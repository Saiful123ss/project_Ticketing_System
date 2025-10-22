@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">🎫 Ticket Details - #{{ $ticket->ticket_id }}</h3>

  <!-- Ticket Details -->
  <div class="card mb-3">
    <div class="card-header bg-info text-white">Ticket Info</div>
    <div class="card-body">
      <p><strong>Client:</strong> {{ $ticket->client_name }} ({{ $ticket->client_email }})</p>
      <p><strong>Domain:</strong> {{ $ticket->domain ?? '-' }}</p>
      <p><strong>Category:</strong> {{ $ticket->category ?? '-' }}</p>
      <p><strong>Description:</strong> {{ $ticket->description }}</p>
      <p><strong>Status:</strong> <span class="badge bg-secondary">{{ ucfirst($ticket->status) }}</span></p>
      <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($ticket->created_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}</p>
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
      justify-content: flex-start;
    }
    .message.client .bubble {
      background: #ffffff;
      color: #000;
      border: 1px solid #ddd;
    }
    .message.admin {
      justify-content: flex-end;
    }
    .message.admin .bubble {
      background: #dcf8c6;
      color: #000;
    }
    .message small {
      display: block;
      font-size: 12px;
      color: #888;
      margin-top: 4px;
      text-align: right;
    }
  </style>

  <div class="card mb-4">
    <div class="card-header bg-light">Conversation</div>
    <div class="card-body chat-box">
      @forelse($replies as $reply)
        <div class="message {{ $reply->user_type }}">
          <div class="bubble">
            {!! nl2br(e($reply->message)) !!}
            @if($reply->attachments)
              <p><a href="{{ asset('storage/'.$reply->attachments) }}" target="_blank">📎 View Attachment</a></p>
            @endif
            <small>
              {{ \Carbon\Carbon::parse($reply->created_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
              @if($reply->user_type == 'admin') • Admin @else • Client @endif
            </small>
          </div>
        </div>
      @empty
        <p class="text-center text-muted">No replies yet.</p>
      @endforelse
    </div>
  </div>

  <!-- Reply Form (Admin Reply) -->
  <div class="card mb-5">
    <div class="card-header bg-success text-white">Add Reply (Admin)</div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.ticket.reply', $ticket->ticket_id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
        <input type="hidden" name="user_type" value="admin">

        <div class="mb-3">
          <textarea name="message" rows="3" class="form-control" placeholder="Type your reply..." required></textarea>
        </div>

        <div class="mb-3">
          <input type="file" name="attachments" class="form-control">
        </div>

        <button class="btn btn-success">Send Reply</button>
      </form>
    </div>
  </div>
</div>
@endsection
