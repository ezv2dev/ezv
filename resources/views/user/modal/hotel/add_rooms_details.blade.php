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
                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">Price</label>
                        <div class="col-md-8">
                            <input type="text" name="price_room_details" id="price_room_details"
                                class="modal-input form-control" placeholder="Price Room Details" />
                            <small id="err-rname" style="display: none;" class="invalid-feedback">Price Room
                                Details</small>
                        </div>
                    </div>

                    <div class="row mb-4" style="padding-left: 10px;">
                        <label for="" class="col-md-4">Price Discount</label>
                        <div class="col-md-8">
                            <input type="text" name="price_discount_room_details" id="price_discount_room_details"
                                class="modal-input form-control" placeholder="Price Room Details" />
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
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
