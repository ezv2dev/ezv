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
<div class="modal fade reset-padding" id="modalPriceDetail" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
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
                        <img class="image-content" id="imagePriceModal"
                            src="{{ URL::asset('/template/villa/template_profile.jpg') }}">
                    </div>
                    <div class="col-lg-7 col-md-7 col-xs-12 rsv-block alert-detail">
                        <div style="margin-left: 20px;">
                            <h2 id="priceName">Price</h2>
                            <div class="price-tag">
                                <h6 class="price-current mb-0" id="priceModal">IDR {{ number_format(500000) }}</h6>
                            </div>
                            <p id="descPriceModal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic iure
                                vitae
                                inventore, quas
                                modi
                                quibusdam laboriosam, consectetur quis quidem culpa et nihil est, fugiat recusandae
                                veniam
                                impedit illum quae unde.</p>
                            <p><b id="startDateModal"></b>-<b id="endDateModal"></b></p>
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
    function view_price(id) {
        $.ajax({
            type: "GET",
            url: '/wow/price/' + id,
            success: function(response) {
                // console.log(response);
                // console.log(response.data.price.toLocaleString());
                let path = "/foto/activity/";
                let slash = "/";
                let uid = response.data.activity.uid;
                var lowerCaseUid = uid.toLowerCase();
                // console.log(path + lowerCaseUid + slash + response.data.foto);
                $('#imagePriceModal').attr("src", path + lowerCaseUid + slash + response.data.foto);
                $('#priceName').html(response.data.name);
                $('#priceModal').html(`IDR ${response.data.price.toLocaleString()}`);
                $('#descPriceModal').html(response.data.description);
                $('#startDateModal').html(response.data.start_date);
                $('#endDateModal').html(response.data.end_date);
                $('#modalPriceDetail').modal('show');
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
