<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-show_review" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="overflow-auto modal-body pe-lg-0" id="modalDescriptionVilla">
                <div class="col-12 d-lg-flex">
                    <div class="col-12 col-lg-4">
                        <div class="col-12 row">
                            @if ($detail->count() > 0)
                                <div class="col-6">
                                    {{ __('user_page.Cleanliness') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $detail[0]->average_clean * 20 }}%"></span>
                                    </div>
                                    <span>
                                        {{ $detail[0]->average_clean }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Check In') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $detail[0]->average_check_in * 20 }}%"></span>
                                    </div>
                                    <span>
                                        {{ $detail[0]->average_check_in }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Value') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $detail[0]->average_value * 20 }}%"></span>
                                    </div>
                                    <span>
                                        {{ $detail[0]->average_value }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Service') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $detail[0]->average_service * 20 }}%"></span>
                                    </div>
                                    <span>
                                        {{ $detail[0]->average_service }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    {{ __('user_page.Location') }}
                                </div>
                                <div class="col-6 px-0">
                                    <div class="liner-modal">
                                        <span class="liner-bar"
                                            style="width: {{ $detail[0]->average_location * 20 }}%"></span>
                                    </div>
                                    <span>
                                        {{ $detail[0]->average_location }}
                                    </span>
                                </div>
                            @else
                            @endif

                        </div>
                    </div>
                    <div class="col-12 mt-4 mt-lg-0 col-lg-8 review-comment-container">
                        @foreach ($hotel[0]->detailComment as $item)
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
