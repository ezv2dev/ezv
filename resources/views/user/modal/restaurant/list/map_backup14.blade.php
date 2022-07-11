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

    .gm-ui-hover-effect{
        border: 1px solid white;
        border-radius: 50%;
        opacity: 1;
        top: 8px !important;
        right: 8px !important;
        background-color: grey !important;
    }

    .gm-ui-hover-effect > span{
        -webkit-mask-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 20 20' fill='white'%3e%3cpath fill-rule='evenodd' d='M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z' clip-rule='evenodd'/%3e%3c/svg%3e") !important;
        background: white !important;
        width: 17px !important;
        height: 17px !important;
        margin: 7px !important;
    }

    .bg-orange {
        background: #ff7400;
    }

    .text-orange {
        color: #ff7400;
    }

    .js-slider-test > .slick-list{
        border-radius: 0px !important;
    }

    .w-70{
        width: 70%;
    }

    .w-30{
        width: 30%;
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
{{-- declare variable --}}
<script>
    let map;
    var mapLoading;
    var list;
    var customContents = [];
    var infowindow;
    var viewedMarkers = [];
    var primaryMarker, secondaryMarker;
    var primaryContent, secondaryContent;

    var restaurantLocations;
    var markerRestaurant = [];

    var villaLocations;
    var markerVilla = [];

    var hotelLocations;
    var markerHotel = [];

    var activityLocations;
    var markerActivity = [];
</script>
{{-- sub function --}}
<script>
    // function to add marker restaurant
    function addMarkerRestaurant(position, icon) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            icon: icon
        });

        markerRestaurant.push(marker);
    }
    // function to desclare custom content for restaurant
    function addCustomContentRestaurant(restaurantLocations) {
        // check if image exist
        let image = '';
        if(restaurantLocations.photo && restaurantLocations.photo.length != 0) {
            image = '';
            for (let j = 0; j < restaurantLocations.photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 270px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(restaurantLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 270px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height:270px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = restaurantLocations.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = restaurantLocations.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (restaurantLocations.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${restaurantLocations.detail_review.average} Reviews`;
        }

        let cuisine = 'there is no cuisine yet';
        if(restaurantLocations.cuisine.length > 4) {
            cuisine = '';
            for (let j = 0; j < 4; j++) {
                var data = `${restaurantLocations.cuisine[j].name} `;
                cuisine += data;
            }
        } else if(restaurantLocations.cuisine.length > 0 && restaurantLocations.cuisine.length <= 4) {
            cuisine = '';
            for (let j = 0; j < restaurantLocations.cuisine.length; j++) {
                var data = `${restaurantLocations.cuisine[j].name} `;
                cuisine += data;
            }
        }

        var customContent = `
                            <div class="card col-12">
                                <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank">
                                        <p class="card-text text-13 text-grey-1 fw-500">${review}</p>
                                        <p class="card-text text-20 text-orange fw-600 mt-1">${restaurantLocations.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${cuisine}</p>
                                        <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1">${short_description}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker restaurant & show it to map
    function declareMarkerRestaurant() {
        for (let i = 0; i < restaurantLocations.length; i++) {
            // declare secondary marker
            addMarkerRestaurant({
                lat: restaurantLocations[i].latitude,
                long: restaurantLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/restaurant_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });

            // show & highlight restaurant when click
            google.maps.event.addListener(markerRestaurant[i], 'click', (function (marker, i) {
                return function () {
                    // reset restaurant markers
                    for (let index = 0; index < markerRestaurant.length; index++) {
                        markerRestaurant[index].setIcon({
                            url:`{{ asset('assets/icon/map/restaurant_unclicked.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        });
                        markerRestaurant[index].setMap(map);
                    }

                    // add viewed marker restaurant
                    addViewedMarker(restaurantLocations[i].id_restaurant);

                    // marked viewed marker restaurant
                    markedViewedMarker();

                    // highlight target restaurant marker & show info window
                    marker.setMap(null);
                    if(primaryMarker) {
                        primaryMarker.setMap(null);
                        primaryMarker = null;
                    }
                    primaryMarker = new google.maps.Marker({
                        position: marker.getPosition(),
                        map: map,
                        icon: {
                            url:`{{ asset('assets/icon/map/restaurant_active.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        },
                        zIndex: 9999999
                    });

                    // append data to right content
                    if(primaryContent) {
                        primaryContent = null;
                    }
                    primaryContent = addCustomContentRestaurant(restaurantLocations[i]);
                    $('#modal-map-content').html('');
                    $('#modal-map-content').append(primaryContent);

                    // show right content
                    $('#map12').addClass('w-70');
                    $('#map12').removeClass('col-12');
                    setTimeout(() => {
                        $('#modal-map-content').show();
                        // load slick slider
                        runSlickSlider();
                    }, 200);
                };
            })(markerRestaurant[i], i));
        }

        // marked viewed marker restaurant
        markedViewedMarker();
    }

    // function to add marker villa
    function addMarkerVilla(position, icon) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            icon: icon
        });

        markerVilla.push(marker);
    }
    // function to desclare custom content for villa
    function addCustomContentVilla(villaLocations) {
        // check if image exist
        let image = '';
        if(villaLocations.photo.length != 0) {
            image = '';
            for (let j = 0; j < villaLocations.photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(villaLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height:200px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = villaLocations.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = villaLocations.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (villaLocations.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaLocations.detail_review.average} (${villaLocations.detail_review.count_person})`;
        }

        let price = `there is no price yet`;
        if(villaLocations.price) {
            price = `IDR ${villaLocations.price.toLocaleString()}`;
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${villaLocations.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaLocations.adult ?? 0} Guest • ${villaLocations.bedroom ?? 0} Bedroom • ${villaLocations.bathroom ?? 0} Bath • ${villaLocations.parking ?? 0} Parking • ${villaLocations.size ?? 0}m² living</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-17 fw-500 mt-1">${price}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker villa & show it to map
    function declareMarkerVilla() {
        for (let i = 0; i < villaLocations.length; i++) {
            // declare secondary marker
            addMarkerVilla({
                lat: villaLocations[i].latitude,
                long: villaLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/villa.png') }}`,
                scaledSize : new google.maps.Size(20, 20)
            });

            // show & highlight villa when click
            google.maps.event.addListener(markerVilla[i], 'click', (function (marker, i) {
                return function () {
                    // reset villa markers
                    resetVillaMarker();

                    // highlight target villa marker & show info window
                    if(secondaryMarker) {
                        secondaryMarker.setMap(null);
                        secondaryMarker = null;
                    }
                    secondaryMarker = new google.maps.Marker({
                        position: marker.getPosition(),
                        map: map,
                        icon: {
                            url:`{{ asset('assets/icon/map/villa.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        },
                        zIndex: 9999999
                    });

                    // append data to info window content
                    if(secondaryContent) {
                        secondaryContent = null;
                    }
                    secondaryContent = addCustomContentVilla(villaLocations[i]);
                    infowindow.setContent(null);
                    infowindow.setContent(secondaryContent);

                    // show info window
                    google.maps.InfoWindow.prototype.opened = true;
                    infowindow.open(map, secondaryMarker);
                };
            })(markerVilla[i], i));
        }
    }

    // function to add marker hotel
    function addMarkerHotel(position, icon) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            icon: icon
        });

        markerHotel.push(marker);
    }
    // function to desclare custom content for hotel
    function addCustomContentHotel(hotelLocations) {
        // check if image exist
        let image = '';
        if(hotelLocations.photo.length != 0) {
            image = '';
            for (let j = 0; j < hotelLocations.photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.name.toLowerCase()}/${hotelLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(hotelLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.name.toLowerCase()}/${hotelLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height:200px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${hotelLocations.name}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker hotel & show it to map
    function declareMarkerHotel() {
        for (let i = 0; i < hotelLocations.length; i++) {
            // declare secondary marker
            addMarkerHotel({
                lat: hotelLocations[i].latitude,
                long: hotelLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/hotel.png') }}`,
                scaledSize : new google.maps.Size(20, 20)
            });

            // show & highlight hotel when click
            google.maps.event.addListener(markerHotel[i], 'click', (function (marker, i) {
                return function () {
                    // reset villa markers
                    if(markerHotel && markerHotel.length > 0) {
                        for (let index = 0; index < markerHotel.length; index++) {
                            markerHotel[index].setIcon({
                                url:`{{ asset('assets/icon/map/hotel.png') }}`,
                                scaledSize : new google.maps.Size(20, 20)
                            });
                            markerHotel[index].setMap(map);
                        }
                    }

                    // highlight target hotel marker & show info window
                    if(secondaryMarker) {
                        secondaryMarker.setMap(null);
                        secondaryMarker = null;
                    }
                    secondaryMarker = new google.maps.Marker({
                        position: marker.getPosition(),
                        map: map,
                        icon: {
                            url:`{{ asset('assets/icon/map/hotel.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        },
                        zIndex: 9999999
                    });

                    // append data to info window content
                    if(secondaryContent) {
                        secondaryContent = null;
                    }
                    secondaryContent = addCustomContentHotel(hotelLocations[i]);
                    infowindow.setContent(null);
                    infowindow.setContent(secondaryContent);

                    // show info window
                    google.maps.InfoWindow.prototype.opened = true;
                    infowindow.open(map, secondaryMarker);
                };
            })(markerHotel[i], i));
        }
    }

    // function to add marker activity
    function addMarkerActivity(position, icon) {
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            icon: icon
        });

        markerActivity.push(marker);
    }
    // function to desclare custom content for activity
    function addCustomContentActivity(activityLocations) {
        // check if image exist
        let image = '';
        if(activityLocations.photo.length != 0) {
            image = '';
            for (let j = 0; j < activityLocations.photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(activityLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height:200px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = activityLocations.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = activityLocations.short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (activityLocations.detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${activityLocations.detail_review.average} Reviews`;
        }

        let facilities = 'there is no facilities yet';
        if(activityLocations.facilities.length > 4) {
            facilities = '';
            for (let i = 0; i < 4; i++) {
                var data = `${activityLocations.facilities[i].name} `;
                facilities+=data;
            }
        } else if(activityLocations.facilities.length > 0 && activityLocations.facilities.length <= 4) {
            facilities = '';
            for (let i = 0; i < activityLocations.facilities.length; i++) {
                var data = `${activityLocations.facilities[i].name} `;
                facilities+=data;
            }
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="card-body map-description">
                                    <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${activityLocations.name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${facilities}</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-13 fw-500 mt-1">${review}</p>
                                    </a>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker activity & show it to map
    function declareMarkerActivity() {
        for (let i = 0; i < activityLocations.length; i++) {
            // declare secondary marker
            addMarkerActivity({
                lat: activityLocations[i].latitude,
                long: activityLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/activity.png') }}`,
                scaledSize : new google.maps.Size(20, 20)
            });

            // show & highlight activity when click
            google.maps.event.addListener(markerActivity[i], 'click', (function (marker, i) {
                return function () {
                    // reset activity markers
                    if(markerActivity && markerActivity.length > 0) {
                        for (let index = 0; index < markerActivity.length; index++) {
                            markerActivity[index].setIcon({
                                url:`{{ asset('assets/icon/map/activity.png') }}`,
                                scaledSize : new google.maps.Size(20, 20)
                            });
                            markerActivity[index].setMap(map);
                        }
                    }

                    // highlight target activity marker & show info window
                    if(secondaryMarker) {
                        secondaryMarker.setMap(null);
                        secondaryMarker = null;
                    }
                    secondaryMarker = new google.maps.Marker({
                        position: marker.getPosition(),
                        map: map,
                        icon: {
                            url:`{{ asset('assets/icon/map/activity.png') }}`,
                            scaledSize : new google.maps.Size(30, 30)
                        },
                        zIndex: 9999999
                    });

                    // append data to info window content
                    if(secondaryContent) {
                        secondaryContent = null;
                    }
                    secondaryContent = addCustomContentActivity(activityLocations[i]);
                    infowindow.setContent(null);
                    infowindow.setContent(secondaryContent);

                    // show info window
                    google.maps.InfoWindow.prototype.opened = true;
                    infowindow.open(map, secondaryMarker);
                };
            })(markerActivity[i], i));
        }
    }

    // function to refetch data marker
    async function refetchMarkers() {
        // disable action google map
        resetMapAction();

        // enable loading
        setMapLoading();

        console.log('hit refetchMarkers', map.getBounds());
        console.log(map.getZoom(), map.getCenter());
        // prepare data coordinate
        var data = {
            latitude_h: map.getBounds().Ab.h,
            latitude_j: map.getBounds().Ab.j,
            longitude_h: map.getBounds().Ua.h,
            longitude_j: map.getBounds().Ua.j,
        };
        // refetch data for markers
        await fetchRestaurantsLocation(data);
        await fetchVillasLocation(data);
        await fetchHotelsLocation(data);
        await fetchActivitysLocation(data);

        // disable loading
        resetMapLoading();

        // enable action google map
        setMapAction();
    }

    // function to set map event
    function setMapEvent() {
        google.maps.event.addListener(map, "idle", async function() {
            console.log('idle trigger');
            // remove marker villa from map
            removeVillaMarkerFromMap();
            // remove marker restaurant from map
            removeRestaurantMarkerFromMap();
            // remove marker hotel from map
            removeHotelMarkerFromMap();
            // remove marker activity from map
            removeActivityMarkerFromMap();

            // clear variable restaurant
            restaurantLocations = null;
            markerRestaurant = [];
            // clear variable villa
            villaLocations = null;
            markerVilla = [];
            // clear variable hotel
            hotelLocations = null;
            markerHotel = [];
            // clear variable activity
            activityLocations = null;
            markerActivity = [];

            // refetch data
            await refetchMarkers();
        });
    }
    // function to reset map event
    function resetMapEvent() {
        // google.maps.event.clearListeners(map, 'idle');
        // google.maps.event.clearListeners(map, 'dragend');
        google.maps.event.clearListeners(map, 'idle');
    }

    // function to set map action
    function setMapAction() {
        console.log('set map action');
        map.setOptions({draggable: true, zoomControl: true, scrollwheel: true});
    }
    // function to reset map action
    function resetMapAction() {
        console.log('reset map action');
        map.setOptions({draggable: false, zoomControl: false, scrollwheel: false});
    }

    // function to set map loading
    function setMapLoading() {
        $('#location-map-loading').addClass('d-block');
        $('#location-map-loading').removeClass('d-none');
    }
    // function to reset map loading
    function resetMapLoading() {
        $('#location-map-loading').removeClass('d-block');
        $('#location-map-loading').addClass('d-none');
    }

    // function to reset primary marker
    function resetPrimaryMarker() {
        if(primaryMarker) {
            primaryMarker.setMap(null);
            primaryMarker = null;
        }
        if(primaryContent) {
            primaryContent = null;
        }
    }
    // function to reset secondary marker
    function resetSecondaryMarker() {
        if(secondaryMarker) {
            secondaryMarker.setMap(null);
            secondaryMarker = null;
        }
        if(secondaryContent) {
            secondaryContent = null;
        }
    }
    // function to reset villa marker
    function resetVillaMarker() {
        if(markerVilla && markerVilla.length > 0) {
            for (let index = 0; index < markerVilla.length; index++) {
                markerVilla[index].setIcon({
                    url:`{{ asset('assets/icon/map/villa.png') }}`,
                    scaledSize : new google.maps.Size(20, 20)
                });
                markerVilla[index].setMap(map);
            }
        }
    }
    // function to reset restaurant marker
    function resetRestaurantMarker() {
        if(markerRestaurant && markerRestaurant.length > 0) {
            for (let index = 0; index < markerRestaurant.length; index++) {
                markerRestaurant[index].setIcon({
                    url:`{{ asset('assets/icon/map/restaurant_unclicked.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
                });
                markerRestaurant[index].setMap(map);
            }
        }
    }
    // function to reset hotel marker
    function resetHotelMarker() {
        if(markerHotel && markerHotel.length > 0) {
            for (let index = 0; index < markerHotel.length; index++) {
                markerHotel[index].setIcon({
                    url:`{{ asset('assets/icon/map/hotel.png') }}`,
                    scaledSize : new google.maps.Size(20, 20)
                });
                markerHotel[index].setMap(map);
            }
        }
    }
    // function to reset activity marker
    function resetActivityMarker() {
        if(markerActivity && markerActivity.length > 0) {
            for (let index = 0; index < markerActivity.length; index++) {
                markerActivity[index].setIcon({
                    url:`{{ asset('assets/icon/map/activity.png') }}`,
                    scaledSize : new google.maps.Size(20, 20)
                });
                markerActivity[index].setMap(map);
            }
        }
    }

    // function to remove villa marker from map
    function removeVillaMarkerFromMap() {
        if(markerVilla && markerVilla.length > 0) {
            for (let index = 0; index < markerVilla.length; index++) {
                markerVilla[index].setMap(null);
            };
        }
    }
    // function to remove restaurant marker from map
    function removeRestaurantMarkerFromMap() {
        if(markerRestaurant && markerRestaurant.length > 0) {
            for (let index = 0; index < markerRestaurant.length; index++) {
                markerRestaurant[index].setMap(null);
            };
        }
    }
    // function to remove hotel marker from map
    function removeHotelMarkerFromMap() {
        if(markerHotel && markerHotel.length > 0) {
            for (let index = 0; index < markerHotel.length; index++) {
                markerHotel[index].setMap(null);
            };
        }
    }
    // function to remove activity marker from map
    function removeActivityMarkerFromMap() {
        if(markerActivity && markerActivity.length > 0) {
            for (let index = 0; index < markerActivity.length; index++) {
                markerActivity[index].setMap(null);
            };
        }
    }

    // function to add viewed marker restaurant
    function addViewedMarker(id_restaurant) {
        if(viewedMarkers.length > 0) {
            var checkViewedMarkerIdExist = false;
            viewedMarkers.forEach(viewedMarkerId => {
                if(viewedMarkerId == id_restaurant) {
                    checkViewedMarkerIdExist = true;
                }
            });

            if(checkViewedMarkerIdExist != true) {
                viewedMarkers.push(id_restaurant);
                console.log('marker doesnt exist', viewedMarkers);
            }
        } else {
            viewedMarkers.push(id_restaurant);
            console.log('array empty', viewedMarkers);
        }
    }
    // function to marked viewed marker restaurant
    function markedViewedMarker() {
        // if(restaurantLocations.length > 0) {
        //     if(viewedMarkers.length > 0) {
        //         if(markerRestaurant.length > 0) {
        //             viewedMarkers.forEach(id_restaurant => {
        //                 for (let j = 0; j < restaurantLocations.length; j++) {
        //                     if(restaurantLocations[j].id_restaurant && restaurantLocations[j].id_restaurant == id_restaurant) {
        //                         markerRestaurant[j].setIcon({
        //                             url:`{{ asset('assets/icon/map/restaurant_clicked.png') }}`,
        //                             scaledSize : new google.maps.Size(30, 30)
        //                         });
        //                     } else {
        //                         console.log('error on markedViewedMarker');
        //                     }
        //                 }
        //             });
        //         } else {
        //             // console.log('there is no viewed marker yet');
        //         }
        //     }
        // }
    }

    // function to run slider js
    function runSlickSlider() {
        $('.js-slider-test').not('.slick-initialized').slick()
    }
</script>
{{-- fetch function --}}
<script>
    // function to refetch data for marker map
    async function fetchRestaurantsLocation(data) {
        const response = await fetch(`{{ route('map_restaurant_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        restaurantLocations = datas;
        declareMarkerRestaurant();
        console.log('fetch restaurant done');
    }
    async function fetchVillasLocation(data) {
        const response = await fetch(`{{ route('map_villa_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        villaLocations = datas;
        declareMarkerVilla();
        console.log('fetch villa done');
    }
    async function fetchHotelsLocation(data) {
        const response = await fetch(`{{ route('map_hotel_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        hotelLocations = datas;
        declareMarkerHotel();
        console.log('fetch hotel done');
    }
    async function fetchActivitysLocation(data) {
        const response = await fetch(`{{ route('map_activity_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        activityLocations = datas;
        declareMarkerActivity();
        console.log('fetch activity done');
    }
</script>
{{-- main function --}}
<script>
    // init map
    function init_map(){
        // declare map
        mapOptions = {
            zoom: 9,
            scrollwheel: true,
            draggable: true,
            disableDoubleClickZoom: true,
            gestureHandling: "greedy",
            mapTypeControl: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP,
            },
            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM,
            },
            fullscreenControl: false,
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
        map = new google.maps.Map(document.getElementById('map12'), mapOptions);

        // declare info window
        infowindow = new google.maps.InfoWindow({
            shouldFocus: true,
        });

        // load slick slider when infowindow show
        infowindow.addListener('domready', function() {
            runSlickSlider();
        });

        // reset secondary marker when infowindow close
        infowindow.addListener('closeclick', function() {
            // reset secondary marker
            resetSecondaryMarker();
            // reset marker villa
            resetVillaMarker();
            // reset marker hotel
            resetHotelMarker();
            // reset marker activity
            resetActivityMarker();
            // reset marker restaurant
            resetRestaurantMarker();
            // marked viewed marker restaurant
            markedViewedMarker();
        });

        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            if(infowindow.opened) {
                google.maps.InfoWindow.prototype.opened = false;
                infowindow.setContent(null);
                infowindow.close();

                // reset secondary marker
                resetSecondaryMarker();
            } else {
                // reset restaurant markers
                resetRestaurantMarker();
                // marked viewed marker restaurant
                markedViewedMarker();
                // reset primary marker
                resetPrimaryMarker();

                $('#map12').removeClass('w-70');
                $('#map12').addClass('col-12');
                $('#modal-map-content').hide();
            }
        });

        // inject html into map for recenter button
        var reCenter = document.createElement("div");
        reCenter.setAttribute("style",
            "background: white; width: 40px; height: 40px; margin: 10px;"
        );
        var markerIcon = document.createElement("img");
        markerIcon.setAttribute("src", "{{ asset('assets/icon/map/restaurant_active.png') }}");
        markerIcon.setAttribute("style", "width: 100%; height: 100%; padding: 4px; box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px -1px;");
        reCenter.appendChild(markerIcon);
        reCenter.setAttribute("id", "location-map-recenter");
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(reCenter);
        reCenter.addEventListener('click', ()=>{
            if(primaryMarker != null){
                var position = primaryMarker.getPosition();
                map.setZoom(13);
                map.setCenter(position);
            }
        });

        // inject html into map for loading
        mapLoadingContainer = document.createElement("div");
        mapLoading = document.createElement("div");
        var loadingImg = document.createElement("img");
        loadingImg.setAttribute("src", "https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif");
        loadingImg.setAttribute("style", "height: 12px;");
        mapLoading.appendChild(loadingImg);
        mapLoading.setAttribute("id", "location-map-loading");
        mapLoading.setAttribute("class", "p-2 mt-3 bg-white");
        mapLoading.setAttribute("style", "border-radius: 50px; box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px -1px;");
        mapLoadingContainer.appendChild(mapLoading);
        mapLoadingContainer.setAttribute("style", "display: flex; justify-content: center; width: 100vw;");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(mapLoadingContainer);
    };
    // view map
    async function view_maps(id) {
        // reset map event
        resetMapEvent();

        // find restaurant
        fetch(`/map/by-coordinate-area/restaurant/${id}`)
            .then(response => response.json())
            .then(async (data)=>{
                // set map
                map.setZoom(13);
                map.setCenter(new google.maps.LatLng(data.latitude, data.longitude));

                // find & hightlight marker
                if(primaryMarker) {
                    primaryMarker.setMap(null);
                    primaryMarker = null;
                }
                primaryMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(data.latitude, data.longitude),
                    map: map,
                    icon: {
                        url:`{{ asset('assets/icon/map/restaurant_active.png') }}`,
                        scaledSize : new google.maps.Size(30, 30)
                    },
                    zIndex: 9999999
                });
                if(primaryContent) {
                    primaryContent = null;
                }
                primaryContent = addCustomContentRestaurant(data);
                $('#modal-map-content').html('');
                $('#modal-map-content').append(primaryContent);

                // add viewed marker restaurant
                addViewedMarker(data.id_restaurant);

                // show modal
                $("#modal-map").modal('show');

                // show right content
                $('#map12').addClass('w-70');
                $('#map12').removeClass('col-12');
                setTimeout(async () => {
                    $('#modal-map-content').show();
                    // load slick slider
                    runSlickSlider();
                    // refetch data
                    await refetchMarkers();
                    // set map event
                    setMapEvent();
                }, 200);
            });
    }
    // view main map
    async function view_main_map() {
        // reset map event
        resetMapEvent();

        // reset primary marker
        resetPrimaryMarker();

        // reset right content
        $('#map12').removeClass('w-70');
        $('#map12').addClass('col-12');
        $('#modal-map-content').hide();

        // reset secondary marker
        resetSecondaryMarker();

        // reset info window
        infowindow.close();

        // show modal
        $("#modal-map").modal('show');

        // reset map
        map.setZoom(9);
        map.setCenter(new google.maps.LatLng(-8.407166117857772, 115.16441301795386));
        setTimeout(async () => {
            // refetch data
            await refetchMarkers();
            // set map event
            setMapEvent();
        }, 200);
    }
</script>
<script>
    // run init map
    $(window).on('load', () => {
        init_map();
    });
</script>
<!-- MAP MODAL -->
<div class="modal fade modal-map-padding overflow-hidden" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-map modal-xl" role="document">
        <div class="modal-content modal-content-map modal-map">
            <div class="modal-header modal-header-map">
                <h5 class="modal-title">Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-map d-flex justify-content-between align-items-start" style="height: 500px">
                <div class="col-12" style="height:100%; border-radius: 10px;" id="map12"></div>
                <div class="w-30" style="display: none; padding-left: 1.5rem;" id="modal-map-content"></div>
            </div>
        </div>
    </div>
</div>
{{-- END GOOGLE MAPS API --}}
