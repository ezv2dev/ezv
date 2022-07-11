@php
$villas = $villa->shuffle()->sortBy('grade');
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
@foreach ($villas as $data)
    <div class="row list-row-gap">
        <!-- Left Sedtion -->
        <div class="col-lg-6 py-2 col-xs-12 list-image-container grid-desc-container list-image-container">
            <div class="content list-image-content">
                @guest
                    <div class="list-like-button-container"
                        style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
                        <a style="position: absolute; z-index: 99; top: 10px; right: 10px; cursor: pointer;"
                            onclick="loginForm()">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation"
                                focusable="false" class="favorite-button favorite-button-28">
                                <path
                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                        </a>
                    </div>
                @endguest

                @auth
                    @php
                        $cekVilla = App\Models\VillaSave::where('id_villa', $data->id_villa)
                            ->where('id_user', Auth::user()->id)
                            ->first();
                    @endphp

                    @if ($cekVilla == null)
                        <div class="list-like-button-container"
                            style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
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
                    @else
                        <div class="list-like-button-container"
                            style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border-radius: 9px;">
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
                    @endif
                @endauth

                <div class="like-sign like-sign-villa-{{ $data->id_villa }}">
                    <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                </div>
                <input type="hidden" value="{{ $data->id_villa }}" id="id_villa" name="id_villa">
                <div class="skeleton skeleton-sm-h-100 skeleton-sm-w-100">
                    <div class="js-slider-2 list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                        data-dots="false" data-arrows="true">
                        @php
                            $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                        @endphp
                        @forelse ($gallery as $item)
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                class="col-lg-6 list-image-container">
                                <img class="img-fluid grid-image" style="display: block;" loading="lazy"
                                    src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $item->photo) }}"
                                    alt="EZV_{{ $item->photo }}">
                            </a>
                        @empty
                            @if ($data->image)
                                <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                    class="col-lg-6 list-image-container">
                                    <img class="img-fluid grid-image" style="display: block;" loading="lazy"
                                        src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}"
                                        alt="EZV_{{ $data->image }}">
                                </a>
                            @else
                                <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                    class="col-lg-6 list-image-container ">
                                    <img class="img-fluid grid-image" style="display: block;" loading="lazy"
                                        src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
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
        <div class="col-lg-6 py-2 col-xs-12 list-image-container grid-desc-container list-desc-container">
            <div class="w-100 ml-responsive" style="position:relative;">
                <!-- Villa Description -->
                <div class="row mt-5 mt-sm-4 mt-lg-0 " style="height:100%;">
                    <div class="col-12 row">
                        <div class="col-9">
                            <div class="skeleton skeleton-h-3 skeleton-w-100">
                                <p class="villa-list-name max-line " style="color: #ff7400; position:relative;">
                                    {{-- {{ $data->name ?? __('user_page.There is no name yet') }} --}}
                                    {{ $data->name ?? __('user_page.There is no name yet') }}
                                    <!-- ({{ $data->grade }}) -->
                                    <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                        style="position:absolute;top:0;left:0;right:0;bottom:0;"></a>
                                </p>
                            </div>
                            <div class="mt-2 cursor-pointer villa-location-description skeleton skeleton-h-2 skeleton-w-100 "
                                onclick="view_maps('{{ $data->id_villa }}')">
                                <i class="fa-solid  fa-location-dot text-orange"></i>
                                <span class="text-orange">
                                    {{ $data->location->name ?? __('user_page.Location not found') }}
                                </span>

                            </div>
                        </div>

                        <!-- Video Button -->
                        <div class="col-3 skeleton">
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank">
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

                        <div class="col-12 villa-info-contanier" style="position:relative;">
                            <div class="villa-list-title pb-3">
                                <div class=" skeleton skeleton skeleton-h-1 skeleton-w-50" style="margin-right: 4px;">
                                    <span class="list-description {{ $textColor }}">
                                        • {{ $data->adult . ' ' . __('user_page.Guests') }}
                                    </span>
                                </div>
                                <div class="skeleton skeleton-h-1 skeleton-w-50">
                                    <span class="list-description {{ $textColor }} ">
                                        • {{ $data->bedroom . ' ' . __('user_page.Bedroom') }}
                                    </span>
                                </div>
                                <div class=" skeleton skeleton-h-1 skeleton-w-50">
                                    <span class="list-description {{ $textColor }}">
                                        • {{ $data->bathroom . ' ' . __('user_page.Bath') }}
                                    </span>
                                </div>
                                @if ($data->parking != null || $data->parking > 0)
                                    <div class="skeleton skeleton-h-1 skeleton-w-50">
                                        <span class="list-description {{ $textColor }} ">
                                            • {{ $data->parking . ' ' . __('user_page.Parking') }}
                                        </span>
                                    </div>
                                @endif
                                @if ($data->size != null || $data->size > 0)
                                    <div class=" skeleton skeleton-h-1 skeleton-w-50">
                                        <span class="list-description {{ $textColor }}">
                                            • {{ number_format($data->size) }} m<sup>2</sup>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="villa-list-description-container skeleton skeleton-h-4 skeleton-w-100">
                                <p class="villa-list-title {{ $textColor }} list-description limit-text-6">
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
                                                {{ CurrencyConversion::exchangeWithUnit($data->price) }} /
                                                {{ __('user_page.night') }}

                                            </span>
                                        @else
                                            <span class="villa-list-price">
                                                {{ CurrencyConversion::exchangeWithUnit($data->price * $dateDiff) }}
                                                / {{ $dateDiff }}
                                                {{ __('user_page.night') }}
                                            </span>
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

                                <div class="villa-list-location">
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

                                </div>
                            </div>
                        </div>
                        <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                            style="position:absolute;top:0;left:0;right:0;bottom:0;"></a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Right Section -->
    </div>
    <hr class="list-row row-line-white" style="margin-top: 29px;">
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
