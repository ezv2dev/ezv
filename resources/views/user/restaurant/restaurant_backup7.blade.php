<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    @include('layouts.admin.title')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .video-position {
            position: relative;
            left: 0;
            top: 0;
        }

        .fa-play:before {
            content: "\f04b";
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

        .restaurant-tag-button {
            border-color: #ff7400;
            border-radius: 50px !important;
            height: 23px;
            font-size: 12px;
            padding: 0px 8px 0px 8px;
        }

        .restaurant-tag-button:hover {
            background-color: #ff7400;
            border: 1px solid #ff7400;
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

            .footer {
                margin-bottom: 174px;
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

            .rsv,
            header .villa-list-header-logo,
            header .search-box,
            header .right-bar,
            .social-share {
                display: none !important;
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

    {{-- GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

    {{-- END GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}
</head>

<body style="background-color:white">
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
                <div class="header-mobile">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('index') }}"><i class="fa fa-chevron-left"></i> Homes EZV2</a>
                        </div>
                        <div class="col-6">
                            <div class="row mobile-social-share">
                                <div class="col-6 text-center icon-center">
                                    @if ($restaurant->is_favorit)
                                        <p>
                                            <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i
                                                    class="fa fa-heart" style="color: #f00;  font-size: 18px;"></i>
                                                <span>CANCEL</span>
                                            </a>
                                        </p>
                                    @else
                                        <p>
                                            <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i
                                                    class="fa fa-heart" style="color: #aaa;  font-size: 18px;"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </header>
        {{-- END HEADER --}}
        {{-- PROFILE --}}
        <div class="row page-content">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block alert-detail">

                {{-- ALERT CONTENT STATUS --}}
                @auth
                    @if (auth()->user()->id == $restaurant->created_by)
                        @if ($restaurant->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>this content is deactive, </span>
                                <form action="{{ route('restaurant_request_update_status', $restaurant->id_restaurant) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                                    <button class="btn" type="submit">request activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($restaurant->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>this content is active, </span>
                                <form action="{{ route('restaurant_request_update_status', $restaurant->id_restaurant) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                                    <button class="btn" type="submit">request deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($restaurant->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request activation for this content, </span>
                                <form
                                    action="{{ route('restaurant_cancel_request_update_status', $restaurant->id_restaurant) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                                    <button class="btn" type="submit">cancel activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($restaurant->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request deactivation for this content, </span>
                                <form
                                    action="{{ route('restaurant_cancel_request_update_status', $restaurant->id_restaurant) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                                    <button class="btn" type="submit">cancel deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($restaurant->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                this content is deactive
                            </div>
                        @endif
                        @if ($restaurant->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                this content is active
                            </div>
                        @endif
                        @if ($restaurant->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request activation, </span>
                                <form action="{{ route('admin_food_update_status', $restaurant->id_restaurant) }}"
                                    method="get">
                                    <button class="btn" type="submit">activate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($restaurant->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request deactivation, </span>
                                <form action="{{ route('admin_food_update_status', $restaurant->id_restaurant) }}"
                                    method="get">
                                    <button class="btn" type="submit">deactivate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                @endauth
                {{-- END ALERT CONTENT STATUS --}}
                <div class="row top-profile">
                    <div class="col-lg-4- col-md-4 col-xs-12 pd-0">
                        <div class="profile-image">
                            @if ($restaurant->image)
                                <img
                                    src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}">
                            @else
                                <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_restaurant_profile()"><i
                                            class="fa fa-pencil-alt" style="color:#FF7400; padding-right:5px;"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Edit"></i></a>
                                    @if ($restaurant->image)
                                        <a class="delete-profile" href="javascript:void(0);"
                                            onclick="delete_profile_image({'id': `{{ $restaurant->id_restaurant }}`})">
                                            {{-- <a href="{{ route('restaurant_delete_image', $restaurant->id_restaurant) }}"> --}}
                                            <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="Delete"></i></a>
                                    @endif
                                @endif
                            @endauth
                            <div>
                                {{-- OPEN CLOSED TIME --}}
                                <p style="font-size: 12px;" id="time-content">
                                    @php
                                        $open = date_create($restaurant->open_time);
                                        $closed = date_create($restaurant->closed_time);
                                    @endphp
                                    {{ date_format($open, 'h:i A') }} - {{ date_format($closed, 'h:i A') }}
                                    @auth
                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="editTimeForm()"><i class="fa fa-pencil-alt"
                                                    style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                    data-bs-animation="true" data-bs-placement="bottom"
                                                    title="Edit"></i></a>
                                        @endif
                                    @endauth
                                </p>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="time-form" style="display:none;">
                                            <form action="{{ route('restaurant_update_time') }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center">
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
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-check"></i> Done
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editTimeFormCancel()">
                                                        <i class="fa fa-xmark"></i> Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- END OPEN CLOSED TIME --}}
                                {{-- CONTACT --}}
                                <div class="col-12"
                                    style="display: flex; padding-right: 70px; padding-left: 70px; margin-top: 18px;">
                                    <div class="col-4">
                                        <a onclick="view_map('{{ $restaurant->id_restaurant }}')" type="button"> <i
                                                class="fa-solid fa-location-dot"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a onclick="contact_restaurant()" type="button">
                                            <i class="fa-solid fa-phone"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a target="_blank" type="button" href="{{ $restaurant->website }}">
                                            <i class="fa-solid fa-globe"></i>
                                        </a>
                                    </div>
                                    <div class="col-1">
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <a type="button" onclick="edit_contact()"><i class="fa fa-pencil-alt"
                                                        style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                        data-bs-animation="true" data-bs-placement="bottom"
                                                        title="Edit"></i></a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                {{-- END CONTACT --}}
                                {{-- RESTAURANT TYPE --}}
                                <div class="col-12" style=" margin-top: 18px;" id="type-content">
                                    <p style="font-size: 12px">
                                        <span data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom"
                                            title="{{ $restaurant->type->name }}">{{ $restaurant->type->name }}</span>
                                        <span> - </span>
                                        @if ($restaurant->price->name == 'Cheap Prices')
                                            <span style="color: #FF7400" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                title="{{ $restaurant->price->name }}">$</span>
                                        @elseif ($restaurant->price->name == 'Cheap Prices')
                                            <span style="color: #FF7400" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                title="{{ $restaurant->price->name }}">$</span>
                                        @else
                                            <span style="color: #FF7400" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                title="{{ $restaurant->price->name }}">$</span>
                                        @endif
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <a type="button" onclick="editTypeForm()"><i class="fa fa-pencil-alt"
                                                        style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                        data-bs-animation="true" data-bs-placement="bottom"
                                                        title="Edit"></i></a>
                                            @endif
                                        @endauth
                                    </p>

                                </div>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="type-form" style="display: none">
                                            <form action="{{ route('restaurant_update_type') }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center">
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
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-check"></i> Done
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editTypeFormCancel()">
                                                        <i class="fa fa-xmark"></i> Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- END RESTAURANT TYPE --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12" style="padding-left: 40px;">
                        <h2 id="name-content">
                            {{ $restaurant->name }}
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <form action="{{ route('restaurant_update_name') }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id_restaurant"
                                            value="{{ $restaurant->id_restaurant }}" required>
                                        <input type="text" style="width: 100%;" class="form-control" name="name"
                                            id="name-form-input" maxlength="100" value="{{ $restaurant->name }}"
                                            required>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            style="background-color: #ff7400">
                                            <i class="fa fa-check"></i> Done
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary"
                                            onclick="editNameCancel()">
                                            <i class="fa fa-xmark"></i> Cancel
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">{{ $restaurant->short_description }}
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"><i
                                            class="fa fa-pencil-alt" style="color:#FF7400; padding-right:5px;"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <form action="{{ route('restaurant_update_short_description') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id_restaurant"
                                            value="{{ $restaurant->id_restaurant }}" required>
                                        <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                            cols="30" rows="3" maxlength="255" required>{{ $restaurant->short_description }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-check"></i> Done
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary"
                                            onclick="editShortDescriptionCancel()">
                                            <i class="fa fa-xmark"></i> Cancel
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        </p>
                        {{-- END SHORT DESCRIPTION --}}
                        {{-- TAG --}}
                        <p class="text-secondary">
                            @if ($tags->count() > 7)
                                @for ($i = 0; $i < 7; $i++)
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
                                    there is no tag yet
                                @endforelse
                            @endif
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="add_tag()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        {{-- END TAG --}}
                        <ul class="stories inner-wrap">
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    @if ($restaurant->story->count() == 0)
                                        <li class="story">
                                            <div class="img-wrap">
                                                <a type="button" onclick="edit_story()">
                                                    <img src="{{ URL::asset('assets/add_story.png') }}">
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        @if ($restaurant->story->count() < 100)
                                            <li class="story" style="margin-top: -35px;">
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
                                                        @foreach ($restaurant->story as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        <a type="button"
                                                                            onclick="view_story_restaurant({{ $item->id_story }});">

                                                                            <div class="story-video-player">
                                                                                <i class="fa fa-play"
                                                                                    aria-hidden="true"></i>
                                                                            </div>

                                                                            <video preload href=""
                                                                                class="story-video-grid"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="delete_story({'id': `{{ $restaurant->id_restaurant }}`, 'id_story': `{{ $item->id_story }}`})">
                                                                                    {{-- <a href="{{ route('restaurant_delete_story', ['id' => $restaurant->id_restaurant, 'id_story' => $item->id_story]) }}"> --}}
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
                                            @foreach ($restaurant->story as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            <a type="button"
                                                                onclick="view_story_restaurant({{ $item->id_story }});">
                                                                <div class="story-video-player">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=1.0">
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
                    <div class="col-lg-2 col-md-2 col-xs-12" style="padding-right: 0px;">
                        <div class="row social-share">
                            <div class="col-6 text-center icon-center">
                                @if ($restaurant->is_favorit)
                                    <p>
                                        <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i
                                                class="fa fa-heart" style="color: #f00;  font-size: 18px;"></i>
                                            <span>CANCEL</span>
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i
                                                class="fa fa-heart" style="color: #aaa;  font-size: 18px;"></i>
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
                                <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                GALLERY
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="menu-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('menu').scrollIntoView();">
                                <i aria-label="Posts" class="fa-solid fa-book navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                MENU
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                ABOUT
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                FACILITIES
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                LOCATION
                            </a>
                        </li>
                        {{-- <li class="navigationItem">
                        <a class="hoover font-13 navigationItem__Button"
                            onClick="document.getElementById('availability').scrollIntoView();">
                            <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                            AVAILABILITY
                        </a>
                    </li> --}}
                        <li class="navigationItem">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                REVIEW
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- END STICKY BAR --}}
                {{-- PAGE CONTENT --}}
                <div class="js-gallery">
                    {{-- GALLERY --}}
                    <section id="gallery" class="photosGrid section">
                        @if ($restaurant->photo->count() > 0)
                            @foreach ($restaurant->photo->sortBy('order') as $item)
                                <a href="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}"
                                    class="img-lightbox photosGrid__Photo"
                                    style="background-image: url('{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}')">
                                </a>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a class="delete" style="height:40px" href="javascript:void(0);"
                                            onclick="delete_photo_photo({'id': `{{ $restaurant->id_restaurant }}`, 'id_photo': `{{ $item->id_photo }}`})"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Delete"><i class="fa fa-trash"></i></a>
                                        <a type="button" class="delete" style="left: -40px !important; height:40px;"
                                            onclick="position_photo()" data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom" title="Edit Position"><i
                                                class="fa fa-pencil"></i></a>
                                    @endif
                                @endauth
                            @endforeach
                        @endif
                        @if ($restaurant->video->count() > 0)
                            @foreach ($restaurant->video->sortBy('order') as $item)
                                <a class="video-grid" onclick="view_video_restaurant({{ $item->id_video }})">
                                    <i class="fas fa-2x fa-play video-button"></i>
                                    <video preload href="" class="photosGrid__Photo"
                                        style="object-fit: cover;"
                                        src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=1.0">
                                    </video>
                                </a>
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a class="delete" style="height:40px" href="javascript:void(0);"
                                            onclick="delete_photo_video({'id': `{{ $restaurant->id_restaurant }}`, 'id_video': `{{ $item->id_video }}`})"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Delete"><i class="fa fa-trash"></i></a>
                                        {{-- <a class="delete" style="height:40px"
                                            href="{{ route('restaurant_delete_photo_video', ['id' => $restaurant->id_restaurant, 'id_video' => $item->id_video]) }}"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Delete"><i class="fa fa-trash"></i></a> --}}
                                        <a type="button" class="delete" style="left: -40px !important; height:40px;"
                                            onclick="position_video()" data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom" title="Edit Position"><i
                                                class="fa fa-pencil"></i></a>
                                    @endif
                                @endauth
                            @endforeach
                        @endif
                        @if ($restaurant->photo->count() <= 0 && $restaurant->video->count() <= 0)
                            there is no gallery yet
                        @endif
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section id="add-gallery"
                                style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                                <form class="dropzone" id="frmTarget">
                                    @csrf
                                    <input type="hidden" value="{{ $restaurant->id_restaurant }}" id="id_restaurant"
                                        name="id_restaurant">
                                </form>
                                <button type="submit" id="button" class="btn btn-primary">Upload</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    {{-- MENU --}}
                    <section id="menu" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>
                                Menu
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_menu()">
                                            <i class="fa fa-plus" style="color:#FF7400; padding-right:5px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="Add"></i>
                                        </a>
                                    @endif
                                @endauth
                            </h2>
                        </div>
                        <div class="photosGrid">
                            @forelse ($restaurant->menu as $menu)
                                <a onclick="view_menu(`{{ $menu->id_menu }}`)" class="photosGrid__Photo btn"
                                    style="background-image: url('{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/menu' . '/' . $menu->foto) }}')">
                                </a>
                            @empty
                                <p
                                    style="text-align: justify; padding-top:10px; padding-bottom:12px; padding-left:10px; padding-right:10px;">
                                    There is no menu yet
                                </p>
                            @endforelse
                        </div>
                    </section>
                    <section id="description" class="section-2" style="margin-top: 12px;">
                        {{-- Description --}}
                        <div style="padding-top:12px; padding-left:10px; padding-right:10px;">
                            <h2>
                                About this place
                            </h2>
                            <p id="description-content"
                                style="text-align: justify; padding-top:10px; padding-bottom:12px">
                                @if ($restaurant->description)
                                    {{ $restaurant->description }}
                                @else
                                    there is no description yet
                                @endif
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editDescriptionForm()"><i
                                                class="fa fa-pencil-alt" style="color:#FF7400; padding-right:5px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('restaurant_update_description') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_restaurant"
                                                value="{{ $restaurant->id_restaurant }}" required>
                                            <div class="form-group">
                                                <textarea name="description" id="description-form-input" class="w-100" rows="5" required>{{ $restaurant->description }}</textarea>
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
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>
                                What this place offers
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="add_facilities()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row amenities-block">
                                        @if ($restaurant->facilities->count() > 9)
                                            @for ($i = 0; $i < 9; $i++)
                                                <div class="col-lg-4 col-6 amenities-detail-view">
                                                    <i class="fa fa-{{ $restaurant->facilities[$i]->icon }}"></i>
                                                    <span>{{ $restaurant->facilities[$i]->name }}</span>
                                                </div>
                                            @endfor
                                        @else
                                            @forelse ($restaurant->facilities as $item)
                                                <div class="col-lg-4 col-6 amenities-detail-view">
                                                    <i class="fa fa-{{ $item->icon }}"></i>
                                                    <span>{{ $item->name }}</span>
                                                </div>
                                            @empty
                                                <div class='col-md-12 mb-6'>
                                                    <span>there is no facilities yet</span>
                                                </div>
                                            @endforelse
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($restaurant->facilities->count() > 9)
                                <div class="amenities-box">
                                    <button type="button" onclick="view_amenities()">More Facilities</button>
                                </div>
                            @endif
                            <hr>
                        </div>
                    </section>
                    <section id="location-map" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>
                                Location
                                @auth
                                    @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <input type="hidden" value="{{ $restaurant->latitude }}" name="latitude"
                                id="latitude">
                            <input type="hidden" value="{{ $restaurant->longitude }}" name="longitude"
                                id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div>
                        </div>
                    </section>
                    <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div>
                    <section id="availability" class="section-2">

                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2 style="color: white;">Availability</h2>
                            <div class="flatpickr-container" style="display: flex; justify-content: center;">

                            </div>
                            <!--
                        <div class="flatpickr-container" style="display: flex; justify-content: center;">
                            <div class="flatpickr" id="inline" style="text-align: left;">
                                {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                            </div>
                        </div>
                        -->

                            <div class="footer">
                            </div>

                    </section>
                </div>
                {{-- END PAGE CONTENT --}}
                <div class="spacer">&nbsp;</div>
            </div>

            {{-- END LEFT CONTENT --}}
            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div class="sidebar sidebar-restaurant sidebar-restaurant-idle">
                    <div class="reserve-block-restaurant"
                        style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%); padding: 15px;">
                        <a href="{{ route('villa', $villas_advertise->id_villa) }}">
                            <img style="border-radius: 10px; aspect-ratio: 4/3; object-fit: cover;"
                                src="{{ URL::asset('/foto/gallery/' . strtolower($villas_advertise->uid) . '/' . $villas_advertise->image) }}">
                        </a>
                        <div class="row mt-2">
                            <div class="col-12">
                                <b style="margin: 0px; margin-top: 10px; font-size: 16px; color: #FF7400">
                                    {{ $villas_advertise->name }}</b>
                                <p style="font-size: 12px; color: grey; margin-bottom: 0px;">
                                    {{ $villas_advertise->bedroom }} Bedroom, {{ $villas_advertise->bathroom }}
                                    Bathroom,
                                    {{ $villas_advertise->beds }} Beds
                                </p>
                                <div>
                                    @foreach ($villa_amenities as $item)
                                        <span><i class="fa fa-{{ $item->icon }}"
                                                style="border: none; font-size: 15px;"></i></span>
                                    @endforeach
                                </div>
                                <p style="font-size: 12px; color: grey; margin-bottom: 0px;">
                                    {{ $villas_advertise->short_description }}
                                </p>
                                <p style="margin: 0px; margin-top: 10px; font-size: 14px;">Price per Night : IDR
                                    {{ number_format($villas_advertise->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!--
                        <input type="hidden" id="id_restaurant" name="id_restaurant"
                            value="{{ $restaurant->id_restaurant }}">
                        @auth
                                                                                                                                                                                                        @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt"
                                                                                                                                                                                                                    style="color: #FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                                                                                                                                                                                    data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
    @endif
                        @endauth
                        <form method="POST" action="{{ route('villa_booking_confirm') }}">
                            @csrf
                            <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                            <div class="row">
                                <div class="col-7">
                                    <p class="price-box">IDR
                                        <span></span>/night
                                    </p>
                                </div>
                                <div class="col-5">
                                    <p class="price-box" style="text-align: end;">
                                        {{-- <i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                    @if ($ratting->count() > 0)
                                        {{ $ratting[0]->average }} reviews</p>
                                @endif --}}
                                </div>
                            </div>
                            <div class="reserve-inner-block">
                                <div class="row">
                                    <div class="col-6 p-5-price line-right">
                                        <p class="price-box"><strong
                                                style="margin-left: 14px;">CHECK-IN</strong><br>
                                            <input class="flatpickr"
                                                style="font-size: 15px; margin-left: 14px; border: none !important; border-color: transparent !important;"
                                                type="text" id="check_in" name="check_in" style="width:80%; border:0"
                                                placeholder="Add Date">
                                        </p>
                                    </div>
                                    <div class="col-6 p-5-price">
                                        <p class="price-box"><strong style="">CHECK-OUT</strong><br>
                                            <input class="flatpickr"
                                                style="font-size: 15px; border: none !important; border-color: transparent !important;"
                                                type="text" id="check_out" name="check_out" style="width:80%; border:0"
                                                placeholder="Add Date" readonly>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 p-9-price line-top">
                                    <p class="price-box"><strong>GUESTS</strong></p>
                                    <button type="button" class="collapsible"><input type="number" id="total_guest2"
                                            value="1" style="width: 15px; text-align:left; border:0;" min="0" readonly>
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
                                                        <p><input type="number" id="adult2" name="adult" value="1"
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
                                                        <p><input type="number" id="child2" name="child" value="0"
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
                                                        <p><input type="number" id="infant2" name="infant" value="0"
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
                                                        <p><input type="number" id="pet2" name="pet" value="0"
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
                            <div class="col-12 p-5-price text-center"><input class="price-button" type="submit"
                                    value="RESERVE NOW">
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
                                <div class="col-5 price-box">IDR <strong><span id="total_all"
                                            style="font-size:100%">0</span></strong></div>
                            </div>
                        </form>-->
                    </div>
                </div>
            </div>
            {{-- END RIGHT CONTENT --}}
        </div>
        <div id="rsv-block-btn">
            {{-- RESERVE BUTTON TOP RIGHT --}}
            <div class="rsv">
                <a onclick="contact_restaurant()" type="button" class="rsv-btn-button">CONTACT RESTAURANT</a>
            </div>
            {{-- END RESERVE BUTTON TOP RIGHT --}}
        </div>
        {{-- FULL WIDTH ABOVE FOOTER --}}
        <div class="row">
            <div class="col-12">
                <section id="review" class="section-2 padding-x-2">
                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                        <h2>Review</h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                @if ($restaurant->detailReview)
                                    <div class="row">
                                        <div class="col-6">
                                            Food
                                        </div>
                                        <div class="col-6 ">
                                            <div class="liner"></div>
                                            {{ $restaurant->detailReview->average_food }}
                                        </div>
                                        <div class="col-6">
                                            Service
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>
                                            {{ $restaurant->detailReview->average_service }}
                                        </div>
                                        <div class="col-6">
                                            Value
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>
                                            {{ $restaurant->detailReview->average_value }}
                                        </div>
                                        <div class="col-6">
                                            Atmosphere
                                        </div>
                                        <div class="col-6">
                                            <div class="liner"></div>
                                            {{ $restaurant->detailReview->average_atmosphere }}
                                        </div>
                                    </div>
                                @else
                                    there is no review yet
                                @endif
                            </div>
                        </div>
                        <hr>
                    </div>
                </section>
                @auth
                    @can('review_create')
                        @if ($restaurant->userReview)
                            <section id="user-review" class="section-2 padding-x-2">
                                <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                    <h2>Your Review</h2>
                                    <span>
                                        <form action="{{ route('restaurant_review_delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_restaurant"
                                                value="{{ $restaurant->id_restaurant }}" required>
                                            <input type="hidden" name="id_review"
                                                value="{{ $restaurant->userReview->id_review }}" required>
                                            <span><button type="submit" class="btn btn-primary">remove
                                                    review</button></span>
                                        </form>
                                    </span>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    Food
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="liner"></div>
                                                    {{ $restaurant->userReview->food }}
                                                </div>
                                                <div class="col-6">
                                                    Service
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $restaurant->userReview->service }}
                                                </div>
                                                <div class="col-6">
                                                    Value
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $restaurant->userReview->value }}
                                                </div>
                                                <div class="col-6">
                                                    Atmosphere
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $restaurant->userReview->atmosphere }}
                                                </div>
                                                @if ($restaurant->userReview->comment)
                                                    <div class="col-12">
                                                        Comment
                                                    </div>
                                                    <div class="col-12">
                                                        "{{ $restaurant->userReview->comment }}"
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </section>
                        @else
                            {{-- STYLE FOR RATING STAR --}}
                            <style>
                                .cm-star-rating {
                                    direction: rtl;
                                    display: inline-block;
                                    /* padding: 20px */
                                }

                                .cm-star-rating input[type=radio] {
                                    display: none
                                }

                                .cm-star-rating label {
                                    color: #bbb;
                                    font-size: 18px;
                                    padding: 0;
                                    cursor: pointer;
                                    -webkit-transition: all .3s ease-in-out;
                                    transition: all .3s ease-in-out
                                }

                                .cm-star-rating label:hover,
                                .cm-star-rating label:hover~label,
                                .cm-star-rating input[type=radio]:checked~label {
                                    color: #f2b600
                                }
                            </style>
                            {{-- END STYLE FOR RATING STAR --}}
                            <section id="add-review" class="section-2 padding-x-2">
                                <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                    <h2>Give review</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <form action="{{ route('restaurant_review_store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_restaurant"
                                                    value="{{ $restaurant->id_restaurant }}" readonly required>
                                                <div class="row">
                                                    <div class="col-6 review-container">
                                                        Food
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        {{-- <div class="form-group">
                                                                <input type="number" name="food" min="1" max="5"
                                                                    class="w-100" required>
                                                            </div> --}}
                                                        <div class="cm-star-rating d-flex align-items-center">
                                                            <input id="food-star-5" type="radio" name="food"
                                                                value="5" required />
                                                            <label for="food-star-5" title="5 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="food-star-4" type="radio" name="food"
                                                                value="4" required />
                                                            <label for="food-star-4" title="4 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="food-star-3" type="radio" name="food"
                                                                value="3" required />
                                                            <label for="food-star-3" title="3 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="food-star-2" type="radio" name="food"
                                                                value="2" required />
                                                            <label for="food-star-2" title="2 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="food-star-1" type="radio" name="food"
                                                                value="1" required />
                                                            <label for="food-star-1" title="1 star">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        Service
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        {{-- <div class="form-group">
                                                                <input type="number" name="service" min="1" max="5"
                                                                    class="w-100" required>
                                                            </div> --}}
                                                        <div class="cm-star-rating d-flex align-items-center">
                                                            <input id="service-star-5" type="radio" name="service"
                                                                value="5" required />
                                                            <label for="service-star-5" title="5 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="service-star-4" type="radio" name="service"
                                                                value="4" required />
                                                            <label for="service-star-4" title="4 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="service-star-3" type="radio" name="service"
                                                                value="3" required />
                                                            <label for="service-star-3" title="3 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="service-star-2" type="radio" name="service"
                                                                value="2" required />
                                                            <label for="service-star-2" title="2 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="service-star-1" type="radio" name="service"
                                                                value="1" required />
                                                            <label for="service-star-1" title="1 star">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        Value
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        {{-- <div class="form-group">
                                                                <input type="number" name="value" min="1" max="5"
                                                                    class="w-100" required>
                                                            </div> --}}
                                                        <div class="cm-star-rating d-flex align-items-center">
                                                            <input id="value-star-5" type="radio" name="value"
                                                                value="5" required />
                                                            <label for="value-star-5" title="5 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="value-star-4" type="radio" name="value"
                                                                value="4" required />
                                                            <label for="value-star-4" title="4 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="value-star-3" type="radio" name="value"
                                                                value="3" required />
                                                            <label for="value-star-3" title="3 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="value-star-2" type="radio" name="value"
                                                                value="2" required />
                                                            <label for="value-star-2" title="2 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="value-star-1" type="radio" name="value"
                                                                value="1" required />
                                                            <label for="value-star-1" title="1 star">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        Atmosphere
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        {{-- <div class="form-group">
                                                                <input type="number" name="atmosphere" min="1" max="5"
                                                                    class="w-100" required>
                                                            </div> --}}
                                                        <div class="cm-star-rating d-flex align-items-center">
                                                            <input id="atmosphere-star-5" type="radio" name="atmosphere"
                                                                value="5" required />
                                                            <label for="atmosphere-star-5" title="5 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="atmosphere-star-4" type="radio" name="atmosphere"
                                                                value="4" required />
                                                            <label for="atmosphere-star-4" title="4 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="atmosphere-star-3" type="radio" name="atmosphere"
                                                                value="3" required />
                                                            <label for="atmosphere-star-3" title="3 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="atmosphere-star-2" type="radio" name="atmosphere"
                                                                value="2" required />
                                                            <label for="atmosphere-star-2" title="2 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="atmosphere-star-1" type="radio" name="atmosphere"
                                                                value="1" required />
                                                            <label for="atmosphere-star-1" title="1 star">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        Comment
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <textarea name="comment" rows="3" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Done</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </section>
                        @endif
                    @endcan
                @endauth
                <div class="section" id="host_end">
                    <div class="host">
                        {{-- <div class="row">
                            <div class="col-2">
                                <img src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}"
                                    style="border-radius: 50%; width: 80px; margin-left: 20px; height: 80px;">
                            </div>
                            <div class=" col-10">
                                <div class="member-profile">
                                    <h4>Hosted by {{ $restaurant->createdByDetails->first_name }}</h4>
                                    <p>Joined in November 2020</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="member-profile-desc padding-x-2">
                            <h4>Things to know</h4>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="d-flex">
                                        <h6>Restaurant Rules</h6>
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editRestaurantRules()"><i
                                                        class="fa fa-pencil-alt"
                                                        style="color:#FF7400; margin-left: 10px;"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" title="Edit"></i></a>
                                            @endif
                                        @endauth
                                    </div>

                                    <p>
                                        @if (!isset($restaurant_rules))
                                            No data found
                                        @endif

                                        @if (isset($restaurant_rules))
                                            @if ($restaurant_rules->children == 'yes')
                                                <i class="fas fa-child"></i> Childrens are allowed<br>
                                            @endif
                                            @if ($restaurant_rules->infants == 'yes')
                                                <i class="fas fa-child"></i> Infants are allowed<br>
                                            @endif
                                            @if ($restaurant_rules->pets == 'yes')
                                                <i class="fas fa-paw"></i> Pets are allowed<br>
                                            @endif
                                            @if ($restaurant_rules->smoking == 'yes')
                                                <i class="fas fa-smoking"></i> Smoking is allowed<br>
                                            @endif
                                            @if ($restaurant_rules->events == 'yes')
                                                <i class="fas fa-calendar"></i> Events are allowed<br>
                                            @endif

                                            @if ($restaurant_rules->children == 'no')
                                                <i class="fas fa-ban"></i> No children<br>
                                            @endif
                                            @if ($restaurant_rules->infants == 'no')
                                                <i class="fas fa-ban"></i> No infants<br>
                                            @endif
                                            @if ($restaurant_rules->pets == 'no')
                                                <i class="fas fa-ban"></i> No pets<br>
                                            @endif
                                            @if ($restaurant_rules->smoking == 'no')
                                                <i class="fas fa-ban"></i> No smoking<br>
                                            @endif
                                            @if ($restaurant_rules->events == 'no')
                                                <i class="fas fa-ban"></i> No events<br>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="d-flex">
                                        <h6>Health & Safety</h6>
                                        @auth
                                            @if (Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editRestaurantGuestSafety()"><i
                                                        class="fa fa-pencil-alt"
                                                        style="color:#FF7400; margin-left: 10px;"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" title="Edit"></i></a>
                                            @endif
                                        @endauth
                                    </div>

                                    <p>
                                        @forelse ($restaurant->guestSafety->take(5) as $item)
                                            <i class="fas fa-{{ $item->icon }}"></i>
                                            {{ $item->guest_safety }}<br>
                                        @empty
                                            No data found
                                        @endforelse
                                    </p>
                                    @php
                                        $countGuest = count($restaurant->guestSafety);
                                    @endphp
                                    @if ($countGuest > 5)
                                        <p>
                                            <a href="javascript:void(0)" onclick="showMoreRestaurantGuestSafety()">
                                                Show More
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </p>
                                    @endif
                                </div>
                                {{-- <div class="col-lg-4 col-md-4 col-xs-12">
                                        <h6>Cancellation Policy</h6>
                                        <p>Add your trip dates to get the cancellation details for this stay.</p>
                                        <p><a href="#">Add Date <i class="fas fa-chevron-right"></i></a></p>
                                    </div> --}}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                    <h4><span><i class="fa-solid fa-house"></i> </span> Villas</h4>
                                    @forelse ($villas_nearby as $item)
                                        @if (!empty($item))
                                            <p>{{ $item[2] }} <span>{{ $item[0] }} Km</span></p>
                                        @endif
                                    @empty
                                        No Villas Found
                                    @endforelse
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                    <h4><span><i class="fas fa-glasses"></i> </span> Top Things To Do</h4>
                                    @forelse ($thingstodo_nearby as $item)
                                        @if (!empty($item))
                                            <p>{{ $item[2] }} <span>{{ $item[0] }} Km</span></p>
                                        @endif
                                    @empty
                                        No Things To Do Found
                                    @endforelse
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                    <h4>
                                        <span><i class="fas fa-map-marker-alt"></i> </span>
                                        Closest Airport
                                    </h4>
                                    <p>
                                        <i class="fas fa-plane"></i>
                                        Ngurah Rai International Airport
                                        <span>
                                            {{ number_format($airportDistance) }} Km
                                        </span>
                                    </p>
                                    <h6>
                                        How to get to
                                        <strong>{{ $restaurant->name }}</strong>
                                        from Ngurah Rai International Airport ?
                                    </h6>
                                    <p>
                                        <i class="fas fa-car"></i> Taxi &nbsp; <i class="fas fa-bus"></i>
                                        Private Suttle
                                        &nbsp; <i class="fas fa-motorcycle"></i> GoJek
                                    </p>
                                    <p>
                                        <i class="fas fa-coffee"></i> <strong>Free welcome drink</strong> upon
                                        arrival.
                                    </p>
                                </div>
                            </div>
                            <p style="font-size: small;">* All distances are measured in straight lines. Actual
                                travel
                                distances may vary.</p>
                            <hr>
                            <h4>Nearby Villas & Things To Do</h4>
                            <div class="row">
                                <h6><span><i class="fa-solid fa-house"></i></span> Villas</h6>
                                <div class="containerSlider">
                                    <div id="slide-left-container">
                                        <div class="slide-left">
                                        </div>
                                    </div>
                                    <div id="cards-container">
                                        <div class="cards">
                                            @forelse ($nearby_villas as $item)
                                                <div class="card col-lg-3" style="border-radius: 5px;">
                                                    <a href="{{ route('villa', $item->id_villa) }}"
                                                        target="_blank">
                                                        @if ($item->image)
                                                            <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                alt="Villas"
                                                                style="width:100%; aspect-ratio: 4/4; object-fit: cover; border-radius: 15px; height: 250px;"
                                                                class="img-shadow">
                                                        @else
                                                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                alt="Villas"
                                                                style="width:100%; aspect-ratio: 4/4; object-fit: cover; border-radius: 15px; height: 250px;"
                                                                class="img-shadow">
                                                        @endif
                                                    </a>
                                                    <center>
                                                        <p style="margin-top: 10px;">
                                                        <p>{{ $item->name }}</p>
                                                        </p>
                                                    </center>
                                                </div>
                                            @empty
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <center>
                                                        <p style="margin-bottom: 0px; text-align: center;">
                                                            <span>No Villas Found</span></a>
                                                        </p>
                                                    </center>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div id="slide-right-container">
                                        <div class="slide-right">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h6><span><i class="fas fa-utensils"></i></span> Things To Do</h6>
                                <div class="containerSlider2">
                                    <div id="slide-left-container2">
                                        <div class="slide-left2">
                                        </div>
                                    </div>
                                    <div id="cards-container2">
                                        <div class="cards2">
                                            @forelse ($nearby_activities as $item)
                                                <div class="card2 col-lg-3" style="border-radius: 5px;">
                                                    <a href="{{ route('activity', $item->id_activity) }}"
                                                        target="_blank">
                                                        @if ($item->image)
                                                            <img src="{{ URL::asset('/foto/activity/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                alt="Things To Do"
                                                                style="width:100%; aspect-ratio: 4/4; object-fit: cover; border-radius: 15px; height: 250px;"
                                                                class="img-shadow">
                                                        @else
                                                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                alt="Things To Do"
                                                                style="width:100%; aspect-ratio: 4/4; object-fit: cover; border-radius: 15px; height: 250px;"
                                                                class="img-shadow">
                                                        @endif
                                                    </a>
                                                    <center>
                                                        <p style="margin-top: 10px;">
                                                        <p>{{ $item->name }}</p>
                                                        </p>
                                                    </center>
                                                </div>
                                            @empty
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <center>
                                                        <p style="margin-bottom: 0px; text-align: center;">
                                                            <span>No Things To Do Found</span></a>
                                                        </p>
                                                    </center>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div id="slide-right-container2">
                                        <div class="slide-right2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            {{-- @include('user.modal.restaurant.name') --}}
            {{-- @include('user.modal.restaurant.short_description') --}}
            {{-- @include('user.modal.restaurant.description') --}}
            {{-- @include('user.modal.restaurant.photo') --}}
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
    @endauth
    {{-- END OTHER MODAL --}}
    {{-- MODAL SCRIPT --}}
    <script>
        function edit_name() {
            $('#modal-edit_name').modal('show');
        }

        function edit_short_description() {
            $('#modal-edit_short_description').modal('show');
        }

        function edit_description() {
            $('#modal-edit_description').modal('show');
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
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-content modal-content-story video-container" style="width:980px;">
                <center>
                    <h5 class="video-title" id="story-title"></h5>
                    <video controls id="story-video" class="video-modal">
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
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
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
            </div>
        </div>
    </div>
    <script>
        function test12456(id) {
            console.log(id);
        }

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
                    video.src = public + lowerCaseUid + slash + data[0].video;
                    video.load();
                    video.play();
                    $("#video-title").html(data.name);
                    $('#videomodalrestaurant').modal('show');
                }
            });
        }
        $(function() {
            $('#videomodalrestaurant').modal({
                show: false
            }).on('hidden.bs.modal', function() {
                $(this).find('video')[0].pause();
            });
        });
    </script>
    {{-- MODAL AMENITIES --}}
    <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">All Facilities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_amenities()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    @forelse ($restaurant->facilities as $item)
                        <div class='col-6 mb-3'>
                            <span>{{ $item->name }}</span>
                        </div>
                    @empty
                        <div class='col-12 mb-3'>
                            <span>there is no facilities yet</span>
                        </div>
                    @endforelse
                </div>
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
    </script>

    {{-- MODAL TAGS --}}
    <div class="modal fade" id="modal-tag" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">All Tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_tag()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style="height: 500px; overflow-y: auto;">
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Cuisine</h5>
                        @foreach ($restaurant->cuisine as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Dietary Food</h5>
                        @foreach ($restaurant->dietaryfood as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Dishes</h5>
                        @foreach ($restaurant->dishes as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Facilities</h5>
                        @foreach ($restaurant->facilities as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Good For</h5>
                        @foreach ($restaurant->goodfor as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        <h5 class="mb-3">Meal</h5>
                        @foreach ($restaurant->meal as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
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
                url: `/restaurant/menu/${id}`,
                statusCode: {
                    500: () => {
                        alert('internal server error');
                    },
                    404: () => {
                        alert('data not found');
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
                        `{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/menu' . '/' . '${data.foto}') }}`;
                    $('#modal-menu-content').children('.modal-body').children('img').attr('src', src);
                    $('#modal-menu-content').children('.modal-body').children('h5').text(
                        `${price}`);
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
                    <h5 class="modal-title">Share</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="fs-3 fw-bold mb-0">Share this place with your friend and family</p>
                    <div class="d-flex gap-3 align-items-center py-3">
                        @if ($restaurant->image)
                            <img src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . $restaurant->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @else
                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $restaurant->name }}</p>
                    </div>
                    <div>
                        @guest
                            <div class="modal-share-container">
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a type="button" class="d-flex p-0" onclick="copy_link()">
                                        <div class="pr-5"><i class="fas fa-copy"></i> <span class="fw-normal">Copy
                                                Link</span></div>
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
                                    <a type="button" class="d-flex p-0" onclick="copy_link_auth()">
                                        <div class="pr-5"><i class="fas fa-copy"></i> <span class="fw-normal">Copy
                                                Link</span></div>
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
    @guest
        <script type="text/javascript">
            function copy_link() {
                navigator.clipboard.writeText(window.location.origin + window.location.pathname);
                alert('link has been copied');
            }
        </script>
    @endguest

    @auth
        <script type="text/javascript">
            //copy link
            function copy_link_auth() {
                let ref = `{{ Auth::user()->user_code }}`;
                navigator.clipboard.writeText(window.location.origin + window.location.pathname + "?ref=" + ref);
                alert('link has been copied');
            }
        </script>
    @endauth
    {{-- MODAL CONTACT RESTAURANT --}}
    <div class="modal fade" id="modal-contact_restaurant" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px; margin-top: 150px;">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $restaurant->name }} Contact</h5>
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
                                {{ $restaurant->phone }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="col-11">
                            <b style="font-size: 15px;" class="price-box">
                                {{ $restaurant->createdByDetails->email }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="col-11">
                            <a href="//{{ $restaurant->website }}" target="_blank">
                                <b style="font-size: 15px;" class="price-box">
                                    {{ $restaurant->website }}
                                </b>
                            </a>
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
                    <h7 class="modal-title" style="font-size: 1.875rem;">Edit Photo Position</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-photo">
                        @forelse ($restaurant->photo->sortBy('order') as $item)
                            @php
                                $id = $item->id_photo;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <img src="{{ asset('foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}"
                                    title="{{ $name }}">
                            </li>
                        @empty
                            there is no image yet
                        @endforelse
                    </ul>

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
                    <h7 class="modal-title" style="font-size: 1.875rem;">Edit Video Position</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-video">
                        @forelse ($restaurant->video->sortBy('order') as $item)
                            @php
                                $id = $item->id_video;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <video
                                    src="{{ asset('foto/restaurant/' . strtolower($restaurant->uid) . '/' . $item->name) }}#t=1.0">
                            </li>
                        @empty
                            there is no image yet
                        @endforelse
                    </ul>

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos" value='Submit'
                            onclick="save_reorder_video()">
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>

    <script src="{{ asset('assets/js/story-admin-slider.js') }}"></script>
    <script src="{{ asset('assets/js/story-slider.js') }}"></script>
    <script src="{{ asset('assets/js/thingstodo-slider.js') }}"></script>
    <script src="{{ asset('assets/js/villa-slider.js') }}"></script>
    <script src="{{ asset('assets/js/view-villa.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

    {{-- SweetAlert JS --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- REF --}}
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
        });

        function position_photo() {
            $('#edit_position_photo').modal('show');
        }
        // Save order
        function save_reorder_photo() {
            showingLoading();
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
                    id: `{{ $restaurant->id_restaurant }}`
                },
                success: function(response) {
                    location.reload();
                }
            });
        }

        function position_video() {
            $('#edit_position_video').modal('show');
        }

        function save_reorder_video() {
            showingLoading();
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
                    id: `{{ $restaurant->id_restaurant }}`
                },
                success: function(response) {
                    location.reload();
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
            formInput.value = '{{ $restaurant->name }}';
        }
    </script>

    <script>
        function editShortDescriptionForm() {
            var form = document.getElementById("short-description-form");
            var content = document.getElementById("short-description-content");
            form.classList.add("d-block");
            content.classList.add("d-none");
        }

        function editShortDescriptionCancel() {
            var form = document.getElementById("short-description-form");
            var formInput = document.getElementById("short-description-form-input");
            var content = document.getElementById("short-description-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $restaurant->short_description }}';
        }
    </script>

    <script>
        function editTimeForm() {
            var form = $("#time-form");
            var content = $("#time-content");
            $(form).show();
            $(content).hide();
        }

        function editTimeFormCancel() {
            var form = $("#time-form");
            var content = $("#time-content");
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
            var restaurantTypeInput = $('#restaurant-type-input');
            var restaurantPriceInput = $('#restaurant-price-input');
            $(restaurantTypeInput).val('{{ $restaurant->open_time }}');
            $(restaurantPriceInput).val('{{ $restaurant->closed_time }}');
            $(form).hide();
            $(content).show();
        }
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
            formInput.value = '{{ $restaurant->description }}';
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
            url: '/restaurant/photo/store',
            parallelUploads: 50,
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
                    var value = $('form#formData #id_restaurant').val();
                    formData.append('id_restaurant', value);
                });

                this.on('queuecomplete', function() {
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
        $(document).ready(function() {
            var $window = $(window);
            var $sidebar = $(".sidebar");
            var $sidebarHeight = $sidebar.innerHeight();
            var $footerOffsetTop = $(".footer").offset().top;
            var $sidebarOffset = $sidebar.offset();

            $window.scroll(function() {
                if ($window.scrollTop() > $sidebarOffset.top) {
                    $sidebar.addClass("fixed");
                } else {
                    $sidebar.removeClass("fixed");
                }
                if ($window.scrollTop() + $sidebarHeight > $footerOffsetTop) {
                    $sidebar.css({
                        "top": -($window.scrollTop() + $sidebarHeight - $footerOffsetTop)
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
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
                        url: `/restaurant/${ids.id}/delete/story/${ids.id_story}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- Sweetalert Function Delete Photo --}}
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
                        url: `/restaurant/${ids.id}/delete/photo/photo/${ids.id_photo}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- Sweetalert Function Delete Photo --}}
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
                        url: `/restaurant/${ids.id}/delete/photo/video/${ids.id_video}`,
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
                    Swal.fire('Cancel', 'Canceled Deleted Data', 'error')
                }
            });
        };
    </script>

    {{-- View Maps Restaurant --}}
    <script>
        async function view_map(id) {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: `/restaurant/map/${id}`,
                statusCode: {
                    500: () => {
                        alert('internal server error');
                    },
                    404: () => {
                        alert('data not found');
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
                    });

                    // add open google maps
                    var gotoMapButton = document.createElement("div");
                    gotoMapButton.setAttribute("style",
                        "margin: 5px; border: 1px solid; padding: 1px 12px; font: bold 11px Roboto, Arial, sans-serif; color: #000000; background-color: #FFFFFF; cursor: pointer;"
                    );
                    gotoMapButton.innerHTML = "Open Google Maps";
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gotoMapButton);
                    google.maps.event.addDomListener(gotoMapButton, "click", function() {
                        var url = `https://maps.google.com/?q=${data.latitude},${data.longitude}`;
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

    {{-- Highlight sticky --}}
    <script>
        var gallery = $('#gallery').offset().top,
            menu = $('#menu').offset().top,
            description = $('#description').offset().top,
            amenities = $('#amenities').offset().top,
            location_map = $('#location-map').offset().top,
            review = $('#review').offset().top,
            host = $('#host_end').offset().top,
            $window = $(window);

        $window.scroll(() => {
            if ($window.scrollTop() >= gallery && $window.scrollTop() < menu) {
                $('#gallery-sticky').addClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= menu && $window.scrollTop() < description) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').addClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= description && $window.scrollTop() < amenities) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').addClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= amenities && $window.scrollTop() < location_map) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').addClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= location_map && $window.scrollTop() < review) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#menu-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#location-sticky').addClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= review && $window.scrollTop() < host) {
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
            }
        });
    </script>

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

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
    <script>
        function language() {
            $('#LegalModal').modal('show');
        }
    </script>
</body>
