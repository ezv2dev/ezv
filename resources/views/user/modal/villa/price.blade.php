<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .modal-header-editprice {
        border-bottom: none !important;
        padding: 2rem 3rem 2rem 2rem;
        background-color: white;
    }

    .modal-body-editprice {
        padding: 0rem 2rem 2rem 2rem !important;
        height: 490px !important;
        overflow-y: auto !important;
    }

    .modal-content-editprice {
        width: 90% !important;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: #ff7400 !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
        color: #ff7400 !important;
    }

    .modal-price-title {
        width: 50% !important;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }

    label {
        font-weight: 500 !important;
    }

    .d-none {
        display: none !important;
    }

    .d-block {
        display: block !important;
    }

    .switch {
        margin: 0px 15px;
        text-align: center;
        box-sizing: border-box;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 37px;
        border-radius: 37px;
        background-color: #f3f4f4;
        cursor: pointer;
        transition: all .3s;
        overflow: hidden;
        box-shadow: 0px 0px 2px rgba(0, 0, 0, .3);
        margin-left: -3px;
        margin-top: 1px;
    }

    .switch input {
        display: none;
    }

    .switch input:checked+div {
        left: calc(80px - 32px);
        box-shadow: 0px 0px 0px white;
    }

    .switch div {
        position: absolute;
        width: 27px;
        height: 27px;
        border-radius: 27px;
        background-color: white;
        top: 5px;
        left: 5px;
        box-shadow: 0px 0px 1px rgb(150, 150, 150);
        transition: all .3s;
    }

    .switch div:before,
    .switch div:after {
        position: absolute;
        content: 'YES';
        width: calc(80px - 40px);
        height: 37px;
        line-height: 37px;
        font-size: 14px;
        font-weight: bold;
        top: -5px;
    }

    .switch div:before {
        content: 'NO';
        color: rgb(120, 120, 120);
        left: 100%;
    }

    .switch div:after {
        content: 'YES';
        right: 100%;
        color: white;
    }

    .switch-checked {
        background-color: #ff7400;
        box-shadow: none;
    }
</style>

