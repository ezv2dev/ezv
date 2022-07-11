{{-- GOOGLE MAPS API --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

<style>
    #map12 * {
        -moz-transition: none;
        -webkit-transition: none;
        -o-transition: all 0s ease;
        transition: none;
    }

    .bg-orange {
        background: #ff7400;
    }
</style>

<!-- custom style for info window -->
{{-- <style>
    /* hide close button on info window */
    /* .gm-style-iw > button {
                            display: none !important;
                        } */
    /* hide scroll */
    /* .gm-style-iw {
                            overflow: hidden !important;
                        } */
    /* hide scroll and hidden padding*/
    /* .gm-style-iw-d {
                            overflow: hidden !important;
                            /* padding: 0px !important; */
    }

    */

    /* hide padding & custom border radius */
    .gm-style .gm-style-iw-c {
        padding: 0px !important;
        border-radius: 75px !important;
    }

    .card-img-top {
        aspect-ratio: 4/3;
        height: 170px;
        object-fit: cover;
    }

    .gm-style-iw-d {
        height: auto !important;
        overflow: visible !important;
    }

    .shadow-lg {
        box-shadow: none !important
    }

    .card {
        border: none !important;
        width: 16rem !important;
    }

    .gm-style-iw {
        padding: 0px !important;
    }

    .poi-info-window.gm-style {
        padding: 10px !important;
    }

    .gm-style-iw.gm-style-iw-c {
        height: auto !important;
        max-height: unset !important;
    }

    .gm-style-iw-d {
        height: auto !important;
        max-height: unset !important;
    }

    .card-text {
        font-family: 'Poppins' !important;
        font-weight: 400;
        font-size: 14px;
        margin: 0px;
    }

    .card-body {
        padding: 0.8rem !important;
    }

    .rounded-pill {
        border-radius: 50px !important;
        padding: 9px 10px 9px 10px !important;
        box-shadow: rgb(0 0 0 / 4%) 0px 0px 0px 1px, rgb(0 0 0 / 18%) 0px 2px 4px;
    }

</style> --}}

<style>
    .map-description{
        padding: 2rem 0rem 0rem 0rem !important;
    }

    .grid-image{
        border-radius: 10px;
    }

    .card{
        border: none;
    }

    .object-type{
        font-weight: 600;
        color: #ff7400;
    }
</style>

