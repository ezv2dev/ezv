<!-- Fade In Default Modal -->
<div class="modal fade" id="modalSocialMedia" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Social Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div id="saveSocialMediaForm">
                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="instagram_link">Instagram <i
                                class="fab fa-instagram"></i> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="instagram_link"
                                name="instagram_link" placeholder="Instagram Link"
                                value="{{ $profile->collaboratorSocial->instagram_link ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="instagram_follower"></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="instagram_follower"
                                name="instagram_follower" placeholder="Instagram Follower"
                                value="{{ $profile->collaboratorSocial->instagram_follower ?? '' }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="facebook_link">Facebook <i
                                class="fab fa-facebook"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="facebook_link"
                                name="facebook_link" placeholder="Facebook Link"
                                value="{{ $profile->collaboratorSocial->facebook_link ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="facebook_follower"></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="facebook_follower"
                                name="facebook_follower" placeholder="Facebook Follower"
                                value="{{ $profile->collaboratorSocial->facebook_follower ?? '' }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="twitter_link">Twitter <i
                                class="fab fa-twitter"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="twitter_link" name="twitter_link"
                                placeholder="Twitter Link"
                                value="{{ $profile->collaboratorSocial->twitter_link ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="twitter_follower"></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="twitter_follower"
                                name="twitter_follower" placeholder="Twitter Follower"
                                value="{{ $profile->collaboratorSocial->twitter_follower ?? '' }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="tiktok_link">Tiktok <i
                                class="fab fa-tiktok"></i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modal-input" id="tiktok_link" name="tiktok_link"
                                placeholder="Tiktok Link"
                                value="{{ $profile->collaboratorSocial->tiktok_link ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-12 margin-bottom-12px">
                        <label class="col-sm-4 col-form-label" for="tiktok_follower"></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control modal-input" id="tiktok_follower"
                                name="tiktok_follower" placeholder="Tiktok Follower"
                                value="{{ $profile->collaboratorSocial->tiktok_follower ?? '' }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" id="btnSaveSocialMedia" onclick="saveSocialMedia()" class="btn btn-sm btn-primary" style="width: 200px;">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                            </button>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
