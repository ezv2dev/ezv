@extends('layouts.user.list')

@section('title', 'List of Food - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    $restaurants = $restaurant->shuffle()->sortBy('grade');
    $list = [];
    foreach ($restaurants as $item) {
        array_push($list, $item->id_restaurant);
    }

    // set theme color
    $bgColor = 'bg-body-light';
    $textColor = 'font-black';
    $rowLineColor = 'row-line-white';
    $listColor = 'listoption-light';
    $shadowColor = 'box-shadow-light';
    if (isset($_COOKIE['tema'])) {
        if ($_COOKIE['tema'] == 'black') {
            $bgColor = 'bg-body-black';
            $textColor = 'font-light';
            $rowLineColor = 'row-line-grey';
            $listColor = '{{ $listColor }}';
            $shadowColor = 'box-shadow-dark';
        }
    }
    @endphp
    {{-- function get data --}}

    <style>
        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }

        .limit-text-1 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>
    <div id="body-color" class="{{ $bgColor }}" style="position: relative; min-height: 100px;">
        <!-- Page Content -->
        <div id="div-to-refresh" class="container__list">
            <!-- Refresh Page -->
            @php
                if (request()->fCuisine) {
                    $fCuisine = request()->fCuisine;
                } else {
                    $fCuisine = '';
                }
            @endphp

            <div id="filter-cat-bg-color" style="width:100%;"
                class="container-grid-cat translate-text-group {{ $bgColor }} top-min-10p pb-10p" style="">
                @foreach ($categories->take(6) as $item)
                    <div>
                        <a href="#" class="grid-img-container"
                            onclick="foodFilter({{ $item->id_cuisine }}, null, true, false)">
                            <img @if ($fCuisine == $item->id_cuisine) style="border: 5px solid #ff7400;" @endif
                                class="grid-img-filter lozad"
                                data-src="https://source.unsplash.com/random/?{{ $item->name }}"
                                src="{{ LazyLoad::show() }}">
                            <div class="grid-text translate-text-group-items">
                                <!-- <span class="translate-text-group-items text-white">{{ $item->name }}</span> -->
                                {{ $item->name }}
                            </div>
                        </a>
                    </div>
                @endforeach

                <div style="cursor:pointer;" onclick="moreCategory()">
                    <a class="grid-img-container">
                        <img class="grid-img-filter lozad" data-src="https://source.unsplash.com/random/?bali"
                            src="{{ LazyLoad::show() }}">
                        <div class="grid-text">
                            {{ __('user_page.More') }}
                        </div>
                    </a>
                </div>
            </div>

            <div class="stickySubCategory">
                <div id="filter-subcat-bg-color" style="width: 100%;"
                    class="container-grid-sub-cat translate-text-group {{ $bgColor }} pt-15p pb-15p" style="">
                    @foreach ($subcategories->take(8) as $item)
                        <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                            onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ $item->id_subcategory }}, false)">
                            <div>
                                <i class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                                    @php
                                        $isChecked = '';
                                        $filterIds = explode(',', request()->get('fSubCategory'));
                                    @endphp @if (in_array($item->id_subcategory, $filterIds))
                                    style="color: #ff7400 !important;"@endif>
                    </i>
                </div>
                <div>
                    <span
                        class="translate-text-group-items list-description {{ $textColor }}">{{ $item->name }}</span>
                </div>
            </div>
            @endforeach
            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="moreSubCategory()">
                <div>
                    <div>
                        <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                    </div>
                    <p class="m-0 list-description {{ $textColor }}">
                        {{ __('user_page.More') }}
                    </p>
                </div>
            </div>
        </div>

    </div>

    @if (count($restaurants) == 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mt-4">
                        <img style="height: 53vh;" class="img-fluid p-4"
                            src="{{ asset('assets/partner/template/assets/img/freepik/filter_data_unavailable.svg') }}"
                            alt="" />
                        <p class="lead" style="font-weight: 700; color: #ff7400;">Restaurant data not available</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-lg-12 container-grid container__grid translate-text-group mt-0 mt-lg-10p">
        @php
            $local = '<script>
                document.write(localStorage.getItem(mode))
            </script>';
            echo $local;
        @endphp
        @foreach ($restaurants as $data)
            <div class="grid-list-container lozad">
                <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                    @guest
                        <div class="list-like-button-container" style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="loginForm(1)" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false" class="favorite-button favorite-button-28">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    @endguest

                    @auth
                        @php
                            $cekRestaurant = App\Models\RestaurantSave::where('id_restaurant', $data->id_restaurant)
                                ->where('id_user', Auth::user()->id)
                                ->first();
                        @endphp

                        @if ($cekRestaurant == null)
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_restaurant }}, 'restaurant')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button favorite-button-28 likeButtonrestaurant{{ $data->id_restaurant }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_restaurant }}, 'restaurant')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button-active favorite-button-28 unlikeButtonrestaurant{{ $data->id_restaurant }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    @endauth
                    <div class="like-sign like-sign-restaurant-{{ $data->id_restaurant }}">
                        <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                    </div>

                    <a href="{{ route('restaurant', $data->id_restaurant) }}" class="absolute-right" target="_blank">
                        <div class="video-thumb-container skeleton">
                            <div class="video-thumb-content">
                                <i class="fas fa-2x fa-play video-button"></i>
                                @if ($data->video->count() > 0)
                                    <video class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/restaurant/' . $data->uid . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                @elseif ($data->photo->count() > 0)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/restaurant/' . $data->uid . '/' . $data->photo->last()->name) }}">
                                @elseif ($data->image != null)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/restaurant/' . $data->uid . '/' . $data->image) }}">
                                @else
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                @endif
                            </div>
                        </div>
                    </a>

                    <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                        <input type="hidden" value="{{ $data->id_restaurant }}" id="id_restaurant"
                            name="id_restaurant">
                        <div class="dots-container d-flex justify-content-center"></div>
                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white skeleton skeleton-w-100 skeleton-h-lg"
                            data-dots="false" data-arrows="true">

                            @forelse ($data->photo->sortBy('order') as $item)
                                <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank"
                                    class="col-lg-6 grid-image-container">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;"
                                        src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/restaurant/' . strtolower($data->uid) . '/' . $item->name) }}"
                                        alt="EZV_{{ $item->name }}">
                                </a>
                            @empty
                                @if ($data->image)
                                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/restaurant/' . strtolower($data->uid) . '/' . $data->image) }}"
                                            alt="EZV_{{ $data->image }}">
                                    </a>
                                @else
                                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                            alt="EZV_no-image.jpeg">
                                    </a>
                                @endif
                            @endforelse

                        </div>
                    </div>

                </div>

                <div class="desc-container-grid mb-2">
                    <a href="{{ route('restaurant', $data->id_restaurant) }}" target="_blank"
                        class="grid-overlay-desc"></a>
                    <div class=" max-lines skeleton skeleton-h-2 skeleton-w-100">
                        <span
                            class="text-14 fw-500 {{ $textColor }} list-description">{{ $data->name ?? __('user_page.There is no name yet') }}</span>
                    </div>

                    <div class="text-align-right skeleton">
                        <span class="fw-500 text-align-right text-14 {{ $textColor }} list-description">
                            @if ($data->detailReview)
                                {{ $data->detailReview->average }}
                                <i class="fa-solid fa-star text-13 text-orange"></i>
                                {{-- @else
                                    {{ __('user_page.New') }} --}}
                            @endif
                        </span>
                    </div>
                    <div class="grid-one-line text-grey-2 max-lines col-lg-10 skeleton skeleton-h-1 skeleton-w-100">
                        <span class="text-14 fw-400 text-grey-2">
                            @if ($data->short_description)
                                {{ Translate::translate($data->short_description) }}
                            @else
                                {{ __('user_page.There is no description yet') }}
                            @endif
                        </span>
                    </div>

                    @php
                        $i = 0;
                    @endphp
                    <div class="skeleton skeleton-h-1 skeleton-w-75">
                        <div style="min-height: 21px;"
                            class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description {{ $textColor }}">
                            @foreach ($data->cuisine->take(3) as $item)
                                @php
                                    $i += 1;
                                @endphp
                                @php
                                    if ($i <= 3 && $i > 1) {
                                        echo ' • ';
                                    }
                                @endphp
                                {{ $item->name }}
                                &nbsp;
                            @endforeach
                        </div>
                    </div>

                    <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between">
                        <div class="skeleton">
                            <a class="orange-hover" href="#!"
                                onclick="view_maps('{{ $data->id_restaurant }}')"><i
                                    class="fa-solid fa-location-dot text-13 text-orange"></i>
                                {{ $data->location->name ?? __('user_page.Location not found') }}</a>
                            </a>
                        </div>
                        <div class="skeleton">
                            @if ($data->price->name == 'Cheap Prices')
                                <span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true"
                                    data-bs-placement="bottom"
                                    title="{{ Translate::translate($data->price->name) }}">$</span>
                            @elseif ($data->price->name == 'Middle Range')
                                <span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true"
                                    data-bs-placement="bottom"
                                    title="{{ Translate::translate($data->price->name) }}">$$</span>
                            @elseif ($data->price->name == 'Fine Dining')
                                <span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true"
                                    data-bs-placement="bottom"
                                    title="{{ Translate::translate($data->price->name) }}">$$$</span>
                            @else
                                <span>{{ __('user_page.no price rate yet') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Grid 43 -->
    </div>
    @if (count($restaurants) != 0)
        <div class="col-12" id="view-map-button-float">
            <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4 {{ $shadowColor }}">
                <button onclick="view_main_map()" style="height:inherit;">
                    <!-- partial:index.partial.html -->
                    {{-- <svg aria-hidden="true" style="width: 0; height: 0; overflow: hidden;" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <symbol id="icon-world" viewBox="0 0 216 100">
                            <g fill-rule="nonzero">
                                <path
                                    d="M48 94l-3-4-2-14c0-3-1-5-3-8-4-5-6-9-4-11l1-4 1-3c2-1 9 0 11 1l3 2 2 3 1 2 8 2c1 1 2 2 0 7-1 5-2 7-4 7l-2 3-2 4-2 3-2 1c-2 2-2 9 0 10v1l-3-2zM188 90l3-2h1l-4 2zM176 87h2l-1 1-1-1zM195 86l3-2-2 2h-1zM175 83l-1-2-2-1-6 1c-5 1-5 1-5-2l1-4 2-2 4-3c5-4 9-5 9-3 0 3 3 3 4 1s1-2 1 0l3 4c2 4 1 6-2 10-4 3-7 4-8 1zM100 80c-2-4-4-11-3-14l-1-6c-1-1-2-3-1-4 0-2-4-3-9-3-4 0-5 0-7-3-1-2-2-4-1-7l3-6 3-3c1-2 10-4 11-2l6 3 5-1c3 1 4 0 5-1s-1-2-2-2l-4-1c0-1 3-3 6-2 3 0 3 0 2-2-2-2-6-2-7 0l-2 2-1 2-3-2-3-3c-1 0-1 1 1 2l1 2-2-1c-4-3-6-2-8 1-2 2-4 3-5 1-1-1 0-4 2-4l2-2 1-2 3-2 3-2 2 1c3 0 7-3 5-4l-1-3h-1l-1 3-2 2h-1l-2-1c-2-1-2-1 1-4 5-4 6-4 11-3 4 1 4 1 2 2v1l3-1 6-1c5 0 6-1 5-2l2 1c1 2 2 2 2 1-2-4 12-7 14-4l11 1 29 3 1 2-3 3c-2 0-2 0-1 1l1 3h-2c-1-1-2-3-1-4h-4l-6 2c-1 1-1 1 2 2 3 2 4 6 1 8v3c1 3 0 3-3 0s-4-1-2 3c3 4 3 7-2 8-5 2-4 1-2 5 2 3 0 5-3 4l-2-1-2-2-1-1-1-1-2-2c-1-2-1-2-4 0-2 1-3 4-3 5-1 3-1 3-3 1l-2-4c0-2-1-3-2-3l-1-1-4-2-6-1-4-2c-1 1 3 4 5 4h2c1 1 0 2-1 4-3 2-7 4-8 3l-7-10 5 10c2 2 3 3 5 2 3 0 2 1-2 7-4 4-4 5-4 8 1 3 1 4-1 6l-2 3c0 2-6 9-8 9l-3-2zm22-51l-2-3-1-1v-1c-2 0-2 2-1 4 2 3 4 4 4 1z" />
                                <path
                                    d="M117 75c-1-2 0-6 2-7h2l-2 5c0 2-1 3-2 1zM186 64h-3c-2 0-6-3-5-5 1-1 6 1 7 3l2 3-2-1zM160 62h2c1 1 0 1-1 1l-1-1zM154 57l-1-2c2 2 3 1 2-2l-2-3 2 2 1 4 1 3v2l-3-4zM161 59c-1-1-1-2 1-4 3-3 4-3 4 0 0 4-2 6-5 4zM167 59l1-1 1 1-1 1-1-1zM176 59l1-1v2l-1-1zM141 52l1-1v2l-1-1zM170 52l1-1v2l-1-1zM32 50c-1-2-4-3-6-4-4-1-5-3-7-6l-3-5-2-2c-1-3-1-6 2-9 1-1 2-3 1-5 0-4-3-5-8-4H4l2-2 1-1 1-1 2-1c1-2 7-2 23-1 12 1 12 1 12-1h1c1 1 2 2 3 1l1 1-3 1c-2 0-8 4-8 5l2 1 2 3 4-3c3-4 4-4 5-3l3 1 1 2 1 2c3 0-1 2-4 2-2 0-2 0-2 2 1 1 0 2-2 2-4 1-12 9-12 12 0 2 0 2-1 1 0-2-2-3-6-2-3 0-4 1-4 3-2 4 0 6 3 4 3-1 3-1 2 1s-1 2 1 2l1 2 1 3 1 1-3-2zm8-24l1-1c0-1-4-3-5-2l1 1v2c-1 1-1 1 0 0h3zM167 47v-3l1 2c1 2 0 3-1 1z" />
                                <path
                                    d="M41 43h2l-1 1-1-1zM37 42v-1l2 1h-2zM16 38l1-1v2l-1-1zM172 32l2-3h1c1 2 0 4-3 4v-1zM173 26h2l-1 1-1-1zM56 22h2l-2 1v-1zM87 19l1-2 1 3-1 1-1-2zM85 19l1-1v1l-1 1v-1zM64 12l1-3c2 0-1-4-3-4s-2 0 0-1V3l-6 2c-3 1-3 1-2-1 2-1 4-2 15-2h14c0 2-6 7-10 9l-5 2-2 1-2-2zM53 12l1-1c2 0-1-3-3-3-2-1-1-1 1-1l4 2c2 1 2 1 1 3-2 1-4 2-4 0zM80 12l1-1 1 1-1 1-1-1zM36 8h-2V7c1-1 7 0 7 1h-5zM116 7l1-1v1l-1 1V7zM50 5h2l-1 1-1-1zM97 5l2-1c0-1 1-1 0 0l-2 1z" />
                            </g>
                        </symbol>
                        <symbol id="icon-repeated-world" viewBox="0 0 432 100">
                            <use href="#icon-world" x="0"></use>
                            <use href="#icon-world" x="189"></use>
                        </symbol>
                    </defs>
                </svg> --}}

                    <div class="notice">
                        <span class="world">
                            <span class="images" style="color: #52EB35;">
                                <img src="{{ asset('assets/earth.svg') }}" alt="Earth SVG">
                                {{-- <svg>
                                <use href="#icon-repeated-world"></use>
                            </svg> --}}
                            </span>
                        </span>
                    </div>
                    <!-- partial -->
                </button>
            </div>
        </div>
    @endif

    <!-- End Refresh Page -->
    </div>
    <!-- End Page Content -->

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center" id="footer">
        <div class="mt-3">
            {{ $restaurant->onEachSide(0)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
    </div>

    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.auth.login_register')
    @include('user.modal.restaurant.category')
    @include('user.modal.restaurant.sub_category')
    @include('user.modal.restaurant.intro')
    {{-- modal laguage and currency --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

    <script>
        $(document).ready(function() {
            if (sessionStorage.getItem('#popup') !== 'true') {
                $('#popup').modal('show');
                sessionStorage.setItem('#popup', true);
            }
        });
    </script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $(".js-slider").each(function(i, el) {
                var sliderLength = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        sliderLength = parseInt($(this).attr("data-slick-index"));
                        maxSlickIndex = sliderLength;
                    }
                })
                var dotsContainer = $(this).parent().find(".dots-container");
                if (sliderLength >= 4) {
                    for (var j = 0; j <= 4; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                } else if (sliderLength > 0 && sliderLength <= 4 && sliderLength != 0) {
                    for (var j = 0; j <= sliderLength; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                }
            });
            $('.js-slider').on("afterChange", function(e) {
                var currSlickIndex = parseInt($(this).find(".slick-current").attr("data-slick-index"));
                var maxSlickIndex = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        maxSlickIndex = parseInt($(this).attr("data-slick-index"));
                    }
                })
                var allDots = $(this).parent().find(".dots-container").find(".circle");
                var dots = $(this).parent().find(".dots-container").find(".circle");
                if (maxSlickIndex > 5) {
                    if (currSlickIndex > 1 && currSlickIndex <= maxSlickIndex - 2) {
                        allDots.removeClass("activeIndicator");
                        dots[2].classList.add("activeIndicator");
                    } else if (currSlickIndex <= 1) {
                        allDots.removeClass("activeIndicator");
                        dots[currSlickIndex].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex - 1) {
                        allDots.removeClass("activeIndicator");
                        dots[3].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex) {
                        allDots.removeClass("activeIndicator");
                        dots[4].classList.add("activeIndicator");
                    }
                } else {
                    allDots.removeClass("activeIndicator");
                    dots[currSlickIndex].classList.add("activeIndicator");
                }
            });
            $('.js-slider .slick-next').css('display', 'none');
            $('.js-slider .slick-prev').css('display', 'none');
            $('.js-slider').mouseenter(function(e) {
                $(this).children('.slick-prev').css('display', 'block');
                $(this).children('.slick-next').css('display', 'block');
            })
            $('.js-slider').mouseleave(function(e) {
                $(this).children('.slick-prev').css('display', 'none');
                $(this).children('.slick-next').css('display', 'none');
            })
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

    {{-- FILTER RESTAURANT LIST --}}
    <script>
        function restaurantRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/food/search?${suburl}`;
        }

        function foodFilter(valueCuisine, valueSub, unCheckCategory, whatToEat) {
            var sLocationFormInput = $("input[name='sLocation']").val();

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            if (unCheckCategory == true) {
                var url_food = window.location.href;
                var url2 = new URL(url_food);

                if (url2.searchParams.get('fCuisine') == valueCuisine) {
                    valueCuisine = '';
                }
            }

            setCookie2("sLocation", sLocationFormInput, 1);

            var sCuisineFormInput = [];
            $("input[name='sKeywords[]']:checked").each(function() {
                sCuisineFormInput.push(parseInt($(this).val()));
            });

            if (whatToEat == true) {
                var sKeywordFormInput = function() {
                    var tmp = null;
                    $.ajax({
                        async: false,
                        type: "GET",
                        global: false,
                        dataType: 'json',
                        url: "/food/subcategory",
                        data: {
                            name: $("input[name='sKeyword']").val()
                        },
                        success: function(response) {
                            tmp = response.data;
                        }
                    });
                    return tmp;
                }();
            }

            var filterFormInput = [];

            $("input[name='subCategory[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });

            if (whatToEat == true) {
                filterFormInput.push(sKeywordFormInput);
                var filteredArray = filterFormInput
            } else if (filterFormInput.includes(valueSub) == true) {
                if (whatToEat == true) {
                    filterFormInput.push(sKeywordFormInput);
                }
                var filterCheck = filterFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueSub;
                }

                var filteredArray = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                filterFormInput.push(valueSub);
                if (whatToEat == true) {
                    filterFormInput.push(sKeywordFormInput);
                }
                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }

            if (valueCuisine == null) {
                subArray = [];
                filteredArray.forEach(element => {
                    if (element !== null) {
                        subArray.push(element);
                    }
                });
                var subUrl =
                    `sLocation=${sLocationFormInput}&fCuisine=&fSubCategory=${subArray}`;
            } else {
                subArray = [];
                filteredArray.forEach(element => {
                    if (element !== null) {
                        subArray.push(element);
                    }
                });
                var subUrl =
                    `sLocation=${sLocationFormInput}&fCuisine=${valueCuisine}&fSubCategory=${subArray}`;
            }

            restaurantRefreshFilter(subUrl);
        }
    </script>

    {{-- <script>
        function restaurantFilter() {
            var fLocationFormInput = [];
            $("input[name='fLocation[]']:checked").each(function() {
                fLocationFormInput.push(parseInt($(this).val()));
            });

            var fTypeFormInput = [];
            $("input[name='fType[]']:checked").each(function() {
                fTypeFormInput.push(parseInt($(this).val()));
            });

            var fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });

            var fPriceFormInput = [];
            $("input[name='fPrice[]']:checked").each(function() {
                fPriceFormInput.push(parseInt($(this).val()));
            });

            var fMealFormInput = [];
            $("input[name='fMeal[]']:checked").each(function() {
                fMealFormInput.push(parseInt($(this).val()));
            });

            var fCuisineFormInput = [];
            $("input[name='fCuisine[]']:checked").each(function() {
                fCuisineFormInput.push(parseInt($(this).val()));
            });

            var fDishesFormInput = [];
            $("input[name='fDishes[]']:checked").each(function() {
                fDishesFormInput.push(parseInt($(this).val()));
            });

            var fDietaryfoodFormInput = [];
            $("input[name='fDietaryfood[]']:checked").each(function() {
                fDietaryfoodFormInput.push(parseInt($(this).val()));
            });

            var fDietaryfoodFormInput = [];
            $("input[name='fDietaryfood[]']:checked").each(function() {
                fDietaryfoodFormInput.push(parseInt($(this).val()));
            });

            var fGoodforFormInput = [];
            $("input[name='fGoodfor[]']:checked").each(function() {
                fGoodforFormInput.push(parseInt($(this).val()));
            });

            var sLocationFormInput = $("input[name='sLocation']").val();

            var sCuisineFormInput = [];
            $("input[name='sKeywords[]']:checked").each(function() {
                sCuisineFormInput.push(parseInt($(this).val()));
            });

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            setCookie2("sLocation", sLocationFormInput, 1);


            var sKeywordFormInput = $("input[name='sKeyword']").val();

            var subUrl =
                `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}`;
            restaurantRefreshFilter(subUrl);
        }
    </script> --}}
    <script>
        // Show modal pop up on first time visit
        var isshow = localStorage.getItem('isshow');
        if (isshow== null) {
        localStorage.setItem('isshow', 1);
        // Show popup here
        setTimeout(function(){
            jQuery('#introModal').modal('show');
            },5000);
        }
    </SCRIPT>

    {{-- Like Favorit --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like Favorit --}}

    {{-- MAP --}}
    @include('user.modal.restaurant.list.map')
    {{-- END MAP --}}

    {{-- VIDEO --}}
    @include('user.modal.restaurant.list.video')
    {{-- END VIDEO --}}

    {{-- LAZY LOAD --}}
    @include('components.lazy-load.lazy-load')
    {{-- END LAZY LOAD --}}
    <script src="{{ asset('assets/js/translate.js') }}"></script>
@endsection