<script>
    let map;
    var infowindows = [];
    var customContents = [];
    var markers = [];
    var secondaryMarkers = [];
    // var marker, i;

    // function to add marker and save it to markers array
    function addMarker(position, label) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            label: label,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 8,
                optimized: true,
            }
        });

        markers.push(marker);
    }

    // function to add secondary markers and save it to secondaryMarkers array
    function addSecondaryMarker(i) {
        var tempArray = [];
        var marker;

        if(villaLocations[i].activity_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < villaLocations[i].activity_nearby.length; j++) {
                // console.log(myLatlng);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        villaLocations[i].activity_nearby[j].detail.latitude,
                        villaLocations[i].activity_nearby[j].detail.longitude
                    ),
                    map: null,
                    // label: villaLocations[i].activity_nearby[j].detail.name,
                    icon: {
                        url:`{{ asset('assets/icon/map/activity.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    },
                    optimized: true
                });
                childTempArray.push(marker);
            }
            if(childTempArray.length) {
                tempArray[0] = childTempArray;
            }
        }

        if(villaLocations[i].restaurant_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < villaLocations[i].restaurant_nearby.length; j++) {
                // console.log(myLatlng);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        villaLocations[i].restaurant_nearby[j].detail.latitude,
                        villaLocations[i].restaurant_nearby[j].detail.longitude
                    ),
                    map: null,
                    // label: villaLocations[i].restaurant_nearby[j].detail.name,
                    icon: {
                        url:`{{ asset('assets/icon/map/restaurant.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    }
                });
                childTempArray.push(marker);
            }
            if(childTempArray.length) {
                tempArray[1] = childTempArray;
            }
        }
        // console.log(tempArray);

        if(tempArray.length > 0) {
            secondaryMarkers[i] = tempArray;
        }
        console.log(secondaryMarkers);

        for (let i = 0; i < secondaryMarkers.length; i++) {
            var data = secondaryMarkers[i] ?? null;
            if(data) {
                if(secondaryMarkers[i][0]) {
                    for (let k = 0; k < secondaryMarkers[i][0].length; k++) {
                        google.maps.event.addListener(secondaryMarkers[i][0][k], 'click', (function (marker, i, k) {
                            return function () {
                                infowindow.setContent(null);
                                infowindow.setContent(villaLocations[i].activity_nearby[k].detail.name);
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][0][k], i, k));
                    }
                }
                if(secondaryMarkers[i][1]) {
                    for (let k = 0; k < secondaryMarkers[i][1].length; k++) {
                        google.maps.event.addListener(secondaryMarkers[i][1][k], 'click', (function (marker, i, k) {
                            return function () {
                                infowindow.setContent(null);
                                infowindow.setContent(villaLocations[i].restaurant_nearby[k].detail.name);
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][1][k], i, k));
                    }
                }
            }
        }

        // secondaryMarkers[0].push(marker);
        // console.log(secondaryMarkers);
        // console.log(i, position, label, icon);
    }


    // function to desclare custom content for infowindow
    function addCustomContent(villaLocations, i) {
        // check if image exist
        let image = '';
        // if(villaLocations[i].photo.length != 0) {
        //     image = '';
        //     for (let j = 0; j < villaLocations[i].photo.length; j++) {
        //         image += `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image" style="display: block; height: 200px;"
        //                 src="{{ URL::asset('/foto/villa/${villaLocations[i].name.toLowerCase()}/${villaLocations[i].photo[j].name}')}}"
        //                 alt="">
        //         </a>`;
        //     }
        // } else {
        //     if(villaLocations[i].image != null) {
        //         image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image bg-primary" style="display: block; height: 200px;"
        //                 src="{{ URL::asset('/foto/villa/${villaLocations[i].name.toLowerCase()}/${villaLocations[i].image}')}}"
        //                 alt="">
        //         </a>`;
        //     } else {
        //         image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image" style="display: block; height:200px;"
        //                 src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
        //                 alt="">
        //         </a>`;
        //     }
        // }
        if(villaLocations[i].image != null) {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image bg-primary" style="display: block; height: 200px;"
                    src="{{ URL::asset('/foto/gallery/${villaLocations[i].uid.toLowerCase()}/${villaLocations[i].image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image" style="display: block; height:200px;"
                    src="{{ URL::asset('/template/gallery/template_profile.jpg') }}"
                    alt="">
            </a>`;
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (villaLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaLocations[i].detail_review.average} (${villaLocations[i].detail_review.count_person})`;
        }

        let price = `there is no price yet`;
        if (villaLocations[i].price!= null) {
            let price = `IDR ${villaLocations[i].price.toLocaleString()}`;
        }

        var customContent = `
                            <div class="card col-12">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="card-body map-description">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank">
                                        <p class="card-text text-secondary">
                                            <small>
                                                ${review}
                                            </small>
                                        </p>
                                        <p class="card-text object-type">${villaLocations[i].property_type.name} • ${villaLocations[i].location.name}</p>
                                        <p class="card-text">${villaLocations[i].name} • ${price}</p>
                                        <p class="card-text">${villaLocations[i].short_description}</p>
                                    </a>
                                </div>
                            </div>`;

        customContents.push(customContent);
    }

    // init map when page is completed load
    function initViewMap(){
        // console.log('hit view map');
        // declare map
        map = new google.maps.Map(document.getElementById('map12'), {
            zoom: 9,
            scrollwheel: true,
            draggable: true,
            gestureHandling: "greedy",
            center: new google.maps.LatLng(-8.62, 115.09),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "on"
                    }]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }
            ]
        });

        // declare info window
        infowindow = new google.maps.InfoWindow({
            shouldFocus: true
        });
        // infowindow.addListener('domready', function() {
        //     $('.js-slider-test').slick();
        // });

        // declare markers & show it to map
        for (let i = 0; i < villaLocations.length; i++) {
            addMarker({
                lat: villaLocations[i].latitude,
                long: villaLocations[i].longitude
            }, {
                text: villaLocations[i].name,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });

            addSecondaryMarker(i);

            addCustomContent(villaLocations, i);

            // show & highlight villa when click
            google.maps.event.addListener(markers[i], 'click', (function (marker, i) {
                return function () {
                    // reset villa markers
                    for (let index = 0; index < markers.length; index++) {
                        markers[index].setLabel({
                            text: villaLocations[index].name,
                            className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                        });
                    }

                    // highlight target villa marker & show info window
                    marker.setLabel({
                        text: villaLocations[i].name,
                        className: 'text-white fw-bold px-1 py-1 rounded-pill bg-orange'
                    });

                    // reset secondary markers
                    for (let i = 0; i < secondaryMarkers.length; i++) {
                        if(secondaryMarkers[i] != null) {
                            for (let j = 0; j < secondaryMarkers[i].length; j++) {
                                if(secondaryMarkers[i][j] != null) {
                                    for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                        secondaryMarkers[i][j][k].setMap(null);
                                    }
                                }
                            }
                        }
                    }

                    // show secondary marker around target villa
                    console.log(secondaryMarkers);
                    if(secondaryMarkers[i] != null) {
                        for (let j = 0; j < secondaryMarkers[i].length; j++) {
                            if(secondaryMarkers[i][j] != null) {
                                for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                    secondaryMarkers[i][j][k].setMap(map);
                                }
                            }
                        }
                    }

                    // infowindow.setContent(null);
                    // infowindow.setContent(customContents[i]);
                    $('#modal-map-content').html('');
                    $('#modal-map-content').append(customContents[i]);

                    $('#map12').addClass('col-8');
                    $('#map12').removeClass('col-12');
                    setTimeout(() => {
                        $('#modal-map-content').show();
                    }, 200);
                    // infowindow.open(map, marker);
                }
            })(markers[i], i));
        }

        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            for (let index = 0; index < markers.length; index++) {
                markers[index].setLabel({
                    text: villaLocations[index].name,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                });
            };

            // reset secondary markers
            for (let i = 0; i < secondaryMarkers.length; i++) {
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        if(secondaryMarkers[i][j] != null) {
                            for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                secondaryMarkers[i][j][k].setMap(null);
                            }
                        }
                    }
                }
            }

            $('#map12').removeClass('col-8');
            $('#map12').addClass('col-12');
            $('#modal-map-content').hide();

            infowindow.close();
        });
    };

    function view_maps(mapId) {
        // console.log(customContents, markers);
        // reset all villa markers to default
        for (let i = 0; i < villaLocations.length; i++) {
            markers[i].setLabel({
                text: villaLocations[i].name,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });
            infowindow.close();
            infowindow.setContent(null);
        }

        // reset secondary markers
        for (let i = 0; i < secondaryMarkers.length; i++) {
            if(secondaryMarkers[i] != null) {
                for (let j = 0; j < secondaryMarkers[i].length; j++) {
                    if(secondaryMarkers[i][j] != null) {
                        for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                            secondaryMarkers[i][j][k].setMap(null);
                        }
                    }
                }
            }
        }

        // find, show and hightlight target villa marker
        for (let i = 0; i < villaLocations.length; i++) {
            if (villaLocations[i].id_villa == mapId) {
                markers[i].setLabel({
                    text: villaLocations[i].name,
                    className: 'text-white fw-bold px-1 py-1 rounded-pill bg-orange'
                });

                // show secondary marker around target villa
                console.log(secondaryMarkers);
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        if(secondaryMarkers[i][j] != null) {
                            for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                secondaryMarkers[i][j][k].setMap(map);
                            }
                        }
                    }
                }
                // infowindow.setContent(null);
                // infowindow.setContent(customContents[i]);
                $('#modal-map-content').html('');
                $('#modal-map-content').append(customContents[i]);

                map.setZoom(13);
                map.setCenter(markers[i].getPosition());

                // Add radius overlay to map
                // const set_radius = new google.maps.Circle({
                //     strokeColor: "#d56203",
                //     strokeOpacity: 0.4,
                //     strokeWeight: 2,
                //     fillColor: "#ff7400",
                //     fillOpacity: 0.10,
                //     map: map,
                //     center: markers[i].getPosition(),
                //     radius: 3 * 1000, // 20km
                // });

                $('#map12').addClass('col-8');
                $('#map12').removeClass('col-12');
                setTimeout(() => {
                    $('#modal-map-content').show();
                }, 200);
                // map.setCenter(new google.maps.LatLng(villaLocations[i].latitude, villaLocations[i].longitude));
                // infowindow.addListener('domready', function() {
                //     $('.js-slider-test').slick();
                // });
                // infowindow.open(map, markers[i]);
                break;
            }
        }
        $("#modal-map").modal('show');
    }
