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

    {{-- DROPZONE --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
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

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/villa-slider.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
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

        .active-sticky span,
        .active-sticky {
            color: #ff7400;
        }
    </style>

    {{-- style reorder image --}}
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable li {
            padding: 2px;
            display: table;
            width: 16.66666667%;
            float: left;
            border: 0;
            background: none;
        }

        #sortable li img {
            width: 100%;
            height: 140px;
            border-radius: 15px;
        }
    </style>
    {{-- /reorder image --}}
</head>

<body style="background-color:white">
    <div id="page-container">
        <div class="page">
            <!-- HEADER -->
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
                                        @if ($villa[0]->is_favorit)
                                            <p>
                                                <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i
                                                        class="fa fa-heart"
                                                        style="color: #f00;  font-size: 18px;"></i>
                                                    <span>CANCEL</span>
                                                </a>
                                            </p>
                                        @else
                                            <p>
                                                <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i
                                                        class="fa fa-heart"
                                                        style="color: #aaa;  font-size: 18px;"></i>
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
            <!-- PROFILE -->
            <div class="profile-wrap">
                <div class="profile-avatar">
                    {{-- <div class="circ-story circ-gradient"></div> --}}
                    <img
                        src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant[0]->name) . '/' . $restaurant[0]->image) }}">
                    <div class="amenities" style="padding-top: 5px">
                        {{-- @foreach ($amenities as $item)
                        <i class="fa fa-{{ $item->icon }}" style="color:green; padding-right:5px;"
                        data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                        title="{{ $item->name }}"></i>
                        @endforeach --}}
                        {{-- <a type="button" onclick="amenities()"><i class="fa fa-plus-square" style="color:green; padding-right:5px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="See More"></i></a> --}}
                    </div>
                </div>

                <div class="profile-info">
                    <div class="profile-title" style="padding-top: 10px;">
                        <h2 style="font-weight: bold;">{{ $restaurant[0]->name }}</h2>
                    </div>
                    <!-- Profile Stats -->
                    {{-- <ul class="profile-numbers mb-1rem">
                    <li>
                        <a href="#">
                            <span class="profile-posts">6</span>
                            Booked
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="profile-followers">800B</span>
                            Rating
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="profile-following">10</span>
                            Views
                        </a>
                    </li>
                </ul> --}}
                    <div class="profile-bio" style="padding-top: 0">
                        <span class="profile-desc">
                            <i class="fa fa-star" style="color: orange; font-size:14px"></i>
                            {{ $ratting[0]->average }}
                            reviews
                            <br>
                            {{-- <iclass="fafa-bed"style="color:rgb(0,110,255);font-size:14px"></i>$restaurant[0]->bedroom Bedrooms - <i class="fa fa-bath" style="color: rgb(0, 110, 255); font-size:14px"></i> {{ $restaurant[0]->bathroom }}
                            Bathroom
                            <br>
                            <i class="fa fa-user-friends" style="color: rgb(0, 110, 255); font-size:14px"></i>
                            {{ $restaurant[0]->adult }} Adults - <i class="fa fa-child"
                                style="color: rgb(0, 110, 255); font-size:14px"></i> {{ $restaurant[0]->children }}
                            Children
                            <br> --}}
                        </span>
                        <i class="fa fa-map-marker-alt" style="color: rgb(0, 110, 255); font-size:14px"></i> <a
                            href="https://maps.google.com/?q={{ $restaurant[0]->latitude }},{{ $restaurant[0]->longitude }}"
                            target="_blank">{{ $restaurant[0]->location }}</a>
                    </div>
                </div>

                {{-- Reserve NOW --}}
                {{-- <div class="reserve">
                <div class="block block-rounded" style="border:1px crimson solid">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                      <div class="item">
                        <i class="fa fa-2x fa-home text-black-75"></i>
                      </div>
                      <div class="ms-3 text-end">
                        <p class="text-black fs-lg fw-semibold mb-0" style="font-weight: bold">
                            Rp. {{ number_format($restaurant[0]->price, 0, ',', '.') }}
                </p>
                <p class="text-black-75 mb-0">
                    /night
                </p>
            </div>
        </div>
        <div style="text-align: center; padding-bottom:10px;">
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-reserve">
                Reserve Now
            </button>
        </div>
    </div>
    </div> --}}
            </div>

            <!-- STORIES -->
            <div class="stories-wrap">
                <ul class="stories inner-wrap">
                    @foreach ($stories as $item)
                        <li class="story">
                            <div class="img-wrap">
                                <a type="button" onclick="view({{ $item->id_story }});">
                                    <i class="fas fa-2x fa-play-circle"
                                        style="position: absolute; bottom:50%; left:40%; color:white"></i>
                                    <img
                                        src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant[0]->name) . '/' . $item->thumbnail) }}">
                                </a>
                            </div>
                            <div class="story-title">
                                {{ $item->title }}
                            </div>
                        </li>
                    @endforeach

                    @if ($stories->count() == 0 || $video->count() == 0)
                        <li class="story">
                            <div class="img-wrap">
                                <a type="button" onclick="requestVideo({{ $restaurant[0]->created_by }})">
                                    <img class="lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/2.png') }}">
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- RESPONSIVE PROFILE NUMBERS -->
            <ul class="profile-numbers responsive-profile">
                {{-- Rp. {{ number_format($restaurant[0]->price, 0, ',', '.') }} /night
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-reserve">
            Reserve Now
        </button> --}}
            </ul>
            <!-- CONTENT -->
        </div>

        <main>
            <div class="sticky-div">
                <ul class="navigationList">
                    <li class="navigationItem {{ request()->routeIs('restaurant') ? 'active' : '' }}">
                        <form action="{{ route('restaurant', $restaurant[0]->id_restaurant) }}" method="GET">
                            <button class="navigationItem__Button" type="submit">

                                <svg aria-label="Posts" class="navigationItem__Icon" fill="#262626" viewBox="0 0 48 48">
                                    <path clip-rule="evenodd"
                                        d="M45 1.5H3c-.8 0-1.5.7-1.5 1.5v42c0 .8.7 1.5 1.5 1.5h42c.8 0 1.5-.7 1.5-1.5V3c0-.8-.7-1.5-1.5-1.5zm-40.5 3h11v11h-11v-11zm0 14h11v11h-11v-11zm11 25h-11v-11h11v11zm14 0h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11zm14 28h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11z"
                                        fill-rule="evenodd"></path>
                                </svg>
                                <span class="navigationItem__Text">PHOTOS</span>
                            </button>
                        </form>
                    </li>
                    <li class="navigationItem {{ request()->routeIs('restaurant_video') ? 'active' : '' }}">
                        <form action="{{ route('restaurant_video', $restaurant[0]->id_restaurant) }}" method="GET">
                            <button class="navigationItem__Button" type="submit">
                                <svg aria-label="Igtv" class="navigationItem__Icon" fill="#8e8e8e" viewBox="0 0 48 48">
                                    <path
                                        d="M41 10c-2.2-2.1-4.8-3.5-10.4-3.5h-3.3L30.5 3c.6-.6.5-1.6-.1-2.1-.6-.6-1.6-.5-2.1.1L24 5.6 19.7 1c-.6-.6-1.5-.6-2.1-.1-.6.6-.7 1.5-.1 2.1l3.2 3.5h-3.3C11.8 6.5 9.2 7.9 7 10c-2.1 2.2-3.5 4.8-3.5 10.4v13.1c0 5.7 1.4 8.3 3.5 10.5 2.2 2.1 4.8 3.5 10.4 3.5h13.1c5.7 0 8.3-1.4 10.5-3.5 2.1-2.2 3.5-4.8 3.5-10.4V20.5c0-5.7-1.4-8.3-3.5-10.5zm.5 23.6c0 5.2-1.3 7-2.6 8.3-1.4 1.3-3.2 2.6-8.4 2.6H17.4c-5.2 0-7-1.3-8.3-2.6-1.3-1.4-2.6-3.2-2.6-8.4v-13c0-5.2 1.3-7 2.6-8.3 1.4-1.3 3.2-2.6 8.4-2.6h13.1c5.2 0 7 1.3 8.3 2.6 1.3 1.4 2.6 3.2 2.6 8.4v13zM34.6 25l-9.1 2.8v-3.7c0-.5-.2-.9-.6-1.2-.4-.3-.9-.4-1.3-.2l-11.1 3.4c-.8.2-1.2 1.1-1 1.9.2.8 1.1 1.2 1.9 1l9.1-2.8v3.7c0 .5.2.9.6 1.2.3.2.6.3.9.3.1 0 .3 0 .4-.1l11.1-3.4c.8-.2 1.2-1.1 1-1.9s-1.1-1.2-1.9-1z">
                                    </path>
                                </svg>
                                <span class="navigationItem__Text">VIDEOS</span>
                            </button>
                        </form>
                    </li>
                    <li class="navigationItem {{ request()->routeIs('restaurant_description') ? 'active' : '' }}">
                        <form action="{{ route('restaurant_description', $restaurant[0]->id_restaurant) }}"
                            method="GET">
                            <button class="navigationItem__Button" type="submit">
                                <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385">
                                    </path>
                                </svg>
                                <span class="navigationItem__Text">DESCRIPTION</span>
                            </button>
                        </form>
                    </li>
                    <li class="navigationItem {{ request()->routeIs('restaurant_menu') ? 'active' : '' }}">
                        <form action="{{ route('restaurant_menu', $restaurant[0]->id_restaurant) }}" method="GET">
                            <button class="navigationItem__Button" type="submit">
                                <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385">
                                    </path>
                                </svg>
                                <span class="navigationItem__Text">MENU</span>
                            </button>
                        </form>
                    </li>
                    {{-- <li class="navigationItem">
                <form action="" method="GET">
                <button class="navigationItem__Button" type="submit">
                    <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e" viewBox="0 0 20 20">
                        <path
                            d="M16.557,4.467h-1.64v-0.82c0-0.225-0.183-0.41-0.409-0.41c-0.226,0-0.41,0.185-0.41,0.41v0.82H5.901v-0.82c0-0.225-0.185-0.41-0.41-0.41c-0.226,0-0.41,0.185-0.41,0.41v0.82H3.442c-0.904,0-1.64,0.735-1.64,1.639v9.017c0,0.904,0.736,1.64,1.64,1.64h13.114c0.904,0,1.64-0.735,1.64-1.64V6.106C18.196,5.203,17.461,4.467,16.557,4.467 M17.377,15.123c0,0.453-0.366,0.819-0.82,0.819H3.442c-0.453,0-0.82-0.366-0.82-0.819V8.976h14.754V15.123z M17.377,8.156H2.623V6.106c0-0.453,0.367-0.82,0.82-0.82h1.639v1.23c0,0.225,0.184,0.41,0.41,0.41c0.225,0,0.41-0.185,0.41-0.41v-1.23h8.196v1.23c0,0.225,0.185,0.41,0.41,0.41c0.227,0,0.409-0.185,0.409-0.41v-1.23h1.64c0.454,0,0.82,0.367,0.82,0.82V8.156z">
                        </path>
                    </svg>
                    <span class="navigationItem__Text">AVAILABALITY</span>
                </button>
                </form>
            </li> --}}
                    <li class="navigationItem {{ request()->routeIs('villa_review') ? 'active' : '' }}">
                        <form action="" method="GET">
                            <button class="navigationItem__Button" type="submit">
                                <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M17.659,3.681H8.468c-0.211,0-0.383,0.172-0.383,0.383v2.681H2.341c-0.21,0-0.383,0.172-0.383,0.383v6.126c0,0.211,0.172,0.383,0.383,0.383h1.532v2.298c0,0.566,0.554,0.368,0.653,0.27l2.569-2.567h4.437c0.21,0,0.383-0.172,0.383-0.383v-2.681h1.013l2.546,2.567c0.242,0.249,0.652,0.065,0.652-0.27v-2.298h1.533c0.211,0,0.383-0.172,0.383-0.382V4.063C18.042,3.853,17.87,3.681,17.659,3.681 M11.148,12.87H6.937c-0.102,0-0.199,0.04-0.27,0.113l-2.028,2.025v-1.756c0-0.211-0.172-0.383-0.383-0.383H2.724V7.51h5.361v2.68c0,0.21,0.172,0.382,0.383,0.382h2.68V12.87z M17.276,9.807h-1.533c-0.211,0-0.383,0.172-0.383,0.383v1.755L13.356,9.92c-0.07-0.073-0.169-0.113-0.27-0.113H8.851v-5.36h8.425V9.807z">
                                    </path>
                                </svg>
                                <span class="navigationItem__Text">REVIEW</span>
                            </button>
                        </form>
                    </li>
                    {{-- <li class="navigationItem">
                <div id="reserve_button" class="reserve_button hide" style="padding-top:10px;">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-reserve">
                        Reserve Now
                    </button>
                </div>
            </li> --}}
                </ul>
            </div>
            @yield('content')

            <!-- Fade In Default Modal -->
            {{-- <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">All Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" >
                    @php
                        $amenities = App\Http\Controllers\ViewController::amenities($restaurant[0]->id_villa);
                        $bathroom = App\Http\Controllers\ViewController::bathroom($restaurant[0]->id_villa);
                        $bedroom = App\Http\Controllers\ViewController::bedroom($restaurant[0]->id_villa);
                        $kitchen = App\Http\Controllers\ViewController::kitchen($restaurant[0]->id_villa);
                        $safety = App\Http\Controllers\ViewController::safety($restaurant[0]->id_villa);
                        $service = App\Http\Controllers\ViewController::service($restaurant[0]->id_villa);
                        echo '<div class="row">';
                        foreach($amenities as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                        echo '<hr>';

                        echo '<h5>Bathroom</h5>';
                        echo '<div class="row">';
                        foreach($bathroom as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                        echo '<hr>';

                        echo '<h5>Bedroom</h5>';
                        echo '<div class="row">';
                        foreach($bedroom as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                        echo '<hr>';

                        echo '<h5>Kitchen</h5>';
                        echo '<div class="row">';
                        foreach($kitchen as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                        echo '<hr>';

                        echo '<h5>Safety</h5>';
                        echo '<div class="row">';
                        foreach($safety as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                        echo '<hr>';

                        echo '<h5>Service</h5>';
                        echo '<div class="row">';
                        foreach($service as $item)
                        {
                           echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span></div>";
                        }
                        echo '</div>';
                    @endphp
                </div>
            </div>
            </div>
        </div> --}}
            <!-- END Fade In Default Modal -->

            <!-- Fade In Default Modal -->
            {{-- <div class="modal fade" id="modal-reserve" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Reserve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" >
                    <!-- Dynamic Table Full -->
                    <form action="{{ route('villa_booking_confirm') }}" method="POST" id="basic-form"
        class="js-validation" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" id="id_villa" name="id_villa" value="{{ $restaurant[0]->id_villa }}">
        <div class="block-content">
            <span class="content-heading border-bottom mb-4 pb-2">Booking Information</span>
            <div class="block-content font-size-sm mb-4">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label" for="adult">Adult <span class="text-danger">*</span></label>
                        <input type="number" max="{{ $restaurant[0]->adult }}" class="form-control" id="adult"
                            name="adult" placeholder="Enter a adult number..">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="child">Children <span class="text-danger">*</span></label>
                        <input type="number" max="{{ $restaurant[0]->children }}" class="form-control" id="child"
                            name="child" placeholder="Enter a children number..">
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="min_stay" name="min_stay" value="{{ $restaurant[0]->min_stay }}">
                    <div class="col-sm-6">
                        <label class="form-label" for="check_in">Check In <span class="text-danger">*</span></label>
                        <input type="text" class="flatpickr form-control bg-white" id="check_in" name="check_in"
                            placeholder="Y-m-d">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="check_out">Check Out <span class="text-danger">*</span></label>
                        <input type="text" class="flatpickr form-control bg-white" id="check_out" name="check_out"
                            placeholder="Y-m-d">
                    </div>
                    <input type="hidden" id="sum_night" name="sum_night">
                </div>
            </div>

            <span class="content-heading border-bottom mb-4 pb-2">Customer Information</span>
            <div class="block-content font-size-sm">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                        @if (Auth::guest())
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            placeholder="Enter a phone firstname..">
                        @else
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            value="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                        @if (Auth::guest())
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            placeholder="Enter a lastname..">
                        @else
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            value="{{ Auth::user()->name }}">
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        @if (Auth::guest())
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter a email..">
                        @else
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        @if (Auth::guest())
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter a phone number..">
                        @else
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ Auth::user()->phone }}">
                        @endif

                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="row items-push">
                <div class="col-lg-7">
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-check"></i> Reserve
                    </button>
                </div>
            </div>
            <!-- END Submit -->
        </div>
        </form>
        <!-- END Dynamic Table Full -->
        </div>
        </div>
        </div>
        </div> --}}
            <!-- END Fade In Default Modal -->

            <!-- Modal -->
            <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
                aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
                style="border-radius: 10px;">
                <div class="modal-dialog modal-xl" role="document">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                        <center>
                            <input type="hidden" id="id_story" name="id_story" value="">
                            <input type="hidden" id="villa" name="villa" value="{{ $restaurant[0]->name }}">
                            <input type="hidden" id="id_villa" name="id_villa"
                                value="{{ $restaurant[0]->id_restaurant }}">

                            <video controls id="video1" style="border-radius: 25px; position:relative; display:block;">
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
            </div>

            {{-- <a href="#" class="float">
            <i class="my-float" style=></i> Reserve
        </a> --}}
        </main>
    </div>
    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>


    <script src="{{ asset('assets/js/story-admin-slider.js') }}"></script>
    <script src="{{ asset('assets/js/story-slider.js') }}"></script>
    <script src="{{ asset('assets/js/thingstodo-slider.js') }}"></script>
    <script src="{{ asset('assets/js/villa-slider.js') }}"></script>

    <script>
        Dashmix.helpersOnLoad(['jq-slick']);
    </script>
    <script>
        Dashmix.helpersOnLoad(['jq-magnific-popup']);
    </script>

    <script>
        $('#check_in').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                $('#check_out').flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: new Date(dateStr).fp_incr(1),
                    onChange: function(selectedDates, dateStr, instance) {
                        var start = new Date($('#check_in').val());
                        var end = new Date($('#check_out').val());
                        var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                        var min_stay = $('#min_stay').val();
                        var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                        if (sum_night < min_stay) {
                            alert("minimum stay is " + min_stay + " days");
                        }
                    }
                });
            }
        });
    </script>

    <script>
        function amenities() {
            $('#modal-amenities').modal('show');
        }
    </script>

    <script>
        $(document).scroll(function() {

            myID = document.getElementById("reserve_button");

            var myScrollFunc = function() {
                var y = window.scrollY;
                if (y >= 220) {
                    myID.className = "reserve_button show"
                } else {
                    myID.className = "reserve_button hide"
                }
            };

            window.addEventListener("scroll", myScrollFunc);
        });
    </script>

    <script>
        function view(id) {
            $.ajax({
                type: "GET",
                url: "/restaurant_story/" + id,
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_story"]').val(data[0].id_story);
                    var villa = document.getElementById("villa").value;
                    var video = document.getElementById('video1');
                    var public = '/foto/restaurant/';
                    var slash = '/';
                    video.src = public + villa + slash + data[0].name;
                    video.load();
                    video.play();
                    $("#title").html(data[0].title);
                    $('#price').html(data[0].created_at);
                    $('#videomodal').modal('show');
                }
            });
        }

        $("#video1").on("ended", function() {
            // $('#videomodal').modal('hide');
            var id = document.getElementById("id_story").value;
            var id_villa = document.getElementById("id_villa").value;
            $.ajax({
                type: "GET",
                url: "/restaurant_story/next/" + id + '/' + id_villa,
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_story"]').val(data[0].id_story);
                    var villa = document.getElementById("villa").value;
                    var video = document.getElementById('video1');
                    var public = '/foto/restaurant/';
                    var slash = '/';
                    video.src = public + villa + slash + data[0].name;
                    video.load();
                    video.play();
                    $("#title").html(data[0].title);
                    $('#price').html(data[0].created_at);
                    $('#videomodal').modal('show');
                }
            });
        });

        $(function() {
            $('#videomodal').modal({
                show: false
            }).on('hidden.bs.modal', function() {
                $(this).find('video')[0].pause();
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
