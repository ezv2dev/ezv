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
        height: 260px;
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
    var contentIsExist = false;
    var mapMobileIsOpen = false;

    var restaurantLocations;
    var markerRestaurant = [];

    var villaLocations;
    var markerVilla = [];

    var hotelLocations;
    var markerHotel = [];

    var activityLocations;
    var markerActivity = [];

    var lat_primary, log_primary;
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
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(restaurantLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var name = restaurantLocations.name;
        if(name.length > 37) {
            name = restaurantLocations.name.substring(0, 37)+'...';
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

        let favorite = '';
        // check if favorit is true
        if (restaurantLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${restaurantLocations.id_restaurant}, 'restaurant')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-22 unlikeButtonrestaurant${restaurantLocations.id_restaurant}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        } else {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${restaurantLocations.id_restaurant}, 'restaurant')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-22 likeButtonrestaurant${restaurantLocations.id_restaurant}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        let indicator = `{
            target_type: 'restaurant',
            id: ${restaurantLocations.id_restaurant}
        }`;

        var customContent = `
                            <div class="col-12 mobile-map-desc-container" style="position: relative;">
                                <div class="modal-map-image-container">
                                    @guest
                                        <div
                                            style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                                            <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                                                onclick="loginForm(1)">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                    focusable="false" class="favorite-button favorite-button-22">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endguest
                                    @auth
                                        ${favorite}
                                    @endauth
                                    <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 260px; width: 100%; position: absolute; border-radius: 15px; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 50px" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                    </div>
                                    <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                    data-arrows="true">
                                        ${image}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank">
                                        <p class="card-text text-20 text-orange fw-600 mt-1">${name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${cuisine}</p>
                                        <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-grey-1 mt-1 text-13"><i class="fa-solid text-orange fa-location-dot"></i> <span class="text-grey-1"><span class="text-grey-1" id="travelDistance"></span> from this activity</span></p>
                                    </a>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-6 d-flex align-items-center">
                                        <p class="text-grey-1 mt-1 mb-0 text-13"><i class="fa-solid text-orange fa-car"></i> <span class="text-grey-1" id="travelTimecar"></span> | <i class="fa-solid text-orange fa-person-walking"></i> <span class="text-grey-1" id="travelTime"></span></p>
                                    </div>
                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
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
                url:`{{ asset('assets/icon/map/restaurant.png') }}`,
                scaledSize : new google.maps.Size(20, 20)
            });

            // show & highlight restaurant when click
            google.maps.event.addListener(markerRestaurant[i], 'click', (function (marker, i) {
                return function () {

                    var directionsDisplay = new google.maps.DirectionsRenderer();
                    var directionsService = new google.maps.DirectionsService();

                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset restaurant markers
                    resetRestaurantMarker();

                    // reset primary marker
                    // resetPrimaryMarker();
                    // reset secondary marker
                    resetSecondaryMarker();
                    // set secondary marker
                    setSecondaryMarker(restaurantLocations[i], 'restaurant');

                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                    calculateAndDisplayRoute2(directionsService, directionsDisplay);

                    // show content when on screen mobile size
                    if(mapMobileIsOpen){
                        if ($(window).width() < 768) {
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            // mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    } else {
                        if ($(window).width() < 768) {
                            // full screen map for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 10px; position: relative; overflow: hidden;');
                            document.getElementById("bottom-mobile").classList.add('d-none');
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("mobile-map-close").classList.remove('d-none');
                            document.getElementById("mobile-map-close").classList.add('d-block');
                            mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    }

                    // show right content
                    setTimeout(() => {
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();

                        // disabled action google map
                        resetMapAction();
                        // activate scroll action
                        map.setOptions({zoomControl: true});
                        // hide primary control
                        hidePrimaryMarkerControlFromMap();
                    }, 200);
                };
            })(markerRestaurant[i], i));
        }
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
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(villaLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var name = villaLocations.name;
        if(name.length > 37) {
            name = villaLocations.name.substring(0, 37)+'...';
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
        if(villaLocations.price_with_exchange_unit) {
            price = villaLocations.price_with_exchange_unit;
        }

        let favorite = '';
        // check if favorit is true
        if (villaLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${villaLocations.id_villa}, 'villa')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-22 unlikeButtonvilla${villaLocations.id_villa}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        } else {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${villaLocations.id_villa}, 'villa')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-22 likeButtonvilla${villaLocations.id_villa}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        let indicator = `{
            target_type: 'villa',
            id: ${villaLocations.id_villa}
        }`;

        var customContent = `
                            <div class="col-12 mobile-map-desc-container" style="position: relative;">
                                <div class="modal-map-image-container">
                                    @guest
                                        <div
                                            style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                                            <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                                                onclick="loginForm(1)">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                    focusable="false" class="favorite-button favorite-button-22">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endguest
                                    @auth
                                        ${favorite}
                                    @endauth
                                    <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 260px; width: 100%; position: absolute; border-radius: 15px; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 50px" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                    </div>
                                    <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                    data-arrows="true">
                                        ${image}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaLocations.adult ?? 0} Guest • ${villaLocations.bedroom ?? 0} Bedroom • ${villaLocations.bathroom ?? 0} Bath • ${villaLocations.parking ?? 0} Parking • ${villaLocations.size ?? 0}m² living</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-orange text-17 fw-500 mt-1">${price}</p>
                                        <p class="card-text text-grey-1 mt-1 text-13"><i class="fa-solid text-orange fa-location-dot"></i> <span class="text-grey-1"><span class="text-grey-1" id="travelDistance"></span> from this activity</span></p>
                                        <p class="text-grey-1 mt-1 text-13"><i class="fa-solid text-orange fa-car"></i> <span class="text-grey-1" id="travelTimecar"></span> | <i class="fa-solid text-orange fa-person-walking"></i> <span class="text-grey-1" id="travelTime"></span></p>
                                    </a>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-6">
                                        <p class="card-text text-orange text-17 fw-500 mt-1">${price}</p>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
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
                    var directionsDisplay = new google.maps.DirectionsRenderer();
                    var directionsService = new google.maps.DirectionsService();

                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset villa markers
                    resetVillaMarker();

                    // reset primary marker
                    // resetPrimaryMarker();
                    // reset secondary marker
                    resetSecondaryMarker();
                    // set secondary marker
                    setSecondaryMarker(villaLocations[i], 'villa');

                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                    calculateAndDisplayRoute2(directionsService, directionsDisplay);

                    // show content when on screen mobile size
                    if(mapMobileIsOpen){
                        if ($(window).width() < 768) {
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            // mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    } else {
                        if ($(window).width() < 768) {
                            // full screen map for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 10px; position: relative; overflow: hidden;');
                            document.getElementById("bottom-mobile").classList.add('d-none');
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("mobile-map-close").classList.remove('d-none');
                            document.getElementById("mobile-map-close").classList.add('d-block');
                            mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    }

                    // show right content
                    setTimeout(() => {
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();

                        // disabled action google map
                        resetMapAction();
                        // activate scroll action
                        map.setOptions({zoomControl: true});
                        // hide primary control
                        hidePrimaryMarkerControlFromMap();
                    }, 200);
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
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.uid.toLowerCase()}/${hotelLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(hotelLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.uid.toLowerCase()}/${hotelLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var name = hotelLocations.name;
        if(name.length > 37) {
            name = hotelLocations.name.substring(0, 37)+'...';
        }

        let favorite = '';
        // check if favorit is true
        if (hotelLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${hotelLocations.id_hotel}, 'hotel')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-22 unlikeButtonhotel${hotelLocations.id_hotel}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        } else {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${hotelLocations.id_hotel}, 'hotel')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-22 likeButtonhotel${hotelLocations.id_hotel}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        let indicator = `{
            target_type: 'hotel',
            id: ${hotelLocations.id_hotel}
        }`;

        var customContent = `
                            <div class="col-12 mobile-map-desc-container" style="position: relative;">
                                <div class="modal-map-image-container">
                                    @guest
                                        <div
                                            style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                                            <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                                                onclick="loginForm(1)">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                    focusable="false" class="favorite-button favorite-button-22">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endguest
                                    @auth
                                        ${favorite}
                                    @endauth
                                    <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 260px; width: 100%; position: absolute; border-radius: 15px; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 50px" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                    </div>
                                    <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                    data-arrows="true">
                                        ${image}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${name}</p>
                                        <p class="card-text text-grey-1 mt-1 text-13"><i class="fa-solid text-orange fa-location-dot"></i> <span class="text-grey-1"><span class="text-grey-1" id="travelDistance"></span> from this activity</span></p>
                                    </a>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-6">
                                        <p class="text-grey-1 mt-1 mb-0 text-13"><i class="fa-solid text-orange fa-car"></i> <span class="text-grey-1" id="travelTimecar"></span> | <i class="fa-solid text-orange fa-person-walking"></i> <span class="text-grey-1" id="travelTime"></span> </p>
                                    </div>
                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
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
                    var directionsDisplay = new google.maps.DirectionsRenderer();
                    var directionsService = new google.maps.DirectionsService();

                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset hotel markers
                    resetHotelMarker();

                    // reset primary marker
                    // resetPrimaryMarker();
                    // reset secondary marker
                    resetSecondaryMarker();
                    // set secondary marker
                    setSecondaryMarker(hotelLocations[i], 'hotel');

                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                    calculateAndDisplayRoute2(directionsService, directionsDisplay);

                    // show content when on screen mobile size
                    if(mapMobileIsOpen){
                        if ($(window).width() < 768) {
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            // mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    } else {
                        if ($(window).width() < 768) {
                            // full screen map for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 10px; position: relative; overflow: hidden;');
                            document.getElementById("bottom-mobile").classList.add('d-none');
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("mobile-map-close").classList.remove('d-none');
                            document.getElementById("mobile-map-close").classList.add('d-block');
                            mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    }

                    // show right content
                    setTimeout(() => {
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();

                        // disabled action google map
                        resetMapAction();
                        // activate scroll action
                        map.setOptions({zoomControl: true});
                        // hide primary control
                        hidePrimaryMarkerControlFromMap();
                    }, 200);
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
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(activityLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 260px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var name = activityLocations.name;
        if(name.length > 37) {
            name = activityLocations.name.substring(0, 37)+'...';
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

        let favorite = '';
        // check if favorit is true
        if (activityLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${activityLocations.id_activity}, 'activity')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-22 unlikeButtonactivity${activityLocations.id_activity}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        } else {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${activityLocations.id_activity}, 'activity')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-22 likeButtonactivity${activityLocations.id_activity}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        let indicator = `{
            target_type: 'activity',
            id: ${activityLocations.id_activity}
        }`;

        var customContent = `
                            <div class="col-12 mobile-map-desc-container" style="position: relative;">
                                <div class="modal-map-image-container">
                                    @guest
                                        <div
                                            style="position: absolute; right: 10px; top: 10px; z-index: 43; display: flex; font-size: 24px; border-radius: 9px;">
                                            <a style="position: absolute; z-index: 43; top: 10px; right: 10px; cursor: pointer;"
                                                onclick="loginForm(1)">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                    focusable="false" class="favorite-button favorite-button-22">
                                                    <path
                                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endguest
                                    @auth
                                        ${favorite}
                                    @endauth
                                    <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 260px; width: 100%; position: absolute; border-radius: 15px; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 50px" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                    </div>
                                    <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                    data-arrows="true">
                                        ${image}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${facilities}</p>
                                        <p class="card-text text-grey-2 text-12 fw-500 text-align-justify mt-1">${short_description}</p>
                                        <p class="card-text text-grey-1 mt-1 text-13"><i class="fa-solid text-orange fa-location-dot"></i> <span class="text-grey-1"><span class="text-grey-1" id="travelDistance"></span> from this activity</span></p>
                                    </a>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-6 d-flex align-items-center">
                                        <p class="text-grey-1 mt-1 mb-0 text-13"><i class="fa-solid text-orange fa-car"></i> <span class="text-grey-1" id="travelTimecar"></span> | <i class="fa-solid text-orange fa-person-walking"></i> <span class="text-grey-1" id="travelTime"></span> </p>
                                    </div>
                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_on_all_marker(${indicator})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
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
                url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });

            // show & highlight activity when click
            google.maps.event.addListener(markerActivity[i], 'click', (function (marker, i) {
                return function () {
                    var directionsDisplay = new google.maps.DirectionsRenderer();
                    var directionsService = new google.maps.DirectionsService();
                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset activity markers
                    resetActivityMarker();
                    // add viewed marker activity
                    addViewedMarker(activityLocations[i].id_activity);
                    // marked viewed marker activity
                    markedViewedMarker();

                    // reset secondary marker
                    resetSecondaryMarker();
                    // reset primary marker
                    resetPrimaryMarker();
                    // set primary marker
                    setPrimaryMarker(activityLocations[i]);
                    // setSecondaryMarker(activityLocations[i], 'activity');

                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                    calculateAndDisplayRoute2(directionsService, directionsDisplay);

                    // show content when on screen mobile size
                    if(mapMobileIsOpen){
                        if ($(window).width() < 768) {
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            // mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    } else {
                        if ($(window).width() < 768) {
                            // full screen map for mobile
                            document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                            document.getElementById("map-desc").classList.add('mobile-map');
                            $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 10px; position: relative; overflow: hidden;');
                            document.getElementById("bottom-mobile").classList.add('d-none');
                            // show right content on the map
                            $('#modal-map-content').removeClass('d-none');
                            $('#modal-map-content').addClass('d-block mobile-map-desc');
                            // show button close full screen for mobile
                            document.getElementById("mobile-map-close").classList.remove('d-none');
                            document.getElementById("mobile-map-close").classList.add('d-block');
                            mapMobileIsOpen = true;
                            contentIsExist = true;
                        }
                    }

                    // show right content
                    setTimeout(() => {
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();

                        // disabled action google map
                        resetMapAction();
                        // activate scroll action
                        map.setOptions({zoomControl: true});
                        // hide primary control
                        hidePrimaryMarkerControlFromMap();
                    }, 200);
                };
            })(markerActivity[i], i));
        }
    }

    // function to clear & hide right content
    function resetRightContent() {
        // $('#modal-map-content').html('');
        // show right content on the map
        $('#modal-map-content').addClass('d-none');
        $('#map-desc').removeClass('mobile-map-close');
        $('#map-desc').removeClass('mobile-map');
        $('#map-desc').addClass('mobile-map-desc-close');
        $('#modal-map-content').removeClass('d-block mobile-map-desc');
        contentIsExist = true;
    }

    // function to refetch data marker
    async function refetchMarkers() {
        console.log('hit refetchMarkers', map.getBounds().getSouthWest());
        console.log(map.getZoom(), map.getCenter());

        // reset all marker
        resetAllMarkers();
        // prepare data coordinate
        var data = {
            latitude_h: map.getBounds().getSouthWest().lat(),
            longitude_h: map.getBounds().getSouthWest().lng(),
            latitude_j: map.getBounds().getNorthEast().lat(),
            longitude_j: map.getBounds().getNorthEast().lng(),
        };
        // refetch data for markers
        await fetchRestaurantsLocation(data);
        await fetchVillasLocation(data);
        await fetchHotelsLocation(data);
        await fetchActivitysLocation(data);
    }


    function reverseMap(){
        document.getElementById("map-desc").classList.remove('mobile-map');
        document.getElementById("map-mobile-overlay").classList.remove('map-mobile-overlay');
        document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
        $('#modal-map-content').removeClass('d-block mobile-map-desc');
        document.getElementById("mobile-map-close").classList.remove('d-block');
        document.getElementById("mobile-map-close").classList.add('d-none');
        document.getElementById("bottom-mobile").classList.remove('d-none');
        $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 12px; position: relative; overflow: hidden;');
        google.maps.event.clearListeners(map, 'click');

    }

    function mapMobile(){
         //mobile map
         map.addListener("click", ()=>{
            console.log('hit mapMobile');
            if(contentIsExist && mapMobileIsOpen){
                console.log('ketika full screen dan content masih terbuka');
                resetRightContent();
                resetPrimaryMarker();
                resetSecondaryMarker();
            }
            if(!contentIsExist && !mapMobileIsOpen) {
                console.log('ketika tidak full  screen dan content tidak terbuka');
                contentIsExist = true;
                mapMobileIsOpen = true;
                // enable loading
                setMapLoading();
                // disable action google map
                resetMapAction();
                // disable event google map
                resetMapEvent();
                // full screen map for mobile
                document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
                document.getElementById("map-mobile-overlay").classList.add('map-mobile-overlay');
                document.getElementById("map-desc").classList.add('mobile-map');
                $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 10px; position: relative; overflow: hidden;');
                document.getElementById("bottom-mobile").classList.add('d-none');

                // reset right content
                $('#modal-map-content').html('');

                setTimeout(async () => {
                    // show right content on the map
                    $('#modal-map-content').removeClass('d-none');
                    $('#modal-map-content').addClass('d-block mobile-map-desc');
                    // show button close full screen for mobile
                    document.getElementById("mobile-map-close").classList.remove('d-none');
                    document.getElementById("mobile-map-close").classList.add('d-block');
                    // refetch target activity
                    await view_maps('{{ $activity->id_activity }}');
                }, 200);

                // disabled action google map
                resetMapAction();
                // activate scroll action
                map.setOptions({zoomControl: true});
                // hide primary control
                hidePrimaryMarkerControlFromMap();
            }
            console.log('contentIsExist: '+contentIsExist);
            console.log('mapMobileIsOpen: '+mapMobileIsOpen);
        });
    }

    function close_map_mobile() {
        mapMobileIsOpen = false;
        contentIsExist = false;
        document.getElementById("map-desc").classList.remove('mobile-map');
        document.getElementById("map-desc").classList.remove('mobile-map-desc-close');
        document.getElementById("mobile-map-close").classList.remove('d-block');
        document.getElementById("mobile-map-close").classList.add('d-none');
        document.getElementById("modal-map-content").classList.remove('d-block');
        document.getElementById("modal-map-content").classList.add('d-none');
        document.getElementById("modal-map-content").classList.remove('mobile-map-desc');
        document.getElementById("bottom-mobile").classList.remove('d-none');
        document.getElementById("map-mobile-overlay").classList.remove('map-mobile-overlay');
        $('#map12').attr('style', 'width: 100%; height: 100%; border-radius: 12px; position: relative; overflow: hidden;');
    }

    // function to set map event
    function setMapEvent() {
        // refetch markers when idle
        google.maps.event.addListener(map, "idle", async function() {
            console.log('idle trigger');
            // enable loading
            setMapLoading();
            // disable action google map
            resetMapAction();
            // disable event google map
            resetMapEvent();

            // refetch data
            await refetchMarkers();

            // enable event google map
            setMapEvent();
            // enable action google map
            setMapAction();
            // disable loading
            resetMapLoading();

            // disabled action google map
            resetMapAction();
            // activate scroll action
            map.setOptions({zoomControl: true});
            // hide primary control
            hidePrimaryMarkerControlFromMap();
        });
    }
    // function to reset map event
    function resetMapEvent() {
        google.maps.event.clearListeners(map, 'idle');
    }

    // function to set map action
    function setMapAction() {
        console.log('set map action');
        map.setOptions({draggable: true, zoomControl: true});
    }
    // function to reset map action
    function resetMapAction() {
        console.log('reset map action');
        map.setOptions({draggable: false, zoomControl: false});
    }

    // function to set map loading
    function setMapLoading() {
        // show loading
        $('#location-map-loading').addClass('d-block');
        $('#location-map-loading').removeClass('d-none');
        // hide recenter button
        hidePrimaryMarkerControlFromMap();
        // disabled prev next button
        disabledPrevNextButton();
    }
    // function to reset map loading
    function resetMapLoading() {
        // hide loading
        $('#location-map-loading').removeClass('d-block');
        $('#location-map-loading').addClass('d-none');
        showPrimaryMarkerControlFromMap();
        // disabled prev next button
        enabledPrevNextButton();
        // check if primary marker is active
        if(primaryMarker) {
            // hide recenter button
            showPrimaryMarkerControlFromMap();
        }
    }

    // function to set primary marker
    function setPrimaryMarker(data) {
        primaryMarker = new google.maps.Marker({
            position: new google.maps.LatLng(data.latitude, data.longitude),
            map: map,
            icon: {
                url:`{{ asset('assets/icon/map/activity_active.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            },
            zIndex: 9999999
        });
        primaryContent = addCustomContentActivity(data);
        $('#modal-map-content').html('');
        $('#modal-map-content').append(primaryContent);
        // show primary marker
        showPrimaryMarkerControlFromMap();
    }
    // function to reset primary marker
    function resetPrimaryMarker() {
        if(primaryMarker) {
            primaryMarker.setMap(null);
            primaryMarker = null;
            // hide primary marker control from map
            hidePrimaryMarkerControlFromMap();
        }
        if(primaryContent) {
            primaryContent = null;
        }
    }
    // function to hide primary marker control from map
    function hidePrimaryMarkerControlFromMap() {
        $('#location-map-recenter').addClass('d-none');
        $('#location-map-recenter').removeClass('d-block');
    }
    // function to show primary marker control from map
    function showPrimaryMarkerControlFromMap() {
        // $('#location-map-recenter').addClass('d-block');
        $('#location-map-recenter').removeClass('d-none');
        $('#location-map-recenter').addClass('d-none');
    }

    // function to set secondary marker
    function setSecondaryMarker(data, markerType) {
        var markerIcon = null;
        if(markerType == 'villa') {
            markerIcon = `{{ asset('assets/icon/map/villa.png') }}`;
            secondaryContent = addCustomContentVilla(data);
        } else if (markerType == 'restaurant') {
            markerIcon = `{{ asset('assets/icon/map/restaurant.png') }}`;
            secondaryContent = addCustomContentRestaurant(data);
        } else if (markerType == 'hotel') {
            markerIcon = `{{ asset('assets/icon/map/hotel.png') }}`;
            secondaryContent = addCustomContentHotel(data);
        } else if (markerType == 'activity') {
            markerIcon = `{{ asset('assets/icon/map/activity.png') }}`;
            secondaryContent = addCustomContentActivity(data);
        } else {
            markerIcon = null;
            secondaryContent = null;
        }

        if(markerIcon != null && secondaryContent != null) {
            secondaryMarker = new google.maps.Marker({
                position: new google.maps.LatLng(data.latitude, data.longitude),
                map: map,
                icon: {
                    url: markerIcon,
                    scaledSize : new google.maps.Size(30, 30)
                },
                zIndex: 9999999
            });
            $('#modal-map-content').html('');
            $('#modal-map-content').append(secondaryContent);
        } else {
            console.log('data not found');
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
                    url:`{{ asset('assets/icon/map/restaurant.png') }}`,
                    scaledSize : new google.maps.Size(20, 20)
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
                    url:`{{ asset('assets/icon/map/activity_unclicked.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
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
    // function to reset all markers
    function resetAllMarkers() {
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
    }

    // function to add viewed marker activity
    function addViewedMarker(id_activity) {
        if(viewedMarkers.length > 0) {
            var checkViewedMarkerIdExist = false;
            viewedMarkers.forEach(viewedMarkerId => {
                if(viewedMarkerId == id_activity) {
                    checkViewedMarkerIdExist = true;
                }
            });

            if(checkViewedMarkerIdExist != true) {
                viewedMarkers.push(id_activity);
                console.log('marker doesnt exist', viewedMarkers);
            }
        } else {
            viewedMarkers.push(id_activity);
            console.log('array empty', viewedMarkers);
        }
    }
    // function to marked viewed marker activity
    function markedViewedMarker() {
        if(activityLocations.length > 0) {
            if(viewedMarkers.length > 0) {
                if(markerActivity.length > 0) {
                    viewedMarkers.forEach(id_activity => {
                        for (let j = 0; j < activityLocations.length; j++) {
                            if(activityLocations[j].id_activity && activityLocations[j].id_activity == id_activity) {
                                markerActivity[j].setIcon({
                                    url:`{{ asset('assets/icon/map/activity_clicked.png') }}`,
                                    scaledSize : new google.maps.Size(30, 30)
                                });
                            } else {
                                // console.log('error on markedViewedMarker');
                            }
                        }
                    });
                } else {
                    // console.log('there is no viewed marker yet');
                }
            }
        }
    }

    // function to run slider js
    function runSlickSlider() {
        // run slick slider
        $('.js-slider-test').not('.slick-initialized').slick();
        // disable image loading
        setTimeout(() => {
            // check if right content loading image has class d-none
            if(!$('#location-map-content-right-image-loading').hasClass('d-none')){
                $('#location-map-content-right-image-loading').removeClass('d-block');
                $('#location-map-content-right-image-loading').addClass('d-none');
            }
            // check if infowindow loading image has class d-none
            if(!$('#location-map-content-info-image-loading').hasClass('d-none')){
                $('#location-map-content-info-image-loading').removeClass('d-block');
                $('#location-map-content-info-image-loading').addClass('d-none');
            }
        }, 500);
        $('.js-slider .slick-next').css('display', 'none');
        $('.js-slider .slick-prev').css('display', 'none');
        $('.js-slider').mouseenter(function(e) {
            $(this).children('.slick-prev').css('display', 'block');
            $(this).children('.slick-next').css('display', 'block');
        })
        $('.js-slider').mouseleave(function(e) {
            $(this).children('.slick-prev').css('display', 'none');
            $(this).children('.slick-next').css('display', 'none');
        })
    }
    // next on all marker
    function next_on_all_marker(indicator) {
        console.log('target type: '+indicator.target_type);
        console.log('id: '+indicator.id);
        // initialization all data marker/location into an array
        var allLocation = [];
        if(villaLocations.length > 0 && villaLocations){
            for (let i = 0; i < villaLocations.length; i++) {
                const dataLocations = {
                    target_type: 'villa',
                    id: villaLocations[i].id_villa
                };
                allLocation.push(dataLocations);
            }
        }
        if(restaurantLocations.length > 0 && restaurantLocations){
            for (let i = 0; i < restaurantLocations.length; i++) {
                const dataLocations = {
                    target_type: 'restaurant',
                    id: restaurantLocations[i].id_restaurant
                };
                allLocation.push(dataLocations);
            }
        }
        if(hotelLocations.length > 0 && hotelLocations){
            for (let i = 0; i < hotelLocations.length; i++) {
                const dataLocations = {
                    target_type: 'hotel',
                    id: hotelLocations[i].id_hotel
                };
                allLocation.push(dataLocations);
            }
        }
        if(activityLocations.length > 0 && activityLocations){
            for (let i = 0; i < activityLocations.length; i++) {
                const dataLocations = {
                    target_type: 'activity',
                    id: activityLocations[i].id_activity
                };
                allLocation.push(dataLocations);
            }
        }
        console.log(allLocation);

        let isFound = false;
        let index;
        let nextMarker;
        for (let i = 0; i < allLocation.length; i++) {
            const hasBeenFound = allLocation[i].id == indicator.id && allLocation[i].target_type == indicator.target_type;
            if(hasBeenFound){
                isFound = true;
                index = i;
                break;
            }
        }
        console.log('next marker: '+isFound);

        if (index != null) {
            if(index == (allLocation.length-1)) {
                nextMarker = allLocation[0];
            } else {
                nextMarker = allLocation[index+1];
            }
        } else {
            console.log('index not found');
        }
        console.log('next marker: '+nextMarker);
        if(nextMarker){
            console.log('next marker type: '+nextMarker.target_type);
            console.log('next marker id: '+nextMarker.id);
        }

        if(isFound && nextMarker){
            if(nextMarker.target_type == 'villa') {
                if(villaLocations.length > 0 && villaLocations){
                    // find index on the list
                    for (let i = 0; i < villaLocations.length; i++) {
                        const data = villaLocations[i];
                        if(data.id_villa == nextMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerVilla[i], 'click');
                            break;
                        }
                    }
                }
            } else if( nextMarker.target_type == 'restaurant'){
                if(restaurantLocations.length > 0 && restaurantLocations){
                    // find index on the list
                    for (let i = 0; i < restaurantLocations.length; i++) {
                        const data = restaurantLocations[i];
                        if(data.id_restaurant == nextMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerRestaurant[i], 'click');
                            break;
                        }
                    }

                }
            } else if( nextMarker.target_type == 'hotel'){
                if(hotelLocations.length > 0 && hotelLocations){
                    // find index on the list
                    for (let i = 0; i < hotelLocations.length; i++) {
                        const data = hotelLocations[i];
                        if(data.id_hotel == nextMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerHotel[i], 'click');
                            break;
                        }
                    }

                }
            } else if( nextMarker.target_type == 'activity'){
                if(activityLocations.length > 0 && activityLocations){
                    // find index on the list
                    for (let i = 0; i < activityLocations.length; i++) {
                        const data = activityLocations[i];
                        if(data.id_activity == nextMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerActivity[i], 'click');
                            break;
                        }
                    }
                }
            };
        } else {
            console.log('next data not found');
            iziToast.error({
                title: "Error",
                message: 'your data is not on the list yet',
                position: "topRight",
            });
        }
    }
    function prev_on_all_marker(indicator) {
        console.log('target type: '+indicator.target_type);
        console.log('id: '+indicator.id);
        // initialization all data marker/location into an array
        var allLocation = [];
        if(villaLocations.length > 0 && villaLocations){
            for (let i = 0; i < villaLocations.length; i++) {
                const dataLocations = {
                    target_type: 'villa',
                    id: villaLocations[i].id_villa
                };
                allLocation.push(dataLocations);
            }
        }
        if(restaurantLocations.length > 0 && restaurantLocations){
            for (let i = 0; i < restaurantLocations.length; i++) {
                const dataLocations = {
                    target_type: 'restaurant',
                    id: restaurantLocations[i].id_restaurant
                };
                allLocation.push(dataLocations);
            }
        }
        if(hotelLocations.length > 0 && hotelLocations){
            for (let i = 0; i < hotelLocations.length; i++) {
                const dataLocations = {
                    target_type: 'hotel',
                    id: hotelLocations[i].id_hotel
                };
                allLocation.push(dataLocations);
            }
        }
        if(activityLocations.length > 0 && activityLocations){
            for (let i = 0; i < activityLocations.length; i++) {
                const dataLocations = {
                    target_type: 'activity',
                    id: activityLocations[i].id_activity
                };
                allLocation.push(dataLocations);
            }
        }
        console.log(allLocation);

        let isFound = false;
        let index;
        let prevMarker;
        for (let i = 0; i < allLocation.length; i++) {
            const hasBeenFound = allLocation[i].id == indicator.id && allLocation[i].target_type == indicator.target_type;
            if(hasBeenFound){
                isFound = true;
                index = i;
                break;
            }
        }
        console.log('prev marker: '+isFound);

        if (index != null) {
            if(index == 0) {
                prevMarker = allLocation[allLocation.length-1];
            } else {
                prevMarker = allLocation[index-1];
            }
        } else {
            console.log('index not found');
        }
        console.log('prev marker: '+prevMarker);
        if(prevMarker){
            console.log('prev marker type: '+prevMarker.target_type);
            console.log('prev marker id: '+prevMarker.id);
        }

        if(isFound && prevMarker){
            if(prevMarker.target_type == 'villa') {
                if(villaLocations.length > 0 && villaLocations){
                    // find index on the list
                    for (let i = 0; i < villaLocations.length; i++) {
                        const data = villaLocations[i];
                        if(data.id_villa == prevMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerVilla[i], 'click');
                            break;
                        }
                    }
                }
            } else if( prevMarker.target_type == 'restaurant'){
                if(restaurantLocations.length > 0 && restaurantLocations){
                    // find index on the list
                    for (let i = 0; i < restaurantLocations.length; i++) {
                        const data = restaurantLocations[i];
                        if(data.id_restaurant == prevMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerRestaurant[i], 'click');
                            break;
                        }
                    }

                }
            } else if( prevMarker.target_type == 'hotel'){
                if(hotelLocations.length > 0 && hotelLocations){
                    // find index on the list
                    for (let i = 0; i < hotelLocations.length; i++) {
                        const data = hotelLocations[i];
                        if(data.id_hotel == prevMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerHotel[i], 'click');
                            break;
                        }
                    }

                }
            } else if( prevMarker.target_type == 'activity'){
                if(activityLocations.length > 0 && activityLocations){
                    // find index on the list
                    for (let i = 0; i < activityLocations.length; i++) {
                        const data = activityLocations[i];
                        if(data.id_activity == prevMarker.id) {
                            // activate the marker
                            google.maps.event.trigger(markerActivity[i], 'click');
                            break;
                        }
                    }
                }
            };
        } else {
            console.log('prev data not found');
            iziToast.error({
                title: "Error",
                message: 'your data is not on the list yet',
                position: "topRight",
            });
        }
    }
    // function to disabled prev next button on right content
    function disabledPrevNextButton() {
        if($('#modal-map-right-prev' == 0)){
            $('#modal-map-right-prev').prop('disabled', true);
        }
        if($('#modal-map-right-next' == 0)){
            $('#modal-map-right-next').prop('disabled', true);
        }
    }
    // function to enabled prev next button on right content
    function enabledPrevNextButton() {
        if($('#modal-map-right-prev' == 0)){
            $('#modal-map-right-prev').prop('disabled', false);
        }
        if($('#modal-map-right-next' == 0)){
            $('#modal-map-right-next').prop('disabled', false);
        }
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
        // marked viewed marker activity
        markedViewedMarker();
        console.log('fetch activity done');
    }
