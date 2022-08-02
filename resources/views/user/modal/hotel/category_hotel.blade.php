<!-- Fade In Default Modal -->

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
</style>

<div class="modal fade" id="ModalCategoryHotel" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: auto; border-radius: 0px;">
                <div class="form-group pt-2 px-4">
                    <div class="row">
                        <label class="form-label"><b>Category</b></label>
                        <div id="check_cat" class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            @foreach ($hotelCategory as $data)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="row" style="font-size: 13px;">
                                        @php
                                            $isChecked = '';
                                            foreach ($hotelHasCategory as $item) {
                                                if ($data->id_hotel_category == $item->id_hotel_category) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <label class="container-checkbox2">
                                            <span class="translate-text-group-items">{{ $data->name }}</span>
                                            <input class="check-cat" type="checkbox" value="{{ $data->id_hotel_category }}"
                                                id="{{ $data->id_hotel_category }}" name="hotelCategory[]"
                                                {{ $isChecked }}>
                                            <span class="checkmark2 checklist-cat"></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <small id="err-slc-cat" style="display: none;" class="invalid-feedback">Select one of category</small><br>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 70px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100" id="btnSaveCategoryH" onclick="editCategoryH({{ $hotel[0]->id_hotel }})">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