<!-- Extra large modal -->
<div class="modal fade modal-availability" id="modal-edit_price" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-editprice" style="border-radius:15px;">
            <div class="modal-header-editprice"
            style="border-bottom: 0.1rem solid #2C3333 !important;">
                <div class="row">
                    <div class="col-11">
                        <ul class="nav filter-language-option-container nav-tabs sideTab column"
                            style="display: flex; flex-wrap: nowrap; padding-bottom: 0px !important;">
                            <li class="active modal-price-title">
                                <a class="tab1 filter-language-option-text" href="#editprice" data-toggle="tab"
                                    style="font-size: 12pt;
                                    font-weight: 600;">
                                    {{ __('user_page.Edit Price') }}
                                </a>
                            </li>
                            <li class="modal-price-title" style="margin-left: 55px;">
                                <a class="filter-language-option-text" href="#availablity" data-toggle="tab"
                                    style="font-size: 12pt;
                                    font-weight: 600; margin-left: -50px;">
                                    {{ __('user_page.Villa Availability') }}
                                </a>
                            </li>
                            <li class="modal-price-title" style="margin-left: 55px;">
                                <a class="filter-language-option-text" href="#extraPrice" data-toggle="tab"
                                    style="font-size: 12pt;
                                    font-weight: 600; margin-left: -50px;">
                                    {{ __('user_page.Extra Price') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body modal-body-editprice">
                <div class="tabbable column-wrapper">
                    <div class="tab-content tab-content-language column rigth" id="tabs">
                        <div class="tab-pane active" id="editprice">
                            <form action="{{ route('villa_update_price') }}" method="POST" id="edit-price"
                                class="js-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_villa" id="id_villa"
                                    value="{{ $villa[0]->id_villa }}">

                                <div class="row mb-12">
                                    <label class="col-sm-4 col-form-label" for="price">
                                        <strong>
                                            {{ __('user_page.Instant Book') }}
                                            <span title="Required" style="font-size: 12pt; color: #EB5353;">
                                                *
                                            </span>
                                        </strong>
                                    </label>
                                    <div class="col-sm-8">
                                        @if ($villa[0]->instant_book == 'no')
                                            <label class="switch">
                                                <input type="checkbox" name="instant_book" />
                                                <div></div>
                                            </label>
                                        @else
                                            <label class="switch switch-checked">
                                                <input type="checkbox" checked name="instant_book" />
                                                <div></div>
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-12 mt-3">
                                    <label class="col-sm-4 col-form-label" for="price">
                                        <strong>
                                            {{ __('user_page.Regular Price') }}
                                            <span title="Required" style="font-size: 12pt; color: #EB5353;">
                                                *
                                            </span>
                                        </strong>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" min="0" class="form-control" id="villa-price"
                                            name="price" placeholder="Price.." value="{{ $villa[0]->price }}">
                                        <small id="err-prc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_price') }}</small>
                                    </div>
                                </div>

                                <div class="row mb-12 mt-3">
                                    <label class="col-sm-4 col-form-label" for="price">
                                        <strong>{{ __('user_page.Commission') }}
                                            <span title="Required" style="font-size: 12pt; color: #EB5353;">*</span>
                                        </strong>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="commission">
                                            {{-- <option value="1" selected>English</option> --}}
                                            <option value="18"
                                                {{ $villa[0]->commission == 18 ? 'selected' : '' }}>
                                                18 %</option>
                                            <option value="15"
                                                {{ $villa[0]->commission == 15 ? 'selected' : '' }}>
                                                15 %</option>
                                            <option value="13"
                                                {{ $villa[0]->commission == 13 ? 'selected' : '' }}>
                                                13 %</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"
                                    style="margin-bottom: 15px; background: #DAE5D0; padding: 10px; margin-left: -32px;margin-right: -32px;margin-top: 15px;">
                                    <div class="col-12">
                                        <span style="color: #383838; margin-left: 8px;">
                                            <strong>
                                                {{ __('user_page.Add Special Price') }}
                                            </strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.Start date') }}</label>
                                        <input type="text" class="form-control" id="start" name="start"
                                            placeholder="{{ __('user_page.Start date') }}.." readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.End date') }}</label>
                                        <input type="text" class="form-control" id="end" name="end"
                                            placeholder="{{ __('user_page.End date') }}.." readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>{{ __('user_page.Price') }}</label>
                                        <input type="number" class="form-control" id="special_price"
                                            name="special_price" placeholder="{{ __('user_page.Price') }}..">
                                        <small id="err-spcl-prc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_special_price') }}</small>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{ __('user_page.Discount') }}</label>
                                        <input type="number" class="form-control" id="disc" name="disc"
                                            placeholder="{{ __('user_page.Discount') }}..">
                                        <small id="err-disc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_discount') }}</small>
                                    </div>
                                </div>
                                <!-- Submit -->
                                <div class="row items-push">
                                    <center>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-sm btn-primary mt-3"
                                                id="submitPrice" style="width: 200px;">
                                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                            </button>
                                        </div>
                                    </center>
                                </div>
                                <!-- END Submit -->
                                <br>
                            </form>
                        </div>

                        <div class="tab-pane" id="availablity">
                            <div class="modal-header-editprice" style="
                            margin-top: -10px;
                            margin-bottom: -20px;">
                                <div class="row">
                                    <div class="col-11">
                                        <ul class="nav filter-language-option-container nav-tabs sideTab column"
                                            style="display: flex; flex-wrap: nowrap; padding-bottom: 0px !important; margin-left: -30px;">
                                            <li class="active modal-price-title">
                                                <a class="tab1 filter-language-option-text" href="#importCalendar"
                                                    data-toggle="tab"
                                                    style="font-size: 12pt;
                                                    font-weight: 600;">
                                                    Import Calendar
                                                </a>
                                            </li>
                                            <li class="modal-price-title" style="margin-left: 55px;">
                                                <a class="filter-language-option-text" href="#addAvailability"
                                                    data-toggle="tab"
                                                    style="font-size: 12pt;
                                                    font-weight: 600; margin-left: -50px;">
                                                    Add Availability
                                                </a>
                                            </li>
                                            <li class="modal-price-title" style="margin-left: 55px;">
                                                <a class="filter-language-option-text" href="#dataAvailability"
                                                    data-toggle="tab"
                                                    style="font-size: 12pt;
                                                    font-weight: 600; margin-left: -50px;">
                                                    Data Availability
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tabbable column-wrapper">
                                <div class="tab-content tab-content-language column rigth" id="tabs">
                                    <div class="tab-pane active" id="importCalendar">
                                        <div class="row"
                                            style="margin-bottom: 15px; background: #1B2430; padding: 10px; margin-left: -32px;margin-right: -32px;margin-top: 15px;">
                                            <div class="col-12">
                                                <span style="color: #fff; margin-left: 8px;">
                                                    <strong>
                                                        {{ __('user_page.Import Calendar') }}
                                                    </strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row items-push d-flex justify-content-end">
                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <div class="file-upload">
                                                        <div class="image-box dropzone"
                                                            style="margin: 0; padding: 0; background: none; height: 50px; border: none; min-height: 0;">
                                                            <a class="btn btn-sm btn-success mt-2"
                                                                style="curson: pointer; width: 200px;">
                                                                <i class="fa fa-add"></i>
                                                                {{ __('user_page.Import type file', ['type' => '.ics']) }}
                                                            </a>
                                                        </div>
                                                        <div style="display: none;">
                                                            <input type="file" id="getICSFile" name="ics" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="msgImportICS"></span>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="addAvailability">
                                        {{-- <hr class="mt-3"> --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="calendar2"></div>
                                            </div>
                                        </div>
                                        <div class="row items-push">
                                            <center>
                                                <div class="col-6">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger mt-2 btn-submit-availability"
                                                        name="action" value="not_available" style="width: 200px;">
                                                        <i class="fa fa-floppy-disk"></i>
                                                        {{ __('user_page.Save Date') }}
                                                    </button>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="dataAvailability">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered table-hover"
                                                        style="color: #383838" id="dataTable" width="100%"
                                                        cellspacing="0">
                                                        <thead style="color: #383838;"
                                                            class="thead-dark table-borderless">
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Start Date</th>
                                                                <th class="text-center">End Date</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- <tr>
                                                                <td class="text-center">1</th>
                                                                <td class="text-center">2022-02-02</th>
                                                                <td class="text-center">2022-02-02</th>
                                                                <td class="text-center">Delete</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">2</th>
                                                                <td class="text-center">2022-02-02</th>
                                                                <td class="text-center">2022-02-02</th>
                                                                <td class="text-center">Delete</th>
                                                            </tr> --}}
                                                        </tbody>
                                                        <tfoot style="color: #383838">
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Start Date</th>
                                                                <th class="text-center">End Date</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="tab-pane" id="extraPrice">
                            <form action="{{ route('villa_update_extra') }}" method="POST" id="edit-extra"
                                class="js-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_villa" id="id_villa"
                                    value="{{ $villa[0]->id_villa }}">

                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="margin-bottom: -10px;">{{ __('user_page.Extra Guest') }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Max Guest') }}</label>
                                        <input type="number" class="form-control" id="max_guest" name="max_guest"
                                            placeholder="{{ __('user_page.Input Max Guest') }}"
                                            value="{{ !empty($villaExtraGuest->max) ? $villaExtraGuest->max : '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Price per Person') }}</label>
                                        <input type="number" class="form-control" id="price_extra_guest"
                                            name="price_extra_guest"
                                            placeholder="{{ __('user_page.Input Price per Person') }}"
                                            value="{{ !empty($villaExtraGuest->price) ? $villaExtraGuest->price : '' }}">
                                    </div>
                                </div>
                                <hr class="mt-5">

                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="margin-bottom: -10px; margin-top: 20px;">
                                            {{ __('user_page.Extra Bed') }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Max Bed') }}</label>
                                        <input type="number" class="form-control" id="max_bed" name="max_bed"
                                            placeholder="{{ __('user_page.Input Max Bed') }}"
                                            value="{{ !empty($villaExtraBed->max) ? $villaExtraBed->max : '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Price per Person') }}</label>
                                        <input type="number" class="form-control" id="price_extra_bed"
                                            name="price_extra_bed"
                                            placeholder="{{ __('user_page.Input Price per Person') }}"
                                            value="{{ !empty($villaExtraBed->price) ? $villaExtraBed->price : '' }}">
                                    </div>
                                </div>
                                <hr class="mt-5">

                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="margin-bottom: -10px; margin-top: 20px;">
                                            {{ __('user_page.Extra Pet') }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Deposit') }}</label>
                                        <select name="deposit" id="deposit" class="form-control"
                                            onchange="displayPrice(this.value)">
                                            <option value="0"
                                                {{ !empty($villaExtraPet->deposit) == 0 ? 'selected' : '' }}>
                                                {{ __('user_page.No Deposit') }}</option>
                                            <option value="1"
                                                {{ !empty($villaExtraPet->deposit) == 1 ? 'selected' : '' }}>
                                                {{ __('user_page.Have to Deposit') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label>{{ __('user_page.Max Pet') }}</label>
                                        <input type="number" class="form-control" id="max_pet" name="max_pet"
                                            placeholder="{{ __('user_page.Input Max Pet') }}"
                                            value="{{ !empty($villaExtraPet->max) ? $villaExtraPet->max : '' }}">
                                    </div>
                                    <div class="col-12 d-none" id="depositPrice">
                                        <label>{{ __('user_page.Deposit Price') }}</label>
                                        <input type="number" class="form-control" id="price_extra_pet"
                                            name="price_extra_pet"
                                            placeholder="{{ __('user_page.Input Price per Person') }}"
                                            value="{{ !empty($villaExtraPet->price_deposit) ? $villaExtraPet->price_deposit : '' }}">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-6 mt-5">
                                        <center>
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                style="width: 200px;">
                                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                            </button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('villa_update_price') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">

                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="price"><strong>Regular Price</strong></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price.." value="{{ $villa[0]->price }}">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px; background: #ff7400; padding: 10px; margin-top: 15px;">
                        <div class="col-12">
                            <span style="color: #fff;"><strong>Add Special Price</strong></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div id="calendar"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Start date</label>
                            <input type="text" class="form-control" id="start" name="start" placeholder="End date.." readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="">End date</label>
                            <input type="text" class="form-control" id="end" name="end" placeholder="End date.." readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Price</label>
                            <input type="number" class="form-control" id="special_price" name="special_price" placeholder="Price..">
                        </div>
                        <div class="col-lg-6">
                            <label>Discount</label>
                            <input type="number" class="form-control" id="disc" name="disc" placeholder="Discount..">
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div> --}}
    </div>
</div>

<style>
    .fc-widget-header span {
        color: black !important;
    }

    .fc-day-number {
        color: rgb(85, 73, 73) !important;
        float: none !important;
    }

    .fc-view-container {
        border: 2px solid #d8d4d4;
        box-shadow: 0px 3px 15px -8px rgb(100, 100, 100);
    }

    .fc-title {
        color: #fff;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(function() {
        $("#villa-price").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#villa-price').removeClass('is-invalid');
            $('#err-prc').hide();
        });
        $("#special_price").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#special_price').removeClass('is-invalid');
            $('#err-spcl-prc').hide();
        });
        $("#disc").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#disc').removeClass('is-invalid');
            $('#err-disc').hide();
        });
        $("#edit-price").submit(function(e) {
            let error = 0;
            if (!parseInt($('#villa-price').val())) {
                $('#villa-price').addClass('is-invalid');
                $('#err-prc').show();
                error = 1;
            }
            if ($('#start').val() && $('#end').val()) {
                if (!$('#special_price').val()) {
                    $('#special_price').addClass('is-invalid');
                    $('#err-spcl-prc').show();
                    error = 1;
                }
                if (!$('#disc').val()) {
                    $('#disc').addClass('is-invalid');
                    $('#err-disc').show();
                    error = 1;
                }
            }
            if (error == 1) {
                e.preventDefault();
            } else {
                let btn = document.getElementById("submitPrice");
                btn.textContent = "Saving...";
                btn.classList.add("disabled");
            }
        });
    });
