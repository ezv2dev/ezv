<div class="modal fade" id="modal-edit_short_description" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Short Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('restaurant_update_short_description') }}" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                    <div class="row mb-12">
                        <label class="col-form-label" for="short_description">Short Description</label>
                        <div class="">
                            <input type="text-area" class="form-control" id="short_description" name="short_description"
                                placeholder="Input Short Description" value="{{ $restaurant->short_description }}" maxlength="255">
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7 mt-4">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
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
