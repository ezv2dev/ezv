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
    // declare variable
    let map;
    var list;
    var customContents = [];
    var infowindow;
    var primaryMarker, secondaryMarker;
    var primaryContent, secondaryContent;

    var restaurantLocations;
    var markerRestaurant = [];

    var villaLocations;
    var markerVilla = [];
</script>
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
    function addCustomContentRestaurant(restaurantLocations, i) {
        // check if image exist
        let image = '';
        if(restaurantLocations[i].photo.length != 0) {
            image = '';
            for (let j = 0; j < restaurantLocations[i].photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image bg-primary" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations[i].uid.toLowerCase()}/${restaurantLocations[i].photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(restaurantLocations[i].image != null) {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image bg-primary" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/restaurant/${restaurantLocations[i].uid.toLowerCase()}/${restaurantLocations[i].image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image bg-primary" loading="lazy" style="display: block; height:200px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = restaurantLocations[i].short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = restaurantLocations[i].short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (restaurantLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${restaurantLocations[i].detail_review.average} Reviews`;
        }

        let cuisine = 'there is no cuisine yet';
        if(restaurantLocations[i].cuisine.length > 4) {
            cuisine = '';
            for (let j = 0; j < 4; j++) {
                var data = `${restaurantLocations[i].cuisine[j].name} `;
                cuisine += data;
            }
        } else if(restaurantLocations[i].cuisine.length > 0 && restaurantLocations[i].cuisine.length <= 4) {
            cuisine = '';
            for (let j = 0; j < restaurantLocations[i].cuisine.length; j++) {
                var data = `${restaurantLocations[i].cuisine[j].name} `;
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
                                    <a href="{{ env('APP_URL') }}/restaurant/${restaurantLocations[i].id_restaurant}" target="_blank">
                                        <p class="card-text text-13 text-grey-1 fw-500">${review}</p>
                                        <p class="card-text text-20 text-orange fw-600 mt-1">${restaurantLocations[i].name}</p>
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

                    // highlight target restaurant marker & show info window
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
                    var content = addCustomContentRestaurant(restaurantLocations, i);
                    $('#modal-map-content').html('');
                    $('#modal-map-content').append(content);

                    // show right content
                    $('#map12').addClass('col-8');
                    $('#map12').removeClass('col-12');
                    setTimeout(() => {
                        $('#modal-map-content').show();
                        // load slick slider
                        $('.js-slider-test').slick();
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
    function addCustomContentVilla(villaLocations, i) {
        // check if image exist
        let image = '';
        if(villaLocations[i].photo.length != 0) {
            image = '';
            for (let j = 0; j < villaLocations[i].photo.length; j++) {
                image += `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations[i].uid.toLowerCase()}/${villaLocations[i].photo[j].name}')}}"
                        alt="">
                </a>`;
            }
        } else {
            if(villaLocations[i].image != null) {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height: 200px;"
                        src="{{ URL::asset('/foto/gallery/${villaLocations[i].uid.toLowerCase()}/${villaLocations[i].image}')}}"
                        alt="">
                </a>`;
            } else {
                image = `<a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank" class="col-lg-6 grid-image-container">
                    <img class="img-fluid grid-image" loading="lazy" style="display: block; height:200px;"
                        src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                        alt="">
                </a>`;
            }
        }

        var short_description = villaLocations[i].short_description ?? 'there is no description yet';
        if(short_description.length > 70) {
            short_description = villaLocations[i].short_description.substring(0, 70)+'...';
        }

        // check if rating exist
        let review = `there is no review yet`;
        if (villaLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaLocations[i].detail_review.average} (${villaLocations[i].detail_review.count_person})`;
        }

        let price = `there is no price yet`;
        if(villaLocations[i].price) {
            price = `IDR ${villaLocations[i].price.toLocaleString()}`;
        }

        var customContent = `
                            <div class="card" style="width: 17rem">
                                <div class="js-slider js-slider-test slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true"
                                data-arrows="true">
                                    ${image}
                                </div>
                                <div class="p-3">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank">
                                        <p class="card-text text-orange mb-0 text-20 fw-600">${villaLocations[i].name}</p>
                                        <p class="card-text text-13 text-grey-1 fw-500 mt-1">${villaLocations[i].adult ?? 0} Guest • ${villaLocations[i].bedroom ?? 0} Bedroom • ${villaContent.bathroom ?? 0} Bath • ${villaContent.parking ?? 0} Parking • ${villaContent.size ?? 0}m² living</p>
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

            // show & highlight restaurant when click
            google.maps.event.addListener(markerVilla[i], 'click', (function (marker, i) {
                return function () {
                    // reset villa markers
                    for (let index = 0; index < markerVilla.length; index++) {
                        markerVilla[index].setIcon({
                            url:`{{ asset('assets/icon/map/villa.png') }}`,
                            scaledSize : new google.maps.Size(20, 20)
                        });
                    }

                    // highlight target restaurant marker & show info window
                    marker.setIcon({
                        url:`{{ asset('assets/icon/map/villa.png') }}`,
                        scaledSize : new google.maps.Size(30, 30)
                    });

                    // append data to right content
                    var content = addCustomContentVilla(villaLocations, i);
                    infowindow.setContent(null);
                    infowindow.setContent(content);
                    google.maps.InfoWindow.prototype.opened = true;
                    infowindow.open(map, marker);
                };
            })(markerVilla[i], i));
        }
    }

    // function to refetch data marker
    function refetchMarkers(map) {
        // prepare data coordinate
        var data = {
            latitude_h: map.getBounds().Ab.h,
            latitude_j: map.getBounds().Ab.j,
            longitude_h: map.getBounds().Ua.h,
            longitude_j: map.getBounds().Ua.j,
        };
        // refetch data for markers
        fetchRestaurantsLocation(data);
        fetchVillasLocation(data);
        fetchHotelsLocation(data);
        fetchActivitysLocation(data);
    }

    // init map when page is completed load
    function initViewMap(){
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

        // load slick slider
        infowindow.addListener('domready', function() {
            $('.js-slider-test').slick();
        });

        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            // console.log('hit');
            if(infowindow.opened) {
                google.maps.InfoWindow.prototype.opened = false;
                infowindow.setContent(null);
                infowindow.close();
            } else {
                // reset restaurant markers
                for (let index = 0; index < markerRestaurant.length; index++) {
                    markerRestaurant[index].setIcon({
                        url:`{{ asset('assets/icon/map/restaurant_unclicked.png') }}`,
                        scaledSize : new google.maps.Size(30, 30)
                    });
                    markerRestaurant[index].setMap(map);
                }

                // reset primary marker
                if(primaryMarker) {
                    primaryMarker.setMap(null);
                    primaryMarker = null;
                }

                $('#map12').removeClass('col-8');
                $('#map12').addClass('col-12');
                $('#modal-map-content').hide();
            }
        });

        // reload marker by appeared map area
        google.maps.event.addListener(map, "idle", function() {
            // remove marker restaurant from map
            if(markerRestaurant && markerRestaurant.length > 0) {
                for (let index = 0; index < markerRestaurant.length; index++) {
                    markerRestaurant[index].setMap(null);
                };
            }
            // remove marker villa from map
            if(markerVilla && markerVilla.length > 0) {
                for (let index = 0; index < markerVilla.length; index++) {
                    markerVilla[index].setMap(null);
                };
            }

            // clear variable restaurant
            restaurantLocations = null;
            markerRestaurant = [];
            // clear variable restaurant
            restaurantLocations = null;
            markerRestaurant = [];
            // clear variable villa
            villaLocations = null;
            markerVilla = [];

            // refetch data
            refetchMarkers(map);
        });
        google.maps.event.addListener(map, "load", function() {
            // remove marker restaurant from map
            if(markerRestaurant && markerRestaurant.length > 0) {
                for (let index = 0; index < markerRestaurant.length; index++) {
                    markerRestaurant[index].setMap(null);
                };
            }
            // remove marker villa from map
            if(markerVilla && markerVilla.length > 0) {
                for (let index = 0; index < markerVilla.length; index++) {
                    markerVilla[index].setMap(null);
                };
            }

            // clear variable restaurant
            restaurantLocations = null;
            markerRestaurant = [];
            // clear variable restaurant
            restaurantLocations = null;
            markerRestaurant = [];
            // clear variable villa
            villaLocations = null;
            markerVilla = [];
            // close infowindow
            if(infowindow) {
                infowindow.close();
                google.maps.InfoWindow.prototype.opened = false;
            }
            // close right content
            $('#map12').removeClass('col-8');
            $('#map12').addClass('col-12');
            $('#modal-map-content').hide();

            // refetch data
            refetchMarkers(map);
        });
    };

    async function view_maps(id) {
        // find restaurant
        fetch(`/map/by-coordinate-area/restaurant/${id}`)
            .then(response => response.json())
            .then((data)=>{
                // set map
                map.setZoom(13);
                console.log(data.latitude, data.longitude);
                map.setCenter(new google.maps.LatLng(data.latitude, data.longitude));

                // find & hightlight marker
                for (let i = 0; i < restaurantLocations.length; i++) {
                    if (restaurantLocations[i].id_restaurant == id) {
                        // highlight target restaurant marker & show right content
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
                        primaryContent = addCustomContentRestaurant(restaurantLocations, i);
                        $('#modal-map-content').html('');
                        $('#modal-map-content').append(primaryContent);

                        // show right content
                        $('#map12').addClass('col-8');
                        $('#map12').removeClass('col-12');
                        setTimeout(() => {
                            $('#modal-map-content').show();
                            // load slick slider
                            $('.js-slider-test').slick();
                            // show modal
                            $("#modal-map").modal('show');
                        }, 200);
                        break;
                    }
                }
            });
    }

    function view_main_map() {
        // refetch data
        refetchMarkers(map);

        // reset marker
        for (let index = 0; index < markerRestaurant.length; index++) {
            markerRestaurant[index].setIcon({
                url:`{{ asset('assets/icon/map/restaurant_unclicked.png') }}`,
                scaledSize : new google.maps.Size(30, 30)
            });
        };

        // reset map
        map.setCenter(new google.maps.LatLng(-8.375227, 115.091637));
        map.setZoom(9);

        // reset modal
        $('#map12').removeClass('col-8');
        $('#map12').addClass('col-12');
        $('#modal-map-content').hide();
        $("#modal-map").modal('show');
    }
