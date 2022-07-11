<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-add_subcategory" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 2.5rem !important;">
                <h5 class="modal-title">{{ __('user_page.Edit Subcategory') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                {{-- <input type="text" onkeyup="filterContent()" id="fn-filter-input" class="bg-secondary"> --}}
                <form action="{{ route('activity_store_subcategory') }}" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_activity" id="id_activity" value="{{ $activity->id_activity }}">

                    <div class="form-group row translate-text-group" style="padding-left: 10px">
                        @foreach ($subCategory as $data)
                            <div class="col-4" style="text-transform: capitalize">
                                <div class="form-check form-switch admin-edit-aminities-modal fn-filter-content">
                                    @php
                                        $isChecked = '';
                                        foreach ($activity->subCategory as $item) {
                                            if ($data->name == $item->name) {
                                                $isChecked = 'checked';
                                            }
                                        }
                                    @endphp
                                    <input class="form-check-input" type="checkbox"
                                        value="{{ $data->id_subcategory }}" id="{{ $data->id_subcategory }}"
                                        name="subcategory[]" {{ $isChecked }}>
                                    <label class="form-check-label"
                                        for="example-switch-default1">
                                        <span class="translate-text-group-items">{{ $data->name }}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <br>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> {{ __('user_page.Save') }}
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
    function add_subcategory() {
        $('#modal-add_subcategory').modal('show');
    }
</script>

{{-- <script>
    function filterContent() {
        var input = $('#fn-filter-input').val();
        var contents = $('.fn-filter-content');
        $.map(contents, (content) => {
            $(content).hide();
            textLabel = $(content).children('label').text();
            textInput = $('#fn-filter-input').val();
            if(textLabel.includes(textInput)) {
                console.log(true);
                console.log($(content).children('label').text());
                $(content).show();
            }
        });
    }
</script> --}}
