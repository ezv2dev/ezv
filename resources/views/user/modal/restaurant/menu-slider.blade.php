<!-- Fade In Default Modal -->
<style>
    .modal-menu-gallery img {
        min-width: 100%;
        height: auto;
        border: solid 1px #cbcbcb;
        margin: 20px 0;
    }
</style>
<!-- <div id="modal-menu-gallery" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullwidth modal-lg" role="document">
        <div class="modal-content-photo">
            <div class="modal-header-photo">
            <button type="button" class="btn-close-modal-photo" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xlose"></i></button>
            </div>
            <div class="modal-body-gallery">
                @if ($restaurant->menu->count() > 0)
                    @foreach ($restaurant->menu as $menu)
                    <div id="{{ $menu->id_menu }}">
                        <div class="modal-menu-gallery">
                            <img id="displayMenu{{ $menu->id_menu }}" class="lozad-gallery-load lozad-gallery"
                                    src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . 'menu/' . $menu->foto) }}"
                                    title="{{ $menu->name }}">
                            </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div> -->


<div id="modal-menu-gallery" class="modal" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Menu Gallery</h5>
        <button type="button" class="btn-close" onClick="closeModalMenuMobile()"></button>
      </div>
      <div class="modal-body" style="height: 100vh; overflow-y: auto;">
            @if ($restaurant->menu->count() > 0)
                    @foreach ($restaurant->menu as $menu)
                    <div id="{{ $menu->id_menu }}">
                        <div class="modal-menu-gallery">
                            <img id="displayMenu{{ $menu->id_menu }}" class="lozad-gallery-load lozad-gallery"
                                    src="{{ URL::asset('/foto/restaurant/' . strtolower($restaurant->uid) . '/' . 'menu/' . $menu->foto) }}"
                                    title="{{ $menu->name }}">
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
    function closeModalMenuMobile() {
        $('#modal-menu-gallery').modal('hide');
    }
    function openModalMenuMobile(id_photo) {
        $('#modal-menu-gallery').modal('show');
        var position = $('#' + id_photo).position();
        $("#modal-menu-gallery").find('.modal-body').scrollTop(position.top);
    }
</script>
