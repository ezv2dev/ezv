<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_bedroom" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">{{ __('user_page.Edit Bedroom, Bathroom, Adult, & Children') }}</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('hotel_update_bedroom') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel[0]->id_hotel }}">

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Bedroom') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="bedroom" name="bedroom"
                                placeholder="{{ __('user_page.Bedroom') }}.."
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="{{ $hotel[0]->bedroom }}" required>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Bathroom') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="bathroom" name="bathroom"
                                placeholder="{{ __('user_page.Bathroom') }}.."
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="{{ $hotel[0]->bathroom }}" required>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="adult">{{ __('user_page.Adults') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="adult" name="adult"
                                placeholder="{{ __('user_page.Adults') }}.." value="{{ $hotel[0]->adult }}" required>
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="children">{{ __('user_page.Children') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="children" name="children"
                                placeholder="{{ __('user_page.Children') }}.." min="0" value="{{ $hotel[0]->children }}" required>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: end;">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
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
