<ul class="nav">
	<li class="nav-item">
	  <a class="nav-link" href="{{ route('home') }}">
	    <i class="nav-icon icon-speedometer"></i> Dashboard
	  </a>
	  @if (Auth::user()->isAdmin())
	  <a class="nav-link" href="{{ route('user') }}">
	    <i class="nav-icon icon-people"></i> Users
	  </a>
	  @endif
	  <a class="nav-link" href="{{ route('news') }}">
	    <i class="nav-icon icon-menu"></i> News
	  </a>
      <a class="nav-link" href="{{ route('member') }}">
	    <i class="nav-icon icon-people"></i> Members
	  </a>
	</li>
</ul>
