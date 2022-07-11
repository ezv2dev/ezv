@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Add Location
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
<link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
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

<!-- Dynamic Table Full -->
<form action="{{ route('admin_location_store') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
@csrf
<div class="block block-rounded">
    <div class="block-content">
        <div class="block-content font-size-sm">
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
            <div class="form-group row">
                <div class="col-sm-6 mb-2">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter a latitude..">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter a longitude..">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-2">
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
                    <button onclick="save()" class="btn btn-alt-primary">Save</button>
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
<script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>

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
    },
    messages:{
        "name":{
            required:"Please enter a name of location",
            minlength:"Your input must consist of at least 2 characters"
        },
    }
});

function save(){
	$.ajax({
		type: "POST",
		url: "{{ route('admin_location_store') }}",
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
		Swal.fire({
            title: 'Success!',
            text: 'Your data has been submited',
            icon: 'success',
            confirmButtonText: 'OK'
        })

		setTimeout(location.reload.bind(location), 500);
	},
	error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
                title: 'Error!',
                text: 'Your data failed to submit',
                icon: 'error',
                confirmButtonText: 'OK'
            })
		}
	});
}
</script>
@endsection