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

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/iziToast/iziToast.min.css') }}">
    <script src="{{ asset('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>
    <script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
    <script type="text/javascript">
        Xendit.setPublishableKey('xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F');
    </script>
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
        {{-- <form action="{{ route('villa_booking_user_store') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" > --}}
            {{-- @csrf
            <input type="hidden" id="id_villa" name="id_villa" value="{{ $villa->id_villa }}">
            <input type="hidden" id="firstname" name="firstname" value="{{ $data['firstname'] }}">
            <input type="hidden" id="lastname" name="lastname" value="{{ $data['lastname'] }}">
            <input type="hidden" id="email" name="email" value="{{ $data['email'] }}">
            <input type="hidden" id="phone" name="phone" value="{{ $data['phone'] }}">
            <input type="hidden" id="hotel_room_price" name="hotel_room_price" value="{{ $villa->price }}"> --}}
            <section class="photosGrid" style="background-color:white">
                <div style="padding-top:10px; padding-left:10px; padding-right:10px;">
                    <div style="text-align: justify; padding-bottom:10px">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-sm-12 col-xs-12">
                                <h3>Your Trip</h3>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6 confirm-date-block" id="confirmBookingDateForm">
                                        <div class="fw-bold">Date</div>
                                        <div class="d-none">
                                            <input type="date" name="check_in" value="{{ $data['check_in'] }}">
                                            <input type="date" name="check_out" value="{{ $data['check_out'] }}">
                                        </div>
                                        <div>
                                            <span style="display:inline-block" id='check_in_content'>{{ date_format(date_create($data['check_in']),"d/m/Y") ?? '' }}</span>
                                            -
                                            <span style="display:inline-block" id='check_out_content'>{{ date_format(date_create($data['check_out']),"d/m/Y") ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <a href="#" class="fw-bold" onclick="showDate()" id="openCheckInDate"><u>Edit</u></a>
                                        <a href="#" class="fw-bold d-none" onclick="hideDate()" id="closeCheckInDate"><u>Close</u></a>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3" id="checkInDate"></div> --}}
                                <div class="content sidebar-popup side-check-in-calendar d-none" id="popup_check" style="min-height: 430px; max-height: 430px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div style="display: table;">
                                                <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                    class="col-lg-12">
                                                    {{-- <a type="button" id="clear_date" style="margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a> --}}
                                                </div>
                                                <div class="flatpickr" id="checkInDate" style="text-align: left;">
                                                    {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 confirm-date-block">
                                        <div class="fw-bold">Guest</div>
                                        <div class="d-flex">
                                            <span id="total_guest">{{ request()->adult+request()->child }}</span>
                                            &nbsp;<span>Guests</span>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        {{-- <a href="#" class="fw-bold"><u>Edit</u></a> --}}
                                    </div>
                                    <div class="content sidebar-popup2" style="left: 633px;" id="popup_guest2">
                                        <div class="row" style="margin-top: 10px;" onclick="recountGuest();reinitDetailGuest();">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ Translate::translate('Adults') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ Translate::translate('Age') }} 13+</p>
                                                    </div>
                                                </div>
                                                <div class="col-6"
                                                    style="display: flex; align-items: center; justify-content: end;">
                                                    <div class="row">
                                                        <a type="button" onclick="decrement_by_id('adult')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                        </a>
                                                        <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                            <p>
                                                                <input type="number" id="adult" name="adult" value="{{ $data->adult }}"
                                                                    style="text-align: center; border:none; width:30px;"
                                                                    min="0" step="1" max='{{ $villa->adult ?? 0 }}' readonly>
                                                            </p>
                                                        </div>
                                                        <a type="button" onclick="increment_by_id('adult')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ Translate::translate('Children') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ Translate::translate('Ages') }} 2-12</p>
                                                    </div>
                                                </div>
                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                    <div class="row">
                                                        <a type="button" onclick="decrement_by_id('child')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                            <p><input type="number" id="child" name="child" value="{{ request()->child ?? 0 }}"
                                                                    style="text-align: center; border:none; width:30px;"
                                                                    min="0" step="1" max='{{ $villa->children ?? 0 }}' readonly></p>
                                                        </div>
                                                        <a type="button" onclick="increment_by_id('child')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ Translate::translate('Infant') }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="price-box" style="color: grey">
                                                            {{ Translate::translate('Under') }} 2</p>
                                                    </div>
                                                </div>
                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                    <div class="row">
                                                        <a type="button" onclick="decrement_by_id('infant')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                            <p><input type="number" id="infant" name="infant" value="{{ request()->infant ?? 0 }}"
                                                                    style="text-align: center; border:none; width:30px;"
                                                                    min="0" readonly></p>
                                                        </div>
                                                        <a type="button" onclick="increment_by_id('infant')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <p class="price-box">
                                                            {{ Translate::translate('Pets') }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                                    <div class="row">
                                                        <a type="button" onclick="decrement_by_id('pet')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                                        </a>
                                                        <div
                                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                            <p><input type="number" id="pet" name="pet" value="{{ request()->pet ?? 0 }}"
                                                                    style="text-align: center; border:none; width:30px;"
                                                                    min="0" readonly></p>
                                                        </div>
                                                        <a type="button" onclick="increment_by_id('pet')"
                                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3>Choose how to pay</h3>
                                <div class="payment-box">
                                    <div class="row col-12">
                                        <div class="col-12">
                                            <div class="row" style="font-size: 13px;">
                                                <label class="container-checkbox2">
                                                    <span class="translate-text-group-items">Virtual Account</span>
                                                    <input type="radio" value="va" id="va" name="payment"
                                                        onclick="paymentCheck();choosePaymentMethodForm('virtual_account');" autocomplete="off">
                                                    <span class="checkmark2"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="panel_va" style="display: none;">
                                            <form method="POST" id="va-form" action="{{ route('api.createVa') }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    @csrf
                                                    @guest
                                                        <div class="col-12">
                                                            <label style="margin: 0px; font-weight: 500;">{{ __('user_page.First Name') }}</label>
                                                            <input type="text" class="form-control" name="firstname" id="firstname_va" value="" placeholder="firstname">
                                                            <small id="err-fname-pay" style="display: none;" class="invalid-feedback"></small>
                                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Last Name') }}</label>
                                                            <input type="text" class="form-control" name="lastname" id="lastname_va" value="" placeholder="lastname">
                                                            <small id="err-lname-pay" style="display: none;" class="invalid-feedback"></small>
                                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Email Address') }}</label>
                                                            <input type="email" class="form-control" name="email" id="email_va" value="" placeholder="email">
                                                            <small id="err-eml-pay" style="display: none;" class="invalid-feedback"></small>
                                                        </div>
                                                    @endguest
                                                    @auth
                                                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                                    @endauth
                                                        <input type="hidden" name="id_villa" id="price_total" value="{{ $villa->id_villa }}">
                                                        <input type="hidden" name="check_in" value="{{ request()->check_in }}">
                                                        <input type="hidden" name="check_out" value="{{ request()->check_out }}">
                                                        <input type="hidden" name="adult" value="{{ request()->adult }}">
                                                        <input type="hidden" name="children" value="{{ request()->child }}">
                                                        <input type="hidden" name="infant" value="{{ request()->infant }}">
                                                        <input type="hidden" name="pet" value="{{ request()->pet }}">

                                                        <div id="va_brand" class="row" style="font-size: 13px;">
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/bca-logo.svg') }}">
                                                                    <input class="chckbrnd2" type="radio" value="BCA" id="bca" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/bni-logo.svg') }}">
                                                                    <input class="chckbrnd2" type="radio" value="BNI" id="bni" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/bri-logo.svg') }}">
                                                                    <input class="chckbrnd2" type="radio" value="BRI" id="bri" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/mandiri-logo.svg') }}">
                                                                    <input class="chckbrnd2" type="radio" value="MANDIRI" id="mandiri" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/permata-logo.svg') }}">
                                                                    <input class="chckbrnd2" type="radio" value="PERMATA" id="permata" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label class="container-checkbox2">
                                                                    <img src="{{ URL::asset('assets/payment_logo/bsi-logo.png') }}"
                                                                        style="width: 50%">
                                                                    <input class="chckbrnd2" type="radio" value="BSI" id="bsi" name="bank_option"
                                                                        autocomplete="off">
                                                                    <span class="checkmark2 chckbrnd"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <small id="err-slc-pay" style="display: none;" class="invalid-feedback"></small>
                                                        <div class="mt-3 col-12 text-center d-none"><input class="price-button" type="submit" id="submit-va-form"
                                                            value="{{ Translate::translate('RESERVE NOW') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <div class="row" style="font-size: 13px;">
                                                <label class="container-checkbox2">
                                                    <span class="translate-text-group-items">Credit Card</span>
                                                    <input type="radio" value="credit" id="credit" name="payment"
                                                        onclick="paymentCheck();choosePaymentMethodForm('credit_card');" autocomplete="off">
                                                    <span class="checkmark2"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="panel_credit" style="display: none;">
                                            <form method="POST" id="payment-form" action="javascript:void(0)">
                                                @csrf
                                                @auth
                                                    <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                                @endauth
                                                <input type="hidden" name="price_total" value="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label style="margin: 0px; font-weight: 500;">{{ __('user_page.Card Number') }}</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="card-number"
                                                                    placeholder="Card number" value="" onpaste="return false" oncut="return false" />
                                                                <small id="err-cnm-pay" style="display: none;" class="invalid-feedback"></small>
                                                                {{-- <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Expiration') }}</label>
                                                            <input class="form-control" type="text" id="card-exp-month"
                                                            placeholder="mm/yy" value="" />
                                                            <small id="err-exp-pay" style="display: none;" class="invalid-feedback"></small>
                                                                {{-- <div class="col-md-6">
                                                                    <input class="form-control" type="text" id="card-exp-year"
                                                                    placeholder="Card expiration year (yyyy)" value="" />
                                                                </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4 pull-right hide-if-multi">
                                                        <div class="form-group">
                                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Cvn Code') }}</label>
                                                            <input class="form-control" type="text" id="card-cvn" placeholder="Cvn"
                                                                value="" />
                                                            <small id="err-cvn-pay" style="display: none;" class="invalid-feedback"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <small id="res-xnd-pay" style="display: none;" class="invalid-feedback mt-2 mb-2"></small>
                                                <input class="form-control" type="hidden" id="currency"
                                                    placeholder="IDR" value="IDR" />

                                                <button class="mt-3 col-12 text-center">
                                                    <input class="price-button" type="submit" onclick="submitPaymentCredit(event)" id="submit-payment-form" value="{{ Translate::translate('RESERVE NOW') }}">
                                                </button>
                                            </form>
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
                                                        <img src="{{ URL::asset('/foto/hotel/'.strtolower($villa->name).'/'.$villa->image)}}">
                                                    </a>
                                                </div>
                                                <div class="pt-1">
                                                    <h5 style="padding-top:10px;">{{ $villa->name }} Room - {{ $villa->name }}</h5>
                                                    <span>{{ $villa->address }}</span>
                                                </div>
                                                <div class="pt-5">
                                                    <hr>
                                                    <h4>Price Details</h4>
                                                    <div class="row d-none" id="totalContent">
                                                        <div class="col-7">
                                                        IDR {{ number_format($villa->price, 0, ',', '.') }}
                                                        x
                                                        <span id="total_night">0</span> <span>nights</span>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                            <p id="total" style="margin:0px;">0</p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-none" id="discountContent">
                                                        <div class="col-6">
                                                            <div>{{ Translate::translate('Discount') }}</div>
                                                        </div>
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <div>
                                                                <p id="discount" style="margin:0px;">0</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row d-none" id="cleaningFeeContent">
                                                        <div class="col-6">
                                                            <div>{{ Translate::translate('Cleaning fee') }}</div>
                                                        </div>
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <div>
                                                                <p id="cleaning_fee" style="margin:0px;">0</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row d-none" id="serviceContent">
                                                        <div class="col-6">
                                                            <div>{{ Translate::translate('Service') }}</div>
                                                        </div>
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <div>
                                                                <p style="margin:0px" id="tax">0</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row d-none" id="totalAllContent">
                                                        <div class="col-7">
                                                        <strong>TOTAL</strong>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                        <strong><p id="total_all" style="margin: 0px;">0</p></strong>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p class="price-box fw-bold">
                                                                <span>{{ Translate::translate('Cancellation policy') }}</span>
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="detail-box">
                                                                <span style="text-align: justify; font-size:12px;">100% refund of amount paid if you cancel
                                                                    by Oct 4, 2022. 50% refund of amount paid (minus the service fee) if you cancel by Nov 3,
                                                                    2022. No refund if you cancel after Nov 3, 2022.</span>
                                                            </p>
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
                            <div class="btn btn-lg btn-outline-primary" id="btnConfirm">
                                <i class="fa fa-check"></i> Confirm
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            This is the last step before reserve. Please check your booking summary again.
                        </div>
                    </div>
                    <!-- END Submit -->
            </section>
        {{-- </form> --}}
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

    <script>
        function paymentCheck() {
            if (document.getElementById('va').checked) {
                document.getElementById('panel_va').style.display = 'block';
                document.getElementById('panel_credit').style.display = 'none';
            } else if (document.getElementById('credit').checked) {
                document.getElementById('panel_va').style.display = 'none';
                document.getElementById('panel_credit').style.display = 'block';
            }
        }
    </script>
    <script>
        function fetchTotalPrice() {
            const id = `{{ request()->id_villa }}`;
            const checkIn = new Date($('#confirmBookingDateForm').find(`input[name='check_in']`).val());
            const checkOut = new Date($('#confirmBookingDateForm').find(`input[name='check_out']`).val());
            var sum_night = (checkOut - checkIn) / 1000 / 60 / 60 / 24;

            const formData = {
                id_villa: id,
                check_in: checkIn,
                check_out: checkOut,
                total_night: sum_night,
                sub_total: total
            };
            console.log(formData);

            // disabled change on edit date form
            $('#confirmBookingDateForm').find(`input[name='check_in']`).attr('readonly', true);
            $('#confirmBookingDateForm').find(`input[name='check_out']`).attr('readonly', true);

            $('#totalContent').addClass('d-none');
            $('#discountContent').addClass('d-none');
            $('#cleaningFeeContent').addClass('d-none');
            $('#serviceContent').addClass('d-none');
            $('#totalAllContent').addClass('d-none');

            $.ajax({
                type: "GET",
                url: "/villa/get_total/" + id,
                data: {
                    start: checkIn.toISOString().split("T")[0],
                    end: checkOut.toISOString().split("T")[0],
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    // enabled change on edit date form
                    $('#confirmBookingDateForm').find(`input[name='check_in']`).attr('readonly', false);
                    $('#confirmBookingDateForm').find(`input[name='check_out']`).attr('readonly', false);

                    // append data to element
                    $('#total_night').html(sum_night);
                    $('#total').html(response.total);
                    if(response.discount){
                        $('#discountContent').removeClass('d-none');
                        $('#discount').html(response.discount);
                    }
                    if(response.cleaning_fee){
                        $('#cleaningFeeContent').removeClass('d-none');
                        $('#cleaning_fee').html(response.cleaning_fee);
                    }
                    $('#tax').html(response.tax);
                    $('#total_all').html(response.total_all);
                    $('#payment-form').find(`input[name="price_total"]`).val(response.price);

                    $('#totalContent').removeClass('d-none');
                    $('#serviceContent').removeClass('d-none');
                    $('#totalAllContent').removeClass('d-none');
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }

                    // disabled change on edit date form
                    $('#confirmBookingDateForm').find(`input[name='check_in']`).attr('readonly', false);
                    $('#confirmBookingDateForm').find(`input[name='check_out']`).attr('readonly', false);
                },
            });
        }
        function calendar_availability() {
            console.log('load calendar_availability');
            $.ajax({
                //create an ajax request to display.php
                type: "GET",
                url: "/villa/date_disabled/" + $("#id_villa").val(),
                success: function (data) {
                    const check_in_val = $('#confirmBookingDateForm').find(`input[name='check_in']`).val();
                    const check_out_val = $('#confirmBookingDateForm').find(`input[name='check_out']`).val();

                    $("#checkInDate").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        minDate: "today",
                        inline: true,
                        showMonths:2,
                        mode: "range",
                        defaultDate: [check_in_val, check_out_val],
                        disable: data,
                        onClose: function (selectedDates, dateStr, instance) {
                            // set main form date value
                            $('#confirmBookingDateForm').find(`input[name='check_in']`).val(instance.formatDate(selectedDates[0], "Y-m-d"));
                            $('#confirmBookingDateForm').find(`input[name='check_out']`).val(instance.formatDate(selectedDates[1], "Y-m-d"));
                            // update ui date
                            $('#confirmBookingDateForm').find(`#check_in_content`).text(instance.formatDate(selectedDates[0], "d/m/Y"));
                            $('#confirmBookingDateForm').find(`#check_out_content`).text(instance.formatDate(selectedDates[1], "d/m/Y"));
                            // update virtual account date form value
                            $('#va-form').find(`input[name='check_in']`).val(instance.formatDate(selectedDates[0], "Y-m-d"));
                            $('#va-form').find(`input[name='check_out']`).val(instance.formatDate(selectedDates[1], "Y-m-d"));

                            var start = new Date(
                                instance.formatDate(selectedDates[0], "Y-m-d")
                            );
                            var end = new Date(
                                instance.formatDate(selectedDates[1], "Y-m-d")
                            );
                            var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                            var min_stay = @json($villa->min_stay);
                            if(min_stay){
                                if(sum_night < min_stay){
                                    alert("minimum stay is " + min_stay + " nights  ");
                                } else {
                                    fetchTotalPrice();
                                }
                            } else {
                                fetchTotalPrice();
                            }
                            // close date
                            $('#closeCheckInDate').trigger('click');
                        },
                    });
                },
            });
        }
        $(window).on('load', ()=>{
            fetchTotalPrice();
        });
        function hideDate() {
            console.log('hideDate');
            $('#popup_check').addClass('d-none');
            $('#openCheckInDate').removeClass('d-none');
            $('#closeCheckInDate').addClass('d-none');
        }
        function showDate() {
            console.log('showDate');
            calendar_availability();
            $('#popup_check').removeClass('d-none');
            $('#openCheckInDate').addClass('d-none');
            $('#closeCheckInDate').removeClass('d-none');
        }
    </script>
    <script>
        function recountGuest() {
            let adult = $('#adult').val();
            let children = $('#child').val();
            $('#total_guest').text(parseInt(adult)+parseInt(children));
        }
        function reinitDetailGuest() {
            const adultTotal = $("#adult").val();
            let childTotal = $('#child').val();
            let infantTotal = $('#infant').val();
            let petTotal = $('#pet').val();
            $('#va-form').find(`input[name="adult"]`).val(adultTotal);
            $('#va-form').find(`input[name="children"]`).val(childTotal);
            $('#va-form').find(`input[name="infant"]`).val(infantTotal);
            $('#va-form').find(`input[name="pet"]`).val(petTotal);
        }
        function increment_by_id(elementId) {
            document.getElementById(elementId).stepUp();
        }
        function decrement_by_id(elementId) {
            document.getElementById(elementId).stepDown();
        }
    </script>
    <script>
        function choosePaymentMethodForm(formIndicator) {
            console.log('hit choosePaymentMethodForm');
            $('#btnConfirm').attr('onclick', `summitingForm('${formIndicator}')`);
        }
        function summitingForm(formIndicator) {
            console.log('hit summitingForm');
            if(formIndicator == 'virtual_account'){
                $('#submit-va-form').trigger('click');
            } else if(formIndicator == 'credit_card'){
                $('#submit-payment-form').trigger('click');
            }
        }
    </script>
    <script>
        $(function() {
            // Virtual Account
            @guest
            // var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;

            $(document).on("focusout", "#firstname_va", function () {
                if(!$(this).val()) {
                    $('#firstname_va').addClass('is-invalid');
                    $('#err-fname-pay').text('{{ __('auth.empty_fname') }}');
                    $('#err-fname-pay').show();
                }
            });
            $(document).on("focusout", "#lastname_va", function () {
                if(!$(this).val()) {
                    $('#lastname_va').addClass('is-invalid');
                    $('#err-lname-pay').text('{{ __('auth.empty_lname') }}');
                    $('#err-lname-pay').show();
                }
            });
            $(document).on("focusout", "#email_va", function () {
                if(!$(this).val()) {
                    $('#email_va').addClass('is-invalid');

                    $('#err-eml-pay').text('{{ __('auth.empty_mail') }}');
                    $('#err-eml-pay').show();
                } else {
                    if (!regex.test($(this).val())) {
                        $('#email_va').addClass('is-invalid');
                        $('#err-eml-pay').text('{{ __('auth.invalid_mail') }}');
                        $('#err-eml-pay').show();
                    }
                }
            });

            $(document).on("keyup", "#firstname_va", function () {
                this.value = this.value.replace(/[0-9]+$/, '');
                $('#firstname_va').removeClass('is-invalid');
                $('#err-fname-pay').hide();
                $('#err-fname-pay').text('');
            });
            $(document).on("keyup", "#lastname_va", function () {
                this.value = this.value.replace(/[0-9]+$/, '');
                $('#lastname_va').removeClass('is-invalid');
                $('#err-lname-pay').hide();
                $('#err-lname-pay').text('');
            });
            $(document).on("keyup", "#email_va", function () {
                $('#email_va').removeClass('is-invalid');
                $('#err-eml-pay').hide();
                $('#err-eml-pay').text('');
            });
            @endguest
            $(".chckbrnd2").change(function () {
                $('#va_brand').each(function() {
                    if($(this).find('input[type="radio"]:checked').length > 0) {
                        $('.chckbrnd').css("border", "");
                        $('#err-slc-pay').hide();
                        $('#err-slc-pay').text('');
                    }
                });
            });
            $("#va-form").submit(function(e) {
                let error = 0;
                @guest
                let valname = /[0-9]+$/;
                if(!$('#firstname_va').val()) {
                    $('#firstname_va').addClass('is-invalid');
                    $('#err-fname-pay').text('{{ __('auth.empty_fname') }}');
                    $('#err-fname-pay').show();
                    error = 1;
                } else {
                    if (valname.test($('#firstname_va').val())) {
                        $('#firstname_va').addClass('is-invalid');
                        $('#err-fname-pay').text('{{ __('auth.invalid_fname') }}');
                        $('#err-fname-pay').show();
                        error = 1;
                    }
                }
                if(!$('#lastname_va').val()) {
                    $('#lastname_va').addClass('is-invalid');
                    $('#err-lname-pay').text('{{ __('auth.empty_lname') }}');
                    $('#err-lname-pay').show();
                    error = 1;
                } else {
                    if (valname.test($('#lastname_va').val())) {
                        $('#lastname_va').addClass('is-invalid');
                        $('#err-lname-pay').text('{{ __('auth.invalid_lname') }}');
                        $('#err-lname-pay').show();
                        error = 1;
                    }
                }
                if(!$('#email_va').val()) {
                    $('#email_va').addClass('is-invalid');
                    $('#err-eml-pay').text('{{ __('auth.empty_mail') }}');
                    $('#err-eml-pay').show();
                    error = 1;
                } else {
                    if (!regex.test($('#email_va').val())) {
                        $('#email_va').addClass('is-invalid');
                        $('#err-eml-pay').text('{{ __('auth.invalid_mail') }}');
                        $('#err-eml-pay').show();
                        error = 1;
                    }
                }
                @endguest
                $('#va_brand').each(function() {
                    if($(this).find('input[type="radio"]:checked').length == 0) {
                        $('.chckbrnd').css("border", "solid #e04f1a 1px");
                        $('#err-slc-pay').text('{{ __('auth.empty_va') }}');
                        $('#err-slc-pay').show();
                        error = 1;
                    }
                });
                if(error == 1) {
                    e.preventDefault();
                }
            });
        });
    </script>
    <script>
    //Credit Card
        $('#card-number').mask('0000 0000 0000 0000');
        $('#card-exp-month').mask('00/00');
        $('#card-cvn').mask('0000');

        $(document).on("focusout", "#card-number", function () {
            if(!$(this).val()) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text('{{ __('auth.empty_cnm') }}');
                $('#err-cnm-pay').show();
            }
        });
        $(document).on("focusout", "#card-exp-month", function () {
            if(!$(this).val()) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                $('#err-exp-pay').show();
            }
        });
        $(document).on("focusout", "#card-cvn", function () {
            if(!$(this).val()) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                $('#err-cvn-pay').show();
            }
        });

        $(document).on("keyup", "#card-number", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-number').removeClass('is-invalid');
            $('#err-cnm-pay').hide();
            $('#err-cnm-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        $(document).on("keyup", "#card-exp-month", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-exp-month').removeClass('is-invalid');
            $('#err-exp-pay').hide();
            $('#err-exp-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        $(document).on("keyup", "#card-cvn", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-cvn').removeClass('is-invalid');
            $('#err-cvn-pay').hide();
            $('#err-cvn-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        //================ Function ================
        function xenditResponseHandler(err, creditCardToken) {
            if(err) {
                return displayError(err);
            }

            if(creditCardToken.status === 'APPROVED' || creditCardToken.status === 'VERIFIED') {
                displaySuccess(creditCardToken);
            } else if (creditCardToken.status === 'IN_REVIEW') {
                // window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');
                // $('.overlay').show();
                // $('#three-ds-container').show();
                // $('#modal-3ds').modal('show');
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FRAUD') {
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FAILED') {
                displayError(creditCardToken);
            }
        }

        function displayError(err) {
            let error = JSON.stringify(err, null, 4);
            let xparse = JSON.parse(error);
            let text = xparse.message;
            if(text.match("number")) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text(xparse.message);
                $('#err-cnm-pay').show();
            }
            if(text.match("expiration")) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text(xparse.message);
                $('#err-exp-pay').show();
            }
            if(text.match("CVN")) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text(xparse.message);
                $('#err-cvn-pay').show();
            }
            $('#res-xnd-pay').text("Error from API : " + xparse.message);
            $('#res-xnd-pay').show();

        };

        function displaySuccess(creditCardToken) {
            var requestData = {};
            $.extend(requestData, getTokenData());
            @auth
            var saveData = $.ajax({
                type: 'POST',
                url: "/api/xendit/credit_card/charge",
                data: {
                    dataresult: creditCardToken,
                    datarequest: requestData,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "text",
                success: function(resultData) {
                    alert("success ")
                }
            });
            @endauth
            saveData.error(function() {
                alert("Something went wrong");
            });
        }

        // function getTokenData() {
        //     let exp = $('#card-exp-month').val();
        //     const split = exp.split("/");
        //     var cnum = $('#card-number').val();
        //     var cvn = $('#card-cvn').val();
        //     return {
        //         amount: $('#price_total2').val(),
        //         card_number: cnum.replace(/\s/g, ''),
        //         card_exp_month: split[0],
        //         card_exp_year: 20 + split[1],
        //         card_cvn: $.trim(cvn),
        //         currency: $('#currency').val(),
        //     };
        // }
        function getTokenData() {
            let exp = $('#card-exp-month').val();
            const split = exp.split("/");
            var cnum = $('#card-number').val();
            var cvn = $('#card-cvn').val();
            return {
                amount: $('#payment-form').find(`input[name="price_total"]`).val(),
                card_number: cnum.replace(/\s/g, ''),
                card_exp_month: split[0],
                card_exp_year: 20 + split[1],
                card_cvn: $.trim(cvn),
                currency: $('#currency').val(),
            };
        }
        //================ Function ================
        function submitPaymentCredit(e) {
            console.log('hit submt payment form');
            let error = 0;
            let valname = /[a-zA-Z]+$/;
            if(!$('#card-number').val()) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text('{{ __('auth.empty_cnm') }}');
                $('#err-cnm-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-number').val())) {
                    $('#card-number').addClass('is-invalid');
                    $('#err-lname-pay').text('{{ __('auth.empty_cnm') }}');
                    $('#err-lname-pay').show();
                    error = 1;
                }
            }
            if(!$('#card-exp-month').val()) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                $('#err-exp-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-exp-month').val())) {
                    $('#card-exp-month').addClass('is-invalid');
                    $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                    $('#err-exp-pay').show();
                    error = 1;
                }
            }
            if(!$('#card-cvn').val()) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                $('#err-cvn-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-cvn').val())) {
                    $('#card-cvn').addClass('is-invalid');
                    $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                    $('#err-cvn-pay').show();
                    error = 1;
                }
            }
            if(error == 1) {
                e.preventDefault();
            } else {
                Xendit.setPublishableKey(
                    'xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F'
                );
                $("#payment-form").find('.submit').prop('disabled', true);
                var tokenData = getTokenData();
                Xendit.card.createToken(tokenData, xenditResponseHandler);
                return false;
            }
        }
    </script>
</body>
</html>
