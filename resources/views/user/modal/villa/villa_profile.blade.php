<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_villa_profile" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Edit Image Profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="javascript:void();" method="POST" id="updateImageForm" class="js-validation"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">
                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone"
                                style="background-image: url({{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $villa[0]->image) }}); background-size: 500px;">
                                <img style="width: 100%" src="" alt="">
                            </div>
                            <div class="controls" style="display: none;">
                                <input id="imageVilla" type="file" name="image" accept=".jpg,.png,.jpeg,.webp" />
                            </div>
                        </div>
                        <small id="err-img" style="display: none;"
                            class="invalid-feedback">{{ __('auth.empty_img') }}</small>
                    </div>
                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <p class="text-danger" style="margin-top: -20px; margin-bottom: 0px;">Click the Image to
                                Upload
                            </p>
                            <button type="submit" class="btn btn-sm btn-primary" id="btnupdateImageForm">
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
