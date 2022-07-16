@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"> Add Booking Villa</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
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
    <form action="{{ route('admin_villa_booking_store') }}" method="POST" id="basic-form" class="js-validation"
        enctype="multipart/form-data">
        @csrf
        <div class="block block-rounded">
            <div class="block-content">
                <span class="content-heading mb-4 pb-2">Customer Information</span>
                <div class="block-content font-size-sm">
                    <div class="form-group row">
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Enter a firstame..">
                        </div>
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Enter a lastname..">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter a email..">
                        </div>
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter a phone number..">
                        </div>
                    </div>
                </div>

                <span class="content-heading mb-4 pb-2">Booking Information</span>
                <div class="block-content font-size-sm">
                    <div class="form-group row">
                        <div class="col-sm-8 padding-left-none">
                            <label class="form-label" for="id_villa">Villa <span class="text-danger">*</span></label>
                            <select class="js-select2 form-control" id="id_villa" name="id_villa" style="width: 100%;"
                                data-placeholder="Choose one villa.." onchange="myChange(this)">
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($villa as $data)
                                    <option value="{{ $data->id_villa }}" data-price="{{ $data->price }}"
                                        data-stay="{{ $data->min_stay }}" data-adult="{{ $data->adult }}"
                                        data-children="{{ $data->children }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            {{-- <label class="form-label" for="min_stay">Min Stay</label> --}}
                            <input type="hidden" class="form-control" id="min_stay" name="min_stay">
                        </div>
                        <div class="col-sm-4">
                            {{-- <label class="form-label" for="adult">Max Adult</label> --}}
                            <input type="hidden" class="form-control" id="max_adult" name="max_adult">
                        </div>
                        <div class="col-sm-4">
                            {{-- <label class="form-label" for="children">Max Children</label> --}}
                            <input type="hidden" class="form-control" id="max_children" name="max_children">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="adult">Adult <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="adult" name="adult"
                                placeholder="Enter a adult number..">
                        </div>
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="child">Children <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="child" name="child"
                                placeholder="Enter a children number..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="check_in">Check In <span class="text-danger">*</span></label>
                            <input type="text" class="flatpickr form-control bg-white" id="check_in" name="check_in"
                                placeholder="Y-m-d">
                        </div>
                        <div class="col-sm-6 padding-left-none">
                            <label class="form-label" for="check_out">Check Out <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="flatpickr form-control bg-white" id="check_out"
                                name="check_out" placeholder="Y-m-d">
                        </div>
                        <input type="hidden" id="sum_night" name="sum_night">
                    </div>
                </div>

                <div class="block-content block-content-full text-right ">
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7 padding-left-none">
                            <button type="submit" class="btn btn-sm button-admin">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </div>
            </div>
        </div>
    </form>
    <!-- END Dynamic Table Full -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
    <script>
        Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);
    </script>

    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script type="text/javascript">
        function myChange(e) {
            var price = $(e).find("option:selected").attr("data-price");
            var min_stay = $(e).find("option:selected").attr("data-stay");
            var adult = $(e).find("option:selected").attr("data-adult");
            var children = $(e).find("option:selected").attr("data-children");
            document.getElementById("price").value = price;
            document.getElementById("min_stay").value = min_stay;
            document.getElementById("max_adult").value = adult;
            document.getElementById("max_children").value = children;
        }
    </script>

    <script>
        $('#check_in').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                $('#check_out').flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: new Date(dateStr).fp_incr(1),
                    onChange: function(selectedDates, dateStr, instance) {
                        var start = new Date($('#check_in').val());
                        var end = new Date($('#check_out').val());
                        var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                        var min_stay = $('#min_stay').val();
                        var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                        if (sum_night < min_stay) {
                            alert("minimum stay is " + min_stay + " days");
                        }
                    }
                });
            }
        });
    </script>

    <script>
        $("#basic-form").validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
                "firstname": {
                    required: !0,
                    minlength: 2
                },
                "lastname": {
                    required: !0,
                    minlength: 2
                },
                "email": {
                    required: !0,
                    email: !0
                },
                "phone": {
                    required: !0,
                    minlength: 5
                },
                "id_villa": {
                    required: !0,
                },
                "adult": {
                    required: !0,
                    number: true,
                    min: 1,
                },
                "child": {
                    required: !0,
                    number: true,
                    min: 1,
                },
                "check_in": {
                    required: !0,
                },
                "check_out": {
                    required: !0,
                },
            },
            messages: {
                "firstname": {
                    required: "Please enter a firstname",
                    minlength: "Your input must consist of at least 2 characters"
                },
                "lastname": {
                    required: "Please enter a lastname",
                    minlength: "Your input must consist of at least 2 characters"
                },
                "phone": {
                    required: "Please enter a villa contact",
                    minlength: "Your input must consist of at least 5 characters"
                },
                "id_villa": {
                    required: "Please enter a villa"
                },
                "adult": {
                    required: "Please enter max number of adult",
                    number: "Please enter your input as a numerical value",
                    min: "You must be enter at least 1",
                    max: "Input cannot exceed maximum"
                },
                "child": {
                    required: "Please enter max number of children",
                    number: "Please enter your input as a numerical value",
                    min: "You must be enter at least 1",
                    max: "Input cannot exceed maximum"
                },
                "check_in": {
                    required: "Please enter a date check in"
                },
                "check_out": {
                    required: "Please enter a date check out"
                },
            }
        });
    </script>
@endsection
