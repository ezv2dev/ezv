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
                <form class="form-edit-contact-container" action="{{ route('activity_update_contact') }}" method="POST" enctype="multipart/form-data" id="updateContactForm" onsubmit="showingLoading()">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id_activity" id="id_activity" value="{{ $activity->id_activity }}">
                    <div class="form-group">
                        <label class="col-sm-4 col-form-label">{{ __('user_page.Phone') }}</label>
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="{{ __('user_page.phone') }}" maxlength="20" value="{{ $activity->phone ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 col-form-label">{{ __('user_page.Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" maxlength="50" value="{{ $activity->email ?? '' }}">
                    </div>
                </form>

                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-primary" form="updateContactForm">
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
<script>
    function edit_contact() {
        $('#modal-edit_contact').modal('show');
    }
</script>
