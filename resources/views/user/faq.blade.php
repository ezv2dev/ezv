<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions - EZV</title>
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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header_minimaliste.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        .accordion .accordion-header:after {
            font-family: 'FontAwesome';  
            content: "\f077";
            float: right; 
        }
        .accordion .accordion-header.collapsed:after {
            content: "\f078"; 
        }
        .nav-item a img {
            height: auto;
            margin-right: 10px;
        }
        .homes, .hotel, .food {
            filter: invert(100%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);
            width: 20px;
        }
        .food {
            width: 16px;
        }
        .wow {
            width: 20px;
        }
        .accordion-header {
            margin-bottom: 0;
            background: #dfdfdf;
            padding: 1rem 1.25rem;
            border-bottom: solid 1px #fff;
            cursor: pointer;
        }
        .accordion-title {
            color: #5e5d5d !important;
            font-weight: 600;
        }
        .accordion-title:hover {
            color: #000 !important;
        }
        .nav-link.active {
            outline: none;
            border-top: solid 1px #dfdfdf;
            border-left: solid 1px #dfdfdf;
            border-right: solid 1px #dfdfdf;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            background: #dfdfdf;
        }
        .nav-link.active:hover, .nav-link.active:focus, .nav-link.active:target, .nav-link.active:visited {
            border-top: solid 1px #dfdfdf !important;
            border-left: solid 1px #dfdfdf !important;
            border-right: solid 1px #dfdfdf !important;
            background: #dfdfdf !important;
        }
        .nav-link, .nav-link:hover, .nav-link:active, .nav-link:focus, .nav-link:target {
            color: #000;
            font-weight: 400;
        }
        .card {
            border-top-left-radius: 0;
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        .card2 {
            border-radius: 0.25rem;
            border: solid 1px #dfdfdf;
            outline: none;
        }

        .last {
            border-bottom: none !important;
        }
    </style>
</head>
<body>
<div id="page-container">
     {{-- navbar --}}
     <section id="header-container" class="header">
        <!-- Header -->
        @include('layouts.user.header_minimaliste')
    </section>
    <section class="collab-body">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">FAQ</a></li>
        </ol>
    </nav>
    <br>

    <small class="text-muted">What You Need To Know</small>

    <div class="privacy-title mb-4"><h2>Frequently Asked Questions [FAQ]</h2>
    </div>
    <div class="privacy-description">
        <h3>Main Services</h3>
        <!-- Tabs Navigation -->
        <ul class="nav navi-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><img class="homes" src="{{ asset('assets/icon/menu/homes.svg') }}">Homes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"><img class="food" src="{{ asset('assets/icon/menu/food.svg') }}">Food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"><img class="hotel" src="{{ asset('assets/icon/menu/hotel.svg') }}">Hotel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab"><img class="wow" src="{{ asset('assets/icon/menu/wow.svg') }}">WoW</a>
            </li>
        </ul>
        <!-- Tab pane homes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div id="accordion" class="accordion">
                    <div class="card mb-0">
                        <div class="accordion-header collapsed" data-toggle="collapse" href="#home1">
                            <a class="accordion-title">
                                Question 1
                            </a>
                        </div>
                        <div id="home1" class="accordion-body collapse" data-parent="#accordion">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home2">
                            <a class="accordion-title">
                            Question 2
                            </a>
                        </div>
                        <div id="home2" class="accordion-body collapse" data-parent="#accordion">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home3">
                            <a class="accordion-title">
                            Question 3
                            </a>
                        </div>
                        <div id="home3" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home4">
                            <a class="accordion-title">
                            Question 4
                            </a>
                        </div>
                        <div id="home4" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home5">
                            <a class="accordion-title">
                            Question 5
                            </a>
                        </div>
                        <div id="home5" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home6">
                            <a class="accordion-title">
                            Question 6
                            </a>
                        </div>
                        <div id="home6" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home7">
                            <a class="accordion-title">
                            Question 7
                            </a>
                        </div>
                        <div id="home7" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home8">
                            <a class="accordion-title">
                            Question 8
                            </a>
                        </div>
                        <div id="home8" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#home9">
                            <a class="accordion-title">
                            Question 9
                            </a>
                        </div>
                        <div id="home9" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion" href="#home10">
                            <a class="accordion-title">
                            Question 10
                            </a>
                        </div>
                        <div id="home10" class="collapse" data-parent="#accordion">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs pane Food -->
            <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div id="accordion2" class="accordion">
                    <div class="card mb-0">
                        <div class="accordion-header collapsed" data-toggle="collapse" href="#food1">
                            <a class="accordion-title">
                                Question 1
                            </a>
                        </div>
                        <div id="food1" class="accordion-body collapse" data-parent="#accordion2">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food2">
                            <a class="accordion-title">
                            Question 2
                            </a>
                        </div>
                        <div id="food2" class="accordion-body collapse" data-parent="#accordion2">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food3">
                            <a class="accordion-title">
                            Question 3
                            </a>
                        </div>
                        <div id="food3" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food4">
                            <a class="accordion-title">
                            Question 4
                            </a>
                        </div>
                        <div id="food4" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food5">
                            <a class="accordion-title">
                            Question 5
                            </a>
                        </div>
                        <div id="food5" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food6">
                            <a class="accordion-title">
                            Question 6
                            </a>
                        </div>
                        <div id="food6" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food7">
                            <a class="accordion-title">
                            Question 7
                            </a>
                        </div>
                        <div id="food7" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food8">
                            <a class="accordion-title">
                            Question 8
                            </a>
                        </div>
                        <div id="food8" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food9">
                            <a class="accordion-title">
                            Question 9
                            </a>
                        </div>
                        <div id="food9" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion2" href="#food10">
                            <a class="accordion-title">
                            Question 10
                            </a>
                        </div>
                        <div id="food10" class="collapse" data-parent="#accordion2">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs pane Hotel -->
            <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div id="accordion3" class="accordion">
                    <div class="card mb-0">
                        <div class="accordion-header collapsed" data-toggle="collapse" href="#hotel1">
                            <a class="accordion-title">
                                Question 1
                            </a>
                        </div>
                        <div id="hotel1" class="accordion-body collapse" data-parent="#accordion3">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel2">
                            <a class="accordion-title">
                            Question 2
                            </a>
                        </div>
                        <div id="hotel2" class="accordion-body collapse" data-parent="#accordion3">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel3">
                            <a class="accordion-title">
                            Question 3
                            </a>
                        </div>
                        <div id="hotel3" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel4">
                            <a class="accordion-title">
                            Question 4
                            </a>
                        </div>
                        <div id="hotel4" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel5">
                            <a class="accordion-title">
                            Question 5
                            </a>
                        </div>
                        <div id="hotel5" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel6">
                            <a class="accordion-title">
                            Question 6
                            </a>
                        </div>
                        <div id="hotel6" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel7">
                            <a class="accordion-title">
                            Question 7
                            </a>
                        </div>
                        <div id="hotel7" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel8">
                            <a class="accordion-title">
                            Question 8
                            </a>
                        </div>
                        <div id="hotel8" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel9">
                            <a class="accordion-title">
                            Question 9
                            </a>
                        </div>
                        <div id="hotel9" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion3" href="#hotel10">
                            <a class="accordion-title">
                            Question 10
                            </a>
                        </div>
                        <div id="hotel10" class="collapse" data-parent="#accordion3">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs pane WoW -->
            <div class="tab-pane" id="tabs-4" role="tabpanel">
            <div id="accordion4" class="accordion">
                    <div class="card mb-0">
                        <div class="accordion-header collapsed" data-toggle="collapse" href="#wow1">
                            <a class="accordion-title">
                                Question 1
                            </a>
                        </div>
                        <div id="wow1" class="accordion-body collapse" data-parent="#accordion4">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow2">
                            <a class="accordion-title">
                            Question 2
                            </a>
                        </div>
                        <div id="wow2" class="accordion-body collapse" data-parent="#accordion4">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow3">
                            <a class="accordion-title">
                            Question 3
                            </a>
                        </div>
                        <div id="wow3" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow4">
                            <a class="accordion-title">
                            Question 4
                            </a>
                        </div>
                        <div id="wow4" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow5">
                            <a class="accordion-title">
                            Question 5
                            </a>
                        </div>
                        <div id="wow5" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow6">
                            <a class="accordion-title">
                            Question 6
                            </a>
                        </div>
                        <div id="wow6" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow7">
                            <a class="accordion-title">
                            Question 7
                            </a>
                        </div>
                        <div id="wow7" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow8">
                            <a class="accordion-title">
                            Question 8
                            </a>
                        </div>
                        <div id="wow8" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow9">
                            <a class="accordion-title">
                            Question 9
                            </a>
                        </div>
                        <div id="wow9" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                        <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion4" href="#wow10">
                            <a class="accordion-title">
                            Question 10
                            </a>
                        </div>
                        <div id="wow10" class="collapse" data-parent="#accordion4">
                            <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Navigation -->
        <hr>
        <h3>Booking, Payment & Cancelation</h3>
        <div id="accordion5" class="accordion">
            <!-- FAQ Booking, Payment & Cancelation -->
            <div class="card2 mb-0">
                <div class="accordion-header collapsed" data-toggle="collapse" href="#book1">
                    <a class="accordion-title">
                        Question 1
                    </a>
                </div>
                <div id="book1" class="accordion-body collapse" data-parent="#accordion5">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </p>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book2">
                    <a class="accordion-title">
                    Question 2
                    </a>
                </div>
                <div id="book2" class="accordion-body collapse" data-parent="#accordion5">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </p>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book3">
                    <a class="accordion-title">
                    Question 3
                    </a>
                </div>
                <div id="book3" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book4">
                    <a class="accordion-title">
                    Question 4
                    </a>
                </div>
                <div id="book4" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book5">
                    <a class="accordion-title">
                    Question 5
                    </a>
                </div>
                <div id="book5" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book6">
                    <a class="accordion-title">
                    Question 6
                    </a>
                </div>
                <div id="book6" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book7">
                    <a class="accordion-title">
                    Question 7
                    </a>
                </div>
                <div id="book7" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book8">
                    <a class="accordion-title">
                    Question 8
                    </a>
                </div>
                <div id="book8" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book9">
                    <a class="accordion-title">
                    Question 9
                    </a>
                </div>
                <div id="book9" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion5" href="#book10">
                    <a class="accordion-title">
                    Question 10
                    </a>
                </div>
                <div id="book10" class="collapse" data-parent="#accordion5">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h3>Membership</h3>
        <div id="accordion6" class="accordion">
            <div class="card2 mb-0">
                <div class="accordion-header collapsed" data-toggle="collapse" href="#membership1">
                    <a class="accordion-title">
                        Question 1
                    </a>
                </div>
                <div id="membership1" class="accordion-body collapse" data-parent="#accordion6">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </p>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership2">
                    <a class="accordion-title">
                    Question 2
                    </a>
                </div>
                <div id="membership2" class="accordion-body collapse" data-parent="#accordion6">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </p>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership3">
                    <a class="accordion-title">
                    Question 3
                    </a>
                </div>
                <div id="membership3" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership4">
                    <a class="accordion-title">
                    Question 4
                    </a>
                </div>
                <div id="membership4" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership5">
                    <a class="accordion-title">
                    Question 5
                    </a>
                </div>
                <div id="membership5" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership6">
                    <a class="accordion-title">
                    Question 6
                    </a>
                </div>
                <div id="membership6" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership7">
                    <a class="accordion-title">
                    Question 7
                    </a>
                </div>
                <div id="membership7" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership8">
                    <a class="accordion-title">
                    Question 8
                    </a>
                </div>
                <div id="membership8" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership9">
                    <a class="accordion-title">
                    Question 9
                    </a>
                </div>
                <div id="membership9" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
                <div class="accordion-header last collapsed" data-toggle="collapse" data-parent="#accordion6" href="#membership10">
                    <a class="accordion-title">
                    Question 10
                    </a>
                </div>
                <div id="membership10" class="collapse" data-parent="#accordion6">
                    <div class="accordion-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
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
                $('#trigger-tab-language').addClass('active');
                $('#content-tab-language').addClass('active');
                $('#trigger-tab-currency').removeClass('active');
                $('#content-tab-currency').removeClass('active');
            }
            function currency() {
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');
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
</body>

</html>
