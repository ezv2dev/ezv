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

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <!-- END Icons -->

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <style>
        .btn-primary {
            background-color: #ff7400;
            border-color: #ff7400;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
        }

    </style>

    {{-- IMAGE UPLOAD STYLE --}}
    <style>
        .file-upload {
            .image-box {
                margin: 0 auto;
                margin-top: 1em;
                height: 15em;
                width: 20em;
                background: #d24d57;
                cursor: pointer;
                overflow: hidden;

                img {
                    height: 10%;
                    display: none;
                }

                p {
                    position: relative;
                    top: 45%;
                }

            }
        }
    </style>
    {{-- END IMAGE UPLOAD STYLE --}}

    {{-- GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}
    <style>
        .pac-container{
            z-index:9999;
        }
    </style>
    {{-- END GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

</head>

<body style="background-color:white">
    {{-- <input type="hidden" id="min_stay" name="min_stay" value="{{ $restaurant->min_stay }}"> --}}
    {{-- <input type="hidden" id="price" name="price" value="{{ $restaurant->price }}"> --}}
    <div id="page-container">
        {{-- HEADER --}}
        <header>
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}
        <div class="row page-content">
            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block">
                {{-- PROFILE --}}
                <div class="row top-profile">
                    <div class="col-lg-4- col-md-4 col-xs-12">
                        <div class="profile-image">
                            <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_restaurant_profile()">
                                        <i class="fa fa-pencil-alt"
                                            style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                    </a>
                                @endif
                            @endauth
                            <div class="amenities">
                                {{-- @if($amenities->count() > 0)
                                    @foreach($amenities as $item)
                                        <i class="fa fa-{{ $item->icon }}" data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom" title="{{ $item->name }}"></i>
                                    @endforeach
                                    <a type="button" onclick="amenities()">MORE</a>
                                @else
                                    @auth
                                        @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="edit_amenities()">MORE</a>
                                        @endif
                                    @endauth
                                @endif --}}
                                <p>AMENITIES</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12">
                        {{-- RESTAURANT NAME --}}
                            <h2 id="name-content">
                                {{ $restaurant->name }}
                                @auth
                                    @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editNameForm()">
                                            <i class="fa fa-pencil-alt"
                                                style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                        </a>
                                    @endif
                                @endauth
                            </h2>
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="name-form" style="display:none;">
                                        <form action="{{ route('restaurant_update_name') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}" required>
                                            <input type="text" name="name" id="name-form-input" value="{{ $restaurant->name }}" required>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fa fa-check"></i> Done
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary" onclick="editNameCancel()">
                                                <i class="fa fa-xmark"></i> Cancel
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        {{-- END RESTAURANT NAME --}}
                        {{-- <p>{{ $restaurant->bedroom }} Bedrooms | {{ $restaurant->bathroom }} Bathroom |
                            {{ $restaurant->adult }} Adults | {{ $restaurant->children }} Children
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 ||
                                    Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_bedroom()">
                                        <i class="fa fa-pencil-alt"
                                            style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                    </a>
                                @endif
                            @endauth
                        </p> --}}
                        <p style="margin-top: 20px;">
                            <a href="https://maps.google.com/?q={{$restaurant->latitude}},{{$restaurant->longitude}}" target="_blank">
                                <i class="fa fa-map-marker-alt" style="font-size:14px"></i>
                                {{ $restaurant->location->name }}
                            </a>
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_location()">
                                        <i class="fa fa-pencil-alt"
                                            style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                    </a>
                                @endif
                            @endauth
                        </p>
                        {{-- SHORT DESCRIPTION --}}
                            <p class="short-desc" id="short-description-content">{{ $restaurant->short_description }}
                                @auth
                                    @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editShortDescriptionForm()">
                                            <i class="fa fa-pencil-alt"
                                                style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                        </a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="short-description-form" style="display:none;">
                                        <form action="{{ route('restaurant_update_short_description') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_restaurant" value="{{ $restaurant->id_restaurant }}" required>
                                            <textarea name="short_description" id="short-description-form-input" cols="30" rows="3" maxlength="255" required>{{ $restaurant->short_description }}</textarea>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fa fa-check"></i> Done
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-secondary" onclick="editShortDescriptionCancel()">
                                                <i class="fa fa-xmark"></i> Cancel
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        {{-- END SHORT DESCRIPTION --}}
                        <ul class="stories inner-wrap">
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    @if($restaurant->story->count() == 0)
                                        @for($i = 0; $i < 5; $i++)
                                            <li class="story dropzone">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img src="{{ URL::asset('assets/add_story.png')}}">
                                                    </a>
                                                </div>
                                            </li>
                                        @endfor
                                    @else
                                        @if($restaurant->story->count() < 5)
                                            @foreach($restaurant->story->reverse() as $story)
                                                <li class="story">
                                                    <div class="img-wrap">
                                                        <a type="button" onclick="viewRestaurantStory({{ $story->id_story }});">
                                                            {{-- <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$story->thumbnail)}}"> --}}
                                                            <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                            @php
                                                $count = 5 - $restaurant->story->count();
                                            @endphp
                                            @if($count > 0)
                                                @for($i=0;$i<$count;$i++)
                                                    <li class="story">
                                                        <div class="img-wrap">
                                                            <a type="button" onclick="edit_story()">
                                                                <img src="{{ URL::asset('assets/add_story.png')}}">
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endfor
                                            @endif
                                        @else
                                            @foreach($restaurant->story as $story)
                                                <li class="story">
                                                    <div class="img-wrap">
                                                        <a type="button" onclick="viewRestaurantStory({{ $story->id_story }});">
                                                            <i class="fas fa-2x fa-play story-video-player"></i>
                                                            <video preload href="" class="story-video-grid"
                                                                style="object-fit: cover;"
                                                                src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$story->name)}}#t=1.0">
                                                            </video>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="story-title">
                                                        {{ $story->title }}
                                                    </div> --}}
                                                </li>
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                            @endauth
                            @if (Auth::guest() || Auth::user()->role_id == 4)
                                @foreach($restaurant->story as $story)
                                    <li class="story">
                                        <div class="img-wrap">
                                            <a type="button" onclick="viewRestaurantStory({{ $story->id_story }});">
                                                <i class="fas fa-2x fa-play story-video-player"></i>
                                                <video preload href="" class="story-video-grid" style="object-fit: cover;"
                                                    src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$story->name)}}#t=1.0">
                                                </video>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                        <div class="row social-share">
                            <div class="col-6 text-center">
                                @if ($restaurant->is_favorit)
                                    <p>
                                        <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i class="fa fa-heart"
                                                style="color: #f00;  font-size: 18px;"></i>
                                            <span>CANCEL FAVORIT</span>
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="{{ route('restaurant_favorit', $restaurant->id_restaurant) }}"><i class="fa fa-heart"
                                                style="color: #aaa;  font-size: 18px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
                                        </a>
                                    </p>
                                @endif
                            </div>
                            <div class="col-6 text-center">
                                <p type="button" class="expand" onclick="share()">
                                    <i class="fa fa-share" style="font-size: 18px;"></i>
                                    <span>SHARE</span></p>
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
                            <a class="navigationItem__Button"
                                onClick="document.getElementById('gallery').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">GALLERY</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">DESCRIPTION</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">AMENITIES</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">LOCATION</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a class="navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">AVAILABILITY</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a class="navigationItem__Button" onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                <span class="navigationItem__Text">REVIEW</span>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- END STICKY BAR --}}
                {{-- PAGE CONTENT --}}
                <div class="js-gallery">
                    <section id="gallery" class="photosGrid section">
                        @if($restaurant->photo->count() > 0)
                        @foreach($restaurant->photo as $photo)
                        <a href="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$photo->name)}}"
                            class="img-lightbox photosGrid__Photo"
                            style="background-image: url('{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$photo->name)}}')">
                        </a>
                        @endforeach
                        @endif
                        @if($restaurant->video->count() > 0)
                        @foreach($restaurant->video as $video)
                        <a class="video-grid" type="button" onclick="viewRestaurantVideo(1,1)">
                            <i class="fas fa-2x fa-play video-button"></i>
                            <video preload href="" class="photosGrid__Photo" style="object-fit: cover;"
                                src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$video->name)}}#t=1.0">
                            </video>
                        </a>
                        @endforeach
                        @endif
                        @auth
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                        <a class="img-lightbox photosGrid__Photo" onclick="edit_photo()"
                            style="background-image: url('{{ URL::asset('assets/add_story.png') }}">
                        </a>
                        @endif
                        @endauth

                    </section>
                    <section id="description" class="section-2">
                        {{-- Description --}}
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>About this place</h2>
                            <p id="description-content" style="text-align: justify; padding-top:10px; padding-bottom:10px">
                                {{ $restaurant->description }}
                                @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2)
                                &nbsp;<a type="button" onclick="editDescriptionForm()"><i class="fa fa-pencil-alt"
                                        style="color:green; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                                @endauth
                            </p>
                            @auth
                                @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('restaurant_update_description') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="id_restaurant" value="{{ $restaurant->id_restaurant }}" required>
                                            <div class="form-group">
                                                <textarea name="description" id="description-form-input" class="w-100" rows="5" required>{{ $restaurant->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i> Done
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary" onclick="editDescriptionCancel()">
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
                            <h2>What this place offers</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 colxs-12">
                                    <div class="row amenities-block">
                                        <div class="col-6">
                                            {{-- @foreach ($villa_amenities as $item)
                                                <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                                            @endforeach
                                            @foreach ($bathroom as $item)
                                                <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                                            @endforeach --}}
                                        </div>
                                        <div class="col-6">
                                            {{-- @foreach ($bedroom as $item)
                                                <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                                            @endforeach
                                            @foreach ($safety as $item)
                                                <span><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</span>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amenities-box">
                                <button type="button" onclick="amenities()">Show more available amenities</button>
                            </div>
                            <hr>
                        </div>
                    </section>
                    <section id="location-map" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>Location</h2>
                            {{-- <input type="hidden" value="{{$restaurant->latitude}}" name="latitude" id="latitude">
                            <input type="hidden" value="{{$restaurant->longitude}}" name="longitude" id="longitude">
                            <div id="map" style="width:100%;height:380px;" class="mb-2"></div> --}}
                            <iframe src="https://maps.google.com/?q={{$restaurant->latitude}},{{$restaurant->longitude}}&output=embed" class="w-100" style="height: 380px"></iframe>
                            <hr>
                        </div>
                    </section>
                    <section id="availability" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>Availability</h2>
                            <div class="flatpickr" id="inline"
                                style="text-align: justify; padding-top:10px; padding-bottom:10px"></div>
                            {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                            <hr class="footer">
                        </div>
                    </section>
                </div>
                {{-- END PAGE CONTENT --}}
                <div class="spacer">&nbsp;</div>
            </div>
            {{-- END LEFT CONTENT --}}
            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div class="sidebar">
                    <div class="reserve-block">
                        {{-- <input type="hidden" id="id_restaurant" name="id_restaurant" value="{{ $restaurant->id_restaurant }}"> --}}
                        @auth
                            @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="edit_price()">
                                    <i class="fa fa-pencil-alt" style="color:green; padding-right:5px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i>
                                </a>
                            @endif
                        @endauth
                        <div class="row">
                            <div class="col-7">
                                {{-- <p class="price-box">IDR <span>{{ number_format($restaurant->price, 0, ',', '.') }}</span>/night</p> --}}
                            </div>
                            <div class="col-5">
                                <p class="price-box">
                                    <i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                    {{-- @if($ratting->count() > 0)
                                        {{ $ratting[0]->average }} reviews</p>
                                    @endif --}}
                            </div>
                        </div>
                        <div class="reserve-inner-block">
                            <div class="row">
                                <div class="col-6 p-5-price line-right">
                                    <p class="price-box text-center"><strong>CHECK-IN</strong><br>
                                        <input class="flatpickr form-control text-center" type="text" id="check_in2" name="check_in" style="width:80%; border:0" placeholder="yyyy/mm/dd">
                                    </p>
                                </div>
                                <div class="col-6 p-5-price">
                                    <p class="price-box text-center">
                                        <strong>CHECK-OUT</strong>
                                        <br>
                                        <input class="flatpickr form-control text-center" type="text" id="check_out2" name="check_out" style="width:80%; border:0" placeholder="yyyy/mm/dd">
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 p-5-price line-top">
                                <p class="price-box">
                                    <strong>GUESTS</strong>
                                </p>
                                <button type="button" class="collapsible">
                                    <span id="total_guest"></span>
                                     Guest
                                </button>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="price-box mb-2">Adults (13 up)</p>
                                        </div>
                                        <div class="col-6">
                                            {{-- <p class="price-box mb-2"><input type="number" min="0"
                                                max="{{ $restaurant->adult }}" value="1" id="adult" name="adult"
                                                style="width: 70%">
                                            </p> --}}
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Children (2-12)</p>
                                        </div>
                                        <div class="col-6">
                                            {{-- <p class="price-box mb-2"><input type="number" min="0"
                                                max="{{ $restaurant->children }}" id="child" name="child" value="0"
                                                style="width: 70%">
                                            </p> --}}
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Infant (under 2)</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0" value="0" style="width: 70%"></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Pets</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0" value="0" style="width: 70%"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-5-price text-center"><input class="price-button" type="submit" value="RESERVE NOW"></div>
                        <div class="col-12 p-5-price price-box text-center">
                            You won't be charged yet
                        </div>
                        <div class="row">
                            <div class="col-7 price-box">
                                Sub Total
                                <input id="sum_night" value="0" style="width: 25px; text-align:right; border:0">
                                nights
                            </div>
                            <div class="col-5 price-box">
                                IDR <span id="total" style="font-size:100%">0</span>
                            </div>
                            <div class="col-7 price-box">Service Fee</div>
                            {{-- <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}</div> --}}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-7 price-box">
                                <strong>Total Before Taxes</strong>
                            </div>
                            <div class="col-5 price-box">
                                IDR <strong><span id="total_all" style="font-size:100%">0</span></strong>
                            </div>
                        </div>
                    </div>
                    <div class="diamond-block price-box">
                        <div class="row">
                            <div class="col-9">
                                <strong>This is a rare find.</strong>
                                 Valeria's place on EZ Villas Bali is usually fully
                                booked.
                            </div>
                            <div class="col-3">
                                <img src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MOBILE --}}
                <div class="reserve-fixed">
                    <div class="reserve-mobile">
                        <div class="row">
                            <div class="col-7 mobile-price">
                                {{-- <p>IDR <span>{{ number_format($restaurant->price, 0, ',', '.') }}</span>/night</p> --}}
                                <p>
                                    <i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                        {{-- @if($ratting->count > 0)
                                            {{ $ratting[0]->average }} reviews</p>
                                    @endif --}}
                            </div>
                            <div class="col-5 text-right">
                                <button onclick="reserve()" type="bitton" class="reserve-mobile-button">RESERVE NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MOBILE}}
            </div>
            {{-- END RIGHT CONTENT --}}
        </div>
    <div id="rsv-block-btn">
        {{-- RESERVE BUTTON TOP RIGHT --}}
        <div class="rsv">
            {{-- IDR <strong>{{ number_format($restaurant->price, 0, ',', '.') }}</strong>/night --}}
            <span><a onclick="reserve2()" type="button" class="rsv-btn-button">RESERVE NOW</a>
        </div>
        {{-- END RESERVE BUTTON TOP RIGHT --}}
    </div>
    {{-- FULL WIDTH ABOVE FOOTER --}}
    <div class="row">
        <div class="col-12">
            {{-- @if($detail->count() > 0)
                <section id="review" class="section-2">
                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                        <h2>Review</h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-6">
                                        Cleanliness
                                    </div>
                                    <div class="col-6 ">
                                        <div class="liner"></div>{{ $detail[0]->average_clean }}
                                    </div>
                                    <div class="col-6">
                                        Check In
                                    </div>
                                    <div class="col-6">
                                        <div class="liner"></div>{{ $detail[0]->average_check_in }}
                                    </div>
                                    <div class="col-6">
                                        Value
                                    </div>
                                    <div class="col-6">
                                        <div class="liner"></div>{{ $detail[0]->average_value }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-6">
                                        Service
                                    </div>
                                    <div class="col-6">
                                        <div class="liner"></div>{{ $detail[0]->average_service }}
                                    </div>
                                    <div class="col-6">
                                        Location
                                    </div>
                                    <div class="col-6">
                                        <div class="liner"></div>{{ $detail[0]->average_location }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </section>
            @endif --}}
            <div class="section">
                <div class="host">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}" style="border-radius: 50%; width: 80px; margin-left: 20px; height: 80px;">
                        </div>
                        <div class=" col-10">
                            <div class="member-profile">
                                <h4>Hosted by Rescape</h4>
                                <p>Joined in November 2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="member-profile-desc">
                        <p>
                            <i class="fa fa-heart" style="color: red;"></i> 141 Reviews |
                            <i class="fa fa-check" style="color: green;"></i> Identity verified
                        </p>
                        <h4>Co-hosts</h4>
                        <p class="member-profile-photo">
                            <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                            <span>Chandra</span>
                        </p>
                        {{--  --}}
                        <h4>During your stay</h4>
                        <p>
                            I won't be there during your stay, however our amazingly<br> friendly staff Yudha
                            will be there to attend your needs
                        </p>
                        <p>Response rate: 100%</p>
                        <p>Response time: within an hour</p>
                        <button type="button" class="member-profile-button">Contact Host</button>
                        <div class="row mt-20">
                            <div class="col-1 payment-warning-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="col-11 payment-warning">
                                To protect your payment, never transfer money or communicate outside of the EZ
                                Villas Bali website or app.
                            </div>
                        </div>
                        <hr>
                        <h4>Things to know</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <h6>House Rules</h6>
                                <p>
                                    <i class="fas fa-clock"></i> Check-in: After 3:00 PM<br>
                                    <i class="fas fa-smoking-ban"></i> No smoking<br>
                                    <i class="fas fa-ban"></i> No parties or events
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <h6>Health & Safety</h6>
                                <p>
                                    <i class="fas fa-hands-wash"></i> EZ Villas Bali's social-distancing and other COVID-19-related guidelines apply<br>
                                    <i class="far fa-bell-slash"></i> Carbon monoxide alarm not reported
                                    <span><a href="#">Show More</a></span>
                                    <br>
                                    <i class="far fa-bell-slash"></i> Smoke alarm not reported
                                    <span><a href="#">Show More</a></span>
                                </p>
                                <p>
                                    <a href="#">Show More <i class="fas fa-chevron-right"></i></a>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <h6>Cancellation Policy</h6>
                                <p>Add your trip dates to get the cancellation details for this stay.</p>
                                <p><a href="#">Add Date <i class="fas fa-chevron-right"></i></a></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                <h4><span><i class="fas fa-eye"></i> </span> What's Surrounding</h4>
                                <p>Kertagosha <span>1.1 Km</span></p>
                                <p>Yeh Panes <span>0.2 Km</span></p>
                                <p>Danau Beratan <span>3.8 Km</span></p>
                                <p>Pura Taman Ayun <span>2.1 Km</span></p>
                                <p>Kantor Bupati <span>3.1 Km</span></p>
                                <p>Tugu Proklamasi <span>1.6 Km</span></p>
                                <p>Pura Kawitan Satriya Dalem <span>3.6 Km</span></p>
                                <p>Taman Ujung <span>0.6 Km</span></p>
                                <p>Besakih Mother Temple <span>5.6 Km</span></p>
                                <p>Batur Temple <span>2.7 Km</span></p>
                                <p>Petulu Village <span>4.7 Km</span></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                <h4><span><i class="fas fa-utensils"></i> </span> Restaurants & Cafes</h4>
                                <p>Restaurant - Bebek Tepi Sawah <span>1.0 Km</span></p>
                                <p>Restaurant - Babi Guling Men Nyalig <span>2.3 Km</span></p>
                                <p>Restaurant - Mc. Donalds Fast Food <span>5.1 Km</span></p>
                                <p>Cafe - Cafe Bibir & Bubu <span>9.4 Km</span></p>
                                <p>Cafe - Cafe Rintihan Nikmat <span>12.7 Km</span></p>
                                <h4><span><i class="fas fa-glasses"></i> </span> Top Activities</h4>
                                <p>Rafting - Ayung River Rafting <span>10.8 Km</span></p>
                                <p>Trekking - Tegallalang Sight Seing <span>8.3 Km</span></p>
                                <p>Dirt Bike - Kintamani Adventure <span>3.9 Km</span></p>
                                <p>Diving - Tulamben Underwater <span>5.0 Km</span></p>
                                <p>Zoo - Bali Zoo Park <span>6.5 Km</span></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                <h4><span><i class="fas fa-leaf"></i> </span> Beauty & Spas</h4>
                                <p>Beauty Salon- La Cantiques <span>0.6 Km</span></p>
                                <p>Gym - Gym Papa & Mama <span>2.9 Km</span></p>
                                <p>Spa - Be Retreat Spa <span>5.7 Km</span></p>
                                <p>Haircut - TamPans Baber Shop <span>1.4 Km</span></p>
                                <p>Nail Care - Svndari Salon & Spa <span>2.7 Km</span></p>
                                <h4><span><i class="fas fa-map-marker-alt"></i> </span> Closest Airport</h4>
                                <p><i class="fas fa-plane"></i> Ngurah Rai International Airport <span>30 Km</span></p>
                                <h6>How to get to <strong>{{ $restaurant->name }}</strong> from Ngurah Rai International
                                    Airport?</h6>
                                <p><i class="fas fa-car"></i> Taxi &nbsp; <i class="fas fa-bus"></i> Private Suttle
                                    &nbsp; <i class="fas fa-motorcycle"></i> GoJek</p>
                                <p><i class="fas fa-coffee"></i> <strong>Free welcome drink</strong> upon arrival.</p>
                            </div>
                        </div>
                        <p style="font-size: small;">* All distances are measured in straight lines. Actual travel distances may vary.</p>
                        <hr>
                        <h4>Related Properties</h4>
                        <div class="row related-properties">
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <p>
                                    <a href="#">
                                        <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                                        <span>{{ $restaurant->name }}</span>
                                    </a>
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <p>
                                    <a href="#">
                                        <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                                        <span>{{ $restaurant->name }}</span>
                                    </a>
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <p>
                                    <a href="#">
                                        <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                                        <span>{{ $restaurant->name }}</span>
                                    </a>
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <p>
                                    <a href="#">
                                        <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}">
                                        <span>{{ $restaurant->name }}</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>

    {{-- OTHER MODAL --}}
        @auth
            @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->role->name == $restaurant->created_at)
                @include('user.modal.restaurant.name')
                @include('user.modal.restaurant.short_description')
                @include('user.modal.restaurant.description')
                @include('user.modal.restaurant.photo')
                @include('user.modal.restaurant.menu')
                @include('user.modal.restaurant.location')
                @include('user.modal.restaurant.restaurant_profile')
                @include('user.modal.restaurant.story')
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
        <div class="modal fade" id="storyRestaurantModal" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
            <div class="modal-dialog modal-xl" role="document">
                <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                    <center>
                        <input type="hidden" id="id_story" name="id_story" value="">
                        <input type="hidden" id="restaurant" name="restaurant" value="{{ $restaurant->name }}">

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
        </div>
        <script>
            function viewRestaurantStory(id_story) {
                $.ajax({
                    type: "GET",
                    url: "/restaurant/story/" + id_story,
                    dataType: "JSON",
                    success: function (data) {
                        // $('[name="id_story"]').val(data[0].id_story);
                        // let restaurant = document.getElementById("restaurant").value;
                        let video = document.getElementById('video');
                        let public = '/foto/restaurant/';
                        let slash = '/';
                        let restaurantName = '{{ $restaurant->name }}';
                        var lowerCaseRestaurantName = restaurantName.toLowerCase();
                        video.src = public + lowerCaseRestaurantName + slash + data[0].name;
                        console.log(public + lowerCaseRestaurantName + slash + data[0].name);
                        console.log(data[0].title);
                        video.load();
                        video.play();
                        $("#title").html(data[0].title);
                        $('#storyRestaurantModal').modal('show');
                    }
                });
            }
        </script>
    {{-- END STORY MODAL --}}

    {{-- MODAL VIDEO --}}
        <div class="modal fade" id="videoRestaurantModal" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
            <div class="modal-dialog modal-xl" role="document">
                <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content video-container">
                    <center>
                        <video controls id="videoRestaurant" class="video-modal">
                            <source src="">
                            Your browser doesn't support HTML5 video tag.
                        </video>
                        <h5 class="video-title" id="title"></h5><br>
                </div>
                </center>
            </div>
        </div>
        <script>
            function viewRestaurantVideo(id_video) {
                console.log(id_restaurant, id_video);
                $.ajax({
                    type: "GET",
                    url: `/restaurant/video/${id_video}`,
                    dataType: "JSON",
                    success: function (data) {
                        var video = document.getElementById('videoRestaurant');
                        var public = '/foto/restaurant/';
                        var slash = '/';
                        var name = data[0].name;
                        var lowerCaseName = name.toLowerCase();
                        video.src = public + lowerCaseName + slash + data[0].video;
                        video.load();
                        video.play();
                        $("#title").html(name);
                        // $('#price').html(0);
                        $('#videoRestaurantModal').modal('show');
                    }
                });
            }
        </script>
    {{-- END MODAL VIDEO --}}

    {{-- MODAL AMENITIES --}}
        <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background: white; border-radius:25px">
                    <div class="modal-header">
                        <h5 class="modal-title">All Amenities</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-1">
                        @php
                        $amenities = App\Http\Controllers\ViewController::amenities($restaurant->id_restaurant);
                        $bathroom = App\Http\Controllers\ViewController::bathroom($restaurant->id_restaurant);
                        $bedroom = App\Http\Controllers\ViewController::bedroom($restaurant->id_restaurant);
                        $kitchen = App\Http\Controllers\ViewController::kitchen($restaurant->id_restaurant);
                        $safety = App\Http\Controllers\ViewController::safety($restaurant->id_restaurant);
                        $service = App\Http\Controllers\ViewController::service($restaurant->id_restaurant);
                        echo '<div class="row">';
                            foreach($amenities as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        echo '
                        <hr>';

                        echo '<h5>Bathroom</h5>';
                        echo '<div class="row">';
                            foreach($bathroom as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        echo '
                        <hr>';

                        echo '<h5>Bedroom</h5>';
                        echo '<div class="row">';
                            foreach($bedroom as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        echo '
                        <hr>';

                        echo '<h5>Kitchen</h5>';
                        echo '<div class="row">';
                            foreach($kitchen as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        echo '
                        <hr>';

                        echo '<h5>Safety</h5>';
                        echo '<div class="row">';
                            foreach($safety as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        echo '
                        <hr>';

                        echo '<h5>Service</h5>';
                        echo '<div class="row">';
                            foreach($service as $item)
                            {
                            echo "<div class='col-md-6'><span><i class='fa fa-".$item->icon."'></i> ".$item->name."</span>
                            </div>";
                            }
                            echo '</div>';
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    {{-- END MODAL AMENITIES --}}

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
        @if(Auth::user()->id == $restaurant->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id ==
        2)
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
                            placeholder="yyyy/mm/dd">
                    </p>
                </div>
                <div class="col-6 p-5-price">
                    <p class="price-box text-center"><strong>CHECK-OUT</strong><br>
                        <input class="text-center" type="text" id="check_out_2" name="check_out" style="width:80%; border:0"
                            placeholder="yyyy/mm/dd">
                    </p>
                </div>
            </div>
            <div class="col-12 p-5-price line-top">
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
    {{-- END MODAL RESERVE --}}

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
                            <img src="{{ URL::asset('/foto/restaurant/'.strtolower($restaurant->name).'/'.$restaurant->image)}}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                            <p class="d-flex align-items-center">{{ $restaurant->name }}</p>
                        </div>
                        <div>
                            <div class="row row-cols-1 row-cols-lg-2">
                                {{-- <div class="col-lg col-12 p-3 border" style="border-radius:10px; margin: 0 30px;">
                                    <a onclick="Copy()" class="d-flex p-0">
                                        <div class="pr-5"><i class="fas fa-copy"></i> <span class="fw-normal">Salin Mink</span></div>
                                    </a>
                                </div> --}}
                                <div class="col-lg col-12 p-3 border share-med">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $restaurant->id_restaurant) }}&display=popup"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                                class="fw-normal">Facebook</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border share-med">
                                    <a href="#" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook-messenger"></i> <span
                                                class="fw-normal">Facebook Messenger</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border share-med">
                                    <a href="https://api.whatsapp.com/send?text={{ route('villa', $restaurant->id_restaurant) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                                class="fw-normal">WhatsApp</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border share-med">
                                    <a href="https://telegram.me/share/url?url={{ route('villa', $restaurant->id_restaurant) }}&text={{ route('villa', $restaurant->id_restaurant) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                                class="fw-normal">Telegram</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border share-med">
                                    <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $restaurant->id_restaurant) }}"
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
    {{-- END MODAL SHARE --}}

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
                        <div class="reserve-inner-block">
                            <div class="row">
                                <div class="col-6 p-5-price line-right">
                                    <p class="price-box text-center"><strong>CHECK-IN</strong><br>
                                        <input class="text-center" type="text" id="check_in_2" name="check_in"
                                            style="width:80%; border:0" placeholder="yyyy/mm/dd">
                                    </p>
                                </div>
                                <div class="col-6 p-5-price">
                                    <p class="price-box text-center"><strong>CHECK-OUT</strong><br>
                                        <input class="text-center" type="text" id="check_out_2" name="check_out"
                                            style="width:80%; border:0" placeholder="yyyy/mm/dd">
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 p-5-price line-top">
                                <p class="price-box"><strong>GUESTS</strong></p>
                                <button type="button" class="collapsible"><span id="total_guest"></span> Guest</button>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="price-box mb-2">Adults (13 up)</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0"
                                                    max="{{ $restaurant->adult }}" value="1" id="adult" name="adult"
                                                    style="width: 70%"></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Children (2-12)</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0"
                                                    max="{{ $restaurant->children }}" id="child" name="child" value="0"
                                                    style="width: 70%"></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Infant (under 2)</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0" value="0"
                                                    style="width: 70%">
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2">Pets</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="price-box mb-2"><input type="number" min="0" value="0"
                                                    style="width: 70%">
                                            </p>
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
    {{-- END MODAL RESERVE II --}}

    {{-- FOOTER --}}
        @include('layouts.user.footer')
    {{-- END FOOTER --}}

    </div>
    {{-- OTHER RESOURCE --}}
        <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
        <script src="{{asset('assets/js/dashmix.app.min.js')}}"></script>
        <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

        <script>
            $('#check_in').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    $('#check_out').flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        minDate: new Date(dateStr).fp_incr(1),
                        onChange: function (selectedDates, dateStr, instance) {
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
            $('#check_in2').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    $('#check_out2').flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        minDate: new Date(dateStr).fp_incr(1),
                        onChange: function (selectedDates, dateStr, instance) {
                            var start = new Date($('#check_in2').val());
                            var end = new Date($('#check_out2').val());
                            var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                            var min_stay = $('#min_stay').val();
                            var minimum = new Date($('#check_in2').val()).fp_incr(min_stay);
                            if (sum_night < min_stay) {
                                alert("minimum stay is " + min_stay + " days");
                            }
                        }
                    });
                }
            });

        </script>

        <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
        {{-- Page JS Plugins --}}
        <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

        <script src="{{ asset('assets/js/view-villa.js') }}"></script>
        <script>
            $("#searchbox").click(function () {
                $("#search_bar").toggleClass("active");
            });
        </script>
    {{-- END OTHER RESOURCE --}}

    {{-- IMAGE UPLOAD --}}
        <script>
            $(".image-box").click(function (event) {
                var previewImg = $(this).children("img");

                $(this)
                    .siblings()
                    .children("input")
                    .trigger("click");

                $(this)
                    .siblings()
                    .children("input")
                    .change(function () {
                        var reader = new FileReader();

                        reader.onload = function (e) {
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
</body>
