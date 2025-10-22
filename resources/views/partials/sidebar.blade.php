<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Profile Section -->
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text">
          <span class="font-weight-bold mb-2">Admin</span>
          <span class="text-secondary text-small">System Administrator</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-speedometer menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Tickets -->
    <li class="nav-item {{ request()->routeIs('admin.tickets') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.tickets') }}">
        <i class="mdi mdi-ticket menu-icon"></i>
        <span class="menu-title">All Tickets</span>
      </a>
    </li>

    <!-- Clients -->
    <li class="nav-item {{ request()->routeIs('admin.clients') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.clients') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Clients</span>
      </a>
    </li>

    <!-- Reports -->
    <li class="nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.reports') }}">
        <i class="mdi mdi-file-chart menu-icon"></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>

    <!-- Logout -->
    <li class="nav-item mt-4">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-gradient-danger w-100">
          <i class="mdi mdi-logout me-2"></i> Logout
        </button>
      </form>
    </li>
  </ul>
</nav>
