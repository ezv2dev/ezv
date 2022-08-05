<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ $restaurant->name }} - EZV2</title>
    <meta name="description" content="EZV2 ">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="EZV2">
    <meta property="og:description" content="EZV2 ">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    {{-- DROPZONE --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    {{-- END DROPZONE --}}

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>

    <!-- END Icons -->

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/villa-slider.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-restaurant.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/simpleLightbox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>
    <script src="{{ asset('assets/js/errorToString.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/iziToast/iziToast.min.css') }}">
    <script src="{{ asset('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>
</head>

<body style="background-color:white">

    <div id="untukDelete"
        style="
    background: #00000040;
    width: 100%;
    position: fixed;
    height: 100%;
    z-index: 999;
    display: none;">
    </div>

    @php
        $condition_villa = Route::is('villa');
        $condition_restaurant = Route::is('restaurant');
        $condition_hotel = Route::is('hotel') || Route::is('room_hotel');
        $condition_things_to_do = Route::is('activity') || Route::is('activity_price_index');

        if (isset($_COOKIE['sCheck_in'])) {
            $get_check_in = $_COOKIE['sCheck_in'];
            $get_check_out = $_COOKIE['sCheck_out'];
        } else {
            $get_check_in = null;
            $get_check_out = null;
        }

        function dateDiff($get_check_in, $get_check_out)
        {
            $date1_ts = strtotime($get_check_in);
            $date2_ts = strtotime($get_check_out);
            $datediff = $date2_ts - $date1_ts;

            return round($datediff / (60 * 60 * 24));
        }

        $dateDiffe = dateDiff($get_check_in, $get_check_out);
    @endphp

    @include('components.notification.notification')
    @component('components.loading.loading-type1')
    @endcomponent
    {{-- <input type="hidden" id="min_stay" name="min_stay" value="{{ $restaurant->min_stay }}">
    <input type="hidden" id="price" name="price" value="{{ $restaurant->price }}">
    <input type="hidden" id="price3" name="price" value="{{ $restaurant->price }}"> --}}
    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}

        {{-- STICKY BOTTOM FOR MOBILE --}}
        <div id="bottom-mobile" class="sticky-bottom-mobile d-xs-block d-md-none">
            <a onclick="contact_restaurant()" type="button" class="rsv-btn-button">
                {{ __('user_page.CONTACT') }}
            </a>
        </div>
        {{-- END STICKY BOTTOM FOR MOBILE --}}

        <div class="expand-navbar-mobile" aria-expanded="false">
            <div class="px-3 pt-2">
                @auth
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="flex-fill d-flex align-items-center me-3">
                                @if (Auth::user()->avatar)
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                        style="border-radius: 50%; width: 50px; border: solid 2px #ff7400;">
                                @else
                                    <img src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                        style="width: 40px; height: 40px; border-radius: 50%;" alt="">
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
                            <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                                style="color: white;">
                                <img class="lozad"
                                    style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;"
                                    src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">
                                @if (session()->has('currency'))
                                    <p class="mb-0 ms-2" style="color: #585656">Change Currency
                                        ({{ session('currency') }})
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
                            <a onclick="loginRegisterForm(2, 'login');" class="btn btn-fill border-0 navbar-gap d-flex align-items-center"
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
                            style="color: white; margin-right: 9px;" id="language">
                            @if (session()->has('locale'))
                                <img style="border-radius: 3px; width: 27px;" class="lozad"
                                    src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                                <img style="border-radius: 3px; width: 27px;" class="lozad"
                                    src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                            <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                            style="color: white;">
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
                @endauth
            </div>

        </div>
        <div id="overlay"></div>
        {{-- PROFILE --}}
        <div class="row page-content">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block">

                <div class="row top-profile px-xs-12p px-sm-24p" id="first-detail-content">
                    <div class="col-lg-4 col-md-4 col-xs-12 pd-0">
                        <div class="profile-image">
                            @if ($restaurant->image)
                                <img id="imageProfileRestaurant" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}">
                            @else
                                <img id="imageProfileRestaurant" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_restaurant_profile()"
                                        class="edit-profile-image-btn-dekstop"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Image Profile') }}</a>
                                    {{-- @if ($restaurant->image)
                                        <a class="delete-profile edit-profile-image-btn-dekstop" href="javascript:void(0);"
                                            onclick="delete_profile_image({'id': '{{ $restaurant->id_restaurant }}'})">
                                            <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom"
                                                title="{{ __('user_page.Delete') }}"></i></a>
                                    @endif --}}
                                @endif
                            @endauth
                            <div class="date-contact-dekstop">
                                {{-- OPEN CLOSED TIME --}}
                                <p style="font-size: 12px;" id="time-content">
                                    @php
                                        $open = date_create($restaurant->open_time);
                                        $closed = date_create($restaurant->closed_time);
                                    @endphp
                                    <span id="timeRestaurantContent">{{ date_format($open, 'h:i A') }} -
                                        {{ date_format($closed, 'h:i A') }}</span>
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="editTimeForm()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Open Hours') }}</a>
                                        @endif
                                    @endauth
                                </p>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="time-form" style="display:none;">
                                            <form action="javascript:void(0);" method="post">
                                                {{-- @csrf
                                                @method('PATCH') --}}
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center edit-time">
                                                    <div class="col-auto">
                                                        <input type="time" name="open_time" class="form-control"
                                                            id="open-time-input" value="{{ $restaurant->open_time }}"
                                                            required>
                                                    </div>
                                                    <span class="mx-2">-</span>
                                                    <div class="col-auto">
                                                        <input type="time" name="closed_time" class="form-control"
                                                            id="close-time-input" value="{{ $restaurant->closed_time }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        id="btnSaveTimeResto" onclick="saveTimeRestaurant();">
                                                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        id="btnCancelTimeResto" onclick="editTimeFormCancel()">
                                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- END OPEN CLOSED TIME --}}
                                {{-- CONTACT --}}
                                <div class="col-12" id="fix-contact-m"
                                    style="display: flex; padding-right: 70px; justify-content: center; padding-left: 70px; margin-top: 18px;">
                                    <div style="padding: 0px 6px;">
                                        <a onclick="contact_restaurant()" type="button">
                                            <i class="fa-solid fa-phone"></i>
                                        </a>
                                    </div>
                                    <div style="padding: 0px 6px;" id="contentEmailResto">
                                        @if ($restaurant->email)
                                            <a id="btnEmailResto" target="_blank" type="button"
                                                href="mailto:{{ $restaurant->email }}">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                        @else
                                            <a type="button" href="javascript:void(0);">
                                                <i class="fa-solid fa-envelope text-secondary"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <a type="button" onclick="edit_contact()"
                                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Contact') }}</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                {{-- END CONTACT --}}
                                {{-- RESTAURANT TYPE --}}
                                <div class="col-12" style=" margin-top: 18px;" id="type-content">
                                    <p style="font-size: 12px">
                                        <span id="type_price_content">
                                            <span data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom"
                                                title="{{ $restaurant->type->name }}">{{ $restaurant->type->name }}</span>
                                            <span> - </span>
                                            @if ($restaurant->price->name == 'Cheap Prices')
                                                <span style="color: #FF7400" data-bs-toggle="popover"
                                                    data-bs-animation="true" data-bs-placement="bottom"
                                                    title="{{ Translate::translate($restaurant->price->name) }}">$</span>
                                            @elseif ($restaurant->price->name == 'Middle Range')
                                                <span style="color: #FF7400" data-bs-toggle="popover"
                                                    data-bs-animation="true" data-bs-placement="bottom"
                                                    title="{{ Translate::translate($restaurant->price->name) }}">$$</span>
                                            @elseif ($restaurant->price->name == 'Fine Dining')
                                                <span style="color: #FF7400" data-bs-toggle="popover"
                                                    data-bs-animation="true" data-bs-placement="bottom"
                                                    title="{{ Translate::translate($restaurant->price->name) }}">$$$</span>
                                            @else
                                                <span>{{ __('user_page.no price rate yet') }}</span>
                                            @endif
                                        </span>

                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <a type="button" onclick="editTypeForm()"
                                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Price Range') }}</a>
                                            @endif
                                        @endauth
                                    </p>

                                </div>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="type-form" style="display: none">
                                            {{-- <form action="{{ route('restaurant_update_type') }}" method="post"> --}}
                                            <form action="javascript:void(0);" method="post">
                                                {{-- @csrf
                                                @method('PATCH') --}}
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center range-edit-price">
                                                    <div class="col-auto">
                                                        <select name="id_type" id="restaurant-type-input"
                                                            class="form-control">
                                                            @forelse ($restaurant_type as $item)
                                                                @php
                                                                    $isSelected = '';
                                                                    if ($item->id_type == $restaurant->id_type) {
                                                                        $isSelected = 'selected';
                                                                    }
                                                                @endphp
                                                                <option value="{{ $item->id_type }}" {{ $isSelected }}>
                                                                    {{ $item->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <span class="mx-2">-</span>
                                                    <div class="col-auto">
                                                        <select name="id_price" id="restaurant-price-input"
                                                            class="form-control">
                                                            @forelse ($restaurant_price as $item)
                                                                @php
                                                                    $isSelected = '';
                                                                    if ($item->id_price == $restaurant->id_price) {
                                                                        $isSelected = 'selected';
                                                                    }
                                                                @endphp
                                                                <option value="{{ $item->id_price }}"
                                                                    {{ $isSelected }}>{{ $item->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        id="btnSaveRestoTime" onclick="saveRestaurantPrice();">
                                                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        id="btnCancelRestoTime" onclick="editTypeFormCancel()">
                                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- END RESTAURANT TYPE --}}
                            </div>
                            {{-- SHORT NAME FOR MOBILE --}}
                            <div class="name-content-mobile ms-3 d-md-none">
                                <h2 id="name-content-mobile">{{ $restaurant->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12 profile-info">
                        {{-- SHORT NAME --}}
                        <h2 id="name-content">
                            <span
                                id="name-content2">{{ $restaurant->name ?? __('user_page.There is no name yet') }}</span>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Name') }}</a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}"
                                        required>
                                    <textarea class="form-control" style="width: 100%;" name="name" id="name-form-input" cols="30"
                                        rows="3" maxlength="55" placeholder="{{ __('user_page.Food Name Here') }}">{{ $restaurant->name }}</textarea>
                                    <small id="err-name" style="display: none;"
                                        class="invalid-feedback">{{ __('auth.empty_name') }}</small><br>
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSaveRestaurant"
                                        onclick="saveNameRestaurant();" style="background-color: #ff7400">
                                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                    </button>
                                    <button type="reset" class="btn btn-sm btn-secondary" onclick="editNameCancel()">
                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                    </button>

                                </div>
                            @endif
                        @endauth
                        {{-- END SHORT NAME --}}

                        {{-- EDIT PROFILE IMAGE AND NAME CONTENT MOBILE --}}
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="edit_restaurant_profile()"
                                    class="edit-profile-image-btn-mobile d-md-none"
                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Image Profile') }} |</a>
                                <a type="button" onclick="editNameForm()" class="edit-profile-name-btn-mobile d-md-none"
                                    style="color:#FF7400; font-weight: 600; font-size: 10pt;">
                                    {{ __('user_page.Edit Name') }}
                                </a>
                                {{-- @if ($restaurant->image)
                                    <a class="delete-profile edit-profile-image-btn-mobile d-md-none" href="javascript:void(0);"
                                        onclick="delete_profile_image({'id': '{{ $restaurant->id_restaurant }}'})">
                                        <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                            data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom"
                                            title="{{ __('user_page.Delete') }}"></i></a>
                                @endif --}}
                            @endif
                        @endauth
                        {{-- END EDIT PROFILE IMAGE AND NAME CONTENT MOBILE --}}

                        {{-- DATE CONTACT FOR MOBILE --}}
                        <div class="date-contact-mobile w-100 d-md-none">
                            <p style="font-size: 12px;" id="time-content-mobile">
                                @php
                                    $open = date_create($restaurant->open_time);
                                    $closed = date_create($restaurant->closed_time);
                                @endphp
                                {{ date_format($open, 'h:i A') }} - {{ date_format($closed, 'h:i A') }}
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a type="button" onclick="editTimeFormMobile()"
                                            style="color:#FF7400; font-weight: 600;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="time-form-mobile" style="display:none;">
                                        <form action="{{ route('restaurant_update_time') }}" method="post">
                                            <!-- @csrf
                                                                                                                                                                                                                    @method('PATCH') -->
                                            <input type="hidden" name="id_restaurant"
                                                value="{{ $restaurant->id_restaurant }}" required>
                                            <div class="form-group d-flex justify-content-start align-items-center">
                                                <div class="col-auto">
                                                    <input type="time" name="open_time" class="form-control"
                                                        id="open-time-input" value="{{ $restaurant->open_time }}"
                                                        required>
                                                </div>
                                                <span class="mx-2">-</span>
                                                <div class="col-auto">
                                                    <input type="time" name="closed_time" class="form-control"
                                                        id="close-time-input" value="{{ $restaurant->closed_time }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    onclick="saveTimeRestaurant();">
                                                    <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary"
                                                    onclick="editTimeFormMobileCancel()">
                                                    <i class="fa fa-xmark"></i>
                                                    {{ __('user_page.Cancel') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            {{-- CONTACT --}}
                            <div class="col-12 contact-mobile"
                                style="display: flex; padding-right: 70px; padding-left: 70px; margin-top: 18px;">
                                <div class="col-4 contact-item">
                                    <a onclick="contact_activity()" type="button">
                                        <i class="fa-solid fa-phone"></i>
                                    </a>
                                </div>
                                <div class="col-3 contact-item">
                                    @if ($restaurant->email)
                                        <a target="_blank" type="button" href="mailto:{{ $restaurant->email }}">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    @else
                                        <a type="button" href="javascript:void(0);">
                                            <i class="fa-solid fa-envelope text-secondary"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-1 contact-item">
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="edit_contact()"
                                                style="font-size: 12px; color:#FF7400; font-weight: 600;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            {{-- END CONTACT --}}
                        </div>
                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">
                            <span
                                id="short_description_contents">{{ Translate::translate($restaurant->short_description) ?? __('user_page.There is no description yet') }}</span>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Description') }}</a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}"
                                        required>
                                    <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                        cols="30" rows="3" maxlength="255"
                                        placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $restaurant->short_description }}</textarea>
                                    <small id="err-shrt-desc" style="display: none;"
                                        class="invalid-feedback">{{ __('auth.empty_short_desc') }}</small><br>
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSaveShortDesc"
                                        onclick="saveShortDescription();">
                                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                    </button>
                                    <button type="reset" class="btn btn-sm btn-secondary"
                                        onclick="editShortDescriptionCancel()">
                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                    </button>
                                </div>
                            @endif
                        @endauth
                        </p>
                        {{-- END SHORT DESCRIPTION --}}
                        {{-- TAG --}}
                        <p id="tagsContent" class="text-secondary translate-text-group">
                            @if ($tags->count() > 7)
                                @for ($i = 0; $i < 7; $i++)
                                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                                        style="background-color: #FF7400;">{{ $tags[$i]->name }}</span>
                                @endfor
                                <button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button"
                                    onclick="view_tag()">{{ __('user_page.More') }}</button>
                            @else
                                @forelse ($tags as $tag)
                                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                                        style="background-color: #FF7400;">{{ $tag->name }}</span>
                                @empty
                                    {{ __('user_page.there is no tag yet') }}
                                @endforelse
                            @endif
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="add_tag()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Tags') }}</a>
                                @endif
                            @endauth
                        </p>
                        {{-- END TAG --}}

                        {{-- RESTAURANT TYPE --}}
                        <div class="col-12" style=" margin-top: 18px;" id="type-content-mobile">
                            <p style="font-size: 12px">
                                <span id="type_price_content_mobile">
                                    <span data-bs-toggle="popover" data-bs-animation="true"
                                        data-bs-placement="bottom"
                                        title="{{ $restaurant->type->name }}">{{ $restaurant->type->name }}</span>
                                    <span> - </span>
                                    @if ($restaurant->price->name == 'Cheap Prices')
                                        <span style="color: #FF7400" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom"
                                            title="{{ Translate::translate($restaurant->price->name) }}">$</span>
                                    @elseif ($restaurant->price->name == 'Middle Range')
                                        <span style="color: #FF7400" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom"
                                            title="{{ Translate::translate($restaurant->price->name) }}">$$</span>
                                    @elseif ($restaurant->price->name == 'Fine Dining')
                                        <span style="color: #FF7400" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom"
                                            title="{{ Translate::translate($restaurant->price->name) }}">$$$</span>
                                    @else
                                        <span>{{ __('user_page.no price rate yet') }}</span>
                                    @endif
                                </span>

                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a type="button" onclick="editTypeFormMobile()"
                                            style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Price Range') }}</a>
                                    @endif
                                @endauth
                            </p>

                        </div>
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="type-form-mobile" style="display: none">
                                    {{-- <form action="{{ route('restaurant_update_type') }}" method="post"> --}}
                                    <form action="javascript:void(0);" method="post">
                                        {{-- @csrf
                                                @method('PATCH') --}}
                                        <input type="hidden" name="id_restaurant"
                                            value="{{ $restaurant->id_restaurant }}" required>
                                        <div class="form-group d-flex justify-content-start align-items-center">
                                            <div class="col-auto">
                                                <select name="id_type" id="restaurant-type-input-mobile"
                                                    class="form-control">
                                                    @forelse ($restaurant_type as $item)
                                                        @php
                                                            $isSelected = '';
                                                            if ($item->id_type == $restaurant->id_type) {
                                                                $isSelected = 'selected';
                                                            }
                                                        @endphp
                                                        <option value="{{ $item->id_type }}" {{ $isSelected }}>
                                                            {{ $item->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <span class="mx-2">-</span>
                                            <div class="col-auto">
                                                <select name="id_price" id="restaurant-price-input-mobile"
                                                    class="form-control">
                                                    @forelse ($restaurant_price as $item)
                                                        @php
                                                            $isSelected = '';
                                                            if ($item->id_price == $restaurant->id_price) {
                                                                $isSelected = 'selected';
                                                            }
                                                        @endphp
                                                        <option value="{{ $item->id_price }}" {{ $isSelected }}>
                                                            {{ $item->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                onclick="saveRestaurantPriceMobile();">
                                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary"
                                                onclick="editTypeFormMobileCancel()">
                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        {{-- END RESTAURANT TYPE --}}

                        <ul class="stories inner-wrap">
                            @if (Auth::guest() || Auth::user()->role_id == 4)
                                @if ($restaurant->story->count() == 0 && $restaurant->video->count() == 0)
                                    <li class="story">
                                        <div class="img-wrap">
                                            <a type="button"
                                                onclick="requestVideo({'id': '{{ $restaurant->created_by }}', 'name': '{{ $restaurant->name }}'})">
                                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="{{ URL::asset('assets/2.png') }}">
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endif

                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || in_array(Auth::user()->role_id, [1, 2, 3]))
                                    @if ($restaurant->story->count() == 0)
                                        @if (Auth::user()->id == $restaurant->created_by || in_array(Auth::user()->role_id, [1, 2]))
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                                            data-src="{{ URL::asset('assets/add_story.png') }}">
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($restaurant->video->count() < 100)
                                            <div class="containerSlider4">
                                                <div id="slide-left-container4">
                                                    <div class="slide-left4">
                                                    </div>
                                                </div>
                                                <div id="cards-container4">
                                                    <div class="cards4" id="storyContent">
                                                        @foreach ($restaurant->video->sortBy('order') as $item)
                                                            <div class="card4 col-lg-3"
                                                                id="displayStoryVideo{{ $item->id_video }}"
                                                                style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $restaurant->created_by)
                                                                            <a type="button"
                                                                                onclick="view_video_restaurant({{ $item->id_video }});">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif

                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>

                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=0.1">
                                                                        </video>
                                                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                data-id="{{ $restaurant->id_restaurant }}"
                                                                                data-video="{{ $item->id_video }}"
                                                                                onclick="delete_photo_video(this)">
                                                                                {{-- <a href="{{ route('restaurant_delete_story', ['id' => $restaurant->id_restaurant, 'id_story' => $item->id_story]) }}"> --}}
                                                                                <i class="fa fa-trash"
                                                                                    style="color:red; margin-left: 25px;"
                                                                                    data-bs-toggle="popover"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{ __('user_page.Delete') }}"></i>
                                                                            </a>
                                                                        @endif
                                                                        </a>
                                                                        <span class="title-story">Title story</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div id="slide-right-container4">
                                                    <div class="slide-right4">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if ($restaurant->story->count() < 100)
                                            @if (Auth::user()->id == $restaurant->created_by || in_array(Auth::user()->role_id, [1, 2]))
                                                <li class="story" style="margin-top: -35px;">
                                                    <div class="img-wrap">
                                                        <a type="button" onclick="edit_story()">
                                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                                data-src="{{ URL::asset('assets/add_story.png') }}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                            <div class="containerSlider4">
                                                <div id="slide-left-container4">
                                                    <div class="slide-left4">
                                                    </div>
                                                </div>
                                                <div id="cards-container4">
                                                    <div class="cards4" id="storyContent">
                                                        @foreach ($restaurant->story as $item)
                                                            <div class="card4 col-lg-3" id="story{{ $item->id_story }}"
                                                                style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $restaurant->created_by)
                                                                            <a type="button"
                                                                                onclick="view_story_restaurant({{ $item->id_story }});">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif

                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>

                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=0.1">
                                                                        </video>
                                                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                data-restaurant="{{ $restaurant->id_restaurant }}"
                                                                                data-story="{{ $item->id_story }}"
                                                                                onclick="delete_story(this)">
                                                                                {{-- <a href="{{ route('restaurant_delete_story', ['id' => $restaurant->id_restaurant, 'id_story' => $item->id_story]) }}"> --}}
                                                                                <i class="fa fa-trash"
                                                                                    style="color:red; margin-left: 25px;"
                                                                                    data-bs-toggle="popover"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{ __('user_page.Delete') }}"></i>
                                                                            </a>
                                                                        @endif
                                                                        </a>
                                                                        <span class="title-story">Title story</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @foreach ($restaurant->video->sortBy('order') as $item)
                                                            <div class="card4 col-lg-3"
                                                                id="displayStoryVideo{{ $item->id_video }}"
                                                                style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $restaurant->created_by)
                                                                            <a type="button"
                                                                                onclick="view_video_restaurant({{ $item->id_video }});">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif

                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>

                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=0.1">
                                                                        </video>
                                                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                data-id="{{ $restaurant->id_restaurant }}"
                                                                                data-video="{{ $item->id_video }}"
                                                                                onclick="delete_photo_video(this)">
                                                                                {{-- <a href="{{ route('restaurant_delete_story', ['id' => $restaurant->id_restaurant, 'id_story' => $item->id_story]) }}"> --}}
                                                                                <i class="fa fa-trash"
                                                                                    style="color:red; margin-left: 25px;"
                                                                                    data-bs-toggle="popover"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{ __('user_page.Delete') }}"></i>
                                                                            </a>
                                                                        @endif
                                                                        </a>
                                                                        <span class="title-story">Title story</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div id="slide-right-container4">
                                                    <div class="slide-right4">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endauth

                            @if (Auth::guest() || Auth::user()->role_id == 4)

                                <div class="containerSlider3">
                                    <div id="slide-left-container3">
                                        <div class="slide-left3">
                                        </div>
                                    </div>
                                    <div id="cards-container3">
                                        <div class="cards3">
                                            @foreach ($restaurant->story as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            @auth
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $restaurant->created_by)
                                                                    <a type="button"
                                                                        onclick="view_story_restaurant({{ $item->id_story }});">
                                                                    @else
                                                                        <a type="button" onclick="showPromotionMobile()">
                                                                @endif
                                                            @endauth
                                                            @guest
                                                                <a type="button" onclick="showPromotionMobile()">

                                                                @endguest
                                                                <div class="story-video-player">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                                <video href="javascript:void(0)"
                                                                    class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=0.1">
                                                                </video>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($restaurant->video->sortBy('order') as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            @if (auth()->check() && in_array(Auth::user()->role_id, [1, 2, 3]))
                                                                <a type="button"
                                                                    onclick="view_video_restaurant({{ $item->id_video }});">
                                                                @else
                                                                    <a type="button" onclick="showPromotionMobile()">
                                                            @endif
                                                            <div class="story-video-player">
                                                                <i class="fa fa-play"></i>
                                                            </div>
                                                            <video href="javascript:void(0)" class="story-video-grid"
                                                                style="object-fit: cover;"
                                                                src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=0.1">
                                                            </video>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div id="slide-right-container3">
                                        <div class="slide-right3">
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </ul>
                    </div>
                </div>
                {{-- END PROFILE --}}
                {{-- STICKY BAR --}}
                <div class="menu-liner"></div>
                <div id="navbar" class="sticky-div">
                    <ul class="navigationList">
                        <li class="navigationItem" onClick="document.getElementById('gallery').scrollIntoView();">
                            <a id="gallery-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.GALLERY') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem" onClick="document.getElementById('menu').scrollIntoView();">
                            <a id="menu-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="fa-solid fa-book navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.MENU') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem" onClick="document.getElementById('description').scrollIntoView();">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.ABOUT') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem" onClick="document.getElementById('amenities').scrollIntoView();">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.FACILITIES') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem" onClick="document.getElementById('location-map').scrollIntoView();">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.LOCATION') }}</span>
                                </span>
                            </a>
                        </li>
                        {{-- <li class="navigationItem">
                        <a class="hoover font-13 navigationItem__Button"
                            onClick="document.getElementById('availability').scrollIntoView();">
                            <span>
                                <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>
                                AVAILABILITY
                            </span>
                        </a>
                    </li> --}}
                        <li class="navigationItem" onClick="document.getElementById('review').scrollIntoView();">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.REVIEW') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem d-flex d-md-none" onClick="document.getElementById('first-detail-content').scrollIntoView();">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button">
                                <span>
                                    <i aria-label="Posts" class="fas fa-play navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- END STICKY BAR --}}
                {{-- PAGE CONTENT --}}
                <div class="js-gallery">
                    {{-- GALLERY --}}
                    <section id="gallery" class="section">
                        <div class="col-12 row gallery">
                            @if ($restaurant->photo->count() > 0)
                                @foreach ($restaurant->photo->sortBy('order') as $item)
                                    <div class="col-4 grid-photo" id="displayPhoto{{ $item->id_photo }}">
                                        <a
                                            href="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}">
                                            <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}"
                                                title="{{ $item->caption }}">
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-icon">
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" type="button"
                                                        title="{{ __('user_page.Add Photo Tag') }}"
                                                        data-id="{{ $restaurant->id_restaurant }}"
                                                        data-photo="{{ $item->id_photo }}"
                                                        onclick="add_photo_tag(this)"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Photo Position') }}" type="button"
                                                        onclick="position_photo()"><i class="fa fa-arrows"></i></button>
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete Photo') }}"
                                                        href="javascript:void(0);"
                                                        data-id="{{ $restaurant->id_restaurant }}"
                                                        data-photo="{{ $item->id_photo }}"
                                                        onclick="delete_photo_photo(this)"><i
                                                            class="fa fa-trash"></i></button>
                                                </span>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            @endif
                            @if ($restaurant->video->count() > 0)
                                @foreach ($restaurant->video->sortBy('order') as $item)
                                    <div class="col-4 grid-photo" id="displayVideo{{ $item->id_video }}">
                                        @auth
                                            @if (auth()->check() && in_array(Auth::user()->role_id, [1, 2, 3]))
                                                <a class="pointer-normal"
                                                    onclick="view_video_restaurant({{ $item->id_video }})"
                                                    href="javascript:void(0);">
                                                @else
                                                    <a class="pointer-normal" onclick="showPromotionMobile()"
                                                        href="javascript:void(0);">
                                            @endif
                                        @endauth

                                        @guest
                                            <a class="pointer-normal" onclick="showPromotionMobile()"
                                                href="javascript:void(0);">
                                            @endguest

                                            <video href="javascript:void(0)" class="photo-grid" loading="lazy"
                                                src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=1.0">
                                            </video>
                                            <span class="video-grid-button"><i class="fa fa-play"></i></span>
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-video-icon">
                                                    <button type="button" onclick="position_video()"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Video Position') }}"><i
                                                            class="fa fa-arrows"></i></button>
                                                    <button href="javascript:void(0);"
                                                        data-id="{{ $restaurant->id_restaurant }}"
                                                        data-video="{{ $item->id_video }}"
                                                        onclick="delete_photo_video(this)" data-bs-toggle="popover"
                                                        data-bs-animation="true" data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete Video') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </span>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            @endif
                            @if ($restaurant->photo->count() <= 0 && $restaurant->video->count() <= 0)
                                {{ __('user_page.there is no gallery yet') }}
                            @endif
                        </div>
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section id="add-gallery" class="add-gallery">
                                <form class="dropzone dz-image-add" id="frmTarget">
                                    @csrf
                                    <div class="dz-message" data-dz-message>
                                        <span>{{ __('user_page.Click here to upload your files') }}</span>
                                    </div>
                                    <input type="hidden" value="{{ $restaurant->id_restaurant }}" id="id_restaurant"
                                        name="id_restaurant">
                                </form>
                                <small id="err-dz" style="display: none;"
                                    class="invalid-feedback">{{ __('auth.empty_file') }}</small><br>
                                <button type="submit" id="button"
                                    class="btn btn-primary">{{ __('user_page.Upload') }}</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    {{-- MENU --}}
                    <section id="menu" class="section-2 menu-gallery">
                        <div class="about-place-block px-sm-24p">
                            <hr>
                            <h2>Menu
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_menu()">
                                            <i class="fa fa-plus" style="color:#FF7400; padding-right:5px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="{{ __('user_page.Add') }}"></i>
                                        </a>
                                    @endif
                                @endauth
                            </h2>
                        </div>
                        <div class="col-12 row gallery2" id="contentMenu">
                            @forelse ($restaurant->menu as $menu)
                                <div class="col-4 grid-photo" id="displayMenu{{ $menu->id_menu }}">
                                    {{-- Popup modal --}}
                                    {{-- <a onclick="view_menu('{{ $menu->id_menu }}')" class="photosGrid__Photo btn"
                                    style="background-image: url('{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/menu' . '/' . $menu->foto) }}')">
                                    </a> --}}
                                    <a class="itemsMenu"
                                        href="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . 'menu/' . $menu->foto) }}">
                                        <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                            src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . 'menu/' . $menu->foto) }}"
                                            title="{{ $menu->name }}">
                                    </a>
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <span class="edit-menu-icon">
                                                {{-- <button data-bs-toggle="popover" data-bs-animation="true"
                                                    data-bs-placement="bottom"
                                                    title="{{ __('user_page.Add Photo Caption') }}"
                                                    onclick="view_add_caption({'id': '{{ $restaurant->id_restaurant }}', 'id_menu': '{{ $menu->id_menu }}'})"><i
                                                        class="fa fa-pencil"></i></button> --}}
                                                <button style="height:40px" href="javascript:void(0);"
                                                    data-id="{{ $restaurant->id_restaurant }}"
                                                    data-menu="{{ $menu->id_menu }}" onclick="delete_menu(this)"
                                                    data-bs-toggle="popover" data-bs-animation="true"
                                                    data-bs-placement="bottom"
                                                    title="{{ __('user_page.Delete Menu') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </span>
                                        @endif
                                    @endauth
                                </div>
                            @empty
                                <p
                                    style="text-align: justify; padding-top:10px; padding-bottom:12px; padding-left:10px; padding-right:10px;">
                                    {{ __('user_page.There is no menu yet') }}
                                </p>
                            @endforelse
                        </div>
                        @guest
                            @if ($restaurant->menu->count() > 3)
                                <div class="col-12" style="margin: 12px;">
                                    <p class="lead">{{ __('user_page.Displayed') }} <b class="shownLength"></b>
                                        {{ __('user_page.Of') }} <b class="listLength"></b>
                                        {{ __('user_page.Menu') }}.</p>
                                    <div class="buttonToogle" style="display: none;">
                                        <a href="javascript:void(0);" class="showMore btn btn-primary">+
                                            {{ __('user_page.More Menu') }}</a>
                                    </div>
                                </div>
                            @endIf
                        @endguest

                        {{-- add multiple menu --}}
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <section id="add-menu" class="add-menu">
                                    <form class="dropzone dz-mn" id="frmMenu">
                                        @csrf
                                        <div class="dz-message" data-dz-message>
                                            <span>{{ __('user_page.Click here to upload your files') }}</span>
                                        </div>
                                        <input type="hidden" value="{{ $restaurant->id_restaurant }}"
                                            id="id_restaurant" name="id_restaurant">
                                    </form>
                                    <small id="err-dz-mn" style="display: none;"
                                        class="invalid-feedback">{{ __('auth.empty_file') }}</small><br>
                                    <button type="submit" id="button_menu"
                                        class="btn btn-primary">{{ __('user_page.Upload') }}</button>
                                </section>
                            @endif
                        @endauth
                        {{-- add multiple menu --}}
                    </section>

                    <section id="description" class="section-2 px-sm-24p">
                        {{-- Description --}}
                        <div class="about-place-block">
                            <hr>
                            <h2>
                                {{ __('user_page.Description') }}
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editDescriptionForm()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit About') }}</i></a>
                                    @endif
                                @endauth
                            </h2>
                            @php
                                $isMobile =
                                    preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $_SERVER['HTTP_USER_AGENT']) ||
                                    preg_match(
                                        '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                                        substr($_SERVER['HTTP_USER_AGENT'], 0, 4),
                                    );
                            @endphp
                            <p id="description-content"
                                style="text-align: justify; padding-top:10px; padding-bottom:12px">
                                @if ($isMobile)
                                    {!! Str::limit(Translate::translate($restaurant->description), 400, ' ...') ??
                                        __('user_page.There is no description yet') !!}
                                @else
                                    {!! Str::limit(Translate::translate($restaurant->description), 600, ' ...') ??
                                        __('user_page.There is no description yet') !!}
                                @endif
                                {{-- {!! $restaurant->description ?? 'there is no description yet' !!} --}}
                            </p>
                            <span id="buttonShowMoreDescription">
                                @if ($isMobile)
                                    @if (Str::length($restaurant->description) > 400)
                                        <a id="btnShowMoreDescription" style="font-weight: 600;"
                                            href="javascript:void(0);" onclick="showMoreDescription();"><span
                                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                            <span style="color: #ff7400;">></span></a>
                                    @endif
                                @else
                                    @if (Str::length($restaurant->description) > 600)
                                        <a id="btnShowMoreDescription" style="font-weight: 600;"
                                            href="javascript:void(0);" onclick="showMoreDescription();"><span
                                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                            <span style="color: #ff7400;">></span></a>
                                    @endif
                                @endif
                            </span>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="javascript:void(0);" method="post">
                                            {{-- @csrf
                                            @method('PATCH') --}}
                                            <input type="hidden" name="id_restaurant"
                                                value="{{ $restaurant->id_restaurant }}" required>
                                            <div class="form-group">
                                                <textarea name="description" id="description-form-input" class="w-100 form-control" rows="5"
                                                    placeholder="{{ __('user_page.Make your short description here') }}">{{ $restaurant->description }}</textarea>
                                                <small id="err-desc" style="display: none;"
                                                    class="invalid-feedback">{{ __('auth.empty_desc') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    id="btnSaveDescription" onclick="saveDescription();">
                                                    <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary"
                                                    onclick="editDescriptionCancel()">
                                                    <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </section>

                    <section id="amenities" class="section-2 px-sm-24p">
                        <div class="row-grid-amenities">
                            <hr>
                            <div>
                                <h2>
                                    {{ __('user_page.Facilities') }}
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;
                                            <a type="button" onclick="add_facilities()"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Facilities') }}</a>
                                        @endif
                                    @endauth
                                </h2>
                            </div>
                            <div class="stopper"></div>
                        </div>

                        <div class="row-grid-amenities" id="row-amenities">
                            <div class="row-grid-list-amenities translate-text-group" id="contentFacilities">
                                @if ($restaurant->facilities->count() > 6)
                                    @for ($i = 0; $i < 6; $i++)
                                        <div class="list-amenities">
                                            <div class="text-align-center" data-maxlength="6">
                                                <i class="f-40 fa fa-{{ $restaurant->facilities[$i]->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $restaurant->facilities[$i]->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $restaurant->facilities[$i]->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endfor
                                    <div class="list-amenities">
                                        <button class="amenities-button" type="button" onclick="view_amenities()">
                                            <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                                            <div style="font-size: 15px;" class="translate-text-group-items">
                                                {{ __('user_page.More') }}</div>
                                        </button>
                                    </div>
                                @else
                                    @forelse ($restaurant->facilities as $item)
                                        <div class="list-amenities">
                                            <div class="text-align-center" data-maxlength="6">
                                                <i class="f-40 fa fa-{{ $item->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        {{-- <p id="default-amen-null">{{ __('user_page.there is no facilities yet') }}</p> --}}
                                    @endforelse
                                @endif
                            </div>
                        @empty($restaurant->facilities->count())
                            <p id="default-amen-null">{{ __('user_page.there is no facilities yet') }}</p>
                        @endempty
                    </div>
                </section>

                <!--<section id="location-map" class="section-2">
<div class="about-place-block">
{{-- <h2>
                                Location
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <input type="hidden" value="{{ $restaurant->latitude }}" name="latitude" id="latitude">
                            <input type="hidden" value="{{ $restaurant->longitude }}" name="longitude"
                                id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div> --}}
</div>
</section> -->
                <!-- <div style="padding-left: 10px; padding-right: 10px;">
<hr>
</div> -->

            </div>
            {{-- END PAGE CONTENT --}}
            <!-- <div class="spacer">&nbsp;</div> -->
        </div>

        {{-- END LEFT CONTENT --}}
        {{-- RIGHT CONTENT --}}
        <div class="col-lg-3 col-md-3 col-12">
            <div class="sidebar sidebar-restaurant" id="sidebar_fix">
                <div class="reserve-block sidebar-mf">
                    <div class="gradient-try">
                        <center>
                            <h4 class="headline-list-property">{{ __('user_page.List Your Property Now') }}!
                            </h4>
                        </center>
                    </div>
                    <!-- Random Villa Slider Start -->
                    <div class="popular-block-activity">
                        <h4>{{ __('user_page.Popular Stays Nearby') }}<h4>
                                <div class="SlickCarousel3">
                                    <!-- Start Slider Items -->
                                    @forelse ($villaRandom as $popular)
                                        <div>
                                            <div class="popular-card">
                                                <div class="popular-card-header"
                                                    onclick="window.open('{{ route('villa', ['id' => $popular->id_villa]) }}', '_blank');"
                                                    style="cursor: pointer;">
                                                    <img
                                                        src="{{ asset('/foto/gallery/' . $popular->uid . '/' . $popular->image) }}">
                                                </div>
                                                <div>
                                                    <div class="card-content">
                                                        <div class="popular-card-title"><a
                                                                href="{{ route('villa', ['id' => $popular->id_villa]) }}"
                                                                target="_blank">{{ $popular->name }}</a></div>
                                                        <div class="popular-card-text">
                                                            <p>{{ $popular->bedroom }}
                                                                {{ __('user_page.Bedroom') }},
                                                                {{ $popular->bathroom }}
                                                                {{ __('user_page.Bathroom') }}</p>
                                                            {{-- <p style="color: #000;">
                                                                @foreach ($popular->amenities as $item)
                                                                    <i class="fa fa-{{ $item->icon }}"></i>
                                                                @endforeach
                                                                <i class="fa fa-wifi"></i> <i class="fa fa-phone"></i>
                                                            </p> --}}
                                                            <!-- Description max 100 character -->
                                                            <p style="text-align: justify;">
                                                                @if (!empty($popular->description))
                                                                    {{ Str::limit(Translate::translate($popular->description), 150, ' ...') }}
                                                                @else
                                                                    {{ __('user_page.There is no description yet') }}
                                                                @endif

                                                            </p>
                                                        </div>
                                                        <div class="popular-card-price">
                                                            @if (!empty($popular->price))
                                                                @if (isset($_COOKIE['sCheck_in']) && $_COOKIE['sCheck_in'] != "")
                                                                    <p>{{ CurrencyConversion::exchangeWithUnit($popular->price * $dateDiffe) }}/
                                                                        {{ $dateDiffe }}
                                                                        {{ __('user_page.night') }}
                                                                        <br>
                                                                        <b>{{ \Carbon\Carbon::parse($get_check_in)->format("d M Y"); }}</b> to
                                                                        <b>{{ \Carbon\Carbon::parse($get_check_out)->format("d M Y"); }}</b>
                                                                    </p>
                                                                @else
                                                                    <p>{{ CurrencyConversion::exchangeWithUnit($popular->price) }}/
                                                                        {{ __('user_page.night') }}
                                                                    </p>
                                                                @endif
                                                            @endIf
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                    <!-- End Slider Items -->
                                </div>
                    </div>
                    <!-- End Random Slider -->
                </div>
            </div>
        </div>
        {{-- END RIGHT CONTENT --}}

        <section id="location-map" class="section-2 px-xs-20p px-sm-24p">
            <hr calss="pendek">
            <h2>
                {{ __("user_page.Explore what's nearby") }}
                @auth
                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        &nbsp;
                        <a type="button" onclick="edit_location()"
                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Location') }}</a>
                    @endif
                @endauth
            </h2>
            <div class="row-grid-location">
                @include('user.modal.restaurant.map-location')
            </div>
        </section>
    </div>
    <div id="rsv-block-btn">
        {{-- RESERVE BUTTON TOP RIGHT --}}
        <div class="rsv">
            <a onclick="contact_restaurant()" type="button"
                class="rsv-btn-button">{{ __('user_page.CONTACT RESTAURANT') }}</a>
        </div>
        {{-- END RESERVE BUTTON TOP RIGHT --}}
    </div>
    <div id="navbarright" class="navright">
        <div class="list-villa-user right-bar">
            @if (Route::is('list') || Route::is('index'))
            @endif

            @auth

                <div class="social-share-container" style="padding: 4px; border-radius: 9px;">
                    @if ($condition_restaurant)
                        @php
                            $cekRestaurant = App\Models\RestaurantSave::where('id_restaurant', $restaurant->id_restaurant)
                                ->where('id_user', Auth::user()->id)
                                ->first();
                        @endphp

                        @if ($cekRestaurant == null)
                            <div style="width: 48px;" class="text-center">
                                <a style="cursor: pointer;"
                                    onclick="likeFavorit({{ $restaurant->id_restaurant }}, 'restaurant')">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button favorite-button-22 likeButtonrestaurant{{ $restaurant->id_restaurant }}"
                                        style="display: unset; margin-left: 0px;">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                    <div style="color: #aaa; font-size: 10px;" id="captFav">
                                        {{ __('user_page.FAVORITE') }}</div>
                                </a>
                            </div>
                        @else
                            <div class="text-center" style="width: 48px;">
                                <a style="cursor: pointer;"
                                    onclick="likeFavorit({{ $restaurant->id_restaurant }}, 'restaurant')">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button-active favorite-button-22 unlikeButtonrestaurant{{ $restaurant->id_restaurant }}"
                                        style="display: unset; margin-left: 0px;">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                    <div style="color: #aaa; font-size: 10px;" id="captCan">
                                        {{ __('user_page.FAVORITE') }}</div>
                                </a>
                            </div>
                        @endif
                    @endif
                    <div class="text-center icon-center">
                        <div type="button" class="" onclick="share()" style="text-align: center;">
                            <svg class="detail-share-button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M503.7 226.2l-176 151.1c-15.38 13.3-39.69 2.545-39.69-18.16V272.1C132.9 274.3 66.06 312.8 111.4 457.8c5.031 16.09-14.41 28.56-28.06 18.62C39.59 444.6 0 383.8 0 322.3c0-152.2 127.4-184.4 288-186.3V56.02c0-20.67 24.28-31.46 39.69-18.16l176 151.1C514.8 199.4 514.8 216.6 503.7 226.2z" />
                            </svg>
                            <div style="font-size: 10px; color: #aaa;">{{ __('user_page.SHARE') }}
                            </div>
                        </div>
                    </div>
                </div>

                <a type="button" onclick="language()" class="navbar-gap d"
                    style="color: white; margin-right: 9px; width:27px;">
                    @if (session()->has('locale'))
                        <img class="language-flag-icon"
                            src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                    @else
                        <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                    @endif
                </a>

                <div class="logged-user-menu-detail" style="">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="logged-user-photo-detail"
                                alt="">
                        @else
                            <img src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                class="logged-user-photo-detail" alt="">
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
                                    <img src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                        class="logged-user-photo-detail" alt="">
                                @endif
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                </div>
                            </h6>
                            <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                {{ __('user_page.Dashboard') }}
                            </a>
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
            @else
                <div class="social-share-container" style="padding: 4px; border-radius: 9px;">
                    <div style="width: 48px;" class="text-center">
                        <a onclick="loginForm(1)" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                role="presentation" focusable="false" class="favorite-button-22 favorite-button"
                                style="display: unset; margin-left: 0px;">
                                <path
                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            <div style="font-size: 10px; color: #aaa;">{{ __('user_page.FAVORITE') }}</div>
                        </a>
                    </div>
                    <div style="width: 48px;" class="text-center icon-center">
                        <div type="button" class="" onclick="share()" style="text-align: center;">
                            <svg class="detail-share-button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M503.7 226.2l-176 151.1c-15.38 13.3-39.69 2.545-39.69-18.16V272.1C132.9 274.3 66.06 312.8 111.4 457.8c5.031 16.09-14.41 28.56-28.06 18.62C39.59 444.6 0 383.8 0 322.3c0-152.2 127.4-184.4 288-186.3V56.02c0-20.67 24.28-31.46 39.69-18.16l176 151.1C514.8 199.4 514.8 216.6 503.7 226.2z" />
                            </svg>
                            <div style="font-size: 10px; color: #aaa;">{{ __('user_page.SHARE') }}
                            </div>
                        </div>
                    </div>
                </div>



                <a type="button" onclick="language()" class="navbar-gap"
                    style="color: white; margin-right: 9px; width:27px;">
                    @if (session()->has('locale'))
                        <img class="language-flag-icon"
                            src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                    @else
                        <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                    @endif
                </a>

                <!-- <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap"
                    style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: flex; align-items: center; justify-content: center; ">
                    <i class="fa-solid fa-user"></i>
                </a> -->

                    <div class="drodwn-container">
                        <button type="button" class="btn-dropdwn dropbtn btn border-0 navbar-gap"></button>
                        <div class="dropdwn dropdown-content">
                        <a href="#" onclick="view_LoginModal('login');">Login</a>
                        <a href="#" onclick="view_LoginModal('register');">Register</a>
                        <hr>
                        <a href="{{ route('ahost') }}">Become a Host</a>
                        <a href="{{ route('collaborator_list') }}">Collaborator Portal</a>
                        <a href="{{ route('faq') }}">FAQ</a>
                        </div>
                    </div>
            @endauth

        </div>
    </div>
    {{-- FULL WIDTH ABOVE FOOTER --}}
    <div class="col-lg-12 bottom-content px-max-md-12p">
        <div class="col-12">
            <section id="review" class="section-2">
                <hr>
                <div class="review-bottom">
                    <h2>{{ __('user_page.Review') }}</h2>
                    <div class="row review-container">
                        <div class="col-12">
                            @if ($restaurant->detailReview)
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex">
                                            <div class="col-6">
                                                {{ __('user_page.Food') }}
                                            </div>
                                            <div class="col-6 ">
                                                <div class="liner">
                                                    <span class="liner-bar"
                                                        style="width: {{ $restaurant->detailReview->average_food * 20 }}%"></span>
                                                </div>
                                                {{ $restaurant->detailReview->average_food }}
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-6">
                                                {{ __('user_page.Service') }}
                                            </div>
                                            <div class="col-6">
                                                <div class="liner">
                                                    <span class="liner-bar"
                                                        style="width: {{ $restaurant->detailReview->average_service * 20 }}%"></span>
                                                </div>
                                                {{ $restaurant->detailReview->average_service }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex">
                                            <div class="col-6">
                                                {{ __('user_page.Value') }}
                                            </div>
                                            <div class="col-6">
                                                <div class="liner">
                                                    <span class="liner-bar"
                                                        style="width: {{ $restaurant->detailReview->average_value * 20 }}%"></span>
                                                </div>
                                                {{ $restaurant->detailReview->average_value }}
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-6">
                                                {{ __('user_page.Atmosphere') }}
                                            </div>
                                            <div class="col-6">
                                                <div class="liner">
                                                    <span class="liner-bar"
                                                        style="width: {{ $restaurant->detailReview->average_atmosphere * 20 }}%"></span>
                                                </div>
                                                {{ $restaurant->detailReview->average_atmosphere }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <button type="button" onclick="showMoreReview();"
                                            class="btn btn-outline-dark">
                                            Show all reviews
                                        </button>
                                    </div>
                                </div>
                            @else
                            <div class="col-12 col-md-6 d-flex">
                                <div class="col-1 icon-review-container">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true" role="presentation" focusable="false"
                                        style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                        <path
                                            d="M14.998 1.032a2 2 0 0 0-.815.89l-3.606 7.766L1.951 10.8a2 2 0 0 0-1.728 2.24l.031.175A2 2 0 0 0 .87 14.27l6.36 5.726-1.716 8.608a2 2 0 0 0 1.57 2.352l.18.028a2 2 0 0 0 1.215-.259l7.519-4.358 7.52 4.358a2 2 0 0 0 2.734-.727l.084-.162a2 2 0 0 0 .147-1.232l-1.717-8.608 6.361-5.726a2 2 0 0 0 .148-2.825l-.125-.127a2 2 0 0 0-1.105-.518l-8.627-1.113-3.606-7.765a2 2 0 0 0-2.656-.971zm-3.07 10.499l4.07-8.766 4.07 8.766 9.72 1.252-7.206 6.489 1.938 9.723-8.523-4.94-8.522 4.94 1.939-9.723-7.207-6.489z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="col-8">
                                    <p class="review-txt">
                                        {{ __('user_page.There is no reviews yet') }}
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6 d-flex">
                                <div class="col-1 icon-review-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                        aria-hidden="true" role="presentation" focusable="false"
                                        style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                        <path
                                            d="M16 1c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15-8.284 0-15-6.716-15-15C1 7.716 7.716 1 16 1zm4.398 21.001h-8.796C12.488 26.177 14.23 29 16 29c1.77 0 3.512-2.823 4.398-6.999zm-10.845 0H4.465a13.039 13.039 0 0 0 7.472 6.351c-1.062-1.58-1.883-3.782-2.384-6.351zm17.982 0h-5.088c-.5 2.57-1.322 4.77-2.384 6.352A13.042 13.042 0 0 0 27.535 22zM9.238 12H3.627A12.99 12.99 0 0 0 3 16c0 1.396.22 2.74.627 4h5.61A33.063 33.063 0 0 1 9 16c0-1.383.082-2.724.238-4zm11.502 0h-9.482A30.454 30.454 0 0 0 11 16c0 1.4.092 2.743.26 4.001h9.48C20.908 18.743 21 17.4 21 16a30.31 30.31 0 0 0-.26-4zm7.632 0h-5.61c.155 1.276.237 2.617.237 4s-.082 2.725-.238 4h5.61A12.99 12.99 0 0 0 29 16c0-1.396-.22-2.74-.627-4zM11.937 3.647l-.046.016A13.04 13.04 0 0 0 4.464 10h5.089c.5-2.57 1.322-4.77 2.384-6.353zM16 3l-.129.005c-1.725.133-3.405 2.92-4.269 6.995h8.796C19.512 5.824 17.77 3 16 3zm4.063.648l.037.055C21.144 5.28 21.952 7.46 22.447 10h5.089a13.039 13.039 0 0 0-7.473-6.352z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="col-8">
                                    <p class="review-txt">
                                        We’re here to help your trip go smoothly. Every reservation is covered by
                                        <span><a href="#">EZV's Guest Refund Policy.</a></span>
                                    </p>
                                </div>
                            </div> --}}
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>
            </section>

            @auth
                @if (Auth::user()->role_id != 3)
                    @can('review_create')
                        @if ($restaurant->userReview)
                            <section id="user-review" class="section-2">
                                <div class="about-place-block">

                                    <div class="d-flex justify-content-left">
                                        <h2>{{ __('user_page.Your Review') }}</h2>
                                        <span>
                                            <form action="{{ route('restaurant_review_delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" required>
                                                <input type="hidden" name="id_review"
                                                    value="{{ $restaurant->userReview->id_review }}" required>
                                                <button type="submit" class="btn"><i class="fa fa-trash"
                                                        style="color:#ff7400; font-size: 20px" data-bs-toggle="popover"
                                                        data-bs-animation="true" data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete') }}"></i></button>
                                            </form>
                                        </span>
                                    </div>

                                    <div class="row">
                                        @if ($restaurant->userReview->comment)
                                            <div class="col-12">
                                                <div class="col-12 col-lg-6 d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Comment') }}
                                                    </div>
                                                    <div class="col-6 review-comment-text">
                                                        {{ $restaurant->userReview->comment }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12 col-lg-6">
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Food') }}
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="liner">
                                                        <span class="liner-bar"
                                                            style="width: {{ $restaurant->userReview->food * 20 }}%"></span>
                                                    </div>
                                                    {{ $restaurant->userReview->food }}
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Service') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner">
                                                        <span class="liner-bar"
                                                            style="width: {{ $restaurant->userReview->service * 20 }}%"></span>
                                                    </div>
                                                    {{ $restaurant->userReview->service }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Value') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner">
                                                        <span class="liner-bar"
                                                            style="width: {{ $restaurant->userReview->value * 20 }}%"></span>
                                                    </div>
                                                    {{ $restaurant->userReview->value }}
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Atmosphere') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner">
                                                        <span class="liner-bar"
                                                            style="width: {{ $restaurant->userReview->atmosphere * 20 }}%"></span>
                                                    </div>
                                                    {{ $restaurant->userReview->atmosphere }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </section>
                        @else
                            {{-- END STYLE FOR RATING STAR --}}
                            <section id="add-review" class="section-2">
                                <div class="about-place-block">
                                    <h2>{{ __('user_page.Give review') }}</h2>
                                    <div class="row">
                                        <form action="{{ route('restaurant_review_store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_restaurant"
                                                value="{{ $restaurant->id_restaurant }}" readonly required>
                                            <div class="row">
                                                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                                    <div class="d-flex">
                                                        <div class="col-4 review-container">
                                                            {{ __('user_page.Food') }}
                                                        </div>
                                                        <div class="col-8 review-container">
                                                            <div class="cm-star-rating">
                                                                <input id="food-star-5" type="radio" name="food"
                                                                    value="5" required />
                                                                <label for="food-star-5"
                                                                    title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="food-star-4" type="radio" name="food"
                                                                    value="4" required />
                                                                <label for="food-star-4"
                                                                    title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="food-star-3" type="radio" name="food"
                                                                    value="3" required />
                                                                <label for="food-star-3"
                                                                    title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="food-star-2" type="radio" name="food"
                                                                    value="2" required />
                                                                <label for="food-star-2"
                                                                    title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="food-star-1" type="radio" name="food"
                                                                    value="1" required />
                                                                <label for="food-star-1"
                                                                    title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-4 review-container">
                                                            {{ __('user_page.Service') }}
                                                        </div>
                                                        <div class="col-8 review-container">
                                                            <div class="cm-star-rating">
                                                                <input id="service-star-5" type="radio"
                                                                    name="service" value="5" required />
                                                                <label for="service-star-5"
                                                                    title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="service-star-4" type="radio"
                                                                    name="service" value="4" required />
                                                                <label for="service-star-4"
                                                                    title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="service-star-3" type="radio"
                                                                    name="service" value="3" required />
                                                                <label for="service-star-3"
                                                                    title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="service-star-2" type="radio"
                                                                    name="service" value="2" required />
                                                                <label for="service-star-2"
                                                                    title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="service-star-1" type="radio"
                                                                    name="service" value="1" required />
                                                                <label for="service-star-1"
                                                                    title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-4 review-container">
                                                            {{ __('user_page.Value') }}
                                                        </div>
                                                        <div class="col-8 review-container">
                                                            <div class="cm-star-rating">
                                                                <input id="value-star-5" type="radio" name="value"
                                                                    value="5" required />
                                                                <label for="value-star-5"
                                                                    title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="value-star-4" type="radio" name="value"
                                                                    value="4" required />
                                                                <label for="value-star-4"
                                                                    title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="value-star-3" type="radio" name="value"
                                                                    value="3" required />
                                                                <label for="value-star-3"
                                                                    title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="value-star-2" type="radio" name="value"
                                                                    value="2" required />
                                                                <label for="value-star-2"
                                                                    title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="value-star-1" type="radio" name="value"
                                                                    value="1" required />
                                                                <label for="value-star-1"
                                                                    title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-4 review-container">
                                                            {{ __('user_page.Atmosphere') }}
                                                        </div>
                                                        <div class="col-8 review-container">
                                                            <div class="cm-star-rating">
                                                                <input id="atmosphere-star-5" type="radio"
                                                                    name="atmosphere" value="5" required />
                                                                <label for="atmosphere-star-5"
                                                                    title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="atmosphere-star-4" type="radio"
                                                                    name="atmosphere" value="4" required />
                                                                <label for="atmosphere-star-4"
                                                                    title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="atmosphere-star-3" type="radio"
                                                                    name="atmosphere" value="3" required />
                                                                <label for="atmosphere-star-3"
                                                                    title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="atmosphere-star-2" type="radio"
                                                                    name="atmosphere" value="2" required />
                                                                <label for="atmosphere-star-2"
                                                                    title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="atmosphere-star-1" type="radio"
                                                                    name="atmosphere" value="1" required />
                                                                <label for="atmosphere-star-1"
                                                                    title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}"
                                                                    class="rating-star">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="col-12">
                                                        {{ __('user_page.Comment') }}
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea name="comment" rows="3" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button type="submit" class="btn btn-block btn-sm btn-primary"
                                                            style="width: 200px">{{ __('user_page.Save') }}</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>
                                </div>
                            </section>
                        @endif
                    @endcan
                @endif
            @endauth
            {{-- <section id="endSticky" class="section-2">
                <h3>Things to know</h3>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">


                        <p>
                            @if (!isset($restaurant_rules))
                                {{ __('user_page.No data found') }}
                            @endif

                            @if (isset($restaurant_rules))
                                @if ($restaurant_rules->children == 'yes')
                                    <i class="fas fa-child"></i>
                                    {{ __('user_page.Childrens are allowed') }}<br>
                                @endif
                                @if ($restaurant_rules->infants == 'yes')
                                    <i class="fas fa-child"></i>
                                    {{ __('user_page.Infants are allowed') }}<br>
                                @endif
                                @if ($restaurant_rules->pets == 'yes')
                                    <i class="fas fa-paw"></i>
                                    {{ __('user_page.Pets are allowed') }}<br>
                                @endif
                                @if ($restaurant_rules->smoking == 'yes')
                                    <i class="fas fa-smoking"></i>
                                    {{ __('user_page.Smoking is allowed') }}<br>
                                @endif
                                @if ($restaurant_rules->events == 'yes')
                                    <i class="fas fa-calendar"></i>
                                    {{ __('user_page.Events are allowed') }}<br>
                                @endif

                                @if ($restaurant_rules->children == 'no')
                                    <i class="fas fa-ban"></i> {{ __('user_page.No children') }}<br>
                                @endif
                                @if ($restaurant_rules->infants == 'no')
                                    <i class="fas fa-ban"></i> {{ __('user_page.No infants') }}<br>
                                @endif
                                @if ($restaurant_rules->pets == 'no')
                                    <i class="fas fa-ban"></i> {{ __('user_page.No pets') }}<br>
                                @endif
                                @if ($restaurant_rules->smoking == 'no')
                                    <i class="fas fa-ban"></i> {{ __('user_page.No smoking') }}<br>
                                @endif
                                @if ($restaurant_rules->events == 'no')
                                    <i class="fas fa-ban"></i> {{ __('user_page.No events') }}<br>
                                @endif
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="d-flex">
                            <h6>{{ __('user_page.Health & Safety') }}</h6>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editRestaurantGuestSafety()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                @endif
                            @endauth
                        </div>

                        <p>
                            @forelse ($restaurant->guestSafety->take(5) as $item)
                                <i class="fas fa-{{ $item->icon }}"></i>
                                {{ $item->guest_safety }}<br>
                            @empty
                                {{ __('user_page.No data found') }}
                            @endforelse
                        </p>
                        @php
                            $countGuest = count($restaurant->guestSafety);
                        @endphp
                        @if ($countGuest > 5)
                            <p>
                                <a href="javascript:void(0)" onclick="showMoreRestaurantGuestSafety()">
                                    {{ __('user_page.Show more') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </section> --}}
            <div class="section">
                <div class="px-xs-12p px-sm-24p">
                    <div class="row owner-block">
                        <div class="col-1 host-profile">
                            @if ($restaurant->image)
                                @guest
                                    <a href="{{ route('owner_profile_show', $restaurant->ownerData->id) }}"
                                        target="_blank">
                                    @endguest
                                    @auth
                                        @if ($restaurant->ownerData->id == Auth::user()->id)
                                            <a href="{{ route('profile_user') }}" target="_blank">
                                            @else
                                                <a href="{{ route('owner_profile_show', $restaurant->ownerData->id) }}"
                                                    target="_blank">
                                        @endIf
                                    @endauth
                                    <img
                                        src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}">
                                </a>
                            @else
                                @auth
                                    @if ($restaurant->ownerData->id == Auth::user()->id)
                                        <a href="{{ route('profile_user') }}" target="_blank">
                                        @else
                                            <a href="{{ route('owner_profile_show', $restaurant->ownerData->id) }}"
                                                target="_blank">
                                    @endIf
                                @endauth
                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}">
                                </a>
                            @endif
                        </div>
                        <div class="col-5">
                            <div class="member-profile">
                                <div class="d-flex">
                                    <h4>{{ __('user_page.Hosted by') }}
                                        @if ($restaurant->ownerData->first_name == null || $restaurant->ownerData->last_name == null)
                                            Anonymous
                                        @else
                                            {{ $restaurant->ownerData->first_name }}
                                            {{ $restaurant->ownerData->last_name }}
                                        @endif
                                    </h4>
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by)
                                            &nbsp;
                                            <a type="button" href="{{ route('profile_user') }}"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Profile') }}</a>
                                        @endif
                                    @endauth
                                </div>
                                @if (isset($restaurant->ownerData->created_at))
                                    <p>
                                        {{ __('user_page.Joined in') }}
                                        {{ date_format($restaurant->ownerData->created_at, 'M Y') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6 owner-profile">
                            <h4>Host Profile</h4>
                            <p>
                                {{ __('user_page.About') }}
                                <span>{{ $restaurant->owner->about ?? '-' }}</span><br>
                                {{ __('user_page.Location') }}
                                <span>{{ $restaurant->owner->location ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- ALERT CONTENT STATUS --}}
                    @auth
                        @if (auth()->user()->id == $restaurant->created_by)
                            @if ($restaurant->status == '0')
                                <div id="activation0">
                                    <div class="alert alert-danger d-flex flex-row align-items-center"
                                        role="alert">
                                        <span>{{ __('user_page.this content is deactive,') }} </span>
                                        <button class="btn" onclick="requestActivation()"
                                            type="submit">{{ __('user_page.request activation') }}</button>
                                        <span> ?</span>
                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '1')
                                <div id="activation1">
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active') }},</span>
                                        <button class="btn" onclick="requestDeactivation()"
                                            type="submit">{{ __('user_page.request deactivation') }}</button>
                                        <span> ?</span>
                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '2')
                                <div id="activation2" class="">
                                    <div class="alert alert-warning d-flex flex-row align-items-center"
                                        role="warning">
                                        <span>{{ __('user_page.you have been request activation for this content, Please wait until the process is complete.') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '3')
                                <div id="activation3">
                                    <div class="alert alert-warning d-flex flex-row align-items-center"
                                        role="warning">
                                        <span>{{ __('user_page.you have been request deactivation for this content,') }}
                                        </span>
                                        <button class="btn" type="submit"
                                            onclick="cancelDeactivation()">{{ __('user_page.cancel deactivation') }}</button>
                                        <span> ?</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                            @if ($restaurant->status == '0')
                                <div id="adminFood0">
                                    <div class="alert alert-danger d-flex flex-row align-items-center"
                                        role="alert">
                                        <span>{{ __('user_page.this content is deactive') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '1')
                                <div id="adminFood1">
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFood">
                                                <option value="AA"
                                                    {{ $restaurant->grade == 'AA' ? 'selected' : '' }}>AA
                                                </option>
                                                <option value="A"
                                                    {{ $restaurant->grade == 'A' ? 'selected' : '' }}>A
                                                </option>
                                                <option value="B"
                                                    {{ $restaurant->grade == 'B' ? 'selected' : '' }}>B
                                                </option>
                                                <option value="C"
                                                    {{ $restaurant->grade == 'C' ? 'selected' : '' }}>C
                                                </option>
                                                <option value="D"
                                                    {{ $restaurant->grade == 'D' ? 'selected' : '' }}>D
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '2')
                                <div id="adminFood2">
                                    <div class="alert alert-warning d-flex justify-content-start" role="warning">
                                        <span>{{ __('user_page.the owner request activation, choose grade Food') }}
                                        </span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade" name="grade" id="grade2">
                                                <option value="AA"
                                                    {{ $restaurant->grade == 'AA' ? 'selected' : '' }}>AA
                                                </option>
                                                <option value="A"
                                                    {{ $restaurant->grade == 'A' ? 'selected' : '' }}>A
                                                </option>
                                                <option value="B"
                                                    {{ $restaurant->grade == 'B' ? 'selected' : '' }}>B
                                                </option>
                                                <option value="C"
                                                    {{ $restaurant->grade == 'C' ? 'selected' : '' }}>C
                                                </option>
                                                <option value="D"
                                                    {{ $restaurant->grade == 'D' ? 'selected' : '' }}>D
                                                </option>
                                            </select>
                                        </div>
                                        <span style="margin-left: 10px;">and</span>
                                        <button class="btn" type="submit" style="margin-top: -7px;"
                                            onclick="ActivationContent()">{{ __('user_page.activate this content') }}</button>
                                    </div>
                                </div>
                            @endif
                            @if ($restaurant->status == '3')
                                <div id="adminFood3">
                                    <div class="alert alert-warning d-flex flex-row align-items-center"
                                        role="warning">
                                        <span>{{ __('user_page.the owner request deactivation,') }}' </span>
                                        <form
                                            action="{{ route('admin_food_update_status', $restaurant->id_restaurant) }}"
                                            method="get">
                                            <button class="btn"
                                                type="submit">{{ __('user_page.deactivate this content') }}</button>
                                        </form>
                                        <span> ?</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endauth
                    {{-- END ALERT CONTENT STATUS --}}

                    @guest
                        <hr>
                        {{-- <h4 style="margin-bottom: -10px;">{{ __('user_page.Nearby Villas & Things To Do') }}
                        </h4> --}}
                        {{-- EDIT TO SWIPE CAROUSEL --}}

                        {{-- <div class="container-xxl mx-auto p-0">
                                    <div class="slick-pop-slider">
                                        <div class="Container1">
                                            <div class="Head">
                                                <h6><i class="fa-solid fa-house"></i></span>
                                                    {{ __('user_page.Villas') }} <span class="Arrows1"></span></h6>
                                            </div>
                                            <!-- Carousel Container -->
                                            <div class="SlickCarousel1">
                                                @forelse ($nearby_villas as $item)
                                                    <!-- Item -->
                                                    <div class="ProductBlock">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a onclick="loginForm()" style="cursor: pointer;">
                                                                    <svg viewBox="0 0 32 32"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="presentation"
                                                                        focusable="false"
                                                                        class="favorite-button-22 favorite-button"
                                                                        id="likeButton"
                                                                        style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                        <path
                                                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        @endguest
                                                        @auth
                                                            @php
                                                                $cekVilla = App\VillaSave::where('id_villa', $item->detail->id_villa)
                                                                    ->where('id_user', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            @if ($cekVilla == null)
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button favorite-button-22 likeButtonvilla{{ $item->detail->id_villa }}"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $item->detail->id_villa }}"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @endif

                                                        @endauth
                                                        <div class="Content">
                                                            <!-- loop setiap gambar disini -->
                                                            @foreach ($item->detail->photo->sortBy('order') as $itemPhoto)
                                                                <div class="img-fill">
                                                                    <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                        target="_blank">
                                                                        <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                            alt="Villas" loading="lazy">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                            <!-- akhir loop setiap gambar -->
                                                        </div>
                                                        <div class="bottom-fill grid-one-line max-lines">
                                                            <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                target="_blank">{{ $item->detail->name }}</a>
                                                        </div>
                                                        <div class="desc-container-grid mb-2">
                                                            <div
                                                                class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                @if ($item->detail->short_description)
                                                                    <span
                                                                        class="translate-text-single">{{ $item->detail->short_description }}</span>
                                                                @else
                                                                    {{ __('user_page.There is no description yet') }}
                                                                @endif
                                                            </div>
                                                            @if ($item->detail->price)
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    <span
                                                                        class="fw-600 ml-1 text-14 font-black list-description">
                                                                        {{ CurrencyConversion::exchangeWithUnit($item->detail->price) }}
                                                                        /
                                                                        {{ __('user_page.night') }}
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    {{ __('user_page.Price is unknown') }}
                                                                </div>
                                                            @endif
                                                            <!-- change to real distance -->
                                                            <div class="text-grey-1 mt-1 text-13">
                                                                <i class="fa-solid text-orange fa-location-dot"></i>
                                                                <span class="text-grey-1"><span class="text-grey-1"
                                                                        id="travelDistance"></span>{{ $item->kilometer }}
                                                                    {{ __('user_page.km from this restaurant') }}</span>
                                                            </div>
                                                            <div>
                                                                <p class="text-grey-1 mt-1 text-13">
                                                                    @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                        <!-- <i class="fa-solid text-orange fas fa-plane"></i> |  -->
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
                                                                    @else
                                                                        <i class="fa-solid text-orange fa-car"></i> <span
                                                                            class="text-grey-1"
                                                                            id="">{{ $item->detail->eta_driving }}</span>
                                                                        | <i
                                                                            class="fa-solid text-orange fa-person-walking"></i>
                                                                        <span class="text-grey-1"
                                                                            id="">{{ $item->detail->eta_walking }}</span>
                                                                    @endIf
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="no-data">
                                                                <span>{{ __('user_page.No villas found') }}</span></a>
                                                            </p>
                                                        </center>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <!-- Carousel Container -->
                                        </div>
                                    </div>
                                </div> --}}

                        {{-- <div class="container-xxl mx-auto p-0">
                                    <div class="slick-pop-slider">
                                        <div class="Container2">
                                            <!-- <div class="row col-12 Arrows2"></div> -->
                                            <div class="Head">
                                                <h6><i class="fa fa-walking"></i></span>
                                                    {{ __('user_page.Things To Do') }} <span class="Arrows2"></span>
                                                </h6>
                                            </div>
                                            <!-- Carousel Container -->
                                            <div class="SlickCarousel2">
                                                @forelse ($nearby_activities as $item)
                                                    <!-- Item -->
                                                    <div class="ProductBlock">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a onclick="loginForm()" style="cursor: pointer;">
                                                                    <svg viewBox="0 0 32 32"
                                                                        class="favorite-button favorite-button-22 white-stroke"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="presentation"
                                                                        focusable="false"
                                                                        class="favorite-button favorite-button-22"
                                                                        style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                        <path
                                                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        @endguest
                                                        @auth
                                                            @php
                                                                $cekActivity = App\ActivitySave::where('id_activity', $item->detail->id_activity)
                                                                    ->where('id_user', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            @if ($cekActivity == null)
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_activity }}, 'activity')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke likeButtonactivity{{ $item->detail->id_activity }}"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_activity }}, 'activity')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke unlikeButtonactivity{{ $item->detail->id_activity }}"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endauth
                                                        <div class="Content">
                                                            <!-- loop setiap gambar disini -->
                                                            @foreach ($item->detail->photo->sortBy('order') as $itemPhoto)
                                                                <div class="img-fill">
                                                                    <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                        target="_blank">
                                                                        <img src="{{ URL::asset('/foto/activity/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                            alt="{{ __('user_page.Things To Do') }}"
                                                                            loading="lazy">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                            <!-- akhir loop setiap gambar -->
                                                        </div>
                                                        <div class="bottom-fill grid-one-line max-lines">
                                                            <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                target="_blank">{{ $item->detail->name }}</a>
                                                        </div>
                                                        <div class="desc-container-grid mb-2">
                                                            <div
                                                                class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                @if ($item->detail->short_description)
                                                                    <span
                                                                        class="translate-text-single">{{ $item->detail->short_description }}</span>
                                                                @else
                                                                    {{ __('user_page.There is no description yet') }}
                                                                @endif
                                                            </div>
                                                            @if ($item->detail->price->count() <= 0 || !$item->detail->price->sortBy('price')->first()->price)
                                                                <div
                                                                    class="text-14 fw-400 grid-one-line font-black list-description">
                                                                    {{ __('user_page.Price is unknown') }}
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="text-14 fw-400 grid-one-line font-black list-description">
                                                                    {{ __('user_page.Start from') }}
                                                                    <span
                                                                        class="fw-600 ml-1 text-14 font-black list-description">
                                                                        {{ CurrencyConversion::exchangeWithUnit($item->detail->price->sortBy('price')->first()->price) }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                             <!-- change to real distance  -->
                                                            <div class="text-grey-1 mt-1 text-13"><i
                                                                    class="fa-solid text-orange fa-location-dot"></i>
                                                                <span class="text-grey-1"><span class="text-grey-1"
                                                                        id="travelDistance"></span>{{ $item->kilometer }}
                                                                    {{ __('user_page.km from this restaurant') }}</span>
                                                            </div>
                                                            <div>
                                                                <p class="text-grey-1 mt-1 text-13">
                                                                    @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                        <!-- <i class="fa-solid text-orange fas fa-plane"></i> |  -->
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
                                                                    @else
                                                                        <i class="fa-solid text-orange fa-car"></i> <span
                                                                            class="text-grey-1"
                                                                            id="">{{ $item->detail->eta_driving }}</span>
                                                                        | <i
                                                                            class="fa-solid text-orange fa-person-walking"></i>
                                                                        <span class="text-grey-1"
                                                                            id="">{{ $item->detail->eta_walking }}</span>
                                                                    @endIf
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="no-data">
                                                                <span>{{ __('No things to do found') }}</span></a>
                                                            </p>
                                                        </center>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <!-- Carousel Container -->
                                        </div>
                                    </div>
                                </div> --}}

                    @endguest

                    @auth
                        @if (Auth::user()->role_id != 3)
                            <hr>
                            <!-- <h4 style="margin-bottom: -10px;">
                                                                {{ __('user_page.Nearby Villas & Things To Do') }}
                                                            </h4> -->
                            {{-- EDIT TO SWIPE CAROUSEL --}}

                            {{-- <div class="container-xxl mx-auto p-0">
                                        <div class="slick-pop-slider">
                                            <div class="Container1">
                                                <div class="Head">
                                                    <h6><i class="fa-solid fa-house"></i></span>
                                                        {{ __('user_page.Villas') }} <span class="Arrows1"></span>
                                                    </h6>
                                                </div>
                                                <!-- Carousel Container -->
                                                <div class="SlickCarousel1">
                                                    @forelse ($nearby_villas as $item)
                                                        <!-- Item -->
                                                        <div class="ProductBlock">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="loginForm()" style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button-22 favorite-button"
                                                                            id="likeButton"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @endguest
                                                            @auth
                                                                @php
                                                                    $cekVilla = App\VillaSave::where('id_villa', $item->detail->id_villa)
                                                                        ->where('id_user', Auth::user()->id)
                                                                        ->first();
                                                                @endphp
                                                                @if ($cekVilla == null)
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button favorite-button-22 likeButtonvilla{{ $item->detail->id_villa }}"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $item->detail->id_villa }}"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @endif

                                                            @endauth
                                                            <div class="Content">
                                                                <!-- loop setiap gambar disini -->
                                                                @foreach ($item->detail->photo->sortBy('order') as $itemPhoto)
                                                                    <div class="img-fill">
                                                                        <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                            target="_blank">
                                                                            <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                                alt="Villas" loading="lazy">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                <!-- akhir loop setiap gambar -->
                                                            </div>
                                                            <div class="bottom-fill grid-one-line max-lines">
                                                                <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                    target="_blank">{{ $item->detail->name }}</a>
                                                            </div>
                                                            <div class="desc-container-grid mb-2">
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    @if ($item->detail->short_description)
                                                                        <span
                                                                            class="translate-text-single">{{ $item->detail->short_description }}</span>
                                                                    @else
                                                                        {{ __('user_page.There is no description yet') }}
                                                                    @endif
                                                                </div>
                                                                @if ($item->detail->price)
                                                                    <div
                                                                        class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                        <span
                                                                            class="fw-600 ml-1 text-14 font-black list-description">
                                                                            {{ CurrencyConversion::exchangeWithUnit($item->detail->price) }}
                                                                            /
                                                                            {{ __('user_page.night') }}
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                        {{ __('user_page.Price is unknown') }}
                                                                    </div>
                                                                @endif
                                                                <!-- change to real distance -->
                                                                <div class="text-grey-1 mt-1 text-13">
                                                                    <i class="fa-solid text-orange fa-location-dot"></i>
                                                                    <span class="text-grey-1"><span class="text-grey-1"
                                                                            id="travelDistance"></span>{{ $item->kilometer }}
                                                                        {{ __('user_page.km from this restaurant') }}</span>
                                                                </div>
                                                                <div>
                                                                    <p class="text-grey-1 mt-1 text-13">
                                                                        @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                            <!-- <i class="fa-solid text-orange fas fa-plane"></i> | -->
                                                                            <i
                                                                                class="fa-solid text-orange fas fa-ship"></i>
                                                                        @else
                                                                            <i class="fa-solid text-orange fa-car"></i>
                                                                            <span class="text-grey-1"
                                                                                id="">{{ $item->detail->eta_driving }}</span>
                                                                            | <i
                                                                                class="fa-solid text-orange fa-person-walking"></i>
                                                                            <span class="text-grey-1"
                                                                                id="">{{ $item->detail->eta_walking }}</span>
                                                                        @endIf
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <center>
                                                                <p class="no-data">
                                                                    <span>{{ __('user_page.No villas found') }}</span></a>
                                                                </p>
                                                            </center>
                                                        </div>
                                                    @endforelse
                                                </div>
                                                <!-- Carousel Container -->
                                            </div>
                                        </div>
                                    </div> --}}

                            {{-- <div class="container-xxl mx-auto p-0">
                                        <div class="slick-pop-slider">
                                            <div class="Container2">
                                                <!-- <div class="row col-12 Arrows2"></div> -->
                                                <div class="Head">
                                                    <h6><i class="fa fa-walking"></i></span>
                                                        {{ __('user_page.Things To Do') }} <span
                                                            class="Arrows2"></span>
                                                    </h6>
                                                </div>
                                                <!-- Carousel Container -->
                                                <div class="SlickCarousel2">
                                                    @forelse ($nearby_activities as $item)
                                                        <!-- Item -->
                                                        <div class="ProductBlock">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="loginForm()" style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button favorite-button-22"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @endguest
                                                            @auth
                                                                @php
                                                                    $cekActivity = App\ActivitySave::where('id_activity', $item->detail->id_activity)
                                                                        ->where('id_user', Auth::user()->id)
                                                                        ->first();
                                                                @endphp
                                                                @if ($cekActivity == null)
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_activity }}, 'activity')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                class="favorite-button favorite-button-22 white-stroke likeButtonactivity{{ $item->detail->id_activity }}"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_activity }}, 'activity')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                class="favorite-button favorite-button-22 white-stroke unlikeButtonactivity{{ $item->detail->id_activity }}"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                            <div class="Content">
                                                                <!-- loop setiap gambar disini -->
                                                                @foreach ($item->detail->photo->sortBy('order') as $itemPhoto)
                                                                    <div class="img-fill">
                                                                        <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                            target="_blank">
                                                                            <img src="{{ URL::asset('/foto/activity/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                                alt="{{ __('user_page.Things To Do') }}"
                                                                                loading="lazy">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                <!-- akhir loop setiap gambar  -->
                                                            </div>
                                                            <div class="bottom-fill grid-one-line max-lines">
                                                                <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                    target="_blank">{{ $item->detail->name }}</a>
                                                            </div>
                                                            <div class="desc-container-grid mb-2">
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    @if ($item->detail->short_description)
                                                                        <span
                                                                            class="translate-text-single">{{ $item->detail->short_description }}</span>
                                                                    @else
                                                                        {{ __('user_page.There is no description yet') }}
                                                                    @endif
                                                                </div>
                                                                @if ($item->detail->price->count() <= 0 || !$item->detail->price->sortBy('price')->first()->price)
                                                                    <div
                                                                        class="text-14 fw-400 grid-one-line font-black list-description">
                                                                        {{ __('user_page.Price is unknown') }}
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="text-14 fw-400 grid-one-line font-black list-description">
                                                                        {{ __('user_page.Start from') }}
                                                                        <span
                                                                            class="fw-600 ml-1 text-14 font-black list-description">
                                                                            {{ CurrencyConversion::exchangeWithUnit($item->detail->price->sortBy('price')->first()->price) }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                                <!-- change to real distance -->
                                                                <div class="text-grey-1 mt-1 text-13"><i
                                                                        class="fa-solid text-orange fa-location-dot"></i>
                                                                    <span class="text-grey-1"><span class="text-grey-1"
                                                                            id="travelDistance"></span>{{ $item->kilometer }}
                                                                        {{ __('user_page.km from this restaurant') }}</span>
                                                                </div>
                                                                <div>
                                                                    <p class="text-grey-1 mt-1 text-13">
                                                                        @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                            <!-- <i class="fa-solid text-orange fas fa-plane"></i> | -->
                                                                            <i
                                                                                class="fa-solid text-orange fas fa-ship"></i>
                                                                        @else
                                                                            <i class="fa-solid text-orange fa-car"></i>
                                                                            <span class="text-grey-1"
                                                                                id="">{{ $item->detail->eta_driving }}</span>
                                                                            | <i
                                                                                class="fa-solid text-orange fa-person-walking"></i>
                                                                            <span class="text-grey-1"
                                                                                id="">{{ $item->detail->eta_walking }}</span>
                                                                        @endIf
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <center>
                                                                <p class="no-data">
                                                                    <span>{{ __('No things to do found') }}</span></a>
                                                                </p>
                                                            </center>
                                                        </div>
                                                    @endforelse
                                                </div>
                                                <!-- Carousel Container -->
                                            </div>
                                        </div>
                                    </div> --}}
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- END FULL WIDTH ABOVE FOOTER --}}
</div>
{{-- MODAL --}}

