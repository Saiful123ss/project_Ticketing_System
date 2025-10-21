<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
            color: #f1f1f1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #2c2c2c;
        }

        .navbar-brand {
            color: #00d8ff !important;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link {
            color: #bbb !important;
            transition: 0.3s;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #00d8ff !important;
        }

        /* Main Container */
        .container {
            flex: 1;
            max-width: 1100px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* Cards */
        .card {
            background: rgba(40, 40, 40, 0.85);
            border: 1px solid #2b2b2b;
            border-radius: 12px;
            backdrop-filter: blur(6px);
        }

        .card-header {
            background: rgba(0, 216, 255, 0.15);
            border-bottom: 1px solid #00d8ff33;
            color: #00d8ff;
            font-weight: 600;
        }

        .card-body {
            color: #ddd;
        }

        .form-control, .form-select {
            background-color: #111;
            color: #fff;
            border: 1px solid #333;
        }

        .form-control:focus, .form-select:focus {
            background-color: #181818;
            border-color: #00d8ff;
            color: #fff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #00d8ff;
            border: none;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #00b0cc;
        }

        /* Footer */
        footer {
            text-align: center;
            color: #777;
            font-size: 14px;
            padding: 20px 0;
            border-top: 1px solid #2b2b2b;
            background: #0d0d0d;
        }

        footer a {
            color: #00d8ff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('category.choose') }}">🎫 Ticket System</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <!-- ✅ Updated: Submit Ticket goes to Category Choose -->
                        <a class="nav-link {{ request()->routeIs('category.choose') ? 'active' : '' }}" href="{{ route('category.choose') }}">Submit Ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ticket.track') ? 'active' : '' }}" href="{{ route('ticket.track') }}">Track Ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.login') ? 'active' : '' }}" href="{{ route('admin.login') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <main class="flex-grow-1">
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success mt-4">{{ session('success') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <p>© {{ date('Y') }} Ticket System — Built with 💻 by <a href="#">Reo</a>.</p>
    </footer>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
