@extends('layouts.admin')

@section('content')

<div class="page-header">
  <h3 class="page-title">Dashboard Overview</h3>
</div>

{{-- ✅ Summary Cards --}}
<div class="row">
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-primary text-white text-center">
      <div class="card-body">
        <h5>Open</h5>
        <h3>{{ $ticketCounts['open'] ?? 0 }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-warning text-white text-center">
      <div class="card-body">
        <h5>In Progress</h5>
        <h3>{{ $ticketCounts['in_progress'] ?? 0 }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-success text-white text-center">
      <div class="card-body">
        <h5>Resolved</h5>
        <h3>{{ $ticketCounts['resolved'] ?? 0 }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-secondary text-white text-center">
      <div class="card-body">
        <h5>Closed</h5>
        <h3>{{ $ticketCounts['closed'] ?? 0 }}</h3>
      </div>
    </div>
  </div>
</div>

{{-- 🔍 Filter Section --}}
<div class="card mb-4">
  <div class="card-body">
    <form method="GET" action="{{ route('admin.dashboard') }}">
      <div class="row g-2 align-items-end">
        <div class="col-md-3">
          <label class="form-label">Ticket ID</label>
          <input type="text" name="ticket_id" class="form-control"
            placeholder="Search Ticket ID" value="{{ $filters['ticket_id'] ?? '' }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="">-- All Status --</option>
            <option value="Open" {{ ($filters['status'] ?? '') == 'Open' ? 'selected' : '' }}>Open</option>
            <option value="In Progress" {{ ($filters['status'] ?? '') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Resolved" {{ ($filters['status'] ?? '') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="Closed" {{ ($filters['status'] ?? '') == 'Closed' ? 'selected' : '' }}>Closed</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Created Date</label>
          <input type="date" name="created_at" class="form-control"
            value="{{ $filters['created_at'] ?? '' }}">
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
        <div class="col-md-1 d-grid">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- 🧾 Recent Tickets --}}
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Recent Tickets</h4>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Domain</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tickets as $ticket)
            <tr>
              <td>#{{ $ticket->ticket_id }}</td>
              <td>{{ $ticket->client_name ?? ($ticket->client->name ?? 'N/A') }}</td>
              <td>{{ $ticket->domain ?? ($ticket->client->domain ?? 'N/A') }}</td>
              <td>{{ $ticket->title }}</td>
              <td>{{ $ticket->category }}</td>
              <td>
                @php $status = strtolower($ticket->status); @endphp
                @if($status == 'open')
                  <label class="badge badge-primary">Open</label>
                @elseif($status == 'in progress' || $status == 'in_progress')
                  <label class="badge badge-warning">In Progress</label>
                @elseif($status == 'resolved')
                  <label class="badge badge-success">Resolved</label>
                @elseif($status == 'closed')
                  <label class="badge badge-secondary">Closed</label>
                @endif
              </td>
              <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
              <td>
                <a href="{{ route('admin.ticket.details', $ticket->ticket_id) }}" class="btn btn-sm btn-success text-white">View</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No tickets found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
      {{ $tickets->appends(request()->query())->links('pagination::bootstrap-5') }}
      <div class="text-center mt-2 text-muted">
        {{ $tickets->firstItem() }} – {{ $tickets->lastItem() }} of {{ $tickets->total() }} results
      </div>
    </div>
  </div>
</div>
@endsection
