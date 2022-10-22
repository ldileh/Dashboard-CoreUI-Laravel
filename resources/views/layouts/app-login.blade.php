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
  </head>
  <body class="app flex-row align-items-center">
     @yield('content')
    
    <script src="{{ asset('js/script-main.js') }}"></script>
  </body>
</html>