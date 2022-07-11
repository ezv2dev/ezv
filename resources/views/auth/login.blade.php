@extends('layouts.login.app')

@section('title', 'Login - EZV2')

@section('content')
    <section class="fxt-template-animation fxt-template-layout1">
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
                                        <i id="fvicn-eml" class="flaticon-envelope"></i>
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
                                        <i id="fvicn-pas" class="flaticon-padlock"></i>
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
                $('#email-login').css("border-bottom-color", "#ff0000");
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#email-login').css("border-bottom-color", "#ff0000");
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                }
            }
        });
        $(document).on("focusout", "#password-login", function () {
            if(!$(this).val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#password-login').css("border-bottom-color", "#ff0000");
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
            } else {
                if($('#password-login').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#password-login').css("border-bottom-color", "#ff0000");
                    $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
                    $('#err-pas-lgn').show();
                    error = 1;
                }
            }
        });
        $(document).on("keyup", "#email-login", function () {
            $('#fvicn-eml').css("top", "50%");
            $('#email-login').css("border-bottom-color", "#e7e7e7");
            $('#err-bcknd').hide();
            $('#err-eml-lgn').hide();
            $('#err-eml-lgn').text('');
        });
        $(document).on("keyup", "#password-login", function () {
            $('#fvicn-eml').css("top", "50%");
            $('#password-login').css("border-bottom-color", "#e7e7e7");
            $('#err-pas-lgn').hide();
            $('#err-pas-lgn').text('');
        });
        $("#frmLgn").submit(function(e) {
            let error = 0;
            if(!$('#email-login').val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#email-login').css("border-bottom-color", "#ff0000");
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
                error = 1;
            } else {
                if (!regex.test($('#email-login').val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#email-login').css("border-bottom-color", "#ff0000");
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                    error = 1;
                }
            }
            if(!$('#password-login').val()) {
                $('#fvicn-pas').css("top", "35%");
                $('#password-login').css("border-bottom-color", "#ff0000");
                $('#err-pas-lgn').text('{{ __('auth.empty_password') }}');
                $('#err-pas-lgn').show();
                error = 1;
            } else {
                if($('#password-login').val().length < 8) {
                    $('#fvicn-pas').css("top", "35%");
                    $('#password-login').css("border-bottom-color", "#ff0000");
                    $('#err-pas-lgn').text('{{ __('auth.min_password') }}');
                    $('#err-pas-lgn').show();
                    error = 1;
                }
            }
            if(error == 1) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
