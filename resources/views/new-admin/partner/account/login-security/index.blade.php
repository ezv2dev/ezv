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
                                <form action="{{ route('password_update') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="old_password">Current password</label>
                                        <input type="password" class="form-control" name="old_password"
                                            id="old_password">

                                        @error('old_password')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <small><a href="#" style="color: #FF7400;">Need a new password?</a></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password">New password</label>
                                        <input type="password" class="form-control" name="password" id="password">

                                        @error('password')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation">Confirm password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation">

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

</script>

@endsection
