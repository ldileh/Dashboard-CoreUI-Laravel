<ul class="nav">
	<li class="nav-item">
	  <a class="nav-link" href="{{ route('home') }}">
	    <i class="nav-icon icon-speedometer"></i> Beranda
	  </a>
	  @if (Auth::user()->isAdmin()) 
	  <a class="nav-link" href="{{ route('user') }}">
	    <i class="nav-icon icon-people"></i> User
	  </a>
	  @endif
	  <a class="nav-link" href="{{ route('user.mahasiswa') }}">
	    <i class="nav-icon icon-people"></i> Mahasiswa
	  </a>
	</li>
</ul>