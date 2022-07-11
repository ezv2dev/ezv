<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_story" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ Translate::translate('Story') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('activity_price_store_story') }}" method="POST" enctype="multipart/form-data"
                    id="storeStoryForm">
                    @csrf
                    <input type="hidden" name="id_price" id="id_price" value="{{ $activityPrice->id_price }}">
                    <div class="form-group">
                        <div class="story-upload">
                            <div class="story-video-form dropzone">
                                <p>{{ Translate::translate('Upload Video') }}</p>
                            </div>
                            <div class="story-video-preview" style="display: none;">
                            <div style="display: flex; align-items: center; margin-bottom: 9px;">
                                <button type="button" class="button-choose-other btn btn-primary">{{ Translate::translate('choose another') }}</button>
                                <button class="button-reset" type="reset">
                                    {{ Translate::translate('remove') }}
                                </button>
                            </div>
                                <video class="w-100 story-upload-video-preview" controls>
                                    {{-- <source src="movie.mp4" type="video/mp4"> --}}
                                        {{ Translate::translate('Your browser does not support the video tag.') }}
                                </video>
                            </div>
                            <div class="story-video-input" style="display: none;">
                                <input type="file" name="file" accept=".mp4" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group story-title-gap">
                        <input type="text" class="form-control" name="title" id="title" placeholder="{{ Translate::translate('Title') }}"
                            required="required">
                    </div>
                </form>


                <!-- Submit -->

                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-primary" form="storeStoryForm">
                            <i class="fa fa-check"></i> {{ Translate::translate('Upload') }}
                        </button>
                    </div>
                </div>

                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

{{-- VIDEO UPLOAD --}}
<script>
    var storyVideoForm = $(".story-upload").children('.story-video-form');
    var storyVideoInput = $(".story-upload").children('.story-video-input');
    var storyVideoPreview = $(".story-upload").children(".story-video-preview");
    var storyChooseOtherInput = $(storyVideoPreview).children('div').children(".button-choose-other");
    var storyResetInput = $(storyVideoPreview).children('div').children(".button-reset");

    $(storyVideoForm)
        .click(function() {
            $(storyVideoInput).children("input").trigger("click");
        });

    $(storyVideoInput)
        .children("input")
        .change(function(value) {
            var reader = new FileReader();
            console.log(this.files);
            reader.onload = function(e) {
                var urll = e.target.result;
                $(storyVideoPreview).children("video").attr("src", urll);
                $(storyVideoPreview).show();
                $(storyVideoForm).hide();
            };
            reader.readAsDataURL(this.files[0]);
        });

    $(storyChooseOtherInput)
        .click(function() {
            $(storyVideoInput).children("input").trigger("click");
        });

    $(storyResetInput)
        .click(function() {
            $(storyVideoInput)
                .children("input")
                .val("");
            $(storyVideoPreview).hide();
            $(storyVideoForm).show();
        });
</script>
{{-- END VIDEO UPLOAD --}}
