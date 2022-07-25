<style>
    .reset-padding {
        padding: 0 !important;

    }

    .reset-margin {
        margin: 0 !important;
    }

    .modal-full {
        width: 100%;
        height: 100%;
    }

    .sticky-div-modal
    {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: white;
    }

    .padding-content
    {
        padding-left: 100px;
        padding-right: 100px;
    }
</style>

{{-- MODAL AMENITIES --}}
<div class="modal fade reset-padding" id="modal-room" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-amenities" role="document" style="overflow-y: initial !important">
        <div class="modal-content modal-content-amenities reset-margin modal-full"
            style="background: white; border-radius:15px">
            <div class="modal-header modal-header-amenities">
                <h5 class="modal-title">Room Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-amenities pb-1 translate-text-group"
                style=" height: 500px; overflow-y: auto;">
                {{-- PROFILE --}}
                <div class="row page-content padding-content">
                    {{-- LEFT CONTENT --}}
                    <div class="col-lg-4 col-md-4 col-xs-12 rsv-block alert-detail">
                        <h2 id="detail-room-type"></h2>
                        <p>
                            <i class="fas fa-expand"></i> <span id="detail-room-size"></span> m<sup>2</sup><br>
                            <i class="fas fa-user-friends"></i> <span id="detail-room-capacity"></span> {{ __('user_page.People') }}<br>
                            <i class="fas fa-bed"></i> <span id="detail-room-bed"></span> {{ __('user_page.Beds') }}<br>
                            <i class="fas fa-door-open"></i> <span id="detail-room-total"></span> {{ __('user_page.Rooms') }}
                        </p>

                        <h2>Room Amenities</h2>
                        <h4><i class="fas fa-shower"></i> Bathroom</h4>
                        <ul style="list-style-type:circle">
                            <li>Apples</li>
                            <li>Bananas</li>
                            <li>Lemons</li>
                            <li>Oranges</li>
                        </ul>

                        <h4><i class="fas fa-bed"></i> Bedroom</h4>
                        <ul style="list-style-type:circle">
                            <li>Apples</li>
                            <li>Bananas</li>
                            <li>Lemons</li>
                            <li>Oranges</li>
                        </ul>

                        <h4><i class="fas fa-utensils"></i> Food and Drink</h4>
                        <ul style="list-style-type:circle">
                            <li>Apples</li>
                            <li>Bananas</li>
                            <li>Lemons</li>
                            <li>Oranges</li>
                        </ul>

                        <h4><i class="fas fa-shield"></i> Safety</h4>
                        <ul style="list-style-type:circle">
                            <li>Apples</li>
                            <li>Bananas</li>
                            <li>Lemons</li>
                            <li>Oranges</li>
                        </ul>

                        <h4><i class="fas fa-hand-sparkles"></i> Service</h4>
                        <ul style="list-style-type:circle">
                            <li>Apples</li>
                            <li>Bananas</li>
                            <li>Lemons</li>
                            <li>Oranges</li>
                        </ul>
                    </div>
                    {{-- END LEFT CONTENT --}}

                    {{-- RIGHT CONTENT --}}
                    <div class="col-lg-8 col-md-8 col-xs-12 rsv-block alert-detail">
                        jasndkasndkjasdn
                    </div>
                    {{-- END RIGHT CONTENT --}}
                </div>
            </div>
            <div class="modal-filter-footer" style="height: 20px;">

            </div>
        </div>
    </div>
</div>
<script>
    function view_room(id) {
        $.ajax({
            type: "GET",
            url: '/hotel/room/' + id,
            success: function(data) {
                $('#detail-room-type').html(data.type_room);
                $('#detail-room-size').html(data.room_size);
                $('#detail-room-capacity').html(data.capacity);
                $('#detail-room-bed').html(data.bed_type);
                $('#detail-room-total').html(data.number_of_room);
                $('#modal-room').modal('show');
            },
            error: function(jqXHR, exception) {
                if (jqXHR.responseJSON.errors) {
                    for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.errors[i],
                            position: "topRight",
                        });
                    }
                } else {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message,
                        position: "topRight",
                    });
                }

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
            },
        })
    }
</script>
