<!-- Fade In Default Modal -->
<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .guest-safety-container {
        padding-bottom: 10px;
    }

    a:hover {
        color: grey;
    }

    a:focus {
        border: none !important;
    }

    .column.right {
        width: 75%;
        float: left;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: black !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
    }

    .nav-tabs>li {
        width: 10%;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
    }


    /* Start of filter modal*/
    .btn-close-modal {
        background: none !important;
        border: none;
    }

    .filter-modal {
        justify-content: flex-end;
    }

    .filter-modal-body {
        padding: 0rem 2rem 2rem 2rem !important;
    }

    .filter-modal-row {
        /* padding-top: 2rem; */
        padding-bottom: 2rem;
        display: table;
        width: 100%;
        border-bottom: none;
    }

    .filter-modal-row-title {
        cursor: pointer;
        font-family: "Poppins";
        color: black;
        font-size: 20px;
        margin-bottom: 2rem;
        font-weight: 500;
    }

    .filter-modal-row-title-secondary {
        color: black;
        font-weight: 500;
        font-family: "Poppins";
    }

    .margin-bottom-0px {
        margin-bottom: 0px !important;
    }

    .roomnumberoption-type-title-modal {
        color: black;
        font-family: "Poppins";
        font-size: 16px;
        font-weight: 400;
        margin: 0px;
    }

    .modal-filter-checkbox {}

    .propertytypemdoal-checkbox-alias {
        border-radius: 15px;
        border: 1px solid rgba(200, 200, 200, 0.77);
        display: inline-block;
        width: 100%;
        height: 110px;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
        position: relative;
        cursor: pointer;
    }

    .propertytype-grid-container input[type="checkbox"] {
        display: none;
        /*   margin-right: -20px;
        position: relative;
        z-index: 2; */
    }

    .propertytype-grid-container input[type="checkbox"]:checked+.propertytypemdoal-checkbox-alias {
        border: 2px solid #ff7400;
        background-color: rgba(242, 242, 242, 0.506);
    }

    .propertytypemodal-icon {
        font-size: 26px;
        margin-bottom: 14px;
        margin-top: 7px;
        display: flex;
        justify-content: center;
    }

    .propertymodal-text {
        display: flex;
        justify-content: center;
    }

    .propertymodal-text p {
        margin: 0px;
        font-family: "Poppins" !important;
        font-size: 14px;
        font-weight: 400;
    }

    .modal-filter-text-row {
        margin-top: 0;
        margin-bottom: 2rem !important;
    }

    .mt-2rem {
        margin-top: 2rem !important;
    }

    .modal-fiter-desc {
        font-family: "Poppins" !important;
        font-size: 15px;
        font-weight: 400;
        color: grey;
    }

    .modal-fiter-desc-secondary {
        font-family: "Poppins" !important;
        font-size: 14px;
        font-weight: 400;
        color: grey;
    }

    .checkdesign-modal-filter {
        display: flex;
        align-items: center;
        height: 25px;
        font-family: "Poppins";
        font-weight: 400;
        padding-left: 36px !important;
    }

    .checkdesign-gap {
        margin-top: 15px;
    }

    .modal-margin-0 {
        margin: 0px;
    }

    .modal-padding-0 {
        padding: 0px;
    }

    .modal-booking-checkbox {
        padding: 0px;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .margin-top-2rem {
        margin-top: 2rem;
    }

    .modal-filter-footer {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        border-top: none;
        height: 60px;
    }

    .modal-checkbox-row {
        margin-top: -17px;
    }

    .propertytype-grid-container {
        grid-template-columns: repeat(4, 1fr) !important;
        grid-template-rows: repeat(1, auto) !important;
        gap: 16px;
        display: grid;
    }

    /* End of filter modal*/

    /*Start of filter radio option*/
    .roomnumber-filter-container {
        width: 100%;
    }

    .roomnumberoption-checkbox-alias {
        border-radius: 10px;
        border: 1px solid rgba(200, 200, 200, 0.77);
        display: flex;
        /* align-items: center; */
        width: 100%;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
        position: relative;
        cursor: pointer;
    }

    .roomnumberoption-container input[type="radio"] {
        display: none;
        /*   margin-right: -20px;
        position: relative;
        z-index: 2; */
    }

    .roomnumberoption-container input[type="radio"]:checked+.roomnumberoption-checkbox-alias {
        border: 2px solid #ff7400;
        background-color: rgba(242, 242, 242, 0.506);
    }

    .roomnumberoption-container {
        grid-template-columns: repeat(8, 1fr) !important;
        grid-template-rows: repeat(1, auto) !important;
        gap: 12px;
        display: grid;
    }

    .roomnumberfiltertitle-gap {
        margin-top: 1.5rem;
    }

    .roomnumberfilter-gap {
        margin-top: 1.5rem;
    }

    .font-12 {
        font-size: 12px !important;
    }

    /*End of filter radio option*/
</style>

<style>
    /* Radio Button */
    .transition {
        transition: all 0.3s ease-out;
    }

    .heading {
        text-align: center;
        font-size: 0.8em;
    }

    input[type="radio"] {
        visibility: hidden;
        height: 0;
        width: 0;
    }

    .d-flex label {
        width: 40px;
        display: flex;
        height: 40px;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background-color: #222222;
        color: white;
        border-radius: 50%;
        margin-left: 10px;
    }

    input[type="radio"]:checked+label {
        background-color: #ff7400;
    }

    /* End Radio Button */
</style>

<div id="modal-edit-hotel-rules" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered" style="overflow-y: initial !important;">
        <div class="modal-content" style="background-color: #fff;">
            <div class="modal-header filter-modal d-flex justify-content-between">
                <h3 class="mb-0">Hotel Rules</h3>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="tabbable column-wrapper translate-text-group">
                    <hr style="margin-top: -20px;">
                    <form method="POST" action="javascript:void(0);" id="hotelRuleForm">
                        @csrf
                        <input type="hidden" id="hotel" name="id_hotel" value="{{ $hotel[0]->id_hotel }}">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Suitable for children (2-12
                                            years)</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            You can let guests know that your place isn't suitable for
                                            children if there are features
                                            that are dangerous for them. Guests will still be able to reach out for more
                                            details.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="children" id="children_1" value="no"
                                            {{ isset($hotelRules->children) == 'no' ? 'checked' : '' }} />
                                        <label for="children_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="children" id="children_2" value="yes"
                                            {{ isset($hotelRules->children) == 'yes' ? 'checked' : '' }} />
                                        <label for="children_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Suitable for infants (under 2
                                            years)</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            You can let guests know that your place isn't suitable for infants if there
                                            are
                                            features
                                            that are dangerous for them. Guests will still be able to reach out for more
                                            details.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="infants" id="infant_1" value="no"
                                            {{ isset($hotelRules->infants) == 'no' ? 'checked' : '' }} />
                                        <label for="infant_1"><i class="fa fa-times"></i></label>

                                        <input type="radio" name="infants" id="infant_2" value="yes"
                                            {{ isset($hotelRules->infants) == 'yes' ? 'checked' : '' }} />
                                        <label for="infant_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Pets allowed</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            You can limit guests from bringing pets, but you must reasonably accommodate
                                            guests
                                            that
                                            might bring an assistant animal.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="pets" id="pet_1" value="no"
                                            {{ isset($hotelRules->pets) == 'no' ? 'checked' : '' }} />
                                        <label for="pet_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="pets" id="pet_2" value="yes"
                                            {{ isset($hotelRules->pets) == 'yes' ? 'checked' : '' }} />
                                        <label for="pet_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Smoking allowed</span></p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="smoking" id="smoke_1" value="no"
                                            {{ isset($hotelRules->smoking) == 'no' ? 'checked' : '' }} />
                                        <label for="smoke_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="smoking" id="smoke_2" value="yes"
                                            {{ isset($hotelRules->smoking) == 'yes' ? 'checked' : '' }} />
                                        <label for="smoke_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Events allowed</span></p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="events" id="event_1" value="no"
                                            {{ isset($hotelRules->events) == 'no' ? 'checked' : '' }} />
                                        <label for="event_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="events" id="event_2" value="yes"
                                            {{ isset($hotelRules->events) == 'yes' ? 'checked' : '' }} />
                                        <label for="event_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex">
                    <div class="d-flex align-items-center col-8">
                        <p class="mb-0" style="color: red; font-size: 12px;"><sup>*</sup>Please make
                            sure
                            you select all the list
                        </p>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <button type="submit" id="btnSaveHouseRules" form="hotelRuleForm"
                            style="border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                            class="btn btn-primary btn-lg btn-block">
                            Save
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
