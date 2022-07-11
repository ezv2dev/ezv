<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/m-home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    @component('components.loading.loading-type2')@endcomponent
    {{-- navbar --}}
    <div class="autohide2 header-fixed">
    <section class="mob-header">
    <form action="{{ route('search_villa') }}" method="GET" id="basic-form" autocomplete="off">
        <div class="row">
            <div class="col-5 header-date">
                <input class="date-filter" placeholder="{{ Translate::translate('Date') }}" type="text" onfocus="(this.type = 'date')"  id="date">
            </div>
            <div class="col-6 location">
                <div id="bar">
                    <input type="text" class="form-control" id="loc_sugest" name="location"
                        placeholder="{{ Translate::translate('Where are you going?') }}">
                        <div id="sugest" class="location-popup display-none">
                            @php
                            $location = App\Http\Controllers\ViewController::get_location();
                            @endphp
                            @foreach($location as $item)
                            <div class="col-lg-12 location-popup-desc-container sugest-list" style="display: none ">
                                <div class="location-popup-map sugest-list-map">
                                    <img class="location-popup-map-image"
                                        src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                </div>
                                <div class="location-popup-text sugest-list-text">
                                    <a type="button" class="location_op"
                                        data-value="{{ $item->name }}">{{ $item->name }}</a>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-lg-12 location-popup-desc-container sugest-list-empty" style="display: none">
                                <p>{{ Translate::translate('location not found') }}</p>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-1">
                <button type="submit" value="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        </form>
    </section>
    </div>
    {{-- End Header Search --}}
    {{-- end navbar --}}
    {{-- hero --}}
    <section class="h-100 w-100 first-section-top" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <div>
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                    <div class="col-12">
                        <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 14px; height: 400px; background-image: url('https://source.unsplash.com/Koei_7yYtIo/2400x1600'); background-position:center; background-size: cover;">
                            <div class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                                <div>
                                    <p class="text-white text-center" style="font-size: 22px;">
                                        {{ Translate::translate('The Best Way To Find Accommodation, Restaurants, or Things To Do') }}
                                    </p>
                                    <div
                                        class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                        <form action="{{ route('list') }}" method="GET" id="villa-form">
                                            {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                            <button class="btn d-inline-flex mb-md-0 btn-company">
                                                {{ Translate::translate("Let's Go") }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end hero --}}

    {{-- location list (desktop) --}}
    <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 1rem;">
                <h1 class="mb-5">{{ Translate::translate('Popular Destination') }}</h1>
                <div class="d-flex overflow-x-auto">
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1611813129102-5581ca61711a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-1">{{ Translate::translate('2 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1583248369069-9d91f1640fe6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=872&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Ubud</h5>
                                    <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1583248369069-9d91f1640fe6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=872&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Ubud</h5>
                                    <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="https://images.unsplash.com/photo-1541739296801-2412947056ae?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kuta</h5>
                                    <p class="card-text mb-1">{{ Translate::translate('10 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end location list (desktop) --}}
    {{-- location list (mobile) --}}
    <section class="h-100 w-100 bg-white d-lg-none d-block">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 1rem;">
                <h1 class="header-image">{{ Translate::translate('Popular Destination') }}</h1>
                <div class="overflow-scroll">
                    <div class="d-inline-flex">
                        <div class="px-0 popular-slider">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-0 popular-slider">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-0 popular-slider">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-0 popular-slider">
                            <a href="#" style="text-decoration: none;">
                                <div class="card bg-company text-white g-0 border-0 overflow-hidden"
                                    style="border-radius: 15px;">
                                    <img src="https://picsum.photos/1920/1080" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mb-1">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="direction">
            <p>{{ Translate::translate('Slidable') }}</p>
        </div>
        </div>
    </section>
    {{-- end location list (mobile) --}}
    {{-- experience --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 1rem;">
                <h1 class="header-image">{{ Translate::translate('Discover Experiences') }}</h1>
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px; margin-bottom: 50px;">
                            <img src="{{ URL::asset('assets/restaurant.jpg') }}" class="card-img"
                                style="height: 350px; object-fit: cover;" alt="...">
                            <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">{{ Translate::translate('Restaurants') }}</h1>
                                    <a href="{{ route('restaurant_list') }}"
                                        class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card-overlay2 card bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px; margin-bottom: 50px;">
                            <img src="{{ URL::asset('assets/activity.webp') }}" class="card-img"
                                style="height: 350px; object-fit: cover;" alt="...">
                            <div class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">{{ Translate::translate('Things To Do') }}</h1>
                                    <a href="{{ route('activity_list') }}"
                                        class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end experience --}}
    {{-- QA desktop --}}
    <section class="w-100 d-lg-block" style="background-image: url('https://source.unsplash.com/2gDwlIim3Uw/1600x800');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 300px;">
        <div class="container-xxl mx-auto p-0 h-100 card-overlay">
            <div style="padding: 1rem" class="h-100">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">{{ Translate::translate('Questions about listing') }} <br>{{ Translate::translate('your property, hotel, restaurant, and activity?') }}</h1>
                    <div>
                        <a href="{{ route('ahost') }}" class="btn btn-company text-white" target="_blank">
                            {{ Translate::translate('Ask a Super Host') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom-block">
    <div class="footer-fixed autohide">
        <div class="row">
            <div class="col-6">
                <div class="row mobile-social-share">
                    <div class="col-6 text-center icon-center">
                        <p type="button" onclick="language()" href="#">
                            @if (session()->has('locale'))
                                <img class="lang" src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                            @else
                                <img class="lang" src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                            @endif
                            <span style="color: #aaa;">{{ Translate::translate('LANG') }}</span>
                        </p>
                    </div>
                    <div class="col-6 text-center icon-center">
                        <p type="button" class="expand" onclick="share()">
                            <i class="fa fa-share" style="font-size: 18px;"></i>
                            <span>{{ Translate::translate('SHARE') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row footer-login">
                    @auth
                    <div class="row">
                        <div class="col-8 navbar-gap">
                            <a href="{{ route('partner_dashboard') }}">
                                {{ Translate::translate('Switch to hosting') }}
                            </a>
                        </div>
                        <div class="col-4 navbar-gap">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if (Auth::user()->avatar)
                                <img src="{{Auth::user()->avatar}}" class="user-photo mt-n2" alt="">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                    class="user-photo">
                                @endif

                                <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                    aria-labelledby="navbarDropdownUserImage">
                                    <h6 class="dropdown-header d-flex align-items-center">
                                        @if (Auth::user()->foto_profile != NULL)
                                        <img class="dropdown-user-img"
                                            src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                                        @elseIf (Auth::user()->avatar != NULL)
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
                                    <a class="dropdown-item" href="{{route('partner_dashboard')}}">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{route('profile_index')}}">
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
                                    <form id="logout-form" action="{{route('logout')}}" method="post"
                                        style="display: none">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>

                    @else
                    <div class="row">
                        <div class="col-9 navbar-gap host-block">
                            <a href="{{ route('ahost') }}">
                                {{ Translate::translate('Become a host') }}
                            </a>
                        </div>
                        <div class="col-3 navbar-gap">
                            <a href="{{ route('login') }}" class="btn btn-fill">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        <div>
    </div>
    </section>
    {{-- end QA desktop --}}
    {{-- QA mobile --}}
    <section class="footer">
        @include('layouts.user.footer')
    </section>
    {{-- end footer --}}
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
    <!-- Modal -->
    {{-- MODAL SHARE --}}
    <div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: white; border-radius:25px">
                <div class="modal-header">
                    <h5 class="modal-title">{{ Translate::translate('Share') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="fs-3 fw-bold mb-0">{{ Translate::translate('Share this page with your friend and family') }}</p>
                    <div>
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col-lg col-12 p-3 border share-med">
                                <a type="button" class="d-flex p-0" onclick="copy_link()">
                                    <div class="pr-5"><i class="fas fa-copy"></i> <span
                                            class="fw-normal">{{ Translate::translate('Copy Link') }}</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&display=popup"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                            class="fw-normal">{{ Translate::translate('Facebook') }}</span></div>
                                </a>
                            </div>
                            {{-- <div class="col-lg col-12 p-3 border share-med">
                                <a href="#" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-facebook-messenger"></i> <span
                                            class="fw-normal">Facebook Messenger</span></div>
                                </a>
                            </div> --}}
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                            class="fw-normal">{{ Translate::translate('Whatsapp') }}</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="https://telegram.me/share/url?url={{ url()->current() }}&text={{ url()->current() }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                            class="fw-normal">{{ Translate::translate('Telegram') }}</span></div>
                                </a>
                            </div>
                            <div class="col-lg col-12 p-3 border share-med">
                                <a href="mailto:?subject=I wanted you to see this site&amp;body={{ url()->current() }}"
                                    target="_blank" class="d-flex p-0">
                                    <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                            class="fw-normal">{{ Translate::translate('Email') }}</span></div>
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

    <script src="{{ asset('assets/js/m-home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{-- Increment Decrement --}}
    <script>
        function adult_increment_index() {
            document.getElementById('adult2').stepUp();
            document.getElementById('total_guest2').stepUp();
        }

        function adult_decrement_index() {
            document.getElementById('adult2').stepDown();
            document.getElementById('total_guest2').stepDown();
        }

        function child_increment_index() {
            document.getElementById('child2').stepUp();
            document.getElementById('total_guest2').stepUp();
        }

        function child_decrement_index() {
            document.getElementById('child2').stepDown();
            document.getElementById('total_guest2').stepDown();
        }

        function infant_increment_index() {
            document.getElementById('infant2').stepUp();
        }

        function infant_decrement_index() {
            document.getElementById('infant2').stepDown();
        }

        function pet_increment_index() {
            document.getElementById('pet2').stepUp();
        }

        function pet_decrement_index() {
            document.getElementById('pet2').stepDown();
        }
    </script>

    {{-- Search Location --}}
    <script>
        $(document).ready(() => {
            $("#loc_sugest").on('click', function () { //use a class, since your ID gets mangled
                var ids = $(".sugest-list");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    var rndInt = Math.floor(Math.random() * (ids.length-1));
                    console.log(rndInt);
                    ids.eq(rndInt).show();
                };

                $('#sugest').removeClass("display-none");
                $('#sugest').addClass("display-block"); //add the class to the clicked element
            });

            $(document).mouseup(function (e) {
                var container = $('#sugest');

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.removeClass("display-block");
                    container.addClass("display-none");
                }
            });

            $("#loc_sugest").on('keyup change', async () => {
                var ids = $(".sugest-list");
                ids.hide();
                $(".sugest-list-empty").eq(0).hide();

                var formValue = $("#loc_sugest").val();
                var isEmpty = true;

                $(".sugest-list").map((data) => {
                    var name = $(".sugest-list").eq(data).children(".sugest-list-text").children('a').text();
                    if(name.toLowerCase().includes(formValue.toLowerCase())) {
                        $(".sugest-list").eq(data).show();
                        isEmpty = false;
                    }
                });

                if(isEmpty) {
                    $(".sugest-list-empty").eq(0).show();
                }
                console.log('done');
            });

            $(".location_op").on('click', function (e) {
                $('#loc_sugest').val($(this).data("value"));
                $('#sugest').removeClass("display-block");
                $('#sugest').addClass("display-none");
            });
        });
    </script>

    <script>
        $("#dates").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onChange: function (selectedDates, dateStr, instance) {
                $('#dates').val("");
                $('#check_in2').val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
                $('#check_out2').val(flatpickr.formatDate(selectedDates[1], "Y-m-d"))
            }
        });

    </script>

    <script>
        function addClass(elements, className) {
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                if (element.classList) {
                    element.classList.add(className);
                } else {
                    element.className += ' ' + className;
                }
            }
        }

        function removeClass(elements, className) {
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                if (element.classList) {
                    element.classList.remove(className);
                } else {
                    element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ')
                        .join('|') + '(\\b|$)', 'gi'), ' ');
                }
            }
        }

    </script>

    <script>
        jQuery(document).ready(function (e) {
            function t(t) {
                e(t).bind("click", function (t) {
                    t.preventDefault();
                    e(this).parent().fadeOut()
                })
            }
            e(".dropdown-toggle").click(function () {
                var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                    ":hidden");
                e(".button-dropdown .dropdown-menu").hide();
                e(".button-dropdown .dropdown-toggle").removeClass("active");
                if (t) {
                    e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                        ".button-dropdown").children(".dropdown-toggle").addClass("active")
                }
            });
            e(document).bind("click", function (t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu")
                    .hide();
            });
            e(document).bind("click", function (t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                    .removeClass("active");
            })
        });

    </script>

    <!-- <script>
        window.addEventListener('scroll', function () {
            if(window.scrollY==0){
                document.getElementById("ul").classList.remove("ul-display-none");
                document.getElementById("ul").classList.add("ul-display-block");
                document.getElementById("bar").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-block");
                document.getElementById("nav").classList.remove("position-fixed");
                document.getElementById("nav").classList.remove("padding-top-0");
            }else{
                console.log("oke");
                document.getElementById("ul").classList.add("ul-display-none");
                document.getElementById("ul").classList.remove("ul-display-block");
                document.getElementById("bar").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-block");
                document.getElementById("nav").classList.add("position-fixed");
                document.getElementById("nav").classList.add("padding-top-0");
                document.getElementById("nav").classList.remove("search-height");
            }
        });
    </script> -->

    <script>
        function popUp() {
            document.getElementById("ul").classList.remove("ul-display-none");
            document.getElementById("ul").classList.add("ul-display-block");
            document.getElementById("bar").classList.remove("display-none");
            document.getElementById("searchbox").classList.add("display-none");
            document.getElementById("searchbox").classList.remove("display-block");
            document.getElementById("nav").classList.add("search-height");
        }

    </script>

<script>
    function share() {
        $('#modal-share').modal('show');
    }
</script>

<script>
    function language() {
        $('#LegalModal').modal('show');
    }
</script>

{{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
<!-- <form action="{{ route('index') }}" method="get" id="redirectMobileForm">
    <input type="hidden" name="screen" value="mobile">
</form>
<form action="{{ route('index') }}" method="get" id="redirectDesktopForm">
    <input type="hidden" name="screen" value="desktop">
</form>
<script>
    $(window).on('resize', ()=> {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            $('#redirectMobileForm').submit();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            $('#redirectDesktopForm').submit();
        }
    });
    $(document).ready(()=> {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            $('#redirectMobileForm').submit();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            $('#redirectDesktopForm').submit();
        }
    });
</script> -->

<script>
//Show/hide bottom menu
document.addEventListener("DOMContentLoaded", function(){

el_autohide = document.querySelector('.autohide');

// add padding-top to bady (if necessary)
navbar_height = document.querySelector('.footer-fixed').offsetHeight;
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
navbar_height = document.querySelector('.header-fixed').offsetHeight;
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
// DOMContentLoaded  end
</script>

</body>

</html>