</script>
<script>
    // function to refetch data for marker map
    function fetchRestaurantsLocation(data) {
        var promises = [];
        var request = fetch(`{{ route('map_restaurant_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`)
            .then(response => response.json())
            .then(datas => {
                restaurantLocations = datas;
            });
        promises.push(request);

        $.when.apply(null, promises).done(async () => {
            declareMarkerRestaurant();
        });
    }
    function fetchVillasLocation(data) {
        var promises = [];
        ;
        var request = fetch(`{{ route('map_villa_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`)
            .then(response => response.json())
            .then(datas => {
                villaLocations = datas;
            });
        promises.push(request);

        $.when.apply(null, promises).done(async () => {
            declareMarkerVilla();
        });
    }
    function fetchHotelsLocation(data) {
        var promises = [];
        // var request = fetch(`{{ route('map_hotel_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`)
        //     .then(response => response.json())
        //     .then(data => console.log(data));
        // promises.push(request);

        // $.when.apply(null, promises).done(async () => {
        //     console.log('done');
        // });
    }
    function fetchActivitysLocation(data) {
        var promises = [];
        // var request = fetch(`{{ route('map_activity_location') }}?latitude_h=${data.latitude_h}&latitude_j=${data.latitude_j}&longitude_h=${data.longitude_h}&longitude_j=${data.longitude_j}`)
        //     .then(response => response.json())
        //     .then(data => console.log(data));
        // promises.push(request);

        // $.when.apply(null, promises).done(async () => {
        //     console.log('done');
        // });
    }

    // function to search data restaurant
    function searchRestaurantLocation(id) {
        var promises = [];
        var data;
        var request = fetch(`/map/by-coordinate-area/restaurant/${id}`)
            .then(response => response.json())
            .then(datas => {
                data = datas;
            });
        promises.push(request);

        $.when.apply(null, promises).done(async () => {
            return data;
        });
    }
</script>
<script>
    // run init map
    list = @json($restaurant);
    restaurantLocations = list.data;
    // prepare data before get
    $(window).on('load', () => {
        initViewMap();
    });
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
