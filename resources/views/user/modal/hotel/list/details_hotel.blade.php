<!-- Fade In Default Modal -->

<style>
    .liner {
        display: inline-block;
        height: 3px;
        width: 50%;
        background: #000;
        margin-right: 5px;
        vertical-align: middle;
    }

    .column.left {
        width: 25%;
        float: left;
    }

    .d-none {
        display: none;
    }

    .modal-header-login {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
        display: flex;
    }

    .modal-body-login {
        padding: 1rem;
        height: 500px !important;
        display: flex;
        align-items: center;
    }

    .modal-content-login {
        background-color: white;
        width: 55% !important;
        box-shadow: 1px 1px 15px rgb(0 0 0 / 16%);
    }

    .modal-login {
        z-index: 1300;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .modal-login-title {
        font-family: "Poppins" !important;
        color: #3A3845;
        font-size: 32px;
        margin-bottom: 1rem;
        font-weight: 600;
        margin-top: 1rem;
    }

    .filter-language-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: grey;
        cursor: pointer;
    }

    .filter-language-option-text:active {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-text:hover {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-container {
        padding-bottom: 10px;
    }

    .filter-language-option-text:focus {
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

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }

    /* Start of filter modal*/
    .btn-close-modal {
        background: none !important;
        border: none;
    }

    .filter-modal {
        justify-content: flex-end;
    }

    .modal-filter-footer-language {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        border-top: none;
        height: 20px;
    }

    .login-container {
        width: 70%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    .register-container {
        width: 80%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    /* End of filter modal*/

    .form-control {
        font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    ::placeholder {
        font-size: 1rem !important;
    }

    .text-small {
        font-size: 12px;
        margin-bottom: -10px;
    }

    .text-small a {
        font-size: 12px;
        color: #ff7400;
        cursor: pointer;
    }

    .right {
        text-align: right;
    }

    .modal-header {
        padding: 1rem 3rem;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .modal-login-title p {
        font-size: 14px;
        margin-bottom: 10px;
        margin-top: -10px;
        font-weight: 400;
    }

    .nav-tabs li {
        margin-right: 10px;
    }

    .login-register-label {
        margin: 0px;
        font-weight: 500;
    }

    .switcher-text2 {
        margin: 0px !important;
        width: unset !important;
    }

    .login-button {
        margin-right: 15px;
        background-color: #ff7400;
        color: white;
        padding: 10px 30px;
        border-radius: 5px
    }

    @media only screen and (max-width: 480px) {
        .modal-content-login {
            width: 95% !important;
        }

        .login-button {
            padding: 5px 12px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }

    @media only screen and (min-width: 481px) and (max-width: 768px) {
        .modal-content-login {
            width: 85% !important;
        }

        .login-button {
            padding: 7px 14px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }

    @media only screen and (min-width: 769px) and (max-width: 991px) {
        .modal-content-login {
            width: 95% !important;
        }

        .login-button {
            padding: 9px 14px;
        }

        .modal-body-login {
            height: auto !important;
        }
    }

    @media only screen and (min-width: 992px) {
        .modal-body-login {
            height: 100% !important;
        }
    }

    .nav-tabs>li {
        width: auto !important;
    }

    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

    /* Loading Animation */
    .container-loading-animation {
        position: absolute;
        top: 50%;
        left: 50%;
        right: auto;
        bottom: auto;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid #ddd;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #ddd transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div id="modal-details" class="modal modal-login fade bs-example-modal-lg">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-horizontal-centered"
        style="overflow-y: initial !important;">
        <div class="modal-content modal-content-login" style="border-radius:15px;">
            <div class="modal-header">
                <div class="col-lg-10">
                    <ul class="nav filter-language-option-container nav-tabs sideTab column"
                        style="display: flex; flex-wrap: nowrap; padding: 0px;">
                        <li id="trigger-tab-description" onclick="switchTabHotel('description')" class="active"><a
                                class="filter-language-option-text">Description</a></li>
                        <li id="trigger-tab-facilities" onclick="switchTabHotel('facilities')"><a
                                class="tab1 filter-language-option-text">Facilities</a></li>
                        <li id="trigger-tab-reviews" onclick="switchTabHotel('reviews')"><a
                                class="tab2 filter-language-option-text">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 right">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="modal-body modal-body-login">
                <div class="tabbable column-wrapper col-12">
                    <div class="tab-content tab-content-language column rigth" id="tabs">
                        <div class="tab-pane active" id="content-tab-description">
                            <h3 class="name-hotel"></h3>
                            <p id="descHotel"></p>
                        </div>
                        <div class="tab-pane" id="content-tab-facilities">
                            <h3 class="name-hotel"></h3>
                            <div id="amenitiesList">
                                <div class="col-md-6 mb-2">
                                    <span class='translate-text-group-items'>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="content-tab-reviews">
                            <div class="row">
                                <div class="col-10">
                                    <h3 class="name-hotel"></h3>
                                </div>
                                <div class="col-2">
                                    <h3 id="average_show"></h3>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-3">
                                    Cleanliness
                                </div>
                                <div class="col-9" id="average_clean_show">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-3">
                                    Service
                                </div>
                                <div class="col-9" id="average_service_show">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-3">
                                    Check In
                                </div>
                                <div class="col-9" id="average_check_in_show">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-3">
                                    Location
                                </div>
                                <div class="col-9" id="average_location_show">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-3">
                                    Value
                                </div>
                                <div class="col-9" id="average_value_show">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer-language">
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function switchTabHotel(indicator) {
        if (indicator == 'facilities') {
            $('#trigger-tab-description').removeClass('active');
            $('#content-tab-description').removeClass('active');
            $('#trigger-tab-facilities').addClass('active');
            $('#content-tab-facilities').addClass('active');
            $('#trigger-tab-reviews').removeClass('active');
            $('#content-tab-reviews').removeClass('active');
        }
        if (indicator == 'description') {
            $('#trigger-tab-description').addClass('active');
            $('#content-tab-description').addClass('active');
            $('#trigger-tab-facilities').removeClass('active');
            $('#content-tab-facilities').removeClass('active');
            $('#trigger-tab-reviews').removeClass('active');
            $('#content-tab-reviews').removeClass('active');
        }
        if (indicator == 'reviews') {
            $('#trigger-tab-description').removeClass('active');
            $('#content-tab-description').removeClass('active');
            $('#trigger-tab-facilities').removeClass('active');
            $('#content-tab-facilities').removeClass('active');
            $('#trigger-tab-reviews').addClass('active');
            $('#content-tab-reviews').addClass('active');
        }
    }
</script>
