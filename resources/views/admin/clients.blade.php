@extends('layouts.admin')

@section('content')
<style>
body { background-color: #0d1117; color: #e6edf3; }
.card { background-color: #161b22; border: 1px solid #30363d; border-radius: 12px; padding: 1.5rem; }
.table { color: #e6edf3; }
.table thead { background-color: #21262d; }
.table-hover tbody tr:hover { background-color: #2c313a; }
.btn-primary { background-color: #238636; border: none; }
.btn-primary:hover { background-color: #2ea043; }
.pagination { justify-content: center; }
.pagination .page-link { background-color: #161b22; color: #e6edf3; border: 1px solid #30363d; }
.pagination .page-link:hover { background-color: #238636; color: white; }
.pagination .active .page-link { background-color: #238636; color: white; }
</style>

<div class="main-content text-center">
    <h2 class="mb-4">👥 Clients List</h2>

    <div class="card mb-4 text-start">
        <form method="GET" action="{{ route('admin.clients') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-light">Search Client</label>
                    <input type="text" name="search" class="form-control bg-dark text-light border-secondary" placeholder="Name or Email" value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                <div class="col-md-2 d-grid">
                    <a href="{{ route('admin.clients') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <div class="card shadow-sm">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Total Tickets</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->tickets->count() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="text-center text-light mt-2">
            {{ $clients->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
