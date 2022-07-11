<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_room" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 3rem !important;">
                <h5 class="modal-title">{{ __('user_page.Add New Room') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="
                padding: 40px;
                padding-top: 0;
                padding-bottom: 0;
            ">
                <form action="{{ route('store_room') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel[0]->id_hotel }}">

                    <div class="mt-4"></div>

                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">{{ __('user_page.Name of Room') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="name_room" id="name_room" class="modal-input form-control" placeholder="{{ __('user_page.Name of Room') }} Hotel.." required />
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">{{ __('user_page.Choose Type of Room') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="id_hotel_type" id="id_hotel_type">
                                @forelse ($hotelType as $typeRoom)
                                    <option value="{{ $typeRoom->id_hotel_type }}">{{ $typeRoom->name }}</option>
                                @empty
                                    <option value="">{{ __('user_page.No Data') }}</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label class="col-md-4" for="price">{{ __('user_page.Room Size') }}(m<sup>2</sup>)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control modal-input" id="room_size" name="room_size"
                                placeholder="{{ __('user_page.Room Size') }}.."
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label class="col-md-4" for="price">{{ __('user_page.Total Capacity') }} ({{ __('user_page.People') }})</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control modal-input" id="capacity" name="capacity"
                                placeholder="{{ __('user_page.Total Max People') }}.."
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label class="col-md-4" for="adult">{{ __('user_page.Bed Type') }}</label>
                        <div class="col-md-8">
                            <select class="form-control modal-input" name="id_bed" id="id_bed">
                                @foreach ($beds as $bed)
                                    <option value="{{ $bed->id_bed }}">{{ $bed->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">{{ __('user_page.Total Rooms') }}</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control modal-input" id="number_of_room" name="number_of_room"
                                placeholder="{{ __('user_page.Number of Room') }}.." min="1" required>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">{{ __('user_page.Price') }} (IDR)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control modal-input" id="price" name="price"
                                placeholder="{{ __('user_page.Price per Night') }}.."
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                required>
                        </div>
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center; margin-top: -30px;">
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
