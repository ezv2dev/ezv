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
        <div class="modal-content">
            {{-- <form action="{{ route('hotel_update_amenities') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel[0]->id_hotel }}"> --}}
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">{{ __('user_page.Edit Amenities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">

                <div class="form-group pt-2 px-4">
                    <div class="row translate-text-group">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Amenities') }}</label>
                                <div class="space-y-2">
                                    @foreach($amenities_m as $data)
                                    <div class="form-check row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($hotel_amenities as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp

                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_amenities }}"
                                                    id="{{ $data->id_amenities }}" name="amenities[]"
                                                    {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Bathroom') }}</label>
                                <div class="space-y-2">
                                    @foreach($bathroom_m as $data)
                                    <div class="form-check row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($bathroom as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bathroom }}"
                                                id="{{ $data->id_amenities }}" name="bathroom[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Bedroom') }}</label>
                                <div class="space-y-2">
                                    @foreach($bedroom_m as $data)
                                    <div class="form-check row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($bedroom as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bed }}"
                                                id="{{ $data->id_bed }}" name="bedroom[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Kitchen') }}</label>
                                <div class="space-y-2">
                                    @foreach($kitchen_m as $data)
                                    <div class="form-check  row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($kitchen as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_kitchen }}"
                                                id="{{ $data->id_kitchen }}" name="kitchen[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Safety') }}</label>
                                <div class="space-y-2">
                                    @foreach($safety_m as $data)
                                    <div class="form-check  row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($safety as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_safety }}"
                                                id="{{ $data->id_safety }}" name="safety[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label">{{ __('user_page.Service') }}</label>
                                <div class="space-y-2">
                                    @foreach($service_m as $data)
                                    <div class="form-check  row admin-edit-aminities-modal">
                                        @php
                                            $isChecked = "";
                                            foreach ($service as $item) {
                                                if($data->name == $item->name) {
                                                    $isChecked = "checked";
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_service }}"
                                                id="{{ $data->id_service }}" name="service[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100" onclick="editAmenitiesHotel({{ $hotel[0]->id_hotel }})">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
