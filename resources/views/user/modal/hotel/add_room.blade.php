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
                {{-- <form action="{{ route('store_room') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data"> --}}
                <form action="javascript:void(0);" method="POST" id="add-room-hotel" class="js-validation"
                    enctype="multipart/form-data">
                    {{-- @csrf --}}
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel[0]->id_hotel }}">

                    <div class="mt-4"></div>

                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">{{ __('user_page.Name of Room') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="name_room" id="name_room" class="modal-input form-control" placeholder="{{ __('user_page.Name of Room') }} Hotel.." />
                            <small id="err-rname" style="display: none;" class="invalid-feedback">{{ __('auth.name_room') }}</small>
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
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <small id="err-rsize" style="display: none;" class="invalid-feedback">{{ __('auth.room_size') }}</small>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label class="col-md-4" for="price">{{ __('user_page.Total Capacity') }} ({{ __('user_page.People') }})</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control modal-input" id="capacity" name="capacity"
                                placeholder="{{ __('user_page.Total Max People') }}.."
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <small id="err-cap" style="display: none;" class="invalid-feedback">{{ __('auth.total_cap') }}</small>
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
                                placeholder="{{ __('user_page.Number of Room') }}.." min="1">
                            <small id="err-numrom" style="display: none;" class="invalid-feedback">{{ __('auth.total_room') }}</small>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">Status</label>
                        <div class="col-md-8">
                            <select class="form-control modal-input" name="status" id="status">
                                <option value="1" selected>Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">{{ __('user_page.Price') }} (IDR)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control modal-input" id="frm-price" name="price"
                                placeholder="{{ __('user_page.Price per Night') }}.."
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <small id="err-prc" style="display: none;" class="invalid-feedback">{{ __('auth.empty_price') }}</small>
                        </div>
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center; margin-top: -30px;">
                            <button type="submit" class="btn btn-sm btn-primary" id="btnaddroomForm">
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
<script>
//Add room hotel
$("#name_room").keyup(function () {
    $('#name_room').removeClass('is-invalid');
    $('#err-rname').hide();
});
$("#room_size").keyup(function () {
    $('#room_size').removeClass('is-invalid');
    $('#err-rsize').hide();
});
$("#number_of_room").keyup(function () {
    $('#number_of_room').removeClass('is-invalid');
    $('#err-numrom').hide();
});
$("#capacity").keyup(function () {
    $('#capacity').removeClass('is-invalid');
    $('#err-cap').hide();
});
$("#frm-price").keyup(function () {
    $('#frm-price').removeClass('is-invalid');
    $('#err-prc').hide();
});
$("#add-room-hotel").submit(function (e) {
    let error = 0;
    if(!$('#name_room').val()) {
        $('#name_room').addClass('is-invalid');
        $('#err-rname').show();
        error = 1;
    }
    if(!$('#room_size').val()) {
        $('#room_size').addClass('is-invalid');
        $('#err-rsize').show();
        error = 1;
    }
    if(!$('#number_of_room').val()) {
        $('#number_of_room').addClass('is-invalid');
        $('#err-numrom').show();
        error = 1;
    }
    if(!$('#capacity').val()) {
        $('#capacity').addClass('is-invalid');
        $('#err-cap').show();
        error = 1;
    }
    if(!$('#frm-price').val()) {
        $('#frm-price').addClass('is-invalid');
        $('#err-prc').show();
        error = 1;
    }
    if(error == 1) {
        e.preventDefault();
    } else {
        e.preventDefault();
        var btn = document.getElementById("btnaddroomForm");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/add-room",
            data: {
                id_hotel: $('#id_hotel').val(),
                name_room: $('#name_room').val(),
                id_hotel_type: $('#id_hotel_type').val(),
                id_bed: $('#id_bed').val(),
                room_size: $('#room_size').val(),
                name_room: $('#number_of_room').val(),
                capacity: $('#capacity').val(),
                status: $('#status').val(),
                price: $('#price').val(),
            },
            success: function (response) {
                $("#name-content").html(response.data);
                $("#name-content-mobile").html(response.data);
                $("#hotelTitle").html(response.data + " - EZV2");

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                editNameCancel();
            },
            error: function (jqXHR, exception) {
                if (jqXHR.responseJSON.errors) {
                    for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.errors[i],
                            position: "topRight",
                        });
                    }
                } else {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message,
                        position: "topRight",
                    });
                }

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editNameCancel();
            },
        });
    }
});
</script>
<!-- END Fade In Default Modal -->
