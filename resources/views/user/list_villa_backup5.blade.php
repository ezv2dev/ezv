@extends('layouts.user.list')

@section('content')
    {{-- function get data --}}
    @php
    $list = [];
    foreach ($villa as $item) {
        array_push($list, $item->id_villa);
    }
    @endphp
    {{-- function get data --}}

    <div class="bg-body-black">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12 grid-container-43">
                <!-- Grid 43 -->
                @foreach ($villa->shuffle() as $data)
                    <div class="row list-row-gap">
                        <!-- Left Sedtion -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container">
                            <div class="content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                                <input type="hidden" value="{{ $data->id_villa }}" id="id_villa" name="id_villa">
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                    data-dots="false" data-arrows="true">
                                    @php
                                        $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                                    @endphp
                                    @forelse ($gallery as $item)
                                        <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/gallery/' . strtolower($data->name) . '/' . $item->photo) }}"
                                                alt="EZV_{{ $item->photo }}">
                                        </a>
                                    @empty
                                        @if ($data->image)
                                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->name) . '/' . $data->image) }}"
                                                    alt="">
                                            </a>
                                        @else
                                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}" alt="">
                                            </a>
                                        @endif
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- End Left Section -->
                        <!-- Right Section -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container">
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class=" overlay-desc"></a>
                            <div class="row">
                                <div class="col-lg-9 float-left">
                                    <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                                    <div class="villa-list-title"><span style="margin-right: 4px;">{{ $data->adult }}
                                            Guests</span><span>{{ $data->bedroom }}
                                            Bedroom</span><span>{{ $data->bathroom }} Bath</span><span>2 Parking</span>
                                    </div>
                                    <p class="villa-list-promotion"></p>
                                </div>
                                <div class="col-lg-3 float-left-align-right">
                                    <div class="villa-list-video-container video-show-buttons">
                                        <a type="button" onclick="view_video({{ $data->id_villa }});">
                                            <i class="fas fa-2x fa-play video-button"></i>
                                            <video class="villa-list-video"
                                                src="{{ URL::asset('/foto/gallery/' . strtolower($data->name) . '/' . $data->video) }}#t=0.1"
                                                alt="Best villa in Bali"></video>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-lg-12 villa-list-description-container">
                                    <p class="col-lg-12 villa-list-title">{{ $data->short_description }}</p>
                                </div>
                                <div class="col-lg-12 villa-list-desc-container">
                                    <div class="col-lg-12 villa-list-price">
                                        <span style="color: #ff7400; font-size: 20px;">
                                            IDR {{ number_format($data->price, 0) }} / night
                                        </span>
                                        <span style="color: white; font-size: 12px; margin-left: 8px;">
                                            5.0 Reviews
                                        </span>
                                    </div>
                                    <div class="villa-list-location">
                                        <span style="color: white;">
                                            5 minute to beach
                                        </span>
                                        <span style="color: #ff7400;">
                                            <a style="z-index: 50" href="#!"
                                                onclick="view_maps('{{ $data->id_villa }}')"></i>View Maps</a>
                                        </span>
                                    </div>
                                    {{-- <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p> --}}

                                    {{-- <p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / night</p>
							<p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- End Right Section -->
                    </div>
                    <hr class="list-row-line">
                @endforeach
                <!-- End Grid 43 -->
                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $villa->links('vendor.pagination.bootstrap-4') }}
                </div>
                {{-- End Pagination --}}
            </div>
            <!-- End Refresh Page -->
        </div>
        <!-- End Page Content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
        <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content video-container">
                <div class="nav-video nav-video-prev">
                    <a type="button" id="button_prev" style="display:none">
                        <span><i class="fa fa-chevron-left"></i></span>Prev<br>Villa
                    </a>
                </div>
                <center>
                    <video controls id="video-detail-video" class="video-modal">
                        <source src="" type="video/mp4">
                        Your browser doesn't support HTML5 video tag.
                    </video>
                </center>
                <div class="overlay-social">
                    <div class="row social-share">
                        <div class="col-6 text-center icon-center">
                            <p id="video-detail-favorit"></p>
                        </div>
                        <div class="col-6 text-center icon-center">
                            <p type="button" class="expand" onclick="share()">
                                <i class="fa fa-share" style="font-size: 16px;"></i>
                                <span>SHARE</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="nav-video nav-video-next">
                    <a type="button" id="button_next" style="display:none">
                        Next<br>Villa<span><i class="fa fa-chevron-right"></i></span>
                    </a>
                </div>
                <div class="overlay-desc">
                    <div class="overlay-desc--wrap">
                        <h5><a id="video-detail-title"></a></h5>
                        <!-- Villa Bed Type -->
                        <p><span id="video-detail-bedrooms"></span> Bedroom, <span id="video-detail-bathrooms"></span> Bathroom, <span
                                id="video-detail-bedss"></span>
                            Beds</p>
                        <div class="row fac" style="padding-top: 0">
                            {{-- @php
                                $facilities = App\Http\Controllers\ViewController::amenities();
                            @endphp --}}
                            {{-- @if (!$facilities->isEmpty())
                                @if (count($facilities) >= 3)
                                    @for ($i = 0; $i <= 2; $i++)
                                        <div class="col-1 right-10">
                                            <i class="fa fa-{{ $facilities[$i]->icon }}"></i>
                                        </div>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count($facilities); $i++)
                                        <div class="col-1">
                                            <i class="fa fa-{{ $facilities[$i]->icon }}"></i>
                                        </div>
                                    @endfor
                                @endif
                                <div class="col-1">
                                    <a type="button" class="btn-amenities btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-amenities-{{ $data->id_villa }}">
                                        MORE
                                    </a>
                                </div>
                            @endif --}}
                            <div class="short-desc" id="video-detail-short-description"></div>
                            <!-- End Villa Bed Type -->
                            <div class="vid-address">
                                <i class="fa fa-map-pin"></i> <span id="video-detail-location"></span>
                            </div>
                            {{-- <div class="review-text-vid">
                                @if ($data->person != '' || $data->person != 0)
                                    <span class="reviews">{{ $data->person }} Guest Reviews</span>
                                @else
                                    <span class="reviews">0 Reviews</span>
                                @endif
                            </div> --}}
                        </div>
                    </div>
                @endsection


                @section('scripts')
                    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

                    <!-- MAP MODAL -->
                    <div class="modal fade" id="modal-map" tabindex="-1" role="dialog"
                        aria-labelledby="modal-default-fadein" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content modal-map">
                                <div class="modal-header">
                                    <h5 class="modal-title">Map</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-1" style="height: 500px">
                                    <div id="map12" style="width:100%;height:100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GOOGLE MAPS API --}}
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
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
                                var request = getData(`/villa/map/${id}`).then((data) => {
                                    villaLocations.push([data.name, data.latitude, data.longitude, data.id_villa]);
                                    // console.log(`process ${id}`);
                                });
                                promises.push(request);
                            });

                            $.when.apply(null, promises).done(() => {
                                // console.log('done');
                            });
                        }

                        fetchVillasLocation(list);
                    </script>

                    <script>
                        function view_maps(mapId) {
                            var villa;
                            for (let i = 0; i < villaLocations.length; i++) {
                                if (villaLocations[i][3] == mapId) {
                                    villa = villaLocations[i];
                                    break;
                                }
                            }
                            if (villa != null && villaLocations.length > 0) {
                                // declare map
                                var map = new google.maps.Map(document.getElementById('map12'), {
                                    zoom: 9,
                                    center: new google.maps.LatLng(-8.62, 115.09),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                });

                                // declare info window
                                var infowindow = new google.maps.InfoWindow();

                                var marker, i;

                                marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(villa[1], villa[2]),
                                    map: map
                                });
                                infowindow.setContent(villa[0]);
                                infowindow.open(map, marker);

                                for (i = 0; i < villaLocations.length; i++) {
                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(villaLocations[i][1], villaLocations[i][2]),
                                        map: map
                                    });

                                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                        return function() {
                                            infowindow.setContent(villaLocations[i][0]);
                                            infowindow.open(map, marker);
                                        }
                                    })(marker, i));
                                }
                                $("#modal-map").modal('show');
                            } else {
                                // console.log('data villa is empty, not showing map modal');
                            }
                        }
                    </script>
                    {{-- google maps api --}}

                    {{-- Video --}}
                    {{-- fetch all video data --}}
                    <script>
                        var list = @json($list);
                        var villaVideos = [];
                        var villaVideoDetails;

                        function getData(ajaxurl) {
                            return $.ajax({
                                url: ajaxurl,
                                type: 'GET',
                            });
                        };

                        function fetchVillasVideo(ids) {
                            var promises = [];
                            var data
                            var i = 0;
                            ids.forEach(id => {
                                var request = getData(`/villa-list/video/${id}`).then((data) => {
                                    if(data.name != undefined) {
                                        villaVideos.push(data);
                                        $('.video-show-buttons').eq(i).hide();
                                    }
                                    console.log(`process ${id}`);
                                });
                                promises.push(request);
                                i++;
                            });

                            $.when.apply(null, promises).done(() => {
                                // console.log('done');
                                // console.log(villaVideos);
                            });
                        }

                        fetchVillasVideo(list);
                    </script>

                    {{-- show video from click --}}
                    <script>
                        function view_video(id) {
                            console.log(id);
                            // search & show video
                            var next;
                            var prev;
                            for (let i = 0; i < villaVideos.length; i++) {
                                console.log(villaVideos[i].id_villa, villaVideos[i].id_villa == id);
                                if (villaVideos[i].id_villa == id) {
                                    villaVideoDetails = villaVideos[i];
                                    next = i+1;
                                    prev = i-1;
                                    console.log(villaVideos);
                                    console.log(i, next, prev);
                                    break;
                                }
                            }

                            // prepare next & prev button
                            if(next > (villaVideos.length-1)) {
                                next = 0;
                                var videoNext = villaVideos[next];
                                if(videoNext) {
                                    $('#button_next').show();
                                    $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
                                }
                            } else {
                                var videoNext = villaVideos[next];
                                if(videoNext) {
                                    $('#button_next').show();
                                    $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
                                }
                            }
                            if(prev < 0) {
                                prev = villaVideos.length-1;
                                var videoPrev = villaVideos[prev];
                                if(videoPrev) {
                                    $('#button_prev').show();
                                    $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
                                }
                            } else {
                                var videoPrev = villaVideos[prev];
                                if(videoPrev) {
                                    $('#button_prev').show();
                                    $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
                                }
                            }

                            // show data video
                            if(villaVideoDetails != null) {
                                console.log(villaVideoDetails);
                                var public = '/foto/gallery/';
                                var slash = '/';
                                var name = villaVideoDetails.name.toLowerCase();
                                var src = public + name + slash + villaVideoDetails.video.name;
                                // console.log(src);
                                $('#video-detail-video').attr('src', src);

                                $('#video-detail-title').text(villaVideoDetails.name);
                                $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/villa/${villaVideoDetails.id_villa}`);
                                $('#video-detail-bedrooms').text(villaVideoDetails.bedroom);
                                $('#video-detail-bathrooms').text(villaVideoDetails.bathroom);
                                $('#video-detail-bedss').text(villaVideoDetails.beds);
                                $('#video-detail-short-description').text(villaVideoDetails.short_description);
                                $('#video-detail-location').text(villaVideoDetails.location.name);
                                if(villaVideoDetails.is_favorit) {
                                    $('#video-detail-favorit').html(
                                        `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                                    );
                                } else {
                                    $('#video-detail-favorit').html(
                                        `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
                                        </a>`
                                    );
                                }

                                $('#videomodal').modal('show');
                            } else {
                                console.log('data video is empty, not showing video modal');
                            }
                        }
                    </script>

                    {{-- show next & prev video --}}
                    <script>
                        function next_video(id) {
                            // search & show video
                            console.log(id);
                            var next;
                            var prev;
                            for (let i = 0; i < villaVideos.length; i++) {
                                console.log(villaVideos[i].id_villa, villaVideos[i].id_villa == id);
                                if (villaVideos[i].id_villa == id) {
                                    villaVideoDetails = villaVideos[i];
                                    next = i+1;
                                    prev = i-1;
                                    break;
                                }
                            }
                            console.log(villaVideoDetails);

                            // prepare next & prev button
                            if(next > (villaVideos.length-1)) {
                                next = 0;
                                var videoNext = villaVideos[next];
                                if(videoNext) {
                                    $('#button_next').show();
                                    $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
                                }
                            } else {
                                var videoNext = villaVideos[next];
                                if(videoNext) {
                                    $('#button_next').show();
                                    $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
                                }
                            }
                            if(prev < 0) {
                                prev = villaVideos.length-1;
                                var videoPrev = villaVideos[prev];
                                if(videoPrev) {
                                    $('#button_prev').show();
                                    $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
                                }
                            } else {
                                var videoPrev = villaVideos[prev];
                                if(videoPrev) {
                                    $('#button_prev').show();
                                    $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
                                }
                            }

                            // show data video
                            if(villaVideoDetails != null) {
                                console.log(villaVideoDetails);
                                var public = '/foto/gallery/';
                                var slash = '/';
                                var name = villaVideoDetails.name.toLowerCase();
                                var src = public + name + slash + villaVideoDetails.video.name;
                                // console.log(src);
                                $('#video-detail-video').attr('src', src);

                                $('#video-detail-title').text(villaVideoDetails.name);
                                $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/villa/${villaVideoDetails.id_villa}`);
                                $('#video-detail-bedrooms').text(villaVideoDetails.bedroom);
                                $('#video-detail-bathrooms').text(villaVideoDetails.bathroom);
                                $('#video-detail-bedss').text(villaVideoDetails.beds);
                                $('#video-detail-short-description').text(villaVideoDetails.short_description);
                                $('#video-detail-location').text(villaVideoDetails.location.name);
                                if(villaVideoDetails.is_favorit) {
                                    $('#video-detail-favorit').html(
                                        `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                                    );
                                } else {
                                    $('#video-detail-favorit').html(
                                        `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
                                        </a>`
                                    );
                                }
                            } else {
                                console.log('data video is empty, not showing video modal');
                            }
                        }
                    </script>

                    {{-- <script>
                        function view(id) {
                            var list = @json($list);
                            var now = list.indexOf(id);
                            var next = list[now += 1];
                            var prev = list[now -= 2];
                            console.log(prev);
                            document.getElementById('button_next').setAttribute('onclick', 'next_villa(' + next + ')');
                            document.getElementById('button_prev').setAttribute('onclick', 'next_villa(' + prev + ')');
                            $.ajax({
                                type: "GET",
                                url: "/villa-list/video/" + id,
                                dataType: "JSON",
                                success: function(data) {
                                    var video = document.getElementById('video1');
                                    var public = '/foto/gallery/';
                                    var slash = '/';
                                    var name = data[0].name;
                                    var lowerCaseName = name.toLowerCase();
                                    var location = data[0].location;
                                    var short = data[0].short;
                                    video.src = public + lowerCaseName + slash + data[0].video;
                                    video.load();
                                    video.play();
                                    $("#title").html(name);
                                    $('#alocation').html(location);
                                    $('#short').html(short);
                                    $('#bedrooms').html(data[0].bedroom);
                                    $('#bathrooms').html(data[0].bathroom);
                                    $('#bedss').html(data[0].beds);
                                    $('#id_villas').html(data[0].id_villas);
                                    $('#test2').append(`<?php $key = array_search('${data[0]}', $list);
                                    echo $key; ?>`)
                                    $('#videomodal').modal('show');
                                }
                            });
                        }

                        function next_villa(id) {
                            var list = @json($list);
                            var now = list.indexOf(id);
                            var next = list[now += 1];
                            var prev = list[now -= 2];
                            document.getElementById('button_next').setAttribute('onclick', 'next_villa(' + next + ')');
                            document.getElementById('button_prev').setAttribute('onclick', 'next_villa(' + prev + ')');
                            $.ajax({
                                type: "GET",
                                url: "/villa-list/video/" + id,
                                dataType: "JSON",
                                success: function(data) {
                                    var video = document.getElementById('video1');
                                    var public = '/foto/gallery/';
                                    var slash = '/';
                                    var name = data[0].name;
                                    var lowerCaseName = name.toLowerCase();
                                    var location = data[0].location;
                                    var short = data[0].short;
                                    video.src = public + lowerCaseName + slash + data[0].video;
                                    video.load();
                                    video.play();
                                    $("#title").html(name);
                                    $('#alocation').html(location);
                                    $('#short').html(short);
                                    $('#bedrooms').html(data[0].bedroom);
                                    $('#bathrooms').html(data[0].bathroom);
                                    $('#bedss').html(data[0].beds);
                                    $('#id_villas').html(data[0].id_villas);
                                    $('#videomodal').modal('show');
                                }
                            });
                        }

                        $(function() {
                            $('#videomodal').modal({
                                show: false
                            }).on('hidden.bs.modal', function() {
                                $(this).find('video')[0].pause();
                            });
                        });
                    </script> --}}
                    {{-- <script>
                        function view(id) {
                            var list = @json($list);
                            var now = list.indexOf(id);
                            var next = list[now += 1];
                            var prev = list[now -= 2];
                            console.log(prev);
                            document.getElementById('button_next').setAttribute('onclick', 'next_villa(' + next + ')');
                            document.getElementById('button_prev').setAttribute('onclick', 'next_villa(' + prev + ')');
                            $.ajax({
                                type: "GET",
                                url: "/villa-list/video/" + id,
                                dataType: "JSON",
                                success: function(data) {
                                    var video = document.getElementById('video1');
                                    var public = '/foto/gallery/';
                                    var slash = '/';
                                    var name = data[0].name;
                                    var lowerCaseName = name.toLowerCase();
                                    var location = data[0].location;
                                    var short = data[0].short;
                                    video.src = public + lowerCaseName + slash + data[0].video;
                                    video.load();
                                    video.play();
                                    $("#title").html(name);
                                    $('#alocation').html(location);
                                    $('#short').html(short);
                                    $('#bedrooms').html(data[0].bedroom);
                                    $('#bathrooms').html(data[0].bathroom);
                                    $('#bedss').html(data[0].beds);
                                    $('#id_villas').html(data[0].id_villas);
                                    $('#test2').append(`<?php $key = array_search('${data[0]}', $list);
                                    echo $key; ?>`)
                                    $('#videomodal').modal('show');
                                }
                            });
                        }

                        function next_villa(id) {
                            var list = @json($list);
                            var now = list.indexOf(id);
                            var next = list[now += 1];
                            var prev = list[now -= 2];
                            document.getElementById('button_next').setAttribute('onclick', 'next_villa(' + next + ')');
                            document.getElementById('button_prev').setAttribute('onclick', 'next_villa(' + prev + ')');
                            $.ajax({
                                type: "GET",
                                url: "/villa-list/video/" + id,
                                dataType: "JSON",
                                success: function(data) {
                                    var video = document.getElementById('video1');
                                    var public = '/foto/gallery/';
                                    var slash = '/';
                                    var name = data[0].name;
                                    var lowerCaseName = name.toLowerCase();
                                    var location = data[0].location;
                                    var short = data[0].short;
                                    video.src = public + lowerCaseName + slash + data[0].video;
                                    video.load();
                                    video.play();
                                    $("#title").html(name);
                                    $('#alocation').html(location);
                                    $('#short').html(short);
                                    $('#bedrooms').html(data[0].bedroom);
                                    $('#bathrooms').html(data[0].bathroom);
                                    $('#bedss').html(data[0].beds);
                                    $('#id_villas').html(data[0].id_villas);
                                    $('#videomodal').modal('show');
                                }
                            });
                        }

                        $(function() {
                            $('#videomodal').modal({
                                show: false
                            }).on('hidden.bs.modal', function() {
                                $(this).find('video')[0].pause();
                            });
                        });
                    </script> --}}

                    {{-- Search --}}
                    <script>
                        $(document).ready(function() {
                            $(".drop-down").hover(function() {
                                $('.mega-menu').addClass('display-on');
                            });
                            $(".drop-down").mouseleave(function() {
                                $('.mega-menu').removeClass('display-on');
                            });

                            $(".drop-down2").hover(function() {
                                $('.mega-menu2').addClass('display-on');
                            });
                            $(".drop-down2").mouseleave(function() {
                                $('.mega-menu2').removeClass('display-on');
                            });

                            $(".drop-down3").hover(function() {
                                $('.mega-menu3').addClass('display-on');
                            });
                            $(".drop-down3").mouseleave(function() {
                                $('.mega-menu3').removeClass('display-on');
                            });

                            $(".drop-down4").hover(function() {
                                $('.mega-menu4').addClass('display-on');
                            });
                            $(".drop-down4").mouseleave(function() {
                                $('.mega-menu4').removeClass('display-on');
                            });

                            $(".drop-down5").hover(function() {
                                $('.mega-menu5').addClass('display-on');
                            });
                            $(".drop-down5").mouseleave(function() {
                                $('.mega-menu5').removeClass('display-on');
                            });

                        });
                    </script>
                @endsection