{{-- OTHER MODAL --}}
@include('user.modal.restaurant.restaurant-guest-safety')
@auth
    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) ||
        auth()->user()->id == $restaurant->created_by)
        @include('user.modal.restaurant.restaurant-guest-safety')
        @include('user.modal.restaurant.edit.edit-restaurant-guest-safety')
        @include('user.modal.restaurant.edit.edit-restaurant-rules')
        @include('user.modal.restaurant.facilities_add')
        @include('user.modal.restaurant.menu')
        @include('user.modal.restaurant.location')
        @include('user.modal.restaurant.restaurant_profile')
        @include('user.modal.restaurant.story')
        @include('user.modal.restaurant.contact')
        @include('user.modal.restaurant.tag_add')
    @endif
    @include('user.modal.advert-listing')
@endauth
@include('user.modal.restaurant.description')
@include('user.modal.restaurant.review')
{{-- END OTHER MODAL --}}

{{-- MODAL SCRIPT --}}
<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            $('html').css('overflow', 'hidden');
        }).on('hidden.bs.modal', function() {
            $('html').css('overflow', 'auto');
        });
    });

    function edit_contact() {
        $('#modal-edit_contact').modal('show');
    }

    function showMoreDescription() {
        $("#modal-show_description").modal("show");
    }

    function edit_name() {
        $('#modal-edit_name').modal('show');
    }

    function edit_short_description() {
        $('#modal-edit_short_description').modal('show');
    }

    function edit_description() {
        $('#modal-edit_description').modal('show');
    }

    function showMoreReview() {
        $("#modal-show_review").modal("show");
    }

    function edit_photo() {
        $('#modal-edit_photo').modal('show');
    }

    function edit_location() {
        $('#modal-edit_location').modal('show');
    }

    function edit_story() {
        $('#modal-edit_story').modal('show');
    }

    function edit_menu() {
        $('#modal-edit_menu').modal('show');
    }

    function edit_restaurant_profile() {
        $('#modal-edit_restaurant_profile').modal('show');
    }
