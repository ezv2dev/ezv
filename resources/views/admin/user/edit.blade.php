@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div
            class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Edit User
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
        <form action="{{ route('admin_user_update', $find[0]->id) }}" method="POST" id="frm_tambah"
            class="js-validation">
            @csrf
            @method('PUT')
            <div class="block-content font-size-sm">
                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $find[0]->first_name }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $find[0]->last_name }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="username">Username <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $find[0]->username }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $find[0]->email }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="password">Password <span
                            class="text-primary">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter a password..">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="password_confirmation">Password Confirmation <span
                            class="text-primary">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="role">Role </label>
                    <div class="col-sm-9">
                        <select style="font-size: 14px;" id="role" name="role" class="form-select" aria-label="Default select example" style="width: 100%;" data-placeholder="Choose one..">
                            <option value="4" {{$find[0]->role_id == 4  ? 'selected' : ''}}>User</option>
                            <option value="3" {{$find[0]->role_id == 3  ? 'selected' : ''}}>Partner</option>
                            <option value="2" {{$find[0]->role_id == 2  ? 'selected' : ''}}>Admin</option>
                        </select>

                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="active">Status </label>
                    <div class="col-sm-9">
                        <select style="font-size: 14px;" id="role" name="role" class="form-select" aria-label="Default select example" style="width: 100%;" data-placeholder="Choose one..">
                            <option value="0" {{$find[0]->active == 0  ? 'selected' : ''}}>Deactive</option>
                            <option value="1" {{$find[0]->active == 1  ? 'selected' : ''}}>Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <!-- Submit -->
                <div class="alert alert-info alert-block">
                    <span class="">(*)</span> If you do not want to change the password, leave the
                        password and confirmation password fields blank 
                </div>
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm button-admin">
                            <i class="fa fa-check"></i> Save
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
        }
    });

</script>
@endsection
