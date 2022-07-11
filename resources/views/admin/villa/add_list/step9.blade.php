@extends('layouts.admin.step_add_villa')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


    <form class="js-wizard-validation2-form" action="{{ route('villa_add_step_nine_store') }}" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">How much do you offer</h1>
                    <h1 style="color: #FFF; font-size: 40px; padding-right:15px; text-align:right;">this place?</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_villa') }}">
                        <i class="fa fa-save"></i> Save & exit
                    </a>
                </div>

                <div style="padding-top:25%;">
                    <div class="form-group">
                        <label class="form-label" for="name" style="font-size: 20px;">Villa Price</label>
                        <input class="form-control" style="border-radius:10px; height:100px; font-size:30px;" type="number" id="price" name="price" value="{{ $data[0]->price }}">
                    </div>
                </div>

                <!-- Footer -->
                <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row">
                        <div class="col-lg-5" style="padding:auto auto;">
                            <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_eight') }}">
                                Back
                            </a>
                            <button style="float: right;" type="submit" class="btn btn-outline-secondary">
                                Next
                            </button>
                        </div>
                    </div>
                </div>  
                <!-- END Footer -->
                    
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

<!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
<script>Dashmix.helpersOnLoad(['jq-select2']);</script>

@endsection
            