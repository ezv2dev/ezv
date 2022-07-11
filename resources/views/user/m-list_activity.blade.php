@extends('layouts.user.m-list_activity')

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

<div id="div-to-refresh" class="col-12 main-content bg-body-black">
    @foreach($activity->shuffle() as $data)
    <div class="col-8">
        <div class="row inner-content">
            <div class="col-2">
                {{-- Note: TOLONG diganti dengan foto profile owner dari propertynya. --}}
                <img class="profile-image" src="{{ URL::asset('/foto/activity/'.strtolower($data->name).'/'.$data->image)}}">
            </div>
            <div class="col-10">
                {{-- Note: TOLONG diganti dengan nama profile owner dari propertynya. --}}
                <p class="profile-header">{{ $data->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="content mp-0">
			<input type="hidden" value="{{$data->id_activity}}" id="id_activity" name="id_activity">
            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                data-dots="false" data-arrows="true">
                {{-- @php
                    $gallery = App\Http\Controllers\ViewController::gallery($data->id_activity);
                @endphp --}}
                @forelse ($data->photo as $item)
                    <a href="{{ route('activity', $data->id_activity) }}" class="col-6 grid-image-container">
                        <img class="img-fluid grid-image" style="display: block;"
                            src="{{ URL::asset('/foto/activity/'.strtolower($data->name).'/'.$item->name)}}"
                            alt="EZV_{{ $item->name }}">
                    </a>
                @empty
                    @if ($data->image)
                        <a href="{{ route('activity', $data->id_activity) }}" class="col-6 grid-image-container">
                            <img class="img-fluid grid-image" style="display: block;"
                                src="{{ URL::asset('/foto/activity/'.strtolower($data->name).'/'.$data->image)}}"
                                alt="">
                        </a>
                    @else
                        <a href="{{ route('activity', $data->id_activity) }}" class="col-6 grid-image-container">
                            <img class="img-fluid grid-image" style="display: block;"
                                src="{{ URL::asset('/foto/default/no-image.jpeg')}}" alt="">
                        </a>
                    @endif
                @endforelse
            </div>
        </div>
    </div>
    <div class="row inner-content">
        <div class="col-9 float-left">
            <div class="villa-list-name">{{ $data->name }}</div>
            <div class="villa-list-title">
				@forelse ($data->facilities as $facilities)
                <span>{{ $facilities->name }}</span>
				@empty
				<span>There is no facilities yet</span>
				@endforelse
			</div>
        </div>
        <div class="col-3 float-left-align-right">
            <div class="villa-list-video-container">
                <a type="button" onclick="view({{ $item->id_video }});">
                <i class="fas fa-2x fa-play video-button"></i>
                <video class="villa-list-video" src="{{ URL::asset('/foto/activity/'.strtolower($data->name).'/'.$data->video)}}#t=0.1" alt="{{ $data->name }}, Best villa in Bali"></video>
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="short-description">{{ $data->short_description }}</div>
        </div>
        <div class="col-12">
            <div class="villa-list-price">
                {{-- IDR <span class="bigger">{{ number_format($data->price, 0) }}</span>/night --}}
                <span>@if ($data->detailReview)
                {{ $data->detailReview->average }} Reviews
                @else
                <span>There is no reviews yet</span>
                @endif</span>
            </div>
            <div class="villa-list-location">
                    <span class="bolder">5 minute</span> to beach
                <span>
                <a style="z-index: 50" href="#!" onclick="view_maps('{{ $data->id_activity }}')"></i>View Maps</a>
                </span>
            </div>
            {{--
            <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                href="javascript.void(0)" data-bs-toggle="modal"
                data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
            --}}

                {{--
            <p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / night</p>
            <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                href="javascript.void(0)" data-bs-toggle="modal"
                data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
                --}}
        </div>
    </div>
    <hr style="color: #fff;">
    @endforeach
    {{-- Pagination --}}
    <div class="container-fluid pagination-block">
        <div class="mt-5 d-flex justify-content-center">
            {{ $activity->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
</div>
<div class="footer-fixed">
    <div class="row">
        <div class="col-8">
            <div class="row mobile-social-share">
                <div class="col-6 text-center icon-center">
                    @if ($activity[0]->is_favorit)
                    <p>
                        <a href="{{ route('activity_favorit', $activity[0]->id_activity) }}"><i class="fa fa-heart"
                                style="color: #f00;  font-size: 18px;"></i>
                            <span>CANCEL</span>
                        </a>
                    </p>
                    @else
                    <p>
                        <a href="{{ route('activity_favorit', $activity[0]->id_activity) }}"><i class="fa fa-heart"
                                style="color: #aaa;  font-size: 18px;"></i>
                            <span style="color: #aaa;">FAVORITE</span>
                        </a>
                    </p>
                    @endif
                </div>
                <div class="col-6 text-center icon-center">
                    <p type="button" class="expand" onclick="share()">
                        <i class="fa fa-share" style="font-size: 18px;"></i>
                        <span>SHARE</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="footer-login text-white text-center">
            <!-- <a type="button" onclick="location.href='{{ route('login') }}'"><i class="fa fa-user"></i> Login</a> -->

            @auth
            <div>
                <h5 class="user-image">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
            </div>
            <div class="logged-user-menu" style="">
                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->avatar)
                    <img src="{{Auth::user()->avatar}}" class="logged-user-photo" alt="">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}" class="logged-user-photo"
                        alt="">
                    @endif
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="margin-right: 0px; left: auto;">
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||
                        Auth::user()->role_id == 3)
                        <li>
                            <a href="{{route('admin_dashboard')}}" class="dropdown-item">Dashboard</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('profile_index')}}" class="dropdown-item">My Profile</a>
                        </li>
                        <li>
                            <a href="{{route('profile_index')}}" class="dropdown-item">Change Password</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                Out</a>
                            <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </li>
                    </ul>
                </a>
            </div>
            @else
            @if (Route::current()->uri() == 'villa/{id}' || Route::is('privacy_policy') || Route::is('terms') ||
            Route::is('license'))
            <input type="button" onclick="location.href='{{ route('register.partner') }}';" value="Become a Host" />
            @endif

            <a type="button" onclick="location.href='{{ route('login') }}'"><i class="fa fa-user"></i> Login</a>

            @endauth
                    </div>
        </div>
    <div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

