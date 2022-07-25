@extends('layouts.user.list')

@section('title', 'List of Hotel - EZV2')

@section('content')
    {{-- function get data --}}

    @php
    $hotels = $hotel->shuffle();
    $list = [];
    foreach ($hotels as $item) {
        array_push($list, $item->id_hotel);
    }
    $scenic_views = App\Models\ScenicViews::all();

    if (request()->fCategory) {
        $fCategory = request()->fCategory;
    } else {
        $fCategory = '';
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

    <style>
        .text-orange:hover {
            color: #ff7400;
        }

        .orange-hover:hover {
            cursor: pointer;
        }

        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }
    </style>
    {{-- function get data --}}

    <div id="body-color" class="{{ $bgColor }}" style="position: relative;">
        <!-- Page Content -->
        <div id="div-to-refresh" class="container__list">
            <!-- Refresh Page -->
            <!-- <div class="col-lg-12"> -->
            <div id="filter-cat-bg-color" style="width: 100%;"
                class="container-grid-cat translate-text-group {{ $bgColor }} top-min-10p pb-10p" style="">
                @foreach ($hotelCategory->take(6) as $item)
                    <div>
                        <a class="grid-img-container" onclick="hotelFilter({{ $item->id_hotel_category }}, null, true)">
                            <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                                @if ($fCategory == $item->id_hotel_category) style="border: 5px solid #ff7400;" @endif
                                data-src="https://source.unsplash.com/random/?{{ $item->name }}">
                            <div class="grid-text translate-text-group-items">
                                {{ $item->name }}
                            </div>
                        </a>
                    </div>
                @endforeach

                <div>
                    <a class="grid-img-container" onclick="moreCategory()">
                        <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                            data-src="https://source.unsplash.com/random/?bali">
                        <div class="grid-text">
                            {{ __('user_page.More') }}
                        </div>
                    </a>
                </div>
            </div>

            <div class="stickySubCategory">
                <div id="filter-subcat-bg-color" style="width: 100%;"
                    class="container-grid-sub-cat translate-text-group {{ $bgColor }} pt-15p pb-15p" style="">

                    <div class="button-dropdown grid-sub-cat-content-container text-13">
                        <a href="javascript:void(0)" id="sortBy" style="cursor:pointer;" class="dropdown-toggle">
                            <div>
                                <i class="fa fa-solid fa-sliders text-18 list-description  {{ $textColor }} sub-icon">
                                </i>
                            </div>
                            <div class="list-description {{ $textColor }}">Sort by</div>
                        </a>
                        <div class="sort-popup dropdown-menu text-center">
                            <h5 style="margin-bottom: 0;">Sort by</h5>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Highest to Lowest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="highest"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'highest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Lowest to Highest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="lowest"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'lowest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Popularity
                                <input type="checkbox" class="fSort" name="fSort[]" value="popularity"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'popularity') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Best Reviewed
                                <input type="checkbox" class="fSort" name="fSort[]" value="best_reviewed"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'best_reviewed') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                        onclick="modalFiltersHotel()">
                        <div>
                            <i class="fas fa-dollar-sign text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <div class="list-description {{ $textColor }}">Price</div>
                    </div>
                    @foreach ($hotelFilter->take(5)->sortBy('order') as $item)
                        <div class="grid-sub-cat-content-container text-13 "
                            onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_hotel_filter }}, false)">
                            <div>
                                <i class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                                    @php
                                        $isChecked = '';
                                        $filterIds = explode(',', request()->get('filter'));
                                    @endphp @if (in_array($item->id_hotel_filter, $filterIds))
                                    style="color: #ff7400 !important;"
                    @endif>
                    </i>
                </div>
                <div class="list-description {{ $textColor }} translate-text-group-items">
                    {{ $item->name }}
                </div>
            </div>
            @endforeach

            <div class="grid-sub-cat-content-container text-13 list-description {{ $textColor }}"
                onclick="modalFiltersHotel()">
                <div>
                    <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">
                    {{ __('user_page.Filters') }}
                </div>
            </div>
            <div class="grid-sub-cat-content-container text-13 list-description {{ $textColor }}"
                onclick="modalFiltersHotel()">
                <div>
                    <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">
                    {{ __('user_page.Filters') }}
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    @if (count($hotel) == 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mt-4">
                        <img style="height: 53vh;" class="img-fluid p-4"
                            src="{{ asset('assets/partner/template/assets/img/freepik/filter_data_unavailable.svg') }}"
                            alt="" />
                        <p class="lead" style="font-weight: 700; color: #ff7400;">Hotel data not available</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-12 container-grid-hotel container__grid mt-0 mt-lg-10p">
        @foreach ($hotel as $data)
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
                            $cekHotel = App\Models\HotelSave::where('id_hotel', $data->id_hotel)
                                ->where('id_user', Auth::user()->id)
                                ->first();
                        @endphp

                        @if ($cekHotel == null)
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_hotel }}, 'hotel')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button favorite-button-28 likeButtonhotel{{ $data->id_hotel }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_hotel }}, 'hotel')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button-active favorite-button-28 unlikeButtonhotel{{ $data->id_hotel }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    @endauth
                    <div class="like-sign like-sign-hotel-{{ $data->id_hotel }}">
                        <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                    </div>

                    <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank" class="absolute-right">
                        <div class="video-thumb-container skeleton">
                            <div class="video-thumb-content">
                                <i class="fas fa-2x fa-play video-button"></i>
                                @if ($data->video->count() > 0)
                                    <video class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/hotel/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                @elseif ($data->photo->count() > 0)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/hotel/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                                @elseif ($data->image != null)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/hotel/' . strtolower($data->uid) . '/' . $data->image) }}">
                                @else
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                @endif
                            </div>
                        </div>
                    </a>

                    <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                        <input type="hidden" value="{{ $data->id_hotel }}" id="id_hotel" name="id_hotel">
                        <div class="dots-container d-flex justify-content-center"></div>
                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white skeleton skeleton-w-100 skeleton-h-lg"
                            data-dots="false" data-arrows="true">

                            @forelse ($data->photo->sortBy('order') as $item)
                                <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                    class="col-lg-6 grid-image-container">
                                    <img class="lozad img-fluid grid-image aspect-ratio-3 h-auto" style="display: block;"
                                        src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/hotel/' . strtolower($data->uid) . '/' . $item->name) }}"
                                        alt="EZV_{{ $item->name }}">
                                </a>
                            @empty
                                @if ($data->image)
                                    <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-3 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/hotel/' . strtolower($data->uid) . '/' . $item->name) }}"
                                            alt="EZV_{{ $data->image }}">
                                    </a>
                                @else
                                    <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-3 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                            alt="EZV_no-image.jpeg">
                                    </a>
                                @endif
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="desc-container-grid " style="z-index:0;">
                    <a href="{{ route('hotel', $data->id_hotel) }}" target="_blank" class="grid-overlay-desc"
                        style="height: 25%;z-index:0;"></a>
                    <div class=" skeleton skeleton-w-100 skeleton-h-2">
                        <span class="text-14 fw-500 {{ $textColor }} list-description">
                            {{ $data->name ?? __('user_page.There is no name yet') }}
                        </span>
                    </div>
                    <div class="grid-one-line max-lines skeleton skeleton-w-100 skeleton-h-1" style="z-index:1">
                        <div class="d-block d-md-flex">
                            <div class="flex-fill">
                                <a class="text-12 fw-400 grid-one-line text-orange mt-1 " href="#!"
                                    onclick="view_maps('{{ $data->id_hotel }}')"><i
                                        class="fa-solid text-orange fa-location-dot"></i>
                                    {{ $data->location_name ?? __('user_page.Location not found') }}
                                </a>
                                <a class="text-12 fw-400 grid-one-line text-orange mt-1 " href="#!">
                                    - {{ number_format($data->km, 1) }}
                                    {{ __('user_page.km to') }}
                                    {{ $data->airport }}
                                </a>
                            </div>
                            @if ($data->star)
                                <div class="text-13 text-md-end">
                                    <span>{{ $data->star }} Stars</span>
                                    <i class="fa-solid fa-star" style="color: #febb02"></i>
                                </div>
                            @else
                                <div class="text-13 text-md-end">
                                    <span>No stars yet</span>
                                    <i class="fa-solid fa-star" style="color: #febb02"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class=" grid-one-line max-lines col-lg-10 skeleton skeleton-w-100 skeleton-h-1">
                        <div class="d-flex">
                            <span class="text-14 fw-400 text-grey-2 grid-one-line max-lines">
                                {{ Translate::translate($data->description) ?? __('user_page.There is no description yet') }}
                            </span>
                            <span class="text-12 fw-400"><a class="orange-hover"
                                    onclick='view_details_hotel({{ $data->id_hotel }})'>{{ __('user_page.More Details') }}</a></span>
                        </div>
                    </div>
                    <div class="mt-2 grid-one-line skeleton skeleton-w-100 skeleton-h-5">
                        <div class="row">
                            <div class="col-6 pe-0">
                                <div class="d-flex flex-column h-100">
                                    <div class="flex-fill">
                                        <p class="text-14 fw-400 grid-one-line mb-0">
                                            Fully Furlindable
                                        </p>
                                        <p class="text-14 fw-400 grid-one-line mb-0">
                                            Reserve now pay later
                                        </p>
                                    </div>
                                    <div>
                                        @if ($data->detailReview)
                                            <p class="text-14 fw-600 grid-one-line max-lines mb-0">
                                                {{ $data->detailReview->average }}/5
                                            </p>
                                            <a class="text-12 fw-400 grid-one-line text-orange mt-1" href="#"
                                                onclick="view_details_hotel({{ $hotel[0]->id_hotel }})">
                                                Review
                                            </a>
                                        @else
                                            <p class="text-14 fw-400 grid-one-line max-lines mb-0">
                                                No reviews yet
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ps-0">
                                <div class="d-flex flex-column h-100">
                                    <div class="flex-fill max-lines-2"></div>
                                    <div class="text-end">
                                        <div class="text-14 grid-one-line  mt-1 skeleton skeleton-w-50 skeleton-h-1">
                                            <span class="fw-400 {{ $textColor }} list-description">
                                                1 {{ __('user_page.night') }}
                                            </span>
                                            <span class="fw-400 {{ $textColor }} list-description">
                                                ,
                                                {{ $data->adult }}
                                                @if (in_array($data->adult, [0, 1]))
                                                    adult
                                                @else
                                                    adults
                                                @endif
                                            </span>
                                        </div>
                                        <div class="text-18 grid-one-line  mt-1 skeleton skeleton-w-50 skeleton-h-1">
                                            @if ($data->price)
                                                <span class=" fw-600 {{ $textColor }} list-description ">
                                                    {{ CurrencyConversion::exchangeWithUnit($data->price) }}
                                                </span>
                                            @else
                                                <span class="fw-400 {{ $textColor }} list-description">
                                                    {{ __('user_page.Price is unknown') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-12 grid-one-line  mt-1 skeleton skeleton-w-50 skeleton-h-1">
                                            <span class="fw-400 {{ $textColor }} list-description">
                                                Included taxes and changes
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($hotel) != 0)
        <div class="col-12" id="view-map-button-float">
            <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4 {{ $shadowColor }}">
                <button onclick="view_main_map()" style="height:inherit;">
                    <div class="notice">
                        <span class="world">
                            <span class="images" style="color: #52EB35;">
                                <img src="{{ asset('assets/earth.svg') }}" alt="Earth SVG">
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
    <!-- End Grid 43 -->
    </div>
    <!-- End Page Content -->
    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center" id="footer">
        <div class="mt-3">
            {{ $hotel->onEachSide(0)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.auth.login_register')
    @include('user.modal.hotel.category')
    @include('user.modal.filter.filter_modal_hotel')
    @include('user.modal.hotel.filter')
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
                        <p><span id="video-detail-bedrooms"></span>Bedroom, <span id="video-detail-bathrooms"></span>
                            Bathroom, <span id="video-detail-bedss"></span>
                            Beds</p>
                        <div class="row fac" style="padding-top: 0">
                            <div class="text-white" id="video-detail-price">IDR
                                999,999/night</div>
                            <div class="short-desc" id="video-detail-short-description"></div>
                            <!-- End Villa Bed Type -->
                            <div class="vid-address">
                                <i class="fa fa-map-pin"></i> <span id="video-detail-location"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

    {{-- Like Favorit --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like Favorit --}}

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
    {{-- END SHOW VIDEO --}}

    {{-- SEARCH FUNCTION --}}
    <script>
        function hotelRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/hotel/search?${suburl}`;
        }
        $("input[name='fSort[]']").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });

        function hotelFilter(valueCategory, valueClick, unCheckCategory) {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sCheck_inFormInput = $("input[name='sCheck_in']").val();
            var sCheck_outFormInput = $("input[name='sCheck_out']").val();
            var sAdultFormInput = $("input[name='sAdult']").val();
            var sChildFormInput = $("input[name='sChild']").val();
            var fSortFormInput = $('.fSort:checked').val();
            if (fSortFormInput == undefined) {
                var fSortFormInput = '';
            }

            var filterFormInput = [];
            var fCategoryFormInput = [];

            var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();
            var fMinPriceFormInput = $("input[name='fMinPrice']").val();

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
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);

            if (unCheckCategory == true) {
                var url_hotel = window.location.href;
                var url2 = new URL(url_hotel);

                if (url2.searchParams.get('fCategory') == valueCategory) {
                    valueCategory = '';
                }
            }

            if (valueCategory != null) {
                $("input[name='fCategory[]']").prop("checked", false);
                $("input[name='fCategory[]']:checked").each(function() {
                    fCategoryFormInput.push(parseInt($(this).val()));
                });
                if (fCategoryFormInput.includes(valueCategory) == true) {
                    var filterCheck = fCategoryFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueCategory;
                    }

                    var filteredCategory = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    fCategoryFormInput.push(valueCategory);

                    var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                        return fCategoryFormInput.indexOf(item) == pos;
                    });
                }
            } else {
                $("input[name='fCategory[]']:checked").each(function() {
                    fCategoryFormInput.push(parseInt($(this).val()));
                });

                var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                    return fCategoryFormInput.indexOf(item) == pos;
                });
            }

            if (valueClick != null) {
                $("input[name='filter[]']:checked").each(function() {
                    filterFormInput.push(parseInt($(this).val()));
                });
                if (filterFormInput.includes(valueClick) == true) {
                    var filterCheck = filterFormInput.filter(unCheck);

                    function unCheck(dataCheck) {
                        return dataCheck != valueClick;
                    }

                    var filteredArray = filterCheck.filter(function(item, pos) {
                        return filterCheck.indexOf(item) == pos;
                    });
                } else {
                    filterFormInput.push(valueClick);

                    var filteredArray = filterFormInput.filter(function(item, pos) {
                        return filterFormInput.indexOf(item) == pos;
                    });
                }
            } else {
                $("input[name='filter[]']:checked").each(function() {
                    filterFormInput.push(parseInt($(this).val()));
                });

                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }

            var subUrl =
                `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fCategory=${filteredCategory}&filter=${filteredArray}&fSort=${fSortFormInput}`;

            hotelRefreshFilter(subUrl);
        }
    </script>

    {{-- END SEARCH FUNCTION --}}

    {{-- MAP --}}
    @include('user.modal.hotel.list.map')
    {{-- END MAP --}}
    {{-- DETAILS --}}
    {{-- @include('user.modal.hotel.list.details') --}}
    @include('user.modal.hotel.list.details_hotel')

    <script>
        function renderRating(rating) {
            switch(Math.floor(rating)) {
                case 1:
                    return "bar-1"
                    break;
                case 2:
                    return "bar-2"
                    break;
                case 3:
                    return "bar-3"
                    break;
                case 4:
                    return "bar-4"
                    break;
                case 5:
                    return "bar-5"
                    break;
            }
        }
        function view_details_hotel(id) {
            $.ajax({
                type: "GET",
                url: `/hotel/details/${id}`,
                success: (data) => {
                    console.log(data);
                    console.log(data.detail_review.average);
                    $('.name-hotel').html(data.name);
                    $('#descHotel').html(data.description);

                    var lengthAmenities = data.amenities.length;
                    $('#amenitiesList').html('');
                    for (i = 0; i < lengthAmenities; i++) {
                        $('#amenitiesList').append(`
                        <div class = "col-md-6 mb-2" >
                            <span class = 'translate-text-group-items'>
                                ${data.amenities[i].name}
                            </span>
                        </div>`);
                    }

                    $('#average_show').empty();
                    $('#average_clean_show').empty();
                    $('#average_service_show').empty();
                    $('#average_check_in_show').empty();
                    $('#average_value_show').empty();
                    $('#average_location_show').empty();

                    $('#average_show').html(`${data.detail_review.average}/5`);
                    $('#average_clean_show').html(
                        `<div class="liner ${renderRating(data.detail_review.average_clean)}"></div>${data.detail_review.average_clean}`);
                    $('#average_service_show').html(
                        `<div class="liner ${renderRating(data.detail_review.average_clean)}"></div>${data.detail_review.average_service}`);
                    $('#average_check_in_show').html(
                        `<div class="liner ${renderRating(data.detail_review.average_clean)}"></div>${data.detail_review.average_check_in}`);
                    $('#average_location_show').html(
                        `<div class="liner ${renderRating(data.detail_review.average_clean)}"></div>${data.detail_review.average_location}`);
                    $('#average_value_show').html(
                        `<div class="liner ${renderRating(data.detail_review.average_clean)}"></div>${data.detail_review.average_value}`);

                }
            });

            $('#modal-details').modal('show');
        }
    </script>
    {{-- END DETAILS --}}
    <script src="{{ asset('assets/js/translate.js') }}"></script>
    <script src="{{ asset('assets/js/price-range.js') }}"></script>
@endsection
