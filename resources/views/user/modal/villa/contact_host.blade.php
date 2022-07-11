<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_amenities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('villa_update_amenities') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">

                    <div class="form-group">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Amenities</label>
                                    <div class="space-y-2">
                                        @foreach($amenities_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($villa_amenities as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_amenities }}" id="{{ $data->id_amenities }}"
                                                name="amenities[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Bathroom</label>
                                    <div class="space-y-2">
                                        @foreach($bathroom_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($bathroom as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}"
                                                name="bathroom[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Bedroom</label>
                                    <div class="space-y-2">
                                        @foreach($bedroom_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($bedroom as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id_bed }}"
                                                id="{{ $data->id_bed }}" name="bedroom[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Kitchen</label>
                                    <div class="space-y-2">
                                        @foreach($kitchen_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($kitchen as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_kitchen }}" id="{{ $data->id_kitchen }}"
                                                name="kitchen[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Safety</label>
                                    <div class="space-y-2">
                                        @foreach($safety_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($safety as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_safety }}" id="{{ $data->id_safety }}"
                                                name="safety[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Service</label>
                                    <div class="space-y-2">
                                        @foreach($service_m as $data)
                                        <div class="form-check form-switch row">
                                            @php
                                                $isChecked = "";
                                                foreach ($service as $item) {
                                                    if($data->name == $item->name) {
                                                        $isChecked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_service }}" id="{{ $data->id_service }}"
                                                name="service[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">{{ $data->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
