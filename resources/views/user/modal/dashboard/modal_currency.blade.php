<!-- Fade In Default Modal -->

<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .modal-header3 {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
    }

    .modal-body3 {
        padding: 0rem 2rem 2rem 2rem !important;
        height: 490px !important;
        overflow-y: auto !important;
    }

    .modal-content3 {
        width: 90% !important;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .modal-body-title {
        font-family: "Poppins" !important;
        color: black;
        font-size: 20px;
        margin-bottom: 2rem;
        font-weight: 500;
        margin-top: 2rem;
    }

    .filter-language-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: grey;
    }

    .filter-language-option-container {
        padding-bottom: 10px;
    }

    .filter-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 6px 0px 0px 0px;
        font-size: 13px !important;
        color: black;
    }

    .filter-option-text-currency {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 0px 0px 0px 0px;
        font-size: 13px !important;
        color: black;
    }

    .filter-option-currency {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 6px 0px 0px 0px;
        font-size: 13px !important;
        color: grey;
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
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(1, auto);
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

</style>

<div id="ModalCurrency" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered modal-horizontal-centered" style="overflow-y: initial !important;">
        <div class="modal-content">
            <div class="modal-header modal-header2 filter-modal">
            <h3 class="modal-body-title m-0">Choose a currency</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body modal-body-language">
                <div class="tabbable column-wrapper">
                    <!-- Only required for left/right tabs -->

                    <div class="tab-content column rigth" id="tabs">
                        <div class="tab-pane active" id="currency">
                            @php
                            $currency = App\Models\Currency::where('symbol', '!=', '')->get();
                            @endphp

                            <form action="{{ route('change-currency') }}" method="POST" id="form">
                                @csrf
                                <div class="filter-modal-row">
                                    <div class="propertytype-input-row">
                                        <div class="col-12 propertytype-grid-container">
                                            @foreach ($currency as $item)
                                                <div class="">
                                                    <div class="roomnumberoption-container" style="display: flex;">
                                                        <div class="roomnumber-filter-container">
                                                            @php
                                                            $checked = [];
                                                            if(isset($_GET['currencyPartner'])){
                                                            $checked = $_GET['currencyPartner'];
                                                            }
                                                            @endphp

                                                            <input type="radio" value="{{ $item->id_currency }}" id="{{ $item->code }}"
                                                                onchange="$('#form').submit();" name="currencyPartner[]"
                                                                @if(in_array($item->id_currency,
                                                                $checked)) checked
                                                                @endif
                                                            />
                                                            <label class="roomnumberoption-checkbox-alias"
                                                                for="{{ $item->code }}">
                                                                <div>
                                                                    <p class="filter-option-text-currency">{{ $item->name }}
                                                                    </p>
                                                                    <p class="filter-option-currency">{{ $item->code }} -
                                                                        {{ $item->symbol }}</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer">

            </div>
        </div>
    </div>
</div>
