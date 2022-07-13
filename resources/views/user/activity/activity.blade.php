<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ $activity->name }} - EZV2</title>

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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-activity.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/simpleLightbox.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
    </script>
    <script src="{{ asset('assets/js/errorToString.js') }}"></script>

    <!-- Izitoast -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/iziToast/iziToast.min.css') }}">
    <script src="{{ asset('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

    {{-- END GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

    <style>
        .brd-radius {
            border-radius: 10px;
        }

        /* .slick-prev {
            margin-top: -20px;
        }

        .slick-next {
            margin-top: -20px;
        } */
    </style>
</head>

<body style="background-color:white">
    @php
        $condition_villa = Route::is('villa');
        $condition_restaurant = Route::is('restaurant');
        $condition_hotel = Route::is('hotel') || Route::is('room_hotel');
        $condition_things_to_do = Route::is('activity') || Route::is('activity_price_index');
    @endphp

    @include('components.notification.notification')
    @include('components.loading.loading-type1')
    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}

        {{-- STICKY BOTTOM FOR MOBILE --}}
        <div class="sticky-bottom-mobile d-xs-block d-md-none">
            <a onclick="contact_activity()" type="button" class="rsv-btn-button">
                {{ __('user_page.CONTACT') }}
            </a>
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
                    @if (auth()->user()->id == $activity->created_by)
                        @if ($activity->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                <span>{{ __('user_page.this content is deactive') }}, </span>
                                <form action="{{ route('activity_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.request activation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                <span>{{ __('user_page.this content is active') }}, </span>
                                <form action="{{ route('activity_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.request deactivation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.you have been request activation for this content') }},
                                </span>
                                <form
                                    action="{{ route('activity_cancel_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.cancel activation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                        @if ($activity->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.you have been request deactivation for this content') }},
                                </span>
                                <form
                                    action="{{ route('activity_cancel_request_update_status', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
                                    <button class="btn"
                                        type="submit">{{ __('user_page.cancel deactivation') }}</button>
                                </form>
                                <span> ?</span>
                            </div>
                        @endif
                    @endif
                    @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']))
                        @if ($activity->status == '0')
                            <div class="alert alert-danger d-flex flex-row align-items-center" role="alert">
                                {{ __('user_page.this content is deactive') }}
                            </div>
                        @endif
                        @if ($activity->status == '1')
                            <div class="alert alert-success d-flex flex-row align-items-center" role="success">
                                {{ __('user_page.this content is active, edit grade things to do') }}

                                <form action="{{ route('activity_update_grade', $activity->id_activity) }}"
                                    method="post">
                                    @csrf
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade-success" name="grade"
                                            onchange='this.form.submit()'>
                                            <option value="AA" {{ $activity->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $activity->grade == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ $activity->grade == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ $activity->grade == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ $activity->grade == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                        <noscript><input type="submit" value="Submit"></noscript>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @if ($activity->status == '2')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.the owner request activation, choose grade things to do') }}
                                </span>
                                <form action="{{ route('admin_activity_update_status', $activity->id_activity) }}"
                                    method="get" class="d-flex">
                                    <div style="margin-left: 10px;">
                                        <select class="custom-select grade" name="grade">
                                            <option value="AA" {{ $activity->grade == 'AA' ? 'selected' : '' }}>AA
                                            </option>
                                            <option value="A" {{ $activity->grade == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ $activity->grade == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="C" {{ $activity->grade == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D" {{ $activity->grade == 'D' ? 'selected' : '' }}>D
                                            </option>
                                        </select>
                                    </div>
                                    <span style="margin-left: 10px;">and</span>
                                    <button class="btn" type="submit" style="margin-top: -7px;">
                                        {{ __('user_page.activate this content') }}</button>
                                </form>
                            </div>
                        @endif
                        @if ($activity->status == '3')
                            <div class="alert alert-warning d-flex flex-row align-items-center" role="warning">
                                <span>{{ __('user_page.the owner request deactivation') }}, </span>
                                <form action="{{ route('admin_activity_update_status', $activity->id_activity) }}"
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
                <div class="row top-profile" id="first-detail-content">
                    <div class="col-lg-4 col-md-4 col-xs-12" style="padding: 0px;">
                        <div class="profile-image">
                            @if ($activity->image)
                                <img class="lozad imageProfileActivity" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activity->image) }}">
                            @else
                                <img class="lozad imageProfileActivity" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" style="color:#FF7400; font-weight: 600;" class="edit-profile-image-btn-dekstop"
                                        onclick="edit_activity_profile()">{{ __('user_page.Edit Image Profile') }}</a>
                                    @if ($activity->image)
                                        {{-- <a href="{{ route('activity_delete_image', $activity->id_activity) }}"> --}}
                                        <a class="delete-profile edit-profile-image-btn-dekstop" href="javascript:void(0);"
                                            onclick="delete_profile_image({'id': `{{ $activity->id_activity }}`})"><i
                                                class="fa fa-trash" style="color:red; margin-left: 25px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom"
                                                title="{{ __('user_page.Delete') }}"></i></a>
                                    @endif
                                @endif
                            @endauth
                            <div class="date-contact-dekstop">
                                <p style="font-size: 12px;" id="time-content">
                                    @php
                                        $open = date_create($activity->open_time);
                                        $closed = date_create($activity->closed_time);
                                    @endphp
                                    <span class="timeActivityContent">{{ date_format($open, 'h:i A') }} - {{ date_format($closed, 'h:i A') }}</span>
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="editTimeForm()"
                                                style="color:#FF7400; font-weight: 600;">{{ __('user_page.Edit Open Hours') }}</a>
                                        @endif
                                    @endauth
                                </p>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div id="time-form" style="display:none;">
                                            <form action="javascript:void(0)" onsubmit="saveTimeActivity()">
                                                <input type="hidden" name="id_activity"
                                                    value="{{ $activity->id_activity }}" required>
                                                <div class="form-group d-flex justify-content-center align-items-center">
                                                    <div class="col-auto">
                                                        <input type="time" name="open_time" class="form-control" id="open-time-input" value="{{ $activity->open_time }}"
                                                            required>
                                                    </div>
                                                    <span class="mx-2">-</span>
                                                    <div class="col-auto">
                                                        <input type="time" name="closed_time" class="form-control" id="close-time-input" value="{{ $activity->closed_time }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-secondary"
                                                        onclick="editTimeFormCancel()">
                                                        <i class="fa fa-xmark"></i>
                                                        {{ __('user_page.Cancel') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                {{-- CONTACT --}}
                                <div class="col-12" id="fix-contact-m"
                                    style="display: flex; padding-right: 70px; justify-content: center; padding-left: 70px; margin-top: 18px;">
                                    <div style="padding: 0px 6px;">
                                        <a onclick="contact_activity()" type="button">
                                            <i class="fa-solid fa-phone"></i>
                                        </a>
                                    </div>
                                    <div style="padding: 0px 6px;">
                                        @if ($activity->email)
                                            <a target="_blank" type="button" href="mailto:{{ $activity->email }}" class="mailto-email-activity">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                        @else
                                            <a type="button" href="javascript:void(0);" class="mailto-email-activity">
                                                <i class="fa-solid fa-envelope text-secondary"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-1">
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <a type="button" onclick="edit_contact()"
                                                    style="font-size: 12px; color:#FF7400; font-weight: 600;">{{ __('user_page.Edit Contact') }}</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                {{-- END CONTACT --}}
                            </div>
                            {{-- SHORT NAME FOR MOBILE --}}
                            <div class="name-content-mobile ms-3 d-md-none">
                                <h2 id="name-content-mobile">
                                    <span id="name-content2-mobile">{{ $activity->name ?? __('user_page.There is no name yet') }}</span>
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;<a type="button" onclick="editNameForm()" class="edit-name-btn"
                                                style="color:#FF7400; font-weight: 600; font-size: 14pt;">
                                                {{ __('user_page.Edit Name') }}</a>
                                        @endif
                                    @endauth
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-xs-12 profile-info" style="padding-left: 40px;">
                        <h2 id="name-content">
                            <span id="name-content2">{{ $activity->name ?? __('user_page.There is no name yet') }}</span>
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editNameForm()"
                                        style="color:#FF7400; font-weight: 600; font-size: 14pt;">
                                        {{ __('user_page.Edit Name') }}</a>
                                @endif
                            @endauth
                        </h2>
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="name-form" style="display:none;">
                                    <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}"
                                        required>
                                    <textarea style="width: 100%;" class="form-control" name="name" cols="30" rows="3"
                                        id="name-form-input" maxlength="100" placeholder="{{ __('user_page.Wow Name Here') }}"
                                        required>{{ $activity->name }}</textarea>
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="saveNameActivity()"
                                        style="background-color: #ff7400">
                                        <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                    </button>
                                    <button type="reset" class="btn btn-sm btn-secondary"
                                        onclick="editNameCancel()">
                                        <i class="fa fa-xmark"></i> {{ __('user_page.Cancel') }}
                                    </button>
                                </div>
                            @endif
                        @endauth

                        {{-- EDIT PROFILE IMAGE AND NAME CONTENT MOBILE --}}
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                &nbsp;<a type="button" style="color:#FF7400; font-weight: 600;" class="edit-profile-image-btn-mobile d-md-none"
                                    onclick="edit_activity_profile()">{{ __('user_page.Edit Image Profile') }}</a>
                                @if ($activity->image)
                                    {{-- <a href="{{ route('activity_delete_image', $activity->id_activity) }}"> --}}
                                    <a class="delete-profile edit-profile-image-btn-mobile d-md-none" href="javascript:void(0);"
                                        onclick="delete_profile_image({'id': `{{ $activity->id_activity }}`})"><i
                                            class="fa fa-trash" style="color:red; margin-left: 25px;"
                                            data-bs-toggle="popover" data-bs-animation="true"
                                            data-bs-placement="bottom"
                                            title="{{ __('user_page.Delete') }}"></i></a>
                                @endif
                            @endif
                        @endauth
                        {{-- END EDIT PROFILE IMAGE AND NAME CONTENT MOBILE --}}

                        {{-- DATE CONTACT FOR MOBILE --}}
                        <div class="date-contact-mobile w-100 d-md-none">
                            <p style="font-size: 12px;" id="time-content-mobile">
                                @php
                                    $open = date_create($activity->open_time);
                                    $closed = date_create($activity->closed_time);
                                @endphp
                                <span class="timeActivityContent">{{ date_format($open, 'h:i A') }} - {{ date_format($closed, 'h:i A') }}</span>
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a type="button" onclick="editTimeFormMobile()"
                                            style="color:#FF7400; font-weight: 600;">{{ __('user_page.Edit Open Hours') }}</a>
                                    @endif
                                @endauth
                            </p>
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="time-form-mobile" style="display:none;">
                                        <form action="javascript:void(0)" onsubmit="saveTimeActivityMobile()">
                                            <input type="hidden" name="id_activity"
                                                value="{{ $activity->id_activity }}" required>
                                            <div class="form-group d-flex justify-content-start align-items-center">
                                                <div class="col-auto">
                                                    <input type="time" name="open_time" class="form-control" id="open-time-input-mobile" value="{{ $activity->open_time }}"
                                                        required>
                                                </div>
                                                <span class="mx-2">-</span>
                                                <div class="col-auto">
                                                    <input type="time" name="closed_time" class="form-control" id="close-time-input-mobile" value="{{ $activity->closed_time }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i> {{ __('user_page.Done') }}
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-secondary"
                                                    onclick="editTimeFormMobileCancel()">
                                                    <i class="fa fa-xmark"></i>
                                                    {{ __('user_page.Cancel') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            {{-- CONTACT --}}
                            <div class="col-12 contact-mobile"
                                style="display: flex; padding-right: 70px; padding-left: 70px; margin-top: 18px;">
                                <div class="col-4 contact-item">
                                    <a onclick="contact_activity()" type="button">
                                        <i class="fa-solid fa-phone"></i>
                                    </a>
                                </div>
                                <div class="col-3 contact-item">
                                    @if ($activity->email)
                                        <a target="_blank" type="button"
                                            href="mailto:{{ $activity->email }}" class="mailto-email-activity">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    @else
                                        <a type="button" href="javascript:void(0)" class="mailto-email-activity">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-1 contact-item">
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a type="button" onclick="edit_contact()"
                                                style="font-size: 12px; color:#FF7400; font-weight: 600;">{{ __('user_page.Edit') }}</a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            {{-- END CONTACT --}}
                        </div>
                        {{-- SHORT DESCRIPTION --}}
                        <p class="short-desc" id="short-description-content">
                            <span id="short_description_contents" class="translate-text-single">
                                {{ $activity->short_description }}
                            </span>
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editShortDescriptionForm()"
                                        style="color:#FF7400; font-weight: 600; font-size: 12pt;">{{ __('user_page.Edit Description') }}</a>
                                @endif
                            @endauth
                        </p>
                        @auth
                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div id="short-description-form" style="display: none">
                                    <form action="javascript:void(0);" method="post">
                                        {{-- @csrf
                                        @method('PATCH') --}}
                                        <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}"
                                            required>
                                        <textarea class="form-control" style="width: 100%;" name="short_description" id="short-description-form-input"
                                            cols="30" rows="3" maxlength="250" placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $activity->short_description }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="saveShortDescription();">
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
                        {{-- TAG --}}
                        <p id="tagsContent" class="text-secondary translate-text-group">
                            @if ($activity->subCategory->count() > 7)
                                @foreach ($activity->subCategory->take(7) as $subcategory)
                                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                                        style="background-color: #FF7400;">{{ $subcategory->name }}</span>
                                @endforeach
                                <button class="btn btn-outline-dark btn-sm rounded wow-tag-button"
                                    onclick="view_subcategory()">{{ __('user_page.More') }}</button>
                            @else
                                @forelse ($activity->subCategory as $subcategory)
                                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                                        style="background-color: #FF7400;">{{ $subcategory->name }}</span>
                                @empty
                                    {{ __('user_page.there is no tag yet') }}
                                @endforelse
                            @endif
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;<a type="button" onclick="editSubcategory()"
                                        style="color:#FF7400; font-weight: 600; font-size: 12pt;">{{ __('user_page.Edit Tags') }}</a>
                                @endif
                            @endauth
                        </p>
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
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                    @if ($activity->story->count() == 0)
                                        @if (in_array(Auth::user()->role_id, [1, 2, 3]) || Auth::user()->id == $activity->created_by)
                                            <li class="story">
                                                <div class="img-wrap">
                                                    <a type="button" onclick="edit_story()">
                                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                                            data-src="{{ URL::asset('assets/add_story.png') }}">
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($activity->video->count() < 100)
                                            <div class="containerSlider4">
                                                <div id="slide-left-container4">
                                                    <div class="slide-left4">
                                                    </div>
                                                </div>
                                                <div id="cards-container4">
                                                    <div class="cards4">
                                                        @foreach ($activity->video as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                                            <a type="button"
                                                                                onclick="view_video_activity({{ $item->id_video }})">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>
                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid" loading="lazy"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                onclick="delete_photo_video({'id': `{{ $activity->id_activity }}`, 'id_video': `{{ $item->id_video }}`})">
                                                                                {{-- <a href="{{ route('activity_delete_story', ['id' => $activity->id_activity, 'id_story' => $item->id_story]) }}"> --}}
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
                                        @if ($activity->story->count() < 100)
                                            @if (in_array(Auth::user()->role_id, [1, 2, 3]) || Auth::user()->id == $activity->created_by)
                                                <li class="story" style="margin-top: -35px;">
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
                                                    <div class="cards4">
                                                        @foreach ($activity->story as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                                            <a type="button"
                                                                                onclick="view_story_activity({{ $item->id_story }})">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>
                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid" loading="lazy"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                onclick="delete_activity_story({'id': `{{ $activity->id_activity }}`, 'id_story': `{{ $item->id_story }}`})">
                                                                                {{-- <a href="{{ route('activity_delete_story', ['id' => $activity->id_activity, 'id_story' => $item->id_story]) }}"> --}}
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
                                                        @foreach ($activity->video as $item)
                                                            <div class="card4 col-lg-3" style="border-radius: 5px;">
                                                                <div class="img-wrap">
                                                                    <div class="video-position">
                                                                        @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                                            <a type="button"
                                                                                onclick="view_video_activity({{ $item->id_video }})">
                                                                            @else
                                                                                <a type="button"
                                                                                    onclick="showPromotionMobile()">
                                                                        @endif
                                                                        <div class="story-video-player">
                                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                                        </div>
                                                                        <video href="javascript:void(0)"
                                                                            class="story-video-grid" loading="lazy"
                                                                            style="object-fit: cover;"
                                                                            src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                                                        </video>
                                                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                                            <a class="delete-story"
                                                                                href="javascript:void(0);"
                                                                                onclick="delete_photo_video({'id': `{{ $activity->id_activity }}`, 'id_video': `{{ $item->id_video }}`})">
                                                                                {{-- <a href="{{ route('activity_delete_story', ['id' => $activity->id_activity, 'id_story' => $item->id_story]) }}"> --}}
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
                                            @foreach ($activity->story as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            @auth
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                                    <a type="button"
                                                                        onclick="view_story_activity({{ $item->id_story }})">
                                                                    @else
                                                                        <a type="button" onclick="showPromotionMobile()">
                                                                @endif
                                                            @endauth
                                                            @guest
                                                                <a type="button" onclick="showPromotionMobile()">
                                                                @endguest
                                                                <div class="story-video-player">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                                <video href="javascript:void(0)"
                                                                    class="story-video-grid" loading="lazy"
                                                                    style="object-fit: cover;"
                                                                    src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                                                </video>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($activity->video as $item)
                                                <div class="card3 col-lg-3" style="border-radius: 5px;">
                                                    <div class="img-wrap">
                                                        <div class="video-position">
                                                            @auth
                                                                @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                                    <a type="button"
                                                                        onclick="view_video_activity({{ $item->id_video }})">
                                                                    @else
                                                                        <a type="button" onclick="showPromotionMobile()">
                                                                @endif
                                                            @endauth

                                                            @guest
                                                                <a type="button" onclick="showPromotionMobile()">
                                                                @endguest
                                                                <div class="story-video-player">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                                <video href="javascript:void(0)"
                                                                    class="story-video-grid" loading="lazy"
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
                        <li class="navigationItem">
                            <a id="price-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('price').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fa fa-money navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.PRICE') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
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
                            <a id="amenities-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('amenities').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-bell navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.FACILITIES') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navigationItem">
                            <a id="location-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('location-map').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="fas fa-map-marker-alt navigationItem__Icon svg-icon"
                                        fill="#262626" viewBox="0 0 20 20"></i>
                                    <span class="navigationItemText">{{ __('user_page.LOCATION') }}</span>
                                </span>
                            </a>
                        </li>
                        {{-- <li class="navigationItem">
                            <a id="availability-sticky" class="hoover font-13 navigationItem__Button"
                                onClick="document.getElementById('availability').scrollIntoView();">
                                <span>
                                    <i aria-label="Posts" class="far fa-calendar-alt navigationItem__Icon svg-icon"
                                    fill="#262626" viewBox="0 0 20 20"></i>
                                    AVAILABILITY
                                </span>
                            </a>
                        </li> --}}
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
                            @if ($activity->photo->count() > 0)
                                @foreach ($activity->photo->sortBy('order') as $item)
                                    <div class="col-4 grid-photo">
                                        <a
                                            href="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}">
                                            <img class="photo-grid img-lightbox lozad-gallery-load lozad-gallery"
                                                src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}"
                                                title="{{ $item->caption }}">
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-icon">
                                                    <button data-bs-toggle="popover" data-bs-animation="true"
                                                        data-bs-placement="bottom" type="button"
                                                        title="{{ __('user_page.Add Photo Caption') }}"
                                                        onclick="view_add_caption({'id': '{{ $activity->id_activity }}', 'id_photo': '{{ $item->id_photo }}', 'caption': '{{ $item->caption }}'})"><i
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
                                                        onclick="delete_photo_photo({'id': `{{ $activity->id_activity }}`, 'id_photo': `{{ $item->id_photo }}`})"><i
                                                            class="fa fa-trash"></i></button>
                                                </span>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            @endif
                            @if ($activity->video->count() > 0)
                                @foreach ($activity->video->sortBy('order') as $item)
                                    <div class="col-4 grid-photo">
                                        @auth
                                            @if (in_array(Auth::user()->role_id, [1, 2]) || Auth::user()->id == $activity->created_by)
                                                <a class="pointer-normal"
                                                    type="button"onclick="view_video_activity({{ $item->id_video }})">
                                                @else
                                                    <a class="pointer-normal" type="button"
                                                        onclick="showPromotionMobile()">
                                            @endif
                                        @endauth
                                        @guest
                                            <a class="pointer-normal" type="button" onclick="showPromotionMobile()">
                                            @endguest
                                            <video href="javascript:void(0)" class="photo-grid" loading="lazy"
                                                src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
                                            </video>
                                            <span class="video-grid-button"><i class="fa fa-play"></i></span>
                                        </a>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <span class="edit-video-icon">
                                                    <button href="javascript:void(0);"
                                                        onclick="delete_photo_video({'id': `{{ $activity->id_activity }}`, 'id_video': `{{ $item->id_video }}`})"
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
                            @if ($activity->photo->count() <= 0 && $activity->video->count() <= 0)
                                {{ __('user_page.there is no gallery yet') }}
                            @endif
                        </div>
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
                                    <input type="hidden" value="{{ $activity->id_activity }}" id="id_activity"
                                        name="id_activity">
                                </form>
                                <button type="submit" id="button"
                                    class="btn btn-primary">{{ __('user_page.Upload') }}</button>
                            </section>
                        @endif
                    @endauth
                    {{-- END ADD GALLERY --}}
                    {{-- PRICES --}}
                    <section id="price" class="section-2">
                        <div class="row pd-tlr-10 prices">
                            <hr>
                            <h2>
                                {{ __('user_page.Prices') }}
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;
                                        <a type="button" onclick="add_price()">
                                            <i class="fa fa-plus" style="color:#FF7400; padding-right:5px;"
                                                data-bs-toggle="popover" data-bs-animation="true"
                                                data-bs-placement="bottom" title="{{ __('user_page.Add') }}"></i>
                                        </a>
                                    @endif
                                @endauth
                            </h2>
                        </div>
                        <div class="col-12">
                            <div class="row table-header">
                                <div class="col-4 text-center tab-header">
                                    {{ __('user_page.Image') }}
                                </div>
                                <div class="col-4 text-center tab-header">
                                    {{ __('user_page.Name') }}
                                </div>
                                {{-- <div class="col-2 text-center tab-header">
                                    Descriptio
                                </div> --}}
                                <div class="col-4 text-center tab-header">
                                    {{ __('user_page.Price') }}
                                </div>
                            </div>
                            <div class="row table-body translate-text-group">
                                @forelse ($activity->price as $item)
                                    <div class="col-12 col-md-4 text-center tab-body">
                                        <div class="content list-image-content">
                                            <input type="hidden" value="" id="id_price" name="id_price">
                                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                                data-dots="false" data-arrows="true">
                                                @if (count($activity->PricePhoto->where('id_price', $item->id_price)) > 0)
                                                    @foreach ($activity->PricePhoto->where('id_price', $item->id_price) as $galleryPrice)
                                                        <a href="{{ route('activity_price_index', $item->id_price) }}"
                                                            target="_blank" class="grid-image-container">
                                                            <img class="brd-radius img-fluid grid-image lozad"
                                                                style="height: 200px; display: block;"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="{{ asset('/foto/activity/' . strtolower($activity->uid) . '/' . $galleryPrice->name) }}"
                                                                alt="">
                                                        </a>
                                                    @endforeach
                                                @elseif (!empty($item->foto))
                                                    <a href="{{ route('activity_price_index', $item->id_price) }}"
                                                        target="_blank" class="grid-image-container">
                                                        <img class="brd-radius img-fluid grid-image lozad"
                                                            style="height: 200px; display: block;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->foto) }}"
                                                            alt="">
                                                    </a>
                                                @else
                                                    <a href="{{ route('activity_price_index', $item->id_price) }}"
                                                        target="_blank" class="grid-image-container">
                                                        <img class="brd-radius img-fluid grid-image lozad"
                                                            style="height: 200px; display: block;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                                            alt="">
                                                    </a>
                                                @endif

                                                {{-- <a href="" target="_blank" class="grid-image-container">
                                                    <img class="brd-radius img-fluid grid-image lozad" style="display: block;"
                                                        src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->foto) }}"
                                                        alt="">
                                                </a>
                                                <a href="" target="_blank" class="grid-image-container">
                                                    <img class="brd-radius img-fluid grid-image lozad" style="display: block;"
                                                        src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('/foto/activity/' . strtolower($activity->uid) . '/' . $item->foto) }}"
                                                        alt="">
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 text-justify tab-body" style="cursor: pointer;"
                                        onclick="window.location='{{ route('activity_price_index', $item->id_price) }}';">
                                        <h4>
                                            <p>
                                                <a href="{{ route('activity_price_index', $item->id_price) }}">
                                                    <span clas="translate-text-group-items">{{ $item->name }}</span>
                                                </a>
                                            </p>
                                        </h4>
                                        <p class="desc-hotel">
                                            {{ Str::limit(Translate::translate($item->description), 200, ' ...') }}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 text-center tab-body" style="cursor: pointer;"
                                        onclick="window.location='{{ route('activity_price_index', $item->id_price) }}';">
                                        {{ CurrencyConversion::exchangeWithUnit($item->price) }}
                                        <br>
                                        <a href="{{ route('activity_price_index', $item->id_price) }}"
                                            target="_blank" style="display: inline-block; width: 50%;"
                                            class="btn btn-outline-dark table-room-button">{{ __('user_page.Select') }}</a>
                                    </div>
                                    <hr>
                                @empty
                                    <div class="col-12">{{ __('user_page.No data found') }}</div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <section id="description" class="section-2">
                        <hr>
                        {{-- Description --}}
                        <div class="pd-tlr-10">
                            <h2>
                                {{ __('user_page.About this place') }}
                                @auth
                                    @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        &nbsp;<a type="button" onclick="editDescriptionForm()"
                                            style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit About') }}</a>
                                    @endif
                                @endauth
                            </h2>
                            <p id="description-content"
                                style="text-align: justify; padding-top:10px; padding-bottom:12px">
                                {!! Str::limit(Translate::translate($activity->description), 600, ' ...') ?? __('user_page.There is no description yet') !!}
                                {{-- {!! $restaurant->description ?? 'there is no description yet' !!} --}}
                            </p>

                            <span id="buttonShowMoreDescription">
                            @if (Str::length($activity->description) > 600)
                                <a id="btnShowMoreDescription" class="d-block" style="font-weight: 600;"
                                    href="javascript:void(0);" onclick="showMoreDescription();"><span
                                        style="text-decoration: underline; color: #ff7400;">{{ __('user_page.Show more') }}</span>
                                    <span style="color: #ff7400;">></span></a>
                            @endIf
                            </span>

                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div id="description-form" style="display:none;">
                                        <form action="javascript:void(0);" method="post">
                                            {{-- @csrf
                                            @method('PATCH') --}}
                                            <input type="hidden" name="id_activity"
                                                value="{{ $activity->id_activity }}" required>
                                            <div class="form-group">
                                                <textarea name="description" class="form-control" id="description-form-input" class="w-100" rows="5"
                                                placeholder="{{ __('user_page.Make your short description here') }}" required>{{ $activity->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="saveDescription();">
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
                        </div>
                    </section>
                    <section id="amenities" class="section-2">
                        <div class="row-grid-amenities">
                            <hr>
                            <div>
                                <h2>
                                    {{ __('user_page.Facilities') }}
                                    @auth
                                        @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            &nbsp;
                                            <a type="button" onclick="add_facilities()"
                                                style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Facilities') }}</a>
                                        @endif
                                    @endauth
                                </h2>
                            </div>
                            <div class="stopper"></div>
                        </div>

                        <div class="row-grid-amenities">
                            <div class="row-grid-list-amenities translate-text-group" id="contentFacilities">
                                @if ($activity->facilities->count() > 6)
                                    @for ($i = 0; $i < 6; $i++)
                                        <div class="list-amenities">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $activity->facilities[$i]->icon }}"></i>
                                                <div class="mb-0 max-line text-expand">
                                                    <span class="translate-text-group-items">
                                                        {{ $activity->facilities[$i]->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $activity->facilities[$i]->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    @forelse ($activity->facilities as $item)
                                        <div class="list-amenities">
                                            <div class="text-align-center">
                                                <i class="f-40 fa fa-{{ $item->icon }}"></i>
                                                <div class="mb-0 max-line text-expand">
                                                    <span class="translate-text-group-items">
                                                        {{ $item->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-0 list-more">
                                                <span class="translate-text-group-items">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class='list-amenities'>
                                            <p>{{ __('user_page.there is no facilities yet') }}</p>
                                        </div>
                                    @endforelse
                                @endif


                                @if ($activity->facilities->count() > 6)
                                    <div class="list-amenities">
                                        <button class="amenities-button" type="button" onclick="view_amenities()">
                                            <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                                            <div style="font-size: 15px; font-weight: 600;">
                                                {{ __('user_page.More') }}</div>
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="footer"></div>
                    </section>


                    {{-- <section id="availability" class="section-2">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </section> --}}
                </div>
                {{-- END PAGE CONTENT --}}
                <!-- <div class="spacer">&nbsp;</div> -->
            </div>

            {{-- END LEFT CONTENT --}}
            {{-- RIGHT CONTENT --}}
            <div class="col-lg-3 col-md-3 col-12">
                <div class="sidebar sidebar-activity sidebar-activity-idle" id="sidebar_fix">
                    <div class="reserve-block sidebar-mf">
                    <style>
                        .gradient-try {
                            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
                            background-size: 400% 400%;
                            animation: gradient 15s ease infinite;
                            border-radius: 12px;
                        }

                        .headline-list-property {
                            color: #FEFBE7;
                        }

                        @keyframes gradient {
                            0% {
                                background-position: 0% 50%;
                            }

                            50% {
                                background-position: 100% 50%;
                            }

                            100% {
                                background-position: 0% 50%;
                            }
                        }
                    </style>
                    <div class="gradient-try"
                        style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%); padding: 15px; margin-top:10px; margin-bottom: 10px;">
                        <center>
                            <h4 class="headline-list-property">{{ __('user_page.List Your Property Now') }}</h4>
                        </center>
                    </div>
                    <!-- Random Villa Slider Start -->
                    <div class="popular-block-activity">
                        <h4>Popular Villa<h4>
                                <div class="SlickCarousel3">
                                    @forelse ($villaRandom as $popular)
                                        <!-- Start Slider Items -->
                                        <div>
                                            <div class="popular-card">
                                                <div class="popular-card-header"
                                                    onclick="window.open('{{ route('villa', ['id' => $popular->id_villa]) }}', '_blank');"
                                                    style="cursor: pointer;">
                                                    <img
                                                        src="{{ asset('/foto/gallery/' . $popular->uid . '/' . $popular->image) }}">
                                                </div>
                                                <div>
                                                    <div class="card-content">
                                                        <div class="popular-card-title"><a
                                                                href="{{ route('villa', ['id' => $popular->id_villa]) }}"
                                                                target="_blank">{{ $popular->name }}</a></div>
                                                        <div class="popular-card-text">
                                                            <p>{{ $popular->bedroom }}
                                                                {{ __('user_page.Bedroom') }},
                                                                {{ $popular->bathroom }}
                                                                {{ __('user_page.Bathroom') }}</p>
                                                            <p style="color: #000;">
                                                                @foreach ($popular->amenities as $item)
                                                                    <i class="fa fa-{{ $item->icon }}"></i>
                                                                @endforeach
                                                                {{-- <i class="fa fa-wifi"></i> <i class="fa fa-phone"></i> --}}
                                                            </p>
                                                            <!-- Description max 100 character -->
                                                            <p style="text-align: justify;">
                                                                {{ Str::limit(Translate::translate($popular->description), 150, ' ...') }}
                                                            </p>
                                                        </div>
                                                        <div class="popular-card-price">
                                                            <p>{{ CurrencyConversion::exchangeWithUnit($popular->price) }}/{{ __('user_page.night') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Slider Items -->
                                    @empty

                                    @endforelse

                                </div>
                    </div>
                    <!-- Random Villa Slider End -->
                    </div>
                </div>
            </div>
            {{-- END RIGHT CONTENT --}}

            <section id="location-map" class="section-2">
                <div class="row-grid-amenities">
                    <hr>
                    <div>
                        <h2>
                            {{ __("user_page.What's nearby ?") }}
                            @auth
                                @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    &nbsp;
                                    <a type="button" onclick="edit_location()"
                                        style="font-size: 12pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit Location') }}</a>
                                @endif
                            @endauth
                        </h2>
                    </div>
                </div>
                <div class="row-grid-location">
                    @include('user.modal.activity.map-location')
                </div>
            </section>
        </div>
        <div id="rsv-block-btn">
            {{-- RESERVE BUTTON TOP RIGHT --}}
            <div class="rsv">
                {{-- <strong>{{ number_format($activity->price, 0, ',', '.') }}</strong>/night --}}
                {{-- <span><a onclick="reserve2()" type="button" class="rsv-btn-button">RESERVE NOW</a> --}}
                <a onclick="contact_activity()" type="button" class="rsv-btn-button">
                    {{ __('user_page.CONTACT') }}
                </a>
            </div>
            {{-- END RESERVE BUTTON TOP RIGHT --}}
        </div>
        <div id="navbarright" class="navright">
            <div class="list-villa-user right-bar">
                @if (Route::is('list') || Route::is('index'))
                @endif

                @auth

                    <div class="social-share-container" style="padding: 4px; border-radius: 9px;">

                        @if ($condition_things_to_do)
                            @php
                                $cekActivity = App\Models\ActivitySave::where('id_activity', $activity->id_activity)
                                    ->where('id_user', Auth::user()->id)
                                    ->first();
                            @endphp

                            @if ($cekActivity == null)
                                <div style="width: 48px;" class="text-center">
                                    <a style="cursor: pointer;"
                                        onclick="likeFavorit({{ $activity->id_activity }}, 'activity')">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button favorite-button-22 likeButtonactivity{{ $activity->id_activity }}"
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
                                    <a style="cursor: pointer;"
                                        onclick="likeFavorit({{ $activity->id_activity }}, 'activity')">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            role="presentation" focusable="false"
                                            class="favorite-button-active favorite-button-22 unlikeButtonactivity{{ $activity->id_activity }}"
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
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('profile_index') }}">
                                    My Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('change_password') }}">
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="#!"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                    Sign Out
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
                                <div style="font-size: 10px; color: #aaa;">{{ __('user_page.FAVORITE') }}</div>
                            </a>
                        </div>
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

                    <a onclick="loginForm()" class="btn btn-fill border-0 navbar-gap"
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
                        <h2>{{ __('user_page.Review') }}</h2>
                        <div class="row">
                            <div class="col-12">
                                @if ($activity->detailReview)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Food') }}
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="liner"></div>
                                                    {{ $activity->detailReview->average_food }}
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Service') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $activity->detailReview->average_service }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Value') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $activity->detailReview->average_value }}
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Atmosphere') }}
                                                </div>
                                                <div class="col-6">
                                                    <div class="liner"></div>
                                                    {{ $activity->detailReview->average_atmosphere }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12 d-flex mt-3 review-container">
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
                                                    We’re here to help your trip go smoothly. Every reservation is
                                                    covered by
                                                    <span><a href="#">EZV's Guest Refund Policy.</a></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                    </div>
                </section>
                @auth
                    @if (Auth::user()->role_id != 3)
                        @can('review_create')
                            @if ($activity->userReview)
                                <section id="user-review" class="section-2">
                                    <div style="padding-top:10px; padding-left:10px; padding-right:10px;">

                                        <div class="d-flex justify-content-left">
                                            <h2>{{ __('user_page.Your Review') }}</h2>
                                            <span>
                                                <form action="{{ route('activity_review_delete') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_activity"
                                                        value="{{ $activity->id_activity }}" required>
                                                    <input type="hidden" name="id_review"
                                                        value="{{ $activity->userReview->id_review }}" required>
                                                    <span>
                                                        <button type="submit" class="btn">
                                                        <i class="fa fa-trash"
                                                            style="color:#ff7400; font-size: 20px"
                                                            data-bs-toggle="popover" data-bs-animation="true"
                                                            data-bs-placement="bottom"
                                                            title="{{ __('user_page.Delete') }}"></i>
                                                        </button>
                                                    </span>
                                                </form>
                                            </span>
                                        </div>

                                        <div class="row">
                                            @if ($activity->userReview->comment)
                                                <div class="col-12">
                                                    <div class="col-6 d-flex">
                                                        <div class="col-6">
                                                            {{ __('user_page.Comment') }}
                                                        </div>
                                                        <div class="col-6" style="font-size: 22px; font-family: 'Poppins'; font-weight: 600;">
                                                            {{ $activity->userReview->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-6 d-flex">
                                                <div class="col-6">
                                                    {{ __('user_page.Experience') }}
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="liner"></div>
                                                    {{ $activity->userReview->experience }}
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </section>
                            @else
                                {{-- STYLE FOR RATING STAR --}}
                                <style>
                                   
                                    .cm-star-rating input[type=radio] {
                                        display: none
                                    }

                                    .cm-star-rating label {
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
                                        <h2>{{ __('user_page.Give review') }}</h2>
                                        <div class="row">
                                           
                                                <form action="{{ route('activity_review_store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_activity"
                                                        value="{{ $activity->id_activity }}" readonly required>
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                                            <div class="d-flex">
                                                                <div class="col-4 review-container">
                                                                    {{ __('user_page.Experience') }}
                                                                </div>
                                                           
                                                            
                                                                <div class="col-8 review-container">
                                                                <div class="cm-star-rating">
                                                                    <input id="star-5" type="radio" name="experience"
                                                                        value="5" required />
                                                                    <label for="star-5"
                                                                        title="{{ trans_choice('user_page.x stars', 5, ['number' => 5]) }}">
                                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                                    </label>
                                                                    <input id="star-4" type="radio" name="experience"
                                                                        value="4" />
                                                                    <label for="star-4"
                                                                        title="{{ trans_choice('user_page.x stars', 4, ['number' => 4]) }}">
                                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                                    </label>
                                                                    <input id="star-3" type="radio" name="experience"
                                                                        value="3" />
                                                                    <label for="star-3"
                                                                        title="{{ trans_choice('user_page.x stars', 3, ['number' => 3]) }}">
                                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                                    </label>
                                                                    <input id="star-2" type="radio" name="experience"
                                                                        value="2" />
                                                                    <label for="star-2"
                                                                        title="{{ trans_choice('user_page.x stars', 2, ['number' => 2]) }}">
                                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                                    </label>
                                                                    <input id="star-1" type="radio" name="experience"
                                                                        value="1" />
                                                                    <label for="star-1"
                                                                        title="{{ trans_choice('user_page.x stars', 1, ['number' => 1]) }}">
                                                                        <i class="active fa fa-star" aria-hidden="true"></i>
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
                                                                    class="btn btn-primary">{{ __('user_page.Done') }}</button>
                                                            </center>
                                                        </div>

                                                    </div>
                                                </form>

                                            
                                        </div>
                                        <hr>
                                    </div>
                                </section>
                            @endif
                        @endcan
                    @endif
                @endauth
                <div class="section">
                    <div id="endSticky" class="host">
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
                            <h3>{{ __('user_page.Things to know') }}</h3>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="d-flex">
                                        <h6>{{ __('user_page.Place Rules') }}</h6>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editActivityRules()"
                                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @endif
                                        @endauth
                                    </div>
                                    <p>
                                        @if (!isset($activity_rules))
                                            {{ __('user_page.No data found') }}
                                        @endif

                                        @if (isset($activity_rules))
                                            @if ($activity_rules->children == 'yes')
                                                <i class="fas fa-child"></i>
                                                {{ __('user_page.Childrens are allowed') }}<br>
                                            @endif
                                            @if ($activity_rules->infants == 'yes')
                                                <i class="fas fa-child"></i>
                                                {{ __('user_page.Infants are allowed') }}<br>
                                            @endif
                                            @if ($activity_rules->pets == 'yes')
                                                <i class="fas fa-paw"></i>
                                                {{ __('user_page.Pets are allowed') }}<br>
                                            @endif
                                            @if ($activity_rules->smoking == 'yes')
                                                <i class="fas fa-smoking"></i>
                                                {{ __('user_page.Smoking is allowed') }}<br>
                                            @endif
                                            @if ($activity_rules->events == 'yes')
                                                <i class="fas fa-calendar"></i>
                                                {{ __('user_page.Events are allowed') }}<br>
                                            @endif

                                            @if ($activity_rules->children == 'no')
                                                <i class="fas fa-ban"></i>
                                                {{ __('user_page.No children') }}<br>
                                            @endif
                                            @if ($activity_rules->infants == 'no')
                                                <i class="fas fa-ban"></i>
                                                {{ __('user_page.No infants') }}<br>
                                            @endif
                                            @if ($activity_rules->pets == 'no')
                                                <i class="fas fa-ban"></i>
                                                {{ __('user_page.No pets') }}<br>
                                            @endif
                                            @if ($activity_rules->smoking == 'no')
                                                <i class="fas fa-ban"></i>
                                                {{ __('user_page.No smoking') }}<br>
                                            @endif
                                            @if ($activity_rules->events == 'no')
                                                <i class="fas fa-ban"></i>
                                                {{ __('user_page.No events') }}<br>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="d-flex">
                                        <h6>{{ __('user_page.Health & Safety') }}</h6>
                                        @auth
                                            @if (Auth::user()->id == $activity->created_by || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                &nbsp;<a type="button" onclick="editActivityGuestSafety()"
                                                    style="font-size: 10pt; font-weight: 600; color: #ff7400;">{{ __('user_page.Edit') }}</a>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="translate-text-group">
                                        @forelse ($activity->guestSafety->take(5) as $item)
                                            <i class="fas fa-{{ $item->icon }}"></i>
                                            <span class="translate-text-group-items">
                                                {{ $item->guest_safety }}
                                            </span>
                                            <br>
                                        @empty
                                            {{ __('user_page.No data found') }}
                                        @endforelse
                                    </p>
                                    @php
                                        $countGuest = count($activity->guestSafety);
                                    @endphp
                                    @if ($countGuest > 5)
                                        <p>
                                            <a href="javascript:void(0)" onclick="showMoreActivityGuestSafety()">
                                                {{ __('user_page.Show more') }}
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @guest
                                <hr>
                                <!-- <h4>{{ __('user_page.Nearby Villas & Restaurant') }}</h4> -->

                                {{-- EDIT TO SWIPE CAROUSEL --}}

                                {{-- <div class="container-xxl mx-auto p-0">
                                    <div class="slick-pop-slider">
                                        <div class="Container2">
                                            <!-- <div class="row col-12 Arrows2"></div> -->
                                            <div class="Head">
                                                <h6><i class="fa-solid fa-house"></i></span>
                                                    {{ __('user_page.Villas') }} <span class="Arrows2"></span>
                                                </h6>
                                            </div>
                                            <!-- Carousel Container -->
                                            <div class="SlickCarousel2">
                                                @forelse ($nearby_villas as $item)
                                                    <!-- Item -->
                                                    <div class="ProductBlock">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a onclick="loginForm()" style="cursor: pointer;">
                                                                    <svg viewBox="0 0 32 32"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="presentation"
                                                                        focusable="false" class="favorite-button favorite-button-22"
                                                                        id="likeButton"
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
                                                                $cekVilla = App\VillaSave::where('id_villa', $item->detail->id_villa)
                                                                    ->where('id_user', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            @if ($cekVilla == null)
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button favorite-button-22 likeButtonvilla{{ $item->detail->id_villa }}"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $item->detail->id_villa }}"
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
                                                                <div class="img-fill">
                                                                    <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                        target="_blank">
                                                                        <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                            alt="{{ __('user_page.Villas') }}"
                                                                            loading="lazy">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                            <!-- akhir loop setiap gambar -->
                                                        </div>
                                                        <div class="bottom-fill grid-one-line max-lines">
                                                            <a href="{{ route('villa', $item->detail->id_villa) }}"
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
                                                            @if ($item->detail->price)
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    <span
                                                                        class="fw-600 ml-1 text-14 font-black list-description">
                                                                        {{ CurrencyConversion::exchangeWithUnit($item->detail->price) }}
                                                                        /
                                                                        {{ __('user_page.night') }}
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                    {{ __('user_page.Price is unknown') }}
                                                                </div>
                                                            @endif
                                                            <!-- change to real distance -->
                                                            <div class="text-grey-1 mt-1 text-13"><i
                                                                    class="fa-solid text-orange fa-location-dot"></i>
                                                                <span class="text-grey-1"><span class="text-grey-1"
                                                                        id="travelDistance"></span>{{ $item->kilometer }}
                                                                    {{ __('user_page.km from this activity') }}</span>
                                                            </div>
                                                            <div>
                                                                <p class="text-grey-1 mt-1 text-13">
                                                                    @if (($item->detail->eta_driving == null) & ($item->detail->eta_walking == null))
                                                                        <!-- <i class="fa-solid text-orange fas fa-plane"></i> -->
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
                                                                    @else
                                                                        <i class="fa-solid text-orange fa-car"></i> <span
                                                                            class="text-grey-1"
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
                                                                <span>{{ __('user_page.No villas found') }}</span>
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
                                                    {{ __('user_page.Restaurants') }}
                                                    <span class="Arrows1"></span>
                                                </h6>
                                            </div>
                                            <!-- Carousel Container -->
                                            <div class="SlickCarousel1">
                                                @forelse ($nearby_restaurant as $item)
                                                    <!-- Item -->
                                                    <div class="ProductBlock">
                                                        @guest
                                                            <div style="position: absolute; z-index: 99;">
                                                                <a onclick="loginForm()" style="cursor: pointer;">
                                                                    <svg viewBox="0 0 32 32"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="presentation"
                                                                        focusable="false" class="favorite-button favorite-button-22"
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
                                                                    <a onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button favorite-button-22 likeButtonrestaurant{{ $item->detail->id_restaurant }}"
                                                                            style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                            <path
                                                                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')"
                                                                        style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false"
                                                                            class="favorite-button-active favorite-button-22 unlikeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                <div class="img-fill">
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
                                                                        {{ __('user_page.km from this activity') }}</span>
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
                                                                        <!-- <i class="fa-solid text-orange fas fa-plane"></i> | -->
                                                                        <i class="fa-solid text-orange fas fa-ship"></i>
                                                                    @else
                                                                        <i class="fa-solid text-orange fa-car"></i> <span
                                                                            class="text-grey-1"
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
                                                                <span>{{ __('user_page.no restaurant found') }}</span>
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
                                    <!-- <h4>{{ __('user_page.Nearby Villas & Restaurant') }}</h4> -->

                                    {{-- EDIT TO SWIPE CAROUSEL --}}
                                    {{-- <div class="container-xxl mx-auto p-0">
                                        <div class="slick-pop-slider">
                                            <div class="Container2">
                                                <!-- <div class="row col-12 Arrows2"></div> -->
                                                <div class="Head">
                                                    <h6><i class="fa-solid fa-house"></i></span>
                                                        {{ __('user_page.Villas') }} <span class="Arrows2"></span>
                                                    </h6>
                                                </div>
                                                <!-- Carousel Container -->
                                                <div class="SlickCarousel2">
                                                    @forelse ($nearby_villas as $item)
                                                        <!-- Item -->
                                                        <div class="ProductBlock">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="loginForm()" style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false" class="favorite-button favorite-button-22"
                                                                            id="likeButton"
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
                                                                    $cekVilla = App\VillaSave::where('id_villa', $item->detail->id_villa)
                                                                        ->where('id_user', Auth::user()->id)
                                                                        ->first();
                                                                @endphp
                                                                @if ($cekVilla == null)
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button favorite-button-22 likeButtonvilla{{ $item->detail->id_villa }}"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_villa }}, 'villa')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button-active favorite-button-22 unlikeButtonvilla{{ $item->detail->id_villa }}"
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
                                                                    <div class="img-fill">
                                                                        <a href="{{ route('villa', $item->detail->id_villa) }}"
                                                                            target="_blank">
                                                                            <img src="{{ URL::asset('/foto/gallery/' . strtolower($item->detail->uid) . '/' . $itemPhoto->name) }}"
                                                                                alt="{{ __('user_page.Villas') }}"
                                                                                loading="lazy">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                <!-- akhir loop setiap gambar -->
                                                            </div>
                                                            <div class="bottom-fill grid-one-line max-lines">
                                                                <a href="{{ route('villa', $item->detail->id_villa) }}"
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
                                                                @if ($item->detail->price)
                                                                    <div
                                                                        class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                        <span
                                                                            class="fw-600 ml-1 text-14 font-black list-description">
                                                                            {{ CurrencyConversion::exchangeWithUnit($item->detail->price) }}
                                                                            /
                                                                            {{ __('user_page.night') }}
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="text-14 fw-400 text-grey-2 grid-one-line max-lines col-lg-10">
                                                                        {{ __('user_page.Price is unknown') }}
                                                                    </div>
                                                                @endif
                                                                <!-- change to real distance -->
                                                                <div class="text-grey-1 mt-1 text-13"><i
                                                                        class="fa-solid text-orange fa-location-dot"></i>
                                                                    <span class="text-grey-1"><span class="text-grey-1"
                                                                            id="travelDistance"></span>{{ $item->kilometer }}
                                                                        {{ __('user_page.km from this activity') }}</span>
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
                                                                    <span>{{ __('user_page.No villas found') }}</span>
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
                                                        {{ __('user_page.Restaurants') }}
                                                        <span class="Arrows1"></span>
                                                    </h6>
                                                </div>
                                                <!-- Carousel Container -->
                                                <div class="SlickCarousel1">
                                                    @forelse ($nearby_restaurant as $item)
                                                        <!-- Item -->
                                                        <div class="ProductBlock">
                                                            @guest
                                                                <div style="position: absolute; z-index: 99;">
                                                                    <a onclick="loginForm()" style="cursor: pointer;">
                                                                        <svg viewBox="0 0 32 32"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            aria-hidden="true" role="presentation"
                                                                            focusable="false" class="favorite-button favorite-button-22"
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
                                                                        <a onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button favorite-button-22 likeButtonrestaurant{{ $item->detail->id_restaurant }}"
                                                                                style="margin-left: 7px !important; margin-top: 7px !important;">
                                                                                <path
                                                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                                                </path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div style="position: absolute; z-index: 99;">
                                                                        <a onclick="likeFavorit({{ $item->detail->id_restaurant }}, 'restaurant')"
                                                                            style="cursor: pointer;">
                                                                            <svg viewBox="0 0 32 32"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                aria-hidden="true" role="presentation"
                                                                                focusable="false"
                                                                                class="favorite-button-active favorite-button-22 unlikeButtonrestaurant{{ $item->detail->id_restaurant }}"
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
                                                                    <div class="img-fill">
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
                                                                            {{ __('user_page.km from this activity') }}</span>
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
                                                                    <span>{{ __('user_page.no restaurant found') }}</span>
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
    </div>
    {{-- END FULL WIDTH ABOVE FOOTER --}}
    </div>
    {{-- MODAL --}}

    {{-- OTHER MODAL --}}
    @include('user.modal.activity.activity-guest-safety')
    @auth
        @if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $activity->created_by)
            {{-- @include('user.modal.restaurant.name') --}}
            {{-- @include('user.modal.restaurant.short_description') --}}

            {{-- @include('user.modal.restaurant.photo') --}}
            {{-- @include('user.modal.restaurant.menu') --}}
            @include('user.modal.activity.activity-guest-safety')
            @include('user.modal.activity.edit.edit-activity-rules')
            @include('user.modal.activity.edit.edit-activity-guest-safety')
            @include('user.modal.activity.facilities_add')
            @include('user.modal.activity.price')
            @include('user.modal.activity.location')
            @include('user.modal.activity.activity_profile')
            @include('user.modal.activity.story')
            @include('user.modal.activity.contact')
            {{-- @include('user.modal.activity.subcategory_add') --}}
            @include('user.modal.activity.edit_sub_category')
        @endif
        @include('user.modal.advert-listing')
    @endauth
    @include('user.modal.activity.description')
    {{-- END OTHER MODAL --}}

    {{-- script recomendation --}}
    {{-- <script>
        let villaRandom = @json($villaRandom);

        // console.log(villaRandom);

        let listUID = [];

        let myElement = document.getElementById('image'),
            imgList = [];

        let linkVilla = document.getElementById('linkVilla'),
            linkVilla2 = document.getElementById('linkVilla2'),
            listLink = [];

        let randomVillaName = document.getElementById('randomVillaName'),
            listNameVilla = [];

        let randomPriceVilla = document.getElementById('randomPriceVilla'),
            listPriceVilla = [];

        let randomBedVilla = document.getElementById('randomBedVilla'),
            listBedsVilla = [],
            listBathroomVilla = [],
            listBedroomVilla = [];

        let appendAmenities = document.getElementById('appendAmenities'),
            listAmenities = [];

        let shortDescVilla = document.getElementById('shortDescVillaRandom'),
            listShortDesc = [];

        for (let i = 0; i < villaRandom.length; i++)
        {
            imgList[i] = villaRandom[i].image;
            listLink[i] = villaRandom[i].id_villa;
            listNameVilla[i] = villaRandom[i].name;
            listPriceVilla[i] = villaRandom[i].price;
            listUID[i] = villaRandom[i].uid;
            listBedsVilla[i] = villaRandom[i].beds;
            listBathroomVilla[i] = villaRandom[i].bathroom;
            listBedroomVilla[i] = villaRandom[i].bedroom;
            listShortDesc[i] = villaRandom[i].short_description;

            //array untuk menampung sementara amenities berdasarkan villa random
            let arrayAmenities = [];

            //looping amenities dari setiap villa random
            for (let j = 0; j < villaRandom[i].amenities.length; j++)
            {
                arrayAmenities.push(villaRandom[i].amenities[j].icon);
            }

            listAmenities.push(arrayAmenities);
        }

        let timerSlider;

        function changeRandomVilla() {
            let timerSlider = setInterval(function() {
                randomAngka = Math.floor(Math.random() * villaRandom.length);
                myElement.src = '{{ URL::asset('/foto/gallery') }}' + '/' + listUID[randomAngka] + '/' +imgList[randomAngka];
                linkVillaHref = `/villa/${listLink[randomAngka]}`;
                linkVilla.href = linkVillaHref;
                linkVilla2.href = linkVillaHref;
                randomVillaName.innerHTML = listNameVilla[randomAngka];
                let tempShortDesc = listShortDesc[randomAngka] == null ? 'there is no short description yet' : listShortDesc[randomAngka];
                shortDescVilla.innerHTML = tempShortDesc.substring(0, 150);

                var formatter = new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'IDR',
                    });
                var price = formatter.format(listPriceVilla[randomAngka]).replace(/(\.0+|0+)$/, '');
                randomPriceVilla.innerHTML = price;

                let tempBed = listBedsVilla[randomAngka] == null ? '' : ', ' + listBedsVilla[randomAngka] + ' Beds';
                randomBedVilla.innerHTML = listBedroomVilla[randomAngka] + ' Bedroom, ' + listBathroomVilla[randomAngka] + ' Bathroom' + tempBed;

                $('#appendAmenities').html('');

                for (let h = 0; h < listAmenities[randomAngka].length; h++)
                {
                    $('#appendAmenities').append(`<span><i class='fa fa-${listAmenities[randomAngka][h]}'
                        style='color: #112B3C; border: none; font-size: 15px;'></i></span> `);
                }
            }, 3000);

            //when mouse hover stop random villa
            $('#sliderPopularVilla').hover(function(ev){
                clearInterval(timerSlider);
            }, function(ev){
                changeRandomVilla();
            });
        }

        changeRandomVilla();

    </script> --}}
    {{-- /end recomendation --}}

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
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true"
        style="border-radius: 10px;">
        <div class="modal-dialog modal-xl" role="document">
            <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal"
                aria-label="Close"></button>
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
        <div class="modal-dialog modal-dialog-amenities" role="document">
            <div class="modal-content modal-content-amenities" style="background: white; border-radius:25px">
                <div class="modal-header modal-header-amenities">
                    <h5 class="modal-title">{{ __('user_page.All Facilities') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="close_amenities()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-amenities pb-1 translate-text-group" id="contentModalFacilities">
                    @forelse ($activity->facilities as $item)
                        <div class='col-md-6 mb-3'>
                            <span class="translate-text-group-items">{{ $item->name }}</span>
                        </div>
                    @empty
                        <div class='col-md-12 mb-3'>
                            <span>{{ __('user_page.there is no facilities yet') }}</span>
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
                <div class="modal-body pb-1">
                    <form action="{{ route('activity_update_caption_photo') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_activity" value="{{ $activity->id_activity }}">
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

    {{-- MODAL TAGS --}}
    <div class="modal fade" id="modal-subcategory" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.All subcategories') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        onclick="close_subcategory()" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <div id="cuisineModalContent" class="row row-border-bottom padding-top-bottom-18px translate-text-group">
                        @foreach ($activity->subCategory as $item)
                            <div class='col-md-6'>
                                <span class="translate-text-group-items">
                                    {{ $item->name }}
                                </span>
                            </div>
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
    <div class="modal fade" id="modal-price" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-price-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                        alert(`{{ __('user_page.internal server error') }}`);
                    },
                    404: () => {
                        alert(`{{ __('user_page.No data found') }}`);
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
                        {{ __('user_page.Share this place with your friend and family') }}
                    </p>
                    <div class="d-flex gap-3 align-items-center py-3">
                        @if ($activity->image)
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/activity/' . strtolower($activity->uid) . '/' . $activity->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad imageProfileActivity">
                        @else
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad imageProfileActivity">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $activity->name }}</p>
                    </div>
                    <div>
                        @guest
                            <div class="modal-share-container">
                                <div class="col-lg col-12 p-3 border br-10">
                                    <a type="button" class="d-flex p-0 copier"
                                        href="{{ route('activity', $activity->id_activity) }}"
                                        onclick="copyURI(event)">
                                        {{ __('user_page.Copy Link') }}
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
                                    <a type="button" class="d-flex p-0 copier"
                                        href="{{ route('activity', $activity->id_activity) }}"
                                        onclick="copyURI(event)">
                                        {{ __('user_page.Copy Link') }}
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

    {{-- MODAL RESERVE II --}}
    <div class="modal fade" id="modal-reserve2" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">Reserve Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                        name="check_out" style="width:80%; border:0" placeholder="Add Date"
                                        readonly>
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
                        <div class="col-3"><img class="lozad" src="{{ LazyLoad::show() }}"
                                data-src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
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
                    <h5 class="modal-title">{{ $activity->name }} {{ __('user_page.Contact') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-1">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="col-11">
                            <b style="font-size: 15px;" class="price-box modal-content-phone">
                                {{ $activity->phone }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="col-11">
                            <b style="font-size: 15px;" class="price-box modal-content-email">
                                {{ $activity->email }}
                            </b>
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
                    <h5 class="modal-title">{{ __('user_page.FAQ') }}</h5>
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
                        <button type="submit" class="btn btn-primary">{{ __('user_page.Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('user.modal.auth.login_register')

    @include('layouts.user.footer')
    </div>
    {{-- END MODAL --}}

    <script>
        function loginForm() {
            $('#LoginModal').modal('show');
        }
    </script>


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
    <script src="{{ asset('assets/js/crud-wow.js') }}"></script>
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
        function editNameForm() {
            var form = document.getElementById("name-form");
            var content = document.getElementById("name-content");
            var contentMobile = document.getElementById("name-content-mobile");
            var formInput = document.getElementById("name-form-input");
            form.classList.add("d-block");
            content.classList.add("d-none");
            contentMobile.classList.add("d-none");

            if(formInput.value == 'Wow Name Here'){
                formInput.value = '';
            }
        }

        function editNameCancel() {
            var form = document.getElementById("name-form");
            var formInput = document.getElementById("name-form-input");
            var content = document.getElementById("name-content");
            var contentMobile = document.getElementById("name-content-mobile");
            form.classList.remove("d-block");
            content.classList.remove("d-none");
            contentMobile.classList.remove("d-none");
            formInput.value = '{{ $activity->name }}';

            if(formInput.value == 'Wow Name Here'){
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
            // formInput.value = '{{ $activity->short_description }}';

            if(formInput.value == 'Make your short description here'){
                formInput.value = '';
            }
        }
    </script>
    <script>
        function editTimeForm() {
            var form = $("#time-form");
            var content = $("#time-content");
            let id_activity = `{{ $activity->id_activity }}`;

            $.ajax({
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "/things-to-do/get/time",
                data: {
                    id_activity: id_activity,
                },
                success: function (response) {
                    console.log(response);

                    $("#open-time-input").val(response.data.open_time);
                    $("#close-time-input").val(response.data.closed_time);

                    $(form).show();
                    $(content).hide();
                }
            });
        }

        function editTimeFormMobile() {
            var form = $("#time-form-mobile");
            var content = $("#time-content-mobile");
            let id_activity = `{{ $activity->id_activity }}`;

            $.ajax({
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "/things-to-do/get/time",
                data: {
                    id_activity: id_activity,
                },
                success: function (response) {
                    console.log(response);

                    $("#open-time-input-mobile").val(response.data.open_time);
                    $("#close-time-input-mobile").val(response.data.closed_time);

                    $(form).show();
                    $(content).hide();
                }
            });
        }

        function editTimeFormCancel() {
            var form = $("#time-form");
            var content = $("#time-content");
            // var openTimeInput = $('.open-time-input');
            // var closeTimeInput = $('.close-time-input');
            // $(openTimeInput).val('{{ $activity->open_time }}');
            // $(closeTimeInput).val('{{ $activity->closed_time }}');
            $(form).hide();
            $(content).show();
        }

        function editTimeFormMobileCancel() {
            var form = $("#time-form-mobile");
            var content = $("#time-content-mobile");
            // var openTimeInput = $('.open-time-input');
            // var closeTimeInput = $('.close-time-input');
            // $(openTimeInput).val('{{ $activity->open_time }}');
            // $(closeTimeInput).val('{{ $activity->closed_time }}');
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
            // formInput.value = '{{ $activity->description }}';
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
                    var value = $('form#formData #id_activity').val();
                    formData.append('id_activity', value);
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
            var $footerOffsetTop = $(".stopper").offset().top + 1140;
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
        jQuery(document).ready(function($){
            $(window).on('scroll', function(){
                if($(window).scrollTop() >= $('#gallery').offset().top - 80 && $(window).scrollTop() <= $('#price').offset().top - 60){
                    $('#gallery-sticky').addClass('active-sticky');
                    $('#price-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                }
                    else if($(window).scrollTop() >= $('#price').offset().top - 60  && $(window).scrollTop() <= $('#description').offset().top - 60){
                        $('#gallery-sticky').removeClass('active-sticky');
                        $('#price-sticky').addClass('active-sticky');
                        $('#about-sticky').removeClass('active-sticky');
                        $('#amenities-sticky').removeClass('active-sticky');
                        $('#location-sticky').removeClass('active-sticky');
                        $('#review-sticky').removeClass('active-sticky');
                    } else if($(window).scrollTop() >= $('#description').offset().top - 60  && $(window).scrollTop() <= $('#amenities').offset().top - 60){
                        $('#gallery-sticky').removeClass('active-sticky');
                        $('#price-sticky').removeClass('active-sticky');
                        $('#about-sticky').addClass('active-sticky');
                        $('#amenities-sticky').removeClass('active-sticky');
                        $('#location-sticky').removeClass('active-sticky');
                        $('#review-sticky').removeClass('active-sticky');
                    } else if($(window).scrollTop() >= $('#amenities').offset().top - 60 && $(window).scrollTop() <= $('#location-map').offset().top - 60){
                        $('#gallery-sticky').removeClass('active-sticky');
                        $('#price-sticky').removeClass('active-sticky');
                        $('#about-sticky').removeClass('active-sticky');
                        $('#amenities-sticky').addClass('active-sticky');
                        $('#location-sticky').removeClass('active-sticky');
                        $('#review-sticky').removeClass('active-sticky');
                    } else if($(window).scrollTop() >= $('#location-map').offset().top -60  && $(window).scrollTop() <= $('#review').offset().top - 60){
                        $('#gallery-sticky').removeClass('active-sticky');
                        $('#price-sticky').removeClass('active-sticky');
                        $('#about-sticky').removeClass('active-sticky');
                        $('#amenities-sticky').removeClass('active-sticky');
                        $('#location-sticky').addClass('active-sticky');
                        $('#review-sticky').removeClass('active-sticky');
                    } else if($(window).scrollTop() >= $('#review').offset().top - 60 && $(window).scrollTop() <= $('#endSticky').offset().top - 60){
                        $('#gallery-sticky').removeClass('active-sticky');
                        $('#price-sticky').removeClass('active-sticky');
                        $('#about-sticky').removeClass('active-sticky');
                        $('#amenities-sticky').removeClass('active-sticky');
                        $('#location-sticky').removeClass('active-sticky');
                        $('#review-sticky').addClass('active-sticky');
                    }
                else {
                    $('#gallery-sticky').removeClass('active-sticky');
                    $('#price-sticky').removeClass('active-sticky');
                    $('#about-sticky').removeClass('active-sticky');
                    $('#amenities-sticky').removeClass('active-sticky');
                    $('#location-sticky').removeClass('active-sticky');
                    $('#review-sticky').removeClass('active-sticky');
                    //or use $('.menu').removeClass('addclass');
                }
            });
        });
    </script>

    {{-- MODAL Reorder image --}}
    <div class="modal fade" id="edit_position_photo" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header" style="padding-left: 18px;">
                    <h7 class="modal-title" style="font-size: 1.875rem;">
                        {{ __('user_page.Edit Position Photos') }}</h7>
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $activity->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-photo">
                        @forelse ($activity->photo->sortBy('order') as $item)
                            @php
                                $id = $item->id_photo;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <img class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ asset('foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}"
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
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i style="font-size: 22px;" class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-1">

                    {{-- <input type="hidden" name="id_owner" value="{{ $activity->created_by }}"> --}}
                    {{-- reorder image --}}
                    <ul id="sortable-video">
                        @forelse ($activity->video->sortBy('order') as $item)
                            @php
                                $id = $item->id_video;
                                $name = $item->name;
                            @endphp
                            <li class="ui-state-default" data-id="{{ $id }}">
                                <video class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ asset('foto/activity/' . strtolower($activity->uid) . '/' . $item->name) }}#t=1.0">
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
                        url: `/things-to-do/${ids.id}/delete/image`,
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

    {{-- Sweetalert Function Delete Story --}}
    <script>
        function delete_activity_story(ids) {
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
                        url: `/things-to-do/${ids.id}/delete/story/${ids.id_story}`,
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
                        url: `/things-to-do/${ids.id}/delete/photo/photo/${ids.id_photo}`,
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
                        url: `/things-to-do/${ids.id}/delete/photo/video/${ids.id_video}`,
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
                        url: `/things-to-do/request/video/${ids.id}/${ids.name}`,
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

    <script>
        $("#clear_date_wow").click(function() {
            // $("#check_in2").val("");
            $("#start_date").val("");
            $("#end_date").val("");
            document.getElementById('add_date_wow').style.display = "block";
            calendar_wow(2);
        });
    </script>

    <script>
        function calendar_wow(months) {
            if (!$("#start_date").val()) {
                var check_in_val = "";
            } else {
                var check_in_val = $("#start_date").val();
            }

            if (!$("#end_date").val()) {
                var check_out_val = "";
            } else {
                var check_out_val = $("#end_date").val();
            }
            $('#date_wow').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                inline: true,
                mode: "range",
                defaultDate: [check_in_val, check_out_val],
                showMonths: months,
                onChange: function(selectedDates, dateStr, instance) {
                    // $('#date_things').val(flatpickr.formatDate("Y-m-d"));
                    let from = instance.formatDate(selectedDates[0], "Y-m-d");
                    let to = instance.formatDate(selectedDates[1], "Y-m-d");
                    $('#start_date').val(from);
                    $('#end_date').val(to);
                    let content = document.getElementById("popup_wow");
                    content.style.display = "none";
                    document.getElementById('add_date_wow').style.display = "none";
                }
            });
        }
        calendar_wow(2);
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
    <script>
        $(document).ready(function() {
            $('.SlickCarousel3').slick({
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                centerMode: false,
                appendArrows: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        // centerMode: true,

                    }

                }, {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        infinite: true,

                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 2000,
                    }
                }]
            });
        });
    </script>
    <script>
        (function() {
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
    </script>

    @include('components.lazy-load.lazy-load')
    @include('components.promotion.mobile-app')

    {{-- Like --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like --}}

    @include('components.lazy-load.lazy-load')
    <script src="{{ asset('assets/js/translate.js') }}"></script>

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

    <script>
        function editSubcategory() {
            $('#modal-add_subcategory').modal('show');
        }
    </script>

    @if ($activity->status == '2' && auth()->user()->id == $activity->created_by)
        <script>
            if(!localStorage.getItem("shareAdver") || localStorage.getItem("shareAdver") != 'true'){
                var myModal = new bootstrap.Modal(document.getElementById('advertListing-Modal'), {})
                myModal.show()
            }
        </script>
    @endif
</body>
