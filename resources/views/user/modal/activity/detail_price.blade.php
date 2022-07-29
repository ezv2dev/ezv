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

    .sticky-div-modal {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: white;
    }

    .image-content {
        border-radius: 25px;
        height: 400px;
    }
</style>

{{-- MODAL AMENITIES --}}
<div class="modal fade reset-padding" id="modal-room" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: white;">
            <div class="modal-header modal-header-amenities">
                <h5 class="modal-title">Price Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-amenities pb-1 translate-text-group"
                style=" height: 500px; overflow-y: auto;">
                {{-- PROFILE --}}
                <div class="d-flex">
                    {{-- RIGHT CONTENT --}}
                    <div class="col-lg-5 col-md-5 col-xs-12 rsv-block alert-detail">
                        <img class="image-content" id="imageProfileHotelRoom"
                            src="{{ URL::asset('/template/villa/template_profile.jpg') }}">
                    </div>
                    <div class="col-lg-7 col-md-7 col-xs-12 rsv-block alert-detail">
                        <div style="margin-left: 20px;">
                            <h2>Price</h2>
                            <div class="price-tag">
                                <h6 class="price-current mb-0">IDR {{ number_format(500000) }}</h6>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic iure vitae inventore, quas
                                modi
                                quibusdam laboriosam, consectetur quis quidem culpa et nihil est, fugiat recusandae
                                veniam
                                impedit illum quae unde.</p>
                        </div>
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
    function open_detail_price() {
        $('#modal-room').modal('show');
    }
</script>

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
