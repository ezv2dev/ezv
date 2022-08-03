<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title id="villaTitle">{{ $villa[0]->name }} - EZV2</title>
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

    {{-- DROPZONE --}}
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/simpleLightbox.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
    <script type="text/javascript">
        Xendit.setPublishableKey('xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F');
    </script>

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/iziToast/iziToast.min.css') }}">
    <script src="{{ asset('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>
</head>

<body style="background-color:white">

    <div class="overlay" style="display: none;"></div>
    <div id="three-ds-container" style="display: none;">
        <iframe height="450" width="550" id="sample-inline-frame" name="sample-inline-frame"> </iframe>
    </div>

    @php
        $condition_villa = Route::is('villa');
        $condition_restaurant = Route::is('restaurant');
        $condition_hotel = Route::is('hotel') || Route::is('room_hotel');
        $condition_things_to_do = Route::is('activity') || Route::is('activity_price_index');
    @endphp

    @include('components.loading.loading-type1')
    <input type="hidden" id="min_stay" name="min_stay" value="{{ $villa[0]->min_stay }}">
    <input type="hidden" id="price" name="price" value="{{ $villa[0]->price }}">
    <input type="hidden" id="price3" name="price" value="{{ $villa[0]->price }}">
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
            <div class="d-flex justify-content-between" style="align-items: center;">
                <div class="button-view-detail">
                    <input type="hidden" id="instant_book_check" value="{{ $villa[0]->instant_book }}">
                    @if (isset($_COOKIE['sCheck_in']) == null && isset($_COOKIE['sCheck_out']) == null)
                    <input class="price-button" onclick="addDatesFunction()"
                        style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                        value="{{ __('user_page.Check Availability') }}" readonly>
                    @else
                        @if ($villa[0]->instant_book == 'yes')
                            <input class="price-button" onclick="details_reserve()"
                                style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                value="{{ __('user_page.VIEW DETAILS') }}" readonly>
                        @else
                            @guest
                                <input class="price-button" onclick="loginForm(2)"
                                    style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                    value="{{ __('user_page.QUICK ENQUIRY') }}" readonly>
                            @endguest

                            @auth
                                <input class="price-button" onclick="details_quick_enquiry()"
                                    style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                    value="{{ __('user_page.QUICK ENQUIRY') }}" readonly>
                            @endauth
                        @endif
                    @endIf
                </div>

                <div class="d-flex" style="flex-direction: column;">
                    <span class="price m-0"
                        id="priceBottom"><strong>{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</strong>/{{ __('user_page.night') }}
                    </span>
                    <span style="font-size: 14px; font-weight: 700;" class="price text-end m-0 d-none"
                        id="priceBottomFilled"></span>
                    <span style="font-size: 13px;" class="price m-0 d-none" id="dateSelected"></span>
                </div>
            </div>
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
                            <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap d-flex align-items-center"
                                style="margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
                                <i class="fa-solid fa-user"></i>
                                <p class="mb-0 ms-2" style="color:#585656">{{ __('user_page.Login') }}</p>
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
                    <div class="d-flex align-items-center">
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
                            @if ($villa[0]->image)
                                <img id="imageProfileVilla" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $villa[0]->image) }}">
                            @else
                                <img id="imageProfileVilla" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}">
                            @endif

                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_villa_profile()"
                                        class="edit-profile-image-btn-dekstop"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Image Profile') }}</a>
                                @endif
                            @endauth
                            <div class="property-type">
                                <p id="property-type-content">
                                    Tags :
                                    @auth
                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editCategoryVilla()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </p>
                                <div id="displayCategory">
                                    @foreach ($villaHasCategory->take(3) as $item)
                                        <span class="badge rounded-pill fw-normal translate-text-group-items"
                                            style="background-color: #FF7400;">
                                            {{ $item->villaCategory->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div id="moreCategory" class="">
                                    @if ($villaHasCategory->count() > 3)
                                        <button class="btn btn-outline-dark btn-sm rounded villa-tag-button"
                                            onclick="view_subcategory()">{{ __('user_page.More') }}</button>
                                    @endif
                                </div>
                            </div>
                            {{-- SHORT NAME FOR MOBILE --}}
                            <div class="name-content-mobile ms-3 d-md-none">
                                <h2 id="name-content-mobile">{{ $villa[0]->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12 profile-info">
                        {{-- SHORT NAME --}}
                        <h2 id="name-content">
                            <span id="name-content2">{{ $villa[0]->name }}</span>
                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Name') }}</a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <textarea class="form-control" style="width: 100%;" name="name" id="name-form-input" cols="30"
                                        rows="3" maxlength="55" placeholder="{{ __('user_page.Home Name Here') }}" required>{{ $villa[0]->name }}</textarea>
                                    <small id="err-name" style="display: none;"
                                        class="invalid-feedback">{{ __('auth.empty_name') }}</small><br>
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSaveName"
                                        style="background-color: #ff7400" onclick="editNameVilla()">
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
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="edit_villa_profile()"
                                    class="edit-profile-image-btn-mobile d-md-none"
                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Image Profile') }}
                                    |</a>
                                &nbsp;
                                <a type="button" onclick="editNameForm()" class="edit-profile-name-btn-mobile d-md-none"
                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Name') }}</a>
                                {{-- @if ($villa[0]->image)
                                    <a class="delete-profile" href="javascript:void(0);"
                                        onclick="delete_profile_image({'id': '{{ $villa[0]->id_villa }}'})">
                                        <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                            data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom"
                                            title="{{ __('user_page.Delete') }}"></i></a>
                                @endif --}}
                            @endif
                        @endauth
                        {{-- END EDIT PROFILE IMAGE AND NAME CONTENT MOBILE --}}

                        {{-- TYPE AND DISTANCE FOR MOBILE --}}
                        <div id="type-distance-mobile" class="d-md-none">
                            <div>
                                <p id="property-type-content">
                                    @auth
                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editCategoryVilla()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">Edit
                                                property</a>
                                        @endif
                                    @endauth
                                </p>
                                @foreach ($villaHasCategory->take(3) as $item)
                                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                                        style="background-color: #FF7400; margin-right: 5px;">
                                        {{ $item->villaCategory->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        {{-- END TYPE AND DISTANCE FOR MOBILE --}}
                        @php
                            $bedCount = 0;
                            for ($i = 0; $i < $villa[0]->villaBedroomDetail->count(); $i++) {
                                $bedCount = $bedCount + $villa[0]->villaBedroomDetail[$i]->bed_count;
                            }
                            $guestCount = $villa[0]->adult + $villa[0]->children;
                        @endphp
                        <p style="font-size: 13px"><span id="bedroomID">{{ $villa[0]->bedroom }}</span>
                            {{ __('user_page.Bedrooms') }}
                            | <span id="bedsID">{{ $bedCount }}</span> Beds | <span
                                id="bathroomID">{{ $villa[0]->bathroom }}</span>
                            {{ __('user_page.Bathroom') }} |
                            <span id="guestID">{{ $guestCount }}</span> {{ __('user_page.Guests') }}
                            {{-- | <span id="childrenID">{{ $villa[0]->children }}</span> {{ __('user_page.Children') }} --}}
                            @if ($villa[0]->size != null || $villa[0]->size > 0)
                                | <span id="sizeID">{{ $villa[0]->size }}</span> m<sup>2</sup>
                            @endif
                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_bedroom()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                @endif
                            @endauth
                        </p>

                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">
                            <span class="translate-text-single" id="short-description-content2">
                                {{ Translate::translate($villa[0]->short_description) ?? __('user_page.There is no description yet') }}
                                {{-- {{ $villa[0]->short_description ?? __('user_page.There is no description yet') }} --}}</span>
                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Description') }}</a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                        cols="30" rows="3" maxlength="255"
                                        placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $villa[0]->short_description }}</textarea>
                                    <small id="err-shrt-desc" style="display: none;"
                                        class="invalid-feedback">{{ __('auth.empty_short_desc') }}</small><br>
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSaveShortDesc"
                                        onclick="editShortDesc()">
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
                        <ul class="stories inner-wrap">
                            @if (Auth::guest() || Auth::user()->role_id == 4)
                                @if ($stories->count() == 0 && $video->count() == 0)
                                    <li class="story">
                                        <div class="img-wrap">
                                            <a type="button"
                                                onclick="requestVideo({'id': '{{ $villa[0]->created_by }}', 'name': '{{ $villa[0]->name }}'})">
                                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="{{ URL::asset('assets/2.png') }}">
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by ||
                                    Auth::user()->role_id == 1 ||
                                    Auth::user()->role_id == 2 ||
                                    Auth::user()->role_id == 3)
                                    @if ($stories->count() == 0)
                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                                            data-src="{{ URL::asset('assets/add_story.png') }}">
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($video->count() < 100)
                                            <div class="containerSlider4">
                                                <div id="slide-left-container4">
                                                    <div class="slide-left4">
                                                    </div>
                                                </div>
                                                <div id="cards-container4">
                                                    <div class="cards4" id="storyContent">
                                                        @foreach ($video as $item)
                                                            <div class="card4 col-lg-3 radius-5"
                                                                id="displayStoryVideo{{ $item->id_video }}">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $villa[0]->created_by)
                                                                            <a type="button"
                                                                                onclick="view({{ $item->id_video }})">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player"><i
                                                                                class="fa fa-play"></i>
                                                                        </div>
                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid" loading="lazy"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                data-id="{{ $villa[0]->id_villa }}"
                                                                                data-video="{{ $item->id_video }}"
                                                                                onclick="delete_photo_video(this)">
                                                                                <i class="fa fa-trash"
                                                                                    style="color:red; margin-left: 25px;"
                                                                                    data-bs-toggle="popover"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{ __('user_page.Delete') }}"></i>
                                                                            </a>
                                                                        @endif
                                                                        </a>
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
                                        @endIf
                                    @else
                                        @if ($stories->count() < 100)
                                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <li class="story">
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
                                                        @foreach ($stories as $item)
                                                            <div class="card4 col-lg-3 radius-5"
                                                                id="displayStory{{ $item->id_story }}">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $villa[0]->created_by)
                                                                            <a type="button"
                                                                                onclick="view_story({{ $item->id_story }})">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player"><i
                                                                                class="fa fa-play"></i>
                                                                        </div>
                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid" loading="lazy"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                data-villa="{{ $villa[0]->id_villa }}"
                                                                                data-story="{{ $item->id_story }}"
                                                                                onclick="delete_story(this)">
                                                                                <i class="fa fa-trash"
                                                                                    style="color:red; margin-left: 25px;"
                                                                                    data-bs-toggle="popover"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{ __('user_page.Delete') }}"></i>
                                                                            </a>
                                                                        @endif
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @if ($video->count() < 100)
                                                            @foreach ($video as $item)
                                                                <div class="card4 col-lg-3 radius-5"
                                                                    id="displayStoryVideo{{ $item->id_video }}">
                                                                    <div class="img-wrap">
                                                                        <div class="video-position">
                                                                            @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $villa[0]->created_by)
                                                                                <a type="button"
                                                                                    onclick="view({{ $item->id_video }})">
                                                                                @else
                                                                                    <a type="button"
                                                                                        onclick="showPromotionMobile()">
                                                                            @endif
                                                                            <div class="story-video-player"><i
                                                                                    class="fa fa-play"></i>
                                                                            </div>
                                                                            <video href="javascript:void(0)"
                                                                                class="story-video-grid" loading="lazy"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    data-id="{{ $villa[0]->id_villa }}"
                                                                                    data-video="{{ $item->id_video }}"
                                                                                    onclick="delete_photo_video(this)">
                                                                                    <i class="fa fa-trash"
                                                                                        style="color:red; margin-left: 25px;"
                                                                                        data-bs-toggle="popover"
                                                                                        data-bs-animation="true"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ __('user_page.Delete') }}"></i>
                                                                                </a>
                                                                            @endif
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
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
                                            @foreach ($stories as $item)
                                                <div class="card3 col-lg-3 radius-5">
                                                    <div class="img-wrap" style="width: 70px; height: 70px;">
                                                        <div class="video-position"
                                                            style="width: 70px; height: 70px;">
                                                            @auth
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $villa[0]->created_by)
                                                                    <a type="button"
                                                                        onclick="view_story({{ $item->id_story }})"
                                                                        style="height: 70px; width: 70px;">
                                                                    @else
                                                                        <a type="button" onclick="showPromotionMobile()"
                                                                            style="height: 70px; width: 70px;">
                                                                @endif
                                                            @endauth
                                                            @guest
                                                                <a type="button" onclick="showPromotionMobile()"
                                                                    style="height: 70px; width: 70px;">
                                                                @endguest

                                                                <div class="story-video-player"><i
                                                                        class="fa fa-play"></i>
                                                                </div>
                                                                <video href="javascript:void(0)"
                                                                    class="story-video-grid" loading="lazy"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
                                                                </video>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($video as $item)
                                                <div class="card3 col-lg-3 radius-5">
                                                    <div class="img-wrap" style="width: 70px; height: 70px;">
                                                        <div class="video-position"
                                                            style="width: 70px; height: 70px;">
                                                            @auth
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $villa[0]->created_by)
                                                                    <a type="button"
                                                                        onclick="view({{ $item->id_video }})"
                                                                        style="height: 70px; width: 70px;">
                                                                    @else
                                                                        <a type="button" onclick="showPromotionMobile()"
                                                                            style="height: 70px; width: 70px;">
                                                                @endif
                                                            @endauth
                                                            <div class="story-video-player"><i class="fa fa-play"></i>
                                                            </div>
                                                            <video href="javascript:void(0)" class="story-video-grid"
                                                                loading="lazy" style="object-fit: cover;"
                                                                src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
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
                        <li class="navigationItem">
                            <a id="gallery-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('gallery').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.GALLERY') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.ABOUT') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.AVAILABILITY') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.AMENITIES') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.LOCATION') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.REVIEW') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem d-flex d-md-none">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('first-detail-content').scrollIntoView();">
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
                            @if ($photo->count() > 0)
                                @foreach ($photo->sortBy('order') as $item)
                                    <div class="col-4 grid-photo" id="displayPhoto{{ $item->id_photo }}">
                                        <a
                                            href="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}">
                                            <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}"
                                                title="{{ $item->caption }}">
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-icon">
                                                    {{-- <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Add Photo Caption') }}"
                                                        onclick="view_add_caption({'id': '{{ $villa[0]->id_villa }}', 'id_photo': '{{ $item->id_photo }}', 'caption': '{{ $item->caption }}'})"><i
                                                            class="fa fa-pencil"></i></button> --}}
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Photo Position') }}"
                                                        onclick="position_photo()"><i class="fa fa-arrows"></i></button>
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete Photo') }}"
                                                        href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}"
                                                        data-photo="{{ $item->id_photo }}"
                                                        onclick="delete_photo_photo(this)"><i
                                                            class="fa fa-trash"></i></button>
                                                </span>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            @endif
                            @if ($video->count() > 0)
                                @foreach ($video as $item)
                                    <div class="col-4 grid-photo" id="displayVideo{{ $item->id_video }}">
                                        @auth
                                            @if (auth()->check() && in_array(Auth::user()->role_id, [1, 2, 3]))
                                                <a class="pointer-normal" onclick="view({{ $item->id_video }})"
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
                                                src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=5.0">
                                            </video>
                                            <span class="video-grid-button"><i class="fa fa-play"></i></span>
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-video-icon">
                                                    <button type="button" onclick="position_video()"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Video Position') }}"><i
                                                            class="fa fa-arrows"></i></button>
                                                    <button href="javascript:void(0);"
                                                        data-id="{{ $villa[0]->id_villa }}"
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
                            @if ($photo->count() <= 0 && $video->count() <= 0)
                                {{ __('user_page.there is no gallery yet') }}
                            @endif
                        </div>
                    </section>
                    {{-- END GALLERY --}}

                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section class="add-gallery">
                                <form class="dropzone dz-image-add" id="frmTarget">
                                    @csrf
                                    <div class="dz-message" data-dz-message>
                                        <span>{{ __('user_page.Click here to upload your files') }}</span>
                                    </div>
                                    <input type="hidden" value="{{ $villa[0]->id_villa }}" id="id_villa"
                                        name="id_villa">
                                </form>
                                <small id="err-dz" style="display: none;"
                                    class="invalid-feedback">{{ __('auth.empty_file') }}</small><br>
                                <button type="submit" id="button"
                                    class="btn btn-primary">{{ __('user_page.Upload') }}</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}

                    <section id="description" class="section-2 px-xs-12p px-sm-24p">
                        {{-- Description --}}
                        <div class="about-place">
                            <hr class="hr-about">
                            <h2>
                                {{ __('user_page.Description') }}
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editDescriptionForm()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit About') }}</a>
                                    @endif
                                @endauth
                            </h2>
                            {{-- <div class="d-flex justify-content-left">
                                <div id="displayTags">
                                    @forelse ($villaTags->take(5) as $item)
                                        <span class="badge rounded-pill fw-normal translate-text-group-items"
                                            style="background-color: #FF7400;">{{ $item->villaFilter->name }}</span>
                                    @empty
                                        <p class="text-secondary">{{ __('user_page.there is no tag yet') }}</p>
                                    @endforelse
                                </div>
                                <div id="moreTags">
                                    @if ($villaTags->count() > 5)
                                        <button class="btn btn-outline-dark btn-sm rounded villa-tag-button ml-1"
                                            onclick="view_tags_villa()">{{ __('user_page.More') }}</button>
                                    @endif
                                </div>
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="displayTags()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Tags') }}</a>
                                    @endif
                                @endauth
                            </div> --}}
                            @php
                                $isMobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4));
                            @endphp
                            <p id="description-content">
                                @if ($isMobile)
                                {!! Str::limit(Translate::translate($villa[0]->description), 400, ' ...') ??
                                __('user_page.There is no description yet') !!}
                                @else
                                {!! Str::limit(Translate::translate($villa[0]->description), 600, ' ...') ??
                                    __('user_page.There is no description yet') !!}
                                @endif
                            </p>
                            <span id="buttonShowMoreDescription">
                                @if ($isMobile)
                                    @if (Str::length($villa[0]->description) > 400)
                                        <a id="btnShowMoreDescription" style="font-weight: 600;"
                                            href="javascript:void(0);" onclick="showMoreDescription();"><span
                                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                            <span style="color: #ff7400;">></span></a>
                                    @endIf
                                @else
                                    @if (Str::length($villa[0]->description) > 600)
                                        <a id="btnShowMoreDescription" style="font-weight: 600;"
                                            href="javascript:void(0);" onclick="showMoreDescription();"><span
                                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                            <span style="color: #ff7400;">></span></a>
                                    @endIf
                                @endIf
                            </span>

                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <div class="form-group">
                                            <textarea class="form-control" name="description" id="description-form-input" class="w-100" rows="5"
                                                placeholder="{{ __('user_page.Make your short description here') }}">{{ str_replace('<br>', '&#13;&#10;', $villa[0]->description) }}</textarea>
                                            <small id="err-desc" style="display: none;"
                                                class="invalid-feedback">{{ __('auth.empty_desc') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary" id="btnSaveDesc"
                                                onclick="editDescriptionVilla({{ $villa[0]->id_villa }})">
                                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary"
                                                onclick="editDescriptionCancel()">
                                                <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </section>

                    {{-- <section id="bedroom" class="section-2">
                        <hr>
                        <div class="pd-tlr-10">
                            <h2 class="mb-0">Where you'll sleep</h2>
                            <div class="Container1">
                                <div class="Head">
                                    <span class="Arrows d-flex justify-content-end mb-3"></span>
                                </div>
                                <div class="SlickCarouselBedroom">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <div>
                                            <div class="bedroom-card mx-2">
                                                <div class="card-body mx-auto text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="30px"
                                                        viewBox="0 0 40 28" style="fill: #222222;">
                                                        <g id="Group_2" data-name="Group 2"
                                                            transform="translate(-66 524)">
                                                            <path id="bed_FILL1_wght400_GRAD0_opsz48"
                                                                d="M4,38V25.25a5.612,5.612,0,0,1,.5-2.35A4.368,4.368,0,0,1,6,21.1V15.3A5.209,5.209,0,0,1,11.3,10h9a4.336,4.336,0,0,1,2.05.5A5.348,5.348,0,0,1,24,11.85a5.454,5.454,0,0,1,1.625-1.35A4.19,4.19,0,0,1,27.65,10h9a5.211,5.211,0,0,1,3.8,1.525A5.085,5.085,0,0,1,42,15.3v5.8a4.368,4.368,0,0,1,1.5,1.8,5.612,5.612,0,0,1,.5,2.35V38H41V34H7v4ZM25.5,20.25H39V15.3a2.192,2.192,0,0,0-.675-1.65A2.32,2.32,0,0,0,36.65,13H27.5a1.775,1.775,0,0,0-1.425.7,2.45,2.45,0,0,0-.575,1.6ZM9,20.25H22.5V15.3a2.45,2.45,0,0,0-.575-1.6A1.775,1.775,0,0,0,20.5,13H11.3A2.3,2.3,0,0,0,9,15.3Z"
                                                                transform="translate(62 -534)" />
                                                        </g>
                                                    </svg>
                                                    <h5 class="my-3">Bedroom {{ $i }}</h5>
                                                    <p class="mb-0">1 king bed</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </section> --}}

                    <section id="availability" class="section-2 px-xs-12p px-sm-24p">
                        <div id="scrollStop"></div>
                        <div class="pd-tlr-10">
                            <hr>
                            <h2>
                                {{ __('user_page.Availability') }}
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="edit_availability();" href="javascript:void(0);"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Availability') }}</a>
                                    @endif
                                @endauth
                            </h2>
                            <div class="desk-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div id="heightCalendar"
                                        style="display: table; background-color: white; padding: 70px 50px 50px 50px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4; margin-bottom: 25px;">
                                        <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                            class="col-lg-12">
                                            <a type="button" id="clear1" style="margin: 0px; font-size: 13px;"
                                                class="py-2 py-md-0">{{ __('user_page.Clear Dates') }}</a>
                                        </div>

                                        <div class="flatpickr" id="inline" style="text-align: left;">
                                            {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>

                    <section id="amenities" class="section-2 div-amenities px-xs-12p px-sm-24p">
                        <div class="row-grid-amenities">
                            <hr>
                            <div>
                                <h2>
                                    {{ __('user_page.Amenities') }}
                                    @auth
                                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;
                                            <a type="button" onclick="edit_amenities()"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Amenities') }}
                                            </a>
                                        @endif
                                    @endauth
                                </h2>
                            </div>

                        </div>
                        <div class="row-grid-amenities" id="row-amenities">
                            <div class="row-grid-list-amenities translate-text-group" id="listAmenities">
                                @if (!empty($villa_amenities->count()))
                                    @if ($villa_amenities->count() > 6)
                                        @foreach ($villa_amenities->take(6) as $item1)
                                            <div class="list-amenities ">
                                                <div class="text-align-center">
                                                    <i class="f-40 fa fa-{{ $item1->icon }}"></i>
                                                    <div class="mb-0 max-line">
                                                        <span
                                                            class="translate-text-group-items">{{ $item1->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="mb-0 list-more">
                                                    <span
                                                        class="translate-text-group-items">{{ $item1->name }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="list-amenities">
                                            <button class="amenities-button" type="button"
                                                onclick="view_amenities()">
                                                <i class="fa-solid fa-ellipsis text-orange"
                                                    style="font-size: 40px;"></i>
                                                <div style="font-size: 15px;" class="translate-text-group-items">
                                                    {{ __('user_page.More') }}</div>
                                            </button>
                                        </div>
                                    @endif
                                    @if ($villa_amenities->count() <= 6)
                                        @php
                                            $i = 6 - $villa_amenities->count();
                                        @endphp
                                        @foreach ($villa_amenities->take($villa_amenities->count()) as $item1)
                                            <div class="list-amenities ">
                                                <div class="text-align-center">
                                                    <i class="f-40 fa fa-{{ $item1->icon }}"></i>
                                                    <div class="mb-0 max-line">
                                                        <span
                                                            class="translate-text-group-items">{{ $item1->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="mb-0 list-more">
                                                    <span
                                                        class="translate-text-group-items">{{ $item1->name }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($i > 0)
                                            @php
                                                $i = $i - $kitchen->count();
                                                $total_last = 6 - $villa_amenities->count();
                                                $total = $villa_amenities->count() + $kitchen->count();
                                                if ($total <= 6) {
                                                    $stop = $kitchen->count();
                                                } else {
                                                    $stop = $total_last;
                                                }
                                            @endphp
                                            @foreach ($kitchen->take($stop) as $item2)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item2->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span
                                                                class="translate-text-group-items">{{ $item2->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span
                                                            class="translate-text-group-items">{{ $item2->name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($i > 0)
                                            @php
                                                $i = $i - $safety->count();
                                                $total_last = 6 - $total;
                                                $total = $total + $safety->count();
                                                if ($total <= 6) {
                                                    $stop = $safety->count();
                                                } else {
                                                    $stop = $total_last;
                                                }
                                            @endphp
                                            @foreach ($safety->take($stop) as $item4)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item4->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span
                                                                class="translate-text-group-items">{{ $item4->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span
                                                            class="translate-text-group-items">{{ $item4->name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($i > 0)
                                            @php
                                                $i = $i - $service->count();
                                                $total_last = 6 - $total;
                                                $total = $total + $service->count();
                                                if ($total <= 6) {
                                                    $stop = $service->count();
                                                } else {
                                                    $stop = $total_last;
                                                }
                                            @endphp
                                            @foreach ($service->take($stop) as $item3)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item3->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span
                                                                class="translate-text-group-items">{{ $item3->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span
                                                            class="translate-text-group-items">{{ $item3->name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($i > 0)
                                            @php
                                                $i = $i - $bathroom->count();
                                                $total_last = 6 - $total;
                                                $total = $total + $bathroom->count();
                                                if ($total <= 6) {
                                                    $stop = $bathroom->count();
                                                } else {
                                                    $stop = $total_last;
                                                }
                                            @endphp
                                            @foreach ($bathroom->take($stop) as $item2)
                                                <div class="list-amenities ">
                                                    <div class="text-align-center">
                                                        <i class="f-40 fa fa-{{ $item2->icon }}"></i>
                                                        <div class="mb-0 max-line">
                                                            <span
                                                                class="translate-text-group-items">{{ $item2->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 list-more">
                                                        <span
                                                            class="translate-text-group-items">{{ $item2->name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{-- @if ($i <= 0)
                                            <div class="list-amenities">
                                                <button class="amenities-button" type="button"
                                                    onclick="view_amenities()">
                                                    <i class="fa-solid fa-ellipsis text-orange"
                                                        style="font-size: 40px;"></i>
                                                    <div style="font-size: 15px;" class="translate-text-group-items">
                                                        {{ __('user_page.More') }}</div>
                                                </button>
                                            </div>
                                        @endif --}}
                                    @endif
                                @endif
                            </div>
                            @empty($villa_amenities->count())
                                <p id="default-amen-null">{{ __('user_page.There is no amenities') }}</p>
                            @endempty
                        </div>
                    </section>
                </div>
                {{-- END PAGE CONTENT --}}
            </div>
            {{-- END LEFT CONTENT --}}

            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div class="sidebar" id="sidebar_fix">
                    <div class="reserve-block">
                        <input type="hidden" id="id_villa" name="id_villa" value="{{ $villa[0]->id_villa }}">
                        @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;<a type="button" onclick="edit_price()"
                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Price') }}</a>
                            @endif
                        @endauth
                        <form method="POST" action="{{ route('villa_booking_confirm') }}">
                            @csrf
                            <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                            <div class="row">
                                <div class="col-12">
                                    <p class="price-box" style="display: none">
                                        <span id="cross_price"
                                            style="text-decoration: line-through; color:grey;">{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</span>
                                    </p>
                                    <p class="price-box">
                                        <span
                                            id="normal_price">{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</span>/{{ __('user_page.night') }}
                                    </p>
                                </div>
                                {{-- <div class="col-3" style="display: flex; align-items: center;">
                                        <p class="price-box" style="text-align: end;"><i class="fa fa-star"
                                                style="color: orange; font-size:14px"></i>
                                            @if ($ratting->count() > 0)
                                                {{ $ratting[0]->average }} {{ __('user_page.Reviews') }}
                                            @endif
                                        </p>
                                    </div> --}}
                            </div>
                            <div class="reserve-inner-block">
                                <div class="col-12"
                                    style="display: flex; border: 2px solid #FF7400; border-radius: 15px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 1px 10px #a4a4a4">

                                    <div class="col-6 p-5-price line-right-orange">
                                        <div class="col-12" style="text-align: center;">
                                            <a type="button" class="collapsible_check"
                                                style="background-color: white;">
                                                <p style="margin-left: 0px; margin-bottom:0px; font-size: 12px;">
                                                    {{ __('user_page.CHECK-IN') }}
                                                </p>
                                                <input class="date-form" type="text" id="check_in"
                                                    name="check_in" placeholder="{{ __('user_page.Add Date') }}"
                                                    readonly>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 p-5-price">
                                        <div class="col-12" style="text-align: center;">
                                            <a type="button" class="collapsible_check"
                                                style="background-color: white;">
                                                <p style="margin-left: 0px; margin-bottom: 0px; font-size: 12px;">
                                                    {{ __('user_page.CHECK-OUT') }}
                                                </p>
                                                <input class="date-form" type="text" id="check_out"
                                                    name="check_out" placeholder="{{ __('user_page.Add Date') }}"
                                                    readonly>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- <div class="content sidebar-popup side-check-in-calendar" id="popup_check"
                                        style="width: fit-content; margin-left: -675px; margin-top: -17px;"> -->
                                    <div class="content sidebar-popup side-check-in-calendar" id="popup_check"
                                        style="min-height: 430px; max-height: 430px;">
                                        <div class="desk-e-call">
                                            <div class="flatpickr-container"
                                                style="display: flex; justify-content: center;">
                                                <div style="display: table;">
                                                    <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                        class="col-lg-12">
                                                        <a type="button" id="clear_date"
                                                            style="margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    </div>
                                                    <div class="flatpickr" id="inline_reserve"
                                                        style="text-align: left;">
                                                        {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 p-9-price line-top"
                                    style="border: 2px solid #FF7400; margin-top: 19px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4">
                                    <button type="button" class="collapsible">{{ __('user_page.Number of Guest') }}
                                        <p class="guest-right">
                                            {{ __('user_page.guest') }}</p>
                                        <input class="guest-right-input" type="number" id="total_guest2"
                                            value="1" min="0" readonly>
                                    </button>
                                    <div class="content sidebar-popup sidebar-popup-tamu" id="popup_guest">
                                        <div class="row" style="margin-top: 10px;">

                                            <div class="reserve-input-row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ __('user_page.Adults') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Ages') }} 13+</p>
                                                    </div>
                                                </div>

                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="adult_decrement()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                    </a>
                                                    <div
                                                        style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                        <p><input type="number" id="adult2" name="adult"
                                                                value="1" min="1"
                                                                style="text-align: center; border:none; width:30px;"
                                                                min="0" readonly></p>
                                                    </div>
                                                    <a type="button" onclick="adult_increment()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="reserve-input-row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ __('user_page.Children') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Ages') }} 2-12</p>
                                                    </div>
                                                </div>

                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="child_decrement()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                    </a>
                                                    <div
                                                        style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                        <p><input type="number" id="child2" name="child"
                                                                value="0"
                                                                style="text-align: center; border:none; width:30px;"
                                                                min="0" readonly></p>
                                                    </div>
                                                    <a type="button" onclick="child_increment()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="reserve-input-row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ __('user_page.Infant') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Under') }}2</p>
                                                    </div>
                                                </div>

                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="infant_decrement()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                    </a>
                                                    <div
                                                        style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                        <p><input type="number" id="infant2" name="infant"
                                                                value="0"
                                                                style="text-align: center; border:none; width:30px;"
                                                                min="0" readonly></p>
                                                    </div>
                                                    <a type="button" onclick="infant_increment()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="reserve-input-row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ __('user_page.Pets') }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <a type="button" onclick="pet_decrement()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                    </a>
                                                    <div
                                                        style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                        <p><input type="number" id="pet2" name="pet"
                                                                value="0"
                                                                style="text-align: center; border:none; width:30px;"
                                                                min="0" readonly></p>
                                                    </div>
                                                    <a type="button" onclick="pet_increment()"
                                                        style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                        <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" style="display: none; margin-top: 10px; padding-top: 10px;"
                                id="total_all2_div">
                                <div class="col-6">
                                    <p style="margin: 0px; font-size: 12px;">
                                        <b>Total</b>
                                    </p>
                                </div>

                                <div class="col-6" style="text-align: right">
                                    <span style="font-size: 12px;"></span>
                                    <b><span id="total_all2"
                                            style="font-size:100%; font-size: 12px; margin: 0px;">0</span></b>
                                </div>

                            </div>

                            <div class="col-12 p-5-price text-center"
                                style="display: none; padding: 0px; margin-top: 20px;" id="details_button">
                                @if ($villa[0]->instant_book == 'yes')
                                    <input class="price-button" onclick="details_reserve()"
                                        style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                        value="{{ __('user_page.VIEW DETAILS') }}" readonly>
                                    <input type ="submit" class="price-button d-none" id="btnBookingDetail"
                                        style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                        value="{{ __('user_page.VIEW DETAILS') }}">
                                    {{-- <a class="price-button"
                                        style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                        href="{{ route('villa_booking_confirm') }}" target="_blank">{{ __('user_page.VIEW DETAILS') }}</a> --}}
                                @else
                                    @guest
                                        <input class="price-button" onclick="loginForm(2)"
                                            style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                            value="{{ __('user_page.QUICK ENQUIRY') }}" readonly>
                                    @endguest
                                    @auth
                                        <input class="price-button" onclick="details_quick_enquiry()"
                                            style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                                            value="{{ __('user_page.QUICK ENQUIRY') }}" readonly>
                                    @endauth
                                @endif
                            </div>

                            <div class="rightbar-advert-container"
                                style="box-shadow: 1px 1px 15px rgb(0 0 0 / 16%); margin-top: 20px; min-height: 150px; border-radius: 12px; padding: 12px;">
                                <img class="advert-img"
                                    src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- END RIGHT CONTENT --}}
            <section id="location-map" class="section-2 px-xs-20p px-sm-24p">
                <div class="row-grid-amenities">
                    <hr class="pendek">
                    <div class="section-title">
                        <h2 class="mb-0">
                            {{ __("user_page.Explore what's nearby") }}
                            @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_location()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Location') }}</a>
                                @endif
                            @endauth
                        </h2>
                    </div>
                </div>
                <div class="row-grid-amenities distance">
                    <p class="location-font-size text-orange">
                        {{ number_format($airportDistance, 1) }} {{ __('user_page.km to') }} Ngurah
                        Rai Airport
                    </p>
                </div>
                <div class="row-grid-location">
                    @include('user.modal.villa.map-location')
                </div>
            </section>
        </div>
        <div id="rsv-block-btn">
            {{-- RESERVE BUTTON TOP RIGHT --}}
            <div class="rsv">
                <strong>{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</strong>/{{ __('user_page.night') }}
                <span><a onclick="reserve2()" type="button"
                        class="rsv-btn-button">{{ __('user_page.RESERVE NOW') }}</a>
            </div>
            {{-- END RESERVE BUTTON TOP RIGHT --}}
        </div>

        <div id="navbarright" class="navright">
            <div class="list-villa-user right-bar">
                @if (Route::is('list') || Route::is('index'))
                @endif

                @auth

                    <div class="social-share-container" style="padding: 4px; border-radius: 9px;">
                        @if ($condition_villa)
                            @php
                                $cekVilla = App\Models\VillaSave::where('id_villa', $villa[0]->id_villa)
                                    ->where('id_user', Auth::user()->id)
                                    ->first();
                            @endphp

                            @if ($cekVilla == null)
                                <div style="width: 48px;" class="text-center">
                                    <a style="cursor: pointer;"
                                        onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button favorite-button-22 likeButtonvilla{{ $villa[0]->id_villa }}"
                                            style="display: unset; margin-left: 0px;">
                                            <path
                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                            </path>
                                        </svg>
                                        <div style="font-size: 10px; color: #aaa" id="captFav">
                                            {{ __('user_page.FAVORITE') }}</div>
                                    </a>
                                </div>
                            @else
                                <div style="width: 48px;" class="text-center">
                                    <a style="cursor: pointer;"
                                        onclick="likeFavorit({{ $villa[0]->id_villa }}, 'villa')">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $villa[0]->id_villa }}"
                                            style="display: unset; margin-left: 0px;">
                                            <path
                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                            </path>
                                        </svg>
                                        <div style="color: #e31c5f; font-size: 10px;" id="captCan">
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

                    <a type="button" onclick="language()" class="navbar-gap"
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

                    <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap"
                        style="color: #ffffff; width: 50px; height: 50px; border-radius: 50%; background-color: #ff7400; display: flex; align-items: center; justify-content: center; ">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @endauth
            </div>
        </div>

        {{-- FULL WIDTH ABOVE FOOTER --}}
        <div class="col-lg-12 bottom-content px-max-md-12p">
            <div class="col-12">
                <section id="review" class="section-2">
                    <hr>
                    <div class="review-bottom">
                        @if ($detail->count() > 0)
                            <h2>{{ __('user_page.Review') }}</h2>
                            <div class="row review-container">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-6">
                                            {{ __('user_page.Cleanliness') }}
                                        </div>
                                        <div class="col-6 ">
                                            <div class="liner">
                                                <span class="liner-bar"
                                                    style="width: {{ $detail[0]->average_clean * 20 }}%"></span>
                                            </div>
                                            <span>
                                                {{ $detail[0]->average_clean }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Check In') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner">
                                                <span class="liner-bar"
                                                    style="width: {{ $detail[0]->average_check_in * 20 }}%"></span>
                                            </div>
                                            <span>
                                                {{ $detail[0]->average_check_in }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Value') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner">
                                                <span class="liner-bar"
                                                    style="width: {{ $detail[0]->average_value * 20 }}%"></span>
                                            </div>
                                            <span>
                                                {{ $detail[0]->average_value }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-6">
                                            {{ __('user_page.Service') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner">
                                                <span class="liner-bar"
                                                    style="width: {{ $detail[0]->average_service * 20 }}%"></span>
                                            </div>
                                            <span>
                                                {{ $detail[0]->average_service }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Location') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner">
                                                <span class="liner-bar"
                                                    style="width: {{ $detail[0]->average_location * 20 }}%"></span>
                                            </div>
                                            <span>
                                                {{ $detail[0]->average_location }}
                                            </span>
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
                            <h3 style="margin: 0px;">{{ __('user_page.Reviews') }}</h3>
                            <div class="col-12 mt-3 d-flex review-container">
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
                            </div>
                        @endif
                        <hr>
                    </div>
                    @auth
                        @if (Auth::user()->role_id == 4)

                            @if ($villa[0]->userReview)
                                <section id="user-review" class="section-2">
                                    <div class="about-place-block">
                                        <div class="d-flex justify-content-left">
                                            <h2>{{ __('user_page.Your Review') }}</h2>
                                            <span>
                                                <form action="{{ route('villa_review_delete') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_villa"
                                                        value="{{ $villa[0]->id_villa }}" required>
                                                    <input type="hidden" name="id_review"
                                                        value="{{ $villa[0]->userReview->id_review }}" required>
                                                    <button class="delete-profile" type="submit"
                                                        style="background-color: white;">
                                                        <i class="fa fa-trash mt-2"
                                                            style="color:#ff7400; margin-left: 25px; font-size: 20px"
                                                            data-bs-toggle="popover" data-bs-animation="true"
                                                            data-bs-placement="bottom"
                                                            title="{{ __('user_page.Delete') }}"></i></button>
                                                </form>
                                            </span>
                                        </div>
                                        <div class="row">
                                            @if ($villa[0]->userReview->comment)
                                                <div class="col-12">
                                                    <div class="col-12 col-lg-6 d-flex">
                                                        <div class="col-6">
                                                            {{ __('user_page.Comment') }}
                                                        </div>
                                                        <div class="col-6 review-comment-text">
                                                            {{ $villa[0]->userReview->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 col-lg-6">
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Cleanliness') }}
                                                    </div>
                                                    <div class="col-6 ">
                                                        <div class="liner">
                                                            <span class="liner-bar"
                                                                style="width: {{ $villa[0]->userReview->cleanliness * 20 }}%"></span>
                                                        </div>
                                                        {{ $villa[0]->userReview->cleanliness }}
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Check In') }}
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="liner">
                                                            <span class="liner-bar"
                                                                style="width: {{ $villa[0]->userReview->check_in * 20 }}%"></span>
                                                        </div>
                                                        {{ $villa[0]->userReview->check_in }}
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Value') }}
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="liner">
                                                            <span class="liner-bar"
                                                                style="width: {{ $villa[0]->userReview->value * 20 }}%"></span>
                                                        </div>
                                                        {{ $villa[0]->userReview->value }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Service') }}
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="liner">
                                                            <span class="liner-bar"
                                                                style="width: {{ $villa[0]->userReview->service * 20 }}%"></span>
                                                        </div>
                                                        {{ $villa[0]->userReview->service }}
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        {{ __('user_page.Location') }}
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="liner">
                                                            <span class="liner-bar"
                                                                style="width: {{ $villa[0]->userReview->location * 20 }}%"></span>
                                                        </div>
                                                        {{ $villa[0]->userReview->location }}
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
                                            <div class="col-12">
                                                <form action="{{ route('villa_review_store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_villa"
                                                        value="{{ $villa[0]->id_villa }}" readonly required>

													<div class="row">
                                                        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                                            <div class="d-flex">
                                                                <div class="col-4 review-container">
                                                                    {{ __('user_page.Cleanliness') }}
                                                                </div>
                                                                <div class="col-8 review-container">
                                                                    <div class="cm-star-rating">
                                                                        <input id="food-star-5" type="radio"
                                                                            name="cleanliness" value="5"
                                                                            required />
                                                                        <label for="food-star-5"
                                                                            title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="food-star-4" type="radio"
                                                                            name="cleanliness" value="4"
                                                                            required />
                                                                        <label for="food-star-4"
                                                                            title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="food-star-3" type="radio"
                                                                            name="cleanliness" value="3"
                                                                            required />
                                                                        <label for="food-star-3"
                                                                            title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="food-star-2" type="radio"
                                                                            name="cleanliness" value="2"
                                                                            required />
                                                                        <label for="food-star-2"
                                                                            title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="food-star-1" type="radio"
                                                                            name="cleanliness" value="1"
                                                                            required />
                                                                        <label for="food-star-1"
                                                                            title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
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
                                                                            name="service" value="5"
                                                                            required />
                                                                        <label for="service-star-5"
                                                                            title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="service-star-4" type="radio"
                                                                            name="service" value="4"
                                                                            required />
                                                                        <label for="service-star-4"
                                                                            title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="service-star-3" type="radio"
                                                                            name="service" value="3"
                                                                            required />
                                                                        <label for="service-star-3"
                                                                            title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="service-star-2" type="radio"
                                                                            name="service" value="2"
                                                                            required />
                                                                        <label for="service-star-2"
                                                                            title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="service-star-1" type="radio"
                                                                            name="service" value="1"
                                                                            required />
                                                                        <label for="service-star-1"
                                                                            title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="col-4 review-container">
                                                                    {{ __('user_page.Check in') }}
                                                                </div>
                                                                <div class="col-8 review-container">
                                                                    <div class="cm-star-rating">
                                                                        <input id="atmosphere-star-5" type="radio"
                                                                            name="check_in" value="5"
                                                                            required />
                                                                        <label for="atmosphere-star-5"
                                                                            title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="atmosphere-star-4" type="radio"
                                                                            name="check_in" value="4"
                                                                            required />
                                                                        <label for="atmosphere-star-4"
                                                                            title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="atmosphere-star-3" type="radio"
                                                                            name="check_in" value="3"
                                                                            required />
                                                                        <label for="atmosphere-star-3"
                                                                            title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="atmosphere-star-2" type="radio"
                                                                            name="check_in" value="2"
                                                                            required />
                                                                        <label for="atmosphere-star-2"
                                                                            title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="atmosphere-star-1" type="radio"
                                                                            name="check_in" value="1"
                                                                            required />
                                                                        <label for="atmosphere-star-1"
                                                                            title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="col-4 review-container">
                                                                    {{ __('user_page.Location') }}
                                                                </div>
                                                                <div class="col-8 review-container">
                                                                    <div class="cm-star-rating">
                                                                        <input id="location-star-5" type="radio"
                                                                            name="location" value="5"
                                                                            required />
                                                                        <label for="location-star-5"
                                                                            title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="location-star-4" type="radio"
                                                                            name="location" value="4"
                                                                            required />
                                                                        <label for="location-star-4"
                                                                            title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="location-star-3" type="radio"
                                                                            name="location" value="3"
                                                                            required />
                                                                        <label for="location-star-3"
                                                                            title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="location-star-2" type="radio"
                                                                            name="location" value="2"
                                                                            required />
                                                                        <label for="location-star-2"
                                                                            title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="location-star-1" type="radio"
                                                                            name="location" value="1"
                                                                            required />
                                                                        <label for="location-star-1"
                                                                            title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
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
                                                                        <input id="value-star-5" type="radio"
                                                                            name="value" value="5"
                                                                            required />
                                                                        <label for="value-star-5"
                                                                            title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="value-star-4" type="radio"
                                                                            name="value" value="4"
                                                                            required />
                                                                        <label for="value-star-4"
                                                                            title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="value-star-3" type="radio"
                                                                            name="value" value="3"
                                                                            required />
                                                                        <label for="value-star-3"
                                                                            title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="value-star-2" type="radio"
                                                                            name="value" value="2"
                                                                            required />
                                                                        <label for="value-star-2"
                                                                            title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="value-star-1" type="radio"
                                                                            name="value" value="1"
                                                                            required />
                                                                        <label for="value-star-1"
                                                                            title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                            <i class="active fa fa-star"
                                                                                aria-hidden="true"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                                            <div class="col-12">
                                                                {{ __('user_page.Comment') }}
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea name="comment" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <center>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-sm btn-primary"
                                                                    style="width: 200px">{{ __('user_page.Save') }}</button>
                                                            </center>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </section>
                            @endif
                        @endif
                    @endauth
                </section>
                <section id="endSticky" class="section-2">
                    <h3>{{ __('user_page.Things to know') }}</h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 mb-3">
                            <div class="d-flex">
                                <h6 class="mb-2">{{ __('user_page.House Rules') }}</h6>
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editHouseRules()"
                                            style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </div>
                            <p style="margin-bottom: 0px !important" id="houseRuleContent">
                                @if (!isset($house_rules))
                                    {{ __('user_page.No data found') }}
                                @endif

                                @if (isset($house_rules))
                                    @if ($house_rules->children == 'yes')
                                        <i class="fas fa-child"></i>
                                        {{ __('user_page.Childrens are allowed') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->infants == 'yes')
                                        <i class="fas fa-child"></i>
                                        {{ __('user_page.Infants are allowed') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->pets == 'yes')
                                        <i class="fas fa-paw"></i>
                                        {{ __('user_page.Pets are allowed') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->smoking == 'yes')
                                        <i class="fas fa-smoking"></i>
                                        {{ __('user_page.Smoking is allowed') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->events == 'yes')
                                        <i class="fas fa-calendar"></i>
                                        {{ __('user_page.Events are allowed') }}
                                        <br>
                                    @endif

                                    @if ($house_rules->children == 'no')
                                        <i class="fas fa-ban"></i>
                                        {{ __('user_page.No children') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->infants == 'no')
                                        <i class="fas fa-ban"></i>
                                        {{ __('user_page.No infants') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->pets == 'no')
                                        <i class="fas fa-ban"></i>
                                        {{ __('user_page.No pets') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->smoking == 'no')
                                        <i class="fas fa-ban"></i>
                                        {{ __('user_page.No smoking') }}
                                        <br>
                                    @endif
                                    @if ($house_rules->events == 'no')
                                        <i class="fas fa-ban"></i>
                                        {{ __('user_page.No events') }}
                                        <br>
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 mb-3">
                            <div class="d-flex">
                                <h6 class="mb-2">{{ __('user_page.Health & Safety') }}</h6>
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editGuestSafety()"
                                            style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </div>
                            <p style="margin-bottom: 0px !important" id="guestSafetyContent">
                                @forelse ($villa[0]->guestSafety->take(4) as $item)
                                    <i class="fas fa-{{ $item->icon }}"></i>
                                    <span class="translate-text-single">{{ $item->guest_safety }}</span><br>
                                @empty
                                    {{ __('user_page.No data found') }}
                                @endforelse
                            </p>
                            @php
                                $countGuest = count($villa[0]->guestSafety);
                            @endphp
                            @if ($countGuest > 5)
                                <p style="margin-bottom: 0px !important" id="btnShowMoreGuestSafety">
                                    <a href="javascript:void(0)" onclick="showMoreGuestSafety()">
                                        {{ __('user_page.Show more') }}
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 mb-1 mb-md-3">
                            <div class="d-flex">
                                <h6 class="mb-2">{{ __('user_page.Cancellation Policy') }}</h6>
                                @auth
                                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editCancelationPolicy()"
                                            style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </div>
                            <p style="margin-bottom: 0px !important">
                                {{ __('user_page.Add your trip dates to get the cancellation details for this stay') }}<br>
                            </p>
                            <p style="margin-bottom: 0px !important; margin-top:14px">
                                <a onclick="addDatesFunction()"
                                    style="text-decoration: underline; color: #ff7400; cursor: pointer;"
                                    class="d-none" id="addDates">{{ __('user_page.Add Dates') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                <a onclick="showMoreCancelationPolicy();" href="javascript:void(0);"
                                    style="text-decoration: underline; color: #ff7400;" class="d-none"
                                    id="showCancel">{{ __('user_page.Show more') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                    <hr>
                </section>
                <section>
                    {{-- Insurance --}}
                    <div class="">
                        <h3>
                            {{ __('user_page.EZV Cover') }}
                        </h3>
                        <p id="description-content">
                            {{ __('user_page.Every booking includes free protection from Host cancellations, listing inaccuracies, and other issues like trouble checking in.') }}
                        </p>

                        <a id="" style="font-weight: 600;" href="javascript:void(0);"
                            onclick="showMoreInsurance();">
                            <span
                                style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Learn more') }}</span>
                        </a>

                    </div>
                    <hr>
                    {{-- End of Insurance --}}
                </section>
                <div class="section">
                    <div>
                        <div class="row owner-block">
                            <div class="col-1 host-profile">
                                @if ($createdby[0]->avatar)
                                    @guest
                                        <a href="{{ route('owner_profile_show', $createdby[0]->id) }}"
                                            target="_blank">
                                        @endguest
                                        @auth
                                            @if ($createdby[0]->id == Auth::user()->id)
                                                <a href="{{ route('profile_user') }}" target="_blank">
                                                @else
                                                    <a href="{{ route('owner_profile_show', $createdby[0]->id) }}"
                                                        target="_blank">
                                            @endIf
                                        @endauth
                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                            data-src="{{ $createdby[0]->avatar }}">
                                    </a>
                                @else
                                    @auth
                                        @if ($createdby[0]->id == Auth::user()->id)
                                            <a href="{{ route('profile_user') }}" target="_blank">
                                            @else
                                                <a href="{{ route('owner_profile_show', $createdby[0]->id) }}"
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
                                            @if ($villa[0]->userCreate->first_name == null || $villa[0]->userCreate->last_name == null)
                                                Anonymous
                                            @else
                                                {{ $villa[0]->userCreate->first_name }}
                                                {{ $villa[0]->userCreate->last_name }}
                                            @endif
                                        </h4>
                                        @auth
                                            @if (Auth::user()->id == $villa[0]->created_by)
                                                &nbsp;
                                                <a type="button" href="{{ route('profile_user') }}"
                                                    style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Profile') }}</a>
                                            @endif
                                        @endauth
                                    </div>
                                    @if (isset($villa[0]->userCreate->created_at))
                                        <p>{{ __('user_page.Joined in') }}
                                            {{ date_format($villa[0]->userCreate->created_at, 'M Y') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="owner-profile">
                                    <h4>{{ __('user_page.Host Profile') }}</h4>
                                    <p>
                                        {{ __('user_page.About') }}
                                        <span>{{ $createdby[0]->about_owner ?? '-' }}</span><br>
                                        {{ __('user_page.Location') }}
                                        <span>{{ $createdby[0]->location_owner ?? '-' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="member-profile-desc">
                            <p class="host-review">
                                @if (isset($government->approved_status) == 1)
                                    <i class="fa fa-check" style="color: green;"></i>
                                    {{ __('user_page.Identity verified') }}
                                @else
                                @endif
                            </p>
                            {{-- <p>{{ $createdby[0]->about_owner }}</p> --}}
                            @auth
                                @if (Auth::user()->role_id == 4)
                                    <button type="button" onclick="contactHostForm()"
                                        class="member-profile-button">{{ __('user_page.Contact Host') }}</button>
                                @endif
                            @endauth
                            <div class="row mt-20">
                                <div class="col-1 payment-warning-icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="col-11 payment-warning">
                                    {{ __('user_page.To protect your payment, never transfer money or communicate outside of the EZVillas Bali website or app') }}
                                </div>
                            </div>
                            <br>
                            {{-- ALERT CONTENT STATUS --}}
                            @auth
                                @if (auth()->user()->id == $villa[0]->created_by)
                                    @if ($villa[0]->status == '0')
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
                                    @if ($villa[0]->status == '1')
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
                                    @if ($villa[0]->status == '2')
                                        <div id="activation2">
                                            <div class="alert alert-warning d-flex flex-row align-items-center"
                                                role="warning">
                                                <span>{{ __('user_page.you have been request activation for this content, Please wait until the process is complete.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($villa[0]->status == '3')
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
                                    @if ($villa[0]->status == '0')
                                        <div id="adminVilla0">
                                            <div class="alert alert-danger d-flex flex-row align-items-center"
                                                role="alert">
                                                <span>{{ __('user_page.this content is deactive') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($villa[0]->status == '1')
                                        <div id="adminVilla1">
                                            <div class="alert alert-success d-flex flex-row align-items-center"
                                                role="success">
                                                <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                                <div style="margin-left: 10px;">
                                                    <select class="custom-select grade-success" name="grade"
                                                        id="gradeVilla">
                                                        <option value="AA"
                                                            {{ $villa[0]->grade == 'AA' ? 'selected' : '' }}>AA
                                                        </option>
                                                        <option value="A"
                                                            {{ $villa[0]->grade == 'A' ? 'selected' : '' }}>A
                                                        </option>
                                                        <option value="B"
                                                            {{ $villa[0]->grade == 'B' ? 'selected' : '' }}>B
                                                        </option>
                                                        <option value="C"
                                                            {{ $villa[0]->grade == 'C' ? 'selected' : '' }}>C
                                                        </option>
                                                        <option value="D"
                                                            {{ $villa[0]->grade == 'D' ? 'selected' : '' }}>D
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    @if ($villa[0]->status == '2')
                                        <div id="adminVilla2">
                                            <div class="alert alert-warning d-flex justify-content-start"
                                                role="warning">
                                                <span>{{ __('user_page.the owner request activation, choose grade Villa') }}
                                                </span>
                                                <div style="margin-left: 10px;">
                                                    <select class="custom-select grade" name="grade" id="grade2">
                                                        <option value="AA"
                                                            {{ $villa[0]->grade == 'AA' ? 'selected' : '' }}>AA
                                                        </option>
                                                        <option value="A"
                                                            {{ $villa[0]->grade == 'A' ? 'selected' : '' }}>A
                                                        </option>
                                                        <option value="B"
                                                            {{ $villa[0]->grade == 'B' ? 'selected' : '' }}>B
                                                        </option>
                                                        <option value="C"
                                                            {{ $villa[0]->grade == 'C' ? 'selected' : '' }}>C
                                                        </option>
                                                        <option value="D"
                                                            {{ $villa[0]->grade == 'D' ? 'selected' : '' }}>D
                                                        </option>
                                                    </select>
                                                </div>
                                                <span style="margin-left: 10px;">and</span>
                                                <button class="btn" type="submit" style="margin-top: -7px;"
                                                    onclick="ActivationContent()">{{ __('user_page.activate this content') }}</button>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($villa[0]->status == '3')
                                        <div id="adminVilla3">
                                            <div class="alert alert-warning d-flex flex-row align-items-center"
                                                role="warning">
                                                <span>{{ __('user_page.the owner request deactivation,') }}' </span>
                                                <form
                                                    action="{{ route('admin_villa_update_status', $villa[0]->id_villa) }}"
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

                                {{-- <h4>{{ __('user_page.Nearby Restaurants & Things To Do') }}</h4> --}}

                                {{-- EDIT TO SWIPE CAROUSEL --}}

                                {{-- <div class="container-xxl mx-auto p-0">
                                    <div class="slick-pop-slider">
                                        <div class="Container1">
                                            <!-- <div class="row col-12 Arrows1"></div> -->
                                            <div class="Head">
                                                <h6><i class="fas fa-utensils"></i></span>
                                                    {{ __('user_page.Restaurants') }} <span class="Arrows1"></span>
                                                </h6>
                                            </div>
                                            <!-- Carousel Container -->
                                            <div class="SlickCarousel1">
                                                @forelse ($nearby_restaurant as $item)
                                                    <!-- Item -->
                                                    <div class="ProductBlock">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a style="cursor: pointer;" onclick="loginForm()">
                                                                    <svg viewBox="0 0 32 32"
                                                                        class="favorite-button favorite-button-22 white-stroke"
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
                                                        @endguest
                                                        @auth
                                                            @php
                                                                $cekRestaurant = App\RestaurantSave::where('id_restaurant', $item->detail->id_restaurant)
                                                                    ->where('id_user', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            @if ($cekRestaurant == null)
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a style="cursor: pointer;"
                                                                        onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke likeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                    <a style="cursor: pointer;"
                                                                        onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button-active favorite-button-22 white-stroke unlikeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                <div class="img-fill" loading="lazy">
                                                                    <a href="{{ route('restaurant', $item->detail->id_restaurant) }}"
                                                                        target="_blank">
                                                                        <img src="{{ URL::asset('/foto/restaurant/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                            alt="{{ __('user_page.Restaurants') }}"
                                                                            loading="lazy">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                            <!-- akhir loop setiap gambar -->
                                                        </div>
                                                        <div class="bottom-fill grid-one-line max-lines">
                                                            <a href="{{ route('restaurant', $item->detail->id_restaurant) }}"
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
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            <div style="min-height: 21px;"
                                                                class="col-12 d-flex justify-content-left text-14 fw-400 text-grey-2">
                                                                @if ($item->detail->cuisine->count() > 0)
                                                                    @foreach ($item->detail->cuisine->take(3) as $cuisine)
                                                                        @php
                                                                            $i += 1;
                                                                        @endphp
                                                                        <span>
                                                                            @php
                                                                                if ($i <= 3 && $i > 1) {
                                                                                    echo ' • ';
                                                                                }
                                                                            @endphp
                                                                            <span
                                                                                class="translate-text-group-items">{{ $cuisine->name }}</span>
                                                                            &nbsp;
                                                                        </span>
                                                                    @endforeach
                                                                @else
                                                                    <span
                                                                        class="translate-text-group-items">{{ __('user_page.there is no cuisine yet') }}</span>
                                                                @endif
                                                            </div>
                                                            <div
                                                                class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between">
                                                                <!-- change to real distance -->
                                                                <div class="text-grey-1 mt-1 text-13"><i
                                                                        class="fa-solid text-orange fa-location-dot"></i>
                                                                    <span class="text-grey-1"><span class="text-grey-1"
                                                                            id="travelDistance"></span>{{ $item->kilometer }}
                                                                        {{ __('user_page.km from this villa') }}</span>
                                                                </div>
                                                                <div
                                                                    class="text-14 fw-400 grid-one-line font-black list-description">
                                                                    @if ($item->detail->price->name == 'Cheap Prices')
                                                                        <span style="color: #FF7400"
                                                                            data-bs-toggle="popover"
                                                                            data-bs-animation="true"
                                                                            data-bs-placement="bottom"
                                                                            title="{{ Translate::translate($item->detail->price->name) }}">$</span>
                                                                    @elseif ($item->detail->price->name == 'Middle Range')
                                                                        <span style="color: #FF7400"
                                                                            data-bs-toggle="popover"
                                                                            data-bs-animation="true"
                                                                            data-bs-placement="bottom"
                                                                            title="{{ Translate::translate($item->detail->price->name) }}">$$</span>
                                                                    @elseif ($item->detail->price->name == 'Fine Dining')
                                                                        <span style="color: #FF7400"
                                                                            data-bs-toggle="popover"
                                                                            data-bs-animation="true"
                                                                            data-bs-placement="bottom"
                                                                            title="{{ Translate::translate($item->detail->price->name) }}">$$$</span>
                                                                    @else
                                                                        {{ __('user_page.Price is unknown') }}
                                                                    @endIf
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-grey-1 mt-1 text-13">
                                                                    @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
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
                                                                <span>{{ __('user_page.no restaurant found') }}</span></a>
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
                                                    <div class="ProductBlock grid-list-container">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a onclick="loginForm()" style="cursor: pointer;">
                                                                    <svg viewBox="0 0 32 32"
                                                                        class="favorite-button favorite-button-22 white-stroke"
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
                                                                            class="favorite-button-active favorite-button-22 white-stroke unlikeButtonactivity{{ $item->detail->id_activity }}"
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
                                                            @foreach ($item->detail->photo->sortBy('photo') as $itemPhoto)
                                                                <div class="img-fill" loading="lazy">
                                                                    <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                        target="_blank">
                                                                        <img src="{{ URL::asset('/foto/activity/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                            alt="{{ __('user_page.Things to do') }}"
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
                                                            <!-- change to real distance -->
                                                            <div class="text-grey-1 mt-1 text-13"><i
                                                                    class="fa-solid text-orange fa-location-dot"></i>
                                                                <span class="text-grey-1"><span class="text-grey-1"
                                                                        id="travelDistance"></span>{{ $item->kilometer }}
                                                                    {{ __('user_page.km from this villa') }}</span>
                                                            </div>
                                                            <div>
                                                                <p class="text-grey-1 mt-1 text-13">
                                                                    @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                        <!-- <i class="fa-solid text-orange fas fa-plane"></i> |  -->
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
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
                                                                <span>{{ __('user_page.no things to do found') }}</span></a>
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
                                    {{-- <h4>{{ __('user_page.Nearby Restaurants & Things To Do') }}</h4> --}}

                                    {{-- EDIT TO SWIPE CAROUSEL --}}

                                    {{-- <div class="container-xxl mx-auto p-0">
                                        <div class="slick-pop-slider">
                                            <div class="Container1">
                                                <!-- <div class="row col-12 Arrows1"></div> -->
                                                <div class="Head">
                                                    <h6><i class="fas fa-utensils"></i></span>
                                                        {{ __('user_page.Restaurants') }} <span
                                                            class="Arrows1"></span>
                                                    </h6>
                                                </div>
                                                <!-- Carousel Container -->
                                                <div class="SlickCarousel1">
                                                    @forelse ($nearby_restaurant as $item)
                                                        <!-- Item -->
                                                        <div class="ProductBlock">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a style="cursor: pointer;" onclick="loginForm()">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke"
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
                                                            @endguest
                                                            @auth
                                                                @php
                                                                    $cekRestaurant = App\RestaurantSave::where('id_restaurant', $item->detail->id_restaurant)
                                                                        ->where('id_user', Auth::user()->id)
                                                                        ->first();
                                                                @endphp
                                                                @if ($cekRestaurant == null)
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a style="cursor: pointer;"
                                                                            onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')">
                                                                            <svg viewBox="0 0 32 32"
                                                                                class="favorite-button favorite-button-22 white-stroke likeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                        <a style="cursor: pointer;"
                                                                            onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')">
                                                                            <svg viewBox="0 0 32 32"
                                                                                class="favorite-button-active favorite-button-22 white-stroke unlikeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                    <div class="img-fill" loading="lazy">
                                                                        <a href="{{ route('restaurant', $item->detail->id_restaurant) }}"
                                                                            target="_blank">
                                                                            <img src="{{ URL::asset('/foto/restaurant/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                                alt="{{ __('user_page.Restaurants') }}"
                                                                                loading="lazy">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                <!-- akhir loop setiap gambar -->
                                                            </div>
                                                            <div class="bottom-fill grid-one-line max-lines">
                                                                <a href="{{ route('restaurant', $item->detail->id_restaurant) }}"
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
                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                                <div style="min-height: 21px;"
                                                                    class="col-12 d-flex justify-content-left text-14 fw-400 text-grey-2">
                                                                    @if ($item->detail->cuisine->count() > 0)
                                                                        @foreach ($item->detail->cuisine->take(3) as $cuisine)
                                                                            @php
                                                                                $i += 1;
                                                                            @endphp
                                                                            <span>
                                                                                @php
                                                                                    if ($i <= 3 && $i > 1) {
                                                                                        echo ' • ';
                                                                                    }
                                                                                @endphp
                                                                                <span
                                                                                    class="translate-text-group-items">{{ $cuisine->name }}</span>
                                                                                &nbsp;
                                                                            </span>
                                                                        @endforeach
                                                                    @else
                                                                        <span
                                                                            class="translate-text-group-items">{{ __('user_page.there is no cuisine yet') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between">
                                                                    <!-- change to real distance -->
                                                                    <div class="text-grey-1 mt-1 text-13"><i
                                                                            class="fa-solid text-orange fa-location-dot"></i>
                                                                        <span class="text-grey-1"><span
                                                                                class="text-grey-1"
                                                                                id="travelDistance"></span>{{ $item->kilometer }}
                                                                            {{ __('user_page.km from this villa') }}</span>
                                                                    </div>
                                                                    <div
                                                                        class="text-14 fw-400 grid-one-line font-black list-description">
                                                                        @if ($item->detail->price->name == 'Cheap Prices')
                                                                            <span style="color: #FF7400"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-animation="true"
                                                                                data-bs-placement="bottom"
                                                                                title="{{ Translate::translate($item->detail->price->name) }}">$</span>
                                                                        @elseif ($item->detail->price->name == 'Middle Range')
                                                                            <span style="color: #FF7400"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-animation="true"
                                                                                data-bs-placement="bottom"
                                                                                title="{{ Translate::translate($item->detail->price->name) }}">$$</span>
                                                                        @elseif ($item->detail->price->name == 'Fine Dining')
                                                                            <span style="color: #FF7400"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-animation="true"
                                                                                data-bs-placement="bottom"
                                                                                title="{{ Translate::translate($item->detail->price->name) }}">$$$</span>
                                                                        @else
                                                                            {{ __('user_page.Price is unknown') }}
                                                                        @endIf
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <p class="text-grey-1 mt-1 text-13">
                                                                        @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
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
                                                                    <span>{{ __('user_page.no restaurant found') }}</span></a>
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
                                                        <div class="ProductBlock grid-list-container">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="loginForm()" style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            class="favorite-button favorite-button-22 white-stroke"
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
                                                                                class="favorite-button-active favorite-button-22 white-stroke unlikeButtonactivity{{ $item->detail->id_activity }}"
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
                                                                @foreach ($item->detail->photo->sortBy('photo') as $itemPhoto)
                                                                    <div class="img-fill" loading="lazy">
                                                                        <a href="{{ route('activity', $item->detail->id_activity) }}"
                                                                            target="_blank">
                                                                            <img src="{{ URL::asset('/foto/activity/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                                alt="{{ __('user_page.Things to do') }}"
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
                                                                <!-- change to real distance -->
                                                                <div class="text-grey-1 mt-1 text-13"><i
                                                                        class="fa-solid text-orange fa-location-dot"></i>
                                                                    <span class="text-grey-1"><span class="text-grey-1"
                                                                            id="travelDistance"></span>{{ $item->kilometer }}
                                                                        {{ __('user_page.km from this villa') }}</span>
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
                                                                    <span>{{ __('user_page.no things to do found') }}</span></a>
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
        {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>

    {{-- MODAL --}}
    @include('user.modal.villa.guest-safety')
    @auth
        @include('user.modal.villa.price')
        @include('user.modal.villa.bedroom')
        {{-- @include('user.modal.villa.guest') --}}
        @include('user.modal.villa.location')
        @include('user.modal.villa.amenities_add')
        @include('user.modal.villa.short_description')
        @include('user.modal.villa.story')
        @include('user.modal.villa.photo')
        @include('user.modal.villa.villa_profile')
        @include('user.modal.villa.edit.edit-guest-safety')
        @include('user.modal.villa.edit.edit-house-rules')
        @include('user.modal.villa.edit.cancelation_policy')
        @include('user.modal.advert-listing')
        @include('user.modal.villa.tags_villa')
        @include('user.modal.villa.category_villa')
    @endauth
    @include('user.modal.villa.description')
    @include('user.modal.villa.insurance')
    @include('user.modal.villa.review')
    @include('user.modal.villa.cancelation-policy-modal')

    {{-- MORE TAG MODAL --}}
    <div class="modal fade" id="modal-subcategory" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Property Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        onclick="close_subcategory()" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <div class="row row-border-bottom padding-top-bottom-18px" id="moreSubCategory">
                        @foreach ($villaHasCategory as $item)
                            <div class='col-md-6'>{{ $item->villaCategory->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tags-villa" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        onclick="close_subcategory()" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <div class="row row-border-bottom padding-top-bottom-18px" id="viewTags">
                        @foreach ($villaTags as $item)
                            <div class='col-md-6'>{{ $item->villaFilter->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MORE TAG MODAL --}}

    {{-- STORY MODAL --}}
    <div class="modal fade" id="storymodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
        style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="modal-content modal-content-story video-container" style="width:980px;">
                <center>
                    <h5 class="video-title" id="storymodal-title"></h5>
                    <input type="hidden" id="id_story" name="id_story" value="{{ $villa[0]->id_villa }}">
                    <input type="hidden" id="villa" name="villa" value="{{ $villa[0]->name }}">

                    <video controls id="video" class="video-modal">
                        <source src="">
                        {{ __("user_page.Your browser doesn't support HTML5 video tag") }}
                    </video>

            </div>
            </center>
        </div>
    </div>

    {{-- MODAL VIDEO --}}
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
        style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-content video-container">
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="">
                        {{ __("user_page.Your browser doesn't support HTML5 video tag") }}
                    </video>
                    <h5 class="video-title" id="title"></h5><br>
            </div>
            </center>
        </div>
    </div>

    {{-- MODAL AMENITIES --}}
    <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered"
            role="document" style="overflow-y: initial !important">
            <div class="modal-content">
                <div class="modal-header modal-header-amenities">
                    <h5 class="modal-title">{{ __('user_page.All Amenities') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-amenities pb-1" style=" height: 415px; overflow-y: auto;">
                    @php
                        $amenitiesGet = App\Http\Controllers\ViewController::amenities($villa[0]->id_villa);
                        $bathroomGet = App\Http\Controllers\ViewController::bathroom($villa[0]->id_villa);
                        $bedroomGet = App\Http\Controllers\ViewController::bedroom($villa[0]->id_villa);
                        $kitchenGet = App\Http\Controllers\ViewController::kitchen($villa[0]->id_villa);
                        $safetyGet = App\Http\Controllers\ViewController::safety($villa[0]->id_villa);
                        $serviceGet = App\Http\Controllers\ViewController::service($villa[0]->id_villa);
                    @endphp
                    <div class="row-modal-amenities translate-text-group row-border-bottom" id="moreAmenities">
                        @foreach ($amenitiesGet as $item)
                            <div class="col-md-6 mb-2">
                                <span class='translate-text-group-items'>
                                    {{ $item->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px"
                        id="moreKitchen">
                        <div class="col-md-12">
                            <h5 class="mb-3">{{ __('user_page.Kitchen') }}</h5>
                        </div>
                        @foreach ($kitchenGet as $item)
                            <div class='col-md-6'>
                                <span class='translate-text-group-items'>
                                    {{ $item->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px"
                        id="moreSafety">
                        <div class="col-md-12">
                            <h5 class="mb-3">{{ __('user_page.Safety') }}</h5>
                        </div>
                        @foreach ($safetyGet as $item)
                            <div class='col-md-6'>
                                <span class='translate-text-group-items'>
                                    {{ $item->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px">
                        <div class="col-md-12">
                            <h5 class="mb-3">{{ __('user_page.Service') }}</h5>
                        </div>
                        @foreach ($serviceGet as $item)
                            <div class='col-md-6'>
                                <span class='translate-text-group-items'>
                                    {{ $item->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px"
                        id="moreBathroom">
                        <div class="col-md-12">
                            <h5 class="mb-3">{{ __('user_page.Bathroom') }}</h5>
                        </div>
                        @foreach ($bathroomGet as $item)
                            <div class="col-md-6">
                                <span class="translate-text-group-items">
                                    {{ $item->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    {{-- @for ($i = 1; $i <= 3; $i++)
                        <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px"
                            id="moreBedroom">
                            <div class="col-md-12">
                                <h5 class="mb-3">{{ __('user_page.Bedroom') }} {{ $i }}</h5>
                            </div>
                            @foreach ($bedroomGet as $item)
                                <div class="col-md-6">
                                    <span class="translate-text-group-items">
                                        {{ $item->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endfor --}}
                    <div id="bedroom-detail-content">
                        @for ($i = 0; $i < $villa[0]->villaBedroomDetail->count(); $i++)
                            <div
                                class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px">
                                <div class="col-md-12">
                                    <h5 class="mb-3">{{ __('user_page.Bedroom') }} {{ $i + 1 }}</h5>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        @forelse ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBedroomAmenities as $item)
                                            <div class="col-md-12">
                                                <span class="translate-text-group-items">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                        @empty
                                        @endforelse
                                        @forelse ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBed as $item)
                                            <div class="col-md-12">
                                                <span class="translate-text-group-items">
                                                    {{ $item->bed->name }}
                                                </span>
                                                <span>
                                                    x{{ $item->qty }}
                                                </span>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="col-md-6">
                                        @forelse ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBathroomAmenities as $item)
                                            <div class="col-md-12">
                                                <span class="translate-text-group-items">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <script>
        function view_amenities() {
            $('#modal-amenities').modal('show');
        }
    </script>



    <script>
        function details_reserve() {
            $('#modal-details-reserve').modal('show');
            $('#modal-details-reserve').css('padding-right', '0px');
        }

        function details_quick_enquiry() {
            $('#modal-quick-enquiry').modal('show');
            $('#modal-quick-enquiry').css('padding-right', '0px');
        }

        $(document).ready(function() {
            $('#modal-details-reserve').on('hidden.bs.modal', function() {
                document.getElementsByTagName('html')[0].style.overflowY = "scroll";
            });
        })
    </script>

    {{-- <script>
        function view_add_caption(idc) {
            $('#id_photo_caption').val(idc.id_photo);

            $('#caption_photo').val(idc.caption);

            $('#modal-add_caption').modal('show');
        }
    </script> --}}

    {{-- MODAL SHARE --}}
    <div class="modal fade" id="modal-share" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down" role="document">
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
                        @if ($villa[0]->image)
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $villa[0]->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                        @else
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $villa[0]->name }}</p>
                    </div>
                    <div>
                        @guest
                            <div class="modal-share-container">
                                <div class="col-lg col-12 p-3 border br-10">
                                    <!-- <input type="text" value="{{ route('villa', $villa[0]->id_villa) }}" id="share_link">
                                                        <button onclick="share_function()">Copy link</button> -->
                                    <button type="button" class="d-flex p-0 copier" onclick="copyURI()">
                                        {{ __('user_page.Copy Link') }}
                                    </button>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $villa[0]->id_villa) }}&display=popup"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                                class="fw-normal">Facebook</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="https://api.whatsapp.com/send?text={{ route('villa', $villa[0]->id_villa) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                                class="fw-normal">WhatsApp</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="https://telegram.me/share/url?url={{ route('villa', $villa[0]->id_villa) }}&text={{ route('villa', $villa[0]->id_villa) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                                class="fw-normal">Telegram</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $villa[0]->id_villa) }}"
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
                                        href="{{ route('villa', $villa[0]->id_villa) }}" onclick="copyURI()">
                                        {{ __('user_page.Copy Link') }}
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $villa[0]->id_villa) }}?ref={{ Auth::user()->user_code }}&display=popup"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                                class="fw-normal">Facebook</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="https://api.whatsapp.com/send?text={{ route('villa', $villa[0]->id_villa) }}?ref={{ Auth::user()->user_code }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                                class="fw-normal">WhatsApp</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="https://telegram.me/share/url?url={{ route('villa', $villa[0]->id_villa) }}?ref={{ Auth::user()->user_code }}&text={{ route('villa', $villa[0]->id_villa) }}?ref={{ Auth::user()->user_code }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                                class="fw-normal">Telegram</span></div>
                                    </a>
                                </div>
                                <div class="col-12 p-3 border br-10">
                                    <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $villa[0]->id_villa) }}?ref={{ Auth::user()->user_code }}"
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

    {{-- MODAL ADD PHOTO CAPTION --}}
    {{-- <div class="modal fade" id="modal-add_caption" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.Add Photo Caption') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-top: 0;">
                    <form action="{{ route('villa_update_caption_photo') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                        <input type="hidden" id="id_photo_caption" name="id_photo" value="">
                        <div class="row">
                            <div class="col-12">
                                <label>{{ __('user_page.Max x character', ['number' => 200]) }}</label>
                                <input type="text" class="add-caption" id="caption_photo" name="caption"
                                    value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('user_page.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}">
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
        <div class="modal-dialog modal-fullscreen modal-xl" role="document">
            <div class="modal-content" style="background: white;">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">
                        {{ __('user_page.Edit Position Photos') }}</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            style="font-size: 22px;" class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-photo">
                        @forelse ($photo as $item)
                            @php
                                $id = $item->id_photo;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}"
                                id="positionPhotoGallery{{ $id }}">
                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ asset('foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}"
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
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            style="font-size: 22px;" class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-video">
                        @forelse ($video as $item)
                            @php
                                $id = $item->id_video;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}"
                                id="positionVideoGallery{{ $id }}">
                                <video loading="lazy"
                                    src="{{ asset('foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}#t=1.0">
                            </li>
                        @empty
                            {{ __('user_page.there is no image yet') }}
                        @endforelse
                    </ul>

                </div>
                <div class="modal-footer">
                    <div style="clear: both; width: 100%;">
                        <button type='submit' id="saveBtnReorderVideo" class="btn-edit-position-photos"
                            onclick="save_reorder_video()">{{ __('user_page.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAP MODAL -->
    <div class="modal fade" id="modal-map" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-map">
                <div class="modal-header">
                    <h5 class="modal-title">Map</h5>
                    <button type="button" class="btn-close" onclick="close_map()"></button>
                </div>
                <div class="modal-body" style="height: 500px">
                    <div id="modal-map-content" style="width:100%;height:100%; border-radius: 10px;"></div>
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

            $('#LoginModal').modal('show');
        }
    </script>

    @if ($villa[0]->instant_book == 'yes')
        @include('user.modal.villa.details_reserve')
    @else
        @auth
            @include('user.modal.villa.quick_enquiry')
        @endauth
    @endif

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
    <script src="{{ asset('assets/js/view-villa.js') }}"></script>
    <script src="{{ asset('assets/js/crud-villa.js') }}"></script>
    <script src="{{ asset('assets/js/simpleLightbox.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- SweetAlert JS --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- Like --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like --}}

    <script>
        var $gallery;
        $(document).ready(function() {
            $gallery = new SimpleLightbox('.gallery a', {});
            // var $gallery2 = new SimpleLightbox('.gallery2 a', {});
        });
    </script>

    {{-- Header List --}}
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

    <script>
        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/homes/search?${suburl}`;
        }
    </script>

    <script>
        function villaFilter() {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sCheck_inFormInput = $("input[name='sCheck_in']").val();
            var sCheck_outFormInput = $("input[name='sCheck_out']").val();
            var sAdultFormInput = $("input[name='sAdult']").val();
            var sChildFormInput = $("input[name='sChild']").val();

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
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);
            setCookie2("sAdult", sAdultFormInput, 1);
            setCookie2("sChild", sChildFormInput, 1);

            var subUrl =
                `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            villaRefreshFilter(subUrl);
        }
    </script>
    {{-- End Header List --}}

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
                url: '/villa/update/photo/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    imageids: imageids_arr,
                    id: '{{ $villa[0]->id_villa }}'
                },
                success: function(response) {
                    console.log(response);

                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });

                    let path = "/foto/gallery/";
                    let slash = "/";
                    let uid = response.data.uid.uid;
                    let lowerCaseUid = uid.toLowerCase();
                    let content = "";
                    let contentPositionModal = "";

                    // let galleryDiv = $('.gallery');
                    // let galleryLength = galleryDiv.find('a').length;

                    // if (galleryLength == 0)
                    // {
                    //     $('.gallery').html("");
                    // }


                    for (let i = 0; i < response.data.photo.length; i++) {
                        content += '<div class="col-4 grid-photo" id="displayPhoto' +
                            response.data.photo[i].id_photo +
                            '"> <a href="' +
                            path + lowerCaseUid + slash + response.data.photo[i].name +
                            '"> <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery" src="' +
                            path + lowerCaseUid + slash + response.data.photo[i].name +
                            '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-photo="' +
                            response.data.photo[i].id_photo +
                            '" onclick="delete_photo_photo(this)"><i class="fa fa-trash"></i></button> </span> </div>';

                        contentPositionModal += '<li class="ui-state-default" data-id="' + response.data.photo[
                                i].id_photo + '" id="positionPhotoGallery' + response.data.photo[i].id_photo +
                            '"> <img src="' +
                            path + lowerCaseUid + slash + response.data.photo[i].name +
                            '" title="' + response.data.photo[i].name + '"> </li>';
                    }

                    if (response.data.video.length > 0) {
                        for (let v = 0; v < response.data.video.length; v++) {
                            content += '<div class="col-4 grid-photo" id="displayVideo' + response.data.video[v]
                                .id_video +
                                '"> <a class="pointer-normal" onclick="view(' + response.data.video[v]
                                .id_video +
                                ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                                path + lowerCaseUid + slash + response.data.video[v].name +
                                '#t=5.0"> </video> <span class="video-grid-button"><i class="fa fa-play"></i></span></a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-video="' +
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
                url: '/villa/update/video/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    videoids: videoids_arr,
                    id: '{{ $villa[0]->id_villa }}'
                },
                success: function(response) {
                    console.log(response);

                    iziToast.success({
                        title: "Success",
                        message: response.message,
                        position: "topRight",
                    });

                    let path = "/foto/gallery/";
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
                            '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-photo="' +
                            response.data.photo[i].id_photo +
                            '" onclick="delete_photo_photo(this)"><i class="fa fa-trash"></i></button> </span> </div>';
                    }

                    if (response.data.video.length > 0) {
                        for (let v = 0; v < response.data.video.length; v++) {
                            content += '<div class="col-4 grid-photo" id="displayVideo' + response.data.video[v]
                                .id_video +
                                '"> <a class="pointer-normal" onclick="view(' + response.data.video[v]
                                .id_video +
                                ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                                path + lowerCaseUid + slash + response.data.video[v].name +
                                '#t=5.0"> </video> <span class="video-grid-button"><i class="fa fa-play"></i></span></a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-video="' +
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
        function contactHostForm() {
            $('#modal-contact-host').modal('show');
        }

        function view_subcategory() {
            $('#modal-subcategory').modal('show');
        }

        function view_tags_villa() {
            $('#modal-tags-villa').modal('show');
        }
    </script>

    {{-- DROPZONE JS --}}
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        // Dropzone.autoDiscover = false;
        Dropzone.options.frmTarget = {
            autoProcessQueue: false,
            url: '/villa/update/photo',
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
                    var value = $('form#formData #id_villa').val();
                    formData.append('id_villa', value);
                });

                this.on('queuecomplete', function() {
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

                console.log(message);

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

                let path = "/foto/gallery/";
                let slash = "/";
                let uid = message.data.uid.uid;
                let lowerCaseUid = uid.toLowerCase();
                let content = "";
                let contentPositionModal;
                let contentPositionModalVideo;
                let contentStory = "";

                let modalPhotoLength = $('#sortable-photo').find('li').length;
                let modalVideoLength = $('#sortable-video').find('li').length;

                if (modalPhotoLength == 0) {
                    $("#sortable-photo").html("");
                }

                if (modalVideoLength == 0) {
                    $('#sortable-video').html("");
                }

                let galleryDiv = $('.gallery');
                let galleryLength = galleryDiv.find('a').length;

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
                        '"> </a> <span class="edit-icon"> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Photo Position') }}" type="button" onclick="position_photo()"><i class="fa fa-arrows"></i></button> <button data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Delete Photo') }}" href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-photo="' +
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
                        '"> <a class="pointer-normal" onclick="view(' + message.data.video[0].id_video +
                        ')" href="javascript:void(0);"> <video href="javascript:void(0)" class="photo-grid" loading="lazy" src="' +
                        path + lowerCaseUid + slash + message.data.video[0].name +
                        '#t=5.0"> </video> <span class="video-grid-button"><i class="fa fa-play"></i></span></a> <span class="edit-video-icon"> <button type="button" onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ __('user_page.Swap Video Position') }}"><i class="fa fa-arrows"></i></button> <button href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-video="' +
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
                        '"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view(' +
                        message.data.video[0].id_video +
                        ')"> <div class="story-video-player"><i class="fa fa-play"></i> </div> <video href="javascript:void(0)" class="story-video-grid" loading="lazy" style="object-fit: cover;" src="' +
                        path +
                        lowerCaseUid +
                        slash +
                        message.data.video[0].name +
                        '#t=1.0"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                        id_villa +
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
    {{-- END DROPZONE JS --}}

    <script>
        // Semi Fixed
        $(document).ready(function() {
            var $window = $(window);
            var $sidebar = $("#sidebar_fix");
            var $availabilityTop = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
                '#sidebar_fix .reserve-block').height() + parseInt($('#sidebar_fix .reserve-block').css(
                "top")) - parseInt($('.div-amenities').css("margin-bottom")) - 15);

            //console.log($footerOffsetTop);
            $window.on("resize", function() {
                $availabilityTop = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
                    '#sidebar_fix .reserve-block').height() + parseInt($(
                    '#sidebar_fix .reserve-block').css("top")) - parseInt($('.div-amenities').css(
                    "margin-bottom")) - 15);
            });

            $window.scroll(function() {
                $availabilityTop = ($('#amenities').offset().top + $('#amenities').outerHeight()) - ($(
                    '#sidebar_fix .reserve-block').height() + parseInt($(
                    '#sidebar_fix .reserve-block').css("top")) - parseInt($('.div-amenities').css(
                    "margin-bottom")) - 15);
                if ($window.scrollTop() >= 0 && $window.scrollTop() < $availabilityTop) {
                    $sidebar.addClass("fixed");
                    $sidebar.css({
                        "top": "0",
                    });
                } else {
                    $sidebar.css({
                        "top": $availabilityTop - 10,
                        "position": "absolute"
                    });
                    $sidebar.removeClass("fixed");
                }
            });
        });
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
        // Collapsable

        var coll = document.getElementsByClassName("collapsible2");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
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
        // Collapsable

        var coll = document.getElementsByClassName("collapsible_check");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = document.getElementById('popup_check');
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
        // Collapsable

        var coll = document.getElementsByClassName("collapsible_check2");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = document.getElementById('popup_check2');
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
        function adult_increment() {
            document.getElementById('adult2').stepUp();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) + parseInt(
                document.getElementById('child2').value);
            document.getElementById('total_guest3').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest5').value = document.getElementById('total_guest2').value;
            document.getElementById('adult3').value = document.getElementById('adult2').value;
            document.getElementById('adult4').value = document.getElementById('adult2').value;
            document.getElementById('adult5').value = document.getElementById('adult2').value;
            document.getElementById('adult_va').value = document.getElementById('adult2').value;
        }

        function adult_decrement() {
            document.getElementById('adult2').stepDown();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest3').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest5').value = document.getElementById('total_guest2').value;
            document.getElementById('adult3').value = document.getElementById('adult2').value;
            document.getElementById('adult4').value = document.getElementById('adult2').value;
            document.getElementById('adult5').value = document.getElementById('adult2').value;
            document.getElementById('adult_va').value = document.getElementById('adult2').value;
        }

        function child_increment() {
            document.getElementById('child2').stepUp();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest3').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest5').value = document.getElementById('total_guest2').value;
            document.getElementById('child3').value = document.getElementById('child2').value;
            document.getElementById('child4').value = document.getElementById('child2').value;
            document.getElementById('child5').value = document.getElementById('child2').value;
            document.getElementById('child_va').value = document.getElementById('child2').value;
        }

        function child_decrement() {
            document.getElementById('child2').stepDown();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest3').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('total_guest5').value = document.getElementById('total_guest2').value;
            document.getElementById('child3').value = document.getElementById('child2').value;
            document.getElementById('child4').value = document.getElementById('child2').value;
            document.getElementById('child5').value = document.getElementById('child2').value;
            document.getElementById('child_va').value = document.getElementById('child2').value;
        }

        function infant_increment() {
            document.getElementById('infant2').stepUp();
            document.getElementById('infant3').value = document.getElementById('infant2').value;
            document.getElementById('infant4').value = document.getElementById('infant2').value;
            document.getElementById('infant5').value = document.getElementById('infant2').value;
        }

        function infant_decrement() {
            document.getElementById('infant2').stepDown();
            document.getElementById('infant3').value = document.getElementById('infant2').value;
            document.getElementById('infant4').value = document.getElementById('infant2').value;
            document.getElementById('infant5').value = document.getElementById('infant2').value;
        }

        function pet_increment() {
            document.getElementById('pet2').stepUp();
            document.getElementById('pet3').value = document.getElementById('pet2').value;
            document.getElementById('pet4').value = document.getElementById('pet2').value;
            document.getElementById('pet5').value = document.getElementById('pet2').value;
        }

        function pet_decrement() {
            document.getElementById('pet2').stepDown();
            document.getElementById('pet3').value = document.getElementById('pet2').value;
            document.getElementById('pet4').value = document.getElementById('pet2').value;
            document.getElementById('pet5').value = document.getElementById('pet2').value;
        }
    </script>

    {{-- Highlight sticky --}}
    <script>
        jQuery(document).ready(function($) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() >= $('#gallery').offset().top - 80 && $(window).scrollTop() <= $(
                        '#description').offset().top - 60) {
                    $('#gallery-sticky').addClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                } else if ($(window).scrollTop() >= $('#description').offset().top - 60 && $(window)
                    .scrollTop() <= $('#availability').offset().top - 60) {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').addClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                } else if ($(window).scrollTop() >= $('#availability').offset().top - 60 && $(window)
                    .scrollTop() <= $('#amenities').offset().top - 60) {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').addClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                } else if ($(window).scrollTop() >= $('#amenities').offset().top - 60 && $(window)
                    .scrollTop() <= $('#location-map').offset().top - 60) {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').addClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                } else if ($(window).scrollTop() >= $('#location-map').offset().top - 60 && $(window)
                    .scrollTop() <= $('#review').offset().top - 60) {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').addClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                } else if ($(window).scrollTop() >= $('#review').offset().top - 60 && $(window)
                    .scrollTop() <= $('#endSticky').offset().top - 60) {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').addClass('active-sticky');
                } else {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#availability-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                    //or use $('.menu').removeClass('addclass');
                }
            });
        });
    </script>

    {{-- Sweetalert Function Delete Story --}}
    <script>
        function delete_story(ids) {
            let id = ids.getAttribute("data-villa");
            let story = ids.getAttribute("data-story")

            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7400',
                cancelButtonColor: '#000',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/villa/${id}/delete/story/${story}`,
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message, 'error');
                            }
                        },
                        success: async function(data) {
                            await Swal.fire('Deleted', data.message, 'success');
                            $(`#displayStory${story}`).remove();

                            //update slider ketika story dihapus
                            sliderRestaurant();
                        }
                    });
                } else {
                    Swal.fire(`{{ __('user_page.Cancel') }}`, `{{ __('user_page.Canceled Deleted Data') }}`,
                        'error')
                }
            });
        };
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
                confirmButtonColor: '#ff7400',
                cancelButtonColor: '#000',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: '/villa/${ids.id}/delete/image',
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message, 'error');
                            }
                        },
                        success: async function(data) {
                            // console.log(data.message);
                            await Swal.fire('Deleted', data.message, 'success');
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

    {{-- Sweetalert Function Delete Photo Gallery --}}
    {{-- blade-formatter-disable --}}
    <script>
        function delete_photo_photo(ids) {
            let id = ids.getAttribute("data-id");
            let photo = ids.getAttribute("data-photo");
            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7400',
                cancelButtonColor: '#000',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/villa/${id}/delete/photo/photo/${photo}`,
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message, 'error');
                            }
                        },
                        success: async function(response) {
                            await Swal.fire('Deleted', response.message, 'success');
                            $(`#displayPhoto${photo}`).remove();
                            $("#positionPhotoGallery"+photo).remove();

                            let galleryDiv = $('.gallery');
                            let galleryLength = galleryDiv.find('a').length;

                            if (galleryLength == 0)
                            {
                                $('.gallery').html("");
                                $('.gallery').html('{{ __('user_page.there is no gallery yet') }}');
                            }

                            $gallery.refresh();
                        }
                    });
                } else {
                    Swal.fire(`{{ __('user_page.Cancel') }}`, `{{ __('user_page.Canceled Deleted Data') }}`,
                        'error')
                }
            });
        };
    </script>
    {{-- blade-formatter-enable --}}

    {{-- Sweetalert Function Delete Video Gallery --}}
    <script>
        function delete_photo_video(ids) {
            let id = ids.getAttribute("data-id");
            let video = ids.getAttribute("data-video");

            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7400',
                cancelButtonColor: '#000',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/villa/${id}/delete/photo/video/${video}`,
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message, 'error');
                            }
                        },
                        success: async function(data) {
                            // console.log(data.message);
                            await Swal.fire('Deleted', data.message, 'success');
                            $("#displayVideo" + video).remove();
                            $("#positionVideoGallery" + video).remove();
                            $("#displayStoryVideo" + video).remove();

                            let galleryDiv = $('.gallery');
                            let galleryLength = galleryDiv.find('a').length;

                            if (galleryLength == 0) {
                                $('.gallery').html("");
                                $('.gallery').html('{{ __('user_page.there is no gallery yet') }}');
                            }

                            sliderRestaurant();
                        }
                    });
                } else {
                    Swal.fire(`{{ __('user_page.Cancel') }}`, `{{ __('user_page.Canceled Deleted Data') }}`,
                        'error')
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
                confirmButtonText: `{{ __('user_page.Yes, Request it') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/villa/request/video/${ids.id}/${ids.name}`,
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

    {{-- View Maps Villa --}}
    <script>
        async function view_map(id) {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: '/villa/map/${id}',
                statusCode: {
                    500: () => {
                        alert(`{{ __('user_page.internal server error') }}`);
                    },
                    404: () => {
                        alert(`{{ __('user_page.No data found') }}`);
                    },
                },
                success: async function(data) {
                    // declare map
                    var map = new google.maps.Map(document.getElementById('modal-map-content'), {
                        zoom: 15,
                        scrollwheel: true,
                        draggable: true,
                        gestureHandling: "greedy",
                        center: new google.maps.LatLng(data.latitude, data.longitude),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "on"
                                }]
                            },
                            {
                                "featureType": "transit.station.airport",
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            }
                        ]
                    });

                    // add marker to map
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(data.latitude, data.longitude),
                        map: map,
                        icon: {
                            url: 'http://maps.google.com/mapfiles/kml/paddle/orange-circle.png',
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(35, 35)
                        }
                    });

                    // add open google maps
                    var gotoMapButton = document.createElement("div");
                    gotoMapButton.setAttribute("style",
                        "margin: 5px; border: 1px solid; padding: 1px 12px; font: bold 11px Roboto, Arial, sans-serif; color: #000000; background-color: #FFFFFF; cursor: pointer;"
                    );
                    gotoMapButton.innerHTML = "Open Google Maps";
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gotoMapButton);
                    google.maps.event.addDomListener(gotoMapButton, "click", function() {
                        var url =
                            'https://maps.google.com/?q=${data.latitude},${data.longitude}';
                        window.open(url);
                    });
                    $("#modal-map").modal('show');
                }
            });
        }

        function close_map() {
            $("#modal-map").modal('hide');
        }
    </script>

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
    <script>
        function language() {
            $('#LegalModal').modal('show');
            $('#trigger-tab-language').addClass('active');
            $('#content-tab-language').addClass('active');
            $('#trigger-tab-currency').removeClass('active');
            $('#content-tab-currency').removeClass('active');
        }

        function currency() {
            $('#LegalModal').modal('show');
            $('#trigger-tab-language').removeClass('active');
            $('#content-tab-language').removeClass('active');
            $('#trigger-tab-currency').addClass('active');
            $('#content-tab-currency').addClass('active');
        }

        function displayTags() {
            $('#ModalTagsVilla').modal('show');
        }

        function editCategoryVilla() {
            $('#ModalCategoryVilla').modal('show');
        }
    </script>

    @if ($villa[0]->status == '2' && auth()->user()->id == $villa[0]->created_by)
        <script>
            if (!localStorage.getItem("shareAdver") || localStorage.getItem("shareAdver") != 'true') {
                var myModal = new bootstrap.Modal(document.getElementById('advertListing-Modal'), {})
                myModal.show()
            }
        </script>
    @endif

    <script>
        $.ajax({
            url: "/houserules/post",
            method: "POST",
            data: {
                '_token': $('input[name=_token]').val(),
                'children': children,
                id: '{{ $villa[0]->id_villa }}'
            },
            success: function(data) {
                // console.log(data);
                jQuery('.alert').show();
                jQuery('.alert').html(data.success);
            }
        });
    </script>

    {{-- validation --}}
    <script>
        $("#form_reserve1").validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
                "check_in": {
                    required: !0
                },
            },
            messages: {
                "name": {
                    required: "Please enter dates",
                },
            }
        });
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

    @include('components.lazy-load.lazy-load')
    @include('components.promotion.mobile-app')
    <script src="{{ asset('assets/js/translate.js') }}"></script>

    {{-- Copy current URL to clipboard --}}
    <script>
        function copyURI() {
            navigator.clipboard.writeText(location.origin + location.pathname).then(() => {
                alert("Link copied");
            }, () => {
                alert("Oooppsss... failed");
            });
        }
    </script>

    {{-- Request Active Deactive --}}
    <script>
        function requestActivation() {
            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/villa/update/request-update-status`,
                data: {
                    id_villa: id_villa
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
                        url: `/admin/villa/update-status/${id_villa}`,
                        data: {
                            grade: grade
                        },
                        success: function(response) {
                            if (response.data == 1) {
                                if (response.grade == "AA") {
                                    $("#adminVilla2").html(`
                                        <div class="alert alert-success d-flex flex-row align-items-center"
                                            role="success">
                                            <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                            <div style="margin-left: 10px;">
                                                <select class="custom-select grade-success" name="grade"
                                                    id="gradeVillaAA">
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
                                    $("#adminVilla2").html(`
                                        <div class="alert alert-success d-flex flex-row align-items-center"
                                            role="success">
                                            <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                            <div style="margin-left: 10px;">
                                                <select class="custom-select grade-success" name="grade"
                                                    id="gradeVillaA">
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
                                    $("#adminVilla2").html(`
                                        <div class="alert alert-success d-flex flex-row align-items-center"
                                            role="success">
                                            <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                            <div style="margin-left: 10px;">
                                                <select class="custom-select grade-success" name="grade"
                                                    id="gradeVillaB">
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
                                    $("#adminVilla2").html(`
                                        <div class="alert alert-success d-flex flex-row align-items-center"
                                            role="success">
                                            <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                            <div style="margin-left: 10px;">
                                                <select class="custom-select grade-success" name="grade"
                                                    id="gradeVillaC">
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
                                    $("#adminVilla2").html(`
                                        <div class="alert alert-success d-flex flex-row align-items-center"
                                            role="success">
                                            <span>{{ __('user_page.this content is active, edit grade villa') }}</span>
                                            <div style="margin-left: 10px;">
                                                <select class="custom-select grade-success" name="grade"
                                                    id="gradeVillaD">
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
                url: `/villa/update/request-update-status`,
                data: {
                    id_villa: id_villa
                },
                success: function(response) {
                    if (response.data == 3) {
                        $("#activation1").html(`
                            <div class="alert alert-warning d-flex flex-row align-items-center"
                                role="warning">
                                <span>{{ __('user_page.you have been request deactivation for this content,') }}
                                </span>
                                <button class="btn"
                                    type="submit" onclick="cancelDeactivation()>{{ __('user_page.cancel deactivation') }}</button>
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
                url: `/villa/update/cancel-request-update-status`,
                data: {
                    id_villa: id_villa
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
    </script>
    {{-- End Active Deactive --}}

    <script>
        if (document.getElementById("check_in").value.length == 0) {
            document.getElementById("addDates").classList.remove("d-none");
        }

        function addDatesFunction() {
            document.getElementById('availability').scrollIntoView();

            iziToast.warning({
                title: "Caution",
                message: "Please add Check In and Check Out Date",
                position: "topRight",
            });
        }
    </script>
</body>

</html>
