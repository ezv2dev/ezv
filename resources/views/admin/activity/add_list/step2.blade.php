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
    <form class="js-validation" action="{{ route('activity_add_step_two_store') }}" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">Let's start from the basic information</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_restaurant') }}">
                        <i class="fa fa-save"></i> Save & exit
                    </a>
                </div>

                <div style="padding-top:25%;">
                    <div class="form-group">
                        <label class="form-label" for="name" style="font-size: 20px;">Activity Name</label>
                        <input class="form-control" style="border-radius:10px; height:100px; font-size:30px;" type="text" id="name" name="name" value="{{ $data[0]->name }}">
                    </div>
                </div>

                <!-- Footer -->
                <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row">
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
            required:"Please enter a restaurant name",
            minlength:"Your input must consist of at least 5 characters"
        },
    }
});
</script>
@endsection
            