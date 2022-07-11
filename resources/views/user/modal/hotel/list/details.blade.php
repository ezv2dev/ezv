<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-details" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 60%;">
            <div class="modal-header bg-white" style="border-radius: 10px 10px 0px 0px; padding: 15px 32px;">
                <h5 id="content-details-name" style="margin: 0px;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white pb-1" style="padding: 19px 32px 32px 32px;">
                <p id="content-details-description" style="line-height: 1.6 !important;"></p>
                <p id="content-details-location"></p>
                <p id="content-details-type-of-room"></p>
            </div>
            <div class="modal-footer bg-white" style="border-radius: 0px 0px 10px 10px; border: none;">
            
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
<script>
    function view_details(id) {
        $.ajax({ //create an ajax request to display.php
            type: "GET",
            url: `/hotel/details/${id}`,
            success:(data) => {
                // console.log(data);
                $('#content-details-name').text(data.name);
                $('#content-details-description').text(data.description);
                $('#content-details-location').text(data.location.name);
                var typeOfRoom = '';
                data.hotel_room.forEach(type => {
                    typeOfRoom += `${type.hotel_type.name}, `;
                });
                $('#content-details-type-of-room').text(typeOfRoom);
                $('#modal-details').modal('show');
            }
        });

    }
</script>
