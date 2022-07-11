@extends('layouts.admin.step_add_villa')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">

    <form class="js-validation" action="{{ route('activity_add_step_four_store') }}" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">Where we can contact you?</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_restaurant') }}">
                        <i class="fa fa-save"></i> Save & exit
                    </a>
                </div>

                <div style="padding-top:6%;">
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="id_location" class="form-label" style="font-size: 20px;">Restaurant Location</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;">
                                        <option></option>
                                    @foreach ($location as $item)
                                        <option value="{{ $item->id_location }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="id_location" class="form-label" style="font-size: 20px;">Restaurant Address</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" id="address" name="address" value={{ $data[0]->address }}>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <input id="searchTextField" type="text" class="form-control" size="50">
                                <div id="map" style="width:100%;height:280px;"></div>
                                <input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="Enter a latitude..">
                                <input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="Enter a latitude..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="booking">Phone Number</label>
                                <input class="form-control" type="text" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row">
                        <div class="col-lg-5" style="padding:auto auto;">
                            <a type="button" class="btn btn-outline-secondary" href="{{ route('restaurant_add_step_three') }}">
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

<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script>
$("#basic-form").validate({
    errorClass: "error fail-alert",
    validClass: "valid success-alert",
    rules:{
        "address":{
            required:!0,
            minlength:5
        },        
    },
    messages:{
        "address":{
            required:"Please enter a restaurant address",
            minlength:"Your input must consist of at least 5 characters"
        },
    }
});
</script>

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
@endsection
            