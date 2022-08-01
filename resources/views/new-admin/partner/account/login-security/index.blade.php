@extends('new-admin.layouts.admin_layout')

@section('title', 'Login & Security - EZV2')

<style>
    @media only screen and (max-width: 767px) {
        .ml-max-md-10p {
            margin-left: 10px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
        .px-max-md-0p {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
    }
</style>

<style>
        .relative{
            position:relative;
        }
        .icon-input-container{
            position:absolute;
            right:.5rem;
            top:50%;
            transform:translateY(-50%);
            background:transparent;
            outline:none;
            border:0;
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
        .padding-right-custom{
            padding-right:34px;
        }

    </style>

@section('content_admin')

<div class="page-header">
    @if (session('successDC'))
    <div class="col-12 d-flex justify-content-center">
        <div class="alert alert-info alert-dismissible" role="alert" style="width: 90%;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('successDC') }}
        </div>
    </div>
    @endif
    
    @if (session('successCC'))
    <div class="col-12 d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible" role="alert" style="width: 90%;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('successCC') }}
        </div>
    </div>
    @endif


    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2 ml-max-md-10p" style="margin-left: 30px;">
                    <div class="block-content">
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}" style="color: #FF7400 !important">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Login & security</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Login & Security
                    </h1>
                </div>

                <div class="col-12">

                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px; border-bottom: 1px solid #DFDFDE;">
                        <div class="title-bar" style="border-bottom: 2px solid #FF7400; display: inline-block;">
                            <h6><b>LOGIN</b></h6>
                        </div>
                    </div>

                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="title-login">
                            <h3><b>Login</b></h3>
                        </div>
                    </div>
                    <div id="passwordField" class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Password</span>
                            <a class="float-right" style="color: #FF7400; font-size: 12pt;" href="javascript:void(0);"
                                onclick="showUpdatePasswordForm()"><b>Update</b></a>
                            @if (Auth::user()->updated_at_password == null)
                            <p class="text-muted">Last updated {{ $last_created }}</p>
                            @else
                            <p class="text-muted">Last updated {{ $last_modified }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if (session('success'))
                    <div class="col-7 ml-max-md-0p" style="margin-left: 20px">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="col-7 ml-max-md-0dp" style="margin-left: 20px">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    </div>
                    @endif
                    <!-- Form Update Password -->
                    <div id="updatePasswordForm" class="col-12" style="display: none;">
                        <div class="col-12 mt-5 d-flex px-max-md-0p">
                            <div class="col-md-7 px-max-md-0p">
                                <div class="legal-name" style="padding-bottom:20px;">
                                    <span class="lead">Password</span>
                                    <a class="float-right" style="color: #FF7400; font-size: 12pt;"
                                        href="javascript:void(0);" onclick="showPasswordField()"><b>Cancel</b></a>
                                    {{-- <p class="text-muted">This is the name on your travel document, which could be a license or a passport.</p> --}}
                                </div>
                                <form action="{{ route('password_update') }}" id="formUpdatePassword" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group mb-3">
                                        <label for="old_password">Current password</label>
                                        <input type="password" class="form-control padding-right-custom" name="old_password"
                                            id="old_password">
                                        <button type="button" class="icon-input-container">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>

                                        <div class="text-danger mt-2 invalid-feedback"></div>
                                        @error('old_password')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <small><a href="#" style="color: #FF7400;">Need a new password?</a></small>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">New password</label>
                                        <input type="password" class="form-control padding-right-custom" name="password" id="password">
                                        <button type="button" class="icon-input-container">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                        
                                        <div class="text-danger mt-2 invalid-feedback"></div>
                                        @error('password')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password_confirmation">Confirm password</label>
                                        <input type="password" class="form-control padding-right-custom" name="password_confirmation"
                                            id="password_confirmation">
                                        <button type="button" class="icon-input-container">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>

                                        <div class="text-danger mt-2 invalid-feedback"></div>
                                        @error('password_confirmation')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn text-white" style="background: #FF7400;">Update
                                        password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Form Update Password -->

                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="title-login">
                            <h3><b>Social accounts</b></h3>
                        </div>
                    </div>
                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Facebook</span>
                            @if (Auth::user()->facebook_id != null)
                            <form action="{{ route('disconnect-facebook') }}" method="POST">
                                @csrf
                                <input type="submit" class="float-right" style="color: #FF7400; font-size: 12pt;font-weight: bolder;border: 0;background-color: #fff;margin-top: -4%;"
                                    value="Disconnect">
                            </form>
                            <p class="text-muted">Connected</p>
                            @else
                            <a class="float-right" style="color: #FF7400; font-size: 12pt;"
                                href="{{ route('user.login.facebook') }}"><b>Connect</b></a>
                            <p class="text-muted">Not Connected</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 mt-4 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead">Google</span>
                            @if (Auth::user()->google_id != null)
                            <form action="{{ route('disconnect-google') }}" method="POST">
                                @csrf
                                <input type="submit" class="float-right" style="color: #FF7400; font-size: 12pt;font-weight: bolder;border: 0;background-color: #fff;margin-top: -4%;"
                                    value="Disconnect">
                            </form>
                            <p class="text-muted">Connected</p>
                            @else
                            <a class="float-right" style="color: #FF7400; font-size: 12pt;"
                                href="{{ route('user.login.google') }}"><b>Connect</b></a>
                            <p class="text-muted">Not Connected</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="title-login">
                            <h3><b>Account</b></h3>
                        </div>
                    </div>
                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div class="legal-name d-flex" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                            <span class="lead flex-fill">Deactive your account</span>
                            <a class="float-right" style="color: #F55353; font-size: 12pt;"
                                href="{{ route('account-delete-form') }}">Deactive</a>
                            {{-- <p class="text-muted">Not Connected</p> --}}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    function showUpdatePasswordForm() {
        document.getElementById("updatePasswordForm").style.display = "block";
        document.getElementById("passwordField").style.display = "none";
    }

    function showPasswordField() {
        document.getElementById("updatePasswordForm").style.display = "none";
        document.getElementById("passwordField").style.display = "block";
    }

    //show password
    $('.icon-input-container').on('click',function(){
        let parent = $(this).parent()
        let icon = $(this).find('.fa-solid')
        if(icon.hasClass('fa-eye')){
            icon.removeClass('fa-eye')
            icon.addClass('fa-eye-slash')
            parent.find('.form-control').get(0).type = 'password'
        }else{
            icon.removeClass('fa-eye-slash')
            icon.addClass('fa-eye')
            parent.find('.form-control').get(0).type = 'text'
        }
    })

    //validasi form when on keyup
    $('.form-control').on('keyup focusout', function(){
        validate($(this))
    })

    $('#formChangePassword').submit(function(e){
        if(typeof e.cancelable !== 'boolean' || e.cancelable){
            e.preventDefault();
            let input = $('#formChangePassword .form-control');
            let error = 0
            $.each(input, function(index, value){
                const validation = validate($(input[index]))
                validation ? error = 0 : error = 1 
            })

            if(error == 0){
                $('.container-loading-animation').removeClass('d-none')

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function( data ){  
                        $('#alertSuccess').removeClass('d-none')
                        $('.container-loading-animation').addClass('d-none')

                        $.each(input, function(index, value){
                            $(input[index]).val('')
                        })
                    },
                    error: function( response ){    
                        if(response.status == 200){
                            $('.container-loading-animation').addClass('d-none')
                            $('#alertSuccess').removeClass('d-none') 
                            $.each(input, function(index, value){
                                $(input[index]).val('')
                            })
                        }else{
                            var errors = response.responseJSON;
                            $.each(errors.errors,function (el, val) {
                                let input = $('#formChangePassword input[name='+el+']')
                                let parentInput = input.parent()
                                let messageContainer = parentInput.parent().find('.invalid-feedback')
                                let iconInput = parentInput.find('.icon-input-container')

                                $('.container-loading-animation').addClass('d-none')
                                setErrorStyle(input, messageContainer, iconInput)

                                $.each(val, function(index, errMessage){
                                    $(messageContainer).text(errMessage)
                                })
        
                            });
                        }                       
                    }
                });
            }
        }
    })

    function validate(input){
        let status = true;
        let parentInput = input.parent()
        let messageContainer = parentInput.parent().find('.invalid-feedback')
        let iconInput = parentInput.find('.icon-input-container')

        // reset error style
        resetErrorStyle(input, messageContainer, iconInput)

        if(!input.val()){
            setErrorStyle(input, messageContainer, iconInput)
            messageContainer.text('{{ __('auth.empty_password') }}')
            status = false
        }else{
            if(input.val().length < 8){
                setErrorStyle(input, messageContainer, iconInput)
                messageContainer.text('{{ __('auth.min_password') }}')
                status = false
            }else if(input.attr('id') == 'password_confirmation'){
                if(input.val() != $('#password').val()){
                    setErrorStyle(input, messageContainer, iconInput)
                    messageContainer.text('{{ __('auth.invalid_password') }}')
                    status = false
                }
            }
        }

        return status
    }
    
    function setErrorStyle(input, messageContainer, iconInput){                
        input.addClass('is-invalid')
        iconInput.hide()
        messageContainer.show()
    }

    function resetErrorStyle(input, messageContainer, iconInput) {
        input.removeClass('is-invalid')
        iconInput.show()
        messageContainer.hide()
        messageContainer.text('')
    }

</script>

@endsection
