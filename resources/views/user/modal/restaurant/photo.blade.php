<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_photo" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('restaurant_store_photo') }}" method="POST" enctype="multipart/form-data" id="storePhotoForm">
                    @csrf
                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>Upload Image/Video</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                                <div class="controls" style="display: none;">
                                <input type="file" name="file" accept=".jpg,.jpeg,.png,.mp4" required/>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <!-- Submit -->
                <br>
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" form="storePhotoForm" class="btn btn-sm btn-primary">
                            <i class="fa fa-check"></i> Upload
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
