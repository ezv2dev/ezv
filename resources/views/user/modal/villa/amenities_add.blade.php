<!-- Fade In Default Modal -->

<style>
    .container-checkbox2 {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: 500 !important;
    }

    /* Hide the browser's default checkbox */
    .container-checkbox2 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .container-checkbox2 .checkmark2 {
        position: absolute;
        top: 25px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container-checkbox2:hover input~.checkmark2 {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container-checkbox2 input:checked~.checkmark2 {
        background-color: #FF7400;
    }

    /* Create the checkmark2/indicator (hidden when not checked) */
    .container-checkbox2 .checkmark2:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark2 when checked */
    .container-checkbox2 input:checked~.checkmark2:after {
        display: block;
    }

    /* Style the checkmark2/indicator */
    .container-checkbox2 .checkmark2:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>

<div class="modal fade" id="modal-edit_amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">{{ __('user_page.Edit Amenities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                <div class="form-group pt-2 px-4">
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Amenities') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($amenities_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($villa_amenities as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_amenities }}"
                                                id="{{ $data->id_amenities }}" name="amenities[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Bathroom') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($bathroom_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($bathroom as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bathroom }}"
                                                id="{{ $data->id_bathroom }}" name="bathroom[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- <hr>
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Bedroom') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($bedroom_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($bedroom as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bed }}"
                                                id="{{ $data->id_bed }}" name="bedroom[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                King
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="kingbed_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="kingbed" name="king" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="kingbed_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                Double
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="doublebed_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="doublebed" name="double" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="doublebed_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                Queen
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="queenbed_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="queenbed" name="queen" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="queenbed_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                Single
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="singlebed_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="singlebed" name="single" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="singlebed_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                Working table
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="workingtable_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="workingtable" name="workingtable" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="workingtable_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                Couch
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="couch_decrement()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-minus" style="padding:30%"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <p><input type="number" id="couch" name="couch" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="couch_increment()" style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                    <i class="fa-solid fa-plus" style="padding:30%"></i>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr> -->
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Kitchen') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($kitchen_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($kitchen as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_kitchen }}"
                                                id="{{ $data->id_kitchen }}" name="kitchen[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Safety') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($safety_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($safety as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_safety }}"
                                                id="{{ $data->id_safety }}" name="safety[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label class="form-label"><b>{{ __('user_page.Service') }}</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($service_m as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($service as $item) {
                                                if ($data->name == $item->name) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_service }}"
                                                id="{{ $data->id_service }}" name="service[]" {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    {{-- <div class="row">
                            <label class="form-label"><b>{{ __('user_page.Family') }}</b></label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                                @foreach ($family_m as $data)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="row" style="font-size: 13px;">
                                            @php
                                                $isChecked = '';
                                                foreach ($family as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_family }}"
                                                    id="{{ $data->id_family }}" name="family[]" {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label"><b>{{ __('user_page.Outdoor') }}</b></label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                                @foreach ($outdoor_m as $data)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="row" style="font-size: 13px;">
                                            @php
                                                $isChecked = '';
                                                foreach ($outdoor as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_outdoor }}"
                                                    id="{{ $data->id_outdoor }}" name="outdoor[]"
                                                    {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 70px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100"
                        onclick="editAmenitiesVilla({{ $villa[0]->id_villa }})">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
