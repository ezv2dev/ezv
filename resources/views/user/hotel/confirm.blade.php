<!DOCTYPE html>
<html lang="en">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZV2</title>
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">

    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <style>
	@font-face {
	font-family: 'Poppins';
	font-style: normal;
	font-weight: normal;
	src: local('Poppins'), url('{{ asset('assets/css/Montreal-Regular.woff') }}') format('woff');
	}


	@font-face {
	font-family: 'Poppins';
	font-style: normal;
	font-weight: normal;
	src: local('Poppins'), url('{{ asset('assets/css/Montreal-Bold.woff') }}') format('woff');
	}

	* {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: "Poppins", sans-serif;
	}

	body {
	background-color: #fafafa;
	}

	.photosGrid {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	}

	.photosGrid__Photo {
	width: 33%;
	width: calc(33.3% - 2px);
	height: 30vw;
	background-position: center;
	background-size: cover;
	margin-bottom: 3px;
	}

	@media screen and (min-width: 736px) {
	main {
	padding: 20px;
	}

	.photosGrid__Photo {
	width: calc(33.3% - 16px);
	margin-bottom: 26px;
	}
    }

	@media screen and (min-width: 980px) {
	main {
	max-width: 100%;
	margin: auto;
	}

	.photosGrid__Photo {
	height: 293px;
	}
    }

	.confirm-header {
	font-size: 1.875rem;
	font-weight: 600;
	}

	.confirm-header span {
	top: 3px;
	position: relative;
	}

	.confirm-header i {
	width: 30px;
	height: 30px;
	font-size: 1.2rem;
	color: #000;
	margin-top: -5px;
	padding: 5px 8px;
	border-radius: 50%;
	}

	.confirm-header i:hover {
	Background: #dfdfdf;
	}

	.block-confirm-info {
	border: 1px #757575 solid;
	border-radius: 15px;
	padding: 20px;
    margin-top: 50px;
	}

	.text-right {
	text-align: right;
	}

	.diamond-block {
	display: block;
	border: solid 1px #575757;
	border-radius: 15px;
	padding: 10px;
	margin-top: 20px;
	width: 40%;
	background: #fff;
	}

	.price-box {
	font-size: 12px;
	margin-bottom: 0 !important;
	}

	.confirm-date-block p {
	font-family: 'Poppins', san-serif;
	}

	.confirm-date-block span {
	display: block;
	font-family: 'Poppins', san-serif;
	}

	.confirm-date-block input {
	border: 0;
	float: right;
	text-align: right;
	text-decoration: underline;
	color: #343a40;
	}

	.confirm-date-block input:focus {
	transition: none !important;
	}

	input:focus {
	outline: none;
	box-shadow: 0;
	}

	.float-right {
    position: relative;
    float: right;
    margin-right: -55px !important;
    }

    .plus-min {
    border-radius: 50%;
    border: solid 1px #b5b5b5;
    padding: 1px 9px;
    }

    .align-center {
    margin-left: 10px;
    margin-right: -10px;
    }

    .confirm-photo img {
    background: #fff;
    padding: 3px;
    border: solid 1px #000;
    border-radius: 50%;
    width: 130px;
    height: 130px;
    margin-right: 30px;
    box-shadow: 1px 1px 5px #000;
    }

    .smaller {
    font-size: 14px;
    margin-bottom: 15px;
    }

    .smaller span {
    display: block;
    margin-top: 15px;
    text-decoration: underline;
    }

    .smaller {
    font-size: 13px;
    margin-bottom: 15px;
    line-height: 1.5;
    }

    .payment-header {
    font-size: 16px;
    margin-bottom: 10px;
    line-height: 1.5;
    font-weight: 600;
    }

    .payment-box {
    border: solid 1px #b7b7b7;
    padding: 20px;
    border-radius: 15px;
    }

    .payment-box img {
    border: solid 1px #a8a7a7;
    }

    .payment-box span input {
    margin-left: 20px;
    height: 25px;
    width: 25px;
    vertical-align: middle;
    accent-color: #e86900;
    }

    .login {
    margin-top: 20px;
    }

    .form-group {
    position: relative;
    z-index: 1;
    margin-bottom: 15px;
    }

    .form-group i {
    position: absolute;
    z-index: 1;
    right: 5px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    .btn-fill {
    margin-right: 30px;
    margin-top: 15px;
    font-family: "Roboto", sans-serif;
    cursor: pointer;
    display: inline-block;
    font-size: 17px;
    font-weight: 500;
    -webkit-box-shadow: none;
    box-shadow: none;
    outline: none;
    border: 0;
    color: #fff;
    border-radius: 3px;
    background-color: #ff7400;
    padding: 10px 36px;
    margin-bottom: 10px;
    -webkit-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    }

    .switcher-text {
    color: #9f9f9f;
    font-size: 15px;
    margin-top: 5px;
    display: block;
    -webkit-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    float: right;
    margin-top: 20px;
    }

    .confirm-socials > ul{
        display: flex;
        justify-content: center;
    }

    .confirm-socials > ul > li{
        margin-right: 10px;
        margin-left: 10px;
    }

    .fxt-transition-delay-2 {
    -webkit-transition-delay: 0.2s;
    -o-transition-delay: 0.2s;
    transition-delay: 0.2s;
    }

    .fxt-transformY-50 {
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
    -webkit-transition: all 1.3s cubic-bezier(0.075, 0.82, 0.165, 1);
    -o-transition: all 1.3s cubic-bezier(0.075, 0.82, 0.165, 1);
    transition: all 1.3s cubic-bezier(0.075, 0.82, 0.165, 1);
        transition-delay: 0s;
    }

    .form-control.form-control-alt {
    border-color: transparent;
    background-color: transparent;
    transition: none;
    border-bottom: solid 1px #b3b1b1;
    border-radius: 0;
    }

    .confirm-socials i {
    padding: 14px 15px;
    }

    .social-facebook a {
    background-color: #3b5998;
    border: solid 1px #3b5998;
    height: 45px;
    width: 45px;
    color: #fff;
    display: inline-block;
    border-radius: 50%;
    }

    .social-facebook a:hover {
    color: #3b5998;
    background: #fff;
    }

    .social-twitter a {
    background-color: #00acee;
    border: solid 1px #00acee;
    height: 45px;
    width: 45px;
    color: #fff;
    display: inline-block;
    border-radius: 50%;
    }

    .social-twitter a:hover {
    color: #00acee;
    background: #fff;
    }

    .social-google a {
    background-color: #c33;
    border: solid 1px #c33;
    height: 45px;
    width: 45px;
    color: #fff;
    display: inline-block;
    border-radius: 50%;
    }

    .social-google a:hover {
    color: #c33;
    background: #fff;
    }

    .social-linkedin a {
    background-color: #0077b5;
    border: solid 1px #0077b5;
    height: 45px;
    width: 45px;
    color: #fff;
    display: inline-block;
    border-radius: 50%;
    }

    .social-linkedin a:hover {
    color: #0077b5;
    background: #fff;
    }

    .social-pinterest a {
    background-color: #bd081c;
    border: solid 1px #bd081c;
    height: 45px;
    width: 45px;
    color: #fff;
    display: inline-block;
    border-radius: 50%;
    }

    .social-pinterest a:hover {
    color: #bd081c;
    background: #fff;
    }

    #sticky {
    position: sticky;
    top: 70px;
    }

    #wrapper {
    width: 100%;
    margin: auto;
    }

    #wrapper {
    height: 850px;
    }

    @media (min-height: 768px) {
        #wrapper{
            height: 2000px;
        }
    }

    @media screen and (max-width: 480px) {
        #sticky {
        position: relative;
        top: 0;
        }

        #wrapper {
        height: auto;
        }
    }
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
</head>

