<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>EZV2</title>

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
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        div,
        span,
        input,
        strong {
            font-family: 'Poppins', sans-serif;
            color: #000;
        }

        #logoo {
            margin-left: 5px !important;
        }

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

        .modal-content {
            display: flex;
            flex-direction: column;
            margin: 10px auto;
            padding: 20px;
            background: transparent;
            border: none;
            font-size: 10px;
        }

        .modal-header {
            background: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 20px;
        }

        .modal-body {
            background: #fff;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .modal-body span {
            margin: 10px 0;
            display: block;
        }

        .container {
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin: 0 auto;
            padding: 0 0.5rem;
        }

        #cards-container {
            overflow: hidden;
            margin: 0px 40px 40px 40px;
        }

        .cards {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 99999px;
        }

        .card {
            /* Add shadows to create the "card" style="border-radius: 10px; height: 370px;" effect */
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background: #fff;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            width: 190px;
            margin: 15px 7.5px;
        }

        .card:hover {
            -webkit-box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .card .img {
            max-width: 220px;
            height: 220px;
            display: inline-block;
        }

        #slide-left-container,
        #slide-right-container {
            display: none;
        }

        #slide-left-container.active,
        #slide-right-container.active {
            display: block;
            cursor: pointer;
        }

        .slide-left,
        .slide-right {
            border-color: #FF7400;
            border-style: solid;
            height: 20px;
            width: 20px;
            margin-top: 30%;
        }

        .slide-left {
            border-width: 4px 0 0 4px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            margin-left: 40%;
        }

        .slide-right {
            border-width: 4px 4px 0 0;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            margin-left: 22%;
        }



        img {
            display: block;
        }

        .btn2 {
            display: inline-block;
            font: inherit;
            background: none;
            border: none;
            color: inherit;
            padding: 0;
            cursor: pointer;
        }

        .btn2:focus {
            outline: 0.5rem auto #4d90fe;
        }

        .visually-hidden {
            position: absolute !important;
            height: 1px;
            width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
        }

        /* Profile Section */

        .profile {
            padding: 5rem 0;
        }

        .profile::after {
            content: "";
            display: block;
            clear: both;
        }

        .profile-image {
            float: left;
            width: calc(33.333% - 1rem);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 3rem;
        }

        .profile-image img {
            border-radius: 50%;
        }

        .profile-user-settings,
        .profile-stats,
        .profile-bio {
            float: left;
            width: calc(66.666% - 2rem);
        }

        .profile-user-settings {
            margin-top: 1.1rem;
        }

        .profile-user-name {
            display: inline-block;
            font-size: 3.2rem;
            font-weight: 300;
        }

        .profile-edit-btn {
            font-size: 1rem;
            line-height: 1.8;
            border: 0.1rem solid #dbdbdb;
            border-radius: 10px;
            padding: 0 2.4rem;
            margin-top: -70px;
            margin-left: 2rem;
        }

        .profile-settings-btn {
            font-size: 2rem;
            margin-left: 1rem;
        }

        .profile-stats {
            margin-top: 2.3rem;
        }

        .profile-stats li {
            display: inline-block;
            font-size: 1.6rem;
            line-height: 1.5;
            margin-right: 4rem;
            cursor: pointer;
        }

        .profile-stats li:last-of-type {
            margin-right: 0;
        }

        .profile-bio {
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 1.5;
            margin-top: 2.3rem;
        }

        .profile-real-name,
        .profile-stat-count,
        .profile-edit-btn {
            font-weight: 600;
        }

        /* Gallery Section */

        .gallery {
            display: flex;
            flex-wrap: wrap;
            margin: -1rem -1rem;
            padding-bottom: 3rem;
        }

        .gallery-item {
            position: relative;
            flex: 1 0 22rem;
            margin: 1rem;
            color: #fff;
            cursor: pointer;
        }

        .gallery-item:hover .gallery-item-info,
        .gallery-item:focus .gallery-item-info {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .gallery-item-info {
            display: none;
        }

        .gallery-item-info li {
            display: inline-block;
            font-size: 1.7rem;
            font-weight: 600;
        }

        .gallery-item-likes {
            margin-right: 2.2rem;
        }

        .gallery-item-type {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2.5rem;
            text-shadow: 0.2rem 0.2rem 0.2rem rgba(0, 0, 0, 0.1);
        }

        .fa-clone,
        .fa-comment {
            transform: rotateY(180deg);
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Loader */

        .loader {
            width: 5rem;
            height: 5rem;
            border: 0.6rem solid #999;
            border-bottom-color: transparent;
            border-radius: 50%;
            margin: 0 auto;
            animation: loader 500ms linear infinite;
        }

        /* Media Query */

        @media screen and (max-width: 40rem) {
            .profile {
                display: flex;
                flex-wrap: wrap;
                padding: 4rem 0;
            }

            .profile::after {
                display: none;
            }

            .profile-image,
            .profile-user-settings,
            .profile-bio,
            .profile-stats {
                float: none;
                width: auto;
            }

            .profile-image img {
                width: 7.7rem;
            }

            .profile-user-settings {
                flex-basis: calc(100% - 10.7rem);
                display: flex;
                flex-wrap: wrap;
                margin-top: 1rem;
            }

            .profile-user-name {
                font-size: 2.2rem;
            }

            .profile-edit-btn {
                order: 1;
                padding: 0;
                text-align: center;
                margin-top: 1rem;
            }

            .profile-edit-btn {
                margin-left: 0;
            }

            .profile-bio {
                font-size: 1.4rem;
                margin-top: 1.5rem;
            }

            .profile-edit-btn,
            .profile-bio,
            .profile-stats {
                flex-basis: 100%;
            }

            .profile-stats {
                order: 1;
                margin-top: 1.5rem;
            }

            .profile-stats ul {
                display: flex;
                text-align: center;
                padding: 1.2rem 0;
                border-top: 0.1rem solid #dadada;
                border-bottom: 0.1rem solid #dadada;
            }

            .profile-stats li {
                font-size: 1.4rem;
                flex: 1;
                margin: 0;
            }

            .profile-stat-count {
                display: block;
            }
        }

        /* Spinner Animation */

        @keyframes loader {
            to {
                transform: rotate(360deg);
            }
        }

        @supports (display: grid) {
            .profile {
                display: grid;
                grid-template-columns: 1fr 2fr;
                grid-template-rows: repeat(3, auto);
                grid-column-gap: 3rem;
                align-items: center;
            }

            .profile-image {
                grid-row: 1 / -1;
            }

            .gallery {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(22rem, 1fr));
                grid-gap: 2rem;
            }

            .profile-image,
            .profile-user-settings,
            .profile-stats,
            .profile-bio,
            .gallery-item,
            .gallery {
                width: auto;
                margin: 0;
            }

            @media (max-width: 40rem) {
                .profile {
                    grid-template-columns: auto 1fr;
                    grid-row-gap: 1.5rem;
                }

                .profile-image {
                    grid-row: 1 / 2;
                }

                .profile-user-settings {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    grid-gap: 1rem;
                }

                .profile-edit-btn,
                .profile-stats,
                .profile-bio {
                    grid-column: 1 / -1;
                }

                .profile-user-settings,
                .profile-edit-btn,
                .profile-settings-btn,
                .profile-bio,
                .profile-stats {
                    margin: 0;
                }
            }
        }

    </style>

    <style>
        body,
        html {
            background-color: #fff;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        div,
        span,
        input,
        strong {
            font-family: 'Poppins', sans-serif;
            color: #000;
        }

        .video-container {
            position: relative;
        }

        .video-container .overlay-desc {
            position: relative;
            z-index: 999;
            max-width: 900px;
            margin: 0 auto;
            margin-top: 300px;
            margin-left: 20px;
            background: rgba(0, 0, 0, 0);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .video-container .overlay-desc h5 {
            color: white;
            font-size: 1.5rem;
        }

        .video-container .overlay-desc p:not(.p-smaller) {
            color: white;
            font-size: 1.1rem;
            line-height: 1.7rem;
            font-weight: 600;
        }

        .video-container .overlay-desc p.p-smaller {
            color: white;
            font-size: 13px;
            line-height: 1;
            font-weight: 400;
            max-width: 375px;
        }

        .video-container .overlay-desc .action_button {
            color: white;
            border-color: white;
            margin: 10px 0;
        }

        video {
            width: 1000px;
            height: auto
        }

        .user-logged .user-photo {
            width: 50px;
            height: 50px;
            margin-top: -10px;
        }

        .right-bar {
            display: block;
            z-index: 999;
        }

        nav ul {
            padding: 0;
            margin: 0;
            list-style: none;
            position: relative;
        }

        nav a {
            display: block;
            padding: 10px 20px;
            color: #000;
            font-size: 16px;
            line-height: 16px;
            text-decoration: none;
        }

        nav a:hover {
            color: #ff7400;
        }

        nav ul ul {
            display: none;
            position: absolute;
            top: 40px;
            border: solid 1px #515151;
            z-index: 999;
            background: #fff;
            border-radius: 10px;
            padding: 10px;
        }

        nav ul li:hover>ul {
            display: inherit;
        }

        /*.fa.fa-user::after {*/
        /*    content: ' +';*/
        /*}*/

        header .head-inner-wrap {
            margin: auto;
            display: flex;
            padding: 10px 0;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: #fff;
        }

        header {
            background: #ffffff;
            border-bottom: 1px solid #dddddd;
        }

        header .search-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
        }

        #page-container {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            width: 100%;
            min-width: 320px;
            min-height: 100vh;
        }

        #page-container.page-header-fixed #main-container {
            padding-top: 0;
        }

        header .logo h3 {
            color: #444444;
        }

        .page-header-fixed {
            width: 100%;
            display: flex;
            justify-content: space-between;
            position: fixed;
            background: #fff;
            z-index: 999;
            padding-top: 20px;
            padding-left: 80px;
            padding-right: 80px;
            border-bottom: solid 1px #919191;
        }

        #content {
            margin-top: 80px;
        }

        header .search-bar input {
            position: relative;
            text-align: left;
        }

        .headaer-search {
            width: 34px;
            height: 34px;
            margin-left: 10px;
            border-radius: 5px;
            border: solid 1px #000;
            color: #fbfbfb;
            background: #000;
        }

        .headaer-search:hover {
            background: #ff7400;
            color: #fff;
            border: solid 1px #ff7400;
        }

        a {
            color: #ff7400;
        }

        a:hover {
            color: #ff7400;
        }

        #myBtnContainer {
            justify-content: center;
            display: grid;
        }

        .video-slider {
            width: 100%;
            min-height: 250px;
            max-height: 250px;
            object-fit: cover;
        }

        .description {
            width: 100%;
        }

        .description-header {
            font-size: 24px;
            font-weight: 600;
        }

        .address {
            font-size: 16px;
            color: #000;
        }

        .address span {
            font-size: 12px;
        }

        .color-green {
            font-size: 15px;
            color: #ff7400;
        }

        .photo {
            height: 70px;
            width: 70px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin-left: 78px;
            margin-top: 52px;
            box-shadow: 1px 1px 10px #a4a4a4;
            border: solid 1px #a4a4a4;
            padding: 3px;
        }

        .slick-prev::before,
        .slick-next::before {
            opacity: .3;
        }

        @media only screen and (max-width: 480px) {
            .photo {
                height: 80px;
                width: 80px;
                margin-left: 270px;
                margin-top: -65px;
            }

            .video-button {
                margin-top: -39px !important;
                margin-left: 297px !important;
            }

            .rates-block {
                text-align: center !important;
                border-left: none !important;
                margin-top: 20px !important;
            }

            .text-left {
                text-align: center !important;
                margin-top: -90px;
            }

            .btn {
                font-size: .8rem;
            }

            .slick-slider {
                margin-top: 30px;
            }

            .menu ul {
                margin-left: -38px;
            }

            .drop-down3 span {
                display: none;
            }

            .mega-menu3.fadeIn.animated.display-on {
                margin-left: -121px;
            }

            .mega-menu4.fadeIn.animated.display-on {
                margin-left: -130px;
            }

            .page-header-fixed {
                padding-left: 10px;
                padding-right: 10px;
            }

            header .search-bar input {
                max-width: 120px;
            }
        }

        @media only screen and (max-width: 360px) {
            .photo {
                height: 80px;
                width: 80px;
                margin-left: 248px;
                margin-top: -94px;
            }

            .video-button {
                margin-top: -69px !important;
                margin-left: 275px !important;
            }
        }

        .video-button {
            margin-left: 100px;
            position: absolute;
            margin-top: 74px;
            color: #fff;
            font-size: 12px !important;
            padding: 8px;
        }

        .video-button:hover {
            color: #ff7400;
        }

        .bg-body-light {
            padding-bottom: 20px;
        }

        .rates-block {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            text-align: right;
            border-left: solid 1px #c0c0c0;
            margin-top: 30px;
        }

        .text-left {
            text-align: left;
        }

        .reviews {
            font-size: 14px;
            color: #8c8c8c;
        }

        .more-filters {
            text-align: left;
        }

        .more-filters p span {
            float: right;
        }

        .bg-green {
            background-color: #000;
        }

        .reviews-quote {
            background-image: url("{{asset('assets/media/villas/group.png')}}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            color: #000;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            padding: 5px 10px 15px 10px;
            display: inline-block;
        }

        .color-orange {
            color: orange;
            font-size: 12px;
        }

        a:not([href]):not([class]),
        a:not([href]):not([class]):hover {
            border: none;
        }

        .content-menu {
            display: none;
            overflow: hidden;
            background-color: transparent;
            margin-top: 20px;
        }

        .double-slider {
            max-width: 250px;
        }

        .from,
        .to {
            width: 250px;
        }

        .villa-description-list {
            margin-top: 10px;
            list-style: none;
        }

        .fa.fa-check {
            color: #fff;
            background: green;
            padding: 3px;
            font-size: 10px;
            border-radius: 2px;
        }

        .btn {
            font-weight: 400;
            line-height: 1.5;
            padding: .175rem .75rem;
            font-size: .9rem;
            border-radius: .25rem;
        }

        .list-facilities {
            display: block;
            font-size: 14px;
            margin-bottom: 10px;
            color: #8c8c8c;
        }

        .review-text-list,
        .entire-text-list {
            font-size: 14px;
            margin-top: 10px;
            display: block;
            color: #8c8c8c;
        }

        .promo {
            margin-top: 30px;
            float: right;
        }

        .btn-promo {
            display: inline-block;
            font-size: 12px !important;
            font-weight: 600;
            color: #000;
            border: solid 1px #ff7400;
            border-radius: 5px;
        }

        .btn-promo:hover {
            color: #ff7400;
        }

        .btn-promo-false {
            display: inline-block;
            font-size: 12px !important;
            font-weight: 600;
            color: #000;
            border: solid 1px #000;
            border-radius: 5px;
            opacity: .3;
            padding: 5px;
            cursor: default;
        }

        .btn-choose {
            color: #fff;
            border: solid 1px #ff7400;
            background: #ff7400;
            outline: none;
        }

        .btn-choose:hover {
            border: solid 1px #000;
            background: #000;
            color: #fff;
        }

        ol,
        ul {
            list-style: none;
        }

        nav.menu {
            background: none;
            position: relative;
            min-height: 45px;
            height: 100%;
        }

        .menu>ul>li {
            display: inline-block;
            list-style: none;
            font-size: 12px;
            line-height: 2;
        }

        .menu>ul li a {
            text-decoration: none;
            display: block;
            background: #F8F9FC;
            border-radius: 15px;
            border: solid 1px #000;
            line-height: 15px;
            padding: 6px 10px;
            font-size: 12px;
            color: #000;
        }

        .menu>ul li a:hover {
            background: #ff7400;
            color: #fff;
            transition-duration: 0.3s;
            -moz-transition-duration: 0.3s;
            -webkit-transition-duration: 0.3s;
            border: solid 1px #ff7400;
        }

        .mega-menu {
            background: none repeat scroll 0 0 #fff;
            margin-top: 0;
            position: absolute;
            width: auto;
            padding: 15px;
            display: none;
            transition-duration: 0.9s;
            z-index: 999;
            border-radius: 25px;
        }

        .mega-menu2,
        .mega-menu4,
        .mega-menu3 {
            background: none repeat scroll 0 0 #fff;
            margin-top: 0;
            position: absolute;
            width: 200px;
            padding: 15px;
            display: none;
            transition-duration: 0.9s;
            z-index: 999;
            border-radius: 25px;
        }

        .mega-menu5 {
            background: none repeat scroll 0 0 #fff;
            margin-top: 0;
            position: absolute;
            width: 200px;
            padding: 15px;
            display: none;
            transition-duration: 0.9s;
            z-index: 999;
            border-radius: 25px;
        }


        .display-on {
            display: block;
            transition-duration: 0.9s;
        }

        .drop-down>a:after,
        .drop-down2>a:after {
            content: '\f103';
            font-weight: 900;
            color: #000;
            font-family: 'Font Awesome\ 5 Free';
            font-style: normal;
            margin-left: 5px;
        }

        .drop-down4>a:after {
            content: '\f103';
            font-weight: 900;
            color: #000;
            font-family: 'Font Awesome\ 5 Free';
            font-style: normal;
            margin-left: 5px;
        }

        .drop-down3>a:before {
            content: "\f1de";
            font-weight: 900;
            color: #000;
            font-family: 'Font Awesome\ 5 Free';
            font-style: normal;
            margin-left: 5px;
        }

        .drop-down5>a:before {
            content: "\f1de";
            font-weight: 900;
            color: #000;
            font-family: 'Font Awesome\ 5 Free';
            font-style: normal;
            margin-left: 5px;
        }

        .drop-down>a:hover:after,
        .drop-down2>a:hover:after,
        .drop-down4>a:hover:after,
        .drop-down3>a:hover:before {
            color: #fff;
        }

        .drop-down5>a:hover:before {
            color: #fff;
        }

        /*Animation--*/
        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .content-bar {
            position: absolute;
            width: 100%;
            text-align: center;
            margin-top: 80px;
            display: block;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            border-radius: 15px;
            box-shadow: 1px 1px 10px #979797;
        }

        .slick-list {
            border: solid 1px #979797;
        }

        .slick-slider.slick-nav-black .slick-next,
        .slick-slider.slick-nav-black .slick-prev,
        .slick-slider.slick-nav-black .slick-next:hover,
        .slick-slider.slick-nav-black .slick-prev:hover {
            background-color: transparent;
        }

        .slick-slider .slick-next::before {
            content: "\f054";
        }

        .slick-slider.slick-nav-black .slick-next::before,
        .slick-slider.slick-nav-black .slick-prev::before {
            text-shadow: 2px 2px 5px #000;
        }

        .slick-slider .slick-prev::before {
            content: "\f053";
        }

        .devider {
            width: 100%;
            height: 1px;
            background: #c1c0c0;
            display: block;
            margin-top: 20px;
        }

        .clear {
            clear: both;
        }

        #page-container.page-header-dark #page-header {
            color: #c3cde4;
            background-color: #fff;
            border-bottom: solid 1px #b0b0b0;
        }

        .bg-body-light {
            background-color: #fff !important;
        }

        .mega-menu.fadeIn.animated,
        .mega-menu2.fadeIn.animated,
        .mega-menu3.fadeIn.animated,
        .mega-menu4.fadeIn.animated {
            border: solid 1px #b3b1b1;
            margin-top: 1px;
        }

        .fac i {
            font-size: 14px;
            color: #fff;
            background: #000;
            padding: 5px 1px;
            height: 30px;
            width: 30px;
            text-align: center;
            border-radius: 5px;
            border: solid 2px #fff;
        }

        .top-20 {
            margin-top: 20px;
        }

        .menu {
            height: 50px;
            top: -8px;
            position: relative;
            padding-top: 10px;
        }

        .short-description {
            margin: 10px 0;
            color: #8c8c8c;
        }

        .modal-content {
            border-radius: 15px;
        }

        .modal-body span {
            margin: 10px;
            display: block;
        }

        /* START NEW PRICE RANGE CSS */
        /* ========================================================= */

        .irs {
            position: relative;
            display: block;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .irs-line {
            position: relative;
            display: block;
            overflow: hidden;
            outline: none !important;
        }

        .irs-line-left,
        .irs-line-mid,
        .irs-line-right {
            position: absolute;
            display: block;
            top: 0;
        }

        .irs-line-left {
            left: 0;
            width: 11%;
        }

        .irs-line-mid {
            left: 9%;
            width: 82%;
        }

        .irs-line-right {
            right: 0;
            width: 11%;
        }

        .irs-bar {
            position: absolute;
            display: block;
            left: 0;
            width: 0;
        }

        .irs-bar-edge {
            position: absolute;
            display: block;
            top: 0;
            left: 0;
        }

        .irs-shadow {
            position: absolute;
            display: none;
            left: 0;
            width: 0;
        }

        .irs-slider {
            position: absolute;
            display: block;
            cursor: default;
            z-index: 1;
        }

        .irs-slider.single {}

        .irs-slider.from {}

        .irs-slider.to {}

        .irs-slider.type_last {
            z-index: 2;
        }

        .irs-min {
            position: absolute;
            display: block;
            left: 0;
            cursor: default;
        }

        .irs-max {
            position: absolute;
            display: block;
            right: 0;
            cursor: default;
        }

        .irs-from,
        .irs-to,
        .irs-single {
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            cursor: default;
            white-space: nowrap;
        }

        .irs-grid {
            position: absolute;
            display: none;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20px;
        }

        .irs-with-grid .irs-grid {
            display: block;
        }

        .irs-grid-pol {
            position: absolute;
            top: 0;
            left: 0;
            width: 1px;
            height: 8px;
            background: #000;
        }

        .irs-grid-pol.small {
            height: 4px;
        }

        .irs-grid-text {
            position: absolute;
            bottom: 0;
            left: 0;
            white-space: nowrap;
            text-align: center;
            font-size: 9px;
            line-height: 9px;
            padding: 0 3px;
            color: #000;
        }

        .irs-disable-mask {
            position: absolute;
            display: block;
            top: 0;
            left: -1%;
            width: 102%;
            height: 100%;
            cursor: default;
            background: rgba(0, 0, 0, 0.0);
            z-index: 2;
        }

        .lt-ie9 .irs-disable-mask {
            background: #000;
            filter: alpha(opacity=0);
            cursor: not-allowed;
        }

        .irs-disabled {
            opacity: 0.4;
        }


        .irs-hidden-input {
            position: absolute !important;
            display: block !important;
            top: 0 !important;
            left: 0 !important;
            width: 0 !important;
            height: 0 !important;
            font-size: 0 !important;
            line-height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            outline: none !important;
            z-index: -9999 !important;
            background: none !important;
            border-style: solid !important;
            border-color: transparent !important;
        }

        .irs {
            height: 55px;
        }

        .irs-with-grid {
            height: 75px;
        }

        .irs-line {
            height: 10px;
            top: 33px;
            background: #EEE;
            background: linear-gradient(to bottom, #DDD -50%, #FFF 150%);
            /* W3C */
            border: 1px solid #CCC;
            border-radius: 16px;
            -moz-border-radius: 16px;
        }

        .irs-line-left {
            height: 8px;
        }

        .irs-line-mid {
            height: 8px;
        }

        .irs-line-right {
            height: 8px;
        }

        .irs-bar {
            height: 10px;
            top: 33px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            background: #000;
            /*background: linear-gradient(to top, rgba(66, 139, 202, 1) 0%, rgba(127, 195, 232, 1) 100%);*/
            background: linear-gradient(to top, rgb(79, 80, 81, 1) 0%, rgb(120, 121, 121, 1) 100%);
            /* W3C */
        }

        .irs-bar-edge {
            height: 10px;
            top: 33px;
            width: 14px;
            border: 1px solid #428bca;
            border-right: 0;
            background: #428bca;
            background: linear-gradient(to top, rgba(66, 139, 202, 1) 0%, rgba(127, 195, 232, 1) 100%);
            /* W3C */
            border-radius: 16px 0 0 16px;
            -moz-border-radius: 16px 0 0 16px;
        }

        .irs-shadow {
            height: 2px;
            top: 38px;
            background: #000;
            opacity: 0.3;
            border-radius: 5px;
            -moz-border-radius: 5px;
        }

        .lt-ie9 .irs-shadow {
            filter: alpha(opacity=30);
        }

        .irs-slider {
            top: 25px;
            width: 27px;
            height: 27px;
            border: 1px solid #AAA;
            background: #DDD;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(220, 220, 220, 1) 20%, rgba(255, 255, 255, 1) 100%);
            /* W3C */
            border-radius: 27px;
            -moz-border-radius: 27px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .irs-slider.state_hover,
        .irs-slider:hover {
            background: #FFF;
        }

        .irs-min,
        .irs-max {
            color: #333;
            font-size: 12px;
            line-height: 1.333;
            text-shadow: none;
            top: 0;
            padding: 1px 5px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            -moz-border-radius: 3px;
        }

        .lt-ie9 .irs-min,
        .lt-ie9 .irs-max {
            background: #ccc;
        }

        .irs-from,
        .irs-to,
        .irs-single {
            color: #fff;
            font-size: 14px;
            line-height: 1.333;
            text-shadow: none;
            padding: 1px 5px;
            background: #000;
            border-radius: 3px;
            -moz-border-radius: 3px;
        }

        .lt-ie9 .irs-from,
        .lt-ie9 .irs-to,
        .lt-ie9 .irs-single {
            background: #999;
        }

        .irs-grid {
            height: 27px;
        }

        .irs-grid-pol {
            opacity: 0.5;
            background: #428bca;
        }

        .irs-grid-pol.small {
            background: #999;
        }

        .irs-grid-text {
            bottom: 5px;
            color: #99a4ac;
        }

        .irs-disabled {}

        /* END NEW PRICE RANGE CSS */

        .display-none{
            display: none;
        }

    </style>
</head>

<body>
    @component('components.loading.loading-dashboard')@endcomponent

    <div id="page-container" class="page-container">
        <!-- Header -->
        <header>
            <div class="page-header-fixed d-flex flex-column">
                <div class="row">
                    <div class="col-8 logo">
                        <a href="{{ route('partner_dashboard') }}" target="_blank">
                            <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                        </a>
                    </div>
                    <div class="col-3 right-bar2">
                        <nav style="margin-left: 30px;">
                            @guest
                            <ul>
                                <li><a href="#"><i class="fa fa-user" style="font-size: 20px;"></i></a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                        @endif
                                        @else
                                        <ul>
                                            <li><a href="#">
                                                    <i class="fa fa-user-check"></i> {{ Auth::user()->first_name }}
                                                    {{ Auth::user()->last_name }}</a>
                                        </ul>
                                </li>
                            </ul>
                            </ul>
                            </li>
                            </ul>
                            @endguest
                        </nav>
                    </div>
                    <div class="col-1" style="margin-top: 10px;">
                        <i class="fa fa-bars" onMouseOver="this.style.color='#ff7400'"
                            onMouseOut="this.style.color='#000'" aria-hidden="true" onclick="view_bars()"
                            style="cursor: pointer;"></i>
                    </div>
                </div>
            </div>
        </header>
        <!-- END Header Content -->

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

            .label {
                text-align: left;
                font-size: 14px;
                margin: 0px;
            }

        </style>

        <div id="homes">
            <div class="col-lg-12" style="padding-top: 150px !important; padding-bottom: 90px !important; text-align: center;">
                @if (session('success'))
                <div class="col-12">
                    <div style="background-color: #CCEEE1 !important; color: #005937 !important; " class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                @if (session('error'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('error') }}
                    </div>
                </div>
                @endif
                <form action="{{ route('password_update') }}" method="POST"
                    style="border: solid 0.5px grey; width: 40%; margin-left: auto; margin-right: auto; border-radius: 7px; padding: 30px; box-sizing: border-box; text-align: center;">
                    @csrf
                    @method('PATCH')

                    <h5>Change Password</h5>
                    <label class="label" for="old_password">Current Password</label>
                    <input type="password" name="old_password" id="old_password"
                        class="form-control adminlisting-font mb-2" size="50" placeholder="Old Password">

                    @error('old_password')
                    <div style="color: red; margin-top: 10px;">
                        {{ $message }}
                    </div>
                    @enderror

                    <label class="label" for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control adminlisting-font mb-2"
                        size="50" placeholder="New Password">

                    @error('password')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror

                    <label class="label" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control adminlisting-font mb-2" size="50" placeholder="Confirm Password">

                    @error('password_confirmation')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                    <button type="submit"
                        style="border-radius: 5px; color: white; font-size: 12px; padding: 9px; box-sizing: border-box; margin-top: 9px; background-color: #FF7400;">Update
                        password</button>
                </form>
            </div>
        </div>
        @include('user.modal.user.bar_modal')

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
        function


        function edit_profile() {
            $('#modal-edit_profile').modal('show');
        }

        function showhotels() {
            document.getElementById("homes").style.display = "none";
            document.getElementById("hotels").style.display = "block";
            document.getElementById("restaurants").style.display = "none";
            document.getElementById("activities").style.display = "none";
        }

        function showhomes() {
            document.getElementById("homes").style.display = "block";
            document.getElementById("hotels").style.display = "none";
            document.getElementById("restaurants").style.display = "none";
            document.getElementById("activities").style.display = "none";
        }

        function showrestaurants() {
            document.getElementById("homes").style.display = "none";
            document.getElementById("hotels").style.display = "none";
            document.getElementById("restaurants").style.display = "block";
            document.getElementById("activities").style.display = "none";
        }

        function showactivities() {
            document.getElementById("homes").style.display = "none";
            document.getElementById("hotels").style.display = "none";
            document.getElementById("restaurants").style.display = "none";
            document.getElementById("activities").style.display = "block";
        }

    </script>

    <script>
        var wrap = $("#page-container");

        wrap.on("scroll", function (e) {

            if (this.scrollTop > 20) {
                wrap.addClass("fix-search");
            } else {
                wrap.removeClass("fix-search");
            }

        });

    </script>

    <script>
        function updateSliderArrowsStatus(
            cardsContainer,
            containerWidth,
            cardCount,
            cardWidth
        ) {
            if (
                $(cardsContainer).scrollLeft() + containerWidth <
                cardCount * cardWidth + 15
            ) {
                $("#slide-right-container").addClass("active");
            } else {
                $("#slide-right-container").removeClass("active");
            }
            if ($(cardsContainer).scrollLeft() > 0) {
                $("#slide-left-container").addClass("active");
            } else {
                $("#slide-left-container").removeClass("active");
            }
        }
        $(function () {
            // Scroll products' slider left/right
            let div = $("#cards-container");
            let cardCount = $(div)
                .find(".cards")
                .children(".card").length;
            let speed = 1000;
            let containerWidth = $(".container").width();
            let cardWidth = 250;

            updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);

            //Remove scrollbars
            $("#slide-right-container").click(function (e) {
                if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
                    $(div).animate({
                        scrollLeft: $(div).scrollLeft() + cardWidth
                    }, {
                        duration: speed,
                        complete: function () {
                            setTimeout(
                                updateSliderArrowsStatus(
                                    div,
                                    containerWidth,
                                    cardCount,
                                    cardWidth
                                ),
                                1005
                            );
                        }
                    });
                }
                updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
            });
            $("#slide-left-container").click(function (e) {
                if ($(div).scrollLeft() + containerWidth > containerWidth) {
                    $(div).animate({
                        scrollLeft: "-=" + cardWidth
                    }, {
                        duration: speed,
                        complete: function () {
                            setTimeout(
                                updateSliderArrowsStatus(
                                    div,
                                    containerWidth,
                                    cardCount,
                                    cardWidth
                                ),
                                1005
                            );
                        }
                    });
                }
                updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
            });

            // If resize action ocurred then update the container width value
            $(window).resize(function () {
                try {
                    containerWidth = $("#cards-container").width();
                    updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
                } catch (error) {
                    console.log(
                        `Error occured while trying to get updated slider container width: 
            ${error}`
                    );
                }
            });
        });

    </script>

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <script src="{{ asset('assets/js/view-villa.js') }}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-slick']);

    </script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-magnific-popup']);

    </script>
</body>

</html>
