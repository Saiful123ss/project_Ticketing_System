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
</head>
<body>
  <div class="container-scroller">
    
    {{-- ✅ 1. Navbar atas --}}
    @include('partials.navbar')

    <div class="container-fluid page-body-wrapper">
      
      {{-- ✅ 2. Sidebar kiri --}}
      @include('partials.sidebar')

      {{-- ✅ 3. Main content kanan --}}
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
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
