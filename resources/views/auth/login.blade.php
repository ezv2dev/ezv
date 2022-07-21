@extends('layouts.login.app')

@section('title', 'Login - EZV2')

@section('content')
    <style>
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
                            <a href="/" class="fxt-logo"><img src="{{ asset('assets/login/img/ezv2-logo.png') }}"
                                    alt="Logo" style="width: 100px"></a>
                            <div class="fxt-page-switcher">
                                <a href="{{ route('register') }}" class="switcher-text1">Register</a>
                                <a href="{{ route('login') }}" class="switcher-text1 active">Log In</a>
                                <a href="{{ route('register.partner') }}" class="switcher-text1">Become a Host</a>
                            </div>
                        </div>
                        <div class="fxt-form">
                            <h2>Log In</h2>
                            <p>Log in to continue in our website</p>
                            <form id="frmLgn" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="email" id="email-login"
                                            class="form-control form-control-alt {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" placeholder="Email Address">
                                        <i id="fvicn-eml" class="flaticon-envelope flaticon"></i>
                                        <small id="err-eml-lgn" style="display: none;" class="invalid-feedback"></small>
                                        @if ($errors->has('email'))
                                            @forelse ($errors->get('email') as $error)
                                                <small id="err-bcknd" class="invalid-feedback">{{ $error }}</small>
                                            @empty
                                            @endforelse
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input type="password"
                                            class="form-control form-control-alt @error('password') is-invalid @enderror"
                                            id="password-login" name="password" placeholder="Password">
                                        <i id="fvicn-pas" class="flaticon-padlock flaticon"></i>
                                        <small id="err-pas-lgn" style="display: none;" class="invalid-feedback"></small>
                                        @if ($errors->has('password'))
                                            @forelse ($errors->get('password') as $error)
                                                <small>{{ $error }}</small>
                                            @empty
                                            @endforelse
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-content-between">
                                            <button type="submit" class="fxt-btn-fill" style="border-radius: 10px">Log
                                                in</button>
                                            <a href="/password/reset" class="switcher-text2">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="fxt-footer">
                            <center>
                                <p style="margin-bottom: 20px;">or login with</p>
                            </center>
                            <ul class="fxt-socials">
                                <li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-4">
                                    <a href="{{ route('user.login.facebook') }}" title="Facebook"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="fxt-google fxt-transformY-50 fxt-transition-delay-6">
                                    <a href="{{ route('user.login.google') }}" title="google"><i
                                            class="fab fa-google"></i></a>
                                </li>
                            </ul>

                            {{-- <ul class="fxt-socials fxt-transformY-50 fxt-transition-delay-4">
                            <a class="btn btn-border btn-google-login" href="{{ route('user.login.google') }}">
                        <img src="{{asset('assets/user/assets/images/ic_google.svg')}}" class="icon" alt="">
                        Sign in with Google
                        </a>
                        </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 fxt-none-767 fxt-bg-img"
                    data-bg-image="https://source.unsplash.com/otg03gUniC4">
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
        $(document).on("focusout", "#email-login", function () {
            if(!$(this).val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#fvicn-eml').hide();
                $('#email-login').css("border-bottom-color", "#ff0000");
                $('#email-login').addClass("is-invalid");
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#fvicn-eml').hide();
                    $('#email-login').css("border-bottom-color", "#ff0000");
                    $('#email-login').addClass("is-invalid");
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                }
            }
        });
        $(document).on("focusout", "#password-login", function () {
            if(!$(this).val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#fvicn-pas').hide();
                $('#password-login').css("border-bottom-color", "#ff0000");
                $('#password-login').addClass("is-invalid");
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
            } else {
                if($('#password-login').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#fvicn-pas').hide();
                    $('#password-login').css("border-bottom-color", "#ff0000");
                    $('#password-login').addClass("is-invalid");
                    $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
                    $('#err-pas-lgn').show();
                    error = 1;
                }
            }
        });
        $(document).on("keyup", "#email-login", function () {
            $('#fvicn-eml').css("top", "50%");
            $('#fvicn-eml').show();
            $('#email-login').css("border-bottom-color", "#e7e7e7");
            $('#email-login').removeClass("is-invalid");
            $('#err-bcknd').hide();
            $('#err-eml-lgn').hide();
            $('#err-eml-lgn').text('');
        });
        $(document).on("keyup", "#password-login", function () {
            $('#fvicn-pas').css("top", "50%");
            $('#fvicn-pas').show();
            $('#password-login').css("border-bottom-color", "#e7e7e7");
            $('#password-login').removeClass("is-invalid");
            $('#err-pas-lgn').hide();
            $('#err-pas-lgn').text('');
        });
        $("#frmLgn").submit(function(e) {
            let error = 0;

            // reset style input
            $('.invalid-feedback').hide()
            $('.invalid-feedback').text('')
            $('.form-control').removeClass('is-invalid')
            $('.form-control').css("border-bottom-color", "#e7e7e7");
            $('.flaticon').show()

            // validasi
            if(!$('#email-login').val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#fvicn-eml').hide();
                $('#email-login').css("border-bottom-color", "#ff0000");
                $('#email-login').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
                error = 1;
            } else {
                if (!regex.test($('#email-login').val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#fvicn-eml').hide();
                    $('#email-login').css("border-bottom-color", "#ff0000");
                    $('#email-login').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                    error = 1;
                }
            }
            if(!$('#password-login').val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#fvicn-pas').hide();
                $('#password-login').css("border-bottom-color", "#ff0000");
                $('#password-login').addClass('is-invalid');
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
                error = 1;
            } else {
                if($('#password-login').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#fvicn-pas').hide();
                    $('#password-login').css("border-bottom-color", "#ff0000");
                    $('#password-login').addClass('is-invalid');
                    $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
                    $('#err-pas-lgn').show();
                    error = 1;
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
                                let idErrorMessage = el == 'email' ? '#err-eml-lgn' : '#err-pas-lgn'
                                let idIconInput = el == 'email' ? '#fvicn-eml' : '#fvicn-pas'
                                
                                $(idIconInput).hide()
                                $(idErrorMessage).show()
                                $('#frmLgn input[name='+el+']').addClass('is-invalid')
                                $('#frmLgn input[name='+el+']').css("border-bottom-color", "#ff0000")
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
