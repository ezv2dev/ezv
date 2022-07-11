@extends('layouts.user.list')

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
<div id="body-color" class="bg-body-black">
    <!-- Page Content -->
    <div id="div-to-refresh">
        <!-- Refresh Page -->
        <div class="col-lg-12 grid-container-43">
            <!-- Grid 43 -->
            @foreach($restaurants as $data)
            <div class="row list-row-gap">
                <!-- Left Sedtion -->
                <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-image-container">
                    
                    <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                        <input type="hidden" value="{{$data->id_restaurant}}" id="id_restaurant" name="id_restaurant">
                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="false"
                        data-arrows="true">
                            @forelse ($data->photo->sortBy('order') as $item)
                                <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank" class="col-lg-6 grid-image-container">
                                    <img class="img-fluid grid-image" style="display: block;"
                                        src="{{ URL::asset('/foto/restaurant/'.strtolower($data->uid).'/'.$item->name)}}"
                                        alt="EZV_{{ $item->name }}">
                                </a>
                            @empty
                                @if ($data->image)
                                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank" class="col-lg-6 grid-image-container">
                                        <img class="img-fluid grid-image" style="display: block;"
                                            src="{{ URL::asset('/foto/restaurant/'.strtolower($data->uid).'/'.$data->image)}}"
                                            alt="EZV_{{ $data->image }}">
                                    </a>
                                @else
                                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank" class="col-lg-6 grid-image-container">
                                        <img class="img-fluid grid-image" style="display: block;"
                                            src="{{ URL::asset('/foto/default/no-image.jpeg')}}"
                                            alt="EZV_no-image.jpeg">
                                    </a>
                                @endif
                            @endforelse
                        </div>
                    </div>
				</div>
                <!-- End Left Section -->
                <!-- Right Section -->
                <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-desc-container">
                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank" class=" overlay-desc"></a>
                    <div class="row">
                        <div class="col-lg-9 float-left">
                            <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                            {{-- <div class="villa-list-title">
                                <span class="font-light list-description" style="margin-right: 4px;">{{ $data->adult }} Guests</span>
                            <span class="font-light list-description">{{ $data->bedroom }} Bedroom</span>
                            <span class="font-light list-description">{{ $data->bathroom }} Bath</span>
                            <span class="font-light list-description">2 Parking</span>
                        </div> --}}
                        <div class="villa-list-title font-light list-description">
                            {{-- <span class="font-light list-description" style="margin-right: 4px;">test</span> --}}
                            @forelse ($data->cuisine as $cuisine)
                            <span class="font-light list-description">{{ $cuisine->name }}</span>
                            @empty
                            there is no cuisine yet
                            @endforelse
                        </div>
                        <p class="villa-list-promotion"></p>
                    </div>
                    <div class="col-lg-3 float-left-align-right">
                        <!-- <div class="villa-list-video-container video-show-buttons" onclick="view_video({{ $data->id_restaurant }});">
                            <a type="button" onclick="view({{ $item->id_video }});">
                            <i class="fas fa-2x fa-play video-button"></i>
                            {{--<video class="villa-list-video"
                                src="{{ URL::asset('/foto/restaurant/'.strtolower($data->uid).'/'.$data->video)}}#t=0.1"
                                alt="Best villa in Bali"></video> --}}
                        </div>
                        </a> -->

                        <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank">
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
                                {{ number_format($data->time) }} minute to {{ $data->villa }}
                            </span>
                            <span style="color: #ff7400;">
                                <a class="orange-hover" href="#!"
                                    onclick="view_maps('{{ $data->id_restaurant }}')"></i>View Maps</a>
                            </span>
                        </div>
                        {{--
							<p class="villa-list-location">Villa | <i class="fa-solid fa-location-dot villa-list-location-icon"></i><a
								href="javascript.void(0)" data-bs-toggle="modal"
								data-bs-target="#modal-map-{{$data->id_restaurant}}">{{ $data->location_name }}</a> | 5 minute to beach</p>
                        --}}

                        {{--
							<p class="col-lg-12 villa-list-title">Rp {{ number_format($data->price, 0, ',', '.') }} / night</p>
                        <p class="villa-list-location">Villa | <i
                                class="fa-solid fa-location-dot villa-list-location-icon"></i><a
                                href="javascript.void(0)" data-bs-toggle="modal"
                                data-bs-target="#modal-map-{{$data->id_restaurant}}">{{ $data->location_name }}</a> | 5
                            minute to beach</p>
                        --}}
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
            {{ $restaurant->links('vendor.pagination.bootstrap-4') }}
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
@endsection
