@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div
            class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Add User
                </h1>
            </div>
            <div class="mt-3 mt-sm-0 ml-sm-3">

            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
@endsection

@section('content')
<!-- Stylesheets -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
<style>
    label {
        width: 100%;
        font-weight: bold;
        display: inline-block;
        margin-top: 20px;
    }

    label span {
        font-size: 0.8rem;
    }

    label.error {
        color: red;
        font-size: 0.8rem;
        display: block;
        margin-top: 5px;
    }

    label.error.fail-alert {
        background: #ffe6eb;
    }

    input.valid.success-alert {
        border: 2px solid #4CAF50;
        color: green;
    }

    input.error,
    textarea.error {
        font-weight: 300;
        color: red;
    }

</style>

<!-- Dynamic Table Full -->
<div class="block block-rounded">
    <div class="block-content">
        <form style="font-size: 14px;" action="{{ route('admin_user_store') }}" method="POST" id="frm_tambah" class="js-validation">
            @csrf
            <div class="block-content font-size-sm">
                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-input-admin-font" id="first_name" name="first_name" placeholder="Enter a first name..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-input-admin-font" id="last_name" name="last_name" placeholder="Enter a last name..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="username">Username <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-input-admin-font" id="username" name="username"
                            placeholder="Enter a username..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-input-admin-font" id="email" name="email" placeholder="Enter a email..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="password">Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-input-admin-font" id="password" name="password"
                            placeholder="Enter a password..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="password_confirmation">Password Confirmation <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-input-admin-font" id="password_confirmation"
                            name="password_confirmation">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="role">Role </label>
                    <div class="col-sm-9">
                        <select style="font-size: 14px;" class="form-select" aria-label="Default select example">
                            <option selected>User</option>
                            <option value="1">Partner</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="active">Status </label>
                    <div class="col-sm-9">
                        <select style="font-size: 14px;" class="form-select" aria-label="Default select example">
                            <option value="1">Deactive</option>
                            <option value="2">Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm button-admin">
                            Save
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </form>
    </div>
</div>
<!-- END Dynamic Table Full -->
@endsection

@section('scripts')

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

<!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
<script>
    Dashmix.helpersOnLoad(['jq-select2']);

</script>

<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<script>
    $("#frm_tambah").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            "name": {
                required: !0,
                minlength: 5
            },
            "username": {
                required: !0,
                minlength: 5
            },
            "email": {
                required: !0,
            },
            "password": {
                required: !0,
            },
            "password_confirmation": {
                required: !0,
            },
        },
        messages: {
            "name": {
                required: "This field is required",
                minlength: "Your input must consist of at least 5 characters"
            },
            "username": {
                required: "This field is required",
                minlength: "Your input must consist of at least 5 characters"
            },
            "email": {
                required: "This field is required",
            },
            "password": {
                required: "This field is required",
            },
            "password_confirmation": {
                required: "This field is required",
            },
        }
    });

</script>
@endsection
