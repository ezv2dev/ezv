@php
$villas = $villa->shuffle()->sortBy('grade');
$list = [];
foreach ($villas as $item) {
    array_push($list, $item->id_villa);
}
@endphp
@foreach ($villas as $data)
    <div class="row list-row-gap">
        <!-- Left Sedtion -->
        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-image-container">
            <div class="content list-image-content">
                <div
                    style="position: absolute; right: 10px; top: 10px; z-index: 99; display: flex; font-size: 24px; border: 1px solid grey; border-radius: 9px;">
                    <div style="margin: 5px;">
                        <i class="fa-solid fa-heart text-orange"></i>
                    </div>
                    <div style="margin: 5px;">
                        <i class="fa-solid fa-share text-orange"></i>
                    </div>
                </div>
                <input type="hidden" value="{{ $data->id_villa }}" id="id_villa" name="id_villa">
                <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                    data-dots="false" data-arrows="true">
                    @php
                        $gallery = App\Http\Controllers\ViewController::gallery($data->id_villa);
                    @endphp
                    @forelse ($gallery->sortBy('order') as $item)
                        <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                            class="col-lg-6 grid-image-container">
                            <img class="lozad img-fluid grid-image" style="display: block;"
                                src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $item->photo) }}"
                                alt="EZV_{{ $item->photo }}">
                        </a>
                    @empty
                        @if ($data->image)
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                class="col-lg-6 grid-image-container">
                                <img class="lozad img-fluid grid-image" style="display: block;"
                                    src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}"
                                    alt="EZV_{{ $data->image }}">
                            </a>
                        @else
                            <a href="{{ route('villa', $data->id_villa) }}" target="_blank"
                                class="col-lg-6 grid-image-container">
                                <img class="lozad img-fluid grid-image" style="display: block;"
                                    src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
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
            <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class=" overlay-desc-1"></a>
            <a href="{{ route('villa', $data->id_villa) }}" target="_blank" class=" overlay-desc-2"></a>
            <div class="row">
                <div class="col-lg-9 float-left">
                    <p class="villa-list-name max-line" style="color: #ff7400;">{{ $data->name }}</p>
                    <a class="list-description font-light" href="#!" onclick="view_maps('{{ $data->id_villa }}')">
                        {{ $data->location->name }}
                    </a>
                    <div class="villa-list-title py-3">
                        <div class="list-description font-light" style="margin-right: 4px;">
                            • {{ $data->adult }} {{ Translate::translate('Guests') }}
                        </div>
                        <div class="list-description font-light">
                            • {{ $data->bedroom }} {{ Translate::translate('Bedroom') }}
                        </div>
                        <div class="list-description font-light">
                            • {{ $data->bathroom }} {{ Translate::translate('Bath') }}
                        </div>
                        <div class="list-description font-light">
                            • {{ $data->parking }} {{ Translate::translate('Parking') }}
                        </div>
                        <div class="list-description font-light">
                            • {{ number_format($data->size) }} m<sup>2</sup>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 float-left-align-right">
                    <a href="{{ route('villa', $data->id_villa) }}" target="_blank">
                        <div class="villa-list-video-container video-show-buttons">
                            <i class="fas fa-2x fa-play video-button"></i>
                            @if ($data->video->count() > 0)
                                <video class="lozad villa-list-video" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                            @elseif ($data->photo->count() > 0)
                                <img class="lozad villa-list-video" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                            @elseif ($data->image != null)
                                <img class="lozad villa-list-video" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/gallery/' . strtolower($data->uid) . '/' . $data->image) }}">
                            @else
                                <img class="lozad villa-list-video" src="{{ LazyLoad::show() }}"
                                    data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                            @endif
                        </div>
                    </a>

                </div>
                <div class="col-lg-12 villa-list-description-container">
                    <p class="col-lg-12 villa-list-title font-light list-description">
                        {{ Translate::translate($data->short_description) }}
                    </p>
                </div>

                <div class="col-lg-12 villa-list-desc-container">
                    <div class="col-lg-12">
                        <div class="col-lg-12 villa-list-price">
                            @if ($data->price)
                                @if (empty($dateDiff))
                                    <span class="villa-list-price">
                                        {{ CurrencyConversion::exchangeWithUnit($data->price) }} /
                                        {{ Translate::translate('night') }}
                                    </span>
                                @else
                                    <span class="villa-list-price">
                                        {{ CurrencyConversion::exchangeWithUnit($data->price * $dateDiff) }}
                                        / {{ $dateDiff }}
                                        {{ Translate::translate('night') }}
                                    </span>
                                @endif
                            @else
                                {{ Translate::translate('Price is unknown') }}
                            @endif
                            <span class="font-light list-description" style="padding-left: 6px; font-size: 12px;">
                                @if ($data->detailReview)
                                    {{ $data->detailReview->average }}
                                    {{ Translate::translate('Reviews') }}
                                @else
                                    {{ Translate::translate('there is no reviews yet') }}
                                @endif
                            </span>
                        </div>

                        <div class="villa-list-location">
                            @if (isset($data->km))
                                <span class="font-light list-description">
                                    {{ number_format($data->km, 1) }}
                                    {{ Translate::translate('km to') }}
                                    {{ $data->airport }}
                                </span>
                            @endif
                            @if (isset($data->km2))
                                <span class="font-light list-description">
                                    {{ number_format($data->km2, 1) }}
                                    {{ Translate::translate('km to') }}
                                    {{ $data->beach }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Right Section -->
    </div>
    <hr class="list-row row-line-white">
@endforeach
