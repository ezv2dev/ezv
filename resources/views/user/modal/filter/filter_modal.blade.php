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

    .roomnumberoption-container{
        overflow-x: scroll;
    }

    .filter-modal-body{
        overflow-x: hidden;
    }

    @media (max-width: 575px) { 
        .roomnumberoption-container{
            width: 45%;
        }
    }
    @media (min-width: 576px) { 
        .roomnumberoption-container{
            width: 67%;
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
    }

</style>

@php
$amenities2 = App\Models\Amenities::orderBy('order')->get();
$amenities_length = count($amenities2);

$amenities3 = [];
for ($i = 6; $i < $amenities_length; $i++) {
    array_push($amenities3, $amenities2[$i]);
}

$category2 = App\Models\VillaCategory::orderBy('order')->get();
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
                                <label class="roomnumberoption-checkbox-alias" for="b6">
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
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Category') }}</h5>
                    <div id="modal-category-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            @foreach ($category2->take(6) as $item)
                                @php
                                    $isChecked = '';
                                    $categoryIds = explode(',', request()->get('fCategory'));
                                    if (in_array($item->id_villa_category, $categoryIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fCategory[]"
                                            value="{{ $item->id_villa_category }}" {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <h6 id="show-more-category" class="filter-modal-row-title-secondary"
                            onclick="showMoreCategory();"
                            style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                            {{ Translate::translate('Show more') }}
                        </h6>
                    </div>

                    <div id="modal-category-all" class="col-12 mt-1rem display-none">
                        <div class="row modal-checkbox-row">
                            @foreach ($category3 as $item)
                                @php
                                    $isChecked = '';
                                    $categoryIds = explode(',', request()->get('fCategory'));
                                    if (in_array($item->id_villa_category, $categoryIds)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="fCategory[]"
                                            value="{{ $item->id_villa_category }}" {{ $isChecked }}>
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

            </div>
            <!-- Submit -->
            <div class="modal-filter-footer">
                <button type="submit"
                    style="width:150px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                    class="btn btn-primary btn-lg btn-block" onclick="homesFilter()">
                    {{ Translate::translate('Save') }}
                </button>
            </div>
            <!-- END Submit -->
        </div>
    </div>
</div>

<script>
    $("input[name='fCategory[]']").on('click', function() {
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
