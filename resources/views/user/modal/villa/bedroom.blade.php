<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_bedroom" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">{{ __('user_page.Edit Bedroom, Bathroom, Adult, & Children') }}</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-x: hidden; overflow-y: auto; border-radius: 0px;">

                <div class="row mb-12 margin-bottom-12px display-none" id="bedsForm">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control modal-input" id="beds1" name="beds1"
                            placeholder="Input Beds.." min="7"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Bathroom') }}</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="t1" name="bathroom"
                                    @if ($villa[0]->bathroom == 1) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="t1">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1.5" id="t1.5" name="bathroom"
                                    @if ($villa[0]->bathroom == 1.5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="t1.5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1.5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="t2" name="bathroom"
                                    @if ($villa[0]->bathroom == 2) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="t2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container"
                                @if ($villa[0]->bathroom == 2.5) checked @endif>
                                <input type="radio" value="2.5" id="t2.5" name="bathroom">
                                <label class="editnumberoption-checkbox-alias" for="t2.5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2.5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="t3" name="bathroom"
                                    @if ($villa[0]->bathroom == 3) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="t3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3.5" id="t3.5" name="bathroom"
                                    @if ($villa[0]->bathroom == 3.5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="t3.5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3.5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container" class="" onclick="showBathroom()"
                                id="moreBathroom">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">more</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container display-none" onclick="hideBathroom()"
                                id="hideBathroom">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">hide</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px display-none" id="bathroomForm">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control modal-input" id="bathroom1" name="bathroom1"
                        @if ($villa[0]->bathroom > 3.5)
                            value="{{ $villa[0]->bathroom }}"
                        @endif
                            placeholder="Input Bathrooms.." min="4"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="adult">{{ __('user_page.Adults') }}</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="x1" name="adult"
                                    @if ($villa[0]->adult == 1) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x1">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="x2" name="adult"
                                    @if ($villa[0]->adult == 2) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="x3" name="adult"
                                    @if ($villa[0]->adult == 3) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="x4" name="adult"
                                    @if ($villa[0]->adult == 4) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="x5" name="adult"
                                    @if ($villa[0]->adult == 5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="x6" name="adult"
                                    @if ($villa[0]->adult == 6) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="x6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container" class="" onclick="showAdult()"
                                id="moreAdult">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">more</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container display-none" onclick="hideAdult()"
                                id="hideAdult">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">hide</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px display-none" id="adultForm">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control modal-input" id="adult1" name="adult1"
                        @if ($villa[0]->adult > 6)
                            value="{{ $villa[0]->adult }}"
                        @endif
                            placeholder="Input Adults.." min="7"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="children">{{ __('user_page.Children') }}</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="0" id="y0" name="children"
                                    @if ($villa[0]->children == 0) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y0">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">0</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="y1" name="children"
                                    @if ($villa[0]->children == 1) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y1">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="y2" name="children"
                                    @if ($villa[0]->children == 2) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="y3" name="children"
                                    @if ($villa[0]->children == 3) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="y4" name="children"
                                    @if ($villa[0]->children == 4) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="y5" name="children"
                                    @if ($villa[0]->children == 5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container" class="" onclick="showChildren()"
                                id="moreChildren">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">more</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container display-none" onclick="hideChildren()"
                                id="hideChildren">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">hide</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px display-none" id="childrenForm">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control modal-input" id="children1" name="children1"
                        @if ($villa[0]->children > 5)
                            value="{{ $villa[0]->children }}"
                        @endif
                            placeholder="Input Childrens.." min="6"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="size">{{ __('user_page.Size') }}
                        (m<sup>2</sup>)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control modal-input" id="size" name="size"
                            placeholder="{{ __('user_page.Size') }}.."
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            value="{{ $villa[0]->size }}">

                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px" id="bedroomFormSelect" onchange="showAddBedroomDetailForm(this, 'radio')">
                    <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Bedrooms') }}</label>
                    <div class="col-sm-8">
                        {{-- check if bedroomDetail exist --}}
                        @php
                            $isSelectNumber = '';
                            $isAdd = '';
                            if($villa[0]->villaBedroomDetail->count() > 0){
                                $isSelectNumber = 'd-none';
                                $isAdd = '';
                            } else {
                                $isSelectNumber = '';
                                $isAdd = 'd-none';
                            }
                        @endphp
                        <div class="editnumberoption_container {{ $isSelectNumber }}" id="btnSelectBedroomNumber">
                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="o1" name="bedroom"
                                    @if ($villa[0]->bedroom == 1) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o1">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="o2" name="bedroom"
                                    @if ($villa[0]->bedroom == 2) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="o3" name="bedroom"
                                    @if ($villa[0]->bedroom == 3) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="o4" name="bedroom"
                                    @if ($villa[0]->bedroom == 4) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="o5" name="bedroom"
                                    @if ($villa[0]->bedroom == 5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="o6" name="bedroom"
                                    @if ($villa[0]->bedroom == 6) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="o6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container" class="" onclick="showBedroom()"
                                id="moreBedroom">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">more</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container display-none" onclick="hideBedroom()"
                                id="hideBedroom">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">hide</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button id="btnAddBedroom" class="btn btn-primary {{ $isAdd }}"
                                data-index="{{ $villa[0]->villaBedroomDetail->count() ?? 0 }}"
                                onclick="addAddBedroomDetailForm()">Add Bedroom</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px display-none" id="bedroomForm" onkeyup="showAddBedroomDetailForm(this, 'input')">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control modal-input" id="bedroom1" name="bedroom1"
                        @if ($villa[0]->bedroom > 5)
                            value="{{ $villa[0]->bedroom }}"
                        @endif
                            placeholder="Input Bedrooms.." min="7"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <hr class="hr-hide" style="display: none;">
                <div id="bedroomDetailForm">
                    @for ($i = 0; $i < $villa[0]->villaBedroomDetail->count(); $i++)
                        <div class="row mb-5 bedroomDetailFormContent" id="bedroomDetailFormContent{{ $i }}">
                            <label class="form-label">
                                <b>{{ __('user_page.Bedroom') }} {{ $i+1 }}</b>
                                <a href="javascript:void(0);" onclick="deleteAddBedroomDetailForm({{ $i }})">
                                    <i class="fa fa-trash" style="color:red; margin-left: 25px;" title="{{ __('user_page.Delete') }}"></i>
                                </a>
                            </label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                                @foreach ($bedroom_m as $data)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="row" style="font-size: 13px;">
                                            @php
                                                $isChecked = '';
                                                foreach ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBedroomAmenities as $bedroomAmenities) {
                                                    if ($bedroomAmenities->name == $data->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_bed }}" id="{{ $data->id_bed }}" name="bedroom[]" {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($bathroom_m as $data)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="row" style="font-size: 13px;">
                                            @php
                                                $isChecked = '';
                                                foreach ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBathroomAmenities as $bathroomAmenities) {
                                                    if ($bathroomAmenities->name == $data->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]" {{ $isChecked }}>
                                                {{-- <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]"> --}}
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @foreach ($bed as $data)
                                <div class="col-4 bedroomDetailFormContentBed">
                                    <div class="reserve-input-row">
                                        <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                            {{ $data->name }}
                                        </div>
                                        <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                            <a type="button" onclick="decrement_qty_bed('bed{{ $i }}{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                                <i class="fa fa-circle-minus fa-lg" aria-hidden="true"></i>
                                            </a>
                                            @php
                                                $count = 0;
                                                foreach ($villa[0]->villaBedroomDetail[$i]->villaBedroomDetailBed as $item) {
                                                    if ($item->id_bed == $data->id_bed) {
                                                        $count = $item->qty;
                                                    }
                                                }
                                            @endphp
                                            <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                                <input type="hidden" name="id_bed" value="{{ $data->id_bed }}" readonly="">
                                                <p><input type="number" id="bed{{ $i }}{{ $data->name }}" name="qty" value="{{ $count }}" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                            </div>
                                            <a type="button" onclick="increment_qty_bed('bed{{ $i }}{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                                <i class="fa fa-circle-plus fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
            <div class="modal-footer" style="background-color: white;">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-12" style="text-align: center;">
                        <button type="submit" class="btn btn-sm btn-primary" style="width: 200px;"
                            onclick="editBedroomVilla({{ $villa[0]->id_villa }})">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
    $(document).ready(function () {
        if ($("input[name='bedroom']").is(":checked") == true) {
            let valueBedroom = $("input[name='bedroom']:checked").val();
            console.log(valueBedroom);
            showAddBedroomDetailForm($("#bedroomFormSelect"), 'radio');
        }
    });

    function showBedroom() {
        document
            .getElementById("bedroomForm")
            .classList.remove("display-none");
        document
            .getElementById("moreBedroom")
            .classList.add("display-none");
        document
            .getElementById("hideBedroom")
            .classList.remove("display-none");
        document
            .getElementById("o1")
            .checked = false;
        document
            .getElementById("o2")
            .checked = false;
        document
            .getElementById("o3")
            .checked = false;
        document
            .getElementById("o4")
            .checked = false;
        document
            .getElementById("o5")
            .checked = false;
        document
            .getElementById("o6")
            .checked = false;
        document
            .getElementById("o1")
            .disabled = true;
        document
            .getElementById("o2")
            .disabled = true;
        document
            .getElementById("o3")
            .disabled = true;
        document
            .getElementById("o4")
            .disabled = true;
        document
            .getElementById("o5")
            .disabled = true;
        document
            .getElementById("o6")
            .disabled = true;
    }

    function hideBedroom() {
        document
            .getElementById("bedroomForm")
            .classList.add("display-none");
        document
            .getElementById("moreBedroom")
            .classList.remove("display-none");
        document
            .getElementById("hideBedroom")
            .classList.add("display-none");
        document
            .getElementById("o1")
            .checked = false;
        document
            .getElementById("o2")
            .checked = false;
        document
            .getElementById("o3")
            .checked = false;
        document
            .getElementById("o4")
            .checked = false;
        document
            .getElementById("o5")
            .checked = false;
        document
            .getElementById("o6")
            .checked = false;
        document
            .getElementById("o1")
            .disabled = false;
        document
            .getElementById("o2")
            .disabled = false;
        document
            .getElementById("o3")
            .disabled = false;
        document
            .getElementById("o4")
            .disabled = false;
        document
            .getElementById("o5")
            .disabled = false;
        document
            .getElementById("o6")
            .disabled = false;
    }

    function showBeds() {
        document
            .getElementById("bedsForm")
            .classList.remove("display-none");
        document
            .getElementById("moreBeds")
            .classList.add("display-none");
        document
            .getElementById("hideBeds")
            .classList.remove("display-none");
        document
            .getElementById("p1")
            .checked = false;
        document
            .getElementById("p2")
            .checked = false;
        document
            .getElementById("p3")
            .checked = false;
        document
            .getElementById("p4")
            .checked = false;
        document
            .getElementById("p5")
            .checked = false;
        document
            .getElementById("p6")
            .checked = false;
        document
            .getElementById("p1")
            .disabled = true;
        document
            .getElementById("p2")
            .disabled = true;
        document
            .getElementById("p3")
            .disabled = true;
        document
            .getElementById("p4")
            .disabled = true;
        document
            .getElementById("p5")
            .disabled = true;
        document
            .getElementById("p6")
            .disabled = true;
    }

    function hideBeds() {
        document
            .getElementById("bedsForm")
            .classList.add("display-none");
        document
            .getElementById("moreBeds")
            .classList.remove("display-none");
        document
            .getElementById("hideBeds")
            .classList.add("display-none");
        document
            .getElementById("p1")
            .checked = false;
        document
            .getElementById("p2")
            .checked = false;
        document
            .getElementById("p3")
            .checked = false;
        document
            .getElementById("p4")
            .checked = false;
        document
            .getElementById("p5")
            .checked = false;
        document
            .getElementById("p6")
            .checked = false;
        document
            .getElementById("p1")
            .disabled = false;
        document
            .getElementById("p2")
            .disabled = false;
        document
            .getElementById("p3")
            .disabled = false;
        document
            .getElementById("p4")
            .disabled = false;
        document
            .getElementById("p5")
            .disabled = false;
        document
            .getElementById("p6")
            .disabled = false;
    }

    let bathroom1Backup = $("input[name='bathroom1']").val();
    let bathroomBackup = $("input[name='bathroom']:checked").val();

    // $("input[name='bathroom']").change(function () {
    //     bathroomBackup = $("input[name='bathroom']:checked").val();
    // });

    function showBathroom() {
        console.log("uncheck bathroom "+bathroomBackup);
        $("input[name='bathroom']").removeAttr("checked");
        $("input[name='bathroom1']").val(bathroom1Backup);

        document
            .getElementById("bathroomForm")
            .classList.remove("display-none");
        document
            .getElementById("moreBathroom")
            .classList.add("display-none");
        document
            .getElementById("hideBathroom")
            .classList.remove("display-none");
        document
            .getElementById("t1")
            .checked = false;
        document
            .getElementById("t1.5")
            .checked = false;
        document
            .getElementById("t2")
            .checked = false;
        document
            .getElementById("t2.5")
            .checked = false;
        document
            .getElementById("t3")
            .checked = false;
        document
            .getElementById("t3.5")
            .checked = false;
        document
            .getElementById("t1")
            .disabled = true;
        document
            .getElementById("t1.5")
            .disabled = true;
        document
            .getElementById("t2")
            .disabled = true;
        document
            .getElementById("t2.5")
            .disabled = true;
        document
            .getElementById("t3")
            .disabled = true;
        document
            .getElementById("t3.5")
            .disabled = true;
    }

    function hideBathroom() {
        console.log("checked bathroom broo"+bathroomBackup);
        $("#bathroom1").val("");
        if (bathroomBackup == null) {

        }
        else {
            document.getElementById("t"+bathroomBackup).checked = true;
        }

        document
            .getElementById("bathroomForm")
            .classList.add("display-none");
        document
            .getElementById("moreBathroom")
            .classList.remove("display-none");
        document
            .getElementById("hideBathroom")
            .classList.add("display-none");
        // document
        //     .getElementById("t1")
        //     .checked = false;
        // document
        //     .getElementById("t1.5")
        //     .checked = false;
        // document
        //     .getElementById("t2")
        //     .checked = false;
        // document
        //     .getElementById("t2.5")
        //     .checked = false;
        // document
        //     .getElementById("t3")
        //     .checked = false;
        // document
        //     .getElementById("t3.5")
        //     .checked = false;
        document
            .getElementById("t1")
            .disabled = false;
        document
            .getElementById("t1.5")
            .disabled = false;
        document
            .getElementById("t2")
            .disabled = false;
        document
            .getElementById("t2.5")
            .disabled = false;
        document
            .getElementById("t3")
            .disabled = false;
        document
            .getElementById("t3.5")
            .disabled = false;
    }

    let adult1Backup = $("input[name='adult1']").val();
    let adultBackup = $("input[name='adult']:checked").val();

    function showAdult() {
        document
            .getElementById("adultForm")
            .classList.remove("display-none");
        document
            .getElementById("moreAdult")
            .classList.add("display-none");
        document
            .getElementById("hideAdult")
            .classList.remove("display-none");

        console.log("uncheck adult "+adultBackup);
        $("input[name='adult']").removeAttr('checked');
        $("input[name='adult1']").val(adult1Backup);

        document
            .getElementById("x1")
            .checked = false;
        document
            .getElementById("x2")
            .checked = false;
        document
            .getElementById("x3")
            .checked = false;
        document
            .getElementById("x4")
            .checked = false;
        document
            .getElementById("x5")
            .checked = false;
        document
            .getElementById("x6")
            .checked = false;

        document
            .getElementById("x1")
            .disabled = true;
        document
            .getElementById("x2")
            .disabled = true;
        document
            .getElementById("x3")
            .disabled = true;
        document
            .getElementById("x4")
            .disabled = true;
        document
            .getElementById("x5")
            .disabled = true;
        document
            .getElementById("x6")
            .disabled = true;
    }

    function hideAdult() {
        console.log("checked adult"+adultBackup);
        $("#adult1").val("");
        if (adultBackup == null) {

        }
        else {
            document.getElementById("x"+adultBackup).checked = true;
        }
        document
            .getElementById("adultForm")
            .classList.add("display-none");
        document
            .getElementById("moreAdult")
            .classList.remove("display-none");
        document
            .getElementById("hideAdult")
            .classList.add("display-none");
        // document
        //     .getElementById("x1")
        //     .checked = false;
        // document
        //     .getElementById("x2")
        //     .checked = false;
        // document
        //     .getElementById("x3")
        //     .checked = false;
        // document
        //     .getElementById("x4")
        //     .checked = false;
        // document
        //     .getElementById("x5")
        //     .checked = false;
        // document
        //     .getElementById("x6")
        //     .checked = false;
        document
            .getElementById("x1")
            .disabled = false;
        document
            .getElementById("x2")
            .disabled = false;
        document
            .getElementById("x3")
            .disabled = false;
        document
            .getElementById("x4")
            .disabled = false;
        document
            .getElementById("x5")
            .disabled = false;
        document
            .getElementById("x6")
            .disabled = false;
    }

    let children1Backup = $("input[name='children1']").val();
    let childrenBackup = $("input[name='children']:checked").val();

    function showChildren() {
        document
            .getElementById("childrenForm")
            .classList.remove("display-none");
        document
            .getElementById("moreChildren")
            .classList.add("display-none");
        document
            .getElementById("hideChildren")
            .classList.remove("display-none");

        console.log("uncheck children "+childrenBackup);
        $("input[name='children']").removeAttr('checked');
        $("input[name='children1']").val(children1Backup);

        document
            .getElementById("y1")
            .checked = false;
        document
            .getElementById("y2")
            .checked = false;
        document
            .getElementById("y3")
            .checked = false;
        document
            .getElementById("y4")
            .checked = false;
        document
            .getElementById("y5")
            .checked = false;
        document
            .getElementById("y0")
            .checked = false;

        document
            .getElementById("y1")
            .disabled = true;
        document
            .getElementById("y2")
            .disabled = true;
        document
            .getElementById("y3")
            .disabled = true;
        document
            .getElementById("y4")
            .disabled = true;
        document
            .getElementById("y5")
            .disabled = true;
        document
            .getElementById("y0")
            .disabled = true;
    }

    function hideChildren() {
        console.log("checked children"+childrenBackup);
        $("#children1").val("");
        if (childrenBackup == null) {

        }
        else {
            document.getElementById("y"+childrenBackup).checked = true;
        }
        document
            .getElementById("childrenForm")
            .classList.add("display-none");
        document
            .getElementById("moreChildren")
            .classList.remove("display-none");
        document
            .getElementById("hideChildren")
            .classList.add("display-none");

        document
            .getElementById("y1")
            .disabled = false;
        document
            .getElementById("y2")
            .disabled = false;
        document
            .getElementById("y3")
            .disabled = false;
        document
            .getElementById("y4")
            .disabled = false;
        document
            .getElementById("y5")
            .disabled = false;
        document
            .getElementById("y0")
            .disabled = false;
    }

    function increment_qty_bed(elementId) {
        document.getElementById(elementId).stepUp();
    }
    function decrement_qty_bed(elementId) {
        document.getElementById(elementId).stepDown();
    }
</script>

<script>
    console.log('hit showAddBedroomDetailForm');
    function showAddBedroomDetailForm(trigger, triggerType) {
        if(triggerType == 'input'){
            let count = $(trigger).find(`input[name='bedroom1']`).val();
            console.log(count, triggerType);

            let content = '';
            for (let i = 0; i < count; i++) {
                content += contentBedroomDetailForm(i, null);
            }
            $('.hr-hide').show();
            $('#bedroomDetailForm').html(content);
            $('#btnAddBedroom').attr('data-index', count);
        }

        if(triggerType == 'radio'){
            let count = $(trigger).find(`input[name='bedroom']:checked`).val();
            console.log(count, triggerType);

            let content = '';
            for (let i = 0; i < count; i++) {
                content += contentBedroomDetailForm(i, null);
            }
            $('.hr-hide').show();
            $('#bedroomDetailForm').html(content);
            $('#btnAddBedroom').attr('data-index', count);
        }

        //disabled/enabled button select/button add bedroom
        if ($(`.bedroomDetailFormContent`).length > 0){
            $('#btnSelectBedroomNumber').addClass('d-none');
            $('#btnAddBedroom').removeClass('d-none');
        } else {
            $('#btnSelectBedroomNumber').removeClass('d-none');
            $('#btnAddBedroom').addClass('d-none');
        }
    }
    function contentBedroomDetailForm(index, data) {
        let content = `
            <div class="row mb-5 bedroomDetailFormContent" id="bedroomDetailFormContent${index}">
                <label class="form-label">
                    <b>{{ __('user_page.Bedroom') }} ${index+1}</b>
                    <a href="javascript:void(0);" onclick="deleteAddBedroomDetailForm(${index})">
                        <i class="fa fa-trash" style="color:red; margin-left: 25px;" title="{{ __('user_page.Delete') }}"></i>
                    </a>
                </label>
                <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                    @foreach ($bedroom_m as $data)
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="row" style="font-size: 13px;">
                                {{--
                                @php
                                    $isChecked = '';
                                    foreach ($bedroom as $item) {
                                        if ($data->name == $item->name) {
                                            $isChecked = 'checked';
                                        }
                                    }
                                @endphp
                                --}}
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">{{ $data->name }}</span>
                                    {{-- <input type="checkbox" value="{{ $data->id_bed }}" id="{{ $data->id_bed }}" name="bedroom[]" {{ $isChecked }}> --}}
                                    <input type="checkbox" value="{{ $data->id_bed }}" id="{{ $data->id_bed }}" name="bedroom[]">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($bathroom_m as $data)
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="row" style="font-size: 13px;">
                                {{--
                                @php
                                    $isChecked = '';
                                    foreach ($bathroom as $item) {
                                        if ($data->name == $item->name) {
                                            $isChecked = 'checked';
                                        }
                                    }
                                @endphp
                                --}}
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">{{ $data->name }}</span>
                                    {{-- <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]" {{ $isChecked }}> --}}
                                    <input type="checkbox" value="{{ $data->id_bathroom }}" id="{{ $data->id_bathroom }}" name="bathroom[]">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach ($bed as $data)
                    <div class="col-4 bedroomDetailFormContentBed">
                        <div class="reserve-input-row">
                            <div class="col-6 align-items-center d-flex" style="font-size: 0.8rem;">
                                {{ $data->name }}
                            </div>
                            <div class="col-6" style="display: flex; align-items: center; justify-content: end;">
                                <a type="button" onclick="decrement_qty_bed('bed${index+1}{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                    <!-- <i class="fa-solid fa-minus" style="padding:30%"></i> -->
                                    <i class="fa fa-circle-minus fa-lg" aria-hidden="true"></i>
                                </a>
                                <div style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                    <input type="hidden" name="id_bed" value="{{ $data->id_bed }}" readonly="">
                                    <p><input type="number" id="bed${index+1}{{ $data->name }}" name="qty" value="0" min="0" style="text-align: center; border:none; width:30px;" readonly=""></p>
                                </div>
                                <a type="button" onclick="increment_qty_bed('bed${index+1}{{ $data->name }}')" style="/*height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;*/">
                                    <!-- <i class="fa-solid fa-plus" style="padding:30%"></i> -->
                                    <i class="fa fa-circle-plus fa-lg" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        `;

        return content;
    }
    function deleteAddBedroomDetailForm(index) {
        // remove tag
        $(`#bedroomDetailFormContent${index}`).remove();

        //disabled/enabled button select/button add bedroom
        if ($(`.bedroomDetailFormContent`).length > 0){
            $('#btnSelectBedroomNumber').addClass('d-none');
            $('#btnAddBedroom').removeClass('d-none');
        } else {
            $('#btnSelectBedroomNumber').removeClass('d-none');
            $('#btnAddBedroom').addClass('d-none');
        }

        // select/input value
        if($(`.bedroomDetailFormContent`).length <= 6){
            value = $(`.bedroomDetailFormContent`).length;
            $('#bedroomFormSelect').find(`input[name=bedroom][value='${value}']`).prop("checked",true);
            $('#bedroomForm').find(`input[name='bedroom1']`).val();
        } else {
            value = $(`.bedroomDetailFormContent`).length;
            $('#bedroomFormSelect').find(`input[name=bedroom]`).prop("checked",false);
            $('#bedroomForm').find(`input[name='bedroom1']`).val(value);
        }
    }
    function addAddBedroomDetailForm() {
        console.log('hit addAddBedroomDetailForm');
        let index = parseInt($('#btnAddBedroom').attr('data-index'));
        let content = contentBedroomDetailForm(index, null);
        $('#bedroomDetailForm').append(content);
        $('#btnAddBedroom').attr('data-index', index+1);
    }
</script>
