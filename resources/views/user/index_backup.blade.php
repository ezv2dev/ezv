<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    @include('layouts.admin.title')

    <meta name="description" content="EZV2 ">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="EZV2">
    <meta property="og:description" content="EZV2 ">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <link rel="stylesheet" href="{{asset('assets/js/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">


    <style>
        .box {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .overlay {
            z-index: 9;
            margin-top: 500px;
            padding-left: 3%;
            padding-right: 3%;
        }

        .input1 {
            width: 400px;
            height: 50px;
            border-radius: 20px;
        }

        .input2 {
            width: 190px;
            height: 50px;
            border-radius: 20px;
        }

        .input3 {
            width: 189px;
            height: 50px;
            border-radius: 20px;
        }

        .photosGrid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .photosGrid__Photo {
            width: 33.3%;
            width: calc(33.3% - 2px);
            height: 30vw;
            background-position: center;
            background-size: cover;
            margin-bottom: 3px;
        }

        @media screen and (min-width: 736px) {
            main {
                padding: 20px;
            }

            .photosGrid__Photo {
                width: calc(25% - 16px);
                margin-bottom: 26px;
            }


        }

        @media screen and (min-width: 980px) {
            main {
                max-width: 1280px;
                margin: auto;
            }

            .photosGrid__Photo {
                height: 293px;
            }

        }

        input {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            position: relative;
            display: block;
            outline: none;
            margin: 0 auto;
            color: #333;
            -webkit-box-shadow: 0 2px 10px 1px rgba(0, 0, 0, 0.5);
            box-shadow: 0 2px 10px 1px rgba(0, 0, 0, 0.5);
        }

        ::-webkit-input-placeholder {
            color: #000;
        }

        :-moz-placeholder {
            color: #000;
        }

        ::-moz-placeholder {
            color: #000;
        }

        :-ms-input-placeholder {
            color: #000;
        }


        /* 3D Slideshow */
        * {
            margin: 0;
            padding: 0;
        }

        #slideshow {
            margin: 0 auto;
            height: 300px;
            width: 100%;
            box-sizing: border-box;
        }

        .entire-content {
            margin: auto;
            width: 190px;
            perspective: 1000px;
            position: relative;
            padding-top: 80px;
        }

        .content-carrousel {
            width: 100%;
            position: absolute;
            float: right;
            animation: rotar 15s infinite linear;
            transform-style: preserve-3d;
        }

        .content-carrousel:hover {
            animation-play-state: paused;
            cursor: pointer;
        }

        .content-carrousel figure {
            width: 100%;
            height: 120px;
            border: 1px solid #3b444b;
            overflow: hidden;
            position: absolute;
        }

        .content-carrousel figure:nth-child(1) {
            transform: rotateY(0deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(2) {
            transform: rotateY(45deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(3) {
            transform: rotateY(90deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(4) {
            transform: rotateY(135deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(5) {
            transform: rotateY(180deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(6) {
            transform: rotateY(225deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(7) {
            transform: rotateY(270deg) translateZ(300px);
        }

        .content-carrousel figure:nth-child(8) {
            transform: rotateY(315deg) translateZ(300px);
        }

        .shadow {
            position: absolute;
            box-shadow: 0px 0px 20px 0px #000;
            border-radius: 15px;
        }

        .content-carrousel img {
            image-rendering: auto;
            transition: all 300ms;
            width: 100%;
            height: 100%;
        }

        .content-carrousel img:hover {
            transform: scale(1.2);
            transition: all 300ms;
            border-radius: 15px;
        }

        @keyframes rotar {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }

        .user-logged .user-photo {
            width: 50px;
            height: 50px;
            margin-top: -10px;
        }

    </style>

</head>

<body style="background-color:black;">
    <div id="page-container" class="page-header-fixed page-header-glass main-content-boxed">

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header mt-3 justify-content-center justify-content-lg-between">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <a class="link-fx fs-lg fw-semibold text-dark" href="">
                        <span style="color: white">EZV</span><small class="fw-medium" style="color: white">2</small>
                    </a>
                    <!-- END Logo -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-none d-lg-flex align-items-center">
                    <!-- Menu -->
                    <?php
                        $req['location'] = null;
                        $req['check_in'] = null;
                        $req['check_out'] = null;
                        $req['adult'] = null;
                        $req['children'] = null;
                    ?>
                    <ul class="nav-main nav-main-horizontal nav-main-hover">
                        <form action="{{ route('list') }}" method="POST" id="villa-form">
                            @csrf
                            <li class="nav-main-item">
                                <a class="nav-main-link" id="villa-button">
                                    <i class="nav-main-link-icon fa-solid fa-house"
                                        style="font-size: 20px; color:white;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Villa"></i>
                                </a>
                            </li>
                            <?php
                                $req['location'] = null;
                                $req['check_in'] = null;
                                $req['check_out'] = null;
                                $req['adult'] = null;
                                $req['children'] = null;
                            ?>
                            <input type="hidden" name="location" id="location" value="{{ $req['location'] }}">
                            <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                            <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                            <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                            <input type="hidden" name="children" id="children" value="{{ $req['children'] }}">
                        </form>
                        <form action="{{ route('hotel_list') }}" method="POST" id="hotel-form">
                            @csrf
                            <li class="nav-main-item">
                                <a class="nav-main-link" id="hotel-button">
                                    <i class="nav-main-link-icon fa fa-hotel" style="font-size: 20px; color:white;"
                                        data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                        title="Hotel"></i>
                                </a>
                            </li>
                            <?php
                                $req['location'] = null;
                                $req['check_in'] = null;
                                $req['check_out'] = null;
                                $req['adult'] = null;
                                $req['children'] = null;
                            ?>
                            <input type="hidden" name="location" id="location" value="{{ $req['location'] }}">
                            <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                            <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                            <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                            <input type="hidden" name="children" id="children" value="{{ $req['children'] }}">
                        </form>
                        <form action="{{ route('restaurant_list') }}" method="POST" id="restaurant-form">
                            @csrf
                            <li class="nav-main-item">
                                <a class="nav-main-link" id="restaurant-button">
                                    <i class="nav-main-link-icon fa fa-utensils" style="font-size: 20px; color:white;"
                                        data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                        title="Restaurant"></i>
                                </a>
                            </li>
                            <?php
                                $req['location'] = null;
                                $req['check_in'] = null;
                                $req['check_out'] = null;
                                $req['adult'] = null;
                                $req['children'] = null;
                            ?>
                            <input type="hidden" name="location" id="location" value="{{ $req['location'] }}">
                            <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                            <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                            <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                            <input type="hidden" name="children" id="children" value="{{ $req['children'] }}">
                        </form>

                        <form action="{{ route('activity_list') }}" method="POST" id="activity-form">
                            @csrf
                            <li class="nav-main-item">
                                <a class="nav-main-link" id="activity-button">
                                    <i class="nav-main-link-icon fa fa-walking" style="font-size: 20px; color:white;"
                                        data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                        title="Activity"></i>
                                </a>
                            </li>
                            <?php
                                $req['location'] = null;
                                $req['check_in'] = null;
                                $req['check_out'] = null;
                                $req['adult'] = null;
                                $req['children'] = null;
                            ?>
                            <input type="hidden" name="location" id="location" value="{{ $req['location'] }}">
                            <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                            <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                            <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                            <input type="hidden" name="children" id="children" value="{{ $req['children'] }}">
                        </form>

                        @auth
                        <li class="nav-main-item">
                            <h5 class="mt-2 mx-3" style="color: white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                        </li>
                        <li class="nav-main-item">
                            <div class="d-flex user-logged nav-item dropdown no-arrow">
                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{-- Halo, {{Auth::user()->name}}! --}}
                                    @if (Auth::user()->avatar)
                                    <img src="{{Auth::user()->avatar}}" class="user-photo" alt=""
                                        style="border-radius: 50%">
                                    @else
                                    <img src="https://ui-avatars.com/api/?name=Admin" class="user-photo" alt=""
                                        style="border-radius: 50%">
                                    @endif
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                        style="right: 0; left: auto">
                                        <li>
                                            <a href="{{route('index')}}" class="dropdown-item">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                                Out</a>
                                            <form id="logout-form" action="{{route('logout')}}" method="post"
                                                style="display: none">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </li>
                                    </ul>
                                </a>
                            </div>
                        </li>
                        @else
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('login') }}">
                                <i class="nav-main-link-icon fa fa-sign-in" style="font-size: 20px; color:white;"
                                    data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                    title="Login"></i>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('register') }}">
                                <i class="nav-main-link-icon fa fa-user" style="font-size: 20px; color:white;"
                                    data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                    title="Sign Up"></i>
                            </a>
                        </li>
                        @endauth

                        {{-- <li class="nav-main-item">
                            <a class="nav-main-link btn btn-light" href="{{ route('login') }}">
                        LOGIN
                        </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link btn btn-light" href="{{ route('register') }}">
                                SIGN UP
                            </a>
                        </li> --}}
                    </ul>
                    <!-- END Menu -->
                </div>

                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-sidebar-dark">
                <div class="content-header">
                    <form class="w-100" action="be_pages_generic_search.html" method="POST">
                        <div class="input-group">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-primary" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-sidebar-dark">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero -->
            <div class="container">

                <div id="hero" class="bg-image box">
                    <div class="content content-top text-center">

                        <!-- Slider -->
                        <!-- 3D Slideshow Section -->
                        <div id="slideshow">
                            <div class="entire-content">
                                <div class="content-carrousel">
                                    <figure class="shadow"><a href="{{ route ('villa_list') }}"><img
                                                src="{{ asset('foto/home/villa.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/hotel.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/restaurant.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/activity.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="{{ route ('villa_list') }}"><img
                                                src="{{ asset('foto/home/villa.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/hotel.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/restaurant.jpg') }}" /></a></figure>
                                    <figure class="shadow"><a href="#"><img
                                                src="{{ asset('foto/home/activity.jpg') }}" /></a></figure>
                                </div>
                            </div>
                        </div>
                        <!-- End Slider -->

                        <div class="pt-4 pt-lg-6">
                            <form action="{{ route('list') }}" method="POST" id="basic-form">
                                @csrf
                                <div class="mb-2">
                                    <input class="form-control input1" id="location" type="text" name="location"
                                        placeholder="Let's find location..." />
                                </div>
                                <div id="textfield" style="width: 400px; margin: 0 auto;">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <input class="flatpickr form-control bg-white input2" type="text"
                                                style="display: none;" name="check_in" id="check_in"
                                                placeholder="Check In" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="flatpickr form-control bg-white input3" type="text"
                                                style="display: none;" name="check_out" id="check_out"
                                                placeholder="Check Out" />
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <input class="form-control input2" type="number" min="0"
                                                style="display: none;" name="adult" id="adult"
                                                placeholder="Number of adults" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control input3" type="number" min="0"
                                                style="display: none;" name="children" id="children"
                                                placeholder="Number of children" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="button" class="btn btn-outline-light px-4 py-2 m-1">
                                    <i class="fa fa-fw fa-search opacity-50 me-1"></i> Search
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- GALLERY
                    <main>
                        <div class="box overlay">
                            <div class="js-gallery">
                                <section class="photosGrid">
                                    @foreach($photo as $item)
                                    <a href="{{ URL::asset('/foto/gallery/'.strtolower($item->name_villa).'/'.$item->name)}}"
                    class="img-lightbox photosGrid__Photo" style="background-image:
                    url('{{ URL::asset('/foto/gallery/'.strtolower($item->name_villa).'/'.$item->name)}}')">
                    </a>
                    @endforeach
                    </section>
                </div>
                <!-- END Simple Gallery -->
            </div>
        </main>
        end gallery --}}

    </div>

    <!-- END Hero -->

    <!-- Footer -->
    {{-- <footer id="page-footer" class="bg-body-extra-light">
        <div class="content py-5">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                        href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    <a class="fw-semibold" href="https://1.envato.market/r6y" target="_blank">Dashmix 5.1</a> &copy;
                    <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- END Footer -->
    </main>
    <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <script>
        document.getElementById("villa-button").onclick = function () {
            document.getElementById("villa-form").submit();
        }

        document.getElementById("hotel-button").onclick = function () {
            document.getElementById("hotel-form").submit();
        }

        document.getElementById("restaurant-button").onclick = function () {
            document.getElementById("restaurant-form").submit();
        }

        document.getElementById("activity-button").onclick = function () {
            document.getElementById("activity-form").submit();
        }

    </script>


    <script src="{{asset('assets/js/dashmix.app.min.js')}}"></script>

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-magnific-popup']);

    </script>

    <script>
        $("#location").keyup(function () {
            var id = $(this).val();
            if ((id).length >= 1) {
                $("#adult").fadeIn("slow");
                $("#children").fadeIn("slow");
                $("#check_in").fadeIn("slow");
                $("#check_out").fadeIn("slow");
                $("#button").fadeIn("slow");
            } else {
                $("#adult").fadeOut("slow");
                $("#children").fadeOut("slow");
                $("#check_in").fadeOut("slow");
                $("#check_out").fadeOut("slow");
                $("#button").fadeOut("slow");
            }
        })

    </script>

    <script>
        $('#check_in').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function (selectedDates, dateStr, instance) {
                $('#check_out').flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: new Date(dateStr).fp_incr(1),
                    onChange: function (selectedDates, dateStr, instance) {
                        var start = new Date($('#check_in').val());
                        var end = new Date($('#check_out').val());
                        var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                        var min_stay = $('#min_stay').val();
                        var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                        if (sum_night < min_stay) {
                            alert("minimum stay is " + min_stay + " days");
                        }
                    }
                });
            }
        });

    </script>

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

</body>

</html>
