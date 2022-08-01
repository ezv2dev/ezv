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
        height: 20px;
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

    /*End of filter radio option*/

    /* Radio */

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
        /* visibility: hidden; */
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

<div id="modal-cancelation-policy" class="modal fade bs-example-modal-lg" style="font-family: 'Poppins' !important">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal d-flex justify-content-between">
                <h3 class="mb-0">{{ __('user_page.Cancellation Policy') }}</h3>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body modal-body3">
                <div class="tabbable column-wrapper">
                    <form method="POST" action="{{ route('villa_update_cancellation_policy') }}">
                        @csrf
                        <input type="hidden" id="villa" name="id_villa" value="{{ $villa[0]->id_villa }}">

                        <div class="container translate-text-group">
                            <h5 style="margin: 0;">{{ __('user_page.Standard cancellation policy') }}</h5>
                            <p class="text-muted" style="font-size: 10pt;"><span class="translate-text-group-items">Choose the policy that will apply to stays under 28 nights.</span></p>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Flexible</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">Full refund 1 day prior to arrival</span></p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        {{-- <input type="radio" name="pool" id="pool_1" value="no" />
                                        <label for="pool_1"><i class="fa fa-times"></i></label> --}}
                                        <input type="radio" name="type_cancellation" id="flexible" value="flexible" {{ !empty($cancellation_policy->type_cancellation) == "flexible" ? "checked" : "" }} />
                                        <label for="flexible"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Flexible or Non-refundable</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">In addition to Flexible, offer a non-refundable option—guests pay 10% less, but you keep your payout no matter when they cancel.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="flexible_non_refund" value="flexible_non_refund" {{ !empty($cancellation_policy->type_cancellation) == "flexible_non_refund" ? "checked" : "" }} />
                                        <label for="flexible_non_refund"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="lake" id="lake_2" value="2" required />
                                        <label for="lake_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Moderate</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">Full refund 5 days prior to arrival</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="moderate" value="moderate" {{ !empty($cancellation_policy->type_cancellation) == "moderate" ? "checked" : "" }} />
                                        <label for="moderate"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="climb" id="climb_2" value="3" required />
                                        <label for="climb_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Moderate or Non-refundable</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">In addition to Moderate, offer a non-refundable option—guests pay 10% less, but you keep your payout no matter when they cancel.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="moderate_non_refund" value="moderate_non_refund" {{ !empty($cancellation_policy->type_cancellation) == "moderate_non_refund" ? "checked" : "" }} />
                                        <label for="moderate_non_refund"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="height" id="height_2" value="4" required />
                                        <label for="height_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Firm</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">Full refund for cancellations up to 30 days before check-in. If booked fewer than 30 days before check-in, full refund for cancellations made within 48 hours of booking and at least 14 days before check-in. After that, 50% refund up to 7 days before check-in. No refund after that.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="firm" value="firm" {{ !empty($cancellation_policy->type_cancellation) == "firm" ? "checked" : "" }} />                                  <label for="firm"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="animal" id="animal_2" value="5" required />
                                        <label for="animal_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Firm or Non-refundable</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">In addition to Firm, offer a non-refundable option—guests pay 10% less, but you keep your payout no matter when they cancel.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="firm_non_refund" value="firm_non_refund" {{ !empty($cancellation_policy->type_cancellation) == "firm_non_refund" ? "checked" : "" }}/>
                                        <label for="firm_non_refund"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="animal" id="animal_2" value="5" required />
                                        <label for="animal_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Strict</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">Full refund for cancellations made within 48 hours of booking, if the check-in date is at least 14 days away. 50% refund for cancellations made at least 7 days before check-in. No refunds for cancellations made within 7 days of check-in.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="strict" value="strict" {{ !empty($cancellation_policy->type_cancellation) == "strict" ? "checked" : "" }}/>
                                        <label for="strict"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="animal" id="animal_2" value="5" required />
                                        <label for="animal_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Strict or Non-refundable</span></p>
                                    <p class="font-12" style="margin-top: -25px;"><span class="translate-text-group-items">In addition to Strict, offer a non-refundable option—guests pay 10% less, but you keep your payout no matter when they cancel.</span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="type_cancellation" id="strict_non_refund" value="strict_non_refund" {{ !empty($cancellation_policy->type_cancellation) == "strict_non_refund" ? "checked" : ")" }}/>
                                        <label for="strict_non_refund"><i class="fa fa-check"></i></label>
                                        {{-- <input type="radio" name="animal" id="animal_2" value="5" required />
                                        <label for="animal_2"><i class="fa fa-check"></i></label> --}}
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                        </div>
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-end" style="padding-bottom: 80px;">
                <button type="submit"
                    style="margin-top: 15px; width:150px; border-radius: 9px; padding : 8px; margin-right: 20px;box-sizing: border-box; background-color: #FF7400; border: none; margin-right: 20px"
                    class="btn btn-primary btn-lg btn-block">
                    {{ __('user_page.Save') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