</script>
<script>
    function displayPrice(id) {
        let element = document.getElementById("depositPrice");
        if (id == 1) {
            element.classList.remove("d-none");
            element.classList.add("d-block");
        } else {
            element.classList.add("d-none");
            element.classList.remove("d-block");
        }
    }
</script>

<script>
    id_villa_fullcalendar = $('#id_villa').val();

    let calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        displayEventTime: true,
        editable: false,
        events: `/villa/calendar/` + id_villa_fullcalendar,

        //disable past day
        validRange: {
            start: new Date(),
        },

        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        selectable: true,
        selectHelper: true,

        //selection date start until end
        select: function(start, end) {
            var start = moment(start).format('YYYY-MM-DD');
            var end = moment(end).subtract(1, "days").format('YYYY-MM-DD');
            $('#start').val(start);
            $('#end').val(end);
            // $('#addSpecialModal').modal('show');
        },
    });

    let multiEvent = [];
    var eventData = [];
    let d;
    let e;

    let calendar2 = $('#calendar2').fullCalendar({
        defaultView: 'month',
        displayEventTime: true,
        editable: false,
        events: `/villa/calendar/not_available/` + id_villa_fullcalendar,

        //disable past day
        validRange: {
            start: new Date(),
        },

        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        selectable: true,
        selectHelper: true,

        //selection date start until end
        select: function(start, end) {
            var start = moment(start).format('YYYY-MM-DD');
            var end = moment(end).subtract(1, "days").format('YYYY-MM-DD');
            var endtemp = moment(end).add(1, "days").format('YYYY-MM-DD');
            $('#startNotAvailable').val(start);
            $('#endNotAvailable').val(end);
            var title = "Not Available";

            var tempEvent;
            tempEvent = {
                title: title,
                start: start,
                end: endtemp,
            }

            multiEvent.push([start, end]);
            eventData.push({
                'start': start,
                'end': endtemp,
                'title': title
            });
            e = uniqBy(eventData, JSON.stringify);

            d = uniqBy(multiEvent, JSON.stringify);
            console.log(d);
            // multiEvent.push(end);
            calendar2.fullCalendar('renderEvent', tempEvent, true);
            // calendar2.fullCalendar('selected');
            // $('#addSpecialModal').modal('show');
        }
    });

    function uniqBy(multiEvent, key) {
        let seen = new Set();
        return multiEvent.filter(item => {
            let k = key(item);
            return seen.has(k) ? false : seen.add(k);
        });
    }

    //add data availability to db
    $(".btn-submit-availability").click(function() {

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('villa_not_available') }}",
            data: {
                multiEvent: d,
                id: id_villa_fullcalendar
            },
            success: function(data) {
                alert(data.message);
                location.reload();
            }
        });

    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $('#getICSFile').on('change', function(ev) {

        var filedata = this.files[0];
        var filetype = filedata.type;
        let id = $('#id_villa').val();

        // let fileContent = "";

        // var reader = new FileReader();
        // reader.readAsText(filedata);

        // reader.onload = function () {
        //     console.log(reader.result);
        //     var json = $.toJSON(reader.result);
        //     console.log(json);
        // };

        //   var match=['image/jpeg','image/jpg','image/png'];

        if (filetype.includes("text/calendar")) {

            var postData = new FormData();
            postData.append('file', filedata);

            var url = "/villa/calendar/import/" + id;

            $.ajax({
                async: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                contentType: false,
                url: url,
                data: postData,
                processData: false,
                beforeSend: function() {
                    $('#msgImportICS').html(
                        '<p style="color:red; margin: 0;">Importing your file...</p>');
                },
                success: (response) => {
                    if (response) {
                        alert('Calendar has been successfully imported');
                        location.reload();
                        this.reset();
                    }
                },
                error: function(response) {
                    alert('Error importing calendar');
                    // location.reload();
                    this.reset();
                }
            });
        } else {
            $('#msgImportICS').html(
                '<p style="color:red; margin: 0;">Please select a valid type file only .ics allowed</p>');
        }
    });
</script>

<script>
    $('.switch input').on('change', function() {
        var dad = $(this).parent();
        if ($(this).is(':checked'))
            dad.addClass('switch-checked');
        else
            dad.removeClass('switch-checked');
    });
</script>

<!-- Page JS Plugins -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />

<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

<script>
    // load_tabel_first();
    let id_villa = $('#id_villa').val();

    var table = $('#dataTable').dataTable({
        processing: true,
        serverSide: true,
        autowidth: true,
        ajax: "/villa/availability/" + id_villa + "/datatable",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                class: 'text-center font-size-sm'
            },
            {
                data: 'start',
                name: 'start',
                class: 'font-w600 font-size-sm'
            },
            {
                data: 'end',
                name: 'end',
                class: 'font-w600 font-size-sm'
            },
            // { data: 'in_out', name: 'in_out', class:'font-w600 font-size-sm' },
            // { data: 'total_price', name: 'total_price', class:'font-w600 font-size-sm' },
            // { data: 'status', name: 'status', class:'font-w600 font-size-sm' },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],
        responsive: true
    });
</script>
