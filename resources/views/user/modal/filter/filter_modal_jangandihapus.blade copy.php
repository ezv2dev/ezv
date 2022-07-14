<!-- Fade In Default Modal -->

<style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 25px;
        border-radius: 20px;
        background: #dfd9ea;
        transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        vertical-align: middle;
        cursor: pointer;
    }

    .example::-webkit-scrollbar {
        display: none;
    }

    .switch::before {
        content: '';
        position: absolute;
        top: 1px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: #fafafa;
        border-radius: 50%;
        transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(128, 128, 128, 0.1);
    }

    input:checked+.switch {
        background: #ff7400;
    }

    input:checked+.switch::before {
        left: 27px;
        background: #fff;
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
        font-size: 15px;
        content: "\f00c";
        text-align: center;
    }

    input:checked+.switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(0, 150, 136, 0.2);
    }

    .font-16 {
        font-size: 16px;
    }

    .font-14 {
        font-size: 14px;
    }

    .orange {
        color: #FF7400;
    }
</style>

@php
$amenities2 = App\Models\Amenities::all();
$amenities_length = count($amenities2);

$amenities3 = [];
for ($i = 6; $i < $amenities_length; $i++) {
    array_push($amenities3, $amenities2[$i]);
}
$host_language2 = App\Models\HostLanguage::all();
$host_language_length = count($host_language2);
$host_language3 = [];
for ($i = 4; $i < $host_language_length; $i++) {
    array_push($host_language3, $host_language2[$i]);
}
$accessibility_features2 = App\Models\VillaAccessibilityFeatures::all();
$accessibility_features_detail2 = App\Models\VillaAccessibilitiyFeaturesDetail::all();
$accessibility_features3 = App\Models\VillaAccessibilityFeatures::whereIn('id_accessibility_features', [2, 3, 4])->get();
$accessibility_features_detail3 = App\Models\VillaAccessibilitiyFeaturesDetail::whereIn('id_detail_accessibility_features', [5, 6, 7, 8, 9, 10, 11, 12, 13])->get();
$property_type = App\Models\PropertyTypeVilla::all();

//get from link
$get_min = app('request')->input('fMinPrice');
if (!$get_min) {
    $get_min = 0;
}
$get_max = app('request')->input('fMaxPrice');
if (!$get_max) {
    $get_max = 100000000;
}
@endphp