{{-- Search --}}
<script>
    $(document).ready(function () {
        $(".drop-down").hover(function () {
            $('.mega-menu').addClass('display-on');
        });
        $(".drop-down").mouseleave(function () {
            $('.mega-menu').removeClass('display-on');
        });

        $(".drop-down2").hover(function () {
            $('.mega-menu2').addClass('display-on');
        });
        $(".drop-down2").mouseleave(function () {
            $('.mega-menu2').removeClass('display-on');
        });

        $(".drop-down3").hover(function () {
            $('.mega-menu3').addClass('display-on');
        });
        $(".drop-down3").mouseleave(function () {
            $('.mega-menu3').removeClass('display-on');
        });

        $(".drop-down4").hover(function () {
            $('.mega-menu4').addClass('display-on');
        });
        $(".drop-down4").mouseleave(function () {
            $('.mega-menu4').removeClass('display-on');
        });

        $(".drop-down5").hover(function () {
            $('.mega-menu5').addClass('display-on');
        });
        $(".drop-down5").mouseleave(function () {
            $('.mega-menu5').removeClass('display-on');
        });

    });

</script>

{{-- ACTIVITY FILTER --}}
<script>
    function activityRefreshFilter(suburl){
        window.location.href = `{{ env('APP_URL') }}/things-to-do/s?${suburl}`;
    }
</script>
<script>
    function activityFilter() {
        var fCategoryFormInput = [];
        $("input[name='fCategory[]']:checked").each(function ()
        {
            fCategoryFormInput.push(parseInt($(this).val()));
        });
        // console.log(fCategoryFormInput);

        var fTimeOfDayFormInput = [];
        $("input[name='fTimeofday[]']:checked").each(function ()
        {
            fTimeOfDayFormInput.push($(this).val());
        });
        // console.log(fTimeOfDayFormInput);

        fFacilitiesFormInput = [];
        $("input[name='fFacilities[]']:checked").each(function ()
        {
            fFacilitiesFormInput.push(parseInt($(this).val()));
        });
        // console.log(fFacilitiesFormInput);

        var sLocationFormInput = $("input[name='sLocation']").val();
        // console.log(sLocationFormInput);

        var subUrl= `sLocation=${sLocationFormInput}&fCategory=${fCategoryFormInput}&fTimeofday=${fTimeOfDayFormInput}&fFacilities=${fFacilitiesFormInput}`;
        // console.log(subUrl);
        activityRefreshFilter(subUrl);
    }
