{{-- MODAL DETAIL RESERVE --}}
@php
use Illuminate\Support\Facades\Crypt;
@endphp
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

    @media (min-width: 768px) {
        .hide-if-multi {
            width: 41.6% !important;
        }
    }
</style>
<div class="modal fade" id="modal-quick-enquiry" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content " style="background: white; border-radius:20px; height:100%; margin-top:0 !important;">
            <div class="modal-header modal-header-amenities"
                style="padding-left: 1.3rem !important;">
                <div class="d-flex flex-column">
                    <h5 class="modal-title">{{ Translate::translate('Quick Enquiry') }}</h5>
                    <p class="mb-0">We will get back to you ASAP!</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="margin-top: -2rem;"></button>
            </div>
            {{-- <form action="{{ route('villa_quick_enquiry') }}" method="POST" id="VillaQuickEnquiry"> --}}
            <form action="javascript:void(0);" method="POST" id="VillaQuickEnquiry" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="email_receiver" value="{{ $villa[0]->userCreate->email }}">
                <input type="hidden" name="villa_name" value="{{ $villa[0]->name }}">
                <div id="totalprice" class="modal-body p-4"
                    style="overflow-y: scroll; height: 500px; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-9">
                            <p class="price-box">
                                <span>{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</span>/{{ Translate::translate('night') }}
                            </p>
                        </div>
                    </div>
                    <div class="reserve-inner-block">
                        <div class="col-12"
                            style="display: flex; border: 2px solid #FF7400; border-radius: 15px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 1px 10px #a4a4a4">

                            <div class="col-6 p-5-price line-right-orange">
                                <div class="col-12" style="text-align: center;">
                                    <button type="button" class="collapsible_check2" style="background-color: white;">
                                        <p style="margin-left: 0px; margin-bottom:0px; font-size: 12px;">
                                            {{ Translate::translate('CHECK-IN') }}
                                        </p>
                                        <input class=""
                                            style="font-size: 15px; margin-left: 0px; width:100%; text-align: center; border: none !important; border-color: transparent !important;"
                                            type="text" id="check_in3" name="check_in" style="width:80%; border:0"
                                            placeholder="{{ Translate::translate('Add Date') }}" readonly>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6 p-5-price">
                                <div class="col-12" style="text-align: center;">
                                    <button type="button" class="collapsible_check2" style="background-color: white;">
                                        <p style="margin-left: 0px; margin-bottom: 0px; font-size: 12px;">
                                            {{ Translate::translate('CHECK-OUT') }}
                                        </p>
                                        <input class=""
                                            style="font-size: 15px; margin-left: 0px; width: 100px; text-align: center; border: none !important; border-color: transparent !important;"
                                            type="text" id="check_out3" name="check_out" style="width:80%; border:0"
                                            placeholder="{{ Translate::translate('Add Date') }}" readonly>
                                    </button>
                                </div>
                            </div>



                            <div class="content calendar-modal" id="popup_check2" style="min-height: 400px; max-height: 400px;">
                                <div class="desk-e-call">
                                    <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                        <div style="display: table;">
                                            <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                                class="col-lg-12">
                                                <a type="button" id="clear_date2"
                                                    style="margin: 0px; font-size: 13px;">{{ Translate::translate('Clear Dates') }}</a>
                                            </div>
                                            <div class="flatpickr" id="inline_reserve2" style="text-align: left;">
                                                {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 p-9-price line-top"
                            style="border: 2px solid #FF7400; margin-top: 19px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4">
                            <button type="button" class="collapsible2">{{ Translate::translate('Number of Guest') }}
                                <p class="guest-right">
                                    {{ Translate::translate('guest') }}</p>
                                <input class="guest-right-input" type="number" id="total_guest4" value="1"
                                    min="0" readonly>
                            </button>
                            <div class="content sidebar-popup2" style="left: 633px;" id="popup_guest2">
                                <div class="row" style="margin-top: 10px;">

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">
                                                    {{ Translate::translate('Adults') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ Translate::translate('Age') }} 13+</p>
                                            </div>
                                        </div>

                                        <div class="col-6"
                                            style="display: flex; align-items: center; justify-content: end;">
                                            <a type="button" onclick="adult_decrement()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-minus" style="padding:30%"></i>
                                            </a>
                                            <div
                                                style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                <p><input type="number" id="adult4" name="adult"
                                                        value="1" min="1"
                                                        style="text-align: center; border:none; width:30px;"
                                                        min="0" readonly></p>
                                            </div>
                                            <a type="button" onclick="adult_increment()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-plus" style="padding:30%"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">
                                                    {{ Translate::translate('Children') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ Translate::translate('Ages') }} 2-12</p>
                                            </div>
                                        </div>

                                        <div class="col-6"
                                            style="display: flex; align-items: center; justify-content: end;">
                                            <a type="button" onclick="child_decrement()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-minus" style="padding:30%"></i>
                                            </a>
                                            <div
                                                style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                <p><input type="number" id="child4" name="child"
                                                        value="0"
                                                        style="text-align: center; border:none; width:30px;"
                                                        min="0" readonly></p>
                                            </div>
                                            <a type="button" onclick="child_increment()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-plus" style="padding:30%"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">
                                                    {{ Translate::translate('Infant') }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p class="price-box" style="color: grey">
                                                    {{ Translate::translate('Under') }} 2</p>
                                            </div>
                                        </div>

                                        <div class="col-6"
                                            style="display: flex; align-items: center; justify-content: end;">
                                            <a type="button" onclick="infant_decrement()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-minus" style="padding:30%"></i>
                                            </a>
                                            <div
                                                style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                <p><input type="number" id="infant4" name="infant"
                                                        value="0"
                                                        style="text-align: center; border:none; width:30px;"
                                                        min="0" readonly></p>
                                            </div>
                                            <a type="button" onclick="infant_increment()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-plus" style="padding:30%"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="reserve-input-row">
                                        <div class="col-6">
                                            <div class="col-12">
                                                <p class="price-box">
                                                    {{ Translate::translate('Pets') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-6"
                                            style="display: flex; align-items: center; justify-content: end;">
                                            <a type="button" onclick="pet_decrement()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-minus" style="padding:30%"></i>
                                            </a>
                                            <div
                                                style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                <p><input type="number" id="pet4" name="pet"
                                                        value="0"
                                                        style="text-align: center; border:none; width:30px;"
                                                        min="0" readonly></p>
                                            </div>
                                            <a type="button" onclick="pet_increment()"
                                                style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                                <i class="fa-solid fa-plus" style="padding:30%"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12"
                            style="display: flex; flex-direction: column; border: 2px solid #ff7400; border-radius:15px; padding: 9px; box-sizing: border-box; box-shadow: 1px 1px 10px #a4a4a4; margin-top: 20px; display:none"
                            id="counting_part">
                            <div class="col-12" style="display: flex;">
                                <div class="col-6" style="border-right: 2px solid #ff7400;">
                                    <p style="font-size: 12px; margin:0px;">
                                        {{ Translate::translate('Total Nights') }}</p>
                                </div>
                                <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                    <input id="sum_night3" value="0"
                                        style="font-size: 12px; text-align:left; width: 20px; border:0"><span
                                        style="font-size: 12px;">nights</span>
                                </div>
                            </div>

                            <div class="col-12" style="display: flex;">
                                <div class="col-6" style="border-right: 2px solid #ff7400;">
                                    <p style="font-size: 12px; margin:0px;">
                                        {{ Translate::translate('Sub Total') }}</p>
                                </div>

                                <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                    <p id="total" style="font-size:12px; margin:0px;">0</p>
                                </div>
                            </div>

                            <div class="col-12" style="display: flex;" id="discount_div">
                                <div class="col-6" style="border-right: 2px solid #ff7400;">
                                    <p style="font-size: 12px; margin:0px;">
                                        {{ Translate::translate('Discount') }}</p>
                                </div>

                                <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                    <p id="discount" style="font-size:12px; margin:0px; color:green">0</p>
                                </div>
                            </div>

                            <div class="col-12" style="display: flex;" id="cleaning_div">
                                <div class="col-6" style="border-right: 2px solid #ff7400;">
                                    <p style="font-size: 12px; margin:0px;">
                                        {{ Translate::translate('Cleaning fee') }}</p>
                                </div>

                                <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                    <p id="cleaning_fee" style="font-size:12px; margin:0px;">0</p>
                                </div>
                            </div>

                            <div class="col-12" style="display: flex;">
                                <div class="col-6">
                                    <p style="font-size: 12px; margin:0px; border-right: 2px solid #ff7400;">
                                        {{ Translate::translate('Service') }}</p>
                                </div>

                                <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                    <p style="font-size: 12px; margin:0px" id="tax"></p>
                                </div>
                            </div>

                            <div class="col-12"
                                style="display: flex; margin-top: 10px; border-top: 2px solid #ff7400; padding-top: 10px;">
                                <div class="col-6">
                                    <p style="margin: 0px; font-size: 12px;">
                                        <b>{{ Translate::translate('Total before taxes') }}</b>
                                    </p>
                                </div>

                                <div class="col-12">
                                    <span style="font-size: 12px;"></span>
                                    <b><span id="total_all"
                                            style="font-size:100%; font-size: 12px; margin: 0px;">0</span></b>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name"
                                    value="{{ Auth::user()->first_name }}" placeholder="First Name"
                                    name="first_name">
                                <small id="err-fname" style="display: none;" class="invalid-feedback">{{ __('auth.empty_fname') }}</small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name"
                                    value="{{ Auth::user()->last_name }}" placeholder="Last Name"
                                    name="last_name">
                                <small id="err-lname" style="display: none;" class="invalid-feedback">{{ __('auth.empty_lname') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ Auth::user()->email }}" placeholder="name@example.com" name="email"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="number" class="form-control" id="phone"
                                value="{{ Auth::user()->phone }}" placeholder="Phone Number" name="phone">
                            <small id="err-phone" style="display: none;" class="invalid-feedback">{{ __('auth.empty_phone') }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="additional_information">Additional Information/Requirements</label>
                            <textarea class="form-control" id="additional_information" name="additional_information" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2"><input class="price-button" id="enq-button" type="submit"
                            value="{{ Translate::translate('QUICK ENQUIRY') }}">
                    </div>
                </div>
            </form>
            <div class="modal-filter-footer" style="height: 20px;"></div>

        </div>
    </div>
</div>

<script>
    $(function() {
        $('#first_name').keyup(function (e) {
            $('#first_name').removeClass('is-invalid');
            $('#err-fname').hide();
        });
        $('#last_name').keyup(function (e) {
            $('#last_name').removeClass('is-invalid');
            $('#err-lname').hide();
        });
        $('#phone').keyup(function (e) {
            $('#phone').removeClass('is-invalid');
            $('#err-phone').hide();
        });
        $('#VillaQuickEnquiry').submit(function(e) {
            let error = 0;
            // let emlrcv = $('#email_receiver').val();
            // let check_out = $('#check_out3').val();
            // let check_in = $('#check_in3').val();
            // let adult = $('#adult4').val();
            // let child = $('#child4').val();
            // let vname = $('#villa_name').val();
            let fname = $('#first_name').val();
            let lname = $('#last_name').val();
            // let email = $('#email').val();
            let phone = $('#phone').val();
            // let adinf = $('#additional_information').val();

            if(!fname) {
                $('#first_name').addClass('is-invalid');
                $('#err-fname').show();
                error = 1;
            }
            if(!lname) {
                $('#last_name').addClass('is-invalid');
                $('#err-lname').show();
                error = 1;
            }
            if(!phone) {
                $('#phone').addClass('is-invalid');
                $('#err-phone').show();
                error = 1;
            }
            if(error == 1) {
                e.preventDefault();
            } else {
                e.preventDefault();
                var formData = new FormData(this);
                var btn = $("#enq-button");
                $(btn).val("Saving...");
                $(btn).attr("disabled", true);

                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Accept: "application/json",
                    },
                    url: "/villa/quick-enquiry",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype: "multipart/form-data",
                    dataType: "json",
                    success: function (response) {
                        iziToast.success({
                            title: "Success",
                            message: response.message,
                            position: "topRight",
                        });
                        $('#modal-quick-enquiry').modal("hide");
                        btn.innerHTML = "<i class='fa fa-check'></i> Save";
                        btn.classList.remove("disabled");
                    },
                    error: function (jqXHR, exception) {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                        $(btn).val('{{ Translate::translate('QUICK ENQUIRY') }}');
                        $(btn).attr("disabled", false);
                    },
                });
            }
        });
    });
    </script>
