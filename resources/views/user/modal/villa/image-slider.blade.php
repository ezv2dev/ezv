<!-- Fade In Default Modal -->
<style>
    .modal-header-photo {
        background: #000;
    }
    .modal-content-photo {
        display: flex;
        flex-direction: column;
        background: #000;
        border: none;
        border-radius: 0;
        margin-bottom: -100px;
    }
    .btn-close-modal-photo {
        width: 100%;
        background: none !important;
        border: none;
        display: flex;
        padding: 25px 15px;
        justify-content: right;
    }
    .modal-gallery {
        background: #000;
    }
    .modal-gallery img {
        min-width: 100%;
        border: solid 1px #cbcbcb;
        object-fit: cover;
        aspect-ratio: 1/1.2;
        margin: 20px 0;
    }
    .modal-fullwidth {
        margin: 50px 0;
    }
    .fa-xlose::after {
        content: '\58';
        color: #c1c1c1;
    }
    .fade:not(.show) {
        opacity: 1;
    }
</style>

<!-- <div id="modal-photo-gallery" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullwidth modal-lg" role="document">
        <div class="modal-content-photo">
            <div class="modal-header-photo">
            <button type="button" class="btn-close-modal-photo" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xlose"></i></button>
            </div>
            <div class="modal-body-gallery">

                @if ($photo->count() > 0)
                    @foreach ($photo->sortBy('order') as $item)
                    <div id="{{ $item->id_photo }}">
                        <div class="modal-gallery">
                            <img id="displayPhoto{{ $item->id_photo }}" class="lozad-gallery-load lozad-gallery"
                                    src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}"
                                    title="{{ $item->caption }}">
                            </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div> -->


<div id="modal-photo-gallery" class="modal" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Photo Gallery</h5>
        <button type="button" class="btn-close" onClick="closeModalGalleryMobile()"></button>
      </div>
      <div class="modal-body" style="height: 100vh; overflow-y: auto;">
                @if ($photo->count() > 0)
                    @foreach ($photo->sortBy('order') as $item)
                    <div id="{{ $item->id_photo }}">
                        <div class="modal-gallery">
                            <img id="displayPhoto{{ $item->id_photo }}" class="lozad-gallery-load lozad-gallery"
                                    src="{{ URL::asset('/foto/gallery/' . $villa[0]->uid . '/' . $item->name) }}"
                                    title="{{ $item->caption }}">
                            </div>
                    </div>
                    @endforeach
                @endif
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<script>
    function closeModalGalleryMobile() {
        $('#modal-photo-gallery').modal('hide');
    }
    function openModalGalleryMobile(id_photo) {
        $('#modal-photo-gallery').modal('show');
        var position = $('#' + id_photo).position();
        $("#modal-photo-gallery").find('.modal-body').scrollTop(position.top);
    }
</script>
<!-- <script>
    $('#modal-photo-gallery').on('shown.bs.modal', function(event) {
    var section = $(event.relatedTarget).data('section');
    var position = $('#' + section).position();
    $("#modal-photo-gallery").find('.modal-body').eq(0).scrollTo(position.scrollTop());
    console.log('hit event modal');
    });
</script> -->