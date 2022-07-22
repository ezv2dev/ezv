<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_contact" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Edit Contact') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                {{-- <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" id="updateContactForm"> --}}
                    {{-- @csrf
                    @method('patch') --}}
                    <input type="hidden" name="id_restaurant" id="id_restaurant" value="{{ $restaurant->id_restaurant }}">
                    <div class="form-group">
                        <label class="col-sm-4 col-form-label">{{ __('user_page.Phone') }}</label>
                        <input type="number"
                        onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" class="form-control"
                        id="phoneResto" name="phone" placeholder="{{ __('user_page.phone') }}" maxlength="13" value="{{ $restaurant->phone ?? '' }}">
                        <small id="err-phone" style="display: none;" class="invalid-feedback">{{ __('auth.empty_phone') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 col-form-label">{{ __('user_page.Email') }}</label>
                        <input type="text" class="form-control" id="emailResto" name="email" placeholder="email@example.com" maxlength="50" value="{{ $restaurant->email ?? '' }}">
                        <small id="err-email" style="display: none;" class="invalid-feedback">{{ __('auth.empty_mail') }}</small>
                    </div>
                {{-- </form> --}}

                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-primary" id="btnSaveContactResto">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

