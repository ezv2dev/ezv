<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become a Host - EZV2</title>

    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/hostpage.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">



    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
    {{-- navbar --}}
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #000000;">
        <div class="header-4-4 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a href="{{ route('index') }}">
                    <img style="width: 90px;" src="{{ asset('assets/logo.png') }}" alt="oke">
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#targetModal-item">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
                    aria-labelledby="targetModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content border-0" style="background-color: #000000">
                            <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                                <a class="modal-title" id="targetModalLabel">
                                    <img style="margin-top: 0.5rem" src="https://ezv2.ezvillasbali.com/ezv250.png"
                                        alt="" />
                                </a>
                                <button type="button" class="close btn-close text-white" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                </ul>
                            </div>
                            <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                                <span>already host?</span>
                                <a type="button" href="{{ route('login') }}" class="btn btn-fill border-0">Log
                                    In</a>
                                {{-- <a type="button" href="{{ route('register.partner') }}" class="btn btn-fill border-0">Register</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    </ul>
                    <div class="gap-3">
                        @auth
                            <div class="user-name">
                                <h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                            </div>
                            <div class="logged-user-menu-detail" style="">
                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" class="logged-user-photo-detail"
                                            alt="">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}"
                                            class="logged-user-photo-detail" alt="">
                                    @endif

                                    <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                        aria-labelledby="navbarDropdownUserImage" style="left:1000px; top: 70%;">
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
                        @endauth
                        @guest
                            <a href="{{ route('register.partner') }}" class="btn btn-fill border-0 navbar-gap"
                                style="color: #ffffff; margin-right: 0px; padding-top: -100px; padding-bottom: 7px; padding-left:7px; padding-right:8px; width: 50px; height: 50px; border-radius: 50%;"
                                id="login">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </section>
    {{-- end navbar --}}
    {{-- hero --}}
    <section class="h-100 w-100 bg-black border-box">
        <div class="row container-xxl mx-auto">
            <div class="col-lg-7 col-md-7 col-xs-12">
                <div class="host-header-left">
                    <h1>LIST YOUR</h1>
                    <div class="row">
                        <div class="v-slider-frame col-sm-6">
                            <ul class="v-slides">
                                <li class="v-slide">&nbsp;</li>
                                <li class="v-slide">VILLA</li>
                                <li class="v-slide">HOTEL</li>
                                <li class="v-slide">RESTAURANT</li>
                                <li class="v-slide">THINGS TO DO</li>
                                <li class="v-slide">&nbsp;</li>
                            </ul>
                        </div>
                    </div>
                    <h1>EZV</h1>
                    <p>Registration can take as little as 15 minutes to complete – get started today</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="host-header-right">
                    <h3>Create New Listing</h3>
                    <ul>
                        <li>It's free to create a listing</li>
                        <li>24/7 support by phone or email</li>
                        <li>Set your own house rules for guests</li>
                        <li>Sync your calendar with other sites you list on</li>
                    </ul>
                    <hr>
                    @auth
                        <div class="row" style="text-align: center;">
                            <div class="col-3">
                                <a href="{{ route('list') }}" style="color: #ff7400;" id="login">
                                    <i class="fa-solid fa-house font-24 hover"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('hotel_list') }}" style="color: #ff7400;" id="login">
                                    <i class="fa-solid fa-city font-24 hover"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('restaurant_list') }}" style="color: #ff7400;" id="login">
                                    <i class="fa-solid fa-utensils font-24 hover"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('activity_list') }}" style="color: #ff7400;" id="login">
                                    <i class="fa-solid fa-person-running font-24 hover"></i>
                                </a>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <p><strong>Create a partner account to get started:</strong></p>
                        <p class="continue">By continuing, you agree to let EZV2.com email you regarding your
                            property
                            registration.</p>
                        <a type="button" href="{{ route('register.partner') }}"
                            class="btn btn-primary btn-block d-flex justify-content-center">
                            <center>Get Started <span><i class="fa fa-chevron-right"></i></span></center>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    {{-- end hero --}}
    <section class="h-100 w-100 bg-white">
        <div class="content-3-2-host container-xxl mx-auto  position-relative"
            style="font-family: 'Poppins', sans-serif">
            <div class="d-flex flex-lg-row flex-column align-items-center">
                <div class="img-hero text-center justify-content-center d-flex">
                    <img id="hero" class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
                        alt="" />
                </div>
                <div class="right-column">
                    <h2 class="host-title-text">Your peace of mind is our top priority <span>Here's how we're helping
                            you feel confident welcoming guests:</span></h2>
                    <ul>
                        <li class="list-unstyled">
                            <p class="host-text-number">1</p>
                            <p class="host-text-caption">Set <strong>house rules</strong> guest must agree to before
                                they stay</p>
                        </li>
                        <li class="list-unstyled">
                            <p class="host-text-number">2</p>
                            <p class="host-text-caption">Request <strong>damage deposits</strong> for extra security
                            </p>
                        </li>
                        <li class="list-unstyled">
                            <p class="host-text-number">3</p>
                            <p class="host-text-caption"><strong>Report guest misconduct</strong> if something goes
                                wrong</p>
                        </li>
                        <li class="list-unstyled">
                            <p class="host-text-number">4</p>
                            <p class="host-text-caption">Access <strong>24/7 support</strong> in 43+ languages</p>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-learn text-white">Learn more</a>
                </div>
            </div>
        </div>
    </section>

    {{-- experience --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div class="p-3-6-rem">
                <h4 class="host-title-text">Which best describes you?
                    <span>Select one of the options to see customized info</span>
                </h4>
                <div class="row top-15">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card card-overlay bg-dark text-white border-0 overflow-hidden radius-15">
                            <div class="p-15 pink">
                                <center>
                                    <h4>I have a property I rent out occasionally</h4>
                                </center>
                                <p><span>✓</span> This property is where I keep my personal belongings<br>
                                    <span>✓</span> I have limited experience working in the hospitality industry
                                </p>
                                <p class="bottom-0"><a href="#" class="btn btn-learn text-white">Learn more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card-overlay2 card bg-dark text-white border-0 overflow-hidden radius-15">
                            <div class="p-15 pink">
                                <center>
                                    <h4>I have multiple properties I rent out year-round</h4>
                                </center>
                                <p><span>✓</span> These properties are primarily used for guests<br>
                                    <span>✓</span> I have experience working in the hospitality industry
                                </p>
                                <p class="bottom-0"><a href="#" class="btn btn-learn text-white">Learn more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end experience --}}

    {{-- experience --}}
    <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div class="p-3-6-rem">
                <h4 class="host-title-text">Benefits of working with us</h4>
                <div class="row top-15">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card card-overlay overflow-hidden benefits-block">
                            <div class="row p-15">
                                <div class="col-3 w-90">
                                    <img src="{{ URL::asset('foto/icons/property.png') }}">
                                </div>
                                <div class="col-9">
                                    <h4>List any type of property</h4>
                                    <span>Villas, Restaurants, Hotels and everything in between can be listed for
                                        free.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card-overlay2 card overflow-hidden benefits-block">
                            <div class="row p-15">
                                <div class="col-3 w-90">
                                    <img src="{{ URL::asset('foto/icons/easy.png') }}">
                                </div>
                                <div class="col-9">
                                    <h4>Easily import details</h4>
                                    <span>To save you time, many of the details from your existing listings can be
                                        imported.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card card-overlay overflow-hidden benefits-block">
                            <div class="row p-15">
                                <div class="col-3 w-90">
                                    <img src="{{ URL::asset('foto/icons/guidance.png') }}">
                                </div>
                                <div class="col-9">
                                    <h4>Step-by-step guidance</h4>
                                    <span>You’ll learn how our platform works, best practices, and things to watch out
                                        for.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card-overlay2 card overflow-hidden benefits-block">
                            <div class="row p-15">
                                <div class="col-3 w-90">
                                    <img src="{{ URL::asset('foto/icons/save.png') }}">
                                </div>
                                <div class="col-9">
                                    <h4>Exclusive discounts</h4>
                                    <span>Discounts on products and services that save time and improve the guest
                                        experience.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end experience --}}

    {{-- <section class="h-100 w-100 bg-white">
        <div class="container-xxl mx-auto p-0">
            <div class="p-3-6-rem">
                <h4 class="host-title-text">Meet Yao Ming <span>See why he loves renting out his property on
                        EZV2.com.<span></h4>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <img id="hero" class="img-fluid" src="{{ URL::asset('yaoming.jpg') }}" alt="" />
                    </div>
                    <div class="col-lg-1 col-md-1 col-xs-12">
                        <div class="arrow-block triangle">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <div class="comment radius-15">
                            <h4>"It makes me more confident to know that I can report guest misconduct for all the
                                properties in my portfolio on EZV2.com."</h4>
                            <p>YAO MING<span>Shang Hai, People's Republic of China</span></p>
                        </div>
                    </div>
                </div>
            </div>
    </section> --}}

    {{-- QA desktop --}}
    <section class="w-100 d-lg-block"
        style="background-image: url('https://source.unsplash.com/2gDwlIim3Uw/1600x800');
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    height: 500px;">
        <div class="container-xxl mx-auto p-0 h-100 card-overlay">
            <div class="h-100 bottom-banner">
                <div class="col-12 d-flex flex-column justify-content-between text-white h-100">
                    <h1 class="card-title">Questions<br>about <br>hosting?</h1>
                    <p>You can host anything, anywhere...</p>
                    <div>
                        <a href="#" class="btn btn-company text-white">{{ Translate::translate('Learn More') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!--
    <script>
        $("#searchbox").click(function() {
            $("#search_bar").toggleClass("active");
        });
    </script>
    -->

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
        $('#adult3').on('change', function() {
            var total_adult = parseInt($('#adult3').val()) + parseInt($('#child3').val());
            $('#total_guest3').val(total_adult);
        });

        $('#child3').on('change', function() {
            var total_child = parseInt($('#adult3').val()) + parseInt($('#child3').val());
            $('#total_guest3').val(total_child);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        //Vertical Slider
        var vsOpts = {
            $slides: $('.v-slide'),
            $list: $('.v-slides'),
            duration: 6,
            lineHeight: 50
        }

        var vSlide = new TimelineMax({
            paused: true,
            repeat: -1
        })

        vsOpts.$slides.each(function(i) {
            vSlide.to(vsOpts.$list, vsOpts.duration / vsOpts.$slides.length, {
                y: i * -1 * vsOpts.lineHeight,
                ease: Elastic.easeOut.config(1, 0.4)
            })
        })
        vSlide.play()
    </script>
</body>

</html>
