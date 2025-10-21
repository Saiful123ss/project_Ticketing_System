@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <h2 class="mb-3 text-light">🎫 Ticket Details - #{{ $ticket->ticket_id }}</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">← Back to Dashboard</a>

    {{-- Ticket Info --}}
    <div class="card mb-4 border-0 shadow-sm bg-dark text-light">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <strong>{{ $ticket->title }}</strong>
            <span class="badge 
                @if($ticket->status=='open') bg-light text-dark
                @elseif($ticket->status=='in_progress') bg-warning text-dark
                @elseif($ticket->status=='resolved') bg-success
                @elseif($ticket->status=='closed') bg-secondary
                @endif
            ">
                {{ ucfirst(str_replace('_',' ',$ticket->status)) }}
            </span>
        </div>
        <div class="card-body">
            <p><strong>Client Name:</strong> {{ $ticket->client->name ?? 'N/A' }}</p>
            <p><strong>Client Email:</strong> {{ $ticket->client->email ?? 'N/A' }}</p>
            <p><strong>Domain:</strong> {{ $ticket->client->domain ?? 'N/A' }}</p>
            <p><strong>Category:</strong> {{ $ticket->category }}</p>
            <p><strong>Description:</strong> {{ $ticket->description }}</p>
            <p><strong>Status:</strong> @php $status = strtolower($ticket->status); @endphp
                            @if($status == 'open')
                                <span class="badge bg-primary">Open</span>
                            @elseif($status == 'in progress' || $status == 'in_progress')
                                <span class="badge bg-warning">In Progress</span>
                            @elseif($status == 'resolved')
                                <span class="badge bg-success">Resolved</span>
                            @elseif($status == 'closed')
                                <span class="badge bg-secondary">Closed</span>
                            @endif</p>
            <p><strong>Created At:</strong> {{ $ticket->created_at->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i A') }}</p>
        </div>
    </div>

    {{-- ✅ Admin Action Buttons --}}
    <div class="d-flex gap-2 mb-4">
        @if($ticket->status !== 'resolved')
            <form method="POST" action="{{ route('admin.ticket.status', $ticket->ticket_id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="resolved">
                <button type="submit" class="btn btn-success shadow-sm">
                    ✅ Mark as Resolved
                </button>
            </form>
        @endif

        @if($ticket->status !== 'closed')
            <form method="POST" action="{{ route('admin.ticket.status', $ticket->ticket_id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="closed">
                <button type="submit" class="btn btn-danger shadow-sm">
                    🚫 Close Ticket
                </button>
            </form>
        @endif
    </div>

    {{-- WhatsApp-Style Conversation --}}
    <h4 class="mb-3 text-light">💬 Conversation</h4>
    <div class="card border-0 shadow-sm mb-4 bg-dark text-light">
        <div class="card-body" style="background-color: #2c2c2c; max-height: 500px; overflow-y: auto;">

            @forelse ($ticket->replies as $reply)
                <div class="d-flex mb-3 {{ $reply->user_type == 'admin' ? 'justify-content-end' : 'justify-content-start' }}">
                    {{-- Chat Bubble --}}
                    <div class="p-2 rounded-3 position-relative"
                        style="
                            max-width: 75%;
                            color: #eee;
                            background-color: {{ $reply->user_type == 'admin' ? '#256F35' : '#3a3a3a' }};
                            border-radius: 18px;
                            box-shadow: 0 1px 1px rgba(0,0,0,0.2);
                        ">
                        
                        {{-- Sender Name --}}
                        <div class="fw-semibold mb-1" style="font-size: 0.9rem; color: #bbb;">
                            {{ $reply->user_type == 'admin' ? 'Admin' : ($reply->client->name ?? 'Client') }}
                        </div>

                        {{-- Message --}}
                        <div style="white-space: pre-line; font-size: 0.95rem; line-height: 1.2;">
                            {{ $reply->message }}
                        </div>

                        {{-- Attachments --}}
                        @if(!empty($reply->attachments))
                            @php $files = json_decode($reply->attachments, true); @endphp
                            <div class="mt-2">
                                @if(is_array($files))
                                    @foreach($files as $file)
                                        <div>
                                            <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-info">
                                                📎 {{ basename($file) }}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div>
                                        <a href="{{ asset('storage/'.$reply->attachments) }}" target="_blank" class="text-decoration-none text-info">
                                            📎 {{ basename($reply->attachments) }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Timestamp --}}
                        <small class="text-muted mt-1 d-block text-end" style="font-size: 0.75rem;">
                            {{ $reply->created_at->timezone('Asia/Kuala_Lumpur')->format('d/m/Y h:i A') }}
                        </small>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted my-3">No replies yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Reply Form --}}
    <div class="card shadow-sm border-0 bg-dark text-light">
        <div class="card-header bg-primary text-white">
            <strong>Reply to Ticket</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.ticket.reply', $ticket->ticket_id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_type" value="admin">

                <div class="mb-3">
                    <textarea name="message" class="form-control bg-dark text-light border-secondary" rows="3" placeholder="Type your reply..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Attachments (optional)</label>
                    <input type="file" name="attachments[]" class="form-control bg-dark text-light border-secondary" multiple>
                </div>

                <button type="submit" class="btn btn-success">Send Reply</button>
            </form>
        </div>
    </div>

</div>
@endsection
