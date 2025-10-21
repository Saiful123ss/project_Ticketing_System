@foreach($ticket->replies as $reply)
    <div class="message {{ $reply->user_type }}">
        <p>{{ $reply->message }}</p>
        <small>{{ $reply->created_at->diffForHumans() }}</small>
    </div>
@endforeach 
