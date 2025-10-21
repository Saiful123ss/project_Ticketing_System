@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h2 class="text-center mb-4">🎫 Track Your Ticket</h2>

  <!-- Track Form -->
  <div class="card p-3 mb-4">
    <form method="GET" action="{{ route('ticket.track') }}">
      <div class="mb-2">
        <label style="color: white;">Enter Ticket ID</label>
        <input type="text" name="id" class="form-control" value="{{ request('id') }}">
      </div>
      <div class="mb-2">
        <label style="color: white;">Track Key</label>
        <input type="text" name="key" class="form-control" value="{{ request('key') }}">
      </div>
      <button class="btn btn-primary">Track</button>
    </form>
  </div>

  @if(isset($error))
    <div class="alert alert-danger">{{ $error }}</div>
  @endif

  @if(isset($ticket))
    <!-- Ticket Info -->
  <div class="card mb-3">
    <div class="card-header bg-info text-white">Ticket Details</div>
    <div class="card-body">
      <p><strong>Title:</strong> {{ $ticket->title }}</p>
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
                            @endif
      </p>
      <p><strong>Created At:</strong> 
        {{ \Carbon\Carbon::parse($ticket->created_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
      </p>
  
      <!-- Client Ticket Status Buttons -->
      <div class="d-flex gap-2 mt-3">
        @if($ticket->status !== 'closed')
            <form method="POST" action="{{ route('ticket.status', $ticket->ticket_id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="closed">
                <button type="submit" class="btn btn-danger shadow-sm">
                    🚫 Close Ticket
                </button>
            </form>
        @endif
      </div>
    </div>
  </div>


    <!-- WhatsApp-style Conversation -->
    <style>
      .chat-box {
        background: #f0f2f5;
        padding: 15px;
        border-radius: 10px;
        max-height: 500px;
        overflow-y: auto;
      }
      .message {
        display: flex;
        margin-bottom: 12px;
      }
      .message .bubble {
        padding: 10px 15px;
        border-radius: 18px;
        max-width: 70%;
        word-wrap: break-word;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
      }
      .message.client {
        justify-content: flex-end; /* Client (You) on right side */
      }
      .message.client .bubble {
        background: #dcf8c6; /* WhatsApp green */
        color: #000;
      }
      .message.admin {
        justify-content: flex-start; /* Admin on left */
      }
      .message.admin .bubble {
        background: #ffffff;
        color: #000;
        border: 1px solid #ddd;
      }
      .message small {
        display: block;
        font-size: 12px;
        color: #888;
        margin-top: 4px;
        text-align: right;
      }
    </style>

    <div class="card mb-3">
      <div class="card-header bg-light">Conversation</div>
      <div class="card-body chat-box" id="chatBox">
        @forelse($replies as $reply)
          <div class="message {{ $reply->user_type }}">
            <div class="bubble">
              {!! nl2br(e($reply->message)) !!}
              @if($reply->attachments)
                <p><a href="{{ asset('storage/'.$reply->attachments) }}" target="_blank">📎 View Attachment</a></p>
              @endif
              <small>
                {{ \Carbon\Carbon::parse($reply->created_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
                @if($reply->user_type == 'admin') • Admin @else • You @endif
              </small>
            </div>
          </div>
        @empty
          <p class="text-center text-muted">No messages yet.</p>
        @endforelse
      </div>
    </div>

    <!-- Reply Form -->
    <div class="card mb-5">
      <div class="card-header bg-success text-white">Add a Reply</div>
      <div class="card-body">
        <form method="POST" action="{{ route('ticket.reply') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
          <input type="hidden" name="user_type" value="client">
          <div class="mb-3">
            <textarea name="message" rows="3" class="form-control" placeholder="Type your message..." required></textarea>
          </div>
          <div class="mb-3">
            <input type="file" name="attachments" class="form-control">
          </div>
          <button class="btn btn-success">Send Message</button>
        </form>
      </div>
    </div>
  @endif
</div>

<!-- Auto scroll to latest message -->
<script>
  const chatBox = document.getElementById('chatBox');
  if (chatBox) {
    chatBox.scrollTop = chatBox.scrollHeight;
  }
</script>
@endsection
