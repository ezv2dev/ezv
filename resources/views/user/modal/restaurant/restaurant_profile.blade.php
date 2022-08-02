<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_restaurant_profile" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Edit Image Profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="javascript:void();" method="POST" id="updateImageForm" class="js-validation"
                    enctype="multipart/form-data">

                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>{{ __('user_page.Upload Image') }}</p>
                                <img id="profileDropzone" style="width: 100%" src="" alt="">
                            </div>
                                <div class="controls" style="display: none;">
                                <input id="imageRestaurant" type="file" name="image" accept=".jpg,.png,.jpeg,.webp"/>
                            </div>
                        </div>
                        <small id="err-img" style="display: none;" class="invalid-feedback">{{ __('auth.empty_img') }}</small>
                    </div>
                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button id="btnupdateImageForm" type="submit" class="btn btn-sm btn-primary" form="updateImageForm">
                                {{ __('user_page.Save Image') }}
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
