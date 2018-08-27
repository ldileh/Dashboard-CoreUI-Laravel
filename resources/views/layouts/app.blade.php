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

    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

    {{-- vex --}}
    <link rel="stylesheet" href="{{ asset('css/vex.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vex-theme-os.css') }}" />

    {{-- select 2 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }}">

    {{-- datapicker --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
        <img class="navbar-brand-full" src="{{ asset('img/logo.svg') }}" width="100" alt="Application Logo">
        <img class="navbar-brand-minimized" src="{{ asset('img/logo-mini.svg') }}" width="30" height="30" alt="Application Logo">
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
          @yield('content')
        </div>
      </main>

    </div>
    <footer class="app-footer">
      <div>
        <a href="https://ldileh.blogspot.com">Project</a>
        <span>&copy; 2018 ldileh.</span>
      </div>
    </footer>

    {{-- load script --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script-main.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

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