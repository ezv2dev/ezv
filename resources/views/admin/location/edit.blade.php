@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill text-align-left">
                    <h1 class="h3 font-w700 mb-2">
                        Edit Location
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome <a class="font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>, everything looks great.
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
<!-- Stylesheets -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
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

<!-- Dynamic Table Full -->
<form action="{{ route('admin_location_update', $find[0]->id_location) }}" method="POST" id="frm_tambah" class="js-validation" enctype="multipart/form-data" >
@csrf
@method('PUT')
<div class="block block-rounded">
    <div class="block-content">
        <div class="block-content font-size-sm">
            <input type="hidden" value="{{ $find[0]->id_location }}" name="id_location" id="id_location">
            <div class="form-group mb-2 row">
                {{-- <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label> --}}
                <div class="col-sm-12">
                    <input type="text" class="form-control mb-2" id="name" name="name" value="{{ $find[0]->name }}">
                </div>
            </div>
            <div class="form-group mb-2 row">
                {{-- <label class="col-sm-3 col-form-label" for="description">Description <span class="text-danger">*</span></label> --}}
                <div class="col-sm-12">
                    <textarea class="form-control" id="description" name="description" rows="5">{{ $find[0]->description }}</textarea>
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-sm-12">
                    <input id="searchTextField" type="text" class="form-control mb-2" size="50">
                    <div id="map" style="width:100%;height:380px;"></div>
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $find[0]->latitude }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $find[0]->longitude }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-2 row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="role">Parent </label>
                        <div class="col-sm-9">
                            <select class="js-select2 form-control" id="id_parent" name="id_parent" style="width: 100%;" data-placeholder="Choose one location parent..">
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach($location as $data)
                                    <option value="{{ $data->id_location }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="role">Feature Image </label>
                        <div class="col-sm-9">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                    @if($find[0]->image != null)
                                        <img style="width: 100%" src="{{ URL::asset('/foto/location/'.strtolower($find[0]->name).'/'.$find[0]->image)}}" alt="">
                                    @else
                                        <p>Upload Image</p>
                                        <img style="width: 100%" src="" alt="">
                                    @endif
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
                <div class="col-lg-7" style="padding: 0px;">
                    <button onclick="save()" class="btn btn-alt-primary button-admin">Save</button>
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

<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){One.helpers('select2');});</script>

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

function save(){
	$.ajax({
        $id = $('#id_location').val();
		type: "PUT",
		url: "/admin/location/update/" + $id,
	data: {
		'name' : $('#name').val(),
		'description' : $('#description').val(),
		'id_parent' : $('#id_parent').val(),
		'latitude' : $('#latitude').val(),
		'longitude' : $('#longitude').val(),
		'image' : $('#image').val(),
		_token : "{{ csrf_token() }}"
	},
	success: function(data){
		Swal.fire(
        'Good job!',
        'Your data has been submited',
        'success'
        )
		setTimeout(location.reload.bind(location), 500);
	},
	error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire(
            'Sorry',
            'Your data failed to submited',
            'warning'
            )
		}
	});
}
</script>
@endsection