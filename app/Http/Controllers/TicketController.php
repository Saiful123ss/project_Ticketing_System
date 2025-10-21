<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Str;
use App\Mail\TicketSubmittedMail;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    // Category chooser
    public function chooseCategory()
    {
        // Blade: resources/views/category.blade.php
        return view('tickets.category');
    }

    // Show form
    public function showForm(Request $request)
    {
        $category = $request->query('category', 'Other Issue');
        // Blade: resources/views/form.blade.php
        return view('tickets.form', compact('category'));
    }

    // Submit form
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'domain' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'category' => 'required|string|max:50',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);
    
        // ✅ Create client
        $client = Client::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'domain' => $request->domain,
            'email' => $request->email,
            'category' => $request->category,
            'created_at' => now(),
        ]);
    
        // ✅ Generate tracking key
        $trackKey = strtoupper(Str::random(10));
    
        // ✅ Create ticket
        $ticket = Ticket::create([
            'client_id' => $client->client_id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'status' => 'open',
            'track_key' => $trackKey,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // ✅ Save attachment (optional)
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            TicketReply::create([
                'ticket_id' => $ticket->ticket_id,
                'user_type' => 'client',
                'user_id' => $client->client_id,
                'message' => '[Attachment uploaded]',
                'attachments' => $path,
                'created_at' => now(),
            ]);
        }
    
        // ✅ Generate tracking link
        $track_link = route('ticket.track', [
            'id' => $ticket->ticket_id,
            'key' => $trackKey,
        ]);
    
        // ✅ Send Gmail email (only if client provided email)
        if ($client->email) {
            Mail::to($client->email)->send(new TicketSubmittedMail($ticket, $track_link));
        }
    
        // ✅ Return success page
        return view('tickets.success', [
            'ticket' => $ticket,
            'track_link' => $track_link,
        ]);
    }

    // Track page (GET with ?id=...&key=...)
    public function track(Request $request)
    {
        $ticketId = $request->query('id');
        $trackKey = $request->query('key');

        if (!$ticketId || !$trackKey) {
            // show track form only
            return view('tickets.track');
        }

        $ticket = Ticket::with('replies','client')->where('ticket_id',$ticketId)->where('track_key',$trackKey)->first();

        if (!$ticket) {
            return view('tickets.track',['error'=>'Invalid tracking info.','replies'=>collect()]);
        }

        return view('tickets.track',['ticket'=>$ticket,'replies'=>$ticket->replies]);
    }

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

    public function getReplies($id)
    {
        $ticket = Ticket::with('replies')->findOrFail($id);
        return view('partials.ticket_replies', compact('ticket'));
    }

    public function store(Request $request)
    {
        // 1️⃣ Create the ticket
        $ticket = Ticket::create([
            'title' => $request->title,
            'status' => 'pending',
            'email' => $request->email, // make sure your form collects this
            // other fields...
        ]);

        // 2️⃣ Generate the track link
        $track_link = route('ticket.track', ['id' => $ticket->ticket_id]);

        // 3️⃣ Send email to the user
        Mail::to($ticket->email)->send(new TicketSubmittedMail($ticket, $track_link));

        // 4️⃣ Show success page
        return view('ticket.success', compact('ticket', 'track_link'));
    }

    // Add reply (client)
    public function addReply(Request $request)
    {
        $request->validate([
            'ticket_id'=>'required|exists:ticket,ticket_id',
            'user_type'=>'required|string',
            'message'=>'required|string',
            'attachments'=>'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5124'
        ]);

        $path = null;
        if ($request->hasFile('attachments')) {
            $path = $request->file('attachments')->store('attachments','public');
        }

        TicketReply::create([
            'ticket_id'=>$request->ticket_id,
            'user_type'=>$request->user_type,
            'user_id'=>null,
            'message'=>$request->message,
            'attachments'=>$path,
            'created_at'=>now()
        ]);

        $ticket = \App\Models\Ticket::find($request->ticket_id);
        
        if ($ticket) {
            if ($request->user_type === 'client' && $ticket->status !== 'Closed' && $ticket->status !== 'Open') {
                $ticket->status = 'In Progress';
                $ticket->save();
            }
        }

        return redirect()->back()->with('success','Reply added.');
    }
}