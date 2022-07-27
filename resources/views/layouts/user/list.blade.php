<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

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
        .subcategory-in-sidebar{
            border: 1px solid #ccc;
            border-radius:4px;
            margin:6px;
            gap:6px;
            padding-left:1rem;
            display:flex;
        }
        .subcategory-in-sidebar:hover{
            cursor:pointer;
        }
        .subcategory-in-sidebar-container > *,
        .subcategory-in-sidebar > *{
            color:#585656;
        }

        .subcategory-in-sidebar i{
            width:30px;
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
                        <a class="d-block mb-2" href="{{ route('partner_dashboard') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Dashboard') }}
                        </a>
                    @endif
                    @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                        <a class="d-block mb-2" href="{{ route('collaborator_list') }}"
                            style="width: fit-content; color:#585656;">
                            {{ __('user_page.Collab Portal') }}
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
                    <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">

                            </div>
                        </a>
                    </div>
                    <div class="d-flex align-items mb-2" id="changeThemeMobile">
                        <div class="logged-user-menu">
                            <label class="container-mode {{ $condition_collaborator ? 'container-mode-collab' : '' }} ">
                                <input type="checkbox" id="background-color-switch"
                                    onclick="changeBackgroundTrigger(this)"
                                    {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                                <div class="checkmark-mode"></div>
                            </label>
                        </div>
                        <p class="mb-0 ms-2" id="switcher" style="cursor: pointer; color: #585656;">Day / Night </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                            style="color: white;">

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

                </div>
            @else
                <div class="d-flex align-items-center">
                    <div class="flex-fill d-flex align-items-center">
                        <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap d-flex align-items-center"
                            style="margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
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
                <a href="{{ route('ahost') }}" class="navbar-gap d-block mb-3"
                    style="color: #585656; width: fit-content;" target="_blank">
                    {{ __('user_page.Become a host') }}
                </a>
                <div class="d-flex align-items-center mb-2">
                    <a type="button" onclick="language()" class="navbar-gap d-blok d-flex align-items-center"
                        style="color: white; " id="language">
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
                <div class="d-flex align-items-center mb-2" id="changeThemeMobile">
                    <div class="logged-user-menu" style="">
                        <label class="container-mode {{ $condition_collaborator ? 'container-mode-collab' : '' }}">
                            <input type="checkbox" id="background-color-switch" onclick="changeBackgroundTrigger(this)"
                                {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                            <span class="checkmark-mode"></span>
                        </label>
                    </div>
                    <p class="mb-0 ms-2" id="switcher" style="cursor: pointer; color: #585656;">Day / Night </p>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                        style="color: white;">

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

            <hr>
            @if($condition_villa)
                <div class="subcategory-in-sidebar-container ">
                    <p class="m-0">Choose Sub Category</p>
                    <div class="mt-2">
                        @foreach ($amenities->sortBy('order')->take(4) as $item)
                            <div class="subcategory-in-sidebar py-2" onclick="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_amenities }})">
                                <i class="fas fa-{{ $item->icon }}"
                                    @php
                                        $amenitiesIds = explode(',', request()->get('fAmenities'));
                                    @endphp 
                                    @if (in_array($item->id_amenities, $amenitiesIds)) style="color: #ff7400;"@endif>
                                </i>
                                <p class="m-0">{{ $item->name }}</p>
                            </div>
                        @endforeach
                        <div class="subcategory-in-sidebar py-2" onclick="modalFiltersHomes()">
                            <i class="fas fa-ellipsis"></i>
                            <p class="m-0">Filters</p>
                        </div>
                    </div>
                </div>
            @elseif($condition_restaurant)
                <div class="subcategory-in-sidebar-container ">
                    <p class="m-0">Choose Sub Category</p>
                    <div class="mt-2">
                        @foreach ($subcategories->take(4) as $item)
                            <div class="subcategory-in-sidebar py-2"onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ $item->id_subcategory }}, false)">
                                <i class="{{ $item->icon }}"
                                    @php
                                        $isChecked = '';
                                        $filterIds = explode(',', request()->get('fSubCategory'));
                                    @endphp @if (in_array($item->id_subcategory, $filterIds)) style="color: #ff7400 !important;"@endif>
                                </i>
                                <p class="m-0">{{ $item->name }}</p>
                            </div>
                        @endforeach
                        <div class="subcategory-in-sidebar py-2" onclick="moreSubCategory()">
                            <i class="fa-solid fa-ellipsis"></i>
                            <p class="m-0">{{ __('user_page.More') }}</p>
                        </div>
                    </div>
                </div>
            @elseif($condition_hotel)
                <div class="subcategory-in-sidebar-container">
                    <p class="m-0">Choose Sub Category</p>
                    @foreach ($hotelFilter->take(4)->sortBy('order') as $item)
                        <div class="subcategory-in-sidebar py-2" onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_hotel_filter }}, false)">
                            <i class="{{ $item->icon }}"
                                @php
                                    $isChecked = '';
                                    $filterIds = explode(',', request()->get('filter'));
                                @endphp @if (in_array($item->id_hotel_filter, $filterIds))style="color: #ff7400 !important;"@endif>
                            </i>
                            <p class="m-0">{{ $item->name }}</p>
                        </div>
                    @endforeach
                    <div class="subcategory-in-sidebar py-2" onclick="modalFiltersHotel()">
                        <i class="fa-solid fa-ellipsis"></i>
                        <p class="m-0">{{ __('user_page.Filters') }}</p>
                    </div>
                </div>

            @elseif($condition_things_to_do)
                <div class="subcategory-in-sidebar-container">
                    <p class="m-0">Choose Sub Category</p>
                    @foreach ($subCategoryAll->take(4) as $item)
                        <div class="subcategory-in-sidebar py-2" onclick="wowFilter({{ $item->id_category }}, {{ $item->id_subcategory }}, null, false)">
                            <i class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                                @php
                                    $isChecked = '';
                                    $filterIds = explode(',', request()->get('fSubCategory'));
                                @endphp @if (in_array($item->id_subcategory, $filterIds))
                                style="color: #ff7400 !important;"@endif>
                            </i>
                            <p class="m-0">{{ $item->name }}</p>
                        </div>
                    @endforeach
                    @if ($subCategoryAll->count() > 6)
                        <div class="subcategory-in-sidebar py-2" onclick="moreSubCategory()">
                            <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                            <p class="m-0">{{ __('user_page.More') }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

    </div>
    <div id="overlay"></div>
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
        function moreCategory() {
            $('#categoryModal').modal('show');
        }

        function moreSubCategory() {
            $('#modalSubCategory').modal('show');
        }

        function modalFiltersHomes() {
            $('#modalFiltersHome').modal('show');
        }

        function modalFiltersHotel() {
            $('#modalFiltersHotel').modal('show');
        }

        function filterCollab() {
            $('#modalFiltersCollab').modal('show');
        }

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
        $(window).resize(function(){
            if($(document).width() > 991){ 
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
