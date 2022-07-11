{{-- SHOW VIDEO --}}
<div class="modal fade" id="videomodal" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;">
    <button type="button" class="btn-close btn-hidden" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content video-container">
            <div class="nav-video nav-video-prev">
                <a type="button" id="button_prev" style="display:none">
                    <span><i class="fa fa-chevron-left"></i></span>Prev<br>
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
                    <div class="col-12 text-center icon-center">
                        <p id="video-detail-favorit"></p>
                    </div>
                    {{-- <div class="col-6 text-center icon-center">
                            <p type="button" class="expand" onclick="share()">
                                <i class="fa fa-share" style="font-size: 16px;"></i>
                                <span>SHARE</span>
                            </p>
                        </div> --}}
                </div>
            </div>

            <div class="nav-video nav-video-next">
                <a type="button" id="button_next" style="display:none">
                    Next<br><span><i class="fa fa-chevron-right"></i></span>
                </a>
            </div>
            <div class="overlay-desc video-modal-desc">
                <div class="overlay-desc--wrap">
                    <h5><a id="video-detail-title"></a></h5>
                    <!-- Villa Bed Type -->
                    <p class="text-white" id="video-detail-cuisine"></p>
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
                    @for ($i = 0; $i < count($facilities); $i++) <div class="col-1">
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
</div>

{{-- fetch all video data --}}
<script>
    var list = @json($list);
    var restaurantVideos = [];
    var restaurantVideoDetails;

    function getData(ajaxurl) {
        return $.ajax({
            url: ajaxurl,
            type: 'GET',
        });
    };

    function fetchVillasVideo(ids) {
        var promises = [];
        var data
        // $('.video-show-buttons').hide();
        for (let i = 0; i < ids.length; i++) {
            var request = getData(`/restaurant/video/${ids[i]}`).then((data) => {
                // console.log(i);
                if (data.name != undefined) {
                    restaurantVideos.push(data);
                    // $('.video-show-buttons').eq(i).show();
                    // $('.video-show-buttons').eq(i).append(
                    //     `<video class="villa-list-video"
                    //                             src="{{ URL::asset('/foto/restaurant/${data.uid.toLowerCase()}/${data.video.name}') }}#t=0.1"
                    //                             alt="Best restaurant in Bali"></video>`
                    // );
                }
                // console.log(`process ${ids[i]}`);
            });
            promises.push(request);
        }

        $.when.apply(null, promises).done(() => {
            // console.log('done');
            // console.log(restaurantVideos);
        });
    }

    fetchVillasVideo(list);
</script>

