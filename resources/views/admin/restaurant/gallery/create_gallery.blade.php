@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        {{ $find[0]->name }} Galllery
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome <a class="font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                    </h2>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">

<!-- Page Content -->
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Gallery</h3>
    </div>
    <!-- Simple Gallery -->
    @if(!$gallery == false)
        <div class="row items-push js-gallery js-gallery push">
            @foreach($gallery as $item)
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <div class="options-container fx-item-rotate-r">
                        <img class="img-fluid" style="width: 234px; height: 156px; object-fit: cover" src="{{ URL::asset('/foto/restaurant/'.strtolower($find[0]->name).'/'.$item->name)}}" alt="">
                        <div class="options-overlay bg-black-75">
                            <div class="options-overlay-content">
                                <a class="btn btn-sm btn-primary img-lightbox" href="{{ URL::asset('/foto/restaurant/'.strtolower($find[0]->name).'/'.$item->name)}}">
                                    <i class="fa fa-search-plus mr-1"></i> View
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('admin_restaurant_delete_gallery', $item->id_photo) }}">
                                    <i class="fa fa-trash-alt mr-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row items-push js-gallery js-gallery push" id="video">
            @foreach($video as $item2)
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <div class="options-container fx-item-rotate-r">
                        <img class="img-fluid" style="width: 234px; height: 156px; object-fit: cover" src="{{ asset('assets/media/videos/video-1.png') }}" alt="">
                        <div class="options-overlay bg-black-75">
                            <div class="options-overlay-content">
                                <button class="btn btn-sm btn-primary" href="{{ URL::asset('/foto/gallery/'.strtolower($find[0]->name).'/'.$item2->name)}}">
                                    <i class="fa fa-search-plus mr-1"></i> View
                                </button>
                                <a class="btn btn-sm btn-danger" href="{{ route('admin_villa_delete_video', $item2->id_video) }}">
                                    <i class="fa fa-trash-alt mr-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endif
    <!-- END Simple Gallery -->
    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
        <div class="row">
            <div class="col-lg-12">
                <!-- DropzoneJS Container -->
                <form class="dropzone" action="{{ route('admin_restaurant_store_gallery') }}" id="frmTarget">
                @csrf 
                <input type="hidden" value="{{ $find[0]->id_restaurant }}" id="id_restaurant" name="id_restaurant">
                </form>
                <br>
            </div>
        </div>
    </div>
    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
        <div class="row">
            <div class="col-6">
                <button type="submit" id="button" class="btn btn-primary">Upload</button>
            </div>
            <div class="col-6 text-right">
                {{-- <button type="button" class="btn btn-alt-danger" >
                   <i class="fa fa-angle-left ml-1"></i>  List Villa 
                </button> --}}
                <a type="button" class="btn btn-alt-success" href="{{ route('admin_restaurant') }}">
                    Back <i class="fa fa-angle-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- END Dropzone -->

<!-- END Page Content -->
@endsection

@section('scripts')

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>Dashmix.helpersOnLoad(['jq-magnific-popup']);</script>

<script>
Dropzone.options.frmTarget = {
    autoProcessQueue: false,
    url: '/admin/restaurant/store_gallery',
    parallelUploads: 50,
    init: function () {

        var myDropzone = this;

        // Update selector to match your button
        $("#button").click(function (e) {
            e.preventDefault();
            myDropzone.processQueue();
            
        });

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            // var data = $('#frmTarget').serializeArray();
            // $.each(data, function(key, el) {
            //     formData.append(el.name, el.value);
            // });
            var value = $('form#formData #id_restaurant').val();
            formData.append('id_restaurant', value);
        });

        this.on('queuecomplete', function () {
            location.reload();
        });

        this.on("addedfile", function(file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<center><button class='btn btn-outline-light'>Remove</button></center>");


            // Capture the Dropzone instance as closure.
            var _this = this;

            // Listen to the click event
            removeButton.addEventListener("click", function(e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                // Remove the file preview.
                _this.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });
    }
}
</script>

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
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto control-group lst").remove();
      });
    });
</script>
<script>
$(document).ready(function() {
    $('#video').magnificPopup({
        delegate: 'button', 
        type: 'iframe',
        gallery:{
            enabled:true
        }
    });
});
</script>

@endsection