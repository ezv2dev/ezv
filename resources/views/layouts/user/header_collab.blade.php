    <style>
        input[type="text"]:disabled {
            background: #ffffff;
            border-style: none;
        }

        .right-bar {
            text-align: right;
            display: flex;
            position: relative;
        }

        .right-bar input[type="button"] {
            font-size: 12px;
            border: solid 1px #444444;
            background: #444444;
            color: #ffffff;
            padding: 5px 10px;
            top: 10px !important;
            position: relative;
            border-radius: 15px;
            max-height: 33px;
            margin-right: 5px;
        }

        /*
        .right-bar i {
            width: 30px;
            height: 30px;
            background: #444;
            color: #fff;
            padding: 5px 6px;
            text-align: center;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 18px;
            cursor: pointer;
        }*/

        .col-3.right-bar i:hover {
            background: #ff7400;
        }

        .right-bar input[type="button"] {
            top: 0;
        }

        .dropdown-pd-0 {
            padding: 0 !important;
            margin: 3px 0;
        }

        .dropdown-menu {
            border-radius: 15px !important;
            min-width: 220px;
        }

        .text-small {
            font-size: 12px;
            color: #899097;
        }

        .plus-min {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: solid 1px #b5b5b5;
            margin: 0 auto;
        }

        .text-small span {
            margin-left: 0 !important;
            font-size: 10px;
            color: #798289;
        }

        .dropdown-menu:hover {
            background-color: white !important;
        }

        .dropdown-pd-0:hover {
            background-color: white !important;
        }

        .searchbar-display-block {
            top: -90px;
        }

    </style>

    @php
    $condition_villa = Route::is('villa');
    $condition_restaurant = Route::is('restaurant');
    $condition_hotel = Route::is('hotel');
    $condition_things_to_do = Route::is('activity');
    $condition_collaborator = Route::is('collaborator');
    @endphp

    @php
        $get_loc = app('request')->input('sLocation');
        $get_search = app('request')->input('sKeyword');
        $get_start = null;
        $get_end = null;

        if ($get_loc == null) {
            $get_loc = '';
        }

        if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
            $get_loc = $_COOKIE['sLocation'];
        }

        if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
            $get_loc = '';
        }

        if (request()->sLocation) {
            $get_loc = request()->sLocation;
        }

        if ($get_search == null) {
            $get_search = __('user_page.Search');
        }

        if (isset($_COOKIE['sCheck_in'])) {
            $get_start = $_COOKIE['sCheck_in'];
        }

        if (isset($_COOKIE['sCheck_out'])) {
            $get_end = $_COOKIE['sCheck_out'];
        }

        if (request()->sStart) {
            $get_start = request()->sStart;
        }

        if (request()->sEnd) {
            $get_end = request()->sEnd;
        }

        function dateDiffe($get_start, $get_end)
        {
            $date1_ts = strtotime($get_start);
            $date2_ts = strtotime($get_end);
            $diff = $date2_ts - $date1_ts;
            return round($diff / 86400);
        }

        if ($get_start == null) {
            $get_date = __('user_page.Add Date');
        } else {
            if ($get_end == $get_start) {
                $dateDiffe = 1;
            } else {
                $dateDiffe = dateDiffe($get_start, $get_end);
            }
            $get_date = $dateDiffe . ' ' . trans_choice('user_page.x days', $dateDiffe);
        }

        if ($get_date == null) {
            $get_date = __('user_page.Add Date');
        }
    @endphp

    <div class="row">
        <div class="col-3 logo villa-list-header-logo flex-fill" style="display: table;">
            <a href="{{ route('index') }}" target="_blank"><img style="width: 90px; margin-top: 15px;"
                src="{{ asset('assets/logo.png') }}" alt="oke"></a>
        </div>

        {{-- @if ($condition_villa) --}}
        <div class="col-6 search-box">
            <div id="row_popup" class="row">
                <div class="col-12 text-center">
                    <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp()"
                        style="cursor: pointer;">
                        <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                    </div>

                    <div id="search_bar" class="searchbar-display-none">
                        <div id="change_display_block" class="display-none nav-menu-container">
                            <ul class="nav-link-container">
                                <a href="{{ route('list') }}" id="villa-form" class="nav-link-form-detail">
                                    @if ($condition_villa)
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                style="width: 31px; height: auto;">
                                        </div>
                                    {{-- <i id="villa-button"
                                        class="fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> --}}
                                    @else
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                style="width: 31px; height: auto;">
                                        </div>
                                    {{-- <i id="villa-button"
                                        class="fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> --}}
                                    @endif

                                    <p class="font-black list-description">
                                        {{ __('user_page.Homes') }}
                                    </p>
                                </a>

                                <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                    class="nav-link-form-detail">
                                    @if ($condition_restaurant)
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                style="width: 20px; height: auto;">
                                        </div>
                                    {{-- <i id="restaurant-button"
                                        class="fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> --}}
                                    @else
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                style="width: 20px; height: auto;">
                                        </div>
                                    {{-- <i id="restaurant-button"
                                        class="fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> --}}
                                    @endif

                                    <p class="font-black list-description">
                                    {{ __('user_page.Food') }}
                                    </p>
                                </a>

                                <a href="{{ route('hotel_list') }}" id="hotel-form" class="nav-link-form-detail">
                                    @if ($condition_hotel)
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                style="width: 29px; height: auto;">
                                        </div>
                                    {{-- <i id="hotel-button"
                                        class="fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> --}}
                                    @else
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                style="width: 29px; height: auto;">
                                        </div>
                                    {{-- <i id="hotel-button"
                                        class="fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> --}}
                                    @endif

                                    <p class="font-black list-description">
                                        {{ __('user_page.Hotels') }}
                                    </p>
                                </a>

                                <a href="{{ route('activity_list') }}" id="activity-form" class="nav-link-form-detail">
                                    @if ($condition_things_to_do)
                                        <div
                                            class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                style="width: 29px; height: auto; filter: none;">
                                        </div>
                                    {{-- <i id="activity-button" style="font-size: 24px;"
                                        class="fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> --}}
                                    @else
                                        <div
                                            class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                style="width: 29px; height: auto; filter: none;">
                                        </div>
                                    {{-- <i id="activity-button" style="font-size: 24px;"
                                        class="fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> --}}
                                    @endif

                                    <p class="font-black list-description">
                                        WoW
                                    </p>
                                </a>
                                <a href="{{ route('collaborator_list') }}" id="collaborator-form"
                                        class="nav-link-form-detail">
                                    @if ($condition_collaborator)
                                        <div
                                            class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/collab1.svg') }}"
                                                style="width: 29px; height: auto; filter: none;">
                                        </div>

                                    @else
                                        <div
                                            class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/collab1.svg') }}"
                                                style="width: 29px; height: auto; filter: none;">
                                        </div>
                                    @endif

                                    <p class="font-black list-description">
                                        {{ __('user_page.Collaborator') }}
                                    </p>
                                </a>
                            </ul>
                        </div>
                        <div>
                            <div class="bar bar-collaborator">
                                <div class="location">
                                    <p>{{ __('user_page.Location') }}
                                    </p>
                                    <input autocomplete="off" type="text"
                                        class="form-control input-transparant" name="sLocation"
                                        value="{{ Request::is('collaborator-list*') || $get_loc == null ? '' : $get_loc }}"
                                        id="loc_sugest" name="sLocation"
                                        style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                        placeholder="{{ __('user_page.Where are you going?') }}">

                                    <div id="sugest" class="location-popup display-none">
                                        <div class="location-popup-container h-100">
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
                                                $hotelName = App\Http\Controllers\HotelController::get_name();
                                                $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
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
                                                            type="button" class="location_op" target="_blank"
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
                                                            type="button" class="location_op" target="_blank"
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
                                                            type="button" class="location_op" target="_blank"
                                                            data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                style="display: none">
                                                <p>{{ __('user_page.location not found') }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="check-out">
                                    <p>
                                        {{-- <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                            style="width: 20px; height: auto;"> --}}
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <!-- <i class="fa fa-search" aria-hidden="true"></i> -->&nbsp;
                                        {{ __('user_page.Category') }}
                                    </p>
                                    <input type="text" style="background-color: #ffffff00;"
                                        placeholder="{{ __('user_page.Search here') }}"
                                        value="{{ request()->get('sKeyword') ?? '' }}" id="keyword"
                                        name="sKeyword">
                                </div>
                                <div class="guests">
                                    <a type="button"
                                        style="position : absolute; z-index:1; width:100%; height: 60px; margin-left: -90px; margin-top: -8px"
                                        class="collapsible_wow"></a>
                                    <p>{{ __('user_page.Date') }}</p>

                                    @if ((isset($_COOKIE['sCheck_in']) && $_COOKIE['sCheck_in'] != '') || (isset($_COOKIE['sCheck_out']) && $_COOKIE['sCheck_out'] != ''))
                                        <p id="add_date_wow"
                                            style="display: none; position: absolute; color: grey; font-size: 15px; top:34px; left: 75px; font-weight: 400;">
                                            {{ __('user_page.Add dates') }}</p>
                                    @else
                                        <p id="add_date_wow"
                                            style="position: absolute; color: grey; font-size: 15px; top:34px; left: 75px; font-weight: 400;">
                                            {{ __('user_page.Add dates') }}</p>
                                    @endIf
                                    <div style="display: flex; padding: 0px;" class="input-date">
                                        <input type="text" placeholder="" class="form-control"
                                            name="start_date" id="start_date"
                                            value="{{ $get_start ?? '' }}"
                                            style="width: 100%; background-color: #ffffff00;">
                                        <input type="text" placeholder="" class="form-control"
                                            name="end_date" id="end_date" value="{{ $get_end ?? '' }}"
                                            style="width: 100%;  background-color: #ffffff00;">
                                    </div>
                                </div>

                                <div class="button">
                                    <button onclick="collabSearch()" class="d-block ms-auto me-1"
                                        style="z-index: 1; border: none; background: transparent;">
                                        <div class="cari">
                                            <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                style="width: 20px; height: auto;">
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </div>
                                    </button>
                                </div>

                            </div>

                            {{-- calendar --}}
                            <div class="content sidebar-popup" id="popup_wow"
                                style="margin-left: -1185px; width:800px; padding:0px; z-index: 999;">
                                <div class="desk-e-call">
                                    <div class="flatpickr-container"
                                        style="display: flex; justify-content: center;">
                                        <div
                                            style="display: table; background-color: white;
                                            border-radius: 15px;">
                                            <div class="col-lg-12"
                                                style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                <a type="button" id="clear_date_wow"
                                                    style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                <p style="margin: 0px; font-size: 13px;"></p>
                                            </div>
                                            <div class="flatpickr" id="date_wow" style="text-align: left;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- calendar --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}

        <div class="col-7 col-md-3 list-villa-user right-bar">
            @if (Route::is('list') || Route::is('index'))
            <!--
            <form action="{{ route('list') }}" method="POST" id="villa-form">
                @csrf
                <a id="villa-button"><i class="fa-solid fa-house" data-bs-toggle="popover" data-bs-animation="true"
                        data-bs-placement="bottom" title="Villa"></i></a>
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
                <a id="hotel-button"><i class="fa fa-hotel" data-bs-toggle="popover" data-bs-animation="true"
                        data-bs-placement="bottom" title="Hotel"></i></a>
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
                <a id="restaurant-button"><i class="fa-solid fa-utensils" data-bs-toggle="popover"
                        data-bs-animation="true" data-bs-placement="bottom" title="Restaurant"></i></a>
            </form>
            <form action="{{ route('activity_list') }}" method="POST" id="activity-form">
                @csrf
                <a id="activity-button"><i class="fa-solid fa-person-walking" data-bs-toggle="popover"
                        data-bs-animation="true" data-bs-placement="bottom" title="Activity"></i></a>
            </form>
            -->
            @endif

            @auth

            @if (Route::current()->uri() == 'villa/{id}' || Route::is('privacy_policy') || Route::is('terms') ||
            Route::is('license'))
            <input type="button" style="top: 0px !important;" onclick="location.href='{{ route('register.partner') }}';"
                value="Become a Host" />
            @endif

            <div class="social-share-container">
                <div class="text-center icon-center">
                    <div style="width: 56px;">
                        @if ($profile->is_favorit)
                            <a href="" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    class="favorite-button favorite-button-22 likeButtonvilla{{ $profile->id_collab }}">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                                <div style="font-size: 12px; color: #aaa">
                                    {{ __('user_page.FAVORITE') }}</div>
                            </a>

                        @else
                            <a href="" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    class="favorite-button favorite-button-22 likeButtonvilla{{ $profile->id_collab }}">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                                <div style="font-size: 12px; color: #aaa">
                                    {{ __('user_page.FAVORITE') }}</div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="text-center icon-center">
                    <div type="button" style="margin: 0px; color: #ff7400; font-size: 12px;">
                        <svg class="detail-share-button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M503.7 226.2l-176 151.1c-15.38 13.3-39.69 2.545-39.69-18.16V272.1C132.9 274.3 66.06 312.8 111.4 457.8c5.031 16.09-14.41 28.56-28.06 18.62C39.59 444.6 0 383.8 0 322.3c0-152.2 127.4-184.4 288-186.3V56.02c0-20.67 24.28-31.46 39.69-18.16l176 151.1C514.8 199.4 514.8 216.6 503.7 226.2z">
                            </path>
                        </svg>
                        <div style="color: #ff7400;">{{ __('user_page.SHARE') }}</div>
                    </div>
                </div>
            </div>

            <a type="button" onclick="language()" class="navbar-gap language-btn"
                style="color: white; margin-right: 9px; width:27px;">
                @if (session()->has('locale'))
                <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                @else
                <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                @endif
            </a>


            <div style="display: table; margin-right: 0px; float: right;">
                <!--<h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>-->
            </div>
            <div class="logged-user-menu-detail" style="">
                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 1px;">
                    @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" class="logged-user-photo-detail" alt="">
                    @else
                    <img src="{{ asset('assets/icon/menu/user_default.svg') }}" class="logged-user-photo-detail"
                        alt="">
                    @endif

                    <!--
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                            style="margin-right: 0px; left: auto;">
                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                <li>
                                    <a href="{{ route('admin_dashboard') }}" class="dropdown-item">Dashboard</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('profile_index') }}" class="dropdown-item">My Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('profile_index') }}" class="dropdown-item">Change Password</a>
                            </li>
                            <li>
                                <a href="#!" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                    Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post"
                                    style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                        -->

                    <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                        aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                        <h6 class="dropdown-header d-flex align-items-center">
                            @if (Auth::user()->foto_profile != NULL)
                            <img class="dropdown-user-img"
                                src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                            @elseIf (Auth::user()->avatar != NULL)
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
                        <a class="dropdown-item" href="{{route('partner_dashboard')}}">
                            Dashboard
                        </a>
                        <a class="dropdown-item" href="{{route('profile_index')}}">
                            My Profile
                        </a>
                        <a class="dropdown-item" href="{{route('change_password')}}">
                            Change Password
                        </a>
                        <a class="dropdown-item" href="#!"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Sign Out
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>

                </a>
            </div>
            {{-- button toggler for mobile --}}
            <button class="navbar-toggler d-flex d-md-none" type="button" id="expand-mobile-btn">
                <i class="fa-solid fa-bars list-description font-black"></i>
            </button>
            @else
            @if (Route::current()->uri() == 'villa/{id}' || Route::is('privacy_policy') || Route::is('terms') ||
            Route::is('license'))
            <input type="button" style="top: 0px !important;" onclick="location.href='{{ route('register.partner') }}';"
                value="Become a Host" />
            @endif

            <a type="button" onclick="language()" class="navbar-gap language-btn"
                style="color: white; margin-right: 9px; width:27px;">
                @if (session()->has('locale'))
                <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                @else
                <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                @endif
            </a>

            <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap"
                style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: flex; align-items: center; justify-content: center; ">
                <i class="fa-solid fa-user"></i>
            </a>

            @endauth
        </div>

        <script>
            var coll = document.getElementsByClassName("collapsible_wow");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_wow');
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
            function popUp() {
                document.getElementById("add_class_popup").classList.add("header-popup");
                document.getElementById("searchbox").classList.remove("searchbox-display-block");
                document.getElementById("searchbox").classList.add("searchbox-display-none");
                document.getElementById("change_display_block").classList.remove("display-none");
                document.getElementById("change_display_block").classList.add("display-block");
                document.getElementById("search_bar").classList.add("searchbar-display-block");
                document.getElementById("row_popup").classList.add("row-popup-height");
            }

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

        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
                calendar_wow(2);
                $("#clear_date_wow").click(function() {
                    // $("#check_in2").val("");
                    $("#start_date").val("");
                    $("#end_date").val("");
                    document.getElementById('add_date_wow').style.display = "block";
                    calendar_wow(2);
                });
                function handleResponsive(windowWidth) {
                    if (windowWidth <= 991) {
                        $("#search_bar .bar").addClass("row");
                        $(".bar .location").addClass("col-12 mb-2");
                        $(".bar .location-restaurant").addClass("col-12 mb-2");
                        $(".bar .check-in").addClass("col-6 mb-2");
                        $(".bar .check-out").addClass("col-6 mb-2");
                        $(".bar-activity-detail .check-out").removeClass("col-6");
                        $(".bar-collaborator .check-out").removeClass("col-6");
                        $(".bar-activity-detail .check-out").addClass("col-12");
                        $(".bar-collaborator .check-out").addClass("col-12");
                        $(".bar .guests").addClass("col-10");
                        $(".bar .button").addClass("col-2");
                    } else {
                        $("#search_bar .bar").removeClass("row");
                        $(".bar .location").removeClass("col-12 mb-2");
                        $(".bar .location-restaurant").removeClass("col-12 mb-2");
                        $(".bar .check-in").removeClass("col-6 mb-2");
                        $(".bar .check-out").removeClass("col-6 mb-2");
                        $(".bar-activity-detail .check-out").removeClass("col-12 mb-2");
                        $(".bar-collaborator-detail .check-out").removeClass("col-12 mb-2");
                        $(".bar .guests").removeClass("col-10");
                        $(".bar .button").removeClass("col-2");
                    }
                    if (windowWidth > 1460) {
                        var gap = (windowWidth - 1360) / 2;
                        var headerWidth = windowWidth - (gap * 2);
                        $(".page-content").css("padding-left", gap + "px");
                        $(".page-content").css("padding-right", gap + "px");
                        $(".bottom-content").css("padding-left", gap + "px");
                        $(".bottom-content").css("padding-right", gap + "px");
                        $(".head-inner-wrap .inside-header-inner-wrap").css("width", headerWidth + "px");
                    }else {
                        $(".head-inner-wrap .inside-header-inner-wrap").css("width", "auto");
                        $(".page-content").css("padding-left", "40px");
                        $(".page-content").css("padding-right", "40px");
                        $(".bottom-content").css("padding-left", "40px");
                        $(".bottom-content").css("padding-right", "40px");
                    }
                    if (windowWidth > 1359) {
                        var gap = (windowWidth - 1360) / 2;
                        var navGap = gap - 20;
                        $("#sidebar_fix").css("right", gap + "px");
                        $("#rsv-block-btn .rsv").css("right", navGap + "px");
                        $("#navbarright").css("right", navGap + "px");
                    } else {
                        $("#sidebar_fix").css("right", "0");
                        $("#rsv-block-btn .rsv").css("right", "-20px");
                        $("#navbarright").css("right", "0");
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
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                })
                $("#expand-mobile-btn").on("click", function() {
                    $("body").css({
                        "height": "100%",
                        "overflow": "hidden"
                    })
                    $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "true");
                })
                $("#loc_sugest").on('click', function () { //use a class, since your ID gets mangled
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

                $(document).mouseup(function (e) {
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

                $(".location_op").on('click', function (e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                });
            });

        </script>

        <script>
            function adult_increment_header() {
                document.getElementById('adult3').stepUp();
                document.getElementById('total_guest3').stepUp();
                // document.getElementById('total_guest2').value = document.getElementById('total_guest3').value;
                // document.getElementById('total_guest4').value = document.getElementById('total_guest3').value;
                // document.getElementById('adult2').value = document.getElementById('adult3').value;
                // document.getElementById('adult4').value = document.getElementById('adult3').value;
            }

            function adult_decrement_header() {
                document.getElementById('adult3').stepDown();
                document.getElementById('total_guest3').stepDown();
            }

            function child_increment_header() {
                document.getElementById('child3').stepUp();
                document.getElementById('total_guest3').stepUp();
            }

            function child_decrement_header() {
                document.getElementById('child3').stepDown();
                document.getElementById('total_guest3').stepDown();
            }

            function infant_increment_header() {
                document.getElementById('infant3').stepUp();
            }

            function infant_decrement_header() {
                document.getElementById('infant3').stepDown();
            }

            function pet_increment_header() {
                document.getElementById('pet3').stepUp();
            }

            function pet_decrement_header() {
                document.getElementById('pet3').stepDown();
            }

        </script>

        <script>
            $(document).ready(function () {
                $('.location_op').bind('click', function (e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                    $('#sugest2').removeClass("display-block");
                    $('#sugest2').addClass("display-none");
                });
            });

        </script>

        <script>
            $('#adult3').on('change', function () {
                var total_adult = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_adult);
            });

            $('#child3').on('change', function () {
                var total_child = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_child);
            });

        </script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
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

        {{-- FILTER RESTAURANT LIST --}}
        <script>
            function restaurantRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/restaurant/s?${suburl}`;
            }

        </script>

        <script>
            function restaurantFilter() {
                var sLocationFormInput = $("input[name='sLocation']").val();
                // console.log(sLocationFormInput);

                var sKeywordFormInput = $("input[name='sKeyword']").val();
                // console.log(sKeywordFormInput);

                var sCuisineFormInput = [];
                $("input[name='sCuisine[]']:checked").each(function () {
                    sCuisineFormInput.push(parseInt($(this).val()));
                });
                // console.log(sCuisineFormInput);

                var subUrl =
                    `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sCuisine=${sCuisineFormInput}`;
                // console.log(subUrl);
                restaurantRefreshFilter(subUrl);
            }

        </script>
        {{-- END FILTER RESTAURANT LIST --}}

        {{-- ACTIVITY FILTER --}}
        <script>
            function activityRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/things-to-do/s?${suburl}`;
            }

        </script>
        <script>
            function activityFilter() {
                var sLocationFormInput = $("input[name='sLocation']").val();
                // console.log(sLocationFormInput);

                var subUrl = `sLocation=${sLocationFormInput}`;
                // console.log(subUrl);
                activityRefreshFilter(subUrl);
            }

        </script>
        {{-- END ACTIVITY FILTER --}}