</script>
{{-- main function --}}
<script>
    // init map
    function init_map(){
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();
        // declare map
        mapOptions = {
            zoom: 9,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT,
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

        // inject html into map for recenter button
        var reCenter = document.createElement("div");
        reCenter.setAttribute("style",
            "background: white; width: 40px; height: 40px; margin: 10px;"
        );
        var markerIcon = document.createElement("img");
        markerIcon.setAttribute("src", "{{ asset('assets/icon/map/activity_active.png') }}");
        markerIcon.setAttribute("style", "width: 100%; height: 100%; padding: 4px; box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px -1px;");
        reCenter.appendChild(markerIcon);
        reCenter.setAttribute("id", "location-map-recenter");
        reCenter.setAttribute("class", "d-none");
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(reCenter);
        reCenter.addEventListener('click', ()=>{
            view_maps('{{ $activity->id_activity }}');
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
        // enable loading
        setMapLoading();
        // disable action google map
        resetMapAction();
        // disable event google map
        resetMapEvent();

        // find activity
        fetch(`/map/by-coordinate-area/activity/${id}`)
            .then(response => response.json())
            .then(async (data)=>{
                // set map
                map.setZoom(13);
                map.setCenter(new google.maps.LatLng(data.latitude, data.longitude));

                lat_primary = data.latitude;
                log_primary = data.longitude;

                // reset secondary marker
                resetSecondaryMarker();
                // reset primary marker
                resetPrimaryMarker();
                // set primary marker
                setPrimaryMarker(data);

                // show right content
                setTimeout(async () => {
                    // load slick slider
                    runSlickSlider();
                    // refetch data
                    await refetchMarkers();
                    // add viewed marker activity
                    addViewedMarker(data.id_activity);
                    // marked viewed marker activity
                    markedViewedMarker();
                    // enable event google map
                    setMapEvent();
                    // enable action google map
                    setMapAction();
                    // disable loading
                    resetMapLoading();

                    // disabled action google map
                    resetMapAction();
                    // activate scroll action
                    map.setOptions({zoomControl: true});
                    // hide primary control
                    hidePrimaryMarkerControlFromMap();
                }, 200);
            });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        // var selectedMode = "WALKING";
        // directionsService.route({
        //   origin: {lat: lat_primary, lng: log_primary},
        //   destination: secondaryMarker.getPosition(),
        //   travelMode: google.maps.TravelMode[selectedMode]
        // }, function(response, status) {
        //   if (status == 'OK') {
        //     directionsDisplay.setDirections(response);
        //     travelTime = response.routes[0].legs[0].duration.text; // contains correct value
        //     distance = response.routes[0].legs[0].distance.text; // contains correct value
        //     $('#travelTime').html(travelTime);
        //     $('#travelDistance').html(distance);
        //   } else {
        //     window.alert('Directions request failed due to ' + status);
        //   }
        // });
    }

    function calculateAndDisplayRoute2(directionsService, directionsDisplay) {
        // var selectedMode = "DRIVING";
        // directionsService.route({
        //   origin: {lat: lat_primary, lng: log_primary},
        //   destination: secondaryMarker.getPosition(),
        //   travelMode: google.maps.TravelMode[selectedMode]
        // }, function(response, status) {
        //   if (status == 'OK') {
        //     directionsDisplay.setDirections(response);
        //     travelTime = response.routes[0].legs[0].duration.text; // contains correct value
        //     // distance = response.routes[0].legs[0].distance.text; // contains correct value
        //     $('#travelTimecar').html(travelTime);
        //   } else {
        //     window.alert('Directions request failed due to ' + status);
        //   }
        // });
    }
</script>
<script>
    // run init map
    $(window).on('load', () => {
        init_map();
        setTimeout(() => {
            view_maps('{{ $activity->id_activity }}');
        }, 200);

        $(document).ready(() => {
            if ($(window).width() < 768) {
                contentIsExist = false;
                mapMobileIsOpen = false;
                mapMobile();
                console.log('contentIsExist: '+contentIsExist);
                console.log('mapMobileIsOpen: '+mapMobileIsOpen);
            }
            if ($(window).width() >= 768) {
                reverseMap();
                console.log('contentIsExist: '+contentIsExist);
                console.log('mapMobileIsOpen: '+mapMobileIsOpen);
            }
        });
    });
    $(window).on('resize', () => {
        if ($(window).width() < 768) {
            contentIsExist = false;
            mapMobileIsOpen = false;
            mapMobile();
            console.log('contentIsExist: '+contentIsExist);
            console.log('mapMobileIsOpen: '+mapMobileIsOpen);
        }
        if ($(window).width() >= 768) {
            reverseMap();
            console.log('contentIsExist: '+contentIsExist);
            console.log('mapMobileIsOpen: '+mapMobileIsOpen);
        }
    });
</script>

{{-- MAP CONTENT --}}
    {{-- <div style="border: 0.5px solid #bebebe; border-radius: 12px; box-shadow: 1px 1px 15px rgb(0 0 0 / 16%); height: 500px; ">
        <div style="width:100%;height:100%; border-radius: 12px;" id="map12"></div>
    </div>
    <div id="modal-map-content" class="overflow-hidden"></div> --}}
    <div id="map-mobile-overlay">
        <div id="map-desc" class="modal-map" style="border: 0.5px solid #bebebe; border-radius: 12px; box-shadow: 1px 1px 15px rgb(0 0 0 / 16%);">
            <div style="width:100%;height:100%; border-radius: 12px;" id="map12"></div>
            <div onclick="close_map_mobile()" id="mobile-map-close" class="d-none">
                <div class="close-button">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-map-content" class="overflow-hidden"></div>
{{-- END MAP CONTENT --}}
