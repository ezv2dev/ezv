<!doctype html>
<html class="no-js" lang="zxx">

<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>EZV2</title>

    <!--====== Favicon ======-->
    <link rel="shortcut icon" href="{{ asset('assets/user/assets/images/logo/favicon.png') }}" type="images/x-icon" />

    <!--====== CSS Here ======-->
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/assets/css/responsive.css') }}">

</head>

<body>
    <!-- HEADER -->
    {{-- @include('layouts.user.header') --}}
    <!-- HEADER -->

    @yield('content')

    {{-- @include('layouts.user.footer') --}}

    <!--========= JS Here =========-->
    <script src="{{ asset('assets/user/assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/lightcase.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('assets/user/assets/js/main.js') }}"></script>

    @yield('scripts')

</body>

</html>