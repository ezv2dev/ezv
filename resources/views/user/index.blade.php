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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    {{-- <script src="{{ asset('enjoyhint/enjoyhint.min.js') }}"></script> --}}
    {{-- <link href="{{ asset('enjoyhint/enjoyhint.css') }}" rel="stylesheet" /> --}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4X1HT890PC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4X1HT890PC');
    </script>
</head>

<body>
    @component('components.loading.loading-type2')
    @endcomponent
    <div class="expand-navbar-mobile" aria-expanded="false">
        <div class="px-3 pt-2">
            @auth
                <div>
                    <div class="d-flex align-items-center">
                        <div class="flex-fill d-flex align-items-center me-3">
                            @if (Auth::user()->avatar)
                                <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                    data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                    style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                            @else
                                <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                    data-src="{{ asset('assets/icon/menu/user_default.svg') }}" alt=""
                                    style="border-radius: 50%">
                            @endif
                            <div class="user-details ms-2">
                                <div class="user-details-name">
                                    {{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</div>
                                <div class="user-details-email">
                                    <p class="mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                            style="background: transparent; border: 0;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <hr>
                    @php
                        $role = Auth::user()->role_id;
                    @endphp
                    @if ($role == 1 || $role == 2 || $role == 3)
                        <a class="d-block mb-2" href="{{ route('partner_dashboard') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Dashboard') }}
                        </a>
                    @endif
                    @if ($role == 4)
                        <a class="d-block mb-2 collab-expand" href="{{ route('collaborator_intro') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Collabs') }}
                        </a>
                    @else
                        <a class="d-block mb-2 collab-expand" href="{{ route('collaborator_list') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Collabs') }}
                        </a>
                    @endif
                    <a class="d-block mb-2" href="{{ route('profile_index') }}"
                        style="width: fit-content; color:#585656;">
                        {{ __('user_page.My Profile') }}
                    </a>
                    <a class="d-block mb-2" href="{{ route('change_password') }}"
                        style="width: fit-content; color:#585656;">
                        {{ __('user_page.Change Password') }}
                    </a>
                    <a class="d-block mb-2" href="#!"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        style="width: fit-content; color:#585656;">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        {{ __('user_page.Sign Out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    <a href="{{ route('switch') }}" class="navbar-gap d-block mb-2"
                        style="color:#585656; width: fit-content;">
                        {{ __('user_page.Switch to hosting') }}
                    </a>
                    <hr>
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="language()" class="navbar-gap d-flex align-items-center"
                            style="color: white;">
                            @if (session()->has('locale'))
                                <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                                <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                            <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center" style="color: white;">

                        @if (session()->has('currency'))
                        <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                        @else
                        <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                        @endif

                    </a>
                    </div>
                    <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">

                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center">
                    <div class="flex-fill d-flex align-items-center">
                        <a type="button" onclick="view_LoginModal();" href="#"
                            class="btn btn-fill border-0 d-flex align-items-center btn-login"
                            style="color: #ddd; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                            id="login">
                            <i class="fa-solid fa-user"></i>
                            <p class="mb-0 ms-2" style="color:#585656">Login</p>
                        </a>
                    </div>
                    <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                        style="background: transparent; border: 0;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <hr>
                <a id="sidebar-host" href="{{ route('ahost') }}" class="navbar-gap d-block mb-3"
                    style="color: #585656; width: fit-content;" target="_blank">
                    {{ __('user_page.Become a host') }}
                </a>
                <div class="d-flex align-items-center mb-2">
                    <a type="button" onclick="language()" class="navbar-gap d-blok d-flex align-items-center"
                        style="color: white; margin-right: 9px;" id="language">
                        @if (session()->has('locale'))
                            <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                        @else
                            <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                        @endif
                        <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center" style="color: white;">

                    @if (session()->has('currency'))
                    <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                        {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                    @else
                    <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                        {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                    @endif

                </a>
                </div>
            @endauth
        </div>

    </div>
    <div id="overlay"></div>
    {{-- navbar --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative"
            style="font-family: 'Poppins', sans-serif">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark">
                <div class="collapse navbar-collapse navbar-dekstop" id="navbarTogglerDemo">
                    <div id="navbar-first-dekstop" class="col-lg-4 d-flex align-items-center">
                        <a href="{{ route('index') }}">
                            <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                        <div id="navbar-collapse-button" class="flex-fill d-flex justify-content-end">
                            <div id="searchbox-mob" class="searchbox display-block" onclick="popUp();"
                                style="cursor: pointer; border: none; margin:0;">
                                <span class="top-search"><i class="fa fa-search"></i></span>
                            </div>
                            <button class="navbar-toggler" type="button" id="expand-mobile-btn">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-4" style="height: 90px !important;">

                        <div id="searchbox" class="searchbox display-none" onclick="popUp();"
                            style="cursor: pointer;">
                            <p>{{ __('user_page.Search here') }} <span class="top-search"><i
                                        class="fa fa-search"></i></p>
                        </div>
                        <!--Start of serach option 1 -->

                        <div id="ul" class="ul-display-block">
                            <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                                <div class="nav-link-form" id="villa-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="villa-button"
                                            target="_blank" href="{{ route('list') }}"><img
                                                src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                style="width: 33px; height: auto;"></a>
                                    </li>
                                    <p>
                                        {{ __('user_page.Homes') }}
                                    </p>
                                </div>
                                <div class="nav-link-form" id="hotel-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="hotel-button"
                                            target="_blank" href="{{ route('restaurant_list') }}"><img
                                                src="{{ asset('assets/icon/menu/food.svg') }}"
                                                style="width: 21px; height: auto;"></a>
                                    </li>
                                    <p>
                                        {{ __('user_page.Food') }}
                                    </p>
                                </div>
                                <div class="nav-link-form" id="restaurant-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="restaurant-button"
                                            target="_blank" href="{{ route('hotel_list') }}"><img
                                                src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                style="width: 28px; height: auto;"></a>
                                    </li>
                                    <p>{{ __('user_page.Hotels') }}</p>
                                </div>
                                <div class="nav-link-form" id="activity-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="activity-button"
                                            target="_blank" href="{{ route('activity_list') }}"><img
                                                src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                style="width: 27px; height: auto;"></a>
                                    </li>
                                    {{-- <p>{{ __('user_page.Things to do') }}</p> --}}
                                    <p>WoW</p>
                                </div>
                                <div class="nav-link-form" id="collaborator-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="collaborator-button"
                                            target="_blank" href="{{ route('collaborator_intro') }}"><img
                                                src="{{ asset('assets/icon/menu/collab1.svg') }}"
                                                style="width: 34px; height: auto; filter: invert(100%) sepia(100%) saturate(2%) hue-rotate(2deg) brightness(112%) contrast(101%)"></a>
                                    </li>
                                    <p>{{ __('user_page.Collabs') }}</p>
                                </div>
                            </ul>
                            <!--End of serach option 1 -->

                            {{-- Header Search --}}
                            <div class="search-box">
                                <div id="search_bar">
                                    <form action="{{ route('search_home_combine') }}" method="GET"
                                        id="basic-form" autocomplete="off">
                                        <div id="bar" class="bar">
                                            <div class="location">
                                                <p>{{ __('user_page.Location') }}</p>
                                                <input type="text" {{-- onfocus="this.value=''" --}}
                                                    class="form-control input-transparant input-location"
                                                    style="margin-top: -2px;" id="loc_sugest" name="sLocation"
                                                    placeholder="{{ __('user_page.Where are you going?') }}">

                                                <div id="sugest" class="location-popup display-none">
                                                    <div class="location-popup-container h-100">
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none;">
                                                            <div onclick="checkGeo();"
                                                                class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://icon-library.com/images/current-location-icon/current-location-icon-23.jpg">
                                                            </div>
                                                            <div onclick="checkGeo();"
                                                                class="location-popup-text sugest-list-text">
                                                                <a id="current_location" type="button"
                                                                    class="location_op" data-value="">Current
                                                                    Location</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="Canggu">Canggu</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="Seminyak">Seminyak</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="Ubud">Ubud</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="Kuta">Kuta</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op"
                                                                    data-value="Pecatu">Pecatu</a>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $location = App\Http\Controllers\ViewController::get_location();
                                                            // $hotelName = App\Http\Controllers\HotelController::get_name();
                                                            // $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                            // $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                        @endphp
                                                        @foreach ($location as $item)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                                style="display: none ">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image lozad"
                                                                        src="{{ LazyLoad::show() }}"
                                                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a type="button" class="location_op"
                                                                        data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{-- @foreach ($hotelName as $item2)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                                style="display: none; cursor: pointer;"
                                                                onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image"
                                                                        src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                        type="button" class="location_op"
                                                                        target="_blank"
                                                                        data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @foreach ($restaurantName as $item3)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                                style="display: none; cursor: pointer;"
                                                                onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image"
                                                                        src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                        type="button" class="location_op"
                                                                        target="_blank"
                                                                        data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @foreach ($activityName as $item4)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                                style="display: none; cursor: pointer;"
                                                                onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image"
                                                                        src="{{ asset('assets/icon/map/activity.png') }}">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a href="{{ route('activity', $item4->id_activity) }}"
                                                                        type="button" class="location_op"
                                                                        target="_blank"
                                                                        data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach --}}
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                            style="display: none">
                                                            <p>{{ __('user_page.Location not found') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="check-in">
                                                <a type="button"
                                                    style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px"
                                                    class="collapsible_check_search"></a>
                                                <p>{{ __('user_page.Check in') }}</p>
                                                <input type="text" placeholder="{{ __('user_page.Add dates') }}"
                                                    class="form-control input-transparant" value=""
                                                    id="check_in2" name="sCheck_in">
                                            </div>
                                            <div class="check-out">
                                                <p>{{ __('user_page.Check out') }}</p>
                                                <input type="text" placeholder="{{ __('user_page.Add dates') }}"
                                                    class="form-control input-transparant" value=""
                                                    id="check_out2" name="sCheck_out">
                                            </div>
                                            <div class="guests">
                                                <p>{{ __('user_page.Guests') }}</p>
                                                <ul class="nav">
                                                    <li class="button-dropdown">
                                                        <input type="number" id="total_guest2" value="1"
                                                            style="width: 30px; border: 0; margin-right: 0; text-align: right;"
                                                            disabled min="1"> {{ __('user_page.Guest') }}
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-toggle input-guest">
                                                        </a>
                                                        <a style="margin-left: 10px;" class="dropdown-toggle-icon">
                                                            {{ __('user_page.Add') }}
                                                        </a>

                                                        <div class="guest-popup dropdown-menu">
                                                            <div class="guests-input-row">
                                                                <div class="col-6">
                                                                    <div class="col-12 guest-type-container">
                                                                        <p class="guest-type-title">
                                                                            {{ __('user_page.Adults') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ __('user_page.Age 13 or above') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6"
                                                                    style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button"
                                                                        onclick="adult_decrement_index()"
                                                                        style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style"
                                                                            style="padding:0px"></i>
                                                                    </a>
                                                                    <div
                                                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="adult2"
                                                                            name="sAdult" value="1"
                                                                            style="text-align: center; border:none; width:40px;"
                                                                            min="0" readonly>
                                                                    </div>
                                                                    <a type="button"
                                                                        onclick="adult_increment_index()"
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
                                                                            {{ __('user_page.Children') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ __('user_page.Ages 2–12') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6"
                                                                    style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button"
                                                                        onclick="child_decrement_index()"
                                                                        style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style"
                                                                            style="padding:0px"></i>
                                                                    </a>
                                                                    <div
                                                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="child2"
                                                                            name="sChild" value="0"
                                                                            style="text-align: center; border:none; width:40px;"
                                                                            min="0" readonly>
                                                                    </div>
                                                                    <a type="button"
                                                                        onclick="child_increment_index()"
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
                                                                            {{ __('user_page.Infants') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ __('user_page.Under 2') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6"
                                                                    style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button"
                                                                        onclick="infant_decrement_index()"
                                                                        style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style"
                                                                            style="padding:0px"></i>
                                                                    </a>
                                                                    <div
                                                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="infant2"
                                                                            name="" value="0"
                                                                            style="text-align: center; border:none; width:40px;"
                                                                            min="0" readonly>
                                                                    </div>
                                                                    <a type="button"
                                                                        onclick="infant_increment_index()"
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
                                                                            {{ __('user_page.Pets') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ __('user_page.Service animal ?') }}
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
                                                                        <input type="number" id="pet2"
                                                                            name="" value="0"
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
                                            <div class="button pb-0">
                                                <button type="submit"
                                                    style="z-index: 1; border: none; background: transparent; height: 48px;">
                                                    <i class="fa fa-search search-button"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_check_search"
                                    style="margin-left: -1116px; width:fit-content; padding:0px;z-index: 999; margin-top: 10px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white;
                                                border-radius: 15px;">
                                                <div class="col-lg-12"
                                                    style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                    <a type="button" id="clear_date_header"
                                                        style="margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    <p style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                                <div class="flatpickr" id="inline_reserve_search"
                                                    style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- calendar --}}
                            </div>
                        </div>
                        {{-- End Header Search --}}
                    </div>

                    <div id="nav-end-dekstop" class="col-lg-4 ms-auto"
                        style="display: flex; align-items: center; justify-content: flex-end;">
                        @auth
                            <div class="d-flex" style="display: inline-block; align-items: center;">
                                <a href="{{ route('switch') }}" class="navbar-gap" style="color: #b9b9b9;">
                                    {{ __('user_page.Switch to hosting') }}
                                </a>

                                <a type="button" onclick="language()" class="navbar-gap"
                                    style="color: white; width:27px;">
                                    @if (session()->has('locale'))
                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                    @else
                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                    @endif
                                </a>

                                <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @if (Auth::user()->avatar)
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2"
                                                alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                                        @else
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                                class="user-photo" alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px;">
                                        @endif

                                        <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                            aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                            <h6 class="dropdown-header d-flex align-items-center">
                                                @if (Auth::user()->foto_profile != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                                @elseIf (Auth::user()->avatar != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ Auth::user()->avatar }}">
                                                @else
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('assets/icon/menu/user_default.svg') }}">
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
                                                    {{ __('user_page.Dashboard') }}
                                                </a>
                                            @endif
                                            @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                                <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                                    {{ __('user_page.Collabs') }}
                                                </a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('profile_index') }}">
                                                {{ __('user_page.My Profile') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('change_password') }}">
                                                {{ __('user_page.Change Password') }}
                                            </a>
                                            <a class="dropdown-item" href="#!"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                                {{ __('user_page.Sign Out') }}
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
                            <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9;"
                                target="_blank">
                                {{ __('user_page.Become a host') }}
                            </a>

                            <a type="button" onclick="language()" class="navbar-gap"
                                style="color: white; margin-right: 9px; width:27px;" id="language">
                                @if (session()->has('locale'))
                                    <img style="border-radius: 3px; height: 23px;" class="lozad"
                                        src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img style="border-radius: 3px;" class="lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                            </a>
                            <a type="button" onclick="view_LoginModal();" href="#{{-- {{ route('login') }} --}}"
                                class="btn btn-fill border-0 navbar-gap"
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
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative"
            style="font-family: 'Poppins', sans-serif">
            <div class="mx-auto d-flex flex-lg-row flex-column hero">
                <div class="col-12">
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load index-jumbotron"
                        data-src="{{ URL::asset('assets/media/photos/desktop/batur.webp') }}">
                        <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                            <div>
                                <p class="text-white text-center" style="font-size: 22px;">
                                    {{-- __('user_page.The Best Way To Find Accommodation, Restaurants, And Things To Do') --}}

                                    {{ __('user_page.The Best Way To Find Home, Hotel, Food, And Wow') }}
                                </p>
                                <div
                                    class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                    <form action="{{ route('list') }}" method="GET" id="villa-form">
                                        {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                        <button class="btn d-inline-flex mb-md-0 btn-company">
                                            {{ __("user_page.Let's Go") }}
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

    <div class="header-4-4 position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="container-xxl mx-auto p-0">
            <div class="mx-auto d-flex flex-lg-row flex-column hero">
                <div class="col-12">
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load"
                        data-src="{{ URL::asset('assets/media/photos/desktop/app.webp') }}"
                        style="border-radius: 14px; height: 400px; background-position:center; background-size: cover;">
                        <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                            <div>
                                <p class="text-white text-center" style="font-size: 62px;" id="text-download-app">
                                    {{ __('user_page.Download The App') }}
                                </p>
                                <p class="text-white text-center" style="margin-top: -20px;">
                                    {{ __('user_page.Unlock all the features today') }}
                                </p>

                                <p style="text-align: center;">
                                    <a href="https://www.apple.com/id/app-store/" target="_blank"
                                        class="btn-donwload-mobile-app" id="btn-to-app-store">
                                        <img src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                    </a>
                                    <a href="https://play.google.com/" target="_blank"
                                        class="btn-donwload-mobile-app" id="btn-to-play-store">
                                        <img src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            {{-- end hero --}}
            {{-- experience --}}

            {{-- Restaurant --}}
            <section class="h-100 w-100 bg-white">
                <div class="container-xxl mx-auto p-0">
                    <div style="padding: 0rem 6rem 2rem 6rem;" class="discover-experiences-container">
                        <h1 class="mb-5" style="margin-bottom: 1rem !important;">{{ __('user_page.Discover Experiences') }}</h1>
                        <div class="row-grid" id="discover-experiences-food">
                            <div class="mb-3">
                                <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/media/photos/desktop/restaurant.webp') }}"
                                        class="card-img lozad index-experience-img img-overlay" alt="...">
                                    <div
                                        class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <h1 class="card-title">{{ __('user_page.Food') }}</h1>
                                            <a href="{{ route('restaurant_list') }}"
                                                class="btn btn-company text-white btn-sm">{{ __('user_page.Explore') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row-grid-img">
                                    @foreach ($restaurantSubCategory->sortBy('order')->take(9) as $item)
                                        <div class="pointer">
                                            <div onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ $item->id_subcategory }})"
                                                class="grid-img-container">
                                                <img class="grid-img lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="https://source.unsplash.com/random/?{{ $item->name }}">
                                                <div class="grid-text">
                                                    {{ $item->name }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Things To Do --}}
            <section class="h-100 w-100 bg-white">
                <div class="container-xxl mx-auto p-0">
                    <div style="padding: 0rem 6rem 0rem 6rem;" class="discover-experiences-container">
                        <h1 class="mb-5" style="margin-bottom: 1rem !important;">{{ __('user_page.Discover Experiences') }}</h1>
                        <div class="row-grid" id="discover-experiences-things-todo">
                            <div class="mb-3">
                                <div class="row-grid-img">
                                    @foreach ($activitySubCategory->sortBy('order')->take(9) as $item)
                                        <div class="pointer">
                                            <div onclick="wowFilter({{ $item->id_category }}, {{ $item->id_subcategory }}, null)"
                                                class="grid-img-container">
                                                <img class="grid-img lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="https://source.unsplash.com/random/?{{ $item->name }}">
                                                <div class="grid-text">
                                                    {{ $item->name }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/media/photos/desktop/activity.webp') }}"
                                        class="card-img lozad index-experience-img img-overlay" alt="...">
                                    <div
                                        class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            {{-- <h1 class="card-title">{{ __('user_page.Things To Do') }}</h1> --}}
                                            <h1>WoW</h1>
                                            <a href="{{ route('activity_list') }}"
                                                class="btn btn-company text-white btn-sm">{{ __('user_page.Explore') }}</a>
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
                <div class="not-header-4-4 container-xxl mx-auto p-0 position-relative"
                    style="font-family: 'Poppins', sans-serif">
                    <div class="mx-auto d-flex flex-lg-row flex-column hero" id="qa-container">
                        <div class="col-12">
                            <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load index-jumbotron"
                                data-src='{{ URL::asset('assets/media/photos/desktop/villa.webp') }}'>
                                <div class="p-0 h-100 card-overlay">
                                    <div style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)); padding: 3rem 6rem"
                                        class="container-xxl mx-auto h-100" id="qa-card">
                                        <div
                                            class="col-12 d-flex flex-column justify-content-between text-white h-100 align-items-center align-items-sm-start">
                                            <h1 class="card-title flex-sm-fill"
                                                style="font-size: 28px;font-weight: 400;display: block;word-wrap: break-word;max-width: 300px;line-height: 1.5;">
                                                {{-- __('user_page.Learn about listing your home, hotel, restaurant, or activity') --}}
                                                {{ __('user_page.Learn about listing your home, hotel, food, or business') }}
                                            </h1>
                                            <div>
                                                <a href="{{ route('ahost') }}" class="btn btn-company text-white"
                                                    target="_blank">{{ __("user_page.Let's Go") }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        {{-- modal laguage and currency --}}

        {{-- modal login --}}
        @include('user.modal.auth.login_register')

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

        {{-- GeoLocation --}}
        <script>
            let result;
            let location_current_user;

            function handlePermission() {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(result) {
                    if (result.state == 'granted') {
                        report(result.state);
                    } else if (result.state == 'prompt') {
                        report(result.state);
                        getLocation();
                    } else if (result.state == 'denied') {
                        report(result.state);
                    }
                    result.onchange = function() {
                        report(result.state);
                    }
                });
            }

            function report(state) {
                result = state;
                console.log(result);
            }

            function checkGeo() {
                handlePermission();
                if (result == "prompt") {
                    alert("Allow your location");
                }
                if (result == "denied") {
                    alert("Allow your location");
                }
                if (result == "granted") {
                    location.reload();
                }
            }

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                let position_lat = position.coords.latitude;
                let position_lng = position.coords.longitude;
                $.ajax({
                    type: "GET",
                    url: "/index/get_lat_long/",
                    data: {
                        latitudeUser: position_lat,
                        longitudeUser: position_lng,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(filtered_data) {
                        location_current_user = document.getElementById("current_location").setAttribute(
                            'data-value', `${filtered_data}`);
                    },
                });
            }

            getLocation();

            // function getLocation(callback) {
            //     if (navigator.geolocation) {
            //         var lat_lng = navigator.geolocation.getCurrentPosition(function(position) {
            //             // console.log(position);
            //             var user_position = {};
            //             user_position.lat = position.coords.latitude;
            //             user_position.lng = position.coords.longitude;
            //             callback(user_position);
            //         });
            //     } else {
            //         alert("Geolocation is not supported by this browser.");
            //     }
            // }

            // getLocation(function(lat_lng) {
            //     $.ajax({
            //         type: "GET",
            //         url: "/index/get_lat_long/",
            //         data: {
            //             latitudeUser: lat_lng.lat,
            //             longitudeUser: lat_lng.lng,
            //             _token: "{{ csrf_token() }}",
            //         },
            //         success: function(filtered_data) {
            //             let location = document.getElementById("current_location").setAttribute('data-value', `${filtered_data}`);
            //             // $("#Sanur").text(data[0].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Ubud").text(data[1].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Canggu").text(data[2].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Kuta").text(data[3].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#NusaDua").text(data[4].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Uluwatu").text(data[5].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Jimbaran").text(data[6].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#TanahLot").text(data[7].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#CandiDasa").text(data[8].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Tulamben").text(data[9].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Bedugul").text(data[10].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Seminyak").text(data[11].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Lovina").text(data[12].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#Pemuteran").text(data[13].miles + ` {{ __('user_page.Km Away') }}`);
            //             // $("#NusaPenida").text(data[14].miles + ` {{ __('user_page.Km Away') }}`);
            //         },
            //     });
            // });
        </script>

        <script>
            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }
        </script>

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
                if (window.innerWidth <= 991) {
                    document.getElementById("ul").classList.add("ul-display-none");
                    document.getElementById("ul").classList.remove("ul-display-block");
                    document.getElementById("bar").classList.add("display-none");
                    document.querySelector("#searchbox").classList.remove("display-none");
                    document.querySelector("#searchbox").classList.add("display-block");
                    document.getElementById("nav").classList.add("position-fixed");
                    document.getElementById("nav").classList.add("padding-top-0");
                }
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                })
                $("#expand-mobile-btn").on("click", function() {
                    $("body").css({
                        "height": "100%",
                        "overflow": "hidden"
                    })
                    $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "true");
                    $("#overlay").css("display", "block");
                })
                $('#overlay').click(function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                })
                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
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
                    var close = $(".sugest-list-first");
                    close.hide();
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

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
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
            var coll = document.getElementsByClassName("collapsible_check_search");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_check_search');
                    if (content_flatpickr.style.display === "block") {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            if (!container.contains(e.target)) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });
            }
        </script>

        <script>
            function calendar_search(months) {
                if (!$("#check_in2").val()) {
                    var check_in_val = "";
                } else {
                    var check_in_val = $("#check_in2").val();
                }

                if (!$("#check_out2").val()) {
                    var check_out_val = "";
                } else {
                    var check_out_val = $("#check_out2").val();
                }
                $("#inline_reserve_search").flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    inline: true,
                    mode: "range",
                    showMonths: months,
                    // disable: data,
                    defaultDate: [check_in_val, check_out_val],
                    onChange: function(selectedDates, dateStr, instance) {
                        $("#check_in2").val(instance.formatDate(selectedDates[0], "Y-m-d"));
                        $("#check_out2").val(
                            instance.formatDate(selectedDates[1], "Y-m-d")
                        );
                        let content = document.getElementById("popup_check_search");
                        content.style.display = "none";
                    },
                });
            }
            calendar_search(2);
        </script>

        <script>
            $("#dates").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                mode: "range",
                showMonths: 2,
                disableMobile: "true",
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
                var isFocused = document.querySelector("#loc_sugest") == document.activeElement;
                if (window.scrollY == 0 && window.innerWidth > 991) {
                    document.getElementById("ul").classList.remove("ul-display-none");
                    document.getElementById("ul").classList.add("ul-display-block");
                    document.getElementById("bar").classList.remove("display-none");
                    document.querySelector("#searchbox").classList.add("display-none");
                    document.querySelector("#searchbox").classList.remove("display-block");
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
                    if (!isFocused || window.innerWidth > 991) {
                        console.log("oke");
                        document.getElementById("ul").classList.add("ul-display-none");
                        document.getElementById("ul").classList.remove("ul-display-block");
                        document.getElementById("bar").classList.add("display-none");
                        document.querySelector("#searchbox").classList.remove("display-none");
                        document.querySelector("#searchbox").classList.add("display-block");
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
                $('#trigger-tab-language').addClass('active');
                $('#content-tab-language').addClass('active');
                $('#trigger-tab-currency').removeClass('active');
                $('#content-tab-currency').removeClass('active');
            }
            function currency() {
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');
            }
        </script>

        <script>
            $(document).ready(function() {
                function handleResponsive(windowWidth) {
                    if (windowWidth <= 649) {
                        calendar_search(1);
                        $("#clear_date_header").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");
                            calendar_search(1);
                        });
                    } else {
                        $("#clear_date_header").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");
                            calendar_search(2);
                        });
                        calendar_search(2);
                    }
                    if (windowWidth <= 991) {
                        $("#search_bar #bar").addClass("row");
                        $("#bar .location").addClass("col-12 mb-2");
                        $("#bar .check-in").addClass("col-6 mb-2");
                        $("#bar .check-out").addClass("col-6 mb-2");
                        $("#bar .guests").addClass("col-10");
                        $("#bar .button").addClass("col-2 p-0 px-2");
                        $(".header-4-4 #nav .navbar-collapse .col-lg-4").css("height", "");
                    } else {
                        $("#search_bar #bar").removeClass("row");
                        $("#bar .location").removeClass("col-12 mb-2");
                        $("#bar .check-in").removeClass("col-6 mb-2");
                        $("#bar .check-out").removeClass("col-6 mb-2");
                        $("#bar .guests").removeClass("col-10");
                        $("#bar .button").removeClass("col-2 p-0 px-2");
                        $(".header-4-4 #nav .navbar-collapse .col-lg-4").css("height", "90px");
                    }
                }
                var windowWidth = $(window).width();
                handleResponsive(windowWidth);
                $(window).on("resize", function() {
                    if ($(this).width() !== windowWidth) {
                        windowWidth = $(this).width();
                        handleResponsive(windowWidth);
                        if (windowWidth <= 991) {
                            if (window.scrollY == 0) {
                                document.getElementById("nav").classList.add("position-fixed");
                                document.getElementById("nav").classList.add("padding-top-0");
                                document.getElementById("nav").classList.add("search-height");
                            }
                        }else {
                            if (window.scrollY == 0) {
                                document.getElementById("nav").classList.remove("position-fixed");
                                document.getElementById("nav").classList.remove("padding-top-0");
                                document.getElementById("nav").classList.remove("search-height");
                            }
                        }
                    }
                })
                $(".SlickCarousel").slick({
                    rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                    autoplay: false,
                    autoplaySpeed: 5000, //  Slide Delay
                    speed: 800, // Transition Speed
                    slidesToShow: 5, // Number Of Carousel
                    slidesToScroll: 3, // Slide To Move
                    pauseOnHover: false,
                    appendArrows: $(".Container .Head .Arrows"),
                    prevArrow: '<span class="Slick-Prev"></span>',
                    nextArrow: '<span class="Slick-Next"></span>',
                    easing: "linear",
                    responsive: [{
                            breakpoint: 801,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 641,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ],
                })
            })
        </script>

        <script>
            $(document).ready(function() {
                $(".SlickCarouselthree").slick({
                    rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                    autoplay: false,
                    autoplaySpeed: 5000, //  Slide Delay
                    speed: 800, // Transition Speed
                    slidesToShow: 5, // Number Of Carousel
                    slidesToScroll: 3, // Slide To Move
                    pauseOnHover: false,
                    appendArrows: $(".Containerthree .Head .Arrows"),
                    prevArrow: '<span class="Slick-Prev"></span>',
                    nextArrow: '<span class="Slick-Next"></span>',
                    easing: "linear",
                    responsive: [{
                            breakpoint: 801,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 641,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ],
                })
            })
        </script>

        <script>
            $(document).ready(function() {
                $(".SlickCarousel2").slick({
                    rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                    autoplay: false,
                    autoplaySpeed: 5000, //  Slide Delay
                    speed: 800, // Transition Speed
                    slidesToShow: 6, // Number Of Carousel
                    slidesToScroll: 1, // Slide To Move
                    pauseOnHover: false,
                    appendArrows: $(".Container .Arrows2"), // Class For Arrows Buttons
                    prevArrow: '<div class="col-6 nav-left"><span class="Slick-Prev"></span></div>',
                    nextArrow: '<div class="col-6 nav-right"><span class="Slick-Next"></span></div>',
                    easing: "linear",
                    responsive: [{
                            breakpoint: 801,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 641,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ],
                })
            })
        </script>

        <script>
            $(document).ready(function() {
                $(".SlickCarousel3").slick({
                    rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                    autoplay: false,
                    autoplaySpeed: 5000, //  Slide Delay
                    speed: 800, // Transition Speed
                    slidesToShow: 6, // Number Of Carousel
                    slidesToScroll: 1, // Slide To Move
                    pauseOnHover: false,
                    appendArrows: $(".Container .Arrows3"), // Class For Arrows Buttons
                    prevArrow: '<div class="col-6 nav-left"><span class="Slick-Prev"></span></div>',
                    nextArrow: '<div class="col-6 nav-right"><span class="Slick-Next"></span></div>',
                    easing: "linear",
                    responsive: [{
                            breakpoint: 801,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 641,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ],
                })
            })
        </script>

        <script>
            function view_LoginModal() {
                $('#LoginModal').modal('show');
            }
        </script>

        <script>
            function wowRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/wow/search?${suburl}`;
            }

            function wowFilter(valueCategory, valueSub, clearSub) {
                var sLocationFormInput = '';
                var sKeywordFormInput = '';
                var sStart = '';
                var sEnd = '';

                if (url2.searchParams.get('fCategory') == valueCategory) {
                    valueCategory = '';
                }

                var filterFormInput = [];
                $("input[name='subCategory[]']:checked").each(function() {
                    filterFormInput.push(parseInt($(this).val()));
                });

                if (filterFormInput.includes(valueSub) == true) {
                    var filterCheck = filterFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueSub;
                    }

                    var filteredArray = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    filterFormInput.push(valueSub);

                    var filteredArray = filterFormInput.filter(function(item, pos) {
                        return filterFormInput.indexOf(item) == pos;
                    });
                }
                console.log(`satttt${valueSub}`);

                if (clearSub == 1) {
                    var subUrl =
                        `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=${valueCategory}&fSubCategory=`;
                } else if (valueCategory == null) {
                    var subUrl =
                        `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=&fSubCategory=${valueSub}`;
                } else {
                    var subUrl =
                        `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=${valueCategory}&fSubCategory=${filteredArray}`;
                }

                wowRefreshFilter(subUrl);
            }

            function restaurantRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/food/search?${suburl}`;
            }

            function foodFilter(valueCuisine, valueSub) {
                var sLocationFormInput = '';

                function setCookie2(name, value, days) {
                    var expires = "";
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "") + expires + "; path=/";
                }

                var url_food = window.location.href;
                var url2 = new URL(url_food);

                if (url2.searchParams.get('fCuisine') == valueCuisine) {
                    valueCuisine = '';
                }

                setCookie2("sLocation", sLocationFormInput, 1);

                var sCuisineFormInput = [];
                $("input[name='sKeywords[]']:checked").each(function() {
                    sCuisineFormInput.push(parseInt($(this).val()));
                });

                var sKeywordFormInput = '';

                var filterFormInput = [];
                $("input[name='subCategory[]']:checked").each(function() {
                    filterFormInput.push(parseInt($(this).val()));
                });

                if (filterFormInput.includes(valueSub) == true) {
                    var filterCheck = filterFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueSub;
                    }

                    var filteredArray = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    filterFormInput.push(valueSub);

                    var filteredArray = filterFormInput.filter(function(item, pos) {
                        return filterFormInput.indexOf(item) == pos;
                    });
                }

                if (valueCuisine == null) {
                    var subUrl =
                        `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&fCuisine=&fSubCategory=${filteredArray}`;
                } else {
                    var subUrl =
                        `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&fCuisine=${valueCuisine}&fSubCategory=${filteredArray}`;
                }
                restaurantRefreshFilter(subUrl);
            }
        </script>

        {{-- LAZY LOAD --}}
        @include('components.lazy-load.lazy-load')
        {{-- END LAZY LOAD --}}
</body>

</html>
