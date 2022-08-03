<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-show_review" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-noscroll" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="overflow-auto modal-body pe-lg-0" id="modalDescriptionVilla">
                <div class="col-12 d-lg-flex">
                    <div class="col-12 col-lg-4">
                        <div class="col-12 row">
                            @if ($restaurant->detailReview)
                                <div class="col-6">
                                    {{ __('user_page.Food') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $restaurant->detailReview->average_food * 20 }}%"></span>
                                    </div>
                                    {{ $restaurant->detailReview->average_food }}
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Service') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $restaurant->detailReview->average_service * 20 }}%"></span>
                                    </div>
                                    {{ $restaurant->detailReview->average_service }}
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Value') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $restaurant->detailReview->average_value * 20 }}%"></span>
                                    </div>
                                    {{ $restaurant->detailReview->average_value }}
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Atmosphere') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $restaurant->detailReview->average_atmosphere * 20 }}%"></span>
                                    </div>
                                    {{ $restaurant->detailReview->average_atmosphere }}
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-4 mt-lg-0 col-lg-8 review-comment-container">
                        @foreach ($restaurant->detailComment as $item)
                            <div class="col-12 mb-4">
                                <div class="col-12 d-flex">
                                    <div>
                                        @if ($item->user->foto_profile != null)
                                            <img class="review-user-profile-pic"
                                                src="{{ asset('foto_profile/' . $item->user->foto_profile) }} ">
                                        @elseIf ($item->user->avatar != null)
                                            <img class="review-user-profile-pic" src="{{ $item->user->avatar }}">
                                        @else
                                            <img class="review-user-profile-pic"
                                                src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="m-0">
                                            {{ $item->user->name }}
                                        </h6>
                                        <div>
                                            <p class="m-0">{{ date_format($item->created_at, 'M Y') }}</p>
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                                <div class="col-12 pt-3">
                                    <p class="m-0">
                                        {{ $item->comment }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
