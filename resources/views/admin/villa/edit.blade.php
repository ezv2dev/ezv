@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"> Edit Villa</h1>
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

    input.error,
    textarea.error {
        font-weight: 300;
        color: red;
    }

</style>
<style>
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

<!-- Validation Wizard 2 -->
<div class="block block-rounded">
    <!-- Step Tabs -->
    <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="step1_tab" data-bs-toggle="tab" data-bs-target="#step1" role="tab"
                aria-controls="step1" aria-selected="true">Basic Info</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="step2_tab" data-bs-toggle="tab" data-bs-target="#step2" role="tab"
                aria-controls="step2" aria-selected="false">Detail Info</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="step3_tab" data-bs-toggle="tab" data-bs-target="#step3" role="tab"
                aria-controls="step3" aria-selected="false">Price</button>
        </li>
    </ul>
    <!-- END Step Tabs -->

    <!-- Form -->
    <form class="js-validation" action="{{ route('admin_villa_update', $find[0]->id_villa) }}" method="POST"
        id="basic-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Steps Content -->
        <div class="block-content block-content-full tab-content px-md-5" style="min-height: 303px;">
            <!-- Step 1 -->
            <div class="tab-pane active" id="step1" role="tabpanel" aria-labelledby="step1_tab">
                <div class="form-group">
                    <label for="name">Villa Name</label>
                    <input class="form-control " type="text" id="name" name="name" value="{{ $find[0]->name }}">
                </div>
                <div class="form-group">
                    <label for="original_name">Villa Original Name</label>
                    <input class="form-control " type="text" id="original_name" name="original_name" value="{{ $find[0]->original_name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="5">{{ $find[0]->description }}</textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="feature">Set villa as Feature</label>
                            <select class="js-select2 form-control" id="feature" name="feature" style="width: 100%;">
                                <option value="0" selected="selected">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="maxadult">Max Adult</label>
                            <input class="form-control" type="text" id="maxadult" name="maxadult"
                                value="{{ $find[0]->adult }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="maxchild">Max Children</label>
                            <input class="form-control" type="text" id="maxchild" name="maxchild"
                                value="{{ $find[0]->children }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input class="form-control" type="text" id="size" name="size" value="{{ $find[0]->size }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="bedroom">Number of Bedroom</label>
                            <input class="form-control" type="text" id="bedroom" name="bedroom"
                                value="{{ $find[0]->bedroom }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="bathroom">Number of Bathroom</label>
                            <input class="form-control" type="text" id="bathroom" name="bathroom"
                                value="{{ $find[0]->bathroom }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="minstay">Minimum Stay</label>
                            <input class="form-control" type="text" id="minstay" name="minstay"
                                value="{{ $find[0]->min_stay }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="booking">Booking Option</label>
                            <select class="js-select2 form-control" id="booking" name="booking" style="width: 100%;">
                                <option value="1">Instant Booking</option>
                                <option value="2">Enquire Booking</option>
                                <option value="3">Instant & Enquire Booking</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-form-label" for="role">Feature Image </label>
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                    @if($find[0]->image != null)
                                    <img style="width: 100%"
                                        src="{{ URL::asset('/foto/gallery/'.strtolower($find[0]->name).'/'.$find[0]->image)}}"
                                        alt="">
                                    @else
                                    <p>Upload Image</p>
                                    <img style="width: 100%" src="" alt="">
                                    @endif
                                </div>
                                <div class="controls" style="display: none;">
                                    <input type="file" name="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Step 1 -->

            <!-- Step 2 -->
            <div class="tab-pane" id="step2" role="tabpanel" aria-labelledby="step2_tab">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="id_location">Villa Location</label>
                            <select class="js-select2 form-control" id="id_location" name="id_location"
                                style="width: 100%;">
                                @foreach ($location as $item)
                                <option value="{{ $item->id_location }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Villa Address</label>
                            <input class="form-control" type="text" id="address" name="address"
                                value="{{ $find[0]->address }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input id="searchTextField" type="text" class="form-control" size="50">
                        <div id="map" style="width:100%;height:380px;"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    value="{{ $find[0]->latitude }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    value="{{ $find[0]->longitude }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="booking">Villa Number</label>
                            <input class="form-control" type="text" id="phone" name="phone"
                                value="{{ $find[0]->phone }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Villa Email</label>
                            <input class="form-control" type="email" id="email" name="email"
                                value="{{ $find[0]->email }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Step 2 -->

            <!-- Step 3 -->
            <div class="tab-pane" id="step3" role="tabpanel" aria-labelledby="step3_tab">
                <div class="form-group row mb-2">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="number" id="price" name="price"
                                value="{{ $find[0]->price }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="discount">Discount Rate (%)</label>
                            <input class="form-control" type="text" id="discount" name="discount"
                                value="{{ $find[0]->discount }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="cancel">Allow Cancel</label>
                            <select class="js-select2 form-control" id="cancel" name="cancel" style="width: 100%;">
                                <option value="0" selected="selected">No</option>
                                <option value="1">Yes</option>
                            </select>
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
            </div>
            <!-- END Step 3 -->

        </div>
        <!-- END Steps Content -->

        <!-- Steps Navigation -->
        <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
            <div class="row">
                <div class="col-6">
                    {{-- <button type="button" class="btn btn-alt-primary" data-wizard="prev">
                        <i class="fa fa-angle-left mr-1"></i> Previous
                    </button> --}}
                </div>
                <div class="col-6 text-right">
                    {{-- <button type="button" class="btn btn-alt-primary" data-wizard="next">
                        Next <i class="fa fa-angle-right ml-1"></i>
                    </button> --}}
                    <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                        <i class="fa fa-check mr-1"></i> Submit
                    </button>
                </div>
            </div>
        </div>
        <!-- END Steps Navigation -->
    </form>
    <!-- END Form -->
</div>
<!-- END Validation Wizard 2 -->
@endsection

@section('scripts')

<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

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
    // variabel global marker
    var marker;

    function taruhMarker(map, posisiTitik) {

        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: map
            });
        }

        // isi nilai koordinat ke form
        document.getElementById("latitude").value = posisiTitik.lat();
        document.getElementById("longitude").value = posisiTitik.lng();

    }

    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -8.396658,
                lng: 115.190841
            },
            zoom: 9
        });

        var input = document.getElementById('searchTextField');

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });


        // even listner ketika peta diklik
        google.maps.event.addListener(map, 'click', function (event) {
            taruhMarker(this, event.latLng);
        });
    }

    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<script>
    $(".image-box").click(function (event) {
        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function () {
                var reader = new FileReader();

                reader.onload = function (e) {
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
    $(".image-box").click(function (event) {
        var previewImg = $(this).children("img");

        $(this)
            .siblings()
            .children("input")
            .trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function () {
                var reader = new FileReader();

                reader.onload = function (e) {
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
        rules: {
            "name": {
                required: !0,
                minlength: 2
            },
            "description": {
                required: !0,
                minlength: 100
            },
            "maxadult": {
                required: !0,
                number: true,
                min: 1
            },
            "maxchild": {
                required: !0,
                number: true,
                min: 1
            },
            "bedroom": {
                required: !0,
                number: true,
                min: 1
            },
            "bathroom": {
                required: !0,
                number: true,
                min: 1
            },
            "minstay": {
                required: !0,
                number: true,
                min: 1
            },
            "address": {
                required: !0,
                minlength: 2
            },
            "id_location": {
                required: !0,
            },
            "email": {
                required: !0,
                email: !0
            },
            "phone": {
                required: !0,
                minlength: 5
            },
            "price": {
                required: !0,
                number: true,
                min: 1
            },
            "discount": {
                number: true,
                min: 1
            },

        },
        messages: {
            "name": {
                required: "This field is required",
                minlength: "Your input must consist of at least 2 characters"
            },
            "description": {
                required: "This field is required",
                minlength: "Your input must consist of at least 100 characters"
            },
            "maxadult": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "maxchild": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "bedroom": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "bathroom": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "minstay": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "address": {
                required: "This field is required",
                minlength: "Your input must consist of at least 2 characters"
            },
            "id_location": {
                required: "This field is required",
            },
            "phone": {
                required: "This field is required",
                minlength: "Your input must consist of at least 5 characters"
            },
            "price": {
                required: "This field is required",
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
            "discount": {
                number: "Please enter your input as a numerical value",
                min: "You must be enter at least 1"
            },
        }
    });

</script>
@endsection
