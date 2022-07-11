@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div
                class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Edit Activity Category
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
            border: 2px solid #ff7400;
            color: black;
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
            <form action="{{ route('admin_activity_category_update', $find[0]->id_category) }}" method="POST"
                id="frm_tambah" class="js-validation">
                @csrf
                @method('PUT')
                <div class="block-content font-size-sm">
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label" for="name">Name Category <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $find[0]->name }}">
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <!-- Submit -->
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
                    minlength: 2
                },
            },
            messages: {
                "name": {
                    required: "This field is required",
                    minlength: "Your input must consist of at least 2 characters"
                },
            }
        });
    </script>
@endsection
