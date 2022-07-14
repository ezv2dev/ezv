<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title> {{ $hotel[0]->name }} - EZV2</title>
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
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/errorToString.js') }}"></script>

    <!-- END Icons -->

    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/villa-slider.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-hotel-room.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header-css.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/simpleLightbox.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body style="background-color:white">
    @include('components.notification.notification')
    @component('components.loading.loading-type1')
    @endcomponent
    <input type="hidden" id="min_stay" name="min_stay" value="{{ $hotel[0]->min_stay }}">
    <input type="hidden" id="price" name="price" value="{{ $hotel[0]->price }}">
    <input type="hidden" id="price3" name="price" value="{{ $hotel[0]->price }}">
    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}

        {{-- PROFILE --}}
        <div class="row page-content">
            {{-- LEFT CONTENT --}}
            <div class="col-lg-9 col-md-9 col-xs-12 rsv-block alert-detail">
                {{-- ALERT CONTENT STATUS --}}
                @auth
                    @if (auth()->user()->id == $hotel[0]->created_by)
                        @if ($hotel[0]->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>{{ __('user_page.this content is deactive,') }} </span>
                                <form action="{{ route('hotel_request_update_status', $hotel[0]->id_hotel) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.request activation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($hotel[0]->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>{{ __('user_page.this content is active,') }} </span>
                                <form action="{{ route('hotel_request_update_status', $hotel[0]->id_hotel) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.request deactivation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($hotel[0]->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.you have been request activation for this content,') }} </span>
                                <form action="{{ route('hotel_cancel_request_update_status', $hotel[0]->id_hotel) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.cancel activation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($hotel[0]->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.you have been request deactivation for this content,') }} </span>
                                <form action="{{ route('hotel_cancel_request_update_status', $hotel[0]->id_hotel) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.cancel deactivation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($hotel[0]->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                {{ __('user_page.this content is deactive') }}
                            </div>
                        @endif
                        @if ($hotel[0]->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                {{ __('user_page.this content is active, edit grade hotel') }}
                                <form action="{{ route('hotel_update_grade', $hotel[0]->id_hotel) }}" method="post">
                                    @csrf
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade-success" name="grade"
                                            onchange='this.form.submit()'>
                                            <option value="AA" {{ $hotel[0]->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $hotel[0]->grade == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ $hotel[0]->grade == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ $hotel[0]->grade == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ $hotel[0]->grade == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                        <noscript><input type="submit" value="Submit"></noscript>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @if ($hotel[0]->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.the owner request activation, choose grade Hotel') }}</span>
                                <form action="{{ route('admin_hotel_update_status', $hotel[0]->id_hotel) }}"
                                    method="get" class="d-flex">
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade" name="grade">
                                            <option value="AA" {{ $hotel[0]->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $hotel[0]->grade == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ $hotel[0]->grade == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ $hotel[0]->grade == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ $hotel[0]->grade == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                    </div>
                                    <span style="margin-left: 10px;">and</span>
                                    <button class="btn" type="submit"
                                        style="margin-top: -7px;">{{ __('user_page.activate this content') }}</button>
                                </form>
                            </div>
                        @endif
                        @if ($hotel[0]->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.the owner request deactivation,') }} </span>
                                <form action="{{ route('admin_hotel_update_status', $hotel[0]->id_hotel) }}"
                                    method="get">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.deactivate this content') }}</button>
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
                            @if ($hotelRoom->image)
                                <img
                                    src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $hotelRoom->image) }}">
                            @else
                                <img src="{{ URL::asset('/template/villa/template_profile.jpg') }}">
                            @endif

                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_hotel_profile()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @if ($hotel[0]->image)
                                        <a class="delete-profile" href="javascript:void(0);"
                                            onclick="delete_profile_image({'id': '{{ $hotelRoom->id_hotel_room }}'})">
                                            <i class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom"
                                                title="{{ __('user_page.Delete') }}"></i></a>
                                        {{-- <a href="{{ route('villa_delete_image', $hotel[0]->id_hotel) }}"><i class="fa fa-trash"
                                style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true"
                                data-bs-placement="bottom" title="{{ __('user_page.Delete') }}"></i></a> --}}
                                    @endif
                                @endif
                            @endauth
                            <div>
                                <p id="property-type-content">
                                    {{ $hotel[0]->propertyType->name }}
                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editPropertyTypeForm()"
                                                style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </p>
                                <p>
                                    @auth
                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <div id="property-type-form" style="display:none;">
                                                <form action="{{ route('villa_update_property_type') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_hotel"
                                                        value="{{ $hotel[0]->id_hotel }}" required>
                                                    <select name="id_property_type" id="property-type-form-input"
                                                        required>
                                                        <option value="">select property type</option>
                                                        @forelse ($propertyType as $type)
                                                            @php
                                                                $isSelected = '';
                                                                if ($type->id_property_type == $hotel[0]->id_property_type) {
                                                                    $isSelected = 'selected';
                                                                }
                                                            @endphp
                                                            <option value="{{ $type->id_property_type }}"
                                                                {{ $isSelected }}>
                                                                {{ $type->name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editPropertyTypeCancel()">
                                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </p>
                            </div>
                            <div>
                                <p class="location-font-size"><a onclick="view_map('{{ $hotel[0]->id_hotel }}')"
                                        href="javascript:void(0);"><i class="fa fa-map-marker-alt"></i>
                                        {{ $hotel[0]->location }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12 profile-info">
                        <h2 id="name-content">{{ $hotelRoom->name }} - <a
                                href="{{ route('hotel', $hotel[0]->id_hotel) }}">{{ $hotel[0]->name }}</a>
                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                @endif
                            @endauth
                        </h2>

                        @auth
                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <form action="{{ route('room_update_name') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_hotel_room"
                                            value="{{ $hotelRoom->id_hotel_room }}" required>
                                        <input type="text" style="width: 100%;" class="form-control" name="name"
                                            id="name-form-input" maxlength="100"
                                            placeholder="{{ __('user_page.Hotel Room Name Here') }}"
                                            value="{{ $hotelRoom->name }}" required>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            style="background-color: #ff7400">
                                            <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary"
                                            onclick="editNameCancel()">
                                            <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        <p>{{ $hotelRoom->room_size }} m<sup>2</sup> | {{ $hotelRoom->capacity }}
                            {{ __('user_page.People') }} |
                            {{ $hotelRoom->bed->name }} {{ __('user_page.Beds') }} |
                            <strong>{{ __('user_page.Total') }}</strong>
                            {{ $hotelRoom->number_of_room }} {{ __('user_page.Rooms') }}
                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_room_size()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                @endif
                            @endauth
                        </p>

                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">
                            {{ Translate::translate($hotelRoom->short_description ?? 'Make your short description here') }}
                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                        style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <form action="{{ route('room_update_short_description') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_hotel_room"
                                            value="{{ $hotelRoom->id_hotel_room }}" required>
                                        <textarea style="width: 100%;" name="short_description" id="short-description-form-input" cols="30"
                                            placeholder="{{ __('user_page.Make your short description here') }}" rows="3" maxlength="255" required>{{ $hotelRoom->short_description }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary"
                                            onclick="editShortDescriptionCancel()">
                                            <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display:none;">
                                    <form action="{{ route('room_update_short_description') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_hotel" value="{{ $hotelRoom->id_hotel_room }}"
                                            required>
                                        <textarea name="short_description" id="short-description-form-input" cols="30" rows="3" maxlength="255"
                                            placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $hotelRoom->short_description }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-secondary"
                                            onclick="editShortDescriptionCancel()">
                                            <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        {{-- END SHORT DESCRIPTION --}}
                        <ul class="stories inner-wrap">

                            @if (Auth::guest() || Auth::user()->role_id == 4)
                                @if ($stories->count() == 0 && $video->count() == 0)
                                    <li class="story">
                                        <div class="img-wrap">
                                            <a type="button"
                                                onclick="requestVideo({'id': '{{ $hotel[0]->created_by }}', 'name': '{{ $hotel[0]->name }}'})">
                                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="{{ URL::asset('assets/2.png') }}">
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endif

                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                    @if ($stories->count() == 0)
                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img src="{{ URL::asset('assets/add_story.png') }}">
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
                                                    <div class="cards4">
                                                        @foreach ($video as $item)
                                                            <div class="card4 col-lg-3 radius-5">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        <a type="button"
                                                                            onclick="view({{ $item->id_video }});">
                                                                            <div class="story-video-player"><i
                                                                                    class="fa fa-play"></i>
                                                                            </div>
                                                                            <video preload href=""
                                                                                class="story-video-grid"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                data-idstory="{{ $item->id_story }}"
                                                                                onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                'id_story': '{{$item->id_story}}'})"> --}}
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="delete_photo_video({'id': '{{ $hotelRoom->id_hotel_room }}', 'id_video': '{{ $item->id_video }}'})">
                                                                                    {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
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
                                        @endif
                                    @else
                                        @if ($stories->count() < 100)
                                            @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                <li class="story">
                                                    <div class="img-wrap">
                                                        <a type="button" onclick="edit_story()">
                                                            <img src="{{ URL::asset('assets/add_story.png') }}">
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
                                                    <div class="cards4">
                                                        @foreach ($stories as $item)
                                                            <div class="card4 col-lg-3 radius-5">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                                            <a type="button"
                                                                                onclick="view_story({{ $item->id_story }});">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player"><i
                                                                                class="fa fa-play"></i>
                                                                        </div>
                                                                        <video preload href=""
                                                                            class="story-video-grid"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                    data-idstory="{{ $item->id_story }}"
                                                                                    onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                    'id_story': '{{$item->id_story}}'})"> --}}
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                onclick="delete_story({'id': '{{ $hotel[0]->id_hotel }}', 'id_story': '{{ $item->id_story }}'})">
                                                                                {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
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
                                                        @foreach ($video as $item)
                                                            <div class="card4 col-lg-3 radius-5">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        <a type="button"
                                                                            onclick="view({{ $item->id_video }});">
                                                                            <div class="story-video-player"><i
                                                                                    class="fa fa-play"></i>
                                                                            </div>
                                                                            <video preload href=""
                                                                                class="story-video-grid"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                {{-- <a class="delete-story" href="javascript:void(0);" data-id="{{ $hotel[0]->id_hotel }}"
                                                                                    data-idstory="{{ $item->id_story }}"
                                                                                    onclick="delete_story({'id': '{{$hotel[0]->id_hotel}}',
                                                                                    'id_story': '{{$item->id_story}}'})"> --}}
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="delete_photo_video({'id': '{{ $hotelRoom->id_hotel_room }}', 'id_video': '{{ $item->id_video }}'})">
                                                                                    {{-- <a href="{{ route('villa_delete_story', ['id' => $hotel[0]->id_hotel, 'id_story' => $item->id_story]) }}"> --}}
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
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $hotel[0]->created_by)
                                                                    <a type="button"
                                                                        onclick="view_story({{ $item->id_story }});"style="height: 70px; width: 70px;">
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
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
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
                                                            <a type="button"
                                                                onclick="view({{ $item->id_video }});"
                                                                style="height: 70px; width: 70px;">
                                                                <div class="story-video-player"><i
                                                                        class="fa fa-play"></i>
                                                                </div>
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
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
                    <div class="col-lg-2 col-md-2 col-xs-12 right-0">
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
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    {{ __('user_page.GALLERY') }}</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    {{ __('user_page.ABOUT') }}</span>
                            </a>
                        </li>
                        <li class="navigationItem ">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    {{ __('user_page.AMENITIES') }}</span>
                            </a>
                        </li>
                        {{-- <li class="navigationItem ">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    LOCATION</span>
                            </a>
                        </li> --}}
                        <li class="navigationItem">
                            <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    {{ __('user_page.AVAILABILITY') }}</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    {{ __('user_page.REVIEW') }}</span>
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
                                @foreach ($photo as $item)
                                    <div class="col-4 grid-phooto">
                                        <a
                                            href="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}">
                                            <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}"
                                                title="{{ $item->caption }}">
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-icon">
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" type="button"
                                                        title="{{ __('user_page.Add Photo Caption') }}"
                                                        onclick="view_add_caption({'id': '{{ $hotelRoom->id_hotel_room }}', 'id_photo': '{{ $item->id_photo }}', 'caption': '{{ $item->caption }}'})"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Photo Position') }}"
                                                        type="button" onclick="position_photo()"><i
                                                            class="fa fa-arrows"></i></button>
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete Photo') }}"
                                                        href="javascript:void(0);"
                                                        onclick="delete_photo_photo({'id': '{{ $hotelRoom->id_hotel_room }}', 'id_photo': '{{ $item->id_photo }}'})"><i
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
                                        <a class="pointer-normal" onclick="view({{ $item->id_video }});"
                                            href="javascript:void(0);">
                                            <video href="javascript:void(0)" class="photo-grid" loading="lazy"
                                                src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                                            </video>
                                            <span class="video-grid-button"><i class="fa fa-play"></i></span>
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-video-icon">
                                                    <button href="javascript:void(0);"
                                                        onclick="delete_photo_video({'id': '{{ $hotelRoom->id_hotel_room }}', 'id_video': '{{ $item->id_video }}'})"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Delete Video') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                    <button type="button" onclick="position_video()"
                                                        data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom"
                                                        title="{{ __('user_page.Swap Video Position') }}"><i
                                                            class="fa fa-arrows"></i></button>
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
                        @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section style="padding-right: 10px; padding-left:5px; box-sizing: border-box;">
                                <form class="dropzone" id="frmTarget">
                                    @csrf
                                    <div class="dz-message" data-dz-message>
                                        <span>{{ __('user_page.Click here to upload your files') }}</span>
                                    </div>
                                    <input type="hidden" value="{{ $hotelRoom->id_hotel_room }}" id="id_hotel_room"
                                        name="id_hotel_room">
                                </form>
                                <button type="submit" id="button" class="btn btn-primary">Upload</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    <section id="description" class="section-2">
                        {{-- Description --}}
                        <div class="about-place">
                            <h2>{{ __('user_page.About this room') }}
                                @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="editDescriptionForm()"
                                            style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </h2>
                            <p id="description-content">
                                {!! Str::limit(Translate::translate($hotelRoom->room_description), 600, ' ...') ??
                                    __('user_page.There is no description yet') !!}
                                {{-- {!! substr($villa[0]->description, 0, 600) ?? 'there is no description yet' !!} --}}
                            </p>
                            @if (Str::length($hotelRoom->room_description) > 600)
                                <a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);"
                                    onclick="showMoreDescription();"><span
                                        style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                    <span style="color: #ff7400;">></span></a>
                            @endIf
                            @auth
                                @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('room_update_description') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_hotel_room"
                                                value="{{ $hotelRoom->id_hotel_room }}" required>
                                            <div class="form-group">
                                                <textarea name="description" id="description-form-input" class="w-100" rows="5" required>{{ $hotelRoom->room_description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary"
                                                    onclick="editDescriptionCancel()">
                                                    <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
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
                        <div class="row-grid-amenities">
                            <h2>
                                {{ __('user_page.What this room offers') }}
                                @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_amenities()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </h2>
                        </div>

                        <div class="row-grid-amenities">
                            <div class="row-grid-list-amenities translate-text-group">
                                @if ($hotel_amenities->count() >= 6)
                                    @foreach ($hotel_amenities->take(6) as $item1)
                                        <div class="list-amenities ">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item1->amenities->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item1->amenities->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item1->amenities->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                @if ($hotel_amenities->count() < 6)
                                    @foreach ($hotel_amenities->take(3) as $item1)
                                        <div class="list-amenities ">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item1->amenities->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item1->amenities->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item1->amenities->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($bathroom->take(3) as $item2)
                                        <div class="list-amenities ">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item2->bathroom->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item2->bathroom->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item2->bathroom->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($bedroom->take(3) as $item3)
                                        <div class="list-amenities ">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item3->bedroom->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item3->bedroom->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item3->bedroom->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($safety->take(3) as $item4)
                                        <div class="list-amenities ">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item4->safety->icon }}"></i>
                                                <div class="mb-0 max-line">
                                                    <span class="translate-text-group-items">
                                                        {{ $item4->safety->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item4->safety->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="list-amenities">
                                    <button class="amenities-button" type="button" onclick="view_amenities()">
                                        <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                                        <div style="font-size: 15px; font-weight: 600;"
                                            class="translate-text-group-items">
                                            {{ __('user_page.More') }}
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </section>
                    {{-- <section id="location-map" class="section-2">
                        <div class="pd-tlr-10">
                            <h2>
                                Location
                                @auth
                                    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="edit_location()"><i class="fa fa-pencil-alt"
                                                style="color:#FF7400; padding-right:5px;" data-bs-toggle="popover"
                                                data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                                    @endif
                                @endauth
                            </h2>
                            <input type="hidden" value="{{ $hotel[0]->latitude }}" name="latitude" id="latitude">
                            <input type="hidden" value="{{ $hotel[0]->longitude }}" name="longitude" id="longitude">
                            <div id="map" style="width:100%;height:380px; border-radius: 9px;" class="mb-2">
                            </div>
                        </div>
                    </section> --}}
                    {{-- <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div> --}}
                    <section id="availability" class="section-2">
                        <div class="pd-tlr-10">
                            <h2>
                                {{ __('user_page.Availability') }}
                                @auth
                                    @if (Auth::user()->id == $hotelRoom->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="edit_price()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                    @endif
                                @endauth
                            </h2>
                            <div class="desk-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div
                                        style="display: table; background-color: white; padding: 70px 80px 80px 80px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4; margin-bottom: 25px;">
                                        <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                            class="col-lg-12">
                                            <p style="margin: 0px; font-size: 13px;">
                                                {{ __('user_page.Clear Dates') }}</p>
                                        </div>
                                        <div class="flatpickr" id="inline" style="text-align: left;">
                                            <input type="hidden" id="id_hotel_room"
                                                value="{{ $hotelRoom->id_hotel_room }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- </div>
                            <div class="mob-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div class="flatpickr" id="inline2" style="text-align: left;">
                                        {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                    </div>
                                </div>
                            </div> -->
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
                <div class="sidebar" id="sidebar_fix" style="position: fixed; top: 9px; margin-right: 12px;">
                    <div class="reserve-block">
                        {{-- <input type="hidden" id="id_hotel" name="id_hotel" value="{{ $hotel[0]->id_hotel }}"> --}}
                        {{-- @auth
                            @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt"
                                        style="color: #FF7400; padding-right:5px;" data-bs-toggle="popover"
                                        data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
                            @endif
                        @endauth --}}
                        <form method="POST" action="{{ route('hotel_room_booking_confirm') }}">
                            @csrf
                            <input type="hidden" name="id_hotel_room" value="{{ $hotelRoom->id_hotel_room }}">
                            <div class="row">
                                <div class="col-7">
                                    <p class="price-box">
                                        {{ CurrencyConversion::exchangeWithUnit($hotelRoom->price) }}/{{ __('user_page.night') }}
                                    </p>
                                </div>
                                <div class="col-5" style="display: flex; align-items: center;">
                                    <p class="price-box" style="text-align: end;"><i class="fa fa-star"
                                            style="color: orange; font-size:14px"></i>
                                        @if ($ratting->count() > 0)
                                            {{ $ratting[0]->average }} {{ __('user_page.reviews') }}
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
                                                    {{ __('user_page.CHECK-IN') }}
                                                </p>
                                                <input class=""
                                                    style="font-size: 15px; margin-left: 0px; width:100%; text-align: center; border: none !important; border-color: transparent !important;"
                                                    type="text" id="check_in" name="check_in"
                                                    style="width:80%; border:0"
                                                    placeholder="{{ __('user_page.Add Date') }}" readonly>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 p-5-price">
                                        <div class="col-12" style="text-align: center;">
                                            <button type="button" class="collapsible_check"
                                                style="background-color: white;">
                                                <p style="margin-left: 0px; margin-bottom: 0px; font-size: 12px;">
                                                    {{ __('user_page.CHECK-OUT') }}
                                                </p>
                                                <input class=""
                                                    style="font-size: 15px; margin-left: 0px; width: 100px; text-align: center; border: none !important; border-color: transparent !important;"
                                                    type="text" id="check_out" name="check_out"
                                                    style="width:80%; border:0"
                                                    placeholder="{{ __('user_page.Add Date') }}" readonly>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="content sidebar-popup side-check-in-calendar" id="popup_check"
                                        style="width: 700px; margin-left: -410px;">
                                        <div class="desk-e-call">
                                            <div class="flatpickr-container"
                                                style="display: flex; justify-content: center;">
                                                <div style="display: table;">
                                                    <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                        class="col-lg-12">
                                                        <p style="margin: 0px; font-size: 13px;">
                                                            {{ __('user_page.Clear Dates') }}</p>
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
                                    <button type="button" class="collapsible">{{ __('user_page.Guest') }}
                                        <p style="font-size: 10px; float: right; margin: 0px;">
                                            {{ __('user_page.guest') }}</p>
                                        <input type="number" id="total_guest2" value="1"
                                            style="width: 16px; float: right; border:0;" min="0" readonly>
                                    </button>
                                    <div class="content sidebar-popup sidebar-popup-tamu">
                                        <div class="row" style="margin-top: 10px;">

                                            <div class="reserve-input-row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">{{ __('user_page.Adults') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Age 13 or above') }}</p>
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
                                                                value="1"
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
                                                        <p class="price-box">{{ __('user_page.Children') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Ages 2–12') }}</p>
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
                                                        <p class="price-box">{{ __('user_page.Infants') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ __('user_page.Under 2') }}</p>
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
                                                        <p class="price-box">{{ __('user_page.Pets') }}</p>
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
                            <div class="col-12"
                                style="display: flex; flex-direction: column; border: 2px solid #ff7400; border-radius:15px; padding: 9px; box-sizing: border-box; box-shadow: 1px 1px 10px #a4a4a4">
                                <div class="col-12" style="display: flex;">
                                    <div class="col-6" style="border-right: 2px solid #ff7400;">
                                        <p style="font-size: 12px; margin:0px;">{{ __('user_page.Total Nights') }}
                                        </p>
                                    </div>
                                    <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                        <input id="sum_night" value="0"
                                            style="font-size: 12px; text-align:left; width: 20px; border:0">
                                    </div>
                                </div>

                                <div class="col-12" style="display: flex;">
                                    <div class="col-6" style="border-right: 2px solid #ff7400;">
                                        <p style="font-size: 12px; margin:0px;">{{ __('user_page.Sub Total') }}</p>
                                    </div>

                                    <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                        <p id="total" style="font-size:12px; margin:0px;">0</p>
                                    </div>
                                </div>

                                <div class="col-12" style="display: flex;">
                                    <div class="col-6">
                                        <p style="font-size: 12px; margin:0px; border-right: 2px solid #ff7400;">
                                            {{ __('user_page.Tax & Service') }}</p>
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
                                        <p style="margin: 0px; font-size: 12px;">{{ __('user_page.Total') }}</p>
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
                                    value="{{ __('user_page.RESERVE NOW') }}"></div>

                            <div class="col-12 p-5-price price-box text-center" style="margin-top: 9px;">
                                {{ __("user_page.You won't be charged yet") }}</div>
                        </form>
                    </div>



                    <!--
                        <div class="diamond-block price-box">
                            <div class="row">
                                <div class="col-9">
                                    <strong>This is a rare find.</strong> {{ $hotel[0]->name }}'s place on EZ Villas Bali is
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
            <div class="rsv">
                {{ CurrencyConversion::exchangeWithUnit($hotelRoom->price) }}/{{ __('user_page.night') }}
                <a onclick="reserve2()" type="button"
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
                        @php
                            $cekHotel = App\Models\HotelSave::where('id_hotel', $hotel[0]->id_hotel)
                                ->where('id_user', Auth::user()->id)
                                ->first();
                        @endphp

                        @if ($cekHotel == null)
                            <div style="width: 48px;" class="text-center">
                                <a style="cursor: pointer;" onclick="likeFavorit({{ $hotel[0]->id_hotel }}, 'hotel')">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button favorite-button-22 likeButtonhotel{{ $hotel[0]->id_hotel }}"
                                        style="display: unset; margin-left: 0px;">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                    <div style="color: #aaa; font-size: 10px;" id="captFav">
                                        {{ __('user_page.FAVORITE') }}</div>
                                </a>
                            </div>
                        @else
                            <div class="text-center" style="width: 48px;">
                                <a style="cursor: pointer;" onclick="likeFavorit({{ $hotel[0]->id_hotel }}, 'hotel')">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button-active favorite-button-22 unlikeButtonhotel{{ $hotel[0]->id_hotel }}"
                                        style="display: unset; margin-left: 0px;">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                    <div style="color: #aaa; font-size: 10px;" id="captCan">
                                        {{ __('user_page.FAVORITE') }}</div>
                                </a>
                            </div>
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
                                        <img class="dropdown-user-img"
                                            src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
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
                            <a href="{{ route('login') }}">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false" class="favorite-button favorite-button-22"
                                    style="display: unset; margin-left: 0px;">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                                <div style="font-size: 10px; color: #aaa;">{{ __('user_page.FAVORITE') }}
                                </div>
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
                                <div style="font-size: 12px; color: #aaa;">{{ __('user_page.SHARE') }}
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
        <div class="col-12 review-block stopper">
            <section id="review" class="section-2">
                <div class="review-bottom-hotel">
                    @if ($detail->count() > 0)
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
                    @else
                        <h3 style="margin: 0px;">{{ __('user_page.there is no reviews yet') }}</h3>
                        <div class="col-12 d-flex mt-3">
                            <div class="col-6 d-flex">
                                <div class="col-1">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                        <path
                                            d="M14.998 1.032a2 2 0 0 0-.815.89l-3.606 7.766L1.951 10.8a2 2 0 0 0-1.728 2.24l.031.175A2 2 0 0 0 .87 14.27l6.36 5.726-1.716 8.608a2 2 0 0 0 1.57 2.352l.18.028a2 2 0 0 0 1.215-.259l7.519-4.358 7.52 4.358a2 2 0 0 0 2.734-.727l.084-.162a2 2 0 0 0 .147-1.232l-1.717-8.608 6.361-5.726a2 2 0 0 0 .148-2.825l-.125-.127a2 2 0 0 0-1.105-.518l-8.627-1.113-3.606-7.765a2 2 0 0 0-2.656-.971zm-3.07 10.499l4.07-8.766 4.07 8.766 9.72 1.252-7.206 6.489 1.938 9.723-8.523-4.94-8.522 4.94 1.939-9.723-7.207-6.489z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="col-8">
                                    <p>
                                        This host has 720 reviews for other places to stay.
                                        <span><a href="#">Show other reviews</a></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <div class="col-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                        <path
                                            d="M16 1c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15-8.284 0-15-6.716-15-15C1 7.716 7.716 1 16 1zm4.398 21.001h-8.796C12.488 26.177 14.23 29 16 29c1.77 0 3.512-2.823 4.398-6.999zm-10.845 0H4.465a13.039 13.039 0 0 0 7.472 6.351c-1.062-1.58-1.883-3.782-2.384-6.351zm17.982 0h-5.088c-.5 2.57-1.322 4.77-2.384 6.352A13.042 13.042 0 0 0 27.535 22zM9.238 12H3.627A12.99 12.99 0 0 0 3 16c0 1.396.22 2.74.627 4h5.61A33.063 33.063 0 0 1 9 16c0-1.383.082-2.724.238-4zm11.502 0h-9.482A30.454 30.454 0 0 0 11 16c0 1.4.092 2.743.26 4.001h9.48C20.908 18.743 21 17.4 21 16a30.31 30.31 0 0 0-.26-4zm7.632 0h-5.61c.155 1.276.237 2.617.237 4s-.082 2.725-.238 4h5.61A12.99 12.99 0 0 0 29 16c0-1.396-.22-2.74-.627-4zM11.937 3.647l-.046.016A13.04 13.04 0 0 0 4.464 10h5.089c.5-2.57 1.322-4.77 2.384-6.353zM16 3l-.129.005c-1.725.133-3.405 2.92-4.269 6.995h8.796C19.512 5.824 17.77 3 16 3zm4.063.648l.037.055C21.144 5.28 21.952 7.46 22.447 10h5.089a13.039 13.039 0 0 0-7.473-6.352z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="col-8">
                                    <p>
                                        We’re here to help your trip go smoothly. Every reservation is covered by
                                        <span><a href="#">EZV's Guest Refund Policy.</a></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <hr class="hr-bottom">
            </section>
            <div class="section" id="host_end">
                <div class="host">
                    <div class="row">
                        <div class="col-2 host-profile">
                            @if ($hotel[0]->image)
                                <img
                                    src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $hotelRoom->image) }}">
                            @else
                                <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                        </div>
                        <div class=" col-10">
                            <div class="member-profile">
                                <h4>{{ __('user_page.Hosted by') }} {{ $createdby[0]->first_name }}</h4>
                                <p>{{ __('user_page.Joined in') }} November 2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="member-profile-desc">
                        <p class="host-review"><i class="fa fa-heart" style="color: red;"></i> 141
                            {{ __('user_page.Reviews') }} | <i class="fa fa-check" style="color: green;"></i>
                            {{ __('user_page.Identity verified') }}
                        </p>
                        <button type="button" onclick="contactHostForm()"
                            class="member-profile-button">{{ __('user_page.Contact') }}
                            Host</button>
                        <div class="row mt-20">
                            <div class="col-1 payment-warning-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="col-11 payment-warning">
                                {{ __('user_page.To protect your payment, never transfer money or communicate outside of the EZVillas Bali website or app') }}
                            </div>
                        </div>
                        <hr>
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
                            <hr>
                        </div>
                        {{-- @guest
                            <hr>
                            <h4>{{ __('user_page.Nearby Restaurants & Things To Do') }}</h4>
                            <div class="container-xxl mx-auto p-0">
                                <div class="slick-pop-slider">
                                    <div class="Container1">
                                        <!-- <div class="row col-12 Arrows1"></div> -->
                                        <div class="Head">
                                            <h6><i class="fas fa-utensils"></i></span>
                                                {{ __('user_page.Restaurants') }} <span class="Arrows1"></span></h6>
                                        </div>
                                        <!-- Carousel Container -->
                                        <div class="SlickCarousel1">
                                            @forelse ($nearby_restaurant as $item)
                                                <!-- Item -->
                                                <div class="ProductBlock">
                                                    <div class="Content">
                                                        <div class="img-fill">
                                                            <a href="{{ route('restaurant', $item->id_restaurant) }}"
                                                                target="_blank">
                                                                @if ($item->image)
                                                                    <img src="{{ URL::asset('/foto/restaurant/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                        alt="{{ __('user_page.Restaurants') }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                        alt="{{ __('user_page.Restaurants') }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="bottom-fill">
                                                            {{ $item->name }}
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
                            </div>
                            <div class="container-xxl mx-auto p-0">
                                <div class="slick-pop-slider">
                                    <div class="Container2">
                                        <!-- <div class="row col-12 Arrows2"></div> -->
                                        <div class="Head">
                                            <h6><i class="fa fa-walking"></i></span> {{ __('user_page.Things To Do') }}
                                                <span class="Arrows2"></span>
                                            </h6>
                                        </div>
                                        <!-- Carousel Container -->
                                        <div class="SlickCarousel2">
                                            @forelse ($nearby_activities as $item)
                                                <!-- Item -->
                                                <div class="ProductBlock">
                                                    <div class="Content">
                                                        <div class="img-fill">
                                                            <a href="{{ route('activity', $item->id_activity) }}"
                                                                target="_blank">
                                                                @if ($item->image)
                                                                    <img src="{{ URL::asset('/foto/activity/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                        alt="{{ __('user_page.Things To Do') }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                        alt="{{ __('user_page.Things To Do') }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="bottom-fill">
                                                            {{ $item->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <center>
                                                        <p class="no-data">
                                                            <span>{{ __('user_page.No things to do found') }}</span></a>
                                                        </p>
                                                    </center>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!-- Carousel Container -->
                                    </div>
                                </div>
                            </div>
                        @endguest
                        @auth
                            @if (Auth::user()->role_id != 3)
                                <hr>
                                <h4>{{ __('user_page.Nearby Restaurants & Things To Do') }}</h4>
                                <div class="container-xxl mx-auto p-0">
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
                                                        <div class="Content">
                                                            <div class="img-fill">
                                                                <a href="{{ route('restaurant', $item->id_restaurant) }}"
                                                                    target="_blank">
                                                                    @if ($item->image)
                                                                        <img src="{{ URL::asset('/foto/restaurant/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                            alt="{{ __('user_page.Restaurants') }}"
                                                                            loading="lazy">
                                                                    @else
                                                                        <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                            alt="{{ __('user_page.Restaurants') }}"
                                                                            loading="lazy">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="bottom-fill">
                                                                {{ $item->name }}
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
                                </div>
                                <div class="container-xxl mx-auto p-0">
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
                                                    <div class="ProductBlock">
                                                        <div class="Content">
                                                            <div class="img-fill">
                                                                <a href="{{ route('activity', $item->id_activity) }}"
                                                                    target="_blank">
                                                                    @if ($item->image)
                                                                        <img src="{{ URL::asset('/foto/activity/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                            alt="{{ __('user_page.Things To Do') }}"
                                                                            loading="lazy">
                                                                    @else
                                                                        <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                            alt="{{ __('user_page.Things To Do') }}"
                                                                            loading="lazy">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="bottom-fill">
                                                                {{ $item->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="no-data">
                                                                <span>{{ __('user_page.No things to do found') }}</span></a>
                                                            </p>
                                                        </center>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <!-- Carousel Container -->
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>
    {{-- MODAL --}}
    @include('user.modal.auth.login_register')
    @auth
        @include('user.modal.hotel.rooms.price')
        @include('user.modal.hotel.rooms.room_size')
        {{-- @include('user.modal.villa.guest') --}}
        @include('user.modal.hotel.location')
        @include('user.modal.hotel.rooms.amenities_add')
        {{-- @include('user.modal.villa.description') --}}
        {{-- @include('user.modal.villa.short_description') --}}
        @include('user.modal.hotel.rooms.story')
        {{-- @include('user.modal.villa.photo') --}}
        @include('user.modal.hotel.rooms.room_profile')
        @include('user.modal.advert-listing')
    @endauth
    @include('user.modal.hotel.rooms.description')
    {{-- STORY MODAL --}}
    {{-- <div class="modal fade" id="storymodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content video-container" style="width: 1000px; border-radius: 25px;">
                <center>
                    <input type="hidden" id="id_story" name="id_story" value="">
                    <input type="hidden" id="villa" name="villa" value="{{ $hotel[0]->name }}">

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
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
        style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="modal-content modal-content-story video-container" style="width:980px;">
                <center>
                    <h5 class="video-title" id="storymodal-title"></h5>
                    <input type="hidden" id="id_story" name="id_story" value="">
                    <input type="hidden" id="hotel" name="hotel" value="">

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
        <div class="modal-dialog" role="document" style="overflow-y: initial !important">
            <div class="modal-content" style="background: white; border-radius:15px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.All Amenities') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style=" height: 500px; overflow-y: auto;">
                    @php
                        $amenities = App\Http\Controllers\Hotel\RoomDetailController::amenities($hotelRoom->id_hotel_room);
                        $bathroom = App\Http\Controllers\Hotel\RoomDetailController::bathroom($hotelRoom->id_hotel_room);
                        $bedroom = App\Http\Controllers\Hotel\RoomDetailController::bedroom($hotelRoom->id_hotel_room);
                        $kitchen = App\Http\Controllers\Hotel\RoomDetailController::kitchen($hotelRoom->id_hotel_room);
                        $safety = App\Http\Controllers\Hotel\RoomDetailController::safety($hotelRoom->id_hotel_room);
                        $service = App\Http\Controllers\Hotel\RoomDetailController::service($hotelRoom->id_hotel_room);
                        echo '<div class="row row-border-bottom">';
                        foreach ($amenities as $item) {
                            echo "<div class='col-md-6 mb-2'><span><i class='fa fa-" .
        $item->amenities->icon .
        "'></i>
                                " .
                                Translate::translate($item->amenities->name) .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                        echo '
                    ';

                        echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">' . __('user_page.Bathroom') . '</h5>';
                        foreach ($bathroom as $item) {
                            echo "<div class='col-md-6 '><span><i class='fa fa-" .
        $item->bathroom->icon .
        "'></i>
                                " .
                                Translate::translate($item->bathroom->name) .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                        echo '
                    ';

                        echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">' . __('user_page.Bedroom') . '</h5>';
                        foreach ($bedroom as $item) {
                            echo "<div class='col-md-6 '><span><i class='fa fa-" .
        $item->bedroom->icon .
        "'></i>
                                " .
                                Translate::translate($item->bedroom->name) .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                        echo '
                    ';

                        echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">' . __('user_page.Kitchen') . '</h5>';
                        foreach ($kitchen as $item) {
                            echo "<div class='col-md-8 '><span><i class='fa fa-" .
        $item->kitchen->icon .
        "'></i>
                                " .
                                Translate::translate($item->kitchen->name) .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                        echo '
                    ';

                        echo '<div class="row row-border-bottom padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">' . __('user_page.Safety') . '</h5>';
                        foreach ($safety as $item) {
                            echo "<div class='col-md-6 '><span><i class='fa fa-" .
        $item->safety->icon .
        "'></i>
                                " .
                                Translate::translate($item->safety->name) .
                                "</span>
                        </div>";
                        }
                        echo '</div>';
                        echo '
                    ';

                        echo '<div class="row padding-top-bottom-18px">';
                        echo '<h5 class="mb-3">' . __('user_page.Service') . '</h5>';
                        foreach ($service as $item) {
                            echo "<div class='col-md-6 '><span><i class='fa fa-" .
        $item->service->icon .
        "'></i>
                                " .
                                Translate::translate($item->service->name) .
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
    </div>
    <script>
        function view_amenities() {
            $('#modal-amenities').modal('show');
            // console.log('hit amenities');
        }
    </script>

    <script>
        function view_add_caption(idc) {
            $('#id_photo_caption').val(idc.id_photo);

            $('#caption_photo').val(idc.caption);

            $('#modal-add_caption').modal('show');
        }
    </script>

    {{-- MODAL ADD PHOTO CAPTION --}}
    <div class="modal fade" id="modal-add_caption" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.Add Photo Caption') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-top: 0;">
                    <form action="{{ route('room_update_caption_photo') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_hotel_room" value="{{ $hotelRoom->id_hotel_room }}">
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
    </div>
    {{-- MODAL RESERVE --}}
    {{-- <div class="modal fade" id="modal-reserve" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-1">
            <div class=" reserve-block">
                <input type="hidden" id="id_hotel" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">
    @auth
    @if (Auth::user()->id == $hotel[0]->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    &nbsp;<a type="button" onclick="edit_price()"><i class="fa fa-pencil-alt" style="color:green; padding-right:5px;"
            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Edit"></i></a>
    @endif
    @endauth
    <div class="row">
        <div class="col-7">
            <p class="price-box">IDR <span>{{ number_format($hotel[0]->price, 0, ',', '.') }}</span>/night
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
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $hotel[0]->adult }}" value="1"
                                id="adult" name="adult" style="width: 70%"></p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2">Children (2-12)</p>
                    </div>
                    <div class="col-6">
                        <p class="price-box mb-2"><input type="number" min="0" max="{{ $hotel[0]->children }}"
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
                    <h5 class="modal-title">{{ __('user_page.Share') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="fs-3 fw-bold mb-0">
                        {{ __('user_page.Share this place with your friend and family') }}</p>
                    <div class="d-flex gap-3 align-items-center py-3">
                        @if ($hotel[0]->image)
                            <img src="{{ URL::asset('/foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $hotel[0]->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @else
                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $hotel[0]->name }}</p>
                    </div>
                    <div>
                        <div class="modal-share-container">
                            <div class="col-lg col-12 p-3 border br-10">
                                <a type="button" class="d-flex p-0 copier"
                                    href="{{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}"
                                    onclick="copyURI(event)">
                                    {{ __('user_page.Copy Link') }}
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border br-10">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">Facebook</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="https://api.whatsapp.com/send?text={{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">WhatsApp</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="https://telegram.me/share/url?url={{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}&text={{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">Telegram</span></div>
                                </a>
                            </div>
                            <div class="col-12 p-3 border br-10">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('room_hotel', ['id' => $hotelRoom->id_hotel_room]) }}"
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
    <div class="modal fade" id="modal-reserve2" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.Reserve Now') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-9">
                            <p class="price-box">
                                {{ CurrencyConversion::exchangeWithUnit($hotelRoom->price) }}/{{ __('user_page.night') }}
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="price-box"><i class="fa fa-star" style="color: orange; font-size:14px"></i>
                                @if ($ratting->count() > 0)
                                    {{ $ratting[0]->average }} {{ __('user_page.reviews') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="reserve-inner-block">
                        <div class="row">
                            <div class="col-6 p-5-price line-right">
                                <p class="price-box text-center">
                                    <strong>{{ __('user_page.CHECK-IN') }}</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_in3"
                                        name="check_in" style="width:80%; border:0"
                                        placeholder="{{ __('user_page.Add Date') }}">
                                </p>
                            </div>
                            <div class="col-6 p-5-price">
                                <p class="price-box text-center">
                                    <strong>{{ __('user_page.CHECK-OUT') }}</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_out3"
                                        name="check_out" style="width:80%; border:0"
                                        placeholder="{{ __('user_page.Add Date') }}" readonly>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 p-9-price line-top">
                            <p class="price-box"><strong>{{ __('user_page.GUESTS') }}</strong></p>
                            <button type="button" class="collapsible"><input type="number" id="total_guest4"
                                    value="1" style="width: 15px; text-align:left; border:0" min="0"
                                    readonly>
                                {{ __('user_page.Guest') }}</button>
                            <div class="content">
                                <div class="row" style="margin-top: 10px;">

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">{{ __('user_page.Adults') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ __('user_page.Age 13 or above') }}</p>
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
                                                <p><input type="number" id="adult4" name="adult"
                                                        value="1"
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
                                                <p class="price-box">{{ __('user_page.Children') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ __('user_page.Ages 2–12') }}</p>
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
                                                <p><input type="number" id="child4" name="child"
                                                        value="0"
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
                                                <p class="price-box">{{ __('user_page.Infants') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ __('user_page.Under 2') }}</p>
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
                                                <p><input type="number" id="infant4" name="infant"
                                                        value="0"
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
                                                <p class="price-box">{{ __('user_page.Pets') }}</p>
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
                                                <p><input type="number" id="pet4" name="pet"
                                                        value="0"
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
                            value="{{ __('user_page.RESERVE NOW') }}">
                    </div>
                    <div class="col-12 p-5-price price-box text-center">
                        {{ __("user_page.You won't be charged yet") }}</div>
                    <div class="row">
                        <div class="col-7 price-box">{{ __('user_page.Sub Total') }}<input id="sum_night3"
                                value="0" style="width: 25px; text-align:right; border:0">
                            {{ __('user_page.nights') }}</div>
                        <div class="col-5 price-box">IDR <span id="total3" style="font-size:100%">0</span>
                        </div>
                        <div class="col-7 price-box">{{ __('user_page.Service Fee') }}</div>
                        <div class="col-5 price-box">IDR {{ number_format(0, 0, ',', '.') }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-7 price-box"><strong>{{ __('user_page.Total Before Taxes') }}</strong>
                        </div>
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
                    <h5 class="modal-title">{{ __('user_page.FAQ') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <form action="{{ route('villa_store_user_message') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_owner" value="{{ $hotel[0]->created_by }}">
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">
                        {{ __('user_page.Edit Position Photos') }}</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            style="font-size: 22px;" class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $hotel[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-photo">
                        @forelse ($photo as $item)
                            @php
                                $id = $item->id_photo;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <img src="{{ asset('foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}"
                                    title="{{ $name }}">
                            </li>
                        @empty
                            {{ __('user_page.there is no image yet') }}
                        @endforelse
                    </ul>

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos"
                            value="{{ __('user_page.Submit') }}" onclick="save_reorder_photo()">
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
                    <h7 class="modal-title" style="font-size: 1.875rem;">
                        {{ __('user_page.Edit Position Video') }}</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            style="font-size: 22px;" class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $hotel[0]->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-video">
                        @forelse ($video as $item)
                            @php
                                $id = $item->id_video;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <video
                                    src="{{ asset('foto/hotel/' . strtolower($hotel[0]->uid) . '/' . $item->name) }}#t=1.0">
                            </li>
                        @empty
                            {{ __('user_page.there is no video yet') }}
                        @endforelse
                    </ul>

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos"
                            value="{{ __('user_page.Submit') }}" onclick="save_reorder_video()">
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
                    <h5 class="modal-title">{{ __('user_page.Map') }}</h5>
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
    <script src="{{ asset('assets/js/view-hotel-room.js') }}"></script>
    <script src="{{ asset('assets/js/simpleLightbox.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

    {{-- SweetAlert JS --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- Header List --}}
    <script>
        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/searchvillacombine?${suburl}`;
        }
    </script>

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

    <script>
        function villaFilter() {
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
                url: '/hotel/room/update/photo/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    imageids: imageids_arr,
                    id: '{{ $hotelRoom->id_hotel_room }}'
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
                url: '/hotel/room/update/video/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    videoids: videoids_arr,
                    id: '{{ $hotelRoom->id_hotel_room }}'
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
            var formInput = document.getElementById("name-form-input");
            form.classList.add("d-block");
            content.classList.add("d-none");

            if (formInput.value == 'Hotel Room Name Here') {
                formInput.value = '';
            }
        }

        function editNameCancel() {
            var form = document.getElementById("name-form");
            var formInput = document.getElementById("name-form-input");
            var content = document.getElementById("name-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $hotelRoom->name }}';

            if (formInput.value == 'Hotel Room Name Here') {
                formInput.value = '';
            }
        }
    </script>
    <script>
        function editShortDescriptionForm() {
            var form = document.getElementById("short-description-form");
            var content = document.getElementById("short-description-content");
            var formInput = document.getElementById("short-description-form-input");
            form.classList.add("d-block");
            content.classList.add("d-none");

            if (formInput.value == 'Make your short description here') {
                formInput.value = '';
            }
        }

        function editShortDescriptionCancel() {
            var form = document.getElementById("short-description-form");
            var formInput = document.getElementById("short-description-form-input");
            var content = document.getElementById("short-description-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $hotelRoom->short_description }}';

            if (formInput.value == 'Make your short description here') {
                formInput.value = '';
            }
        }
    </script>
    <script>
        function editDescriptionForm() {
            var form = document.getElementById("description-form");
            var content = document.getElementById("description-content");
            var btn = document.getElementById("btnShowMoreDescription");
            var formInput = document.getElementById("description-form-input");
            form.classList.add("d-block");
            content.classList.add("d-none");
            btn.classList.add("d-none");
        }

        function editDescriptionCancel() {
            var form = document.getElementById("description-form");
            var formInput = document.getElementById("description-form-input");
            var content = document.getElementById("description-content");
            var btn = document.getElementById("btnShowMoreDescription");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            btn.classList.remove("d-none");
            formInput.value = '{{ $hotelRoom->description }}';
        }
    </script>
    <script>
        function editPropertyTypeForm() {
            var form = document.getElementById("property-type-form");
            var content = document.getElementById("property-type-content");
            form.classList.add("d-block");
            content.classList.add("d-none");
        }

        function editPropertyTypeCancel() {
            var form = document.getElementById("property-type-form");
            var formInput = document.getElementById("property-type-form-input");
            var content = document.getElementById("property-type-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            $('#property-type-form-input').each(() => {
                if ($(this).val() == '{{ $hotel[0]->propertyType->id }}') {
                    $(this).attr("selected", "selected");
                }
            });
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
            url: '/admin/hotel/room/store_gallery',
            parallelUploads: 50,
            "error": function(file, message, xhr) {
                this.removeFile(file); // perhaps not remove on xhr errors
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
                    var value = $('form#formData #id_hotel_room').val();
                    formData.append('id_hotel_room', value);
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
            var $footerOffsetTop = $(".stopper").offset().top - 100;
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
        var gallery = $('#gallery').offset().top - 200,
            description = $('#description').offset().top - 150,
            amenities = $('#amenities').offset().top - 150,
            availability = $('#availability').offset().top - 150,
            review = $('#review').offset().top - 150,
            host = $('#host_end').offset().top - 200,
            $window = $(window);

        $window.scroll(function() {
            if ($window.scrollTop() >= gallery && $window.scrollTop() < description) {
                $('#gallery-sticky').addClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= description && $window.scrollTop() < amenities) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').addClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= amenities && $window.scrollTop() < availability) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').addClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= availability && $window.scrollTop() < review) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#availability-sticky').addClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= review && $window.scrollTop() < host) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').addClass('active-sticky');
            } else {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#amenities-sticky').removeClass('active-sticky');
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
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/hotel/room/${ids.id}/delete/story/${ids.id_story}`,
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

    {{-- Sweetalert Function Delete Profile Image --}}
    <script>
        function delete_profile_image(ids) {
            var ids = ids;
            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/hotel/room/${ids.id}/delete/image`,
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
    <script>
        function delete_photo_photo(ids) {
            var ids = ids;
            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/hotel/room/${ids.id}/delete/photo/photo/${ids.id_photo}`,
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

    {{-- Sweetalert Function Delete Video Gallery --}}
    <script>
        function delete_photo_video(ids) {
            var ids = ids;
            Swal.fire({
                title: `{{ __('user_page.Are you sure?') }}`,
                text: `{{ __('user_page.You will not be able to recover this imaginary file!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: `{{ __('user_page.Yes, deleted it') }}`,
                cancelButtonText: `{{ __('user_page.Cancel') }}`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/hotel/room/${ids.id}/delete/photo/video/${ids.id_video}`,
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
                        url: `/hotel/room/request/video/${ids.id}/${ids.name}`,
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
                url: `/hotel/map/${id}`,
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
        })
    </script>
    <script>
        (function() {
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
    </script>

    {{-- Like --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like --}}

    @include('components.lazy-load.lazy-load')
    @include('components.promotion.mobile-app')

    {{-- Copy current URL to clipboard --}}
    <script>
        function copyURI(evt) {
            evt.preventDefault();
            navigator.clipboard.writeText(evt.target.getAttribute('href')).then(() => {
                alert("Link copied");
            }, () => {
                alert("Oooppsss... failed");
            });
        }
    </script>

    @if ($hotel[0]->status == 2)
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('advertListing-Modal'), {})
            myModal.show()
        </script>
    @endif

</body>

</html>
