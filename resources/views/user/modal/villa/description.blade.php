<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-show_description" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 2rem !important;">
                <h5 class="modal-title">{{ __('user_page.Description') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1rem 2rem 2rem 2rem !important;" id="modalDescriptionVilla">
                {!! $villa[0]->description !!}
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
