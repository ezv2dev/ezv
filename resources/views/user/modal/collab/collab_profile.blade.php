<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_collab_profile" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Image Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="javascript:void()" method="POST" id="updateImageForm"
                    class="js-validation" enctype="multipart/form-data">
                {{-- <form action="{{ route('collab_update_image') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data" onsubmit="showingLoading()"> --}}
                    @csrf
                    <input type="hidden" name="id_collab" id="id_collab" value="{{ $profile->id_collab }}">

                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>Upload Image</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                            <div class="controls" style="display: none;">
                                <input id="imageCollab" type="file" name="image" accept=".jpg,.png,.jpeg,.webp" />
                            </div>
                        </div>
                        <small id="err-img" style="display: none;" class="invalid-feedback">{{ __('auth.empty_img') }}</small>
                    </div>
                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7" style="margin-left: 150px;">
                            <button type="submit" class="btn btn-sm btn-primary" id="btnupdateImageForm">
                                Save Image
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
