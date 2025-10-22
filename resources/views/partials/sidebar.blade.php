<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Admin</span>
          <span class="text-secondary text-small">System Administrator</span>
        </div>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.tickets') ? 'active' : '' }}" href="{{ route('admin.tickets') }}">
        <span class="menu-title">All Tickets</span>
        <i class="mdi mdi-ticket menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.clients') ? 'active' : '' }}" href="{{ route('admin.clients') }}">
        <span class="menu-title">Clients</span>
        <i class="mdi mdi-account-multiple menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}">
        <span class="menu-title">Reports</span>
        <i class="mdi mdi-file-chart menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
      </form>
    </li>
  </ul>
</nav> 