</script>
{{-- END MODAL SCRIPT --}}
{{-- STORY MODAL --}}
<div class="modal fade" id="storymodalrestaurant" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
    style="border-radius: 10px;">
    <div class="modal-dialog modal-xl modal-fullscreen-md-down" role="document">
        <div class="modal-content modal-content-story video-container" style="width:980px;">
            <center>
                <h5 class="video-title" id="story-title"></h5>
                <video controls id="story-video" class="video-modal">
                    <source src="">
                    {{ __("user_page.Your browser doesn't support HTML5 video tag") }}
                </video>
                <button type="button" class="btn-close btn-close-white d-md-none" data-bs-dismiss="modal" onclick="close_story()"
                    aria-label="Close"></button>
            </center>
        </div>
    </div>
</div>
<script>
    function view_story_restaurant(id) {
        $.ajax({
            type: "GET",
            url: "/restaurant/story/" + id,
            dataType: "JSON",
            success: function(data) {
                // $('[name="id_story"]').val(data[0].id_story);
                // let restaurant = document.getElementById("restaurant").value;
                let video = document.getElementById('story-video');
                let public = '/foto/restaurant/';
                let slash = '/';
                let uid = '{{ $restaurant->uid }}';
                var lowerCaseUid = uid.toLowerCase();
                video.src = public + lowerCaseUid + slash + data[0].name;
                video.load();
                video.play();
                $("#story-title").text(data[0].title);
                $('#storymodalrestaurant').modal('show');
            }
        });
    }

    $(function() {
        $('#storymodalrestaurant').modal({
            show: false
        }).on('hidden.bs.modal', function() {
            $(this).find('video')[0].pause();
        });
    });
