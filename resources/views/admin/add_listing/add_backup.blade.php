@extends('layouts.admin.add_listing')

@section('content')
    <div class="row">
        <div class="col-lg-6" style="background-color: #000;">
            <div class="">
                <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:20px; padding-right:15px; text-align:right; color : #ff7400;">What type you want to add?</h1>
            </div>

            <div style="padding-left : 20px; padding-right:20px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image" style="background-color : #ff7400; border-radius:25px;" onclick="villa()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <i class="fa fa-2x fa-home" style="color : #fff"></i>
                                        <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">{{ $type[0]->name }}</div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image" style="background-color : #ff7400; border-radius:25px;" onclick="hotel()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <i class="fa fa-2x fa-hotel" style="color : #fff"></i>
                                        <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">{{ $type[1]->name }}</div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image" style="background-color : #ff7400; border-radius:25px;" onclick="restaurant()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <i class="fa fa-2x fa-utensils" style="color : #fff"></i>
                                        <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">{{ $type[2]->name }}</div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-6">
                            <a class="block block-rounded text-center bg-image" style="background-color : #ff7400; border-radius:25px;" onclick="activity()">
                                <div class="block-content block-content-full ratio ratio-16x9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <i class="fa fa-2x fa-walking" style="color : #fff"></i>
                                        <div class="fw-semibold mt-3 text-uppercase" style="color: #fff ">{{ $type[3]->name }}</div>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
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

            <div id="text">
                <h2 style="padding-top:50%">Please Select Type First</h2>
            </div>

            <div id="villa" style="display: none">
                <h3>Please fill out the form below</h3>

                <form action="{{ route('admin_villa_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <input type="text"
                                class="form-control"
                                id="name" name="name" value="{{ old('name') }}"
                                placeholder="name" required>
                            <i class="flaticon-user"></i>
                            @error('name')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <input type="number"
                                class="form-control" name="guest" id="guest"
                                placeholder="max guest" required="required">
                            <i class="flaticon-user"></i>
                        </div>
                    </div>
                    <div class="form-group" id="guest_detail" style="display:none">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <label>adults </label>
                                    <input type="number"
                                        class="form-control"
                                        id="adult" name="adult" value="{{ old('adult') }}"
                                        placeholder="adults" required="required">
                                    <i class="flaticon-user"></i>
                                    @error('adult')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <label>children </label>
                                    <input type="number"
                                        class="form-control"
                                        id="children" name="children" value="{{ old('children') }}"
                                        placeholder="children" required="required">
                                    <i class="flaticon-user"></i>
                                    @error('children')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                            <div class="col">
                                <input type="number"
                                    class="form-control"
                                    id="bedroom" name="bedroom" value="{{ old('bedroom') }}"
                                    placeholder="bedroom" required="required">
                                <i class="flaticon-user"></i>
                                @error('bedroom')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="number"
                                    class="form-control"
                                    id="bathroom" name="bathroom" value="{{ old('bathroom') }}"
                                    placeholder="bathroom" required="required">
                                <i class="flaticon-user"></i>
                                @error('bathroom')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="id_location" class="form-label" style="font-size: 20px;">Villa Location</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;">
                                        <option></option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_location')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <input id="searchTextField" type="text" class="form-control" size="50">
                                <div id="map" style="width:100%;height:280px;"></div>
                                <input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="Enter a latitude..">
                                <input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="Enter a longitude..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1 row">
                            <div class="col">
                                <input type="text"
                                    class="form-control"
                                    id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="phone" maxlength="50" required="required">
                                <i class="flaticon-user"></i>
                                @error('phone')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="email"
                                    class="form-control"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="email" maxlength="100" required="required">
                                <i class="flaticon-user"></i>
                                @error('email')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                    <p>Upload Image</p>
                                    <img style="width: 100%" src="" alt="">
                            </div>
                            <div class="controls" style="display: none;">
                                    <input type="file" name="image"/>
                            </div>
                        </div>
                        @error('image')
                            <div class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>

            <div id="hotel" style="display: none">
                <span>hotel</span>
            </div>

            <div id="restaurant" style="display: none">
                <span>restaurant</span>
            </div>

            <div id="activity" style="display: none">
                <span>activity</span>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
function villa() {
  document.getElementById("villa").style.display = "block";
  document.getElementById("text").style.display = "none";
  document.getElementById("hotel").style.display = "none";
  document.getElementById("restaurant").style.display = "none";
  document.getElementById("activity").style.display = "none";
}

function hotel() {
  document.getElementById("villa").style.display = "none";
  document.getElementById("text").style.display = "none";
  document.getElementById("hotel").style.display = "block";
  document.getElementById("restaurant").style.display = "none";
  document.getElementById("activity").style.display = "none";
}

function restaurant() {
  document.getElementById("villa").style.display = "none";
  document.getElementById("text").style.display = "none";
  document.getElementById("hotel").style.display = "none";
  document.getElementById("restaurant").style.display = "block";
  document.getElementById("activity").style.display = "none";
}

function activity() {
  document.getElementById("villa").style.display = "none";
  document.getElementById("text").style.display = "none";
  document.getElementById("hotel").style.display = "none";
  document.getElementById("restaurant").style.display = "none";
  document.getElementById("activity").style.display = "block";
}

$('input[name=guest]').keyup(function(){
    if($(this).val().length){
        $('#guest_detail').show();
        $('#adult').val($('#guest').val());
    }else{
        $('#guest_detail').hide();
    }
});

$('#children').keyup(function(){
    var adult = $('#guest').val();
    var child = $('#children').val();
    $('#adult').val(adult - child);
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
{{-- image upload --}}
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
