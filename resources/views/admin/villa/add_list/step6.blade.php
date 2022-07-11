@extends('layouts.admin.step_add_villa')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">Create a gallery for your villa</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_villa') }}">
                        <i class="fa fa-save"></i> Save & exit
                    </a>
                </div>

                <div style="padding-top:6%;">
                    <!-- Simple Gallery -->
                    @if(!$gallery == false)
                    <div class="row items-push js-gallery js-gallery push">
                        @foreach($gallery as $item)
                            <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                                <div class="options-container fx-item-rotate-r">
                                    <img class="img-fluid" style="width: 234px; height: 156px; object-fit: cover" src="{{ URL::asset('/foto/gallery/'.strtolower($find[0]->name).'/'.$item->name)}}" alt="">
                                    <div class="options-overlay bg-black-75">
                                        <div class="options-overlay-content">
                                            <a class="btn btn-sm btn-primary img-lightbox" href="{{ URL::asset('/foto/gallery/'.strtolower($find[0]->name).'/'.$item->name)}}">
                                                <i class="fa fa-search-plus mr-1"></i> View
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('admin_villa_delete_gallery', $item->id_photo) }}">
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
                            <form class="dropzone" action="{{ route('admin_villa_store_gallery') }}" id="frmTarget">
                            @csrf 
                            <input type="hidden" value="{{ $find[0]->id_villa }}" id="id_villa" name="id_villa">
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
                            <div class="row">
                                <div class="col-6">
                                    <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_five') }}">
                                        Back
                                    </a>
                                </div>
                                <div class="col-6">    
                                    <a style="float: right;" class="btn btn-outline-secondary" href="{{ route('villa_add_step_six_store') }}">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- END Dropzone -->
                </div>

                <!-- Footer -->
                {{-- <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row">
                        <div class="col-lg-5" style="padding:auto auto;">
                            <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_five') }}">
                                Back
                            </a>
                            <button style="float: right;" type="submit" class="btn btn-outline-secondary">
                                Next
                            </button>
                        </div>
                    </div>
                </div>   --}}
                <!-- END Footer -->
                    
            </div>
        </div>
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
        url: '/admin/villa/store_gallery',
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
                var value = $('form#formData #id_villa').val();
                formData.append('id_villa', value);
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
            