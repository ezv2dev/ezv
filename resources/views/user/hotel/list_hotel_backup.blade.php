@extends('layouts.user.list')

@section('content')
    {{-- function get data --}}

    @php
    $hotels = $hotel->shuffle();
    $list = [];
    foreach ($hotels as $item) {
        array_push($list, $item->id_hotel);
    }
    @endphp

    {{-- function get data --}}

    <div id="body-color" class="bg-body-black">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12 grid-container-43">
                <!-- Grid 43 -->
                @foreach ($hotels as $data)
                    <div class="row list-row-gap">
                        <!-- Left Sedtion -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-image-container">
                            <div class="content list-image-content">
                                <input type="hidden" value="{{ $data->id_hotel }}" id="id_hotel" name="id_hotel">
                                <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                    data-dots="false" data-arrows="true">
                                    @php
                                        // $gallery = App\Http\Controllers\ViewController::gallery($data->id_hotel);
                                    @endphp
                                    {{-- @forelse ($gallery as $item) --}}
                                    {{-- <a href="{{ route('villa', $data->id_villa) }}" target="_blank" --}}
                                    {{-- <a href="#" target="_blank"
                                class="col-lg-6 grid-image-container">
                                <img class="img-fluid grid-image" style="display: block;"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->name) . '/' . $item->photo) }}"
                                    alt="EZV_{{ $item->photo }}">
                            </a>
                            @empty --}}
                                    {{-- @if ($data->image)
                                        <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/hotel/' . strtolower($data->name) . '/' . $data->image) }}"
                                                alt="EZV_{{ $data->image }}">
                                        </a>
                                    @else
                                        <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/default/no-image.jpeg') }}" alt="EZV_no-image.jpeg">
                                        </a>
                                    @endif --}}
                                    {{-- @endforelse --}}

                                    @forelse ($data->photo->sortBy('order') as $item)
                                        <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/hotel/' . strtolower($data->name) . '/' . $item->name) }}"
                                                alt="EZV_{{ $data->name }}">
                                        </a>
                                    @empty
                                        @if ($data->image)
                                            <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/hotel/' . strtolower($data->name) . '/' . $data->image) }}"
                                                    alt="EZV_{{ $data->image }}">
                                            </a>
                                        @else
                                            <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}" alt="EZV_no-image.jpeg">
                                            </a>
                                        @endif
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- End Left Section -->
                        <!-- Right Section -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-desc-container">
                            <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank" class=" overlay-desc"></a>
                            <div class="row">
                                <div class="col-lg-9 float-left">
                                    <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                                    <div class="villa-list-title"><span class="list-description font-light"
                                            style="margin-right: 4px;">{{ $data->adult }}
                                            Guests</span><span class="list-description font-light">{{ $data->bedroom }}
                                            Bedroom</span><span
                                            class="list-description font-light">{{ $data->bathroom }} Bath</span><span
                                            class="list-description font-light">2 Parking</span>
                                    </div>
                                    <p class="villa-list-promotion"></p>
                                </div>
                                <div class="col-lg-3 float-left-align-right">
                                    <div class="villa-list-video-container video-show-buttons"
                                        onclick="view_video({{ $data->id_hotel }});">
                                        <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank">
                                            <i class="fas fa-2x fa-play video-button"></i>
                                            {{-- @if ($data->video->count() > 0)
                                                <video class="villa-list-video" src="{{ URL::asset('/foto/hotel/'.$data->uid.'/'.$data->video->last()->name) }}#t=1.0"></video>
                                            @elseif ($data->photo->count() > 0)
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/hotel/'.$data->uid.'/'.$data->photo->last()->name) }}">
                                            @elseif ($data->image != null)
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/hotel/'.$data->uid.'/'.$data->image) }}">
                                            @else
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                            @endif --}}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-12 villa-list-description-container">
                                    <p class="col-lg-12 villa-list-title font-light list-description">
                                        {{ $data->short_description }}</p>
                                </div>
                                <div class="col-lg-12 villa-list-desc-container">
                                    <div class="col-lg-12 villa-list-price">
                                        <span class="villa-list-price">
                                            IDR {{ number_format($data->price, 0, ',', '.') }} / night
                                        </span>
                                        <span class="font-light list-description"
                                            style="padding-left: 6px; font-size: 12px;">
                                            @if ($data->detailReview)
                                                {{ $data->detailReview->average }} Reviews
                                            @else
                                                there is no reviews yet
                                            @endif
                                        </span>
                                    </div>
                                    <div class="villa-list-location">
                                        <span class="font-light list-description">
                                            {{ number_format($data->time) }} minute to {{ $data->activity }}
                                        </span>
                                        <span style="color: #ff7400;">
                                            <a class="orange-hover" href="#!"
                                                onclick="view_maps('{{ $data->id_hotel }}')"></i>View Maps</a>
                                        </span>
                                    </div>
                                    {{-- <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p> --}}



                                    {{-- <p class="villa-list-location">Villa | <i
                                    class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                                    href="javascript.void(0)" data-bs-toggle="modal"
                                    data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5
                                minute to beach</p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- End Right Section -->
                    </div>
                    <hr class="list-row row-line-white">
                @endforeach
                <!-- End Grid 43 -->
                {{-- Pagination --}}
                {{-- <div class="mt-5 d-flex justify-content-center">
                {{ $villa->links('vendor.pagination.bootstrap-4') }}
            </div> --}}
                {{-- End Pagination --}}
            </div>
            <!-- End Refresh Page -->
        </div>
        <!-- End Page Content -->
        {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        {{-- modal laguage and currency --}}
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
            @endsection


            @section('scripts')
                <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

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
                        $('.video-show-buttons').hide();
                        for (let i = 0; i < ids.length; i++) {
                            var request = getData(`/villa/video/${ids[i]}`).then((data) => {
                                // console.log(i);
                                if (data.name != undefined) {
                                    villaVideos.push(data);
                                    $('.video-show-buttons').eq(i).show();
                                    $('.video-show-buttons').eq(i).append(
                                        `<video class="villa-list-video"
                                                src="{{ URL::asset('/foto/gallery/${data.name.toLowerCase()}/${data.video.name}') }}#t=0.1"
                                                alt="Best villa in Bali"></video>`
                                    );
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
                            var name = villaVideoDetails.name.toLowerCase();
                            var src = public + name + slash + villaVideoDetails.video.name;
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
                            var name = villaVideoDetails.name.toLowerCase();
                            var src = public + name + slash + villaVideoDetails.video.name;
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
                {{-- END SHOW VIDEO --}}

                {{-- SEARCH FUNCTION --}}
                <script>
                    function villaRefreshFilter(suburl) {
                        window.location.href = `{{ env('APP_URL') }}/searchvillacombine?${suburl}`;
                    }
                </script>

                <script>
                    function villaFilter() {
                        var fMaxPriceFormInput = [];
                        $("input[name='fMaxPrice[]']").each(function() {
                            fMaxPriceFormInput.push(parseInt($(this).val()));
                        });

                        var fMinPriceFormInput = [];
                        $("input[name='fMinPrice[]']").each(function() {
                            fMinPriceFormInput.push(parseInt($(this).val()));
                        });

                        var fPropertyFormInput = [];
                        $("input[name='fProperty[]']:checked").each(function() {
                            fPropertyFormInput.push(parseInt($(this).val()));
                        });

                        var fBedroomFormInput = [];
                        $("input[name='fBedroom[]']").each(function() {
                            fBedroomFormInput.push(parseInt($(this).val()));
                        });

                        var fBathroomFormInput = [];
                        $("input[name='fBathroom[]']").each(function() {
                            fBathroomFormInput.push(parseInt($(this).val()));
                        });

                        var fBedsFormInput = [];
                        $("input[name='fBeds[]']").each(function() {
                            fBedsFormInput.push(parseInt($(this).val()));
                        });

                        var fFacilitiesFormInput = [];
                        $("input[name='fFacilities[]']:checked").each(function() {
                            fFacilitiesFormInput.push(parseInt($(this).val()));
                        });

                        var fSuitableFormInput = [];
                        $("input[name='fSuitable[]']:checked").each(function() {
                            fSuitableFormInput.push(parseInt($(this).val()));
                        });

                        var sLocationFormInput = $("input[name='sLocation']").val();

                        var sCheck_inFormInput = $("input[name='sCheck_in']").val();

                        var sCheck_outFormInput = $("input[name='sCheck_out']").val();

                        var sAdultFormInput = $("input[name='sAdult']").val();

                        var sChildFormInput = $("input[name='sChild']").val();

                        var subUrl =
                            `fMaxPrice=${fMaxPriceFormInput}&fMinPrice=${fMinPriceFormInput}&fProperty=${fPropertyFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fFacilities=${fFacilitiesFormInput}&fSuitable=${fSuitableFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
                        villaRefreshFilter(subUrl);
                    }
                </script>
                {{-- END SEARCH FUNCTION --}}

                {{-- MAP --}}
                @include('user.modal.hotel.list.map')
                {{-- END MAP --}}
            @endsection
