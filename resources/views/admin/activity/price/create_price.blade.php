@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Add Price
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
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

<!-- Dynamic Table Full -->
<form action="{{ route('admin_activity_store_price') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
@csrf
<input type="hidden" id="id_activity" name="id_activity" value="{{ $find[0]->id_activity }}">
<div class="block block-rounded">
    <div class="block-content">
        <div class="block-content font-size-sm">
            <div class="form-group row mb-2">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter a name..">
            </div>
            <div class="form-group row mb-2">
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter the description.."></textarea>
            </div>
            <div class="form-group row mb-2">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="price">Max Adult</label>
                        <input type="number" min="1" class="form-control" id="adult" name="adult" placeholder="Enter a adult from price..">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="price">Max Children</label>
                        <input type="number" min="1" class="form-control" id="children" name="children" placeholder="Enter a children from price..">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="price">Price</label>
                        <input type="number" min="1" class="form-control" id="price" name="price" placeholder="Enter a price from price..">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="role">Feature Image </label>
                        <div class="col-sm-9">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                      <p>Upload Image</p>
                                      <img style="width: 100%" src="" alt="">
                                  </div>
                                <div class="controls" style="display: none;">
                                      <input type="file" name="image"/>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> 
        <div class="block-content block-content-full text-right border-top">
            <!-- Submit -->
            <div class="row items-push">
                <div class="col-lg-7 offset-lg-4">
                    <button type="submit" class="btn btn-alt-primary">Save</button>
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
<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

<!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
<script>Dashmix.helpersOnLoad(['jq-select2']);</script>

<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<script>
    $(".image-box").click(function(event) {
        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
            });
    });
</script>
<script>
    $("#basic-form").validate({
      errorClass: "error fail-alert",
      validClass: "valid success-alert",
      rules:{
          "name":{
              required:!0,
              minlength:2
          },
          "description":{
              minlength:2
          },
          "price":{
              number: true,
              min: 1
          },
          "adult":{
              number: true,
              min: 1
          }, 
          "children":{
              number: true,
              min: 1
          },         
      },
      messages:{
          "name":{
              required:"Please enter a menu name",
              minlength:"Your input must consist of at least 2 characters"
          },
          "description":{
              minlength:"Your input must consist of at least 2 characters"
          },
          "price":{
              number: "Please enter your input as a numerical value",
              min: "You must be enter at least 1"
          },
          "adult":{
              number: "Please enter your input as a numerical value",
              min: "You must be enter at least 1"
          },
          "children":{
              number: "Please enter your input as a numerical value",
              min: "You must be enter at least 1"
          },
      }
  });
  </script>
@endsection