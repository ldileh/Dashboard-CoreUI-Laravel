<div class="dropdown-menu dropdown-menu-right">
  <div class="dropdown-header text-center">
    <strong>Settings</strong>
  </div>
  <a class="dropdown-item" href="{{ route('profile') }}">
    <i class="fa fa-user"></i> Profile
  </a>
  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa fa-lock"></i> {{ __('Logout') }}
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
</div>