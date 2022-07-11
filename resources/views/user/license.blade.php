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

            .mobile-social-share span, .mobile-social-share i {
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

        /* Responshive 480 px > */
        @media screen and (max-width: 480px) {
            .page-content {
                margin-top: 0;
                padding: 0;
            }

            .rsv, header .villa-list-header-logo, header .search-box, header .right-bar, .social-share {
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
        }

        @media screen and (min-width: 481px) {
            .header-mobile {
                display: none;
            }
        }

    </style>

    {{-- GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}

    {{-- END GOOGLE MAP AUTOCOMPLETE LIST ZINDEX --}}
</head>

<body style="background-color:white">

    <div id="page-container">
        {{-- HEADER --}}
        <header id="add_class_popup" class="">
            <div class="head-inner-wrap">
                @include('layouts.user.header')
            </div>
        </header>
        {{-- END HEADER --}}
        <div class="row page-content">
            {{-- LEFT CONTENT --}}
            <div class="col-12 rsv-block">
                <div class="row top-profile">
                    <div class="col-lg-8 pt-2 ml-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">License</a></li>
                            </ol>
                        </nav>
                        <br>

                        <small class="text-muted">Legal Terms</small>

                        <div class="privacy-title mb-4"><h2>License</h2>
                        </div>

                        <div class="privacy-description">

                            {{-- <p class="mb-3 text-dark text-justify" style="font-size: 16pt"><b>Terms of Service for Non-European Users</b></p> --}}

                            {{-- <p class="lead">Last Updated: February 10, 2022</p> --}}
                            <p class="mb-3 text-dark text-justify" style="font-size: 11pt">The EZV Platform offers an online venue that enables users (“Members”) to publish, offer, search for, and book services. Members who publish and offer services are “Hosts” and Members who search for, book, or use services are “Guests.” Hosts offer accommodations (“Accommodations”), activities, excursions, and events (“Experiences”), and a variety of travel and other services (collectively, “Host Services,” and each Host Service offering, a “Listing”). You must register an account to access and use many features of the EZV Platform, and must keep your account information accurate. As the provider of the EZV Platform, EZV does not own, control, offer or manage any Listings or Host Services. EZV is not a party to the contracts entered into directly between Hosts and Guests, nor is EZV a real estate broker, travel agency, or insurer. EZV is not acting as an agent in any capacity for any Member, except as specified in the Payments Terms of Service (“Payment Terms”). To learn more about EZV’s role see Section 16.</p>

                            <p class="mb-3 text-dark text-justify" style="font-size: 11pt">The EZV Platform offers an online venue that enables users (“Members”) to publish, offer, search for, and book services. Members who publish and offer services are “Hosts” and Members who search for, book, or use services are “Guests.” Hosts offer accommodations (“Accommodations”), activities, excursions, and events (“Experiences”), and a variety of travel and other services (collectively, “Host Services,” and each Host Service offering, a “Listing”). You must register an account to access and use many features of the EZV Platform, and must keep your account information accurate. As the provider of the EZV Platform, EZV does not own, control, offer or manage any Listings or Host Services. EZV is not a party to the contracts entered into directly between Hosts and Guests, nor is EZV a real estate broker, travel agency, or insurer. EZV is not acting as an agent in any capacity for any Member, except as specified in the Payments Terms of Service (“Payment Terms”). To learn more about EZV’s role see Section 16.</p>

                            <p class="mb-3 text-dark text-justify" style="font-size: 11pt">We maintain other terms and policies that supplement these Terms like our Privacy Policy, which describes our collection and use of personal data, and our Payments Terms, which govern any payment services provided to Members by the EZV payment entities (collectively "EZV Payments").</p>

                            <p class="mb-3 text-dark text-justify" style="font-size: 11pt">If you are a Host, you are responsible for understanding and complying with all laws, rules, regulations and contracts with third parties that apply to your Host Services.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- FULL WIDTH ABOVE FOOTER --}}

    </div>
    {{-- END FULL WIDTH ABOVE FOOTER --}}

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

    <script>
        $("#searchbox").click(function () {
            $("#search_bar").toggleClass("active");
        });

    </script>

    {{-- END CONTACT HOST --}}
    {{-- DROPZONE JS --}}
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}

</body>
