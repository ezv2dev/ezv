@extends('layouts.user.m-list')

@section('content')
{{-- function get data --}}
@php
$villas = $villa->shuffle();
$list = [];
foreach ($villas as $item) {
array_push($list, $item->id_villa);
}
@endphp
{{-- function get data --}}

<div id="div-to-refresh" class="col-12 main-content bg-body-black">
    <!-- Page Content -->
    @foreach ($villas as $data)
    <div class="w-100 d-flex">
        <!-- <div class="villa-list-video video-show-buttons" onclick="view_video({{ $data->id_villa }});">
            <a type="button">
                <i class="fas fa-2x fa-play video-button"></i>
            </a>
        </div> -->
        <a href="{{ route('villa', $data->id_villa) }}">
            <div class="villa-list-video-container video-show-buttons">
                <i class="fas fa-2x fa-play video-button"></i>
            </div>
        </a>
        <div class="profile-header text-white">
        {{ $data->name }}
        </div>
    </div>
    <div class="col-12">
        <div class="content mp-0">
            <input type="hidden" value="{{ $data->id_villa }}" id="id_villa" name="id_villa">
            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                data-dots="false" data-arrows="true">
                @php
                    $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                @endphp
                @forelse ($gallery as $item)
                    <a href="{{ route('villa', $data->id_villa) }}" class="col-6 grid-image-container">
                        <img class="img-fluid grid-image" style="display: block;"
                            src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $item->photo) }}"
                            alt="EZV_{{ $item->photo }}">
                    </a>
                @empty
                    @if ($data->image)
                        <a href="{{ route('villa', $data->id_villa) }}" class="col-6 grid-image-container">
                            <img class="img-fluid grid-image" style="display: block;"
                                src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}"
                                alt="">
                        </a>
                    @else
                    <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                        class="col-lg-6 grid-image-container">
                        <img class="img-fluid grid-image" style="display: block;"
                            src="{{ URL::asset('/template/villa/template_profile.jpg') }}" alt="">
                    </a>
                    @endif
                @endforelse
            </div>
        </div>
    </div>
    <div class="row inner-content">
        <div class="col-12">
            {{-- <div class="villa-list-name">{{ $data->name }}</div> --}}
            <div class="villa-list-title">
                <span>{{ $data->adult ?? 0 }} {{ Translate::translate('Guests') }}</span>
                <span>{{ $data->bedroom ?? 0 }} {{ Translate::translate('Bedroom') }}</span>
                <span>{{ $data->bathroom ?? 0 }} {{ Translate::translate('Bathroom') }}</span>
                <span>{{ $data->parking ?? 0 }} {{ Translate::translate('Car Park') }}</span>
                <span>{{ $data->size ?? 0 }} {{ Translate::translate('Living Area') }}</span>
            </div>
            <div class="villa-list-promotion">{{ $data->promotion }}</div>
        </div>
        {{-- <div class="col-3 float-left-align-right">
            <div class="villa-list-video-container">
                <a type="button" onclick="view({{ $data->id_villa }});">
                <i class="fas fa-2x fa-play video-button"></i>
                <video class="villa-list-video" src="{{ URL::asset('/foto/gallery/' . strtolower($data->name) . '/' . $data->video) }}#t=0.1" alt="{{ $data->name }}, Best villa in Bali"></video>
                </a>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="short-description">{{ Translate::translate($data->short_description ?? 'there is no description yet') }}</div>
        </div>
        <div class="col-12">
            <div class="villa-list-price">
                IDR <span class="bigger">{{ number_format($data->price, 0) }}</span>/{{ Translate::translate('night') }}
                <span>5.0 {{ Translate::translate('Reviews') }}</span>
            </div>
            <div class="villa-list-location">
                    <span class="bolder">5 {{ Translate::translate('minute') }}</span> {{ Translate::translate('to beach') }}
                <span>
                    <a class="orange-hover" href="#!" onclick="view_maps('{{ $data->id_villa }}')"></i>{{ Translate::translate('View Maps') }}</a>
                </span>
                <span>
                    <a class="orange-hover" href="#">More Amenities</a>
                </span>
            </div>
            {{--
            <p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                href="javascript.void(0)" data-bs-toggle="modal"
                data-bs-target="#modal-map-{{$data->id_villa}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
            --}}

                {{--
            <p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / {{ Translate::translate('night') }}</p>
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
            {{ $villa->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
    
    <!-- End Page Content -->
    {{-- modal laguage and currency --}}
        @include('user.modal.filter.m-filter_language')
    {{-- modal laguage and currency --}}
</div>
<!-- Modal -->
<div class="modal fade modal-video-block" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content video-container">
			<center>
				<video controls="controls" id="video-detail-video" class="video-modal">
					<source src="" type="video/mp4">
					Your browser doesn't support HTML5 video tag.
				</video>
			</center>
			<div class="row overlay-social">
                <div class="col-6">
                    <div class="row social-share">
                        <div class="col-6 text-center icon-center">
                            <p id="video-detail-favorit"></p>
                        </div>
                    </div>
                </div>  
                <div class="col-6 overlay-close">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
			</div>
			<div class="overlay-video">
				<div class="overlay-desc-wrap video-modal-desc">
                    <div class="row">
                        <div class="col-9">
					        <h5><a id="video-detail-title"></a></h5>
                        </div>
                        <div class="col-3">
                            <div class="vid-address">
                                <i class="fa fa-map-marker"></i> <span id="video-detail-location"></span>
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-10">
							<ul>
								<li><span id="video-detail-bedrooms"></span> {{ Translate::translate('Bedroom') }}</li>
								<li><span id="video-detail-bathrooms"></span> {{ Translate::translate('Bathroom') }}</li>
								<li><span id="video-detail-bedss"></span> {{ Translate::translate('Beds') }}</li>
							</ul>
							<div class="text-white" id="video-detail-price">IDR 999,999/{{ Translate::translate('night') }}</div>
							<div class="short-desc" id="video-detail-short-description"></div>
						</div>
						<div class="col-2">
							<div class="overlay-nav">
								<div class="nav-video nav-video-next">
									<a type="button" id="button_next" style="display:none">
                                    <span><i class="fa fa-chevron-up"></i></span>Next Villa
									</a>
								</div>
								<div class="nav-video nav-video-prev">
									<a type="button" id="button_prev" style="display:none">
										Prev Villa<span><i class="fa fa-chevron-down"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
	</div>
</div>

<div class="autohide footer-fixed">
            <div class="row">
                <div class="col-8">
                    <div class="row mobile-social-share">
                        <div class="col-4 text-center icon-center">
                            <p type="button" onclick="language()" href="#">
                                @if (session()->has('locale'))
                                    <img class="lang" src="{{ URL::asset('assets/flags/flag_'.session('locale').'.svg')}}">
                                @else
                                    <img class="lang" src="{{ URL::asset('assets/flags/flag_en.svg')}}">
                                @endif
                                <span style="color: #aaa;">{{ Translate::translate('LANG') }}</span>
                            </p>
                        </div>
                        <div class="col-4 text-center icon-center">
                            @if ($villa[0]->is_favorit)
                            <p>
                                <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                                        style="color: #f00;  font-size: 18px;"></i>
                                    <span>{{ Translate::translate('CANCEL') }}</span>
                                </a>
                            </p>
                            @else
                            <p>
                                <a href="{{ route('villa_favorit', $villa[0]->id_villa) }}"><i class="fa fa-heart"
                                        style="color: #aaa;  font-size: 18px;"></i>
                                    <span style="color: #aaa;">{{ Translate::translate('FAVORITE') }}</span>
                                </a>
                            </p>
                            @endif
                        </div>
                        <div class="col-4 text-center icon-center">
                            <p type="button" class="expand" onclick="share()">
                                <i class="fa fa-share" style="font-size: 18px;"></i>
                                <span>{{ Translate::translate('SHARE') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="footer-login text-white text-center">
                        @auth
                        <h5 class="user-image">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
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
                                        <a href="{{route('admin_dashboard')}}" class="dropdown-item">{{ Translate::translate('Dashboard') }}</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{route('profile_index')}}" class="dropdown-item">{{ Translate::translate('My Profile') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('profile_index')}}" class="dropdown-item">{{ Translate::translate('Change Password') }}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()">{{ Translate::translate('Sign
                                            Out') }}</a>
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
                        <a type="button" onclick="location.href='{{ route('login') }}'"><i class="fa fa-user"></i> {{ Translate::translate('Login') }}</a>
                        @endauth
                    </div>
                </div>
            <div>
        </div>
@endsection


@section('scripts')
<script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

{{-- VIEW MAP --}}
@include('user.modal.villa.list.map')
{{-- END VIEW MAP --}}

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

            var short_description = villaVideoDetails.short_description ?? 'there is no description yet';
            if(villaVideoDetails.short_description.length >70) {
                short_description = villaVideoDetails.short_description.substring(0, 70)+'...';
            }
            $('#video-detail-title').text(villaVideoDetails.name);
            $('#video-detail-title').attr('href', `{{ env('APP_URL') }}/villa/${villaVideoDetails.id_villa}`);
            $('#video-detail-bedrooms').text(villaVideoDetails.bedroom);
            $('#video-detail-bathrooms').text(villaVideoDetails.bathroom);
            $('#video-detail-bedss').text(villaVideoDetails.beds);
            $('#video-detail-price').text(`IDR ${price.toLocaleString()}/night`);
            $('#video-detail-short-description').text(short_description);
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
{{-- END SHOW VIDEO --}}

{{-- SEARCH FUNCTION --}}
<script>
    function villaRefreshFilter(suburl) {
        window.location.href = `{{ env('APP_URL') }}/searchvillacombine?${suburl}`;
    }

</script>

<script>
    function villaFilter(){
        var fMaxPriceFormInput = [];
        $("input[name='fMaxPrice[]']").each(function () {
            fMaxPriceFormInput.push(parseInt($(this).val()));
        });

        var fMinPriceFormInput = [];
        $("input[name='fMinPrice[]']").each(function () {
            fMinPriceFormInput.push(parseInt($(this).val()));
        });

        var fPropertyFormInput = [];
        $("input[name='fProperty[]']:checked").each(function () {
            fPropertyFormInput.push(parseInt($(this).val()));
        });

        var fBedroomFormInput = [];
        $("input[name='fBedroom[]']").each(function () {
            fBedroomFormInput.push(parseInt($(this).val()));
        });

        var fBathroomFormInput = [];
        $("input[name='fBathroom[]']").each(function () {
            fBathroomFormInput.push(parseInt($(this).val()));
        });

        var fBedsFormInput = [];
        $("input[name='fBeds[]']").each(function () {
            fBedsFormInput.push(parseInt($(this).val()));
        });

        var fFacilitiesFormInput = [];
        $("input[name='fFacilities[]']:checked").each(function () {
            fFacilitiesFormInput.push(parseInt($(this).val()));
        });

        var fSuitableFormInput = [];
        $("input[name='fSuitable[]']:checked").each(function () {
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

{{-- GOOGLE MAPS API --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

<!-- <script>
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
                villaLocations.push(data);
                // console.log(`process ${id}`);
            });
            promises.push(request);
        });

        $.when.apply(null, promises).done(() => {
            // console.log('done');
            // console.log(villaLocations);
            initViewMap();
        });
    }

    fetchVillasLocation(list);

</script>

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
    function addCustomContent(villaLocations, i) {
        // check if price exist
        let price = 'price not been set yet';
        if (villaLocations[i].price != null) {
            price = 'IDR ' + villaLocations[i].price.toLocaleString();
        }
        // check if image exist
        let image = `<img src="{{ asset('foto/default/no-image.jpeg') }}" class="card-img-top">`;
        if (villaLocations[i].image != null) {
            image =
                `<img src="{{ asset('foto/gallery/${villaLocations[i].name.toLowerCase()}/${villaLocations[i].image}') }}" class="card-img-top">`;
        }
        // check if rating exist
        let review = `there is no review yet`;
        if (villaLocations[i].detail_review != null) {
            review =
                `<i class="fa-solid fa-star" style="color: #ff7400"></i> ${villaLocations[i].detail_review.average} (${villaLocations[i].detail_review.count_person})`;
        }

        var customContent = `<div class="card" style="width: 18rem; font-family: 'Poppins'">
                                <a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank">
                                ${image}
                                </a>
                                <div class="card-body">
                                    <a href="{{ env('APP_URL') }}/villa/${villaLocations[i].id_villa}" target="_blank">
                                        <p class="card-text text-secondary">
                                            <small>
                                                ${review}
                                            </small>
                                        </p>
                                        <p class="card-text">${villaLocations[i].property_type.name} • ${villaLocations[i].location.name}</p>
                                        <p class="card-text">${villaLocations[i].name}</p>
                                        <p class="card-text" style="font-weight: 600;">
                                            ${price}
                                            <small class="fw-normal">/night</small>
                                        </p>

                                    </a>
                                </div>
                            </div>`;

        customContents.push(customContent);
    }

    // init map when page is completed load
    async function initViewMap() {
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
        for (let i = 0; i < villaLocations.length; i++) {
            let price = 'price not been set yet';
            if (villaLocations[i].price != null) {
                price = 'IDR ' + villaLocations[i].price.toLocaleString();
            }

            addMarker({
                lat: villaLocations[i].latitude,
                long: villaLocations[i].longitude
            }, {
                text: price,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });

            addCustomContent(villaLocations, i);

            google.maps.event.addListener(markers[i], 'click', (function (marker, i) {
                return function () {
                    // console.log('hit');
                    for (let index = 0; index < markers.length; index++) {
                        let price = 'price not been set yet';
                        if (villaLocations[index].price != null) {
                            price = 'IDR ' + villaLocations[index].price.toLocaleString();
                        }
                        markers[index].setLabel({
                            text: price,
                            className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                        });
                    }
                    let price = 'price not been set yet';
                    if (villaLocations[i].price != null) {
                        price = 'IDR ' + villaLocations[i].price.toLocaleString();
                    }
                    marker.setLabel({
                        text: price,
                        className: 'text-white fw-bold px-1 py-1 rounded-pill bg-black'
                    });
                    infowindow.setContent(customContents[i]);
                    infowindow.open(map, marker);
                }
            })(markers[i], i));
        }

        // close info window and reset markers when click on the map
        google.maps.event.addListener(map, "click", function (event) {
            for (let index = 0; index < markers.length; index++) {
                let price = 'price not been set yet';
                if (villaLocations[index].price != null) {
                    price = 'IDR ' + villaLocations[index].price.toLocaleString();
                }
                markers[index].setLabel({
                    text: price,
                    className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
                });
            };
            infowindow.close();
        });
    };

    function view_maps(mapId) {
        for (let i = 0; i < villaLocations.length; i++) {
            let price = 'price not been set yet';
            if (villaLocations[i].price != null) {
                price = 'IDR ' + villaLocations[i].price.toLocaleString();
            }
            markers[i].setLabel({
                text: price,
                className: 'text-black fw-bold px-1 py-1 rounded-pill bg-white'
            });
            infowindow.close();
            infowindow.setContent(null);
        }
        for (let i = 0; i < villaLocations.length; i++) {
            if (villaLocations[i].id_villa == mapId) {
                let price = 'price not been set yet';
                if (villaLocations[i].price != null) {
                    price = 'IDR ' + villaLocations[i].price.toLocaleString();
                }
                markers[i].setLabel({
                    text: price,
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

</script> -->

<!-- MAP MODAL -->
<!-- <div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
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
</div> -->
{{-- END GOOGLE MAPS API --}}

{{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
{{-- <script>
    var search = new URLSearchParams(window.location.search);
    $(window).on('resize', () => {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            search.set('screen', 'mobile');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            search.set('screen', 'desktop');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
    });
    $(document).ready(() => {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            search.set('screen', 'mobile');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            search.set('screen', 'desktop');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
    });

</script> --}}
{{-- END REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 900 --}}
@endsection