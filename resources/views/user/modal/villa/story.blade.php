<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_story" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-story">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('user_page.Story') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('villa_update_story') }}" method="POST" enctype="multipart/form-data"
                    id="updateStoryForm">
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">
                    <div class="form-group">
                        <div class="story-upload">
                            <div class="story-video-form dropzone">
                                <p>{{ __('user_page.Upload Video') }}</p>
                            </div>
                            <div class="story-video-preview" style="display: none;">
                                <div style="display: flex; align-items: center; margin-bottom: 9px;">
                                    <button type="button" class="button-choose-other btn btn-primary">{{ __('user_page.Choose another') }}</button>
                                    <button class="button-reset" type="reset">{{ __('user_page.Remove') }}</button>
                                </div>
                                <video class="w-100 story-upload-video-preview" controls>
                                    {{-- <source src="movie.mp4" type="video/mp4"> --}}
                                    {{ __("user_page.Your browser doesn't support HTML5 video tag") }}
                                </video>
                            </div>
                            <div class="story-video-input" style="display: none;">
                                <input id="storyVideo" type="file" name="file" accept=".mp4" />
                            </div>
                        </div>
                    </div>
                    <small id="err-stry-vid" style="display: none;" class="invalid-feedback">{{ __('auth.empty_video') }}</small>
                    <div class="form-group story-title-gap">
                        <input type="text" class="form-control" name="title" id="title" maxlength="15" placeholder="{{ __('user_page.Title...') }}">
                    </div>
                    <small id="err-stry-ttl" style="display: none;" class="invalid-feedback">{{ __('auth.empty_title') }}</small>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button class="btn btn-sm btn-primary" id="updateStoryForm">
                                <i class="fa fa-check"></i> {{ __('user_page.Upload') }}
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

    $("#storyVideo").on("change", function(ev) {
        if(document.getElementById("storyVideo").files.length != 0){
            $('.story-video-form').css("border", "");
            $('#err-stry-vid').hide();
        }
    });
    $(document).on("keyup", "#title", function () {
            $('#title').css("border", "");
            $('#err-stry-ttl').hide();
    });
    $("form#updateStoryForm").submit(function(e) {
        let error = 0;
        if(document.getElementById("storyVideo").files.length == 0){
            $('.story-video-form').css("border", "solid #e04f1a 1px");
            $('#err-stry-vid').show();
            error = 1;
        } else {
            $('.story-video-form').css("border", "");
            $('#err-stry-vid').hide();
        }
        if(!$('#title').val()) {
            $('#title').css("border", "solid #e04f1a 1px");
            $('#err-stry-ttl').show();
            error = 1;
        } else {
            $('#title').css("border", "");
            $('#err-stry-ttl').hide();
        }
        if(error == 1) {
            e.preventDefault();
        }
    });

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
                $('.story-title-gap').css("margin-top", "50px");
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
            $('.story-title-gap').css("margin-top", "18px");
            $(storyVideoPreview).hide();
            $(storyVideoForm).show();
        });
</script>