<body style="background-color:white">
    <div class="page">
        <!-- HEADER -->
        <header>
            <div class="head-inner-wrap">
                <div class="logo">
                    <a href="#" target="_blank">
                        <h3>EZV2</h3>
                    </a>
                </div>
            </div>
        </header>
    </div>
    <main>

        <p class="confirm-header"><a href="#" onclick="window.history.go(-1); return false;"><i class="fa fa-chevron-left"></i></a> <span>Confirm and Pay</span></p>
        {{-- <div class="diamond-block price-box">
                    <div class="row">
                        <div class="col-9">
                            <strong>This is a rare find.</strong><br> {{ $villa[0]->name }}'s place on EZ Villas Bali is usually fully
                            booked.
                        </div>
                        <div class="col-3"><img
                                src="https://a0.muscache.com/airbnb/static/packages/assets/frontend/gp-pdp-core-ui-sections/images/stays/icon-uc-diamond.296a9c250dc9ee3d995629f834798cb1.gif">
                        </div>
                    </div>
                </div> --}}
        <form action="{{ route('hotel_room_booking_store') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" id="id_hotel_room" name="id_hotel_room" value="{{ $hotel[0]->id_hotel_room }}">
        <input type="hidden" id="firstname" name="firstname" value="{{ $data['firstname'] }}">
        <input type="hidden" id="lastname" name="lastname" value="{{ $data['lastname'] }}">
        <input type="hidden" id="email" name="email" value="{{ $data['email'] }}">
        <input type="hidden" id="phone" name="phone" value="{{ $data['phone'] }}">
        <input type="hidden" id="hotel_room_price" name="hotel_room_price" value="{{ $hotel[0]->price }}">
        <section class="photosGrid" style="background-color:white">
            <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                <div style="text-align: justify; padding-bottom:10px">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-sm-12 col-xs-12">
                            <h3>Your Trip</h3>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-6 confirm-date-block">
                                    <p>Check In Date<span>{{ $data['check_in'] }}</span></p>
                                </div>
                                <div class="col-6 confirm-date-block">
                                    <input type="text" class="flatpickr bg-white" id="check_in" name="check_in" value="EDIT">
                                </div>
                                <div class="col-6 confirm-date-block">
                                    <p>Check Out Date<span>{{ $data['check_out'] }}</span></p>
                                </div>
                                <div class="col-6 confirm-date-block">
                                    <input type="text" class="flatpickr bg-white" id="check_out" name="check_out" value="EDIT">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 confirm-date-block">
                                    <p>Adult <span>{{ $data['adult'] }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="row float-right">
                                        <div class="col-2">
                                            <button class="plus-min" href="#">-</button>
                                        </div>
                                        <div class="col-2 align-center">
                                            0
                                        </div>
                                        <div class="col-2">
                                            <button class="plus-min" href="#">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 confirm-date-block">
                                    <p>Children <span>{{ $data['child'] }}</span></p>
                                </div>
                                <div class="col-md-6">
                                <div class="row float-right">
                                        <div class="col-2">
                                            <button class="plus-min" href="#">-</button>
                                        </div>
                                        <div class="col-2 align-center">
                                            0
                                        </div>
                                        <div class="col-2">
                                            <button class="plus-min" href="#">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>Choose how to pay</h3>
                            <div class="payment-box">
                                <div class="row">
                                    <h5><img class="img-avatar img-avatar48" src="{{ asset('assets/bank_transfer.png') }}" alt=""> Bank Transfer</h5>
                                    <div class="col-8">
                                        <p class="payment-header">Pay in Full</h5>
                                        <p class="smaller">Pay the total now and you're all set.</p>
                                    </div>
                                    <div class="col-4">
                                        IDR {{ number_format($total, 0, ',', '.') }} <span><input type="radio" name="pay-full" id="pay-full"></span>
                                    </div>
                                    <hr>
                                    <div class="col-8">
                                        <p class="payment-header">Pay 50% Now, The Balance Later</p>
                                        <p class="smaller">Pay IDR (50% {{--50 % dari total--}}) now, and the rest IDR (50% {{--50 % dari total--}}) will be automatically charged to the same payment method on (May 4, 2022 {{--Tambah 1 bulan dari tanggal sekarang--}}). No extra fees.
                                            <span><a type="button" onclick="modal-payment">More Detail</a></span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        IDR {{ number_format($total, 0, ',', '.') }} <span><input type="radio" name="pay-full" id="pay-full"></span>
                                    </div>
                                    <hr>
                                    <h5><img class="img-avatar img-avatar48" src="{{ asset('assets/paypal.png') }}" alt=""> PayPal</h5>
                                    <div class="col-8">
                                        <p class="payment-header">Pay in Full</h5>
                                        <p class="smaller">Pay the total now with your PayPal account. It's secure.</p>
                                    </div>
                                    <div class="col-4">
                                        IDR {{ number_format($total, 0, ',', '.') }} <span><input type="radio" name="pay-full" id="pay-full"></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-12 col-xs-12">
                        <div id="wrapper">
                            <div id="sticky">
                                <div class="block-confirm-info">
                                        <div class="row confirm-photo float-right">
                                            <a href="#" onclick="window.history.go(-1); return false;" title="Photo 1">
                                                <img src="{{ URL::asset('/foto/hotel/'.strtolower($hotel[0]->hotel->name).'/'.$hotel[0]->image)}}">
                                            </a>
                                        </div>
                                        <div class="pt-1">
                                        <h5 style="padding-top:10px;">{{ $hotel[0]->hotelType->name }} Room - {{ $hotel[0]->hotel->name }}</h5>
                                        <span>{{ $hotel[0]->hotel->address }}</span>
                                        </div>
                                        <div class="pt-5">
                                        <hr>
                                            <h4>Price Details</h4>
                                            <div class="row">
                                                <div class="col-7">
                                                IDR {{ number_format($hotel[0]->price, 0, ',', '.') }} x {{ $night }} nights
                                                </div>
                                                <div class="col-5 text-right">
                                                IDR {{ number_format($total, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                Discount
                                                </div>
                                                <div class="col-5 text-right">
                                                IDR 0
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-7">
                                                <strong>TOTAL</strong>
                                                </div>
                                                <div class="col-5 text-right">
                                                IDR <strong>{{ number_format($total, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-6">
                    <hr>
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            <i class="fa fa-check"></i> Confirm
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            <div class="row">
            <div class="col-6 login">
            <hr>
            <p>Log in or <a href="{{ route('register') }}">sign up</a> to continue booking</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                        <input type="text"
                            class="form-control form-control-alt {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                            name="login" placeholder="Email Address" required="required">
                        <i class="fa fa-envelope"></i>

                        @error($errors->has('username') || $errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="password"
                        class="form-control form-control-alt @error('password') is-invalid @enderror"
                        id="password" name="password" placeholder="Password" required="required">
                    <i class="fa fa-lock"></i>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="fxt-content-between">
                        <button type="submit" class="btn-fill" style="border-radius: 10px">Log in</button>
                        <a href="forgot-password-1.html" class="switcher-text">Forgot Password</a>
                    </div>
                </div>
            </form>

            <center>
                <p>or with</p>
            </center>
            <div class="confirm-socials">
                <ul>
                    <li class="social-facebook">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="social-twitter">
                        <a href="#" title="twitter"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="social-google">
                        <a href="{{ route('user.login.google') }}" title="google"><i
                                class="fab fa-google"></i></a>
                    </li>
                    <li class="social-linkedin">
                        <a href="#" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="social-pinterest">
                        <a href="#" title="pinterest"><i class="fab fa-pinterest-p"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </section>
    </form>
    </main>
    @include('layouts.user.footer')
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
        });

        window.addEventListener("beforeunload", function (e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });

    </script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <!-- <script>
        // Semi Fixed

        const $win = $(window);
        const $sidebar = $('.sidebar');
        const $footer = $('.footer');

        let windowTop = 0;
        let lastDelta = 0;
        let fixed = false;

        function isFooterInViewport() {
            return $footer.position().top < $win.scrollTop() + $win.height();
        }

        function updateSidebarAbsolutePosition(delta) {
            if ((delta > 0 && lastDelta < 0) || (delta < 0 && lastDelta > 0) || isFooterInViewport()) {
                $sidebar
                    .css({
                        top: $sidebar.offset().top + 'px',
                        bottom: 'auto'
                    })
                    .attr('class', 'sidebar')
                    .addClass('absolute');

                fixed = false;
            }
        }

        function setSidebarFixedBottom() {
            $sidebar
                .attr('class', 'sidebar')
                .attr('style', '')
                .addClass('fixed fixed--bottom');
        }

        function setSidebarFixedTop() {
            $sidebar
                .attr('class', 'sidebar')
                .attr('style', '')
                .addClass('fixed fixed--top');
        }

        $win.scroll(function (e) {
            const newTop = $win.scrollTop();
            const delta = newTop - windowTop;

            if (!fixed) {
                if (delta > 0) {
                    const sidebarBottom = parseInt($sidebar.css('top')) + $sidebar.outerHeight(true);
                    const visibleBottom = newTop + $win.height();

                    if (visibleBottom > sidebarBottom) {
                        if (isFooterInViewport()) {
                            updateSidebarAbsolutePosition(delta);
                        } else {
                            setSidebarFixedBottom();
                            fixed = true;
                        }
                    }
                } else {
                    if ($sidebar.position().top - windowTop > 0) {
                        setSidebarFixedTop();
                        fixed = true;
                    }
                }
            } else {
                updateSidebarAbsolutePosition(delta);
            }

            lastDelta = delta > 0 ? 1 : -1;
            windowTop = newTop;
        });

    </script> -->
    <script>
        $('#check_in').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            $('#check_out').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: new Date(dateStr).fp_incr(1),
                onChange: function(selectedDates, dateStr, instance){
                    var start = new Date($('#check_in').val());
                    var end = new Date($('#check_out').val());
                    var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                    var min_stay = $('#min_stay').val();
                    var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                    if(sum_night < min_stay)
                    {
                        alert("minimum stay is " + min_stay + " days");
                    }
                }
            });
        }
        });
    </script>
</body>
</html>
