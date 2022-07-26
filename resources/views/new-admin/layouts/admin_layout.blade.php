<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link href="{{ asset('assets/partner/css/styles.css') }}" rel="stylesheet" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">


    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous">
    </script>

    <style>
        /* NAVBAR */
        .loading-splash-screen {
            background-color: white !important;
            height: 100%;
            position: fixed;
            z-index: 9999;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link {
            color: #092a33;
            transition: 0.3s;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link.active {
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started {
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started-blue {
            background-color: #ff7400;
            transition: 0.3s;
        }

        .navbar-1-1 .btn-get-started-blue:hover {
            background-color: #FF7400;
            transition: 0.3s;
        }

        .borderr:hover {
            background-color: #eff3f9;
            border-radius: 30px;
            border-bottom: none !important;
        }

        .border-bottom {
            border-bottom: 2px solid #222222 !important;
        }

        /* End Navbar */
.expand-navbar-mobile {
    width: 80%;
    height: 100%;
    position: fixed;
    z-index: 1001;
    background: #eee;
    top: 0;
    bottom: 0;
    right: -80%;
}
.expanding-navbar-mobile {
    transform: translate(-100%, 0px);
    transition: all 0.2s ease;
    z-index: 1002;
}
.closing-navbar-mobile {
    transform: translate(0px, 0px);
    transition: all 0.2s ease;
}
#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 1001;
    cursor: pointer;
}
.sub-drop {
    font-size: 15px;
    color: #585656;
}
.f-arrow {
  border: solid black;
  border-width: 0 1px 1px 0;
  display: inline-block;
  padding: 3px;
  margin-right: 7px;
  margin-bottom: 3px;
}
.f-right {
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
}
.f-down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}
@media only screen and (max-width: 533px) {
    .flex-gap .bg-white {
        width: 100%;
    }
}
@media only screen and (min-width: 534px) and (max-width: 782px) {
    .flex-gap .bg-white {
        width: 48%;
    }
}
.overflow-x-auto::-webkit-scrollbar {
    display: none;
}
@media only screen and (max-width: 576px) {
    .expand-navbar-mobile .user-details-name {
        font-size: 14px !important;
    }
    .expand-navbar-mobile .user-details-email p {
        font-size: 12px !important;
    }
}
    </style>

</head>

<body class="nav-fixed">
    {{-- @component('components.loading.loading-dashboard')
    @endcomponent --}}
    @component('components.loading.loading-type2')
    @endcomponent
    <div class="expand-navbar-mobile" aria-expanded="false" style="overflow-y: scroll; overflow-x: hidden;">
        <div class="px-3 pt-2 h-100" style="overflow-x: hidden; overflow-y: auto;">
            @auth
                <div>
                    <div class="d-flex align-items-center">
                        <div class="flex-fill d-flex align-items-center me-3">
                            @if (Auth::user()->avatar)
                                <img class="lozad user-avatar" src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                    style="border-radius: 50%; width: 50px; border: solid 2px #ff7400;">
                            @else
                                <img src="{{ asset('assets/icon/menu/user_default.svg') }}" class="logged-user-photo"
                                    alt="">
                            @endif
                            <div class="dropdown">
                                <div class="user-details ms-2" style="cursor: pointer; padding-left: 10px;">
                                    <div class="user-details-name">
                                        {{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="user-details-email">
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                            style="background: transparent; border: 0;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="dropdown">
                        <a id="nav-user" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropProfile" aria-expanded="false" aria-controls="dropProfile">
                            <i id="f-user" class="f-arrow f-right"></i>Users
                        </a>
                        <div class="collapse" id="dropProfile">
                            @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                                <a class="dropdown-item sub-drop" href="{{ route('profile_user') }}">
                                    Profile
                                </a>
                                <a class="dropdown-item sub-drop" href="{{ route('account_setting') }}">
                                    Account
                                </a>
                                <a class="dropdown-item sub-drop" href="{{ route('help_guest') }}">
                                    Get Help
                                </a>
                                <a class="dropdown-item sub-drop" href="{{ route('partner_inbox') }}">
                                    Inbox
                                </a><a class="dropdown-item sub-drop" href="{{ route('calendar_index') }}">
                                    Calendar
                                </a><a class="dropdown-item sub-drop" href="{{ route('insight_dashboard') }}">
                                    Insight
                                </a>
                                <a class="dropdown-item sub-drop" href="javascript:void(0);" onclick="language()">
                                    Language and translation
                                </a>
                                <a class="dropdown-item sub-drop" href="javascript:void(0);" onclick="currency()">
                                    @if (isset(Auth::user()->currency->symbol) || isset(Auth::user()->currency->code))
                                        {{ Auth::user()->currency->symbol }} {{ Auth::user()->currency->code }}
                                    @else
                                        $ USD
                                    @endif
                                </a>
                            @endIf
                            @if (in_array(Auth::user()->role_id, [1, 2, 3, 4, 5]))
                                <a class="dropdown-item sub-drop" href="{{ route('index') }}">
                                    Switch to traveling
                                </a>
                            @endIf
                            @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                                <a class="dropdown-item sub-drop" href="{{ route('admin_tax_setting') }}">
                                    Tax Setting
                                </a>
                            @endIf
                            <a class="dropdown-item sub-drop" href="#!"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <div class="dropdown-item-icon"><i data-feather="log-out" style="margin-right: 5px;"></i>Logout</div>

                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                                style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                        <a id="nav-home" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropHomes" aria-expanded="false" aria-controls="dropHomes">
                            <i id="f-home" class="f-arrow f-right"></i>{{ __('user_page.Homes') }}
                        </a>
                        <div class="collapse" id="dropHomes">
                          <a class="dropdown-item sub-drop" href="{{ route('listing_dashboard') }}">Listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('reservations_dashboard') }}">Reservations</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_add_listing') }}">Create new listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('manage_guidebook') }}">Guidebooks</a>
                          <a class="dropdown-item sub-drop" href="{{ route('completed_payouts') }}">Transaction history</a>
                        </div>
                        <a id="nav-hotels" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropHotels" aria-expanded="false" aria-controls="dropHotels">
                            <i id="f-hotels" class="f-arrow f-right"></i>{{ __('user_page.Hotels') }}
                        </a>
                        <div class="collapse" id="dropHotels">
                          <a class="dropdown-item sub-drop" href="{{ route('dashboard_listing_hotel') }}">Listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('hotel_room_reservations_dashboard') }}">Reservations</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_add_listing') }}">Create new listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('manage_guidebook') }}">Guidebooks</a>
                          <a class="dropdown-item sub-drop" href="{{ route('completed_payouts') }}">Transaction history</a>
                        </div>
                        <a id="nav-food" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropFood" aria-expanded="false" aria-controls="dropFood">
                            <i id="f-food" class="f-arrow f-right"></i>{{ __('user_page.Food') }}
                        </a>
                        <div class="collapse" id="dropFood">
                          <a class="dropdown-item sub-drop" href="{{ route('admin_restaurant') }}">List Restaurant</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_add_listing') }}">Create new listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('manage_guidebook') }}">Guidebooks</a>
                          <a class="dropdown-item sub-drop" href="{{ route('completed_payouts') }}">Transaction history</a>
                        </div>
                        <a id="nav-wow" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropWow" aria-expanded="false" aria-controls="dropWow">
                            <i id="f-wow" class="f-arrow f-right"></i>Wow
                        </a>
                        <div class="collapse" id="dropWow">
                          <a class="dropdown-item sub-drop" href="{{ route('admin_activity') }}">List Things To Do</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_add_listing') }}">Create new listing</a>
                          <a class="dropdown-item sub-drop" href="{{ route('manage_guidebook') }}">Guidebooks</a>
                          <a class="dropdown-item sub-drop" href="{{ route('completed_payouts') }}">Transaction history</a>
                        </div>
                        <a id="nav-reward" class="navbar-gap d-block mb-2"
                            style="cursor:pointer; color:#585656; width: fit-content; text-decoration: none;" data-toggle="collapse" data-target="#dropReward" aria-expanded="false" aria-controls="dropReward">
                            <i id="f-reward" class="f-arrow f-right"></i>Reward
                        </a>
                        <div class="collapse" id="dropReward">
                          <a class="dropdown-item sub-drop" href="{{ route('admin_reward_category') }}">Reward Category</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_user_reward') }}">User Reward</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_user_reward_balance') }}">User Reward Balance</a>
                          <a class="dropdown-item sub-drop" href="{{ route('admin_staff_reward_balance') }}">Staff Reward Balance</a>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="language()" class="navbar-gap d-flex align-items-center"
                            style="color: white;">
                            @if (session()->has('locale'))
                                <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                                <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                            <p class="sub-drop mb-0 ms-2" style="margin-left:5px; color: #585656">{{ __('user_page.Choose a Language') }}</p>
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
                    {{-- <div class="d-flex align-items mb-2" id="changeThemeMobile">
                        <div class="logged-user-menu">
                            <label class="container-mode">
                                <input type="checkbox" id="background-color-switch"
                                    onclick="changeBackgroundTrigger(this)"
                                    {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                                <span class="checkmark-mode"></span>
                            </label>
                        </div>
                        <p class="mb-0 ms-2" id="switcher" style="cursor: pointer; color: #585656;">Day / Night </p>
                    </div> --}}
                    <div class="d-flex align-items-center mb-2">
                        <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                            style="color: white;">

                            @if (session()->has('currency'))
                                <p class="sub-drop mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})
                                </p>
                                {{-- <img style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                            @else
                                <p class="sub-drop mb-0 ms-2" style="color: #585656">Choose Currency</p>
                                {{-- <img style="width: 27px;" src="{{ LazyLoad::show() }}"
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
                            <img style="border-radius: 3px; width: 27px;" src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                        @else
                            <img style="border-radius: 3px; width: 27px;" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                        @endif
                        <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                    </a>
                </div>
                {{-- <div class="d-flex align-items-center mb-2" id="changeThemeMobile">
                    <div class="logged-user-menu" style="">
                        <label class="container-mode">
                            <input type="checkbox" id="background-color-switch" onclick="changeBackgroundTrigger(this)"
                                {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-mobile">
                            <span class="checkmark-mode"></span>
                        </label>
                    </div>
                    <p class="mb-0 ms-2" id="switcher" style="cursor: pointer; color: #585656;">Day / Night </p>
                </div> --}}
                <div class="d-flex align-items-center mb-2">
                    <a type="button" onclick="currency()" class="navbar-gap d-flex align-items-center"
                        style="color: white;">

                        @if (session()->has('currency'))
                            <p class="mb-0 ms-2" style="color: #585656">Change Currency ({{ session('currency') }})</p>
                            {{-- <img style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}"> --}}
                        @else
                            <p class="mb-0 ms-2" style="color: #585656">Choose Currency</p>
                            {{-- <img style="width: 27px;" src="{{ LazyLoad::show() }}"
                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}"> --}}
                        @endif

                    </a>
                </div>

            @endauth
        </div>

    </div>
    <div id="overlay"></div>
    {{-- <nav class="fixed-top shadow bg-white navbar-1-1 navbar navbar-expand-lg navbar-light p-4 px-md-4" --}}
    <nav class="navbar-1-1 navbar navbar-expand-lg navbar-light p-4 {{ Request::is('manage-your-space') ? 'shadow bg-white fixed-top' : '' }}"
        style="margin-bottom:-2%;">
        <div class="container">
            <a href="{{ route('partner_dashboard') }}" class="navbar-brand mb-n1" target="_blank">
                <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb-lg-0">
                    @if (Request::is('account-settings*') || Request::is('referral*') || Request::is('users/edit-photo') || Request::is('account-delete') || Request::is('profile*') || Request::is('owner*'))
                    @else
                        <li class="nav-item">
                            <a class="borderr nav-link px-md-4 {{ Request::is('dashboard') || Request::is('dashboard/arriving_soon') || Request::is('dashboard/checkout') || Request::is('dashboard/upcoming') ? 'border-bottom' : '' }}"
                                href="{{ route('partner_dashboard') }}"
                                style="color: #000000; {{ Request::is('dashboard') || Request::is('dashboard/arriving_soon') || Request::is('dashboard/checkout') || Request::is('dashboard/upcoming') ? 'font-weight: 600;' : '' }}">Today</a>
                        </li>

                        {{-- Villa --}}
                        <li class="nav-item dropdown no-caret mr-1 ml-n1 dropdown-notifications">
                            <a class="{{ Request::is('dashboard/listing') || Request::is('dashboard/reservation*') || Request::is('users/*') || Request::is('manage-guidebook') ? 'border-bottom' : '' }} borderr nav-link px-md-5 btn btn-icon btn-transparent-dark dropdown-toggle"
                                id="navbarDropdownMessages" href="javascript:void(0);" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p
                                    style="color: #000000; {{ Request::is('dashboard/listing') || Request::is('dashboard/reservation') || Request::is('users/*') || Request::is('manage-guidebook') ? 'font-weight: 600;' : '' }}">
                                    {{ __('user_page.Homes') }} <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"
                                        aria-hidden="true" role="presentation" focusable="false">
                                        <g fill="none">
                                            <path
                                                d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932">
                                            </path>
                                        </g>
                                    </svg></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownMessages">
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('listing_dashboard') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Listing</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('reservations_dashboard') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Reservations</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_add_listing') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Create new listing</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('manage_guidebook') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('completed_payouts') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Transaction history</div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <!-- HOTEL -->
                        <li class="nav-item dropdown no-caret mr-2 ml-n1 dropdown-notifications">
                            <a class="{{ Request::is('dashboard/hotel*') ? 'border-bottom' : '' }} borderr nav-link px-md-5 btn btn-icon btn-transparent-dark dropdown-toggle"
                                id="navbarDropdownMessages" href="javascript:void(0);" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p
                                    style="color: #000000; {{ Request::is('dashboard/hotel*') ? 'font-weight: 600;' : '' }}">
                                    {{ __('user_page.Hotels') }} <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"
                                        aria-hidden="true" role="presentation" focusable="false">
                                        <g fill="none">
                                            <path
                                                d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932">
                                            </path>
                                        </g>
                                    </svg></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownMessages">
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('dashboard_listing_hotel') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Listing</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('hotel_room_reservations_dashboard') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Reservations</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_add_listing') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Create new listing</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('manage_guidebook') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('completed_payouts') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Transaction history</div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        {{-- Restaurant --}}
                        <li class="nav-item dropdown no-caret mr-2 dropdown-notifications" style="margin-left: 5px;">
                            <a style="padding: 0px 60px;"
                                class="{{ Request::is('dashboard/restaurant*') ? 'border-bottom' : '' }} borderr nav-link btn btn-icon btn-transparent-dark dropdown-toggle"
                                id="navbarDropdownMessages" href="javascript:void(0);" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p
                                    style="color: #000000; {{ Request::is('dashboard/restaurant*') ? 'font-weight: 600;' : '' }}">
                                    {{ __('user_page.Food') }} <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"
                                        aria-hidden="true" role="presentation" focusable="false">
                                        <g fill="none">
                                            <path
                                                d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932">
                                            </path>
                                        </g>
                                    </svg></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownMessages">
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_restaurant') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">List Restaurant</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_add_listing') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Create new listing
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('manage_guidebook') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('completed_payouts') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Transaction history
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        {{-- Things To Do --}}
                        <li class="nav-item dropdown no-caret ml-3 mr-2 dropdown-notifications">
                            <a style="padding: 0px 60px;"
                                class="{{ Request::is('dashboard/things-to-do*') ? 'border-bottom' : '' }} borderr nav-link btn btn-icon btn-transparent-dark dropdown-toggle"
                                id="navbarDropdownMessages" href="javascript:void(0);" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p
                                    style="color: #000000; {{ Request::is('dashboard/things-to-do*') ? 'font-weight: 600;' : '' }}">
                                    Wow <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"
                                        aria-hidden="true" role="presentation" focusable="false">
                                        <g fill="none">
                                            <path
                                                d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932">
                                            </path>
                                        </g>
                                    </svg></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownMessages">
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_activity') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">List Things To Do
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('admin_add_listing') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Create new listing
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('manage_guidebook') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Guidebooks</div>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-notifications-item"
                                    href="{{ route('completed_payouts') }}">
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-text">Transaction history
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        {{-- Reward --}}
                        @if (Auth::user()->role_id == 1)
                            <li class="nav-item dropdown no-caret dropdown-notifications">
                                <a style="padding: 0px 60px;"
                                    class="{{ Request::is('dashboard/reward-category') || Request::is('dashboard/user-reward') || Request::is('dashboard/user-reward-balance') || Request::is('dashboard/staff-reward-balance') ? 'border-bottom' : '' }} borderr nav-link btn btn-icon btn-transparent-dark dropdown-toggle"
                                    id="navbarDropdownMessages" href="javascript:void(0);" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <p
                                        style="color: #000000; {{ Request::is('dashboard/reward-category') || Request::is('dashboard/user-reward') || Request::is('dashboard/user-reward-balance') || Request::is('dashboard/staff-reward-balance') ? 'font-weight: 600;' : '' }}">
                                        Reward <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                            style="fill: rgb(113, 113, 113); height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"
                                            aria-hidden="true" role="presentation" focusable="false">
                                            <g fill="none">
                                                <path
                                                    d="m28 12-11.2928932 11.2928932c-.3905243.3905243-1.0236893.3905243-1.4142136 0l-11.2928932-11.2928932">
                                                </path>
                                            </g>
                                        </svg></p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                    aria-labelledby="navbarDropdownMessages">
                                    <a class="dropdown-item dropdown-notifications-item"
                                        href="{{ route('admin_reward_category') }}">
                                        <div class="dropdown-notifications-item-content">
                                            <div class="dropdown-notifications-item-content-text">Reward Category
                                            </div>
                                        </div>
                                    </a>

                                    <a class="dropdown-item dropdown-notifications-item"
                                        href="{{ route('admin_user_reward') }}">
                                        <div class="dropdown-notifications-item-content">
                                            <div class="dropdown-notifications-item-content-text">User Reward</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item dropdown-notifications-item"
                                        href="{{ route('admin_user_reward_balance') }}">
                                        <div class="dropdown-notifications-item-content">
                                            <div class="dropdown-notifications-item-content-text">User Reward Balance
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item dropdown-notifications-item"
                                        href="{{ route('admin_staff_reward_balance') }}">
                                        <div class="dropdown-notifications-item-content">
                                            <div class="dropdown-notifications-item-content-text">Staff Reward Balance
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endif
                    @endif

                </ul>
                <ul class="navbar-nav align-items-center">
                    @if (Request::is('account-settings*') || Request::is('account-delete') || Request::is('referral*') || Request::is('users/edit-photo') || Request::is('profile*'))
                        <li class="nav-item">
                            <a style="color: #524A4E;" aria-current="page"
                                href="{{ route('partner_dashboard') }}">Switch to
                                hosting</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown no-caret mr-3 d-none d-md-inline">
                        <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up"
                            aria-labelledby="navbarDropdownDocs">
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Documentation</div>
                                    Usage instructions and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3"
                                href="https://docs.startbootstrap.com/sb-admin-pro/components" target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Components</div>
                                    Code snippets and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3"
                                href="https://docs.startbootstrap.com/sb-admin-pro/changelog" target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i
                                        data-feather="file-text"></i></div>
                                <div>
                                    <div class="small text-gray-500">Changelog</div>
                                    Updates and changes
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-3 d-md-none">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown"
                            href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i data-feather="search"></i></a>
                        <!-- Dropdown - Search-->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100">
                                <div class="input-group input-group-joined input-group-solid">
                                    <input class="form-control" type="text" placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2" />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i data-feather="search"></i></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    @auth
                        @if (Request::is('owner/profile/*'))
                        @else
                            <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
                                    href="javascript:void(0);" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                    aria-labelledby="navbarDropdownAlerts">
                                    <h6 class="dropdown-header dropdown-notifications-header">
                                        <i class="mr-2" data-feather="bell"></i>
                                        Alerts Center
                                    </h6>

                                    @php
                                        $notificationOwner = App\Models\NotificationOwner::where('id_user', Auth::user()->id)->get();
                                    @endphp

                                    @foreach ($notificationOwner as $item)
                                        <a class="dropdown-item dropdown-notifications-item"
                                            href="{{ route('notification_owner') }}">
                                            <div class="dropdown-notifications-item-icon bg-warning"><i
                                                    data-feather="activity"></i>
                                            </div>
                                            <div class="dropdown-notifications-item-content">
                                                <div class="dropdown-notifications-item-content-details">
                                                    {{ $item->created_at->format('j F, Y h:i:s') }}
                                                </div>
                                                <div class="dropdown-notifications-item-content-text">
                                                    {{ $item->message }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endauth
                    @auth
                        <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                                href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{-- @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="img-fluid"
                            alt="Pict">
                            @else
                            <img src="{{ asset('assets/icon/menu/user_default.svg') }}" class="img-fluid"
                                alt="Pict">
                            @endif --}}
                                @if (Auth::user()->foto_profile != null)
                                    <img class="img-fluid"
                                        src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                @elseIf (Auth::user()->avatar != null)
                                    <img class="img-fluid" src="{{ Auth::user()->avatar }}">
                                @else
                                    <img class="img-fluid"
                                        src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownUserImage">
                                <h6 class="dropdown-header d-flex align-items-center">
                                    @if (Auth::user()->foto_profile != null)
                                        <img class="dropdown-user-img"
                                            src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                    @elseIf (Auth::user()->avatar != null)
                                        <img class="dropdown-user-img" src="{{ Auth::user()->avatar }}">
                                    @else
                                        <img class="dropdown-user-img"
                                            src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                    @endif
                                    {{-- @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}"
                                class="dropdown-user-img" alt="Pict">
                                @else
                                <img src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                    class="dropdown-user-img" alt="Pict">
                                @endif --}}
                                    <div class="dropdown-user-details">
                                        <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}</div>
                                        <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                    </div>
                                </h6>
                                @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                                    <a class="dropdown-item sub-drop" href="{{ route('profile_user') }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item sub-drop" href="{{ route('account_setting') }}">
                                        Account
                                    </a>
                                    <a class="dropdown-item sub-drop" href="{{ route('help_guest') }}">
                                        Get Help
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item sub-drop" href="{{ route('partner_inbox') }}">
                                        Inbox
                                    </a><a class="dropdown-item sub-drop" href="{{ route('calendar_index') }}">
                                        Calendar
                                    </a><a class="dropdown-item sub-drop" href="{{ route('insight_dashboard') }}">
                                        Insight
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item sub-drop" href="javascript:void(0);" onclick="language()">
                                        Language and translation
                                    </a>
                                    <a class="dropdown-item sub-drop" href="javascript:void(0);" onclick="currency()">
                                        @if (isset(Auth::user()->currency->symbol) || isset(Auth::user()->currency->code))
                                            {{ Auth::user()->currency->symbol }} {{ Auth::user()->currency->code }}
                                        @else
                                            $ USD
                                        @endif
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    {{-- <a class="dropdown-item sub-drop" href="{{ route('refer_host') }}">
                                Your Referral Code
                            </a> --}}
                                @endIf
                                @if (in_array(Auth::user()->role_id, [1, 2, 3, 4, 5]))
                                    <a class="dropdown-item sub-drop" href="{{ route('index') }}">
                                        Switch to traveling
                                    </a>
                                @endIf
                                @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                                    <a class="dropdown-item sub-drop" href="{{ route('admin_tax_setting') }}">
                                        Tax Setting
                                    </a>
                                @endIf
                                <a class="dropdown-item sub-drop" href="#!"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post"
                                    style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <hr style="background-color: transparent; border-color: transparent;">
        @yield('content_admin')

        @include('user.modal.dashboard.modal_language')
        @include('user.modal.dashboard.modal_currency')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/partner/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/partner/assets/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
    <script src='https://kenwheeler.github.io/slick/slick/slick.js'></script>


    <script>
        function language() {
            $('#ModalLanguage').modal('show');
        }

        function currency() {
            $('#ModalCurrency').modal('show');
        }
    </script>



    @yield('scripts')
    <script>
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
        $(".navbar-toggler").on("click", function() {
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
    </script>
    <script>
        function cleanClass(data) {
            switch(data) {
                case 'user':
                    $("#f-home").removeClass('f-down').addClass('f-right');
                    $('#dropHomes').removeClass('show');
                    $("#f-hotels").removeClass('f-down').addClass('f-right');
                    $('#dropHotels').removeClass('show');
                    $("#f-food").removeClass('f-down').addClass('f-right');
                    $('#dropFood').removeClass('show');
                    $("#f-wow").removeClass('f-down').addClass('f-right');
                    $('#dropWow').removeClass('show');
                    $("#f-reward").removeClass('f-down').addClass('f-right');
                    $('#dropReward').removeClass('show');
                break;
                case 'home':
                    $("#f-user").removeClass('f-down').addClass('f-right');
                    $('#dropProfile').removeClass('show');
                    $("#f-hotels").removeClass('f-down').addClass('f-right');
                    $('#dropHotels').removeClass('show');
                    $("#f-food").removeClass('f-down').addClass('f-right');
                    $('#dropFood').removeClass('show');
                    $("#f-wow").removeClass('f-down').addClass('f-right');
                    $('#dropWow').removeClass('show');
                    $("#f-reward").removeClass('f-down').addClass('f-right');
                    $('#dropReward').removeClass('show');
                break;
                case 'hotels':
                    $("#f-user").removeClass('f-down').addClass('f-right');
                    $('#dropProfile').removeClass('show');
                    $("#f-home").removeClass('f-down').addClass('f-right');
                    $('#dropHomes').removeClass('show');
                    $("#f-food").removeClass('f-down').addClass('f-right');
                    $('#dropFood').removeClass('show');
                    $("#f-wow").removeClass('f-down').addClass('f-right');
                    $('#dropWow').removeClass('show');
                    $("#f-reward").removeClass('f-down').addClass('f-right');
                    $('#dropReward').removeClass('show');
                break;
                case 'food':
                    $("#f-user").removeClass('f-down').addClass('f-right');
                    $('#dropProfile').removeClass('show');
                    $("#f-home").removeClass('f-down').addClass('f-right');
                    $('#dropHomes').removeClass('show');
                    $("#f-hotels").removeClass('f-down').addClass('f-right');
                    $('#dropHotels').removeClass('show');
                    $("#f-wow").removeClass('f-down').addClass('f-right');
                    $('#dropWow').removeClass('show');
                    $("#f-reward").removeClass('f-down').addClass('f-right');
                    $('#dropReward').removeClass('show');
                break;
                case 'wow':
                    $("#f-user").removeClass('f-down').addClass('f-right');
                    $('#dropProfile').removeClass('show');
                    $("#f-home").removeClass('f-down').addClass('f-right');
                    $('#dropHomes').removeClass('show');
                    $("#f-hotels").removeClass('f-down').addClass('f-right');
                    $('#dropHotels').removeClass('show');
                    $("#f-food").removeClass('f-down').addClass('f-right');
                    $('#dropFood').removeClass('show');
                    $("#f-reward").removeClass('f-down').addClass('f-right');
                    $('#dropReward').removeClass('show');
                break;
                case 'reward':
                    $("#f-user").removeClass('f-down').addClass('f-right');
                    $('#dropProfile').removeClass('show');
                    $("#f-home").removeClass('f-down').addClass('f-right');
                    $('#dropHomes').removeClass('show');
                    $("#f-hotels").removeClass('f-down').addClass('f-right');
                    $('#dropHotels').removeClass('show');
                    $("#f-food").removeClass('f-down').addClass('f-right');
                    $('#dropFood').removeClass('show');
                    $("#f-wow").removeClass('f-down').addClass('f-right');
                    $('#dropWow').removeClass('show');
                break;
            default:
            }
        }
        $(function() {
            $('#nav-user').click(function() {
                cleanClass("user");
                $('#f-user').toggleClass('f-right f-down');
            });
            $('#nav-home').click(function() {
                cleanClass("home");
                $('#f-home').toggleClass('f-right f-down');
            });
            $('#nav-hotels').click(function() {
                cleanClass("hotels");
                $('#f-hotels').toggleClass('f-right f-down');
            });
            $('#nav-food').click(function() {
                cleanClass("food");
                $('#f-food').toggleClass('f-right f-down');
            });
            $('#nav-wow').click(function() {
                cleanClass("wow");
                $('#f-wow').toggleClass('f-right f-down');
            });
            $('#nav-reward').click(function() {
                cleanClass("reward");
                $('#f-reward').toggleClass('f-right f-down');
            });
        })
    </script>
</body>

</html>
