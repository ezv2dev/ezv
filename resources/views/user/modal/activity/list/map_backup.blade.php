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

        .card-body {
            padding: 0.8rem !important;
        }

        .rounded-pill {
            border-radius: 50px !important;
            padding: 9px 10px 9px 10px !important;
            box-shadow: rgb(0 0 0 / 4%) 0px 0px 0px 1px, rgb(0 0 0 / 18%) 0px 2px 4px;
        }

    </style>

    <script>
        let map;
        var infowindows = [];
        var customContents = [];
        var markers = [];
        var marker, i;

        // function to add marker and save it to markers array
        function addMarker(position, label) {
            // console.log(position);
            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(position.lat, position.long),
                map: map,
                label: label,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8
                }
            });

            markers.push(marker);
        }


        // function to desclare custom content for infowindow
        function addCustomContent(activityLocations, i) {
            // check if image exist
            let image = `<img src="{{ asset('foto/default/no-image.jpeg') }}" class="card-img-top">`;
            if (activityLocations[i].image != null) {
                image =
                    `<img src="{{ asset('foto/activity/${activityLocations[i].name.toLowerCase()}/${activityLocations[i].image}') }}" class="card-img-top">`;
            }
            // check if rating exist
            let review = `there is no review yet`;
            if (activityLocations[i].detail_review != null) {
                review =
                    `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${activityLocations[i].detail_review.average} (${activityLocations[i].detail_review.count_person})`;
            }

            var customContent = `<div class="card" style="width: 18rem; font-family: 'Poppins'">
                                <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations[i].id_activity}" target="_blank">
                                ${image}
                                </a>
                                <div class="card-body">
                                    <a href="{{ env('APP_URL') }}/things-to-do/${activityLocations[i].id_activity}" target="_blank">
                                        <p class="card-text text-secondary">
                                            <small>
                                                ${review}
                                            </small>
                                        </p>
                                        <p class="card-text">${activityLocations[i].location.name}</p>
                                        <p class="card-text">${activityLocations[i].name}</p>
                                    </a>
                                </div>
                            </div>`;

            customContents.push(customContent);
        }

        // init map when page is completed load
        function initViewMap() {
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
                    text: activityLocations[i].name,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                });

                addCustomContent(activityLocations, i);

                google.maps.event.addListener(markers[i], 'click', (function(marker, i) {
                    return function() {
                        for (let index = 0; index < markers.length; index++) {
                            markers[index].setLabel({
                                text: activityLocations[index].name,
                                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                            });
                        }
                        marker.setLabel({
                            text: activityLocations[i].name,
                            className: 'text-white fw-bold px-1 py-1 rounded-pill bg-black'
                        });
                        infowindow.setContent(customContents[i]);
                        infowindow.open(map, marker);
                    }
                })(markers[i], i));
            }

            // close info window and reset markers when click on the map
            google.maps.event.addListener(map, "click", function(event) {
                for (let index = 0; index < markers.length; index++) {
                    markers[index].setLabel({
                        text: activityLocations[index].name,
                        className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                    });
                };
                infowindow.close();
            });
        };

        function view_maps(mapId) {
            // console.log(customContents, markers);
            for (let i = 0; i < activityLocations.length; i++) {
                markers[i].setLabel({
                    text: activityLocations[i].name,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                });
                infowindow.close();
                infowindow.setContent(null);
            }
            for (let i = 0; i < activityLocations.length; i++) {
                if (activityLocations[i].id_activity == mapId) {
                    markers[i].setLabel({
                        text: activityLocations[i].name,
                        className: 'text-white fw-bold px-1 py-1 rounded-pill bg-black'
                    });
                    infowindow.setContent(customContents[i]);
                    // map.setCenter(new google.maps.LatLng(villaLocations[i].latitude, villaLocations[i].longitude));
                    infowindow.open(map, markers[i]);
                    break;
                }
            }
            $("#modal-map").modal('show');
        }
    </script>

    <script>
        var list = @json($list);
        var activityLocations = [];

        function getData(ajaxurl) {
            return $.ajax({
                url: ajaxurl,
                type: 'GET',
            });
        };

        function fetchRestaurantsLocation(ids) {
            var promises = [];
            ids.forEach(id => {
                var request = getData(`/things-to-do/map/${id}`).then((data) => {
                    activityLocations.push(data);
                    // console.log(`process ${id}`);
                });
                promises.push(request);
            });

            $.when.apply(null, promises).done(() => {
                // console.log('done');
                // console.log(activityLocations);
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
                <div class="modal-body" style="height: 500px">
                    <div id="map12" style="width:100%;height:100%; border-radius: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- END GOOGLE MAPS API --}}
