@extends('layouts.user.list')

@section('title', 'List of Collaborator - EZV2')

<style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px !important;
        height: 25px !important;
        border-radius: 20px;
        background: #dfd9ea;
        transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        vertical-align: middle;
        cursor: pointer;
    }

    .d-none {
        display: none;
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

    /* Styling for card component*/

    .card-text {
        font-family: 'Poppins' !important;
        font-weight: 400;
        margin: 0px;
    }

    .mb-0 {
        margin-bottom: 0px !important;
    }

    .ml-1 {
        margin-left: 0.25rem;
    }


    .text-12 {
        font-size: 12px;
    }

    .text-13 {
        font-size: 13px;
    }

    .text-14 {
        font-size: 14px;
    }

    .text-17 {
        font-size: 17px;
    }

    .text-18 {
        font-size: 18px;
    }

    .text-20 {
        font-size: 20px;
    }

    .text-align-left {
        text-align: left;
    }

    .text-align-center {
        text-align: center;
    }

    .text-align-right {
        text-align: right;
    }

    .text-align-justify {
        text-align: justify;
    }

    .fw-400 {
        font-weight: 400;
    }

    .fw-500 {
        font-weight: 500;
    }

    .fw-600 {
        font-weight: 600;
    }

    .text-grey-1 {
        color: #707070;
    }

    .text-grey-2 {
        color: #ACACAC;
    }

    .text-orange {
        color: #ff7400;
    }

    .br-10 {
        border-radius: 10px;
    }

    .h-150 {
        display: block;
        height: 150px;
    }

    .h-180 {
        display: block;
        height: 150px;
    }

    .h-200 {
        display: block;
        height: 200px;
    }

    .aspect-ratio-1 {
        aspect-ratio: 1/1;
    }

    /* END Styling for card component*/

    .sub-icon:hover {
        color: #ff7400 !important;
        cursor: pointer;
    }

    /* START FOLLOWERS SLIDER */

    :root {
        --bg: #e3e4e8;
        --bgT: #ff7400;
        --fg: #000;
        --inputBg: #fff;
        --handleBg: #fc9e51;
        --handleDownBg: #c95b00;
        --handleTrackBg: #ff7400;
    }

    .body,
    input {
        border: 0;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        color: var(--fg);
        font: 1em/1.5 "Hind", sans-serif;
    }

    .body,
    .range,
    .range__counter {
        display: flex;
        padding-right: 5px;
        margin-left: 20px;
        margin-top: 5px;
    }

    form,
    input,
    .range__input,
    .range__counter-sr {
        width: 100%;
    }

    form {
        margin: auto;
        padding: 0 0.75em;
        max-width: 17em;
    }

    .range:not(:last-child) {
        margin-bottom: 1.5em;
    }

    .range input[type=range],
    .range input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
    }

    .range input[type=range],
    .range__input-fill {
        border-radius: 0.25em;
        height: 0.5em;
    }

    .range input[type=range] {
        background-color: #DDDDDE;
        display: block;
        margin: 0.5em 0;
        padding: 0;
    }

    .range input[type=range]:focus {
        outline: transparent;
    }

    .range input[type=range]::-webkit-slider-thumb {
        background-color: var(--handleBg);
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        transition: background 0.1s linear;
        width: 1.5em;
        height: 1.5em;
        z-index: 1;
    }

    .range input[type=range]::-moz-range-thumb {
        background-color: var(--handleBg);
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        transform: translateZ(1px);
        transition: background-color 0.1s linear;
        width: 1.5em;
        height: 1.5em;
        z-index: 1;
    }

    .range input[type=range]::-moz-focus-outer {
        border: 0;
    }

    .range__input,
    .range__input-fill,
    .range__counter-column,
    .range__counter-digit {
        display: block;
    }

    .range__input,
    .range__counter {
        position: relative;
    }

    .range__input {
        margin-right: 0.375em;
    }

    .range__input:active input[type=range]::-webkit-slider-thumb,
    .range input[type=range]:focus::-webkit-slider-thumb,
    .range input[type=range]::-webkit-slider-thumb:hover {
        background-color: var(--handleDownBg);
    }

    .range__input:active input[type=range]::-moz-range-thumb,
    .range input[type=range]:focus::-moz-range-thumb,
    .range input[type=range]::-moz-range-thumb:hover {
        background-color: var(--handleDownBg);
    }

    .range__input-fill,
    .range__counter-sr {
        position: absolute;
        left: 0;
    }

    .range__input-fill {
        background-color: var(--handleTrackBg);
        pointer-events: none;
        top: calc(50% - 0.25em);
    }

    .range__counter,
    .range__counter-digit {
        height: 1.5em;
    }

    .range__counter {
        margin: -30px;
        overflow: hidden;
        text-align: center;
    }

    .range__counter-sr {
        color: transparent;
        letter-spacing: 0.06em;
        top: 0;
        text-align: right;
        z-index: 1;
    }

    .range__counter-column {
        transition: transform 0.25s ease-in-out;
        width: 0.66em;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .range__counter-column--pause {
        transition: none;
    }

    /* END FOLLOWERS SLIDER */
</style>

@php
$bgColor = 'bg-body-light';
$textColor = 'font-black';
$rowLineColor = 'row-line-white';
$listColor = 'listoption-light';
$shadowColor = 'box-shadow-light';
if (isset($_COOKIE['tema'])) {
    if ($_COOKIE['tema'] == 'black') {
        $bgColor = 'bg-body-black';
        $textColor = 'font-light';
        $rowLineColor = 'row-line-grey';
        $listColor = '{{ $listColor }}';
        $shadowColor = 'box-shadow-dark';
    }
}

if (request()->fCategory) {
    $fCategory = request()->fCategory;
} else {
    $fCategory = '';
}
@endphp

@section('content')
    <div id="body-color" class="{{ $bgColor }}">
        <!-- Page Content -->
        <div id="div-to-refresh" class="container__list">
            <!-- Refresh Page -->

            <div class="col-12">
                <div id="filter-cat-bg-color" style="width:100%;"
                    class="container-grid-cat translate-text-group {{ $bgColor }}" style="">
                    @foreach ($collabCategory->take(6) as $item)
                        <div>
                            <a href="#" class="grid-img-container"
                                onclick="collabFilter({{ $item->id_collab_category }}, null)">
                                <img class="grid-img-filter lozad"
                                    @if ($fCategory == $item->id_collab_category) style="border: 5px solid #ff7400;" @endif
                                    data-src="https://source.unsplash.com/random/?{{ $item->name }}"
                                    src="{{ LazyLoad::show() }}">
                                <div class="grid-text">
                                    <span class="translate-text-group-items text-white">{{ $item->name }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div style="cursor:pointer;" onclick="moreCategory()">
                        <a class="grid-img-container">
                            <img class="grid-img-filter lozad" data-src="https://source.unsplash.com/random/?bali"
                                src="{{ LazyLoad::show() }}">
                            <div class="grid-text">
                                {{ __('user_page.More') }}
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div id="filter-subcat-bg-color" class="container-grid-sub-cat {{ $bgColor }} stickySubCategory" style="width: 100%;"
            data-isshow="true">
            {{-- <div class="button-dropdown skeleton skeleton-h-3 skeleton-w-100">
                <a href="javascript:void(0)" id="price" style="cursor:pointer;"
                    class="dropdown-toggle grid-sub-cat-content-container text-13">
                    <div>
                        <i class="fa fa-solid fa-dollar-sign text-18 list-description  {{ $textColor }} sub-icon">
                        </i>
                    </div>
                    <div class="list-description {{ $textColor }}">Price</div>
                </a>
                <div class="price-popup dropdown-menu">
                    <div class="double-slider">
                        <div class="extra-controls form-inline">
                            <div class="col-lg-12">
                                <p class="price-popup-title">Price Range
                                </p>
                            </div>
                            <div class="form-group col-lg-12 price-popup-display-container">
                                <div class="price-popup-display-wrap1">
                                    <div class="col-lg-12 price-popup-display">
                                        <label for="min_price" class="price-popup-label">Min</label>
                                        <input name="fMinPrice[]" type="text"
                                            class="js-input-from form-control price-popup-label" value="0"
                                            style="border: none;" />
                                    </div>
                                </div>
                                <div class="price-popup-display-gap-container">
                                    <div></div>
                                </div>
                                <div class="price-popup-display-wrap2">
                                    <div class="col-lg-12 price-popup-display">
                                        <label for="max_price" class="price-popup-label">Max</label>
                                        <input name="fMaxPrice[]" type="text"
                                            class="js-input-to form-control price-popup-label" value="0"
                                            style="border: none;" />
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="js-range-slider" value="" />
                        </div>
                        <center>
                            <div style="margin-top: 25px;">
                                <button type="submit" class="btn btn-choose"
                                    style="border-radius:12px; width: 100%; padding: 10px;">{{ Translate::translate('Save') }}</button>
                            </div>
                        </center>
                    </div>
                </div>
            </div>

            <div class="button-dropdown skeleton skeleton-h-3 skeleton-w-100">
                <a href="javascript:void(0)" id="gender" style="cursor:pointer;"
                    class="dropdown-toggle grid-sub-cat-content-container text-13">
                    <div>
                        <i
                            class="fa fa-solid fa-mars-and-venus text-18 list-description  {{ $textColor }} sub-icon">
                        </i>
                    </div>
                    <div class="list-description {{ $textColor }}">Gender</div>
                </a>
                <div class="price-popup dropdown-menu">
                    <div>
                        <p class="price-popup-title">Gender
                        </p>
                        <div class="propertytype-input-row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="checkdesign">Male
                                            <input type="checkbox" name="gender[]" value="Male">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="checkdesign">Female
                                            <input type="checkbox" name="gender[]" value="Female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 25px;">
                            <button type="submit" class="btn btn-choose"
                                style="border-radius:12px; width: 100%; padding: 10px;"
                                onclick="villaFilter()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-dropdown skeleton skeleton-h-3 skeleton-w-100">
                <a href="javascript:void(0)" id="followers" style="cursor:pointer;"
                    class="dropdown-toggle grid-sub-cat-content-container text-13">
                    <div>
                        <i class="fa fa-solid fa-circle-user text-18 list-description  {{ $textColor }} sub-icon">
                        </i>
                    </div>
                    <div class="list-description {{ $textColor }}">Followers</div>
                </a>
                <div class="price-popup dropdown-menu">
                    <div class="dropdown-pd-0">
                        <div class="list-description {{ $textColor }}">Followers Range</div>
                        <div class="body">
                            <form>
                                <input id="range2" name="range2" type="range" min="0" max="1000000"
                                    value="500000">
                            </form>
                        </div>

                        <center>
                            <div style="margin-top: 25px;">
                                <button type="submit" class="btn btn-choose"
                                    style="border-radius:12px; width: 100%; padding: 10px;">{{ Translate::translate('Save') }}</button>
                            </div>
                        </center>
                    </div>
                </div>
            </div> --}}

            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterCollab()">
                <div>
                    <i class="fas fa-dollar-sign text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">Price</div>
            </div>

            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterCollab()">
                <div>
                    <i class="fas fa-mars-and-venus text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">Gender</div>
            </div>

            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterCollab()">
                <div>
                    <i class="fas fa-circle-user text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">Followers</div>
            </div>

            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="filterCollab()">
                <div>
                    <i class="fas fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                </div>
                <div class="list-description {{ $textColor }}">Filters</div>
            </div>
        </div>

        <div class="col-lg-12 container-grid container__grid">
            @foreach ($collab as $data)
                <div class="grid-list-container">

                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">

                        <div class="content list-image-content"
                            style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="{{ $data->id_collab }}" id="id_collab" name="id_collab">
                            <div class="js-slider-2 list-slider slick-nav-black slick-dotted-inner slick-dotted-white skeleton skeleton-w-100 skeleton-h-10"
                                data-dots="false" data-arrows="true">
                                @php
                                    $gallery = App\Http\Controllers\Collaborator\CollaboratorController::gallery($data->id_collab);
                                @endphp
                                @forelse ($gallery as $item)
                                    <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="img-fluid grid-image aspect-ratio-1 h-auto" style="display: block;"
                                            src="{{ URL::asset('/foto/collaborator/' . $data->id_collab . '/' . $item->photo) }}"
                                            {{-- src="{{ URL::asset('foto/collaborator/1/1.jpg') }}" --}} alt="EZV_{{ $item->photo }}">
                                    </a>
                                @empty
                                    @if ($data->image)
                                        <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image aspect-ratio-1 h-auto" style="display: block;"
                                                src="{{ URL::asset('/foto/collaborator/' . $item->id_collab . '/' . $data->image) }}"
                                                alt="EZV_{{ $item->photo }}">
                                        </a>
                                    @else
                                        <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image aspect-ratio-1 h-auto" style="display: block;"
                                                src="{{ URL::asset('/template/collab/template_profile.jpg') }}"
                                                alt="EZV_{{ $item->photo }}">
                                        </a>
                                    @endif
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="desc-container-grid mb-2">
                        <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                            class="grid-overlay-desc"></a>
                        <div class="skeleton skeleton-h-2 skeleton-w-100">
                            <div class="text-14 fw-500 {{ $textColor }} list-description"
                                style="text-transform: capitalize;">
                                {{ $data->user->first_name }} {{ $data->user->last_name }}</div>
                        </div>
                        <div class="grid-one-line max-lines col-lg-10 skeleton skeleton-w-100 skeleton-h-1">
                            <p class="text-14 fw-400 text-grey-2 grid-one-line max-lines">{{ $data->description }}</p>
                        </div>
                        <div class="grid-one-line skeleton skeleton-w-50 skeleton-h-1">
                            <div class="text-14 fw-400 grid-one-line  text-orange ">{{ $data->address }}</div>
                        </div>
                        <div class="text-14 grid-one-line mt-1 skeleton">
                            <span class="text-14 fw-400 {{ $textColor }} list-description">Start from</span>
                            <span class="fw-600 ml-1 text-14 {{ $textColor }} list-description">IDR
                                {{ number_format($data->price, 0, ',', '.') }}
                            </span>
                        </div>
                        </a>
                        <div class="text-14 fw-400 grid-one-line {{ $textColor }} list-description skeleton"
                            style="display: flex;">
                            <a href="mailto:{{ $data->email }}?subject=I want to collab">
                                <div
                                    style="width: 40px; height: 40px; color: white; background-color: #ff7400; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $data->phone }}">
                                <div
                                    style="width: 40px; height: 40px; color: white; background-color: #ff7400; border-radius: 50%; margin-left: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
        <!-- End Refresh Page -->
    </div>
    <!-- End Page Content -->
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.collaborator.category')
    @include('user.modal.auth.login_register')
    @include('user.modal.collaborator.sub_category')
    @include('user.modal.collab.filter_collab')
    {{-- modal laguage and currency --}}
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/list-collab-extend.js') }}"></script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $(".js-slider-2 .slick-next").css("display", "none");
            $(".js-slider-2 .slick-prev").css("display", "none");
            $(".js-slider-2").mouseenter(function(e) {
                $(this).children(".slick-prev").css("display", "block");
                $(this).children(".slick-next").css("display", "block");
            });
            $(".js-slider-2").mouseleave(function(e) {
                $(this).children(".slick-prev").css("display", "none");
                $(this).children(".slick-next").css("display", "none");
            });
            $(".drop-down").hover(function() {
                $('.mega-menu').addClass('display-on');
            });
            $(".drop-down").mouseleave(function() {
                $('.mega-menu').removeClass('display-on');
            });

            $(".drop-down2").hover(function() {
                $('.mega-menu2').addClass('display-on');
            });
            $(".drop-down2").mouseleave(function() {
                $('.mega-menu2').removeClass('display-on');
            });

            $(".drop-down3").hover(function() {
                $('.mega-menu3').addClass('display-on');
            });
            $(".drop-down3").mouseleave(function() {
                $('.mega-menu3').removeClass('display-on');
            });

            $(".drop-down4").hover(function() {
                $('.mega-menu4').addClass('display-on');
            });
            $(".drop-down4").mouseleave(function() {
                $('.mega-menu4').removeClass('display-on');
            });

            $(".drop-down5").hover(function() {
                $('.mega-menu5').addClass('display-on');
            });
            $(".drop-down5").mouseleave(function() {
                $('.mega-menu5').removeClass('display-on');
            });

        });
    </script>

    {{-- FILTER RESTAURANT LIST --}}
    <script>
        function moreCategory() {
            $('#categoryModal').modal('show');
        }

        function moreSubCategory() {
            $('#modalSubCategory').modal('show');
        }

        function collabRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/collaborator/search?${suburl}`;
        }
    </script>

    <script>
        function filterCollab() {
            $('#modalFiltersCollab').modal('show');
        }

        function collabFilter(valueCategory, valueClick) {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sStart = $("input[name='start_date']").val();
            var sEnd = $("input[name='end_date']").val();

            var url_homes = window.location.href;
            var url2 = new URL(url_homes);

            if (url2.searchParams.get('fCategory') == valueCategory) {
                valueCategory = '';
            }

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
            setCookie2("sCheck_in", sStart, 1);
            setCookie2("sCheck_out", sEnd, 1);

            var filterFormInput = [];
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

            if (valueCategory == null) {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=&filter=${filteredArray}`;
            } else {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=${valueCategory}&filter=${filteredArray}`;
            }

            collabRefreshFilter(subUrl);
        }
    </script>
    {{-- END SEARCH FUNCTION --}}

    {{-- FOLLOWERS SLIDER --}}
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            let range2 = new RollCounterRange("#range2");
        });

        class RollCounterRange {
            constructor(id) {
                this.el = document.querySelector(id);
                this.srValue = null;
                this.fill = null;
                this.digitCols = null;
                this.lastDigits = "";
                this.rollDuration = 0; // the transition duration from CSS will override this
                this.trans09 = false;

                if (this.el) {
                    this.buildSlider();
                    this.el.addEventListener("input", this.changeValue.bind(this));
                }
            }
            buildSlider() {
                // create a div to contain the <input>
                let rangeWrap = document.createElement("div");
                rangeWrap.className = "range";
                this.el.parentElement.insertBefore(rangeWrap, this.el);

                // create another div to contain the <input> and fill
                let rangeInput = document.createElement("span");
                rangeInput.className = "range__input";
                rangeWrap.appendChild(rangeInput);

                // range fill, place the <input> and fill inside container <span>
                let rangeFill = document.createElement("span");
                rangeFill.className = "range__input-fill";
                rangeInput.appendChild(this.el);
                rangeInput.appendChild(rangeFill);

                // create the counter
                let counter = document.createElement("span");
                counter.className = "range__counter";
                rangeWrap.appendChild(counter);

                // screen reader value
                let srValue = document.createElement("span");
                srValue.className = "range__counter-sr";
                srValue.textContent = "0";
                counter.appendChild(srValue);

                // column for each digit
                for (let D of this.el.max.split("")) {
                    let digitCol = document.createElement("span");
                    digitCol.className = "range__counter-column";
                    digitCol.setAttribute("aria-hidden", "true");
                    counter.appendChild(digitCol);

                    // digits (blank, 0–9, fake 0)
                    for (let d = 0; d <= 15; ++d) {
                        let digit = document.createElement("span");
                        digit.className = "range__counter-digit";

                        if (d > 0)
                            digit.textContent = d == 15 ? 0 : `${d - 1}`;

                        digitCol.appendChild(digit);
                    }
                }

                this.srValue = srValue;
                this.fill = rangeFill;
                this.digitCols = counter.querySelectorAll(".range__counter-column");
                this.lastDigits = this.el.value;

                while (this.lastDigits.length < this.digitCols.length)
                    this.lastDigits = " " + this.lastDigits;

                this.changeValue();

                // use the transition duration from CSS
                let colCS = window.getComputedStyle(this.digitCols[0]),
                    transDur = colCS.getPropertyValue("transition-duration"),
                    msLabelPos = transDur.indexOf("ms"),
                    sLabelPos = transDur.indexOf("s");

                if (msLabelPos > -1)
                    this.rollDuration = transDur.substr(0, msLabelPos);
                else if (sLabelPos > -1)
                    this.rollDuration = transDur.substr(0, sLabelPos) * 1e3;
            }
            changeValue() {
                // keep the value within range
                if (+this.el.value > this.el.max)
                    this.el.value = this.el.max;

                else if (+this.el.value < this.el.min)
                    this.el.value = this.el.min;

                // update the screen reader value
                if (this.srValue)
                    this.srValue.textContent = this.el.value;

                // width of fill
                if (this.fill) {
                    let pct = this.el.value / this.el.max,
                        fillWidth = pct * 100,
                        thumbEm = 1 - pct;

                    this.fill.style.width = `calc(${fillWidth}% + ${thumbEm}em)`;
                }

                if (this.digitCols) {
                    let rangeVal = this.el.value;

                    // add blanks at the start if needed
                    while (rangeVal.length < this.digitCols.length)
                        rangeVal = " " + rangeVal;

                    // get the differences between current and last digits
                    let diffsFromLast = [];
                    if (this.lastDigits) {
                        rangeVal.split("").forEach((r, i) => {
                            let diff = +r - this.lastDigits[i];
                            diffsFromLast.push(diff);
                        });
                    }

                    // roll the digits
                    this.trans09 = false;
                    rangeVal.split("").forEach((e, i) => {
                        let digitH = 1.5,
                            over9 = false,
                            under0 = false,
                            transY = e === " " ? 0 : (-digitH * (+e + 1)),
                            col = this.digitCols[i];

                        // start handling the 9-to-0 or 0-to-9 transition
                        if (e == 0 && diffsFromLast[i] == -9) {
                            transY = -digitH * 15;
                            over9 = true;

                        } else if (e == 9 && diffsFromLast[i] == 9) {
                            transY = 0;
                            under0 = true;
                        }

                        col.style.transform = `translateY(${transY}em)`;
                        col.firstChild.textContent = "";

                        // finish the transition
                        if (over9 || under0) {
                            this.trans09 = true;
                            // add a temporary 9
                            if (under0)
                                col.firstChild.textContent = e;

                            setTimeout(() => {
                                if (this.trans09) {
                                    let pauseClass = "range__counter-column--pause",
                                        transYAgain = -digitH * (over9 ? 1 : 10);

                                    col.classList.add(pauseClass);
                                    col.style.transform = `translateY(${transYAgain}em)`;
                                    void col.offsetHeight;
                                    col.classList.remove(pauseClass);

                                    // remove the 9
                                    if (under0)
                                        col.firstChild.textContent = "";
                                }

                            }, this.rollDuration);
                        }
                    });
                    this.lastDigits = rangeVal;
                }
            }
        }
    </script>
    {{-- END FOLLOWERS SLIDER --}}
@endsection
