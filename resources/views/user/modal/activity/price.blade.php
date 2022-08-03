<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_price" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <form class="form-edit-menu-container" action="javascript:void(0)" method="POST"
                enctype="multipart/form-data" id="addPriceForm" style="gap: 0px !important;">
                {{-- @csrf --}}
                <input type="hidden" name="id_activity" id="id_activity" value="{{ $activity->id_activity }}">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('user_page.Add Price') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                    <p class="modal-title">Name</p>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Input name here">
                        <small id="err-xname" style="display: none;" class="invalid-feedback">{{ __('auth.empty_name') }}</small>
                    </div>
                    <p class="modal-title">Price</p>
                    <div class="form-group mb-4">
                        <input type="text" style="margin-top: 0;" class="form-control" id="xprice" name="price"
                            placeholder="Input price here"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <small id="err-price" style="display: none;" class="invalid-feedback">{{ __('auth.empty_price') }}</small>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                            <p class="modal-title">Start Date</p>
                            <div class="form-group">
                                <input type="date" class="form-control" name="start_date" id="startDate"
                                    placeholder="{{ __('user_page.Start Date') }}">
                                <small id="err-sdateprc" style="display: none;" class="invalid-feedback">{{ __('auth.empty_sdate') }}</small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <p class="modal-title">End Date</p>
                            <div class="form-group">
                                <input type="date" class="form-control" name="end_date" id="endDate"
                                    placeholder="{{ __('user_page.End Date') }}">
                                <small id="err-edateprc" style="display: none;" class="invalid-feedback">{{ __('auth.empty_edate') }}</small>
                            </div>
                        </div>
                    </div>

                    <p class="modal-title">Description</p>
                    <div class="form-group mb-4">
                        <textarea id="xdescription" name="description" class="form-control" style="height: 200px"
                            placeholder="Input Description here"></textarea>
                        <small id="err-descprc" style="display: none;" class="invalid-feedback">{{ __('auth.empty_desc') }}</small>
                    </div>

                    <p class="modal-title">Image</p>
                    <div class="form-group mb-4">
                        <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>{{ __('user_page.Upload Image') }}</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                            <small id="err-imgprc" style="display: none;" class="invalid-feedback">{{ __('auth.empty_img') }}</small>
                            <div class="controls" style="display: none;">
                                <input id="imgPrice" type="file" name="image" accept=".jpeg,.png,.jpg,.webp" />
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
                        <button type="submit" id="btnSavePrice" class="btn btn-sm btn-primary w-100"
                            form="addPriceForm">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
