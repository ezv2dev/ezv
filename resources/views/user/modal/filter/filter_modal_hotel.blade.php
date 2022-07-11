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

//get from link
$get_min = app('request')->input('fMinPrice');
if (!$get_min) {
    $get_min = 0;
}
$get_max = app('request')->input('fMaxPrice');
if (!$get_min) {
    $get_max = 100000000;
}
@endphp

<div class="modal fade" id="modal-filters-hotel" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body" style=" height: 450px; overflow-y: auto;">
                <form action="{{ route('filters-hotel') }}" method="GET" id="basic-form" class="js-validation col-12"
                    enctype="multipart/form-data" style="display: table">
                    <div class="filter-modal-row">
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">{{ Translate::translate('Price Range') }}</h5>
                        <div class="col-12" style="display: flex; justify-content: center;">

                            <div class="double-slider-modal">
                                <div class="extra-controls form-inline">
                                    <div class="form-group col-lg-12" style="display: flex;">

                                        <div class=""
                                            style="display: table; width: 50%; float: left; padding-right: 10px;">
                                            <div class="col-lg-12"
                                                style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                                <label for="min_price" style="font-size: 12px;">Min</label>
                                                <input name="min_price" style="font-size: 12px;" type="text"
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
                                                <label for="max_price" style="font-size: 12px;">Max</label>
                                                <input name="max_price" style="font-size: 12px;" type="text"
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
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">{{ Translate::translate('Amenities') }}</h5>
                        <div id="modal-amenities-default" class="col-12">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="filterAmenities[]" value="null" />
                                @foreach ($amenities2->take(6) as $item)
                                    @php
                                        $checked = [];
                                        if (isset($_GET['filterAmenities'])) {
                                            $checked = $_GET['filterAmenities'];
                                        }

                                        $amenities_filter = explode(',', app('request')->input('fFacilities'));
                                    @endphp
                                    <div class="col-4 checkdesign-gap">
                                        <label class="checkdesign checkdesign-modal-filter">{{ Translate::translate($item->name) }}
                                            <input type="checkbox" name="filterAmenities[]"
                                                value="{{ $item->id_amenities }}"
                                                @if (in_array($item->id_amenities, $checked) || in_array($item->id_amenities, $amenities_filter)) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <h6 id="show-more-amenities2" class="filter-modal-row-title-secondary"
                                onclick="showmoreamenities2();"
                                style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                {{ Translate::translate('Show more') }}
                            </h6>
                        </div>

                        <div id="modal-amenities-all2" class="col-12 mt-1rem display-none">
                            <div class="row modal-checkbox-row">
                                @foreach ($amenities3 as $item)
                                    @php
                                        $checked = [];
                                        if (isset($_GET['filterAmenities'])) {
                                            $checked = $_GET['filterAmenities'];
                                        }
                                    @endphp
                                    <div class="col-4 checkdesign-gap">
                                        <label class="checkdesign checkdesign-modal-filter">{{ Translate::translate($item->name) }}
                                            <input type="checkbox" name="filterAmenities[]"
                                                value="{{ $item->id_amenities }}"
                                                @if (in_array($item->id_amenities, $checked)) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <h6 id="show-less-amenities" class="filter-modal-row-title-secondary"
                                onclick="closemoreamenities2();"
                                style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                Show less
                            </h6>
                        </div>
                    </div>

                    <div class="filter-modal-row" style="border-bottom: 0px;">
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">{{ Translate::translate('Host Languange') }}</h5>
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
                            <h6 id="show-more-language2" class="filter-modal-row-title-secondary"
                                onclick="showmorelanguage2();"
                                style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                {{ Translate::translate('Show more') }}
                            </h6>
                        </div>

                        <div id="modal-language-all2" class="col-12 mt-1rem display-none">
                            <div class="row modal-checkbox-row">
                                @foreach ($host_language3 as $item)
                                    <div class="col-6 checkdesign-gap">
                                        <label class="checkdesign checkdesign-modal-filter">{{ Translate::translate($item->name) }}
                                            <input type="checkbox" name="filterHostLanguage[]"
                                                value="{{ $item->id_host_language }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <h6 id="show-less-language" class="filter-modal-row-title-secondary"
                                onclick="closemorelanguage2();"
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
                    class="btn btn-primary btn-lg btn-block">
                    Save
                </button>
            </div>
            <!-- END Submit -->
            </form>
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

    function showmoreamenities2() {
        document.getElementById("modal-amenities-all2").classList.remove("display-none");
        document.getElementById("modal-amenities-all2").classList.add("display-block");
        document.getElementById("show-more-amenities2").classList.add("display-none");
    }

    function closemoreamenities2() {
        document.getElementById("modal-amenities-all2").classList.remove("display-block");
        document.getElementById("modal-amenities-all2").classList.add("display-none");
        document.getElementById("show-more-amenities2").classList.remove("display-none");
    }

    function showmorelanguage2() {
        document.getElementById("modal-language-all2").classList.remove("display-none");
        document.getElementById("modal-language-all2").classList.add("display-block");
        document.getElementById("show-more-language2").classList.add("display-none");
    }

    function closemorelanguage2() {
        document.getElementById("modal-language-all2").classList.remove("display-block");
        document.getElementById("modal-language-all2").classList.add("display-none");
        document.getElementById("show-more-language2").classList.remove("display-none");
    }
</script>
<!-- END Fade In Default Modal -->