{{-- show video from click --}}
<script>
    function view_video(id) {
        // console.log(id);
        // search & show video
        var next;
        var prev;
        for (let i = 0; i < restaurantVideos.length; i++) {
            // console.log(restaurantVideos[i].id_restaurant, restaurantVideos[i].id_restaurant == id);
            if (restaurantVideos[i].id_restaurant == id) {
                restaurantVideoDetails = restaurantVideos[i];
                next = i + 1;
                prev = i - 1;
                // console.log(restaurantVideos);
                // console.log(i, next, prev);
                break;
            }
        }

        // prepare next & prev button
        if (next > (restaurantVideos.length - 1)) {
            next = 0;
            var videoNext = restaurantVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_restaurant + ')');
            }
        } else {
            var videoNext = restaurantVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_restaurant + ')');
            }
        }
        if (prev < 0) {
            prev = restaurantVideos.length - 1;
            var videoPrev = restaurantVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_restaurant + ')');
            }
        } else {
            var videoPrev = restaurantVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_restaurant + ')');
            }
        }

        // show data video
        if (restaurantVideoDetails != null) {
            // console.log(restaurantVideoDetails);
            var public = '/foto/restaurant/';
            var slash = '/';
            var uid = restaurantVideoDetails.uid.toLowerCase();
            var src = public + uid + slash + restaurantVideoDetails.video.name;
            // console.log(src);
            $('#video-detail-video').attr('src', src);
            var price = 0;
            if (restaurantVideoDetails.price > 0) {
                price = restaurantVideoDetails.price;
            }
            $('#video-detail-title').text(restaurantVideoDetails.name);
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/restaurant/${restaurantVideoDetails.id_restaurant}`);
            if(restaurantVideoDetails.cuisine.length != 0) {
                $('#video-detail-cuisine').text('');
                restaurantVideoDetails.cuisine.forEach(cuisine => {
                    $('#video-detail-cuisine').append(`<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">`+ cuisine.name +"</span> ");
                });
            } else {
                $('#video-detail-cuisine').text('');
                $('#video-detail-cuisine').text('there is no cuisine yet');
            }
            $('#video-detail-short-description').text(restaurantVideoDetails.short_description);
            $('#video-detail-location').text(restaurantVideoDetails.location.name);
            if (restaurantVideoDetails.is_favorit) {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/restaurant/favorit/${restaurantVideoDetails.id_restaurant}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                );
            } else {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/restaurant/favorit/${restaurantVideoDetails.id_restaurant}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
                                        </a>`
                );
            }
            $('#video-detail-video').get(0).load();
            $('#video-detail-video').get(0).play();
            $('#videomodal').modal('show');
        } else {
            // console.log('data video is empty, not showing video modal');
        }
    }

</script>

{{-- show next & prev video --}}
<script>
    function next_video(id) {
        // search & show video
        var next;
        var prev;
        for (let i = 0; i < restaurantVideos.length; i++) {
            // console.log(restaurantVideos[i].id_restaurant, restaurantVideos[i].id_restaurant == id);
            if (restaurantVideos[i].id_restaurant == id) {
                restaurantVideoDetails = restaurantVideos[i];
                next = i + 1;
                prev = i - 1;
                break;
            }
        }
        // console.log(restaurantVideoDetails);

        // prepare next & prev button
        if (next > (restaurantVideos.length - 1)) {
            next = 0;
            var videoNext = restaurantVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_restaurant + ')');
            }
        } else {
            var videoNext = restaurantVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_restaurant + ')');
            }
        }
        if (prev < 0) {
            prev = restaurantVideos.length - 1;
            var videoPrev = restaurantVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_restaurant + ')');
            }
        } else {
            var videoPrev = restaurantVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_restaurant + ')');
            }
        }

        // show data video
        if (restaurantVideoDetails != null) {
            // console.log(restaurantVideoDetails);
            var public = '/foto/restaurant/';
            var slash = '/';
            var name = restaurantVideoDetails.name.toLowerCase();
            var src = public + name + slash + restaurantVideoDetails.video.name;
            // console.log(src);
            $('#video-detail-video').attr('src', src);
            var price = 0;
            if (restaurantVideoDetails.price > 0) {
                price = restaurantVideoDetails.price;
            }
            $('#video-detail-title').text(restaurantVideoDetails.name);
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/restaurant/${restaurantVideoDetails.id_restaurant}`);
            if(restaurantVideoDetails.cuisine.length != 0) {
                $('#video-detail-cuisine').text('');
                restaurantVideoDetails.cuisine.forEach(cuisine => {
                    $('#video-detail-cuisine').append(`<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">`+ cuisine.name +"</span> ");
                });
            } else {
                $('#video-detail-cuisine').text('');
                $('#video-detail-cuisine').append('there is no cuisine yet');
            }
            $('#video-detail-short-description').text(restaurantVideoDetails.short_description);
            $('#video-detail-location').text(restaurantVideoDetails.location.name);
            if (restaurantVideoDetails.is_favorit) {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/restaurant/favorit/${restaurantVideoDetails.id_restaurant}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                );
            } else {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/restaurant/favorit/${restaurantVideoDetails.id_restaurant}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
                                            <span style="color: #aaa;">FAVORIT</span>
                                        </a>`
                );
            }

            $('#video-detail-video').get(0).load();
            $('#video-detail-video').get(0).play();
        } else {
            // console.log('data video is empty, not showing video modal');
        }
    }

</script>
{{-- END SHOW VIDEO --}}
