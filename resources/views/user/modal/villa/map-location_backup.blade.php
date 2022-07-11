<style>
    #map-location * {
        -moz-transition: none;
        -webkit-transition: none;
        -o-transition: all 0s ease;
        transition: none;
    }

    .bg-orange {
        background: #ff7400;
    }

    .bg-clicked {
        background: #d5d5d5;
    }

    .text-orange {
        color: #ff7400;
    }
</style>

<!-- custom style for info window -->
<style>
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


      /* Styling for map component*/

      .card-text {
        font-family: 'Poppins' !important;
        font-weight: 400;
        margin: 0px;
    }

    .mb-0{
        margin-bottom: 0px !important;
    }

    .text-12{
        font-size: 12px;
    }

    .text-13{
        font-size: 13px;
    }

    .text-14{
        font-size: 14px;
    }

    .text-17{
        font-size: 17px;
    }

    .text-18{
        font-size: 18px;
    }

    .text-20{
        font-size: 20px;
    }

    .text-align-left{
        text-align: left;
    }

    .text-align-center{
        text-align: center;
    }

    .text-align-right{
        text-align: right;
    }

    .text-align-justify{
        text-align: justify;
    }

    .fw-400{
        font-weight: 400;
    }

    .fw-500{
        font-weight: 500;
    }

    .fw-600{
        font-weight: 600;
    }

    .text-grey-1{
        color: #707070;
    }

    .text-grey-2{
        color: #ACACAC;
    }

    .br-10{
        border-radius: 10px;
    }

    .h-150{
        display: block;
        height: 150px;
    }

    .h-180{
        display: block;
        height: 150px;
    }

    .h-200{
        display: block;
        height: 200px;
    }
    /* END Styling for map component*/


    .rounded-pill {
        border-radius: 50px !important;
        padding: 9px 10px 9px 10px !important;
        box-shadow: rgb(0 0 0 / 4%) 0px 0px 0px 1px, rgb(0 0 0 / 18%) 0px 2px 4px;
    }

</style>

