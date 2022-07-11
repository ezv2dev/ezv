<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true" style="padding-left: 1.5rem !important;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('room_update_amenities') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_hotel_room" id="id_hotel_room" value="{{ $hotelRoom->id_hotel_room }}">
            <div class="modal-header" style="padding-left: 1.5rem !important;">
                <h5 class="modal-title">{{ __('user_page.Edit Amenities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                    <div class="form-group">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">{{ __('user_page.Amenities') }}</label>
                                    <div class="space-y-2">
                                        @foreach($amenities_m as $data)
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($hotel_amenities as $item) {
                                                    if($data->name == $item->amenities->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_amenities }}" id="{{ $data->id_amenities }}"
                                                name="amenities[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
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
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($bathroom as $item) {
                                                    if($data->name == $item->bathroom->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}"
                                                name="bathroom[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
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
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($bedroom as $item) {
                                                    if($data->name == $item->bedroom->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_bed }}"
                                                id="{{ $data->id_bed }}" name="bedroom[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
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
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($kitchen as $item) {
                                                    if($data->name == $item->kitchen->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_kitchen }}" id="{{ $data->id_kitchen }}"
                                                name="kitchen[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
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
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($safety as $item) {
                                                    if($data->name == $item->safety->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_safety }}" id="{{ $data->id_safety }}"
                                                name="safety[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
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
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = "";
                                                foreach ($service as $item) {
                                                    if($data->name == $item->service->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_service }}" id="{{ $data->id_service }}"
                                                name="service[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ Translate::translate($data->name) }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Submit -->
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            </div>
            <!-- END Submit -->
            </form>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
