<!-- Fade In Default Modal -->
<style>
/* Code here */
</style>

<div id="advertListing-Modal" class="modal fade bs-example-modal-lg" style="font-family: 'Poppins' !important">
    <div class="modal-dialog" style="overflow-y: initial !important;">
        <div class="modal-content" style="border-radius:15px;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body modal-body3">
                <h1>{{ __("user_page.Tell Your Friends Now") }}</h1>
                <p>{{ __("user_page.Maybe your friends are looking for a place to promote their products. Here is the best place for listing villas, restaurants, hotels and their activities.") }} <strong>{{ __("user_page.It's FREE") }}</strong></p>
                <div class="modal-share-container">
                    <div class="col-lg col-12 p-3 border br-10">
                        <a type="button" class="d-flex p-0 copier" href="{{ route('ahost') }}" onclick="copyURI(event)">
                            {{ __('user_page.Copy Link') }}
                        </a>
                    </div>
                    <div class="col-lg col-12 p-3 border br-10">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('ahost') }}&display=popup"
                            target="_blank" class="d-flex p-0">
                            <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                    class="fw-normal">Facebook</span></div>
                        </a>
                    </div>
                    <div class="col-12 p-3 border br-10">
                        <a href="https://api.whatsapp.com/send?text={{ route('ahost') }}"
                            target="_blank" class="d-flex p-0">
                            <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                    class="fw-normal">WhatsApp</span></div>
                        </a>
                    </div>
                    <div class="col-12 p-3 border br-10">
                        <a href="https://telegram.me/share/url?url={{ route('ahost') }}&text={{ route('ahost') }}"
                            target="_blank" class="d-flex p-0">
                            <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                    class="fw-normal">Telegram</span></div>
                        </a>
                    </div>
                    <div class="col-12 p-3 border br-10">
                        <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('ahost') }}"
                            target="_blank" class="d-flex p-0">
                            <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                    class="fw-normal">Email</span></div>
                        </a>
                    </div>
                </div>
                <hr>
                <form class="dont-show" action="">
                <input type="checkbox" id="dont-show" name="dont-show" value="Dont show" onclick="dontShowAdvertListing()">
                <label for="dont-show">{{ __("user_page.Don't show it again") }}</label>
                {{-- <input type="submit" value="CLOSE"> --}}
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    if(localStorage.getItem("shareAdver") && localStorage.getItem("shareAdver") == 'true'){
        $('#advertListing-Modal').find('#dont-show').prop('checked', 'true');
    } else {
        localStorage.setItem("shareAdver", "false");
    }
    function dontShowAdvertListing() {
        var isChecked = $('#advertListing-Modal').find('#dont-show').prop('checked');
        console.log(isChecked);
        if(isChecked) {
            localStorage.setItem("shareAdver", "true");
        } else {
            localStorage.setItem("shareAdver", "false");
        }
    }
</script>
