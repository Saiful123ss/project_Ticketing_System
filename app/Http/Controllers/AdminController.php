<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\Client;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    // Admin dashboard
    public function dashboard(Request $request)
{
    // Start query with relationship
    $query = Ticket::with('client')->orderBy('created_at', 'desc');

    // 🔍 Apply filters
    if ($request->filled('ticket_id')) {
        $query->where('ticket_id', $request->ticket_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }

    // Pagination
    $tickets = $query->paginate(10);

    // Count tickets by status
    $ticketCounts = [
        'open' => Ticket::where('status', 'Open')->count(),
        'in_progress' => Ticket::where('status', 'In Progress')->count(),
        'resolved' => Ticket::where('status', 'Resolved')->count(),
        'closed' => Ticket::where('status', 'Closed')->count(),
    ];

    // Keep filter values in view
    return view('admin.dashboard', compact('tickets', 'ticketCounts'))
        ->with('filters', $request->only('ticket_id', 'status', 'created_at'));
}


    // Filtering tickets
    public function tickets(Request $request)
    {
        $query = Ticket::with('client'); // <-- eager load client
    
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('ticket_id', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
    
        $ticketCounts = [
            'open' => Ticket::where('status', 'Open')->count(),
            'in_progress' => Ticket::where('status', 'In Progress')->count(),
            'resolved' => Ticket::where('status', 'Resolved')->count(),
            'closed' => Ticket::where('status', 'Closed')->count(),
        ];
    
        return view('admin.dashboard', compact('tickets', 'ticketCounts'));
    }

    // Show single ticket details
    public function showTicket($id)
    {
        $ticket = Ticket::with(['replies', 'client'])->findOrFail($id);
        $admins = Admin::all();

        return view('admin.ticket_details', compact('ticket', 'admins'));
    }

    // Relationship (not needed in controller, but okay to keep)
    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    // Add a reply
    public function addReply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:2048',
        ]);

        $ticket = Ticket::findOrFail($id);

        $reply = new TicketReply();
        $reply->ticket_id = $ticket->ticket_id;
        $reply->user_type = 'admin';
        $reply->user_id = auth('admin')->id();
        $reply->message = $request->message;

        if ($request->hasFile('attachments')) {
            $files = [];
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('ticket_attachments', 'public');
                $files[] = $path;
            }
            $reply->attachments = json_encode($files);
        }

        $reply->save();

        // Update ticket status if it's Open
        if ($ticket->status === 'Open') {
            $ticket->status = 'In Progress';
            $ticket->save();
        }

        return redirect()->back()->with('success', 'Reply added successfully!');
    }

    // Update ticket status manually (from buttons)
    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
    
        $status = match ($request->status) {
            'open' => 'Open',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
            default => $ticket->status,
        };
    
        $ticket->status = $status;
        $ticket->save();
    
        return redirect()->back()->with('success', 'Ticket status updated to ' . $status);
    }



    // 🧾 Show Clients List
    public function clients(Request $request)
    {
        $query = Client::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }
    
        $clients = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.clients', compact('clients'));
    }
    
    // 📊 Show Reports
    public function reports()
    {
        // Example: basic stats — you can extend later
        $ticketsByStatus = Ticket::select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->pluck('total', 'status')
                                ->toArray();
    
        $ticketsByMonth = Ticket::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
    
        return view('admin.reports', compact('ticketsByStatus', 'ticketsByMonth'));
    }


    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
