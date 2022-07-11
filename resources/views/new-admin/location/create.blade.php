@extends('new-admin.layouts.admin_layout')

@section('content_admin')
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
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="h3 font-w700 mb-2">
                            Add Location
                        </h1>
                    </div>
                    <div class="mt-3 mt-sm-0 ml-sm-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">Add Location Form</div>
            <div class="card-body">
                <form action="{{ route('admin_location_store') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                    @csrf
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="block-content font-size-sm text-black">
                                <div class="form-group row">
                                    {{-- <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label> --}}
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter a name..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- <label class="col-sm-3 col-form-label" for="description">Description <span class="text-danger">*</span></label> --}}
                                    <div class="col-sm-12 mb-3">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter the description.."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input id="searchTextField" type="text" class="form-control mb-2" size="50">
                                        <div id="map" style="width:100%;height:380px;" class="mb-2"></div>
                                    </div>
                                </div>
                                <div class="form-group row d-none">
                                    <div class="col-sm-6 mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="Enter a latitude..">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="Enter a longitude..">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
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
            </div>
        </div>
    </div>
    {{-- END CONTENT --}}
@endsection

@section('scripts')
<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places"></script>
<script>

    // variabel global marker
    var marker;

    function taruhMarker(map, posisiTitik){

        if( marker ){
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
        center: {lat: -8.396658, lng: 115.190841},
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

        autocomplete.addListener('place_changed', function() {
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
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });
    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);
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
@endsection
