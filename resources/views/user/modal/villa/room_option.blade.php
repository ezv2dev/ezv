<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_room_option" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">{{ __('user_page.Add Room Option') }}</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-x: hidden; overflow-y: auto; border-radius: 0px;">
                <form action="javascript:void(0);" method="POST" enctype="multipart/form-data"
                    id="roomDetailForm">
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">
                <div>
                    <div class="row mb-5 bedroomDetailFormContent" id="roomDetailFormContent">
                        <div class="form-group mb-4">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-box dropzone">
                                    <p>{{ __('user_page.Upload Image') }}</p>
                                    <img style="width: 100%" src="" alt="">
                                </div>
                                <div class="controls" style="display: none;">
                                    <input id="imgRoomVilla" type="file" name="image" accept=".jpeg,.png,.jpg,.webp" />
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($bedroom_m as $data)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="row" style="font-size: 13px;">
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bed }}" id="{{ $data->id_bed }}" name="bedroom[]">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($bathroom_m as $data)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="row" style="font-size: 13px;">
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]">
                                            {{-- <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]"> --}}
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($bed as $data)
                            <div class="col-6 col-lg-4 bedroomDetailFormContentBed">
                                <div class="reserve-input-row">
                                    <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                        {{ $data->name }}
                                    </div>
                                    <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                        <a type="button" onclick="decrement_qty_bed('bed{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                            <i class="fa fa-circle-minus fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                            <input type="hidden" name="id_bed{{$data->id_bed}}" value="{{ $data->id_bed }}" readonly="">
                                            <p><input type="number" id="bed{{ $data->name }}" name="qty{{$data->id_bed}}" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                        </div>
                                        <a type="button" onclick="increment_qty_bed('bed{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                            <i class="fa fa-circle-plus fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row mb-12 mt-3">
                            <label class="col-sm-4 col-form-label" for="price">
                                {{ __('user_page.Price per Night') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" class="form-control"
                                    id="room-price" name="price" placeholder="Price.."
                                    value="">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-12" style="text-align: center;">
                        <button type="submit" form="roomDetailForm" class="btn btn-sm btn-primary" style="width: 200px;">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
    function increment_qty_bed(elementId) {
        document.getElementById(elementId).stepUp();
    }
    function decrement_qty_bed(elementId) {
        document.getElementById(elementId).stepDown();
    }
</script>
