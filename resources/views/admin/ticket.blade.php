@extends('layouts.admin')

@section('content')
<style>
/* 🌙 DARK THEME DASHBOARD (CENTERED) */
body {
    background-color: #0d1117;
    color: #e6edf3;
    font-family: 'Inter', sans-serif;
}

.main-content {
    margin-left: 260px;
    padding: 2rem;
    display: flex;
    justify-content: center;
}

.dashboard-container {
    width: 100%;
    max-width: 1200px;
}

/* Headings */
h2 {
    color: #f0f6fc;
    font-weight: 600;
}

/* Cards */
.card {
    background-color: #161b22;
    border: 1px solid #30363d;
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255,255,255,0.05);
}

.card h5 {
    font-weight: 600;
    color: #9ba3af;
}

.card p {
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
    color: #e6edf3;
}

/* Table */
.table {
    color: #e6edf3;
}

.table thead {
    background-color: #21262d;
    color: #c9d1d9;
}

.table-hover tbody tr:hover {
    background-color: #2c313a;
}

/* Buttons */
.btn-primary {
    background-color: #238636;
    border: none;
}

.btn-primary:hover {
    background-color: #2ea043;
}

/* ✅ Green "View" button */
.btn-view {
    background-color: #238636;
    border: none;
    color: #fff;
}

.btn-view:hover {
    background-color: #2ea043;
    color: #fff;
}

.btn-outline-secondary {
    color: #c9d1d9;
    border-color: #30363d;
}

.btn-outline-secondary:hover {
    background-color: #30363d;
    color: #fff;
}

/* Badges */
.badge {
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 0.8rem;
    text-transform: capitalize;
}

.bg-primary { background-color: #1f6feb !important; }
.bg-warning { background-color: #bb8009 !important; }
.bg-success { background-color: #238636 !important; }
.bg-secondary { background-color: #6e7681 !important; }

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

/* Filter Card */
.filter-card {
    background-color: #161b22;
    border: 1px solid #30363d;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
}

/* Pagination */
.pagination {
    justify-content: center;
}

.pagination .page-link {
    background-color: #161b22;
    color: #e6edf3;
    border: 1px solid #30363d;
    border-radius: 6px;
    margin: 0 3px;
}

.pagination .page-link:hover {
    background-color: #238636;
    color: white;
}

.pagination .active .page-link {
    background-color: #238636;
    border-color: #238636;
    color: white;
}

/* ✅ White text for "Showing X to Y of Z results" */
.pagination-summary {
    color: #fff;
    text-align: center;
    margin-top: 10px;
    font-size: 0.9rem;
}
</style>

<div class="dashboard-container">
    <div class="header">
        <h2>Dashboard Overview</h2>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <h5>Open</h5>
                <p>{{ $ticketCounts['open'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <h5>In Progress</h5>
                <p>{{ $ticketCounts['in_progress'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <h5>Resolved</h5>
                <p>{{ $ticketCounts['resolved'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <h5>Closed</h5>
                <p>{{ $ticketCounts['closed'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    {{-- 🔍 Filter Section --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label text-light">Ticket ID</label>
                    <input type="text" name="ticket_id" class="form-control bg-dark text-light border-secondary"
                        placeholder="Search Ticket ID"
                        value="{{ $filters['ticket_id'] ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-light">Status</label>
                    <select name="status" class="form-select bg-dark text-light border-secondary">
                        <option value="">-- All Status --</option>
                        <option value="Open" {{ ($filters['status'] ?? '') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ ($filters['status'] ?? '') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ ($filters['status'] ?? '') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ ($filters['status'] ?? '') == 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-light">Created Date</label>
                    <input type="date" name="created_at" class="form-control bg-dark text-light border-secondary"
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

    {{-- Recent Tickets --}}
    <div class="card shadow-sm mt-4">
        <h5 class="mb-3">Recent Tickets</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                                <span class="badge bg-primary">Open</span>
                            @elseif($status == 'in progress' || $status == 'in_progress')
                                <span class="badge bg-warning">In Progress</span>
                            @elseif($status == 'resolved')
                                <span class="badge bg-success">Resolved</span>
                            @elseif($status == 'closed')
                                <span class="badge bg-secondary">Closed</span>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.ticket.details', $ticket->ticket_id) }}" class="btn btn-sm btn-view">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No tickets found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ Pagination & Summary --}}
        <div class="mt-3">
            {{ $tickets->appends(request()->query())->links('pagination::bootstrap-5') }}
            <div class="pagination-summary">
                {{ $tickets->firstItem() }} – {{ $tickets->lastItem() }} of {{ $tickets->total() }} results
            </div>
        </div>
    </div>
</div>
@endsection