</script>
{{-- MODAL VIDEO --}}
<div class="modal fade" id="videomodalrestaurant" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
    style="border-radius: 10px;">
    <div class="modal-dialog modal-xl" role="document">
        <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
            aria-label="Close"></button>
        <h5 class="video-title" id="video-title"></h5><br>
        <div class="modal-content video-container">
            <center>
                <video controls id="video" class="video-modal">
                    {{ __("user_page.Your browser doesn't support HTML5 video tag") }}
                </video>
            </center>
        </div>
    </div>
</div>
<script>
    function view_video_restaurant(id) {
        console.log(id);
        $.ajax({
            type: "GET",
            url: "/restaurant/video/" + id,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                var video = document.getElementById('video');
                var public = '/foto/restaurant/';
                var slash = '/';
                var uid = '{{ $restaurant->uid }}';
                var lowerCaseUid = uid.toLowerCase();
                video.src = public + lowerCaseUid + slash + data.name;
                video.load();
                video.play();
                // $("#video-title").html(data.name);
                $('#videomodalrestaurant').modal('show');
            }
        });
    }
    // $(function() {
    //     $('#videomodalrestaurant').modal({
    //         show: false
    //     }).on('hidden.bs.modal', function() {
    //         $(this).find('video')[0].pause();
    //     });
    // });
