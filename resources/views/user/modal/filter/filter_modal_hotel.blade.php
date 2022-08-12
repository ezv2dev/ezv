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

    .roomnumberoption-container::-webkit-scrollbar {
        visibility: hidden;
    }

    .roomnumberoption-container {
        overflow-x: scroll;
        width: 100%;
    }

    .filter-modal-body {
        overflow-x: hidden;
    }

    /* @media (max-width: 575px) {
        .roomnumberoption-container{
            width: 49%;
        }
    }
    @media (min-width: 576px) {
        .roomnumberoption-container{
            width: 71%;
        }
    }
    @media (min-width: 768px) {
        .roomnumberoption-container{
            width: 67%;
        }
    }

    @media (min-width: 992px) {
        .roomnumberoption-container{
            width: 100%;
        }
    }

    @media (min-width: 1200px) {
        .roomnumberoption-container{
            width: 100%;
        }
    }

    @media (min-width: 1400px) {
        .roomnumberoption-container{
            width: 100%;
        }
    } */
</style>

@php
$hotel_filter2 = App\Models\HotelFilter::orderBy('order')->get();
$hotel_filter_length = count($hotel_filter2);

$hotel_filter3 = [];
for ($i = 6; $i < $hotel_filter_length; $i++) {
    array_push($hotel_filter3, $hotel_filter2[$i]);
}

$category2 = App\Models\HotelCategory::orderBy('order')->get();
$category_length = count($category2);

$category3 = [];
for ($i = 6; $i < $category_length; $i++) {
    array_push($category3, $category2[$i]);
}

//get from link
$get_min = request()->get('fMinPrice');
if (!$get_min) {
    $get_min = 0;
}

$get_max = request()->get('fMaxPrice');
if (!$get_max) {
    $get_max = 200000000;
}

$get_category = request()->get('fCategory');
@endphp

<div class="modal fade" id="modalFiltersHotel" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-md-down" role="document"
        style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body">
                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Sort By') }}</h5>
                    <div class="col-12">
                        <div class="row modal-checkbox-row">
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Ezv top pick
                                    <input type="checkbox" class="fSort" name="fSort[]" value="ezv_top_pick"
                                        @if (request()->get('fSort') == 'ezv_top_pick') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Lowest to Highest Price
                                    <input type="checkbox" class="fSort" name="fSort[]" value="lowest"
                                        @if (request()->get('fSort') == 'lowest') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Best Reviewed
                                    <input type="checkbox" class="fSort" name="fSort[]" value="best_reviewed"
                                        @if (request()->get('fSort') == 'best_reviewed') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Popularity
                                    <input type="checkbox" class="fSort" name="fSort[]" value="popularity"
                                        @if (request()->get('fSort') == 'popularity') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Highest to Lowest Price
                                    <input type="checkbox" class="fSort" name="fSort[]" value="highest"
                                        @if (request()->get('fSort') == 'highest') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Closest to the beach
                                    <input type="checkbox" class="fSort" name="fSort[]" value="beach"
                                        @if (request()->get('fSort') == 'beach') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


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
                                            <input name="fMinPrice" style="font-size: 12px; border: none;"
                                                type="text" class="js-input-from form-control"
                                                value="{{ $get_min }}" />
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
                                            <input name="fMaxPrice" style="font-size: 12px; border: none;"
                                                type="text" class="js-input-to form-control"
                                                value="{{ $get_max }}" />
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
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Category') }}</h5>
                    <div id="modal-category-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @foreach ($category2->take(6) as $item)
                                @php
                                    $isChecked = '';
                                    $categoryIds = explode(',', request()->get('fCategory'));
                                    if (in_array($item->id_hotel_category, $categoryIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fCategory[]"
                                            value="{{ $item->id_hotel_category }}" {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-more-category" class="filter-modal-row-title-secondary display-none"
                            onclick="showMoreCategory();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show more') }}
                        </h6>
                    </div>

                    <div id="modal-category-all" class="col-12 mt-1rem">
                        <div class="row modal-checkbox-row">
                            @foreach ($category3 as $item)
                                @php
                                    $isChecked = '';
                                    $categoryIds = explode(',', request()->get('fCategory'));
                                    if (in_array($item->id_hotel_category, $categoryIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fCategory[]"
                                            value="{{ $item->id_hotel_category }}" {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-less-category" class="filter-modal-row-title-secondary"
                            onclick="closeMoreCategory();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show less') }}
                        </h6>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Stars') }}</h5>
                    <div id="modal-category-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @php
                                $starIds = explode(',', request()->get('fStar'));
                            @endphp

                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter"> 5 Stars
                                    <input type="checkbox" name="fStar[]" value="5"
                                        @if (in_array(5, $starIds)) checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter"> 4 Stars
                                    <input type="checkbox" name="fStar[]" value="4"
                                        @if (in_array(4, $starIds)) checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter"> 3 Stars
                                    <input type="checkbox" name="fStar[]" value="3"
                                        @if (in_array(3, $starIds)) checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter"> 2 Stars
                                    <input type="checkbox" name="fStar[]" value="2"
                                        @if (in_array(2, $starIds)) checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter"> 1 Star
                                    <input type="checkbox" name="fStar[]" value="1"
                                        @if (in_array(1, $starIds)) checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Filter') }}</h5>
                    <div id="modal-amenities-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @foreach ($hotel_filter2->take(6) as $item)
                                @php
                                    $isChecked = '';
                                    $hotel_filterIds = explode(',', request()->get('filter'));
                                    if (in_array($item->id_hotel_filter, $hotel_filterIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="filter[]" value="{{ $item->id_hotel_filter }}"
                                            {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-more-amenities" class="filter-modal-row-title-secondary display-none"
                            onclick="showMoreFilter();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show more') }}
                        </h6>
                    </div>

                    <div id="modal-amenities-all" class="col-12 mt-1rem">
                        <div class="row modal-checkbox-row">
                            @foreach ($hotel_filter3 as $item)
                                @php
                                    $isChecked = '';
                                    $hotel_filterIds = explode(',', request()->get('filter'));
                                    if (in_array($item->id_hotel_filter, $hotel_filterIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-12 col-md-6 col-lg-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="filter[]" value="{{ $item->id_hotel_filter }}"
                                            {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-less-amenities" class="filter-modal-row-title-secondary"
                            onclick="closeMoreFilter();"
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
                    class="btn btn-primary btn-lg btn-block" onclick="hotelFilter()">
                    {{ Translate::translate('Save') }}
                </button>
            </div>
            <!-- END Submit -->
        </div>
    </div>
</div>

<script>
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

    function showMoreFilter() {
        document.getElementById("modal-amenities-all").classList.remove("display-none");
        document.getElementById("modal-amenities-all").classList.add("display-block");
        document.getElementById("show-more-amenities").classList.add("display-none");
    }

    function closeMoreFilter() {
        document.getElementById("modal-amenities-all").classList.remove("display-block");
        document.getElementById("modal-amenities-all").classList.add("display-none");
        document.getElementById("show-more-amenities").classList.remove("display-none");
    }

    function showMoreCategory() {
        document.getElementById("modal-category-all").classList.remove("display-none");
        document.getElementById("modal-category-all").classList.add("display-block");
        document.getElementById("show-more-category").classList.add("display-none");
    }

    function closeMoreCategory() {
        document.getElementById("modal-category-all").classList.remove("display-block");
        document.getElementById("modal-category-all").classList.add("display-none");
        document.getElementById("show-more-category").classList.remove("display-none");
    }
</script>
<!-- END Fade In Default Modal -->
