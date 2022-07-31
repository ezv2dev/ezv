<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link href="{{ asset('assets/partner/css/styles.css') }}" rel="stylesheet" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">

    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous">
    </script>

    <style>
        .loading-splash-screen {
            background-color: white !important;
            height: 100%;
            position: fixed;
            z-index: 9999;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link {
            color: #092a33;
            transition: 0.3s;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-link.active {
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started {
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: 500;
        }

        .navbar-1-1 .btn-get-started-blue {
            background-color: #ff7400;
            transition: 0.3s;
        }

        .navbar-1-1 .btn-get-started-blue:hover {
            background-color: #FF7400;
            transition: 0.3s;
        }

        .borderr:hover {
            background-color: #eff3f9;
            border-radius: 30px;
            border-bottom: none !important;
        }

        .border-bottom {
            border-bottom: 2px solid #222222 !important;
        }


        li.active a.nav-link-insight:before,
        a.nav-link-insight:hover:before {
            visibility: visible;
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
        }

        ul.nav-insight {
            list-style-type: none;
        }

        a.nav-link-insight {
            position: relative;
            color: #FF7400;
            text-decoration: none;
        }

        a.nav-link-insight:visited {
            color: #FF7400;
            text-decoration: none;
        }

        a.nav-link-insight:hover {
            color: #FF7400;
            text-decoration: none;
        }

        a.nav-link-insight:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #FF7400;
            visibility: hidden;
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
        }

        li.active a:before,
        a.nav-link-insight:hover:before {
            visibility: visible;
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
        }

        .active {
            font-weight: 600 !important;
        }

        .rate {
            border-radius: 50% !important;
            width: 30px;
            height: 30px;
            font-weight: bold;
            margin-left: -240px !important;
            margin-top: 50px !important;
            box-shadow: none !important;
        }

        .border-bottom2 {
            border-bottom: 2px solid #FF7400;
        }

        .black {
            color: black !important;
        }

        a:hover {
            color: #ff7400 !important;
        }
    </style>

    <style>
        .fix-search {
            position: fixed;
            top: 10px;
        }

        .margin-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .sticky {
            position: fixed;
            top: 56px;
            width: 100%;
            height: 55px;
            z-index: 1022;

        }

        .menubar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            background: #fff;
            z-index: 999;
            padding-top: 20px;
            height: 110px;
        }

        .orange {
            color: #ff7400;
        }
    </style>

</head>

<body class="nav-fixed">
    @component('components.loading.loading-type1')
    @endcomponent

    {{-- <nav class="fixed-top shadow bg-white navbar-1-1 navbar navbar-expand-lg navbar-light p-4 px-md-4" --}}
    <nav class="navbar-1-1 navbar navbar-expand-lg navbar-light p-4" style="margin-bottom:-2%;">
        <div class="container">
            <a href="" class="navbar-brand mb-n1" target="_blank">
                <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb-lg-0">
                </ul>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown no-caret mr-3 d-none d-md-inline">
                        <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up"
                            aria-labelledby="navbarDropdownDocs">
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Documentation</div>
                                    Usage instructions and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Components</div>
                                    Code snippets and reference
                                </div>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog"
                                target="_blank">
                                <div class="icon-stack bg-primary-soft text-primary mr-4"><i
                                        data-feather="file-text"></i></div>
                                <div>
                                    <div class="small text-gray-500">Changelog</div>
                                    Updates and changes
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-3 d-md-none">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                data-feather="search"></i></a>
                        <!-- Dropdown - Search-->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100">
                                <div class="input-group input-group-joined input-group-solid">
                                    <input class="form-control" type="text" placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2" />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i data-feather="search"></i></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                            href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            @if (Auth::user()->foto_profile != null)
                                <img class="img-fluid" src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                            @elseIf (Auth::user()->avatar != null)
                                <img class="img-fluid" src="{{ Auth::user()->avatar }}">
                            @else
                                <img class="img-fluid" src="{{ asset('assets/icon/menu/user_default.svg') }}">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                            aria-labelledby="navbarDropdownUserImage">
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
                            <a class="dropdown-item" href="#!"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                                style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <hr>
        @yield('content_admin')
        @include('new-admin.layouts.footer')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/partner/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/partner/assets/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".list-menu-slider").slick({
                rtl: false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay: false,
                autoplaySpeed: 5000, //  Slide Delay
                speed: 500, // Transition Speed
                slidesToShow: 6, // Number Of Carousel
                slidesToScroll: 1, // Slide To Move
                pauseOnHover: false,
                // appendArrows:$(".Arrows"), // Class For Arrows Buttons
                prevArrow: '<span class="Slick-Prev"></span>',
                nextArrow: '<span class="Slick-Next"></span>',
                easing: "linear",
                responsive: [{
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 1536,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                ],
            })
        })
    </script>

    <script>
        function language() {
            $('#ModalLanguage').modal('show');
        }

        function currency() {
            $('#ModalCurrency').modal('show');
        }
    </script>

    @yield('scripts')

    <script src='https://kenwheeler.github.io/slick/slick/slick.js'></script>
</body>

</html>
