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

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <style>
    label {
    width: 100%;
    font-weight: bold;
    display: inline-block;
    margin-top: 20px;
    }

    label span {
    font-size: 0.8rem;
    }

    label.error {
        color: red;
        font-size: 0.8rem;
        display: block;
        margin-top: 5px;
    }

    label.error.fail-alert {
        background: #ffe6eb;
    }

    input.valid.success-alert {
        border: 2px solid #4CAF50;
        color: green;
    }

    input.error, textarea.error {
        font-weight: 300;
        color: red;
    }
    </style>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #fafafa;
        }

        .navigationList {
            list-style: none;
            display: flex;
            justify-content: center;
            border-top: 1px solid #dbdbdb;
            border-bottom: 1px solid #dbdbdb;
        }

        .navigationItem {
            position: relative;
            width: 33.3%;
            display: flex;
            justify-content: center;
        }

        .navigationItem:last-child {
            margin-right: 0;
        }

        .navigationItem.active .navigationItem__Text {
            color: #000;
        }

        .navigationItem.active .navigationItem__Icon path {
            fill: #0095f6;
        }

        .navigationItem__Button {
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            appearance: none;
            -webkit-appearance: none;
            padding: 12px 0;
            cursor: pointer;
        }

        .navigationItem__Icon {
            width: 24px;
            height: 24px;
        }

        .navigationItem__Text {
            display: none;
            font-weight: bold;
            font-size: 12px;
            color: #868686;
            letter-spacing: 0.7px;
        }

        .photosGrid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .photosGrid__Photo {
            width: 33.3%;
            width: calc(33.3% - 2px);
            height: 30vw;
            background-position: center;
            background-size: cover;
            margin-bottom: 3px;
        }

        

        @media screen and (min-width: 736px) {
            main {
                padding: 20px;
            }

            .navigationList {
                border-bottom: none;
            }

            .navigationItem {
                width: auto;
                margin-right: 50px;
            }

            .navigationItem__Button {
                padding: 18px 0;
            }

            .navigationItem__Text {
                display: block;
            }

            .navigationItem__Icon {
                margin-right: 6px;
                width: 12px;
                height: 12px;
            }

            .navigationItem.active::before {
                content: '';
                position: absolute;
                height: 1px;
                width: 100%;
                background-color: #000;
                top: -1px;
                left: 0;
                right: 0;
            }

            .navigationItem.active .navigationItem__Icon path {
                fill: #000;
            }

            .photosGrid__Photo {
                width: calc(25% - 16px);
                margin-bottom: 26px;
            }

            .sticky-div{
                position : sticky;
            }

            .sticky-div2{
                position : sticky;
            }
        }

        @media screen and (min-width: 980px) {
            main {
                width: 1280px;
                margin: auto;
            }

            .photosGrid__Photo {
                height: 293px;
            }

            .sticky-div{
                position : sticky;
            }

            .sticky-div2{
                position : sticky;
            }
            
        }

        .sticky-div {
            background-color: white;
            position: sticky;
            top: 0px;
            z-index: 99;
            overflow: hidden
            display: flex
            left : 0
            right: 0
            justify-content: center
            /* padding: 10px 0px; */
        }

        .sticky-div2 {
            background-color: white;
            position: sticky;
            top: 50px;
            z-index: 99;
            overflow: hidden
            display: flex
            left : 0
            right: 0
            justify-content: center
            /* padding: 10px 0px; */
        }

        .hide {
            opacity:0;
        }
        .show {
            opacity:1;
        }

        .video-container {
            position: relative;
        }
        .video-container .overlay-desc {
            position: relative;
            z-index: 999;
            max-width: 900px;
            margin : 0 auto;
            margin-top : 300px;
            margin-left : 20px;
            background: rgba(0,0,0,0);
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .video-container .overlay-desc h5 {
            color: white;
            font-size: 1.5rem;
        }

        .video-container .overlay-desc p:not(.p-smaller) {
            color: white;
            font-size: 1.1rem;
            line-height: 1.7rem;
            font-weight: 600;
        }
        .video-container .overlay-desc p.p-smaller {
            color: white;
            font-size: 13px;
            line-height: 1;
            font-weight: 400;
            max-width: 375px;
        }
        .video-container .overlay-desc .action_button {
            color: white;
            border-color: white;
            margin: 10px 0;
        }

        video{
            width: 1000px;
            height:auto
        }
    </style>
</head>

<body style="background-color:white">
<div id="page-container" >
    <div class="page">
        <!-- HEADER -->
        <header>
            <div class="head-inner-wrap">
                <div class="logo">
                    <a href="#" target="_blank">
                        <h3>EZV2</h3>
                    </a>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <span><i class="fa fa-search"></i></span>
                </div>
                <div class="btn">
                    <a href="#" class="cta">Log In</a>
                    <a href="#">Sign Up</a>
                </div>
            </div>
        </header>
        <!-- PROFILE -->
        <div class="profile-wrap">
            <div class="profile-avatar">
                {{-- <div class="circ-story circ-gradient"></div> --}}
                <img src="{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$activity[0]->image)}}">
                <div class="amenities" style="padding-top: 5px">
                    {{-- @foreach($amenities as $item)
                        <i class="fa fa-{{ $item->icon }}" style="color:green; padding-right:5px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="{{ $item->name }}"></i>
                    @endforeach --}}
                    {{-- <a type="button" onclick="amenities()"><i class="fa fa-plus-square" style="color:green; padding-right:5px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="See More"></i></a> --}}
                </div>
            </div>
            
            <div class="profile-info">
                <div class="profile-title" style="padding-top: 10px;">
                    <h2 style="font-weight: bold;">{{ $activity[0]->name }}</h2>
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
                        <i class="fa fa-star" style="color: orange; font-size:14px"></i> {{ $ratting[0]->average }} reviews
                        <br>
                        {{-- <iclass="fafa-bed"style="color:rgb(0,110,255);font-size:14px"></i>$restaurant[0]->bedroom Bedrooms - <i class="fa fa-bath" style="color: rgb(0, 110, 255); font-size:14px"></i> {{ $restaurant[0]->bathroom }} Bathroom
                        <br> 
                        <i class="fa fa-user-friends" style="color: rgb(0, 110, 255); font-size:14px"></i> {{ $restaurant[0]->adult }} Adults - <i class="fa fa-child" style="color: rgb(0, 110, 255); font-size:14px"></i> {{ $restaurant[0]->children }} Children
                        <br> --}}
                    </span> 
                    <i class="fa fa-map-marker-alt" style="color: rgb(0, 110, 255); font-size:14px"></i> <a href="https://maps.google.com/?q={{$activity[0]->latitude}},{{$activity[0]->longitude}}" target="_blank">{{ $activity[0]->location }}</a>
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
                @foreach($stories as $item)
                <li class="story">
                    <div class="img-wrap">
                        <a type="button" onclick="view({{ $item->id_story }});">
                            <i class="fas fa-2x fa-play-circle" style="position: absolute; bottom:50%; left:40%; color:white"></i>
                            <img src="{{ URL::asset('/foto/activity/'.strtolower($activity[0]->name).'/'.$item->thumbnail)}}">
                        </a>
                    </div>
                    <div class="story-title">
                        {{ $item->title }}
                    </div>
                </li>
                @endforeach
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
            <li class="navigationItem {{ request()->routeIs('activity') ? 'active' : '' }}">
                <form action="{{ route('activity',$activity[0]->id_activity) }}" method="GET">
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
            <li class="navigationItem {{ request()->routeIs('activity_video') ? 'active' : '' }}">
                <form action="{{ route('activity_video', $activity[0]->id_activity) }}" method="GET">
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
            <li class="navigationItem {{ request()->routeIs('activity_description') ? 'active' : '' }}">
                <form action="{{ route('activity_description', $activity[0]->id_activity) }}" method="GET">
                <button class="navigationItem__Button" type="submit">
                    <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e" viewBox="0 0 20 20">
                        <path
                            d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385">
                        </path>
                    </svg>
                    <span class="navigationItem__Text">DESCRIPTION</span>
                </button>
                </form>
            </li>
            <li class="navigationItem {{ request()->routeIs('activity_price') ? 'active' : '' }}">
                <form action="{{ route('activity_price', $activity[0]->id_activity) }}" method="GET">
                <button class="navigationItem__Button" type="submit">
                    <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e" viewBox="0 0 20 20">
                        <path
                            d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385">
                        </path>
                    </svg>
                    <span class="navigationItem__Text">Price</span>
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
                    <svg aria-label="Tagged" class="navigationItem__Icon" fill="#8e8e8e" viewBox="0 0 20 20">
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
            </li>             --}}
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
                    <form action="{{ route('villa_booking_confirm') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" id="id_villa" name="id_villa" value="{{ $restaurant[0]->id_villa }}">
                        <div class="block-content">            
                            <span class="content-heading border-bottom mb-4 pb-2">Booking Information</span>
                            <div class="block-content font-size-sm mb-4">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="adult">Adult <span class="text-danger">*</span></label>
                                        <input type="number" max="{{ $restaurant[0]->adult }}" class="form-control" id="adult" name="adult" placeholder="Enter a adult number..">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="child">Children <span class="text-danger">*</span></label>
                                        <input type="number" max="{{ $restaurant[0]->children }}" class="form-control" id="child" name="child" placeholder="Enter a children number..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="min_stay" name="min_stay" value="{{ $restaurant[0]->min_stay }}">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="check_in">Check In <span class="text-danger">*</span></label>
                                        <input type="text" class="flatpickr form-control bg-white" id="check_in" name="check_in" placeholder="Y-m-d">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="check_out">Check Out <span class="text-danger">*</span></label>
                                        <input type="text" class="flatpickr form-control bg-white" id="check_out" name="check_out" placeholder="Y-m-d">
                                    </div>
                                    <input type="hidden" id="sum_night" name="sum_night">
                                </div>
                            </div>

                            <span class="content-heading border-bottom mb-4 pb-2">Customer Information</span>
                            <div class="block-content font-size-sm">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                                        @if(Auth::guest())
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter a phone firstname..">
                                        @else
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ Auth::user()->name }}">
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                                        @if(Auth::guest())
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter a lastname..">
                                        @else
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ Auth::user()->name }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                        @if(Auth::guest())
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter a email..">
                                        @else
                                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                        @if(Auth::guest())
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter a phone number..">
                                        @else
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
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
         <div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;"> 
            <div class="modal-dialog modal-xl" role="document">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                    <center>
                    <input type="hidden" id="id_story" name="id_story" value="">
                    <input type="hidden" id="villa" name="villa" value="{{ $activity[0]->name }}">
                    <input type ="hidden" id="id_villa" name="id_villa" value="{{ $activity[0]->id_activity }}">
                    
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
    <script src="{{asset('assets/js/dashmix.app.min.js')}}"></script>

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script>Dashmix.helpersOnLoad(['jq-slick']);</script>
    <script>Dashmix.helpersOnLoad(['jq-magnific-popup']);</script>

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
                   onChange: function(selectedDates, dateStr, instance){
                       var start = new Date($('#check_in').val());
                       var end = new Date($('#check_out').val());
                       var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                       var min_stay = $('#min_stay').val();
                       var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                       if(sum_night < min_stay)
                       {
                           alert("minimum stay is " + min_stay + " days");
                       }
                   }
               }); 
           }
        });
    </script>

    <script>
        function amenities(){
            $('#modal-amenities').modal('show');
        }
    </script>
    
    <script>
        $(document).scroll(function() {
    
            myID = document.getElementById("reserve_button");
    
            var myScrollFunc = function () {
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
        function view(id){
            $.ajax({
            type: "GET",
            url: "/activity_story/" + id,
            dataType: "JSON",
            success: function(data){
                $('[name="id_story"]').val(data[0].id_story);
                var villa = document.getElementById("villa").value;
                var video = document.getElementById('video1');
                var public = '/foto/activity/';
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
            url: "/activity_story/next/" + id + '/' + id_villa,
            dataType: "JSON",
            success: function(data){
                $('[name="id_story"]').val(data[0].id_story);
                var villa = document.getElementById("villa").value;
                var video = document.getElementById('video1');
                var public = '/foto/activity/';
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

        $(function(){
            $('#videomodal').modal({
                show: false
            }).on('hidden.bs.modal', function(){
                $(this).find('video')[0].pause();
            });
        });
    </script>

    @yield('scripts')
</body>

</html>