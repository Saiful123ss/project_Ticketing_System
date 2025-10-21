@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
  <div class="card p-4 shadow-sm text-white">
    <h3 class="text-success mb-3">Ticket Submitted Successfully 🎉</h3>
    <p><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</p>
    <p><strong>Title:</strong> {{ $ticket->title }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><a href="{{ $track_link }}" class="btn btn-primary">View Ticket</a></p>
  </div>
</div>
@endsection