</script>

<script>
    var list = @json($list);
    var villaLocations = [];

    function getData(ajaxurl) {
        return $.ajax({
            url: ajaxurl,
            type: 'GET',
        });
    };

    function fetchVillasLocation(ids) {
        var promises = [];
        ids.forEach(id => {
            var request = getData(`{{ env('APP_URL') }}/villa/map/${id}`).then((data) => {
                villaLocations.push(data);
                console.log(`process fetch villa ${id}`);
            });
            promises.push(request);
        });

        $.when.apply(null, promises).done(async () => {
            console.log(villaLocations);
            await fetchRestaurantNearbyVilla(villaLocations);
            await fetchActivityNearbyVilla(villaLocations);
        });
    }

    function fetchRestaurantNearbyVilla(villas) {
        var promises = [];
        villas.forEach((villa) => {
            var request = getData(`{{ env('APP_URL') }}/villa/restaurant-nearby/${villa.id_villa}`).then((restaurants) => {
                villa['restaurant_nearby'] = restaurants;
                console.log(`process fetch restaurant nearby ${villa.id_villa}`);
            });
            promises.push(request);
        });

        $.when.apply($, promises).done(() => {
            // console.log(villas);
        });
    }

    function fetchActivityNearbyVilla(villas) {
        var promises = [];
        villas.forEach((villa) => {
            var request = getData(`{{ env('APP_URL') }}/villa/things-to-do-nearby/${villa.id_villa}`).then((activity) => {
                villa['activity_nearby'] = activity;
                console.log(`process fetch activity nearby ${villa.id_villa}`);
            });
            promises.push(request);
        });

        $.when.apply($, promises).done(() => {
            // console.log(villas);
            initViewMap();
        });
    }

    fetchVillasLocation(list);
</script>

<!-- MAP MODAL -->
<div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-map">
            <div class="modal-header">
                <h5 class="modal-title">Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-map d-flex justify-content-between align-items-start" style="height: 500px">
                <div class="col-12" style="height:100%; border-radius: 10px;" id="map12"></div>
                <div class="col-4" style="display: none; padding-left: 1.5rem;" id="modal-map-content"></div>
            </div>
        </div>
    </div>
</div>
{{-- END GOOGLE MAPS API --}}
