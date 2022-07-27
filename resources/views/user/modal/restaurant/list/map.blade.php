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

    .bg-clicked {
        background: #d5d5d5;
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

    .icon-filter-map{
        width:28px;
        height:28px;
    }

    .icon-filter-map:hover{
        cursor:pointer;
    }

    .icon-filter-map img{
        width:auto;
        height:100%;
    }

    .limit-text{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        text-transform: uppercase;
    }

    .link-detail{
        display:flex;
        align-items:center;
    }

    .link-detail i{
        margin-left:4px;
        transition:all .5s;
    }

    .link-detail:hover i{
        margin-left:8px;
        transition:all .5s;
    }

    .modal-search {
        cursor: pointer;
        border: 2px solid #ff7400;
        padding: 9px;
        border-radius: 12px;
        margin-top: 0.9rem;
    }

    @media only screen and (max-width: 767px) {
        /* .modal-body .w-70 {
            width: 100% !important;
        }
        .modal-body .map-content {
            padding-left: 0px !important;
            position: absolute;
            width: 100% !important;
            left: 0;
            bottom: 0;
        }
        .modal-body .map-content #modal-map-right-content .card {
            padding: 0.5rem !important;
        } */
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        /* .modal-body .w-70 {
            width: 50% !important;
        }
        .modal-body .map-content {
            width: 50% !important;
        } */
    }
    @media only screen and (max-width: 991px) {
        /* .modal-body .map-content .modal-view-detail {
            margin-top: 1rem !important;
        }
        .modal-body .map-content .mt-3 a .card-text:nth-child(1) {
            font-size: 16px !important;
        }
        .modal-body .map-content .mt-3 a .card-text:nth-child(2) {
            min-height: 28px !important;
        } */
    }
    @media only screen and (min-width: 992px) and (max-width: 1099px) {
        /* .modal-body .w-70 {
            width: 60% !important;
        }
        .modal-body .map-content {
            width: 40% !important;
        } */
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
    var viewedMarkers = [];
    var primaryMarker;
    var primaryDetails;
    var primaryContent;

    var restaurantLocations;
    var markerRestaurant = [];
    var viewedMarkerRestaurant = [];

    var villaLocations;
    var markerVilla = [];
    var viewedMarkerVilla = [];

    var hotelLocations;
    var markerHotel = [];
    var viewedMarkerHotel = [];

    var activityLocations;
    var markerActivity = [];
    var viewedMarkerActivity = [];
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
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(restaurantLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations.uid.toLowerCase()}/${restaurantLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = restaurantLocations.short_description ?? 'there is no description yet';
        if(short_description.length > 230) {
            short_description = restaurantLocations.short_description.substring(0, 230)+'...';
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${restaurantLocations.id_restaurant}, 'restaurant')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-28 unlikeButtonrestaurant${restaurantLocations.id_restaurant}">
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${restaurantLocations.id_restaurant}, 'restaurant')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-28 likeButtonrestaurant${restaurantLocations.id_restaurant}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        var customContent = `
                            <div class="card col-12 d-flex h-100 justify-content-between">
                                <div>
                                    <div class="image-in-map-container">
                                        @guest
                                            <div
                                                style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                                                <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                                    onclick="loginForm(1)">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                        focusable="false" class="favorite-button favorite-button-28">
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
                                        <div class="like-sign like-sign-restaurant-${restaurantLocations.id_restaurant}">
                                            <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                                        </div>
                                        <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 270px; width: 100%; position: absolute; border-radius: 15px; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                            <img style="height: 12px;" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                        </div>
                                        <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                        data-arrows="true">
                                            ${image}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank">
                                            {{--<p class="card-text text-13 text-grey-1 fw-500">${review}</p>--}}
                                            <p class="card-text text-20 text-orange fw-600 mt-1">${restaurantLocations.name}</p>
                                            <p class="card-text text-13 text-grey-1 fw-500 mt-1">${cuisine}</p>
                                            <p class="card-text text-grey-2 limit-text text-14 fw-500 text-align-justify mt-1 limit-short-description">${short_description}</p>
                                        </a>
                                    </div>

                                    <div class="d-none d-md-flex mt-2" style="height: 70px; width: 100%; border-radius: 10px; overflow: hidden; position: relative;">
                                        <div style="position: absolute; height: 70px;" class="col-12 d-flex justify-content-center align-items-center">
                                                <p class="text-align-center mb-0">
                                                    <a href="https://www.apple.com/id/app-store/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-app-store">
                                                        <img style="width:30%;" src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                                    </a>

                                                    <a href="https://play.google.com/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-play-store">
                                                        <img style="width:37%;" src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                                    </a>
                                                </p>
                                        </div>
                                        <img style="object-fit: cover; width: 100%;" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end modal-view-detail">
                                    <div class="col-6">
                                        <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations.id_restaurant}" target="_blank" class="link-detail">
                                            <p class="card-text text-17 text-orange fw-600">View Detail</p>
                                            <i class=" text-orange fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_marker('restaurant', ${restaurantLocations.id_restaurant})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_marker('restaurant', ${restaurantLocations.id_restaurant})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </div>

                            </div>`;

        return customContent;
    }
    // function to declare marker restaurant & show it to map
    function declareMarkerRestaurant() {
        markerRestaurant = [];
        for (let i = 0; i < restaurantLocations.length; i++) {
            // declare primary marker
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
                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset restaurant markers
                    resetRestaurantMarker();

                    // reset primary marker
                    resetPrimaryMarker();
                    // set primary marker
                    setPrimaryMarker(restaurantLocations[i], 'restaurant');

                    // add viewed marker
                    addViewedMarkerNew(restaurantLocations[i].id_restaurant, 'restaurant');
                    // marked viewed marker
                    markedViewedMarkerNew();

                    // show right content
                    // $('#map12').addClass('w-70');
                    $('#map12').removeClass('w-100');
                    $('#map12').removeClass('h-mobile-100');
                    setTimeout(() => {
                        $('#modal-map-right').show();
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();
                    }, 200);
                };
            })(markerRestaurant[i], i));
        }

        const indicatorRestaurant = $('#map-filter-restaurant').data('indicator');
        if(!indicatorRestaurant){
            removeRestaurantMarkerFromMap();
        };
    }

    // function to add marker villa
    function addMarkerVilla(position, label) {
        const height = 12+12+11;
        const width = 12+12+(6.8*label.text.length);
        // console.log(position);
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.long),
            map: map,
            label: label,
            icon: {
                url: `{{ asset('assets/icon/map/transparent.png') }}`,
                scaledSize: new google.maps.Size(width, height),
            }
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
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(villaLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/gallery/${villaLocations.uid.toLowerCase()}/${villaLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
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

        // check if price exist
        let price = `there is no price yet`;
        if(villaLocations.price_with_exchange_unit) {
            price = villaLocations.price_with_exchange_unit;
        }

        let favorite = '';
        // check if favorit is true
        if (villaLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${villaLocations.id_villa}, 'villa')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-28 unlikeButtonvilla${villaLocations.id_villa}">
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${villaLocations.id_villa}, 'villa')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-28 likeButtonvilla${villaLocations.id_villa}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        var customContent = `
                            <div class="card col-12 d-flex h-100 justify-content-between">
                                <div>
                                    <div class="image-in-map-container">
                                        @guest
                                            <div
                                                style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                                                <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                                    onclick="loginForm(1)">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                        focusable="false" class="favorite-button favorite-button-28">
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
                                        <div class="like-sign like-sign-villa-${villaLocations.id_villa}">
                                            <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                                        </div>
                                        <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 270px; width: 100%; position: absolute; z-index: 99; display: flex; justify-content: center; align-items: center; border-radius: 15px;">
                                            <img style="height: 12px;" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                        </div>
                                        <div class="js-slider js-slider-border-none js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                        data-arrows="true">
                                            ${image}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank">
                                            <p class="card-text text-orange mb-0 text-20 fw-600 map-title-description">${villaLocations.name}</p>
                                            <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaLocations.adult ?? 0} Guest • ${villaLocations.bedroom ?? 0} Bedroom • ${villaLocations.bathroom ?? 0} Bath • ${villaLocations.parking ?? 0} Parking • ${villaLocations.size ?? 0}m² living</p>
                                            <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1 limit-short-description mb-2">${short_description}</p>
                                            <p class="card-text text-orange text-17 fw-500">${price}/Night</p>
                                        </a>
                                    </div>

                                    {{-- <div class="d-flex mt-1" style="height: 110px; width: 100%; border-radius: 12px; overflow: hidden;">
                                        <div style="position: absolute; height: 110px;" class="col-12 d-flex justify-content-center align-items-center">
                                                <p class="text-align-center mb-0">
                                                    <a href="https://www.apple.com/id/app-store/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-app-store">
                                                        <img style="width:30%;" src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                                    </a>

                                                    <a href="https://play.google.com/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-play-store">
                                                        <img style="width:37%;" src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                                    </a>
                                                </p>
                                        </div>
                                        <img style="object-fit: cover; width: 100%;" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                                    </div> --}}
                                </div>

                                <div class="d-flex align-items-end modal-view-detail">
                                    <div class="col-6">
                                        <a href="{{ env('APP_URL') }}/villa/${villaLocations.id_villa}" target="_blank" class="link-detail">
                                            <p class="card-text text-17 text-orange fw-600">View Detail</p>
                                            <i class=" text-orange fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-next" id="modal-map-right-prev" disabled="true" onclick="prev_marker('villa', ${villaLocations.id_villa})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-prev" id="modal-map-right-next" disabled="true" onclick="next_marker('villa', ${villaLocations.id_villa})"><i class="fa-solid fa-chevron-right"></i></button>
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
                text: villaLocations[i].price_with_exchange_unit,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });

            // show & highlight villa when click
            google.maps.event.addListener(markerVilla[i], 'click', (function (marker, i) {
                return function () {
                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset villa markers
                    resetVillaMarker();

                    // reset primary marker
                    resetPrimaryMarker();
                    // set primary marker
                    setPrimaryMarker(villaLocations[i], 'villa');

                    // add viewed marker
                    addViewedMarkerNew(villaLocations[i].id_villa, 'villa');
                    // marked viewed marker
                    markedViewedMarkerNew();

                    // show right content
                    // $('#map12').addClass('w-70');
                    $('#map12').removeClass('w-100');
                    $('#map12').removeClass('h-mobile-100');
                    setTimeout(() => {
                        $('#modal-map-right').show();
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();
                    }, 200);
                };
            })(markerVilla[i], i));
        }

        const indicatorVilla = $('#map-filter-villa').data('indicator');
        if(!indicatorVilla){
            removeVillaMarkerFromMap();
        };
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
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.uid.toLowerCase()}/${hotelLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(hotelLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/hotel/${hotelLocations.uid.toLowerCase()}/${hotelLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        let favorite = '';
        // check if favorit is true
        if (hotelLocations.is_favorit) {
            favorite = `
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${hotelLocations.id_hotel}, 'hotel')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-28 unlikeButtonhotel${hotelLocations.id_hotel}">
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${hotelLocations.id_hotel}, 'hotel')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-28 likeButtonhotel${hotelLocations.id_hotel}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        var customContent = `
                            <div class="card col-12 d-flex h-100 justify-content-between">
                                <div>
                                    <div class="image-in-map-container">
                                        @guest
                                            <div
                                                style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                                                <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                                    onclick="loginForm(1)">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                        focusable="false" class="favorite-button favorite-button-28">
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
                                        <div class="like-sign like-sign-hotel-${hotelLocations.id_hotel}">
                                            <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                                        </div>
                                        <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 270px; border-radius: 15px; width: 100%; position: absolute; z-index: 99; display: flex; justify-content: center; align-items: center;">
                                            <img style="height: 12px;" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                        </div>
                                        <div class="js-slider js-slider-border-none js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                        data-arrows="true">
                                            ${image}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank">
                                            <p class="card-text text-orange mb-0 text-20 fw-600 map-title-description">${hotelLocations.name}</p>
                                        </a>
                                    </div>

                                    <div class="d-none d-md-flex mt-2" style="height: 140px; width: 100%; border-radius: 12px; overflow: hidden;">
                                        <div style="position: absolute; height: 140px;" class="col-12 d-flex justify-content-center align-items-center">
                                                <p class="text-align-center mb-0">
                                                    <a href="https://www.apple.com/id/app-store/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-app-store">
                                                        <img style="width:30%;" src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                                    </a>

                                                    <a href="https://play.google.com/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-play-store">
                                                        <img style="width:37%;" src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                                    </a>
                                                </p>
                                        </div>
                                        <img style="object-fit: cover; width: 100%;" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end modal-view-detail">
                                    <div class="col-6">
                                        <a href="{{ env('APP_URL') }}/hotel/${hotelLocations.id_hotel}" target="_blank" class="link-detail">
                                            <p class="card-text text-17 text-orange fw-600">View Detail</p>
                                            <i class=" text-orange fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_marker('hotel', ${hotelLocations.id_hotel})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_marker('hotel', ${hotelLocations.id_hotel})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker hotel & show it to map
    function declareMarkerHotel() {
        for (let i = 0; i < hotelLocations.length; i++) {
            // declare primary marker
            addMarkerHotel({
                lat: hotelLocations[i].latitude,
                long: hotelLocations[i].longitude
            }, {
                url:`{{ asset('assets/icon/map/hotel_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });

            // show & highlight hotel when click
            google.maps.event.addListener(markerHotel[i], 'click', (function (marker, i) {
                return function () {
                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset hotel markers
                    resetHotelMarker();

                    // reset primary marker
                    resetPrimaryMarker();
                    // set primary marker
                    setPrimaryMarker(hotelLocations[i], 'hotel');

                    // add viewed marker
                    addViewedMarkerNew(hotelLocations[i].id_hotel, 'hotel');
                    // marked viewed marker
                    markedViewedMarkerNew();

                    // show right content
                    // $('#map12').addClass('w-70');
                    $('#map12').removeClass('w-100');
                    $('#map12').removeClass('h-mobile-100');
                    setTimeout(() => {
                        $('#modal-map-right').show();
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();
                    }, 200);
                };
            })(markerHotel[i], i));
        }

        const indicatorHotel = $('#map-filter-hotel').data('indicator');
        if(!indicatorHotel){
            removeHotelMarkerFromMap();
        };
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
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(activityLocations.image != null) {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/activity/${activityLocations.uid.toLowerCase()}/${activityLocations.image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image image-in-map" loading="lazy"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = activityLocations.short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = activityLocations.short_description.substring(0, 70)+'...';
        }

        var name = activityLocations.name ?? '';
        if(name.length > 7) {
            name = activityLocations.name.substring(0, 7)+'...';
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${activityLocations.id_activity}, 'activity')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button-active favorite-button-28 unlikeButtonactivity${activityLocations.id_activity}">
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
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                    <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                        onclick="likeFavorit(${activityLocations.id_activity}, 'activity')">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            role="presentation" focusable="false"
                            class="favorite-button favorite-button-28 likeButtonactivity${activityLocations.id_activity}">
                            <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                            </path>
                        </svg>
                    </a>
                </div>
            `;
        }

        var customContent = `
                            <div class="card col-12 d-flex justify-content-between h-100">
                                <div>
                                    <div class="image-in-map-container">
                                        @guest
                                            <div
                                                style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                                                <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                                    onclick="loginForm(1)">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                                        focusable="false" class="favorite-button favorite-button-28">
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
                                        <div class="like-sign like-sign-activity-${activityLocations.id_activity}">
                                            <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                                        </div>
                                        <div id="location-map-content-right-image-loading" style="background-color: #e8e8e8; height: 270px; width: 100%; position: absolute; z-index: 99; display: flex; justify-content: center; align-items: center; border-radius: 15px;">
                                            <img style="height: 12px;" src="https://c.tenor.com/NqKNFHSmbssAAAAi/discord-loading-dots-discord-loading.gif">
                                        </div>
                                        <div class="js-slider js-slider-border-none js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" style="overflow:hidden" data-dots="true"
                                        data-arrows="true">
                                            ${image}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank">
                                            <p class="card-text text-orange mb-0 text-20 fw-600 map-title-description">${activityLocations.name}</p>
                                            <p class="card-text text-13 text-grey-1 fw-500 mt-1">${facilities}</p>
                                            <p class="card-text text-grey-2 text-14 fw-500 text-align-justify mt-1 limit-short-description">${short_description}</p>
                                            {{-- <p class="card-text text-orange text-13 fw-500 mt-1">${review}</p> --}}
                                        </a>
                                    </div>

                                    <div class="d-none d-md-flex mt-2" style="height: 70px; width: 100%; border-radius: 12px; overflow: hidden;">
                                        <div style="position: absolute; height: 70px;" class="col-12 d-flex justify-content-center align-items-center">
                                            <p class="text-align-center mb-0">
                                                <a href="https://www.apple.com/id/app-store/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-app-store">
                                                    <img style="width:30%;" src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                                </a>

                                                <a href="https://play.google.com/" target="_blank" class="btn-donwload-mobile-app" id="btn-to-play-store">
                                                    <img style="width:37%;" src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.svg') }}">
                                                </a>
                                            </p>
                                        </div>
                                        <img style="object-fit: cover; width: 100%;" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                                    </div>
                                </div>

                                <div class="d-flex align-items-end modal-view-detail">
                                    <div class="col-6">
                                        <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations.id_activity}" target="_blank" class="link-detail">
                                            <p class="card-text text-17 text-orange fw-600">View Detail</p>
                                            <i class=" text-orange fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end col-6">
                                        <button class="button-prev" id="modal-map-right-prev" disabled="true" onclick="prev_marker('activity', ${activityLocations.id_activity})"><i class="fa-solid fa-chevron-left"></i></button>
                                        <div class="me-2"></div>
                                        <button class="button-next" id="modal-map-right-next" disabled="true" onclick="next_marker('activity', ${activityLocations.id_activity})"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>`;

        return customContent;
    }
    // function to declare marker activity & show it to map
    function declareMarkerActivity(addi) {
        for (let i = 0; i < activityLocations.length; i++) {
            // declare primary marker
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
                    // enable loading
                    setMapLoading();
                    // disable action google map
                    resetMapAction();
                    // disable event google map
                    resetMapEvent();

                    // reset activity markers
                    resetActivityMarker();

                    // reset primary marker
                    resetPrimaryMarker();
                    // set primary marker
                    setPrimaryMarker(activityLocations[i], 'activity');

                    // add viewed marker
                    addViewedMarkerNew(activityLocations[i].id_activity, 'activity');
                    // marked viewed marker
                    markedViewedMarkerNew();

                    // show right content
                    // $('#map12').addClass('w-70');
                    $('#map12').removeClass('w-100');
                    $('#map12').removeClass('h-mobile-100');
                    setTimeout(() => {
                        $('#modal-map-right').show();
                        // load slick slider
                        runSlickSlider();
                        // enable event google map
                        setMapEvent();
                        // enable action google map
                        setMapAction();
                        // disable loading
                        resetMapLoading();
                    }, 200);
                };
            })(markerActivity[i], i));
        }

        const indicatorActivity = $('#map-filter-activity').data('indicator');
        if(!indicatorActivity){
            removeActivityMarkerFromMap();
        };
    }

    // function to refetch data marker
    async function refetchMarkers(additionalOption) {
        console.log('hit refetchMarkers', map.getBounds());
        // console.log(map.getZoom(), map.getCenter());

        // reset all markers
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

        if(additionalOption){
            if(additionalOption.withAdditionalArray){
                if (additionalOption.additionalArrayType == 'villa') {
                    if(additionalOption.additionalArrayData){
                        villaLocations = [...villaLocations, ...additionalOption.additionalArrayData];
                        removeVillaMarkerFromMap();
                        declareMarkerVilla();
                    }
                }
                if (additionalOption.additionalArrayType == 'restaurant') {
                    if(additionalOption.additionalArrayData){
                        restaurantLocations = [...restaurantLocations, ...additionalOption.additionalArrayData];
                        removeRestaurantMarkerFromMap();
                        declareMarkerRestaurant();
                    }
                }
                if (additionalOption.additionalArrayType == 'hotel') {
                    if(additionalOption.additionalArrayData){
                        hotelLocations.concat(additionalOption.additionalArrayData);
                        removeHotelMarkerFromMap();
                        declareMarkerHotel();
                    }
                }
                if (additionalOption.additionalArrayType == 'activity') {
                    if(additionalOption.additionalArrayData){
                        activityLocations.concat(additionalOption.additionalArrayData);
                        removeActivityMarkerFromMap();
                        declareMarkerActivity();
                    }
                }
            }
        }

        markedViewedMarkerNew();
    }

    // function to set map event
    function setMapEvent() {
        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            resetRightContent();
        });

        // refetch markers when idle
        google.maps.event.addListener(map, "idle", async function() {
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
        });
    }
    // function to reset map event
    function resetMapEvent() {
        google.maps.event.clearListeners(map, 'click');
        google.maps.event.clearListeners(map, 'idle');
    }

    // function to set map action
    function setMapAction() {
        // console.log('set map action');
        map.setOptions({draggable: true, zoomControl: true, scrollwheel: true});
    }
    // function to reset map action
    function resetMapAction() {
        // console.log('reset map action');
        map.setOptions({draggable: false, zoomControl: false, scrollwheel: false});
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
        // check if primary marker is active
        if(primaryMarker) {
            // hide recenter button
            showPrimaryMarkerControlFromMap();
            // disabled prev next button
            enabledPrevNextButton();
        }
    }
    // function to hide primary marker control from map
    function hidePrimaryMarkerControlFromMap() {
        $('#location-map-recenter').addClass('d-none');
        $('#location-map-recenter').removeClass('d-block');
    }
    // function to show primary marker control from map
    function showPrimaryMarkerControlFromMap() {
        $('#location-map-recenter').addClass('d-block');
        $('#location-map-recenter').removeClass('d-none');
    }
    // function to change primary marker control image
    function changePrimaryMarkerControlImage(targetType) {
        var image = "";
        if(targetType == 'villa') {
            var image = "{{ asset('assets/icon/map/villa_active.png') }}";
        }
        if(targetType == 'restaurant') {
            var image = "{{ asset('assets/icon/map/restaurant_active.png') }}";
        }
        if(targetType == 'hotel') {
            var image = "{{ asset('assets/icon/map/hotel_active.png') }}";
        }
        if(targetType == 'activity') {
            var image = "{{ asset('assets/icon/map/activity_active.png') }}";
        }
        $('#location-map-recenter').children('img').attr('src', image);
    }

    // function to set primary marker
    function setPrimaryMarker(data, markerType) {
        var markerIcon = null;
        if(markerType == 'villa') {
            markerIcon = `{{ asset('assets/icon/map/villa_active.png') }}`;
            primaryContent = addCustomContentVilla(data);
        } else if (markerType == 'restaurant') {
            markerIcon = `{{ asset('assets/icon/map/restaurant_active.png') }}`;
            primaryContent = addCustomContentRestaurant(data);
        } else if (markerType == 'hotel') {
            markerIcon = `{{ asset('assets/icon/map/hotel_active.png') }}`;
            primaryContent = addCustomContentHotel(data);
        } else if (markerType == 'activity') {
            markerIcon = `{{ asset('assets/icon/map/activity_active.png') }}`;
            primaryContent = addCustomContentActivity(data);
        } else {
            markerIcon = null;
            primaryContent = null;
        }

        if(markerIcon != null && primaryContent != null) {
            // initialize primary detail
            primaryDetails = {
                markerType: markerType,
                data: data
            };

            // make special marker for villa
            if (markerType == 'villa') {
                let height = 12+12+11;
                let width = 12+12+(6.8*data.price_with_exchange_unit.length);
                console.log(width, height);
                primaryMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(data.latitude, data.longitude),
                    map: map,
                    label: {
                        text: data.price_with_exchange_unit,
                        className: 'text-white fw-bold px-1 py-1 rounded-pill bg-orange'
                    },
                    icon: {
                        url: markerIcon,
                        scaledSize: new google.maps.Size(width, height),
                    },
                    zIndex: 9999999
                });
            } else {
                // make primary marker
                primaryMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(data.latitude, data.longitude),
                    map: map,
                    icon: {
                        url: markerIcon,
                        scaledSize : new google.maps.Size(30, 30)
                    },
                    zIndex: 9999999
                });
            }

            $('#modal-map-right-content').html('');
            $('#modal-map-right-content').append(primaryContent);
        } else {
            // console.log('data not found');
        }
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
    // function to reset villa marker
    function resetVillaMarker() {
        if(markerVilla && markerVilla.length > 0) {
            for (let index = 0; index < markerVilla.length; index++) {
                markerVilla[index].setLabel({
                    text: markerVilla[index].label.text,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
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
                    url:`{{ asset('assets/icon/map/hotel_unclicked.png') }}`,
                    scaledSize : new google.maps.Size(30, 30)
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

    // function to show villa marker from map
    function showVillaMarkerFromMap() {
        if(markerVilla && markerVilla.length > 0) {
            for (let index = 0; index < markerVilla.length; index++) {
                markerVilla[index].setMap(map);
            };
        }
    }
    // function to show restaurant marker from map
    function showRestaurantMarkerFromMap() {
        if(markerRestaurant && markerRestaurant.length > 0) {
            for (let index = 0; index < markerRestaurant.length; index++) {
                markerRestaurant[index].setMap(map);
            };
        }
    }
    // function to show hotel marker from map
    function showHotelMarkerFromMap() {
        if(markerHotel && markerHotel.length > 0) {
            for (let index = 0; index < markerHotel.length; index++) {
                markerHotel[index].setMap(map);
            };
        }
    }
    // function to show activity marker from map
    function showActivityMarkerFromMap() {
        if(markerActivity && markerActivity.length > 0) {
            for (let index = 0; index < markerActivity.length; index++) {
                markerActivity[index].setMap(map);
            };
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
                // console.log('marker doesnt exist', viewedMarkers);
            }
        } else {
            viewedMarkers.push(id_restaurant);
            // console.log('array empty', viewedMarkers);
        }
    }
    // function to marked viewed marker restaurant
    function markedViewedMarker() {
        if(restaurantLocations.length > 0) {
            if(viewedMarkers.length > 0) {
                if(markerRestaurant.length > 0) {
                    viewedMarkers.forEach(id_restaurant => {
                        for (let j = 0; j < restaurantLocations.length; j++) {
                            if(restaurantLocations[j].id_restaurant && restaurantLocations[j].id_restaurant == id_restaurant) {
                                markerRestaurant[j].setIcon({
                                    url:`{{ asset('assets/icon/map/restaurant_clicked.png') }}`,
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

    // function to add viewed marker
    function addViewedMarkerNew(id, target_type) {
        // mark clicked villa marker villa
        if(target_type == 'villa') {
            if(viewedMarkerVilla.length > 0) {
                var checkViewedMarkerIdExist = false;
                viewedMarkerVilla.forEach(viewedMarkerId => {
                    if(viewedMarkerId == id) {
                        checkViewedMarkerIdExist = true;
                    }
                });

                if(checkViewedMarkerIdExist != true) {
                    viewedMarkerVilla.push(id);
                    console.log('marker doesnt exist', viewedMarkerVilla);
                }
            } else {
                viewedMarkerVilla.push(id);
                console.log('array empty', viewedMarkerVilla);
            }
        }
        // mark clicked villa marker restaurant
        if(target_type == 'restaurant') {
            if(viewedMarkerRestaurant.length > 0) {
                var checkViewedMarkerIdExist = false;
                viewedMarkerRestaurant.forEach(viewedMarkerId => {
                    if(viewedMarkerId == id) {
                        checkViewedMarkerIdExist = true;
                    }
                });

                if(checkViewedMarkerIdExist != true) {
                    viewedMarkerRestaurant.push(id);
                    console.log('marker doesnt exist', viewedMarkerRestaurant);
                }
            } else {
                viewedMarkerRestaurant.push(id);
                console.log('array empty', viewedMarkerRestaurant);
            }
        }
        // mark clicked villa marker hotel
        if(target_type == 'hotel') {
            if(viewedMarkerHotel.length > 0) {
                var checkViewedMarkerIdExist = false;
                viewedMarkerHotel.forEach(viewedMarkerId => {
                    if(viewedMarkerId == id) {
                        checkViewedMarkerIdExist = true;
                    }
                });

                if(checkViewedMarkerIdExist != true) {
                    viewedMarkerHotel.push(id);
                    console.log('marker doesnt exist', viewedMarkerHotel);
                }
            } else {
                viewedMarkerHotel.push(id);
                console.log('array empty', viewedMarkerHotel);
            }
        }
        // mark clicked villa marker activity
        if(target_type == 'activity') {
            if(viewedMarkerActivity.length > 0) {
                var checkViewedMarkerIdExist = false;
                viewedMarkerActivity.forEach(viewedMarkerId => {
                    if(viewedMarkerId == id) {
                        checkViewedMarkerIdExist = true;
                    }
                });

                if(checkViewedMarkerIdExist != true) {
                    viewedMarkerActivity.push(id);
                    console.log('marker doesnt exist', viewedMarkerActivity);
                }
            } else {
                viewedMarkerActivity.push(id);
                console.log('array empty', viewedMarkerActivity);
            }
        }
    }
    // function to marked viewed marker
    function markedViewedMarkerNew() {
        // mark clicked villa marker
        if(villaLocations.length > 0) {
            if(viewedMarkerVilla.length > 0) {
                if(markerVilla.length > 0) {
                    viewedMarkerVilla.forEach(id_villa => {
                        for (let j = 0; j < villaLocations.length; j++) {
                            if(villaLocations[j].id_villa && villaLocations[j].id_villa == id_villa) {
                                try {
                                    markerVilla[j].setLabel({
                                        text: markerVilla[j].label.text,
                                        className: 'text-black fw-bold px-1 py-1 rounded-pill bg-clicked'
                                    });
                                } catch (error) {}
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
        // mark clicked restaurant marker
        if(restaurantLocations.length > 0) {
            if(viewedMarkerRestaurant.length > 0) {
                if(markerRestaurant.length > 0) {
                    viewedMarkerRestaurant.forEach(id_restaurant => {
                        for (let j = 0; j < restaurantLocations.length; j++) {
                            if(restaurantLocations[j].id_restaurant && restaurantLocations[j].id_restaurant == id_restaurant) {
                                try {
                                    markerRestaurant[j].setIcon({
                                        url:`{{ asset('assets/icon/map/restaurant_clicked.png') }}`,
                                        scaledSize : new google.maps.Size(30, 30)
                                    });
                                } catch (error) {}
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
        // mark clicked hotel marker
        if(hotelLocations.length > 0) {
            if(viewedMarkerHotel.length > 0) {
                if(markerHotel.length > 0) {
                    viewedMarkerHotel.forEach(id_hotel => {
                        for (let j = 0; j < hotelLocations.length; j++) {
                            if(hotelLocations[j].id_hotel && hotelLocations[j].id_hotel == id_hotel) {
                                try {
                                    markerHotel[j].setIcon({
                                        url:`{{ asset('assets/icon/map/hotel_clicked.png') }}`,
                                        scaledSize : new google.maps.Size(30, 30)
                                    });
                                } catch (error) {}
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
        // mark clicked activity marker
        if(activityLocations.length > 0) {
            if(viewedMarkerActivity.length > 0) {
                if(markerActivity.length > 0) {
                    viewedMarkerActivity.forEach(id_activity => {
                        for (let j = 0; j < activityLocations.length; j++) {
                            if(activityLocations[j].id_activity && activityLocations[j].id_activity == id_activity) {
                                try {
                                    markerActivity[j].setIcon({
                                        url:`{{ asset('assets/icon/map/activity_clicked.png') }}`,
                                        scaledSize : new google.maps.Size(30, 30)
                                    });
                                } catch (error) {}
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

    // function to reset filter indicator
    function resetFilterIndicator() {
        const filterVilla = $('#map-filter-villa');
        const filterRestaurant = $('#map-filter-restaurant');
        const filterHotel = $('#map-filter-hotel');
        const filterActivity = $('#map-filter-activity');

        filterVilla.data('indicator', false);
        filterRestaurant.data('indicator', false);
        filterHotel.data('indicator', false);
        filterActivity.data('indicator', false);

        var srcVilla = filterVilla.children('img').data('src');
        var srcRestaurant = filterRestaurant.children('img').data('src');
        var srcHotel = filterHotel.children('img').data('src');
        var srcActivity = filterActivity.children('img').data('src');

        filterVilla.children('img').attr('src', srcVilla);
        filterRestaurant.children('img').attr('src', srcRestaurant);
        filterHotel.children('img').attr('src', srcHotel);
        filterActivity.children('img').attr('src', srcActivity);
    }
    // function to set filter indicator
    function setFilterIndicator(indicator_type) {
        const filterVilla = $('#map-filter-villa');
        const filterRestaurant = $('#map-filter-restaurant');
        const filterHotel = $('#map-filter-hotel');
        const filterActivity = $('#map-filter-activity');

        if (indicator_type == 'villa') {
            filterVilla.data('indicator', true);
            var srcActiveVilla = filterVilla.children('img').data('src-active');
            filterVilla.children('img').attr('src', srcActiveVilla);
        } else if(indicator_type == 'restaurant') {
            filterRestaurant.data('indicator', true);
            var srcActiveRestaurant = filterRestaurant.children('img').data('src-active');
            filterRestaurant.children('img').attr('src', srcActiveRestaurant);
        } else if(indicator_type == 'hotel') {
            filterHotel.data('indicator', true);
            var srcActiveHotel = filterHotel.children('img').data('src-active');
            filterHotel.children('img').attr('src', srcActiveHotel);
        } else if(indicator_type == 'activity') {
            filterActivity.data('indicator', true);
            var srcActiveActivity = filterActivity.children('img').data('src-active');
            filterActivity.children('img').attr('src', srcActiveActivity);
        }

        console.log('Villa filter :'+filterVilla.data('indicator'));
        console.log('Restaurant filter :'+filterRestaurant.data('indicator'));
        console.log('Hotel filter :'+filterHotel.data('indicator'));
        console.log('Activity filter :'+filterActivity.data('indicator'));
    }
    // function to show only filtered marker
    function showOnlyFilteredMarker() {
        const filterVilla = $('#map-filter-villa');
        const filterRestaurant = $('#map-filter-restaurant');
        const filterHotel = $('#map-filter-hotel');
        const filterActivity = $('#map-filter-activity');

        var indicatorVilla = filterVilla.data('indicator');
        var indicatorRestaurant = filterRestaurant.data('indicator');
        var indicatorHotel = filterHotel.data('indicator');
        var indicatorActivity = filterActivity.data('indicator');

        if(indicatorVilla) {
            showVillaMarkerFromMap();
            removeRestaurantMarkerFromMap();
            removeHotelMarkerFromMap();
            removeActivityMarkerFromMap();
        } else if (indicatorRestaurant) {
            removeVillaMarkerFromMap();
            showRestaurantMarkerFromMap();
            removeHotelMarkerFromMap();
            removeActivityMarkerFromMap();
        } else if (indicatorHotel) {
            removeVillaMarkerFromMap();
            removeRestaurantMarkerFromMap();
            showHotelMarkerFromMap();
            removeActivityMarkerFromMap();
        } else if (indicatorActivity) {
            removeVillaMarkerFromMap();
            removeRestaurantMarkerFromMap();
            removeHotelMarkerFromMap();
            showActivityMarkerFromMap();
        }
    }

    // reset right content
    function resetRightContent() {
        // reset map event
        resetMapEvent();
        // reset primary marker
        resetPrimaryMarker();
        // marked viewed marker
        markedViewedMarkerNew();
        // show only filtered marker
        showOnlyFilteredMarker();
        // reset right content
        // $('#map12').removeClass('w-70');
        $('#map12').addClass('w-100');
        $('#map12').addClass('h-mobile-100');
        $('#modal-map-right-content').html('');
        $('#modal-map-right').hide();
        // hide primary marker control
        hidePrimaryMarkerControlFromMap();

        setTimeout(async () => {
            // set map event
            setMapEvent();
        }, 200);
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
</script>
{{-- fetch function --}}
<script>
    // function to refetch data for marker map
    async function fetchRestaurantsLocation(data) {
        const response = await fetch(`{{ route('map_restaurant_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        restaurantLocations = datas;
        declareMarkerRestaurant();
        // console.log('fetch restaurant done');
    }
    async function fetchVillasLocation(data) {
        const response = await fetch(`{{ route('map_villa_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        villaLocations = datas;
        declareMarkerVilla();
        // console.log('fetch villa done');
    }
    async function fetchHotelsLocation(data) {
        const response = await fetch(`{{ route('map_hotel_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        hotelLocations = datas;
        declareMarkerHotel();
        // console.log('fetch hotel done');
    }
    async function fetchActivitysLocation(data) {
        const response = await fetch(`{{ route('map_activity_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`);
        datas = await response.json();
        activityLocations = datas;
        declareMarkerActivity();
        // console.log('fetch activity done');
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
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
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
        reCenter.setAttribute("class", "d-none");
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

        $("#modal-map-right-content").on('swipe', function() {
            console.log('swipe right');
        });
        console.log('init map');
    };
    // view map
    async function view_maps(id) {
        // enable loading
        setMapLoading();
        // disable action google map
        resetMapAction();
        // disable event google map
        resetMapEvent();

        // find restaurant
        fetch(`/map/by-coordinate-area/restaurant/${id}`)
            .then(response => response.json())
            .then(async (data)=>{
                // set map
                map.setZoom(13);
                map.setCenter(new google.maps.LatLng(data.latitude, data.longitude));

                // reset primary marker
                resetPrimaryMarker();
                // set primary marker
                setPrimaryMarker(data, 'restaurant');

                // show modal
                $("#modal-map").modal('show');

                // show right content
                // $('#map12').addClass('w-70');
                $('#map12').removeClass('w-100');
                $('#map12').removeClass('h-mobile-100');
                setTimeout(async () => {
                    $('#modal-map-right').show();
                    // load slick slider
                    runSlickSlider();
                    // filter map
                    filter_map('restaurant', {
                        withResetRightContent: false,
                    });
                    // refetch data
                    await refetchMarkers({
                        withAdditionalArray: true,
                        additionalArrayType: 'restaurant',
                        additionalArrayData: [data]
                    });
                    // add viewed marker
                    addViewedMarkerNew(data.id_restaurant, 'restaurant');
                    // marked viewed marker
                    markedViewedMarkerNew();
                    // enable event google map
                    setMapEvent();
                    // enable action google map
                    setMapAction();
                    // disable loading
                    resetMapLoading();
                }, 200);
            });
    }
    // view main map
    async function view_main_map() {
        // console.log('view main map');
        // enable loading
        setMapLoading();
        // disable action google map
        resetMapAction();
        // disable event google map
        resetMapEvent();

        // reset right content
        // $('#map12').removeClass('w-70');
        $('#map12').addClass('w-100');
        $('#map12').addClass('h-mobile-100');

        $('#modal-map-right').hide();

        // reset primary marker
        resetPrimaryMarker();

        // show modal
        $("#modal-map").modal('show');

        // reset map
        map.setZoom(12);
        map.setCenter(new google.maps.LatLng(-8.687822, 115.175102));
        setTimeout(async () => {
            // filter map
            filter_map('restaurant', {
                withResetRightContent: false,
            });
            // refetch data
            await refetchMarkers();
            // enable event google map
            setMapEvent();
            // enable action google map
            setMapAction();
            // disable loading
            resetMapLoading();
        }, 200);
    }
    // filter map
    function filter_map(indicator_type, additionalOption) {
        // reset filter indicator
        resetFilterIndicator();

        // set filter indicator
        setFilterIndicator(indicator_type);

        // change primary marker control image
        changePrimaryMarkerControlImage(indicator_type);

        // check if additionalOption exist, otherwise back to default setting
        if(additionalOption){
            if(additionalOption.withResetRightContent == true){
                // reset right content
                resetRightContent();
            }
        } else {
            resetRightContent();
        }

        // show only filtered marker
        showOnlyFilteredMarker();
    }
    // next marker
    function next_marker(target_type, id) {
        console.log('target_type :'+target_type);
        console.log('id :'+id);
        if(target_type == 'villa') {
            if(villaLocations.length > 0 && villaLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < villaLocations.length; i++) {
                    const data = villaLocations[i];
                    if(data.id_villa == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == (villaLocations.length-1)) {
                        console.log('hit last of the list');
                        google.maps.event.trigger(markerVilla[0], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerVilla[index+1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'restaurant'){
            if(restaurantLocations.length > 0 && restaurantLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < restaurantLocations.length; i++) {
                    const data = restaurantLocations[i];
                    if(data.id_restaurant == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == (restaurantLocations.length-1)) {
                        console.log('hit last of the list');
                        google.maps.event.trigger(markerRestaurant[0], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerRestaurant[index+1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'hotel'){
            if(hotelLocations.length > 0 && hotelLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < hotelLocations.length; i++) {
                    const data = hotelLocations[i];
                    if(data.id_hotel == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == (hotelLocations.length-1)) {
                        console.log('hit last of the list');
                        google.maps.event.trigger(markerHotel[0], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerHotel[index+1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'activity'){
            if(activityLocations.length > 0 && activityLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < activityLocations.length; i++) {
                    const data = activityLocations[i];
                    if(data.id_activity == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == (activityLocations.length-1)) {
                        console.log('hit last of the list');
                        google.maps.event.trigger(markerActivity[0], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerActivity[index+1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        };
    }
    // prev marker
    function prev_marker(target_type, id) {
        console.log('target_type :'+target_type);
        console.log('id :'+id);
        if(target_type == 'villa') {
            if(villaLocations.length > 0 && villaLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < villaLocations.length; i++) {
                    const data = villaLocations[i];
                    if(data.id_villa == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == 0) {
                        console.log('hit first of the list');
                        google.maps.event.trigger(markerVilla[(villaLocations.length-1)], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerVilla[index-1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'restaurant'){
            if(restaurantLocations.length > 0 && restaurantLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < restaurantLocations.length; i++) {
                    const data = restaurantLocations[i];
                    if(data.id_restaurant == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == 0) {
                        console.log('hit first of the list');
                        google.maps.event.trigger(markerRestaurant[(restaurantLocations.length-1)], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerRestaurant[index-1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'hotel'){
            if(hotelLocations.length > 0 && hotelLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < hotelLocations.length; i++) {
                    const data = hotelLocations[i];
                    if(data.id_hotel == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == 0) {
                        console.log('hit first of the list');
                        google.maps.event.trigger(markerHotel[(hotelLocations.length-1)], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerHotel[index-1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        } else if( target_type == 'activity'){
            if(activityLocations.length > 0 && activityLocations){
                // find index on the list
                var index = null;
                for (let i = 0; i < activityLocations.length; i++) {
                    const data = activityLocations[i];
                    if(data.id_activity == id) {
                        index = i;
                        break;
                    }
                }

                // check if index is exist
                if (index != null) {
                    if(index == 0) {
                        console.log('hit first of the list');
                        google.maps.event.trigger(markerActivity[(activityLocations.length-1)], 'click');
                    } else {
                        console.log('hit data in the middle');
                        google.maps.event.trigger(markerActivity[index-1], 'click');
                    }
                } else {
                    console.log('index not found');
                }
            }
        };
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
    <div class="modal-dialog modal-fullscreen modal-xl overflow-y-scroll" role="document" style="height:100vh;">
        <div class="modal-content modal-map">
            <div class="modal-header modal-header-map flex-column">
                <div class="row" style="width:100%;">
                    <div class="col-3"><h5 class="modal-title">{{ __('user_page.Map') }}</h5></div>
                    <div class="col-6">
                        <div class="d-flex justify-content-center">
                            <a class="icon-filter-map" id="map-filter-villa" data-indicator="false" onclick="filter_map('villa')">
                                <img
                                    src="{{asset('assets/icon/map/villa.png')}}"
                                    data-src-active="{{asset('assets/icon/map/villa_active.png')}}"
                                    data-src="{{asset('assets/icon/map/villa.png')}}"
                                    alt="villa-icon">
                            </a>
                            <a class="icon-filter-map" id="map-filter-restaurant" data-indicator="true" onclick="filter_map('restaurant')">
                                <img
                                    src="{{asset('assets/icon/map/restaurant_active.png')}}"
                                    data-src-active="{{asset('assets/icon/map/restaurant_active.png')}}"
                                    data-src="{{asset('assets/icon/map/restaurant.png')}}"
                                    alt="restaurant-icon">
                            </a>
                            <a class="icon-filter-map" id="map-filter-hotel" data-indicator="false" onclick="filter_map('hotel')">
                                <img
                                    src="{{asset('assets/icon/map/hotel.png')}}"
                                    data-src-active="{{asset('assets/icon/map/hotel_active.png')}}"
                                    data-src="{{asset('assets/icon/map/hotel.png')}}"
                                    alt="hotel-icon">
                            </a>
                            <a class="icon-filter-map" id="map-filter-activity" data-indicator="false" onclick="filter_map('activity')">
                                <img
                                    src="{{asset('assets/icon/map/activity.png')}}"
                                    data-src-active="{{asset('assets/icon/map/activity_active.png')}}"
                                    data-src="{{asset('assets/icon/map/activity.png')}}"
                                    alt="activity-icon">
                            </a>
                            <a class="icon-filter-map" id="searchMapMobile" onclick="popUp()" data-bs-dismiss="modal" aria-label="Close">
                                <img
                                    src="{{asset('assets/icon/menu/search.svg')}}"
                                    data-src-active="{{asset('assets/icon/menu/search.svg')}}"
                                    data-src="{{asset('assets/icon/menu/search.svg')}}"
                                    alt="search-icon">
                            </a>
                        </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end px-0 align-items-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row col-12 justify-content-center" id="searchMapDekstop">
                    <div class="col-12 col-lg-3 close-modal modal-search" onclick="popUp();">
                        Search here ...
                    </div>
                </div>
            </div>
            <div class="modal-body modal-body-map">
                <div class="map-modal-container">
                    <div class="map-container"id="map12"></div>
                    <div class="map-content" id="modal-map-right">
                        <div id="modal-map-right-content" class="h-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END GOOGLE MAPS API --}}
