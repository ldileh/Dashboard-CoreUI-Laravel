<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="{{asset('site/css/bootstrap.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/bootstrap.min.css') }}">
        </noscript>
        <!-- Animate CSS -->
        <link href="{{asset('site/css/animate.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/animate.min.css') }}">
        </noscript>
        <link rel="preload" href="{{asset('site/css/font-awesome.min.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/font-awesome.min.css') }}">
        </noscript>
        <link rel="preload" href="{{asset('site/css/font-awesome.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/font-awesome.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/icon.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/icon.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/magnific-popup.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/magnific-popup.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/animate.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/animate.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/slick.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/slick.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/structure.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/structure.min.css') }}"></noscript>
        <link rel="preload" href="{{asset('site/css/main.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/main.css') }}"></noscript>
        {{-- @if($language->text_direction == "RTL")
            <link rel="preload" href="{{asset('site/css/rtl.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
            <noscript><link  rel="stylesheet" href="{{asset('site/css/rtl.min.css') }}"></noscript>
        @endif --}}
        <link rel="preload" href="{{asset('site/css/responsive.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link  rel="stylesheet" href="{{asset('site/css/responsive.min.css') }}"></noscript>

        <!-- Meanmenu CSS -->
        <link href="{{asset('site/css/meanmenu.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/meanmenu.css') }}">
        </noscript>
        <!-- Boxicons CSS -->
        <link href="{{asset('site/css/boxicons.min.css') }}" rel="stylesheet">
        <!-- Owl Carousel CSS -->
        <link href="{{asset('site/css/owl.carousel.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/owl.carousel.min.css') }}">
        </noscript>
        <!-- Owl Carousel Default CSS -->
        <link href="{{asset('site/css/owl.theme.default.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/owl.theme.default.min.css') }}">
        </noscript>
        <!-- Magnific Popup CSS -->
        <link href="{{asset('site/css/magnific-popup.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/magnific-popup.min.css') }}">
        </noscript>
        <!-- Nice Select CSS -->
        <link href="{{asset('site/css/nice-select.min.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/nice-select.min.css') }}">
        </noscript>
        <!-- Style CSS -->
        <link href="{{asset('site/css/style.css') }}" rel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/style.css') }}">
        </noscript>
        <!-- Responsive CSS -->
        <link href="{{asset('site/css/responsive.css') }}" arel="preload" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/responsive.css') }}">
        </noscript>

        <link rel="preload" href="{{asset('site/css/icon.min.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="{{asset('site/css/icon.min.css') }}">
        </noscript>

        <link
            rel="preload"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap"
            as="style"
            onload="this.onload=null;this.rel='stylesheet'">

        <noscript>
            <link
                href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap"
                rel="stylesheet">
        </noscript>

        <link rel="preload" href="{{asset('site/css/custom.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

        @yield('style')

        <link rel="icon" href="{{ asset('img/icon.png') }}">
        <link rel="apple-touch-icon" sizes="144x144"
            href="{{asset('site/images/ico/apple-touch-icon-precomposed.png') }}">
        <link rel="apple-touch-icon" sizes="114x114"
            href="{{asset('site/images/ico/apple-touch-icon-114-precomposed.png') }}">
        <link rel="apple-touch-icon" sizes="72x72"
            href="{{asset('site/images/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon" sizes="57x57"
            href="{{asset('site/images/ico/apple-touch-icon-57-precomposed.png') }}">

        {{-- @include('feed::links') --}}
    </head>

    <body>

        <!-- Start Preloader -->
        {{-- <div class="preloader">
            <div class="loader">
                <div class="wrapper">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-1a"></div>
                    <div class="circle circle-2"></div>
                    <div class="circle circle-3"></div>
                </div>
                <span>Loading...</span>
            </div>
        </div> --}}
        <!-- End Preloader -->

        @include('layouts.site.site-header')

        @yield('content')

        {{-- <div class="scrollToTop" id="display-nothing">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div> --}}

        @include('layouts.site.site-footer')

        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id={{ settingHelper('google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', '{{ settingHelper('google_analytics_id') }}');
        </script> --}}

        <!-- Jquery Slim JS -->
        <script src="{{asset('site/js/jquery.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{asset('site/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('site/js/bootstrap.min.js') }}"></script>
        <!-- Meanmenu JS -->
        <script src="{{asset('site/js/jquery.meanmenu.js') }}"></script>
        <!-- Owl Carousel JS -->
        <script src="{{asset('site/js/owl.carousel.min.js') }}"></script>
        {{--<!-- Magnific Popup JS -->--}}
        <script src="{{asset('site/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Nice Select JS -->
        <script src="{{asset('site/js/nice-select.min.js') }}"></script>
        <!-- Ajaxchimp JS -->
        <script src="{{asset('site/js/jquery.ajaxchimp.min.js') }}"></script>
        {{--<!-- Form Validator JS -->--}}
        <script src="{{asset('site/js/form-validator.min.js') }}"></script>
        <!-- Contact JS -->
        <script src="{{asset('site/js/contact-form-script.js') }}"></script>
        <!-- Wow JS -->
        <script src="{{asset('site/js/wow.min.js') }}"></script>
        <!-- Custom JS -->
        <script src="{{asset('site/js/main.js') }}"></script>
        {{-- <script src="{{asset('site/js/popper.min.js') }}"></script> --}}
        <script src="{{asset('site/js/slick.min.js') }}"></script>
        <script src="{{asset('site/js/theia-sticky-sidebar.min.js') }}"></script>
        {{-- <script src="{{asset('site/js/magnific-popup.min.js') }}"></script> --}}
        <script src="{{asset('site/js/carouFredSel.min.js') }}"></script>
        <script src="{{asset('site/js/custom.js') }}"></script>
        <script defer src="{{asset('site/js/lazyload.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('site/js/webp-support.js') }}"></script>
        {{-- <script type="text/javascript" src="{{ asset('site/js/custom.min.js')}}" type="text/javascript"></script> --}}

        @stack('script')
    </body>
</html>
