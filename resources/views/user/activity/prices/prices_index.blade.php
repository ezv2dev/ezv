<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ $activity->name }} - EZV2</title>

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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/simpleLightbox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    <script src="{{ asset('assets/js/errorToString.js') }}"></script>
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        .list-image-content {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .pd-tlr-10 {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Price Type */
        .tab-header {
            background: #ff7400;
            color: #fff;
            padding: 15px;
            font-weight: 600;
        }

        .tab-body {
            padding: 10px;
        }

        .table-body,
        .table-header {
            padding-left: 10px;
            padding-right: 10px;
        }

        .reserve-block-activity {
            display: block;
            width: 274px;
            height: auto;
            top: 125px;
            margin-left: 15px;
            border-radius: 15px;
            position: relative;
        }

        /* .delete {
            top: -116px;
        } */

        .edit-icon {
            margin-top: -283px;
            margin-left: 235px;
        }

        @media (min-width: 1260px) and (max-width: 1359px) {
            .reserve-block-activity {
                width: 246px !important;
                right: -2px !important;
            }

            .menu-liner {
                width: 98.8% !important;
            }
        }


        .review-bottom {
            margin: 0;
        }

        .host {
            margin-left: -12px;
        }

        /* STYLE FOR RATING STAR */
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
    /* END STYLE FOR RATING STAR */
    </style>

</head>

<body style="background-color:white">
    @include('components.notification.notification')
    @component('components.loading.loading-type1')
    @endcomponent
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
                    @if (auth()->user()->id == $activity->created_by)
                        @if ($activity->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>this content is deactive, </span>
                                <form action="{{ route('activity_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn" type="submit">request activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>this content is active, </span>
                                <form action="{{ route('activity_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn" type="submit">request deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request activation for this content, </span>
                                <form
                                    action="{{ route('activity_cancel_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn" type="submit">cancel activation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>you have been request deactivation for this content, </span>
                                <form
                                    action="{{ route('activity_cancel_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn" type="submit">cancel deactivation</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($activity->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                this content is deactive
                            </div>
                        @endif
                        @if ($activity->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                this content is active
                            </div>
                        @endif
                        @if ($activity->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request activation, </span>
                                <form action="{{ route('admin_activity_update_status', $activity->id_activity) }}"
                                    method="get">
                                    <button class="btn" type="submit">activate this content</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>the owner request deactivation, </span>
                                <form action="{{ route('admin_activity_update_status', $activity->id_activity) }}"
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
                    <div class="col-lg-4- col-md-4 col-xs-12" style="padding: 0px;">
                        <div class="profile-image">
                            @if ($activityPrice->foto)
                                <img
                                    src="{{ asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activityPrice->foto) }}">
                            @else
                                <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="edit_activity_profile()">Edit></a>
                                    @if ($activityPrice->foto)
                                        {{-- <a href="{{ route('activity_delete_image', $activity->id_activity) }}"> --}}
                                        <a class="delete-profile" href="javascript:void(0);"
                                            onclick="delete_profile_image({'id': `{{ $activityPrice->id_price }}`})"><i
                                                class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="Delete"></i></a>
                                    @endif
                                @endif
                            @endauth
                            <div>
                                <p style="font-size: 12px;" id="time-content">
                                    @php
                                        $open = date_create($activity->open_time);
                                        $closed = date_create($activity->closed_time);
                                    @endphp
                                    {{ date_format($open, 'h:i A') }} - {{ date_format($closed, 'h:i A') }}
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="editTimeForm()"
                                                style="color:#FF7400; font-weight: 600;">Edit</a>
                                        @endif
                                    @endauth
                                </p>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="time-form" style="display:none;">
                                            <form action="{{ route('activity_update_time') }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id_activity"
                                                    value="{{ $activity->id_activity }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center">
                                                    <div class="col-auto">
                                                        <input type="time" name="open_time" class="form-control"
                                                            id="open-time-input" value="{{ $activity->open_time }}"
                                                            required>
                                                    </div>
                                                    <span class="mx-2">-</span>
                                                    <div class="col-auto">
                                                        <input type="time" name="closed_time" class="form-control"
                                                            id="close-time-input" value="{{ $activity->closed_time }}"
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
                                {{-- CONTACT --}}
                                <div class="col-12" style="margin-top: 18px;">
                                    <span id="price-content"
                                        style="color: #FF7400; font-weight: 600; font-size: 14pt;">IDR
                                        {{ number_format($activityPrice->price, 0, ',', '.') }}</span>
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a id="price-content-teks" type="button"
                                                style="color:#FF7400; font-weight: 600;"
                                                onclick="editPriceForm()">Edit</a>
                                        @endif
                                    @endauth
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <div id="price-form" style="display:none;">
                                                <form action="{{ route('activity_price_update_price') }}"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="id_price"
                                                        value="{{ $activityPrice->id_price }}" required>
                                                    <input type="text" style="width: 100%;" class="form-control"
                                                        name="price" id="price-form-input" maxlength="100"
                                                        value="{{ $activityPrice->price }}" required>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        style="background-color: #ff7400">
                                                        <i class="fa fa-check"></i> Done
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editPriceCancel()">
                                                        <i class="fa fa-xmark"></i> Cancel
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                {{-- END CONTACT --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6- col-md-6 col-xs-12" style="padding-left: 40px;">
                        <h2 id="name-content">
                            {{ $activityPrice->name }} - <a
                                href="{{ route('activity', $activityPrice->id_activity) }}">{{ $activity->name }}</a>
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"
                                        style="color:#FF7400; font-size: 10pt; font-weight: 600;">Edit</a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <form action="{{ route('activity_price_update_name') }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id_price" value="{{ $activityPrice->id_price }}"
                                            required>
                                        <input type="text" style="width: 100%;" class="form-control" name="name"
                                            id="name-form-input" maxlength="100" value="{{ $activityPrice->name }}"
                                            placeholder="{{ __('user_page.Wow Price Here') }}" required>
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
                        <p class="short-desc {{ $activityPrice->short_description == null ? 'text-muted' : '' }}"
                            id="short-description-content">
                            {{ $activityPrice->short_description ? $activityPrice->short_description : 'there is no short description' }}
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                        style="color:#FF7400; font-weight: 600;">Edit</a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display: none">
                                    <form action="{{ route('activity_price_short_description') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id_price" value="{{ $activityPrice->id_price }}"
                                            required>
                                        <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                            cols="30" rows="3" maxlength="250" placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $activityPrice->short_description }}</textarea>
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
                        {{-- TAG --}}
                        <p class="text-secondary">
                            @if ($activity->subCategory->count() > 7)
                                @for ($i = 0; $i < 7; $i++)
                                    <span class="badge rounded-pill fw-normal"
                                        style="background-color: #FF7400;">{{ $subcategory->name }}</span>
                                @endfor
                                <button class="btn btn-outline-dark btn-sm rounded" onclick="view_tag()">More</button>
                            @else
                                @forelse ($activity->subCategory as $subcategory)
                                    <span class="badge rounded-pill fw-normal"
                                        style="background-color: #FF7400;">{{ $subcategory->name }}</span>
                                @empty
                                    there is no tag yet
                                @endforelse
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="add_subcategory()"
                                        style="color:#FF7400; font-weight: 600;">Edit</a>
                                @endif
                            @endauth
                        </p>
                        {{-- END TAG --}}
                        {{-- END SHORT DESCRIPTION --}}
                        <ul class="stories inner-wrap">
                            @if (Auth::guest() || Auth::user()->role_id == 4)
                                @if ($activity->story->count() == 0 && $activity->video->count() == 0)
                                    <li class="story">
                                        <div class="img-wrap">
                                            <a type="button"
                                                onclick="requestVideo({'id': '{{ $activity->created_by }}', 'name': '{{ $activity->name }}'})">
                                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                                    data-src="{{ URL::asset('assets/2.png') }}">
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endif

                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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
                                                        @foreach ($stories as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        <a type="button"
                                                                            onclick="view_story_activity({{ $item->id_story }});">

                                                                            <div class="story-video-player">
                                                                                <i class="fa fa-play"
                                                                                    aria-hidden="true"></i>
                                                                            </div>

                                                                            <video preload href=""
                                                                                class="story-video-grid"
                                                                                style="object-fit: cover;"
                                                                                src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                                                            </video>
                                                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                                <a class="delete-story"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="delete_activity_story({'id': `{{ $activityPrice->id_price }}`, 'id_story': `{{ $item->id_story }}`})">
                                                                                    {{-- <a href="{{ route('activity_delete_story', ['id' => $activity->id_activity, 'id_story' => $item->id_story]) }}"> --}}
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
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            <a type="button"
                                                                onclick="view_story_activity({{ $item->id_story }});">
                                                                <div class="story-video-player">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                                <video preload href="" class="story-video-grid"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
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
                                    GALLERY</span>
                            </a>
                        </li>
                        {{-- <li class="navigationItem">
                            <a id="price-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('price').scrollIntoView();">
                                <i aria-label="Posts" class="fa fa-money navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span>&nbsp
                                    PRICE</span>
                            </a>
                        </li> --}}
                        <li class="navigationItem">
                            <a id="about-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('description').scrollIntoView();">
                                <i aria-label="Posts" class="far fa-list-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    ABOUT</span>
                            </a>
                        </li>
                        {{-- <li class="navigationItem">
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon" fill="#262626"
                                    viewBox="0 0 20 20"></i><span>&nbsp
                                    FACILITIES</span>
                            </a>
                        </li>
                        <li class="navigationItem">
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
                                    AVAILABILITY</span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="review-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('review').scrollIntoView();">
                                <i aria-label="Posts" class="fas fa-check navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i><span>&nbsp
                                    REVIEW</span>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- END STICKY BAR --}}
                {{-- PAGE CONTENT --}}
                <div class="js-gallery">
                    {{-- GALLERY --}}
                    {{-- <section id="gallery" class="photosGrid section">
                        @if ($activity->photo->count() > 0)
                            @foreach ($activity->photo as $item)
                                <a href="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}"
                                    class="img-lightbox photosGrid__Photo"
                                    style="background-image: url('{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}')">
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a
                                            href="{{ route('activity_delete_photo_photo', ['id' => $activity->id_activity, 'id_photo' => $item->id_photo]) }}">X</a>
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
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                    </video>
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a
                                            href="{{ route('activity_delete_photo_video', ['id' => $activity->id_activity, 'id_video' => $item->id_video]) }}">X</a>
                                    @endif
                                @endauth
                            @endforeach
                        @endif
                    </section> --}}
                    <section id="gallery" class="section">
                        @if ($activityPrice->photo->count() > 0)
                        <div class="col-12 row gallery">
                            @foreach ($activityPrice->photo as $item)
                            <div class="col-4 grid-photo">
                                <a href="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}">
                                    <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}"
                                        title="{{ $item->caption }}">
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <span class="edit-icon">
                                        <button href="javascript:void(0);"
                                            onclick="delete_photo_photo({'id': `{{ $activityPrice->id_price }}`, 'id_photo': `{{ $item->id_photo }}`})"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Delete"><i class="fa fa-trash"></i></button>
                                        <button onclick="position_photo()" data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom" title="Edit Position"><i
                                                class="fa fa-pencil"></i></button>
                                    </span>
                                    @endif
                                @endauth
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if ($video->count() > 0)
                            @foreach ($video as $item)
                                <a class="video-grid" type="button"
                                    onclick="view_video_activity({{ $item->id_video }});">
                                    <i class="fas fa-2x fa-play video-button"></i>
                                    <video preload href="" class="photosGrid__Photo"
                                        style="object-fit: cover;"
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                    </video>
                                </a>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a class="delete" style="height:40px" href="javascript:void(0);"
                                            onclick="delete_photo_video({'id': `{{ $activityPrice->id_price }}`, 'id_video': `{{ $item->id_video }}`})"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Delete"><i class="fa fa-trash"></i></a>
                                        {{-- <a class="delete" style="height:40px"
                                        href="{{ route('activity_delete_photo_video', ['id' => $activity->id_activity, 'id_video' => $item->id_video]) }}"
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
                    </section>
                    {{-- END GALLERY --}}
                    {{-- ADD GALLERY --}}
                    @auth
                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <section id="add-gallery" class="add-gallery">
                                <form class="dropzone" id="frmTarget">
                                    @csrf
                                    <div class="dz-message" data-dz-message>
                                        <span>{{ __('user_page.Click here to upload your files') }}</span>
                                    </div>
                                    <input type="hidden" value="{{ $activityPrice->id_price }}" id="id_price"
                                        name="id_price">
                                </form>
                                <button type="submit" id="button" class="btn btn-primary">Upload</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    {{-- PRICES --}}
                    <section id="description" class="section-2" style="margin-top: 12px;">
                        {{-- Description --}}
                        <div style="padding-top:12px; padding-left:10px; padding-right:10px;">
                            <h2>
                                About this place
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editDescriptionForm()"
                                            style="color:#FF7400; font-size: 10pt; font-weight: 600;">Edit</a>
                                    @endif
                                @endauth
                            </h2>
                            @php
                                $isMobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4));
                            @endphp
                            <p id="description-content"
                                style="text-align: justify; padding-top:10px; padding-bottom:12px">
                                @if ($isMobile)
                                {!! Str::limit($activityPrice->description, 400, ' ...') ?? 'there is no description yet' !!}
                                @else
                                {!! Str::limit($activityPrice->description, 600, ' ...') ?? 'there is no description yet' !!}
                                @endif
                                {{-- {!! $restaurant->description ?? 'there is no description yet' !!} --}}
                            </p>
                            @if ($isMobile)
                                @if (Str::length($activityPrice->description) > 400)
                                <a id="btnShowMoreDescription" class="d-block" style="font-weight: 600;"
                                    href="javascript:void(0);" onclick="showMoreDescription();"><span
                                        style="text-decoration: underline; color: #ff7400;">Show more</span> <span
                                        style="color: #ff7400;">></span></a>
                                @endif
                            @else
                                @if (Str::length($activityPrice->description) > 600)
                                    <a id="btnShowMoreDescription" class="d-block" style="font-weight: 600;"
                                        href="javascript:void(0);" onclick="showMoreDescription();"><span
                                            style="text-decoration: underline; color: #ff7400;">Show more</span> <span
                                            style="color: #ff7400;">></span></a>
                                @endif
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="{{ route('activity_price_description') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_price"
                                                value="{{ $activityPrice->id_price }}" required>
                                            <div class="form-group">
                                                <textarea name="description" class="form-control" id="description-form-input" class="w-100" rows="5"
                                                    required>{{ $activityPrice->description }}</textarea>
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
                    {{-- <div style="padding-left: 10px; padding-right: 10px;">
                        <hr>
                    </div> --}}
                    <section id="availability" class="section-2">
                        <div class="pd-tlr-10">
                            <h2>Availability</h2>
                            <div class="desk-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div
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
                            <!-- <div class="mob-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div class="flatpickr" id="inline2" style="text-align: left;">
                                        {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </section>
                </div>
                {{-- END PAGE CONTENT --}}
            </div>

            {{-- END LEFT CONTENT --}}
            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div class="sidebar sidebar-activity sidebar-activity-idle">
                    <div class="reserve-block-activity"
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
                    </div>
                </div>
            </div>
            {{-- END RIGHT CONTENT --}}
        </div>
        <div id="rsv-block-btn">
            {{-- RESERVE BUTTON TOP RIGHT --}}
            <div class="rsv">
                {{-- <strong>{{ number_format($activity->price, 0, ',', '.') }}</strong>/night --}}
                {{-- <span><a onclick="reserve2()" type="button" class="rsv-btn-button">RESERVE NOW</a> --}}
                <a onclick="contact_activity()" type="button" class="rsv-btn-button">CONTACT</a>
            </div>
            {{-- END RESERVE BUTTON TOP RIGHT --}}
        </div>
        {{-- FULL WIDTH ABOVE FOOTER --}}
        <div class="col-12 bottom-content">
            <div class="stopper"></div>
            <div class="col-12">
                <section id="review" class="section-2">
                    <hr>
                    <div class="review-bottom">
                    @if ($activity->detailReview)
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <h2 style="margin: 0px;">Review</h2>
                                    <div class="row">
                                        <div class="col-6">
                                            Experience
                                        </div>
                                        <div class="col-6 ">
                                            <div class="liner"></div>
                                            {{ $activity->detailReview->average_experience }}
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
                                            There is no reviews yet
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
                </section>
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
                            <section id="add-review" class="section-2">
                                <div class="bottom-content">
                                    <h2>Give review</h2>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <form action="{{ route('activity_review_store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_activity"
                                                    value="{{ $activity->id_activity }}" readonly required>
                                                <div class="row">
                                                    <div class="col-6 review-container">
                                                        Experience
                                                    </div>
                                                    <div class="col-6 review-container">
                                                        <div class="cm-star-rating d-flex align-items-center">
                                                            <input id="star-5" type="radio" name="experience"
                                                                value="5" required />
                                                            <label for="star-5" title="5 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-4" type="radio" name="experience"
                                                                value="4" />
                                                            <label for="star-4" title="4 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-3" type="radio" name="experience"
                                                                value="3" />
                                                            <label for="star-3" title="3 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-2" type="radio" name="experience"
                                                                value="2" />
                                                            <label for="star-2" title="2 stars">
                                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-1" type="radio" name="experience"
                                                                value="1" />
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
                    <div class="host bottom-content">
                        {{-- <div class="row">
                                <div class="col-2">
                                    <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activity->image) }}"
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
                                        src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activity->image) }}">
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
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="d-flex">
                                        <h6>Place Rules</h6>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editActivityRules()"
                                                    style="color:#FF7400; font-weight: 600;">Edit</a>
                                            @endif
                                        @endauth
                                    </div>
                                    <p>
                                        @if (!isset($activity_rules))
                                            No data found
                                        @endif

                                        @if (isset($activity_rules))
                                            @if ($activity_rules->children == 'yes')
                                                <i class="fas fa-child"></i> Childrens are allowed<br>
                                            @endif
                                            @if ($activity_rules->infants == 'yes')
                                                <i class="fas fa-child"></i> Infants are allowed<br>
                                            @endif
                                            @if ($activity_rules->pets == 'yes')
                                                <i class="fas fa-paw"></i> Pets are allowed<br>
                                            @endif
                                            @if ($activity_rules->smoking == 'yes')
                                                <i class="fas fa-smoking"></i> Smoking is allowed<br>
                                            @endif
                                            @if ($activity_rules->events == 'yes')
                                                <i class="fas fa-calendar"></i> Events are allowed<br>
                                            @endif

                                            @if ($activity_rules->children == 'no')
                                                <i class="fas fa-ban"></i> No children<br>
                                            @endif
                                            @if ($activity_rules->infants == 'no')
                                                <i class="fas fa-ban"></i> No infants<br>
                                            @endif
                                            @if ($activity_rules->pets == 'no')
                                                <i class="fas fa-ban"></i> No pets<br>
                                            @endif
                                            @if ($activity_rules->smoking == 'no')
                                                <i class="fas fa-ban"></i> No smoking<br>
                                            @endif
                                            @if ($activity_rules->events == 'no')
                                                <i class="fas fa-ban"></i> No events<br>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="d-flex">
                                        <h6>Health & Safety</h6>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editActivityGuestSafety()"
                                                    style="color:#FF7400; font-weight: 600;">Edit</a>
                                            @endif
                                        @endauth
                                    </div>
                                    <p>
                                        @forelse ($activity->guestSafety->take(5) as $item)
                                            <i class="fas fa-{{ $item->icon }}"></i>
                                            {{ $item->guest_safety }}<br>
                                        @empty
                                            No data found
                                        @endforelse
                                    </p>
                                    @php
                                        $countGuest = count($activity->guestSafety);
                                    @endphp
                                    @if ($countGuest > 5)
                                        <p>
                                            <a href="javascript:void(0)" onclick="showMoreActivityGuestSafety()">
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
                            {{-- <h4>{{ Translate::translate('Nearby Villas & Restaurant') }}</h4> --}}

                            {{-- EDIT TO SWIPE CAROUSEL --}}
                            {{-- <div class="container-xxl mx-auto p-0">
                                <div class="slick-pop-slider">
                                    <div class="Container2">
                                        <!-- <div class="row col-12 Arrows2"></div> -->
                                        <div class="Head">
                                            <h6><i class="fa-solid fa-house"></i></span>
                                                {{ Translate::translate('Villas') }} <span class="Arrows2"></span>
                                            </h6>
                                        </div>
                                        <!-- Carousel Container -->
                                        <div class="SlickCarousel2">
                                            @forelse ($nearby_villas as $item)
                                                <!-- Item -->
                                                <div class="ProductBlock">
                                                    <div class="Content">
                                                        <div class="img-fill">
                                                            <a href="{{ route('villa', $item->id_villa) }}"
                                                                target="_blank">
                                                                @if ($item->image)
                                                                    <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->uid) . '/' . $item->image) }}"
                                                                        alt="Villas" loading="lazy">
                                                                @else
                                                                    <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                        alt="Villas" loading="lazy">
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
                                                            <span>{{ Translate::translate('No villas found') }}</span></a>
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
                                    <div class="Container1">
                                        <!-- <div class="row col-12 Arrows1"></div> -->
                                        <div class="Head">
                                            <h6><i class="fas fa-utensils"></i></span>
                                                {{ Translate::translate('Restaurants') }} <span
                                                    class="Arrows1"></span></h6>
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
                                                                        alt="Restaurants" loading="lazy">
                                                                @else
                                                                    <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                                        alt="Restaurants" loading="lazy">
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
                                                            <span>{{ Translate::translate('No restaurants found') }}</span></a>
                                                        </p>
                                                    </center>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!-- Carousel Container -->
                                    </div>
                                </div>
                            </div> --}}
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
    {{-- @include('user.modal.activity.activity-guest-safety') --}}
    @auth
        @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $activity->created_by)
            {{-- @include('user.modal.activity.activity-guest-safety') --}}
            {{-- @include('user.modal.activity.edit.edit-activity-rules') --}}
            {{-- @include('user.modal.activity.edit.edit-activity-guest-safety') --}}
            {{-- @include('user.modal.activity.facilities_add') --}}
            {{-- @include('user.modal.activity.price') --}}
            {{-- @include('user.modal.activity.location') --}}
            @include('user.modal.activity.price.activity_profile')
            @include('user.modal.activity.price.story')
            {{-- @include('user.modal.activity.contact') --}}
            {{-- @include('user.modal.activity.subcategory_add') --}}
        @endif
    @endauth
    @include('user.modal.activity.price.description')
    {{-- END OTHER MODAL --}}
    {{-- MODAL SCRIPT --}}
    <script>
        function showMoreDescription() {
            $("#modal-show_description").modal("show");
        }

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
        function view_story_activity(id) {
            $.ajax({
                type: "GET",
                url: "/things-to-do/price/story/" + id,
                dataType: "JSON",
                success: function(data) {
                    // $('[name="id_story"]').val(data[0].id_story);
                    // let activity = document.getElementById("activity").value;
                    let video = document.getElementById('story-video');
                    let public = '/foto/activity/';
                    let slash = '/';
                    let uid = '{{ $activity->uid }}';
                    var lowerCaseUid = uid.toLowerCase();
                    video.src = public + lowerCaseUid + slash + data[0].name;
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
                    var uid = '{{ $activity->uid }}';
                    var lowerCaseUid = uid.toLowerCase();
                    video.src = public + lowerCaseUid + slash + data.name;
                    video.load();
                    video.play();
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
                    @forelse ($activity->facilities as $item)
                        <div class='col-md-6 mb-3'>
                            <span>{{ $item->name }}</span>
                        </div>
                    @empty
                        <div class='col-md-12 mb-3'>
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
    <div class="modal fade" id="modal-subcategory" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">All subcategories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_subcategory()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <div class="row row-border-bottom padding-top-bottom-18px">
                        @foreach ($activity->subCategory as $item)
                            <div class='col-md-6'>{{ $item->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function view_subcategory() {
            $('#modal-subcategory').modal('show');
        }

        function close_subcategory() {
            $('#modal-subcategory').modal('hide');
        }
    </script>

    <!-- PRICE MODAL -->
    <div class="modal fade" id="modal-price" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-price-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <img src="" alt="" class="img-fluid" style="border-radius:15px;">
                    <h5 style="color: #FF7400; margin-top: 10px; margin-bottom: 5px;"></h5>
                    <p></p>
                    <p id="start"></p>
                    <p id="end"></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function view_price(id) {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: `/things-to-do/price/${id}`,
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

                    $('#modal-price-content').children('.modal-header').children('.modal-title').text(data
                        .name);
                    var src =
                        `{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/price' . '/' . '${data.foto}') }}`;
                    $('#modal-price-content').children('.modal-body').children('img').attr('src', src);
                    $('#modal-price-content').children('.modal-body').children('h5').text(`${price}`);
                    $('#modal-price-content').children('.modal-body').children('p').text(data.description);
                    $('#modal-price-content').children('.modal-body').children('#start').text(data
                        .start_date);
                    $('#modal-price-content').children('.modal-body').children('#end').text(data.end_date);
                    $('#modal-price').modal('show');
                }
            });
        }
    </script>
    <!-- END PRICE MODAL -->

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
                        @if ($activity->image)
                            <img src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activity->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @else
                            <img src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $activity->name }}</p>
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
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('activity', $activity->id_activity) }}&display=popup"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                                class="fw-normal">Facebook</span></div>
                                    </a>
                                </div>
                                {{-- <div class="col-lg col-12 p-3 border br-10">
                                <a href="#" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook-messenger"></i> <span
                                            class="fw-normal">Facebook Messenger</span></div>
                                </a>
                            </div> --}}
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://api.whatsapp.com/send?text={{ route('activity', $activity->id_activity) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                                class="fw-normal">WhatsApp</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://telegram.me/share/url?url={{ route('activity', $activity->id_activity) }}&text={{ route('activity', $activity->id_activity) }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                                class="fw-normal">Telegram</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('activity', $activity->id_activity) }}"
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
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('activity', $activity->id_activity) }}?ref={{ Auth::user()->user_code }}&display=popup"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                                class="fw-normal">Facebook</span></div>
                                    </a>
                                </div>
                                {{-- <div class="col-lg col-12 p-3 border br-10">
                                <a href="#" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook-messenger"></i> <span
                                            class="fw-normal">Facebook Messenger</span></div>
                                </a>
                            </div> --}}
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://api.whatsapp.com/send?text={{ route('activity', $activity->id_activity) }}?ref={{ Auth::user()->user_code }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                                class="fw-normal">WhatsApp</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="https://telegram.me/share/url?url={{ route('activity', $activity->id_activity) }}?ref={{ Auth::user()->user_code }}&text={{ route('activity', $activity->id_activity) }}?ref={{ Auth::user()->user_code }}"
                                        target="_blank" class="d-flex p-0">
                                        <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                                class="fw-normal">Telegram</span></div>
                                    </a>
                                </div>
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('activity', $activity->id_activity) }}?ref={{ Auth::user()->user_code }}"
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
                alert('Link has been copied');
            }
        </script>
    @endguest

    @auth
        <script type="text/javascript">
            //copy link
            function copy_link_auth() {
                let ref = `{{ Auth::user()->user_code }}`;
                navigator.clipboard.writeText(window.location.origin + window.location.pathname + "?ref=" + ref);
                alert('Link has been copied');
            }
        </script>
    @endauth

    {{-- MODAL RESERVE II --}}
    <div class="modal fade" id="modal-reserve2" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
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
                            <p class="price-box"><i class="fa fa-star" style="color: orange; font-size:14px"></i>
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
                                    <input class="flatpickr text-center" type="text" id="check_in3"
                                        name="check_in" style="width:80%; border:0" placeholder="Add Date">
                                </p>
                            </div>
                            <div class="col-6 p-5-price">
                                <p class="price-box text-center"><strong>CHECK-OUT</strong><br>
                                    <input class="flatpickr text-center" type="text" id="check_out3"
                                        name="check_out" style="width:80%; border:0" placeholder="Add Date" readonly>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 p-9-price line-top">
                            <p class="price-box"><strong>GUESTS</strong></p>
                            <button type="button" class="collapsible"><input type="number" id="total_guest4"
                                    value="1" style="width: 15px; text-align:left; border:0" min="0"
                                    readonly>
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
                            value="RESERVE NOW">
                    </div>
                    <div class="col-12 p-5-price price-box text-center">You won't be charged yet</div>
                    <div class="row">
                        <div class="col-7 price-box">Sub Total<input id="sum_night3" value="0"
                                style="width: 25px; text-align:right; border:0"> nights</div>
                        <div class="col-5 price-box">IDR <span id="total3" style="font-size:100%">0</span>
                        </div>
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

    {{-- MODAL CONTACT ACTIVITY --}}
    <div class="modal fade" id="modal-contact_activity" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $activity->name }} Contact</h5>
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
                                {{ $activity->phone }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="col-11">
                            <b style="font-size: 15px;" class="price-box">
                                {{ $activity->createdByDetails->email }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="col-11">
                            <a href="//{{ $activity->website }}" target="_blank">
                                <b style="font-size: 15px;" class="price-box">
                                    {{ $activity->website }}
                                </b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function contact_activity() {
            $('#modal-contact_activity').modal('show');
        }
    </script>

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

    <!-- MAP MODAL -->
    <div class="modal fade" id="modal-map" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-map">
                <div class="modal-header">
                    <h5 class="modal-title">Map</h5>
                    <button type="button" class="btn-close" onclick="close_map()"></button>
                </div>
                <div class="modal-body pb-1" style="height: 500px">
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
    <script src="{{ asset('assets/js/view-villa.js') }}"></script>
    <script src="{{ asset('assets/js/simpleLightbox.js') }}"></script>

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
        function editPriceForm() {
            var form = document.getElementById("price-form");
            var content = document.getElementById("price-content");
            var content_teks = document.getElementById("price-content-teks");
            form.classList.add("d-block");
            content.classList.add("d-none");
            content_teks.classList.add("d-none");
        }

        function editPriceCancel() {
            var form = document.getElementById("price-form");
            var formInput = document.getElementById("price-form-input");
            var content = document.getElementById("price-content");
            var content_teks = document.getElementById("price-content-teks");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            content_teks.classList.remove("d-none");
            formInput.value = '{{ $activityPrice->price }}';
        }


        function editNameForm() {
            var form = document.getElementById("name-form");
            var content = document.getElementById("name-content");
            var formInput = document.getElementById("name-form-input");
            form.classList.add("d-block");
            content.classList.add("d-none");

            if(formInput.value == 'Wow Price Here'){
                formInput.value = '';
            }
        }

        function editNameCancel() {
            var form = document.getElementById("name-form");
            var formInput = document.getElementById("name-form-input");
            var content = document.getElementById("name-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $activityPrice->name }}';

            if(formInput.value == 'Wow Price Here'){
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

            if(formInput.value == 'Make your short description here'){
                formInput.value = '';
            }
        }

        function editShortDescriptionCancel() {
            var form = document.getElementById("short-description-form");
            var formInput = document.getElementById("short-description-form-input");
            var content = document.getElementById("short-description-content");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            formInput.value = '{{ $activityPrice->short_description }}';

            if(formInput.value == 'Make your short description here'){
                formInput.value = '';
            }
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
            $(openTimeInput).val('{{ $activity->open_time }}');
            $(closeTimeInput).val('{{ $activity->closed_time }}');
            $(form).hide();
            $(content).show();
        }
    </script>
    <script>
        function editDescriptionForm() {
            var form = document.getElementById("description-form");
            var content = document.getElementById("description-content");
            var btn = document.getElementById("btnShowMoreDescription");
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
            url: '/things-to-do/price/photo/store',
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
                    var value = $('form#formData #id_price').val();
                    formData.append('id_price', value);
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
        $(document).ready(function() {
            var $window = $(window);
            var $sidebar = $(".sidebar");
            var $sidebarHeight = $sidebar.innerHeight();
            var $footerOffsetTop = $(".stopper").offset().top;
            var $sidebarOffset = $sidebar.offset();

            $window.scroll(function() {
                if ($window.scrollTop() > $sidebarOffset.top) {
                    $sidebar.addClass("fixed-activity");
                } else {
                    $sidebar.removeClass("fixed-activity");
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

    {{-- Highlight sticky --}}
    <script>
        var gallery = $('#gallery').offset().top,
            description = $('#description').offset().top,
            availability = $('#availability').offset().top,
            review = $('#review').offset().top,
            host = $('.host').offset().top,
            $window = $(window);

        $window.scroll(function() {
            if ($window.scrollTop() >= gallery && $window.scrollTop() < description) {
                $('#gallery-sticky').addClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= description && $window.scrollTop() < availability) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').addClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= availability && $window.scrollTop() < review) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#availability-sticky').addClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            } else if ($window.scrollTop() >= review && $window.scrollTop() < host) {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').addClass('active-sticky');
            } else {
                $('#gallery-sticky').removeClass('active-sticky');
                $('#about-sticky').removeClass('active-sticky');
                $('#location-sticky').removeClass('active-sticky');
                $('#availability-sticky').removeClass('active-sticky');
                $('#review-sticky').removeClass('active-sticky');
            }
        });
    </script>

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
                        @forelse ($photo as $item)
                            @php
                                $id = $item->id_photo;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <img src="{{ asset('foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}"
                                    title="{{ $name }}">
                            </li>
                        @empty
                            there is no image yet
                        @endforelse
                    </ul>

                    <div style="clear: both; margin-top: 20px;">
                        <input type='button' class="btn-edit-position-photos" value='{{ __('user_page.Save') }}'
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
                        @forelse ($activity->video->sortBy('order') as $item)
                            @php
                                $id = $item->id_video;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <video
                                    src="{{ asset('foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
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
                url: '/things-to-do/update/photo/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    imageids: imageids_arr,
                    id: `{{ $activity->id_activity }}`
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
                url: '/things-to-do/update/video/position',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    videoids: videoids_arr,
                    id: `{{ $activity->id_activity }}`
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
    {{-- END EDIT POSITION PHOTO & VIDEO --}}

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
                        url: `/things-to-do/price/${ids.id}/delete/image`,
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

    {{-- Sweetalert Function Delete Story --}}
    <script>
        function delete_activity_story(ids) {
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
                        url: `/things-to-do/price/${ids.id}/delete/story/${ids.id_story}`,
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
                        url: `/things-to-do/price/${ids.id}/delete/photo/photo/${ids.id_photo}`,
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
                        url: `/things-to-do/price/${ids.id}/delete/photo/video/${ids.id_video}`,
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

    {{-- Sweetalert Function Request Video to Owner --}}
    <script>
        function requestVideo(ids) {
            var ids = ids;
            Swal.fire({
                title: 'Do you want request a video to the Owner?',
                text: 'Requesting a video!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ff7400',
                cancelButtonColor: '#000',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Request it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: `/things-to-do/price/request/video/${ids.id}/${ids.name}`,
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
                    Swal.fire('Cancel', 'Canceled Request Video', 'error')
                }
            });
        };
    </script>

    {{-- View Maps Activity --}}
    <script>
        async function view_map(id) {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: `/things-to-do/map/${id}`,
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

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
    <script>
            function sidebarhide() {
                $("body").css({
                    "height": "auto",
                    "overflow": "auto"
                })
                $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                $(".expand-navbar-mobile").attr("aria-expanded", "false");
                $("#overlay").css("display", "none");
            }
            function language() {
                sidebarhide();
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').addClass('active');
                $('#content-tab-language').addClass('active');
                $('#trigger-tab-currency').removeClass('active');
                $('#content-tab-currency').removeClass('active');
            }
            function currency() {
                sidebarhide();
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');
            }
    </script>

    {{-- Like --}}
    @auth
        <script>
            function likeFavorit(value) {
                $.ajax({
                    type: "GET",
                    url: `/like/things-to-do/${value}`,
                    data: {
                        activity: value,
                        user: `{{ Auth::user()->id }}`,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data == 1) {
                            $(`#likeButton${value}`).removeClass('list-like-button');
                            $(`#likeButton${value}`).addClass('list-like-button-active');
                            $(`#unlikeButton${value}`).removeClass('list-like-button');
                            $(`#unlikeButton${value}`).addClass('list-like-button-active');
                            $("#captCan").html("CANCEL");
                            $("#captFav").html("CANCEL");
                        } else if (data == 0) {
                            $(`#likeButton${value}`).removeClass('list-like-button-active');
                            $(`#likeButton${value}`).addClass('list-like-button');
                            $(`#unlikeButton${value}`).removeClass('list-like-button-active');
                            $(`#unlikeButton${value}`).addClass('list-like-button');
                            $("#captCan").html("FAVORITE");
                            $("#captFav").html("FAVORITE");
                        }
                    },
                });
            }
        </script>
    @endauth
    {{-- End Like --}}

    <script>
        (function() {
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
    </script>

    @include('components.lazy-load.lazy-load')

</body>
