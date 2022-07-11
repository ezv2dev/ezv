<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-promotion-mobile" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="margin-top: 55px !important">
        <div class="modal-content" style="width: 750px !important;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div class="card bg-dark text-white w-100"
                    style="font-family: 'Poppins', sans-serif; border-radius: 14px;">
                    <img class="card-img" style="border-radius: 14px;"
                        src="{{ URL::asset('assets/media/photos/desktop/app.webp') }}">
                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                        <div class="row text-center">
                            <p class="text-white" style="font-size: 62px;">
                                {{ __('user_page.Download The App') }}
                            </p>
                            <p class="text-white">
                                {{ __('user_page.Unlock all the features today') }}
                            </p>
                            <div>
                                <a href="https://www.apple.com/id/app-store/" target="_blank">
                                    <img style="width:18%;"
                                        src="{{ URL::asset('assets/media/photos/desktop/app-store-badge.svg') }}">
                                </a>
                                <a href="https://play.google.com/" target="_blank">
                                    <img style="width:21%;"
                                        src="{{ URL::asset('assets/media/photos/desktop/google-play-badge.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
<script>
    function showPromotionMobile() {
        $('#modal-promotion-mobile').modal('show');
    }
</script>
