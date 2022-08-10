<!-- Fade In Default Modal -->
<style>
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

<div id="modal-photo-gallery" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullwidth modal-lg" role="document">
        <div class="modal-content-photo">
            <div class="modal-header">
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
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
