<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Admin Panel</span>
          <span class="text-secondary text-small">Ticket System</span>
        </div>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.clients') }}">
        <span class="menu-title">Clients</span>
        <i class="mdi mdi-account-group menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>