</script>
{{-- MODAL AMENITIES --}}
<div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.All Facilities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_amenities()"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1 translate-text-group" id="contentModalFacilities">
                @forelse ($restaurant->facilities as $item)
                    <div class='col-6 mb-3'>
                        <span class="translate-text-group-items">{{ $item->name }}</span>
                    </div>
                @empty
                    <div class='col-12 mb-3'>
                        <span>{{ __('user_page.there is no facilities yet') }}</span>
                    </div>
                @endforelse
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<script>
    function view_amenities() {
        $('#modal-amenities').modal('show');
    }

    function close_amenities() {
        $('#modal-amenities').modal('hide');
    }

    function close_story() {
        $('#storymodalrestaurant').modal('hide');
    }
</script>

<script>
    function add_photo_tag(e) {
        let id_photo = e.getAttribute("data-photo");
        $('#id_photo').val(id_photo);

        // $('#caption_photo').val(idc.caption);

        $('#modal-add_photo_tag').modal('show');
    }
</script>

{{-- MODAL ADD PHOTO Tag --}}
<div class="modal fade" id="modal-add_photo_tag" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: white; border-radius:25px">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Add Photo Tag') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('restaurant_update_tag_photo') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                    <input type="hidden" id="id_photo" name="id_photo" value="">
                    <div class="row">
                        <div class="col-12">
                            <label>Choose tag for this photo</label>
                            <select name="tag">
                                {{-- @php
                                    $id_photo = "<script>document.write($('#id_photo').val());</script>";
                                    @endphp --}}
                                @foreach ($photoTag as $tag)
                                    <option value="{{ $tag->id_subcategory }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            {{-- {{ $id_photo }} --}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('user_page.Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- MODAL TAGS --}}
<div class="modal fade" id="modal-tag" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: white; border-radius:25px">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.All Tags') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_tag()"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 500px; overflow-y: auto;">
                <div class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                    <h5 class="mb-3">{{ __('user_page.Cuisine') }}</h5>
                    <div id="cuisineModalContent">
                        @foreach ($restaurant->cuisine as $item)
                            <div class='col-md-6'><span
                                    class="translate-text-group-items">{{ $item->name }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                    <h5 class="mb-3">{{ __('user_page.Dietary Food') }}</h5>
                    <div id="dietaryFoodModalContent">
                        @foreach ($restaurant->dietaryfood as $item)
                            <div class='col-md-6'><span
                                    class="translate-text-group-items">{{ $item->name }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                    <h5 class="mb-3">{{ __('user_page.Dishes') }}</h5>
                    <div id="dishesModalContent">
                        @foreach ($restaurant->dishes as $item)
                            <div class='col-md-6'><span
                                    class="translate-text-group-items">{{ $item->name }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                    <h5 class="mb-3">{{ __('user_page.Good For') }}</h5>
                    <div id="goodForModalContent">
                        @foreach ($restaurant->goodfor as $item)
                            <div class='col-md-6'><span
                                    class="translate-text-group-items">{{ $item->name }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                    <h5 class="mb-3">{{ __('user_page.Meal') }}</h5>
                    <div id="mealModalContent">
                        @foreach ($restaurant->meal as $item)
                            <div class='col-md-6'><span
                                    class="translate-text-group-items">{{ $item->name }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer" style="height: 20px;">

            </div>
        </div>
    </div>
</div>
<script>
    function view_tag() {
        $('#modal-tag').modal('show');
    }

    function close_tag() {
        $('#modal-tag').modal('hide');
    }
</script>

<!-- MENU MODAL -->
<div class="modal fade" id="modal-menu" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-menu-content" style="background: white; border-radius:25px">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <img src="" alt="" class="img-fluid" style="border-radius:15px;">
                <h5 style="color: #FF7400; margin-top: 10px; margin-bottom: 5px;"></h5>
                <p style="height:250px; overflow-x:auto"></p>
            </div>
        </div>
    </div>
</div>
<script>
    async function view_menu(id) {
        await $.ajax({
            type: "get",
            dataType: 'json',
            url: '/restaurant/menu/${id}',
            statusCode: {
                500: () => {
                    alert(`{{ __('user_page.internal server error') }}`);
                },
                404: () => {
                    alert(`{{ __('user_page.data not found') }}`);
                },
            },
            success: async function(data) {
                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'IDR',
                });
                var price = formatter.format(data.price).replace(/(\.0+|0+)$/, '');
                console.log(data);
                $('#modal-menu-content').children('.modal-header').children('.modal-title').text(data
                    .name);
                var src =
                    '{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/menu' . '/' . '${data.foto}') }}';
                $('#modal-menu-content').children('.modal-body').children('img').attr('src', src);
                $('#modal-menu-content').children('.modal-body').children('h5').text(
                    '${price}');
                $('#modal-menu-content').children('.modal-body').children('p').text(data.description);
                $('#modal-menu').modal('show');
            }
        });
    }
</script>

{{-- MODAL RESERVE --}}
{{-- <div class="modal fade" id="modal-reserve" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-1">
            <div class=" reserve-block">
                <input type="hidden" id="id_restaurant" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
        @auth
        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt" style="color:green; padding-right:5px;"
                data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
        @endif
        @endauth
        <div class="row">
            <div class="col-7">
                <p class="price-box">IDR <span>{{ number_format($restaurant->price, 0, ',', '.') }}</span>/night
                </p>
            </div>
            <div class="col-5">
                <p class="price-box"><i class="fa fa-star" style="color: orange; font-size:14px"></i>
                    {{ $ratting[0]->average }} reviews</p>
            </div>
        </div>
        <div class="reserve-inner-block">
            <div class="row">
                <div class="col-6 p-5-price line-right">
                    <p class="price-box text-center"><strong>CHECK-IN</strong><br>
                        <input class="text-center" type="text" id="check_in_2" name="check_in" style="width:80%; border:0"
                            placeholder="Add Date">
                    </p>
                </div>
                <div class="col-6 p-5-price">
                    <p class="price-box text-center"><strong>CHECK-OUT</strong><br>
                        <input class="text-center" type="text" id="check_out_2" name="check_out" style="width:80%; border:0"
                            placeholder="Add Date">
                    </p>
                </div>
            </div>
            <div class="col-12 p-9-price line-top">
                <p class="price-box"><strong>GUESTS</strong></p>
                <button type="button" class="collapsible"><span id="total_guest"></span> Guest</button>
                <div class="content">
                    <div class="row">
                        <div class="col-6">
                            <p class="price-box mb-2">Adults (13 up)</p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2"><input type="number" min="0" max="{{ $restaurant->adult }}" value="1"
                                    id="adult" name="adult" style="width: 70%"></p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2">Children (2-12)</p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2"><input type="number" min="0" max="{{ $restaurant->children }}"
                                    id="child" name="child" value="0" style="width: 70%"></p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2">Infant (under 2)</p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2"><input type="number" min="0" value="0" style="width: 70%">
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2">Pets</p>
                        </div>
                        <div class="col-6">
                            <p class="price-box mb-2"><input type="number" min="0" value="0" style="width: 70%">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 p-5-price text-center"><input class="price-button" type="submit" value="RESERVE NOW">
        </div>
        <div class="col-12 p-5-price price-box text-center">You won't be charged yet</div>
        <div class="row">
            <div class="col-7 price-box">Sub Total<input id="sum_night" value="0"
                    style="width: 25px; text-align:right; border:0"> nights</div>
            <div class="col-5 price-box">IDR <span id="total" style="font-size:100%">0</span></div>
            <div class="col-7 price-box">Service Fee</div>
            <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-7 price-box"><strong>Total Before Taxes</strong></div>
            <div class="col-5 price-box">IDR <strong><span id="total_all" style="font-size:100%">0</span></strong></div>
        </div>
        </div>
        <div class="diamond-block price-box">
            <div class="row">
                <div class="col-9">
                    <strong>This is a rare find.</strong> Valeria's place on EZ Villas Bali is usually fully booked.
                </div>
                <div class="col-3"><img
                        src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                </div>
            </div>
        </div>
        </div>
    </div> --}}

