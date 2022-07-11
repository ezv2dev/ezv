<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    @include('layouts.admin.title')
    <meta name="description" content="EZV2 ">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    {{-- Open Graph Meta --}}
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

    {{-- Icons --}}
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    {{-- The following icons can be replaced with your own, they are used by desktop and mobile browsers --}}
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>

    {{-- END Icons --}}

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    {{-- SweetAlert CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

    {{-- Stylesheets --}}
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/villa-slider.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/m-view-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body style="background-color:white">
    @component('components.loading.loading-type1')@endcomponent
    <input type="hidden" id="min_stay" name="min_stay" value="{{ $villa[0]->min_stay }}">
    <input type="hidden" id="price" name="price" value="{{ $villa[0]->price }}">
    <input type="hidden" id="price3" name="price" value="{{ $villa[0]->price }}">
    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="autohide2 head-inner-wrap">
                <div class="header-mobile">
                    <div class="row">
                        <div class="col-4">
                            <a type="button" href="{{ route('index') }}"><i class="fa fa-chevron-left"></i> EZV2</a>
                        </div>
                        <div class="col-8">
                            <div class="row mobile-social-share">
                                <div class="col-4 text-center icon-center">
                                    <p type="button" onclick="language()" href="#">
                                        @if (session()->has('locale'))
                                            <img class="lang" src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                                        @else
                                            <img class="lang" src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                                        @endif
                                        <span style="color: #aaa;">{{ Translate::translate('LANG') }}</span>
                                    </p>
                                </div>
                                <div class="col-4 text-center icon-center">
                                    @if ($villa[0]->is_favorit)
                                    <p>
                                        <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                                                style="color: #f00;  font-size: 18px;"></i>
                                            <span>CANCEL</span>
                                        </a>
                                    </p>
                                    @else
                                    <p>
                                        <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                                                style="color: #aaa;  font-size: 18px;"></i>
                                            <span style="color: #aaa;">FAVORITE</span>
                                        </a>
                                    </p>
                                    @endif
                                </div>
                                <div class="col-4 text-center icon-center">
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
            <div class="alert-detail">
            {{-- ALERT CONTENT STATUS --}}
                @auth
                    @if (auth()->user()->id == $villa[0]->created_by)
                        @if ($villa[0]->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>this content is deactive, </span>
                                <form action="{{ route('villa_request_update_status', $villa[0]->id_villa) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                                    <button class="btn" type="submit">request activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($villa[0]->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>this content is active, </span>
                                <form action="{{ route('villa_request_update_status', $villa[0]->id_villa) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                                    <button class="btn" type="submit">request deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($villa[0]->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request activation for this content, </span>
                                <form action="{{ route('villa_cancel_request_update_status', $villa[0]->id_villa) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                                    <button class="btn" type="submit">cancel activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($villa[0]->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request deactivation for this content, </span>
                                <form action="{{ route('villa_cancel_request_update_status', $villa[0]->id_villa) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
                                    <button class="btn" type="submit">cancel deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($villa[0]->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                this content is deactive
                            </div>
                        @endif
                        @if ($villa[0]->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                this content is active
                            </div>
                        @endif
                        @if ($villa[0]->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request activation, </span>
                                <form action="{{ route('admin_villa_update_status', $villa[0]->id_villa) }}" method="get">
                                    <button class="btn" type="submit">activate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($villa[0]->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request deactivation, </span>
                                <form action="{{ route('admin_villa_update_status', $villa[0]->id_villa) }}" method="get">
                                    <button class="btn" type="submit">deactivate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                @endauth
                {{-- END ALERT CONTENT STATUS --}}
            </div>
            <div class="col-12">
                <div class="row top-profile">
                    <div class="col-12 pd-0">
                        <div class="profile-image">
                            @if ($villa[0]->image)
                            <img src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $villa[0]->image) }}">
                            @else
                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                            Auth::user()->role_id == 2)
                            &nbsp;
                            <a class="edit-profile" type="button" onclick="edit_villa_profile()"><i class="fa fa-pencil-alt"
                                    style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                    data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @if ($villa[0]->image)
                            <a class="delete-profile" href="javascript:void(0);" onclick="delete_profile_image({'id': `{{$villa[0]->id_villa}}`})">
                                <i class="fa fa-trash" data-bs-toggle="popover"
                                    data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i></a>
                            {{-- <a href="{{ route('villa_delete_image', $villa[0]->id_villa) }}"><i class="fa fa-trash"
                                    data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i></a> --}}
                            @endif
                            @endif
                            @endauth
                            {{-- Story Video Slider --}}
                            <div class="story-video-slider-block">
                                <ul class="stories inner-wrap">
                                @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                @if ($stories->count() == 0)
                                <li class="story">
                                    <div class="img-wrap">
                                        <a class="add-story" type="button" onclick="edit_story()">
                                            <img src="{{ URL::asset('assets/add_story.png') }}">
                                        </a>
                                    </div>
                                </li>
                                @else
                                @if ($stories->count() < 100) <li class="story">
                                    <div class="img-wrap">
                                        <a class="add-story" type="button" onclick="edit_story()">
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
                                                        <a type="button" onclick="view_story({{ $item->id_story }});">
                                                        <div class="story-video-player"><i class="fa fa-play"></i>
                                                        </div>
                                                            <video preload href="" class="story-video-grid"
                                                                style="object-fit: cover;"
                                                                src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name) }}#t=1.0">
                                                            </video>
                                                            @if (Auth::user()->id == $villa[0]->created_by ||
                                                            Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                            {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $villa[0]->id_villa }}" data-idstory="{{ $item->id_story }}" onclick="delete_story({'id': `{{$villa[0]->id_villa}}`, 'id_story': `{{$item->id_story}}`})"> --}}
                                                            <a class="delete-story" href="javascript:void(0);" onclick="delete_story({'id': `{{$villa[0]->id_villa}}`, 'id_story': `{{$item->id_story}}`})">
                                                                {{-- <a href="{{ route('villa_delete_story', ['id' => $villa[0]->id_villa, 'id_story' => $item->id_story]) }}"> --}}
                                                                <i class="fa fa-trash" style="color:red; margin-left: 30px;"
                                                                    data-bs-toggle="popover" data-bs-animation="true"
                                                                    data-bs-placement="bottom" title="Delete"></i>
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
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            <a type="button" onclick="view_story({{ $item->id_story }});">
                                                                <div class="story-video-player"><i class="fa fa-play"></i>
                                                                </div>
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name) }}#t=1.0">
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
                            {{-- End Story Video Slider --}}
                            <div>
                                <p class="location-font-size"><a onclick="view_map('{{ $villa[0]->id_villa }}')" href="javascript:void(0);"><i class="fa fa-map-marker-alt"></i>
                                        {{ $villa[0]->location }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 profile-info">
                        <h2>{{ $villa[0]->name }}</h2>
                        <p>{{ $villa[0]->bedroom }} Bedrooms | {{ $villa[0]->bathroom }} Bathroom |
                            {{ $villa[0]->adult }} Adults | {{ $villa[0]->children }} Children
                            @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                            Auth::user()->role_id == 2)
                            &nbsp;<a type="button" onclick="edit_bedroom()"><i class="fa fa-pencil-alt"
                                    style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                    data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @endif
                            @endauth
                        </p>

                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">{{ $villa[0]->short_description }}
                            @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                            Auth::user()->role_id == 2)
                            &nbsp;<a type="button" onclick="editShortDescriptionForm()"><i class="fa fa-pencil-alt"
                                    style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                    data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @endif
                            @endauth
                        </p>
                        @auth
                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                        Auth::user()->role_id == 2)
                        <div id="short-description-form" style="display:none;">
                            <form action="{{ route('villa_update_short_description') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}" required>
                                <textarea style="width: 100%;" name="short_description"
                                    id="short-description-form-input" cols="30" rows="3" maxlength="255"
                                    required>{{ $villa[0]->short_description }}</textarea>
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
                        @auth
                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                        Auth::user()->role_id == 2)
                        <div id="short-description-form" style="display:none;">
                            <form action="{{ route('villa_update_short_description') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}" required>
                                <textarea name="short_description" id="short-description-form-input" cols="30" rows="3"
                                    maxlength="255" required>{{ $villa[0]->short_description }}</textarea>
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
                                <i aria-label="Posts" class="far fa-image navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span>&nbsp
                                GALLERY</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                ABOUT</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span>&nbsp
                                AMENITIES</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                LOCATION</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                AVAILABILITY</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="review-sticky"  class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span>&nbsp
                                REVIEW</span>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- END STICKY BAR --}}

                {{-- PAGE CONTENT --}}
                <div class="js-gallery">
                    {{-- GALLERY --}}
                    <section id="gallery" class="section">
                        <div class="photosGrid">
                        @if ($photo->count() > 0)
                        @foreach ($photo as $item)
                        <a href="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name) }}"
                            class="img-lightbox photosGrid__Photo"
                            style="background-image: url('{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name) }}')">
                        </a>
                        @auth
                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                        Auth::user()->role_id == 2)
                        {{-- <a class="delete" href="{{ route('villa_delete_photo_photo', ['id' => $villa[0]->id_villa, 'id_photo' => $item->id_photo]) }}"> --}}
                        <a class="delete delete-photo" href="javascript:void(0);" onclick="delete_photo_photo({'id': `{{$villa[0]->id_villa}}`, 'id_photo': `{{$item->id_photo}}`})"><i class="fa fa-trash"></i></a>
                        <a type="button" class="delete" style="left: -40px !important; " onclick="position_photo()"><i class="fa fa-pencil"></i></a>
                        @endif
                        @endauth
                        @endforeach

                        @endif
                        @if ($video->count() > 0)
                        @foreach ($video as $item)
                        <a class="video-grid" type="button" onclick="view({{ $item->id_video }});">
                            <i class="fas fa-2x fa-play video-button"></i>
                            <video preload href="" class="photosGrid__Photo" style="object-fit: cover;"
                                src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name) }}#t=1.0">
                            </video>
                        </a>
                        @auth
                        @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                        Auth::user()->role_id == 2)
                        <a class="delete delete-video" href="javascript:void(0);" onclick="delete_photo_video({'id': `{{$villa[0]->id_villa}}`, 'id_video': `{{$item->id_video}}`})"><i class="fa fa-trash"></i></a>
                        {{-- <a class="delete" href="{{ route('villa_delete_photo_video', ['id' => $villa[0]->id_villa, 'id_video' => $item->id_video]) }}"><i class="fa fa-trash"></i></a> --}}
                        @endif
                        @endauth
                        {{-- <a href="{{ URL::asset('/foto/gallery/'.strtolower($villa[0]->name).'/'.$item->name)}}"
                        class="img-lightbox photosGrid__Photo"
                        style="background-image:
                        url('{{ URL::asset('/foto/gallery/'.strtolower($villa[0]->name).'/'.$item->name)}}')">
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
                        </div>
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                    @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                    Auth::user()->role_id == 2)
                    <section style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                        <form class="dropzone" id="frmTarget">
                            @csrf
                            <input type="hidden" value="{{ $villa[0]->id_villa }}" id="id_villa" name="id_villa">
                        </form>
                        <button type="submit" id="button" class="btn btn-primary">Upload</button>
                    </section>
                    @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    <section id="description" class="section-2">
                        {{-- Description --}}
                        <div class="about-place">
                            <h2>About this place</h2>
                            <p id="description-content">
                                {{ $villa[0]->description }}
                                @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="editDescriptionForm()"><i class="fa fa-pencil-alt"
                                        style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                                @endauth
                            </p>
                            @auth
                            @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                            Auth::user()->role_id == 2)
                            <div id="description-form" style="display:none;">
                                <form action="{{ route('villa_update_description') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}" required>
                                    <div class="form-group">
                                        <textarea name="description" id="description-form-input" class="w-100" rows="5"
                                            required>{{ $villa[0]->description }}</textarea>
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
                                What this place offers
                                @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="edit_amenities()"><i class="fa fa-pencil-alt"
                                        style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                                @endauth
                            </h2>
                            <div class="row">
                                <div class="col-12">
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
                            </div>
                            <div class="amenities-box">
                                <button type="button" onclick="amenities()">More amenities</button>
                            </div>
                            <hr>
                        </div>
                    </section>
                    <section id="location-map" class="section-2" >
                        <div class="pd-tlr-10">
                            <h2>
                                Location
                                @auth
                                @if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 2)
                                &nbsp;
                                <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                        style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                @endif
                                @endauth
                            </h2>
                            <input type="hidden" value="{{ $villa[0]->latitude }}" name="latitude" id="latitude">
                            <input type="hidden" value="{{ $villa[0]->longitude }}" name="longitude" id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div>
                        </div>
                    </section>
                    <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div>
                    <section id="availability" class="section-2" >
                        <div class="pd-tlr-10">
                            <h2>Availability</h2>
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
            </div>
            <div class="col-12">
                {{-- MOBILE --}}
                <div class="reserve-fixed">
                    <div class="autohide reserve-mobile">
                        <div class="row">
                            <div class="col-7 mobile-price">
                                <p>IDR <span>{{ number_format($villa[0]->price, 0, ',', '.') }}</span>/night</p>
                                <p class="price-box"><i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                        @if ($ratting->count() > 0)
                                        {{ $ratting[0]->average }} reviews
                                    </p>
                                    @endif
                                <p class="price-box">{{-- Tanggal Booking --}} <a href="#">12 May - 24 June 2022</a></p>
                            </div>
                            <div class="col-5 text-right">
                                <button onclick="reserve()" type="button" class="reserve-mobile-button">RESERVE
                                    NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MOBILE --}}
            </div>
        </div>
        {{-- FULL WIDTH ABOVE FOOTER --}}
        <div class="col-lg-12 pd-left-right-10">
            <div class="col-12">
                <section id="review" class="section-2">
                        <h2 class="margin-0">Review</h2>
                        <div class="row review">
                            @if ($detail->count() > 0)
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
                            @else
                                <div class="col-12 no-review">There is no review yet</div>
                            @endif
                        </div>
                    <hr>
                </section>
                <div class="section" id="host_end">
                    <div class="host">
                        <div class="row">
                            <div class="col-2 host-profile">
                                <img src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $villa[0]->image) }}">
                            </div>
                            <div class=" col-10">
                                <div class="member-profile">
                                    <h4>Hosted by {{ $createdby[0]->first_name }}</h4>
                                    <p>Joined in November 2020</p>
                                </div>
                            </div>
                        </div>
                        <div class="member-profile-desc">
                            <p class="host-review"><i class="fa fa-heart" style="color: red;"></i> 141 Reviews | <i class="fa fa-check"
                                    style="color: green;"></i> Identity verified</p>
                            <h4>During your stay</h4>
                            <p>I won't be there during your stay, however our amazingly<br> friendly staff Yudha
                                will be there to attend your needs</p>
                            <p>Response rate: 100%</p>
                            <p>Response time: within an hour</p>
                            <button type="button" onclick="contactHostForm()" class="member-profile-button">Contact
                                Host</button>
                            <div class="row mt-20">
                                <div class="payment-warning-icon">
                                    <i class="fa fa-exclamation-triangle"></i> <span class="payment-warning">
                                    To protect your payment, never transfer money or communicate outside of the EZ
                                    Villas Bali website or app.</span>
                                </div>
                                {{-- <div class="col-11 payment-warning">
                                    To protect your payment, never transfer money or communicate outside of the EZ
                                    Villas Bali website or app.
                                </div> --}}
                            </div>
                            <hr>
                            <h4>Things to know</h4>
                            <div class="row">
                                <div class="col-12 ml-10">
                                    <h6>House Rules</h6>
                                    <p><i class="fas fa-clock"></i> Check-in: After 3:00 PM<br>
                                        <i class="fas fa-smoking-ban"></i> No smoking<br>
                                        <i class="fas fa-ban"></i> No parties or events
                                    </p>
                                </div>
                                <div class="col-12 ml-10">
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
                                <div class="col-12 ml-10">
                                    <h6>Cancellation Policy</h6>
                                    <p>Add your trip dates to get the cancellation details for this stay.</p>
                                    <p><a href="#">Add Date <i class="fas fa-chevron-right"></i></a></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 extra-info ml-10">
                                    <h4><span><i class="fas fa-utensils"></i> </span> Restaurants & Cafes</h4>
                                    @foreach ($last as $item)
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
                                <div class="col-12 extra-info ml-10">
                                    <h4><span><i class="fas fa-glasses"></i> </span> Top Things To Do</h4>
                                    @foreach ($last2 as $item)
                                    @if (!empty($item))
                                    <p>{{ $item[2] }} <span>{{ $item[0] }} Km</span></p>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-12 extra-info ml-10">
                                    <h4><span><i class="fas fa-leaf"></i> </span> Beauty & Spas</h4>
                                    <p>Beauty Salon- La Cantiques <span>0.6 Km</span></p>
                                    <p>Gym - Gym Papa & Mama <span>2.9 Km</span></p>
                                    <p>Spa - Be Retreat Spa <span>5.7 Km</span></p>
                                    <p>Haircut - TamPans Baber Shop <span>1.4 Km</span></p>
                                    <p>Nail Care - Svndari Salon & Spa <span>2.7s Km</span></p>
                                    <h4><span><i class="fas fa-map-marker-alt"></i> </span> Closest Airport</h4>
                                    <p><i class="fas fa-plane"></i> Ngurah Rai International Airport <span>30
                                            Km</span>
                                    </p>
                                    <h6>How to get to <strong>{{ $villa[0]->name }}</strong> from Ngurah Rai
                                        International
                                        Airport?</h6>
                                    <p><i class="fas fa-car"></i> Taxi &nbsp; <i class="fas fa-bus"></i>
                                        Private Suttle
                                        &nbsp; <i class="fas fa-motorcycle"></i> GoJek</p>
                                    <p><i class="fas fa-coffee"></i> <strong>Free welcome drink</strong> upon
                                        arrival.
                                    </p>
                                </div>
                            </div>
                            <p style="font-size: small;">* All distances are measured in straight lines. Actual
                                travel
                                distances may vary.</p>
                            <hr>
                            <h4>Nearby Restaurants & Things To Do</h4>

                            {{-- Oke --}}

                            <div class="row related-items">
                                <h6><span><i class="fas fa-utensils"></i></span> Restaurants</h6>
                                <div class="containerSlider">
                                    <div id="slide-left-container">
                                        <div class="slide-left">
                                        </div>
                                    </div>
                                    <div id="cards-container">
                                        <div class="cards">
                                            @forelse ($nearby_restaurant as $item)
                                            <div class="card col-lg-3" style="border-radius: 5px;">
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
                                                <div class="col-12">
                                                    <p class="no-related-items">
                                                        <span>No Restaurants Found</span></a>
                                                    </p>
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

                            <div class="row related-items">
                                <h6><span><i class="fa fa-walking"></i></span> Things To Do</h6>
                                <div class="containerSlider2">
                                    <div id="slide-left-container2">
                                        <div class="slide-left2">
                                        </div>
                                    </div>
                                    <div id="cards-container2">
                                        <div class="cards2">
                                            @forelse ($nearby_activities as $item)
                                            <div class="card2 col-lg-3" style="border-radius: 5px;">
                                                <a href="{{ route('activity', $item->id_activity) }}" target="_blank">
                                                    <img src="{{ URL::asset('/foto/activity/' . strtolower($item->name) . '/' . $item->image) }}"
                                                        alt="Things To Do"
                                                        style="width:100%; aspect-ratio: 4/4; object-fit: cover; border-radius: 15px; height: 250px;"
                                                        class="img-shadow">
                                                </a>
                                                <center>
                                                    <p style="margin-top: 10px;">
                                                        <p>{{ $item->name }}</p>
                                                    </p>
                                                </center>
                                            </div>
                                            @empty
                                                <div class="col-12">
                                                    <p class="no-related-items">
                                                        <span>No Things To Do Found</span></a>
                                                    </p>
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

                            {{-- <div class="row">
                            <h6><span><i class="fas fa-utensils"></i></span> Restaurants</h6>
                            @forelse ($nearby_restaurant as $item)
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <p style="margin-bottom: 0px; text-align: center;"><a
                                        href="{{ route('restaurant', $item->id_restaurant) }}"><img
                                style="box-shadow: 1px 1px 10px #979797; border-radius: 12px; margin-bottom: 15px;"
                                src="{{ URL::asset('/foto/restaurant/'.strtolower($item->name).'/'.$item->image)}}">
                            <span>{{ $item->name }}</span></a></p>
                        </div>
                        @empty
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <center>
                                <p style="margin-bottom: 0px; text-align: center;">
                                    <span>No Things To Do Found</span></a></p>
                            </center>
                        </div>
                        @endforelse
                    </div>

                    <div class="row" style="margin-top: 14px;">
                        <h6><span><i class="fas fa-walking"></i></span> Things To Do</h6>
                        @forelse ($nearby_activities as $item)
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <p style="margin-bottom: 0px; text-align: center;"><a
                                    href="{{ route('activity', $item->id_activity) }}"><img
                                        style="box-shadow: 1px 1px 10px #979797; border-radius: 12px; margin-bottom: 15px;"
                                        src="{{ URL::asset('/foto/activity/'.strtolower($item->name).'/'.$item->image)}}">
                                    <span>{{ $item->name }}</span></a></p>
                        </div>
                        @empty
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <center>
                                <p style="margin-bottom: 0px; text-align: center;">
                                    <span>No Things To Do Found</span></a></p>
                            </center>
                        </div>
                        @endforelse
                    </div> --}}
                </div>
        </div>
    </div>
    </div>
    {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>
    {{-- MODAL --}}
    @auth
    @include('user.modal.villa.price')
    @include('user.modal.villa.bedroom')
    @include('user.modal.villa.guest')
    @include('user.modal.villa.location')
    @include('user.modal.villa.amenities_add')
    @include('user.modal.villa.description')
    @include('user.modal.villa.short_description')
    @include('user.modal.villa.story')
    @include('user.modal.villa.photo')
    @include('user.modal.villa.villa_profile')
    @endauth
    {{-- STORY MODAL --}}
    {{-- <div class="modal fade" id="storymodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                <center>
                    <input type="hidden" id="id_story" name="id_story" value="">
                    <input type="hidden" id="villa" name="villa" value="{{ $villa[0]->name }}">

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
            <h5 class="video-title" id="title"></h5>
            <div class="modal-content video-container" style="width:980px;">
                <center>
                    <input type="hidden" id="id_story" name="id_story" value="{{ $villa[0]->id_villa }}">
                    <input type="hidden" id="villa" name="villa" value="{{ $villa[0]->name }}">

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
    {{-- MODAL AMENITIES --}}
    <div class="modal fade" id="modal-amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:15px">
                <div class="modal-header">
                    <h5 class="modal-title">All Amenities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    @php
                    $amenities = App\Http\Controllers\ViewController::amenities($villa[0]->id_villa);
                    $bathroom = App\Http\Controllers\ViewController::bathroom($villa[0]->id_villa);
                    $bedroom = App\Http\Controllers\ViewController::bedroom($villa[0]->id_villa);
                    $kitchen = App\Http\Controllers\ViewController::kitchen($villa[0]->id_villa);
                    $safety = App\Http\Controllers\ViewController::safety($villa[0]->id_villa);
                    $service = App\Http\Controllers\ViewController::service($villa[0]->id_villa);
                    echo '<div class="row row-border-bottom">';
                        foreach ($amenities as $item) {
                        echo "<div class='col-md-6 mb-2'><span><i class='fa fa-" . $item->icon . "'></i>
                                " . $item->name . "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';
                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                    echo '<h5 class="mb-3">Bathroom</h5>';
                        foreach ($bathroom as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" . $item->icon . "'></i>
                                " . $item->name . "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                    echo '<h5 class="mb-3">Bedroom</h5>';
                        foreach ($bedroom as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" . $item->icon . "'></i>
                                " . $item->name . "</span> </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                    echo '<h5 class="mb-3">Kitchen</h5>';
                        foreach ($kitchen as $item) {
                        echo "<div class='col-md-8 '><span><i class='fa fa-" . $item->icon . "'></i>
                                " . $item->name . "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                    echo '<h5 class="mb-3">Safety</h5>';
                        foreach ($safety as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" . $item->icon . "'></i>
                                " . $item->name . "</span>
                        </div>";
                        }
                        echo '</div>';
                    echo '
                    ';

                    echo '<div class="row padding-top-bottom-18px">';
                    echo '<h5 class="mb-3">Service</h5>';
                        foreach ($service as $item) {
                        echo "<div class='col-md-6 '><span><i class='fa fa-" . $item->icon . "'></i>
                                " .
                                $item->name .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                    @endphp
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL RESERVE --}}
    <div class="modal fade" id="modal-reserve" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
					<div class="reserve-block">
						<input type="hidden" id="id_villa" name="id_villa" value="{{ $villa[0]->id_villa }}">
						@auth
							@if (Auth::user()->id == $villa[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
								&nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt"
										style="color: #FF7400; padding-right:5px;" data-bs-toggle="popover"
										data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
							@endif
						@endauth
						<form method="POST" action="{{ route('villa_booking_confirm') }}">
							@csrf
							<input type="hidden" name="id_villa" value="{{ $villa[0]->id_villa }}">
							<div class="row">
								<div class="col-7">
									<p class="price-box">IDR
										<span>{{ number_format($villa[0]->price, 0, ',', '.') }}</span>/night
									</p>
								</div>
								<div class="col-5" style="display: flex; align-items: center;">
									<p class="price-box" style="text-align: end;"><i class="fa fa-star"
											style="color: orange; font-size:14px"></i>
										@if ($ratting->count() > 0)
											{{ $ratting[0]->average }} reviews
									</p>
									@endif
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
													CHECK-IN
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
													CHECK-OUT
												</p>
												<input class=""
													style="font-size: 15px; margin-left: 0px; width: 100px; text-align: center; border: none !important; border-color: transparent !important;"
													type="text" id="check_out" name="check_out"
													style="width:80%; border:0" placeholder="Add Date" readonly>
											</button>
										</div>
									</div>
									<div class="content sidebar-popup" id="popup_check"
										style="width: 700px; margin-left: -410px; margin-top: 80px;">
										<div class="desk-e-call">
											<div class="flatpickr-container"
												style="display: flex; justify-content: center;">
												<div style="display: table;">
													<div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
														class="col-lg-12">
														<p style="margin: 0px; font-size: 13px;">Clear Dates</p>
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
								<div class="col-12 p-9-price line-top" style="border: 2px solid #FF7400; margin-top: 19px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4">
									<button type="button" class="collapsible">Guest
										<p style="font-size: 10px; float: right; margin: 0px;">guest</p>
										<input type="number" id="total_guest2" value="1"
											style="width: 16px; float: right; border:0;" min="0" readonly>
									</button>
									<div class="content sidebar-popup" style="left: 973px;">
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
							<div class="col-12"
								style="display: flex; flex-direction: column; border: 2px solid #ff7400; border-radius:15px; padding: 9px; box-sizing: border-box; box-shadow: 1px 1px 10px #a4a4a4">
								<div class="col-12" style="display: flex;">
									<div class="col-6" style="border-right: 2px solid #ff7400;">
										<p style="font-size: 12px; margin:0px;">Total Nights</p>
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
									value="RESERVE NOW"></div>
							<div class="col-12 p-5-price price-box text-center" style="margin-top: 9px;">You won't be
								charged yet</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
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
                        <img src="{{ URL::asset('/foto/gallery/' . strtolower($villa[0]->name) . '/' . $villa[0]->image) }}"
                            style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        <p class="d-flex align-items-center">{{ $villa[0]->name }}</p>
                    </div>
                    <div>
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col-lg col-12 p-3 border share-med">
                                <a type="button" class="d-flex p-0" onclick="copy_link()">
                                    <div class="pr-5"><i class="fas fa-copy"></i> <span
                                            class="fw-normal">Copy Link</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $villa[0]->id_villa) }}&display=popup"
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
                                <a href="https://api.whatsapp.com/send?text={{ route('villa', $villa[0]->id_villa) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://telegram.me/share/url?url={{ route('villa', $villa[0]->id_villa) }}&text={{ route('villa', $villa[0]->id_villa) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $villa[0]->id_villa) }}"
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
    <script>
        function copy_link() {
            alert('link has been copied');
            navigator.clipboard.writeText(window.location.href);
        }
    </script>
    {{-- MODAL CONTACT HOST --}}
    <div class="modal fade" id="modal-contact-host" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <form action="{{ route('villa_store_user_message') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}">
                        <div class="form-group">
                            <textarea name="message" rows="10" class="form-control w-100" value="{{ old('message') }}"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CONTACT HOST --}}
    <div class="modal fade" id="edit_position_photo" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">Edit Position Photos</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" style="margin-left: 1086px; position: absolute;"><i style="font-size: 22px;" class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                        {{-- <input type="hidden" name="id_owner" value="{{ $villa[0]->created_by }}"> --}}
                        {{-- reorder image --}}
                        <ul id="sortable" >
                            <?php
                            foreach($photo as $item){
                                $id = $item->id_photo;
                                $name = $item->name;

                                echo '<li class="ui-state-default" data-id="'.$id.'" >
                                <img src="../foto/gallery/' . strtolower($villa[0]->name) . '/' . $item->name.'" title="'.$name.'" >
                                </li>';
                            }
                            ?>
                        </ul>

                        <div style="clear: both; margin-top: 20px;">
                            <input type='button' class="btn-edit-position-photos" value='Submit' id='submit'>
                        </div>

                </div>
            </div>
        </div>
    </div>

        {{-- MAP MODAL --}}
<div class="modal fade" id="modal-map" tabindex="-1" role="dialog"
aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-map">
            <div class="modal-header">
                <h5 class="modal-title">Map</h5>
                <button type="button" class="btn-close" onclick="close_map()"></button>
            </div>
            <div class="modal-body pb-1" style="height: 500px">
                {{-- <iframe
                    src="https://maps.google.com/?q={{ $data->latitude }},{{ $data->longitude }}&output=embed"
                    class="w-100 h-100"></iframe> --}}
                    <iframe id="modal-map-content" src="" class="w-100 h-100"></iframe>
            </div>
        </div>
    </div>
</div>
@include('layouts.user.footer')
</div>
    
{{-- modal laguage and currency --}}
@include('user.modal.filter.filter_language')
{{-- modal laguage and currency --}}
{{-- END MODAL --}}
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
<script src="{{ asset('assets/js/m-view-villa.js') }}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

{{-- SweetAlert JS --}}
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

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
                id: `{{ $villa[0]->id_villa }}`
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
                id: `{{ $villa[0]->id_villa }}`
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
    $('#adult2').on('change', function () {
        var total_adult2 = parseInt($('#adult2').val()) + parseInt($('#child2').val());
        $('#total_guest2').val(total_adult2);
        $('#adult4').val($('#adult2').val());
        $('#child4').val($('#child2').val());
        $('#total_guest4').val($('#total_guest2').val());
    });

    $('#child2').on('change', function () {
        var total_child2 = parseInt($('#adult2').val()) + parseInt($('#child2').val());
        $('#total_guest2').val(total_child2);
        $('#adult4').val($('#adult2').val());
        $('#child4').val($('#child2').val());
        $('#total_guest4').val($('#total_guest2').val());
    });

</script>

<script>
    $('#adult4').on('change', function () {
        var total_adult4 = parseInt($('#adult4').val()) + parseInt($('#child4').val());
        $('#total_guest4').val(total_adult4);
        $('#adult2').val($('#adult4').val());
        $('#child2').val($('#child4').val());
        $('#total_guest2').val($('#total_guest4').val());
    });

    $('#child4').on('change', function () {
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

{{-- <script>
    $('#check_in2').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        mode: "range",
        showMonths: 2,
        onChange: function (selectedDates, dateStr, instance) {
            $('#check_out2').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: new Date(dateStr).fp_incr(1),
                onChange: function (selectedDates, dateStr, instance) {
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

</script> --}}

{{-- <script>
    $('#check_in3').flatpickr({
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

</script> --}}

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

{{-- <script>
    $("#searchbox").click(function () {
        $("#search_bar").toggleClass("active");
    });

</script> --}}

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
        formInput.value = '{{ $villa[0]->short_description }}';
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
        formInput.value = '{{ $villa[0]->description }}';
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
        url: '/admin/villa/store_gallery',
        parallelUploads: 50,
        init: function () {

            var myDropzone = this;

            // Update selector to match your button
            $("#button").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();

            });

            this.on('sending', function (file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                // var data = $('#frmTarget').serializeArray();
                // $.each(data, function(key, el) {
                //     formData.append(el.name, el.value);
                // });
                var value = $('form#formData #id_villa').val();
                formData.append('id_villa', value);
            });

            this.on('queuecomplete', function () {
                location.reload();
            });

            this.on("addedfile", function (file) {

                // Create the remove button
                var removeButton = Dropzone.createElement(
                    "<center><button class='btn btn-outline-light btn-del'>Remove</button></center>"
                );


                // Capture the Dropzone instance as closure.
                var _this = this;

                // Listen to the click event
                removeButton.addEventListener("click", function (e) {
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

{{-- <script>
    // Semi Fixed
    $(document).ready(function() {
        var $window = $(window);
        var $sidebar = $("#sidebar_fix");
        var $sidebarHeight = $sidebar.innerHeight();
        var $footerOffsetTop = $(".footer-scroll").offset().top;
        var $sidebarOffset = $sidebar.offset();

        $window.scroll(function() {
            if($window.scrollTop() > $sidebarOffset.top) {
            $sidebar.addClass("fixed");
            } else {
            $sidebar.removeClass("fixed");
            }
            if($window.scrollTop() + $sidebarHeight > $footerOffsetTop) {
            $sidebar.css({"top" : -($window.scrollTop() + $sidebarHeight - $footerOffsetTop)});
            } else {
            $sidebar.css({"top": "0",});
            }
        });
    });

</script> --}}

{{-- <script>
    // Show Hide Reserve Button

    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= $(
                '.rsv-block').offset().top + $('.rsv-block').outerHeight() - window.innerHeight) {

            document.getElementById("rsv-block-btn").style.display = "block";
        } else {
            document.getElementById("rsv-block-btn").style.display = "none";
        };
    });

</script> --}}

{{-- <script>
    // Collapsable

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

</script> --}}

{{-- <script>
// Collapsable

var coll = document.getElementsByClassName("collapsible_check");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = document.getElementById('popup_check');
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}

</script> --}}

<script>
    function adult_increment() {
        document.getElementById('adult2').stepUp();
        document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) + parseInt(document.getElementById('child2').value);
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('adult4').value = document.getElementById('adult2').value;
    }

    function adult_decrement() {
        document.getElementById('adult2').stepDown();
        document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) + parseInt(document.getElementById('child2').value);
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('adult4').value = document.getElementById('adult2').value;
    }

    function child_increment() {
        document.getElementById('child2').stepUp();
        document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) + parseInt(document.getElementById('child2').value);
        document.getElementById('total_guest4').value = document.getElementById('total_guest2').value;
        document.getElementById('child4').value = document.getElementById('child2').value;
    }

    function child_decrement() {
        document.getElementById('child2').stepDown();
        document.getElementById('total_guest2').value = parseInt(document.getElementById('adult2').value) + parseInt(document.getElementById('child2').value);
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
        if ( $window.scrollTop() >= gallery && $window.scrollTop() < description ) {
            $('#gallery-sticky').addClass('active-sticky');
            $('#about-sticky').removeClass('active-sticky');
            $('#amenities-sticky').removeClass('active-sticky');
            $('#location-sticky').removeClass('active-sticky');
            $('#availability-sticky').removeClass('active-sticky');
            $('#review-sticky').removeClass('active-sticky');
        }else if ( $window.scrollTop() >= description && $window.scrollTop() < amenities ) {
            $('#gallery-sticky').removeClass('active-sticky');
            $('#about-sticky').addClass('active-sticky');
            $('#amenities-sticky').removeClass('active-sticky');
            $('#location-sticky').removeClass('active-sticky');
            $('#availability-sticky').removeClass('active-sticky');
            $('#review-sticky').removeClass('active-sticky');
        }else if ( $window.scrollTop() >= amenities && $window.scrollTop() < location_menu ) {
            $('#gallery-sticky').removeClass('active-sticky');
            $('#about-sticky').removeClass('active-sticky');
            $('#amenities-sticky').addClass('active-sticky');
            $('#location-sticky').removeClass('active-sticky');
            $('#availability-sticky').removeClass('active-sticky');
            $('#review-sticky').removeClass('active-sticky');
        }else if ( $window.scrollTop() >= location_menu && $window.scrollTop() < availability ) {
            $('#gallery-sticky').removeClass('active-sticky');
            $('#about-sticky').removeClass('active-sticky');
            $('#amenities-sticky').removeClass('active-sticky');
            $('#location-sticky').addClass('active-sticky');
            $('#availability-sticky').removeClass('active-sticky');
            $('#review-sticky').removeClass('active-sticky');
        }else if ( $window.scrollTop() >= availability && $window.scrollTop() < review ) {
            $('#gallery-sticky').removeClass('active-sticky');
            $('#about-sticky').removeClass('active-sticky');
            $('#amenities-sticky').removeClass('active-sticky');
            $('#location-sticky').removeClass('active-sticky');
            $('#availability-sticky').addClass('active-sticky');
            $('#review-sticky').removeClass('active-sticky');
        }else if ( $window.scrollTop() >= review && $window.scrollTop() < host ) {
            $('#gallery-sticky').removeClass('active-sticky');
            $('#about-sticky').removeClass('active-sticky');
            $('#amenities-sticky').removeClass('active-sticky');
            $('#location-sticky').removeClass('active-sticky');
            $('#availability-sticky').removeClass('active-sticky');
            $('#review-sticky').addClass('active-sticky');
        }else{
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
            if(result.isConfirmed){
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/villa/${ids.id}/delete/story/${ids.id_story}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message ,'error');
                        }
                    },
                    success: async function (data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message ,'success');
                        location.reload();
                    }
                });
            }
            else {
                Swal.fire('Cancel','Canceled Deleted Data','error')
            }
        });
    };
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
            if(result.isConfirmed){
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/villa/${ids.id}/delete/image`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message ,'error');
                        }
                    },
                    success: async function (data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message ,'success');
                        location.reload();
                    }
                });
            }
            else {
                Swal.fire('Cancel','Canceled Deleted Data','error')
            }
        });
    };
</script>

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
            if(result.isConfirmed){
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/villa/${ids.id}/delete/photo/photo/${ids.id_photo}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message ,'error');
                        }
                    },
                    success: async function (data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message ,'success');
                        location.reload();
                    }
                });
            }
            else {
                Swal.fire('Cancel','Canceled Deleted Data','error')
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
            if(result.isConfirmed){
                $.ajax({
                    type: "get",
                    dataType: 'json',
                    url: `/villa/${ids.id}/delete/photo/video/${ids.id_video}`,
                    statusCode: {
                        500: () => {
                            Swal.fire('Failed', data.message ,'error');
                        }
                    },
                    success: async function (data) {
                        // console.log(data.message);
                        await Swal.fire('Deleted', data.message ,'success');
                        location.reload();
                    }
                });
            }
            else {
                Swal.fire('Cancel','Canceled Deleted Data','error')
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
                console.log(data);
                var src = `https://maps.google.com/?q=${data.latitude},${data.longitude}&output=embed`;
                $("#modal-map-content").attr('src', src)
                $("#modal-map").modal('show');
            }
        });
    }
    function close_map() {
        $("#modal-map").modal('hide');
    }
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

