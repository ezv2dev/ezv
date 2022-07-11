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

    </style>

    {{-- GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

    {{-- END GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}
</head>

<body style="background-color:white">
    {{-- <input type="hidden" id="min_stay" name="min_stay" value="{{ $activity->min_stay }}">
    <input type="hidden" id="price" name="price" value="{{ $activity->price }}">
    <input type="hidden" id="price3" name="price" value="{{ $activity->price }}"> --}}
    <div id="page-container">
        {{-- HEADER --}}
        <header>
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}
        {{-- PROFILE --}}
        <div class="row page-content" style="padding-left: 40px; padding-right: 40px;">
            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block" style="padding-left: 0px; padding-right: 5px;">
                <div class="row top-profile">
                    <div class="col-lg-4- col-md-4 col-xs-12" style="padding: 0px;">
                        <div class="profile-image">
                            @if ($activity->image)
                                <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $activity->image) }}">
                            @else
                                <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_activity_profile()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @if ($activity->image)
                                        <a href="{{ route('activity_delete_image', $activity->id_activity) }}"><i
                                                class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                                title="Delete"></i></a>
                                    @endif
                                @endif
                            @endauth
                            <div>
                                <p class="location-font-size" style="margin-top: 55px;"><a
                                        href="https://maps.google.com/?q={{ $activity->latitude }},{{ $activity->longitude }}"
                                        target="_blank"><i class="fa fa-map-marker-alt" style="font-size:14px"></i>
                                        {{ $activity->location->name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12" style="padding-left: 40px;">
                        <h2>{{ $activity->name }}</h2>
                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">{{ $activity->short_description }}
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form">
                                    <form action="{{ route('activity_update_short_description') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}"
                                            required>
                                        <textarea style="width: 100%;" name="short_description" id="short-description-form-input" cols="30" rows="3"
                                            maxlength="255" required>{{ $activity->short_description }}</textarea>
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
                        {{-- END SHORT DESCRIPTION --}}
                        {{-- SUBCATEGGORY --}}
                        <p class="text-secondary">
                            subcategory:
                            @forelse ($activity->subCategory as $subcategory)
                                <span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">{{ $subcategory->name }}</span>
                            @empty
                                this activity doesnt has subcategory yet
                            @endforelse
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="add_subcategory()"><i class="fa fa-pencil-alt"
                                            style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                            data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                            @endauth
                        </p>
                        {{-- END SUB CATEGORY --}}
                        {{-- @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <form action="{{ route('activity_update_short_description') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}" required>
                        <textarea name="short_description" id="short-description-form-input" cols="30" rows="3"
                            maxlength="255" required>{{ $activity->short_description }}</textarea>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-check"></i> Done
                        </button>
                        <button type="reset" class="btn btn-sm btn-secondary" onclick="editShortDescriptionCancel()">
                            <i class="fa fa-xmark"></i> Cancel
                        </button>
                        </form>
                    </div>
                    @endif
                    @endauth --}}
                        {{-- END SHORT DESCRIPTION --}}
                        <ul class="stories inner-wrap">
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    @if ($activity->story->count() == 0)
                                        <li class="story">
                                            <div class="img-wrap">
                                                <a type="button" onclick="edit_story()">
                                                    <img src="{{ URL::asset('assets/add_story.png') }}">
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        @if ($activity->story->count() < 100)
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
                                                        @foreach ($activity->story as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <a type="button"
                                                                        onclick="view_story_activity({{ $item->id_story }});">
                                                                        <video preload href="" class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a href="{{ route('activity_delete_story', ['id' => $activity->id_activity, 'id_story' => $item->id_story]) }}">
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
                                            @foreach ($activity->story as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <a type="button"
                                                            onclick="view_story_activity({{ $item->id_story }});">
                                                            <i class="fa-play story-video-player"></i>
                                                            <video preload href="" class="story-video-grid"
                                                                style="object-fit: cover;"
                                                                src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $item->name) }}#t=1.0">
                                                            </video>
                                                        </a>
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
                                @if ($activity->is_favorit)
                                    <p>
                                        <a href="{{ route('activity_favorit', $activity->id_activity) }}"><i
                                                class="fa fa-heart" style="color: #f00;  font-size: 18px;"></i>
                                            <span>CANCEL</span>
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="{{ route('activity_favorit', $activity->id_activity) }}"><i
                                                class="fa fa-heart" style="color: #aaa;  font-size: 18px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
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
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('gallery').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                GALLERY
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('price').scrollIntoView();">
                                <i aria-label="Posts" class="fa fa-money navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                PRICE
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                ABOUT
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
                                FACILITIES
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                LOCATION
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>&nbsp
                                AVAILABILITY
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i>&nbsp
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
                        @if ($activity->photo->count() > 0)
                            @foreach ($activity->photo as $item)
                                <a href="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $item->name) }}"
                                    class="img-lightbox photosGrid__Photo"
                                    style="background-image: url('{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $item->name) }}')">
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a href="{{ route('activity_delete_photo_photo', ['id' => $activity->id_activity, 'id_photo' => $item->id_photo]) }}">X</a>
                                    @endif
                                @endauth
                            @endforeach
                        @endif
                        @if ($activity->video->count() > 0)
                            @foreach ($activity->video as $item)
                                <a class="video-grid" type="button"
                                    onclick="view_video_activity({{ $item->id_video }});">
                                    <i class="fas fa-2x fa-play video-button"></i>
                                    <video preload href="" class="photosGrid__Photo" style="object-fit: cover;"
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $item->name) }}#t=1.0">
                                    </video>
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a href="{{ route('activity_delete_photo_video', ['id' => $activity->id_activity, 'id_video' => $item->id_video]) }}">X</a>
                                    @endif
                                @endauth
                                {{-- <a href="{{ URL::asset('/foto/activity/'.strtolower($activity->name).'/'.$item->name)}}"
                    class="img-lightbox photosGrid__Photo"
                    style="background-image:
                    url('{{ URL::asset('/foto/activity/'.strtolower($activity->name).'/'.$item->name)}}')">
                    </a> --}}
                            @endforeach
                        @endif
                        {{-- @auth
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                            <a class="img-lightbox photosGrid__Photo" onclick="edit_photo()"
                                style="background-image: url('{{ URL::asset('assets/add_story.png') }}">
                    </a>
                    @endif
                    @endauth --}}
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section id="add-gallery"
                                style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                                <form class="dropzone" id="frmTarget">
                                    @csrf
                                    <input type="hidden" value="{{ $activity->id_activity }}" id="id_activity"
                                        name="id_activity">
                                </form>
                                <button type="submit" id="button" class="btn btn-primary">Upload</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    {{-- PRICES --}}
                    <section id="price" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>Prices</h2>
                        </div>
                        <div class="photosGrid">
                            @if ($activity->price->count() > 0)
                                @foreach ($activity->price as $price)
                                    <a data-bs-toggle="modal" data-bs-target="#modal-price-{{ $price->id_price }}"
                                        class="img-lightbox photosGrid__Photo"
                                        style="background-image: url('{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/price' . '/' . $price->foto) }}')">
                                    </a>
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a href="{{ route('activity_delete_price', ['id' => $activity->id_activity, 'id_price' => $price->id_price]) }}">X</a>
                                        @endif
                                    @endauth
                                    {{-- MODAL MENU --}}
                                    <div class="modal fade" id="modal-price-{{ $price->id_price }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="background: white; border-radius:25px">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $price->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-1">
                                                    <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/price' . '/' . $price->foto) }}"
                                                        alt="{{ $price->foto }}" class="img-fluid"
                                                        style="border-radius:15px;">
                                                    <h5 style="color: #FF7400; margin-top: 10px; margin-bottom: 5px;">
                                                        <b>IDR </b>{{ NumberToCurrency::IDR($price->price) }}
                                                    </h5>
                                                    <p>{{ $price->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- END MODAL MENU --}}
                                @endforeach
                            @endif
                            @auth
                                @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->role->name == $activity->created_at)
                                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                        &nbsp;
                                        <a type="button" onclick="add_price()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </section>
                    <section id="description" class="section-2" style="margin-top: 12px;">
                        {{-- Description --}}
                        <div style="padding-top:12px; padding-left:10px; padding-right:10px;">
                            <h2>About this place</h2>
                            <p id="description-content"
                                style="text-align: justify; padding-top:10px; padding-bottom:12px">
                                {{ $activity->description }}
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editDescriptionForm()">
                                            <i class="fa fa-pencil-alt" style="color:#FF7400; padding-right:5px;"
                                                data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                                title="Edit"></i>
                                        </a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('activity_update_description') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}"
                                                required>
                                            <div class="form-group">
                                                <textarea name="description" id="description-form-input" class="w-100" rows="5"
                                                    required>{{ $activity->description }}</textarea>
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
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="add_facilities()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 colxs-12">
                                    <div class="row amenities-block">
                                        <div class="col-6">
                                            @if ($activity->facilities->count() > 0)
                                                @foreach ($activity->facilities as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amenities-box">
                                <button type="button" onclick="amenities()">More Facilities</button>
                            </div>
                            <hr>
                        </div>
                    </section>
                    <section id="location-map" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>
                                Location
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <input type="hidden" value="{{ $activity->latitude }}" name="latitude" id="latitude">
                            <input type="hidden" value="{{ $activity->longitude }}" name="longitude" id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div>
                        </div>
                    </section>
                    <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div>
                    <section id="availability" class="section-2">
                        <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                            <h2>Availability</h2>
                            <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                <div class="flatpickr" id="inline" style="text-align: left;">
                                    <input type="hidden" class="flatpickr bg-white" name="check_in">
                                </div>
                            </div>
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
                        <input type="hidden" id="id_activity" name="id_activity"
                            value="{{ $activity->id_activity }}">
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt"
                                        style="color: #FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @endif
                        @endauth
                        <form method="POST" action="{{ route('villa_booking_confirm') }}">
                            @csrf
                            <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                            <div class="row">
                                <div class="col-7">
                                    <p class="price-box">IDR
                                        {{-- <span>{{ number_format($activity->price, 0, ',', '.') }}</span>/night --}}
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
                                {{-- <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}
                        </div> --}}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-7 price-box"><strong>Total Before Taxes</strong></div>
                                <div class="col-5 price-box">IDR <strong><span id="total_all"
                                            style="font-size:100%">0</span></strong></div>
                            </div>
                        </form>
                    </div>
                    <div class="diamond-block price-box">
                        <div class="row">
                            <div class="col-9">
                                <strong>This is a rare find.</strong> {{ $activity->name }}'s place on EZ Villas
                                Bali is
                                usually fully
                                booked.
                            </div>
                            <div class="col-3"><img
                                    src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MOBILE --}}
                <div class="reserve-fixed">
                    <div class="reserve-mobile">
                        <div class="row">
                            <div class="col-7 mobile-price">
                                {{-- <p>IDR <span>{{ number_format($activity->price, 0, ',', '.') }}</span>/night</p> --}}
                                <p><i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                    {{-- @if ($ratting->count > 0)
                                    {{ $ratting[0]->average }} reviews</p>
                        @endif --}}
                            </div>
                            <div class="col-5 text-right">
                                <button onclick="reserve()" type="bitton" class="reserve-mobile-button">RESERVE
                                    NOW</button>
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
                    {{-- <strong>{{ number_format($activity->price, 0, ',', '.') }}</strong>/night --}}
                    <span><a onclick="reserve2()" type="button" class="rsv-btn-button">RESERVE NOW</a>
                </div>
                {{-- END RESERVE BUTTON TOP RIGHT --}}
            </div>
            {{-- FULL WIDTH ABOVE FOOTER --}}
            <div class="row">
                <div class="col-12">
                    @if ($activity->detailReview)
                        <section id="review" class="section-2">
                            <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                <h2>Review</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-6">
                                                Experience
                                            </div>
                                            <div class="col-6 ">
                                                <div class="liner"></div>
                                                {{ $activity->detailReview->average_experience }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </section>
                    @endif
                    @auth
                        @can('review_create')
                            @if ($activity->userReview)
                                <section id="user-review" class="section-2">
                                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                        <h2>Your Review</h2>
                                        <span>
                                            <form action="{{ route('activity_review_delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}"
                                                    required>
                                                <input type="hidden" name="id_review"
                                                    value="{{ $activity->userReview->id_review }}" required>
                                                <span><button type="submit" class="btn btn-primary">remove
                                                        review</button></span>
                                            </form>
                                        </span>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        Experience
                                                    </div>
                                                    <div class="col-6 ">
                                                        <div class="liner"></div>
                                                        {{ $activity->userReview->experience }}
                                                    </div>
                                                    @if ($activity->userReview->comment)
                                                        <div class="col-12">
                                                            Comment
                                                        </div>
                                                        <div class="col-12">
                                                            "{{ $activity->userReview->comment }}"
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
                                <section id="add-review" class="section-2">
                                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                                        <h2>give review</h2>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <form action="{{ route('activity_review_store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_activity"
                                                        value="{{ $activity->id_activity }}" readonly required>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Experience
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="cm-star-rating">
                                                                <input id="star-5" type="radio" name="experience" value="5" />
                                                                <label for="star-5" title="5 stars">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="star-4" type="radio" name="experience" value="4" />
                                                                <label for="star-4" title="4 stars">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="star-3" type="radio" name="experience" value="3" />
                                                                <label for="star-3" title="3 stars">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="star-2" type="radio" name="experience" value="2" />
                                                                <label for="star-2" title="2 stars">
                                                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="star-1" type="radio" name="experience" value="1" />
                                                                <label for="star-1" title="1 star">
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
                    <div class="section">
                        <div class="host">
                            {{-- <div class="row">
                                <div class="col-2">
                                    <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $activity->image) }}"
            style="border-radius: 50%; width: 80px; margin-left: 20px; height: 80px;">
        </div>
        <div class=" col-10">
            <div class="member-profile">
                <h4>Hosted by {{ $activity->createdByDetails->first_name }}</h4>
                <p>Joined in November 2020</p>
            </div>
        </div>
    </div> --}}
                            <div class="member-profile-desc">
                                {{-- <p><i class="fa fa-heart" style="color: red;"></i> 141 Reviews | <i
                                        class="fa fa-check" style="color: green;"></i> Identity verified</p>
                                <h4>Co-hosts</h4>
                                <p class="member-profile-photo"><img
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $activity->image) }}">
        <span>Chandra</span>
        </p>
        <h4>During your stay</h4>
        <p>I won't be there during your stay, however our amazingly<br> friendly staff Yudha
            will be there to attend your needs</p>
        <p>Response rate: 100%</p>
        <p>Response time: within an hour</p>
        <button type="button" onclick="contactHostForm()" class="member-profile-button">Contact
            Host</button>
        <div class="row mt-20">
            <div class="col-1 payment-warning-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div class="col-11 payment-warning">
                To protect your payment, never transfer money or communicate outside of the EZ
                Villas Bali website or app.
            </div>
        </div>
        <hr> --}}
                                <h4>Things to know</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <h6>House Rules</h6>
                                        <p><i class="fas fa-clock"></i> Check-in: After 3:00 PM<br>
                                            <i class="fas fa-smoking-ban"></i> No smoking<br>
                                            <i class="fas fa-ban"></i> No parties or events
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <h6>Health & Safety</h6>
                                        <p><i class="fas fa-hands-wash"></i> EZ Villas Bali's social-distancing and
                                            other COVID-19-related guidelines apply<br>
                                            <i class="far fa-bell-slash"></i> Carbon monoxide alarm not reported
                                            <span><a href="#">Show More</a></span><br>
                                            <i class="far fa-bell-slash"></i> Smoke alarm not reported <span><a
                                                    href="#">Show
                                                    More</a></span>
                                        </p>
                                        <p><a href="#">Show More <i class="fas fa-chevron-right"></i></a></p>
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
                                        <h4><span><i class="fa-solid fa-house"></i> </span> Villas</h4>
                                        @foreach ($villas_nearby as $item)
                                            @if (!empty($item))
                                                <p>{{ $item[2] }} <span>{{ $item[0] }} Km</span></p>
                                            @endif
                                        @endforeach
                                        {{-- <h4><span><i class="fas fa-eye"></i> </span> What's Surrounding</h4> --}}
                                        {{-- <p>Kertagosha <span>1.1 Km</span></p>
                                <p>Yeh Panes <span>0.2 Km</span></p>
                                <p>Danau Beratan <span>3.8 Km</span></p>
                                <p>Pura Taman Ayun <span>2.1 Km</span></p>
                                <p>Kantor Bupati <span>3.1 Km</span></p>
                                <p>Tugu Proklamasi <span>1.6 Km</span></p>
                                <p>Pura Kawitan Satriya Dalem <span>3.6 Km</span></p>
                                <p>Taman Ujung <span>0.6 Km</span></p>
                                <p>Besakih Mother Temple <span>5.6 Km</span></p>
                                <p>Batur Temple <span>2.7 Km</span></p>
                                <p>Petulu Village <span>4.7 Km</span></p> --}}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                        <h4><span><i class="fas fa-utensils"></i> </span> Restaurants & Cafes</h4>
                                        @foreach ($restaurants_nearby as $item)
                                            @if (!empty($item))
                                                <p>{{ $item[2] }} <span>{{ $item[0] }} Km</span></p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 extra-info">
                                        <h4><span><i class="fas fa-leaf"></i> </span> Beauty & Spas</h4>
                                        <p>Beauty Salon- La Cantiques <span>0.6 Km</span></p>
                                        <p>Gym - Gym Papa & Mama <span>2.9 Km</span></p>
                                        <p>Spa - Be Retreat Spa <span>5.7 Km</span></p>
                                        <p>Haircut - TamPans Baber Shop <span>1.4 Km</span></p>
                                        <p>Nail Care - Svndari Salon & Spa <span>2.7s Km</span></p>
                                        <h4><span><i class="fas fa-map-marker-alt"></i> </span> Closest Airport</h4>
                                        <p><i class="fas fa-plane"></i> Ngurah Rai International Airport <span>30
                                                Km</span></p>
                                        <h6>How to get to <strong>{{ $activity->name }}</strong> from Ngurah Rai
                                            International
                                            Airport?</h6>
                                        <p><i class="fas fa-car"></i> Taxi &nbsp; <i class="fas fa-bus"></i>
                                            Private Suttle
                                            &nbsp; <i class="fas fa-motorcycle"></i> GoJek</p>
                                        <p><i class="fas fa-coffee"></i> <strong>Free welcome drink</strong> upon
                                            arrival.</p>
                                    </div>
                                </div>
                                <p style="font-size: small;">* All distances are measured in straight lines. Actual
                                    travel
                                    distances may vary.</p>
                                <hr>
                                <h4>Nearby Restaurants & Things To Do</h4>

                                <div class="row">
                                    <h6><span><i class="fa-solid fa-house"></i></span> Villas</h6>
                                    <div class="containerSlider">
                                        <div id="slide-left-container">
                                            <div class="slide-left">
                                            </div>
                                        </div>
                                        <div id="cards-container">
                                            <div class="cards">
                                                @forelse ($villas_slider as $item)
                                                    <div class="card col-lg-3" style="border-radius: 5px;">
                                                        <a href="{{ route('villa', $item->id_villa) }}"
                                                            target="_blank">
                                                            <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->name) . '/' . $item->image) }}"
                                                                alt="Villas"
                                                                style="width:100%; aspect-ratio: 4/4; height: 250px; object-fit: cover; border-radius: 15px;"
                                                                class="img-shadow">
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
                                    <h6><span><i class="fas fa-utensils"></i></span> Restaurants</h6>
                                    <div class="containerSlider2">
                                        <div id="slide-left-container2">
                                            <div class="slide-left2">
                                            </div>
                                        </div>
                                        <div id="cards-container2">
                                            <div class="cards2">
                                                @forelse ($restaurants_slider as $item)
                                                    <div class="card2 col-lg-3" style="border-radius: 5px;">
                                                        <a href="{{ route('restaurant', $item->id_restaurant) }}"
                                                            target="_blank">
                                                            <img src="{{ URL::asset('/foto/restaurant/' . strtolower($item->name) . '/' . $item->image) }}"
                                                                alt="Restaurants"
                                                                style="width:100%; aspect-ratio: 4/4; height: 250px; object-fit: cover; border-radius: 15px;"
                                                                class="img-shadow">
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
                                                                <span>No Restaurants Found</span></a>
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
        {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>
    {{-- MODAL --}}

    {{-- OTHER MODAL --}}
    @auth
        @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->role->name == $activity->created_at)
            {{-- @include('user.modal.restaurant.name') --}}
            {{-- @include('user.modal.restaurant.short_description') --}}
            {{-- @include('user.modal.restaurant.description') --}}
            {{-- @include('user.modal.restaurant.photo') --}}
            {{-- @include('user.modal.restaurant.menu') --}}
            @include('user.modal.activity.facilities_add')
            @include('user.modal.activity.price')
            @include('user.modal.activity.location')
            @include('user.modal.activity.activity_profile')
            @include('user.modal.activity.story')
            @include('user.modal.activity.subcategory_add')
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

        function add_price() {
            $('#modal-add_price').modal('show');
        }

        function edit_activity_profile() {
            $('#modal-edit_activity_profile').modal('show');
        }
    </script>
    {{-- END MODAL SCRIPT --}}
    {{-- STORY MODAL --}}
    <div class="modal fade" id="storymodalactivity" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="video-title" id="story-title"></h5>
            <div class="modal-content video-container" style="width:980px;">
                <center>
                    <video controls id="story-video" class="video-modal">
                        <source src="">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
            </div>
        </div>
    </div>
    <script>
        function view_story_activity(id) {
            $.ajax({
                type: "GET",
                url: "/things-to-do/story/" + id,
                dataType: "JSON",
                success: function(data) {
                    // $('[name="id_story"]').val(data[0].id_story);
                    // let activity = document.getElementById("activity").value;
                    let video = document.getElementById('story-video');
                    let public = '/foto/activity/';
                    let slash = '/';
                    let name = '{{ $activity->name }}';
                    var lowerCaseName = name.toLowerCase();
                    video.src = public + lowerCaseName + slash + data[0].name;
                    video.load();
                    video.play();
                    $("#story-title").text(data[0].title);
                    $('#storymodalactivity').modal('show');
                }
            });
        }

        $(function() {
            $('#storymodalactivity').modal({
                show: false
            }).on('hidden.bs.modal', function() {
                $(this).find('video')[0].pause();
            });
        });
    </script>
    {{-- MODAL VIDEO --}}
    <div class="modal fade" id="videomodalactivity" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
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
        function view_video_activity(id) {
            $.ajax({
                type: "GET",
                url: "/things-to-do/video/" + id,
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    var video = document.getElementById('video');
                    var public = '/foto/activity/';
                    var slash = '/';
                    var name = '{{ $activity->name }}';
                    var lowerCaseName = name.toLowerCase();
                    video.src = public + lowerCaseName + slash + data[0].video;
                    video.load();
                    video.play();
                    $("#video-title").html(name);
                    $('#videomodalactivity').modal('show');
                }
            });
        }
        $(function() {
            $('#videomodalactivity').modal({
                show: false
            }).on('hidden.bs.modal', function() {
                $(this).find('video')[0].pause();
            });
        });
    </script>
    {{-- MODAL AMENITIES --}}
    {{-- <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">All Amenities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    @php
                    $amenities = App\Http\Controllers\ViewController::amenities($activity->id_activity);
                    $bathroom = App\Http\Controllers\ViewController::bathroom($activity->id_activity);
                    $bedroom = App\Http\Controllers\ViewController::bedroom($activity->id_activity);
                    $kitchen = App\Http\Controllers\ViewController::kitchen($activity->id_activity);
                    $safety = App\Http\Controllers\ViewController::safety($activity->id_activity);
                    $service = App\Http\Controllers\ViewController::service($activity->id_activity);
                    echo '<div class="row">';
                        foreach($amenities as $item)
                        {
                        echo "<div class='col-md-6 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Bathroom</h5>';
                    echo '<div class="row">';
                        foreach($bathroom as $item)
                        {
                        echo "<div class='col-md-6 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Bedroom</h5>';
                    echo '<div class="row">';
                        foreach($bedroom as $item)
                        {
                        echo "<div class='col-md-6 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Kitchen</h5>';
                    echo '<div class="row">';
                        foreach($kitchen as $item)
                        {
                        echo "<div class='col-md-8 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Safety</h5>';
                    echo '<div class="row">';
                        foreach($safety as $item)
                        {
                        echo "<div class='col-md-6 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    <hr>';

                    echo '<h5>Service</h5>';
                    echo '<div class="row">';
                        foreach($service as $item)
                        {
                        echo "<div class='col-md-6 mb-3'><span><i class='fa fa-".$item->icon."'></i>
                                ".$item->name."</span>
                        </div>";
                        }
                        echo '</div>';
                    @endphp
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MODAL RESERVE --}}
    {{-- <div class="modal fade" id="modal-reserve" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-1">
            <div class=" reserve-block">
                <input type="hidden" id="id_activity" name="id_activity" value="{{ $activity->id_activity }}">
    @auth
    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt" style="color:green; padding-right:5px;"
            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
    @endif
    @endauth
    <div class="row">
        <div class="col-7">
            <p class="price-box">IDR <span>{{ number_format($activity->price, 0, ',', '.') }}</span>/night
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
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $activity->adult }}" value="1"
                                id="adult" name="adult" style="width: 70%"></p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2">Children (2-12)</p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $activity->children }}"
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
                        <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->name) . '/' . $activity->image) }}"
                            style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        <p class="d-flex align-items-center">{{ $activity->name }}</p>
                    </div>
                    <div>
                        <div class="row row-cols-1 row-cols-lg-2">
                            {{-- <div class="col-lg col-12 p-3 border" style="border-radius:10px; margin: 0 30px;">
                                <a onclick="Copy()" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-copy"></i> <span class="fw-normal">Salin Mink</span></div>
                                </a>
                            </div> --}}
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $activity->id_activity) }}&display=popup"
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
                                <a href="https://api.whatsapp.com/send?text={{ route('villa', $activity->id_activity) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://telegram.me/share/url?url={{ route('villa', $activity->id_activity) }}&text={{ route('villa', $activity->id_activity) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $activity->id_activity) }}"
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
                                {{-- <span>{{ number_format($activity->price, 0, ',', '.') }}</span>/night --}}
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="price-box"><i class="fa fa-star"
                                    style="color: orange; font-size:14px"></i>
                                {{-- @if ($activity->detailReview->count() > 0)
                                        {{ $activity->detailReview->average }} reviews
                            </p>
                            @endif --}}
                        </div>
                    </div>
                    <div class="reserve-inner-block">
                        <div class="row">
                            <div class="col-6 p-5-price line-right">
                                <p class="price-box text-center"><strong>CHECK-IN</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_in3" name="check_in"
                                        style="width:80%; border:0" placeholder="Add Date">
                                </p>
                            </div>
                            <div class="col-6 p-5-price">
                                <p class="price-box text-center"><strong>CHECK-OUT</strong><br>
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
                            value="RESERVE NOW">
                    </div>
                    <div class="col-12 p-5-price price-box text-center">You won't be charged yet</div>
                    <div class="row">
                        <div class="col-7 price-box">Sub Total<input id="sum_night3" value="0"
                                style="width: 25px; text-align:right; border:0"> nights</div>
                        <div class="col-5 price-box">IDR <span id="total3" style="font-size:100%">0</span></div>
                        <div class="col-7 price-box">Service Fee</div>
                        {{-- <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}
                    </div> --}}
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
                        <input type="hidden" name="id_owner" value="{{ $activity->created_by }}">
                        <div class="form-group">
                            <textarea name="message" rows="10" class="form-control w-100" value="{{ old('message') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">send</button>
                    </form>
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
    <script src="{{ asset('assets/js/view-villa.js') }}"></script>

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
            formInput.value = '{{ $activity->short_description }}';
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
            formInput.value = '{{ $activity->description }}';
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
            url: '/things-to-do/photo/store',
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
                    var value = $('form#formData #id_activity').val();
                    formData.append('id_activity', value);
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
        // Semi Fixed

        const $win = $(window);
        const $sidebar = $('.sidebar');
        const $footer = $('.footer');

        let windowTop = 0;
        let lastDelta = 0;
        let fixed = false;

        function isFooterInViewport() {
            return $footer.position().top < $win.scrollTop() + $win.height();
        }

        function updateSidebarAbsolutePosition(delta) {
            if ((delta > 0 && lastDelta < 0) || (delta < 0 && lastDelta > 0) || isFooterInViewport()) {
                $sidebar
                    .css({
                        top: $sidebar.offset().top + 'px',
                        bottom: 'auto'
                    })
                    .attr('class', 'sidebar')
                    .addClass('absolute');

                fixed = false;
            }
        }

        function setSidebarFixedBottom() {
            $sidebar
                .attr('class', 'sidebar')
                .attr('style', '')
                .addClass('fixed fixed--bottom');
        }

        function setSidebarFixedTop() {
            $sidebar
                .attr('class', 'sidebar')
                .attr('style', '')
                .addClass('fixed fixed--top');
        }

        $win.scroll(function(e) {
            const newTop = $win.scrollTop();
            const delta = newTop - windowTop;

            if (!fixed) {
                if (delta > 0) {
                    const sidebarBottom = parseInt($sidebar.css('top')) + $sidebar.outerHeight(true);
                    const visibleBottom = newTop + $win.height();

                    if (visibleBottom > sidebarBottom) {
                        if (isFooterInViewport()) {
                            updateSidebarAbsolutePosition(delta);
                        } else {
                            setSidebarFixedBottom();
                            fixed = true;
                        }
                    }
                } else {
                    if ($sidebar.position().top - windowTop > 0) {
                        setSidebarFixedTop();
                        fixed = true;
                    }
                }
            } else {
                updateSidebarAbsolutePosition(delta);
            }

            lastDelta = delta > 0 ? 1 : -1;
            windowTop = newTop;
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

    <script>
        $("textarea").keydown(function(e){
            // Enter was pressed without shift key
            if (e.keyCode == 13 && !e.shiftKey)
            {
                // prevent default behavior
                e.preventDefault();
            }
        });
    </script>
</body>
