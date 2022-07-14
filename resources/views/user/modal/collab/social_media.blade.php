<!-- Fade In Default Modal -->
<div class="modal fade" id="modalSocialMedia" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Social Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('collab_update_social_media') }}" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="instagram_name">Instagram <i
                                class="fab fa-instagram"></i> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="instagram_name"
                                name="instagram_name" placeholder="Instagram Name" value="">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="instagram_follower"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="instagram_follower"
                                name="instagram_follower" placeholder="Instagram Follower" value=""
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="facebook_name">Facebook <i
                                class="fab fa-facebook"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="facebook_name"
                                name="facebook_name" placeholder="Facebook Name" value="">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="facebook_follower"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="facebook_follower"
                                name="facebook_follower" placeholder="Facebook Follower" value=""
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="twitter_name">Twitter <i
                                class="fab fa-twitter"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="twitter_name" name="twitter_name"
                                placeholder="Twitter Name" value="">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="twitter_follower"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="twitter_follower"
                                name="twitter_follower" placeholder="Twitter Follower" value=""
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="tiktok_name">Tiktok <i
                                class="fab fa-tiktok"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="tiktok_name" name="tiktok_name"
                                placeholder="Tiktok Name" value="">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="tiktok_follower"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="tiktok_follower"
                                name="tiktok_follower" placeholder="Tiktok Follower" value=""
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-sm btn-primary" style="width: 200px;">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- END Submit -->
                <br>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
