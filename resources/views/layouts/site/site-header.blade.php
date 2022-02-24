@php
    $menus = \App\Helpers\ConfigSiteHelper::instance()->menus();
    $socialMedia = \App\Helpers\ConfigSiteHelper::instance()->headerSocialMedia();
@endphp

<!-- Start Top Header Area -->
<div class="top-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <ul class="top-header-social">
                    @foreach($socialMedia as $item)
                    <li>
                        <a href="{{ $item['url'] }}" target="_blank" name="{{ $item['name'] }}">
                            <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Top Header Area -->

<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="{{ route('site') }}" class="navbar-brand">
                        <img src="{{ asset('img/kpam-logo.png') }}" alt="Logo" style="height: 80px">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navbar" >
        <div class="container" >
            <nav class="navbar navbar-expand-md navbar-light" style="height: 85px">
                <a class="navbar-brand" href="{{ route('site') }}">
                    <img src="{{ asset('img/kpam-logo.png') }}" alt="image" style="height: 84px">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="height: 84px">
                    <ul class="navbar-nav">
                        @foreach($menus as $menu)
                        <li class="nav-item">
                            <a href="{{ $menu['url'] }}" class="nav-link" @if (!empty($menu['target'])) target="{{ $menu['target'] }}" @endif>
                                {{ $menu['title'] }}
                                @if(array_key_exists('child', $menu)) <span><i class="bx bx-chevron-down" aria-hidden="true"></i></span>@endif
                            </a>

                            @if(array_key_exists('child', $menu))
                            <ul class="dropdown-menu">
                                @foreach($menu['child'] as $menuChild)
                                <li class="nav-item">
                                    <a href="{{ $menuChild['url'] }}" class="nav-link" @if (!empty($menuChild['target'])) target="{{ $menuChild['target'] }}" @endif>
                                        {{ $menuChild['title'] }}
                                        @if(array_key_exists('child', $menuChild))
                                        <span class="pull-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        @endif
                                    </a>

                                    @if(array_key_exists('child', $menuChild))
                                    <ul class="dropdown-menu">
                                        @foreach($menuChild['child'] as $subMenuChild)
                                        <li class="nav-item">
                                            <a href="{{ $subMenuChild['url'] }}" class="nav-link" @if (!empty($subMenuChild['target'])) target="{{ $subMenuChild['target'] }}" @endif>
                                                {{ $subMenuChild['title'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>

                    <div class="others-options d-flex align-items-center">
                        <div class="option-item">
                            <form class="search-box" method="GET" action="{{ route('site.news') }}">
                                <input type="text" class="form-control" style="margin-bottom: 0px !important;" placeholder="Search for news.." name="search">
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu" style="z-index: 0;">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="option-inner">
                    <div class="others-options d-flex align-items-center">
                        <div class="option-item">
                            <form class="search-box">
                                <input type="text" class="form-control" placeholder="Search for..">
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->

@if(session('error') || session('success'))
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('error'))
                <div id="error_m" class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div id="success_m" class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(isset($errors))
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endif
