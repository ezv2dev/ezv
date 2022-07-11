@extends('layouts.user.m-list_restaurant')

@section('content')
{{-- function get data --}}
@php
$restaurants = $restaurant->shuffle();
$list = [];
foreach ($restaurants as $item) {
array_push($list, $item->id_restaurant);
}
@endphp
{{-- function get data --}}
<div id="div-to-refresh" class="col-12 main-content bg-body-black">
     <!-- Refresh Page -->
    @foreach($restaurants as $data)
    <div class="w-100 d-flex">
		<!-- <div class="villa-list-video-container video-show-buttons" onclick="view_video({{ $data->id_restaurant }});">
			<a type="button" onclick="view({{ $item->id_video }});">
			<i class="fas fa-2x fa-play video-button"></i>
			{{--<video class="villa-list-video"
				src="{{ URL::asset('/foto/restaurant/'.strtolower($data->uid).'/'.$data->video)}}#t=0.1"
				alt="Best villa in Bali"></video> --}}
		</div>
		</a> -->
        
        <a href="{{ route('restaurant', $data->id_restaurant) }}">
            <div class="villa-list-video-container video-show-buttons">
                <i class="fas fa-2x fa-play video-button"></i>
                @if ($data->video->count() > 0)
                    <video class="villa-list-video" src="{{ URL::asset('/foto/restaurant/'.$data->uid.'/'.$data->video->last()->name) }}#t=1.0"></video>
                @elseif ($data->photo->count() > 0)
                    <img class="villa-list-video" src="{{ URL::asset('/foto/restaurant/'.$data->uid.'/'.$data->photo->last()->name) }}">
                @elseif ($data->image != null)
                    <img class="villa-list-video" src="{{ URL::asset('/foto/restaurant/'.$data->uid.'/'.$data->image) }}">
                @else
                    <img class="villa-list-video" src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                @endif
            </div>
        </a>
        <div class="profile-header text-white">
        {{ $data->name }}
        </div>
	</div>
    <div class="col-12">
        <div class="content mp-0">
            <input type="hidden" value="{{$data->id_restaurant}}" id="id_restaurant" name="id_restaurant">
            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                data-dots="false" data-arrows="true">
                {{-- @php
                    $gallery = App\Http\Controllers\ViewController::gallery($data->id_restaurant);
                @endphp --}}
                @forelse ($data->photo as $item)
                    <a href="{{ route('restaurant', $data->id_restaurant) }}" class="col-6 grid-image-container">
                        <img class="img-fluid grid-image" style="display: block;"
                            src="{{ URL::asset('/foto/restaurant/'.strtolower($data->name).'/'.$item->name)}}"
                            alt="EZV_{{ $item->name }}">
                    </a>
                @empty
                    @if ($data->image)
                        <a href="{{ route('restaurant', $data->id_restaurant) }}" class="col-6 grid-image-container">
                            <img class="img-fluid grid-image" style="display: block;"
                                src="{{ URL::asset('/foto/restaurant/'.strtolower($data->name).'/'.$data->image)}}"
                                alt="">
                        </a>
                    @else
                        <a href="{{ route('restaurant', $data->id_restaurant) }}" class="col-6 grid-image-container">
                            <img class="img-fluid grid-image" style="display: block;"
                                src="{{ URL::asset('/foto/default/no-image.jpeg')}}" alt="">
                        </a>
                    @endif
                @endforelse
            </div>
        </div>
    </div>
    <div class="row inner-content">
        <div class="col-912">
            {{-- <div class="villa-list-name">{{ $data->name }}</div> --}}
            <div class="villa-list-title">
				@forelse ($data->facilities as $facilities)
                <span>{{ $facilities->name }}</span>
				@empty
				<span>There is no facilities yet</span>
				@endforelse
			</div>
        </div>
        {{-- <div class="col-3 float-left-align-right">
            <div class="villa-list-video-container">
                <a type="button" onclick="view({{ $item->id_video }});">
                <i class="fas fa-2x fa-play video-button"></i>
                <video class="villa-list-video" src="{{ URL::asset('/foto/restaurant/'.strtolower($data->name).'/'.$data->video)}}#t=0.1" alt="{{ $data->name }}, Best villa in Bali"></video>
                </a>
            </div>
        </div> --}}
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
                <a style="z-index: 50" href="#!" onclick="view_maps('{{ $data->id_restaurant }}')"></i>View Maps</a>
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
            {{ $restaurant->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
</div>
<div class="autohide footer-fixed">
    <div class="row">
        <div class="col-8">
            <div class="row mobile-social-share">
                <div class="col-6 text-center icon-center">
                    @if ($restaurant[0]->is_favorit)
                    <p>
                        <a href="{{ route('restaurant_favorit', $restaurant[0]->id_restaurant) }}"><i class="fa fa-heart"
                                style="color: #f00;  font-size: 18px;"></i>
                            <span>CANCEL</span>
                        </a>
                    </p>
                    @else
                    <p>
                        <a href="{{ route('restaurant_favorit', $restaurant[0]->id_restaurant) }}"><i class="fa fa-heart"
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

{{-- FILTER RESTAURANT LIST --}}
<script>
    function restaurantRefreshFilter(suburl) {
        window.location.href = `{{ env('APP_URL') }}/restaurant/s?${suburl}`;
    }

</script>

<script>
    function restaurantFilter() {
        var fLocationFormInput = [];
        $("input[name='fLocation[]']:checked").each(function () {
            fLocationFormInput.push(parseInt($(this).val()));
        });
        // console.log(fLocationFormInput);

        var fTypeFormInput = [];
        $("input[name='fType[]']:checked").each(function () {
            fTypeFormInput.push(parseInt($(this).val()));
        });
        // console.log(fTypeFormInput);

        var fFacilitiesFormInput = [];
        $("input[name='fFacilities[]']:checked").each(function () {
            fFacilitiesFormInput.push(parseInt($(this).val()));
        });
        // console.log(fFacilitiesFormInput);

        var fPriceFormInput = [];
        $("input[name='fPrice[]']:checked").each(function () {
            fPriceFormInput.push(parseInt($(this).val()));
        });
        // console.log(fPriceFormInput);

        var fMealFormInput = [];
        $("input[name='fMeal[]']:checked").each(function () {
            fMealFormInput.push(parseInt($(this).val()));
        });
        // console.log(fMealFormInput);

        var fCuisineFormInput = [];
        $("input[name='fCuisine[]']:checked").each(function () {
            fCuisineFormInput.push(parseInt($(this).val()));
        });
        // console.log(fCuisineFormInput);

        var fDishesFormInput = [];
        $("input[name='fDishes[]']:checked").each(function () {
            fDishesFormInput.push(parseInt($(this).val()));
        });
        // console.log(fDishesFormInput);

        var fDietaryfoodFormInput = [];
        $("input[name='fDietaryfood[]']:checked").each(function () {
            fDietaryfoodFormInput.push(parseInt($(this).val()));
        });
        // console.log(fDietaryfoodFormInput);

        var fGoodforFormInput = [];
        $("input[name='fGoodfor[]']:checked").each(function () {
            fGoodforFormInput.push(parseInt($(this).val()));
        });
        // console.log(fGoodforFormInput);

        var sLocationFormInput = $("input[name='sLocation']").val();
        // console.log(sLocationFormInput);

        var sKeywordFormInput = $("input[name='sKeyword']").val();
        // console.log(sKeywordFormInput);

        var sCuisineFormInput = [];
        $("input[name='sCuisine[]']:checked").each(function () {
            sCuisineFormInput.push(parseInt($(this).val()));
        });
        // console.log(sCuisineFormInput);

        var subUrl =
            `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sCuisine=${sCuisineFormInput}&fLocation=${fLocationFormInput}&fType=${fTypeFormInput}&fPrice=${fPriceFormInput}&fFacilities=${fFacilitiesFormInput}&fMeal=${fMealFormInput}&fCuisine=${fCuisineFormInput}&fDishes=${fDishesFormInput}&fDietaryfood=${fDietaryfoodFormInput}&fGoodfor=${fGoodforFormInput}`;
        // console.log(subUrl);
        restaurantRefreshFilter(subUrl);
    }

</script>
{{-- END FILTER RESTAURANT LIST --}}

{{-- MAP --}}
@include('user.modal.restaurant.list.map')
{{-- END MAP --}}

{{-- VIDEO --}}
@include('user.modal.restaurant.list.video')
{{-- END VIDEO --}}

<script>
    function share() {
        $('#modal-share').modal('show');
    }
</script>
@endsection
