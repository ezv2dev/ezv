<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    <script src="{{ asset('enjoyhint/enjoyhint.min.js') }}"></script>
    <link href="{{ asset('enjoyhint/enjoyhint.css') }}" rel="stylesheet" />
</head>

<body>
    @component('components.loading.loading-type2')
    @endcomponent
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
                            <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                    </div>

                    <div class="col-lg-4" style="height: 90px !important;">

                        <div id="searchbox" class="searchbox display-none" onclick="popUp();" style="cursor: pointer;">
                            <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                        </div>
                        <!--Start of serach option 1 -->

                        <div id="ul" class="ul-display-block">
                            <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                                <form class="nav-link-form" action="{{ route('list') }}" method="GET"
                                    id="villa-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="villa-button" href="#"><i
                                                style="font-size: 20px;" class="fa-solid fa-house"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('villas') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('restaurant_list') }}" method="GET"
                                    id="hotel-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="hotel-button" href="#"><i
                                                style="font-size: 17px;" class="fa-solid fa-utensils"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('restaurants') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('hotel_list') }}" method="GET"
                                    id="restaurant-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="restaurant-button"
                                            href="#"><i style="font-size: 21px;" class="fa-solid fa-city"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('hotels') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('activity_list') }}" method="GET"
                                    id="activity-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="activity-button"
                                            href="#"><i style="font-size: 24px;"
                                                class="fa-solid fa-person-running"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('things to do') }}</p>
                                </form>
                            </ul>
                            <!--End of serach option 1 -->

                            {{-- Header Search --}}
                            <div class="search-box">

                                <div id="search_bar">
                                    <form action="{{ route('search_villa_combine') }}" method="GET" id="basic-form"
                                        autocomplete="off">
                                        <div id="bar" class="bar">
                                            <div class="location">
                                                <p>{{ Translate::translate('Location') }}</p>
                                                <input type="text" class="form-control input-transparant input-location"
                                                    id="loc_sugest" name="location"
                                                    placeholder="{{ Translate::translate('Where are you going?') }}">

                                                <div id="sugest" class="location-popup display-none">
                                                    @php
                                                        $location = App\Http\Controllers\ViewController::get_location();
                                                    @endphp
                                                    @foreach ($location as $item)
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image"
                                                                    src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                        style="display: none">
                                                        <p>{{ Translate::translate('location not found') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="check-in">
                                                <input type="text"
                                                    style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px"
                                                    id="dates">
                                                <p>{{ Translate::translate('Check in') }}</p>
                                                <input type="text"
                                                    placeholder="{{ Translate::translate('Add dates') }}"
                                                    class="flatpickr form-control input-transparant" value=""
                                                    id="check_in2" name="check_in">
                                            </div>
                                            <div class="check-out">
                                                <p>{{ Translate::translate('Check out') }}</p>
                                                <input type="text"
                                                    placeholder="{{ Translate::translate('Add dates') }}"
                                                    class="flatpickr form-control input-transparant" value=""
                                                    id="check_out2" name="check_out">
                                            </div>
                                            <div class="guests">
                                                <p>{{ Translate::translate('Guest') }}</p>
                                                <ul class="nav">
                                                    <li class="button-dropdown">
                                                        <input type="number" id="total_guest2" value="1"
                                                            style="width: 30px; border: 0; margin-right: 0; text-align: right;"
                                                            disabled min="1"> {{ Translate::translate('Guest') }}
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-toggle input-guest">
                                                        </a>
                                                        <a style="margin-left: 20px;" class="dropdown-toggle-icon">
                                                            {{ Translate::translate('Add') }}
                                                        </a>

                                                        <div class="guest-popup dropdown-menu">
                                                            <div class="guests-input-row">
                                                                <div class="col-6">
                                                                    <div class="col-12 guest-type-container">
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Adult') }}</p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Age 13 or above') }}
                                                                        </p>
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
                                                                            style="text-align: center; border:none; width:40px;"
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
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Children') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Ages 2–12') }}
                                                                        </p>
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
                                                                            value="0"
                                                                            style="text-align: center; border:none; width:40px;"
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
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Infants') }}</p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Under 2') }}</p>
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
                                                                            value="0"
                                                                            style="text-align: center; border:none; width:40px;"
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
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Pets') }}</p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Service animal?') }}
                                                                        </p>
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
                                                                        <input type="number" id="pet2" name="pet"
                                                                            value="0"
                                                                            style="text-align: center; border:none; width:40px;"
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
                                                    <i class="fa fa-search search-button"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Header Search --}}
                    </div>

                    <div class="col-lg-4" style="display: flex; align-items: center; justify-content: flex-end;">
                        @auth
                            <div class="d-flex" style="display: inline-block; align-items: center;">
                                <a href="{{ route('partner_dashboard') }}" class="navbar-gap"
                                    style="color: #b9b9b9;">
                                    {{ Translate::translate('Switch to hosting') }}
                                </a>

                                <a type="button" onclick="language()" class="navbar-gap"
                                    style="color: white; width:27px;">
                                    @if (session()->has('locale'))
                                        <img src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                    @else
                                        <img src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                    @endif
                                </a>

                                <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                                style="border-radius: 50%; width: 50px; border: solid 2px #ff7400;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                                class="user-photo" alt="" style="border-radius: 50%">
                                        @endif

                                        <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                            aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                            <h6 class="dropdown-header d-flex align-items-center">
                                                @if (Auth::user()->foto_profile != null)
                                                    <img class="dropdown-user-img"
                                                        src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                                @elseIf (Auth::user()->avatar != null)
                                                    <img class="dropdown-user-img" src="{{ Auth::user()->avatar }}">
                                                @else
                                                    <img class="dropdown-user-img"
                                                        src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                                                @endif
                                                <div class="dropdown-user-details">
                                                    <div class="dropdown-user-details-name">
                                                        {{ Auth::user()->first_name }}
                                                        {{ Auth::user()->last_name }}</div>
                                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}
                                                    </div>
                                                </div>
                                            </h6>
                                            @php
                                                $role = Auth::user()->role_id;
                                            @endphp
                                            @if ($role == 1 || $role == 2 || $role == 3)
                                                <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                                    Dashboard
                                                </a>
                                            @endif
                                            @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                                <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                                    Collab Portal
                                                </a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('profile_index') }}">
                                                My Profile
                                            </a>
                                            <a class="dropdown-item" href="{{ route('change_password') }}">
                                                Change Password
                                            </a>
                                            <a class="dropdown-item" href="#!"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                                Sign Out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                                                style="display: none">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9;">
                                {{ Translate::translate('Become a host') }}
                            </a>

                            <a type="button" onclick="language()" class="navbar-gap"
                                style="color: white; margin-right: 9px; width:27px;" id="language">
                                @if (session()->has('locale'))
                                    <img src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap"
                                style="color: #ffffff; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
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
            <div class="mx-auto d-flex flex-lg-row flex-column hero">
                <div class="col-12">
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                        style="border-radius: 14px; height: 400px; background-image: url('{{ URL::asset('assets/media/photos/desktop/lake.jpg') }}'); background-position:center; background-size: cover;">
                        <div
                            class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                            <div>
                                <p class="text-white text-center" style="font-size: 22px;">
                                    {{ Translate::translate('The Best Way To Find Accommodation, Restaurants, And Things To Do') }}
                                </p>
                                <div
                                    class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                    <form action="{{ route('list') }}" method="GET" id="villa-form">
                                        {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                        <button class="btn d-inline-flex mb-md-0 btn-company" id="lest_go">
                                            {{ Translate::translate("Let's Go") }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="mx-auto d-flex flex-lg-row flex-column hero">
                <div class="col-12">
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                        style="border-radius: 14px; height: 400px; background-image: url('{{ URL::asset('assets/media/photos/desktop/app.jpg') }}'); background-position:center; background-size: cover;">
                        <div
                            class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                            <div>
                                <p class="text-white text-center" style="font-size: 62px;">
                                    {{ Translate::translate('Download The App') }}
                                </p>
                                <p class="text-white text-center" style="margin-top: -20px;">
                                    {{ Translate::translate('Unlock all the features today') }}
                                </p>
                                <div
                                    class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                    <form action="{{ route('list') }}" method="GET" id="villa-form">
                                        {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                        <p> <button class="btn d-inline-flex mb-md-0 btn-company btn-android" id="androin_go">
                                            Android
                                        </button>
                                        <button class="btn d-inline-flex mb-md-0 btn-company btn-ios" id="ios_go">
                                            iOS
                                        </button></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end hero --}}
    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0">
            <div class="slick-pop-slider">
                <div class="Container">
                    <h1 class="Head">{{ Translate::translate('Popular Destinations') }}</h1>
                    <div class="row col-12 Arrows"></div>
                    <!-- Carousel Container -->
                    <div class="SlickCarousel">
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/denpasar.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Sanur</h3><span>0.5 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/ubud.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Ubud</h3><span>15 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/canggu.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Canggu</h3><span>5 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/kuta.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Kuta</h3><span>2 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/nusa-dua.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Nusa Dua</h3><span>3 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/uluwatu.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Uluwatu</h3><span>4 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/jimbaran.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Jimbaran</h3><span>3.5 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/tanah-lot.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Tanah Lot</h3><span>12 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/candi-dasa.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Candi Dasa</h3><span>30 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/tulamben.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Tulamben</h3><span>70 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/bedugul.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Bedugul</h3><span>26 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/seminyak.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Seminyak</h3><span>1.5 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/lovina.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Lovina</h3><span>56 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/pemuteran.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Pemuteran</h3><span>80 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/nusa-penida.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Nusa Penida</h3><span>60 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Carousel Container -->
                </div>
            </div>
        </div>
    </section>
    {{-- end location list (desktop) --}}
    {{-- experience --}}
    {{-- Restaurant --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 0rem 6rem 3rem 6rem;">
                <h1 class="mb-5">{{ Translate::translate('Discover Experiences') }}</h1>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/media/photos/desktop/restaurant.jpg') }}"
                                class="card-img" style="height: 550px; object-fit: cover;" alt="...">
                            <div
                                class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">{{ Translate::translate('Restaurants') }}</h1>
                                    <a href="{{ route('restaurant_list') }}"
                                        class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,food'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Kakul Gondang Restaurant & Grill</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,dessert'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Bebek Tepen Papah Ubud</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,cook'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Sing Dadi Ketho The Waroeng</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,drinks'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Sex On The Beach Cafe</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,pork'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Niang Dayu Tegallalang</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,seafood'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Mr. Crab Jimbaran - Bali</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,mexican'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Taco Beach Grill - Seminyak</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,seats'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Be Guling Men Lengking Jimbaran</a>
                            </div>
                            <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?restaurant,bali'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                <a href="#">Ne Ba Jaen - Tuak & Lawar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Things To Do --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 0rem 6rem 3rem 6rem;">
                <h1 class="mb-5">{{ Translate::translate('Discover Experiences') }}</h1>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="row">
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,dirtbike'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Batur Lava & Jungle Dirt Bike</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,whitewaterrafting'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Telaga Waja White Water Rafting</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,trekking'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Kintamani Rice Field Trekking</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,cooking'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Dharma Sasana Cooking Class</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,hunting'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Pan Wrthi Duck Hunter Baturiti</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,fishing'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Bali Mina Ageng Fishing Club</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,plantation'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Pupuan Cooffe Plantation Tour</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,wild'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Overnight With Cheetah</a>
                                </div>
                                <div class="col-4 restaurant-grid" style="background: url('https://source.unsplash.com/random/?actifity,mountain'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                    <a href="#">Mount Batur Climbing & Sightseeing</a>
                                </div>
                            </div>
                        </div>
                    <div class="col-6 mb-3">
                        <div class="card-overlay2 card bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/media/photos/desktop/activity.jpg') }}"
                                class="card-img" style="height: 550px; object-fit: cover;" alt="...">
                            <div
                                class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">{{ Translate::translate('Things To Do') }}</h1>
                                    <a href="{{ route('activity_list') }}"
                                        class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
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
    <section class="h-100 w-100" style="box-sizing: border-box;">
        <div class="not-header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="mx-auto d-flex flex-lg-row flex-column hero">
                <div class="col-12">
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                        style="border-radius: 14px; height: 400px; background-image: url('{{ URL::asset('assets/media/photos/desktop/villa.jpg') }}'); background-position:center; background-size: cover;">
                        <div class="p-0 h-100 card-overlay">
                            <div style="padding: 3rem 6rem" class="container-xxl mx-auto h-100">
                                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                                    <h1 class="card-title">
                                        {{ Translate::translate('Learn about listing') }}<br>{{ Translate::translate('your home, hotel, restaurant, or activity') }}
                                    </h1>
                                    <div>
                                        <a href="{{ route('ahost') }}" class="btn btn-company text-white"
                                            target="_blank">{{ Translate::translate('Ask a Super Host') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="w-100 d-none d-lg-block" style="background-image: url('{{ URL::asset('assets/media/photos/desktop/villa.jpg') }}');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 500px;">
        <div class="p-0 h-100 card-overlay">
            <div style="padding: 3rem 6rem" class="container-xxl mx-auto h-100">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">
                        {{ Translate::translate('Learn about listing') }}<br>{{ Translate::translate('your home, hotel, restaurant, or activity') }}
                    </h1>
                    <div>
                        <a href="{{ route('ahost') }}" class="btn btn-company text-white"
                            target="_blank">{{ Translate::translate('Ask a Super Host') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 1.5rem 5.7rem;">
                <div class="Container">
                    <h1 class="Head">{{ Translate::translate('Popular Places in Bali for Nature') }}</h1>
                    <div class="row col-12 Arrows2"></div>
                    <!-- Carousel Container -->
                    <div class="SlickCarousel2">
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/mt-batur.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Mount Batur</h3><span>55.1 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/jatiluwih.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Jatiluwih</h3><span>27 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/kebun-raya-bedugul.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Kebun Raya Bedugul</h3><span>45 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/campuhan.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Campuhan</h3><span>45 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/sidemen.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Sidemen</h3><span>72 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/kintamani.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Kintamai</h3><span>53 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/west-bali.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>West Bali</h3><span>94 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/menjangan.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Menjangan</h3><span>103.5 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                        <!-- Item -->
                        <div class="ProductBlock">
                        <div class="Content">
                            <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/gitgit.jpg') }}');">
                            </div>
                            <div class="bottom-fill">
                            <h3>Gitgit</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Carousel Container -->
                </div>
            </div>
        </div>
    </section>

    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="slick-pop-slider">
            <div class="Container">
                <h1 class="Head">{{ Translate::translate('Popular Places in Bali for Beaches') }}</h1>
                <div class="row col-12 Arrows3"></div>
                <!-- Carousel Container -->
                <div class="SlickCarousel3">
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/padang-padang.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Padang Padang</h3><span>55.1 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/jimbaran-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Jimbaran</h3><span>27 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/kuta-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Kuta</h3><span>45 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/seminyak-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Seminyak</h3><span>45 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/peti-tenget.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Peti Tenget</h3><span>72 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/berawa.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Berawa</h3><span>53 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/seseh.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Seseh</h3><span>94 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/yeh-gangga.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Yeh Gangga</h3><span>103.5 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/balian.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Balian</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/soka.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Soka</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/medewi.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Medewi</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/perancak.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Perancak</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/gilimanuk.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Gilimanuk</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/pemuteran-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Pemuteran</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/celukan-bawang.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Celukan Bawang</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/lovina-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Lovina</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/ponjok-batu.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Ponjok Batu</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/tulamben-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Tulamben</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/amed.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Amed</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/candi-dasa-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Candidasa</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/ketewel.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Ketewel</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/sanur-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Sanur</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                    <!-- Item -->
                    <div class="ProductBlock">
                    <div class="Content">
                        <div class="img-fill" style="background: url('{{ URL::asset('assets/media/photos/desktop/nusa-dua-beach.jpg') }}');">
                        </div>
                        <div class="bottom-fill">
                        <h3>Nusa Dua</h3><span>62 Km {{ Translate::translate('Away') }}</span>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Carousel Container -->
            </div>
        </div>
    </section>

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}

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
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <script>
        $(function() {
            $('.legal-tabs li').on('click', function() {
                var tab = $(this).index();
                $('#LegalModal .modal-body .nav-tabs a:eq(' + tab + ')').tab('show');
            });
        });
    </script>

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

    {{-- Search Location --}}
    <script>
        $(document).ready(() => {
            $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                var ids = $(".sugest-list");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    var rndInt = Math.floor(Math.random() * (ids.length - 1));
                    console.log(rndInt);
                    ids.eq(rndInt).show();
                };

                $('#sugest').removeClass("display-none");
                $('#sugest').addClass("display-block"); //add the class to the clicked element
            });

            $(document).mouseup(function(e) {
                var container = $('#sugest');

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.removeClass("display-block");
                    container.addClass("display-none");
                }
            });

            $("#loc_sugest").on('keyup change', async () => {
                var ids = $(".sugest-list");
                ids.hide();
                $(".sugest-list-empty").eq(0).hide();

                var formValue = $("#loc_sugest").val();
                var isEmpty = true;

                $(".sugest-list").map((data) => {
                    var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                        .children('a').text();
                    if (name.toLowerCase().includes(formValue.toLowerCase())) {
                        $(".sugest-list").eq(data).show();
                        isEmpty = false;
                    }
                });

                if (isEmpty) {
                    $(".sugest-list-empty").eq(0).show();
                }
                console.log('done');
            });

            $(".location_op").on('click', function(e) {
                $('#loc_sugest').val($(this).data("value"));
                $('#sugest').removeClass("display-block");
                $('#sugest').addClass("display-none");
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
            onReady(_, __, fp) {
                fp.calendarContainer.classList.add("flat-margin");
            },
            onChange: function(selectedDates, dateStr, instance) {
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
        jQuery(document).ready(function(e) {
            function t(t) {
                e(t).bind("click", function(t) {
                    t.preventDefault();
                    e(this).parent().fadeOut()
                })
            }
            e(".dropdown-toggle").click(function() {
                var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                    ":hidden");
                e(".button-dropdown .dropdown-menu").hide();
                e(".button-dropdown .dropdown-toggle").removeClass("active");
                if (t) {
                    e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                        ".button-dropdown").children(".dropdown-toggle").addClass("active")
                }
            });
            e(document).bind("click", function(t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu")
                    .hide();
            });
            e(document).bind("click", function(t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                    .removeClass("active");
            })
        });
    </script>

    <script>
        var lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            var st = window.pageYOffset || document.documentElement.scrollTop;
            if (window.scrollY == 0) {
                document.getElementById("ul").classList.remove("ul-display-none");
                document.getElementById("ul").classList.add("ul-display-block");
                document.getElementById("bar").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-block");
                document.getElementById("nav").classList.remove("position-fixed");
                document.getElementById("nav").classList.remove("padding-top-0");

                function removeClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.remove(className);
                        } else {
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className
                                .split(' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var els = document.getElementsByClassName("flatpickr-calendar");
                removeClass(els, 'display-none');
            } else {
                console.log("oke");
                document.getElementById("ul").classList.add("ul-display-none");
                document.getElementById("ul").classList.remove("ul-display-block");
                document.getElementById("bar").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-block");
                document.getElementById("nav").classList.add("position-fixed");
                document.getElementById("nav").classList.add("padding-top-0");
                document.getElementById("nav").classList.remove("search-height");

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
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className
                                .split(' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var els = document.getElementsByClassName("flatpickr-calendar");
                addClass(els, 'display-none');
            }
        });
    </script>

    <script>
        function popUp() {
            document.getElementById("ul").classList.remove("ul-display-none");
            document.getElementById("ul").classList.add("ul-display-block");
            document.getElementById("bar").classList.remove("display-none");
            document.getElementById("searchbox").classList.add("display-none");
            document.getElementById("searchbox").classList.remove("display-block");
            document.getElementById("nav").classList.add("search-height");

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

            var els = document.getElementsByClassName("flatpickr-calendar");
            removeClass(els, 'display-none');
        }
    </script>

    <script>
        function language() {
            $('#LegalModal').modal('show');
        }
    </script>

    {{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
    <form action="{{ route('index') }}" method="get" id="redirectMobileForm">
        <input type="hidden" name="screen" value="mobile">
    </form>
    <form action="{{ route('index') }}" method="get" id="redirectDesktopForm">
        <input type="hidden" name="screen" value="desktop">
    </form>
    <script>
        $(window).on('resize', () => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                $('#redirectMobileForm').submit();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                $('#redirectDesktopForm').submit();
            }
        });
        $(document).ready(() => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                $('#redirectMobileForm').submit();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                $('#redirectDesktopForm').submit();
            }
        });
    </script>

    <script>
        var enjoyhint_instance = new EnjoyHint({});

        var enjoyhint_script_steps = [{
                'next #lest_go': 'Welcome to Turbo Search! Let me guide you through its features.',
                'nextButton': {
                    className: "myNext",
                    text: "Sure"
                },
                'skipButton': {
                    className: "mySkip",
                    text: "Nope!"
                }
            },

        ];

        enjoyhint_instance.set(enjoyhint_script_steps);
        enjoyhint_instance.run();
    </script>
    <script>
        $(document).ready(function(){
        $(".SlickCarousel").slick({
            rtl:false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay:false,
            autoplaySpeed:5000, //  Slide Delay
            speed:800, // Transition Speed
            slidesToShow:6, // Number Of Carousel
            slidesToScroll:1, // Slide To Move
            pauseOnHover:false,
            appendArrows:$(".Container .Arrows"), // Class For Arrows Buttons
            prevArrow:'<div class="col-6 nav-left"><span class="Slick-Prev"></span></div>',
            nextArrow:'<div class="col-6 nav-right"><span class="Slick-Next"></span></div>',
            easing:"linear",
            responsive:[
            {breakpoint:801,settings:{
                slidesToShow:3,
            }},
            {breakpoint:641,settings:{
                slidesToShow:3,
            }},
            {breakpoint:481,settings:{
                slidesToShow:1,
            }},
            ],
        })
        })
    </script>

    <script>
        $(document).ready(function(){
        $(".SlickCarousel2").slick({
            rtl:false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay:false,
            autoplaySpeed:5000, //  Slide Delay
            speed:800, // Transition Speed
            slidesToShow:6, // Number Of Carousel
            slidesToScroll:1, // Slide To Move
            pauseOnHover:false,
            appendArrows:$(".Container .Arrows2"), // Class For Arrows Buttons
            prevArrow:'<div class="col-6 nav-left"><span class="Slick-Prev"></span></div>',
            nextArrow:'<div class="col-6 nav-right"><span class="Slick-Next"></span></div>',
            easing:"linear",
            responsive:[
            {breakpoint:801,settings:{
                slidesToShow:3,
            }},
            {breakpoint:641,settings:{
                slidesToShow:3,
            }},
            {breakpoint:481,settings:{
                slidesToShow:1,
            }},
            ],
        })
        })
    </script>


<script>
        $(document).ready(function(){
        $(".SlickCarousel3").slick({
            rtl:false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay:false,
            autoplaySpeed:5000, //  Slide Delay
            speed:800, // Transition Speed
            slidesToShow:6, // Number Of Carousel
            slidesToScroll:1, // Slide To Move
            pauseOnHover:false,
            appendArrows:$(".Container .Arrows3"), // Class For Arrows Buttons
            prevArrow:'<div class="col-6 nav-left"><span class="Slick-Prev"></span></div>',
            nextArrow:'<div class="col-6 nav-right"><span class="Slick-Next"></span></div>',
            easing:"linear",
            responsive:[
            {breakpoint:801,settings:{
                slidesToShow:3,
            }},
            {breakpoint:641,settings:{
                slidesToShow:3,
            }},
            {breakpoint:481,settings:{
                slidesToShow:1,
            }},
            ],
        })
        })
    </script>

</body>

</html>
