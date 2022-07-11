<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_bedroom" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">{{ __('user_page.Edit Bedroom, Bathroom, Adult, & Children') }}</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Bedrooms') }}</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">
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

                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px display-none" id="bedroomForm">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control modal-input" id="bedroom1" name="bedroom1"
                            placeholder="Input Bedrooms.." min="7"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="price">Beds</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="1" id="p1" name="beds"
                                    @if ($villa[0]->beds == 1) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p1">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">1</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="2" id="p2" name="beds"
                                    @if ($villa[0]->beds == 2) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p2">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">2</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="3" id="p3" name="beds"
                                    @if ($villa[0]->beds == 3) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p3">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">3</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="4" id="p4" name="beds"
                                    @if ($villa[0]->beds == 4) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p4">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">4</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="5" id="p5" name="beds"
                                    @if ($villa[0]->beds == 5) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p5">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">5</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="p6" name="beds"
                                    @if ($villa[0]->beds == 6) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="p6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container" class="" onclick="showBeds()"
                                id="moreBeds">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">more</p>
                                    </div>
                                </label>
                            </div>

                            <div class="roomnumber-filter-container display-none" onclick="hideBeds()"
                                id="hideBeds">
                                <label class="editnumberoption-checkbox-alias">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">hide</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
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
                                <input type="radio" value="6" id="t3.5" name="bathroom"
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
                        <input type="text" class="form-control modal-input" id="adult1" name="adult1"
                            placeholder="Input Adults.." min="7"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
                <div class="row mb-12 margin-bottom-12px">
                    <label class="col-sm-4 col-form-label" for="children">{{ __('user_page.Children') }}</label>
                    <div class="col-sm-8">
                        <div class="editnumberoption_container">

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

                            <div class="roomnumber-filter-container">
                                <input type="radio" value="6" id="y6" name="children"
                                    @if ($villa[0]->children == 6) checked @endif>
                                <label class="editnumberoption-checkbox-alias" for="y6">
                                    <div class="">
                                        <p style="font-size: 13px; margin: 0px;">6</p>
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
                        <input type="text" class="form-control modal-input" id="children1" name="children1"
                            placeholder="Input Childrens.." min="7"
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
                <br>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
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

    function showBathroom() {
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
        document
            .getElementById("bathroomForm")
            .classList.add("display-none");
        document
            .getElementById("moreBathroom")
            .classList.remove("display-none");
        document
            .getElementById("hideBathroom")
            .classList.add("display-none");
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
        document
            .getElementById("adultForm")
            .classList.add("display-none");
        document
            .getElementById("moreAdult")
            .classList.remove("display-none");
        document
            .getElementById("hideAdult")
            .classList.add("display-none");
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
            .getElementById("y6")
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
            .getElementById("y6")
            .disabled = true;
    }

    function hideChildren() {
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
            .getElementById("y6")
            .checked = false;
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
            .getElementById("y6")
            .disabled = false;
    }
</script>
