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

    .ml-1{
        margin-left: 0.25rem;
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

    .text-orange{
        color: #ff7400;
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
    var markers = [];
    var viewedMarkers = [];
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
        if(activityLocations[i].villa_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < activityLocations[i].villa_nearby.length; j++) {
                // console.log(myLatlng);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        activityLocations[i].villa_nearby[j].detail.latitude,
                        activityLocations[i].villa_nearby[j].detail.longitude
                    ),
                    map: null,
                    icon: {
                        url:`{{ asset('assets/icon/map/villa.png') }}`,
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
        if(activityLocations[i].restaurant_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < activityLocations[i].restaurant_nearby.length; j++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        activityLocations[i].restaurant_nearby[j].detail.latitude,
                        activityLocations[i].restaurant_nearby[j].detail.longitude
                    ),
                    map: null,
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

        // marker for hotel nearby
        if(activityLocations[i].hotel_nearby.length) {
            var childTempArray = [];
            for (let j = 0; j < activityLocations[i].hotel_nearby.length; j++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        activityLocations[i].hotel_nearby[j].detail.latitude,
                        activityLocations[i].hotel_nearby[j].detail.longitude
                    ),
                    map: null,
                    icon: {
                        url:`{{ asset('assets/icon/map/hotel.png') }}`,
                        scaledSize : new google.maps.Size(20, 20)
                    }
                });
                childTempArray.push(marker);
            }
            if(childTempArray.length) {
                tempArray[2] = childTempArray;
            }
        }
        // console.log(tempArray);

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
                                var content = addCustomContentVilla(activityLocations[i].villa_nearby[k].detail);
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
                                var content = addCustomContentRestaurant(activityLocations[i].restaurant_nearby[k].detail);
                                infowindow.setContent(null);
                                infowindow.setContent(content);
                                google.maps.InfoWindow.prototype.opened = true;
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][1][k], i, k));
                    }
                }
                // set onclick marker infoWindows hotel
                if(secondaryMarkers[i][2]) {
                    for (let k = 0; k < secondaryMarkers[i][2].length; k++) {
                        google.maps.event.addListener(secondaryMarkers[i][2][k], 'click', (function (marker, i, k) {
                            return function () {
                                var content = addCustomContentHotel(activityLocations[i].hotel_nearby[k].detail);
                                infowindow.setContent(null);
                                infowindow.setContent(content);
                                google.maps.InfoWindow.prototype.opened = true;
                                infowindow.open(map, marker);
                            }
                        })(secondaryMarkers[i][2][k], i, k));
                    }
                }
            }
        }
    }

    function addCustomContentVilla(villaContent) {
        // check if image exist
        let image = '';
        if(villaContent.image != null) {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaContent.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/gallery/${villaContent.uid.toLowerCase()}/${villaContent.image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/villa/${villaContent.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/template/gallery/template_profile.jpg') }}"
                    alt="">
            </a>`;
        }

        var short_description = villaContent.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = villaContent.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (villaContent.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaContent.detail_review.average} Reviews`;
        }

        let price = `there is no price yet`;
        if(villaContent.price) {
            price = `IDR ${villaContent.price.toLocaleString()}/night`;
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/villa/${villaContent.id_villa}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${villaContent.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaContent.adult ?? 0} Guest • ${villaContent.bedroom ?? 0} Bedroom • ${villaContent.bathroom ?? 0} Bath • ${villaContent.parking ?? 0} Parking • ${villaContent.size ?? 0}m² living</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-17 fw-500 mt-1">${price}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
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

    function addCustomContentHotel(hotelContent) {
        // check if image exist
        let image = '';
        if(hotelContent.image != null) {
            image = `<a href="{{ env('APP_URL') }}/hotel/${hotelContent.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/hotel/${hotelContent.name.toLowerCase()}/${hotelContent.image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/hotel/${hotelContent.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image h-180"
                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                    alt="">
            </a>`;
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/hotel/${hotelContent.id_hotel}" target="_blank">
                                        <p  class="card-text text-orange mb-0 text-20 fw-600">${hotelContent.name}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }

    // function to desclare custom content for infowindow
    function addCustomContent(activityLocations, i) {
        // check if image exist
        let image = '';
        if(activityLocations[i].image != null) {
            image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations[i].id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image br-10 h-200"
                    src="{{ URL::asset('/foto/activity/${activityLocations[i].uid.toLowerCase()}/${activityLocations[i].image}')}}"
                    alt="">
            </a>`;
        } else {
            image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations[i].id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                <img class="img-fluid grid-image br-10 h-200"
                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                    alt="">
            </a>`;
        }

        var short_description = activityLocations[i].short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = activityLocations[i].short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (activityLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${activityLocations[i].detail_review.average} Reviews`;
        }

        let facilities = 'there is no facilities yet';
        if(activityLocations[i].facilities.length > 4) {
            facilities = '';
            for (let j = 0; j < 4; j++) {
                var data = `${activityLocations[i].facilities[j].name} `;
                facilities+=data;
            }
        } else if(activityLocations[i].facilities.length > 0 && activityLocations[i].facilities.length <= 4) {
            facilities = '';
            for (let j = 0; j < activityLocations[i].facilities.length; j++) {
                var data = `${activityLocations[i].facilities[j].name} `;
                facilities+=data;
            }
        }
        // console.log(facilities);

        var customContent = `
                            <div class="card col-12">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations[i].id_activity}" target="_blank">
                                        <p class="card-text text-13 text-grey-1 fw-500">${review}</p>
                                        <p class="card-text text-20 text-orange fw-600 mt-1">${activityLocations[i].name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${facilities}</p>
                                        <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1">${short_description}</p>
                                    </a>
                                </div>
                            </div>`;

        customContents.push(customContent);
    }

    // function to add viewed marker list
    function addViewedMarker(i) {
        if(viewedMarkers.length > 0) {
            var checkViewedMarkerIndexExist = false;
            viewedMarkers.forEach(viewedMarkerIndex => {
                if(viewedMarkerIndex == i) {
                    checkViewedMarkerIndexExist = true;
                }
            });

            if(checkViewedMarkerIndexExist != true) {
                viewedMarkers.push(i);
                // console.log('marker doesnt exist', viewedMarkers);
            }
        } else {
            viewedMarkers.push(i);
            // console.log('array empty', viewedMarkers);
        }
    }

    // function to marked viewed marker
    function markedViewedMarker(markers) {
        if(viewedMarkers.length > 0) {
            viewedMarkers.forEach(index => {
                markers[index].setIcon({
                    url:`{{ asset('assets/icon/map/activity_clicked.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
                });
            });
        } else {
            // console.log('there is no viewed marker yet');
        }
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

        // declare markers & show it to map
        for (let i = 0; i < activityLocations.length; i++) {
            addMarker({
                lat: activityLocations[i].latitude,
                long: activityLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });

            addSecondaryMarker(i);

            addCustomContent(activityLocations, i);

            // show & highlight activity when click
            google.maps.event.addListener(markers[i], 'click', (function (marker, i) {
                return function () {
                    // reset activity markers
                    for (let index = 0; index < markers.length; index++) {
                        markers[index].setIcon({
                            url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        });
                    }

                    // add viewed marker
                    addViewedMarker(i);

                    // marked viewed marker
                    markedViewedMarker(markers);

                    // highlight target activity marker & show info window
                    marker.setIcon({
                        url:`{{ asset('assets/icon/map/activity_active.png') }}`,
                        scaledSize : new google.maps.Size(30, 30)
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

                    // show secondary marker around target activity
                    if(secondaryMarkers[i] != null) {
                        for (let j = 0; j < secondaryMarkers[i].length; j++) {
                            if(secondaryMarkers[i][j] != null) {
                                for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                    secondaryMarkers[i][j][k].setMap(map);
                                }
                            }
                        }
                    }
                    $('#modal-map-content').html('');
                    $('#modal-map-content').append(customContents[i]);

                    $('#map12').addClass('col-8');
                    $('#map12').removeClass('col-12');
                    setTimeout(() => {
                        $('#modal-map-content').show();
                    }, 200);
                }
            })(markers[i], i));
        }

        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            // console.log('hit');
            if(infowindow.opened) {
                google.maps.InfoWindow.prototype.opened = false;
                infowindow.setContent(null);
                infowindow.close();
            } else {
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
                for (let index = 0; index < markers.length; index++) {
                    markers[index].setIcon({
                        url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                        scaledSize : new google.maps.Size(30, 30)
                    });
                };

                markedViewedMarker(markers);

                $('#map12').removeClass('col-8');
                $('#map12').addClass('col-12');
                $('#modal-map-content').hide();
            }
        });
    };

    function view_maps(mapId) {
        // reset all activity markers to default
        for (let i = 0; i < activityLocations.length; i++) {
            markers[i].setIcon({
                url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });
            google.maps.InfoWindow.prototype.opened = false;
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

        // find, show and hightlight target activity marker
        for (let i = 0; i < activityLocations.length; i++) {
            if (activityLocations[i].id_activity == mapId) {
                // add viewed marker
                addViewedMarker(i);

                // marked viewed marker
                markedViewedMarker(markers);

                markers[i].setIcon({
                    url:`{{ asset('assets/icon/map/activity_active.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
                });

                // show secondary marker around target activity
                if(secondaryMarkers[i] != null) {
                    for (let j = 0; j < secondaryMarkers[i].length; j++) {
                        if(secondaryMarkers[i][j] != null) {
                            for (let k = 0; k < secondaryMarkers[i][j].length; k++) {
                                secondaryMarkers[i][j][k].setMap(map);
                            }
                        }
                    }
                }

                $('#modal-map-content').html('');
                $('#modal-map-content').append(customContents[i]);

                map.setZoom(13);
                map.setCenter(markers[i].getPosition());

                $('#map12').addClass('col-8');
                $('#map12').removeClass('col-12');
                setTimeout(() => {
                    $('#modal-map-content').show();
                }, 200);
                break;
            }
        }
        $("#modal-map").modal('show');
    }

    function view_main_map() {
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
        for (let index = 0; index < markers.length; index++) {
            markers[index].setIcon({
                url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });
        };

        markedViewedMarker(markers);

        $('#map12').removeClass('col-8');
        $('#map12').addClass('col-12');
        $('#modal-map-content').hide();
        $("#modal-map").modal('show');
    }
</script>
<script>
    var list = @json($activity);
    var activityLocations = list.data;
    // prepare data before get
    $(document).ready(() => {
        console.log(activityLocations);
        initViewMap();
    });
</script>

<!-- MAP MODAL -->
<div class="modal fade modal-map-padding" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-map modal-xl" role="document">
        <div class="modal-content modal-content-map modal-map">
            <div class="modal-header modal-header-map">
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
