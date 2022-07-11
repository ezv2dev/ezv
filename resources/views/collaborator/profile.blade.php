<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ $user->first_name }} {{ $user->last_name }} - EZV2</title>

    <meta name="description" content="EZV2 ">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

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
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/errorToString.js') }}"></script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .video-position {
            position: relative;
            left: 0;
            top: 0;
        }

        .radius-5 {
            border-radius: 5px;
        }

        .rsv-block {
            padding-left: 0px;
            padding-right: 5px;
        }

        .pd-0 {
            padding: 0px;
        }

        .pd-tlr-10 {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .profile-info {
            padding-left: 40px;
        }

        .right-0 {
            padding-right: 0px;
        }

        .about-place {
            padding-top: 12px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .header-mobile {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 0 30px;
        }

        .header-mobile a {
            color: #000;
        }

        .mobile-social-share {
            margin: -15px auto;
            border: solid 1px #8a8a8a;
            padding: 10px;
            border-radius: 15px;
            height: 50px;
        }

        .mobile-social-share p {
            font-size: 10px;
            color: #000;
        }

        .mobile-social-share span,
        .mobile-social-share i {
            display: block;
            text-align: center;
            color: #ff7400;
        }

        .location-font-size i {
            font-size: 12px;
        }

        .amenities-detail-view {
            display: flex;
        }

        #description-content {
            text-align: justify;
        }

        .navigationItem span:hover {
            color: #ff7400;
        }

        .review-bottom {
            margin: 10px 10px 10px 0;
        }

        .host-profile img {
            border-radius: 50%;
            width: 80px;
            margin-left: 20px;
            height: 80px;
        }

        .related-items h6 {
            padding: 20px 0 20px 0;
            display: block;
            text-align: left;
            margin-left: 55px;
            font-family: 'Poppins', san-serif;
            font-weight: 400;
        }

        @media only screen and (max-width: 480px) {
            .related-items h6 {
                padding: 20px 0 20px 0;
                display: block;
                text-align: center;
                font-family: 'Poppins', san-serif;
                font-weight: 400;
            }
        }

        .delete {
            right: 16px;
            margin-left: -27px;
            top: 16px;
            position: relative;
        }

        .delete i {
            background: #000;
            height: 23px;
            width: 23px;
            color: #fff;
            padding: 3px;
            text-align: center;
            border-radius: 3px;
        }

        .delete i:hover {
            background: #ff7400;
        }

        .mob-e-call {
            display: none;
        }

        .mobile-price .price-box a {
            color: #000;
            text-decoration: underline;
        }

        /* Responshive 480 px > */
        @media only screen and (max-width: 480px) {

            .modal-dialog {
                top: 33%;
            }

            .host-review {
                font-size: 12px;
                margin-left: 110px;
            }

            .delete {
                right: 6px;
                margin-left: -23px;
                top: 10px;
                position: relative;
            }

            .desk-e-call {
                display: none;
            }

            .mob-e-call {
                display: block;
            }

            .video-player {
                font-size: 12px;
                margin-left: 11px;
                margin-top: 11px;
            }

            .related-properties {
                width: 95.9%;
            }

            .photosGrid__Photo {
                width: calc(33.5% - 1px);
                height: 30vw;
                margin-bottom: 0;
                margin-left: 0;
                margin-right: 0;
                border-top: solid 1px #000;
                box-shadow: none;
                border-radius: 5px;
                border-left: solid 1px #000;
                border-right: 0;
                border-bottom: 0;
            }

            #gallery {
                background: #000;
                padding-top: 0px !important;
                border-bottom: solid 1px #000;
            }

            .video-button {
                margin-left: 55px !important;
                margin-top: 45px !important;
                font-size: 12px;
                padding: 8px;
            }

            video.photosGrid__Photo {
                width: 100%;
                margin-top: 0;
            }

            .video-grid {
                width: calc(33.5% - 1px);
                height: 113px;
                margin-right: 0;
                margin-top: -1px;
            }

            .extra-info p {
                margin-right: 20px;
            }

            .page-content {
                margin-top: 0;
                padding: 0;
            }

            .profile-image {
                margin-right: 0;
            }

            .location-font-size {
                font-size: 22px;
                margin-top: 22px;
                margin-bottom: 20px !important;
            }

            .location-font-size i {
                font-size: 18px;
            }

            .profile-info h2 {
                font-weight: 600;
                font-size: 20px;
                margin-bottom: 8px;
            }

            .profile-info p {
                font-size: 14px;
                color: #666464;
                margin-bottom: -15px;
            }

            .short-desc {
                min-height: auto;
            }

            #navbar {
                margin: 0;
                height: 60px;
            }

            .navigationItem span {
                display: none;
            }

            .story-video-grid {
                width: 65px;
                height: 65px;
                margin-left: 5px;
                border-radius: 50%;
                border: solid 1px #a4a4a4;
                padding: 2px;
                box-shadow: 1px 1px 5px #a4a4a4;
                position: relative;
            }

            .story-video-player,
            .video-player {
                left: 33px;
                top: 23px;
            }

            .inner-wrap {
                margin-left: -10px;
            }

            .cards3 {
                width: 335px;
                margin-left: 10px;
            }

            .card3 {
                width: 60px;
            }

            .card4 {
                margin-right: -10px;
            }

            .containerSlider3 {
                padding: 0;
                margin-top: 0;
                width: 334px;
                margin-left: -19px;
            }

            @-moz-document url-prefix() {
                .containerSlider3 {
                    margin-left: 0;
                }
            }


            .containerSlider4 {
                width: 283px;
            }

            .video-title {
                top: 44px;
                left: 0;
                font-weight: 400;
                font-size: 14px;
                font-family: 'Poppins', sans-serif;
            }

            /* calendar */

            span.flatpickr-weekday {
                width: 51px;
            }

            .flatpickr-container .flatpickr-days {
                width: 380px !important;
            }

            .flatpickr-day {
                max-width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .dayContainer {
                min-width: 388px;
            }

            .flatpickr-current-month {
                font-size: 100%;
            }

            .flatpickr-months .flatpickr-prev-month,
            .flatpickr-months .flatpickr-next-month {
                top: -8px;
            }

            .flatpickr-container .flatpickr-weekdays {
                margin-bottom: 0;
            }

            .flatpickr-months .flatpickr-month {
                height: 44px;
            }

            /* end calendar */

            #review {
                padding-left: 0;
                margin-top: 200px;
            }

            .member-profile {
                top: 14px;
                left: 56px;
                position: relative;
            }

            .rsv-block {
                margin-bottom: -210px;
            }

            .review-bottom {
                margin: 0 0 0 10px;
            }

            .section .host {
                margin-top: -50px;
            }

            .mfp-arrow-left {
                left: 200px;
                margin-left: -190px;
                width: max-content !important;
            }

            .mfp-arrow-right {
                right: 15px;
            }
        }

        /* Responshive above 480 px */
        @media screen and (min-width: 481px) {
            .header-mobile {
                display: none;
            }
        }

        .active-sticky span,
        .active-sticky {
            color: #ff7400;
        }
    </style>

    {{-- style reorder image --}}
    <style>
        #sortable-photo {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable-photo li {
            padding: 2px;
            display: table;
            width: 16.66666667%;
            float: left;
            border: 0;
            background: none;
        }

        #sortable-photo li img {
            width: 100%;
            height: 140px;
            border-radius: 15px;
        }
    </style>
    {{-- /reorder image --}}

    {{-- style reorder video --}}
    <style>
        #sortable-video {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable-video li {
            padding: 2px;
            display: table;
            width: 16.66666667%;
            float: left;
            border: 0;
            background: none;
        }

        #sortable-video li video {
            width: 100%;
            height: 140px;
            border-radius: 15px;
            object-fit: cover;
        }
    </style>
    {{-- /reorder video --}}
