@extends('new-admin.layouts.admin_layout')

@section('title', 'Personal Information - Account Setting - EZV2')

<style>
    @media only screen and (max-width: 767px) {
        .ml-max-md-20p {
            margin-left: 20px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
        .government-card {
            width: 100% !important;
            margin-top: 1rem !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 1199px) {
        .government-card {
            position: absolute !important;
            width: 18rem !important;
            right: 20px !important;
            bottom: 0px !important;
        }
    }
    @media only screen and (min-width: 1200px) {
        .government-card {
            position: absolute !important;
            width: 23rem !important;
            right: 20px !important;
            bottom: 0px !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between" style="position: relative;">
                <div class="col-12 mt-2 ml-max-md-20p" style="margin-left: 30px;">
                    <div class="block-content">
                        @if (session('success'))
                        <div class="col-8 justify-content-center ml-n3">
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 90%;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}" style="color: #ff7400 !important">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Personal info</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Personal info
                    </h1>
                </div>



                <div id="content" class="col-12">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divLegalName">
                        <div class="col-md-7" id="legal-name">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Legal name</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showformLegalName()">Edit</a>
                                <p class="text-muted">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divGender">
                        <div class="col-md-7" id="gender">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Gender</span>
                                <a onclick="showformGender()"
                                class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);">Edit</a>
                                <p class="text-muted">{{ Auth::user()->gender == null ? 'Not specified' : Auth::user()->gender }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divBirthday">
                        <div class="col-md-7" id="date-of-birth">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Date of birth</span>
                                <a class="float-right text-dark"
                                onclick="showBirthdayForm()" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);">Edit</a>
                                <p class="text-muted">{{ Auth::user()->birthday == null ? 'Not Specified' : Auth::user()->birthday->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divEmailAddress">
                        <div class="col-md-7" id="email-address">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Email address</span>
                                <a class="float-right text-dark"
                                onclick="showEmailForm()" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);">Edit</a>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divPhoneNumber">
                        <div class="col-md-7" id="phone-number">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Phone numbers</span>
                                <a class="float-right text-dark"
                                onclick="showPhoneNumberForm()" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);">{{ Auth::user()->phone == null ? 'Add' : 'Edit' }}</a>
                                <p class="text-muted">{{ Auth::user()->phone == null ? 'Add a number so confirmed guests and EZV2Villas can get in touch. You can add other numbers and choose how they’re used' : Auth::user()->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divGovernment">
                        <div class="col-md-7" id="government">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Government ID</span>
                                @if (\App\Models\Government::where('user_id',Auth::user()->id)->first() == null)
                                    <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="{{ route('add_government') }}">Add</a>
                                @else

                                    @if (\App\Models\Government::where('approved_status',0)->where('user_id',Auth::user()->id)->first())
                                        <span class="text-danger float-right">Waiting For Approval</span>
                                    @endIf

                                @endIf

                                <p class="text-muted">
                                    @if ( \App\Models\Government::where('user_id',Auth::user()->id)->first() != null )

                                        @if (\App\Models\Government::where('approved_status',0)->where('user_id',Auth::user()->id)->first())
                                            Waiting For Approval
                                        @else
                                            Government ID has been added
                                        @endIf

                                    @else
                                        Not provided
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 ml-max-md-0p d-flex" style="margin-left: 10px;" id="divAddress">
                        <div class="col-md-7" id="address">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Address</span>
                                <a class="float-right text-dark"
                                onclick="showAddressForm()" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);">Edit</a>
                                <p class="text-muted">{{ Auth::user()->address == null ? 'Not provided.' : Auth::user()->address}}</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 mt-4 d-flex" style="margin-left: 10px;" id="divEmergencyContact">
                        <div class="col-md-7" id="emergency-contact">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Emergency contact</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="#">Add</a>
                                <p class="text-muted">Not provided.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 d-flex" style="margin-left: 10px;" id="divPassport">
                        <div class="col-md-7" id="passport">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Passport info for China travel
                                </span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="#">Add</a>
                                <p class="text-muted">Not provided.</p>
                            </div>
                        </div>
                    </div> --}}

                </div>

                <!-- Form Legal Name -->
                <div id="legalform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Legal name</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showLegalName()">Cancel</a>
                                <p class="text-muted">This is the name on your travel document, which could be a license or a passport.</p>
                            </div>
                            <form action="{{ route('personal_update_name') }}" method="post" id="profile-name">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-md">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">First name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}">
                                            <small id="err-fname" style="display: none;" class="invalid-feedback">The first name field is required</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Last name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}">
                                            <small id="err-lname" style="display: none;" class="invalid-feedback">The last name field is required</small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Legal Name -->

                <!-- Form Gender -->
                <div id="genderform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Gender</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showGender()">Cancel</a>
                                {{-- <p class="text-muted">This is the name on your travel document, which could be a license or a passport.</p> --}}
                            </div>
                            <form action="{{ route('personal_update_gender') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <select style="width: 100%; padding:10px;" class="form-select" name="gender">
                                        <option value="0" selected>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Gender -->

                <!-- Form Birthday -->
                <div id="birthdayform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Date of birth</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showBirthday()">Cancel</a>
                            </div>
                            <form action="{{ route('personal_update_birthday') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <input type="date" class="form-control" name="birthday" date-format="Y-m-d" value="{{ Auth::user()->birthday ? Auth::user()->birthday->format('Y-m-d') : '' }}">
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Birthday -->

                <!-- Form Email -->
                <div id="emailform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Email address</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showEmail()">Cancel</a>
                                <p class="text-muted">Use an address you’ll always have access to.</p>
                            </div>
                            <form action="{{ route('personal_update_email') }}" method="post" id="profile-email">
                                @csrf
                                <div class="mb-4">
                                    <input type="email" class="form-control" name="email" id="user_email" value="{{ Auth::user()->email }}">
                                    <small id="err-email" style="display: none;" class="invalid-feedback">The email field is required</small>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Email -->

                <!-- Form Phone Number -->
                <div id="phoneform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Phone numbers</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showPhoneNumber()">Cancel</a>
                                <p class="text-muted">Add a number so confirmed guests and EZV can get in touch. You can add other numbers and choose how they’re used.</p>
                            </div>
                            <form action="{{ route('personal_update_phone') }}" method="post" id="profile-phone">
                                @csrf
                                <div class="mb-4">
                                    <label for="">Enter a phone number</label>
                                    <input type="text" class="form-control" name="phone" id="profile_phone" value="{{ Auth::user()->phone }}">
                                    <small id="err-phone" style="display: none;" class="invalid-feedback">The phone number field is required</small>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Phone Number -->

                <!-- Form Address -->
                <div id="addressform" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 ml-max-md-0p d-flex" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Address</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;" href="javascript:void(0);"
                                onclick="showAddress()">Cancel</a>
                                {{-- <p class="text-muted">Add a number so confirmed guests and EZV can get in touch. You can add other numbers and choose how they’re used.</p> --}}
                            </div>
                            <form action="{{ route('personal_update_address') }}" method="post" id="profile-address">
                                @csrf
                                <div class="mb-4">
                                    <input type="text" class="form-control" name="address" id="profile_address" value="{{ Auth::user()->address }}">
                                    <small id="err-address" style="display: none;" class="invalid-feedback">The address field is required</small>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Address -->

                @if (Auth::user()->role->name == "superadmin" || Auth::user()->role->name == "admin")
                    <div class="col-12" style="padding-left: 2rem; padding-right: 2rem;">
                        <div class="card p-4 government-card" style="box-shadow: 0px 3px 15px -8px rgb(100,100,100);">
                            <div class="card-body">
                                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" style="display:block;height:48px;width:48px;fill:#E31C5F;stroke:currentColor" aria-hidden="true" role="presentation" focusable="false"><g stroke="none"><path d="m39 15.999v28.001h-30v-28.001z" fill-opacity=".2"></path><path d="m24 0c5.4292399 0 9.8479317 4.32667079 9.9961582 9.72009516l.0038418.27990484v2h7c1.0543618 0 1.9181651.8158778 1.9945143 1.8507377l.0054857.1492623v32c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-34c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-32c0-1.0543618.81587779-1.9181651 1.85073766-1.9945143l.14926234-.0054857h7v-2c0-5.5228475 4.4771525-10 10-10zm17 14h-34v32h34zm-17 14c1.6568542 0 3 1.3431458 3 3s-1.3431458 3-3 3-3-1.3431458-3-3 1.3431458-3 3-3zm0 2c-.5522847 0-1 .4477153-1 1s.4477153 1 1 1 1-.4477153 1-1-.4477153-1-1-1zm0-28c-4.3349143 0-7.8645429 3.44783777-7.9961932 7.75082067l-.0038068.24917933v2h16v-2c0-4.418278-3.581722-8-8-8z"></path></g></svg>

                                <h5 class="card-title mt-4"><b>Approved Government ID</b></h5>
                                <p class="card-text">
                                    All List Data Need Approval By SuperAdmin / Admin
                                    <a href="{{ route('government_approval_index') }}" class="btn btn-outline-success d-block" style="margin-top: 10px;">Government Data</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endIf

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    //function show form legal name
    function showformLegalName() {
        document.getElementById("legalform").style.display = "block";
        // document.getElementById("formLegalName").style.marginTop = "-240px";
        document.getElementById("content").style.display = "none";
    }

    //function hide form legal name
    function showLegalName() {
        document.getElementById("legalform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    //function show form gender
    function showformGender()
    {
        document.getElementById("genderform").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    //function hide form gender
    function showGender()
    {
        document.getElementById("genderform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    //function show form birthday
    function showBirthdayForm()
    {
        document.getElementById("birthdayform").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    //function hide form birthday
    function showBirthday()
    {
        document.getElementById("birthdayform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    //function show form email
    function showEmailForm()
    {
        document.getElementById("emailform").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    //function hide form email
    function showEmail()
    {
        document.getElementById("emailform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    //function show form phone
    function showPhoneNumberForm()
    {
        document.getElementById("phoneform").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    //function hide form phone
    function showPhoneNumber()
    {
        document.getElementById("phoneform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    //function show form address
    function showAddressForm()
    {
        document.getElementById("addressform").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    //function hide form address
    function showAddress()
    {
        document.getElementById("addressform").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

</script>
<script>
    // validasi
    $(function() {
        $('#first_name').keyup(function (e) {
            $('#first_name').removeClass('is-invalid');
            $('#err-fname').hide();
        });
        $('#last_name').keyup(function (e) {
            $('#last_name').removeClass('is-invalid');
            $('#err-lname').hide();
        });
        $('#user_email').keyup(function (e) {
            $('#user_email').removeClass('is-invalid');
            $('#err-email').hide();
        });
        $('#profile_phone').keyup(function (e) {
            $('#profile_phone').removeClass('is-invalid');
            $('#err-phone').hide();
        });
        $('#profile_address').keyup(function (e) {
            $('#profile_address').removeClass('is-invalid');
            $('#err-address').hide();
        });
        $('#profile-name').submit(function (e) {
            if(!$('#first_name').val()) {
                $('#first_name').addClass('is-invalid');
                $('#err-fname').show();
                e.preventDefault();
            } else {
                $('#first_name').removeClass('is-invalid');
                $('#err-fname').hide();
            }
            if(!$('#last_name').val()) {
                $('#last_name').addClass('is-invalid');
                $('#err-lname').show();
                e.preventDefault();
            } else {
                $('#last_name').removeClass('is-invalid');
                $('#err-lname').hide();
            }
        });
        $('#profile-email').submit(function (e) {
            if(!$('#user_email').val()) {
                $('#err-email').show();
                $('#user_email').addClass('is-invalid');
                e.preventDefault();
            } else {
                $('#user_email').removeClass('is-invalid');
                $('#err-email').hide();
            }


        });
        $('#profile-phone').submit(function (e) {
            if(!$('#profile_phone').val()) {
                $('#err-phone').show();
                $('#profile_phone').addClass('is-invalid');
                e.preventDefault();
            } else {
                $('#profile_phone').removeClass('is-invalid');
                $('#err-phone').hide();
            }

        });
        $('#profile-address').submit(function (e) {
            if(!$('#profile_address').val()) {
                $('#err-address').show();
                $('#profile_address').addClass('is-invalid');
                e.preventDefault();
            } else {
                $('#profile_address').removeClass('is-invalid');
                $('#err-address').hide();
            }
        });
    })
</script>

@endsection
