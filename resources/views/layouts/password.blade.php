<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborator Program in Brief - EZV</title>
    <meta name="description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}"> -->

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .card-header{
            background-color: #222222 !important;
            color: white !important;
        }
        .card-body {
            background-color: #fff;
        }
        @media only screen and (max-width: 425px) {
            .card {
                max-width: 90%;
                margin: 0 auto;
                padding: 10px;
            }
            .forget-header {
            padding: 0 1rem !important;
            }
        }
        .forget-header {
            width: 100%;
            height: 70px;
            background: #000;
            padding: 0 7rem;
        }
        .collab-body {
            background: #fff;
            width: 100%;
            padding: 110px 110px;
        }
        .bg-black {
            display: block;
            height: 87px;
            background: #000;
        }
        .collab-button {
            padding: 12px 20px;
            border: solid 1px #ff7400;
            border-radius: 12px;
            background: #000;
            color: #fff;
        }
        .right-image img {
            object-fit: cover;
            max-width: 100%;
            aspect-ratio: 16/11;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .fix-header {
            position: fixed;
            top: 0;
            width: 100%;
            transition: all 1s ease 0s;
        }
        .w-logo {
            width: 90px;
        }
        .header {
            box-sizing: border-box; 
            background-color: #000000;
            z-index: 999;
        }
        @media only screen and (min-width: 426px) and (max-width: 768px) {
            .w-logo {
            width: 80px;
            }
            .collab-body {
                padding: 30px 20px;
            } 
        }
        @media only screen and (max-width: 320px) {
            .w-logo {
            width: 50px;
            } 
        }
        @media only screen and (max-width: 425px) {
            .collab-body {
                padding: 30px 15px;
            }
        }
        @media only screen and (min-width: 321px) and (max-width: 425px) {
            .w-logo {
            width: 60px;
            } 
        }

        @media only screen and (min-width: 1367px) {
            .collab-body {
                max-width: 1367px;
                margin: 0 auto;
            }
        }
        .btn-primary {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div id="page-container">
     {{-- navbar --}}
    <section id="header-container" class="header">
        <!-- Header -->
        <div class="expand-navbar-mobile" aria-expanded="false">
            <div class="px-3 pt-2">
                @auth
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="flex-fill d-flex align-items-center me-3">
                                @if (Auth::user()->avatar)
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2" alt=""
                                        style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                                @else
                                    <img class="lozad user-avatar" src="{{ LazyLoad::show() }}"
                                        data-src="{{ asset('assets/icon/menu/user_default.svg') }}" alt=""
                                        style="border-radius: 50%">
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
                        {{-- @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                            <a class="d-block mb-2 collab-expand" href="{{ route('collaborator_list') }}"
                                style="width: fit-content; color:#585656;">
                                {{ __('user_page.Collabs') }}
                            </a>
                        @endif --}}
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

                        <a href="{{ route('switch') }}" class="navbar-gap d-block mb-2"
                            style="color:#585656; width: fit-content;">
                            {{ __('user_page.Switch to hosting') }}
                        </a>
                        <hr>
                        <div class="d-flex align-items-center mb-2">
                            <a type="button" onclick="language()" class="navbar-gap d-flex align-items-center"
                                style="color: white;">
                                @if (session()->has('locale'))
                                    <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img style="width: 27px;" src="{{ URL::asset('assets/flags/flag_en.svg') }}">
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
                            <a type="button" onclick="view_LoginModal();" href="#"
                                class="btn btn-fill border-0 d-flex align-items-center btn-login"
                                style="color: #ddd; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
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
                    <div class="d-flex align-items-center">
                        <a type="button" onclick="language()" class="navbar-gap d-blok d-flex align-items-center"
                            style="color: white; margin-right: 9px;" id="language">
                            @if (session()->has('locale'))
                                <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                            @else
                                <img style="border-radius: 3px; width: 27px;" class="lozad" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                            @endif
                            <p class="mb-0 ms-2" style="color: #585656">Choose Language</p>
                        </a>
                    </div>
                @endauth
            </div>

        </div>
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative"
            style="font-family: 'Poppins', sans-serif">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark">
                <div class="collapse navbar-collapse navbar-dekstop" id="navbarTogglerDemo">
                    <div id="navbar-first-dekstop" class="col-lg-4 d-flex align-items-center">
                        <a href="{{ route('index') }}">
                            <img class="w-logo" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                        <div id="navbar-collapse-button" class="flex-fill d-flex justify-content-end">
                            <button class="navbar-toggler" type="button" id="expand-mobile-btn">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                    {{-- Jangan Dihapus --}}
                    <div class="col-lg-4">
                        <div id="ul" class="ul-display-block"></div>
                    </div>
                    {{-- / Jangan Dihapus --}}

                    <div id="nav-end-dekstop" class="col-lg-4 ms-auto"
                        style="display: flex; align-items: center; justify-content: flex-end;">
                        @auth
                            <div class="d-flex" style="display: inline-block; align-items: center;">
                                <a href="{{ route('switch') }}" class="navbar-gap" style="color: #b9b9b9;">
                                    {{ __('user_page.Switch to hosting') }}
                                </a>

                                <a type="button" onclick="language()" class="navbar-gap"
                                    style="color: white; width:27px;">
                                    @if (session()->has('locale'))
                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                    @else
                                        <img class="lozad" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                    @endif
                                </a>

                                <div class="d-flex user-logged nav-item dropdown navbar-gap no-arrow">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @if (Auth::user()->avatar)
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ Auth::user()->avatar }}" class="user-photo mt-n2"
                                                alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px; border: solid 2px #ff7400;">
                                        @else
                                            <img class="lozad" src="{{ LazyLoad::show() }}"
                                                data-src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                                class="user-photo" alt=""
                                                style="border-radius: 50%; width: 50px; height: 50px;">
                                        @endif

                                        <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                            aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                            <h6 class="dropdown-header d-flex align-items-center">
                                                @if (Auth::user()->foto_profile != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                                @elseIf (Auth::user()->avatar != null)
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ Auth::user()->avatar }}">
                                                @else
                                                    <img class="dropdown-user-img lozad" src="{{ LazyLoad::show() }}"
                                                        data-src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                                @endif
                                                <div class="dropdown-user-details">
                                                    <div class="dropdown-user-details-name">
                                                        {{ Auth::user()->first_name }}
                                                        {{ Auth::user()->last_name }}</div>
                                                    <div class="dropdown-user-details-email">{{ Auth::user()->email }}
                                                    </div>
                                                </div>
                                            </h6>
                                            @php
                                                $role = Auth::user()->role_id;
                                            @endphp
                                            @if ($role == 1 || $role == 2 || $role == 3)
                                                <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                                    {{ __('user_page.Dashboard') }}
                                                </a>
                                            @endif
                                            @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                                <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                                    {{ __('user_page.Collabs') }}
                                                </a>
                                            @endif
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
                            </div>
                        @else
                            <a type="button" onclick="language()" class="navbar-gap"
                                style="color: white; margin-right: 9px; width:27px;" id="language">
                                @if (session()->has('locale'))
                                    <img style="border-radius: 3px; height: 23px;" class="lozad"
                                        src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                                @else
                                    <img style="border-radius: 3px;" class="lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                                @endif
                            </a>
                            <a type="button" onclick="view_LoginModal();" href="#{{-- {{ route('login') }} --}}"
                                class="btn btn-fill border-0 navbar-gap"
                                style="color: #ffffff; margin-right: 0px; padding-top: 15px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

        </div>
    </section>
    <section class="collab-body">
		@yield('content')
    </section>
    {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        {{-- modal laguage and currency --}}

        {{-- modal login --}}
        @include('user.modal.auth.login_register')
        {{-- @include('user.modal.user.bar_modal') --}}

        <!-- Footer -->
        @include('layouts.user.footer')
        <!-- END Footer -->
</div>
    <!-- END Page Container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

    <script>
        //Sticky Bar
        $(function(){
        $(window).scroll(function(){
            var winTop = $(window).scrollTop();
            if(winTop >= 100){
            $("#header-container").addClass("fix-header");
            }else{
            $("#header-container").removeClass("fix-header");
            }
            });
        });
    </script>

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('assets/js/view-villa.js') }}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-slick']);

    </script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-magnific-popup']);

    </script>

    <!-- Tambahan -->
    <script src="{{ asset('assets/js/home.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
                if (window.scrollY == 0 && window.innerWidth <= 991) {
                    document.getElementById("ul").style.display = "none";
                }
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                })
                $("#expand-mobile-btn").on("click", function() {
                    $("body").css({
                        "height": "100%",
                        "overflow": "hidden"
                    })
                    $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "true");
                })
                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest').removeClass("display-none");
                    $('#sugest').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#loc_sugest").on('keyup change', async () => {
                    var close = $(".sugest-list-first");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty").eq(0).hide();

                    var formValue = $("#loc_sugest").val();
                    var isEmpty = true;

                    $(".sugest-list").map((data) => {
                        var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                            .children('a').text();
                        if (name.toLowerCase().includes(formValue.toLowerCase())) {
                            $(".sugest-list").eq(data).show();
                            isEmpty = false;
                        }
                    });

                    if (isEmpty) {
                        $(".sugest-list-empty").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op").on('click', function(e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                });
            });
        </script>

        <script>
            function language() {
                $('#LegalModal').modal('show');
            }
        </script>
        <script>
            function view_LoginModal() {
                $('#LoginModal').modal('show');
            }
        </script>

        {{-- LAZY LOAD --}}
        @include('components.lazy-load.lazy-load')
        {{-- END LAZY LOAD --}}
    @yield('scripts')
</body>

</html>