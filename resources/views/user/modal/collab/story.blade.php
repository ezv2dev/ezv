<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_story" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-story">
            <div class="modal-header">
                <h5 class="modal-title">Story</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('collab_update_story') }}" method="POST" enctype="multipart/form-data"
                    id="updateStoryForm" onsubmit="showingLoading()">
                    @csrf
                    <input type="hidden" name="id_collab" id="id_collab" value="{{ $profile->id_collab }}">
                    <div class="form-group">
                        {{-- <div class="file-upload" id="file-upload1">
                            <div class="image-box dropzone">
                                <p>Upload Video</p>
                                <img style="width: 100%" src="" alt="">
                            </div>
                                <div class="controls" style="display: none;">
                                <input type="file" name="file" accept=".mp4" required/>
                            </div>
                        </div> --}}
                        <div class="story-upload">
                            <div class="story-video-form dropzone">
                                <p>Upload Video</p>
                            </div>
                            <div class="story-video-preview" style="display: none;">
                                <div style="display: flex; align-items: center; margin-bottom: 9px;">
                                    <button type="button" class="button-choose-other btn btn-primary">choose another</button>
                                    <button class="button-reset" type="reset">remove</button>
                                </div>
                                <video class="w-100 story-upload-video-preview" controls>
                                    {{-- <source src="movie.mp4" type="video/mp4"> --}}
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="story-video-input" style="display: none;">
                                <input type="file" name="file" accept=".mp4" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group story-title-gap">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title..."
                            required>
                    </div>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button class="btn btn-sm btn-primary" id="updateStoryForm">
                                <i class="fa fa-check"></i> Upload
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </form>
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
    var storyChooseOtherInput = $(storyVideoPreview).children(".button-choose-other");
    var storyResetInput = $(storyVideoPreview).children(".button-reset");

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
