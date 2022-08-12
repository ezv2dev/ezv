@php
$villas = $villa;
$list = [];
foreach ($villas as $item) {
    array_push($list, $item->id_villa);
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
        $listColor = 'listoption-dark';
        $shadowColor = 'box-shadow-dark';
    }
}
@endphp
<style>
    .ml-responsive {
        margin-left: 0px;
    }

    @media screen and (min-width: 992px) {
        .ml-responsive {
            margin-left: 20px;
        }
    }
</style>
<script>
    $(window).on('load resize', ()=>{
        var width = $(window).width();
        var height = $(window).height();

        if ((width >= 500)) {
            $(".villa-list-price-trigger").attr("onclick", "modal_price_breakdown(this)");
        }
        else {
            $(".villa-list-price-trigger").attr("onclick", "showpricebreakdown(this)");
            $(".price-breakdown-overlay").addClass("d-none");
            $(".price-breakdown-mobile").removeClass("price-breakdown-mobile-expand");
        }
    });

    function modal_price_breakdown(e) {
        let id_villa = e.getAttribute("data-villa");
        $('#modal_price_breakdown-'+id_villa).modal('show');
    }
</script>

<div class="price-breakdown-overlay d-none" onclick="closepricebreakdown()"></div>
@if (count($villas) == 0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mt-4">
                    <img style="height: 53vh;" class="img-fluid p-4"
                        src="{{ asset('assets/partner/template/assets/img/freepik/filter_data_unavailable.svg') }}"
                        alt="" />
                    <p class="lead" style="font-weight: 700; color: #ff7400;">Homes data not available</p>
                </div>
            </div>
        </div>
    </div>
@endif

@foreach ($villas as $data)
    <div class="row list-row-gap pt-xxs-20p pt-xs-15p pt-sm-35p pt-xlg-0p pt-lg-10p pb-0">
        <!-- Left Sedtion -->
        <div class="col-lg-6 py-0 col-xs-12 list-image-container grid-desc-container list-image-container">
            <div class="content list-image-content list-image-content-villa">
                @guest
                    <div class="list-like-button-container"
                        style="position: absolute; left: 57px; top: 0px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                        <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                            onclick="loginForm(1)">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                role="presentation" focusable="false" class="favorite-button favorite-button-28">
                                <path
                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class="absolute-right"  id="villa-list-video-mobile">
                        <div class="villa-list-video-container video-show-buttons">
                            <i class="fas fa-2x fa-play video-button"></i>
                            @if ($data->video->count() > 0)
                                <video class="villa-list-video" loading="lazy"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                            @elseif ($data->photo->count() > 0)
                                <img class="villa-list-video" loading="lazy"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                            @elseif ($data->image != null)
                                <img class="villa-list-video" loading="lazy"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}">
                            @else
                                <img class="villa-list-video" loading="lazy"
                                    src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                        </div>
                    </a>
                @endguest

                @auth
                    @php
                        $cekVilla = App\Models\VillaSave::where('id_villa', $data->id_villa)
                            ->where('id_user', Auth::user()->id)
                            ->first();
                    @endphp

                    @if ($cekVilla == null)
                        <div class="list-like-button-container"
                            style="position: absolute; left: 57px; top: 0px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                            <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                onclick="likeFavorit({{ $data->id_villa }}, 'villa')">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    class="favorite-button favorite-button-28 likeButtonvilla{{ $data->id_villa }}">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class="absolute-right" id="villa-list-video-mobile">
                            <div class="villa-list-video-container video-show-buttons">
                                <i class="fas fa-2x fa-play video-button"></i>
                                @if ($data->video->count() > 0)
                                    <video class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                @elseif ($data->photo->count() > 0)
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                                @elseif ($data->image != null)
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}">
                                @else
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                @endif
                            </div>
                        </a>
                    @else
                        <div class="list-like-button-container"
                            style="position: absolute; left: 57px; top: 0px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                            <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                                onclick="likeFavorit({{ $data->id_villa }}, 'villa')">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false"
                                    class="favorite-button-active favorite-button-28 unlikeButtonvilla{{ $data->id_villa }}">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class="absolute-right" id="villa-list-video-mobile">
                            <div class="villa-list-video-container video-show-buttons">
                                <i class="fas fa-2x fa-play video-button"></i>
                                @if ($data->video->count() > 0)
                                    <video class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                @elseif ($data->photo->count() > 0)
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                                @elseif ($data->image != null)
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}">
                                @else
                                    <img class="villa-list-video" loading="lazy"
                                        src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                @endif
                            </div>
                        </a>
                    @endif
                @endauth

                <div class="like-sign like-sign-villa-{{ $data->id_villa }}">
                    <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                </div>
                <input type="hidden" value="{{ $data->id_villa }}" id="id_villa" name="id_villa">
                <div class="skeleton skeleton-h-100 skeleton-w-100">
                    <div class="dots-container d-flex justify-content-center"></div>
                    <div class="js-slider-2 list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                        data-dots="false" data-arrows="true">
                        @php
                            $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                        @endphp
                        @forelse ($gallery->sortBy('order') as $item)
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                class="col-lg-6 list-image-container">
                                <img class="lozad img-fluid grid-image" style="display: block;" loading="lazy"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $item->photo) }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $item->photo) }}"
                                    alt="EZV_{{ $item->photo }}">
                            </a>
                        @empty
                            @if ($data->image)
                                <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                    class="col-lg-6 list-image-container">
                                    <img class="lozad img-fluid grid-image" style="display: block;" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}"
                                        data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}"
                                        alt="EZV_{{ $data->image }}">
                                </a>
                            @else
                                <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                    class="col-lg-6 list-image-container ">
                                    <img class="lozad img-fluid grid-image" style="display: block;" loading="lazy"
                                        src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
                                        data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
                                        alt="EZV_no-image.jpeg">
                                </a>
                            @endif
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- End Left Section -->
        <!-- Right Section -->
        <div
            class="col-lg-6 py-2 col-xs-12 list-image-container grid-desc-container list-desc-container height-list-villa">
            <div class="w-100 ml-responsive" style="position:relative;">
                <!-- Villa Description -->
                <div class="row mt-3 mt-lg-0 " style="height:100%;">
                    <div class="col-12 row">
                        <div class="col-lg-9">
                            <div class="skeleton skeleton-h-2 skeleton-lg-h-3 skeleton-w-100 mt-0">
                                <p class="villa-list-name " style="position:relative;">
                                    {{-- {{ $data->name ?? __('user_page.There is no name yet') }} --}}
                                    {{ $data->name ?? __('user_page.There is no name yet') }}
                                    <!-- ({{ $data->grade }}) -->
                                    <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                        style="position:absolute;top:0;left:0;right:0;bottom:0;"></a>
                                </p>
                            </div>
                            <div class="cursor-pointer skeleton skeleton-h-2 skeleton-w-100"
                                onclick="view_maps('{{ $data->id_villa }}')">
                                <div class="villa-location-description">
                                    <span class="text-orange">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $data->location->name ?? __('user_page.Location not found') }}
                                        <span class="villa-list-location-mobile text-orange">
                                            -
                                            @if (isset($data->km))
                                                {{ number_format($data->km, 1) }}
                                                {{ __('user_page.km to') }}
                                                {{ $data->airport }}
                                            @elseif(isset($data->km2))
                                                {{ number_format($data->km2, 1) }}
                                                {{ __('user_page.km to') }}
                                                {{ $data->beach }}
                                            @endif
                                        </span>
                                        <span class="villa-list-location-desktop text-orange">
                                            •
                                            @if (isset($data->km))
                                                {{ number_format($data->km, 1) }}
                                                {{ __('user_page.km to') }}
                                                {{ $data->airport }}
                                            @elseif(isset($data->km2))
                                                {{ number_format($data->km2, 1) }}
                                                {{ __('user_page.km to') }}
                                                {{ $data->beach }}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="villa-list-title">
                                <div class=" skeleton skeleton skeleton-lg-h-1 skeleton-lg-w-50"
                                    style="margin-right: 4px;">
                                    <span class="list-description {{ $textColor }}">
                                        • {{ $data->adult . ' ' . __('user_page.Guests') }}
                                    </span>
                                </div>
                                <div class="skeleton skeleton-lg-h-1 skeleton-lg-w-50">
                                    <span class="list-description {{ $textColor }} ">
                                        • {{ $data->bedroom . ' ' . __('user_page.Bedroom') }}
                                    </span>
                                </div>
                                <div class=" skeleton skeleton-lg-h-1 skeleton-lg-w-50">
                                    <span class="list-description {{ $textColor }}">
                                        • {{ $data->bathroom . ' ' . __('user_page.Bath') }}
                                    </span>
                                </div>
                                @if ($data->parking != null || $data->parking > 0)
                                    <div class="skeleton skeleton-lg-h-1 skeleton-lg-w-50">
                                        <span class="list-description {{ $textColor }} ">
                                            • {{ $data->parking . ' ' . __('user_page.Parking') }}
                                        </span>
                                    </div>
                                @endif
                                @if ($data->size != null || $data->size > 0)
                                    <div class=" skeleton skeleton-lg-h-1 skeleton-lg-w-50">
                                        <span class="list-description {{ $textColor }}">
                                            • {{ number_format($data->size) }} m<sup>2</sup>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Video Button -->
                        <div class="col-lg-3 skeleton">
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank" id="villa-list-video-desktop">
                                <div class="villa-list-video-container video-show-buttons">
                                    <i class="fas fa-2x fa-play video-button"></i>
                                    @if ($data->video->count() > 0)
                                        <video class="villa-list-video" loading="lazy"
                                            src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                    @elseif ($data->photo->count() > 0)
                                        <img class="villa-list-video" loading="lazy"
                                            src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                                    @elseif ($data->image != null)
                                        <img class="villa-list-video" loading="lazy"
                                            src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}">
                                    @else
                                        <img class="villa-list-video" loading="lazy"
                                            src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                    @endif
                                </div>
                            </a>
                        </div>

                        <div class="col-12 d-none d-sm-block villa-info-contanier" style="position:relative;">
                            <div class="villa-list-description-container skeleton skeleton-h-4 skeleton-w-100">
                                <p
                                    class="villa-list-title {{ $textColor }} list-description limit-text-list-villa">
                                    {{ Translate::translate($data->short_description) ?? __('user_page.There is no description yet') }}
                                </p>
                            </div>

                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                style="position:absolute;top:0;left:0;right:0;bottom:0;"></a>
                        </div>
                    </div>

                    <div class="col-12 d-flex align-items-end" style="position:relative;">
                        <div class="villa-list-desc-container skeleton">
                            <div>
                                <div class="villa-list-price">
                                    @if ($data->price)
                                        @if (empty($dateDiff))
                                            <span class="villa-list-price">
                                                {{ CurrencyConversion::exchangeWithUnit($data->price) }} /{{ __('user_page.night') }}
                                            </span>
                                        @else
                                            @php
                                                $disc = App\Http\Controllers\VillabookingController::get_disc(['start' => $get_check_in, 'end' => $get_check_out, 'id_villa' => $data->id_villa]);
                                                $service = App\Http\Controllers\VillabookingController::get_service(['start' => $get_check_in, 'end' => $get_check_out, 'id_villa' => $data->id_villa]);
                                                $get_total = App\Http\Controllers\VillabookingController::get_total_all(['start' => $get_check_in, 'end' => $get_check_out, 'id_villa' => $data->id_villa]);
                                            @endphp
                                            <span class="villa-list-price">
                                                {{ CurrencyConversion::exchangeWithUnit($data->price) }} /{{ __('user_page.night') }}
                                            </span>
                                            <span> • </span>
                                            <span class="villa-list-price villa-list-price-trigger" data-villa="{{ $data->id_villa }}" onclick="modal_price_breakdown(this)">
                                                {{ $get_total }} Total
                                            </span>

                                            <div class="price-breakdown-mobile" id="modal-price-{{$data->id_villa}}">
                                                <header class="price-breakdown-header p-3 d-flex justify-content-between border-bottom">
                                                    <div class="font-black">
                                                        Price Breakdown
                                                    </div>
                                                    <div onclick="closepricebreakdown()">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </div>
                                                </header>
                                                <div class="col-12">
                                                    <span>{{ CurrencyConversion::exchangeWithUnit($data->price) }} x {{$dateDiff}} nights</span>
                                                    <span>{{ CurrencyConversion::exchangeWithUnit($data->price * $dateDiff) }}</span></br>
                                                    <span>Discount</span><span>{{ $disc }}</span></br>
                                                    <span>Service Fee</span><span>{{ $service }}</span></br>
                                                </div>
                                            </div>

                                            <!-- Start modal price breakdown -->
                                            <div class="modal fade" id="modal_price_breakdown-{{$data->id_villa}}" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered"
                                                role="document" style="overflow-y: initial !important">
                                                <div class="modal-content" style="background: #fff;">
                                                    <div class="modal-header">
                                                        <h7 class="modal-title">Price Breakdown</h7>
                                                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                                                                class="fa-solid fa-xmark"></i></button>
                                                    </div>
                                                    <div class="filter-modal-body modal-body" style=" height: 70vh; overflow-y: auto;">
                                                        <span>{{ CurrencyConversion::exchangeWithUnit($data->price) }} x {{$dateDiff}} nights</span>
                                                        <span>{{ CurrencyConversion::exchangeWithUnit($data->price * $dateDiff) }}</span></br>
                                                        <span>Discount</span> <span>{{ $disc }}</span></br>
                                                        <span>Service Fee</span> <span>{{ $service }}</span></br>
                                                    </div>
                                                    <!-- Submit -->
                                                    <div class="modal-filter-footer">

                                                    </div>
                                                    <!-- END Submit -->
                                                </div>
                                            </div>
                                            </div>
                                            <!-- End modal price breakdown -->
                                        @endif
                                    @else
                                        {{ __('user_page.Price is unknown') }}
                                    @endif
                                    {{-- <span class="font-light list-description"
                                        style="padding-left: 6px; font-size: 12px;">
                                        @if ($data->detailReview)
                                            {{ $data->detailReview->average }}
                                            {{ __('user_page.villa.Reviews') }}
                                        @else
                                            {{ __('user_page.there is no reviews yet') }}
                                        @endif
                                    </span> --}}
                                </div>

                                <!-- <div class="villa-list-location">
                                    @if (isset($data->km))
                                        <span class="{{ $textColor }} list-description">
                                            {{ number_format($data->km, 1) }}
                                            {{ __('user_page.km to') }}
                                            {{ $data->airport }}
                                        </span>
                                    @elseif(isset($data->km2))
                                        <span class="{{ $textColor }} list-description">
                                            {{ number_format($data->km2, 1) }}
                                            {{ __('user_page.km to') }}
                                            {{ $data->beach }}
                                        </span>
                                    @else
                                        <span class="{{ $textColor }} list-description">

                                        </span>
                                    @endif

                                </div> -->
                            </div>
                        </div>
                        {{-- <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                            style="position:absolute;top:0;left:0;right:0;bottom:0;"></a> --}}
                    </div>
                </div>

            </div>
        </div>
        <!-- End Right Section -->
    </div>

    <hr class="list-row row-line-grey mt-29p mb-xxs-2p mb-xs-4p mb-min-sm-16p mb-xlg-16p mb-lg-14p">
@endforeach

@include('user.modal.villa.list.share')
<script>
    function modal_click(value) {
        $(`#modal-share-${value}`).modal('show');
    }
</script>
<script>
    add(@json($villas->pluck('id_villa')));
</script>