{{-- MODAL SHARE --}}
<div class="modal fade" id="modal-share" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: white; border-radius:25px">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Share') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="fs-3 fw-bold mb-0">
                    {{ __('user_page.Share this place with your friend and family') }}</p>
                <div class="d-flex gap-3 align-items-center py-3">
                    @if ($restaurant->image)
                        <img src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}"
                            style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                    @else
                        <img src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                            style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                    @endif
                    <p class=mb-0">{{ $restaurant->name }}</p>
                </div>
                <div>
                    @guest
                        <div class="modal-share-container">
                            <div class="col-lg col-12 p-3 border br-10">
                                <a type="button" class="d-flex p-0 copier"
                                    href="{{ route('restaurant', $restaurant->id_restaurant) }}"
                                    onclick="copyURI(event)">
                                    {{ __('user_page.Copy Link') }}
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('restaurant', $restaurant->id_restaurant) }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">Facebook</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://api.whatsapp.com/send?text={{ route('restaurant', $restaurant->id_restaurant) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://telegram.me/share/url?url={{ route('restaurant', $restaurant->id_restaurant) }}&text={{ route('restaurant', $restaurant->id_restaurant) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('restaurant', $restaurant->id_restaurant) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                            class="fw-normal">Email</span></div>
                                </a>
                            </div>
                        </div>
                    @endguest

                    @auth
                        <div class="modal-share-container">
                            <div class="col-lg col-12 p-3 border br-10">
                                <a type="button" class="d-flex p-0 copier"
                                    href="{{ route('restaurant', $restaurant->id_restaurant) }}"
                                    onclick="copyURI(event)">
                                    {{ __('user_page.Copy Link') }}
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('restaurant', $restaurant->id_restaurant) }}?ref={{ Auth::user()->user_code }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">Facebook</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://api.whatsapp.com/send?text={{ route('restaurant', $restaurant->id_restaurant) }}?ref={{ Auth::user()->user_code }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://telegram.me/share/url?url={{ route('restaurant', $restaurant->id_restaurant) }}?ref={{ Auth::user()->user_code }}&text={{ route('restaurant', $restaurant->id_restaurant) }}?ref={{ Auth::user()->user_code }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('restaurant', $restaurant->id_restaurant) }}?ref={{ Auth::user()->user_code }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                            class="fw-normal">Email</span></div>
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function share() {
        $("#modal-share").modal("show");
    }
</script>
{{-- MODAL CONTACT RESTAURANT --}}
<div class="modal fade" id="modal-contact_restaurant" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: white; border-radius:25px; margin-top: 150px;">
            <div class="modal-header">
                <h5 class="modal-title"><span id="nameRestoInContact">{{ $restaurant->name }}</span>
                    {{ __('user_page.Contact') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="col-11">
                        <b style="font-size: 15px;" class="price-box">
                            <span id="restoPhoneInContact">{{ $restaurant->phone }}</span>
                        </b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="col-11">
                        <b style="font-size: 15px;" class="price-box">
                            <span id="restoEmailInContact">{{ $restaurant->email }}</span>
                        </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function contact_restaurant() {
        $('#modal-contact_restaurant').modal('show');
    }
</script>
{{-- MODAL CONTACT HOST --}}
<div class="modal fade" id="modal-contact-host" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: white; border-radius:25px">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.FAQ') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('villa_store_user_message') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_owner" value="{{ $restaurant->created_by }}">
                    <div class="form-group">
                        <textarea name="message" rows="10" class="form-control w-100" value="{{ old('message') }}" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('user_page.Send') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL Reorder image --}}
<div class="modal fade" id="edit_position_photo" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen" role="document">
        <div class="modal-content" style="background: white;">
            <div class="modal-header" style="padding-left: 18px;">
                <h7 class="modal-title" style="font-size: 1.875rem;">
                    {{ __('user_page.Edit Position Photos') }}</h7>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body pb-1">

                {{-- <input type="hidden" name="id_owner" value="{{ $restaurant->created_by }}"> --}}
                {{-- reorder image --}}
                <ul id="sortable-photo">
                    @forelse ($restaurant->photo->sortBy('order') as $item)
                        @php
                            $id = $item->id_photo;
                            $name = $item->name;
                        @endphp
                        <li class="ui-state-default" data-id="{{ $id }}"
                            id="positionPhotoGallery{{ $id }}">
                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                data-src="{{ asset('foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}"
                                title="{{ $name }}">
                        </li>
                    @empty
                        {{ __('user_page.there is no image yet') }}
                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <div style="clear: both; width: 100%;">
                    <button type='submit' id="saveBtnReorderPhoto" class="btn-edit-position-photos"
                        onclick="save_reorder_photo()">{{ __('user_page.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL Reorder video --}}
<div class="modal fade" id="edit_position_video" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen" role="document">
        <div class="modal-content" style="background: white;">
            <div class="modal-header" style="padding-left: 18px;">
                <h7 class="modal-title" style="font-size: 1.875rem;">
                    {{ __('user_page.Edit Position Video') }}</h7>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body pb-1">

                {{-- <input type="hidden" name="id_owner" value="{{ $restaurant->created_by }}"> --}}
                {{-- reorder image --}}
                <ul id="sortable-video">
                    @forelse ($restaurant->video->sortBy('order') as $item)
                        @php
                            $id = $item->id_video;
                            $name = $item->name;
                        @endphp
                        <li class="ui-state-default" data-id="{{ $id }}"
                            id="positionVideoGallery{{ $id }}">
                            <video loading="lazy"
                                src="{{ asset('foto/restaurant/' . $restaurant->uid . '/' . $item->name) }}#t=1.0">
                        </li>
                    @empty
                        {{ __('user_page.there is no image yet') }}
                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <div style="clear: both;">
                    <button type='submit' id="saveBtnReorderVideo" class="btn-edit-position-photos"
                        onclick="save_reorder_video()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.modal.auth.login_register')

@include('layouts.user.footer')
</div>
{{-- END MODAL --}}

<script>
    function loginForm(value) {
        console.log(value);
        if (value == 1) {
            $('#loginAlert').removeClass('d-none');
            $('#registerAlert').removeClass('d-none');
        }
        if (value == 2) {
            $('#loginAlert').addClass('d-none');
            $('#registerAlert').addClass('d-none');
        }
        sidebarhide();
        $('#LoginModal').modal('show');
    }
</script>


<script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>



<script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
{{-- Page JS Plugins --}}
<script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<script src="{{ asset('assets/js/story-admin-slider.js') }}"></script>
<script src="{{ asset('assets/js/story-slider.js') }}"></script>
<script src="{{ asset('assets/js/thingstodo-slider.js') }}"></script>
<script src="{{ asset('assets/js/villa-slider.js') }}"></script>
{{-- <script src="{{ asset('assets/js/view-villa.js') }}"></script> --}}
<script src="{{ asset('assets/js/crud-restaurant.js') }}"></script>
<script src="{{ asset('assets/js/simpleLightbox.js') }}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

{{-- SweetAlert JS --}}
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    window.onscroll = function() {
        myFunction();
        if ((document.getElementById("popup_check").style.display = "block")) {
            document.getElementById("popup_check").style.display = "none";
        }
        if ((document.getElementById("popup_guest").style.display = "block")) {
            document.getElementById("popup_guest").style.display = "none";
        }
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    // var about_sticky = document.getElementById("about-sticky");
    // var description = document.getElementById("description");
    // var descriptiona = description.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");

            document.getElementById("navbarright").classList.add("active");

            document
                .getElementById("add_class_popup")
                .classList.remove("header-popup");
            document
                .getElementById("searchbox")
                .classList.add("searchbox-display-block");
            document
                .getElementById("searchbox")
                .classList.remove("searchbox-display-none");
            document.getElementById("search_bar").classList.remove("active");
            document
                .getElementById("change_display_block")
                .classList.add("display-none");
            document
                .getElementById("change_display_block")
                .classList.remove("display-block");
        } else {
            navbar.classList.remove("sticky");
            document.getElementById("navbarright").classList.remove("active");
            document
                .getElementById("add_class_popup")
                .classList.remove("header-popup");
            document
                .getElementById("searchbox")
                .classList.add("searchbox-display-block");
            document
                .getElementById("searchbox")
                .classList.remove("searchbox-display-none");
            document.getElementById("search_bar").classList.remove("active");
            document
                .getElementById("change_display_block")
                .classList.add("display-none");
            document
                .getElementById("change_display_block")
                .classList.remove("display-block");
            document
                .getElementById("search_bar")
                .classList.remove("searchbar-display-block");
            document
                .getElementById("row_popup")
                .classList.remove("row-popup-height");
        }
    }
</script>

@guest
    <script>
        $(function() {
            var increment = 3;
            var startFilter = 0;
            var endFilter = increment;
            var $this = $('.gallery2');
            var elementLength = $this.find('a').length;
            $('.listLength').text(elementLength);

            if (elementLength > 2) {
                $('.buttonToogle').show();
            }
            $('.gallery2 .itemsMenu').slice(startFilter, endFilter).addClass('shown');
            $('.shownLength').text(endFilter);
            $('.gallery2 .itemsMenu').not('.shown').hide();
            $('.buttonToogle .showMore').on('click', function() {
                if (elementLength > endFilter) {
                    startFilter += increment;
                    endFilter += increment;
                    $('.gallery2 .itemsMenu').slice(startFilter, endFilter).not('.shown').addClass('shown')
                        .toggle(500);
                    $('.shownLength').text((endFilter > elementLength) ? elementLength : endFilter);
                    if (elementLength <= endFilter) {
                        $(this).remove();
                    }
                }

            });
        });
    </script>
@endguest

<script>
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    var url_string2 = window.location.href
    var url2 = new URL(url_string2);

    if (url2.searchParams.get('ref')) {
        setCookie("ref", url2.searchParams.get('ref'), 1095);
    }
</script>

{{-- EDIT POSITION PHOTO & VIDEO --}}
<script>
    $(document).ready(function() {
        // Initialize sortable
        $("#sortable-video").sortable();
        $("#sortable-photo").sortable();

        if ($(window).width() < 992) {
            //Setter
            $("#sortable-video").sortable("option", "disabled", true);
            $("#sortable-photo").sortable("option", "disabled", true);
        } else {
            //Setter
            $("#sortable-video").sortable("option", "disabled", false);
            $("#sortable-photo").sortable("option", "disabled", false);
        }

        //handle resize
        $(window).on("resize", function() {
            if ($(this).width() < 992) {
                //Setter
                $("#sortable-video").sortable("option", "disabled", true);
                $("#sortable-photo").sortable("option", "disabled", true);
            } else {
                //Setter
                $("#sortable-video").sortable("option", "disabled", false);
                $("#sortable-photo").sortable("option", "disabled", false);
            }
        })

        //initialize timeout variable
        var timeOut = 0;

        //clear time out to prevent memory leak
        $("#edit_position_photo").on("click", function(e) {
            if (e.target.id == "edit_position_photo") {
                clearTimeout(timeOut);
            }
        })
        $("#edit_position_video").on("click", function(e) {
            if (e.target.id == "edit_position_video") {
                clearTimeout(timeOut);
            }
        })
        $("#edit_position_photo .modal-header .btn-close-modal").on("click", function() {
            clearTimeout(timeOut);
        })
        $("#edit_position_video .modal-header .btn-close-modal").on("click", function() {
            clearTimeout(timeOut);
        })

        //event for mobile
        $("#sortable-photo .ui-state-default img").on("mouseenter", function() {
            if ($(window).width() < 992) {
                timeOut = setTimeout(function() {
                    $("#sortable-photo .ui-state-default img").addClass("shake-anim");
                    $("#sortable-photo").sortable("option", "disabled", false);
                }, 500);
            }
        }).on("mouseup mouseleave", function() {
            if ($(window).width() < 992) {
                $("#sortable-photo .ui-state-default img").removeClass("shake-anim");
                $("#sortable-photo").sortable("option", "disabled", true);
            }
        })
        $("#sortable-video .ui-state-default video").on("mouseenter", function() {
            if ($(window).width() < 992) {
                timeOut = setTimeout(function() {
                    $("#sortable-video .ui-state-default video").addClass("shake-anim");
                    $("#sortable-video").sortable("option", "disabled", false);
                }, 500);
            }
        }).on("mouseup mouseleave", function() {
            if ($(window).width() < 992) {
                $("#sortable-video .ui-state-default video").removeClass("shake-anim");
                $("#sortable-video").sortable("option", "disabled", true);
            }
        })
    });

    function position_photo() {
        $('#edit_position_photo').modal('show');
    }
    // Save order
    function save_reorder_photo() {

        let btn = document.getElementById("saveBtnReorderPhoto");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");

        var imageids_arr = [];
        // get image ids order
        $('#sortable-photo li').each(function() {
            var id = $(this).data('id');
            imageids_arr.push(id);
        });
        // AJAX request
        $.ajax({
            url: '/restaurant/update/photo/position',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                imageids: imageids_arr,
                id: '{{ $restaurant->id_restaurant }}'
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                let path = "/foto/restaurant/";
                let slash = "/";
                let uid = response.data.uid.uid;
                let lowerCaseUid = uid.toLowerCase();
                let content = "";
                let contentPositionModal = "";

                let galleryDiv = $('.gallery');
                let galleryLength = galleryDiv.find('a').length;

                if (galleryLength == 0) {
                    $('.gallery').html("");
                }

                for (let i = 0; i < response.data.photo.length; i++) {
                    content += '<div class="col-4 grid-photo" id="displayPhoto' +
                        response.data.photo[i].id_photo +
                        '"> <a href="' +
                        path + lowerCaseUid + slash + response.data.photo[i].name +
                        '"> <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery" src="' +
                        path + lowerCaseUid + slash + response.data.photo[i].name +
                        '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" type="button" title="{{ __('user_page.Add Photo Tag') }}" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                        response.data.photo[i].id_photo +
                        '" onclick="add_photo_tag(this)"><i class="fa fa-pencil"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                        response.data.photo[i].id_photo +
                        '" onclick="delete_photo_photo(this)"><i class="fa fa-trash"></i></button> </span> </div>';

                    contentPositionModal += '<li class="ui-state-default" data-id="' + response.data.photo[
                            i]
                        .id_photo + '" id="positionPhotoGallery' + response.data.photo[i].id_photo +
                        '"> <img src="' +
                        path + lowerCaseUid + slash + response.data.photo[i].name +
                        '" title="' + response.data.photo[i].name + '"> </li>';
                }
                if (response.data.video.length > 0) {
                    for (let v = 0; v < response.data.video.length; v++) {
                        content += '<div class="col-4 grid-photo" id="displayVideo' + response.data.video[v]
                            .id_video +
                            '"> <a class="pointer-normal" onclick="view_video_restaurant(' +
                            response.data.video[v].id_video +
                            ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                            path + lowerCaseUid + slash + response.data.video[v].name +
                            '#t=1.0"></video> <span class="video-grid-button"><i class="fa fa-play"></i></span> </a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-video="' +
                            response.data.video[v].id_video +
                            '" onclick="delete_photo_video(this)" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Video') }}"><i class="fa fa-trash"></i></button> </span> </div>';
                    }
                }

                btn.textContent = "{{ __('user_page.Save') }}";
                btn.classList.remove("disabled");

                $('.gallery').html("");
                $('.gallery').append(content);
                $('#sortable-photo').html("");
                $('#sortable-photo').append(contentPositionModal);

                $("#edit_position_photo").modal("hide");

                $gallery.refresh();
            }
        });
    }

    function position_video() {
        $('#edit_position_video').modal('show');
    }

    function save_reorder_video() {

        let btn = document.getElementById("saveBtnReorderVideo");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");

        var videoids_arr = [];
        // get video ids order
        $('#sortable-video li').each(function() {
            var id = $(this).data('id');
            videoids_arr.push(id);
        });
        // AJAX request
        $.ajax({
            url: '/restaurant/update/video/position',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                videoids: videoids_arr,
                id: '{{ $restaurant->id_restaurant }}'
            },
            success: function(response) {
                console.log(response);

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                let path = "/foto/restaurant/";
                let slash = "/";
                let uid = response.data.uid.uid;
                let lowerCaseUid = uid.toLowerCase();
                let content = "";
                let contentPositionModal = "";

                for (let i = 0; i < response.data.photo.length; i++) {
                    content += '<div class="col-4 grid-photo" id="displayPhoto' +
                        response.data.photo[i].id_photo +
                        '"> <a href="' +
                        path + lowerCaseUid + slash + response.data.photo[i].name +
                        '"> <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery" src="' +
                        path + lowerCaseUid + slash + response.data.photo[i].name +
                        '" title="' +
                        response.data.photo[i].caption +
                        '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" type="button" title="{{ __('user_page.Add Photo Tag') }}" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                        response.data.photo[i].id_photo +
                        '" onclick="add_photo_tag(this)"><i class="fa fa-pencil"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                        response.data.photo[i].id_photo +
                        '" onclick="delete_photo_photo(this)"><i class="fa fa-trash"></i></button> </span> </div>';
                }
                if (response.data.video.length > 0) {
                    for (let v = 0; v < response.data.video.length; v++) {
                        content += '<div class="col-4 grid-photo" id="displayVideo' + response.data.video[v]
                            .id_video +
                            '"> <a class="pointer-normal" onclick="view_video_restaurant(' +
                            response.data.video[v].id_video +
                            ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                            path + lowerCaseUid + slash + response.data.video[v].name +
                            '#t=1.0"></video> <span class="video-grid-button"><i class="fa fa-play"></i></span> </a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-video="' +
                            response.data.video[v].id_video +
                            '" onclick="delete_photo_video(this)" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Video') }}"><i class="fa fa-trash"></i></button> </span> </div>';

                        contentPositionModal += '<li class="ui-state-default" data-id="' + response.data
                            .video[v]
                            .id_video + '" id="positionVideoGallery' + response.data.video[v].id_video +
                            '"> <video loading="lazy" src="' +
                            path + lowerCaseUid + slash + response.data.video[v].name +
                            '#t=1.0"> </li>';
                    }
                }

                btn.textContent = "{{ __('user_page.Save') }}";
                btn.classList.remove("disabled");

                $('.gallery').html("");
                $('.gallery').append(content);
                $('#sortable-video').html("");
                $('#sortable-video').append(contentPositionModal);

                $("#edit_position_video").modal("hide");

                $gallery.refresh();
            }
        });
    }
</script>
{{-- END EDIT POSITION PHOTO & VIDEO --}}

{{-- Guest Count --}}
<script>
    $('#adult2').on('change', function() {
        var total_adult2 = parseInt($('#adult2').val()) + parseInt($('#child2').val());
        $('#total_guest2').val(total_adult2);
        $('#adult4').val($('#adult2').val());
        $('#child4').val($('#child2').val());
        $('#total_guest4').val($('#total_guest2').val());
    });

    $('#child2').on('change', function() {
        var total_child2 = parseInt($('#adult2').val()) + parseInt($('#child2').val());
        $('#total_guest2').val(total_child2);
        $('#adult4').val($('#adult2').val());
        $('#child4').val($('#child2').val());
        $('#total_guest4').val($('#total_guest2').val());
    });
</script>

<script>
    $('#adult4').on('change', function() {
        var total_adult4 = parseInt($('#adult4').val()) + parseInt($('#child4').val());
        $('#total_guest4').val(total_adult4);
        $('#adult2').val($('#adult4').val());
        $('#child2').val($('#child4').val());
        $('#total_guest2').val($('#total_guest4').val());
    });

    $('#child4').on('change', function() {
        var total_child4 = parseInt($('#adult4').val()) + parseInt($('#child4').val());
        $('#total_guest4').val(total_child4);
        $('#adult2').val($('#adult4').val());
        $('#child2').val($('#child4').val());
        $('#total_guest2').val($('#total_guest4').val());
    });
</script>

