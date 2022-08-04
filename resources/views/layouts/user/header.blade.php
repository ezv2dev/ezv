    <style>
        input[type="text"]:disabled {
            background: #ffffff;
            border-style: none;
        }

        .right-bar {
            text-align: right;
            display: flex;
            position: relative;
            padding-right: 24px !important;
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

        /*Dropdown users stile*/

        .dropbtn {
            margin-right: 0px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ff7400 !important;
            padding: 17px;
        }

        .dropbtn:hover {
            --tw-shadow: none;
            box-shadow: none;
            transition: none;
        }

        .dropbtn::after {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f007";
            color: #fff;
            font-size: 18px;
        }

        .dropbtn:hover, .dropbtn1:focus {
            background-color: #ff7400;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 225px;
            overflow: auto;
            z-index: 1;
            right: 0;
            top: 70px;
            border-radius: 15px;
            border: solid 2px #ff7400;
            padding: 10px 0;
            text-align: left;
        }

        .dropdown-content a {
            color: #282828;
            text-decoration: none;
            display: block;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
        }

        .dropdown1 a:hover {
            color: #ff7400;
        }

        .show {
            display: block;
        }

        .dropdown-content a {
            cursor: pointer;
        }

        .dropdown-content a:hover {
            color: #ff7400 !important;
        }
    </style>

    @php
        $condition_villa = Route::is('villa');
        $condition_restaurant = Route::is('restaurant');
        $condition_hotel = Route::is('hotel') || Route::is('room_hotel');
        $condition_things_to_do = Route::is('activity') || Route::is('activity_price_index');
    @endphp

    <div class="row inside-header-inner-wrap">
        <div class="col-3 logo villa-list-header-logo flex-fill" style="display: table;">
            <a href="{{ route('index') }}" target="_blank"><img style="width: 90px; margin-top: 15px;"
                    src="{{ asset('assets/logo.png') }}" alt="oke"></a>
        </div>

        @if ($condition_villa)
            <div class="col-6 search-box">
                <div id="row_popup" class="row">
                    <div class="col-12 text-center">
                        <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp()"
                            style="cursor: pointer; width: 65%;">

                            <div
                                style="flex: 1 1 !important; color: #8c8c8c; text-align: left; align-items: center; display: flex;">
                                {{ __('user_page.Search here') }}
                            </div>
                            <div class="top-search"><img src="{{ asset('assets/icon/menu/search.svg') }}"
                                    style="width: 20px; height: auto;">
                                <!-- <i style="color: white;" class="fa fa-search"></i> -->
                            </div>
                        </div>

                        <div id="search_bar" class="searchbar-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../homes/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                            target="_blank" id="villa-form" class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" class="nav-link-form-detail"
                                            target="_blank">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../food/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sCuisine="
                                            target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../hotel/search?fViews=&sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                            target="_blank" id="hotel-form" class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../wow/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                            target="blank" id="activity-form" class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" target="_blank"
                                        class="nav-link-form-detail" target="_blank" style="margin-left: 60px;">
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="font-black fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        <p>{{ __('user_page.create listing') }}</p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar" id="parentBar">
                                    <div class="location">
                                        <p>{{ __('user_page.Location') }}</p>
                                        <input type="text" class="form-control input-transparant"
                                            onfocus="this.value=''" value="{{ $_COOKIE['sLocation'] ?? '' }}"
                                            id="loc_sugest" name="sLocation"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="Where are you going?">

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
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
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
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none">
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
                                                    <p>{{ __('user_page.location not found') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="check-in">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:350px; height: 60px; margin-left: -90px; margin-top: -8px;"
                                            class="collapsible_check_search"></a>
                                        <p>{{ __('user_page.Check in') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            {{-- value="{{ $_COOKIE['sCheck_in'] ?? '' }}" --}} id="check_in4" name="sCheck_in"
                                            style="width: 100% !important; background-color: #ffffff00; margin-top: 2px;">
                                    </div>
                                    <div class="check-out">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:150px; height: 60px; margin-left: -90px; margin-top: -8px;"
                                            class="collapsible_check_search"></a>
                                        <p>{{ __('user_page.Check out') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            style="background-color: #ffffff00; margin-top: 2px;"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            {{-- value="{{ $_COOKIE['sCheck_out'] ?? '' }}" --}} id="check_out4" name="sCheck_out" readonly>
                                    </div>

                                    <div class="guests">
                                        <p>{{ __('user_page.Guests') }}</p>
                                        <ul class="nav">
                                            <li class="button-dropdown">
                                                <input type="number" id="total_guest3" value="1"
                                                    style="width: 10px; border: 0; margin-right: 0; text-align: right;"
                                                    disabled min="1"> {{ __('user_page.Guest') }}
                                                <a href="javascript:void(0)" class="dropdown-toggle"
                                                    style="margin-left: 20px;">
                                                    {{ __('user_page.Add') }}
                                                </a>

                                                <div class="guest-popup dropdown-menu">
                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Adults') }}</p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Age 13 or above') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="adult_decrement_header()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="adult3" name="sAdult"
                                                                    value="1"
                                                                    style="text-align: center; border:none; width:40px;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="adult_increment_header()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Children') }}</p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Ages 2–12') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="child_decrement_header()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="child3" name="sChild"
                                                                    value="0"
                                                                    style="text-align: center; border:none; width:40px;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="child_increment_header()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Infants') }}</p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Under 2') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="infant_decrement_header()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="infant3" name="sInfant"
                                                                    value="0"
                                                                    style="text-align: center; border:none; width:40px;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="infant_increment_header()"
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
                                                                    {{ __('user_page.Pets') }}</p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Service animal ?') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="pet_decrement_header()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="pet3" name="sPet"
                                                                    value="0"
                                                                    style="text-align: center; border:none; width:40px;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="pet_increment_header()"
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
                                            style="z-index: 1; border: none; background: transparent;"
                                            onclick="villaFilter()">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>

                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_check_search"
                                    style="margin-left: -1057px; width: fit-content; padding: 20px 0; min-height: 430px; max-height: 430px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div>
                                                <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                    class="col-lg-12">
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
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_restaurant)
            <div class="col-6 search-box">
                <div id="row_popup" class="row">
                    <div class="col-12 text-center">
                        <div id="searchbox" style="width: 65%;" class="searchbox searchbox-display-block"
                            onclick="popUp()" style="cursor: pointer;">
                            <div
                                style="flex: 1 1 !important; color: #8c8c8c; text-align: left; align-items: center; display: flex;">
                                {{ __('user_page.Search here') }}
                            </div>
                            <div class="top-search"><img src="{{ asset('assets/icon/menu/search.svg') }}"
                                    style="width: 20px; height: auto;">
                                <!-- <i style="color: white;" class="fa fa-search"></i> -->
                            </div>
                        </div>

                        <div id="search_bar" class="searchbar-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../homes/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                            target="_blank" id="villa-form" class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../food/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sCuisine="
                                            target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../hotel/search?fViews=&sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                            target="_blank" id="hotel-form" class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../wow/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                            target="_blank" id="activity-form" class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" class="nav-link-form-detail"
                                        target="_blank" style="margin-left: 60px;">
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="font-black fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        <p>{{ __('user_page.create listing') }}</p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar bar-restaurant-detail" id="parentBar">
                                    <div class="location-restaurant">
                                        <p>{{ __('user_page.Location / Restaurant') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            autocomplete="off" value="{{ request()->get('sLocation') ?? '' }}"
                                            id="loc_sugest" name="location"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="Where are you going?">

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
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
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
                                                        style="display: nonecursor: pointer;"
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
                                                    <p>{{ __('user_page.location not found') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guests" style="width: auto;">
                                        <p>{{ __('user_page.What do you want to eat ?') }}</p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sKeyword" value=""
                                            id="search_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest2" class="location-popup display-none"
                                            style="width: 560px; left: -262px; height: 390px;">
                                            <div class="location-popup-container h-100">
                                                <div class="row location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    @php
                                                        $restaurantSubCategory = App\Http\Controllers\Restaurant\RestaurantController::restaurant_subcategory();
                                                    @endphp

                                                    @foreach ($restaurantSubCategory as $item)
                                                        <div class="col-12 col-md-6 col-lg-4 d-flex"
                                                            style="padding-left: 0px !important; align-items: center;">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    style="background: #222222;"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op2"
                                                                    data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @foreach ($restaurantSubCategory as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button" style="padding-left: 0px;">
                                        <button onclick="foodFilter()"
                                            style="z-index: 1; border: none; background: transparent;">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_hotel)
            <div class="col-6 search-box">
                <div id="row_popup" class="row">
                    <div class="col-12 text-center">
                        <div id="searchbox" style="width: 65%;" class="searchbox searchbox-display-block"
                            onclick="popUp()" style="cursor: pointer;">
                            <div
                                style="flex: 1 1 !important; color: #8c8c8c; text-align: left; align-items: center; display: flex;">
                                {{ __('user_page.Search here') }}
                            </div>
                            <div class="top-search"><img src="{{ asset('assets/icon/menu/search.svg') }}"
                                    style="width: 20px; height: auto;">
                                <!-- <i style="color: white;" class="fa fa-search"></i> -->
                            </div>
                        </div>

                        <div id="search_bar" class="searchbar-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('hotel/*'))
                                            <a href="../../homes/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                target="_blank" id="villa-form" class="nav-link-form-detail">
                                                @if ($condition_villa)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>
                                                    {{ __('user_page.Homes') }}
                                                </p>
                                            </a>
                                        @else
                                            <a href="../homes/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                target="_blank" id="villa-form" class="nav-link-form-detail">
                                                @if ($condition_villa)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>
                                                    {{ __('user_page.Homes') }}
                                                </p>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('hotel/*'))
                                            <a href="../../food/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sCuisine="
                                                target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                                @if ($condition_restaurant)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>{{ __('user_page.Food') }}</p>
                                            </a>
                                        @else
                                            <a href="../food/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sCuisine="
                                                target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                                @if ($condition_restaurant)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>{{ __('user_page.Food') }}</p>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.restaurants') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('hotel/*'))
                                            <a href="../../hotel/search?fViews=&sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                                target="_blank" id="hotel-form" class="nav-link-form-detail">
                                                @if ($condition_hotel)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>{{ __('user_page.hotels') }}</p>
                                            </a>
                                        @else
                                            <a href="../hotel/search?fViews=&sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                                target="_blank" id="hotel-form" class="nav-link-form-detail">
                                                @if ($condition_hotel)
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p>{{ __('user_page.hotels') }}</p>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detai">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('hotel/*'))
                                            <a href="../../wow/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                                target="_blank" id="activity-form" class="nav-link-form-detail">
                                                @if ($condition_things_to_do)
                                                    <div
                                                        class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="font-black list-description">
                                                    {{-- {{ __('user_page.things to do') }} --}}
                                                    WoW
                                                </p>
                                            </a>
                                        @else
                                            <a href="../wow/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                                target="_blank" id="activity-form" class="nav-link-form-detail">
                                                @if ($condition_things_to_do)
                                                    <div class="class="font-black list-description nav-link-gap
                                                        nav-link-style-detail nav-link-style-detail-active
                                                        nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="font-black list-description">
                                                    {{-- {{ __('user_page.things to do') }} --}}
                                                    WoW
                                                </p>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" class="nav-link-form-detail"
                                        target="_blank" style="margin-left: 60px;">
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="font-black fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        <p>{{ __('user_page.create listing') }}</p>
                                    </a>
                                </ul>
                            </div>
                            <div>
                                <form action="{{ route('search_hotel') }}" method="GET" id="basic-form"
                                    autocomplete="off">
                                    <div id="parentBar" class="bar">
                                        <div class="location">
                                            <p>{{ __('user_page.Location') }}</p>
                                            <input type="text" onfocus="this.value=''"
                                                class="form-control input-transparant" value="" id="loc_sugest"
                                                name="sLocation"
                                                style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                                placeholder="Where are you going?">

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
                                                        <div class="col-lg-12 location-popup-desc-container sugest-list-first"
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
                                                    @endforeach
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                        style="display: none">
                                                        <p>{{ __('user_page.location not found') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="check-in">
                                            <a type="button"
                                                style="position : absolute; z-index:1; width:350px; height: 60px; margin-left: -90px; margin-top: -8px;"
                                                class="collapsible_check_search"></a>
                                            <p>{{ __('user_page.Check in') }}</p>
                                            <input type="text" onfocus="this.value=''"
                                                placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                                value="{{ $_COOKIE['sCheck_in'] ?? '' }}" id="check_in4"
                                                name="sCheck_in"
                                                style="width: 100% !important; background-color: #ffffff00; margin-top: 2px;">
                                        </div>
                                        <div class="check-out">
                                            <a type="button"
                                                style="position : absolute; z-index:1; width:150px; height: 60px; margin-left: -90px; margin-top: -8px;"
                                                class="collapsible_check_search"></a>
                                            <p>{{ __('user_page.Check out') }}</p>
                                            <input type="text" onfocus="this.value=''"
                                                style="background-color: #ffffff00; margin-top: 2px;"
                                                placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                                value="{{ $_COOKIE['sCheck_out'] ?? '' }}" id="check_out4"
                                                name="sCheck_out" readonly>
                                        </div>
                                        <div class="guests">
                                            <p>{{ __('user_page.Guests') }}</p>
                                            <ul class="nav">
                                                <li class="button-dropdown">
                                                    <input type="number" id="total_guest3" value="1"
                                                        style="width: 10px; border: 0; margin-right: 0; text-align: right;"
                                                        disabled min="1"> {{ __('user_page.Guest') }}
                                                    <a href="javascript:void(0)" class="dropdown-toggle"
                                                        style="margin-left: 20px;">
                                                        {{ __('user_page.Add') }}
                                                    </a>

                                                    <div class="guest-popup dropdown-menu">
                                                        <div class="guests-input-row">
                                                            <div class="col-6">
                                                                <div class="col-12 guest-type-container">
                                                                    <p class="guest-type-title">
                                                                        {{ __('user_page.Adults') }}</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">
                                                                        {{ __('user_page.Age 13 or above') }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="adult_decrement_header()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="adult3"
                                                                        name="sAdult" value="1"
                                                                        style="text-align: center; border:none; width:40px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="adult_increment_header()"
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
                                                                        {{ __('user_page.Children') }}</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">
                                                                        {{ __('user_page.Ages 2–12') }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button" onclick="child_decrement_header()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="child3"
                                                                        name="sChild" value="0"
                                                                        style="text-align: center; border:none; width:40px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="child_increment_header()"
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
                                                                        {{ __('user_page.Infants') }}</p>
                                                                </div>
                                                                <div class="col-12" style="padding: 0px;">
                                                                    <p class="guest-type-desc">
                                                                        {{ __('user_page.Under 2') }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6"
                                                                style="display: flex; align-items: center; justify-content: end;">
                                                                <a type="button"
                                                                    onclick="infant_decrement_header()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="infant3"
                                                                        name="sInfant" value="0"
                                                                        style="text-align: center; border:none; width:40px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button"
                                                                    onclick="infant_increment_header()"
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
                                                                <a type="button" onclick="pet_decrement_header()"
                                                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fa-solid fa-minus guests-style"
                                                                        style="padding:0px"></i>
                                                                </a>
                                                                <div
                                                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                    <input type="number" id="pet3"
                                                                        name="sPet" value="0"
                                                                        style="text-align: center; border:none; width:40px;"
                                                                        min="0" readonly>
                                                                </div>
                                                                <a type="button" onclick="pet_increment_header()"
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
                                                <div class="cari">
                                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i class="fa fa-search cari"></i> -->
                                            </button>
                                        </div>

                                    </div>

                                    {{-- calendar --}}
                                    <div class="content sidebar-popup" id="popup_check_search"
                                        style="margin-left: -1064px; width: 720px; padding: 20px 0; min-height: 430px; max-height: 430px;">
                                        <div class="desk-e-call">
                                            <div class="flatpickr-container"
                                                style="display: flex; justify-content: center;">
                                                <div>
                                                    <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                        class="col-lg-12">
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

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_things_to_do)
            <div class="col-6 search-box">
                <div id="row_popup" class="row">
                    <div class="col-12 text-center">
                        <div id="searchbox" style="width: 65%;" class="searchbox searchbox-display-block"
                            onclick="popUp()" style="cursor: pointer;">
                            <div
                                style="flex: 1 1 !important; color: #8c8c8c; text-align: left; align-items: center; display: flex;">
                                {{ __('user_page.Search here') }}
                            </div>
                            <div class="top-search"><img src="{{ asset('assets/icon/menu/search.svg') }}"
                                    style="width: 20px; height: auto;">
                                <!-- <i style="color: white;" class="fa fa-search"></i> -->
                            </div>
                        </div>

                        <div id="search_bar" class="searchbar-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../homes/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                            target="_blank" id="villa-form" class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="font-black fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../food/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sCuisine="
                                            target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="font-black fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.Food') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        <a href="../hotel/search?fViews=&sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                            target="_blank" id="hotel-form" class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="font-black fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p>{{ __('user_page.hotels') }}</p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        <a href="../wow/search?sLocation={{ $_COOKIE['sLocation'] ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                            target="_blank" id="activity-form" class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="font-black list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="font-black list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="font-black list-description">
                                                {{-- {{ __('user_page.things to do') }} --}}
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form"
                                        class="nav-link-form-detail" target="_blank" style="margin-left: 60px;">
                                        <div
                                            class="font-black nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="font-black fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        <p>{{ __('user_page.create listing') }}</p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar bar-activity-detail" id="parentBar">
                                    <div class="location">
                                        <p>{{ __('user_page.Location') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            value="{{ request()->get('sLocation') }}" id="loc_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="Where are you going?">


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
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
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
                                                        <div class=" location-popup-map sugest-list-map">
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
                                                    <p>{{ __('user_page.location not found') }}</p>
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
                                            {{ __('user_page.Search') }}
                                        </p>

                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sKeyword" value=""
                                            id="search_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest2" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Beach">Beach</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Lake">Lake</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Mountain">Mountain</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Museum">Museum</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Zoo">Zoo</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $activitySubCategory = App\Http\Controllers\Activity\ActivityController::get_subcategory();
                                                @endphp
                                                @foreach ($activitySubCategory as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guests">
                                        <a type="button" class="collapsible_wow"></a>
                                        <p class="p-wow">{{ __('user_page.Date') }}</p>

                                        @if ((isset($_COOKIE['sCheck_in']) && $_COOKIE['sCheck_in'] != '') ||
                                            (isset($_COOKIE['sCheck_out']) && $_COOKIE['sCheck_out'] != ''))
                                            <p id="add_date_wow" class="add-date-wow" style="display: none;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @else
                                            <p id="add_date_wow" class="add-date-wow" style="display: block;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @endIf

                                        <div style="display: flex; padding: 0px;" class="input-date">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="start_date" id="start_date"
                                                value="{{ $_COOKIE['sCheck_in'] ?? '' }}"
                                                style="width: 100%; background-color: #ffffff00;">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="end_date" id="end_date"
                                                value="{{ $_COOKIE['sCheck_out'] ?? '' }}"
                                                style="width: 100%;  background-color: #ffffff00;">
                                        </div>
                                    </div>

                                    <div class="button">
                                        <button onclick="activityFilter()"
                                            style="z-index: 1; border: none; background: transparent;">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>
                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_wow"
                                    style="margin-left: -1064px; width: 720px; padding: 20px 0; min-height: 430px; max-height: 430px;">
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
        @endif

        <div class="col-7 col-md-3 list-villa-user right-bar">
            @if (Route::is('list') || Route::is('index'))
            @endif

            @auth
                @if (Route::current()->uri() == 'homes/{id}' ||
                    Route::current()->uri() == 'food/{id}' ||
                    Route::is('hotel') ||
                    Route::is('restaurant') ||
                    Route::is('activity') ||
                    Route::is('privacy_policy') ||
                    Route::is('terms') ||
                    Route::is('license') ||
                    Route::is('room_hotel'))
                    <!-- NEW NAV SHARE BUTTON-->
                    <div class="social-share-container">
                        <div class="text-center icon-center">
                            @guest
                                <div>
                                    <a onclick="loginForm(1)" style="cursor: pointer;">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button-22 favorite-button"
                                            style="display: unset; margin-left: 0px;">
                                            <path
                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                            </path>
                                        </svg>
                                        <span style="color: #aaa;">{{ __('user_page.FAVORITE') }}</span>
                                    </a>
                                </div>
                            @endguest
                            @auth
                                @if ($condition_villa)
                                    @php
                                        $cekVilla = App\Models\VillaSave::where('id_villa', $villa[0]->id_villa)
                                            ->where('id_user', Auth::user()->id)
                                            ->first();
                                    @endphp

                                    @if ($cekVilla == null)
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button-22 favorite-button likeButtonvilla{{ $villa[0]->id_villa }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="font-size: 12px; color: #aaa">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @else
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $villa[0]->id_villa }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: grey; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if ($condition_hotel)
                                    @php
                                        $cekHotel = App\Models\HotelSave::where('id_hotel', $hotel[0]->id_hotel)
                                            ->where('id_user', Auth::user()->id)
                                            ->first();
                                    @endphp

                                    @if ($cekHotel == null)
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $hotel[0]->id_hotel }}, 'hotel')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button favorite-button-22 likeButtonhotel{{ $hotel[0]->id_hotel }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: #aaa; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @else
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $hotel[0]->id_hotel }}, 'hotel')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button-active favorite-button-22 unlikeButtonhotel{{ $hotel[0]->id_hotel }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: grey; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if ($condition_restaurant)
                                    @php
                                        $cekRestaurant = App\Models\RestaurantSave::where('id_restaurant', $restaurant->id_restaurant)
                                            ->where('id_user', Auth::user()->id)
                                            ->first();
                                    @endphp

                                    @if ($cekRestaurant == null)
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $restaurant->id_restaurant }}, 'restaurant')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button favorite-button-22 likeButtonrestaurant{{ $restaurant->id_restaurant }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: #aaa; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @else
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $restaurant->id_restaurant }}, 'restaurant')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button-active favorite-button-22 unlikeButtonrestaurant{{ $restaurant->id_restaurant }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: grey; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if ($condition_things_to_do)
                                    @php
                                        $cekActivity = App\Models\ActivitySave::where('id_activity', $activity->id_activity)
                                            ->where('id_user', Auth::user()->id)
                                            ->first();
                                    @endphp

                                    @if ($cekActivity == null)
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $activity->id_activity }}, 'activity')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button favorite-button-22 likeButtonactivity{{ $activity->id_activity }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: #aaa; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @else
                                        <div style="width: 56px;">
                                            <a style="cursor: pointer;"
                                                onclick="likeFavorit({{ $activity->id_activity }}, 'activity')">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" role="presentation" focusable="false"
                                                    class="favorite-button-active favorite-button-22 unlikeButtonactivity{{ $activity->id_activity }}"
                                                    style="display: unset; margin-left: 0px;">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                                <div style="color: grey; font-size: 12px;">
                                                    {{ __('user_page.FAVORITE') }}</div>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endauth
                        </div>
                        <div class="text-center icon-center">
                            <div type="button" class="" onclick="share()" style="text-align: center;">
                                <svg class="detail-share-button" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M503.7 226.2l-176 151.1c-15.38 13.3-39.69 2.545-39.69-18.16V272.1C132.9 274.3 66.06 312.8 111.4 457.8c5.031 16.09-14.41 28.56-28.06 18.62C39.59 444.6 0 383.8 0 322.3c0-152.2 127.4-184.4 288-186.3V56.02c0-20.67 24.28-31.46 39.69-18.16l176 151.1C514.8 199.4 514.8 216.6 503.7 226.2z" />
                                </svg>
                                <div style="font-size: 12px; color: #aaa;">{{ __('user_page.SHARE') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END NEW NAV SHARE BUTTON-->
                @endif
                <a type="button" onclick="language()" class="navbar-gap language-btn"
                    style="color: white; margin-right: 9px; width:27px;">
                    @if (session()->has('locale'))
                        <img class="language-flag-icon"
                            src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                    @else
                        <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                    @endif
                </a>


                <div style="display: table; margin-right: 0px; float: right;">
                    <!--<h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>-->
                </div>
                <div class="logged-user-menu-detail" style="">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="logged-user-photo-detail" alt="">
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
                                    <img class="dropdown-user-img"
                                        src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                @endif
                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</div>
                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                </div>
                            </h6>
                            <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                {{ __('user_page.Collab Portal') }}
                            </a>
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

                {{-- button toggler for mobile --}}
                <button class="navbar-toggler d-flex d-md-none" type="button" id="expand-mobile-btn">
                    <i class="fa-solid fa-bars list-description font-black"></i>
                </button>
            @else
                @if (Route::current()->uri() == 'homes/{id}' ||
                    Route::is('hotel') ||
                    Route::is('restaurant') ||
                    Route::is('activity') ||
                    Route::is('privacy_policy') ||
                    Route::is('terms') ||
                    Route::is('license') ||
                    Route::is('room_hotel'))
                    <!-- NEW NAV SHARE BUTTON-->
                    <div class="social-share-container" style="margin: 0px;">
                        <div class="text-center">
                            @guest
                                <div style="margin-bottom: 0px; font-size: 12px;">
                                    <a onclick="loginForm(1)" style="cursor: pointer;">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button-22 favorite-button"
                                            style="display: unset; margin-left: 0px;">
                                            <path
                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                            </path>
                                        </svg>
                                        <div style="color: #aaa;">{{ __('user_page.FAVORITE') }}</div>
                                    </a>
                                </div>
                            @endguest
                            @auth
                                @php
                                    $cekVilla = App\Models\VillaSave::where('id_villa', $villa[0]->id_villa)
                                        ->where('id_user', Auth::user()->id)
                                        ->first();
                                @endphp

                                @if ($cekVilla == null)
                                    <div>
                                        <a style="cursor: pointer;"
                                            onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                role="presentation" focusable="false"
                                                class="favoeite-button favorite-button-22 likeButtonvilla{{ $villa[0]->id_villa }}">
                                                <path
                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                </path>
                                            </svg>
                                            <div style="margin-top: -12px; margin-left: 10px;">
                                                {{ __('user_page.FAVORITE') }}</div>
                                        </a>
                                    </div>
                                @else
                                    <div>
                                        <a style="cursor: pointer;"
                                            onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                role="presentation" focusable="false"
                                                class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $villa[0]->id_villa }}">
                                                <path
                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                </path>
                                            </svg>
                                            <div style="margin-top: -12px; margin-left: 10px; color: #e31c5f">
                                                {{ __('user_page.FAVORITE') }}</div>
                                        </a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <div class="text-center">
                            <div type="button" class="" onclick="share()"
                                style="margin: 0px; color: #ff7400; font-size: 12px;">
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
                    <!-- END NAV SHARE BUTTON-->
                @endif

                <a type="button" onclick="language()" class="navbar-gap language-btn"
                    style="color: white; margin-right: 9px; width:27px;">
                    @if (session()->has('locale'))
                        <img class="language-flag-icon"
                            src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                    @else
                        <img class="language-flag-icon" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                    @endif
                </a>

                <!-- <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap login-btn"
                    style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: flex; align-items: center; justify-content: center; ">
                    <i class="fa-solid fa-user"></i>
                </a> -->
                
                <div class="dropdown">
                    <button onclick="thisFunction()" class="dropbtn btn border-0 navbar-gap"></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a onclick="loginForm(2)">Login</a>
                        <a onclick="loginForm(2)">Register</a>
                        <hr>
                        <a href="{{ route('ahost') }}">Become a Host</a>
                        <a href="{{ route('collaborator_list') }}">Collaborator Portal</a>
                        <a href="{{ route('faq') }}">FAQ</a>
                    </div>
                </div>

                {{-- button toggler for mobile --}}
                <button class="navbar-toggler d-flex d-md-none" type="button" id="expand-mobile-btn">
                    <i class="fa-solid fa-bars list-description font-black"></i>
                </button>
            @endauth
        </div>

        <script>
            var coll = document.getElementsByClassName("collapsible_check_search");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content = document.getElementById('popup_check_search');
                    if (content.style.display === "block") {
                        content.style.display = "none";
                    } else {
                        content.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content;
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

        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
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
                        var navGap = gap - 20;
                        var headerWidth = windowWidth - (gap * 2);
                        $(".page-content").css("padding-left", gap + "px");
                        $(".page-content").css("padding-right", gap + "px");
                        $(".bottom-content").css("padding-left", gap + "px");
                        $(".bottom-content").css("padding-right", gap + "px");
                        $(".head-inner-wrap .inside-header-inner-wrap").css("width", headerWidth + "px");
                        $("#sidebar_fix").css("right", gap + "px");
                        $("#navbarright").css("right", navGap + "px");
                    } else {
                        $(".head-inner-wrap .inside-header-inner-wrap").css("width", "");
                        $(".page-content").css("padding-left", "");
                        $(".page-content").css("padding-right", "");
                        $(".bottom-content").css("padding-left", "");
                        $(".bottom-content").css("padding-right", "");
                        $("#sidebar_fix").css("right", "");
                        $("#navbarright").css("right", "0");
                    }
                    if (windowWidth > 1359) {
                        var gap = (windowWidth - 1360) / 2;
                        var navGap = gap - 20;
                        $("#rsv-block-btn .rsv").css("right", navGap + "px");
                    } else {
                        $("#rsv-block-btn .rsv").css("right", "0px");
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
                        "height": "",
                        "overflow": ""
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
                        "height": "",
                        "overflow": ""
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
            function adult_increment_header() {
                document.getElementById('adult3').stepUp();
                document.getElementById('total_guest3').value = parseInt(document.getElementById('adult3').value) + parseInt(
                    document.getElementById('child3').value);
                document.getElementById('total_guest2').value = document.getElementById('total_guest3').value;
                document.getElementById('total_guest4').value = document.getElementById('total_guest3').value;
                document.getElementById('adult2').value = document.getElementById('adult3').value;
                document.getElementById('adult4').value = document.getElementById('adult3').value;
            }

            function adult_decrement_header() {
                document.getElementById('adult3').stepDown();
                document.getElementById('total_guest3').value = parseInt(document.getElementById('adult3').value) +
                    parseInt(document.getElementById('child3').value);
                document.getElementById('total_guest2').value = document.getElementById('total_guest3').value;
                document.getElementById('total_guest4').value = document.getElementById('total_guest3').value;
                document.getElementById('adult2').value = document.getElementById('adult3').value;
                document.getElementById('adult4').value = document.getElementById('adult3').value;
            }

            function child_increment_header() {
                document.getElementById('child3').stepUp();
                document.getElementById('total_guest3').value = parseInt(document.getElementById('adult3').value) +
                    parseInt(document.getElementById('child3').value);
                document.getElementById('total_guest2').value = document.getElementById('total_guest3').value;
                document.getElementById('total_guest4').value = document.getElementById('total_guest3').value;
                document.getElementById('child2').value = document.getElementById('child3').value;
                document.getElementById('child4').value = document.getElementById('child3').value;
            }

            function child_decrement_header() {
                document.getElementById('child3').stepDown();
                document.getElementById('total_guest3').value = parseInt(document.getElementById('adult3').value) +
                    parseInt(document.getElementById('child3').value);
                document.getElementById('total_guest2').value = document.getElementById('total_guest3').value;
                document.getElementById('total_guest4').value = document.getElementById('total_guest3').value;
                document.getElementById('child2').value = document.getElementById('child3').value;
                document.getElementById('child4').value = document.getElementById('child3').value;
            }

            function infant_increment_header() {
                document.getElementById('infant3').stepUp();
                document.getElementById('infant2').value = document.getElementById('infant3').value;
                document.getElementById('infant4').value = document.getElementById('infant3').value;
            }

            function infant_decrement_header() {
                document.getElementById('infant3').stepDown();
                document.getElementById('infant2').value = document.getElementById('infant3').value;
                document.getElementById('infant4').value = document.getElementById('infant3').value;
            }

            function pet_increment_header() {
                document.getElementById('pet3').stepUp();
                document.getElementById('pet2').value = document.getElementById('pet3').value;
                document.getElementById('pet4').value = document.getElementById('pet3').value;
            }

            function pet_decrement_header() {
                document.getElementById('pet3').stepDown();
                document.getElementById('pet2').value = document.getElementById('pet3').value;
                document.getElementById('pet4').value = document.getElementById('pet3').value;
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.location_op').bind('click', function(e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                    $('#sugest2').removeClass("display-block");
                    $('#sugest2').addClass("display-none");
                });
            });
        </script>

        <script>
            $('#adult3').on('change', function() {
                var total_adult = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_adult);
            });

            $('#child3').on('change', function() {
                var total_child = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_child);
            });
        </script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
            document.getElementById("villa-button").onclick = function() {
                document.getElementById("villa-form").submit();
            }

            document.getElementById("hotel-button").onclick = function() {
                document.getElementById("hotel-form").submit();
            }

            document.getElementById("restaurant-button").onclick = function() {
                document.getElementById("restaurant-form").submit();
            }

            document.getElementById("activity-button").onclick = function() {
                document.getElementById("activity-form").submit();
            }
        </script>

        {{-- FILTER RESTAURANT LIST --}}
        <script>
            function restaurantRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/food/search?${suburl}`;
            }

            function foodFilter() {
                var sLocationFormInput = $("input[name='sLocation']").val();

                function setCookie2(name, value, days) {
                    var expires = "";
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "") + expires + "; path=/";
                }

                setCookie2("sLocation", sLocationFormInput, 1);

                console.log($("input[name='sKeyword']").val());

                var sKeywordFormInput = function() {
                    var tmp = null;
                    $.ajax({
                        async: false,
                        type: "GET",
                        global: false,
                        dataType: 'json',
                        url: "/food/subcategory",
                        data: {
                            name: $("input[name='sKeyword']").val()
                        },
                        success: function(response) {
                            tmp = response.data;
                        }
                    });
                    return tmp;
                }();

                keyWordTemp = [];
                keyWordTemp.push(sKeywordFormInput);

                var subUrl =
                    `sLocation=${sLocationFormInput}&fCuisine=&fSubCategory=${keyWordTemp}`;
                restaurantRefreshFilter(subUrl);
            }
        </script>
        {{-- END FILTER RESTAURANT LIST --}}

        {{-- ACTIVITY FILTER --}}
        <script>
            function activityRefreshFilter(suburl) {
                window.location.href = `{{ env('APP_URL') }}/wow/search?${suburl}`;
            }
        </script>

        <script>
            function activityFilter() {
                var sLocationFormInput = $("input[name='sLocation']").val();
                var sKeywordFormInput = $("input[name='sKeyword']").val();
                var sStart = $("input[name='start_date']").val();
                var sEnd = $("input[name='end_date']").val();
                // console.log(sLocationFormInput);
                function setCookie2(name, value, days) {
                    var expires = "";
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "") + expires + "; path=/";
                }

                setCookie2("sLocation", sLocationFormInput, 1);
                setCookie2("sCheck_in", sStart, 1);
                setCookie2("sCheck_out", sEnd, 1);

                var subUrl =
                    `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}`;
                // console.log(subUrl);
                activityRefreshFilter(subUrl);
            }
        </script>

        <script>
            $(document).ready(() => {
                $("#search_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest2').removeClass("display-none");
                    $('#sugest2').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest2');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#search_sugest").on('keyup change', async () => {
                    var close = $(".sugest-list-first");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty2").eq(0).hide();

                    var formValue = $("#search_sugest").val();
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
                        $(".sugest-list-empty2").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op2").on('click', function(e) {
                    $('#search_sugest').val($(this).data("value"));
                    $('#sugest2').removeClass("display-block");
                    $('#sugest2').addClass("display-none");
                });
            });
        </script>
        {{-- END ACTIVITY FILTER --}}

        {{-- Calendar Header --}}
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
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function thisFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
                }
            }
        }
        </script>
