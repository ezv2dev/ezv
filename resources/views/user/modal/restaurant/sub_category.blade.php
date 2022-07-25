<!-- Fade In Default Modal -->

<style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 25px;
        border-radius: 20px;
        background: #dfd9ea;
        transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        vertical-align: middle;
        cursor: pointer;
    }

    .example::-webkit-scrollbar {
        display: none;
    }

    .switch::before {
        content: '';
        position: absolute;
        top: 1px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: #fafafa;
        border-radius: 50%;
        transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(128, 128, 128, 0.1);
    }

    input:checked+.switch {
        background: #ff7400;
    }

    input:checked+.switch::before {
        left: 27px;
        background: #fff;
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
        font-size: 15px;
        content: "\f00c";
        text-align: center;
    }

    input:checked+.switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(0, 150, 136, 0.2);
    }

    .font-16 {
        font-size: 16px;
    }

    .font-14 {
        font-size: 14px;
    }

    .orange {
        color: #FF7400;
    }
</style>

<div class="modal fade" id="modalSubCategory" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal" style="padding-left: 2.2rem !important;">
                <div class="col-10">
                    <h5 class="mb-0">{{ Translate::translate('Filters') }}</h5>
                </div>
                <button type="button" class="btn-close-modal col-2 d-flex justify-content-end pe-3"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body" style=" height: 450px; overflow-y: auto;">
                <div class="filter-modal-row" style="border-bottom: 0px;">
                    <div id="modal-language-default" class="col-12">
                        <div class="row modal-checkbox-row translate-text-group">
                            @foreach ($subcategories as $item)
                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        <span class="translate-text-group-items">{{ $item->name }}</span>

                                        @php
                                            $isChecked = '';
                                            $filterIds = explode(',', request()->get('fSubCategory'));
                                            if (in_array($item->id_subcategory, $filterIds)) {
                                                $isChecked = 'checked';
                                            }
                                        @endphp

                                        <input type="checkbox" name="subCategory[]"
                                            value="{{ $item->id_subcategory }}"
                                            onchange="foodFilter({{ request()->get('fCuisine') ?? 'null' }})"
                                            {{ $isChecked }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <!-- Submit -->
            <div class="modal-filter-footer">
            </div>
            <!-- END Submit -->
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
