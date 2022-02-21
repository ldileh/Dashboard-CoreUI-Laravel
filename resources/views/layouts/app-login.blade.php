<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Login Page</title>
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style-main.css') }}" rel="stylesheet">

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
  <body class="app flex-row align-items-center">
     @yield('content')

    <script src="{{ asset('js/script-main.js') }}"></script>
  </body>
</html>
