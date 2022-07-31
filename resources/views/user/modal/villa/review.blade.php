<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-show_review" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 2rem !important;">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="overflow-y: unset;" class="modal-body pe-0" id="modalDescriptionVilla">
                <div class="col-12 d-flex">
                    <div class="col-4">
                        <div class="col-12 row">
                        @if ($detail->count() > 0)
                            <div class="col-6">
                                {{ __('user_page.Cleanliness') }}
                            </div>
                            <div class="col-6 px-0">
                                <div class="liner">
                                    <span class="liner-bar" style="width: {{ $detail[0]->average_clean * 20 }}%"></span>
                                </div>
                                <span>
                                    {{ $detail[0]->average_clean }}
                                </span>
                            </div>
                            <div class="col-6">
                                {{ __('user_page.Check In') }}
                            </div>
                            <div class="col-6 px-0">
                                <div class="liner">
                                    <span class="liner-bar" style="width: {{ $detail[0]->average_check_in * 20 }}%"></span>
                                </div>
                                <span>
                                    {{ $detail[0]->average_check_in }}
                                </span>
                            </div>
                            <div class="col-6">
                                {{ __('user_page.Value') }}
                            </div>
                            <div class="col-6 px-0">
                                <div class="liner">
                                    <span class="liner-bar" style="width: {{ $detail[0]->average_value * 20 }}%"></span>
                                </div>
                                <span>
                                    {{ $detail[0]->average_value }}
                                </span>
                            </div>
                            <div class="col-6">
                                {{ __('user_page.Service') }}
                            </div>
                            <div class="col-6 px-0">
                                <div class="liner">
                                    <span class="liner-bar" style="width: {{ $detail[0]->average_service * 20 }}%"></span>
                                </div>
                                <span>
                                    {{ $detail[0]->average_service }}
                                </span>
                            </div>
                            <div class="col-6">
                                {{ __('user_page.Location') }}
                            </div>
                            <div class="col-6 px-0">
                                <div class="liner">
                                    <span class="liner-bar" style="width: {{ $detail[0]->average_location * 20 }}%"></span>
                                </div>
                                <span>
                                    {{ $detail[0]->average_location }}
                                </span>
                            </div>

                        @else


                        @endif
                            
                        </div>
                    </div>
                    <div class="col-8" style="height: 510px; overflow-y: scroll;">
                        <div class="col-12 mb-4">
                            <div class="col-12 d-flex">
                                <div>
                                    <img style="width: 48px; height: 48px; border-radius: 50%;" src="https://images.unsplash.com/photo-1581382575275-97901c2635b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                                </div>
                                <div class="ms-3">
                                    <h6 class="m-0">
                                        David Jones
                                    </h6>
                                    <div>
                                        <p class="m-0">July 2022</p>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <p class="m-0">
                                    Martin, Flora and all the staff were amazing - they couldn’t have been more accommodating. The island is one of the most beautiful places we’ve ever been and perfect for a big family gathering - 21 of us! There is so much to see and do - we leave with wonderful memories and can’t recommend Floral Island highly enough. Thank you all yet again for your incredible hospitality!
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="col-12 d-flex">
                                <div>
                                    <img style="width: 48px; height: 48px; border-radius: 50%;" src="https://images.unsplash.com/photo-1581382575275-97901c2635b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                                </div>
                                <div class="ms-3">
                                    <h6 class="m-0">
                                        Christian
                                    </h6>
                                    <div>
                                        <p class="m-0">July 2022</p>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <p class="m-0">
                                    Martin, Flora and all the staff were amazing - they couldn’t have been more accommodating. The island is one of the most beautiful places we’ve ever been and perfect for a big family gathering - 21 of us! There is so much to see and do - we leave with wonderful memories and can’t recommend Floral Island highly enough. Thank you all yet again for your incredible hospitality!
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="col-12 d-flex">
                                <div>
                                    <img style="width: 48px; height: 48px; border-radius: 50%;" src="https://images.unsplash.com/photo-1581382575275-97901c2635b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                                </div>
                                <div class="ms-3">
                                    <h6 class="m-0">
                                        Tony Fernandes
                                    </h6>
                                    <div>
                                        <p class="m-0">July 2022</p>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <p class="m-0">
                                    Martin, Flora and all the staff were amazing - they couldn’t have been more accommodating. The island is one of the most beautiful places we’ve ever been and perfect for a big family gathering - 21 of us! There is so much to see and do - we leave with wonderful memories and can’t recommend Floral Island highly enough. Thank you all yet again for your incredible hospitality!
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="col-12 d-flex">
                                <div>
                                    <img style="width: 48px; height: 48px; border-radius: 50%;" src="https://images.unsplash.com/photo-1581382575275-97901c2635b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                                </div>
                                <div class="ms-3">
                                    <h6 class="m-0">
                                        Jamaludin
                                    </h6>
                                    <div>
                                        <p class="m-0">July 2022</p>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <p class="m-0">
                                    Martin, Flora and all the staff were amazing - they couldn’t have been more accommodating. The island is one of the most beautiful places we’ve ever been and perfect for a big family gathering - 21 of us! There is so much to see and do - we leave with wonderful memories and can’t recommend Floral Island highly enough. Thank you all yet again for your incredible hospitality!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
