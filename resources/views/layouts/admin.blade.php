<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">

    {{-- ✅ Top Navbar --}}
    @include('partials.navbar')

    <div class="container-fluid page-body-wrapper">

      {{-- ✅ Sidebar (fixed left) --}}
      @include('partials.sidebar')

      {{-- ✅ Main Content Area --}}
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        {{-- Optional Footer --}}
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© {{ date('Y') }} Purple Dashboard</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with ❤️ by <a href="#" target="_blank">You</a></span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  {{-- JS --}}
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
</body>
</html>
