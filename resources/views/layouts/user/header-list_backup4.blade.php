    <style>
        input[type="text"]:disabled {
            background: #ffffff;
            border-style: none;
        }
        *{
            transition: all 0.2s ease;
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

        .col-4.right-bar i:hover {
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

        .input-guest {
            position: absolute;
            width: 184px;
            top: 0px;
            left: 0px;
            height: 62px;
        }

        .bg-orange{
            background-color: #ff7400;
        }
    </style>

    @php
    $condition_villa = Route::is('list') || Route::is('property_type') || Route::is('filter') || Route::is('price') ||
    Route::is('more_filter') || Route::is('box_filter') || Route::is('sort_low_to_high') ||
    Route::is('sort_high_to_low') || Route::is('sort_popularity') || Route::is('sort_newest') ||
    Route::is('sort_highest_rating') || Route::is('filter_activity') || Route::is('filter_activity_get_subcategory') ||
    Route::is('search_villa') ||
    Route::is('amenities_filter') || Route::is('filters');

    $condition_hotel = Route::is('hotel_list');

    $condition_restaurant = Route::is('restaurant_list') || Route::is('search_restaurant') ||
    Route::is('filter_restaurant');

    $condition_things_to_do = Route::is('activity_list') || Route::is('search_activity');
    @endphp

    <div class="row nav-row">
        <div class="col-4 logo villa-list-header-logo">
            <a href="{{ route('index') }}"><img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke"></a>
        </div>

        @if ($condition_villa)

        @php
            $get_loc = app('request')->input('location');
            $get_check_in = app('request')->input('check_in');
            $get_check_out = app('request')->input('check_out');
            $get_adult = app('request')->input('adult');
            $get_child = app('request')->input('child');
            $get_infant = app('request')->input('infant');
            $get_pet = app('request')->input('pet');

            if($get_loc == null){
                $get_loc = "Add Location";
            }

            if($get_check_in == null)
            {
                $get_dates = "Add Date";
            }else{
                if($get_check_out == $get_check_in)
                {
                    $days = "1 day";
                }else{
                    $diff = abs(strtotime($get_check_out) - strtotime($get_check_in));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                }
                $get_dates = $days." days";
            }

            if($get_adult == 0){
                $get_adult = 1;
            }

            if($get_child == 0){
                $get_child = 0;
            }

            $get_guest = $get_adult + $get_child;
        @endphp
        <div class="col-4 search-box" style="height: 50px;">
            <div class="row">
                <div class="col-12 text-center">
                    <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();" style="cursor: pointer;">
                        <p>{{ $get_loc }} | {{ $get_dates }} | {{ $get_guest }} guest<span class="top-search"><i class="fa fa-search"></i></p>
                    </div>

                    <div id="search_bar" class="searchbar-list-display-none">
                    <div id="change_display_block" class="display-none nav-menu-container">
                        <ul class="nav-link-container">
                            <li class="nav-link-gap">
                                @if($condition_villa)
                                    <a href="{{ route('list') }}" class="nav-link-style bg-orange">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('list') }}" class="nav-link-style">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">villas</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_restaurant)
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style bg-orange">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">restaurant</p>
                            </li>
                            <li class="nav-link-gap">
                                @if (Route::is('hotel_list'))
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style bg-orange">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">hotel</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_things_to_do)
                                    <a href="{{ route('search_activity') }}" class="nav-link-style bg-orange">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_activity') }}" class="nav-link-style">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">things to do</p>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <form action="{{ route('search_villa') }}" method="GET" id="basic-form" autocomplete="off">
                            <div class="bar">
                                <div class="location">
                                    <p>Location</p>
                                    <input type="text" class="form-control input-transparant" value="{{  $get_loc }}" id="loc_sugest"
                                        name="location"
                                        style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                        placeholder="Where are you going?">

                                    <div id="sugest" class="location-popup display-none">
                                        @php
                                        $location = App\Http\Controllers\ViewController::get_location();
                                        @endphp
                                        @foreach($location as $item)
                                        <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
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
                                        <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                            <p>location not found</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-in">
                                    <input type="text"
                                        style="position : absolute; z-index:1; width:367px; height: 60px; margin-left: -90px; margin-top: -8px"
                                        id="dates">
                                    <p>Check in</p>
                                    <input type="text" placeholder="Add dates" class="flatpickr form-control" value="{{ $get_check_in }}"
                                        id="check_in2" name="check_in"
                                        style="width: 100% !important; background-color: #ffffff00;">
                                </div>
                                <div class="check-out">
                                    <p>Check out</p>
                                    <input type="text" style="background-color: #ffffff00;" placeholder="Add dates"
                                        class="flatpickr form-control" value="{{ $get_check_out }}" id="check_out2" name="check_out"
                                        readonly>
                                </div>
                                <div class="guests">
                                    <p>Guests</p>
                                    <ul class="nav">
                                        <li class="button-dropdown">
                                            <input type="number" id="total_guest5" value="{{ $get_guest }}"
                                                style="width: 30px; border: 0; margin-right: 0; background: transparent; text-align: right;"
                                                disabled min="1"> Guest
                                            <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                                </a>
                                            <a class="dropdown-toggle-icon"
                                                style="margin-left: 20px;">
                                                Add
                                            </a>
                                            <div class="guest-popup dropdown-menu">
                                                <div class="guests-input-row">
                                                    <div class="col-6">
                                                        <div class="col-12 guest-type-container">
                                                            <p class="guest-type-title">Adults</p>
                                                        </div>
                                                        <div class="col-12" style="padding: 0px;">
                                                            <p class="guest-type-desc">Age 13 or above</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6"
                                                        style="display: flex; align-items: center; justify-content: end;">
                                                        <a type="button" onclick="adult_decrement_header_list()"
                                                            style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-minus guests-style"
                                                                style="padding:0px"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                            <input type="number" id="adult5" name="adult" value="{{ $get_adult }}"
                                                                style="text-align: center; margin-left: 7px; border:none; width:40px;"
                                                                min="1" readonly>
                                                        </div>
                                                        <a type="button" onclick="adult_increment_header_list()"
                                                            style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="guests-input-row">
                                                    <div class="col-6">
                                                        <div class="col-12 guest-type-container">
                                                            <p class="guest-type-title">Children</p>
                                                        </div>
                                                        <div class="col-12" style="padding: 0px;">
                                                            <p class="guest-type-desc">Ages 2–12</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6"
                                                        style="display: flex; align-items: center; justify-content: end;">
                                                        <a type="button" onclick="child_decrement_header_list()"
                                                            style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-minus guests-style"
                                                                style="padding:0px"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                            <input type="number" id="child5" name="child" value="{{ $get_child }}"
                                                                style="text-align: center; margin-left: 7px; border:none; width:40px;"
                                                                min="0" readonly>
                                                        </div>
                                                        <a type="button" onclick="child_increment_header_list()"
                                                            style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="guests-input-row">
                                                    <div class="col-6">
                                                        <div class="col-12 guest-type-container">
                                                            <p class="guest-type-title">Infants</p>
                                                        </div>
                                                        <div class="col-12" style="padding: 0px;">
                                                            <p class="guest-type-desc">Under 2</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6"
                                                        style="display: flex; align-items: center; justify-content: end;">
                                                        <a type="button" onclick="infant_decrement_header_list()"
                                                            style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-minus guests-style"
                                                                style="padding:0px"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                            <input type="number" id="infant5" name="infant" value="{{ $get_infant }}"
                                                                style="text-align: center; border:none; margin-left: 7px; width:40px;"
                                                                min="0" readonly>
                                                        </div>
                                                        <a type="button" onclick="infant_increment_header_list()"
                                                            style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-plus guests-style"
                                                                style="padding:0px"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="guests-input-row">
                                                    <div class="col-6">
                                                        <div class="col-12 guest-type-container">
                                                            <p class="guest-type-title">Pets</p>
                                                        </div>
                                                        <div class="col-12" style="padding: 0px;">
                                                            <p class="guest-type-desc">Service animal?</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6"
                                                        style="display: flex; align-items: center; justify-content: end;">
                                                        <a type="button" onclick="pet_decrement_header_list()"
                                                            style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa-solid fa-minus guests-style"
                                                                style="padding:0px"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                            <input type="number" id="pet5" name="pet" value="{{ $get_pet }}"
                                                                style="text-align: center; border:none; margin-left: 7px; width:40px;"
                                                                min="0" readonly>
                                                        </div>
                                                        <a type="button" onclick="pet_increment_header_list()"
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
                                    <button type="submit" style="z-index: 1; border: none; background: transparent;">
                                        <i class="fa fa-search cari"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($condition_restaurant)
        <div class="col-4 search-box" style="height: 50px;">
            <div class="row">
                <div class="col-12 text-center">
                    <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();" style="cursor: pointer;">
                        <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                    </div>
                    <div id="search_bar" class="searchbar-list-display-none">
                    <div id="change_display_block" class="display-none nav-menu-container">
                        <ul class="nav-link-container">
                            <li class="nav-link-gap">
                                @if($condition_villa)
                                    <a href="{{ route('list') }}" class="nav-link-style bg-orange">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('list') }}" class="nav-link-style">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">villas</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_restaurant)
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style bg-orange">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">restaurant</p>
                            </li>
                            <li class="nav-link-gap">
                                @if (Route::is('hotel_list'))
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style bg-orange">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">hotel</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_things_to_do)
                                    <a href="{{ route('search_activity') }}" class="nav-link-style bg-orange">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_activity') }}" class="nav-link-style">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">things to do</p>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <div class="bar">
                            <div class="location">
                                <p>Location</p>
                                <input type="text" class="form-control input-transparant" name="sLocation"
                                    value="{{ request()->get('sLocation') ?? '' }}" id="loc_sugest" name="location"
                                    style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                    placeholder="Where are you going?">

                                <div id="sugest" class="location-popup display-none">
                                    @php
                                    $location = App\Http\Controllers\ViewController::get_location();
                                    @endphp
                                    @foreach($location as $item)
                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
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
                                    <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                        <p>location not found</p>
                                    </div>
                                </div>
                            </div>
                            <div class="check-out" style="width: auto;">
                                <p></i>&nbsp; Type of food</p>
                                <input type="text" placeholder="Search here"
                                    value="{{ request()->get('sKeyword') ?? '' }}" id="keyword" name="sKeyword" style="background-color: #ffffff00; width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 0px; cursor: pointer;">

                            </div>
                            <div class="guests" style="width: auto;">
                                <p >What do you want to eat ?</p>
                                <ul class="nav">
                                    <li class="button-dropdown">
                                        <input type="number" id="total_guest5" value="1"
                                            style="width: 30px; border: 0; margin-right: 0; background: transparent; text-align: right;"
                                            disabled min="1"> Cuisine
                                        <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                        </a>
                                        <!--
                                        <a class="dropdown-toggle-icon" style="margin-left: 20px;">
                                            Add
                                        </a>
                                        -->
                                        <div class="cuisine-popup dropdown-menu">
                                            <div class="row">
                                                @forelse ($cuisines as $cuisine)
                                                @php
                                                $isChecked = '';
                                                $cuisinesIds = explode(',', request()->get('sCuisine'));
                                                if(in_array($cuisine->id_cuisine, $cuisinesIds)){
                                                $isChecked = 'checked';
                                                }
                                                @endphp

                                                <div class="col-6 mb-3" style="padding: 0px;">
                                                    <label class="checkdesign" style="height: 25px; display: flex; align-items: center;">&nbsp; {{ $cuisine->name }}
                                                        <input type="checkbox" id="vehicle2" name="sCuisine[]"
                                                            value="{{ $cuisine->id_cuisine }}"
                                                            {{ $isChecked }}>
                                                        <span class="checkmark" style="margin-left: 0px;"></span>

                                                </div>
                                                @empty
                                                No Data Found
                                            </div>
                                            @endforelse
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="button" style="padding-left: 0px;">
                                <button onclick="restaurantFilter()" style="z-index: 1; border: none; background: transparent;">
                                    <i class="fa fa-search cari"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($condition_things_to_do)
        <div class="col-4 search-box" style="height: 50px;">
            <div class="row">
                <div class="col-12 text-center">
                    <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();" style="cursor: pointer;">
                        <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                    </div>

                    <div id="search_bar" class="searchbar-list-display-none">
                    <div id="change_display_block" class="display-none nav-menu-container">
                        <ul class="nav-link-container">
                            <li class="nav-link-gap">
                                @if($condition_villa)
                                    <a href="{{ route('list') }}" class="nav-link-style bg-orange">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('list') }}" class="nav-link-style">
                                        <div class="nav-link-icon-container"
                                        id="villa-button"><i class="fa-solid fa-house nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">villas</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_restaurant)
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style bg-orange">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_restaurant') }}" class="nav-link-style">
                                        <div id="restaurant-button" class="nav-link-icon-container"><i class="fa-solid fa-utensils nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">restaurant</p>
                            </li>
                            <li class="nav-link-gap">
                                @if (Route::is('hotel_list'))
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style bg-orange">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('hotel_list') }}" class="nav-link-style">
                                        <div id="hotel-button" class="nav-link-icon-container"><i class="fa-solid fa-city nav-link-icon-style"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">hotel</p>
                            </li>
                            <li class="nav-link-gap">
                                @if($condition_things_to_do)
                                    <a href="{{ route('search_activity') }}" class="nav-link-style bg-orange">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @else
                                    <a href="{{ route('search_activity') }}" class="nav-link-style">
                                        <div id="activity-button" class="nav-link-icon-container"><i style="font-size: 24px;" class="fa-solid fa-person-running"></i></div>
                                    </a>
                                @endif
                                <p style="margin: 7px 0px 0px 0px; color: white;">things to do</p>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <div class="bar">
                            <div class="location">
                                <p>Location</p>
                                <input type="text" class="form-control input-transparant" name="sLocation"
                                    value="{{ request()->get('sLocation') }}" id="loc_sugest"
                                    style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                    placeholder="Where are you going?">

                                <div id="sugest" class="location-popup display-none">
                                    @php
                                    $location = App\Http\Controllers\ViewController::get_location();
                                    @endphp
                                    @foreach($location as $item)
                                    <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
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
                                    <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                        <p>location not found</p>
                                    </div>
                                </div>
                            </div>
                            <div class="check-out">
                                <p><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Search</p>
                                <input type="text" style="background-color: #ffffff00;" placeholder="Search here"
                                    value="{{ request()->get('sKeyword') ?? '' }}" id="keyword" name="sKeyword">
                            </div>
                            <div class="guests">
                                <p>Date</p>
                                <input type="text" placeholder="Add dates" class="flatpickr form-control" value=""
                                    id="check_in_things_to_do" name="check_in"
                                    style="width: 100% !important; background-color: #ffffff00;">
                            </div>

                            <div class="button">
                                <button onclick="activityFilter()"
                                    style="z-index: 1; border: none; background: transparent;">
                                    <i class="fa fa-search cari"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-4 list-villa-user right-bar" style="padding: 0px;">
            @if (!$condition_restaurant && !$condition_things_to_do)
                @guest
                <a href="{{ route('ahost') }}" class="navbar-gap" style="color: #b9b9b9; margin-right: 9px; font-size: 15px;">
                    Become a host
                </a>
                @endguest

                @auth
                <a href="{{ route('partner_dashboard') }}" class="navbar-gap" style="color: #b9b9b9; margin-right: 9px; font-size: 15px;">
                    Switch to Hosting
                </a>
                @endauth
            @endif

            <a type="button" onclick="language()" class="navbar-gap" style="color: white; margin-right: 9px; width:27px;">
                @if (session()->has('locale'))
                    <img src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                @else
                    <img src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                @endif
            </a>

            @auth
            <div style="display: table; margin-right: 0px; float: right;">
                <!--<h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>-->
            </div>
            <div class="logged-user-menu" style="">
                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->avatar)
                    <img src="{{Auth::user()->avatar}}" class="logged-user-photo" alt="">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}" class="logged-user-photo"
                        alt="">
                    @endif

                    <!--
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="margin-right: 0px; left: auto;">
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||
                        Auth::user()->role_id == 3)
                        <li>
                            <a href="{{route('admin_dashboard')}}" class="dropdown-item">Dashboard</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('profile_index')}}" class="dropdown-item">My Profile</a>
                        </li>
                        <li>
                            <a href="{{route('profile_index')}}" class="dropdown-item">Change Password</a>
                        </li>
                        <li>
                            <a href="#!" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                Out</a>
                            <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
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
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                        @endif
                        {{-- @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}"
                        class="dropdown-user-img" alt="Pict">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
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
            @else
            @if (Route::current()->uri() == 'villa/{id}')
            <input type="button" onclick="location.href='{{ route('register.partner') }}';" value="Become a Host" />
            @endif

            <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap"
                style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: inline-block; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-user"></i>
            </a>

            @endauth
        </div>

        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
                $("#loc_sugest").on('click', function () { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        var rndInt = Math.floor(Math.random() * (ids.length-1));
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
                        var name = $(".sugest-list").eq(data).children(".sugest-list-text").children('a').text();
                        if(name.toLowerCase().includes(formValue.toLowerCase())) {
                            $(".sugest-list").eq(data).show();
                            isEmpty = false;
                        }
                    });

                    if(isEmpty) {
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
            function adult_increment_header_list() {
                document.getElementById('adult5').stepUp();
                document.getElementById('total_guest5').stepUp();
            }

            function adult_decrement_header_list() {
                document.getElementById('adult5').stepDown();
                document.getElementById('total_guest5').stepDown();
            }

            function child_increment_header_list() {
                document.getElementById('child5').stepUp();
                document.getElementById('total_guest5').stepUp();
            }

            function child_decrement_header_list() {
                document.getElementById('child5').stepDown();
                document.getElementById('total_guest5').stepDown();
            }

            function infant_increment_header_list() {
                document.getElementById('infant5').stepUp();
            }

            function infant_decrement_header_list() {
                document.getElementById('infant5').stepDown();
            }

            function pet_increment_header_list() {
                document.getElementById('pet5').stepUp();
            }

            function pet_decrement_header_list() {
                document.getElementById('pet5').stepDown();
            }

        </script>

        <script>
            function popUp() {
                document.getElementById("myBtnContainer").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("searchbox-display-block");
                document.getElementById("searchbox").classList.add("searchbox-display-none");
                document.getElementById("change_display_block").classList.remove("display-none");
                document.getElementById("change_display_block").classList.add("display-block");
                document.getElementById("new-bar-black").classList.add("header-popup-list");
                document.getElementById("new-bar-black").classList.add("search-height");
                document.getElementById("search_bar").classList.add("searchbar-list-display-block");
                document.getElementById("search_bar").classList.remove("searchbar-list-display-none");

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
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(
                                    ' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var elss = document.getElementsByClassName("flatpickr-calendar");
                removeClass(elss, 'display-none');
            }

        </script>

        <script>
            window.onscroll = function () {
                whenScroll()
            };

            function whenScroll() {
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

                document.getElementById("myBtnContainer").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("searchbox-display-block");
                document.getElementById("searchbox").classList.remove("searchbox-display-none");
                document.getElementById("search_bar").classList.remove("active");
                document.getElementById("change_display_block").classList.add("display-none");
                document.getElementById("change_display_block").classList.remove("display-block");
                document.getElementById("new-bar-black").classList.remove("header-popup-list");
                document.getElementById("new-bar-black").classList.remove("search-height");
                document.getElementById("search_bar").classList.remove("searchbar-list-display-block");
                document.getElementById("search_bar").classList.add("searchbar-list-display-none");

                var els = document.getElementsByClassName("flatpickr-calendar");
                addClass(els, 'display-none');
            }

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
            function language() {
                $('#LegalModal').modal('show');
            }

        </script>
