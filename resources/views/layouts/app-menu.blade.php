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
	    <i class="nav-icon icon-notebook"></i> News
	  </a>
      <a class="nav-link" href="{{ route('member') }}">
	    <i class="nav-icon icon-organization"></i> Members
	  </a>
      <a class="nav-link" href="{{ route('gallery') }}">
	    <i class="nav-icon icon-book-open"></i> Gallery
	  </a>
      <a class="nav-link" href="{{ route('product') }}">
	    <i class="nav-icon icon-social-dropbox"></i> Products
	  </a>
      <a class="nav-link" href="{{ route('video') }}">
	    <i class="nav-icon icon-disc"></i> Video
	  </a>
      <a class="nav-link" href="{{ route('business_unit') }}">
	    <i class="nav-icon icon-magic-wand"></i> Business Unit
	  </a>
      <a class="nav-link" href="{{ route('company_profile') }}">
	    <i class="nav-icon icon-star"></i> Company Profile
	  </a>
	</li>
</ul>
