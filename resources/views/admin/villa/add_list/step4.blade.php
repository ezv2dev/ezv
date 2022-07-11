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
    <form class="js-validation" action="{{ route('villa_add_step_four_store') }}" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">How many guests would you like to welcome?</h1>
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
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label class="form-label" for="description" style="font-size: 20px;">Adult</label>
                            </div>

                            <div class="col-lg-4">
                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="adult_decrement()"><i class="fa fa-minus"></i></a>

                                <input id="adult" name="adult" type=number min=1 style="width:50px; border:none; text-align:right;font-size: 20px;" value="{{ $data[0]->adult }}">

                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="adult_increment()"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label class="form-label" for="description" style="font-size: 20px;">Children</label>
                            </div>

                            <div class="col-lg-4">
                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="children_decrement()"><i class="fa fa-minus"></i></a>

                                <input id="children" name="children" type=number min=1 style="width:50px; border:none; text-align:right; font-size: 20px;" value="{{ $data[0]->children }}">

                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="children_increment()"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label class="form-label" for="description" style="font-size: 20px;">Bedroom</label>
                            </div>

                            <div class="col-lg-4">
                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bedroom_decrement()"><i class="fa fa-minus"></i></a>

                                <input id="bedroom" name="bedroom" type=number min=1 style="width:50px; border:none; text-align:right; font-size: 20px;" value="{{ $data[0]->bedroom }}">

                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bedroom_increment()"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label class="form-label" for="description" style="font-size: 20px;">Bathroom</label>
                            </div>

                            <div class="col-lg-4">
                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bathroom_decrement()"><i class="fa fa-minus"></i></a>

                                <input id="bathroom" name="bathroom" type=number min=1 style="width:50px; border:none; text-align:right; font-size: 20px;" value="{{ $data[0]->bathroom }}">

                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="bathroom_increment()"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label class="form-label" for="description" style="font-size: 20px;">Minimum Stay</label>
                            </div>

                            <div class="col-lg-4">
                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="stay_decrement()"><i class="fa fa-minus"></i></a>

                                <input id="stay" name="stay" type=number min=1 style="width:50px; border:none; text-align:right; font-size: 20px;" value="{{ $data[0]->min_stay }}">

                                <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" onclick="stay_increment()"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row mb-3">
                        <div class="col-lg-5" style="padding:auto auto;">
                            <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_three') }}">
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
        "adult":{
            required:!0,
            min:1
        },
        "children":{
            required:!0,
            min:1
        },
        "bedroom":{
            required:!0,
            min:1
        },
        "bathroom":{
            required:!0,
            min:1
        },  
        "stay":{
            required:!0,
            min:1
        },      
    },
});
</script>
<script>
  function adult_increment() {
        document.getElementById('adult').stepUp();
   }
   function adult_decrement() {
      document.getElementById('adult').stepDown();
   }
   function children_increment() {
      document.getElementById('children').stepUp();
   }
   function children_decrement() {
      document.getElementById('children').stepDown();
   }
   function bedroom_increment() {
      document.getElementById('bedroom').stepUp();
   }
   function bedroom_decrement() {
      document.getElementById('bedroom').stepDown();
   }
   function bathroom_increment() {
      document.getElementById('bathroom').stepUp();
   }
   function bathroom_decrement() {
      document.getElementById('bathroom').stepDown();
   }
   function stay_increment() {
      document.getElementById('stay').stepUp();
   }
   function stay_decrement() {
      document.getElementById('stay').stepDown();
   }
</script>
@endsection
            