<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_story" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Story</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form action="{{ route('villa_update_story') }}" method="POST" class="dropzone" id="frmTarget">
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">
                </form>
                <br>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title...">
                <!-- Submit -->
                <br>
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" id="button" class="btn btn-sm btn-primary">
                            <i class="fa fa-check"></i> Upload
                        </button>
                    </div>
                </div>

                <!-- END Submit -->
            </div>
        </div>
    </div>
</div>

<script>
    Dropzone.options.frmTarget = {
        autoProcessQueue: false,
        url: '/villa/update/story',
        parallelUploads: 50,
        init: function () {

            var myDropzone = this;

            // Update selector to match your button
            $("#button").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();

            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                // var data = $('#frmTarget').serializeArray();
                // $.each(data, function(key, el) {
                //     formData.append(el.name, el.value);
                // });
                var value = $('form#formData #id_villa').val();
                formData.append('id_villa', value);
            });

            this.on('queuecomplete', function () {
                location.reload();
            });

            this.on("addedfile", function(file) {

                // Create the remove button
                var removeButton = Dropzone.createElement("<center><button class='btn btn-outline-light'>Remove</button></center>");


                // Capture the Dropzone instance as closure.
                var _this = this;

                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    _this.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });
        }
    }
</script>
<!-- END Fade In Default Modal -->
