<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/m-home.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    <script src="{{ asset('enjoyhint/enjoyhint.min.js') }}"></script>
    <link href="{{ asset('enjoyhint/enjoyhint.css') }}" rel="stylesheet" />
</head>

<body>
    @component('components.loading.loading-type2')
    @endcomponent
    {{-- navbar --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
        <header class="nav-top">
        <img src="{{ asset('assets/logo.png') }}"><span class="hamburger" id="ham"></span>
        </header>

        <nav class="nav-drill">
        <ul class="nav-items nav-level-1">
            <li class="nav-item nav-expand">
                    <a class="nav-link nav-expand-link" href="#">
                        Menu
                    </a>
                    <ul class="nav-items nav-expand-content">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Level 2
                            </a>
                        </li>
                        <li class="nav-item nav-expand">
                            <a class="nav-link nav-expand-link" href="#">
                                Menu
                            </a>
                            <ul class="nav-items nav-expand-content">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Level 3
                                    </a>
                                </li>
                                <li class="nav-item nav-expand">
                                    <a class="nav-link nav-expand-link" href="#">
                                        Menu
                                    </a>
                                    <ul class="nav-items nav-expand-content">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                Level 4
                                            </a>
                                        </li>
                                        <li class="nav-item nav-expand">
                                            <a class="nav-link nav-expand-link" href="#">
                                                Menu
                                            </a>
                                            <ul class="nav-items nav-expand-content">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        Level 5 Directory
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        Level 5 Contact
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        Level 5 Quick links
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        Level 5 Launchpad
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                Level 4 Directory
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                Level 4 Contact
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                Level 4 Quick links
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                Level 4 Launchpad
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Level 3 Directory
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Level 3 Contact
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Level 3 Quick links
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Level 3 Launchpad
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Level 2 Directory
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Level 2 Contact
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Level 2 Quick links
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Level 2 Launchpad
                            </a>
                        </li>
                    </ul>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">
                        Directory
                    </a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">
                        Quick links
                    </a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">
                        Launchpad
                    </a>
                </li>
            <li class="nav-item">
                <div class="row nav-info-block">
                    <div class="col-12">
                        Become a Host
                    </div>
                    <div class="col-12">
                        Language
                    </div>
                    <div class="col-12">
                        Currency
                    </div>
                    <div class="col-12">
                        Guest [Register | Login]
                    </div>
                </div>
            </li>
        </ul>
        </nav>
    </section>
    {{-- Header Search --}}
    {{-- end navbar --}}
    {{-- hero --}}
    <section class="h-100 w-100 first-section-top" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
                <div class="advance-search" style="padding: 0.4rem 1.2rem">
                    <div id="advanceSearch">
                        <form>
                            <div class="row text-center">
                                <div class="col-12 font-destination">
                                <input type="text" placeholder="Search destination or property name ..."><i class="fa fa-map-marker fa-lg"></i>
                                </div>
                                <div class="col-6 font-calendar">
                                <input type="text" placeholder="Starting Date" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"><i class="fa fa-calendar fa-lg"></i>
                                </div>
                                <div class="col-6 font-calendar">
                                <input type="text" placeholder="Finished Date" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"><i class="fa fa-calendar fa-lg"></i>
                                </div>
                                <div class="col-12 font-guest">
                                <input type="number" placeholder="Number of guest (number only)" min="1"><i class="fa fa-user fa-lg"></i>
                                </div>
                                <div class="col-12 font-search">
                                <input type="submit" value="Search"><i class="fa fa-search fa-lg"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                    <div class="col-12">
                        <div class="card card-overlay bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 14px; height: 300px; background-image: url('{{ URL::asset('assets/media/photos/desktop/lake.jpg') }}'); background-position:center; background-size: cover;">
                            <div
                                class="card-img-overlay card-overlay d-flex align-items-center justify-content-center">
                                <div>
                                    <p class="text-white text-center" style="font-size: 22px;">
                                        {{ Translate::translate('The Best Way To Find Accommodation, Restaurants, And Things To Do') }}
                                    </p>
                                    <div
                                        class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                                        <form action="{{ route('list') }}" method="GET" id="villa-form">
                                            {{-- <button class="btn d-inline-flex mb-md-0 btn-try border-0" style="color: #ffffff;"> --}}
                                            <button class="btn d-inline-flex mb-md-0 btn-company" id="lest_go">
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
    </section>
    {{-- end hero --}}

    {{-- location list (desktop) --}}
    <!-- <section class="h-100 w-100 bg-white d-lg-block d-none">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 3rem 6rem;">
                <h1 class="mb-5">{{ Translate::translate('Popular Destination') }}</h1>
                <div class="d-flex overflow-x-auto">
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="{{ URL::asset('assets/media/photos/desktop/denpasar.jpg') }}"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Denpasar</h5>
                                    <p class="card-text mb-5">{{ Translate::translate('2 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="{{ URL::asset('assets/media/photos/desktop/ubud.jpg') }}"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Ubud</h5>
                                    <p class="card-text mb-5">{{ Translate::translate('17 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="{{ URL::asset('assets/media/photos/desktop/canggu.jpg') }}"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Canggu</h5>
                                    <p class="card-text mb-5">{{ Translate::translate('17 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 pe-2">
                        <a href="#" style="text-decoration: none;">
                            <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                style="border-radius: 15px;">
                                <img src="{{ URL::asset('assets/media/photos/desktop/kuta.jpg') }}"
                                    height="200" class="card-img-top overflow-hidden" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kuta</h5>
                                    <p class="card-text mb-5">{{ Translate::translate('10 kilometres away') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    {{-- end location list (desktop) --}}
    {{-- location list (mobile) --}}
    <section class="h-100 w-100 bg-white d-lg-none d-block">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 0.3rem 0.6rem;">
                <h1 class="mt-3 mb-3">{{ Translate::translate('Popular Destination') }}</h1>
                <div class="overflow-scroll">
                    <div class="d-inline-flex">
                        <div class="px-2" style="width: 17.5rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                    style="border-radius: 15px;">
                                    <img src="{{ URL::asset('assets/media/photos/desktop/denpasar.jpg') }}"
                                        height="200" class="card-img-top overflow-hidden" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Denpasar</h5>
                                        <p class="card-text mt-3 mb-3">{{ Translate::translate('2 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 17.5rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                    style="border-radius: 15px;">
                                    <img src="{{ URL::asset('assets/media/photos/desktop/ubud.jpg') }}"
                                        height="200" class="card-img-top overflow-hidden" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubud</h5>
                                        <p class="card-text mt-3 mb-3">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 17.5rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                    style="border-radius: 15px;">
                                    <img src="{{ URL::asset('assets/media/photos/desktop/canggu.jpg') }}"
                                        height="200" class="card-img-top overflow-hidden" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Canggu</h5>
                                        <p class="card-text mt-3 mb-3">{{ Translate::translate('17 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-2" style="width: 17.5rem;">
                            <a href="#" style="text-decoration: none;">
                                <div class="card text-white g-0 border-0 overflow-hidden h-100 bg-company"
                                    style="border-radius: 15px;">
                                    <img src="{{ URL::asset('assets/media/photos/desktop/kuta.jpg') }}"
                                        height="200" class="card-img-top overflow-hidden" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Kuta</h5>
                                        <p class="card-text mt-3 mb-3">{{ Translate::translate('10 kilometres away') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end location list (mobile) --}}
    {{-- experience --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div style="padding: 0rem 1.2rem 0.6rem 1.2rem;">
                <h1 class="mt-3 mb-3">{{ Translate::translate('Discover Experiences') }}</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card card-overlay  bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/media/photos/desktop/restaurant.jpg') }}" class="card-img"
                                style="height: 350px; object-fit: cover;" alt="...">
                            <div
                                class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <h1 class="card-title">{{ Translate::translate('Restaurants') }}</h1>
                                    <a href="{{ route('restaurant_list') }}"
                                        class="btn btn-company text-white btn-sm">{{ Translate::translate('Explore') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="card-overlay2 card bg-dark text-white border-0 overflow-hidden"
                            style="border-radius: 15px;">
                            <img src="{{ URL::asset('assets/media/photos/desktop/activity.jpg') }}" class="card-img"
                                style="height: 350px; object-fit: cover;" alt="...">
                            <div
                                class="card-img-overlay card-overlay d-flex justify-content-center align-items-center">
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
    <section class="w-100 d-lg-none d-lg-block" style="background-image: url('{{ URL::asset('assets/media/photos/desktop/villa.jpg') }}');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 500px;">
        <div class="p-0 h-100 card-overlay">
            <div style="padding: 0.6rem 1.2rem" class="container-xxl mx-auto h-100">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">
                        {{ Translate::translate('Learn about listing') }}<br>{{ Translate::translate('your home, hotel, restaurant, or activity') }}
                    </h1>
                    <div>
                        <a href="{{ route('ahost') }}" class="btn btn-company text-white"
                            target="_blank">{{ Translate::translate('Learn More') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}

    {{-- end QA desktop --}}
    {{-- QA mobile --}}
    <section class="h1-00 w-100">

        @include('layouts.user.footer')
    </section>
    {{-- end footer --}}

    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        $(function() {
            $('.legal-tabs li').on('click', function() {
                var tab = $(this).index();
                $('#LegalModal .modal-body .nav-tabs a:eq(' + tab + ')').tab('show');
            });
        });
    </script>

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
            $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                var ids = $(".sugest-list");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    var rndInt = Math.floor(Math.random() * (ids.length - 1));
                    console.log(rndInt);
                    ids.eq(rndInt).show();
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
        $("#dates").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onReady(_, __, fp) {
                fp.calendarContainer.classList.add("flat-margin");
            },
            onChange: function(selectedDates, dateStr, instance) {
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
        jQuery(document).ready(function(e) {
            function t(t) {
                e(t).bind("click", function(t) {
                    t.preventDefault();
                    e(this).parent().fadeOut()
                })
            }
            e(".dropdown-toggle").click(function() {
                var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                    ":hidden");
                e(".button-dropdown .dropdown-menu").hide();
                e(".button-dropdown .dropdown-toggle").removeClass("active");
                if (t) {
                    e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                        ".button-dropdown").children(".dropdown-toggle").addClass("active")
                }
            });
            e(document).bind("click", function(t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu")
                    .hide();
            });
            e(document).bind("click", function(t) {
                var n = e(t.target);
                if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                    .removeClass("active");
            })
        });
    </script>

    <script>
        var lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            var st = window.pageYOffset || document.documentElement.scrollTop;
            if (window.scrollY == 0) {
                document.getElementById("ul").classList.remove("ul-display-none");
                document.getElementById("ul").classList.add("ul-display-block");
                document.getElementById("bar").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-block");
                document.getElementById("nav").classList.remove("position-fixed");
                document.getElementById("nav").classList.remove("padding-top-0");

                function removeClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.remove(className);
                        } else {
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className
                                .split(' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var els = document.getElementsByClassName("flatpickr-calendar");
                removeClass(els, 'display-none');
            } else {
                console.log("oke");
                document.getElementById("ul").classList.add("ul-display-none");
                document.getElementById("ul").classList.remove("ul-display-block");
                document.getElementById("bar").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("display-block");
                document.getElementById("nav").classList.add("position-fixed");
                document.getElementById("nav").classList.add("padding-top-0");
                document.getElementById("nav").classList.remove("search-height");

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
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className
                                .split(' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var els = document.getElementsByClassName("flatpickr-calendar");
                addClass(els, 'display-none');
            }
        });
    </script>

    <script>
        function popUp() {
            document.getElementById("ul").classList.remove("ul-display-none");
            document.getElementById("ul").classList.add("ul-display-block");
            document.getElementById("bar").classList.remove("display-none");
            document.getElementById("searchbox").classList.add("display-none");
            document.getElementById("searchbox").classList.remove("display-block");
            document.getElementById("nav").classList.add("search-height");

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

            var els = document.getElementsByClassName("flatpickr-calendar");
            removeClass(els, 'display-none');
        }
    </script>

    <script>
        function language() {
            $('#LegalModal').modal('show');
        }
    </script>

    {{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
    <form action="{{ route('index') }}" method="get" id="redirectMobileForm">
        <input type="hidden" name="screen" value="mobile">
    </form>
    <form action="{{ route('index') }}" method="get" id="redirectDesktopForm">
        <input type="hidden" name="screen" value="desktop">
    </form>
    <script>
        $(window).on('resize', () => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                $('#redirectMobileForm').submit();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                $('#redirectDesktopForm').submit();
            }
        });
        $(document).ready(() => {
            if ($(window).width() < 1024 && '{{ request()->screen ?? '' }}' != 'mobile') {
                $('#redirectMobileForm').submit();
            }
            if ($(window).width() > 1024 && '{{ request()->screen ?? '' }}' != 'desktop') {
                $('#redirectDesktopForm').submit();
            }
        });
    </script>


    <script>
        var enjoyhint_instance = new EnjoyHint({});

        var enjoyhint_script_steps = [{
                'next #lest_go': 'Welcome to Turbo Search! Let me guide you through its features.',
                'nextButton': {
                    className: "myNext",
                    text: "Sure"
                },
                'skipButton': {
                    className: "mySkip",
                    text: "Nope!"
                }
            },

        ];

        enjoyhint_instance.set(enjoyhint_script_steps);
        enjoyhint_instance.run();
    </script>

    <script>
        console.clear()

        const navExpand = [].slice.call(document.querySelectorAll('.nav-expand'))
        const backLink = `<li class="nav-item">
            <a class="nav-link nav-back-link" href="javascript:;">
                Back
            </a>
        </li>`

        navExpand.forEach(item => {
            item.querySelector('.nav-expand-content').insertAdjacentHTML('afterbegin', backLink)
            item.querySelector('.nav-link').addEventListener('click', () => item.classList.add('active'))
            item.querySelector('.nav-back-link').addEventListener('click', () => item.classList.remove('active'))
    })


        // ---------------------------------------
        // not-so-important stuff starts here

        const ham = document.getElementById('ham')
        ham.addEventListener('click', function() {
            document.body.classList.toggle('nav-is-toggled');
    })


        //Adds active class to the menu icon
        $('.hamburger').on('click', function(){
        $(this).toggleClass("active");
    });
</script>

<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("advanceSearch");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>

</body>

</html>
