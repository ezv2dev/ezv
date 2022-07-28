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

<div class="modal fade" id="modal-add-room-details" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">Add Room Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                <div class="form-group pt-2 px-4">
                    <input type="hidden" value="" id="idHotelRoom">
                    <input type="hidden" value="" id="idHotel">
                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">Price</label>
                        <div class="col-md-8">
                            <input type="text" name="price_room_details" id="price_room_details"
                                class="modal-input form-control" placeholder="Price Room Details"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                            <small id="err-rname" style="display: none;" class="invalid-feedback">Price Room
                                Details</small>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">Price Discount</label>
                        <div class="col-md-8">
                            <input type="text" name="price_discount_room_details" id="price_discount_room_details"
                                class="modal-input form-control" placeholder="Price Room Details"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                            <small id="err-rname" style="display: none;" class="invalid-feedback">Price Discount Room
                                Details</small>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px">
                        <label for="" class="col-md-4">{{ __('user_page.Total Capacity') }}
                            ({{ __('user_page.People') }})</label>
                        <div class="col-md-8">
                            <select class="form-control" name="room_details_capacity" id="room_details_capacity">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100" onclick="saveRoomDetails()">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- blade-formatter-disable --}}
<script>
    function saveRoomDetails() {
        let priceRoomDetails = $("#price_room_details").val();
        let priceDiscountRoomDetails = $("#price_discount_room_details").val();
        let roomDetailsCapacity = $("#room_details_capacity").val();
        let idHotelRoom = $("#idHotelRoom").val();
        let idHotel = $("#idHotel").val();

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/room/details/add",
            data: {
                priceRoomDetails: priceRoomDetails,
                priceDiscountRoomDetails: priceDiscountRoomDetails,
                roomDetailsCapacity: roomDetailsCapacity,
                idHotelRoom: idHotelRoom,
                idHotel: idHotel,
            },
            success: function(data) {
                let priceDiscount = parseInt(data.discount_price);
                let pricee = parseInt(data.price);
                $('#modal-add-room-details').modal('hide');

                let content = '<div class="col-12 m-0 ps-2 pe-2 row ">';
                content += '<div class="col-2 border border-secondary border-end-0">';

                for (let i = 0; i < data.capacity; i++) {
                    content += '<i class="fas fa-user"></i>';
                }
                content += '</div>';

                content += `
                        <div class="col-4 border border-secondary border-end-0">
                            <div class="price-tag">`;

                content += '<p class="price-discount mb-2">IDR '+ priceDiscount.toLocaleString('en-US') + '</p>';

                content += '<h6 class="price-current mb-0">IDR '+ pricee.toLocaleString('en-US') + '</h6>';

                content += `
                            </div>
                            <p class="mb-0 text-secondary text-small">Includes taxes and charges</p>
                        </div>
                        <div class="col-4 border border-secondary border-end-0">
                            <div class="choice-item">
                                <i class="fa-solid fa-mug-saucer regular-icon"></i>
                                <span class="regular-text">Breakfast Rp 171,600 (optional)</span>
                            </div>
                        </div>
                        <div class="col-2 border border-secondary">
                            <select name="room-amount" id="room-amount" style="width: 3.5rem;">
                                <option value="0">0</option>
                                <option value="0">1 &nbsp; &nbsp; &nbsp; IDR
                                    {{ number_format($item->price) }}
                                </option>
                            </select>
                        </div>
                    </div>`;

                $('#hotelTypeDetailList').append(content);

                iziToast.success({
                    title: "Success",
                    message: data.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
            error: function(jqXHR, exception) {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
</script>
{{-- blade-formatter-enable --}}