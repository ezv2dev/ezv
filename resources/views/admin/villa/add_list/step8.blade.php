@extends('layouts.admin.step_add_villa')

@section('content')
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
    border: 2px solid red;
    border-radius: 4px;
    line-height: 1;
    padding: 2px 0 6px 6px;
    background: #ffe6eb;
}

input.valid.success-alert {
    border: 2px solid #4CAF50;
    color: green;
}

input.error, textarea.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
.file-upload {
    .image-box {
        margin: 0 auto;
        margin-top: 1em;
        height: 15em;
        width: 20em;
        background: #d24d57;
        cursor: pointer;
        overflow: hidden;
        
        img {
            height: 10%;
            display: none;
        }

        p {
            position: relative;
            top: 45%;
        }
        
    }
}
</style>
    <form class="js-validation" action="{{ route('villa_add_step_eight_store') }}" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">Let guests know what your place has to offer</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_villa') }}">
                        <i class="fa fa-save"></i> Save & exit
                    </a>
                </div>

                <div style="padding-top:10%;">
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="id_location" class="form-label" style="font-size: 20px;">Villa Type</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="js-select2 form-select" id="id_villa_type" name="id_villa_type" style="width: 100%;">
                                        <option></option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item->id_villa_type }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Amenities</label>
                                    <div class="space-y-2">
                                        @foreach($amenities as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_amenities }}" id="{{ $data->id_amenities }}" name="amenities[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Bathroom</label>
                                    <div class="space-y-2">
                                        @foreach($bathroom as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Bedroom</label>
                                    <div class="space-y-2">
                                        @foreach($bedroom as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_bed }}" id="{{ $data->id_bed }}" name="bedroom[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Kitchen</label>
                                    <div class="space-y-2">
                                        @foreach($kitchen as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_kitchen }}" id="{{ $data->id_kitchen }}" name="kitchen[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Safety</label>
                                    <div class="space-y-2">
                                        @foreach($safety as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_safety }}" id="{{ $data->id_safety }}" name="safety[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Service</label>
                                    <div class="space-y-2">
                                        @foreach($service as $data)
                                        <div class="form-check form-switch row">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_service }}" id="{{ $data->id_service }}" name="service[]" >
                                            <label class="form-check-label" for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row" style="background-color: white">
                        <div class="col-lg-5" style="padding:auto auto;">
                            <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_one') }}">
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
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script>
$("#basic-form").validate({
    errorClass: "error fail-alert",
    validClass: "valid success-alert",
    rules:{
        "name":{
            required:!0,
            minlength:5
        },        
    },
    messages:{
        "name":{
            required:"Please enter a villa name",
            minlength:"Your input must consist of at least 5 characters"
        },
    }
});
</script>
@endsection
            