<div class="modal fade" id="modalFiltersHome" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body" style=" height: 450px; overflow-y: auto;">
                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Price Range') }}</h5>
                    <div class="col-12" style="display: flex; justify-content: center;">

                        <div class="double-slider-modal">
                            <div class="extra-controls form-inline">
                                <div class="form-group col-lg-12" style="display: flex;">

                                    <div class=""
                                        style="display: table; width: 50%; float: left; padding-right: 10px;">
                                        <div class="col-lg-12"
                                            style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                            <label for="fMinPrice" style="font-size: 12px;">Min</label>
                                            <input name="fMinPrice" style="font-size: 12px;" type="text"
                                                class="js-input-from form-control" value="0" />
                                            <input type="hidden" id="min_filter_price" value="{{ $get_min }}">
                                        </div>
                                    </div>
                                    <div class=""
                                        style="display: flex; align-items: center; justify-content: center;">
                                        <div style="background-color: black; width: 15px; height: 2px;">
                                        </div>
                                    </div>

                                    <div class=""
                                        style="display: table; width: 50%; float: left; padding-left: 10px;">
                                        <div class="col-lg-12"
                                            style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                            <label for="fMaxPrice" style="font-size: 12px;">Max</label>
                                            <input name="fMaxPrice" style="font-size: 12px;" type="text"
                                                class="js-input-to form-control" value="0" />
                                            <input type="hidden" id="max_filter_price" value="{{ $get_max }}">
                                        </div>
                                    </div>

                                </div>
                                <input type="text" class="js-range-slider" value="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-modal-row">
                    {{-- get data filter --}}
                    @php
                        $get_bedroom_filter = app('request')->input('fBedroom');
                    @endphp
                    {{-- /get data filter --}}
                    <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">
                        {{ Translate::translate('Number of Rooms') }}</h5>
                    <h6 class="roomnumberoption-type-title-modal ">{{ Translate::translate('Bedrooms') }}</h6>
                    <div class="roomnumberfilter-gap">
                        <div class="roomnumberoption-container">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="0" id="o0" name="fBedroom"
                                    @if ($get_bedroom_filter == 0) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o0">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">{{ Translate::translate('Any') }}
                                        </p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="o1" name="fBedroom"
                                    @if ($get_bedroom_filter == 1) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o1">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="o2" name="fBedroom"
                                    @if ($get_bedroom_filter == 2) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="o3" name="fBedroom"
                                    @if ($get_bedroom_filter == 3) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="o4" name="fBedroom"
                                    @if ($get_bedroom_filter == 4) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="o5" name="fBedroom"
                                    @if ($get_bedroom_filter == 5) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="o6" name="fBedroom"
                                    @if ($get_bedroom_filter == 6) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="7" id="o7" name="fBedroom"
                                    @if ($get_bedroom_filter == 7) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o7">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">7</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="8" id="o8" name="fBedroom"
                                    @if ($get_bedroom_filter >= 8) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o8">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">8+</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>


                    {{-- get data filter --}}
                    @php
                        $get_beds_filter = app('request')->input('fBeds');
                    @endphp
                    {{-- /get data filter --}}
                    <h6 class="roomnumberoption-type-title-modal roomnumberfiltertitle-gap">
                        {{ Translate::translate('Beds') }}</h6>
                    <div class="roomnumberfilter-gap">
                        <div class="roomnumberoption-container">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="0" id="a0" name="fBeds"
                                    @if ($get_beds_filter == 0) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a0">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">{{ Translate::translate('Any') }}
                                        </p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="a1" name="fBeds"
                                    @if ($get_beds_filter == 1) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a1">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="a2" name="fBeds"
                                    @if ($get_beds_filter == 2) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="a3" name="fBeds"
                                    @if ($get_beds_filter == 3) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="a4" name="fBeds"
                                    @if ($get_beds_filter == 4) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="a5" name="fBeds"
                                    @if ($get_beds_filter == 5) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="a6" name="fBeds"
                                    @if ($get_beds_filter == 6) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="7" id="a7" name="fBeds"
                                    @if ($get_beds_filter == 7) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a7">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">7</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="8" id="a8" name="fBeds"
                                    @if ($get_beds_filter >= 8) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="a8">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">8+</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- get data filter --}}
                    @php
                        $get_bathroom_filter = app('request')->input('fBathroom');
                    @endphp
                    {{-- /get data filter --}}

                    <h6 class="roomnumberoption-type-title-modal roomnumberfiltertitle-gap">
                        {{ Translate::translate('Bathrooms') }}</h6>

                    <div class="roomnumberfilter-gap">
                        <div class="roomnumberoption-container">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="0" id="b0" name="fBathroom"
                                    @if ($get_beds_filter == 0) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b0">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">
                                            {{ Translate::translate('Any') }}</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="b1" name="fBathroom"
                                    @if ($get_beds_filter == 1) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b1">
                                    <div>
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="b2" name="fBathroom"
                                    @if ($get_beds_filter == 2) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="b3" name="fBathroom"
                                    @if ($get_beds_filter == 3) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="b4" name="fBathroom"
                                    @if ($get_beds_filter == 4) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="b5" name="fBathroom"
                                    @if ($get_beds_filter == 5) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="b6" name="fBathroom"
                                    @if ($get_beds_filter == 6) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="o6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="7" id="b7" name="fBathroom"
                                    @if ($get_beds_filter == 7) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b7">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">7</p>
                                    </div>
                                </label>
                            </div>
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="8" id="b8" name="fBathroom"
                                    @if ($get_beds_filter >= 8) checked @endif />
                                <label class="roomnumberoption-checkbox-alias" for="b8">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">8+</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="filter-modal-row">
                    <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">
                        {{ Translate::translate('Property Type') }}</h5>
                    <div class="propertytype-input-row">
                        <div class="col-12 propertytype-grid-container">
                            @php
                                $i = 0;
                                $get_property_filter = app('request')->input('fProperty');
                            @endphp

                            @foreach ($property_type as $item)
                                @php
                                    $isChecked = '';
                                    $propertyIds = explode(',', request()->get('fProperty'));
                                    if (in_array($item->id_property_type, $propertyIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp

                                <div class="propertytypeoption-type-container">
                                    <input type="checkbox" name="fProperty[]"
                                        value="{{ $item->id_property_type }}" id="r{{ $i }}"
                                        {{ $isChecked }} />
                                    <label class="propertytypemdoal-checkbox-alias" for="r{{ $i }}">
                                        <div class="propertytypemodal-icon">
                                            <i class="{{ $item->icon }}"></i>
                                        </div>
                                        <div class="propertymodal-text">
                                            <p>{{ $item->name }}</p>
                                        </div>
                                    </label>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">
                        {{ Translate::translate('Accessibility Features') }}
                    </h5>
                    <p class="modal-filter-text-row modal-fiter-desc">
                        {{ Translate::translate('This info was provided by the Host and reviewed by EZV.') }}
                    </p>

                    @foreach ($accessibility_features2->take(1) as $item)
                        <div id="modal-accessibility-default" class="col-12 mt-2rem">
                            <h6 class="filter-modal-row-title-secondary" style="margin-bottom: 5px;">
                                {{ $item->name }}
                            </h6>
                            @php
                                $checked2 = [];
                                if (isset($_GET['filterAccessibilityDetails'])) {
                                    $checked2 = $_GET['filterAccessibilityDetails'];
                                }
                            @endphp
                            <div class="row">
                                @foreach ($accessibility_features_detail2->take(4) as $item2)
                                    @if ($item2->id_accessibility_features == $item->id_accessibility_features)
                                        <div class="col-6 font-14 checkdesign-gap">
                                            <label class="checkdesign checkdesign-modal-filter">{{ $item2->name }}
                                                <input type="checkbox" name="filterAccessibilityDetails[]"
                                                    value="{{ $item->id_accessibility_features_detail }}"
                                                    @if (in_array($item->id_accessibility_features_detail, $checked2)) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <h6 id="show-more-accessibility" class="filter-modal-row-title-secondary"
                        onclick="showmoreaccessibility();"
                        style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration:underline;">
                        {{ Translate::translate('Show more') }}
                    </h6>

                    <div id="modal-accessibility-all" class="col-12 display-none">
                        @foreach ($accessibility_features3 as $item)
                            <h6 class="filter-modal-row-title-secondary"
                                style="margin-top: 20px; margin-bottom: -5px;">
                                {{ $item->name }}
                            </h6>
                            @php
                                $checked2 = [];
                                if (isset($_GET['filterAccessibilityDetails'])) {
                                    $checked2 = $_GET['filterAccessibilityDetails'];
                                }
                            @endphp
                            <div class="row">
                                @foreach ($accessibility_features_detail3 as $item2)
                                    @if ($item2->id_accessibility_features == $item->id_accessibility_features)
                                        <div class="col-6 font-14 checkdesign-gap">
                                            <label class="checkdesign checkdesign-modal-filter">{{ $item2->name }}
                                                <input type="checkbox" name="filterAccessibilityDetails[]"
                                                    value="{{ $item->id_accessibility_features_detail }}"
                                                    @if (in_array($item->id_accessibility_features_detail, $checked2)) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        <h6 id="show-less-accessibility" class="filter-modal-row-title-secondary"
                            onclick="closemoreaccessibility();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show less') }}
                        </h6>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Amenities') }}</h5>
                    <div id="modal-amenities-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @foreach ($amenities2->take(6) as $item)
                                @php
                                    $isChecked = '';
                                    $amenitiesIds = explode(',', request()->get('fAmenities'));
                                    if (in_array($item->id_amenities, $amenitiesIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fAmenities[]"
                                            value="{{ $item->id_amenities }}" {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-more-amenities" class="filter-modal-row-title-secondary"
                            onclick="showmoreamenities();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show more') }}
                        </h6>
                    </div>

                    <div id="modal-amenities-all" class="col-12 mt-1rem display-none">
                        <div class="row modal-checkbox-row">
                            @foreach ($amenities3 as $item)
                                @php
                                    $isChecked = '';
                                    $amenitiesIds = explode(',', request()->get('fAmenities'));
                                    if (in_array($item->id_amenities, $amenitiesIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fAmenities[]"
                                            value="{{ $item->id_amenities }}" {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-less-amenities" class="filter-modal-row-title-secondary"
                            onclick="closemoreamenities();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show less') }}
                        </h6>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Booking Options') }}</h5>

                    <div class="row col-12 modal-margin-0 margin-top-2rem">
                        <div class="col-11 modal-padding-0">
                            <h6 class="filter-modal-row-title-secondary">
                                {{ Translate::translate('Instant Book') }}
                            </h6>
                            <p class="modal-fiter-desc-secondary modal-margin-0">
                                {{ Translate::translate('Listings you can book without waiting for Host approval') }}
                            </p>
                        </div>
                        <div class="col-1 modal-booking-checkbox">
                            <input type="checkbox" hidden="hidden" id="instant_book">
                            <label class="switch" for="instant_book"></label>
                        </div>
                    </div>
                    <div class="row col-12 modal-margin-0 margin-top-2rem">
                        <div class="col-11 modal-padding-0">
                            <h6 class="filter-modal-row-title-secondary">
                                {{ Translate::translate('Self check-in') }}
                            </h6>
                            <p class="modal-fiter-desc-secondary modal-margin-0">
                                {{ Translate::translate('Easy access to the property once you arrive') }}
                            </p>
                        </div>
                        <div class="col-1 modal-booking-checkbox">
                            <input type="checkbox" hidden="hidden" id="self_check_in">
                            <label class="switch" for="self_check_in"></label>
                        </div>
                    </div>
                    <div class="row col-12 modal-margin-0 margin-top-2rem">
                        <div class="col-11 modal-padding-0">
                            <h6 class="filter-modal-row-title-secondary">
                                {{ Translate::translate('Free cancellation') }}
                            </h6>
                            <p class="modal-fiter-desc-secondary modal-margin-0">
                                {{ Translate::translate('Only show stays that offer free cancellation') }}
                            </p>
                        </div>
                        <div class="col-1 modal-booking-checkbox">
                            <input type="checkbox" hidden="hidden" id="free_cancelation">
                            <label class="switch" for="free_cancelation"></label>
                        </div>
                    </div>
                </div>

                <div class="filter-modal-row" style="border-bottom: 0px;">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Host Languange') }}</h5>
                    <div id="modal-language-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @foreach ($host_language2->take(4) as $item)
                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="filterHostLanguage[]"
                                            value="{{ $item->id_host_language }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-more-language" class="filter-modal-row-title-secondary"
                            onclick="showmorelanguage();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show more') }}
                        </h6>
                    </div>

                    <div id="modal-language-all" class="col-12 mt-1rem display-none">
                        <div class="row modal-checkbox-row">
                            @foreach ($host_language3 as $item)
                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="filterHostLanguage[]"
                                            value="{{ $item->id_host_language }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-less-language" class="filter-modal-row-title-secondary"
                            onclick="closemorelanguage();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show less') }}
                        </h6>
                    </div>
                </div>

            </div>
            <!-- Submit -->
            <div class="modal-filter-footer">
                <button type="submit"
                    style="width:150px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                    class="btn btn-primary btn-lg btn-block" onclick="villaFilter()">
                    {{ Translate::translate('Save') }}
                </button>
            </div>
            <!-- END Submit -->
        </div>
    </div>
</div>

<script>
    $("input[name='fProperty[]']").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    function bedroom_increment_modal() {
        document.getElementById('bedroom_number2').stepUp();
    }

    function bedroom_decrement_modal() {
        document.getElementById('bedroom_number2').stepDown();
    }

    function bathroom_increment_modal() {
        document.getElementById('bathroom_number2').stepUp();
    }

    function bathroom_decrement_modal() {
        document.getElementById('bathroom_number2').stepDown();
    }

    function bed_increment_modal() {
        document.getElementById('bed_number2').stepUp();
    }

    function bed_decrement_modal() {
        document.getElementById('bed_number2').stepDown();
    }

    function showmoreaccessibility() {
        document.getElementById("modal-accessibility-all").classList.remove("display-none");
        document.getElementById("modal-accessibility-all").classList.add("display-block");
        document.getElementById("show-more-accessibility").classList.add("display-none");
    }

    function closemoreaccessibility() {
        document.getElementById("modal-accessibility-all").classList.remove("display-block");
        document.getElementById("modal-accessibility-all").classList.add("display-none");
        document.getElementById("show-more-accessibility").classList.remove("display-none");
    }

    function showmoreamenities() {
        document.getElementById("modal-amenities-all").classList.remove("display-none");
        document.getElementById("modal-amenities-all").classList.add("display-block");
        document.getElementById("show-more-amenities").classList.add("display-none");
    }

    function closemoreamenities() {
        document.getElementById("modal-amenities-all").classList.remove("display-block");
        document.getElementById("modal-amenities-all").classList.add("display-none");
        document.getElementById("show-more-amenities").classList.remove("display-none");
    }

    function showmorelanguage() {
        document.getElementById("modal-language-all").classList.remove("display-none");
        document.getElementById("modal-language-all").classList.add("display-block");
        document.getElementById("show-more-language").classList.add("display-none");
    }

    function closemorelanguage() {
        document.getElementById("modal-language-all").classList.remove("display-block");
        document.getElementById("modal-language-all").classList.add("display-none");
        document.getElementById("show-more-language").classList.remove("display-none");
    }
</script>
<!-- END Fade In Default Modal -->
