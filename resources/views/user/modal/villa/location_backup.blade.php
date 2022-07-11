<div class="modal fade" id="modal-edit_location" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('villa_update_location') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">

                    <label class="col-sm-3 col-form-label" for="bed" style="font-size: 20px;">Location</label>
                    <div class="col-sm-12 mb-3">
                        <select class="js-select2 form-select" id="id_location" name="id_location" style="width: 100%;">
                            <option></option>
                            @foreach ($location as $item)
                            @php
                            $selected = '';
                            if($item->id_location == $villa[0]->id_location) // Any Id
                            {
                            $selected = 'selected="selected"';
                            }
                            @endphp
                            <option value="{{ $item->id_location }}" {{$selected}}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <input id="searchTextField2" type="text" class="form-control" size="50">
                        <div id="map2" style="width:100%;height:280px;"></div>
                        <input type="hidden" class="form-control" id="latitude" name="latitude"
                            placeholder="Enter a latitude..">
                        <input type="hidden" class="form-control" id="longitude" name="longitude"
                            placeholder="Enter a longitude..">
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

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

    $('input[name=guest]').keyup(function () {
        if ($(this).val().length) {
            $('#guest_detail').show();
            $('#adult').val($('#guest').val());
        } else {
            $('#guest_detail').hide();
        }
    });

    $('#children').keyup(function () {
        var adult = $('#guest').val();
        var child = $('#children').val();
        $('#adult').val(adult - child);
    });

</script>
<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

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
        var map = new google.maps.Map(document.getElementById('map2'), {
            center: {
                lat: -8.396658,
                lng: 115.190841
            },
            zoom: 9
        });

        var input = document.getElementById('searchTextField2');

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


{{-- image upload --}}
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
<!-- END Fade In Default Modal -->
