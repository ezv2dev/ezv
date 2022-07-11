<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

            .header-4-4 .modal-backdrop.show {
                background-color: #2c2c2c;
                opacity: 1;
            }

            .header-4-4 .modal-item.modal {
                top: 2rem;
            }

            .header-4-4 .navbar,
            .header-4-4 .hero {
                padding: 3rem 2rem;
            }

            .header-4-4 .navbar-dark .navbar-nav .nav-link {
                font: 300 18px/1.5rem Poppins, sans-serif;
                color: #b9b9b9;
                transition: 0.3s;
            }

            .header-4-4 .navbar-dark .navbar-nav .nav-link:hover {
                font: 600 18px/1.5rem Poppins, sans-serif;
                color: #e7e7e8;
                transition: 0.3s;
            }

            .header-4-4 .navbar-dark .navbar-nav .active>.nav-link,
            .header-4-4 .navbar-dark .navbar-nav .nav-link.active,
            .header-4-4 .navbar-dark .navbar-nav .nav-link.show,
            .header-4-4 .navbar-dark .navbar-nav .show>.nav-link {
                font-weight: 600;
                transition: 0.3s;
            }

            .header-4-4 .navbar-dark .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            .header-4-4 .btn:focus,
            .header-4-4 .btn:active {
                outline: none !important;
            }

            .header-4-4 .btn-fill {
                font: 600 18px / normal Poppins, sans-serif;
                background-image: linear-gradient(rgba(255, 116, 0, 1),
                        rgba(255, 116, 0, 1));
                border-radius: 12px;
                color: #000000;
                padding: 12px 32px;
                transition: 0.3s;
            }

            .header-4-4 .btn-fill:hover {
                color: #000000;
                --tw-shadow: inset 0 0px 18px 0 rgba(0, 0, 0, 0.7);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                    var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                transition: 0.3s;
            }

            .header-4-4 .btn-no-fill {
                font: 300 18px/1.75rem Poppins, sans-serif;
                color: #e7e7e8;
                padding: 12px 32px;
                transition: 0.3s;
            }

            .header-4-4 .btn-no-fill:hover {
                color: #e7e7e8;
                transition: 0.3s;
            }

            .header-4-4 .modal-item .modal-dialog .modal-content {
                border-radius: 8px;
            }

            .header-4-4 .responsive li a {
                padding: 1rem;
                transition: 0.3s;
            }

            .header-4-4 .left-column {
                margin-bottom: 2.75rem;
                width: 100%;
            }

            .header-4-4 .text-caption {
                font: 600 0.875rem/1.625 Poppins, sans-serif;
                margin-bottom: 2rem;
                color: #c3cdfe;
            }

            .header-4-4 .title-text-big {
                font: 600 2.25rem/2.5rem Poppins, sans-serif;
                margin-bottom: 2rem;
            }

            .header-4-4 .btn-try {
                font: 600 1rem/1.5rem Poppins, sans-serif;
                color: #000000;
                padding: 1rem 1.5rem;
                border-radius: 0.75rem;
                background-image: linear-gradient(rgba(255, 116, 0, 1),
                        rgba(255, 116, 0, 1));
                transition: 0.3s;
            }

            .header-4-4 .btn-try:hover {
                color: #000000;
                --tw-shadow: inset 0 0px 18px 0 rgba(0, 0, 0, 0.7);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                    var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                transition: 0.3s;
            }

            .header-4-4 .btn-outline {
                font: 400 1rem/1.5rem Poppins, sans-serif;
                border: 1px solid #999999;
                color: #999999;
                padding: 1rem 1.5rem;
                border-radius: 0.75rem;
                background-color: transparent;
                transition: 0.3s;
            }

            .header-4-4 .btn-outline:hover {
                border: 1px solid #ffffff;
                color: #ffffff;
                transition: 0.3s;
            }

            .header-4-4 .btn-outline:hover div path {
                fill: #ffffff;
                transition: 0.3s;
            }

            .header-4-4 .right-column {
                width: 100%;
            }

            @media (min-width: 576px) {
                .header-4-4 .modal-item .modal-dialog {
                    max-width: 95%;
                    border-radius: 12px;
                }

                .header-4-4 .navbar {
                    padding: 3rem 2rem;
                }

                .header-4-4 .hero {
                    padding: 3rem 2rem 5rem;
                }

                .header-4-4 .title-text-big {
                    font-size: 3rem;
                    line-height: 1.2;
                }
            }

            @media (min-width: 768px) {
                .header-4-4 .navbar {
                    padding: 3rem 4rem;
                }

                .header-4-4 .hero {
                    padding: 3rem 4rem 5rem;
                }

                .header-4-4 .left-column {
                    margin-bottom: 3rem;
                }
            }

            @media (min-width: 992px) {
                .header-4-4 .navbar-expand-lg .navbar-nav .nav-link {
                    padding-right: 1.25rem;
                    padding-left: 1.25rem;
                }

                .header-4-4 .navbar {
                    padding: 3rem 6rem;
                }

                .header-4-4 .hero {
                    padding: 3rem 6rem 5rem;
                }

                .header-4-4 .left-column {
                    width: 50%;
                    margin-bottom: 0;
                }

                .header-4-4 .title-text-big {
                    font-size: 3.75rem;
                    line-height: 1.2;
                }

                .header-4-4 .right-column {
                    width: 50%;
                }
            }

        </style>
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a href="#">
                    <img style="margin-right: 0.75rem" src="{{ asset('ezv250.png') }}" alt="" />
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#targetModal-item">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
                    aria-labelledby="targetModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content border-0" style="background-color: #000000">
                            <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                                <a class="modal-title" id="targetModalLabel">
                                    <img style="margin-top: 0.5rem" src="{{ asset('ezv250.png') }}" alt="" />
                                </a>
                                <button type="button" class="close btn-close text-white" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#" style="color: #e7e7e8">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">Villa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Hotels</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Restaurant</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Activity</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                                <button class="btn btn-default btn-no-fill">Log In</button>
                                <button class="btn btn-fill border-0">Register</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" style="color: #e7e7e8">Home</a>
                        </li>
                        <form action="{{ route('list') }}" method="POST" id="villa-form">
                            @csrf
                            <li class="nav-item">
                                <a class="nav-link" id="villa-button" href="#">Villa</a>
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
                            <li class="nav-item">
                                <a class="nav-link" id="hotel-button" href="#">Hotel</a>
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
                            <li class="nav-item">
                                <a class="nav-link" id="restaurant-button" href="#">Restaurant</a>
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
                        <form action="{{ route('list') }}" method="POST" id="activity-form">
                            @csrf
                            <li class="nav-item">
                                <a class="nav-link" id="activity-button" href="#">Activity</a>
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
                    </ul>
                    <div class="gap-3">
                        @auth
                        <div class="d-flex" style="display: inline-block">
                            <h5 class="mx-4" style="color: white; margin-top: 20px;">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</h5>
                            <div class="d-flex user-logged nav-item dropdown no-arrow">
                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{-- Halo, {{Auth::user()->name}}! --}}
                                    @if (Auth::user()->avatar)
                                    <img src="{{Auth::user()->avatar}}" class="user-photo mt-n2" alt=""
                                        style="border-radius: 50%; width: 60px;">
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
                        </div>

                        @else
                        <a href="{{ route('login') }}" class="btn btn-default btn-no-fill">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-fill border-0" style="color: #ffffff;">
                            Sign Up
                        </a>
                        @endauth
                    </div>
                </div>
            </nav>

            <div>
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                    <!-- Left Column -->
                    <div
                        class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
                        <p class="text-caption">EZV</p>
                        <h1 class="title-text-big text-white">
                            The best way<br class="d-lg-block d-none" />
                            to get Villa in Bali
                        </h1>
                        <div
                            class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                            <form action="{{ route('list') }}" method="POST" id="villa-form">
                                @csrf
                                <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;">
                                    Let's Get In
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
                                </button>
                            </form>
                            <button class="btn btn-outline">
                                <div class="d-flex align-items-center">
                                    Start your Search
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="right-column text-center d-flex justify-content-lg-end justify-content-center pe-0">
                        <img id="img-fluid" style="border-radius: 20px" class="h-auto mw-100"
                            src="https://source.unsplash.com/Koei_7yYtIo/600x400" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="h1-00 w-100 bg-white" style="box-sizing: border-box">
        <style>
            #main,
            #thumbnails img {
                box-shadow: 2px 2px 10px 5px #b8b8b8;
                border-radius: 20px;
            }

            * {
                transition: all 0.5s ease;
            }

            #thumbnails {
                text-align: center;
            }

            #thumbnails img {
                width: 100px;
                height: 100px;
                margin: 10px;
                cursor: pointer;
            }

            @media only screen and (max-width: 480px) {
                #thumbnails img {
                    width: 50px;
                    height: 50px;
                }
            }

            #thumbnails img:hover {
                transform: scale(1.05);
            }

            #main {
                width: 50%;
                height: 400px;
                object-fit: cover;
                display: block;
                margin-top: 200px;
                margin: 20px auto;
            }

            @media only screen and (max-width: 480px) {
                #main {
                    width: 100%;
                }
            }

            .hidden {
                opacity: 0;
            }

        </style>

        <img src="https://source.unsplash.com/AHUlvfoUmCY/800x800" id="main" style="margin-top: 80px">
        <div id="thumbnails">
            <img src="https://source.unsplash.com/AHUlvfoUmCY/800x800">
            <img src="https://source.unsplash.com/bfOQSDwEFg4/800x800">
            <img src="https://source.unsplash.com/2gDwlIim3Uw/800x800">
            <img src="https://source.unsplash.com/si4-pd-eeJs/800x800">
            <img src="https://source.unsplash.com/tVzyDSV84w8/800x800">
            <img src="https://source.unsplash.com/Koei_7yYtIo/800x800">
        </div>
    </section>
    <section class="h1-00 w-100 bg-white" style="box-sizing: border-box">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

            .content-3-2 .btn:focus,
            .content-3-2 .btn:active {
                outline: none !important;
            }

            .content-3-2 {
                padding: 5rem 2rem;
            }

            .content-3-2 .img-hero {
                width: 100%;
                margin-bottom: 3rem;
            }

            .content-3-2 .right-column {
                width: 100%;
            }

            .content-3-2 .title-text {
                font: 600 1.875rem/2.25rem Poppins, sans-serif;
                margin-bottom: 2.5rem;
                letter-spacing: -0.025em;
                color: #121212;
            }

            .content-3-2 .title-caption {
                font: 500 1.5rem/2rem Poppins, sans-serif;
                margin-bottom: 1.25rem;
                color: #121212;
            }

            .content-3-2 .circle {
                font: 500 1.25rem/1.75rem Poppins, sans-serif;
                height: 3rem;
                width: 3rem;
                margin-bottom: 1.25rem;
                border-radius: 9999px;
                background-color: #FF7400;
            }

            .content-3-2 .text-caption {
                font: 400 1rem/1.75rem Poppins, sans-serif;
                letter-spacing: 0.025em;
                color: #565656;
            }

            .content-3-2 .btn-learn {
                font: 600 1rem/1.5rem Poppins, sans-serif;
                padding: 1rem 2.5rem;
                background-color: #FF7400;
                transition: 0.3s;
                letter-spacing: 0.025em;
                border-radius: 0.75rem;
            }

            .content-3-2 .btn:hover {
                background-color: #000000;
                transition: 0.3s;
            }

            @media (min-width: 768px) {
                .content-3-2 .title-text {
                    font: 600 2.25rem/2.5rem Poppins, sans-serif;
                }
            }

            @media (min-width: 992px) {
                .content-3-2 .img-hero {
                    width: 50%;
                    margin-bottom: 0;
                }

                .content-3-2 .right-column {
                    width: 50%;
                }

                .content-3-2 .circle {
                    margin-right: 1.25rem;
                    margin-bottom: 0;
                }
            }

        </style>
        <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="d-flex flex-lg-row flex-column align-items-center">
                <!-- Left Column -->
                <div class="img-hero text-center justify-content-center d-flex">
                    <img id="hero" class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
                        alt="" />
                </div>

                <!-- Right Column -->
                <div
                    class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
                    <h2 class="title-text">3 Keys Benefit</h2>
                    <ul style="padding: 0; margin: 0;">
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    1
                                </span>
                                Lots of Choices
                            </h4>
                            <p class="text-caption">
                                We provide a large selection of villas, hotels,<br class="d-sm-inline d-none" />
                                restaurants, and activities.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    2
                                </span>
                                Tons of Promos
                            </h4>
                            <p class="text-caption">
                                We provide the best price just for you<br class="d-sm-inline d-none" />
                                who are looking forward for a vacation.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 4rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    3
                                </span>
                                Easy and Fun
                            </h4>
                            <p class="text-caption">
                                Make your vacation more enjoyable<br class="d-sm-inline d-none" />
                                with EZV.
                            </p>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-learn text-white">Register Now</a>
                </div>
            </div>
        </div>
    </section>
    {{-- hook --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0" >
            <div style="padding: 3rem 6rem;">
                <div class="col-12 mb-3">
                    <div class="card bg-dark text-white border-0 overflow-hidden" style="border-radius: 25px;">
                        <img src="https://picsum.photos/1920/1080" class="card-img" alt="...">
                        <div class="card-img-overlay d-flex align-items-end justify-content-center">
                            <div class="text-center mb-5">
                                <h1 class="card-title">Kalau penasaran, pesan saja!</h1>
                                <a href="#" class="btn btn-light rounded-pill p-3 fw-bold fs-6">Perjalanan flexsibel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end hook --}}
    {{-- location list (desktop) --}}
    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0" >
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Inspirasi untuk perjalanan Anda berikutnya</h1>
                <div class="d-flex overflow-x-auto">
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100" style="border-radius: 25px; background-color:#ff7400;">
                                <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">berjarak 17km</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100" style="border-radius: 25px; background-color:#ff7400;">
                                <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">berjarak 17km</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100" style="border-radius: 25px; background-color:#ff7400;">
                                <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">berjarak 17km</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100" style="border-radius: 25px; background-color:#ff7400;">
                                <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">berjarak 17km</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end location list (desktop) --}}
    {{-- location list (mobile) --}}
    <section class="h-100 w-100 bg-white d-lg-none d-block">
        <div class="container-xxl mx-auto p-0" >
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Inspirasi untuk perjalanan Anda berikutnya (mobile)</h1>
                <div class="overflow-scroll">
                    <div class="d-inline-flex">
                        <div class="px-2" style="width: 30rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-danger text-white g-0 border-0 overflow-hidden" style="border-radius: 25px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-5">berjarak 17km</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 30rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-danger text-white g-0 border-0 overflow-hidden" style="border-radius: 25px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-5">berjarak 17km</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 30rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-danger text-white g-0 border-0 overflow-hidden" style="border-radius: 25px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-5">berjarak 17km</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 30rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-danger text-white g-0 border-0 overflow-hidden" style="border-radius: 25px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-5">berjarak 17km</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end location list (mobile) --}}
    {{-- experience --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0" >
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Temukan Pengalaman</h1>
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card bg-dark text-white border-0 overflow-hidden" style="border-radius: 25px;">
                            <img src="https://picsum.photos/1920/1080" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <h1 class="card-title">Aktivitas untuk perjalanan Anda</h1>
                                <a href="#" class="btn btn-light">Pengalaman</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card bg-dark text-white border-0 overflow-hidden" style="border-radius: 25px;">
                            <img src="https://picsum.photos/1920/1080" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <h1 class="card-title">Aktivitas <br> dari rumah</h1>
                                <a href="#" class="btn btn-light">Pengalaman Online</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end experience --}}
    {{-- QA desktop --}}
    <section class="w-100 d-none d-lg-block" style="background-image: url('https://picsum.photos/1920/1080');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 500px;">
        <div class="container-xxl mx-auto p-0 h-100">
            <div style="padding: 3rem 6rem" class="h-100">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">Ada pertanyaan <br>seputar <br>menerima tamu? (desktop)</h1>
                    <div>
                        <a href="#" class="btn btn-light rounded-pill p-3 fw-bold fs-6">Perjalanan flexsibel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end QA desktop --}}
    {{-- QA mobile --}}
    <section class="h-100 w-100 bg-white d-block d-lg-none">
        <div class="container-xxl mx-auto p-0" >
            <div style="padding: 3rem 6rem;">
                <div class="col-12">
                    <div class="card bg-dark text-white border-0 overflow-hidden" style="border-radius: 25px;">
                        <img src="https://picsum.photos/1920/1080" class="card-img" alt="...">
                        <div class="card-img-overlay d-flex flex-column justify-content-between p-5">
                            <h1 class="card-title">Ada pertanyaan <br>seputar <br>menerima tamu?</h1>
                            <div>
                                <a href="#" class="btn btn-light rounded-pill p-3 fw-bold fs-6">Perjalanan flexsibel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end QA mobile --}}
    {{-- footer --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

            .footer-2-4 .list-space {
                margin-bottom: 1.25rem;
            }

            .footer-2-4 .footer-text-title {
                font: 600 1.5rem Poppins, sans-serif;
                margin-bottom: 1.5rem;
            }

            .footer-2-4 .list-menu {
                color: #999999;
                text-decoration: none !important;
            }

            .footer-2-4 .list-menu:hover {
                color: #ffffff;
            }

            .footer-2-4 hr.hr {
                margin: 0;
                border: 0;
                border-top: 1px solid rgba(48, 48, 48, 1);
            }

            .footer-2-4 .border-color {
                color: #999999;
            }

            .footer-2-4 .footer-link {
                color: #999999;
            }

            .footer-2-4 .footer-link:hover {
                color: #ffffff;
            }

            .footer-2-4 .social-media-c:hover circle,
            .footer-2-4 .social-media-p:hover path {
                fill: #ffffff;
            }

            .footer-2-4 .footer-info-space {
                padding-top: 3rem;
            }

            .footer-2-4 .list-footer {
                padding: 5rem 1rem 3rem 1rem;
            }

            .footer-2-4 .info-footer {
                padding: 0 1rem 3rem;
            }

            @media (min-width: 576px) {
                .footer-2-4 .list-footer {
                    padding: 5rem 2rem 3rem 2rem;
                }

                .footer-2-4 .info-footer {
                    padding: 0 2rem 3rem;
                }
            }

            @media (min-width: 768px) {
                .footer-2-4 .list-footer {
                    padding: 5rem 4rem 6rem 4rem;
                }

                .footer-2-4 .info-footer {
                    padding: 0 4rem 3rem;
                }
            }

            @media (min-width: 992px) {
                .footer-2-4 .list-footer {
                    padding: 5rem 6rem 6rem 6rem;
                }

                .footer-2-4 .info-footer {
                    padding: 0 6rem 3rem;
                }
            }

        </style>

        <div class="footer-2-4 container-xxl mx-auto position-relative p-0" style="font-family: 'Poppins', sans-serif">
            <div class="list-footer">
                <div class="row gap-md-0 gap-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="">
                            <div class="list-space">
                                <img src="{{ asset('ezv250.png') }}" alt="" />
                            </div>
                            <nav class="list-unstyled">
                                <li class="list-space">
                                    <a href="" class="list-menu">Villa</a>
                                </li>
                                <li class="list-space">
                                    <a href="" class="list-menu">Hotel</a>
                                </li>
                                <li class="list-space">
                                    <a href="" class="list-menu">Restaurant</a>
                                </li>
                                <li class="list-space">
                                    <a href="" class="list-menu">Activity</a>
                                </li>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h2 class="footer-text-title text-white">Company</h2>
                        <nav class="list-unstyled">
                            <li class="list-space">
                                <a href="" class="list-menu">Contact Us</a>
                            </li>
                            <li class="list-space">
                                <a href="" class="list-menu">Blog</a>
                            </li>
                            <li class="list-space">
                                <a href="" class="list-menu">Culture</a>
                            </li>
                        </nav>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h2 class="footer-text-title text-white">Support</h2>
                        <nav class="list-unstyled">
                            <li class="list-space">
                                <a href="" class="list-menu">Getting Started</a>
                            </li>
                            <li class="list-space">
                                <a href="" class="list-menu">Help Center</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="border-color info-footer">
                <div class="">
                    <hr class="hr" />
                </div>
                <div class="mx-auto d-flex flex-column flex-lg-row align-items-center footer-info-space gap-4">
                    <div class="d-flex title-font font-medium align-items-center gap-4">
                        <a href="">
                            <svg class="social-media-c social-media-left" width="30" height="30" viewBox="0 0 30 30"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="15" fill="#999999" />
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M17.6648 9.65667H19.1254V7.11267C18.8734 7.078 18.0068 7 16.9974 7C14.8914 7 13.4488 8.32467 13.4488 10.7593V13H11.1248V15.844H13.4488V23H16.2981V15.8447H18.5281L18.8821 13.0007H16.2974V11.0413C16.2981 10.2193 16.5194 9.65667 17.6648 9.65667Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="16" height="16" fill="white" transform="translate(7 7)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="">
                            <svg class="social-media-c social-media-center-1" width="30" height="30" viewBox="0 0 30 30"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="15" fill="#999999" />
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M23 10.039C22.405 10.3 21.771 10.473 21.11 10.557C21.79 10.151 22.309 9.513 22.553 8.744C21.919 9.122 21.219 9.389 20.473 9.538C19.871 8.897 19.013 8.5 18.077 8.5C16.261 8.5 14.799 9.974 14.799 11.781C14.799 12.041 14.821 12.291 14.875 12.529C12.148 12.396 9.735 11.089 8.114 9.098C7.831 9.589 7.665 10.151 7.665 10.756C7.665 11.892 8.25 12.899 9.122 13.482C8.595 13.472 8.078 13.319 7.64 13.078C7.64 13.088 7.64 13.101 7.64 13.114C7.64 14.708 8.777 16.032 10.268 16.337C10.001 16.41 9.71 16.445 9.408 16.445C9.198 16.445 8.986 16.433 8.787 16.389C9.212 17.688 10.418 18.643 11.852 18.674C10.736 19.547 9.319 20.073 7.785 20.073C7.516 20.073 7.258 20.061 7 20.028C8.453 20.965 10.175 21.5 12.032 21.5C18.068 21.5 21.368 16.5 21.368 12.166C21.368 12.021 21.363 11.881 21.356 11.742C22.007 11.28 22.554 10.703 23 10.039Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="16" height="16" fill="white" transform="translate(7 7)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="">
                            <svg class="social-media-p social-media-center-2" width="30" height="30" viewBox="0 0 30 30"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.8711 15C17.8711 16.5857 16.5857 17.8711 15 17.8711C13.4143 17.8711 12.1289 16.5857 12.1289 15C12.1289 13.4143 13.4143 12.1289 15 12.1289C16.5857 12.1289 17.8711 13.4143 17.8711 15Z"
                                    fill="#999999" />
                                <path
                                    d="M21.7144 9.92039C21.5764 9.5464 21.3562 9.20789 21.0701 8.93002C20.7923 8.64392 20.454 8.42374 20.0797 8.28572C19.7762 8.16785 19.3203 8.02754 18.4805 7.98932C17.5721 7.94789 17.2997 7.93896 14.9999 7.93896C12.6999 7.93896 12.4275 7.94766 11.5193 7.98909C10.6796 8.02754 10.2234 8.16785 9.92014 8.28572C9.54591 8.42374 9.2074 8.64392 8.92976 8.93002C8.64366 9.20789 8.42348 9.54617 8.28523 9.92039C8.16736 10.2239 8.02705 10.6801 7.98883 11.5198C7.9474 12.428 7.93848 12.7004 7.93848 15.0004C7.93848 17.3002 7.9474 17.5726 7.98883 18.481C8.02705 19.3208 8.16736 19.7767 8.28523 20.0802C8.42348 20.4545 8.64343 20.7927 8.92953 21.0706C9.2074 21.3567 9.54568 21.5769 9.91991 21.7149C10.2234 21.833 10.6796 21.9733 11.5193 22.0115C12.4275 22.053 12.6997 22.0617 14.9997 22.0617C17.3 22.0617 17.5723 22.053 18.4803 22.0115C19.3201 21.9733 19.7762 21.833 20.0797 21.7149C20.8309 21.4251 21.4247 20.8314 21.7144 20.0802C21.8323 19.7767 21.9726 19.3208 22.011 18.481C22.0525 17.5726 22.0612 17.3002 22.0612 15.0004C22.0612 12.7004 22.0525 12.428 22.011 11.5198C21.9728 10.6801 21.8325 10.2239 21.7144 9.92039ZM14.9999 19.4231C12.5571 19.4231 10.5768 17.4431 10.5768 15.0002C10.5768 12.5573 12.5571 10.5773 14.9999 10.5773C17.4426 10.5773 19.4229 12.5573 19.4229 15.0002C19.4229 17.4431 17.4426 19.4231 14.9999 19.4231ZM19.5977 11.4361C19.0269 11.4361 18.5641 10.9733 18.5641 10.4024C18.5641 9.83159 19.0269 9.36879 19.5977 9.36879C20.1685 9.36879 20.6313 9.83159 20.6313 10.4024C20.6311 10.9733 20.1685 11.4361 19.5977 11.4361Z"
                                    fill="#999999" />
                                <path
                                    d="M15 0C6.717 0 0 6.717 0 15C0 23.283 6.717 30 15 30C23.283 30 30 23.283 30 15C30 6.717 23.283 0 15 0ZM23.5613 18.5511C23.5197 19.468 23.3739 20.094 23.161 20.6419C22.7135 21.7989 21.7989 22.7135 20.6419 23.161C20.0942 23.3739 19.468 23.5194 18.5513 23.5613C17.6328 23.6032 17.3394 23.6133 15.0002 23.6133C12.6608 23.6133 12.3676 23.6032 11.4489 23.5613C10.5322 23.5194 9.90601 23.3739 9.35829 23.161C8.78334 22.9447 8.26286 22.6057 7.83257 22.1674C7.39449 21.7374 7.05551 21.2167 6.83922 20.6419C6.62636 20.0942 6.48056 19.468 6.4389 18.5513C6.39656 17.6326 6.38672 17.3392 6.38672 15C6.38672 12.6608 6.39656 12.3674 6.43867 11.4489C6.48033 10.532 6.6259 9.90601 6.83876 9.35806C7.05505 8.78334 7.39426 8.26263 7.83257 7.83257C8.26263 7.39426 8.78334 7.05528 9.35806 6.83899C9.90601 6.62613 10.532 6.48056 11.4489 6.43867C12.3674 6.39679 12.6608 6.38672 15 6.38672C17.3392 6.38672 17.6326 6.39679 18.5511 6.4389C19.468 6.48056 20.094 6.62613 20.6419 6.83876C21.2167 7.05505 21.7374 7.39426 22.1677 7.83257C22.6057 8.26286 22.9449 8.78334 23.161 9.35806C23.3741 9.90601 23.5197 10.532 23.5616 11.4489C23.6034 12.3674 23.6133 12.6608 23.6133 15C23.6133 17.3392 23.6034 17.6326 23.5613 18.5511Z"
                                    fill="#999999" />
                            </svg>
                        </a>
                        <a href="">
                            <svg class="social-media-c social-media-right" width="30" height="30" viewBox="0 0 30 30"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="15" fill="#999999" />
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M17.9027 22.4467C17.916 22.4427 17.9287 22.4373 17.942 22.4327C26.0853 19.1973 23.8327 7 15 7C10.5673 7 7 10.6133 7 15C7 20.5513 12.6227 24.5127 17.9027 22.4467ZM10.5207 20.3727C11.0887 19.418 12.9267 16.7247 16.064 15.7953C16.72 17.468 17.18 19.4193 17.2253 21.632C14.848 22.4313 12.3407 21.8933 10.5207 20.3727ZM18.2087 21.2147C18.1213 19.0887 17.6873 17.2033 17.0687 15.57C18.4567 15.3533 20.0633 15.498 21.8853 16.228C21.498 18.402 20.108 20.2293 18.2087 21.2147ZM21.99 15.194C19.9833 14.44 18.2147 14.346 16.684 14.638C16.4473 14.1047 16.1987 13.592 15.9353 13.12C18.284 12.182 19.672 11.0387 20.2933 10.4333C21.39 11.7027 22.0413 13.346 21.99 15.194ZM19.5833 9.72133C19.018 10.2593 17.6867 11.346 15.41 12.2347C14.294 10.4693 13.1007 9.224 12.3447 8.52667C14.7633 7.53067 17.5527 7.956 19.5833 9.72133ZM11.3887 9.01533C11.9593 9.51733 13.212 10.7227 14.4207 12.5867C12.7607 13.1213 10.6793 13.514 8.148 13.5693C8.55067 11.64 9.75333 10.0053 11.3887 9.01533ZM8.02133 14.5733C10.8547 14.5273 13.148 14.08 14.9607 13.4747C15.2113 13.914 15.4493 14.3927 15.678 14.89C12.5213 15.8953 10.5487 18.4907 9.79333 19.6627C8.57467 18.3027 7.90267 16.528 8.02133 14.5733Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="16" height="16" fill="white" transform="translate(7 7)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <nav class="mx-auto d-flex flex-wrap align-items-center justify-content-center gap-4">
                        <a href="" class="footer-link" style="text-decoration: none">Terms of Service</a>
                        <span>|</span>
                        <a href="" class="footer-link" style="text-decoration: none">Privacy Policy</a>
                        <span>|</span>
                        <a href="" class="footer-link" style="text-decoration: none">Licenses</a>
                    </nav>
                    <nav class="d-flex flex-lg-row flex-column align-items-center justify-content-center">
                        <p style="margin: 0">Copyright © 2022 ezv250</p>
                    </nav>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        var thumbnails = document.getElementById("thumbnails")
        var imgs = thumbnails.getElementsByTagName("img")
        var main = document.getElementById("main")
        var counter = 0;

        for (let i = 0; i < imgs.length; i++) {
            let img = imgs[i]


            img.addEventListener("click", function () {
                main.src = this.src
            })

        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>
