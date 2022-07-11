@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Add Review
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

input.error, textarea.error {
    font-weight: 300;
    color: red;
}
</style>

<!-- Dynamic Table Full -->
<div class="block block-rounded">
    <div class="block-content">
        <form action="{{ route('villa_review_store') }}" method="POST" id="frm_tambah" class="js-validation"  >
            @csrf
            <input type="hidden" value="{{ $data[0]->id_villa }}" name="id">
            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Cleanliness</label>
                    </div>

                    <div class="col-lg-4">
                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="adult_decrement()"><i class="fa fa-minus"></i></a>

                        <input id="cleanliness" name="cleanliness" type=number min=1 max=5 step="0.1" style="width:50px; border:none; text-align:right;font-size: 20px;">

                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="adult_increment()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Service</label>
                    </div>

                    <div class="col-lg-4">
                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="children_decrement()"><i class="fa fa-minus"></i></a>

                        <input id="service" name="service" type=number min=1 max=5 step="0.1" style="width:50px; border:none; text-align:right; font-size: 20px;">

                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="children_increment()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Check In</label>
                    </div>

                    <div class="col-lg-4">
                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bedroom_decrement()"><i class="fa fa-minus"></i></a>

                        <input id="check_in" name="check_in" type=number min=1 max=5 step="0.1" style="width:50px; border:none; text-align:right; font-size: 20px;" >

                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bedroom_increment()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Location</label>
                    </div>

                    <div class="col-lg-4">
                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bathroom_decrement()"><i class="fa fa-minus"></i></a>

                        <input id="location" name="location" type=number min=1 max=5 step="0.1" style="width:50px; border:none; text-align:right; font-size: 20px;" >

                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bathroom_increment()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Value</label>
                    </div>

                    <div class="col-lg-4">
                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="stay_decrement()"><i class="fa fa-minus"></i></a>

                        <input id="value" name="value" type=number min=1 max=5 step="0.1" style="width:50px; border:none; text-align:right; font-size: 20px;">

                        <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="stay_increment()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <label class="form-label" for="description" style="font-size: 20px;">Comment</label>
                    </div>

                    <div class="col-lg-8">
                        <textarea style="width: 100%" name="comment" id="comment"></textarea>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-outline-primary">
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
<script>Dashmix.helpersOnLoad(['jq-select2']);</script>

<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<script>
    function adult_increment() {
          document.getElementById('cleanliness').stepUp();
     }
     function adult_decrement() {
        document.getElementById('cleanliness').stepDown();
     }
     function children_increment() {
        document.getElementById('service').stepUp();
     }
     function children_decrement() {
        document.getElementById('service').stepDown();
     }
     function bedroom_increment() {
        document.getElementById('check_in').stepUp();
     }
     function bedroom_decrement() {
        document.getElementById('check_in').stepDown();
     }
     function bathroom_increment() {
        document.getElementById('location').stepUp();
     }
     function bathroom_decrement() {
        document.getElementById('location').stepDown();
     }
     function stay_increment() {
        document.getElementById('value').stepUp();
     }
     function stay_decrement() {
        document.getElementById('value').stepDown();
     }
  </script>
@endsection