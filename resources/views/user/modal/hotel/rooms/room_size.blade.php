<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_room_size" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">{{ __('user_page.Edit Room Size, Capacity, Type Bed, & Total Rooms') }}</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('update_room_size') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_hotel_room" id="id_hotel_room" value="{{ $hotelRoom->id_hotel_room }}">

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Room Size') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="room_size" name="room_size"
                                placeholder="{{ __('user_page.Room Size') }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="{{ $hotelRoom->room_size }}" required>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Total Capacity') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="capacity" name="capacity"
                                placeholder="{{ __('user_page.Total People') }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="{{ $hotelRoom->capacity }}" required>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="adult">{{ __('user_page.Bed Type') }}</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-input" name="id_bed" id="id_bed">
                                @foreach ($beds as $bed)
                                    <option value="{{ $bed->id_bed }}" {{ $hotelRoom->id_bed == $bed->id_bed ? 'selected' : '' }}>{{ $bed->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="children">{{ __('user_page.Total Rooms') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="number_of_room" name="number_of_room"
                                placeholder="{{ __('user_page.Number of Room') }}" min="1" value="{{ $hotelRoom->number_of_room }}" required>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: end;">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
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