<script type="text/javascript">
    //copy link
    function copy_link()
    {
        navigator.clipboard.writeText(window.location.href);
        alert('link has been copied');
    }
</script>

<script>
    function language() {
        $('#LegalModal').modal('show');
    }
</script>
<script>
//Show/hide bottom menu
document.addEventListener("DOMContentLoaded", function(){

el_autohide = document.querySelector('.autohide');

// add padding-top to bady (if necessary)
navbar_height = document.querySelector('.reserve-mobile').offsetHeight;
//document.body.style.paddingTop = navbar_height + 'px';

if(el_autohide){
  var last_scroll_top = 0;
  window.addEventListener('scroll', function() {
        let scroll_top = window.scrollY;
       if(scroll_top < last_scroll_top) {
            el_autohide.classList.remove('scrolled-down');
            el_autohide.classList.add('scrolled-up');
        }
        else {
            el_autohide.classList.remove('scrolled-up');
            el_autohide.classList.add('scrolled-down');
        }
        last_scroll_top = scroll_top;
  }); 
  // window.addEventListener
}
// if

}); 
// DOMContentLoaded  end
</script>

<script>
//Show/hide top menu
document.addEventListener("DOMContentLoaded", function(){

el_autohide2 = document.querySelector('.autohide2');

// add padding-top to bady (if necessary)
navbar_height = document.querySelector('.head-inner-wrap').offsetHeight;
//document.body.style.paddingTop = navbar_height + 'px';

if(el_autohide2){
  var last_scroll_top = 0;
  window.addEventListener('scroll', function() {
        let scroll_top = window.scrollY;
       if(scroll_top > last_scroll_top) {
            el_autohide2.classList.remove('scroll-down');
            el_autohide2.classList.add('scroll-up');
        }
        else {
            el_autohide2.classList.remove('scroll-up');
            el_autohide2.classList.add('scroll-down');
        }
        last_scroll_top = scroll_top;
  }); 
  // window.addEventListener
}
// if

}); 
</script>

<script>
    function reserve() {
        $('#modal-reserve').modal('show');
    }
</script>

</body>
</html>