<script>
    $('#check_in').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        mode: "range",
        showMonths: 2,
        onChange: function(selectedDates, dateStr, instance) {
            var start = new Date(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
            var end = new Date(flatpickr.formatDate(selectedDates[1], "Y-m-d"));
            var sum_night = (end - start) / 1000 / 60 / 60 / 24;
            var min_stay = $('#min_stay').val();
            var total = $('#price').val() * sum_night;
            // console.log(sum_night);
            if (sum_night < min_stay) {
                alert("minimum stay is " + min_stay + " days");
            } else {
                $('#sum_night').val(sum_night);
                $("#total").text(total.toString().replace(
                    /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                    "."));
                $("#total_all").text(total.toString().replace(
                    /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                    "."));
            }
            $('#check_in').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
            $('#check_out').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"));
            $('#check_in3').val($('#check_in').val());
            $('#check_out3').val($('#check_out').val());
            $('#sum_night3').val($('#sum_night').val());
            $('#total3').text(total.toString().replace(
                /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                "."));
            $('#total_all3').text(total.toString().replace(
                /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                "."));
        }
    });
</script>

<script>
    $('#check_in2').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        mode: "range",
        showMonths: 2,
        onChange: function(selectedDates, dateStr, instance) {
            $('#check_out2').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: new Date(dateStr).fp_incr(1),
                onChange: function(selectedDates, dateStr, instance) {
                    var start = new Date($('#check_in2').val());
                    var end = new Date($('#check_out2').val());
                    var min_stay = $('#min_stay').val();
                    var minimum = new Date($('#check_in2').val()).fp_incr(min_stay);
                    if (sum_night < min_stay) {
                        alert("minimum stay is " + min_stay + " days");
                    }
                }
            });

            $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
            $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"));
        }
    });
</script>

<script>
    $('#check_in3').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        mode: "range",
        showMonths: 2,
        onChange: function(selectedDates, dateStr, instance) {
            var start = new Date(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
            var end = new Date(flatpickr.formatDate(selectedDates[1], "Y-m-d"));
            var sum_night = (end - start) / 1000 / 60 / 60 / 24;
            var min_stay = $('#min_stay').val();
            var total = $('#price').val() * sum_night;
            // console.log(sum_night);
            if (sum_night < min_stay) {
                alert("minimum stay is " + min_stay + " days");
            } else {
                $('#sum_night3').val(sum_night);
                $("#total3").text(total.toString().replace(
                    /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                    "."));
                $("#total_all3").text(total.toString().replace(
                    /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                    "."));
            }
            $('#check_in3').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
            $('#check_out3').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"));
            $('#check_in').val($('#check_in3').val());
            $('#check_out').val($('#check_out3').val());
            $('#sum_night').val($('#sum_night3').val());
            $('#total').text(total.toString().replace(
                /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                "."));
            $('#total_all').text(total.toString().replace(
                /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                "."));
        }
    });
</script>

<script>
    $("#searchbox").click(function() {
        $("#search_bar").toggleClass("active");
    });
</script>

{{-- IMAGE UPLOAD --}}
<script>
    $(".image-box").click(function(event) {
        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
            });
    });
</script>
{{-- END IMAGE UPLOAD --}}

<script>
    // function replace ascii to string in every input
    function asciiToString(str) {
        var newStr = str;
        var arrAsciiIndex = [...str.matchAll(/[&#0-9;]/g)];
        if (arrAsciiIndex.length >= 3) {
            for (var i = 0; i < arrAsciiIndex.length; i++) {
                if (str[arrAsciiIndex[i].index] === "&" && i != arrAsciiIndex.length - 1) {
                    if (arrAsciiIndex[i + 1] != undefined) {
                        if (str[arrAsciiIndex[i + 1].index] === "#") {
                            if (arrAsciiIndex[i + 2] != undefined) {
                                if (!isNaN(parseInt(str[arrAsciiIndex[i + 2].index]))) {
                                    var lastIndex = i + 3;
                                    var number = str[arrAsciiIndex[i + 2].index];
                                    while (lastIndex < arrAsciiIndex.length) {
                                        if (!isNaN(parseInt(str[arrAsciiIndex[lastIndex].index]))) {
                                            number += str[arrAsciiIndex[lastIndex].index];
                                            lastIndex++;
                                        } else {
                                            break;
                                        }
                                    }
                                    var escapeChar = String.fromCharCode(parseInt(number));
                                    var pattern = str[arrAsciiIndex[i].index] + str[arrAsciiIndex[i + 1].index] +
                                        number + ";"
                                    newStr = newStr.replace(pattern, escapeChar);
                                }
                            }
                        }
                    }
                }
            }
        }
        return newStr;
    }
</script>

{{-- UPDATE FORM --}}
<script>
    function editNameForm() {
        var formattedText = asciiToString(document.getElementById("name-form-input").value);
        document.getElementById("name-form-input").value = formattedText;
        var form = document.getElementById("name-form");
        var content = document.getElementById("name-content");
        var formInput = document.getElementById("name-form-input");
        form.classList.add("d-block");
        content.classList.add("d-none");

        if (formInput.value == 'Food Name Here') {
            formInput.value = '';
        }
    }

    function editNameCancel() {
        var form = document.getElementById("name-form");
        var formInput = document.getElementById("name-form-input");
        var content = document.getElementById("name-content");
        form.classList.remove("d-block");
        content.classList.remove("d-none");

        //mengembalikan value sebelum disave ketika klik button cancel
        formInput.value = name_resto_backup;

        if (formInput.value == 'Food Name Here') {
            formInput.value = '';
        }
    }
</script>

<script>
    function editShortDescriptionForm() {
        var formattedText = asciiToString(document.getElementById("short-description-form-input").value);
        document.getElementById("short-description-form-input").value = formattedText;
        var form = document.getElementById("short-description-form");
        var content = document.getElementById("short-description-content");
        var formInput = document.getElementById("short-description-form-input");
        form.classList.add("d-block");
        content.classList.add("d-none");
        if (formInput.value == 'Make your short description here') {
            formInput.value = '';
        };
    }

    function editShortDescriptionCancel() {
        var form = document.getElementById("short-description-form");
        var formInput = document.getElementById("short-description-form-input");
        var content = document.getElementById("short-description-content");
        form.classList.remove("d-block");

        //mengembalikan value sebelum disave ketika klik button cancel
        formInput.value = short_desc_backup;

        content.classList.remove("d-none");
        if (formInput.value == 'Make your short description here') {
            formInput.value = '';
        };
    }
</script>

<script>
    function editTimeForm() {
        var form = $("#time-form");
        var content = $("#time-content");
        let id_restaurant = $('#id_restaurant').val();

        $.ajax({
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/restaurant/get/time",
            data: {
                id_restaurant: id_restaurant,
            },
            success: function(response) {
                console.log(response);

                $("#open-time-input").val(response.data.open_time);
                $("#closed-time-input").val(response.data.closed_time);

                $(form).show();
                $(content).hide();
            }
        });

    }

    function editTimeFormMobile() {
        var form = $("#time-form-mobile");
        var content = $("#time-content-mobile");
        $(form).show();
        $(content).hide();
    }

    function editTimeFormCancel() {
        var form = $("#time-form");
        var content = $("#time-content");
        // var openTimeInput = $('#open-time-input');
        // var closeTimeInput = $('#close-time-input');
        // $(openTimeInput).val('{{ $restaurant->open_time }}');
        // $(closeTimeInput).val('{{ $restaurant->closed_time }}');
        $(form).hide();
        $(content).show();
    }

    function editTimeFormMobileCancel() {
        var form = $("#time-form-mobile");
        var content = $("#time-content-mobile");
        var openTimeInput = $('#open-time-input');
        var closeTimeInput = $('#close-time-input');
        $(openTimeInput).val('{{ $restaurant->open_time }}');
        $(closeTimeInput).val('{{ $restaurant->closed_time }}');
        $(form).hide();
        $(content).show();
    }
</script>

<script>
    function editTypeForm() {
        var form = $("#type-form");
        var content = $("#type-content");
        $(form).show();
        $(content).hide();
    }

    function editTypeFormCancel() {
        var form = $("#type-form");
        var content = $("#type-content");
        // var restaurantTypeInput = $('#restaurant-type-input');
        // var restaurantPriceInput = $('#restaurant-price-input');
        // $(restaurantTypeInput).val('{{ $restaurant->open_time }}');
        // $(restaurantPriceInput).val('{{ $restaurant->closed_time }}');
        $(form).hide();
        $(content).show();
    }
</script>

<script>
    function editTypeFormMobile() {
        var form = $("#type-form-mobile");
        var content = $("#type-content-mobile");
        $(form).show();
        $(content).hide();
    }

    function editTypeFormMobileCancel() {
        var form = $("#type-form-mobile");
        var content = $("#type-content-mobile");
        // var restaurantTypeInput = $('#restaurant-type-input');
        // var restaurantPriceInput = $('#restaurant-price-input');
        // $(restaurantTypeInput).val('{{ $restaurant->open_time }}');
        // $(restaurantPriceInput).val('{{ $restaurant->closed_time }}');
        $(form).hide();
        $(content).show();
    }
</script>

{{-- <script>
    function editDescriptionForm() {
        var formattedText = asciiToString(document.getElementById("description-form-input").value);
        document.getElementById("description-form-input").value = formattedText;
        var form = document.getElementById("description-form");
        var content = document.getElementById("description-content");
        var btn = document.getElementById("btnShowMoreDescription");
        form.classList.add("d-block");
        content.classList.add("d-none");
        if (btn != null) {
            btn.classList.add("d-none");
        }
    }

    function editDescriptionCancel() {
        var form = document.getElementById("description-form");
        var formInput = document.getElementById("description-form-input");
        var content = document.getElementById("description-content");
        var btn = document.getElementById("btnShowMoreDescription");
        form.classList.remove("d-block");
        content.classList.remove("d-none");
        if (btn != null) {
            btn.classList.add("d-none");
        }
        // formInput.value = '{{ $restaurant->description }}';
    }
</script> --}}
{{-- END UPDATE FORM --}}

{{-- DROPZONE JS --}}
<script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}

<script>
    var $gallery;
    var $gallery2;
    $(document).ready(function() {
        $gallery = new SimpleLightbox('.gallery a', {});
        $gallery2 = new SimpleLightbox('.gallery2 a', {});
    });
</script>

<script>
    // Dropzone.autoDiscover = false;
    Dropzone.options.frmTarget = {
        autoProcessQueue: false,
        thumbnailWidth: 960,
        url: '/restaurant/photo/store',
        parallelUploads: 50,
        init: function() {

            var myDropzone = this;

            // Update selector to match your button
            $("#button").click(function(e) {
                e.preventDefault();
                if (!myDropzone.files.length) {
                    $(".dz-image-add").css("border", "solid #e04f1a 1px");
                    $('#err-dz').show();
                } else {
                    $(".dz-image-add").css("border", "");
                    $('#err-dz').hide();
                    myDropzone.processQueue();

                    $("#button").html('Uploading Gallery...');
                    $("#button").addClass('disabled');
                }
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                // var data = $('#frmTarget').serializeArray();
                // $.each(data, function(key, el) {
                //     formData.append(el.name, el.value);
                // });
                var value = $('form#formData #id_restaurant').val();
                formData.append('id_restaurant', value);
            });

            this.on('queuecomplete', function(file, response, message) {
                $("#button").html('Upload');
                $("#button").removeClass('disabled');
            });

            this.on("complete", function(file, response, message) {
                this.removeFile(file);
            });

            this.on("addedfile", function(file) {
                $(".dz-image-add").css("border", "");
                $('#err-dz').hide();
                // Create the remove button
                var removeButton = Dropzone.createElement(
                    "<center><button class='btn btn-outline-light btn-del'>{{ __('user_page.Remove') }}</button></center>"
                );


                // Capture the Dropzone instance as closure.
                var _this = this;

                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    _this.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });
        },
        error: function(file, message, xhr) {
            this.removeFile(file); // perhaps not remove on xhr errors

            for (let i = 0; i < message.message.length; i++) {
                iziToast.error({
                    title: "Error",
                    message: message.message[i],
                    position: "topRight",
                });
            }
        },
        success: function(file, message, response) {
            console.log(file);
            // console.log(response);
            console.log(message);

            iziToast.success({
                title: "Success",
                message: message.message,
                position: "topRight",
            });

            let path = "/foto/restaurant/";
            let slash = "/";
            let uid = message.data.uid.uid;
            let lowerCaseUid = uid.toLowerCase();
            let content;
            let contentPositionModal;
            let contentPositionModalVideo;
            let contentStory;

            let galleryDiv = $('.gallery');
            let galleryLength = galleryDiv.find('a').length;
            let modalPhotoLength = $('#sortable-photo').find('li').length;
            let modalVideoLength = $('#sortable-video').find('li').length;

            if (modalPhotoLength == 0) {
                $("#sortable-photo").html("");
            }

            if (modalVideoLength == 0) {
                $('#sortable-video').html("");
            }

            if (galleryLength == 0) {
                $('.gallery').html("");
            }

            if (message.data.photo.length > 0) {
                content = '<div class="col-4 grid-photo" id="displayPhoto' +
                    message.data.photo[0].id_photo +
                    '"> <a href="' +
                    path + lowerCaseUid + slash + message.data.photo[0].name +
                    '"> <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery" src="' +
                    path + lowerCaseUid + slash + message.data.photo[0].name +
                    '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" type="button" title="{{ __('user_page.Add Photo Tag') }}" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                    message.data.photo[0].id_photo +
                    '" onclick="add_photo_tag(this)"><i class="fa fa-pencil"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-photo="' +
                    message.data.photo[0].id_photo +
                    '" onclick="delete_photo_photo(this)"><i class="fa fa-trash"></i></button> </span> </div>';

                contentPositionModal = '<li class="ui-state-default" data-id="' + message.data.photo[0]
                    .id_photo + '" id="positionPhotoGallery' + message.data.photo[0].id_photo +
                    '"> <img src="' +
                    path + lowerCaseUid + slash + message.data.photo[0].name +
                    '" title="' + message.data.photo[0].name + '"> </li>';

                $('.gallery').append(content);
                $('#sortable-photo').append(contentPositionModal);
            }
            if (message.data.video.length > 0) {
                content = '<div class="col-4 grid-photo" id="displayVideo' + message.data.video[0].id_video +
                    '"> <a class="pointer-normal" onclick="view_video_restaurant(' +
                    message.data.video[0].id_video +
                    ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                    path + lowerCaseUid + slash + message.data.video[0].name +
                    '#t=1.0"></video> <span class="video-grid-button"><i class="fa fa-play"></i></span> </a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-video="' +
                    message.data.video[0].id_video +
                    '" onclick="delete_photo_video(this)" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Video') }}"><i class="fa fa-trash"></i></button> </span> </div>';

                contentPositionModalVideo = '<li class="ui-state-default" data-id="' + message.data.video[0]
                    .id_video + '" id="positionVideoGallery' + message.data.video[0].id_video +
                    '"> <video loading="lazy" src="' +
                    path + lowerCaseUid + slash + message.data.video[0].name +
                    '#t=1.0"> </li>';

                contentStory =
                    '<div class="card4 col-lg-3 radius-5" id="displayStoryVideo' +
                    message.data.video[0].id_video +
                    '"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_video_restaurant(' +
                    message.data.video[0].id_video +
                    ')"> <div class="story-video-player"><i class="fa fa-play"></i> </div> <video href="javascript:void(0)" class="story-video-grid" loading="lazy" style="object-fit: cover;" src="' +
                    path +
                    lowerCaseUid +
                    slash +
                    message.data.video[0].name +
                    '#t=1.0"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                    id_restaurant +
                    '" data-video="' +
                    message.data.video[0].id_video +
                    '" onclick="delete_photo_video(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';

                $('.gallery').append(content);
                $('#sortable-video').append(contentPositionModalVideo);
                $("#storyContent").append(contentStory);
                sliderRestaurant();
            }

            $gallery.refresh();

            this.removeFile(file);
        },
    }
</script>

<script>
    // Dropzone.autoDiscover = false;
    Dropzone.options.frmMenu = {
        autoProcessQueue: false,
        thumbnailWidth: 960,
        url: '/restaurant/menu/store_multi',
        parallelUploads: 50,
        init: function() {

            var myDropzone = this;

            // Update selector to match your button
            $("#button_menu").click(function(e) {
                e.preventDefault();
                if (!myDropzone.files.length) {
                    $(".dz-mn").css("border", "solid #e04f1a 1px");
                    $('#err-dz-mn').show();
                } else {
                    $(".dz-mn").css("border", "");
                    $('#err-dz-mn').hide();
                    myDropzone.processQueue();

                    $("#button_menu").html('Uploading Menu...');
                    $("#button_menu").addClass('disabled');
                }
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                // var data = $('#frmTarget').serializeArray();
                // $.each(data, function(key, el) {
                //     formData.append(el.name, el.value);
                // });
                var value = $('form#formData #id_restaurant').val();
                formData.append('id_restaurant', value);
            });

            this.on('queuecomplete', function() {});

            this.on("complete", function(file, response, message) {
                this.removeFile(file);
            });

            this.on("addedfile", function(file) {
                $(".dz-mn").css("border", "");
                $('#err-dz-mn').hide();
                // Create the remove button
                var removeButton = Dropzone.createElement(
                    "<center><button class='btn btn-outline-light btn-del'>{{ __('user_page.Remove') }}</button></center>"
                );


                // Capture the Dropzone instance as closure.
                var _this = this;

                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    _this.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });
        },
        error: function(file, message, xhr) {
            this.removeFile(file); // perhaps not remove on xhr errors

            for (let i = 0; i < message.message.length; i++) {
                iziToast.error({
                    title: "Error",
                    message: message.message[i],
                    position: "topRight",
                });
            }

            $("#button_menu").html('Upload');
            $("#button_menu").removeClass('disabled');
        },
        success: function(file, message, response) {
            console.log(file);
            // console.log(response);
            console.log(message);

            iziToast.success({
                title: "Success",
                message: message.message,
                position: "topRight",
            });

            let path = "/foto/restaurant/";
            let slash = "/";
            let menuPath = "menu";
            let uid = message.data.uid.uid;
            var lowerCaseUid = uid.toLowerCase();
            let content = "";

            let menuDiv = $('.gallery2');
            let menuLength = menuDiv.find('a').length;

            if (menuLength == 0) {
                $('.gallery2').html("");
                // $('.gallery2').html('<p style="text-align: justify; padding-top:10px; padding-bottom:12px; padding-left:10px; padding-right:10px;">{{ __('user_page.There is no menu yet') }}</p>');
            }

            for (let i = 0; i < message.data.menu.length; i++) {
                content += '<div class="col-4 grid-photo" id="displayMenu' +
                    message.data.menu[i].id_menu +
                    '"> <a class="itemsMenu" href="' +
                    path +
                    lowerCaseUid +
                    slash +
                    menuPath +
                    slash +
                    message.data.menu[i].foto +
                    '"> <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery" src="' +
                    path +
                    lowerCaseUid +
                    slash +
                    menuPath +
                    slash +
                    message.data.menu[i].foto +
                    '" title="' +
                    message.data.menu[i].name +
                    '"> </a> <span class="edit-menu-icon"> <button style="height:40px" href="javascript:void(0);" data-id="{{ $restaurant->id_restaurant }}" data-menu="' +
                    message.data.menu[i].id_menu +
                    '" onclick="delete_menu(this)" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete Menu"><i class="fa fa-trash"></i></button> </span> </div>';
            }

            $(".gallery2").append(content);

            $gallery2.refresh();

            this.removeFile(file);

            $("#button_menu").html('Upload');
            $("#button_menu").removeClass('disabled');
        },
    }
