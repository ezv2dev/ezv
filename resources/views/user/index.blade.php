<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> --}}

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

    <style>
        .list-link-sidebar {
            gap: 12px;
            display: flex;
            align-items: center;
        }

        .list-link-sidebar i {
            width: 30px;
        }

        .list-link-sidebar>*,
        .list-link-sidebar:hover>* {
            color: #585656;
        }
    </style>
</head>

<body>
    @component('components.loading.loading-type2')
    @endcomponent
    <div class="expand-navbar-mobile" aria-expanded="false">
        <div class="px-3 pt-2 h-100" style="overflow-x: hidden; overflow-y: auto;">
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
                        <a class="list-link-sidebar mb-2" href="{{ route('partner_dashboard') }}">
                            <i class="fa fa-tachometer text-center" aria-hidden="true"></i>
                            <p class="m-0">{{ __('user_page.Dashboard') }}</p>
                        </a>
                    @endif
                    @if ($role == 4)
                        <a class="list-link-sidebar mb-2" href="{{ route('collaborator_intro') }}">
                            <i class="fa fa-handshake-o text-center" aria-hidden="true"></i>
                            <p class="m-0">{{ __('user_page.Collabs') }}</p>
                        </a>
                    @else
                        <a class="list-link-sidebar mb-2" href="{{ route('collaborator_list') }}">
                            <i class="fa fa-handshake-o text-center" aria-hidden="true"></i>
                            <p class="m-0">{{ __('user_page.Collab Portal') }}</p>
                        </a>
                    @endif
                    <a class="list-link-sidebar mb-2" href="{{ route('profile_index') }}">
                        <i class="fa-solid fa-user text-center"></i>
                        <p class="m-0">{{ __('user_page.My Profile') }}</p>
                    </a>
                    <a class="list-link-sidebar mb-2" href="{{ route('change_password') }}">
                        <i class="fa-solid fa-key text-center"></i>
                        <p class="m-0">{{ __('user_page.Change Password') }}</p>
                    </a>
                    <a href="{{ route('switch') }}" class="list-link-sidebar mb-2">
                        <i class="fa fa-refresh text-center" aria-hidden="true"></i>
                        <p class="m-0">{{ __('user_page.Switch to Hosting') }}</p>
                    </a>
                    <a class="list-link-sidebar mb-2" href="#!"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out text-center" aria-hidden="true"></i>
                        <p class="m-0">{{ __('user_page.Sign Out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <hr>
                    <a type="button" onclick="language()" class="list-link-sidebar mb-2" style="color: white;">
                        @if (session()->has('locale'))
                            <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                        @else
                            <img class="lozad" style="width: 27px;" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                        @endif
                        <p class="mb-0 ms-2" style="color: #585656">{{ __('user_page.Choose a Language') }}</p>
                    </a>
                    <a type="button" onclick="currency()" class="list-link-sidebar mb-2" style="color: white;">
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
                <div class="d-flex align-items-center justify-content-between pt-3 pb-0">
                    <a type="button" onclick="loginRegisterForm(2, 'registration');" class="list-link-sidebar btn-login"
                        id="login">
                        <i class="fa-solid fa-user text-center"></i>
                        <p class="mb-0">{{ __('user_page.Create Account') }}</p>
                    </a>
                    <button type="button" class="btn-close-expand-navbar-mobile" aria-label="Close"
                        style="background: transparent; border: 0;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <hr>
                <a id="sidebar-host" href="{{ route('ahost') }}" class="list-link-sidebar mb-2" target="_blank">
                    <i class="fa fa-pencil-square text-center" aria-hidden="true"></i>
                    <p class="m-0">{{ __('user_page.Create Listing') }}</p>
                </a>
                <hr>
                <a type="button" onclick="language()" class="list-link-sidebar mb-2"
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
                <a type="button" onclick="currency()" class="list-link-sidebar mb-2" style="color: white;">
                    <img class="lozad" style=" width: 27px; border: solid 1px #858585; padding: 2px; border-radius: 3px;"
                        src="{{ LazyLoad::show() }}"
                        data-src="{{ URL::asset('assets/icon/currency/dollar-sign.svg') }}">
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
            @endauth
        </div>

    </div>
    <div id="overlay"></div>
    {{-- NEW SEARCH MOBILE
    new search ui untuk mobile --}}
    <div class="search-container-mobile">
        {{-- NEW SEARCH MOBILEa
        tombol dipaling atas untuk close atau kembli --}}
        <button class="btn-top-search me-2">
            <i class="fa-solid fa-xmark close"></i>
            <i class="fa-solid fa-angle-left back d-none"></i>
        </button>
        <form action="{{ route('search_home_combine') }}" method="GET" id="basic-form-mobile" autocomplete="off">
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
                                data-src="https://cf.bstatic.com/xdata/images/xphoto/max500_ao/85179701.jpg?k=ce7f1e159c7c0a6ce44bab2342d2145165d0d5dd2235dce5df882ae89ee01f07&o=">
                            <div class="location-popup-text sugest-list-text">
                                <a type="button" class="location_op" data-value="Berawa">Berawa</a>
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
                            <a type="button" onclick="adult_decrement_index()"
                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                            </a>
                            <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                <input type="number" id="adult_mobile" name="sAdult" value="1"
                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                    min="0" readonly>
                            </div>
                            <a type="button" onclick="adult_increment_index()"
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
                            <a type="button" onclick="child_decrement_index()"
                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                            </a>
                            <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                <input type="number" id="child_mobile" name="sChild" value="0"
                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                    min="0" readonly>
                            </div>
                            <a type="button" onclick="child_increment_index()"
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
                            <a type="button" onclick="infant_decrement_index()"
                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                            </a>
                            <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                <input type="number" id="infant_mobile" name="" value="0"
                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                    min="0" readonly>
                            </div>
                            <a type="button" onclick="infant_increment_index()"
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
                            <a type="button" onclick="pet_decrement_index()"
                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                            </a>
                            <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                <input type="number" id="pet_mobile" name="" value="0"
                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                    min="0" readonly>
                            </div>
                            <a type="button" onclick="pet_increment_index()"
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
                    <button class="btn-company submit-mobile ms-auto d-none">Search</button>
                </div>
            </div>
        </form>
    </div>
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
                            <button class="btn-company d-block d-lg-none listing-mobile-btn me-1"
                                style="font-size: 9px; padding: 10px !important; border: none;">
                                <a href="{{ route('ahost') }}" style="color: white;">
                                    Create listing
                                </a>
                            </button>
                            <div id="searchbox-mob" class="searchbox display-none" onclick="popUp();"
                                style="cursor: pointer; border: none; margin:0;">
                                <span class="top-search"><i class="fa fa-search"></i></span>
                            </div>
                            <button class="navbar-toggler px-0" type="button" id="expand-mobile-btn">
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
                                            target="_blank" href="{{ route('collaborator_list') }}"><img
                                                src="{{ asset('assets/icon/menu/collab1-white.svg') }}"
                                                style="width: 34px; height: auto;"></a>
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
                                                <input type="text" onfocus="this.value=''"
                                                    class="form-control input-transparant input-location"
                                                    style="margin-top: -2px;" id="loc_sugest_desktop"
                                                    name="sLocation"
                                                    placeholder="{{ __('user_page.Where are you going?') }}">

                                                <div id="sugest_desktop" class="location-popup display-none">
                                                    @php
                                                        $location = App\Http\Controllers\ViewController::get_location();
                                                        $hotelName = App\Http\Controllers\HotelController::get_name();
                                                        $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                        $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                    @endphp
                                                    <div class="location-popup-container h-100">
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
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
                                                                    class="location_op_desktop" data-value="">Current
                                                                    Location</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op_desktop"
                                                                    data-value="Canggu">Canggu</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op_desktop"
                                                                    data-value="Seminyak">Seminyak</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op_desktop"
                                                                    data-value="Ubud">Ubud</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op_desktop"
                                                                    data-value="Kuta">Kuta</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                            style="display: none ">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op_desktop"
                                                                    data-value="Pecatu">Pecatu</a>
                                                            </div>
                                                        </div>
                                                        @foreach ($location as $item)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                                style="display: none ">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image lozad"
                                                                        src="{{ LazyLoad::show() }}"
                                                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a type="button" class="location_op_desktop"
                                                                        data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @foreach ($location as $item)
                                                            <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                                style="display: none ">
                                                                <div class="location-popup-map sugest-list-map">
                                                                    <img class="location-popup-map-image lozad"
                                                                        src="{{ LazyLoad::show() }}"
                                                                        data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                                </div>
                                                                <div class="location-popup-text sugest-list-text">
                                                                    <a type="button" class="location_op_desktop"
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
                                                                    <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                        type="button" class="location_op_desktop"
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
                                                                        type="button" class="location_op_desktop"
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
                                                                        type="button" class="location_op_desktop"
                                                                        target="_blank"
                                                                        data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-empty-desktop"
                                                            style="display: none">
                                                            <p>{{ __('user_page.Location not found') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="check-in">
                                                <a type="button"
                                                    style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px"
                                                    class="collapsible-check-search-desktop"></a>
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
                                                        <input type="number" id="total_guest_desktop" value="1"
                                                            style="width: 30px; border: 0; margin-right: 0; text-align: right; -moz-appearance: textfield; background-color: transparent;"
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
                                                                        <input type="number" id="adult_desktop"
                                                                            name="sAdult" value="1"
                                                                            style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
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
                                                                        <input type="number" id="child_desktop"
                                                                            name="sChild" value="0"
                                                                            style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
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
                                                                        <input type="number" id="infant_desktop"
                                                                            name="" value="0"
                                                                            style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
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
                                                                        <input type="number" id="pet_desktop"
                                                                            name="" value="0"
                                                                            style="text-align: center; border:none; width:40px; -moz-appearance: textfield; background-color: transparent;"
                                                                            min="0" readonly>
                                                                    </div>
                                                                    <a type="button" onclick="pet_increment_index()"
                                                                        style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-plus guests-style"
                                                                            style="padding:0px"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="d-block m-auto"
                                                                style="background: #ff7400; color: white; padding: 5px 15px; border-radius: 10px; font-size: 18px; border: none;">
                                                                Search
                                                            </button>
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
                                <div class="content sidebar-popup" id="popup_check_search_desktop"
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
                                                <div class="flatpickr" id="inline_reserve_search_desktop"
                                                    style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Header Search --}}
                    </div>

                    <div id="nav-end-dekstop" class="col-lg-4 ms-auto"
                        style="display: flex; align-items: center; justify-content: flex-end;">
                        @auth
                            <div class="d-flex" style="display: inline-block; align-items: center;">
                                <a href="{{ route('switch') }}" class="navbar-gap" style="color: #b9b9b9;">
                                    {{ __('user_page.Switch to Hosting') }}
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
                                            aria-labelledby="navbarDropdownUserImage"
                                            style="left: -186px; top: 120%; min-width: 239px;">
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
                            <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9;" target="_blank">
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
                            <div class="dropdown">
                                <button type="button" class="btn-dropdwn dropbtn btn border-0 navbar-gap"></button>
                                <div class="dropdown-content">
                                    <a href="#" onclick="loginRegisterForm(2, 'login');">Login</a>
                                    <a href="#" onclick="loginRegisterForm(2, 'register');">Register</a>
                                    <hr>
                                    <a href="{{ route('ahost') }}">Become a Host</a>
                                    <a href="{{ route('collaborator_list') }}">Collaborator Portal</a>
                                    <a href="{{ route('faq') }}">FAQ</a>
                                </div>
                            </div>
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

                                    {{ __('user_page.The Best Way To Find Accomodation, Restaurant, And Things To Do') }}
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
                                        <img
                                            src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                    </a>
                                    <a href="https://play.google.com/" target="_blank"
                                        class="btn-donwload-mobile-app" id="btn-to-play-store">
                                        <img
                                            src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
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
                        <h1 class="mb-5" style="margin-bottom: 1rem !important;">
                            {{ __('user_page.Discover Experiences') }}</h1>
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
                        <h1 class="mb-5" style="margin-bottom: 1rem !important;">
                            {{ __('user_page.Discover Experiences') }}</h1>
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
                if (parseInt(document.getElementById('total_guest_desktop').value) < 10
                    && parseInt(document.querySelector('.guests-mobile').innerHTML) < 10) {
                    document.getElementById('adult_desktop').stepUp();
                    document.getElementById('adult_mobile').stepUp();
                    document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                            .value) +
                        parseInt(document.getElementById('child_desktop').value);
                    // NEW SEARCH MOBILE
                    // fungsi untuk mengisi guest di mobile
                    document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                        parseInt(document.getElementById('child_mobile').value) + " Guests";    
                }
            }

            function adult_decrement_index() {
                document.getElementById('adult_desktop').stepDown();
                document.getElementById('adult_mobile').stepDown();
                document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                        .value) +
                    parseInt(document.getElementById('child_desktop').value);
                // NEW SEARCH MOBILE
                // fungsi untuk mengisi guest di mobile
                document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                    parseInt(document.getElementById('child_mobile').value) + " Guests";
            }

            function child_increment_index() {
                if (parseInt(document.getElementById('total_guest_desktop').value) < 10
                    && parseInt(document.querySelector('.guests-mobile').innerHTML) < 10) {
                    document.getElementById('child_desktop').stepUp();
                    document.getElementById('child_mobile').stepUp();
                    document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                            .value) +
                        parseInt(document.getElementById('child_desktop').value);
                    // NEW SEARCH MOBILE
                    // fungsi untuk mengisi guest di mobile
                    document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                        parseInt(document.getElementById('child_mobile').value) + " Guests";
                }
            }

            function child_decrement_index() {
                document.getElementById('child_desktop').stepDown();
                document.getElementById('child_mobile').stepDown();
                document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                        .value) +
                    parseInt(document.getElementById('child_desktop').value);
                // NEW SEARCH MOBILE
                // fungsi untuk mengisi guest di mobile
                document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                    parseInt(document.getElementById('child_mobile').value) + " Guests";
            }

            function infant_increment_index() {
                document.getElementById('infant_desktop').stepUp();
                document.getElementById('infant_mobile').stepUp();
            }

            function infant_decrement_index() {
                document.getElementById('infant_desktop').stepDown();
                document.getElementById('infant_mobile').stepDown();
            }

            function pet_increment_index() {
                document.getElementById('pet_desktop').stepUp();
                document.getElementById('pet_mobile').stepUp();
            }

            function pet_decrement_index() {
                document.getElementById('pet_desktop').stepDown();
                document.getElementById('pet_mobile').stepDown();
            }
        </script>

        <script>
            $(".search-container-mobile .close").on("click", function() {
                backToMainMobile();
                $(".search-container-mobile").removeClass("search-container-mobile-open")
                    .addClass("search-container-mobile-closed");
                $("body").removeAttr("style");
            });
        </script>

        <script>
            // NEW SEARCH MOBILE
            // fungsi untuk kembali ke bagian awal search di mobile
            function backToMainMobile() {
                $(".search-container-mobile form").removeClass("h-100");
                $("#sugest").removeClass("display-block").addClass("display-none");
                $(".search-container-mobile .select-location-mobile-container").removeClass("d-none");
                $(".search-container-mobile .location-has-selected-container").removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .first-sugest-location").removeClass("d-none");
                $(".search-container-mobile .dates-container").removeClass("d-none h-100 px-0");
                $(".search-container-mobile .sidebar-popup").removeAttr("style");
                $(".search-container-mobile .sidebar-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .guests-container").removeClass("d-none p-0");
                $(".search-container-mobile .guest-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .selected-guest-mobile").removeClass("d-none").addClass("d-flex");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none bottom-select-date");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none");
                $(".search-container-mobile .clear-all-mobile").removeClass("d-none");
                $(".search-container-mobile .clear-date-mobile").addClass("d-none");
                if ($("#check_in2").val() != "" && $("#check_out2").val() != "" &&
                    parseInt($("#total_guest_desktop").val()) >= 1 && $("#loc_sugest").val() != "") {
                    $(".search-container-mobile .submit-mobile").removeClass("d-none");
                    $(".search-container-mobile .next-mobile").addClass("d-none");
                } else {
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .next-mobile").html("Next");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                }
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $('#sugest_mobile').removeClass("display-block").addClass("display-none");
                $("#loc_sugest").attr("readonly", true);
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select location di mobile
            function moveToLocationMobile() {
                $("#loc_sugest").removeAttr("readonly");
                var ids = $(".sugest-list-first");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                    // console.log(rndInt);
                    ids.show();
                };
                $(".search-container-mobile form").addClass("h-100");
                $(".search-container-mobile .first-sugest-location").addClass("d-none");
                $(".search-container-mobile .dates-container").addClass("d-none");
                $('#popup_check_search_mobile').removeClass('d-block').addClass('d-none');
                $(".search-container-mobile .guests-container").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-block");
                $(".search-container-mobile .bottom-action-container").addClass("d-none");
                $(".search-container-mobile .btn-top-search .close").addClass("d-none");
                $(".search-container-mobile .btn-top-search .back").removeClass("d-none");
                $(".search-container-mobile .location-container")
                    .removeClass("mx-2").addClass("h-100");
                $(".search-container-mobile .location-has-selected-container")
                    .removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .select-location-mobile-container").removeClass("d-none");
                $('#sugest_mobile').removeClass("display-none");
                $('#sugest_mobile').addClass("display-block");
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select date di mobile
            function moveToDateMobile() {
                $('#popup_check_search_mobile').removeClass('d-none').addClass('d-block');
                $(".location-has-selected-container").removeClass("d-none").addClass("d-flex");
                $(".select-location-mobile-container").addClass("d-none");
                $(".search-container-mobile form").addClass("h-100");
                $(".search-container-mobile .first-sugest-location").removeClass("d-none");
                $(".search-container-mobile .dates-container").removeClass("d-none").addClass("h-100 px-0");
                $(".search-container-mobile .guests-container").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-block");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none").addClass("bottom-select-date");
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $('#sugest_mobile').removeClass("display-block").addClass("display-none");
                $("#loc_sugest").attr("readonly", true);
                $(".search-container-mobile .clear-date-mobile").removeClass("d-none");
                $(".search-container-mobile .clear-all-mobile").addClass("d-none");
                if ($("#check_in2").val() == "" && $("#check_out2").val() == "") {
                    $(".search-container-mobile .next-mobile").html("Skip");
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                } else {
                    $(".search-container-mobile .next-mobile").html("Next");
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                }
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select guest di mobile
            function moveToGuestsMobile() {
                $('#popup_check_search_mobile').removeClass("d-block").addClass("d-none");
                $(".location-has-selected-container").removeClass("d-none").addClass("d-flex");
                $(".select-location-mobile-container").addClass("d-none");
                $(".search-container-mobile form").removeClass("h-100");
                $(".search-container-mobile .first-sugest-location").addClass("d-none");
                $(".search-container-mobile .guests-container").removeClass("d-none").addClass("p-0");
                $(".search-container-mobile .dates-container").removeClass("d-none px-0");
                $(".search-container-mobile .sidebar-popup").removeAttr("style");
                $(".search-container-mobile .sidebar-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $(".search-container-mobile .selected-guest-mobile").removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-none").addClass("d-block");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none bottom-select-date");
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .clear-date-mobile").addClass("d-none");
                $(".search-container-mobile .clear-all-mobile").removeClass("d-none");
                $(".search-container-mobile .next-mobile").addClass("d-none");
                $(".search-container-mobile .submit-mobile").removeClass("d-none");
            }
        </script>

        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
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

                $(window).resize(function() {
                    if (window.innerWidth > 991) {
                        $(".btn-close-expand-navbar-mobile").trigger('click')
                    }
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
                // NEW SEARCH MOBILE
                // fungsi untuk ketika tombol kembali diklik
                $(".search-container-mobile .btn-top-search .back").on('click', backToMainMobile);

                // NEW SEARCH MOBILE
                // fungsi untuk munculin location-popup ketika input search location di mobile diklik
                $(".search-container-mobile #loc_sugest").on('click', moveToLocationMobile);

                // NEW SEARCH MOBILE
                // fungsi untuk munculin location-popup ketika search location di mobile diklik
                $(".search-container-mobile .location-has-selected-container").on('click', moveToLocationMobile);

                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        ids.show();
                    };

                    $('#sugest_mobile').removeClass("display-none");
                    $('#sugest_mobile').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest_mobile');

                    // if the target of the click isn't the container nor a descendant of the container
                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan location-popup hanya berlaku ketika bukan dimobile
                    if (!container.is(e.target) && container.has(e.target).length === 0 && window.innerWidth >
                        649) {
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

                // NEW SEARCH MOBILE
                // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                // dari location yang paling populer di mobile
                $(".first-sugest-location img").on('click', function(e) {
                    // NEW SEARCH MOBILE
                    // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                    $('#loc_sugest').val($(this).parents(".col-4").children(".location-popup-text").children(
                        ".location_op").data("value"));
                    $('#loc_sugest_desktop').val($(this).parents(".col-4").children(".location-popup-text")
                        .children(".location_op").data("value"));
                    $('.loc_sugest_mobile').html($(this).parents(".col-4").children(".location-popup-text")
                        .children(".location_op").data("value"));

                    // NEW SEARCH MOBILE
                    // fungsi untuk sembunyiin popup location
                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");

                    // NEW SEARCH MOBILE
                    // fungsi untuk berpindah ke select date di mobile
                    moveToDateMobile();

                    //calendar show when user filled location
                    var content_flatpickr = document.getElementById('popup_check_search');

                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            // NEW SEARCH MOBILE
                            // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });

                $(".location_op").on('click', function(e) {
                    $('#loc_sugest_desktop').val($(this).data("value"));

                    // NEW SEARCH MOBILE
                    // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                    $('#loc_sugest').val($(this).data("value"));
                    $('.loc_sugest_mobile').html($(this).data("value"));

                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");

                    // NEW SEARCH MOBILE
                    // fungsi untuk berpindah ke select date di mobile
                    if ($("#check_in2").val() == "") {
                        moveToDateMobile();
                    } else {
                        moveToGuestsMobile();
                    }

                    //calendar show when user filled location
                    var content_flatpickr = document.getElementById('popup_check_search');

                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            // NEW SEARCH MOBILE
                            // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });

                $("#loc_sugest_desktop").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first-desktop");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        ids.show();
                    };

                    if (window.innerWidth <= 649) {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-closed")
                            .addClass("search-container-mobile-open");
                        $("body").css({
                            "height": "100%",
                            "overflow": "hidden"
                        });
                    }else {
                        $('#sugest_desktop').removeClass("display-none");
                        $('#sugest_desktop').addClass("display-block"); //add the class to the clicked element
                    }
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest_desktop');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#loc_sugest_desktop").on('keyup change', async () => {
                    var close = $(".sugest-list-first-desktop");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty-desktop").eq(0).hide();

                    var formValue = $("#loc_sugest_desktop").val();
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
                        $(".sugest-list-empty-desktop").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op_desktop").on('click', function(e) {
                    $('#loc_sugest_desktop').val($(this).data("value"));
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest_desktop').removeClass("display-block");
                    $('#sugest_desktop').addClass("display-none");

                    $('.loc_sugest_mobile').html($(this).data("value"));
                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");
                    moveToGuestsMobile();

                    //calendar show when location click
                    var content_flatpickr = document.getElementById('popup_check_search_desktop');
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

                // NEW SEARCH MOBILE
                // Guest mobile
                $(".selected-guest-mobile").on("click", moveToGuestsMobile);
            });
        </script>

        <script>
            // NEW SEARCH MOBILE
            // fungsi untuk tombol next atau skip di mobile
            $(".next-mobile").on("click", function() {
                if ($("#loc_sugest").val() == "" && $("#check_in2").val() == "" &&
                    $("#check_out2").val() == "" && $(".search-container-mobile .sidebar-popup").css("display") !=
                    "block") {
                    moveToLocationMobile();
                } else if ($("#loc_sugest").val() != "" && $("#check_in2").val() == "" &&
                    $("#check_out2").val() == "" && parseInt($("#total_guest_desktop").val()) < 1) {
                    moveToDateMobile();
                } else if (($("#check_in2").val() == "" ||
                        $("#check_out2").val() == "") || $(".search-container-mobile .sidebar-popup").css("display") ==
                    "block") {
                    moveToGuestsMobile();
                }
            });
            // NEW SEARCH MOBILE
            // fungsi untuk clear all di mobile
            $(".clear-all-mobile").on("click", function() {
                $("#loc_sugest_desktop").val("");
                $("#loc_sugest").val("");
                $("#check_in2").val("");
                $("#check_out2").val("");
                $("#check_in_mobile").val("");
                $("#check_out_mobile").val("");
                $("#total_guest_desktop").val("1");
                $(".search-container-mobile .loc_sugest_mobile").html("Location");
                $(".search-container-mobile .dates-mobile").html("When");
                $(".search-container-mobile .guests-mobile").html("1 Guests");
                calendarSearch(window.countMonthsMobile);
            });
        </script>

        <script>
            var coll = document.getElementsByClassName("collapsible-check-search");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_check_search_mobile');
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        moveToDateMobile();
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });
            }

            var collDesktop = document.getElementsByClassName("collapsible-check-search-desktop");
            var j;

            for (j = 0; j < collDesktop.length; j++) {
                collDesktop[j].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_check_search_desktop');
                    if (content_flatpickr.style.display === "block") {
                        content_flatpickr.style.display = "none";
                    } else {
                        if (window.innerWidth <= 649) {
                            backToMainMobile();
                            $(".search-container-mobile").removeClass("search-container-mobile-closed")
                                .addClass("search-container-mobile-open");
                            $("body").css({
                                "height": "100%",
                                "overflow": "hidden"
                            });
                        } else {
                            content_flatpickr.style.display = "block";
                            document.addEventListener('mouseup', function(e) {
                                let container = content_flatpickr;
                                if (!container.contains(e.target)) {
                                    container.style.display = 'none';
                                }
                            });
                        }
                        
                    }
                });
            }
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
                if (window.scrollY > 0 && window.innerWidth > 991) {
                    $('#ul').removeClass('ul-display-block').addClass('ul-display-none');
                    $('#bar').addClass('display-none');
                    $('#searchbox').removeClass('display-none').addClass('display-block');
                    $('#nav').removeClass('search-height').addClass('position-fixed').addClass('padding-top-0');
                    $('#searchbox-mob').removeClass('display-none').addClass('display-block');

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

                function t(t) {
                    e(t).bind("click", function(t) {
                        t.preventDefault();
                        e(this).parent().fadeOut()
                    })
                }
                e(".dropdown-toggle").click(function() {
                    if (window.innerWidth <= 649) {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-closed")
                            .addClass("search-container-mobile-open");
                        $("body").css({
                            "height": "100%",
                            "overflow": "hidden"
                        });
                    }else {
                        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                        ":hidden");
                        e(".button-dropdown .dropdown-menu").hide();
                        e(".button-dropdown .dropdown-toggle").removeClass("active");
                        if (t) {
                            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                                ".button-dropdown").children(".dropdown-toggle").addClass("active")
                        }
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
                if (window.scrollY > 400 && window.innerWidth < 992 && !$("#ul").hasClass("ul-display-block")) {
                    $("#navbar-first-dekstop").addClass("navbar-mobile-position-fixed");
                    $('#searchbox-mob').removeClass('display-none').addClass('display-block');
                    $('#ul').removeAttr("style");
                    $('#bar').removeAttr("style");
                    $('#searchbox').removeAttr("style");
                }
                if (window.innerWidth > 991) {
                    $('#ul').removeAttr("style");
                    $('#bar').removeAttr("style");
                    $('#searchbox').removeAttr("style");
                }
                if (window.scrollY < 400 && window.innerWidth < 992) {
                    $('#ul').attr("style", "transition: none !important");
                    $('#bar').attr("style", "transition: none !important");
                    $('#searchbox').attr("style", "transition: none !important");
                }
                if (window.scrollY == 0 || (window.scrollY < 400 && window.innerWidth < 992)) {
                    // $('#ul').show();
                    $('#ul').removeClass('ul-display-none').addClass('ul-display-block');
                    $('#bar').removeClass('display-none');
                    $('#searchbox').removeClass('display-block').addClass('display-none');
                    $('#nav').removeClass('position-fixed').removeClass('padding-top-0');
                    $('#searchbox-mob').removeClass('display-block').addClass('display-none');
                    $("#navbar-first-dekstop").removeClass("navbar-mobile-position-fixed");

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
                    if (!isFocused && window.innerWidth < 992 && window.scrollY > 400) {
                        $('#ul').removeClass('ul-display-block').addClass('ul-display-none');
                        $('#bar').addClass('display-none');
                        $('#searchbox').removeClass('display-none').addClass('display-block');
                        $('#nav').removeClass('search-height').addClass('position-fixed').addClass('padding-top-0');
                        $('#searchbox-mob').removeClass('display-none').addClass('display-block');

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
                    } else if (!isFocused || window.innerWidth > 991) {
                        $('#ul').removeClass('ul-display-block').addClass('ul-display-none');
                        $('#bar').addClass('display-none');
                        $('#searchbox').removeClass('display-none').addClass('display-block');
                        $('#nav').removeClass('search-height').addClass('position-fixed').addClass('padding-top-0');
                        $('#searchbox-mob').removeClass('display-none').addClass('display-block');

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
                // $('#ul').show();
                document.getElementById("ul").classList.remove("ul-display-none");
                document.getElementById("ul").classList.add("ul-display-block");
                document.getElementById("bar").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-block");
                document.getElementById("nav").classList.add("search-height");
                if (window.innerWidth < 992) {
                    $("#navbar-first-dekstop").removeClass("navbar-mobile-position-fixed");
                    document.getElementById("nav").classList.add("position-fixed");
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

                var els = document.getElementsByClassName("flatpickr-calendar");
                removeClass(els, 'display-none');
            }
        </script>

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
            $(document).ready(function() {
                function handleResponsive(windowWidth) {
                    if (windowWidth <= 649) {
                        $("#loc_sugest_desktop").attr("readonly", true);
                        calendarSearch(window.countMonthsMobile);
                        $("#clear_date_mobile").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");

                            // NEW SEARCH MOBILE
                            // clear date untuk mobile
                            $(".search-container-mobile .dates-mobile").html("When");
                            $(".search-container-mobile .next-mobile").html("Skip");

                            // Fungsi untuk menyembunyikan calendar ketika clear date hanya berlaku kalo bukan mobile
                            if (windowWidth > 649) {
                                let content = document.getElementById("popup_check_search_mobile");
                                content.style.display = "none";
                            }
                            calendarSearch(window.countMonthsMobile);
                        });
                    } else {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-open")
                            .addClass("search-container-mobile-closed");
                        $("body").removeAttr("style");
                        $("#loc_sugest_desktop").attr("readonly", false);
                        $("#clear_date_header").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");

                            // NEW SEARCH MOBILE
                            // clear date untuk mobile
                            $(".search-container-mobile .dates-mobile").html("When");
                            $(".search-container-mobile .next-mobile").html("Skip");

                            let content = document.getElementById("popup_check_search_mobile");
                            content.style.display = "none";
                            calendarSearchDesktop(2);
                        });
                        calendarSearchDesktop(2);
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
                        $("#navbar-first-dekstop").removeClass("navbar-mobile-position-fixed");
                    }
                }
                var windowWidth = $(window).width();
                handleResponsive(windowWidth);
                $(window).on("resize", function() {
                    if ($(this).width() !== windowWidth) {
                        windowWidth = $(this).width();
                        handleResponsive(windowWidth);
                    }
                })
                // $(".SlickCarousel").slick({
                //     rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                //     autoplay: false,
                //     autoplaySpeed: 5000, //  Slide Delay
                //     speed: 800, // Transition Speed
                //     slidesToShow: 5, // Number Of Carousel
                //     slidesToScroll: 3, // Slide To Move
                //     pauseOnHover: false,
                //     appendArrows: $(".Container .Head .Arrows"),
                //     prevArrow: '<span class="Slick-Prev"></span>',
                //     nextArrow: '<span class="Slick-Next"></span>',
                //     easing: "linear",
                //     responsive: [{
                //             breakpoint: 801,
                //             settings: {
                //                 slidesToShow: 3,
                //             }
                //         },
                //         {
                //             breakpoint: 641,
                //             settings: {
                //                 slidesToShow: 3,
                //             }
                //         },
                //         {
                //             breakpoint: 481,
                //             settings: {
                //                 slidesToShow: 1,
                //             }
                //         },
                //     ],
                // })
            })
        </script>
        <script>
            function loginRegisterForm(value, type) {
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
                if (type == 'login') {
                    $('#trigger-tab-register').removeClass('active');
                    $('#content-tab-register').removeClass('active');
                    $('#trigger-tab-login').addClass('active');
                    $('#content-tab-login').addClass('active');
                } else {
                    $('#trigger-tab-register').addClass('active');
                    $('#content-tab-register').addClass('active');
                    $('#trigger-tab-login').removeClass('active');
                    $('#content-tab-login').removeClass('active');
                }
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

        <script>
            //Drop down login
            $(document).ready(function() {
                var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;
                $('.dropbtn').on(supportsTouch ? 'touchend' : 'click', function(event) {
                    event.stopPropagation();
                    $('.dropdown-content').slideToggle('fast');
                });

                $(document).on(supportsTouch ? 'touchend' : 'click', function(event) {
                    $('.dropdown-content').slideUp('fast');
                    // document.activeElement.blur();//lose focus
                });
            });
        </script>

        {{-- LAZY LOAD --}}
        @include('components.lazy-load.lazy-load')
        {{-- END LAZY LOAD --}}
</body>

</html>
