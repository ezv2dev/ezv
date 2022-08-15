<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">

    <title>@yield('title')</title>

    <meta name="description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/list-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/list-restaurant.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/pagination-css.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/skeleton-load.css') }}">

    <style>
        .list-link-sidebar {
            gap: 12px;
            display: flex;
            align-items:center;
        }

        .list-link-sidebar i {
            width: 30px;
        }

        .subcategory-in-sidebar:hover {
            cursor: pointer;
        }

        .list-link-sidebar>*,
        .list-link-sidebar:hover>*,
        .subcategory-in-sidebar-container>*,
        .subcategory-in-sidebar>* {
            color: #585656;
        }
    </style>
</head>



@php

// set theme color
$bgColor = 'bg-body-light';
$textColor = 'font-black';
$rowLineColor = 'row-line-white';
$listColor = 'listoption-light';
$shadowColor = 'box-shadow-light';
if (isset($_COOKIE['tema'])) {
    if ($_COOKIE['tema'] == 'black') {
        $bgColor = 'bg-body-black';
        $textColor = 'font-light';
        $rowLineColor = 'row-line-grey';
        $listColor = '{{ $listColor }}';
        $shadowColor = 'box-shadow-dark';
    }
}

@endphp

<body id="bodyList" class="{{ $bgColor }}">
    {{-- MAIN LOADING --}}
    {{-- @include('components.loading.loading-type2') --}}
    {{-- END MAIN LOADING --}}

    @php
        $condition_villa = Route::is('list') || Route::is('property_type') || Route::is('filter') || Route::is('price') || Route::is('more_filter') || Route::is('box_filter') || Route::is('sort_low_to_high') || Route::is('sort_high_to_low') || Route::is('sort_popularity') || Route::is('sort_newest') || Route::is('sort_highest_rating') || Route::is('filter_activity') || Route::is('filter_activity_get_subcategory') || Route::is('search_villa') || Route::is('amenities_filter') || Route::is('filters') || Route::is('search_villa_combine') || Route::is('search_home_combine');
        $condition_hotel = Route::is('hotel_list') || Route::is('search_hotel') || Route::is('filters-hotel');
        $condition_restaurant = Route::is('restaurant_list') || Route::is('search_restaurant') || Route::is('filter_restaurant') || Route::is('search_food');
        $condition_things_to_do = Route::is('activity_list') || Route::is('search_activity') || Route::is('search_wow') || Route::is('search_wow_sub');
        $condition_collaborator = Route::is('collaborator_list') || Route::is('search_collaborator');
        $scenic_views = App\Models\ScenicViews::all();
        $tema = isset($_COOKIE['tema']) ? $_COOKIE['tema'] : null;
        $bedroomCheck = app('request')->input('fBedroom');
        $bathroomCheck = app('request')->input('fBathroom');
        $bedsCheck = app('request')->input('fBeds');

        if ($bedroomCheck == 0) {
            $bedroomCheck = 0;
        }

        if ($bathroomCheck == 0) {
            $bathroomCheck = 0;
        }

        if ($bedsCheck == 0) {
            $bedsCheck = 0;
        }

    @endphp

    <div class="expand-navbar-mobile" aria-expanded="false">
        <div class="px-3 pt-2 h-100" style="overflow-x: hidden; overflow-y: auto;">
            @auth
                <div>
                    <div class="d-flex align-items-center">
                        <div class="flex-fill d-flex align-items-center me-3">
                            @if (Auth::user()->avatar)
                                <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                    data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                    style="border-radius: 50%; width: 50px; border: solid 2px #ff7400;">
                            @else
                                <img src="{{ asset('assets/icon/menu/user_default.svg') }}" class="logged-user-photo"
                                    alt="">
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
                        <a class="list-link-sidebar mb-2" href="{{ route('partner_dashboard') }}">
                            <i class="fa fa-tachometer text-center" aria-hidden="true"></i>
                            <p class="m-0">{{ __('user_page.Dashboard') }}</p>
                        </a>
                    @endif
                    @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                        <a class="list-link-sidebar mb-2" href="{{ route('collaborator_list') }}">
                            <i class="fa fa-handshake-o text-center" aria-hidden="true"></i>
                            <p class="m-0">{{ __('user_page.Collab Portal') }}</p>
                        </a>
                    @endif
                    <a class="list-link-sidebar  mb-2" href="{{ route('profile_index') }}">
                        <i class="fa-solid fa-user text-center"></i>
                        <p class="m-0">{{ __('user_page.My Profile') }}</p>
                    </a>
                    <a class="list-link-sidebar  mb-2" href="{{ route('change_password') }}">
                        <i class="fa-solid fa-key text-center"></i>
                        <p class="m-0">{{ __('user_page.Change Password') }}</p>
                    </a>
                    <a href="{{ route('switch') }}" class="list-link-sidebar mb-2">
                        <i class="fa fa-refresh text-center" aria-hidden="true"></i>
                        <p class="m-0">{{ __('user_page.Switch to Hosting') }}</p>
                    </a>
                    <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreCategory()">
                        <i class="fa fa-th text-center" aria-hidden="true"></i>
                        <p class="m-0">{{ __('user_page.Category') }}</p>
                    </div>
                    @if ($condition_villa)
                    <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="modalFiltersHomes()">
                        <i class="fas fa-ellipsis text-center"></i>
                        <p class="m-0">Filters</p>
                    </div>
                    @elseif($condition_restaurant)
                    <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreSubCategory()">
                        <i class="fa-solid fa-ellipsis text-center"></i>
                        <p class="m-0">{{ __('user_page.Filters') }}</p>
                    </div>
                    @elseif($condition_hotel)
                    <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="modalFiltersHotel()">
                        <i class="fa-solid fa-ellipsis text-center"></i>
                        <p class="m-0">{{ __('user_page.Filters') }}</p>
                    </div>
                    @elseif($condition_things_to_do)
                    <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreSubCategory()">
                        <i class="fa-solid fa-ellipsis text-center"></i>
                        <p class="m-0">{{ __('user_page.Filters') }}</p>
                    </div>
                    @endif
                    <a class="list-link-sidebar mb-2" href="#!"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out text-center" aria-hidden="true"></i>
                        <p class="m-0">{{ __('user_page.Sign Out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <hr>
                    <a type="button" onclick="language()" class="list-link-sidebar navbar-gap mb-2">
                        @if (session()->has('locale'))
                            <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                        @else
                            <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                        @endif
                        <p class="mb-0">{{ __('user_page.Choose a Language') }}</p>
                    </a>
                    <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">

                            </div>
                        </a>
                    </div>
                    <div class="list-link-sidebar navbar-gap mb-2" id="changeThemeMobile">
                        <div class="logged-user-menu">
                            <label class="container-mode {{ $condition_collaborator ? 'container-mode-collab' : '' }} ">
                                <input type="checkbox" id="background-color-switch"
                                    onclick="changeBackgroundTrigger(this)"
                                    {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                                <div class="checkmark-mode"></div>
                            </label>
                        </div>
                        <p class="mb-0 ms-2" id="switcher" style="cursor: pointer; color: #585656;">Light / Dark Mode</p>
                    </div>
                    <a type="button" onclick="currency()" class="list-link-sidebar navbar-gap mb-2">
                        <img class="lozad"
                            style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;"
                            src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">
                        @if (session()->has('currency'))
                            <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})
                            </p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                        @else
                            <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                        @endif

                    </a>

                </div>
            @else
                <div class="d-flex align-items-center justify-content-between pt-3 pb-0">
                    <a onclick="loginRegisterForm(2, 'registration');" class="list-link-sidebar" id="login">
                        <i class="fa-solid fa-user text-center"></i>
                        <p class="mb-0">{{ __('user_page.Create Account') }}</p>
                    </a>
                    <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                        style="background: transparent; border: 0;">
                        <i class="fa-solid fa-xmark" style="color:#585656"></i>
                    </button>
                </div>
                <hr>
                <a href="{{ route('ahost') }}" class="list-link-sidebar mb-2" target="_blank">
                    <i class="fa fa-pencil-square text-center" aria-hidden="true"></i>
                    <p class="m-0">{{ __('user_page.Create Listing') }}</p>
                </a>
                <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreCategory()">
                    <i class="fa fa-th text-center" aria-hidden="true"></i>
                    <p class="m-0">{{ __('user_page.Category') }}</p>
                </div>
                @if ($condition_villa)
                <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="modalFiltersHomes()">
                    <i class="fas fa-ellipsis text-center"></i>
                    <p class="m-0">Filters</p>
                </div>
                @elseif($condition_restaurant)
                <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreSubCategory()">
                    <i class="fa-solid fa-ellipsis text-center"></i>
                    <p class="m-0">{{ __('user_page.Filters') }}</p>
                </div>
                @elseif($condition_hotel)
                <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="modalFiltersHotel()">
                    <i class="fa-solid fa-ellipsis text-center"></i>
                    <p class="m-0">{{ __('user_page.Filters') }}</p>
                </div>
                @elseif($condition_things_to_do)
                <div class="list-link-sidebar subcategory-in-sidebar mb-2" onclick="moreSubCategory()">
                    <i class="fa-solid fa-ellipsis text-center"></i>
                    <p class="m-0">{{ __('user_page.Filters') }}</p>
                </div>
                @endif
                <hr>
                <a type="button" onclick="language()" class="navbar-gap list-link-sidebar mb-2" id="language">
                    @if (session()->has('locale'))
                        <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                    @else
                        <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                    @endif
                    <p class="mb-0" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                </a>
                <div class="list-link-sidebar mb-2" id="changeThemeMobile">
                    <div class="logged-user-menu" style="">
                        <label class="container-mode {{ $condition_collaborator ? 'container-mode-collab' : '' }}">
                            <input type="checkbox" id="background-color-switch" onclick="changeBackgroundTrigger(this)"
                                {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                            <span class="checkmark-mode"></span>
                        </label>
                    </div>
                    <p class="mb-0" id="switcher" style="cursor: pointer; color: #585656;">Light / Dark Mode</p>
                </div>
                <a type="button" onclick="currency()" class="navbar-gap list-link-sidebar mb-2"
                        style="color: white;">
                        <img class="lozad"
                            style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;"
                            src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">
                        @if (session()->has('currency'))
                            <p class="mb-0" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                        @else
                            <p class="mb-0" style="color: #585656">Choose Currency</p>
                            {{-- <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                        @endif

                </a>
            @endauth

            <hr>
            @if ($condition_villa)
                <div class="subcategory-in-sidebar-container">
                    <div class="mt-2">
                        @foreach ($amenities->sortBy('order')->take(4) as $item)
                            <div class="list-link-sidebar subcategory-in-sidebar mb-2"
                                onclick="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_amenities }})">
                                <i class="fas fa-{{ $item->icon }} text-center" @php
                                    $amenitiesIds = explode(',', request()->get('fAmenities'));
                                @endphp @if (in_array($item->id_amenities, $amenitiesIds))
                                    style="color: #ff7400;"
                        @endif>
                        </i>
                        <p class="m-0">{{ $item->name }}</p>
                    </div>
            @endforeach
        </div>
    </div>
@elseif($condition_restaurant)
    <div class="subcategory-in-sidebar-container ">
        <div class="mt-2">
            @foreach ($subcategories->take(4) as $item)
                <div
                    class="list-link-sidebar subcategory-in-sidebar mb-2"onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ $item->id_subcategory }}, false)">
                    <i class="{{ $item->icon }} text-center" @php
                        $isChecked = '';
                        $filterIds = explode(',', request()->get('fSubCategory'));
                    @endphp @if (in_array($item->id_subcategory, $filterIds))
                        style="color: #ff7400 !important;"
            @endif>
            </i>
            <p class="m-0">{{ $item->name }}</p>
        </div>
        @endforeach
    </div>
    </div>
@elseif($condition_hotel)
    <div class="subcategory-in-sidebar-container">
        @foreach ($hotelFilter->take(4)->sortBy('order') as $item)
            <div class="list-link-sidebar subcategory-in-sidebar mb-2"
                onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_hotel_filter }}, false)">
                <i class="{{ $item->icon }} text-center" @php
                    $isChecked = '';
                    $filterIds = explode(',', request()->get('filter'));
                @endphp @if (in_array($item->id_hotel_filter, $filterIds))
                    style="color: #ff7400 !important;"
        @endif>
        </i>
        <p class="m-0">{{ $item->name }}</p>
    </div>
    @endforeach
    </div>
