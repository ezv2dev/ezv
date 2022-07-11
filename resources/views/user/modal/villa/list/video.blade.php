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
                    Next<br>Villa<span><i class="fa fa-chevron-right"></i></span>
                </a>
            </div>
            <div class="overlay-desc video-modal-desc">
                <div class="overlay-desc--wrap">
                    <h5><a id="video-detail-title"></a></h5>
                    <!-- Villa Bed Type -->
                    <p><span id="video-detail-bedrooms"></span> Bedroom, <span id="video-detail-bathrooms"></span>
                        Bathroom, <span id="video-detail-bedss"></span>
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
                <div class="text-white" id="video-detail-price">IDR 999,999/night</div>
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

{{-- SHOW VIDEO --}}
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
        // $('.video-show-buttons').hide();
        for (let i = 0; i < ids.length; i++) {
            var request = getData(`/villa/video/${ids[i]}`).then((data) => {
                // console.log(i);
                if (data.name != undefined) {
                    villaVideos.push(data);
                    // $('.video-show-buttons').eq(i).show();
                    // $('.video-show-buttons').eq(i).append(
                    //     `<video class="villa-list-video"
                    //                             src="{{ URL::asset('/foto/gallery/${data.uid.toLowerCase()}/${data.video.name}') }}#t=0.1"
                    //                             alt="Best villa in Bali"></video>`
                    // );
                }
                // console.log(`process ${ids[i]}`);
            });
            promises.push(request);
        }

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
        // console.log(id);
        // search & show video
        var next;
        var prev;
        for (let i = 0; i < villaVideos.length; i++) {
            // console.log(villaVideos[i].id_villa, villaVideos[i].id_villa == id);
            if (villaVideos[i].id_villa == id) {
                villaVideoDetails = villaVideos[i];
                next = i + 1;
                prev = i - 1;
                // console.log(villaVideos);
                // console.log(i, next, prev);
                break;
            }
        }

        // prepare next & prev button
        if (next > (villaVideos.length - 1)) {
            next = 0;
            var videoNext = villaVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
            }
        } else {
            var videoNext = villaVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
            }
        }
        if (prev < 0) {
            prev = villaVideos.length - 1;
            var videoPrev = villaVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
            }
        } else {
            var videoPrev = villaVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
            }
        }

        // show data video
        if (villaVideoDetails != null) {
            // console.log(villaVideoDetails);
            var public = '/foto/gallery/';
            var slash = '/';
            var uid = villaVideoDetails.uid.toLowerCase();
            var src = public + uid + slash + villaVideoDetails.video.name;
            // console.log(src);
            $('#video-detail-video').attr('src', src);
            var price = 0;
            if (villaVideoDetails.price > 0) {
                price = villaVideoDetails.price;
            }
            $('#video-detail-title').text(villaVideoDetails.name);
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/villa/${villaVideoDetails.id_villa}`);
            $('#video-detail-bedrooms').text(villaVideoDetails.bedroom);
            $('#video-detail-bathrooms').text(villaVideoDetails.bathroom);
            $('#video-detail-bedss').text(villaVideoDetails.beds);
            $('#video-detail-price').text(`IDR ${price.toLocaleString()}/night`);
            $('#video-detail-short-description').text(villaVideoDetails.short_description);
            $('#video-detail-location').text(villaVideoDetails.location.name);
            if (villaVideoDetails.is_favorit) {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                );
            } else {
                $('#video-detail-favorit').html(
                    `<a href="{{ env('APP_URL') }}/villa/favorit/${villaVideoDetails.id_villa}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
                                            <span style="color: #aaa;">FAVORITE</span>
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
        for (let i = 0; i < villaVideos.length; i++) {
            // console.log(villaVideos[i].id_villa, villaVideos[i].id_villa == id);
            if (villaVideos[i].id_villa == id) {
                villaVideoDetails = villaVideos[i];
                next = i + 1;
                prev = i - 1;
                break;
            }
        }
        // console.log(villaVideoDetails);

        // prepare next & prev button
        if (next > (villaVideos.length - 1)) {
            next = 0;
            var videoNext = villaVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
            }
        } else {
            var videoNext = villaVideos[next];
            if (videoNext) {
                $('#button_next').show();
                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_villa + ')');
            }
        }
        if (prev < 0) {
            prev = villaVideos.length - 1;
            var videoPrev = villaVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
            }
        } else {
            var videoPrev = villaVideos[prev];
            if (videoPrev) {
                $('#button_prev').show();
                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_villa + ')');
            }
        }

        // show data video
        if (villaVideoDetails != null) {
            // console.log(villaVideoDetails);
            var public = '/foto/gallery/';
            var slash = '/';
            var uid = villaVideoDetails.uid.toLowerCase();
            var src = public + uid + slash + villaVideoDetails.video.name;
            // console.log(src);
            $('#video-detail-video').attr('src', src);
            var price = 0;
            if (villaVideoDetails.price > 0) {
                price = villaVideoDetails.price;
            }
            $('#video-detail-title').text(villaVideoDetails.name);
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/villa/${villaVideoDetails.id_villa}`);
            $('#video-detail-bedrooms').text(villaVideoDetails.bedroom);
            $('#video-detail-bathrooms').text(villaVideoDetails.bathroom);
            $('#video-detail-bedss').text(villaVideoDetails.beds);
            $('#video-detail-price').text(`IDR ${price.toLocaleString()}/night`);
            $('#video-detail-short-description').text(villaVideoDetails.short_description);
            $('#video-detail-location').text(villaVideoDetails.location.name);
            if (villaVideoDetails.is_favorit) {
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

            $('#video-detail-video').get(0).load();
            $('#video-detail-video').get(0).play();
        } else {
            // console.log('data video is empty, not showing video modal');
        }
    }

</script>
{{-- END SHOW VIDEO --}}
