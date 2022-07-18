<!-- Fade In Default Modal -->
<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .modal-header3 {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
        padding-left: 2.8rem !important;
        padding-bottom: 2rem !important;
    }
    .modal-header3 h3 {
        margin: 0;
        padding: 20px 0px;
    }

    .modal-body3 {
        padding: 0rem 2rem 2rem 2rem !important;
        height: 490px !important;
        overflow-y: auto !important;
    }

    .modal-content3 {
        width: 60% !important;
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

<div id="modal-edit-guest-safety" class="modal fade bs-example-modal-lg" style="font-family: 'Poppins' !important">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content3" style="border-radius:15px; background: #fff;">
            <div class="modal-header modal-header3 filter-modal d-flex justify-content-between">
                <h3>{{ __('user_page.Health & Safety') }}</h3>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body modal-body3">
                <div class="tabbable column-wrapper translate-text-group">
                    <form method="POST" action="javascript:void(0);" id="guestSafetyForm">
                        @csrf
                        <input type="hidden" id="villa" name="id_villa" value="{{ $villa[0]->id_villa }}">

                        <div class="container">
                            <h5>{{ __('user_page.Safety Considerations') }}</h5>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Pool/hot tub without a gate or lock</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests will have direct access to an ungated / unlocked in-ground or
                                            above-ground
                                            swimming pool or hot tub.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="pool" id="pool_1" value="no" />
                                        <label for="pool_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="pool" id="pool_2" value="1" />
                                        <label for="pool_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Nearby lake, river, other body of water</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests will have direct, unrestricted access to any permanent natural or
                                            artificial
                                            body
                                            of water located directly on or next to the property. Ex: ocean/beach, pond,
                                            creek,
                                            wetlands.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="lake" id="lake_1" value="no" />
                                        <label for="lake_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="lake" id="lake_2" value="2" />
                                        <label for="lake_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Climbing or play structure</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests (including children) will have access to structures or items intended for
                                            climbing or playing on. Ex: swing, slide, playset, climbing ropes.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="climb" id="climb_1" value="no" />
                                        <label for="climb_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="climb" id="climb_2" value="3" />
                                        <label for="climb_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Heights without rails or protection</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests will have access to an area or structure that reaches a height of more
                                            than
                                            1.4
                                            meters/4.6 feet and does not have a rail or other protection. Ex: balcony, roof,
                                            terrace.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="height" id="height_1" value="no" />
                                        <label for="height_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="height" id="height_2" value="4" />
                                        <label for="height_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Potentially dangerous animal</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests (and their pets) will be around or near wild or domesticated animals that
                                            could
                                            cause harm because of their behavior or size. Ex: horse, mountain lion, dog that
                                            growls
                                            or bites.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="animal" id="animal_1" value="no" />
                                        <label for="animal_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="animal" id="animal_2" value="5" />
                                        <label for="animal_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                        </div>

                        <div class="container">
                            <h5 style="margin-top: 40px;">Safety Devices</h5>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Security cameras/audio recording devices</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            The property has a security camera or recording device capable of recording or
                                            sending video, audio, or still images. EZV requires hosts to inform guests of
                                            any
                                            such camera or device located in a common area—even if it will be turned off
                                            during
                                            a guest’s stay. EZV prohibits security cameras or recording devices in
                                            private
                                            spaces like bedrooms, bathrooms, or sleeping areas.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="camera" id="camera_1" value="no" />
                                        <label for="camera_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="camera" id="camera_2" value="6" />
                                        <label for="camera_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Carbon monoxide alarm</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            The property has an alarm that detects and warns about the presence of carbon
                                            monoxide gas. Check your local laws for specific requirements.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="monoxide" id="monoxide_1" value="no" />
                                        <label for="monoxide_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="monoxide" id="monoxide_2" value="7" />
                                        <label for="monoxide_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Smoke alarm</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            The property has an alarm that detects and warns about the presence of smoke and
                                            fire. Check your local laws for specific requirements.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="alarm" id="alarm_1" value="no" />
                                        <label for="alarm_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="alarm" id="alarm_2" value="8" />
                                        <label for="alarm_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                        </div>

                        <div class="container">
                            <h5 style="margin-top: 40px;">Property Info</h5>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Must climb stairs</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests can expect to walk up and down stairs during their stay.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="must" id="must_1" value="no" />
                                        <label for="must_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="must" id="must_2" value="9" />
                                        <label for="must_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Potential for noise</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests can expect to hear some noise during their stay. Ex: traffic,
                                            construction,
                                            nearby businesses.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="potential" id="potential_1" value="no" />
                                        <label for="potential_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="potential" id="potential_2" value="10" />
                                        <label for="potential_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Pet(s) live on property</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests may come across pets and experience a little animal love during their
                                            stay.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="come" id="come_1" value="no" />
                                        <label for="come_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="come" id="come_2" value="11" />
                                        <label for="come_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">No parking on property</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            This property does not have dedicated parking for guests.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="parking" id="parking_1" value="no" />
                                        <label for="parking_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="parking" id="parking_2" value="12" />
                                        <label for="parking_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Some spaces are shared</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests can expect to share spaces with other people during their stay. Ex:
                                            kitchen,
                                            bathroom, patio.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="shared" id="shared_1" value="no" />
                                        <label for="shared_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="shared" id="shared_2" value="13" />
                                        <label for="shared_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Amenity limitations</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests shouldn’t expect some essentials they may be used to having when
                                            traveling.
                                            Ex: wifi, running water, indoor shower.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="amenity" id="amenity_1" value="no" />
                                        <label for="amenity_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="amenity" id="amenity_2" value="14" />
                                        <label for="amenity_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">
                            <div class="row">
                                <div class="col-8">
                                    <p><span class="translate-text-group-items">Weapons on property</span></p>
                                    <p class="font-12" style="margin-top: -25px;">
                                        <span class="translate-text-group-items">
                                            Guests should be aware that there is at least one weapon stored on this
                                            property.
                                            EZV requires all weapons to be properly stored and secured.
                                        </span>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <input type="radio" name="weapon" id="weapon_1" value="no" />
                                        <label for="weapon_1"><i class="fa fa-times"></i></label>
                                        <input type="radio" name="weapon" id="weapon_2" value="15" />
                                        <label for="weapon_2"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: -10px;">

                        </div>
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-between" style="padding-bottom: 80px;">
                <p style="color: red; font-size: 12px; margin-left: 20px; margin-top: 20px;"><sup>*</sup>Please make
                    sure
                    you select all the list</p>
                <button type="submit" form="guestSafetyForm" id="btnSaveGuestSafety"
                    style="width:150px; border-radius: 9px; padding : 8px; margin-right: 20px;box-sizing: border-box; background-color: #FF7400; border: none; margin-right: 20px"
                    class="btn btn-primary btn-lg btn-block">
                    Save
                </button>
                </form>

            </div>
        </div>
    </div>
</div>
