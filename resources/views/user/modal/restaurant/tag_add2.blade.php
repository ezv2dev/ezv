<!-- Fade In Default Modal -->

<div class="modal fade" id="modal-add_tag" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header" style="padding-left: 2.3rem !important;">
                <h5 class="modal-title">{{ __('user_page.Edit Tags') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: scroll; border-radius: 0px;">
                {{-- <input type="text" onkeyup="filterContent()" id="fn-filter-input" class="bg-secondary"> --}}
                <form action="{{ route('restaurant_store_tag') }}" method="POST" id="basic-form" class="js-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_restaurant" id="id_restaurant"
                        value="{{ $restaurant->id_restaurant }}">

                    <div class="form-group pt-2 px-4">
                        <div class="row">
                            <label class="form-label" style="font-weight: 600; font-size: 20px;">{{ __('user_page.Cuisine') }}</label>
                            <div style="display: flex; flex-wrap: wrap;">
                                @foreach ($cuisine as $data)
                                    <div class="col-4">
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->cuisine as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_cuisine }}" id="{{ $data->id_cuisine }}"
                                                name="cuisine[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label" style="font-weight: 600; font-size: 20px;">{{ __('user_page.Dietary Food') }}</label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap;">
                                @foreach ($dietaryfood as $data)
                                    <div class="col-4">
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->dietaryfood as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_dietaryfood }}" id="{{ $data->id_dietaryfood }}"
                                                name="dietaryfood[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label" style="font-weight: 600; font-size: 20px;">{{ __('user_page.Dishes') }}</label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap;">
                                @foreach ($dishes as $data)
                                    <div class="col-4">
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->dishes as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_dishes }}" id="{{ $data->id_dishes }}"
                                                name="dishes[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label" style="font-weight: 600; font-size: 20px;">{{ __('user_page.Good For') }}</label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap;">
                                @foreach ($goodfor as $data)
                                    <div class="col-4">
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->goodfor as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_goodfor }}" id="{{ $data->id_goodfor }}"
                                                name="goodfor[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label" style="font-weight: 600; font-size: 20px;">{{ __('user_page.Meal') }}</label>
                            <div class="translate-text-group" style="display: flex; flex-wrap: wrap;">
                                @foreach ($meal as $data)
                                    <div class="col-4">
                                        <div class="form-check form-switch row admin-edit-aminities-modal">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->meal as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $data->id_meal }}" id="{{ $data->id_meal }}"
                                                name="meal[]" {{ $isChecked }}>
                                            <label class="form-check-label"
                                                for="example-switch-default1">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- Submit -->

                    <!-- END Submit -->
                    <br>

            </div>
            <div class="modal-filter-footer d-flex justify-content-center"
                style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                <div class="col-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                    </button>
                </div>
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
