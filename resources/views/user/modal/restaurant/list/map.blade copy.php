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
        font-weight: 300;
        font-size: 14px;
        margin: 0px;
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

        if(restaurantLocations[i].activity_nearby.length) {
            for (let j = 0; j < restaurantLocations[i].activity_nearby.length; j++) {
                // console.log(myLatlng);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        restaurantLocations[i].activity_nearby[j].detail.latitude,
                        restaurantLocations[i].activity_nearby[j].detail.longitude
                    ),
                    map: null,
                    // label: restaurantLocations[i].activity_nearby[j].detail.name,
                    icon: {
                        url:`{{ asset('assets/icon/map/activity.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    },
                    optimized: true
                });
                tempArray.push(marker);
            }
        }

        if(restaurantLocations[i].villa_nearby.length) {
            for (let j = 0; j < restaurantLocations[i].villa_nearby.length; j++) {
                // console.log(myLatlng);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        restaurantLocations[i].villa_nearby[j].detail.latitude,
                        restaurantLocations[i].villa_nearby[j].detail.longitude
                    ),
                    map: null,
                    // label: restaurantLocations[i].villa_nearby[j].detail.name,
                    icon: {
                        url:`{{ asset('assets/icon/map/villa.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    }
                });
                tempArray.push(marker);
            }
        }

        if(tempArray.length > 0) {
            secondaryMarkers[i] = tempArray;
        }

        for (let i = 0; i < secondaryMarkers.length; i++) {
            var data = secondaryMarkers[i] ?? null;
            if(data) {
                for (let j = 0; j < secondaryMarkers[i].length; j++) {
                    google.maps.event.addListener(secondaryMarkers[i][j], 'click', (function (marker, i, j) {
                        return function () {
                            infowindow.setContent(null);
                            infowindow.setContent(restaurantLocations[i].activity_nearby[j].detail.name);
                            infowindow.open(map, marker);
                        }
                    })(secondaryMarkers[i][j], i, j));
                }
            }
        }

        // secondaryMarkers[0].push(marker);
        // console.log(secondaryMarkers);
        // console.log(i, position, label, icon);
    }


    // function to desclare custom content for infowindow
    function addCustomContent(restaurantLocations, i) {
        // check if image exist
        let image = '';
        // if(restaurantLocations[i].photo.length != 0) {
        //     image = '';
        //     for (let j = 0; j < restaurantLocations[i].photo.length; j++) {
        //         image += `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image" style="display: block; height: 200px;"
        //                 src="{{ URL::asset('/foto/restaurant/${restaurantLocations[i].name.toLowerCase()}/${restaurantLocations[i].photo[j].name}')}}"
        //                 alt="">
        //         </a>`;
        //     }
        // } else {
        //     if(restaurantLocations[i].image != null) {
        //         image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image bg-primary" style="display: block; height: 200px;"
        //                 src="{{ URL::asset('/foto/restaurant/${restaurantLocations[i].name.toLowerCase()}/${restaurantLocations[i].image}')}}"
        //                 alt="">
        //         </a>`;
        //     } else {
        //         image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
        //             <img class="img-fluid grid-image" style="display: block; height:200px;"
        //                 src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
        //                 alt="">
        //         </a>`;
        //     }
        // }
        if(restaurantLocations[i].image != null) {
            image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image bg-primary" style="display: block; height: 200px;"
                    src="{{ URL::asset('/foto/restaurant/${restaurantLocations[i].name.toLowerCase()}/${restaurantLocations[i].image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image" style="display: block; height:200px;"
                    src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                    alt="">
            </a>`;
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (restaurantLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${restaurantLocations[i].detail_review.average} (${restaurantLocations[i].detail_review.count_person})`;
        }

        let price = `there is no price yet`;
        if (restaurantLocations[i].price!= null) {
            if(restaurantLocations[i].price.name.toLowerCase() == 'cheap prices') {
                price = '$';
            } else if(restaurantLocations[i].price.name.toLowerCase() == 'middle range') {
                price = '$$';
            } else if(restaurantLocations[i].price.name.toLowerCase() == 'fine dining') {
                price = '$$$';
            }
        }

        var short_description = restaurantLocations[i].short_description ?? 'there is no description yet';
        if(short_description.length > 120) {
            short_description = restaurantLocations[i].short_description.substring(120)+'...';
        }

        var customContent = `
                            <div class="card col-12">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="card-body map-description">
                                    <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank">
                                        <p class="card-text text-secondary">
                                            <small>
                                                ${review}
                                            </small>
                                        </p>
                                        <p class="card-text object-type">${restaurantLocations[i].type.name} • ${restaurantLocations[i].location.name}</p>
                                        <p class="card-text">${restaurantLocations[i].name} • ${price}</p>
                                        <p class="card-text">${short_description}</p>
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
        for (let i = 0; i < restaurantLocations.length; i++) {
            addMarker({
                lat: restaurantLocations[i].latitude,
                long: restaurantLocations[i].longitude
            }, {
                text: restaurantLocations[i].name,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });

            addSecondaryMarker(i);

            addCustomContent(restaurantLocations, i);

            // show & highlight restaurant when click
            google.maps.event.addListener(markers[i], 'click', (function (marker, i) {
                return function () {
                    // reset restaurant markers
                    for (let index = 0; index < markers.length; index++) {
                        markers[index].setLabel({
                            text: restaurantLocations[index].name,
                            className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                        });
                    }

                    // highlight target restaurant marker & show info window
                    marker.setLabel({
                        text: restaurantLocations[i].name,
                        className: 'text-white fw-bold px-1 py-1 rounded-pill bg-orange'
                    });

                    // reset secondary markers
                    for (let i = 0; i < secondaryMarkers.length; i++) {
                        if(secondaryMarkers[i] != null) {
                            for (let j = 0; j < secondaryMarkers[i].length; j++) {
                                secondaryMarkers[i][j].setMap(null);
                            }
                        }
                    }

                    // show secondary marker around target restaurant
                    console.log(secondaryMarkers);
                    if(secondaryMarkers[i] != null) {
                        for (let j = 0; j < secondaryMarkers[i].length; j++) {
                            secondaryMarkers[i][j].setMap(map);
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
                    text: restaurantLocations[index].name,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                });
            };

            // reset secondary markers
            for (let i = 0; i < secondaryMarkers.length; i++) {
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        secondaryMarkers[i][j].setMap(null);
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
        // reset all restaurant markers to default
        for (let i = 0; i < restaurantLocations.length; i++) {
            markers[i].setLabel({
                text: restaurantLocations[i].name,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });
            infowindow.close();
            infowindow.setContent(null);
        }

        // reset secondary markers
        for (let i = 0; i < secondaryMarkers.length; i++) {
            if(secondaryMarkers[i] != null) {
                for (let j = 0; j < secondaryMarkers[i].length; j++) {
                    secondaryMarkers[i][j].setMap(null);
                }
            }
        }

        // find, show and hightlight target restaurant marker
        for (let i = 0; i < restaurantLocations.length; i++) {
            if (restaurantLocations[i].id_restaurant == mapId) {
                markers[i].setLabel({
                    text: restaurantLocations[i].name,
                    className: 'text-white fw-bold px-1 py-1 rounded-pill bg-orange'
                });

                // show secondary marker around target restaurant
                console.log(secondaryMarkers);
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        secondaryMarkers[i][j].setMap(map);
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
    var restaurantLocations = [];

    function getData(ajaxurl) {
        return $.ajax({
            url: ajaxurl,
            type: 'GET',
        });
    };

    function fetchRestaurantsLocation(ids) {
        var promises = [];
        ids.forEach(id => {
            var request = getData(`{{ env('APP_URL') }}/restaurant/map/${id}`).then((data) => {
                restaurantLocations.push(data);
                console.log(`process fetch restaurant ${id}`);
            });
            promises.push(request);
        });

        $.when.apply(null, promises).done(async () => {
            console.log(restaurantLocations);
            await fetchVillaNearbyRestaurant(restaurantLocations);
            await fetchActivityNearbyRestaurant(restaurantLocations);
        });
    }

    function fetchVillaNearbyRestaurant(restaurants) {
        var promises = [];
        restaurants.forEach((restaurant) => {
            var request = getData(`{{ env('APP_URL') }}/restaurant/villa-nearby/${restaurant.id_restaurant}`).then((villas) => {
                restaurant['villa_nearby'] = villas;
                console.log(`process fetch villa nearby ${restaurant.id_restaurant}`);
            });
            promises.push(request);
        });

        $.when.apply($, promises).done(() => {
            // console.log(restaurants);
        });
    }

    function fetchActivityNearbyRestaurant(restaurants) {
        var promises = [];
        restaurants.forEach((restaurant) => {
            var request = getData(`{{ env('APP_URL') }}/restaurant/things-to-do-nearby/${restaurant.id_restaurant}`).then((activity) => {
                restaurant['activity_nearby'] = activity;
                console.log(`process fetch activity nearby ${restaurant.id_restaurant}`);
            });
            promises.push(request);
        });

        $.when.apply($, promises).done(() => {
            // console.log(restaurants);
            initViewMap();
        });
    }

    fetchRestaurantsLocation(list);
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
