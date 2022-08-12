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
//get from link
$get_min = request()->get('fMinPrice');
if (!$get_min) {
    $get_min = 0;
}

$get_max = request()->get('fMaxPrice');
if (!$get_max) {
    $get_max = 200000000;
}
@endphp

<div class="modal fade" id="modalFiltersCollab" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-md-down" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body">
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
                        {{ Translate::translate('Gender') }}</h5>
                    <div id="modal-category-default" class="col-12">
                        <div class="row modal-checkbox-row">
                            <div class="col-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Male
                                    <input type="radio" name="gender[]" value="male">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-4 checkdesign-gap">
                                <label class="checkdesign checkdesign-modal-filter">Female
                                    <input type="radio" name="gender[]" value="female">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-modal-row">
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">
                        {{ Translate::translate('Followers') }}</h5>
                    <div class="col-12" style="display: flex; justify-content: center;">

                        <div class="double-slider-modal">
                            <div class="extra-controls form-inline">
                                <div class="form-group col-lg-12" style="display: flex;">
                                    <div class=""
                                        style="display: table; width: 50%; float: left; padding-right: 10px;">
                                        <div class="col-lg-12"
                                            style="border: 1px solid #ff7400; border-radius: 10px; padding-left: 8px; padding-bottom: 8px;">
                                            <label for="fMinFollowers" style="font-size: 12px;">Min</label>
                                            <input name="fMinFollowers" style="font-size: 12px; border: none;"
                                                type="text" class="js-input-from form-control"
                                                value="{{ $get_min }}" />
                                            <input type="hidden" id="min_followers_price"
                                                value="{{ $get_min }}">
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
                                            <label for="fMaxFollowers" style="font-size: 12px;">Max</label>
                                            <input name="fMaxFollowers" style="font-size: 12px; border: none;"
                                                type="text" class="js-input-to form-control"
                                                value="{{ $get_max }}" />
                                            <input type="hidden" id="max_followers_price"
                                                value="{{ $get_max }}">
                                        </div>
                                    </div>

                                </div>
                                <input type="text" class="js-range-slider" value="" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Submit -->
            <div class="modal-filter-footer">
                <button type="submit"
                    style="width:150px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                    class="btn btn-primary btn-lg btn-block" onclick="">
                    {{ Translate::translate('Save') }}
                </button>
            </div>
            <!-- END Submit -->
        </div>
    </div>
</div>
