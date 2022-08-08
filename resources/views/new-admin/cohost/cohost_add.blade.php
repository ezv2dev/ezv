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

<div class="modal fade" id="modal-cohost" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">Add Co-Host</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                <form action="javasript.void(0)" method="post" id="formcohost">
                    <div class="form-group pt-2 px-4">
                        <div class="row">
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="email" id="email_cohost"
                                            class="form-control form-control-alt {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email_cohost" placeholder="Email Address">
                                        <i id="fvicn-eml" class="flaticon-envelope flaticon"></i>
                                        <small id="err-eml-lgn" style="display: none;" class="invalid-feedback"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label class="form-label"><b>Permission</b></label>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Listing</span>
                                        <input type="checkbox"
                                            id="listing" name="listing">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Reservation</span>
                                        <input type="checkbox"
                                            id="reservation" name="reservation">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Calendar</span>
                                        <input type="checkbox"
                                            id="calendar" name="calendar">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Statistic</span>
                                        <input type="checkbox"
                                            id="statistic" name="statistic">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Finance</span>
                                        <input type="checkbox"
                                            id="finance" name="finance">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Inbox</span>
                                        <input type="checkbox"
                                            id="inbox" name="inbox">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="translate-text-group" style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row" style="font-size: 13px;">
                                    <label class="container-checkbox2">
                                        <span class="translate-text-group-items">Collaboration</span>
                                        <input type="checkbox"
                                            id="collaboration" name="collaboration">
                                        <span class="checkmark2"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 70px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100" id="btnSaveAmenities"
                        onclick="store_cohost()">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->


<script>
function store_cohost()
{
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/cohost-store",
        data: $('#formcohost').serialize(),
        success: function (response) {

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $('#modal-cohost').modal('hide');
        },
        error: function (jqXHR, exception) {
            if (jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }
        },
    });
}
</script>
