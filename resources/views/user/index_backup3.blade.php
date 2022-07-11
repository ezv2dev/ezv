<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">


    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        .location_op {
            color: black;
        }

    </style>
</head>

<body>
    {{-- navbar --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark">

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
                                    <img style="margin-top: 0.5rem" src="https://ezv2.ezvillasbali.com/ezv250.png"
                                        alt="" />
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
                    <div class="col-lg-4" style="display: flex; align-items: center;">
                        <a href="{{ route('index') }}">
                            <img style="margin-right: 0.75rem" src="https://ezv2.ezvillasbali.com/ezv250.png" alt="" />
                        </a>
                    </div>

                    <div class="col-lg-4">

                        <div id="searchbox" class="searchbox display-none" onclick="popUp();" style="cursor: pointer;">
                            <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                        </div>
                        <!--Start of serach option 1 -->
                        <ul id="ul" class="navbar-nav me-auto mt-2 mt-lg-0 ">
                            <form class="nav-link-form" action="{{ route('list') }}" method="POST" id="villa-form">
                                @csrf
                                <li class="nav-item">
                                    <a class="nav-link nav-link-style nav-link-margin" id="villa-button" href="#"><i
                                            style="font-size: 20px;" class="fa-solid fa-house"></i></a>
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
                                <p>villas</p>
                            </form>
                            <form class="nav-link-form" action="{{ route('restaurant_list') }}" method="POST"
                                id="hotel-form">
                                @csrf
                                <li class="nav-item">
                                    <a class="nav-link nav-link-style nav-link-margin" id="hotel-button" href="#"><i
                                            style="font-size: 17px;" class="fa-solid fa-utensils"></i></a>
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
                                <p>restaurants</p>
                            </form>
                            <form class="nav-link-form" action="{{ route('hotel_list') }}" method="POST"
                                id="restaurant-form">
                                @csrf
                                <li class="nav-item">
                                    <a class="nav-link nav-link-style nav-link-margin" id="restaurant-button"
                                        href="#"><i style="font-size: 21px;" class="fa-solid fa-city"></i></a>
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
                                <p>hotels</p>
                            </form>
                            <form class="nav-link-form" action="{{ route('activity_list') }}" method="POST"
                                id="activity-form">
                                @csrf
                                <li class="nav-item">
                                    <a class="nav-link nav-link-style nav-link-margin" id="activity-button" href="#"><i
                                            style="font-size: 24px;" class="fa-solid fa-person-running"></i></a>
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
                                <p>things to do</p>
                            </form>
                        </ul>
                        <!--End of serach option 1 -->



                        {{--Header Search --}}
                        <div class="search-box">
                            <!--
                        <div id="searchbox" class="searchbox">
                            <p>Search... <span class="top-search"><i class="fa fa-search"></i></p>
                        </div>
                        -->

                            <div id="search_bar">
                                <form action="{{ route('search_villa') }}" method="POST" id="basic-form"
                                    autocomplete="off">
                                    @csrf
                                    <div id="bar" class="bar">
                                        <div class="location">
                                            <p>Location</p>
                                            <input type="text" class="form-control input-transparant input-location"
                                                value="" id="loc_sugest" name="location"
                                                placeholder="Where are you going?">

                                            <div id="sugest" class="location-popup display-none">
                                                @php
                                                $location = App\Http\Controllers\ViewController::get_location();
                                                @endphp
                                                @foreach($location as $item)
                                                <div class="col-lg-12 location-popup-desc-container">
                                                    <div class="location-popup-map">
                                                        <img class="location-popup-map-image"
                                                            src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text">
                                                        <a type="button" class="location_op"
                                                            data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div id="sugest2" class="location-popup display-none">
                                            </div>

                                        </div>
                                        <div class="check-in">
                                            <input type="text"
                                                style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px"
                                                id="dates">
                                            <p>Check in</p>
                                            <input type="text" placeholder="Add dates"
                                                class="flatpickr form-control input-transparant" value="" id="check_in2"
                                                name="check_in">
                                        </div>
                                        <div class="check-out">
                                            <p>Check out</p>
                                            <input type="text" placeholder="Add dates"
                                                class="flatpickr form-control input-transparant" value=""
                                                id="check_out2" name="check_out">
                                        </div>
                                        <div class="guests">
                                            <p>Guests</p>
                                            <ul class="nav">
                                                <li class="button-dropdown">
                                                    <input type="number" id="total_guest2" value="1"
                                                        style="width: 30px; border: 0; margin-right: 0; background: transparent; text-align: right;"
                                                        disabled min="1"> Guest
                                                    <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                                    </a>
                                                    <a style="margin-left: 20px;" class="dropdown-toggle-icon">
                                                        Add
                                                    </a>

                                                    <div class="guest-popup dropdown-menu">
                                                        <div class="guests-input-row">
                                                            <div class="col-6">
                                                                <div class="col-12 guest-type-container">
                                                                    <p class="guest-type-title">Adults</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">Age 13 or above</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="adult_decrement_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="adult2" name="adult"
                                                                        value="1"
                                                                        style="text-align: center; margin-left:7px; border:none; width:40px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="adult_increment_index()"
                                                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-plus"
                                                                        style="padding:0px;"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="guests-input-row">
                                                            <div class="col-6">
                                                                <div class="col-12 guest-type-container">
                                                                    <p class="guest-type-title">Children</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">Ages 2–12</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="child_decrement_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="child2" name="child"
                                                                        value="1"
                                                                        style="text-align: center; border:none; width:40px; margin-left:7px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="child_increment_index()"
                                                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-plus"
                                                                        style="padding:0px;"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="guests-input-row">
                                                            <div class="col-6">
                                                                <div class="col-12 guest-type-container">
                                                                    <p class="guest-type-title">Infants</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">Under 2</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="infant_decrement_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="infant2" name="infant"
                                                                        value="1"
                                                                        style="text-align: center; border:none; width:40px; margin-left:7px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="infant_increment_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-plus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="guests-input-row">
                                                            <div class="col-6">
                                                                <div class="col-12 guest-type-container">
                                                                    <p class="guest-type-title">Pets</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">Service animal?</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="pet_decrement_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="pet2" name="pet" value="1"
                                                                        style="text-align: center; border:none; width:40px; margin-left:7px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="pet_increment_index()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-plus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="button">
                                            <button type="submit"
                                                style="z-index: 1; border: none; background: transparent;">
                                                <i class="fa fa-search search-button" style="font-size: 17px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Header Search --}}

                    </div>

                    <div class="col-lg-4" style="display: flex; align-items: center; justify-content: flex-end;">

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
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                        class="user-photo" alt="" style="border-radius: 50%">
                                    @endif
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                        style="right: 0; left: auto">
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||
                                        Auth::user()->role_id == 3)
                                        <li>
                                            <a href="{{route('admin_dashboard')}}" class="dropdown-item">Dashboard</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{route('profile_index')}}" class="dropdown-item">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{route('change_password')}}" class="dropdown-item">Change
                                                Password</a>
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
                        <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9;">
                            Become a host
                        </a>

                        <a href="" class="navbar-gap" style="color: white; margin-right: 9px; width:27px;">
                            <img src="https://raw.githubusercontent.com/lipis/flag-icons/c1efa9d9a94d62a4da54916f4061cbf9bbadff1d/flags/4x3/us.svg">
                        </a>

                        <!--
                        <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap" style="color: #ffffff;">
                            Log In
                        </a>
                        -->
                        <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap"
                            style="color: #ffffff; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;">
                            <i class="fa-solid fa-user"></i>
                        </a>


                        @endauth
                    </div>
                </div>
            </nav>

        </div>
    </section>
    {{-- end navbar --}}
    {{-- hero --}}
    <section class="h-100 w-100 first-section-top" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <div>
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                    <div class="col-12">
                        <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 14px; height: 400px; background-image: url('https://source.unsplash.com/Koei_7yYtIo/2400x1600'); background-position:center; background-size: cover;">
                            <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                                <div>
                                    <p class="text-white text-center" style="font-size: 22px;">
                                        The Best Way To Find Accommodation, Restaurants, And Things To Do
                                    </p>
                                    <div
                                        class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                        <form action="{{ route('list') }}" method="POST" id="villa-form">
                                            @csrf
                                            {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                            <button class="btn d-inline-flex mb-md-0 btn-company">
                                                Let's Go
                                                <?php
                                                    $req['location'] = null;
                                                    $req['check_in'] = null;
                                                    $req['check_out'] = null;
                                                    $req['adult'] = null;
                                                    $req['children'] = null;
                                                ?>
                                                <input type="hidden" name="location" id="location"
                                                    value="{{ $req['location'] }}">
                                                <input type="hidden" name="check_in" id="in"
                                                    value="{{ $req['check_in'] }}">
                                                <input type="hidden" name="check_out" id="out"
                                                    value="{{ $req['check_out'] }}">
                                                <input type="hidden" name="adult" id="adult"
                                                    value="{{ $req['adult'] }}">
                                                <input type="hidden" name="children" id="children"
                                                    value="{{ $req['children'] }}">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end hero --}}
    <section class="h1-00 w-100 bg-white" style="box-sizing: border-box;">
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

    <!--
    <section class="h-100 w-100 bg-white">
        <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="d-flex flex-lg-row flex-column align-items-center">

                <div class="img-hero text-center justify-content-center d-flex">
                    <img id="hero" class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
                        alt="" />
                </div>


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
    -->

    {{-- location list (desktop) --}}
    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Inspiration for your next trip</h1>
                <div class="d-flex overflow-x-auto">
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1611813129102-5581ca61711a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">2 kilometres away</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1583248369069-9d91f1640fe6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=872&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Ubud</h5>
                                    <p class="card-text mb-5">17 kilometres away</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1583248369069-9d91f1640fe6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=872&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Ubud</h5>
                                    <p class="card-text mb-5">17 kilometres away</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1541739296801-2412947056ae?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kuta</h5>
                                    <p class="card-text mb-5">10 kilometres away</p>
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
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Inspiration for your next trip</h1>
                <div class="overflow-scroll">
                    <div class="d-inline-flex">
                        <div class="px-2" style="width: 30rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
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
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
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
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
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
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
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
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">Discover Experiences</h1>
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/restaurant.jpg') }}" class="card-img"
                                style="height: 550px; object-fit: cover;" alt="...">
                            <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">Restaurant</h1>
                                    <a href="javascript:$('#restaurant-form2').submit();"
                                        class="btn btn-company text-white btn-sm">Explore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card-overlay2 card bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/activity.webp') }}" class="card-img"
                                style="height: 550px; object-fit: cover;" alt="...">
                            <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">Things To Do</h1>
                                    <a href="javascript:$('#activity-form2').submit();"
                                        class="btn btn-company text-white btn-sm">Explore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end experience --}}
    {{-- QA desktop --}}
    <section class="w-100 d-none d-lg-block" style="background-image: url('https://source.unsplash.com/2gDwlIim3Uw/1600x800');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 500px;">
        <div class="container-xxl mx-auto p-0 h-100 card-overlay">
            <div style="padding: 3rem 6rem" class="h-100">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">Questions<br>about <br>hosting?</h1>
                    <div>
                        <a href="{{ route('ahost') }}" class="btn btn-company text-white" target="_blank">Ask a
                            Superhost</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end QA desktop --}}
    {{-- QA mobile --}}
    <section class="h1-00 w-100">

        @include('layouts.user.footer')
    </section>
    {{-- end footer --}}

    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    {{-- Increment Decrement --}}
    <script>
        function adult_increment_index() {
            document.getElementById('adult2').stepUp();
            document.getElementById('total_guest2').stepUp();
        }

        function adult_decrement_index() {
            document.getElementById('adult2').stepDown();
            document.getElementById('total_guest2').stepDown();
        }

        function child_increment_index() {
            document.getElementById('child2').stepUp();
            document.getElementById('total_guest2').stepUp();
        }

        function child_decrement_index() {
            document.getElementById('child2').stepDown();
            document.getElementById('total_guest2').stepDown();
        }

        function infant_increment_index() {
            document.getElementById('infant2').stepUp();
        }

        function infant_decrement_index() {
            document.getElementById('infant2').stepDown();
        }

        function pet_increment_index() {
            document.getElementById('pet2').stepUp();
        }

        function pet_decrement_index() {
            document.getElementById('pet2').stepDown();
        }
    </script>

    <script>
        $("#loc_sugest").on('click', function () { //use a class, since your ID gets mangled
            $('#sugest').removeClass("display-none");
            $('#sugest').addClass("display-block"); //add the class to the clicked element
            $('#sugest2').removeClass("display-block");
            $('#sugest2').addClass("display-none");
        });

        $(document).mouseup(function (e) {
            var container = $('#sugest');

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass("display-block");
                container.addClass("display-none");
            }
        });

    </script>

    {{-- <script>
        $("#loc_sugest").on('keypress change', async function () {
            var name = $('#loc_sugest').val();
            await fetch(`http://localhost:8000/autocomplete?name=${name}`).then(response => response.json())
                .then(datas => {
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                    $('#sugest2').removeClass("display-none");
                    $('#sugest2').addClass("display-block");
                    $('#sugest2').html('');
                    console.log(datas);
                    datas.map((data) => {
                        $('#sugest2')
                            .append(
                                '<div class="col-lg-12 location-popup-desc-container">' +
                                '<div class="location-popup-map">' +
                                '<img class="location-popup-map-image" src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">' +
                                '</div>' +
                                '<div class="location-popup-text">' +
                                ' <a type="button" class="location_op" onclick="fillLocationFormFromList()" data-value="' + data
                                .name + '" >' +
                                data.name +
                                '</a>' +
                                '</div>' +
                                '</div>');
                    });
                });
        });
    </script> --}}

    <script>
        $(document).ready(() => {
            $(".location_op").on('click', function (e) {
                console.log($(this).data("value"));
                // $('#loc_sugest').val($(this).data("value"));
                // $('#sugest').removeClass("display-block");
                // $('#sugest').addClass("display-none");
                // $('#sugest2').removeClass("display-block");
                // $('#sugest2').addClass("display-none");
            });
        });
    </script>

    <script>
        $("#dates").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onChange: function (selectedDates, dateStr, instance) {
                $('#dates').val("");
                $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
                $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"))
            }
        });

    </script>

    <script>
        function addClass(elements, className) {
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                if (element.classList) {
                    element.classList.add(className);
                } else {
                    element.className += ' ' + className;
                }
            }
        }

        function removeClass(elements, className) {
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                if (element.classList) {
                    element.classList.remove(className);
                } else {
                    element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ')
                        .join('|') + '(\\b|$)', 'gi'), ' ');
                }
            }
        }

    </script>

    <script>
        jQuery(document).ready(function (e) {
            function t(t) {
                e(t).bind("click", function (t) {
                    t.preventDefault();
                    e(this).parent().fadeOut()
                })
            }
            e(".dropdown-toggle").click(function () {
                var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                    ":hidden");
                e(".button-dropdown .dropdown-menu").hide();
                e(".button-dropdown .dropdown-toggle").removeClass("active");
                if (t) {
                    e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                        ".button-dropdown").children(".dropdown-toggle").addClass("active")
                }
            });
            e(document).bind("click", function (t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu")
                    .hide();
            });
            e(document).bind("click", function (t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                    .removeClass("active");
            })
        });

    </script>

    <script>
        window.addEventListener('scroll', function () {
            if(window.scrollY==0){
                document.getElementById("ul").classList.remove("display-none");
                document.getElementById("bar").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-block");
                document.getElementById("nav").classList.remove("position-fixed");
            }else{
                console.log("oke");
                document.getElementById("ul").classList.add("display-none");
                document.getElementById("bar").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-block");
                document.getElementById("nav").classList.add("position-fixed");
            }
        });
    </script>

    <script>
        function popUp() {
            document.getElementById("ul").classList.remove("display-none");
            document.getElementById("bar").classList.remove("display-none");
            document.getElementById("searchbox").classList.add("display-none");
            document.getElementById("searchbox").classList.remove("display-block");
        }

    </script>
</body>

</html>
