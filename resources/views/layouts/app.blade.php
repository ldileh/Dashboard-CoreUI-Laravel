<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Main styles for this application-->
    <link href="{{ asset('css/style-main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('extra-css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="icon" href="{{ asset('img/icon.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{asset('site/images/ico/apple-touch-icon-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{asset('site/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{asset('site/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="57x57"
        href="{{asset('site/images/ico/apple-touch-icon-57-precomposed.png') }}">
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="loading">
      <img id="loading-image" src="{{ asset('img/progress-loading.gif') }}" alt="Loading..." />
    </div>

    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('img/ic_logo_admin_panel.png') }}" width="100" alt="Application Logo">
        <img class="navbar-brand-minimized" src="{{ asset('img/icon.png') }}" width="30" height="30" alt="Application Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="{{ asset('img/default-user.jpg') }}" alt="{{ Auth::user()->email }}">
          </a>
          @include('layouts.app-menu-extra')
        </li>
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          @include('layouts.app-menu')
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <div class="container-fluid" style="margin-top: 16px;">
          <div class="animated fadeIn">
            @yield('content')
          </div>
        </div>
      </main>

    </div>
    <footer class="app-footer">
      <div>
        <a href="{{url('')}}">KPAM Company Profile</a>
        <span>&copy; 2022 KPAM.</span>
      </div>
    </footer>

    {{-- load script --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script-main.js') }}"></script>
    @yield('extra-js')

    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>

    @stack('scripts')
  </body>
</html>
