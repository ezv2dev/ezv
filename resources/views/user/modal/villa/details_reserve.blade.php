{{-- MODAL DETAIL RESERVE --}}
@php
    use Illuminate\Support\Facades\Crypt;
@endphp
<div class="modal fade" id="modal-details-reserve" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true" style="overflow-y:scroll;">
    <div class="modal-dialog modal-md" role="document" style="overflow-y: initial !important">
        <div class="modal-content "
            style="background: white; border-radius:20px; height:100%; margin-top:0 !important;">
            <div class="modal-header modal-header-amenities" style="padding-left: 1.3rem !important;">
                <h5 class="modal-title">{{ Translate::translate('Booking Summary') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="overflow-y: auto; overflow-x: hidden;">
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



                        <div class="content calendar-modal" id="popup_check2">
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
                                            <p><input type="number" id="adult4" name="adult" value="1"
                                                    min="1"
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
                                            <p><input type="number" id="child4" name="child" value="0"
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
                                            <p><input type="number" id="infant4" name="infant" value="0"
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
                                            <p><input type="number" id="pet4" name="pet" value="0"
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
                    <div class="col-9">
                        <p class="price-box">
                            <span style="font-size:14px;">{{ Translate::translate('Cancellation policy') }}</span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="detail-box">
                            <span style="text-align: justify; font-size:12px;">100% refund of amount paid if you cancel
                                by Oct 4, 2022.50% refund of amount paid (minus the service fee) if you cancel by Nov 3,
                                2022.No refund if you cancel after Nov 3, 2022.</span>
                        </p>
                    </div>
                </div>


                    <div class="row" style="padding-left:15px">
                        <div class="col-12">
                            <div class="row" style="font-size: 13px;">
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">Virtual Account</span>
                                    <input type="radio" value="va" id="va" name="payment"
                                        onclick="paymentCheck()" autocomplete="off">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                        <div id="panel_va" style="display: none; padding:0 0 10px 20px">
                            <form method="POST" id="va-form" action="{{ route('api.createVa') }}">
                            @csrf
                            @auth
                                <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                            @endauth
                            @guest
                                <input type="text" name="firstname_va" id="firstname_va" value="" placeholder="firstname">
                                <input type="text" name="lastname_va" id="lastname_va" value="" placeholder="lastname">
                                <input type="email" name="email" id="email" value="" placeholder="email">
                            @endguest
                                <input type="hidden" name="price_total" id="price_total" value="{{ Crypt::encryptString($villa[0]->id_villa) }}">
                                <input type="hidden" name="check_in_date" id="check_in_date" value="">
                                <input type="hidden" name="check_out_date" id="check_out_date" value="">
                                <input type="hidden" name="adult_va" id="adult_va" value="">
                                <input type="hidden" name="child_va" id="child_va" value="">

                                <div class="row" style="font-size: 13px;">
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/bca-logo.svg') }}">
                                            <input type="radio" value="BCA" id="bca" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/bni-logo.svg') }}">
                                            <input type="radio" value="BNI" id="bni" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/bri-logo.svg') }}">
                                            <input type="radio" value="BRI" id="bri" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/mandiri-logo.svg') }}">
                                            <input type="radio" value="MANDIRI" id="mandiri" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/permata-logo.svg') }}">
                                            <input type="radio" value="PERMATA" id="permata" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="container-checkbox2">
                                            <img src="{{ URL::asset('assets/payment_logo/bsi-logo.png') }}"
                                                style="width: 50%">
                                            <input type="radio" value="BSI" id="bsi" name="bank_option"
                                                autocomplete="off">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 text-center"><input class="price-button" type="submit"
                                    value="{{ Translate::translate('RESERVE NOW') }}">
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="row" style="font-size: 13px;">
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">Credit Card</span>
                                    <input type="radio" value="credit" id="credit" name="payment"
                                        onclick="paymentCheck()" autocomplete="off">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                        <div id="panel_credit" style="display: none; padding:0 0 10px 20px">
                            <form method="POST" id="payment-form" action="javascript:void(0);">
                                @csrf
                                @auth
                                    <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                    @endauth
                                <input type="hidden" name="price_total2" id="price_total2" value="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="card-number">CARD NUMBER</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="card-number"
                                                    placeholder="Card number" value="" /> <br />
                                                {{-- <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="card-exp-month">Expiration</label>

                                                <input class="form-control" type="text" id="card-exp-month"
                                                placeholder="mm//yy" value="" />
                                                {{-- <div class="col-md-6">
                                                    <input class="form-control" type="text" id="card-exp-year"
                                                    placeholder="Card expiration year (yyyy)" value="" />
                                                </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-md-4 pull-right hide-if-multi">
                                        <div class="form-group">
                                            <label for="card-cvn">CVN CODE</label>
                                            <input class="form-control" type="text" id="card-cvn" placeholder="Cvn"
                                                value="" /> <br />
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control" type="hidden" id="currency"
                                    placeholder="IDR" value="IDR" /> <br />

                                <div class="col-12 text-center"><input class="price-button" type="submit"
                                    value="{{ Translate::translate('RESERVE NOW') }}">
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <div class="col-12 text-center"><input class="price-button" type="submit"
                            value="{{ Translate::translate('RESERVE NOW') }}">
                    </div>
                </form> --}}

                <div id="success" style="display:none;">
                    <p>Success! Use the token id below to charge the credit card.</p>
                    <div class="request">
                        <span>REQUEST DATA</span>
                        <pre class="request-data"></pre>
                    </div>
                    <span>RESPONSE</span>
                    <pre class="result"></pre>
                </div>

                <div id="error" style="display:none;">
                    <p>Whoops! There was an error while processing your request.</p>
                    <div class="request">
                        <span>REQUEST DATA</span>
                        <pre class="request-data"></pre>
                    </div>
                    <span>RESPONSE</span>
                    <pre class="result"></pre>
                </div>


                {{-- <div class="overlay" style="display: none;"></div>
                <div id="three-ds-container" style="display: none;">
                    <iframe height="450" width="550" id="sample-inline-frame" name="sample-inline-frame"> </iframe>
                </div> --}}

                <div class="col-12 p-5-price price-box text-center">This is the last step before reserve. Please check
                    your booking summary again.</div>
                {{-- <div class="row">
                    <div class="col-7 price-box">Sub Total<input id="sum_night3" value=""
                            style="width: 25px; text-align:right; border:0"> nights</div>
                    <div class="col-5 price-box"><span id="total3" style="font-size:100%">0</span></div>
                    <div class="col-7 price-box">Tax & Service</div>
                    <div class="col-5 price-box"><span id="tax3" style="font-size:100%">0</span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-7 price-box"><strong>Total </strong></div>
                    <div class="col-5 price-box"><strong><span id="total_all3"
                                style="font-size:100%">0</span></strong></div>
                </div> --}}
            </div>
            <div class="modal-filter-footer" style="height: 20px;"></div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var $form = $('#payment-form');

        $form.submit(function(event) {
            hideResults();

            Xendit.setPublishableKey(
                'xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F'
                );

            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Xendit:
            var tokenData = getTokenData();

            Xendit.card.createToken(tokenData, xenditResponseHandler);

            // Prevent the form from being submitted:
            return false;
        });

        function xenditResponseHandler(err, creditCardToken) {
            $form.find('.submit').prop('disabled', false);

            if (err) {
                return displayError(err);
            }

            if (creditCardToken.status === 'APPROVED' || creditCardToken.status === 'VERIFIED') {
                displaySuccess(creditCardToken);
            } else if (creditCardToken.status === 'IN_REVIEW') {
                window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');
                $('.overlay').show();
                $('#three-ds-container').show();
                // $('#modal-3ds').modal('show');
            } else if (creditCardToken.status === 'FRAUD') {
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FAILED') {
                displayError(creditCardToken);
            }
        }

        function displayError(err) {
            $('#three-ds-container').hide();
            $('.overlay').hide();
            $('#error .result').text(JSON.stringify(err, null, 4));
            $('#error').show();

            var requestData = {};
            $.extend(requestData, getTokenData());
            $('#error .request-data').text(JSON.stringify(requestData, null, 4));

        };

        function displaySuccess(creditCardToken) {
            $('#three-ds-container').hide();
            $('.overlay').hide();

            // $('#success .result').text(JSON.stringify(creditCardToken, null, 4));
            // $('#success').show();

            var requestData = {};
            $.extend(requestData, getTokenData());
            // $('#success .request-data').text(JSON.stringify(requestData, null, 4));

            @auth
            var saveData = $.ajax({
                type: 'POST',
                url: "/api/xendit/credit_card/charge",
                data: {
                    dataresult: creditCardToken,
                    datarequest: requestData,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "text",
                success: function(resultData) {
                    alert("success ")
                }
            });
            @endauth
        saveData.error(function() {
            alert("Something went wrong");
        });

    }

    function getTokenData() {
        let exp = $form.find('#card-exp-month').val();
        const split = exp.split("/");
        return {
            amount: $form.find('#price_total2').val(),
            card_number: $form.find('#card-number').val(),
            card_exp_month: split[0],
            card_exp_year: 20 + split[1],
            card_cvn: $form.find('#card-cvn').val(),
            currency: $form.find('#currency').val(),
            // on_behalf_of: $form.find('#on-behalf-of').val(),
            // billing_details: $form.find('#should-send-billing-details').prop('checked') ? getBillingDetails() : undefined,
            // customer: $form.find('#should-send-customer-details').prop('checked') ? getCustomerDetails() : undefined,
        };
    }

    function hideResults() {
        $('#success').hide();
        $('#error').hide();
    }
    });
</script>

<script>
    function paymentCheck() {
        if (document.getElementById('va').checked) {
            document.getElementById('panel_va').style.display = 'block';
            document.getElementById('panel_credit').style.display = 'none';
        } else if (document.getElementById('credit').checked) {
            document.getElementById('panel_va').style.display = 'none';
            document.getElementById('panel_credit').style.display = 'block';
        }

    }
</script>
