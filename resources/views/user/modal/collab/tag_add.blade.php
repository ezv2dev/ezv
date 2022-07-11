<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_tag" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                {{-- <input type="text" onkeyup="filterContent()" id="fn-filter-input" class="bg-secondary"> --}}
                <form action="{{ route('collab_store_category') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_collab" id="id_collab" value="{{ $profile->id_collab }}">

                    <div class="form-group">
                        <div class="row" style="padding-left: 10px">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label">Category</label>
                                    <div class="space-y-2">
                                        @foreach($category as $data)
                                            <div class="form-check form-switch row admin-edit-aminities-modal">
                                                @php
                                                    $isChecked = "";
                                                    foreach ($tags as $item) {
                                                        if($data->name == $item->name) {
                                                            $isChecked = "checked";
                                                        }
                                                    }
                                                @endphp
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $data->id_category }}" id="{{ $data->id_category }}"
                                                    name="category[]" {{ $isChecked }}>
                                                <label class="form-check-label"
                                                    for="example-switch-default1">{{ $data->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
    function add_tag() {
        $('#modal-add_tag').modal('show');
    }
</script>