</script>

<!-- MAP MODAL -->
<div class="modal fade" id="modal-map" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true" style="display:none">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content modal-map">
            <div class="modal-header">
                <h5 class="modal-title">Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 500px">
                <div id="mapActivities"  style="width:100%;height:100%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- GOOGLE MAPS API --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

<script>
    var list = @json($list);

    var ActivityLocations = [];

    function getData(ajaxurl) {
        return $.ajax({
            url: ajaxurl,
            type: 'GET',
        });
    };

    function fetchActivitiesLocation(ids) {
        var promises = [];
        ids.forEach(id => {
            var request = getData(`/things-to-do/map/${id}`).then((data) => {
                ActivityLocations.push([data.name, data.latitude, data.longitude, data.id_activity]);
                // console.log(`process ${id}`);
            });
            promises.push(request);
        });

        $.when.apply(null, promises).done(() => {
            // console.log('done');
        });
    }

    fetchActivitiesLocation(list);
</script>

<script>
    function view_maps(mapId) {
        var Activity;
        // console.log(mapId);
        // console.log(ActivityLocations);
        for (let i = 0; i < ActivityLocations.length; i++) {
            if(ActivityLocations[i][3] == mapId) {
                Activity = ActivityLocations[i];
                break;
            }
        }
        if(Activity != null && ActivityLocations.length > 0) {
            // declare map
            var map = new google.maps.Map(document.getElementById('mapActivities'), {
                zoom: 9,
                center: new google.maps.LatLng(-8.62, 115.09),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // declare info window
            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            marker = new google.maps.Marker({
                    position: new google.maps.LatLng(Activity[1], Activity[2]),
                    map: map
                });
            infowindow.setContent(Activity[0]);
            infowindow.open(map, marker);

            for (i = 0; i < ActivityLocations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(ActivityLocations[i][1], ActivityLocations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                    infowindow.setContent(ActivityLocations[i][0]);
                    infowindow.open(map, marker);
                    }
                })(marker, i));
            }
            $("#modal-map").modal('show');
        } else {
            // console.log('data Activity is empty, not showing map modal');
        }
    }
</script>
{{-- google maps api --}}

<script>
    function share() {
        $('#modal-share').modal('show');
    }
</script>

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
                    <div class="col-6 text-center icon-center">
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
        $('.video-show-buttons').hide();
        for (let i = 0; i < ids.length; i++) {
            var request = getData(`/things-to-do/video/${ids[i]}`).then((data) => {
                console.log(i);
                if (data.name != undefined) {
                    activityVideos.push(data);
                    $('.video-show-buttons').eq(i).show();
                    $('.video-show-buttons').eq(i).append(
                        `<video class="villa-list-video"
                                                src="{{ URL::asset('/foto/activity/${data.name.toLowerCase()}/${data.video.name}') }}#t=0.1"
                                                alt="Best activity in Bali"></video>`
                    );
                }
                console.log(`process ${ids[i]}`);
            });
            promises.push(request);
        }

        $.when.apply(null, promises).done(() => {
            console.log('done');
            console.log(activityVideos);
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
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/activity/${activityVideoDetails.id_activity}`);
            if(activityVideoDetails.facilities.length != 0) {
                $('#video-detail-facilities').text('');
                activityVideoDetails.facilities.forEach(facilities => {
                    $('#video-detail-facilities').append(`<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">`+ facilities.name +"</span> ");
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
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/activity/${activityVideoDetails.id_activity}`);
            if(activityVideoDetails.facilities.length != 0) {
                $('#video-detail-facilities').text('');
                activityVideoDetails.facilities.forEach(facilities => {
                    $('#video-detail-facilities').append(`<span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">`+ facilities.name +"</span> ");
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
