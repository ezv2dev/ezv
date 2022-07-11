@extends('layouts.user.list')

@section('content')
    {{-- function get data --}}
    @php
    $activitys = $activity->shuffle();
    $list = [];
    foreach ($activitys as $item) {
        array_push($list, $item->id_activity);
    }
    @endphp
    {{-- function get data --}}

    <div id="body-color" class="bg-body-black">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12 grid-container-43">
                <!-- Grid 43 -->
                @foreach ($activitys as $data)
                    <div class="row list-row-gap">
                        <!-- Left Sedtion -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-image-container">
                            <div class="content list-image-content"
                                style="margin: 0; padding: 0; max-width: 1200px !important;">
                                <input type="hidden" value="{{ $data->id_activity }}" id="id_activity" name="id_activity">
                                <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                    data-dots="false" data-arrows="true">
                                    @forelse ($data->photo->sortBy('order') as $item)
                                        <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/activity/' . strtolower($data->name) . '/' . $item->name) }}"
                                                alt="EZV_{{ $item->name }}">
                                        </a>
                                    @empty
                                        @if ($data->image)
                                            <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/activity/' . strtolower($data->name) . '/' . $data->image) }}"
                                                    alt="">
                                            </a>
                                        @else
                                            <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
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
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-desc-container">
                            <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                class=" overlay-desc"></a>
                            <div class="row">
                                <div class="col-lg-9 float-left">
                                    <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                                    {{-- <div class="villa-list-title">
                                <span style="margin-right: 4px;">{{ $data->adult }} Guests</span>
                                <span>{{ $data->bedroom }} Bedroom</span>
                                <span>{{ $data->bathroom }} Bath</span>
                                <span>2 Parking</span>
                            </div> --}}
                                    <div class="villa-list-title font-light list-description">
                                        {{-- <span class="font-light list-description" style="margin-right: 4px;">test</span> --}}
                                        @forelse ($data->facilities as $facilities)
                                            <span class="font-light list-description">{{ $facilities->name }}</span>
                                        @empty
                                            there is no facilities yet
                                        @endforelse
                                    </div>
                                    <p class="villa-list-promotion"></p>
                                </div>
                                <div class="col-lg-3 float-left-align-right">
                                    <div class="villa-list-video-container video-show-buttons"
                                        onclick="view_video({{ $data->id_activity }});">
                                        <a href="{{ route('activity', $data->id_activity) }}" target="_blank">
                                            <i class="fas fa-2x fa-play video-button"></i>
                                            @if ($data->video->count() > 0)
                                                <video class="villa-list-video" src="{{ URL::asset('/foto/activity/'.$data->uid.'/'.$data->video->last()->name) }}#t=1.0"></video>
                                            @elseif ($data->photo->count() > 0)
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/activity/'.$data->uid.'/'.$data->photo->last()->name) }}">
                                            @elseif ($data->image != null)
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/activity/'.$data->uid.'/'.$data->image) }}">
                                            @else
                                                <img class="villa-list-video" src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                            @endif
                                        </a>
                                    </div>

                                </div>
                                <div class="col-lg-12 villa-list-description-container">
                                    <p class="col-lg-12 villa-list-title font-light list-description">{{ $data->short_description }}</p>
                                </div>
                                <div class="col-lg-12 villa-list-desc-container">
                                    <div class="col-lg-12 villa-list-price">
                                        {{-- <span style="color: #ff7400; font-size: 20px;">
									IDR {{ number_format($data->price, 0) }} / night
								</span> --}}
                                        <span class="font-light list-description" style="font-size: 12px;">
                                            @if ($data->detailReview)
                                                <i class="fa-solid fa-star" style="color: #ff7400"></i>
                                                {{ $data->detailReview->average }} Reviews
                                            @else
                                                there is no reviews yet
                                            @endif

                                        </span>
                                    </div>
                                    <div class="villa-list-location">
                                        <span class="font-light list-description">
                                            {{ number_format($data->time) }} minutes to {{ $data->villa }}
                                        </span>
                                        <span style="color: #ff7400;">
                                            <a class="orange-hover" href="#!"
                                                onclick="view_maps(`{{ $data->id_activity }}`)"><i
                                                    class="fa-solid fa-location-dot margin-right-5px"></i>View Maps</a>
                                        </span>
                                    </div>
                                    {{-- <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_activity}}">{{ $data->location_name }}</a> | 5 minute to beach</p> --}}

                                    {{-- <p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / night</p>
							<p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_activity}}">{{ $data->location_name }}</a> | 5 minute to beach</p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- End Right Section -->
                    </div>
                    <hr class="list-row row-line-white">
                @endforeach
                <!-- End Grid 43 -->
                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $activity->links('vendor.pagination.bootstrap-4') }}
                </div>
                {{-- End Pagination --}}
            </div>
            <!-- End Refresh Page -->
        </div>
        <!-- End Page Content -->
    </div>
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    {{-- modal laguage and currency --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

    <script>
        $('#date_things').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            mode: "range",
            showMonths: 2,
            onChange: function(selectedDates, dateStr, instance) {
                $('#date_things').val(flatpickr.formatDate("Y-m-d"));
            }
        });
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

    {{-- ACTIVITY FILTER --}}
    <script>
        function activityRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/things-to-do/s?${suburl}`;
        }
    </script>
    <script>
        function activityFilter() {
            var fCategoryFormInput = [];
            $("input[name='fCategory[]']:checked").each(function() {
                fCategoryFormInput.push(parseInt($(this).val()));
            });
            // console.log(fCategoryFormInput);

            var fTimeOfDayFormInput = [];
            $("input[name='fTimeofday[]']:checked").each(function() {
                fTimeOfDayFormInput.push($(this).val());
            });
            // console.log(fTimeOfDayFormInput);

            fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });
            // console.log(fFacilitiesFormInput);

            var sLocationFormInput = $("input[name='sLocation']").val();
            // console.log(sLocationFormInput);
            var sKeywordFormInput = $("input[name='sKeyword']").val();
            var sDateFormInput = $("input[name='sDate']").val();


            var subUrl =
                `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sDate=${sDateFormInput}&fCategory=${fCategoryFormInput}&fTimeofday=${fTimeOfDayFormInput}&fFacilities=${fFacilitiesFormInput}`;
            // console.log(subUrl);
            activityRefreshFilter(subUrl);
        }
    </script>

    {{-- VIEW MAP --}}
    @include('user.modal.activity.list.map')
    {{-- END VIEW MAP --}}

    {{-- SHOW VIDEO --}}
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
                        <p class="text-white" id="video-detail-facilities"></p>
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
                    var activityVideos = [];
                    var activityVideoDetails;

                    function getData(ajaxurl) {
                        return $.ajax({
                            url: ajaxurl,
                            type: 'GET',
                        });
                    };

                    function fetchActivitiesVideo(ids) {
                        var promises = [];
                        var data
                        // $('.video-show-buttons').hide();
                        for (let i = 0; i < ids.length; i++) {
                            var request = getData(`/things-to-do/video/${ids[i]}`).then((data) => {
                                // console.log(i);
                                if (data.name != undefined) {
                                    activityVideos.push(data);
                                    // $('.video-show-buttons').eq(i).show();
                                    // $('.video-show-buttons').eq(i).append(
                                    //     `<video class="villa-list-video"
                                    //             src="{{ URL::asset('/foto/activity/${data.name.toLowerCase()}/${data.video.name}') }}#t=0.1"
                                    //             alt="Best activity in Bali"></video>`
                                    // );
                                }
                                // console.log(`process ${ids[i]}`);
                            });
                            promises.push(request);
                        }

                        $.when.apply(null, promises).done(() => {
                            // console.log('done');
                            // console.log(activityVideos);
                        });
                    }

                    fetchActivitiesVideo(list);
                </script>

                {{-- show video from click --}}
                <script>
                    function view_video(id) {
                        // console.log(id);
                        // search & show video
                        var next;
                        var prev;
                        for (let i = 0; i < activityVideos.length; i++) {
                            // console.log(activityVideos[i].id_activity, activityVideos[i].id_activity == id);
                            if (activityVideos[i].id_activity == id) {
                                activityVideoDetails = activityVideos[i];
                                next = i + 1;
                                prev = i - 1;
                                // console.log(activityVideos);
                                // console.log(i, next, prev);
                                break;
                            }
                        }

                        // prepare next & prev button
                        if (next > (activityVideos.length - 1)) {
                            next = 0;
                            var videoNext = activityVideos[next];
                            if (videoNext) {
                                $('#button_next').show();
                                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_activity + ')');
                            }
                        } else {
                            var videoNext = activityVideos[next];
                            if (videoNext) {
                                $('#button_next').show();
                                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_activity + ')');
                            }
                        }
                        if (prev < 0) {
                            prev = activityVideos.length - 1;
                            var videoPrev = activityVideos[prev];
                            if (videoPrev) {
                                $('#button_prev').show();
                                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_activity + ')');
                            }
                        } else {
                            var videoPrev = activityVideos[prev];
                            if (videoPrev) {
                                $('#button_prev').show();
                                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_activity + ')');
                            }
                        }

                        // show data video
                        if (activityVideoDetails != null) {
                            // console.log(activityVideoDetails);
                            var public = '/foto/activity/';
                            var slash = '/';
                            var name = activityVideoDetails.name.toLowerCase();
                            var src = public + name + slash + activityVideoDetails.video.name;
                            // console.log(src);
                            $('#video-detail-video').attr('src', src);
                            var price = 0;
                            if (activityVideoDetails.price > 0) {
                                price = activityVideoDetails.price;
                            }
                            $('#video-detail-title').text(activityVideoDetails.name);
                            $('#video-detail-title').attr('href',
                                `{{ env('APP_URL') }}/activity/${activityVideoDetails.id_activity}`);
                            if (activityVideoDetails.facilities.length != 0) {
                                $('#video-detail-facilities').text('');
                                activityVideoDetails.facilities.forEach(facilities => {
                                    $('#video-detail-facilities').append(
                                        `<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">` +
                                        facilities.name + "</span> ");
                                });
                            } else {
                                $('#video-detail-facilities').text('');
                                $('#video-detail-facilities').text('there is no facilities yet');
                            }
                            $('#video-detail-short-description').text(activityVideoDetails.short_description);
                            $('#video-detail-location').text(activityVideoDetails.location.name);
                            if (activityVideoDetails.is_favorit) {
                                $('#video-detail-favorit').html(
                                    `<a href="{{ env('APP_URL') }}/activity/favorit/${activityVideoDetails.id_activity}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                                );
                            } else {
                                $('#video-detail-favorit').html(
                                    `<a href="{{ env('APP_URL') }}/activity/favorit/${activityVideoDetails.id_activity}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
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
                        for (let i = 0; i < activityVideos.length; i++) {
                            // console.log(activityVideos[i].id_activity, activityVideos[i].id_activity == id);
                            if (activityVideos[i].id_activity == id) {
                                activityVideoDetails = activityVideos[i];
                                next = i + 1;
                                prev = i - 1;
                                break;
                            }
                        }
                        // console.log(activityVideoDetails);

                        // prepare next & prev button
                        if (next > (activityVideos.length - 1)) {
                            next = 0;
                            var videoNext = activityVideos[next];
                            if (videoNext) {
                                $('#button_next').show();
                                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_activity + ')');
                            }
                        } else {
                            var videoNext = activityVideos[next];
                            if (videoNext) {
                                $('#button_next').show();
                                $('#button_next').attr('onclick', 'next_video(' + videoNext.id_activity + ')');
                            }
                        }
                        if (prev < 0) {
                            prev = activityVideos.length - 1;
                            var videoPrev = activityVideos[prev];
                            if (videoPrev) {
                                $('#button_prev').show();
                                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_activity + ')');
                            }
                        } else {
                            var videoPrev = activityVideos[prev];
                            if (videoPrev) {
                                $('#button_prev').show();
                                $('#button_prev').attr('onclick', 'next_video(' + videoPrev.id_activity + ')');
                            }
                        }

                        // show data video
                        if (activityVideoDetails != null) {
                            // console.log(activityVideoDetails);
                            var public = '/foto/activity/';
                            var slash = '/';
                            var name = activityVideoDetails.name.toLowerCase();
                            var src = public + name + slash + activityVideoDetails.video.name;
                            // console.log(src);
                            $('#video-detail-video').attr('src', src);
                            var price = 0;
                            if (activityVideoDetails.price > 0) {
                                price = activityVideoDetails.price;
                            }
                            $('#video-detail-title').text(activityVideoDetails.name);
                            $('#video-detail-title').attr('href',
                                `{{ env('APP_URL') }}/activity/${activityVideoDetails.id_activity}`);
                            if (activityVideoDetails.facilities.length != 0) {
                                $('#video-detail-facilities').text('');
                                activityVideoDetails.facilities.forEach(facilities => {
                                    $('#video-detail-facilities').append(
                                        `<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">` +
                                        facilities.name + "</span> ");
                                });
                            } else {
                                $('#video-detail-facilities').text('');
                                $('#video-detail-facilities').append('there is no facilities yet');
                            }
                            $('#video-detail-short-description').text(activityVideoDetails.short_description);
                            $('#video-detail-location').text(activityVideoDetails.location.name);
                            if (activityVideoDetails.is_favorit) {
                                $('#video-detail-favorit').html(
                                    `<a href="{{ env('APP_URL') }}/activity/favorit/${activityVideoDetails.id_activity}"><i class="fa fa-heart" style="color: #f00;  font-size: 16px;"></i><span>CANCEL</span></a>`
                                );
                            } else {
                                $('#video-detail-favorit').html(
                                    `<a href="{{ env('APP_URL') }}/activity/favorit/${activityVideoDetails.id_activity}"><i class="fa fa-heart" style="color: #aaa;  font-size: 16px;"></i>
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
            @endsection
