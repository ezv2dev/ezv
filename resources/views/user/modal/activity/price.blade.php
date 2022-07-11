<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_price" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-edit-menu-container" action="{{ route('activity_store_price') }}" method="POST"
                    enctype="multipart/form-data" id="addMenuForm" style="gap: 0px !important;">
                    @csrf
                    <input type="hidden" name="id_activity" id="id_activity" value="{{ $activity->id_activity }}">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Add Price') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('user_page.name') }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" id="price" name="price" placeholder="{{ __('user_page.price') }}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required>
                    </div>
                    <div class="mb-4" style="display: flex;">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="date" class="form-control"
                                    name="start_date" placeholder="{{ __('user_page.Start Date') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="date" class="form-control"
                                    name="end_date" placeholder="{{ __('user_page.End Date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <textarea id="description" name="description" class="form-control" style="height: 200px"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>{{ __('user_page.Upload Image') }}</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                            <div class="controls" style="display: none;">
                                <input type="file" name="image" accept=".jpeg,.png,.jpg,.webp"/>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <input type="file" name="image" accept=".png,.jpg,.jpeg">
                    </div> --}}
                <!-- END Submit -->
            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-sm btn-primary w-100" form="addMenuForm">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
