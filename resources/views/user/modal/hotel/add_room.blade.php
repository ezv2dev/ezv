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
                            <input type="number" class="form-control modal-input" id="frm-price"
                                placeholder="{{ __('user_page.Price per Night') }}..">
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
function addComa(x) {
    return x.replace(/\B(?=(\d{3})+(?!\d))/g,",");
}
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
                id_hotel_type: $('#id_hotel_type').val(),
                name_room: $('#name_room').val(),
                id_bed: $('#id_bed').val(),
                room_size: $('#room_size').val(),
                number_of_room: $('#number_of_room').val(),
                capacity: $('#capacity').val(),
                status: $('#status').val(),
                price: $('#frm-price').val(),
            },
            success: function (response) {
                // $("#name-content").html(response.data);
                // $("#name-content-mobile").html(response.data);
                // $("#hotelTitle").html(response.data + " - EZV2");
                console.log(response);
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                // add-hotel-list
                let rooms;

                rooms = '<div class="col-12 col-md-4 text-center tab-body"> <div class="content list-image-content"> <input type="hidden" value="" id="id_hotel" name="id_hotel"> <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true"> <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 296px; transform: translate3d(0px, 0px, 0px);"><a href="'+ response.data +'" target="_blank" class="grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 296px;"> <img class="brd-radius img-fluid grid-image" style="height: 200px; display: block;" src="https://images.unsplash.com/photo-1609611606051-f22b47a16689?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80" alt=""> </a></div></div></div></div></div><div class="col-12 col-md-4 text-justify tab-body" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');"><h4><p><a href="' +
                response.data + '" target="_blank">' + $('#name_room').val() + '</a></p></h4><p class="desc-hotel"><span class="translate-text-single"></span></p><div class="d-flex" style="font-size: 14px;"><svg class="bk-icon -streamline-room_size" height="24px" width="24px" viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false"><path d="M3.75 23.25V7.5a.75.75 0 0 0-1.5 0v15.75a.75.75 0 0 0 1.5 0zM.22 21.53l2.25 2.25a.75.75 0 0 0 1.06 0l2.25-2.25a.75.75 0 1 0-1.06-1.06l-2.25 2.25h1.06l-2.25-2.25a.75.75 0 0 0-1.06 1.06zM5.78 9.22L3.53 6.97a.75.75 0 0 0-1.06 0L.22 9.22a.75.75 0 1 0 1.06 1.06l2.25-2.25H2.47l2.25 2.25a.75.75 0 1 0 1.06-1.06zM7.5 3.75h15.75a.75.75 0 0 0 0-1.5H7.5a.75.75 0 0 0 0 1.5zM9.22.22L6.97 2.47a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06L8.03 2.47v1.06l2.25-2.25A.75.75 0 1 0 9.22.22zm12.31 5.56l2.25-2.25a.75.75 0 0 0 0-1.06L21.53.22a.75.75 0 1 0-1.06 1.06l2.25 2.25V2.47l-2.25 2.25a.75.75 0 0 0 1.06 1.06zM10.5 13.05v7.2a2.25 2.25 0 0 0 2.25 2.25h6A2.25 2.25 0 0 0 21 20.25v-7.2a.75.75 0 0 0-1.5 0v7.2a.75.75 0 0 1-.75.75h-6a.75.75 0 0 1-.75-.75v-7.2a.75.75 0 0 0-1.5 0zm13.252 2.143l-6.497-5.85a2.25 2.25 0 0 0-3.01 0l-6.497 5.85a.75.75 0 0 0 1.004 1.114l6.497-5.85a.75.75 0 0 1 1.002 0l6.497 5.85a.75.75 0 0 0 1.004-1.114z"></path></svg><p style="margin-left: 10px; margin-top: 5px; font-size: 12px;" class="mb-0">' +
                $('#room_size').val() + ' m<sup>2</sup></p></div></div><div class="col-6 col-md-2 text-center tab-body type-room" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');">';
                for(let i = 0; i < $('#capacity').val(); i++) {
                    rooms += '<i class="fas fa-user" aria-hidden="true"></i>';
                }
                rooms += $('#id_bed').val() == 1 ? '<p style="margin-bottom: 10px; font-size: 13px;">Single</p><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="30px" viewBox="0 0 40 28" style="fill: #222222;"><g id="Group_2" data-name="Group 2" transform="translate(-66 524)"><path id="bed_FILL1_wght400_GRAD0_opsz48" d="M4,38V25.25a5.612,5.612,0,0,1,.5-2.35A4.368,4.368,0,0,1,6,21.1V15.3A5.209,5.209,0,0,1,11.3,10h9a4.336,4.336,0,0,1,2.05.5A5.348,5.348,0,0,1,24,11.85a5.454,5.454,0,0,1,1.625-1.35A4.19,4.19,0,0,1,27.65,10h9a5.211,5.211,0,0,1,3.8,1.525A5.085,5.085,0,0,1,42,15.3v5.8a4.368,4.368,0,0,1,1.5,1.8,5.612,5.612,0,0,1,.5,2.35V38H41V34H7v4ZM25.5,20.25H39V15.3a2.192,2.192,0,0,0-.675-1.65A2.32,2.32,0,0,0,36.65,13H27.5a1.775,1.775,0,0,0-1.425.7,2.45,2.45,0,0,0-.575,1.6ZM9,20.25H22.5V15.3a2.45,2.45,0,0,0-.575-1.6A1.775,1.775,0,0,0,20.5,13H11.3A2.3,2.3,0,0,0,9,15.3Z" transform="translate(62 -534)"></path></g></svg></div>' : '<p style="margin-bottom: 10px; font-size: 13px;"> Twin </p><svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 82 28.001" style="fill: #222222;"> <g id="Group_4" data-name="Group 4" transform="translate(-61 525)"> <path id="Subtraction_1" data-name="Subtraction 1" d="M3,28H0V15.25A5.631,5.631,0,0,1,.5,12.9,4.389,4.389,0,0,1,2,11.1V5.3A5.21,5.21,0,0,1,7.3,0H32.65a5.234,5.234,0,0,1,3.8,1.525A5.109,5.109,0,0,1,38,5.3v5.8a4.391,4.391,0,0,1,1.5,1.8,5.644,5.644,0,0,1,.5,2.35V28H37V24H3v4ZM7,3A2,2,0,0,0,5,5v6H35V5a2,2,0,0,0-2-2H7Z" transform="translate(61 -525)"></path> <path id="Subtraction_2" data-name="Subtraction 2" d="M3,28H0V15.25A5.631,5.631,0,0,1,.5,12.9,4.389,4.389,0,0,1,2,11.1V5.3A5.21,5.21,0,0,1,7.3,0H32.65a5.234,5.234,0,0,1,3.8,1.525A5.109,5.109,0,0,1,38,5.3v5.8a4.391,4.391,0,0,1,1.5,1.8,5.644,5.644,0,0,1,.5,2.35V28H37V24H3v4ZM7,3A2,2,0,0,0,5,5v6H35V5a2,2,0,0,0-2-2H7Z" transform="translate(103 -525)"></path> </g> </svg></div>';
                rooms += '<div class="col-6 col-md-2 text-center tab-body price-room" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');">IDR ' + addComa($('#frm-price').val()) + '<br><a class="btn btn-outline-dark table-room-button" target="_blank">Select Room</a></div>';
                $('.room-content').last().append(rooms);
                $('#modal-add_room').modal("hide");

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
                $('#modal-add_room').modal("hide");
            },
        });
    }
});
</script>
<!-- END Fade In Default Modal -->
