<!-- Fade In Default Modal -->

<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .d-none {
        display: none;
    }

    .modal-header-login {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
        display: flex;
    }

    .modal-body-login {
        padding: 1rem;
        height: 500px !important;
        display: flex;
        align-items: center;
    }

    .modal-content-login {
        background-color: white;
        width: 55% !important;
        box-shadow: 1px 1px 15px rgb(0 0 0 / 16%);
    }

    .modal-login {
        z-index: 1300;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .modal-login-title {
        font-family: "Poppins" !important;
        color: #3A3845;
        font-size: 32px;
        margin-bottom: 1rem;
        font-weight: 600;
        margin-top: 1rem;
    }

    .filter-language-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: grey;
        cursor: pointer;
    }

    .filter-language-option-text:active {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-text:hover {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-container {
        padding-bottom: 10px;
    }

    .filter-language-option-text:focus {
        border: none !important;
    }

    .column.right {
        width: 75%;
        float: left;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: black !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }

    /* Start of filter modal*/
    .btn-close-modal {
        background: none !important;
        border: none;
    }

    .filter-modal {
        justify-content: flex-end;
    }

    .modal-filter-footer-language {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        border-top: none;
        height: 20px;
    }

    .login-container {
        width: 70%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    .register-container {
        width: 80%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    /* End of filter modal*/

    .form-control {
        font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    ::placeholder {
        font-size: 1rem !important;
    }

    .text-small {
        font-size: 12px;
        margin-bottom: -10px;
    }

    .text-small a {
        font-size: 12px;
        color: #ff7400;
        cursor: pointer;
    }

    .right {
        text-align: right;
    }

    .modal-header {
        padding: 1rem 3rem;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .modal-login-title p {
        font-size: 14px;
        margin-bottom: 10px;
        margin-top: -10px;
        font-weight: 400;
    }

    .nav-tabs li {
        margin-right: 10px;
    }

    .login-register-label {
        margin: 0px;
        font-weight: 500;
    }

    .switcher-text2 {
        margin: 0px !important;
        width: unset !important;
    }

    .login-button {
        margin-right: 15px;
        background-color: #ff7400;
        color: white;
        padding: 10px 30px;
        border-radius: 5px
    }

    @media only screen and (max-width: 480px) {
        .modal-content-login {
            width: 100% !important;
            border-radius: 0px !important;
        }

        .login-button {
            padding: 5px 12px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }

    @media only screen and (min-width: 481px) and (max-width: 767px) {
        .modal-content-login {
            width: 100% !important;
            border-radius: 0px !important;
        }

        .login-button {
            padding: 7px 14px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .modal-content-login {
            width: 95% !important;
        }

        .login-button {
            padding: 9px 14px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }
    @media only screen and (min-width: 992px) {
        .modal-body-login {
            height: 100% !important;
        }
    }
    .nav-tabs>li {
        width: auto !important;
    }
    input::-ms-reveal, input::-ms-clear {
        display: none;
    }

    /* Loading Animation */
    .container-loading-animation{
        position:absolute;
        top:50%;
        left:50%;
        right:auto;
        bottom:auto;
        transform:translate(-50%, -50%);
        z-index: 1;
    }
    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid #ddd;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #ddd transparent transparent transparent;
    }
    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }
    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }
    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }
    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div id="LoginModal" class="modal modal-login fade bs-example-modal-lg">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-horizontal-centered modal-fullscreen-md-down"
        style="overflow-y: initial !important;">
        <div class="modal-content modal-content-login" style="border-radius:15px;">
            <div class="modal-header">
                <div class="col-lg-10">
                    <ul class="nav filter-language-option-container nav-tabs sideTab column"
                        style="display: flex; flex-wrap: nowrap; padding: 0px;">

                        <li id="trigger-tab-register" onclick="switchTabLogin('register')" class="active"><a
                                class="filter-language-option-text">{{ __('user_page.Register') }}</a></li>

                        <li id="trigger-tab-login" onclick="switchTabLogin('login')"><a
                                class="tab1 filter-language-option-text">{{ __('user_page.Login') }}</a></li>

                    </ul>
                </div>
                <div class="col-lg-2 right">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="modal-body modal-body-login">
                <div class="container-loading-animation d-none">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                </div>
                <div class="tabbable column-wrapper col-12">
                    <!-- Only required for left/right tabs -->
                    <div class="tab-content tab-content-language column rigth" id="tabs">
                        <div class="tab-pane" id="content-tab-login">
                            <div class="login-container">
                                <div class="col-12 modal-login-title ">
                                    <div class="alert alert-danger d-none" id="loginAlert"
                                        style="font-size: 14px; font-weight: 400;" role="alert">
                                        Make your account today, and save more our best listing.
                                    </div>
                                    <h3 class="text-center">{{ __('user_page.Log In') }}</h3>
                                    <p class="text-center text-muted">
                                        {{ __('user_page.Log in to continue in our website') }}</p>
                                </div>
                                <div class="col-12">
                                    <form id="frmLgn" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label
                                                    class="login-register-label">{{ __('user_page.Email Address') }}</label>
                                                <input type="email" id="email-login"
                                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email" placeholder="{{ __('user_page.Email Address') }}">
                                                <small id="err-eml-lgn" style="display: none;"
                                                    class="invalid-feedback"></small>
                                                @if ($errors->has('email'))
                                                    @forelse ($errors->get('email') as $error)
                                                        <small id="err-bcknd"
                                                            class="invalid-feedback">{{ $error }}</small>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12" style="position: relative;">
                                                <label
                                                    class="login-register-label">{{ __('user_page.Password') }}</label>
                                                <input type="password" id="password-login"
                                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" placeholder="{{ __('user_page.Password') }}">
                                                <i id="tp-log" class="fa fa-eye-slash" aria-hidden="true"
                                                    style="position: absolute; top: 35px; right: 24px;"></i>
                                                <small id="err-pas-lgn" style="display: none;"
                                                    class="invalid-feedback"></small>
                                                @if ($errors->has('password'))
                                                    @forelse ($errors->get('password') as $error)
                                                        <small class="invalid-feedback">{{ $error }}</small>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12"
                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                <button type="submit" id="btnLogin"
                                                    class="btn login-button">{{ __('user_page.Log in') }}</button>
                                                <a style="font-size: 10pt; color: #7F8487;" href="/password/reset"
                                                    class="switcher-text2">{{ __('user_page.Forgot Password') }}</a>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="socialite-login">
                                                <p class="text-center" style="font-size: 10pt; margin-bottom: 10px;">
                                                    {{ __('user_page.or login with') }}</p>
                                                <div class="icon-socialite d-flex" style="justify-content: center;">
                                                    <a href="{{ route('user.login.facebook') }}" class="btn"
                                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #11468F; display: flex; align-items: center; justify-content: center; margin-right: 10px;"
                                                        title="Facebook"><i class="fab fa-facebook-f"
                                                            style="color: white;"></i></a>
                                                    <a href="{{ route('user.login.google') }}" class="btn"
                                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #B33030; display: flex; align-items: center; justify-content: center;"
                                                        title="google"><i class="fab fa-google"
                                                            style="color: white;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane active" id="content-tab-register">
                            <div class="register-container">
                                <div class="col-12 modal-login-title ">
                                    <div class="alert alert-danger d-none" id="registerAlert"
                                        style="font-size: 14px; font-weight: 400;" role="alert">
                                        Make your account today, and save more our best listing.
                                    </div>
                                    <h3 class="text-center">{{ __('user_page.Register') }}</h3>
                                    <p class="text-center text-muted">
                                        {{ __('user_page.Create an account free and enjoy it') }}</p>
                                </div>
                                <div class="col-12">
                                    <form id="frmRgs" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <label
                                                    class="login-register-label">{{ __('user_page.Email Address') }}</label>
                                                <input type="email" id="email-register"
                                                    class="form-control input-text-border {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email"
                                                    placeholder="{{ __('user_page.Email Address') }}">
                                                <small id="err-eml-rgs" style="display: none;"
                                                    class="invalid-feedback"></small>
                                                @if ($errors->has('email'))
                                                    @forelse ($errors->get('email') as $error)
                                                        <small id="err-bcknd"
                                                            class="invalid-feedback">{{ $error }}</small>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </div>
                                        </div>

                                        {{-- <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <label class="login-register-label">Referral Code</label>
                                                <input id="myRef" value="" type="text"
                                                    class="form-control input-text-border" name="referral_code"
                                                    placeholder="Referral Code" readonly>
                                            </div>

                                            <div class="col-lg-12 text-small">
                                                @php
                                                    $user = App\User::select('user_code')
                                                        ->inRandomOrder()
                                                        ->first();

                                                    // echo $user->user_code;

                                                @endphp

                                                @if (!isset($_COOKIE['ref']))
                                                    <label class="login-register-label">Don't have a code?<a
                                                            href="/register?ref={{ $user->user_code }}">
                                                            <b>&nbsp;Ask here!</b></a></label>
                                                @endif
                                            </div>
                                        </div> --}}

                                        <div class="row mt-3">
                                            <div class="col-lg-6 d-none" style="position: relative;" id="passwordID">
                                                <label
                                                    class="login-register-label">{{ __('user_page.Password') }}</label>
                                                <input type="password" id="password-register"
                                                    class="form-control input-text-border  {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" placeholder="{{ __('user_page.Password') }}">
                                                <i id="tp-reg" class="fa fa-eye-slash" aria-hidden="true"
                                                    style="position: absolute; top: 35px; right: 24px;"></i>
                                                <small id="err-pas-rgs" style="display: none;"
                                                    class="invalid-feedback"></small>
                                                @if ($errors->has('password'))
                                                    @forelse ($errors->get('password') as $error)
                                                        <small class="invalid-feedback">{{ $error }}</small>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </div>
                                            <div class="col-lg-6 d-none" style="position: relative;"
                                                id="confirmPasswordID">
                                                <label
                                                    class="login-register-label">{{ __('user_page.Confirm Password') }}</label>
                                                <input type="password" id="password_confirmation"
                                                    class="form-control input-text-border  {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                    name="password_confirmation"
                                                    placeholder="{{ __('user_page.Password') }}">
                                                <i id="tcp-reg" class="fa fa-eye-slash" aria-hidden="true"
                                                    style="position: absolute; top: 35px; right: 24px;"></i>
                                                <small id="err-cpas-rgs" style="display: none;"
                                                    class="invalid-feedback"></small>
                                                @if ($errors->has('password'))
                                                    @forelse ($errors->get('password_confirmation') as $error)
                                                        <small class="invalid-feedback">{{ $error }}</small>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12"
                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                <button type="button" class="btn login-button"
                                                    id="continueID">Continue
                                                    with
                                                    Email</button>
                                                <button type="submit" class="btn login-button d-none"
                                                    id="confirmID">Create
                                                    Account</button>
                                                <span class="switcher-text2"
                                                    style="font-size: 10pt;">{{ __('user_page.Already registered') }}?
                                                    <a style="color: #ff7400;" href="#!"
                                                        onclick="switchTabLogin('login')">{{ __('user_page.Login') }}</a></span>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="d-none" id="termID">
                                                <p>By signing in or creating an account, you agree with our
                                                    <a href="{{ route('terms') }}" style="color: #ff7400">Terms &
                                                        Conditions</a> and
                                                    <a href="{{ route('privacy_policy') }}"
                                                        style="color: #ff7400">Privacy Statement</a>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="socialite-login">
                                                <p class="text-center" style="font-size: 10pt; margin-bottom: 10px;">
                                                    {{ __('user_page.or login with') }}</p>
                                                <div class="icon-socialite d-flex" style="justify-content: center;">
                                                    <a href="{{ route('user.login.facebook') }}" class="btn"
                                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #11468F; display: flex; align-items: center; justify-content: center; margin-right: 10px;"
                                                        title="Facebook"><i class="fab fa-facebook-f"
                                                            style="color: white;"></i></a>
                                                    <a href="{{ route('user.login.google') }}" class="btn"
                                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #B33030; display: flex; align-items: center; justify-content: center;"
                                                        title="google"><i class="fab fa-google"
                                                            style="color: white;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer-language">

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    // Validation
    $(function() {
        // var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;

        $("#tp-log, #tp-reg, #tcp-reg").hover(function() {
            $(this).css('cursor', 'pointer');
        });

        //login
        $(document).on("click", "#tp-log", function() {
            $(this).toggleClass("fa-eye-slash fa-eye");
            var input = $("#password-login");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).on("focusout", "#email-login", function() {
            if (!$(this).val()) {
                $('#email-login').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#email-login').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                }
            }
        });
        $(document).on("focusout", "#password-login", function() {
            if (!$(this).val()) {
                $('#tp-log').hide();
                $('#password-login').addClass('is-invalid');
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
            }// else {
            //     if ($('#password-login').val().length < 8) {
            //         $('#tp-log').hide();
            //         $('#password-login').addClass('is-invalid');
            //         $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
            //         $('#err-pas-lgn').show();
            //         error = 1;
            //     }
            // }
        });
        $(document).on("keyup", "#email-login", function() {
            $('#email-login').removeClass('is-invalid');
            $('#err-bcknd').hide();
            $('#err-eml-lgn').hide();
            $('#err-eml-lgn').text('');
        });
        $(document).on("keyup", "#password-login", function() {
            $('#password-login').removeClass('is-invalid');
            $('#tp-log').show();
            $('#err-pas-lgn').hide();
            $('#err-pas-lgn').text('');
        });
        $("#frmLgn").submit(function(e) {
            let error = 0;
            if (!$('#email-login').val()) {
                $('#email-login').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
                error = 1;
            } else {
                if (!regex.test($('#email-login').val())) {
                    $('#email-login').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                    error = 1;
                }
            }
            if (!$('#password-login').val()) {
                $('#tp-log').hide();
                $('#password-login').addClass('is-invalid');
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
                error = 1;
            } else {
                if ($('#password-login').val().length < 8) {
                    $('#tp-log').hide();
                    $('#password-login').addClass('is-invalid');
                    $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
                    $('#err-pas-lgn').show();
                    error = 1;
                }
            }

            // if(error == 1){
            //     e.preventDefault();
            // }

            if(typeof event.cancelable !== 'boolean' || event.cancelable){
                e.preventDefault();
                if(error == 0){
                    $('.container-loading-animation').removeClass('d-none')
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function( data ){
                            location.reload();
                        },
                        error: function( response ){
                            $('.container-loading-animation').addClass('d-none')
                            $('.invalid-feedback').hide()
                            $('.invalid-feedback').text('')
                            $('.form-control').removeClass('is-invalid')

                            if(response.status == 200){
                                location.reload();
                            }else{
                                var errors = response.responseJSON;
                                $.each(errors.errors,function (el, val) {
                                    let idErrorMessage = el == 'email' ? '#err-eml-lgn' : '#err-pas-lgn'

                                    $('#frmLgn input[name='+el+']').addClass('is-invalid')
                                    $(idErrorMessage).show()
                                    $.each(val, function(index, errMessage){
                                        $(idErrorMessage).text(errMessage)
                                    })

                                });
                            }

                        }
                    });
                }
            }


        });

        //register
        $(document).on("click", "#tp-reg", function() {
            $(this).toggleClass("fa-eye-slash fa-eye");
            var input = $("#password-register");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).on("click", "#tcp-reg", function() {
            $(this).toggleClass("fa-eye-slash fa-eye");
            var input = $("#password_confirmation");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).on("click", "#continueID", function() {
            var email = $('#email-register').val();
            if (!email) {
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
            } else {
                if (!regex.test(email)) {
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                } else {
                    $('#passwordID').removeClass('d-none');
                    $('#confirmPasswordID').removeClass('d-none');
                    $('#confirmID').removeClass('d-none');
                    $('#continueID').addClass('d-none');
                    $('#createID').removeClass('d-none');
                    $('#termID').removeClass('d-none');
                }
            }
        });

        $(document).on("focusout", "#email-register", function() {
            if (!$(this).val()) {
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                }
            }
        });
        $(document).on("focusout", "#password-register", function() {
            if (!$(this).val()) {
                $('#tp-reg').hide();
                $('#password-register').addClass('is-invalid');
                $('#err-pas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-pas-rgs').show();
            } else {
                if ($('#password-register').val().length < 8) {
                    $('#tp-reg').hide();
                    $('#password-register').addClass('is-invalid');
                    $('#err-pas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-pas-rgs').show();
                }
            }
        });
        $(document).on("focusout", "#password_confirmation", function() {
            if (!$(this).val()) {
                $('#tcp-reg').hide();
                $('#password_confirmation').addClass('is-invalid');
                $('#err-pas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-pas-rgs').show();
            } else {
                if ($('#password_confirmation').val().length < 8) {
                    $('#tcp-reg').hide();
                    $('#password_confirmation').addClass('is-invalid');
                    $('#err-cpas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-cpas-rgs').show();
                }
            }
        });

        $(document).on("keyup", "#email-register", function() {
            $('#email-register').removeClass('is-invalid');
            $('#err-bcknd').hide();
            $('#err-eml-rgs').hide();
            $('#err-eml-rgs').text('');
        });
        $(document).on("keyup", "#password-register", function() {
            $('#password-register').removeClass('is-invalid');
            $('#tp-reg').show();
            $('#err-pas-rgs').hide();
            $('#err-pas-rgs').text('');
        });
        $(document).on("keyup", "#password_confirmation", function() {
            $('#password_confirmation').removeClass('is-invalid');
            $('#tcp-reg').show();
            $('#err-cpas-rgs').hide();
            $('#err-cpas-rgs').text('');
        });
        $("#frmRgs").submit(function(e) {
            let error = 0;
            let CPass = $('#password-register').val();

            // reset input style
            $('.invalid-feedback').hide()
            $('.invalid-feedback').text('')
            $('.form-control').removeClass('is-invalid')

            // validasi
            if (!$('#email-register').val()) {
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
                error = 1;
            } else {
                if (!regex.test($('#email-register').val())) {
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                    error = 1;
                }
            }
            if (!$('#password-register').val()) {
                $('#tp-reg').hide();
                $('#password-register').addClass('is-invalid');
                $('#err-pas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-pas-rgs').show();
                error = 1;
            } else {
                if ($('#password-register').val().length < 8) {
                    $('#tp-reg').hide();
                    $('#password-register').addClass('is-invalid');
                    $('#err-pas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-pas-rgs').show();
                    error = 1;
                }
            }
            if (!$('#password_confirmation').val()) {
                $('#tcp-reg').hide();
                $('#password_confirmation').addClass('is-invalid');
                $('#err-cpas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-cpas-rgs').show();
                error = 1;
            } else {
                if ($('#password_confirmation').val().length < 8) {
                    $('#tcp-reg').hide();
                    $('#password_confirmation').addClass('is-invalid');
                    $('#err-cpas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-cpas-rgs').show();
                    error = 1;
                } else {
                    if ($('#password_confirmation').val() !== CPass) {
                        $('#tcp-reg').hide();
                        $('#password_confirmation').addClass('is-invalid');
                        $('#err-cpas-rgs').text('{{ __('auth.invalid_password') }}');
                        $('#err-cpas-rgs').show();
                        error = 1;
                    }
                }
            }

            // if(error == 1){
            //     e.preventDefault();
            // }

            if(typeof event.cancelable !== 'boolean' || event.cancelable){
                e.preventDefault();
                if(error == 0){
                    $('.container-loading-animation').removeClass('d-none')

                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function( data ){
                            location.reload();
                        },
                        error: function( response ){
                            $('.container-loading-animation').addClass('d-none')

                            var errors = response.responseJSON;
                            $.each(errors.errors,function (el, val) {
                                let idErrorMessage = el == 'email' ? '#err-eml-rgs' : '#err-pas-rgs'

                                $('#frmRgs input[name='+el+']').addClass('is-invalid')
                                $(idErrorMessage).show()
                                $.each(val, function(index, errMessage){
                                    $(idErrorMessage).text(errMessage)
                                })

                            });
                        }
                    });
                }
            }

        });
    });
</script>

@if ($errors->has('email') || $errors->has('password'))
    <script>
        $(document).ready(function() {
            $('#LoginModal').modal({
                show: true
            });
        });
    </script>
@endif

<script>
    function switchTabLogin(indicator) {
        if (indicator == 'login') {
            $('#trigger-tab-register').removeClass('active');
            $('#content-tab-register').removeClass('active');
            $('#trigger-tab-login').addClass('active');
            $('#content-tab-login').addClass('active');
        }
        if (indicator == 'register') {
            $('#trigger-tab-register').addClass('active');
            $('#content-tab-register').addClass('active');
            $('#trigger-tab-login').removeClass('active');
            $('#content-tab-login').removeClass('active');
        }
    }
</script>

<script>
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    var url_string2 = window.location.href
    var url2 = new URL(url_string2);

    if (url2.searchParams.get('ref')) {
        setCookie("ref", url2.searchParams.get('ref'), 1095);
    }
    let ref3 = getCookie("ref");
    console.log(ref3);
    document.getElementById("myRef").value = ref3;
</script>

<script>
    var url_string = window.location.href
    var url = new URL(url_string);
    var ref = url.searchParams.get("ref");
</script>

<script>
    $("form :input").attr("autocomplete", "off");
</script>
