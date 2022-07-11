<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_hotel_profile" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Edit Image Profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('hotel_update_image') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data" onsubmit="showingLoading()">
                    @csrf
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel[0]->id_hotel }}">
                    {{-- <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="price"><b>Image Profile</b></label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="editUpload">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>{{ __('user_page.Upload Image') }}</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                            <div class="controls" style="display: none;">
                                <input type="file" name="image" accept=".jpg,.png,.jpeg,.webp" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-sm btn-primary">
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
