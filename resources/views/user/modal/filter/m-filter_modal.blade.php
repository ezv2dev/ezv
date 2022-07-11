<!-- Fade In Default Modal -->

@php
$amenities2 = App\Models\Amenities::all();
@endphp

@php
$host_language2 = App\Models\HostLanguage::all();
$accessibility_features2 = App\Models\VillaAccessibilityFeatures::all();
$accessibility_features_detail2 = App\Models\VillaAccessibilitiyFeaturesDetail::all();
@endphp

<div class="modal fade" id="modal-filters" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body" style=" height: 450px; overflow-y: auto;">
                <form action="{{ route('filters') }}" method="GET" id="basic-form" class="js-validation col-12" enctype="multipart/form-data"
                    style="display: table">
                    <div class="filter-modal-row">
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Price Range</h5>
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
                                            </div>
                                        </div>

                                    </div>
                                    <input type="text" class="js-range-slider" value="" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="add-guest-modal">
                        <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">Add Guest</h5>
                            <div class="guests-input-row">
                                <div class="col-6">
                                    <div class="col-12 guest-type-container">
                                        <p class="guest-type-title">Adults</p>
                                    </div>
                                    <div class="col-12" style="padding: 0px;">
                                        <p class="guest-type-desc">Age 13 or above</p>
                                    </div>
                                </div>
                                <div class="col-6"
                                    style="display: flex; align-items: center; justify-content: end;">
                                    <a type="button" onclick="adult_decrement_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-minus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                    <div
                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                        <input type="number" id="adult5" name="adult" value="1"
                                            style="text-align: center; margin-left:0; border:none; width:40px;  color: #807c7c;"
                                            min="1" readonly>
                                    </div>
                                    <a type="button" onclick="adult_increment_header_list()"
                                        style="height: 19px; width:19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="guests-input-row">
                                <div class="col-6">
                                    <div class="col-12 guest-type-container">
                                        <p class="guest-type-title">Children</p>
                                    </div>
                                    <div class="col-12" style="padding: 0px;">
                                        <p class="guest-type-desc">Ages 2–12</p>
                                    </div>
                                </div>
                                <div class="col-6"
                                    style="display: flex; align-items: center; justify-content: end;">
                                    <a type="button" onclick="child_decrement_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-minus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                    <div
                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                        <input type="number" id="child5" name="adult" value="0"
                                            style="text-align: center; border:none; width:40px; margin-left:0;  color: #807c7c;"
                                            min="0" readonly>
                                    </div>
                                    <a type="button" onclick="child_increment_header_list()"
                                        style="height: 19px; width:19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="guests-input-row">
                                <div class="col-6">
                                    <div class="col-12 guest-type-container">
                                        <p class="guest-type-title">Infants</p>
                                    </div>
                                    <div class="col-12" style="padding: 0px;">
                                        <p class="guest-type-desc">Under 2</p>
                                    </div>
                                </div>
                                <div class="col-6"
                                    style="display: flex; align-items: center; justify-content: end;">
                                    <a type="button" onclick="infant_decrement_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-minus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                    <div
                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                        <input type="number" id="infant5" name="adult" value="0"
                                            style="text-align: center; border:none; width:40px; margin-left:0; color: #807c7c;"
                                            min="0" readonly>
                                    </div>
                                    <a type="button" onclick="infant_increment_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-plus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="guests-input-row">
                                <div class="col-6">
                                    <div class="col-12 guest-type-container">
                                        <p class="guest-type-title">Pets</p>
                                    </div>
                                    <div class="col-12" style="padding: 0px;">
                                        <p class="guest-type-desc">Service animal?</p>
                                    </div>
                                </div>
                                <div class="col-6"
                                    style="display: flex; align-items: center; justify-content: end;">
                                    <a type="button" onclick="pet_decrement_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-minus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                    <div
                                        style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                        <input type="number" id="pet5" name="adult" value="0"
                                            style="text-align: center; border:none; width:40px; margin-left:0;  color: #807c7c;"
                                            min="0" readonly>
                                    </div>
                                    <a type="button" onclick="pet_increment_header_list()"
                                        style="height: 19px; width: 19px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-plus guests-style"
                                            style="padding:0px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="filter-modal-row">
                        <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">Number of Rooms</h5>

                        <div class="roomnumber-input-row">
                            <div class="col-6 vertical-center">
                                <div class="col-12 roomnumberoption-type-container">
                                    <h6 class="roomnumberoption-type-title-modal">Bedroom</h6>
                                </div>
                            </div>
                            <div class="col-6 roomnumberoption-button-container">
                                <a type="button" onclick="bedroom_decrement_modal()"
                                    class="roomnumberoption-button-title">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div
                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="bedroom_number2" name="bedroom" value="0"
                                        style="text-align: center; margin-left: 7px; border:none; width:40px;" min="0"
                                        readonly>
                                </div>
                                <a type="button" onclick="bedroom_increment_modal()"
                                    class="roomnumberoption-button-title">
                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                </a>
                            </div>
                        </div>

                        <div class="roomnumber-input-row">
                            <div class="col-6 vertical-center">
                                <div class="col-12 roomnumberoption-type-container">
                                    <h6 class="roomnumberoption-type-title-modal">Bathroom</h6>
                                </div>
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="bathroom_decrement_modal()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div
                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="bathroom_number2" name="bathroom" value="0"
                                        style="text-align: center; margin-left: 7px; border:none; width:40px;" min="0"
                                        readonly>
                                </div>
                                <a type="button" onclick="bathroom_increment_modal()"
                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                </a>
                            </div>
                        </div>

                        <div class="roomnumber-input-row margin-bottom-0px">
                            <div class="col-6 vertical-center">
                                <div class="col-12 roomnumberoption-type-container">
                                    <h6 class="roomnumberoption-type-title-modal">Bed</h6>
                                </div>
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="bed_decrement_modal()"
                                    style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-minus guests-style" style="padding:0px"></i>
                                </a>
                                <div
                                    style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                    <input type="number" id="bed_number2" name="beds" value="0"
                                        style="text-align: center; border:none; margin-left: 7px; width:40px;" min="0"
                                        readonly>
                                </div>
                                <a type="button" onclick="bed_increment_modal()"
                                    style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    -->

                    <div class="filter-modal-row">
                        <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">Number of Rooms</h5>

                        <h6 class="roomnumberoption-type-title-modal ">Bedrooms</h6>

                        <div class="roomnumberfilter-gap">
                            <div class="roomnumberoption-container" style="display: flex;">
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="o0" name="o" checked/>
                                    <label class="roomnumberoption-checkbox-alias" for="o0">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">Any</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="o1" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o1">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">1</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o2" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o2">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">2</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o3" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o3">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">3</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o4" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o4">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">4</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o5" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o5">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">5</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o6" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o6">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">6</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o7" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o7">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">7</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="o8" name="o"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o8">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">8+</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <h6 class="roomnumberoption-type-title-modal roomnumberfiltertitle-gap">Beds</h6>

                        <div class="roomnumberfilter-gap">
                            <div class="roomnumberoption-container" style="display: flex;">
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="a0" name="a" checked/>
                                    <label class="roomnumberoption-checkbox-alias" for="a0">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">Any</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="a1" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a1">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">1</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a2" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a2">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">2</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a3" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a3">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">3</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a4" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a4">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">4</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a5" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a5">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">5</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a6" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a6">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">6</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a7" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a7">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">7</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="a8" name="a"/>
                                    <label class="roomnumberoption-checkbox-alias" for="a8">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">8+</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h6 class="roomnumberoption-type-title-modal roomnumberfiltertitle-gap">Bathrooms</h6>

                        <div class="roomnumberfilter-gap">
                            <div class="roomnumberoption-container" style="display: flex;">
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="b0" name="b" checked/>
                                    <label class="roomnumberoption-checkbox-alias" for="b0">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">Any</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio"  value="" id="b1" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b1">
                                        <div>
                                            <p style="font-size: 13px; margin: 0px;">1</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b2" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b2">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">2</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b3" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b3">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">3</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b4" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b4">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">4</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b5" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b5">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">5</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b6" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="o6">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">6</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b7" name="b"/>
                                    <label class="roomnumberoption-checkbox-alias" for="b7">
                                        <div class="">
                                            <p style="font-size: 13px; margin: 0px;">7</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="roomnumber-filter-container">
                                    <input type="radio" value="" id="b8" name="b"/>
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

                        <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">Property Type</h5>
                        <div class="propertytype-input-row">
                            <div class="col-12 propertytype-grid-container">

                                @php
                                $i = 0;
                                @endphp
                                @php
                                $checked2 = [];
                                if(isset($_GET['filterProperty'])){
                                $checked2 = $_GET['filterProperty'];
                                }
                                @endphp
                                <input type="hidden" name="filterProperty[]" value="null"/>
                                @foreach ($property_type as $item)
                                <div class="propertytypeoption-type-container">
                                    <input type="checkbox" name="filterProperty[]" value="{{ $item->id_property_type }}" @if(in_array($item->id_amenities,
                                        $checked2)) checked @endif id="r{{ $i }}" />
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

                        <h5 class="filter-modal-row-title col-12" style="cursor: pointer;">Accessibility Features</h5>
                        <p class="modal-filter-text-row modal-fiter-desc">This info was provided by the Host and reviewed by EZV.</p>

                        <div id="modal-accessibility-default" class="col-12 mt-2rem">
                            <h6 class="filter-modal-row-title-secondary" style="margin-bottom: 10px;">
                                Guest entrance and parking
                            </h6>
                            <div class="row">
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Step free guest entrance
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Guest entrance wider than 32 inches
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Accessible parking spot
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Step-free path to the guest entrance
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <h6 id="show-more-accessibility" class="filter-modal-row-title-secondary" onclick="showmoreaccessibility();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration:underline;">
                                    Show more
                                </h6>
                            </div>
                        </div>

                        <div id="modal-accessibility-all" class="col-12 mt-2rem display-none">
                            <h6 class="filter-modal-row-title-secondary" style="margin-bottom: 10px;">
                                Bedroom
                            </h6>
                            <div class="row">
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Step free guest entrance
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Guest entrance wider than 32 inches
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <h6 id="show-less-accessibility" class="filter-modal-row-title-secondary" onclick="closemoreaccessibility();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                    Show less
                                </h6>
                            </div>
                        </div>

                        <!--
                        @foreach ($accessibility_features2 as $item)
                        <div class="col-12 mt-2rem">
                            <h6 class="filter-modal-row-title-secondary" style="margin-bottom: 10px;">{{ $item->name }}
                            </h6>
                            @php
                            $checked2 = [];
                            if(isset($_GET['filterAccessibilityDetails'])){
                            $checked2 = $_GET['filterAccessibilityDetails'];
                            }
                            @endphp
                            <div class="row">
                                @foreach ($accessibility_features_detail2 as $item2)
                                @if ($item2 -> id_accessibility_features == $item -> id_accessibility_features)
                                <div class="col-6 font-14 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item2->name }}
                                        <input type="checkbox" name="filterAccessibilityDetails[]"
                                            value="{{ $item->id_accessibility_features_detail }}"
                                            @if(in_array($item->id_accessibility_features_detail, $checked2)) checked
                                        @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        -->
                    </div>

                    <div class="filter-modal-row">

                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Amenities</h5>


                        <div id="modal-amenities-default" class="col-12">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="" value="null"/>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Parking
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Wifi
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Pool
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Private Entrace
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Air Conditioning
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Free Cencelation
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <h6 id="show-more-amenities" class="filter-modal-row-title-secondary" onclick="showmoreamenities();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                Show more
                            </h6>
                        </div>

                        <div id="modal-amenities-all" class="col-12 mt-1rem display-none">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="" value="null"/>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Ocean View
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Breakfast
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Kitchen
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Washer
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Heating
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Dryer
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <h6 id="show-less-amenities" class="filter-modal-row-title-secondary" onclick="closemoreamenities();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                Show less
                            </h6>
                        </div>




                        <!--
                        <div class="col-12">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="filterAmenities[]" value="null"/>
                                @foreach ($amenities2 as $item)
                                @php
                                $checked = [];
                                if(isset($_GET['filterAmenities'])){
                                $checked = $_GET['filterAmenities'];
                                }
                                @endphp
                                <div class="col-4 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                        <input type="checkbox" name="filterAmenities[]"
                                            value="{{ $item->id_amenities }}" @if(in_array($item->id_amenities,
                                        $checked)) checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        -->

                    </div>

                    <div class="filter-modal-row">

                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Booking Options</h5>

                        <div class="row col-12 modal-margin-0 margin-top-2rem">
                            <div class="col-11 modal-padding-0">
                                <h6 class="filter-modal-row-title-secondary">
                                    Instant Book
                                </h6>
                                <p class="modal-fiter-desc-secondary modal-margin-0">Listings you can book without
                                    waiting for Host approval</p>
                            </div>
                            <div class="col-1 modal-booking-checkbox">
                                <input type="checkbox" hidden="hidden" id="instant_book">
                                <label class="switch" for="instant_book"></label>
                            </div>
                        </div>
                        <div class="row col-12 modal-margin-0 margin-top-2rem">
                            <div class="col-11 modal-padding-0">
                                <h6 class="filter-modal-row-title-secondary">
                                    Self check-in
                                </h6>
                                <p class="modal-fiter-desc-secondary modal-margin-0">Easy access to the property once
                                    you arrive</p>
                            </div>
                            <div class="col-1 modal-booking-checkbox">
                                <input type="checkbox" hidden="hidden" id="self_check_in">
                                <label class="switch" for="self_check_in"></label>
                            </div>
                        </div>
                        <div class="row col-12 modal-margin-0 margin-top-2rem">
                            <div class="col-11 modal-padding-0">
                                <h6 class="filter-modal-row-title-secondary">
                                    Free cancellation
                                </h6>
                                <p class="modal-fiter-desc-secondary modal-margin-0">Only show stays that offer free
                                    cancellation</p>
                            </div>
                            <div class="col-1 modal-booking-checkbox">
                                <input type="checkbox" hidden="hidden" id="free_cancelation">
                                <label class="switch" for="free_cancelation"></label>
                            </div>
                        </div>
                    </div>

                    <div class="filter-modal-row" style="border-bottom: 0px;">

                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Host Languange</h5>
                        <div id="modal-language-default" class="col-12">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="" value="null"/>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        English
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        French
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        German
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Japanese
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <h6 id="show-more-language" class="filter-modal-row-title-secondary" onclick="showmorelanguage();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                Show more
                            </h6>
                        </div>

                        <div id="modal-language-all" class="col-12 mt-1rem display-none">
                            <div class="row modal-checkbox-row">
                                <input type="hidden" name="" value="null"/>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Italian
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Russian
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Spanish
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Chinese (Simplified)
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Arabic
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        Portugese
                                        <input type="checkbox" name="" value=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <h6 id="show-less-language" class="filter-modal-row-title-secondary" onclick="closemorelanguage();" style="margin-top: 2rem; margin-bottom: 0px; cursor: pointer; text-decoration: underline;">
                                Show less
                            </h6>
                        </div>

                        <!--
                        <div class="row modal-checkbox-row">
                            @foreach ($host_language2 as $item)
                            <div class="col-6 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">{{ $item->name }}
                                    <input type="checkbox" name="filterHostLanguage[]"
                                        value="{{ $item->id_host_language }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        -->

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