@elseif($condition_things_to_do)
    <div class="subcategory-in-sidebar-container">
        @foreach ($subCategory->take(4) as $item)
            <div class="list-link-sidebar subcategory-in-sidebar mb-2"
                onclick="wowFilter({{ $item->id_category }}, {{ $item->id_subcategory }}, null, false)">
                <i class="{{ $item->icon }} text-center"
                    @php
                        $isChecked = '';
                        $filterIds = explode(',', request()->get('fSubCategory'));
                    @endphp @if (in_array($item->id_subcategory, $filterIds))
                    style="color: #ff7400 !important;"
        @endif>
        </i>
        <p class="m-0">{{ $item->name }}</p>
    </div>
    @endforeach
    </div>
@endif
    </div>

    </div>
    <div id="overlay"></div>
    @if ($condition_villa || $condition_hotel)
        {{-- NEW SEARCH MOBILE
        new search ui untuk mobile --}}
        <div class="search-container-mobile">
            {{-- NEW SEARCH MOBILEa
            tombol dipaling atas untuk close atau kembli --}}
            <button class="btn-top-search me-2">
                <i class="fa-solid fa-xmark close"></i>
                <i class="fa-solid fa-angle-left back d-none"></i>
            </button>
            <form onsubmit="event.preventDefault();" autocomplete="off">
                {{-- NEW SEARCH MOBILE
                location untuk mobile --}}
                <div class="location-container mx-2 mt-2">
                    {{-- NEW SEARCH MOBILE
                    ui ketika user belum pilih location untuk mobile
                    berisi input dan location paling populer --}}
                    <div class="select-location-mobile-container">
                        <h3 class="mb-2">{{ __('user_page.Location') }}</h3>
                        <input type="text" onfocus="this.value=''" class="form-control input-transparant d-block"
                            id="loc_sugest" name="sLocation" placeholder="{{ __('user_page.Where are you going?') }}"
                            readonly>
                        <div class="row mt-2 first-sugest-location">
                            <div class="col-4">
                                <img class="d-block w-100 lozad" src="{{ LazyLoad::show() }}"
                                    data-src="https://pix10.agoda.net/hotelImages/931/931511/931511_15082814490035280393.jpg?ca=5&ce=1&s=768x1024">
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Canggu">Canggu</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <img class="d-block w-100 lozad" src="{{ LazyLoad::show() }}"
                                    data-src="https://pix10.agoda.net/hotelImages/71995/-1/090e900e653bb0af941ba8ae8ccc6a77.jpg?ca=11&ce=1&s=1024x768">
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Seminyak">Seminyak</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <img class="d-block w-100 lozad" src="{{ LazyLoad::show() }}"
                                    data-src="https://pix4.agoda.net/hotelimages/412153/-1/d38ca3ce2e65312e961e0b80636510f9.jpg">
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Ubud">Ubud</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- NEW SEARCH MOBILE
                    ui ketika user sudah pilih location untuk mobile --}}
                    <div class="location-has-selected-container d-none">
                        <p class="text-secondary text-small mb-0 loc_sugest_mobile">Location</p>
                        <div class="btn-transparent-action ms-auto">{{ __('user_page.Where are you going?') }}</div>
                    </div>
                    {{-- NEW SEARCH MOBILE
                    popup location untuk mobile --}}
                    <div id="sugest_mobile" class="location-popup w-100 display-none">
                        @php
                            $location = App\Http\Controllers\ViewController::get_location();
                            $hotelName = App\Http\Controllers\HotelController::get_name();
                            $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                            $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                        @endphp
                        <div class="location-popup-container h-100">
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none;">
                                <div onclick="checkGeo();" class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://icon-library.com/images/current-location-icon/current-location-icon-23.jpg">
                                </div>
                                <div onclick="checkGeo();" class="location-popup-text sugest-list-text">
                                    <a id="current_location" type="button" class="location_op" data-value="">Current
                                        Location</a>
                                </div>
                            </div>
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Canggu">Canggu</a>
                                </div>
                            </div>
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Seminyak">Seminyak</a>
                                </div>
                            </div>
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Ubud">Ubud</a>
                                </div>
                            </div>
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Kuta">Kuta</a>
                                </div>
                            </div>
                            <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op" data-value="Pecatu">Pecatu</a>
                                </div>
                            </div>
                            @foreach ($location as $item)
                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                    style="display: none ">
                                    <div class="location-popup-map sugest-list-map">
                                        <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                    </div>
                                    <div class="location-popup-text sugest-list-text">
                                        <a type="button" class="location_op"
                                            data-value="{{ $item->name }}">{{ $item->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($location as $item)
                                <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
                                    <div class="location-popup-map sugest-list-map">
                                        <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}"
                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                    </div>
                                    <div class="location-popup-text sugest-list-text">
                                        <a type="button" class="location_op"
                                            data-value="{{ $item->name }}">{{ $item->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($hotelName as $item2)
                                <div class="col-lg-12 location-popup-desc-container sugest-list"
                                    style="display: none; cursor: pointer;"
                                    onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                    <div class="location-popup-map sugest-list-map">
                                        <img class="location-popup-map-image"
                                            src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                    </div>
                                    <div class="location-popup-text sugest-list-text">
                                        <a href="{{ route('hotel', $item2->id_hotel) }}" type="button"
                                            class="location_op" target="_blank"
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
                                        <a href="{{ route('restaurant', $item3->id_restaurant) }}" type="button"
                                            class="location_op" target="_blank"
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
                                        <a href="{{ route('activity', $item4->id_activity) }}" type="button"
                                            class="location_op" target="_blank"
                                            data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                <p>{{ __('user_page.Location not found') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- NEW SEARCH MOBILE
                date untuk mobile --}}
                <div class="dates-container mx-2 mt-2">
                    {{-- NEW SEARCH MOBILE
                    ui ketika user belum atau sudah pilih date untuk mobile --}}
                    <div class="d-flex collapsible-check-search">
                        <p class="text-secondary text-small mb-0 dates-mobile">When</p>
                        <input type="hidden" id="check_in_mobile" value="" name="sCheck_in">
                        <input type="hidden" id="check_out_mobile" value="" name="sCheck_out">
                        <div class="btn-transparent-action ms-auto">Add Dates</div>
                    </div>
                    {{-- calendar --}}
                    <div class="content sidebar-popup" id="popup_check_search_mobile">
                        <div class="flatpickr" id="inline_reserve_search" style="text-align: left;">
                        </div>
                    </div>
                </div>
                {{-- NEW SEARCH MOBILE
                guests untuk mobile --}}
                <div class="guests-container mx-2 mt-2">
                    {{-- NEW SEARCH MOBILE
                    ui ketika user belum atau sudah pilih guests untuk mobile --}}
                    <div class="d-flex selected-guest-mobile">
                        <p class="text-secondary text-small mb-0 guests-mobile">1 Guests</p>
                        <div class="btn-transparent-action ms-auto">Add Guests</div>
                    </div>
                    {{-- NEW SEARCH MOBILE
                    ui popup guest untuk mobile --}}
                    <div class="guest-popup dropdown-menu">
                        <h5 class="mb-2">Guests</h5>
                        <div class="d-flex mb-2">
                            <div class="guest-type-container flex-fill">
                                <p class="guest-type-title mb-0">
                                    {{ __('user_page.Adults') }}
                                </p>
                                <p class="guest-type-desc mb-0">
                                    {{ __('user_page.Age 13 or above') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a type="button" onclick="adult_decrement_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="adult_mobile" name="sAdult" value="1"
                                        style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                        min="0" readonly>
                                </div>
                                <a type="button" onclick="adult_increment_header_list()"
                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-2">
                            <div class="guest-type-container flex-fill">
                                <p class="guest-type-title mb-0">
                                    {{ __('user_page.Children') }}
                                </p>
                                <p class="guest-type-desc mb-0">
                                    {{ __('user_page.Ages 2–12') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a type="button" onclick="child_decrement_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="child_mobile" name="sChild" value="0"
                                        style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                        min="0" readonly>
                                </div>
                                <a type="button" onclick="child_increment_header_list()"
                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-2">
                            <div class="guest-type-container flex-fill">
                                <p class="guest-type-title mb-0">
                                    {{ __('user_page.Infants') }}
                                </p>
                                <p class="guest-type-desc mb-0">
                                    {{ __('user_page.Under 2') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a type="button" onclick="infant_decrement_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="infant_mobile" name="" value="0"
                                        style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                        min="0" readonly>
                                </div>
                                <a type="button" onclick="infant_increment_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus guests-style" style="padding:0px"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-2">
                            <div class="guest-type-container flex-fill">
                                <p class="guest-type-title mb-0">
                                    {{ __('user_page.Pets') }}
                                </p>
                                <p class="guest-type-desc mb-0">
                                    {{ __('user_page.Service animal ?') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a type="button" onclick="pet_decrement_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="pet_mobile" name="" value="0"
                                        style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                        min="0" readonly>
                                </div>
                                <a type="button" onclick="pet_increment_header_list()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus guests-style" style="padding:0px"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- NEW SEARCH MOBILE
                tombol action dipaling bawah untuk mobile --}}
                <div class="bottom-action-container">
                    <div class="d-flex align-items-center">
                        <div id="clear_date_mobile" class="btn-transparent-action clear-date-mobile d-none">
                            {{ __('user_page.Clear Dates') }}</div>
                        <div class="btn-transparent-action clear-all-mobile">Clear All</div>
                        <div class="btn-company next-mobile ms-auto">Next</div>
                        @if ($condition_villa)
                            <button class="btn-company submit-mobile ms-auto d-none" 
                                onclick="homesFilter({{ request()->get('fPropertyType') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})">
                                Search
                            </button>
                        @endif
                        @if ($condition_hotel)
                            <button class="btn-company submit-mobile ms-auto d-none" 
                            onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }}, false)">
                                Search
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    @endif
    <div id="page-container">
        <!-- Header -->
        <header>
            <div id="new-bar-black" class="page-header-fixed d-flex flex-column {{ $bgColor }} pt-5p">
                @include('layouts.user.header-list')
            </div>

            @if ($condition_villa)
                @php
                    $amenities = App\Models\Amenities::all();
                    $locations = App\Models\Location::all();
                    $property_type = App\Models\PropertyTypeVilla::all();
                    $villa_suitable = App\Models\VillaSuitable::whereIn('id_suitable', ['2'])->get();
                    $villaFacilities = App\Models\Amenities::whereIn('id_amenities', [5, 14, 12, 13])->get();
                @endphp

                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        {{-- <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="prices"
                                    class="dropdown-toggle {{ $listColor }} list-option">
                                    Prices
                                </a>
                                <div class="price-popup dropdown-menu">
                                    <div class="dropdown-pd-0">
                                        <div class="double-slider">
                                            <div class="extra-controls form-inline">
                                                <div class="col-lg-12">
                                                    <p class="price-popup-title">Price</p>
                                                </div>
                                                <div class="form-group col-lg-12 price-popup-display-container">
                                                    <div class="price-popup-display-wrap1">
                                                        <div class="col-lg-12 price-popup-display">
                                                            <label for="min_price" class="price-popup-label">Min</label>
                                                            <input name="fMinPrice[]" type="text"
                                                                class="js-input-from form-control price-popup-label"
                                                                value="0" />
                                                        </div>
                                                    </div>
                                                    <div class="price-popup-display-gap-container">
                                                        <div></div>
                                                    </div>
                                                    <div class="price-popup-display-wrap2">
                                                        <div class="col-lg-12 price-popup-display">
                                                            <label for="max_price" class="price-popup-label">Max</label>
                                                            <input name="fMaxPrice[]" type="text"
                                                                class="js-input-to form-control price-popup-label"
                                                                value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="js-range-slider" value="" />
                                            </div>
                                            <center>
                                                <div style="margin-top: 25px;">
                                                    <button type="submit" class="btn btn-choose"
                                                        style="border-radius:12px; width: 100%; padding: 10px;"
                                                        onclick="villaFilter()">Save</button>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="property"
                                    class="dropdown-toggle {{ $listColor }} list-option">
                                    Property Type
                                </a>
                                <div class="propertytype-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12">
                                                <div class="row">
                                                    @foreach ($property_type as $item)
                                                        @php
                                                            $isChecked = '';
                                                            $propertyIds = explode(',', request()->get('fProperty'));
                                                            if (in_array($item->id_property_type, $propertyIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $item->name }}
                                                                <input type="checkbox" name="fProperty[]"
                                                                    value="{{ $item->id_property_type }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="villaFilter()">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="rooms"
                                    class="dropdown-toggle {{ $listColor }} list-option">
                                    Number of rooms
                                </a>

                                <div class="roomnumber-popup dropdown-menu">
                                    <div class="numberofrooms-input-row">
                                        <div class="col-lg-12">
                                            <p class="roomnumber-input-row {{ $listColor }} list-option">Number of rooms
                                            </p>
                                        </div>

                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Bedrooms</p>
                                                </div>
                                            </div>
                                            <div class="col-6 roomnumberoption-button-container">
                                                <a type="button" onclick="bedroom_decrement()"
                                                    class="roomnumberoption-button-title">
                                                    <i
                                                        class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                </a>
                                                <div class="roomnumber-popup-display-container">
                                                    <input class="roomnumber-popup-display" type="number"
                                                        id="bedroom_number" name="fBedroom[]"
                                                        value="{{ $bedroomCheck }}" min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bedroom_increment()"
                                                    class="roomnumberoption-button-title">
                                                    <i class="fa-solid fa-plus roomnumberoption-button-icon"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Bathrooms</p>
                                                </div>
                                            </div>
                                            <div class="col-6"
                                                style="display: flex; align-items: center; justify-content: end;">
                                                <a type="button" onclick="bathroom_decrement()"
                                                    class="roomnumberoption-button-title">
                                                    <i
                                                        class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                </a>
                                                <div class="roomnumber-popup-display-container">
                                                    <input class="roomnumber-popup-display" type="number"
                                                        id="bathroom_number" name="fBathroom[]"
                                                        value="{{ $bathroomCheck }}" min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bathroom_increment()"
                                                    class="roomnumberoption-button-title">
                                                    <i class="fa-solid fa-plus roomnumberoption-button-icon"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="roomnumber-input-row">
                                            <div class="col-6 vertical-center">
                                                <div class="col-12 roomnumberoption-type-container">
                                                    <p class="roomnumberoption-type-title">Beds</p>
                                                </div>
                                            </div>
                                            <div class="col-6"
                                                style="display: flex; align-items: center; justify-content: end;">
                                                <a type="button" onclick="bed_decrement()"
                                                    class="roomnumberoption-button-title">
                                                    <i
                                                        class="fa-solid fa-minus guests-style roomnumberoption-button-icon"></i>
                                                </a>
                                                <div class="roomnumber-popup-display-container">
                                                    <input class="roomnumber-popup-display" type="number"
                                                        id="bed_number" name="fBeds[]" value="{{ $bedsCheck }}"
                                                        min="0" readonly>
                                                </div>
                                                <a type="button" onclick="bed_increment()"
                                                    class="roomnumberoption-button-title">
                                                    <i class="fa-solid fa-plus"
                                                        class="roomnumberoption-button-icon"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 dropdown-pd-0 text-small">
                                            <button type="submit" class="btn btn-choose roomnumber-popup-button-search"
                                                onclick="villaFilter()">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                @foreach ($villaFacilities as $item)
                                    <div class="cat action cat-gap list-option {{ $listColor }}">
                                        <label>
                                            @php
                                                $isChecked = '';
                                                $facilitiesIds = explode(',', request()->get('fFacilities'));
                                                if (in_array($item->id_amenities, $facilitiesIds)) {
                                                    $isChecked = 'checked';
                                                }
                                            @endphp
                                            <input type="checkbox" onchange="villaFilter()" name="fFacilities[]"
                                                value="{{ $item->id_amenities }}" {{ $isChecked }}><span
                                                class="cat-span font-light list-description">{{ $item->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                @foreach ($villa_suitable as $item2)
                                    <div class="cat action cat-gap list-option {{ $listColor }}">
                                        <label>
                                            @php
                                                $isChecked = '';
                                                $suitableIds = explode(',', request()->get('fSuitable'));
                                                if (in_array($item2->id_suitable, $suitableIds)) {
                                                    $isChecked = 'checked';
                                                }
                                            @endphp
                                            <input type="checkbox" onchange="villaFilter()" name="fSuitable[]"
                                                value="{{ $item2->id_suitable }}" {{ $isChecked }}><span
                                                class="cat-span font-light list-description">{{ $item2->name }}</span>AAA
                                        </label>
                                    </div>
                                @endforeach
                            </li>
                            <li class="cat-gap">
                                <a href="#" id="filters" onclick="filters_click()"
                                    class="{{ $listColor }} list-option"><i class="fa fa-sliders"
                                        aria-hidden="true"></i> Filters</a>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            @endif

            @if ($condition_hotel)
                @php
                    $amenities = App\Models\Amenities::all();
                    $locations = App\Models\Location::all();
                    $property_type = App\Models\PropertyTypeVilla::all();
                    $villa_suitable = App\Models\VillaSuitable::whereIn('id_suitable', ['2'])->get();
                    $villaFacilities = App\Models\Amenities::whereIn('id_amenities', [5, 14, 12, 13])->get();
                @endphp

                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                    </div>
                </div>
            @endif

            @if ($condition_restaurant)
                @php
                    $amenities = App\Models\Amenities::all();
                    $locations = App\Models\Location::all();
                    $types = App\Models\RestaurantType::all();
                    $facilities = App\Models\RestaurantFacilities::all();
                    $meals = App\Models\RestaurantMeal::all();
                    $prices = App\Models\RestaurantPrice::all();
                    $cuisines = App\Models\RestaurantCuisine::all();
                    $dishes = App\Models\RestaurantDishes::all();
                    $dietaryfoods = App\Models\RestaurantDietaryFood::all();
                    $goodfors = App\Models\RestaurantGoodfor::all();
                @endphp
                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        {{-- <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Restaurant Type
                                </a>
                                <div class="restauranttype-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="type-form">
                                                <div class="row">
                                                    @forelse ($types as $type)
                                                        @php
                                                            $isChecked = '';
                                                            $typesIds = explode(',', request()->get('fType'));
                                                            if (in_array($type->id_type, $typesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $type->name }}
                                                                <input type="checkbox" class="type-form-input"
                                                                    name="fType[]" value="{{ $type->id_type }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Rate of Price
                                </a>
                                <div class="rateofprice-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="price-form">
                                                <div class="row">
                                                    @forelse ($prices as $price)
                                                        @php
                                                            $isChecked = '';
                                                            $pricesIds = explode(',', request()->get('fPrice'));
                                                            if (in_array($price->id_price, $pricesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $price->name }}
                                                                <input type="checkbox" class="price-form-input"
                                                                    name="fPrice[]" value="{{ $price->id_price }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Facilities
                                </a>
                                <div class="facilities-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="facilities-form">
                                                <div class="row">
                                                    @forelse ($facilities as $facility)
                                                        @php
                                                            $isChecked = '';
                                                            $facilitiesIds = explode(',', request()->get('fFacilities'));
                                                            if (in_array($facility->id_facilities, $facilitiesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $facility->name }}
                                                                <input type="checkbox" class="facilities-form-input"
                                                                    name="fFacilities[]"
                                                                    value="{{ $facility->id_facilities }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Meal
                                </a>
                                <div class="meal-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="meal-form">
                                                <div class="row">
                                                    @forelse ($meals as $meal)
                                                        @php
                                                            $isChecked = '';
                                                            $mealsIds = explode(',', request()->get('fMeal'));
                                                            if (in_array($meal->id_meal, $mealsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $meal->name }}
                                                                <input type="checkbox" class="meal-form-input"
                                                                    name="fMeal[]" value="{{ $meal->id_meal }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Dishes
                                </a>
                                <div class="dishes-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="dishes-form">
                                                <div class="row">
                                                    @forelse ($dishes as $dish)
                                                        @php
                                                            $isChecked = '';
                                                            $dishesIds = explode(',', request()->get('fDishes'));
                                                            if (in_array($dish->id_dishes, $dishesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $dish->name }}
                                                                <input type="checkbox" class="dishes-form-input"
                                                                    name="fDishes[]" value="{{ $dish->id_dishes }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Dietary Food
                                </a>
                                <div class="dietaryfood-popup dropdown-menu">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="dietaryfood-form">
                                                <div class="row">
                                                    @forelse ($dietaryfoods as $dietaryfood)
                                                        @php
                                                            $isChecked = '';
                                                            $dietaryfoodsIds = explode(',', request()->get('fDietaryfood'));
                                                            if (in_array($dietaryfood->id_dietaryfood, $dietaryfoodsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $dietaryfood->name }}
                                                                <input type="checkbox" class="dietaryfood-form-input"
                                                                    name="fDietaryfood[]"
                                                                    value="{{ $dietaryfood->id_dietaryfood }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Good For
                                </a>
                                <div class="goodfor-popup dropdown-menu">

                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="goodfor-form">
                                                <div class="row">
                                                    @forelse ($goodfors as $goodfor)
                                                        @php
                                                            $isChecked = '';
                                                            $goodforsIds = explode(',', request()->get('fGoodfor'));
                                                            if (in_array($goodfor->id_goodfor, $goodforsIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $goodfor->name }}
                                                                <input type="checkbox" class="goodfor-form-input"
                                                                    name="fGoodfor[]"
                                                                    value="{{ $goodfor->id_goodfor }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-choose"
                                                style="border-radius:12px; width: 100%; padding: 10px;"
                                                onclick="restaurantFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            @endif

            @if ($condition_things_to_do)
                @php
                    $amenities = App\Models\Amenities::all();
                    $locations = App\Models\Location::all();
                    $facilities = App\Models\ActivityFacilities::all();
                    $categories = App\Models\ActivityCategory::all();
                    $subCategory = App\Models\ActivitySubcategory::all();
                @endphp
                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        {{-- <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Category
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 340px !important;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="category-form">
                                                <div class="row">
                                                    @forelse ($categories as $category)
                                                        @php
                                                            $isChecked = '';
                                                            $categoryIds = explode(',', request()->get('fCategory'));
                                                            if (in_array($category->id_category, $categoryIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3"
                                                            id="category-form-input{{ $category->id_category }}">
                                                            <label class="checkdesign"
                                                                for="{{ $category->id_category }}">{{ $category->name }}
                                                                <input type="checkbox" class="category-form-input"
                                                                    name="fCategory[]"
                                                                    id="{{ $category->id_category }}"
                                                                    value="{{ $category->id_category }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Time of Day
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 455px !important;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="timeofday-form">
                                                <div class="row">
                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('morning', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Morning
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="morning"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>

                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('afternoon', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Afternoon
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="afternoon"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>

                                                    @php
                                                        $isChecked = '';
                                                        $timeofdayIds = explode(',', request()->get('fTimeofday'));
                                                        if (in_array('evening', $timeofdayIds)) {
                                                            $isChecked = 'checked';
                                                        }
                                                    @endphp
                                                    <div class="col-6 mb-3" id="timeofday-form-input">
                                                        <label class="checkdesign">Evening
                                                            <input type="checkbox" class="timeofday-form-input"
                                                                name="fTimeofday[]" value="evening"
                                                                {{ $isChecked }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" class="dropdown-toggle list-option {{ $listColor }}">
                                    Facilities
                                </a>
                                <div class="propertytype-popup dropdown-menu" style="left: 570px;">
                                    <div>
                                        <div class="propertytype-input-row">
                                            <div class="col-12" id="facilities-form">
                                                <div class="row">
                                                    @forelse ($facilities as $facility)
                                                        @php
                                                            $isChecked = '';
                                                            $facilitiesIds = explode(',', request()->get('fFacilities'));
                                                            if (in_array($facility->id_facilities, $facilitiesIds)) {
                                                                $isChecked = 'checked';
                                                            }
                                                        @endphp
                                                        <div class="col-6 mb-3">
                                                            <label class="checkdesign">{{ $facility->name }}
                                                                <input type="checkbox" class="facilities-form-input"
                                                                    name="fFacilities[]"
                                                                    value="{{ $facility->id_facilities }}"
                                                                    {{ $isChecked }}>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                    <input type="submit" onclick="activityFilter()"
                                                        class="btn btn-choose roomnumber-popup-button-search"
                                                        value="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            @endif

            @if ($condition_collaborator)
                <div class="row row-cat-container">
                    <div id="myBtnContainer" class="menu col-12">
                        {{-- <ul class="cat-container">
                            <li class="button-dropdown cat-margin-0 cat-gap">
                                <a href="javascript:void(0)" id="prices"
                                    class="dropdown-toggle {{ $listColor }} list-option">
                                    Prices
                                </a>
                                <div class="price-popup dropdown-menu" style="left: 520px;">
                                    <div class="dropdown-pd-0">
                                        <div class="double-slider">
                                            <div class="extra-controls form-inline">
                                                <div class="col-lg-12">
                                                    <p class="price-popup-title">{{ Translate::translate('Price') }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-lg-12 price-popup-display-container">
                                                    <div class="price-popup-display-wrap1">
                                                        <div class="col-lg-12 price-popup-display">
                                                            <label for="min_price"
                                                                class="price-popup-label">Min</label>
                                                            <input name="fMinPrice[]" type="text"
                                                                class="js-input-from form-control price-popup-label"
                                                                value="0" />
                                                        </div>
                                                    </div>
                                                    <div class="price-popup-display-gap-container">
                                                        <div></div>
                                                    </div>
                                                    <div class="price-popup-display-wrap2">
                                                        <div class="col-lg-12 price-popup-display">
                                                            <label for="max_price"
                                                                class="price-popup-label">Max</label>
                                                            <input name="fMaxPrice[]" type="text"
                                                                class="js-input-to form-control price-popup-label"
                                                                value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="js-range-slider" value="" />
                                            </div>
                                            <center>
                                                <div style="margin-top: 25px;">
                                                    <button type="submit" class="btn btn-choose"
                                                        style="border-radius:12px; width: 100%; padding: 10px;">{{ Translate::translate('Save') }}</button>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            @endif
    </div>
    </header>
    <!-- END Header Content -->

    <!-- Main Container -->
    <main id="main-container" class="{{ $bgColor }}">

        @yield('content')

    </main>
    <!-- END Main Container -->

    </div>
    </div>
    </div>
    </div>
    @include('user.modal.filter.filter_modal')
    <!-- Footer -->
    @if (Route::is('list') || Route::is('search_villa_combine'))
        @include('user.modal.filter.filter_modal')
    @endif

    @if (Route::is('hotel_list'))
        @include('user.modal.filter.filter_modal_hotel')
    @endif

    @include('layouts.user.footer')
    <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <script src="{{ asset('assets/js/skeleton.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script> -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <style>
        .flat-margin {
            margin-top: 30px;
        }
    </style>

    <script>
        var check_in_val = $('#check_in2').val();
        var check_out_val = $('#check_out2').val();
        $("#dates").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            defaultDate: [check_in_val, check_out_val],
            onReady(_, __, fp) {
                fp.calendarContainer.classList.add("flat-margin");
            },
            onChange: function(selectedDates, dateStr, instance) {
                $('#dates').val("");
                $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
                $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"))
            }
        });
        $('#dates').val("");
    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <script src="{{ asset('assets/js/list-villa.js') }}"></script>

    <script>
        $("#searchbox").click(function() {
            $("#search_bar").toggleClass("active");
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".list-menu-slider").slick({
                rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay: false,
                autoplaySpeed: 5000, //  Slide Delay
                speed: 800, // Transition Speed
                variableWidth: false,
                slidesToShow: 7, // Number Of Carousel
                slidesToScroll: 3, // Slide To Move
                pauseOnHover: false,
                // appendArrows:$(".Arrows"), // Class For Arrows Buttons
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
            $(".js-slider-2").slick({
                rtl: false,
                autoplay: false,
                autoplaySpeed: 5000,
                speed: 800,
                slidesToShow: 1,
                slidesToScroll: 1,
                variableWidth: true,
                pauseOnHover: false,
                easing: "linear",
                arrows: true
            });
        })
    </script>

    <script src="{{ asset('assets/js/price-range.js') }}"></script>
    <script src='https://kenwheeler.github.io/slick/slick/slick.js'></script>

    <script>
        function sidebarhide() {
            $("body").css({
                "height": "auto",
                "overflow": "auto"
            })
            $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
            $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
            $(".expand-navbar-mobile").attr("aria-expanded", "false");
            $("#overlay").css("display", "none");
        }

        function moreCategory() {
            sidebarhide();
            $('#categoryModal').modal('show');
            $('#categoryModal').css("overflow-y", "hidden")

            // close sidebar di mobile size
            $( ".btn-close-expand-navbar-mobile" ).trigger( "click" )

            // close searchbar di mobile size
            $( "#bodyList #overlay" ).trigger( "click" )
        }

        function moreSubCategory() {
            sidebarhide();
            $('.modal').modal('hide');
            $('#modalSubCategory').modal('show');
            $('#modalSubCategory').css("overflow-y", "hidden")

            // close sidebar di mobile size
            $( ".btn-close-expand-navbar-mobile" ).trigger( "click" )

            // close searchbar di mobile size
            $( "#bodyList #overlay" ).trigger( "click" )
        }

        function modalFiltersHomes() {
            sidebarhide();
            $('.modal').modal('hide');
            $('#modalFiltersHome').modal('show');
            $('#modalFiltersHome').css("overflow-y", "hidden")

            // close sidebar di mobile size
            $( ".btn-close-expand-navbar-mobile" ).trigger( "click" )

            // close searchbar di mobile size
            $( "#bodyList #overlay" ).trigger( "click" )
        }

        function modalFiltersHotel() {
            $('.modal').modal('hide');
            $('#modalFiltersHotel').modal('show');
            $('#modalFiltersHotel').css("overflow-y", "hidden")

           // close sidebar di mobile size
           $( ".btn-close-expand-navbar-mobile" ).trigger( "click" )

            // close searchbar di mobile size
            $( "#bodyList #overlay" ).trigger( "click" )
        }

        function filterCollab() {
            $('.modal').modal('hide');
            $('#modalFiltersCollab').modal('show');
            $('#modalFiltersCollab').css("overflow-y", "hidden")

           // close sidebar di mobile size
           $( ".btn-close-expand-navbar-mobile" ).trigger( "click" )

            // close searchbar di mobile size
            $( "#bodyList #overlay" ).trigger( "click" )
        }

        // fix bug scroll ketika open sidebar dan open modal subcategory di mobile size
        // $('#categoryModal, #modalSubCategory, #modalFiltersHome, #modalFiltersHotel, #modalFiltersCollab').on('hidden.bs.modal', function (e) {
        //     $('html').css("overflow-y", "")
        // })
    </script>

    <script>
        $("input[name='fViews[]']").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                if ($box.is(":checked")) {
                    $box.prop("checked", false);
                }
                $box.prop("checked", false);
            }
        });

        $("input[name='sCuisine[]']").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>

    <script>
        var input = document.getElementById("loc_sugest");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchBtn").click();
            }
        });

        var input2 = document.getElementById("keyword");
        input2.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchBtn").click();
            }
        });

        var input3 = document.getElementById("idCuisine");
        input3.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchBtn").click();
            }
        });

        var input4 = document.getElementById("bodyList");
        input4.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchBtn").click();
            }
        });
    </script>

    <script>
        var socialFloat = document.querySelector('#view-map-button-float');
        var footer = document.querySelector('#footer');

        function checkOffset() {
            function getRectTop(el) {
                var rect = el.getBoundingClientRect();
                return rect.top;
            }

            if ((getRectTop(socialFloat) + document.body.scrollTop) + socialFloat.offsetHeight >= (getRectTop(footer) +
                    document.body.scrollTop) - 10)
                socialFloat.style.position = 'absolute',
                socialFloat.style.bottom = '0px';
            if (document.body.scrollTop + window.innerHeight < (getRectTop(footer) + document.body.scrollTop))
                socialFloat.style.position = 'fixed', // restore when you scroll up
                socialFloat.style.bottom = '34px';

            // socialFloat.innerHTML = document.body.scrollTop + window.innerHeight;
        }

        document.addEventListener("scroll", function() {
            checkOffset();
        });
    </script>

    <script>
        function calendar_wow(months) {
            if (!$("#start_date").val()) {
                var check_in_val = "";
            } else {
                var check_in_val = $("#start_date").val();
            }

            if (!$("#end_date").val()) {
                var check_out_val = "";
            } else {
                var check_out_val = $("#end_date").val();
            }
            $('#date_wow').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                inline: true,
                mode: "range",
                defaultDate: [check_in_val, check_out_val],
                showMonths: months,
                onChange: function(selectedDates, dateStr, instance) {
                    // $('#date_things').val(flatpickr.formatDate("Y-m-d"));
                    let from = instance.formatDate(selectedDates[0], "Y-m-d");
                    let to = instance.formatDate(selectedDates[1], "Y-m-d");
                    $('#start_date').val(from);
                    $('#end_date').val(to);
                    let content = document.getElementById("popup_wow");
                    content.style.display = "none";
                    document.getElementById('add_date_wow').style.display = "none";
                }
            });
        }
        calendar_wow(2);
    </script>

    <script>
        // NEW SEARCH MOBILE
        window.countMonthsMobile = 3;

        function calendarSearch(months) {
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
                onReady: function(selectedDates, dateStr, instance) {
                    // NEW SEARCH MOBILE
                    // Meredesign calendar untuk mobile
                    if (window.innerWidth <= 649) {
                        var indexMonth = instance.currentMonth;
                        var year = instance.currentYear;
                        $(".dayContainer").each(function(i, curr) {
                            var month = instance.l10n.months.longhand[indexMonth];
                            $(this).before("<h5 class='text-start'>" + month + " " + year + "</h5>");
                            if (indexMonth == 11) {
                                indexMonth = 0;
                                year++;
                            } else {
                                indexMonth++;
                            }
                        });
                        $(".flatpickr-weekdaycontainer").addClass("d-none");
                        $(".flatpickr-weekdaycontainer:first-child").removeClass("d-none");
                        $(".flatpickr-days").append(
                            "<button class='btn-company btn-load-more-calendar-mobile' style='border: none;'>Load More</button>"
                        );
                        $(".btn-load-more-calendar-mobile").on("click", function() {
                            window.countMonthsMobile += 3;
                            calendarSearch(window.countMonthsMobile);
                        });
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    $("#check_in2").val(instance.formatDate(selectedDates[0], "Y-m-d"));
                    $(".search-container-mobile .dates-mobile").html(instance.formatDate(selectedDates[0],
                        "Y-m-d"));
                    if (selectedDates.length > 1) {
                        $("#check_out2").val(
                            instance.formatDate(selectedDates[1], "Y-m-d")
                        );
                        // NEW SEARCH MOBILE
                        // fungsi untuk isi date di mobile
                        $(".search-container-mobile .dates-mobile").html(
                            instance.formatDate(selectedDates[0], "Y-m-d") +
                            " to " +
                            instance.formatDate(selectedDates[1], "Y-m-d")
                        );
                        $("#check_in_mobile").val(instance.formatDate(selectedDates[0], "Y-m-d"));
                        $("#check_out_mobile").val(instance.formatDate(selectedDates[1], "Y-m-d"));
                        // NEW SEARCH MOBILE
                        // fungsi untuk mengubah tombol dibawah jadi next ketika sudah selesai milih
                        $(".search-container-mobile .next-mobile").html("Next");
                    }
                    // NEW SEARCH MOBILE
                    // fungsi untuk menutup calendar ketika sudah selesai milih hanya berlaku ketika bukan dimobile
                    if (window.innerWidth > 649) {
                        let content = document.getElementById("popup_check_search_mobile");
                        content.style.display = "none";
                    }
                    // NEW SEARCH MOBILE
                    // Meredesign calendar mobile
                    if (window.innerWidth <= 649) {
                        var indexMonth = instance.currentMonth;
                        var year = instance.currentYear;
                        $(".dayContainer").each(function(i, curr) {
                            var month = instance.l10n.months.longhand[indexMonth];
                            $(this).before("<h5 class='text-start'>" + month + " " + year + "</h5>");
                            if (indexMonth == 11) {
                                indexMonth = 0;
                                year++;
                            } else {
                                indexMonth++;
                            }
                        });
                        $(".flatpickr-weekdaycontainer").addClass("d-none");
                        $(".flatpickr-weekdaycontainer:first-child").removeClass("d-none");
                        $(".flatpickr-days").append(
                            "<button class='btn-company btn-load-more-calendar-mobile' style='border: none;'>Load More</button>"
                        );
                        $(".btn-load-more-calendar-mobile").on("click", function() {
                            window.countMonthsMobile += 3;
                            calendarSearch(window.countMonthsMobile);
                        });
                    }
                }
            });
        }
        calendarSearch(2);

        function calendarSearchDesktop(months) {
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
            $("#inline_reserve_search_desktop").flatpickr({
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
                    $("#check_out2").val(instance.formatDate(selectedDates[1], "Y-m-d"));
                    $("#check_in_mobile").val(instance.formatDate(selectedDates[0], "Y-m-d"));
                    $("#check_out_mobile").val(instance.formatDate(selectedDates[1], "Y-m-d"));
                    $('.dates-mobile').html(
                        instance.formatDate(selectedDates[0], "Y-m-d") +
                        " to " +
                        instance.formatDate(selectedDates[1], "Y-m-d")
                    );

                    let content = document.getElementById("popup_check_search_desktop");
                    content.style.display = "none";
                },
            });
        }
        calendarSearchDesktop(2);
    </script>

    <script>
        $(document).ready(() => {
            var mode = localStorage.getItem("mode");
            if (mode == 'dark') {
                $('.slick-list').removeClass('box-shadow-light')
                $('.slick-list').addClass('box-shadow-dark')

                $('.page-link').removeClass('font-black')
                $('.page-link').addClass('font-light')
            } else {
                $('.slick-list').removeClass('box-shadow-dark')
                $('.slick-list').addClass('box-shadow-light')

                $('.page-link').removeClass('font-light')
                $('.page-link').addClass('font-black')
            }
        });

        // close sidebar menu in dekstop size
        $(window).resize(function() {
            if ($(document).width() > 991) {
                $('.btn-close-expand-navbar-mobile').click()
            }
        })
    </script>

    {{-- LAZY LOAD --}}
    @include('components.lazy-load.lazy-load')
    {{-- END LAZY LOAD --}}

    @yield('scripts')
</body>

</html>
