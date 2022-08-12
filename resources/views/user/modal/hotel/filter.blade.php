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
    @media(max-width:992px){
        #sortByMobile{
            display:none;
        }
    }
</style>

<div class="modal fade" id="modalSubCategory" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal" style="padding-left: 2.2rem !important;">
                <div class="col-10">
                    <h5 class="mb-0"><span class="translate-text-single">{{ Translate::translate('Filters') }}</span></h5>
                </div>
                <button type="button" class="btn-close-modal col-2 d-flex justify-content-end pe-3"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body">
                <div class="filter-modal-row" id="sortByMobile">
                    <h5 class="filter-modal-row-title">Sort By</h5>
                    <ul class="p-0">
                        <li>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Highest to Lowest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="highest"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                        @if (request()->get('fSort') == 'highest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Lowest to Highest Price
                                <input type="checkbox" class="fSort" name="fSort[]" value="lowest"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'lowest') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Popularity
                                <input type="checkbox" class="fSort" name="fSort[]" value="popularity"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'popularity') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="checkdesign checkdesign-modal-filter mt-1">Best Reviewed
                                <input type="checkbox" class="fSort" name="fSort[]" value="best_reviewed"
                                    onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }})"
                                    @if (request()->get('fSort') == 'best_reviewed') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="filter-modal-row" style="border-bottom: 0px;">
                    <div id="modal-language-default" class="col-12">
                        <div class="row modal-checkbox-row translate-text-group">
                            @foreach ($hotelFilter as $item)
                                <div class="col-6 checkdesign-gap">
                                    <label class="checkdesign checkdesign-modal-filter">
                                        <span class="translate-text-group-items">
                                            {{ $item->name }}
                                        </span>
                                        @php
                                            $isChecked = '';
                                            $filterIds = explode(',', request()->get('filter'));
                                            if (in_array($item->id_hotel_filter, $filterIds)) {
                                                $isChecked = 'checked';
                                            }
                                        @endphp
                                        <input type="checkbox" name="filter[]" value="{{ $item->id_hotel_filter }}"
                                            onchange="hotelFilter({{ request()->get('fCategory') ?? 'null' }})"
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

<script>

    function hotelFilter(valueCategory, valueClick, unCheckCategory) {
        var sLocationFormInput = $("input[name='sLocation']").val();
        var sCheck_inFormInput = $("input[name='sCheck_in']").val();
        var sCheck_outFormInput = $("input[name='sCheck_out']").val();
        var sAdultFormInput = $("input[name='sAdult']").val();
        var sChildFormInput = $("input[name='sChild']").val();
        var fSortFormInput = $('.fSort:checked').val();
        if (fSortFormInput == undefined) {
            var fSortFormInput = '';
        }

        var filterFormInput = [];
        var fCategoryFormInput = [];

        var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();
        var fMinPriceFormInput = $("input[name='fMinPrice']").val();

        function setCookie2(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        setCookie2("sLocation", sLocationFormInput, 1);
        setCookie2("sCheck_in", sCheck_inFormInput, 1);
        setCookie2("sCheck_out", sCheck_outFormInput, 1);

        if (unCheckCategory == true) {
            var url_hotel = window.location.href;
            var url2 = new URL(url_hotel);

            if (url2.searchParams.get('fCategory') == valueCategory) {
                valueCategory = '';
            }
        }

        if (valueCategory != null) {
            $("input[name='fCategory[]']").prop("checked", false);
            $("input[name='fCategory[]']:checked").each(function() {
                fCategoryFormInput.push(parseInt($(this).val()));
            });
            if (fCategoryFormInput.includes(valueCategory) == true) {
                var filterCheck = fCategoryFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueCategory;
                }

                var filteredCategory = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                fCategoryFormInput.push(valueCategory);

                var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                    return fCategoryFormInput.indexOf(item) == pos;
                });
            }
        } else {
            $("input[name='fCategory[]']:checked").each(function() {
                fCategoryFormInput.push(parseInt($(this).val()));
            });

            var filteredCategory = fCategoryFormInput.filter(function(item, pos) {
                return fCategoryFormInput.indexOf(item) == pos;
            });
        }

        if (valueClick != null) {
            $("input[name='filter[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });
            if (filterFormInput.includes(valueClick) == true) {
                var filterCheck = filterFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueClick;
                }

                var filteredArray = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                filterFormInput.push(valueClick);

                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }
        } else {
            $("input[name='filter[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });

            var filteredArray = filterFormInput.filter(function(item, pos) {
                return filterFormInput.indexOf(item) == pos;
            });
        }

        var subUrl =
            `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fCategory=${filteredCategory}&filter=${filteredArray}&fSort=${fSortFormInput}`;

        hotelRefreshFilter(subUrl);
    }
</script>