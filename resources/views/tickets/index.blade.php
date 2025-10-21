@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>All Tickets</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Client Name</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->ticket_id }}</td>
                <td>{{ $ticket->client?->name ?? 'N/A' }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ ucfirst($ticket->status) }}</td>
                <td>{{ $ticket->created_at?->format('d M Y, h:i A') ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No tickets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
