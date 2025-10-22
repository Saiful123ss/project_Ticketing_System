<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="profileDropdown" data-bs-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile image">
            <p class="mb-0 d-none d-sm-block navbar-profile-name">Admin</p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
        </a>
      </li>
    </ul>
  </div>
</nav> 