<style>

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
    var viewedMarkers = [];
    var markers = [];
    var secondaryMarkers = [];
    // var marker, i;

    // function to add marker and save it to markers array
    function addMarker(position, icon) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            icon: icon
        });

        markers.push(marker);
    }

    // function to add secondary markers and save it to secondaryMarkers array
    function addSecondaryMarker(i) {
        var tempArray = [];
        var marker;

        // marker for villa nearby
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
                    icon: {
                        url:`{{ asset('assets/icon/map/restaurant.png') }}`,
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

        // marker for activity nearby
        if(villaLocations[i].activity_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < villaLocations[i].activity_nearby.length; j++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        villaLocations[i].activity_nearby[j].detail.latitude,
                        villaLocations[i].activity_nearby[j].detail.longitude
                    ),
                    map: null,
                    icon: {
                        url:`{{ asset('assets/icon/map/activity.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    }
                });
                childTempArray.push(marker);
            }
            if(childTempArray.length) {
                tempArray[1] = childTempArray;
            }
        }

        if(tempArray.length > 0) {
            secondaryMarkers[i] = tempArray;
        }
        // console.log(secondaryMarkers);

        for (let i = 0; i < secondaryMarkers.length; i++) {
            var data = secondaryMarkers[i] ?? null;
            if(data) {
                // set onclick marker infoWindow villa
                if(secondaryMarkers[i][0]) {
                    for (let k = 0; k < secondaryMarkers[i][0].length; k++) {
                        google.maps.event.addListener(secondaryMarkers[i][0][k], 'click', (function (marker, i, k) {
                            return function () {
                                var content = addCustomContentRestaurant(villaLocations[i].restaurant_nearby[k].detail);
                                infowindow.setContent(null);
                                infowindow.setContent(content);
                                google.maps.InfoWindow.prototype.opened = true;
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][0][k], i, k));
                    }
                }
                // set onclick marker infoWindow activity
                if(secondaryMarkers[i][1]) {
                    for (let k = 0; k < secondaryMarkers[i][1].length; k++) {
                        google.maps.event.addListener(secondaryMarkers[i][1][k], 'click', (function (marker, i, k) {
                            return function () {
                                var content = addCustomContentActivity(villaLocations[i].activity_nearby[k].detail);
                                infowindow.setContent(null);
                                infowindow.setContent(content);
                                google.maps.InfoWindow.prototype.opened = true;
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][1][k], i, k));
                    }
                }
            }
        }
    }

    // function to desclare custom content for infowindow
    function addCustomContent(villaLocations, i) {
        // check if image exist
        let image = '';
        if(villaLocations[i].image != null) {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image br-10 h-200"
                    src="{{ URL::asset('/foto/gallery/${villaLocations[i].uid.toLowerCase()}/${villaLocations[i].image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image br-10 h-200"
                    src="{{ URL::asset('/template/gallery/template_profile.jpg') }}"
                    alt="">
            </a>`;
        }

        var short_description = villaLocations[i].short_description ?? 'there is no description yet';
        if(short_description.length > 150) {
            short_description = villaLocations[i].short_description.substring(0, 150)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (villaLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaLocations[i].detail_review.average} Reviews`;
        }

        let price = 'there is no price yet';
        if(villaLocations[i].price != null) {
            price = `IDR ${villaLocations[i].price.toLocaleString()}`;
        }

        let amenities = 'there is no amenities yet';
        if(villaLocations[i].amenities.length > 9) {
            amenities = '';
            for (let j = 0; j < 9; j++) {
                var name = villaLocations[i].amenities[j].name;
                if(name.length > 7) {
                    name = name.substring(0, 7)+'...';
                }
                amenities += `<div class="list-amenities">
                                <div class="text-align-center">
                                    <i class="f-40 fa fa-${villaLocations[i].amenities[j].icon}"></i>
                                    <p class="mb-0">${name}
                                    </p>
                                </div>
                                <div class="mb-0 list-more">${villaLocations[i].amenities[j].name}</div>
                            </div>`;
            }
        } else if(villaLocations[i].amenities.length > 0 && villaLocations[i].amenities.length <= 9) {
            amenities = '';
            for (let j = 0; j < villaLocations[i].amenities.length; j++) {
                var name = villaLocations[i].amenities[j].name;
                if(name.length > 7) {
                    name = name.substring(0, 7)+'...';
                }
                amenities += `<div class="list-amenities">
                                <div class="text-align-center">
                                    <i class="f-40 fa fa-${villaLocations[i].amenities[j].icon}"></i>
                                    <p class="mb-0">${name}
                                    </p>
                                </div>
                                <div class="mb-0 list-more">${villaLocations[i].amenities[j].name}</div>
                            </div>`;
            }
        }

        var customContent = `
                            <div class="col-12" style="padding: 15px;">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank">
                                        <p class="card-text text-13 text-grey-1 fw-500">${review}</p>
                                        <p class="card-text text-20 text-orange fw-600 mt-1">${villaLocations[i].name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaLocations[i].adult ?? 0} Guest • ${villaLocations[i].bedroom ?? 0} Bedroom • ${villaLocations[i].bathroom ?? 0} Bath • ${villaLocations[i].parking ?? 0} Parking • ${villaLocations[i].size ?? 0}m² living</p>
                                        <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-17 text-orange fw-600 mt-1">${price}</p>
                                    </a>
                                </div>
                                <div class="row-grid-list-amenities mt-3">
                                    ${amenities}
                                </div>
                                
                            </div>`;

        customContents.push(customContent);
    }
    function addCustomContentRestaurant(restaurantContent) {
        // check if image exist
        let image = '';
        if(restaurantContent.image != null) {
            image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantContent.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/restaurant/${restaurantContent.uid.toLowerCase()}/${restaurantContent.image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantContent.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                    alt="">
            </a>`;
        }

        var short_description = restaurantContent.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = restaurantContent.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (restaurantContent.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${restaurantContent.detail_review.average} Reviews`;
        }

        let cuisine = 'there is no cuisine yet';
        if(restaurantContent.cuisine.length > 4) {
            cuisine = '';
            for (let j = 0; j < 4; j++) {
                var data = `${restaurantContent.cuisine[j].name} `;
                cuisine += data;
            }
        } else if(restaurantContent.cuisine.length > 0 && restaurantContent.cuisine.length <= 4) {
            cuisine = '';
            for (let j = 0; j < restaurantContent.cuisine.length; j++) {
                var data = `${restaurantContent.cuisine[j].name} `;
                cuisine += data;
            }
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/restaurant/${restaurantContent.id_restaurant}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${restaurantContent.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${cuisine}</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-13 fw-500 mt-1">${review}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }
    function addCustomContentActivity(activityContent) {
        // check if image exist
        let image = '';
        if(activityContent.image != null) {
            image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityContent.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/activity/${activityContent.uid.toLowerCase()}/${activityContent.image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityContent.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                    alt="">
            </a>`;
        }

        var short_description = activityContent.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = activityContent.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (activityContent.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${activityContent.detail_review.average} Reviews`;
        }

        let facilities = 'there is no facilities yet';
        if(activityContent.facilities.length > 4) {
            facilities = '';
            for (let i = 0; i < 4; i++) {
                var data = `${activityContent.facilities[i].name} `;
                facilities+=data;
            }
        } else if(activityContent.facilities.length > 0 && activityContent.facilities.length <= 4) {
            facilities = '';
            for (let i = 0; i < activityContent.facilities.length; i++) {
                var data = `${activityContent.facilities[i].name} `;
                facilities+=data;
            }
        }

        var customContent = `
                            <div class="card" style="width: 17rem;">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/things-to-do/${activityContent.id_activity}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${activityContent.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${facilities}</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-13 fw-500 mt-1">${review}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }

    // init map when page is completed load
    function initViewMap(){
        // declare map
        mapOptions = {
            zoom: 15,
            draggable: true,
            mapTypeControl: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP,
            },
            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM,
            },
            fullscreenControl:true,
            fullscreenControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM,
            },
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
        };
        map = new google.maps.Map(document.getElementById('map-location'), mapOptions);

        // declare info window
        infowindow = new google.maps.InfoWindow({
            shouldFocus: true
        });

        // declare markers & show it to map
        for (let i = 0; i < villaLocations.length; i++) {
            // check if price exist on the villa
            var price = 'there is no price yet';
            if(villaLocations[i].price != null) {
                price = 'IDR '+villaLocations[i].price.toLocaleString();
            }

            // declare marker
            addMarker({
                lat: villaLocations[i].latitude,
                long: villaLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/villa_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });

            // declare custom content for marker
            addCustomContent(villaLocations, i);

            // declare secondary marker
            addSecondaryMarker(i);
        }

        // close info window when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            infowindow.setContent(null);
            google.maps.InfoWindow.prototype.opened = false;
            infowindow.close();
        });

        // inject html into map for right content
        var rightContent = document.createElement("div");
        rightContent.setAttribute("style",
            "background: white; width: 320px; height: 100%; display: none;"
        );
        rightContent.setAttribute("id", "location-map-right-content");
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(rightContent);

        // open full screen when double click on google map
        google.maps.event.addListener(map, "dblclick", function (event) {
            // set right content
            $('#location-map-right-content').html(customContents[0]);
            $('button[title="Toggle fullscreen view"]').trigger('click');
        });

        // check if full screen event happened
        google.maps.event.addListener( map, 'bounds_changed', function(event){
            if ( $(map.getDiv()).children().eq(0).height() == window.innerHeight &&
            $(map.getDiv()).children().eq(0).width()  == window.innerWidth ) {
                $('#location-map-right-content').show();
                map.setOptions({gestureHandling: "greedy"});
            }
            else {
                $('#location-map-right-content').hide();
                map.setOptions({gestureHandling: "cooperative"});
            }
        });

        // inject html into map for recenter button
        var reCenter = document.createElement("div");
        reCenter.setAttribute("style",
            "background: white; width: 40px; height: 40px; margin: 10px;"
        );
        var markerIcon = document.createElement("img");
        markerIcon.setAttribute("src", "{{ asset('assets/icon/map/villa_active.png') }}");
        markerIcon.setAttribute("style", "width: 100%; height: 100%; padding: 4px; box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px -1px;");
        reCenter.appendChild(markerIcon);
        reCenter.setAttribute("id", "location-map-recenter");
        map.controls[google.maps.ControlPosition.LEFT_CENTER].push(reCenter);
        reCenter.addEventListener('click', ()=>{
            var position = markers[0].getPosition();
            map.setCenter(position);
            map.setZoom(13);
        });

        // find, show and hightlight target villa marker
        for (let i = 0; i < villaLocations.length; i++) {
            if (villaLocations[i].id_villa == villaLocations[i].id_villa) {
                markers[i].setIcon({
                    url:`{{ asset('assets/icon/map/villa_active.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
                });

                // show secondary marker around target villa
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        if(secondaryMarkers[i][j] != null) {
                            for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                secondaryMarkers[i][j][k].setMap(map);
                            }
                        }
                    }
                }

                map.setZoom(13);
                map.setCenter(markers[i].getPosition());

                break;
            }
        }
    };
</script>

<script>
    var list = @json($villa[0]);
    var villaLocations = [];
    villaLocations.push(list);

    $(window).on('load', () => {
        console.log(villaLocations);
        initViewMap();
    });
</script>
<div id="map-location" style="width:100%;height:100%; min-height: 410px; border-radius: 12px;" class=""></div>
