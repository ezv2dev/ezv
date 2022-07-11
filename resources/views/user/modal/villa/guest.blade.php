 <!-- Fade In Default Modal -->
 <div class="modal fade" id="modal-edit_guest" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{ __('user_page.Edit Guest') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-1" >
            <form action="{{ route('villa_update_guest') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">
                <div class="row mb-12">
                    <label class="col-sm-4 col-form-label" for="price">{{ __('user_page.Adults') }}</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="adult" name="adult" placeholder="{{ __('user_page.Adults') }}.." value="{{ $villa[0]->adult }}">
                    </div>
                </div>
                <br>
                <div class="row mb-12">
                    <label class="col-sm-4 col-form-label" for="price">{{ __("user_page.Children") }}</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="children" name="children" placeholder="{{ __("user_page.Children") }}.." value="{{ $villa[0]->children }}">
                    </div>
                </div>
                <br>
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-check"></i> {{ __("user_page.Save") }}
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
