@extends('layouts.login.app')

@section('title', 'Become a Host - EZV2')

@section('content')
    <style>
        .d-none {
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
            z-index: 3;
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

    <section class="fxt-template-animation fxt-template-layout1">
        <div class="container-loading-animation d-none">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <a href="{{ route('index') }}" class="fxt-logo"><img
                                    src="{{ asset('assets/login/img/ezv2-logo.png') }}" alt="Logo"
                                    style="width: 100px"></a>
                            <div class="fxt-page-switcher">
                                <a href="{{ route('register') }}" class="switcher-text1">Register</a>
                                <a href="{{ route('login') }}" class="switcher-text1">Log In</a>
                                <a href="{{ route('register.partner') }}" class="switcher-text1 active">Become a Host</a>
                            </div>
                        </div>
                        <div class="fxt-form">
                            <h2>Register</h2>
                            <p>Create an account free and enjoy it</p>
                            <form id="frmPrtnr" action="{{ route('register.partner.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <select name="role_id" id="role-register"
                                            class="form-control form-control-alt @error('role_id') is-invalid @enderror">
                                            <option value="3">Host</option>
                                        </select>
                                        <i class="flaticon-user flaticon"></i>
                                        <small id="err-rol-rgs" style="display: none;" class="invalid-feedback"></small>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <small id="err-bcknd" class="invalid-feedback">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="email"
                                            class="form-control form-control-alt @error('email') is-invalid @enderror"
                                            id="email-register" name="email" value="{{ old('email') }}" placeholder="Email">
                                        <i id="fvicn-eml" class="flaticon-envelope flaticon"></i>
                                        <small id="err-eml-rgs" style="display: none;" class="invalid-feedback"></small>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <small id="err-bcknd" class="invalid-feedback">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-none" id="passwordID">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input type="password"
                                            class="form-control form-control-alt @error('password') is-invalid @enderror"
                                            id="password-register" name="password" placeholder="Password">
                                        <i id="fvicn-pas" class="flaticon-padlock flaticon"></i>
                                        <small id="err-pas-rgs" style="display: none;" class="invalid-feedback"></small>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <small id="err-bcknd" class="invalid-feedback">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-none" id="confirmPasswordID">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input type="password" class="form-control form-control-alt"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Confirm Password">
                                        <i id="fvicn-cpas" class="flaticon-padlock flaticon"></i>
                                        <small id="err-cpas-rgs" style="display: none;" class="invalid-feedback"></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-content-between">
                                            <button type="button" class="fxt-btn-fill"
                                                id="continueID" style="border-radius: 10px">Continue
                                                with Email</button>
                                            <button type="submit" class="fxt-btn-fill d-none" id="createID"
                                                style="border-radius: 10px">Create
                                                Account</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="d-none" id="termID">
                            <p>By signing in or creating an account, you agree with our
                                <a href="{{ route('terms') }}" style="color: #ff7400">Terms & Conditions</a> and
                                <a href="{{ route('privacy_policy') }}" style="color: #ff7400">Privacy Statement</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 fxt-none-767 fxt-bg-img"
                    data-bg-image="https://source.unsplash.com/rf5R1qXwlDU">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Validation
    $(function () {
        // var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;
        $(document).on("click", "#continueID", function () {
            var email = $('#email-register').val();
            if(!email) {
                $('#fvicn-eml').css("top", "35%");
                $('#fvicn-eml').hide();
                $('#email-register').css("border-bottom-color", "#ff0000");
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
            } else {
                if (!regex.test(email)) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#fvicn-eml').hide();
                    $('#email-register').css("border-bottom-color", "#ff0000");
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                } else {
                    $('#fvicn-eml').css("top", "50%");
                    $('#passwordID').removeClass('d-none');
                    $('#confirmPasswordID').removeClass('d-none');
                    $('#confirmID').removeClass('d-none');
                    $('#continueID').addClass('d-none');
                    $('#createID').removeClass('d-none');
                    $('#termID').removeClass('d-none');
                }
            }
        });

        $(document).on("focusout", "#email-register", function () {
            if(!$(this).val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#fvicn-eml').hide();
                $('#email-register').css("border-bottom-color", "#ff0000");
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#fvicn-eml').hide();
                    $('#email-register').css("border-bottom-color", "#ff0000");
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                }
            }
        });
        $(document).on("focusout", "#password-register", function () {
            if(!$(this).val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#fvicn-pas').hide();
                $('#password-register').css("border-bottom-color", "#ff0000");
                $('#password-register').addClass('is-invalid');
                $('#err-pas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-pas-rgs').show();
            } else {
                if($('#password-register').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#fvicn-pas').hide();
                    $('#password-register').css("border-bottom-color", "#ff0000");
                    $('#password-register').addClass('is-invalid');
                    $('#err-pas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-pas-rgs').show();
                }
            }
        });
        $(document).on("focusout", "#password_confirmation", function () {
            if(!$(this).val()) {
                $('#fvicn-cpas').css("top", "35%");
                $('#fvicn-cpas').hide();
                $('#password_confirmation').css("border-bottom-color", "#ff0000");
                $('#password_confirmation').addClass('is-invalid');
                $('#err-cpas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-cpas-rgs').show();
            } else {
                if($('#password_confirmation').val().length < 8) {
                    $('#fvicn-cpas').css("top", "35%");
                    $('#fvicn-cpas').hide();
                    $('#password_confirmation').css("border-bottom-color", "#ff0000");
                    $('#password_confirmation').addClass('is-invalid');
                    $('#err-cpas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-cpas-rgs').show();
                }
            }
        });

        $(document).on("keyup", "#email-register", function () {
            $('#fvicn-eml').css("top", "50%");
            $('#fvicn-eml').show();
            $('#email-register').css("border-bottom-color", "#e7e7e7");
            $('#email-register').removeClass('is-invalid');
            $('#err-bcknd').hide();
            $('#err-eml-rgs').hide();
            $('#err-eml-rgs').text('');
        });
        $(document).on("keyup", "#password-register", function () {
            $('#fvicn-pas').css("top", "50%");
            $('#fvicn-pas').show();
            $('#password-register').css("border-bottom-color", "#e7e7e7");
            $('#password-register').removeClass('is-invalid');
            $('#err-pas-rgs').hide();
            $('#err-pas-rgs').text('');
        });
        $(document).on("keyup", "#password_confirmation", function () {
            $('#fvicn-cpas').css("top", "50%");
            $('#fvicn-cpas').show();
            $('#password_confirmation').css("border-bottom-color", "#e7e7e7");
            $('#password_confirmation').removeClass('is-invalid');
            $('#err-cpas-rgs').hide();
            $('#err-cpas-rgs').text('');
        });
        $("#frmPrtnr").submit(function(e) {
            let error = 0;
            let CPass = $('#password-register').val();

            // reset input style
            $('.invalid-feedback').hide()
            $('.invalid-feedback').text('')
            $('.form-control').removeClass('is-invalid')
            $('.flaticon').show()
            $('.form-control').css("border-bottom-color", "#e7e7e7");

            // validasi
            if(!$('#email-register').val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#fvicn-eml').hide();
                $('#email-register').css("border-bottom-color", "#ff0000");
                $('#email-register').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-rgs').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-rgs').show();
                error = 1;
            } else {
                if (!regex.test($('#email-register').val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#fvicn-eml').hide();
                    $('#email-register').css("border-bottom-color", "#ff0000");
                    $('#email-register').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-rgs').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-rgs').show();
                    error = 1;
                }
            }
            if(!$('#password-register').val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#fvicn-pas').hide();
                $('#password-register').css("border-bottom-color", "#ff0000");
                $('#password-register').addClass('is-invalid');
                $('#err-pas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-pas-rgs').show();
                error = 1;
            } else {
                if($('#password-register').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#fvicn-pas').hide();
                    $('#password-register').css("border-bottom-color", "#ff0000");
                    $('#password-register').addClass('is-invalid');
                    $('#err-pas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-pas-rgs').show();
                    error = 1;
                }
            }
            if(!$('#password_confirmation').val()) {
                $('#fvicn-cpas').css("top", "35%");
                $('#fvicn-cpas').hide();
                $('#password_confirmation').css("border-bottom-color", "#ff0000");
                $('#password_confirmation').addClass('is-invalid');
                $('#err-cpas-rgs').text('{{ __('auth.empty_password') }}');
                $('#err-cpas-rgs').show();
                error = 1;
            } else {
                if($('#password_confirmation').val().length < 8) {
                    $('#fvicn-cpas').css("top", "35%");
                    $('#fvicn-cpas').hide();
                    $('#password_confirmation').css("border-bottom-color", "#ff0000");
                    $('#password_confirmation').addClass('is-invalid');
                    $('#err-cpas-rgs').text('{{ __('auth.min_password') }}');
                    $('#err-cpas-rgs').show();
                    error = 1;
                } else {
                    if($('#password_confirmation').val() !== CPass) {
                        $('#fvicn-cpas').css("top", "35%");
                        $('#fvicn-cpas').hide();
                        $('#password_confirmation').css("border-bottom-color", "#ff0000");
                        $('#password_confirmation').addClass('is-invalid');
                        $('#err-cpas-rgs').text('{{ __('auth.invalid_password') }}');
                        $('#err-cpas-rgs').show();
                        error = 1;
                    }
                }
            }
            // if(error == 1) {
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
                                let idIconInput = el == 'email' ? '#fvicn-eml' : '#fvicn-pas'

                                $(idIconInput).hide()
                                $(idErrorMessage).show()

                                $('#frmPrtnr input[name='+el+']').addClass('is-invalid')
                                $('#frmPrtnr input[name='+el+']').css("border-bottom-color", "#ff0000")
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
@endsection
