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

<div class="modal fade" id="modal-add_gender" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 200px; width: 400px; top: 200px;">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">Edit Gender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 450px; border-radius: 0px;">
                <div class="form-group pt-2 px-4">
                    <div class="row">
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-6">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Male</span>
                                        <input type="checkbox" value="male" id="male" name="gender[]">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Female</span>
                                        <input type="checkbox" value="female" id="female" name="gender[]">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 70px;">
                <div class="col-4" style="text-align: center;">
                    <button id="btnsaveCategoryRestaurant" type="submit" class="btn btn-primary btn-sm w-100 mb-2"
                        onclick="updateGender({{ $profile->id_collab }})">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
    $("input[name='gender[]']").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
</script>