</head>

<body style="background-color:white">
    @include('components.notification.notification')
    @component('components.loading.loading-type1')
    @endcomponent

    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="head-inner-wrap">
                @include('layouts.user.header_collab')
            </div>
        </header>
        {{-- END HEADER --}}

        {{-- STICKY BOTTOM FOR MOBILE --}}
        <div class="sticky-bottom-mobile d-xs-block d-md-none">
            <input class="price-button" onclick="reserve2()"
                style="box-shadow: 1px 1px 10px #a4a4a4; text-align:center; cursor: pointer !important;"
                value="CONTACT NOW" readonly>
            <span
                class="price"><strong>{{ CurrencyConversion::exchangeWithUnit($profile->price) }}</strong>/day</span>
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
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                        class="user-photo" alt="" style="border-radius: 50%">
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
                                <p class="mb-0 ms-2" style="color: #585656">Choose Language</p>
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
                            <a onclick="loginForm()" class="btn btn-fill border-0 navbar-gap d-flex align-items-center"
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
                            <p class="mb-0 ms-2" style="color: #585656">Choose Language</p>
                        </a>
                    </div>
                @endauth
            </div>

        </div>

        {{-- PROFILE --}}
        <div class="row page-content">
            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block alert-detail">
                {{-- ALERT CONTENT STATUS --}}
                @auth
                    @if (auth()->user()->id == $profile->created_by)
                        @if ($profile->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>this content is deactive, </span>
                                <form action="{{ route('collab_request_update_status', $profile->id_collab) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                                    <button class="btn" type="submit">request activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($profile->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>this content is active, </span>
                                <form action="{{ route('collab_request_update_status', $profile->id_collab) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                                    <button class="btn" type="submit">request deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($profile->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request activation for this content, </span>
                                <form action="{{ route('collab_cancel_request_update_status', $profile->id_collab) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                                    <button class="btn" type="submit">cancel activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($profile->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request deactivation for this content, </span>
                                <form action="{{ route('collab_cancel_request_update_status', $profile->id_collab) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                                    <button class="btn" type="submit">cancel deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($profile->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                this content is deactive
                            </div>
                        @endif
                        @if ($profile->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>{{ Translate::translate('this content is active, edit grade collaborator') }}</span>

                                <form action="{{ route('collab_update_grade', $profile->id_collab) }}" method="post">
                                    @csrf
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade-success" name="grade"
                                            onchange='this.form.submit()'>
                                            <option value="AA" {{ $profile->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $profile->grade == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $profile->grade == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ $profile->grade == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ $profile->grade == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                        <noscript><input type="submit" value="Submit"></noscript>
                                    </div>
                                </form>

                            </div>
                        @endif
                        @if ($profile->status == '2')
                            <div class="alert alert-warning d-flex justify-content-start" role="warning">
                                <span>{{ Translate::translate('the owner request activation, choose grade collaborator') }}
                                </span>
                                <form action="{{ route('admin_collab_update_status', $profile->id_collab) }}"
                                    method="get" class="d-flex">
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade" name="grade">
                                            <option value="AA" {{ $profile->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $profile->grade == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ $profile->grade == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ $profile->grade == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ $profile->grade == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                    </div>
                                    <span style="margin-left: 10px;">and</span>
                                    <button class="btn" type="submit"
                                        style="margin-top: -7px;">{{ Translate::translate('activate this content') }}</button>
                                </form>
                            </div>
                        @endif
                        @if ($profile->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request deactivation, </span>
                                <form action="{{ route('admin_collab_update_status', $profile->id_collab) }}"
                                    method="get">
                                    <button class="btn" type="submit">deactivate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                @endauth
                {{-- END ALERT CONTENT STATUS --}}

                <div class="row top-profile" id="first-detail-content">
                    <div class="col-lg-4- col-md-4 col-xs-12 pd-0">
                        <div class="profile-image">
                            @if ($profile->image)
                                <img
                                    src="{{ URL::asset('/foto/collaborator/' . strtolower($profile->id_collab) . '/' . $profile->image) }}">
                            @else
                                <img src="{{ URL::asset('/template/collabs/template-profile.webp') }}">
                            @endif

                            @auth
                                @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_collab_profile()" class="edit-collab-profile-btn-dekstop"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth

                            <div class="collab-joined-in-dekstop">
                                <p>
                                    <i class="fa fa-users-rectangle" style="color: #ff7400"></i>
                                    Joined in {{ date_format($user->created_at, 'M Y') }}
                                </p>
                            </div>
                            {{-- SHORT NAME FOR MOBILE --}}
                            <div class="name-content-mobile ms-3 d-md-none">
                                <h2 id="name-content-mobile">{{ $user->first_name }} {{ $user->last_name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12 profile-info">
                        <h2 id="name-content">{{ $user->first_name }} {{ $user->last_name }}
                            @auth
                                @if (Auth::user()->id == $profile->created_by)
                                    &nbsp;<a type="button" onclick="editNameForm()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $profile->created_by)
                                <div id="name-form" style="display:none;">
                                    <form action="{{ route('collab_update_name') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}" required>
                                        <textarea style="width: 100%;" name="name" id="name-form-input" cols="30" rows="3" maxlength="255" required>{{ $user->first_name }} {{ $user->last_name }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            style="background-color: #ff7400">
                                            <i class="fa fa-check"></i> Done
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary" onclick="editNameCancel()">
                                            <i class="fa fa-xmark"></i> Cancel
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        {{-- verified and rating --}}
                        <p style="margin-bottom:10px"><i class="fa-solid fa-star" style="color: #ff7400"></i> 190
                            Reviews | <i class="fa-solid fa-circle-check" style="color: #ff7400"></i> Identity verified
                        </p>
                        {{-- verified and rating --}}

                        {{-- category --}}
                        <p class="text-secondary" style="margin-bottom: 10px;">
                            @if ($tags->count() > 3)
                                @for ($i = 0; $i < 3; $i++)
                                    <span class="badge rounded-pill fw-normal"
                                        style="background-color: #FF7400;">{{ $tags[$i]->name }}</span>
                                @endfor
                                <button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button"
                                    onclick="view_tag()">More</button>
                            @else
                                @forelse ($tags as $tag)
                                    <span class="badge rounded-pill fw-normal"
                                        style="background-color: #FF7400;">{{ $tag->name }}</span>
                                @empty
                                    there is no category yet
                                @endforelse
                            @endif
                            @auth
                                @if (Auth::user()->id == $profile->created_by)
                                    &nbsp;<a type="button" onclick="add_tag()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        {{-- category --}}

                        {{-- location --}}
                        <p style="margin-bottom:10px"><i class="fa fa-map-marker-alt" style="color: #ff7400"></i>
                            {{ $profile->name_location }}
                            @auth
                                @if (Auth::user()->id == $profile->created_by)
                                    &nbsp;<a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        {{-- location --}}

                        {{-- language --}}
                        <p style="margin-bottom:10px">Language :
                            @foreach ($owner_language as $collab_language)
                                <img src="{{ URL::asset('assets/flags/' . $collab_language->language->flag) }}"
                                    style="width: 27px; border:0.1px solid grey;">&nbsp;
                            @endforeach
                            @auth
                                @if (Auth::user()->id == $profile->created_by)
                                    &nbsp;<a type="button" onclick="edit_collab_language()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        {{-- language --}}

                        <ul class="stories inner-wrap">
                            @auth
                                @if (Auth::user()->id == $profile->created_by)
                                    @if ($stories->count() == 0)
                                        <li class="story">
                                            <div class="img-wrap">
                                                <a type="button" onclick="edit_story()">
                                                    <img src="{{ URL::asset('assets/add_story.png') }}">
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        @if ($stories->count() < 100)
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img src="{{ URL::asset('assets/add_story.png') }}">
                                                    </a>
                                                </div>
                                            </li>
                                            <div class="containerSlider4">
                                                <div id="slide-left-container4">
                                                    <div class="slide-left4">
                                                    </div>
                                                </div>
                                                <div id="cards-container4">
                                                    <div class="cards4">
                                                        @foreach ($stories as $item)
                                                            <div class="card4 col-lg-3 radius-5">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        <a type="button"
                                                                            onclick="view_story({{ $item->id_story }});">
                                                                            <div class="story-video-player"><i
                                                                                    class="fa fa-play"></i>
                                                                            </div>
                                                                            <video preload href="" class="story-video-grid"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="delete_story({'id': `{{ $profile->id_collab }}`, 'id_story': `{{ $item->id_story }}`})">
                                                                                    <i class="fa fa-trash"
                                                                                        style="color:red; margin-left: 25px;"
                                                                                        data-bs-toggle="popover"
                                                                                        data-bs-animation="true"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Delete"></i>
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
                                                        <div class="video-position" style="width: 70px; height: 70px;">
                                                            <a type="button"
                                                                onclick="view_story({{ $item->id_story }});"
                                                                style="height: 70px; width: 70px;">
                                                                <div class="story-video-player"><i
                                                                        class="fa fa-play"></i>
                                                                </div>
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}#t=1.0">
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
                    <!-- <div class="col-lg-2 col-md-2 col-xs-12 right-0">
                        <div class="row social-share">
                            <div class="col-6 text-center icon-center">
                                @if ($profile->is_favorit)
                                    <p>
                                        <a href=""><i class="fa fa-heart" style="color: #f00;  font-size: 18px;"></i>
                                            <span>CANCEL</span>
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href=""><i class="fa fa-heart" style="color: #aaa;  font-size: 18px;"></i>
                                            <span style="color: #aaa;">FAVORITE</span>
                                        </a>
                                    </p>
                                @endif
                            </div>
                            <div class="col-6 text-center icon-center">
                                <p type="button" class="expand" onclick="share()">
                                    <i class="fa fa-share" style="font-size: 18px;"></i>
                                    <span>SHARE</span>
                                </p>
                            </div>
                        </div>
                    </div> -->
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
                                    <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    GALLERY</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    ABOUT</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    INFORMATION</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    LOCATION</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    AVAILABILITY</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span class="navigationItemText">&nbsp
                                    REVIEW</span>
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
                    <section id="gallery" class="photosGrid section mb-3">
                    <div class="col-12 row gallery">
                        @if ($photo->count() > 0)

                            @foreach ($photo as $item)
                            <div class="col-4 grid-photo">
                                <a href="{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}"
                                    class="img-lightbox photosGrid__Photo"
                                    style="background-image: url('{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}')">
                                    <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                src="{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}"
                                                title="{{ $item->caption }}">
                                </a>
                                @auth
                                    @if (Auth::user()->id == $profile->created_by)
                                    <span class="edit-icon">


                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" type="button"
                                                        ><i
                                                            class="fa fa-pencil"></i></button>
                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        href="javascript:void(0);"
                                                        type="button" onclick="position_photo()"><i
                                                            class="fa fa-arrows"></i></button>
                                            <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        href="javascript:void(0);"
                                                        onclick="delete_photo_photo({'id': `{{ $profile->id_collab }}`, 'id_photo': `{{ $item->id_photo }}`})"><i
                                                            class="fa fa-trash"></i></button>
                                    </span>
                                    @endif
                                @endauth
                            </div>
                            @endforeach

                        @endif
                        @if ($video->count() > 0)
                            @foreach ($video as $item)
                            <div class="col-4 grid-photo">
                                <a class="video-grid" type="button" onclick="view({{ $item->id_video }});">
                                    <i class="fas fa-2x fa-play video-button"></i>
                                    <video preload href="" class="photosGrid__Photo" style="object-fit: cover;"
                                        src="{{ URL::asset('/foto/collaborator/' . $profile->uid . '/' . $item->name) }}#t=1.0">
                                    </video>
                                </a>
                                @auth
                                    @if (Auth::user()->id == $profile->created_by)
                                        <a class="delete delete-video" href="javascript:void(0);"
                                            onclick="delete_photo_video({'id': `{{ $profile->id_collab }}`, 'id_video': `{{ $item->id_video }}`})"><i
                                                class="fa fa-trash"></i></a>
                                        <a type="button" class="delete" style="left: -40px !important; "
                                            onclick="position_video()"><i class="fa fa-pencil"></i></a>
                                    @endif
                                @endauth
                            </div>
                            @endforeach
                        @endif
                        @if ($photo->count() <= 0 && $video->count() <= 0)
                            there is no gallery yet
                        @endif
                    </div>
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section class="add-gallery" style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                                <form class="dropzone" id="frmTarget">
                                    @csrf
                                    <div class="dz-message" data-dz-message>
                                        <span>{{ __('user_page.Click here to upload your files') }}</span>
                                    </div>
                                    <input type="hidden" value="{{ $profile->id_collab }}" id="id_collab"
                                        name="id_collab">
                                </form>
                                <button type="submit" id="button" class="btn btn-primary">Upload</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    <section id="description" class="section-2">
                        {{-- Description --}}
                        <div class="about-place">
                            <h2>About this influencer</h2>
                            <p id="description-content">
                                {{ $profile->description }}
                                @auth
                                    @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editDescriptionForm()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('collab_update_description') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}"
                                                required>
                                            <div class="form-group">
                                                <textarea value="{{ $profile->description }}" name="description" id="description-form-input" class="w-100"
                                                    rows="5" required>{{ $profile->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i> Done
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary"
                                                    onclick="editDescriptionCancel()">
                                                    <i class="fa fa-xmark"></i> Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            <hr>
                        </div>
                    </section>
                    <section id="amenities" class="section-2">
                        <div class="pd-tlr-10">
                            <h2>
                                Information
                                @auth
                                    @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_amenities()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            {{-- <div class="row">
                                <div class="col-lg-12 col-md-6 col-xs-12">
                                    <div class="row amenities-block">
                                        @foreach ($villa_amenities->take(3) as $item1)
                                        <div class="col-4 amenities-detail-view">
                                            <i class="fa fa-{{ $item1->icon }}"></i>
                                            <span>{{ $item1->name }}</span>
                                        </div>
                                        @endforeach
                                        @foreach ($bathroom->take(3) as $item2)
                                        <div class="col-4 amenities-detail-view">
                                            <i class="fa fa-{{ $item2->icon }}"></i>
                                            <span>{{ $item2->name }}</span>
                                        </div>
                                        @endforeach
                                        @foreach ($bedroom->take(3) as $item3)
                                        <div class="col-4 amenities-detail-view">
                                            <i class="fa fa-{{ $item3->icon }}"></i>
                                            <span>{{ $item3->name }}</span>
                                        </div>
                                        @endforeach
                                        @foreach ($safety->take(3) as $item4)
                                        <div class="col-4 amenities-detail-view">
                                            <i class="fa fa-{{ $item4->icon }}"></i>
                                            <span>{{ $item4->name }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                            <div class="amenities-box">
                                <button type="button" onclick="view_amenities()">More Information</button>
                            </div>
                            <hr>
                        </div>
                    </section>
                    <section id="location-map" class="section-2">
                        <div class="pd-tlr-10">
                            <div class="d-flex justify-content-between">
                                <h2>
                                    Location
                                    @auth
                                        @if (Auth::user()->id == $profile->created_by)
                                            &nbsp;
                                            <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                                    style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                    data-bs-animation="true" data-bs-placement="bottom"
                                                    title="Edit"></i></a>
                                        @endif
                                    @endauth
                                </h2>
                                <h6 style="color: #FF7400" class="mt-2">Check Location</h6>
                            </div>
                            <input type="hidden" value="{{ $profile->latitude }}" name="latitude" id="latitude">
                            <input type="hidden" value="{{ $profile->longitude }}" name="longitude" id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div>
                        </div>
                    </section>
                    <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div>
                    <section id="availability" class="section-2">
                        <div class="pd-tlr-10">
                            <h2>Availability</h2>

                            <div class="desk-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div id="heightCalendar"
                                        style="display: table; background-color: white; padding: 70px 80px 80px 80px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4; margin-bottom: 25px;">
                                        <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                            class="col-lg-12">
                                            <p style="margin: 0px; font-size: 13px;">Clear Dates</p>
                                        </div>

                                        <div class="flatpickr" id="inline" style="text-align: left;">
                                            {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="scrollStop"></div>
                            <div class="mob-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div class="flatpickr" id="inline2" style="text-align: left;">
                                        {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </section>
                </div>
                {{-- END PAGE CONTENT --}}
                <!--
                <div class="spacer">&nbsp;</div>
                -->
            </div>

            {{-- END LEFT CONTENT --}}
            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div style="position: fixed; top: 9px; margin-right: 12px;" class="sidebar" id="sidebar_fix">
                    <div class="reserve-block">
                        <input type="hidden" id="id_collab" name="id_collab" value="{{ $profile->id_collab }}">
                        @auth
                            @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt"
                                        style="color: #FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @endif
                        @endauth
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                            <div class="row">
                                <div class="col-7">
                                    <p class="price-box">IDR
                                        <span>{{ number_format($profile->price, 0, ',', '.') }}</span>/day
                                    </p>
                                </div>
                                <div class="col-5" style="display: flex; align-items: center;">
                                    <p class="price-box" style="text-align: end;"><i class="fa fa-star"
                                            style="color: orange; font-size:14px"></i>
                                        {{-- @if ($ratting->count() > 0)
                                        {{ $ratting[0]->average }} reviews --}}
                                    </p>
                                    {{-- @endif --}}
                                </div>
                            </div>
                            <div class="reserve-inner-block">
                                <div class="col-12"
                                    style="display: flex; border: 2px solid #FF7400; border-radius: 15px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 1px 10px #a4a4a4">

                                    <div class="col-6 p-5-price line-right-orange">
                                        <div class="col-12" style="text-align: center;">
                                            <button type="button" class="collapsible_check"
                                                style="background-color: white;">
                                                <p style="margin-left: 0px; margin-bottom:0px; font-size: 12px;">
                                                    START-DATE
                                                </p>
                                                <input class=""
                                                    style="font-size: 15px; margin-left: 0px; width:100%; text-align: center; border: none !important; border-color: transparent !important;"
                                                    type="text" id="check_in" name="check_in"
                                                    style="width:80%; border:0" placeholder="Add Date" readonly>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 p-5-price">
                                        <div class="col-12" style="text-align: center;">
                                            <button type="button" class="collapsible_check"
                                                style="background-color: white;">
                                                <p style="margin-left: 0px; margin-bottom: 0px; font-size: 12px;">
                                                    END-DATE
                                                </p>
                                                <input class=""
                                                    style="font-size: 15px; margin-left: 0px; width: 100px; text-align: center; border: none !important; border-color: transparent !important;"
                                                    type="text" id="check_out" name="check_out"
                                                    style="width:80%; border:0" placeholder="Add Date" readonly>
                                            </button>
                                        </div>
                                    </div>



                                    {{-- calendar --}}
                                    <div class="content sidebar-popup" id="popup_check"
                                    style="margin-left: -765px; width:800px; padding:0px; z-index: 999; margin-top: -16px;">
                                        <div class="desk-e-call">
                                            <div class="flatpickr-container"
                                                style="display: flex; justify-content: center;">
                                                <div
                                                    style="display: table; background-color: white;
                                                    border-radius: 15px;">
                                                    <div class="col-lg-12"
                                                        style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                        <a type="button" id="clear_date_inline"
                                                            style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                        <p style="margin: 0px; font-size: 13px;"></p>
                                                    </div>
                                                    <div class="flatpickr" id="inline_reserve" style="text-align: left;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- calendar --}}
                                </div>
                            </div>
                            <div class="col-12"
                                style="display: flex; flex-direction: column; border: 2px solid #ff7400; border-radius:15px; padding: 9px; box-sizing: border-box; box-shadow: 1px 1px 10px #a4a4a4">
                                <div class="col-12" style="display: flex;">
                                    <div class="col-6" style="border-right: 2px solid #ff7400;">
                                        <p style="font-size: 12px; margin:0px;">Total Days</p>
                                    </div>
                                    <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                        <input id="sum_night" value="0"
                                            style="font-size: 12px; text-align:left; width: 20px; border:0">
                                    </div>
                                </div>

                                <div class="col-12" style="display: flex;">
                                    <div class="col-6" style="border-right: 2px solid #ff7400;">
                                        <p style="font-size: 12px; margin:0px;">Sub Total</p>
                                    </div>

                                    <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                        <p id="total" style="font-size:12px; margin:0px;">0</p>
                                    </div>
                                </div>

                                <div class="col-12" style="display: flex;">
                                    <div class="col-6">
                                        <p style="font-size: 12px; margin:0px; border-right: 2px solid #ff7400;">Tax &
                                            Service</p>
                                    </div>

                                    <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                        <p style="font-size: 12px; margin:0px">IDR
                                            {{ number_format(0, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12"
                                    style="display: flex; margin-top: 10px; border-top: 2px solid #ff7400; padding-top: 10px;">
                                    <div class="col-6">
                                        <p style="margin: 0px; font-size: 12px;">Total</p>
                                    </div>

                                    <div class="col-12">
                                        <span style="font-size: 12px;">IDR</span>
                                        <span id="total_all"
                                            style="font-size:100%; font-size: 12px; margin: 0px;">0</span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 p-5-price text-center" style="padding: 0px; margin-top: 20px;"><input
                                    class="price-button" type="submit" style="box-shadow: 1px 1px 10px #a4a4a4;"
                                    value="CONTACT NOW"></div>

                            <div class="col-12 p-5-price price-box text-center" style="margin-top: 9px;">You won't be
                                charged yet</div>
                        </form>
                    </div>



                    <!--
                <div class="diamond-block price-box">
                    <div class="row">
                        <div class="col-9">
                            <strong>This is a rare find.</strong> {{ $profile->name }}'s place on EZ Villas Bali is
                            usually fully
                            booked.
                        </div>
                        <div class="col-3"><img
                                src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                        </div>
                    </div>
                </div>
                -->

                </div>
            </div>
            {{-- END RIGHT CONTENT --}}
        </div>
        <div id="rsv-block-btn">
            {{-- RESERVE BUTTON TOP RIGHT --}}
            <div class="rsv">IDR
                <strong>{{ number_format($profile->price, 0, ',', '.') }}</strong>/day <span><a onclick="reserve2()"
                        type="button" class="rsv-btn-button">CONTACT NOW</a>
            </div>
            {{-- END RESERVE BUTTON TOP RIGHT --}}
        </div>

        <div id="navbarright" class="navright">
            <div class="list-villa-user right-bar">
                @auth
                    <div class="social-share-container" style="padding: 4px; border-radius: 9px;">
                        <div class="text-center icon-center">
                            <div style="width: 48px;">
                                @if ($profile->is_favorit)
                                    <a href="" style="cursor: pointer;">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button favorite-button-22 likeButtonvilla{{ $profile->id_collab }}">
                                            <path
                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                            </path>
                                        </svg>
                                        <div style="font-size: 10px; color: #aaa">
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
                                        <div style="font-size: 10px; color: #aaa">
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
                                <div style="color: #ff7400; font-size: 10px;">{{ __('user_page.SHARE') }}</div>
                            </div>
                        </div>
                    </div>

                    <a type="button" onclick="language()" class="navbar-gap"
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
                    @else
                    @if (Route::current()->uri() == 'villa/{id}' || Route::is('privacy_policy') || Route::is('terms') ||
                    Route::is('license'))
                    <input type="button" style="top: 0px !important;" onclick="location.href='{{ route('register.partner') }}';"
                        value="Become a Host" />
                    @endif

                    <a type="button" onclick="language()" class="navbar-gap"
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
        </div>

        {{-- FULL WIDTH ABOVE FOOTER --}}
        <div class="col-lg-12 bottom-content">
            <div class="col-12">
                <section id="review" class="section-2">
                <hr>
                    <div class="review-bottom">
                        {{-- @if ($detail->count() > 0)
                            <h2 style="margin: 0px;">{{ __('user_page.Review') }}</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-6">
                                            {{ __('user_page.Cleanliness') }}
                                        </div>
                                        <div class="col-6 ">
                                            <div class="liner"></div>{{ $detail[0]->average_clean }}
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Check In') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>
                                            {{ $detail[0]->average_check_in }}
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Value') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>{{ $detail[0]->average_value }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-6">
                                            {{ __('user_page.Service') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>{{ $detail[0]->average_service }}
                                        </div>
                                        <div class="col-6">
                                            {{ __('user_page.Location') }}
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>
                                            {{ $detail[0]->average_location }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else --}}
                            <h3 style="margin: 0px;">{{ __('user_page.there is no reviews yet') }}</h3>
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
                                            This host has 720 reviews for other places to stay.
                                            <span><a href="#">Show other reviews</a></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 d-flex">
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
                                </div>
                            </div>
                        {{-- @endif --}}
                    <hr>
                    </div>
                </section>

                <div class="section" id="host_end">

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>

    {{-- MODAL --}}
    @auth
        @include('user.modal.collab.story')
        @include('user.modal.collab.collab_language')
        @include('user.modal.collab.location')
        @include('user.modal.collab.collab_profile')
        @include('user.modal.collab.tag_add')
    @endauth
    {{-- modal --}}

    {{-- STORY MODAL --}}
    {{-- <div class="modal fade" id="storymodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                <center>
                    <input type="hidden" id="id_story" name="id_story" value="">
                    <input type="hidden" id="villa" name="villa" value="{{ $profile->name }}">
                    <video controls id="video" class="video-modal">
                        <source src="" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
                <div class="overlay-desc">
                    <div class="overlay-desc--wrap">
                        <h5 class="headline" id="title" style="margin-bottom: 10px"></h5>
                        <p id="price"></p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="storymodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content modal-content-story video-container" style="width:980px;">
                <center>
                    <h5 class="video-title" id="title">test</h5>
                    <input type="hidden" id="id_story" name="id_story" value="{{ $profile->id_collab }}">
                    <input type="hidden" id="villa" name="villa" value="{{ $profile->name }}">

                    <video controls id="video" class="video-modal">
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
            </div>
            </center>
        </div>
    </div>

    {{-- MODAL VIDEO --}}
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content video-container">
                <center>
                    <video controls id="video1" class="video-modal">
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                    <h5 class="video-title" id="title"></h5><br>
            </div>
            </center>
        </div>
    </div>

    {{-- MODAL INFO --}}
    {{-- <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="overflow-y: initial !important">
            <div class="modal-content" style="background: white; border-radius:15px">
                <div class="modal-header">
                    <h5 class="modal-title">All Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style=" height: 500px; overflow-y: auto;">
                    @php
                    $amenities = App\Http\Controllers\ViewController::amenities($profile->id_collab);
                    $bathroom = App\Http\Controllers\ViewController::bathroom($profile->id_collab);
                    $bedroom = App\Http\Controllers\ViewController::bedroom($profile->id_collab);
                    $kitchen = App\Http\Controllers\ViewController::kitchen($profile->id_collab);
                    $safety = App\Http\Controllers\ViewController::safety($profile->id_collab);
                    $service = App\Http\Controllers\ViewController::service($profile->id_collab);
                    echo '<div class="row row-border-bottom">';
                        foreach ($amenities as $item) {
                        echo "<div class='col-md-6 mb-2'><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';


                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">Bathroom</h5>';
                        foreach ($bathroom as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">Bedroom</h5>';
                        foreach ($bedroom as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">Kitchen</h5>';
                        foreach ($kitchen as $item) {
                        echo "<div class='col-md-8 '><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">Safety</h5>';
                        foreach ($safety as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">Service</h5>';
                        foreach ($service as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" .
                                $item->icon .
                                "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    @endphp
                </div>
                <div class="modal-filter-footer" style="height: 20px;">

                </div>
            </div>
        </div>
    </div> --}}
    <script>
        function view_amenities() {
            $('#modal-amenities').modal('show');
            // console.log('hit amenities');
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
                <input type="hidden" id="id_collab" name="id_collab" value="{{ $profile->id_collab }}">
    @auth
    @if (Auth::user()->id == $profile->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt" style="color:green; padding-right:5px;"
            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
    @endif
    @endauth
    <div class="row">
        <div class="col-7">
            <p class="price-box">IDR <span>{{ number_format($profile->price, 0, ',', '.') }}</span>/day
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
                <p class="price-box text-center"><strong>START-DATE</strong><br>
                    <input class="text-center" type="text" id="check_in_2" name="check_in" style="width:80%; border:0"
                        placeholder="Add Date">
                </p>
            </div>
            <div class="col-6 p-5-price">
                <p class="price-box text-center"><strong>END-DATE</strong><br>
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
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $profile->adult }}" value="1"
                                id="adult" name="adult" style="width: 70%"></p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2">Children (2-12)</p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $profile->children }}"
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
    <div class="col-12 p-5-price text-center"><input class="price-button" type="submit" value="CONTACT NOW">
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
    <div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Share</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="fs-3 fw-bold mb-0">Share this place with your friend and family</p>
                    <div class="d-flex gap-3 align-items-center py-3">
                        @if ($profile->image)
                            <img src="{{ URL::asset('/foto/collaborator/' . strtolower($profile->uid) . '/' . $profile->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @else
                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $profile->name }}</p>
                    </div>
                    <div>
                        <div class="modal-share-container">
                            <div class="col-lg col-12 p-3 border br-10">
                                <a type="button" class="d-flex p-0" onclick="copy_link()">
                                    <div class="pr-5"><i class="fas fa-copy"></i> <span
                                            class="fw-normal">Copy
                                            Link</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('collaborator', $profile->id_collab) }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">Facebook</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="https://api.whatsapp.com/send?text={{ route('collaborator', $profile->id_collab) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="https://telegram.me/share/url?url={{ route('collaborator', $profile->id_collab) }}&text={{ route('collaborator', $profile->id_collab) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('collaborator', $profile->id_collab) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                            class="fw-normal">Email</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL RESERVE II --}}
    <div class="modal fade" id="modal-reserve2" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Reserve Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-9">
                            <p class="price-box">IDR
                                <span>{{ number_format($profile->price, 0, ',', '.') }}</span>/day
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="price-box"><i class="fa fa-star"
                                    style="color: orange; font-size:14px"></i>
                                {{-- @if ($ratting->count() > 0)
                                {{ $ratting[0]->average }} reviews --}}
                            </p>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="reserve-inner-block">
                        <div class="row">
                            <div class="col-6 p-5-price line-right">
                                <p class="price-box text-center"><strong>START-DATE</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_in3" name="check_in"
                                        style="width:80%; border:0" placeholder="Add Date">
                                </p>
                            </div>
                            <div class="col-6 p-5-price">
                                <p class="price-box text-center"><strong>END-DATE</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_out3" name="check_out"
                                        style="width:80%; border:0" placeholder="Add Date" readonly>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 p-9-price line-top">
                            <p class="price-box"><strong>GUESTS</strong></p>
                            <button type="button" class="collapsible"><input type="number" id="total_guest4"
                                    value="1" style="width: 15px; text-align:left; border:0" min="0" readonly>
                                Guest</button>
                            <div class="content">
                                <div class="row" style="margin-top: 10px;">

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">Adults</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">Age 13+</p>
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
                                                <p><input type="number" id="adult4" name="adult" value="1"
                                                        style="text-align: center; border:none; width:30px;" readonly>
                                                </p>
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
                                                <p class="price-box">Children</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">Ages 2-12</p>
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
                                                <p><input type="number" id="child4" name="child" value="0"
                                                        style="text-align: center; border:none; width:30px;" readonly>
                                                </p>
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
                                                <p class="price-box">Infant</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">Under 2</p>
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
                                                <p><input type="number" id="infant4" name="infant" value="0"
                                                        style="text-align: center; border:none; width:30px;" readonly>
                                                </p>
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
                                                <p class="price-box">Pets</p>
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
                                                <p><input type="number" id="pet4" name="pet" value="0"
                                                        style="text-align: center; border:none; width:30px;" readonly>
                                                </p>
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
                    <div class="col-12 p-5-price text-center"><input class="price-button" type="submit"
                            value="CONTACT NOW">
                    </div>
                    <div class="col-12 p-5-price price-box text-center">You won't be charged yet</div>
                    <div class="row">
                        <div class="col-7 price-box">Sub Total<input id="sum_night3" value="0"
                                style="width: 25px; text-align:right; border:0"> nights</div>
                        <div class="col-5 price-box">IDR <span id="total3" style="font-size:100%">0</span></div>
                        <div class="col-7 price-box">Service Fee</div>
                        <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-7 price-box"><strong>Total Before Taxes</strong></div>
                        <div class="col-5 price-box">IDR <strong><span id="total_all3"
                                    style="font-size:100%">0</span></strong></div>
                    </div>
                </div>
                <div class="diamond-block modal-price-box">
                    <div class="row">
                        <div class="col-9">
                            <strong>This is a rare find.</strong> Valeria's place on EZ Villas Bali is usually fully
                            booked.
                        </div>
                        <div class="col-3"><img
                                src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL CONTACT HOST --}}
    <div class="modal fade" id="modal-contact-host" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <form action="{{ route('villa_store_user_message') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_owner" value="{{ $profile->created_by }}">
                        <div class="form-group">
                            <textarea name="message" rows="10" class="form-control w-100" value="{{ old('message') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL Reorder image --}}
    <div class="modal fade" id="edit_position_photo" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">Edit Position Photos</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-left: 1086px; position: absolute;"><i style="font-size: 22px;"
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $profile->created_by }}"> --}}
                    {{-- reorder image --}}
                    {{-- <ul id="sortable-photo">
                        @forelse ($photo as $item)
                        @php
                        $id = $item->id_photo;
                        $name = $item->name;
                        @endphp
                        <li class="ui-state-default" data-id="{{ $id }}">
                            <img src="{{ asset('foto/gallery/' . strtolower($profile->name) . '/' . $item->name) }}"
                                title="{{ $name }}">
                        </li>
                        @empty
                        there is no image yet
                        @endforelse
                    </ul> --}}

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos" value='Submit'
                            onclick="save_reorder_photo()">
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- MODAL Reorder video --}}
    <div class="modal fade" id="edit_position_video" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">Edit Position Video</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-left: 1086px; position: absolute;"><i style="font-size: 22px;"
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $profile->created_by }}"> --}}
                    {{-- reorder image --}}
                    {{-- <ul id="sortable-video">
                        @forelse ($video as $item)
                        @php
                        $id = $item->id_video;
                        $name = $item->name;
                        @endphp
                        <li class="ui-state-default" data-id="{{ $id }}">
                            <video
                                src="{{ asset('foto/gallery/' . strtolower($profile->name) . '/' . $item->name) }}#t=1.0">
                        </li>
                        @empty
                        there is no image yet
                        @endforelse
                    </ul> --}}

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos" value='Submit'
                            onclick="save_reorder_video()">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- MAP MODAL -->
    <div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
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

    @include('layouts.user.footer')
    </div>
    {{-- END MODAL --}}

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
    {{-- Page JS Plugins --}}
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    {{-- GOOGLE MAPS API --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script> --}}
    <script src="{{ asset('assets/js/story-admin-slider.js') }}"></script>
    <script src="{{ asset('assets/js/story-slider.js') }}"></script>
    <script src="{{ asset('assets/js/thingstodo-slider.js') }}"></script>
    <script src="{{ asset('assets/js/villa-slider.js') }}"></script>
    <script src="{{ asset('assets/js/view-collab.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

    {{-- SweetAlert JS --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(window).scroll(function() {
            if ($(".sticky-div").hasClass("sticky") && $("#rsv-block-btn").css("display") !== "block") {
                $("#navbarright").addClass("active");
            }else {
                $("#navbarright").removeClass("active");
            }
        })
    </script>

    <script>
        function editDescriptionForm() {
            var form = document.getElementById("description-form");
            var content = document.getElementById("description-content");
            form.classList.add("d-block");
            content.classList.add("d-none");
        }

        function editDescriptionCancel() {
            var form = document.getElementById("description-form");
            var formInput = document.getElementById("description-form-input");
            var content = document.getElementById("description-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
        }
    </script>

    {{-- Header List --}}
    <script>
        function collabRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/collaborator/search?${suburl}`;
        }
    </script>

    <script>
        function collabSearch() {
            var fMaxPriceFormInput = [];
            $("input[name='fMaxPrice[]']").each(function() {
                fMaxPriceFormInput.push(parseInt($(this).val()));
            });

            var fMinPriceFormInput = [];
            $("input[name='fMinPrice[]']").each(function() {
                fMinPriceFormInput.push(parseInt($(this).val()));
            });

            var fPropertyFormInput = [];
            $("input[name='fProperty[]']:checked").each(function() {
                fPropertyFormInput.push(parseInt($(this).val()));
            });

            var fBedroomFormInput = [];
            $("input[name='fBedroom[]']").each(function() {
                fBedroomFormInput.push(parseInt($(this).val()));
            });

            var fBathroomFormInput = [];
            $("input[name='fBathroom[]']").each(function() {
                fBathroomFormInput.push(parseInt($(this).val()));
            });

            var fBedsFormInput = [];
            $("input[name='fBeds[]']").each(function() {
                fBedsFormInput.push(parseInt($(this).val()));
            });

            var fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });

            var fSuitableFormInput = [];
            $("input[name='fSuitable[]']:checked").each(function() {
                fSuitableFormInput.push(parseInt($(this).val()));
            });

            var sLocationFormInput = $("input[name='sLocation']").val();

            var sCheck_inFormInput = $("input[name='sCheck_in']").val();

            var sCheck_outFormInput = $("input[name='sCheck_out']").val();

            var sAdultFormInput = $("input[name='sAdult']").val();

            var sChildFormInput = $("input[name='sChild']").val();

            var subUrl =
                `fMaxPrice=${fMaxPriceFormInput}&fMinPrice=${fMinPriceFormInput}&fProperty=${fPropertyFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fFacilities=${fFacilitiesFormInput}&fSuitable=${fSuitableFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            collabRefreshFilter(subUrl);
        }
    </script>

    {{-- End Header List --}}
<script>
        function position_photo() {
            $('#edit_position_photo').modal('show');
        }
</script>
    {{-- EDIT POSITION PHOTO & VIDEO --}}
    {{-- <script>
        $(document).ready(function () {
            // Initialize sortable
            $("#sortable-video").sortable();
            $("#sortable-photo").sortable();
        });

        // Save order
        function save_reorder_photo() {
            var imageids_arr = [];
            // get image ids order
            $('#sortable-photo li').each(function () {
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
                    id: `{{ $profile->id_collab }}`
                },
                success: function (response) {
                    location.reload();
                }
            });
        }

        function position_video() {
            $('#edit_position_video').modal('show');
        }

        function save_reorder_video() {
            var videoids_arr = [];
            // get video ids order
            $('#sortable-video li').each(function () {
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
                    id: `{{ $profile->id_collab }}`
                },
                success: function (response) {
                    location.reload();
                }
            });
        }

    </script> --}}
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

    {{-- <script>
        $('#check_in').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onChange: function (selectedDates, dateStr, instance) {
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

    </script> --}}

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

    {{-- <script>
        $('#check_in3').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function (selectedDates, dateStr, instance) {
                $('#check_out3').flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: new Date(dateStr).fp_incr(1),
                    onChange: function (selectedDates, dateStr, instance) {
                        var start = new Date($('#check_in3').val());
                        var end = new Date($('#check_out3').val());
                        var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                        var min_stay = $('#min_stay').val();
                        var minimum = new Date($('#check_in3').val()).fp_incr(min_stay);
                        var total = $('#price').val() * sum_night;
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
            }
        });

    </script> --}}

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

    {{-- UPDATE FORM --}}
    <script>
        function editNameForm() {
            var form = document.getElementById("name-form");
            var content = document.getElementById("name-content");
            form.classList.add("d-block");
            content.classList.add("d-none");
        }

        function editNameCancel() {
            var form = document.getElementById("name-form");
            var formInput = document.getElementById("name-form-input");
            var content = document.getElementById("name-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $user->first_name }} {{ $user->last_name }}';
        }
    </script>
    {{-- END UPDATE FORM --}}

    {{-- CONTACT HOST --}}
    <script>
        function contactHostForm() {
            $('#modal-contact-host').modal('show');
        }
    </script>
    {{-- END CONTACT HOST --}}

    {{-- DROPZONE JS --}}
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}

    <script>
        // Dropzone.autoDiscover = false;
        Dropzone.options.frmTarget = {
            autoProcessQueue: false,
            url: '/collaborator/update/photo',
            parallelUploads: 50,
            "error": function(file, message, xhr) {
                this.removeFile(file);// perhaps not remove on xhr errors
                alert(errorToString(message));
            },
            init: function() {

                var myDropzone = this;

                // Update selector to match your button
                $("#button").click(function(e) {
                    e.preventDefault();
                    myDropzone.processQueue();

                });

                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    // var data = $('#frmTarget').serializeArray();
                    // $.each(data, function(key, el) {
                    //     formData.append(el.name, el.value);
                    // });
                    var value = $('form#formData #id_collab').val();
                    formData.append('id_collab', value);
                });

                this.on('queuecomplete', function() {
                    $('#loading-content').show();
                    location.reload();
                });

                this.on("addedfile", function(file) {

                    // Create the remove button
                    var removeButton = Dropzone.createElement(
                        "<center><button class='btn btn-outline-light btn-del'>Remove</button></center>"
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
            }
        }
    </script>
    {{-- END DROPZONE JS --}}

    <script>
        // Semi Fixed
        $(document).ready(function() {
            var $window = $(window);
            var $sidebar = $("#sidebar_fix");
            var $sidebarHeight = $sidebar.innerHeight();
            var $footerOffsetTop = $("#scrollStop").offset().top;
            var $footerHeight = $("#heightCalendar").innerHeight();
            var $sidebarOffset = $sidebar.offset();

            $window.scroll(function() {
                if ($window.scrollTop() > $sidebarOffset.top) {
                    $sidebar.addClass("fixed");
                } else {
                    $sidebar.removeClass("fixed");
                }
                if ($window.scrollTop() + $sidebarHeight > $footerOffsetTop + $footerHeight) {
                    $sidebar.css({
                        "top": -($window.scrollTop() + $sidebarHeight - $footerOffsetTop - $footerHeight)
                    });
                } else {
                    $sidebar.css({
                        "top": "0",
                    });
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
        function adult_increment() {
            document.getElementById('adult2').stepUp();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('adult4').value = document.getElementById('adult2').value;
        }

        function adult_decrement() {
            document.getElementById('adult2').stepDown();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('adult4').value = document.getElementById('adult2').value;
        }

        function child_increment() {
            document.getElementById('child2').stepUp();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
            document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
            document.getElementById('child4').value = document.getElementById('child2').value;
        }

        function child_decrement() {
            document.getElementById('child2').stepDown();
            document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) +
                parseInt(document.getElementById('child2').value);
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

    {{-- Highlight sticky --}}
    <script>
        var gallery = $('#gallery').offset().top,
            description = $('#description').offset().top,
            amenities = $('#amenities').offset().top,
            location_menu = $('#location-map').offset().top,
            availability = $('#availability').offset().top,
            review = $('#review').offset().top,
            host = $('#host_end').offset().top,
            $window = $(window);

        $window.scroll(function() {
            if ($window.scrollTop() >= gallery && $window.scrollTop() < description) {
                $('#gallery-sticky').addClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= description && $window.scrollTop() < amenities) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').addClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= amenities && $window.scrollTop() < location_menu) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').addClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= location_menu && $window.scrollTop() < availability) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').addClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= availability && $window.scrollTop() < review) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').addClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= review && $window.scrollTop() < host) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').addClass('active-sticky');
            } else {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            }
        });
    </script>

    {{-- Sweetalert Function Delete Story --}}
    <script>
        function delete_story(ids) {
            var ids = ids;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, deleted it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/collab/${ids.id}/delete/story/${ids.id_story}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- Sweetalert Function Delete Profile Image --}}
    {{-- <script>
        function delete_profile_image(ids) {
            var ids = ids;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, deleted it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/villa/${ids.id}/delete/image`,
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message, 'error');
                            }
                        },
                        success: async function (data) {
                            // console.log(data.message);
                            await Swal.fire('Deleted', data.message, 'success');
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };

    </script> --}}

    {{-- Sweetalert Function Delete Photo Gallery --}}
    <script>
        function delete_photo_photo(ids) {
            var ids = ids;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, deleted it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/collab/${ids.id}/delete/photo/photo/${ids.id_photo}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- Sweetalert Function Delete Video Gallery --}}
    <script>
        function delete_photo_video(ids) {
            var ids = ids;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, deleted it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/collab/${ids.id}/delete/photo/video/${ids.id_video}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- View Maps Villa --}}
    {{-- <script>
        async function view_map(id) {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: `/villa/map/${id}`,
                statusCode: {
                    500: () => {
                        alert('internal server error');
                    },
                    404: () => {
                        alert('data not found');
                    },
                },
                success: async function (data) {
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
                    });

                    // add open google maps
                    var gotoMapButton = document.createElement("div");
                    gotoMapButton.setAttribute("style",
                        "margin: 5px; border: 1px solid; padding: 1px 12px; font: bold 11px Roboto, Arial, sans-serif; color: #000000; background-color: #FFFFFF; cursor: pointer;"
                    );
                    gotoMapButton.innerHTML = "Open Google Maps";
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gotoMapButton);
                    google.maps.event.addDomListener(gotoMapButton, "click", function () {
                        var url =
                            `https://maps.google.com/?q=${data.latitude},${data.longitude}`;
                        window.open(url);
                    });
                    $("#modal-map").modal('show');
                }
            });
        }

        function close_map() {
            $("#modal-map").modal('hide');
        }

    </script> --}}

    {{-- PREVENT TEXTAREA TYPE ENTER --}}
    <script>
        $("textarea").keydown(function(e) {
            // Enter was pressed without shift key
            if (e.keyCode == 13 && !e.shiftKey) {
                // prevent default behavior
                e.preventDefault();
            }
        });
    </script>

    <script type="text/javascript">
        //copy link
        function copy_link() {
            navigator.clipboard.writeText(window.location.origin + window.location.pathname);
            alert('Link has been copied');
        }
    </script>

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
    <script>
        function language() {
            $('#LegalModal').modal('show');
        }
    </script>
</body>

</html>
