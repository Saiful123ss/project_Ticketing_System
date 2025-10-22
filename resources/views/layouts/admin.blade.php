<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  {{-- ✅ PurpleAdmin CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
</head>

<body>
  <div class="container-scroller">

    {{-- ✅ Page Body Wrapper (holds sidebar + main content) --}}
    <div class="container-fluid page-body-wrapper">

      {{-- ✅ Sidebar (now correctly placed inside wrapper) --}}
      @include('partials.sidebar')

      {{-- ✅ Main Panel --}}
      <div class="main-panel">

        {{-- ✅ Navbar (optional, only if exists) --}}
        @includeIf('partials.navbar')

        {{-- ✅ Content --}}
        <div class="content-wrapper">
          @yield('content')
        </div>

      </div> {{-- End Main Panel --}}
    </div> {{-- End Page Body Wrapper --}}
  </div> {{-- End Container Scroller --}}

  <!-- ✅ PurpleAdmin JS -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
</body>
</html>