</script>

{{-- END DROPZONE JS --}}
<script>
    $(document).ready(function() {
        var $window = $(window);
        var $sidebar = $("#sidebar_fix");
        // var $amenitiesTop = $("#amenities").offset().top;
        // var $sidebarHeight = $sidebar.height();
        var $result = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
            '#sidebar_fix .reserve-block').height() + parseInt($('#sidebar_fix .reserve-block').css(
            "top"))) - 60;

        // console.log($amenitiesOffsetTop);
        $window.on("resize", function() {
            // $amenitiesTop = $("#amenities").offset().top;
            // $sidebarHeight = $sidebar.height();
            $result = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
                '#sidebar_fix .reserve-block').height() + parseInt($(
                '#sidebar_fix .reserve-block').css("top"))) - 60;
        });

        $window.scroll(function() {
            // $amenitiesTop = $("#amenities").offset().top + 110;
            // $sidebarHeight = $sidebar.height();
            $result = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
                '#sidebar_fix .reserve-block').height() + parseInt($(
                '#sidebar_fix .reserve-block').css("top"))) - 60;
            if ($window.scrollTop() >= 0 && $window.scrollTop() < $result) {
                $sidebar.addClass("fixed");
                $sidebar.css({
                    "top": "0",
                });
            } else {
                console.log($result);
                $sidebar.css({
                    "top": $result,
                    "position": "absolute"
                });
                $sidebar.removeClass("fixed");
            }
        });
    });
</script>

<script>
    function add_tag() {
        $('#modal-add_tag').modal('show');
    }
</script>

<script>
    // Show Hide Reserve Button

    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= $(
                '.rsv-block').offset().top + $('.rsv-block').outerHeight() - window.innerHeight) {

            document.getElementById("rsv-block-btn").style.display = "block";
            document.getElementById("navbarright").classList.remove("active");
        } else {
            document.getElementById("rsv-block-btn").style.display = "none";
        };
    });
</script>

<script>
    // Collapsable

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

<script>
    function adult_increment() {
        document.getElementById('adult2').stepUp();
        document.getElementById('total_guest2').stepUp();
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('adult4').value = document.getElementById('adult2').value;
    }

    function adult_decrement() {
        document.getElementById('adult2').stepDown();
        document.getElementById('total_guest2').stepDown();
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('adult4').value = document.getElementById('adult2').value;
    }

    function child_increment() {
        document.getElementById('child2').stepUp();
        document.getElementById('total_guest2').stepUp();
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('child4').value = document.getElementById('child2').value;
    }

    function child_decrement() {
        document.getElementById('child2').stepDown();
        document.getElementById('total_guest2').stepDown();
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('child4').value = document.getElementById('child2').value;
    }

    function infant_increment() {
        document.getElementById('infant2').stepUp();
        document.getElementById('infant4').value = document.getElementById('infant2').value;
    }

    function infant_decrement() {
        document.getElementById('infant2').stepDown();
        document.getElementById('infant4').value = document.getElementById('infant2').value;
    }

    function pet_increment() {
        document.getElementById('pet2').stepUp();
        document.getElementById('pet4').value = document.getElementById('pet2').value;
    }

    function pet_decrement() {
        document.getElementById('pet2').stepDown();
        document.getElementById('pet4').value = document.getElementById('pet2').value;
    }
</script>

{{-- Sweetalert Function Delete Profile Image --}}
<script>
    function delete_profile_image(ids) {
        var ids = ids;
        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/${ids.id}/delete/image`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message, 'success');
                        showingLoading();
                        location.reload();
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`, `{{ __('user_page.Canceled Deleted Data') }}`,
                    'error')
            }
        });
    };
</script>

{{-- Sweetalert Function Delete Story --}}
<script>
    function delete_story(e) {
        var id = e.getAttribute("data-restaurant");
        var story = e.getAttribute("data-story");

        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/${id}/delete/story/${story}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message, 'success');

                        //remove element story
                        $('#story' + story).remove();

                        //update slider ketika story dihapus
                        sliderRestaurant();
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`, 'Canceled Deleted Data', 'error')
            }
        });
    };
</script>

{{-- Sweetalert Function Delete Photo --}}
<script>
    function delete_photo_photo(ids) {
        let id = ids.getAttribute("data-id");
        let photo = ids.getAttribute("data-photo");

        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                let displayBlack = document.getElementById('untukDelete');
                displayBlack.style.display = "block";

                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/${id}/delete/photo/photo/${photo}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message, 'success');
                        $(`#displayPhoto${photo}`).remove();
                        $("#positionPhotoGallery" + photo).remove();

                        let galleryDiv = $('.gallery');
                        let galleryLength = galleryDiv.find('a').length;

                        if (galleryLength == 0) {
                            $('.gallery').html("");
                            $('.gallery').html('{{ __('user_page.there is no gallery yet') }}');
                        }

                        $gallery.refresh();
                        displayBlack.style.display = "none";
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`, `{{ __('user_page.Canceled Deleted Data') }}`,
                    'error')
            }
        });
    };
</script>

{{-- Sweetalert Function Delete Photo --}}
<script>
    function delete_photo_video(ids) {
        let id = ids.getAttribute("data-id");
        let video = ids.getAttribute("data-video");

        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/${id}/delete/photo/video/${video}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message, 'success');
                        // showingLoading();
                        $('#displayVideo' + video).remove();
                        $("#positionVideoGallery" + video).remove();
                        $("#displayStoryVideo" + video).remove();
                        sliderRestaurant();
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`, 'Canceled Deleted Data', 'error')
            }
        });
    };
</script>

{{-- Sweetalert Function Delete Photo --}}
<script>
    function delete_menu(ids) {
        let id = ids.getAttribute("data-id");
        let menu = ids.getAttribute("data-menu");

        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            text: 'You will not be able to recover this content!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/${id}/delete/menu/${menu}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message, 'success');
                        $("#displayMenu" + menu).remove();
                        let menuDiv = $('.gallery2');
                        let menuLength = menuDiv.find('a').length;

                        if (menuLength == 0) {
                            $('.gallery2').html("");
                            $('.gallery2').html(
                                '<p style="text-align: justify; padding-top:10px; padding-bottom:12px; padding-left:10px; padding-right:10px;">{{ __('user_page.There is no menu yet') }}</p>'
                            );
                        }
                        $gallery2.refresh();
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`, 'Canceled Deleted Data', 'error')
            }
        });
    };
</script>

{{-- Sweetalert Function Request Video to Owner --}}
<script>
    function requestVideo(ids) {
        var ids = ids;
        Swal.fire({
            title: `{{ __('user_page.Do you want request a video to the Owner?') }}`,
            text: `{{ __('user_page.Requesting a video!') }}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ff7400',
            cancelButtonColor: '#000',
            cancelButtonText: `{{ __('user_page.Cancel') }}`,
            confirmButtonText: 'Yes, Request it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/restaurant/request/video/${ids.id}/${ids.name}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message, 'error');
                        }
                    },
                    success: async function(data) {
                        // console.log(data.message);
                        await Swal.fire('Success', data.message, 'success');
                        showingLoading();
                        location.reload();
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`,
                    `{{ __('user_page.Canceled Request Video') }}`, 'error')
            }
        });
    };
</script>

{{-- Highlight sticky --}}
<script>
    jQuery(document).ready(function($) {
        $(window).on('scroll', function() {
            if ($(window).scrollTop() >= $('#gallery').offset().top - 80 && $(window).scrollTop() <= $(
                    '#menu').offset().top - 60) {
                $('#gallery-sticky').addClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($(window).scrollTop() >= $('#menu').offset().top - 60 && $(window).scrollTop() <=
                $('#description').offset().top - 60) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').addClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($(window).scrollTop() >= $('#description').offset().top - 60 && $(window)
                .scrollTop() <= $('#amenities').offset().top - 60) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').addClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($(window).scrollTop() >= $('#amenities').offset().top - 60 && $(window)
                .scrollTop() <= $('#location-map').offset().top - 60) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').addClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($(window).scrollTop() >= $('#location-map').offset().top - 60 && $(window)
                .scrollTop() <= $('#review').offset().top - 60) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').addClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($(window).scrollTop() >= $('#review').offset().top - 60 && $(window)
                .scrollTop() <= $('#endSticky').offset().top - 60) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').addClass('active-sticky');
            } else {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
                //or use $('.menu').removeClass('addclass');
            }
        });
    });
</script>

{{-- PREVENT TEXTAREA TYPE ENTER --}}
{{-- <script>
    $("textarea").keydown(function(e) {
        // Enter was pressed without shift key
        if (e.keyCode == 13 && !e.shiftKey) {
            // prevent default behavior
            e.preventDefault();
        }
    });
</script> --}}


{{-- modal laguage and currency --}}
@include('user.modal.filter.filter_language')
{{-- modal laguage and currency --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
    function language() {
        sidebarhide();
        $('#LegalModal').modal('show');
        $('#trigger-tab-language').addClass('active');
        $('#content-tab-language').addClass('active');
        $('#trigger-tab-currency').removeClass('active');
        $('#content-tab-currency').removeClass('active');
    }

    function currency() {
        sidebarhide();
        $('#LegalModal').modal('show');
        $('#trigger-tab-language').removeClass('active');
        $('#content-tab-language').removeClass('active');
        $('#trigger-tab-currency').addClass('active');
        $('#content-tab-currency').addClass('active');
    }
</script>

<script>
    // Slick Slier Carousel
    $(document).ready(function() {
        $(".SlickCarousel1").slick({
            rtl: false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay: false,
            autoplaySpeed: 5000, //  Slide Delay
            speed: 800, // Transition Speed
            slidesToShow: 5, // Number Of Carousel
            slidesToScroll: 1, // Slide To Move
            pauseOnHover: false,
            appendArrows: $(".Container1 .Head .Arrows1"), // Class For Arrows Buttons
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
        $(".SlickCarousel1 .ProductBlock .Content").slick({
            rtl: false,
            autoplay: false,
            autoplaySpeed: 5000,
            speed: 800,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            easing: "linear",
            arrows: true
        })
        $(".SlickCarousel1 .ProductBlock .Content").on("mousedown mouseup", function() {
            var firstItemIndex = $(".SlickCarousel1 .slick-current").first().attr("data-slick-index");
            $(".SlickCarousel1").slick("slickGoTo", firstItemIndex);
        })
        $(".SlickCarousel1 .ProductBlock .Content .slick-prev").css("display", "none");
        $(".SlickCarousel1 .ProductBlock .Content .slick-next").css("display", "none");
        $('.SlickCarousel1 .ProductBlock .Content').mouseenter(function(e) {
            $(this).children('.slick-prev').css('display', 'block');
            $(this).children('.slick-next').css('display', 'block');
        })
        $('.SlickCarousel1 .ProductBlock .Content').mouseleave(function(e) {
            $(this).children('.slick-prev').css('display', 'none');
            $(this).children('.slick-next').css('display', 'none');
        })
    })
</script>

<script>
    // Slick Slier Carousel
    $(document).ready(function() {
        $(".SlickCarousel2").slick({
            rtl: false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay: false,
            autoplaySpeed: 5000, //  Slide Delay
            speed: 800, // Transition Speed
            slidesToShow: 5, // Number Of Carousel
            slidesToScroll: 1, // Slide To Move
            pauseOnHover: false,
            appendArrows: $(".Container2 .Head .Arrows2"), // Class For Arrows Buttons
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
        $(".SlickCarousel2 .ProductBlock .Content").slick({
            rtl: false,
            autoplay: false,
            autoplaySpeed: 5000,
            speed: 800,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            easing: "linear",
            arrows: true
        })
        $(".SlickCarousel2 .ProductBlock .Content").on("mousedown mouseup", function() {
            var firstItemIndex = $(".SlickCarousel2 .slick-current").first().attr("data-slick-index");
            $(".SlickCarousel2").slick("slickGoTo", firstItemIndex);
        })
        $(".SlickCarousel2 .ProductBlock .Content .slick-prev").css("display", "none");
        $(".SlickCarousel2 .ProductBlock .Content .slick-next").css("display", "none");
        $('.SlickCarousel2 .ProductBlock .Content').mouseenter(function(e) {
            $(this).children('.slick-prev').css('display', 'block');
            $(this).children('.slick-next').css('display', 'block');
        })
        $('.SlickCarousel2 .ProductBlock .Content').mouseleave(function(e) {
            $(this).children('.slick-prev').css('display', 'none');
            $(this).children('.slick-next').css('display', 'none');
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('.SlickCarousel3').slick({
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,
            centerMode: false,
            appendArrows: false,
            responsive: false,
        });
    });
</script>

{{-- LAZY LOAD --}}
@include('components.lazy-load.lazy-load')
{{-- END LAZY LOAD --}}

{{-- Like --}}
@auth
    @include('components.favorit.like-favorit')
@endauth
{{-- End Like --}}

@include('components.promotion.mobile-app')
<script src="{{ asset('assets/js/translate.js') }}"></script>

{{-- Request Active Deactive --}}
<script>
    function requestActivation() {
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/food/update/request-update-status`,
            data: {
                id_restaurant: id_restaurant
            },
            success: function(response) {
                if (response.data == 2) {
                    $("#activation0").html(`
                            <div class="alert alert-warning d-flex flex-row align-items-center"
                                role="warning">
                                <span>{{ __('user_page.you have been request activation for this content, Please wait until the process is complete.') }}
                                </span>
                            </div>
                        `)
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                }
            }
        });
    }

    function ActivationContent() {
        var grade = $("#grade2 option:selected").val();
        console.log(grade);
        Swal.fire({
            title: `{{ __('user_page.Are you sure?') }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff7400',
            cancelButtonColor: '#000',
            confirmButtonText: `Yes, Activate it`,
            cancelButtonText: `{{ __('user_page.Cancel') }}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: `/admin/food/update-status/${id_restaurant}`,
                    data: {
                        grade: grade
                    },
                    success: function(response) {
                        // console.log('sattt');
                        if (response.data == 1) {
                            if (response.grade == "AA") {
                                $("#adminFood2").html(`
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFoodAA">
                                                <option value="AA" selected>AA</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                `);

                                gradeAA();
                                $("#activation2").addClass('d-none');
                            } else if (response.grade == "A") {
                                $("#adminFood2").html(`
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFoodA">
                                                <option value="AA">AA</option>
                                                <option value="A" selected>A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                `)

                                gradeA();
                                $("#activation2").addClass('d-none');
                            } else if (response.grade == "B") {
                                $("#adminFood2").html(`
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFoodB">
                                                <option value="AA">AA</option>
                                                <option value="A">A</option>
                                                <option value="B" selected>B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                `)

                                gradeB();
                                $("#activation2").addClass('d-none');
                            } else if (response.grade == "C") {
                                $("#adminFood2").html(`
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFoodC">
                                                <option value="AA">AA</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C" selected>C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                `)

                                gradeC();
                                $("#activation2").addClass('d-none');
                            } else if (response.grade == "D") {
                                $("#adminFood2").html(`
                                    <div class="alert alert-success d-flex flex-row align-items-center"
                                        role="success">
                                        <span>{{ __('user_page.this content is active, edit grade Food') }}</span>
                                        <div style="margin-left: 10px;">
                                            <select class="custom-select grade-success" name="grade"
                                                id="gradeFoodD">
                                                <option value="AA">AA</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D" selected>D</option>
                                            </select>
                                        </div>
                                    </div>
                                `)

                                gradeD();
                                $("#activation2").addClass('d-none');
                            }

                            iziToast.success({
                                title: "Success",
                                message: response.message,
                                position: "topRight",
                            });
                        }
                    }
                });
            } else {
                Swal.fire(`{{ __('user_page.Cancel') }}`,
                    `Canceled Activate Data`,
                    'error')
            }
        });
    }

    function requestDeactivation() {
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/food/update/request-update-status`,
            data: {
                id_restaurant: id_restaurant
            },
            success: function(response) {
                if (response.data == 3) {
                    $("#activation1").html(`
                            <div class="alert alert-warning d-flex flex-row align-items-center"
                                role="warning">
                                <span>{{ __('user_page.you have been request deactivation for this content,') }}
                                </span>
                                <button class="btn"
                                    type="submit" onclick="cancelDeactivation()">{{ __('user_page.cancel deactivation') }}</button>
                                <span> ?</span>
                            </div>
                        `);
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                }
            }
        })
    }

    function cancelDeactivation() {
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/food/update/cancel-request-update-status`,
            data: {
                id_restaurant: id_restaurant
            },
            success: function(response) {
                if (response.data == 1) {
                    $("#activation3").html(`
                            <div class="alert alert-success d-flex flex-row align-items-center"
                                role="success">
                                <span>{{ __('user_page.this content is active') }}</span>
                            </div>
                        `);
                    $("#activation1").html(`
                            <div class="alert alert-success d-flex flex-row align-items-center"
                                role="success">
                                <span>{{ __('user_page.this content is active') }}</span>
                            </div>
                        `);
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                }
            }
        })
    }

    // ! gradeFood
    $("#gradeFood").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/food/grade/${id_restaurant}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });

    function gradeAA() {
        $("#gradeFoodAA").change(function() {
            var grade = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/food/grade/${id_restaurant}`,
                data: {
                    grade: grade,
                },
                success: function(response) {
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                },
            });
        });
    }

    function gradeA() {
        $("#gradeFoodA").change(function() {
            var grade = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/food/grade/${id_restaurant}`,
                data: {
                    grade: grade,
                },
                success: function(response) {
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                },
            });
        });
    }

    function gradeB() {
        $("#gradeFoodB").change(function() {
            var grade = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/food/grade/${id_restaurant}`,
                data: {
                    grade: grade,
                },
                success: function(response) {
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                },
            });
        });
    }

    function gradeC() {
        $("#gradeFoodC").change(function() {
            var grade = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/food/grade/${id_restaurant}`,
                data: {
                    grade: grade,
                },
                success: function(response) {
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                },
            });
        });
    }

    function gradeD() {
        $("#gradeFoodD").change(function() {
            var grade = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/food/grade/${id_restaurant}`,
                data: {
                    grade: grade,
                },
                success: function(response) {
                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });
                },
            });
        });
    }
    // ! End gradeFood
</script>
{{-- End Active Deactive --}}

{{-- Copy current URL to clipboard --}}
<script>
    function copyURI(evt) {
        evt.preventDefault();
        navigator.clipboard.writeText(evt.target.getAttribute('href')).then(() => {
            alert("Link copied");
        }, () => {
            alert("Oooppsss... failed");
        });
    }
</script>

@if ($restaurant->status == '2' && auth()->user()->id == $restaurant->created_by)
    <script>
        if (!localStorage.getItem("shareAdver") || localStorage.getItem("shareAdver") != 'true') {
            var myModal = new bootstrap.Modal(document.getElementById('advertListing-Modal'), {})
            myModal.show()
        }
    </script>
@endif

<script>
        //Drop down login 2
        var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;
        $('.btn-dropdwn').on(supportsTouch ? 'touchend' : 'click', function (event) {
        event.stopPropagation();
        $('.dropdwn').slideToggle('fast');
        });

        $(document).on(supportsTouch ? 'touchend' : 'click', function (event) {
        $('.dropdwn').slideUp('fast');
        // document.activeElement.blur();//lose focus
        });
    </script>
</body>
