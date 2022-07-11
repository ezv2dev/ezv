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

    </style>

    @php
        $villa_condition = Route::is('villa');
        $restaurant_condition = Route::is('restaurant');
        $hotel_condition = Route::is('hotel');
        $activity_condition = Route::is('activity');
    @endphp

    <div class="row">
        <div class="col-4 logo villa-list-header-logo" style="display: table;">
            <a href="{{ route('index') }}"><img style="width: 90px; margin-top: 15px;"
                    src="{{ asset('assets/logo_black.png') }}" alt="oke"></a>
        </div>

        <div class="col-4 search-box">
            <div id="row_popup" class="row">
                <div class="col-12 text-center">
                    <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp()"
                        style="cursor: pointer;">
                        <p>Search here... <span class="top-search"><i class="fa fa-search"></i></p>
                    </div>

                    <div id="search_bar" class="searchbar-display-none">
                        <div id="change_display_block" class="display-none nav-menu-container">

                            <ul class="nav-link-container">

                                <form action="{{ route('list') }}" method="POST" id="villa-form"
                                    class="nav-link-form-detail">
                                    @csrf
                                    @if (Route::is('list'))
                                        <i id="villa-button"
                                            class="fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @else
                                        <i id="villa-button"
                                            class="fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @endif

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
                                    <p>villas</p>
                                </form>


                                <form action="{{ route('restaurant_list') }}" method="POST" id="restaurant-form"
                                    class="nav-link-form-detail">
                                    @csrf
                                    @if (Route::is('restaurant_list'))
                                        <i id="restaurant-button"
                                            class="fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @else
                                        <i id="restaurant-button"
                                            class="fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @endif
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
                                    <input type="hidden" name="children" id="children"
                                        value="{{ $req['children'] }}">
                                    <p>restaurant</p>
                                </form>


                                <form action="{{ route('hotel_list') }}" method="POST" id="hotel-form"
                                    class="nav-link-form-detail">
                                    @csrf

                                    @if (Route::is('hotel_list'))
                                        <i id="hotel-button"
                                            class="fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @else
                                        <i id="hotel-button"
                                            class="fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @endif
                                    <?php
                                    $req['location'] = null;
                                    $req['check_in'] = null;
                                    $req['check_out'] = null;
                                    $req['adult'] = null;
                                    $req['children'] = null;
                                    ?>
                                    <input type="hidden" name="location" id="location"
                                        value="{{ $req['location'] }}">
                                    <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                                    <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                                    <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                                    <input type="hidden" name="children" id="children"
                                        value="{{ $req['children'] }}">
                                    <p>hotel</p>
                                </form>


                                <form action="{{ route('activity_list') }}" method="POST" id="activity-form"
                                    class="nav-link-form-detail">
                                    @csrf
                                    @if (Route::is('activity_list'))
                                        <i id="activity-button" style="font-size: 24px;"
                                            class="fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @else
                                        <i id="activity-button" style="font-size: 24px;"
                                            class="fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i>
                                    @endif
                                    </li>
                                    <?php
                                    $req['location'] = null;
                                    $req['check_in'] = null;
                                    $req['check_out'] = null;
                                    $req['adult'] = null;
                                    $req['children'] = null;
                                    ?>
                                    <input type="hidden" name="location" id="location"
                                        value="{{ $req['location'] }}">
                                    <input type="hidden" name="check_in" id="in" value="{{ $req['check_in'] }}">
                                    <input type="hidden" name="check_out" id="out" value="{{ $req['check_out'] }}">
                                    <input type="hidden" name="adult" id="adult" value="{{ $req['adult'] }}">
                                    <input type="hidden" name="children" id="children"
                                        value="{{ $req['children'] }}">
                                    <p>things to do</p>
                                </form>
                            </ul>


                        </div>
                        <div>
                            <form action="{{ route('search_villa') }}" method="GET" id="basic-form" autocomplete="off">
                                <div class="bar">
                                    <div class="location">
                                        <p>Location</p>
                                        <input type="text" class="form-control input-transparant" value="" id="loc_sugest"
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
                                        <input type="text" placeholder="Add dates" class="flatpickr form-control" value=""
                                            id="check_in2" name="check_in"
                                            style="width: 100% !important; background-color: #ffffff00;">
                                    </div>
                                    <div class="check-out">
                                        <p>Check out</p>
                                        <input type="text" style="background-color: #ffffff00;" placeholder="Add dates"
                                            class="flatpickr form-control" value="" id="check_out2" name="check_out"
                                            readonly>
                                    </div>
                                    <div class="guests">
                                        <p>Guests</p>
                                        <ul class="nav">
                                            <li class="button-dropdown">
                                                <input type="number" id="total_guest5" value="1"
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
                                                                <input type="number" id="adult5" name="adult" value="1"
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
                                                                <input type="number" id="child5" name="child" value="0"
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
                                                                <input type="number" id="infant5" name="infant" value="0"
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
                                                                <input type="number" id="pet5" name="pet" value="0"
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

        <div class="col-4 list-villa-user right-bar">
            @if (Route::is('list') || Route::is('index'))
                <!--
            <form action="{{ route('list') }}" method="POST" id="villa-form">
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
                <a id="restaurant-button"><i class="fa-solid fa-utensils" data-bs-toggle="popover"
                        data-bs-animation="true" data-bs-placement="bottom" title="Restaurant"></i></a>
            </form>
            <form action="{{ route('activity_list') }}" method="POST" id="activity-form">
                <a id="activity-button"><i class="fa-solid fa-person-walking" data-bs-toggle="popover"
                        data-bs-animation="true" data-bs-placement="bottom" title="Activity"></i></a>
            </form>
            -->
            @endif

            @auth
                <div style="display: table; margin-right: 0px; float: right;">
                    <h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                </div>
                <div class="logged-user-menu" style="">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="logged-user-photo" alt="">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                class="logged-user-photo" alt="">
                        @endif
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
                                <a href="#" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                    Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post"
                                    style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @else
                @if (Route::current()->uri() == 'villa/{id}' || Route::is('privacy_policy') || Route::is('terms') || Route::is('license'))
                    <input type="button" style="top: 0px !important;"
                        onclick="location.href='{{ route('register.partner') }}';" value="Become a Host" />
                @endif

                <a href="" class="navbar-gap" style="color: white; margin-right: 9px; width:27px;">
                    <img
                        src="https://raw.githubusercontent.com/lipis/flag-icons/c1efa9d9a94d62a4da54916f4061cbf9bbadff1d/flags/4x3/us.svg">
                </a>

                <a href="{{ route('login') }}" class="btn btn-fill border-0 navbar-gap"
                    style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: flex; align-items: center; justify-content: center; ">
                    <i class="fa-solid fa-user"></i>
                </a>

            @endauth
        </div>

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
