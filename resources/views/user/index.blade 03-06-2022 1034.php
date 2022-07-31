<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    <script src="{{ asset('enjoyhint/enjoyhint.min.js') }}"></script>
    <link href="{{ asset('enjoyhint/enjoyhint.css') }}" rel="stylesheet" />

    <style>
        .index-jumbotron {
            border-radius: 14px;
            height: 400px;
            background-position: center !important;
            background-size: cover !important;
        }

        .index-grid-container {
            background-size: cover !important;
            background-position: 50% 50% !important;
            background-repeat: no-repeat !important;
        }

        .index-experience-img {
            aspect-ratio: 1/1;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @component('components.loading.loading-type2')
    @endcomponent
    {{-- navbar --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark">

                <!-- <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#targetModal-item">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <!--
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
                </div> -->

                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <div class="col-lg-4" style="display: flex; align-items: center;">
                        <a href="{{ route('index') }}">
                            <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                    </div>

                    <div class="col-lg-4" style="height: 90px !important;">

                        <div id="searchbox" class="searchbox display-none" onclick="popUp();" style="cursor: pointer;">
                            <p>{{ Translate::translate('Search here...') }} <span class="top-search"><i class="fa fa-search"></i></p>
                        </div>
                        <!--Start of serach option 1 -->

                        <div id="ul" class="ul-display-block">
                            <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                                <form class="nav-link-form" action="{{ route('list') }}" method="GET" id="villa-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="villa-button" href="#"><i style="font-size: 20px;" class="fa-solid fa-house"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('villas') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('restaurant_list') }}" method="GET" id="hotel-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="hotel-button" href="#"><i style="font-size: 17px;" class="fa-solid fa-utensils"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('restaurants') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('hotel_list') }}" method="GET" id="restaurant-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="restaurant-button" href="#"><i style="font-size: 21px;" class="fa-solid fa-city"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('hotels') }}</p>
                                </form>
                                <form class="nav-link-form" action="{{ route('activity_list') }}" method="GET" id="activity-form">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-style nav-link-margin" id="activity-button" href="#"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></a>
                                    </li>
                                    <p>{{ Translate::translate('things to do') }}</p>
                                </form>
                            </ul>
                            <!--End of serach option 1 -->

                            {{-- Header Search --}}
                            <div class="search-box">
                                <div id="search_bar">
                                    <form action="{{ route('search_villa_combine') }}" method="GET" id="basic-form" autocomplete="off">
                                        <div id="bar" class="bar">
                                            <div class="location">
                                                <p>{{ Translate::translate('Location') }}</p>
                                                <input type="text" onfocus="this.value=''" class="form-control input-transparant input-location" id="loc_sugest" name="sLocation" placeholder="{{ Translate::translate('Where are you going?') }}">

                                                <div id="sugest" class="location-popup display-none">
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="Canggu">Canggu</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="Seminyak">Seminyak</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="Ubud">Ubud</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="Kuta">Kuta</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="Pecatu">Pecatu</a>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                    @endphp
                                                    @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad" src="{{ LazyLoad::show() }}" data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op" data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none; cursor: pointer;" onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image" src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}" type="button" class="location_op" target="_blank" data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none; cursor: pointer;" onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image" src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}" type="button" class="location_op" target="_blank" data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none; cursor: pointer;" onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image" src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}" type="button" class="location_op" target="_blank" data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                                        <p>{{ Translate::translate('location not found') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="check-in">
                                                <input type="text" style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px" id="dates">
                                                <p>{{ Translate::translate('Check in') }}</p>
                                                <input type="text" placeholder="{{ Translate::translate('Add dates') }}" class="flatpickr form-control input-transparant" value="" id="check_in2" name="sCheck_in">
                                            </div>
                                            <div class="check-out">
                                                <p>{{ Translate::translate('Check out') }}</p>
                                                <input type="text" placeholder="{{ Translate::translate('Add dates') }}" class="flatpickr form-control input-transparant" value="" id="check_out2" name="sCheck_out">
                                            </div>
                                            <div class="guests">
                                                <p>{{ Translate::translate('Guest') }}</p>
                                                <ul class="nav">
                                                    <li class="button-dropdown">
                                                        <input type="number" id="total_guest2" value="1" style="width: 30px; border: 0; margin-right: 0; text-align: right;" disabled min="1"> {{ Translate::translate('Guest') }}
                                                        <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                                        </a>
                                                        <a style="margin-left: 20px;" class="dropdown-toggle-icon">
                                                            {{ Translate::translate('Add') }}
                                                        </a>

                                                        <div class="guest-popup dropdown-menu">
                                                            <div class="guests-input-row">
                                                                <div class="col-6">
                                                                    <div class="col-12 guest-type-container">
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Adult') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Age') }} 13
                                                                            {{ Translate::translate('or above') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button" onclick="adult_decrement_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                    <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="adult2" name="sAdult" value="1" style="text-align: center; border:none; width:40px;" min="0" readonly>
                                                                    </div>
                                                                    <a type="button" onclick="adult_increment_index()" style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-plus" style="padding:0px;"></i>
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
                                                                            {{ Translate::translate('Ages') }} 2–12
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button" onclick="child_decrement_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                    <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="child2" name="sChild" value="0" style="text-align: center; border:none; width:40px;" min="0" readonly>
                                                                    </div>
                                                                    <a type="button" onclick="child_increment_index()" style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="guests-input-row">
                                                                <div class="col-6">
                                                                    <div class="col-12 guest-type-container">
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Infants') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Under') }} 2
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button" onclick="infant_decrement_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                    <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="infant2" name="" value="0" style="text-align: center; border:none; width:40px;" min="0" readonly>
                                                                    </div>
                                                                    <a type="button" onclick="infant_increment_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-plus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="guests-input-row">
                                                                <div class="col-6">
                                                                    <div class="col-12 guest-type-container">
                                                                        <p class="guest-type-title">
                                                                            {{ Translate::translate('Pets') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12" style="padding: 0px;">
                                                                        <p class="guest-type-desc">
                                                                            {{ Translate::translate('Service animal') }}?
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                                    <a type="button" onclick="pet_decrement_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                    <div style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                        <input type="number" id="pet2" name="" value="0" style="text-align: center; border:none; width:40px;" min="0" readonly>
                                                                    </div>
                                                                    <a type="button" onclick="pet_increment_index()" style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa-solid fa-plus guests-style" style="padding:0px"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="button">
                                                <button type="submit" style="z-index: 1; border: none; background: transparent;">
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
                            <a href="{{ route('partner_dashboard') }}" class="navbar-gap" style="color: #b9b9b9;">
                                {{ Translate::translate('Switch to Hosting') }}
                            </a>

                            <a type="button" onclick="language()" class="navbar-gap" style="color: white; width:27px;">
                                @if (session()->has('locale'))
                                <img class="lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                <img class="lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                            </a>

                            <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::user()->avatar)
                                    <img class="lozad" src="{{ LazyLoad::show() }}" data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt="" style="border-radius: 50%; width: 50px; border: solid 2px #ff7400;">
                                    @else
                                    <img class="lozad" src="{{ LazyLoad::show() }}" data-src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}" class="user-photo" alt="" style="border-radius: 50%">
                                    @endif

                                    <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                        <h6 class="dropdown-header d-flex align-items-center">
                                            @if (Auth::user()->foto_profile != null)
                                            <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                            @elseIf (Auth::user()->avatar != null)
                                            <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ Auth::user()->avatar }}">
                                            @else
                                            <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}" data-src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                                            @endif
                                            <div class="dropdown-user-details">
                                                <div class="dropdown-user-details-name">
                                                    {{ Auth::user()->first_name }}
                                                    {{ Auth::user()->last_name }}
                                                </div>
                                                <div class="dropdown-user-details-email">{{ Auth::user()->email }}
                                                </div>
                                            </div>
                                        </h6>
                                        @php
                                        $role = Auth::user()->role_id;
                                        @endphp
                                        @if ($role == 1 || $role == 2 || $role == 3)
                                        <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                            {{ Translate::translate('Dashboard') }}
                                        </a>
                                        @endif
                                        @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                        <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                            {{ Translate::translate('Collab Portal') }}
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('profile_index') }}">
                                            {{ Translate::translate('My Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('change_password') }}">
                                            {{ Translate::translate('Change Password') }}
                                        </a>
                                        <a class="dropdown-item" href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                            {{ Translate::translate('Sign Out') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9;" target="_blank">
                            {{ Translate::translate('Become a host') }}
                        </a>

                        <a type="button" onclick="language()" class="navbar-gap" style="color: white; margin-right: 9px; width:27px;" id="language">
                            @if (session()->has('locale'))
                            <img style="border-radius: 3px;" class="lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                            <img style="border-radius: 3px;" class="lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap" style="color: #ffffff; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;" id="login">
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
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load index-jumbotron" data-src="{{ URL::asset('assets/media/photos/desktop/batur.webp') }}">
                        <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                            <div>
                                <p class="text-white text-center" style="font-size: 22px;">
                                    {{ Translate::translate('The Best Way To Find Accommodation, Restaurants, And Things To Do') }}
                                </p>
                                <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                    <form action="{{ route('list') }}" method="GET" id="villa-form">
                                        {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                        <button class="btn d-inline-flex mb-md-0 btn-company">
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
                <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load" data-src="{{ URL::asset('assets/media/photos/desktop/app.webp') }}" style="border-radius: 14px; height: 400px; background-position:center; background-size: cover;">
                    <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                        <div>
                            <p class="text-white text-center" style="font-size: 62px;">
                                {{ Translate::translate('Download The App') }}
                            </p>
                            <p class="text-white text-center" style="margin-top: -20px;">
                                {{ Translate::translate('Unlock all the features today') }}
                            </p>

                            <p style="text-align: center;">
                                <a href="https://www.apple.com/id/app-store/" target="_blank">
                                    <img style="width:18%;" src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                </a>
                                <a href="https://play.google.com/" target="_blank">
                                    <img style="width:21%;" src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        {{-- end hero --}}
        <section class="h-100 w-100 bg-white">
            <div class="container-xxl mx-auto p-0">
                <div class="slick-pop-slider">
                    <!-- partial:index.partial.html -->
                    <div class="Containertwo">
                        <h1 class="Head">{{ Translate::translate('Popular Destinations') }}<span class="Arrows"></span></h1>
                        <!-- Carousel Container -->
                        <div class="SlickCarouseltwo">
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Sanur&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/denpasar.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Sanur</p>
                                            <p class="desc-list" id="sanur"></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Ubud&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/ubud.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Ubud</p>
                                            <p class="desc-list">2 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Canggu&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/canggu.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Canggu</p>
                                            <p class="desc-list">1.5 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Kuta&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/kuta.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Kuta</p>
                                            <p class="desc-list">20 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Nusa+Dua&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/nusa-dua.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Nusa Dua</p>
                                            <p class="desc-list">25 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Uluwatu&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/uluwatu.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Uluwatu</p>
                                            <p class="desc-list">30 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Jimbaran&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/jimbaran.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Jimbaran</p>
                                            <p class="desc-list">15 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <a href="../villa-search?fMinPrice=0&fMaxPrice=100000000&fBedroom=0&fBathroom=0&fBeds=0&fProperty=&fViews=&fAmenities=&sLocation=Tanah+Lot&sCheck_in=&sCheck_out=&sAdult=1&sChild=0">
                                    <div class="Content">
                                        <div class="img-fill">
                                            <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/tanah-lot.webp') }}">
                                        </div>
                                        <div class="desc-list-container">
                                            <p class="desc-list-title">Tanah Lot</p>
                                            <p class="desc-list">10 Km {{ Translate::translate('Away') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/candi-dasa.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Candi Dasa</p>
                                        <p class="desc-list">12 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/tulamben.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Tulamben</p>
                                        <p class="desc-list">60 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/bedugul.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Bedugul</p>
                                        <p class="desc-list">65 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/seminyak.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Seminyak</p>
                                        <p class="desc-list">12 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/lovina.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Lovina</p>
                                        <p class="desc-list">90 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/pemuteran.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Pemuteran</p>
                                        <p class="desc-list">100 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
                            <!-- Item -->
                            <div class="ProductBlock">
                                <div class="Content">
                                    <div class="img-fill">
                                        <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/nusa-penida.webp') }}">
                                    </div>
                                    <div class="desc-list-container">
                                        <p class="desc-list-title">Nusa Penida</p>
                                        <p class="desc-list">50 Km {{ Translate::translate('Away') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item -->
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
                    <div class="row-grid">
                        <div class="mb-3">
                            <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden" style="border-radius: 15px;">
                                <img src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/media/photos/desktop/restaurant.webp') }}" class="card-img lozad index-experience-img" alt="...">
                                <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <h1 class="card-title">{{ Translate::translate('Restaurants') }}</h1>
                                        <a href="{{ route('restaurant_list') }}" class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row-grid-img">
                                @if ($restaurant->count() > 9)
                                @for ($i = 0; $i < 9; $i++) <div>
                                    <a href="{{ route('restaurant', $restaurant[$i]->id_restaurant) }}" class="grid-img-container">
                                        <img class="grid-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('/foto/restaurant/' . $restaurant[$i]->uid . '/' . $restaurant[$i]->image) }}">
                                        <div class="grid-text">
                                            {{ $restaurant[$i]->name }}
                                        </div>
                                    </a>
                            </div>
                            @endfor
                            @else
                            @forelse ($restaurant as $item)
                            <div>
                                <a href="{{ route('restaurant', $item->id_restaurant) }}" class="grid-img-container">
                                    <img class="grid-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('/foto/restaurant/' . $item->uid . '/' . $item->image) }}">
                                    <div class="grid-text">
                                        {{ $item->name }}
                                    </div>
                                </a>
                            </div>
                            @empty
                            {{ Translate::translate('there is no content yet') }}
                            @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div class="slick-pop-slider">
                <!-- partial:index.partial.html -->
                <div class="Container">
                    <h1 class="Head">
                        {{ Translate::translate('Popular Places in Bali for Nature') }}<span class="Arrows"></span>
                    </h1>
                    <!-- Carousel Container -->
                    <div class="SlickCarousel">
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/mt-batur.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Mount Batur</p>
                                    <p class="desc-list">0.5 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/jatiluwih.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Jatiluwih</p>
                                    <p class="desc-list">2 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/kebun-raya-bedugul.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Bedugul</p>
                                    <p class="desc-list">1.5 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/campuhan.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Campuhan</p>
                                    <p class="desc-list">20 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/sidemen.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Sidemen</p>
                                    <p class="desc-list">25 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/kintamani.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Kintamani</p>
                                    <p class="desc-list">30 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/west-bali.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">West Bali</p>
                                    <p class="desc-list">15 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/menjangan.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Menjangan</p>
                                    <p class="desc-list">10 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/gitgit.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">gitgit</p>
                                    <p class="desc-list">12 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/tulamben.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Tulamben</p>
                                    <p class="desc-list">60 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/bedugul.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Bedugul</p>
                                    <p class="desc-list">65 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/seminyak.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Seminyak</p>
                                    <p class="desc-list">12 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/lovina.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Lovina</p>
                                    <p class="desc-list">90 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/pemuteran.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Pemuteran</p>
                                    <p class="desc-list">100 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <!-- Item -->
                        <div class="ProductBlock">
                            <div class="Content">
                                <div class="img-fill">
                                    <img loading="lazy" src="{{ URL::asset('assets/media/photos/desktop/nusa-penida.webp') }}">
                                </div>
                                <div class="desc-list-container">
                                    <p class="desc-list-title">Nusa Penida</p>
                                    <p class="desc-list">50 Km {{ Translate::translate('Away') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                    </div>
                    <!-- Carousel Container -->
                </div>
            </div>
        </div>
    </section>

    {{-- Things To Do --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 0rem 6rem 3rem 6rem;">
                <h1 class="mb-5">{{ Translate::translate('Discover Experiences') }}</h1>
                <div class="row-grid">
                    <div class="mb-3">
                        <div class="row-grid-img">
                            @if ($activity->count() > 9)
                            @for ($i = 0; $i < 9; $i++) <div>
                                <a href="{{ route('activity', $activity[$i]->id_activity) }}" class="grid-img-container">
                                    <img class="grid-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('/foto/activity/' . $activity[$i]->uid . '/' . $activity[$i]->image) }}">
                                    <div class="grid-text">
                                        {{ $activity[$i]->name }}
                                    </div>
                                </a>
                        </div>
                        @endfor
                        @else
                        @forelse ($activity as $item)
                        <div>
                            <a href="{{ route('activity', $item->id_activity) }}" class="grid-img-container">
                                <img class="grid-img lozad" src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('/foto/activity/' . $item->uid . '/' . $item->image) }}">
                                <div class="grid-text">
                                    {{ $item->name }}
                                </div>
                            </a>
                        </div>
                        @empty
                        {{ Translate::translate('there is no content yet') }}
                        @endforelse
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden" style="border-radius: 15px;">
                        <img src="{{ LazyLoad::show() }}" data-src="{{ URL::asset('assets/media/photos/desktop/activity.webp') }}" class="card-img lozad index-experience-img" alt="...">
                        <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h1 class="card-title">{{ Translate::translate('Things To Do') }}</h1>
                                <a href="{{ route('activity_list') }}" class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
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
                    <div class="card card-overlay bg-dark text-white border-0 overflow-hidden lozad-gallery lozad-gallery-load index-jumbotron" data-src='{{ URL::asset('assets/media/photos/desktop/villa.webp') }}'>
                        <div class="p-0 h-100 card-overlay">
                            <div style="padding: 3rem 6rem" class="container-xxl mx-auto h-100">
                                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                                    <h1 class="card-title">
                                        {{ Translate::translate('Learn about listing') }}<br>{{ Translate::translate('your home, hotel, restaurant, or activity') }}
                                    </h1>
                                    <div>
                                        <a href="{{ route('ahost') }}" class="btn btn-company text-white" target="_blank">{{ Translate::translate('Ask a Super Host') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    {{-- GeoLocation --}}
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supsported by this browser.";
            }
        }

        function showPosition(position) {
            let latitudeUser = position.coords.latitude;
            let longitudeUser = position.coords.longitude;
            console.log(latitudeUser);
            console.log(longitudeUser);

            $.ajax({
                type: "GET",
                url: "/index/get_lat_long/",
                data: {
                    latitudeUser: latitudeUser,
                    longitudeUser: longitudeUser,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $("#sanur").text(data + ' Km Away');
                },
            });
        }

        getLocation();
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

    <script>
        $(document).ready(function() {
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
            $(".SlickCarouseltwo").slick({
                rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay: false,
                autoplaySpeed: 5000, //  Slide Delay
                speed: 800, // Transition Speed
                slidesToShow: 5, // Number Of Carousel
                slidesToScroll: 3, // Slide To Move
                pauseOnHover: false,
                appendArrows: $(".Containertwo .Head .Arrows"),
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

    {{-- LAZY LOAD --}}
    @include('components.lazy-load.lazy-load')
    {{-- END LAZY LOAD --}}
</body>

</html>