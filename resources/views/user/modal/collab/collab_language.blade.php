<!-- Modal Checkbox-->
<div id="saveLanguageForm">
    <div class="modal fade" id="collab_language_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Languages I speak</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="header-description mb-3">
                    <span class="text-dark" style="font-size: 11pt;">We have many international travelers who appreciate influencer who can speak their language.</span>
                </div>

                {{-- <form action="{{ route('collab_update_language') }}" method="post">
                    @csrf --}}
                    <input type="hidden" name="id_collab" value="{{ $profile->id_collab }}">
                    @foreach ($languages as $item)
                    <div id="check_lang" class="form-check">
                        @php
                            $isChecked = "";
                            foreach ($owner_language as $owner_lang) {
                                if($item->id_host_language == $owner_lang->id_language) {
                                    $isChecked = "checked";
                                }
                            }
                        @endphp
                        <input class="form-check-input check-lang" type="checkbox" name="language[]" id="languages" style="width: 20px;
                        height: 20px;" value="{{ $item->id_host_language }}" {{ $isChecked }}>
                        <label class="form-check-label" style="margin-left: 10px; margin-top: 3px;">
                        {{$item->name}}
                        </label>
                    </div>
                    @endforeach
                    <small id="err-slc-lang" style="display: none;" class="invalid-feedback">Select one language</small><br>
                    <button type="submit" class="btn btn-primary float-right" id="btnSaveLanguage" onclick="saveLanguage()">Save</button>
                {{-- </form> --}}

            </div>
            {{-- <div class="modal-footer"> --}}
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}

            {{-- </div> --}}
        </div>
        </div>
    </div>
</div>
<!-- Modal Checkbox-->
