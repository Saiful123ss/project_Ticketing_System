<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0d1117;
            color: #e6edf3;
            font-family: 'Inter', sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #161b22;
            border-right: 1px solid #30363d;
            width: 240px;
            height: 100vh;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h4 {
            color: #f0f6fc;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar a {
            color: #c9d1d9;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #238636;
            color: #fff;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            flex: 1;
        }

        .btn-logout {
            margin-top: auto;
        }

        .btn-danger {
            background-color: #d73a49;
            border: none;
        }

        .btn-danger:hover {
            background-color: #b62334;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>🎫 Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.tickets') }}" class="{{ request()->routeIs('admin.tickets') ? 'active' : '' }}">All Tickets</a>
        <a href="{{ route('admin.clients') }}" class="{{ request()->routeIs('admin.clients') ? 'active' : '' }}">Clients</a>
        <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">Reports</a>
        <a href="#">Settings</a>

        <form method="POST" action="{{ route('admin.logout') }}" class="btn-logout">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
