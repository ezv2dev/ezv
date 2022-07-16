<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_menu" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-edit-menu-container" action="{{ route('restaurant_store_menu') }}" method="POST"
                enctype="multipart/form-data" id="addMenuForm" onsubmit="showingLoading()" style="gap: 0px !important;">
                @csrf
                <input type="hidden" name="id_restaurant" id="id_restaurant"
                    value="{{ $restaurant->id_restaurant }}">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.Add Menu') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                        <div class="form-group mb-4">
                            <input type="text" class="frm-name form-control" id="name" name="name" placeholder="{{ __('user_page.Input name') }}">
                            <small style="display: none;" class="err-name invalid-feedback">{{ __('auth.empty_name') }}</small>
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="frm-price form-control" id="price" name="price"
                                placeholder="{{ __('user_page.Input price (number only)') }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <small style="display: none;" class="err-prc invalid-feedback">{{ __('auth.empty_price') }}</small>
                        </div>
                        <div class="form-group mb-4">
                            <textarea id="description" name="description" class="frm-desc form-control" style="height: 200px"></textarea>
                            <small style="display: none;" class="err-desc invalid-feedback">{{ __('auth.empty_desc') }}</small>
                        </div>
                        <div class="form-group mb-4">
                            <div class="file-upload" id="file-upload1">
                                <div class="image-add-res image-box dropzone">
                                    <p>{{ __('user_page.Upload Image') }}</p>
                                    <img style="width: 100%" src="" alt="">
                                </div>
                                <div class="controls" style="display: none;">
                                    <input id="imgRes" type="file" name="image" />
                                </div>
                            </div>
                            <small style="display: none;" class="err-img invalid-feedback">{{ __('auth.empty_img') }}</small>
                        </div>
                        {{-- <div class="form-group">
                            <input type="file" name="image" accept=".png,.jpg,.jpeg">
                        </div> --}}
                </div>
                <div class="modal-filter-footer d-flex justify-content-center"
                    style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                    <div class="col-4" style="text-align: center;">
                        <button type="submit" class="btn btn-sm btn-primary w-100" form="addMenuForm">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </form>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
<script>
    $(function() {
        $("#imgRes").on("change", function() {
            if (document.getElementById("imgRes").files.length != 0) {
                $(".image-add-res").css("border", "");
                $(".err-img").hide();
            }
        });
        $(".frm-name").on("keyup", function() {
            $('.frm-name').removeClass('is-invalid');
            $(".err-name").hide();
        });
        $(".frm-price").on("keyup", function() {
            $('.frm-price').removeClass('is-invalid');
            $("#err-prc").hide();
        });
        $(".frm-desc").on("keyup", function() {
            $('.frm-desc').removeClass('is-invalid');
            $(".err-desc").hide();
        });
        $("#addMenuForm").submit(function (e) {
            let error = 0;
            if(!$('.frm-name').val()) {
                $('.frm-name').addClass('is-invalid');
                $(".err-name").show();
                error = 1;
            } else {
                $('.frm-name').removeClass('is-invalid');
                $(".frm-name").hide();
            }
            if(!$('.frm-price').val()) {
                $('.frm-price').addClass('is-invalid');
                $(".err-prc").show();
                error = 1;
            } else {
                $('#price').removeClass('is-invalid');
                $("#err-prc").hide();
            }
            if(!$('.frm-desc').val()) {
                $('.frm-desc').addClass('is-invalid');
                $(".err-desc").show();
                error = 1;
            } else {
                $('.frm-desc').removeClass('is-invalid');
                $(".err-desc").hide();
            }
            if (document.getElementById("imgRes").files.length == 0) {
                $(".image-add-res").css("border", "solid #e04f1a 1px");
                $(".err-img").show();
                error = 1;
            } else {
                $(".image-add-res").css("border", "");
                $(".err-img").hide();
            }
            if(error == 1) {
                e.preventDefault();
            } else {

            }
        });
});
</script>
