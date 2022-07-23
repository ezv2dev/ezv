{{-- MODAL AMENITIES --}}
<div class="modal fade" id="modal-room" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-dialog-amenities" role="document" style="overflow-y: initial !important">
        <div class="modal-content modal-content-amenities" style="background: white; border-radius:15px">
            <div class="modal-header modal-header-amenities">
                <h5 class="modal-title">{{ __('user_page.All Amenities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-amenities pb-1 translate-text-group"
                style=" height: 500px; overflow-y: auto;">
                @php
                    $amenities = App\Http\Controllers\Hotel\HotelDetailController::amenities($hotel[0]->id_hotel);
                    $bathroom = App\Http\Controllers\Hotel\HotelDetailController::bathroom($hotel[0]->id_hotel);
                    $bedroom = App\Http\Controllers\Hotel\HotelDetailController::bedroom($hotel[0]->id_hotel);
                    $kitchen = App\Http\Controllers\Hotel\HotelDetailController::kitchen($hotel[0]->id_hotel);
                    $safety = App\Http\Controllers\Hotel\HotelDetailController::safety($hotel[0]->id_hotel);
                    $service = App\Http\Controllers\Hotel\HotelDetailController::service($hotel[0]->id_hotel);
                    echo '<div class="row-modal-amenities row-border-bottom">';
                    foreach ($amenities as $item) {
                        echo "<div class='col-md-6 mb-2'>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                    echo '';

                    echo '<div class="row-modal-amenities row-border-bottom padding-top-bottom-18px">';
                    echo '<div class="col-md-12"><h5 class="mb-3">' . __('user_page.Bathroom') . '</h5></div>';
                    foreach ($bathroom as $item) {
                        echo "<div class='col-md-6 '>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                    echo '';

                    echo '<div class="row-modal-amenities row-border-bottom padding-top-bottom-18px">';
                    echo '<div class="col-md-12"><h5 class="mb-3">' . __('user_page.Bedroom') . '</h5></div>';
                    foreach ($bedroom as $item) {
                        echo "<div class='col-md-6 '>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                    echo '';

                    echo '<div class="row-modal-amenities row-border-bottom padding-top-bottom-18px">';
                    echo '<div class="col-md-12"><h5 class="mb-3">' . __('user_page.Kitchen') . '</h5></div>';
                    foreach ($kitchen as $item) {
                        echo "<div class='col-md-8 '>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                    echo '';

                    echo '<div class="row-modal-amenities row-border-bottom padding-top-bottom-18px">';
                    echo '<div class="col-md-12"><h5 class="mb-3">' . __('user_page.Safety') . '</h5></div>';
                    foreach ($safety as $item) {
                        echo "<div class='col-md-6 '>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                    echo '';

                    echo '<div class="row-modal-amenities padding-top-bottom-18px">';
                    echo '<div class="col-md-12"><h5 class="mb-3">' . __('user_page.Service') . '</h5></div>';
                    foreach ($service as $item) {
                        echo "<div class='col-md-6 '>
                            <span class='translate-text-group-items'>" .
                            $item->name .
                            "</span>
                    </div>";
                    }
                    echo '</div>';
                @endphp
            </div>
            <div class="modal-filter-footer" style="height: 20px;">

            </div>
        </div>
    </div>
</div>
<script>
    function view_room() {
        $('#modal-room').modal('show');
        // console.log('hit amenities');
    }
</script>
