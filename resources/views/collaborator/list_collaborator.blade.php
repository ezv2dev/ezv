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
        <div id="div-to-refresh">
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

            <div id="filter-subcat-bg-color" class="container-grid-sub-cat {{ $bgColor }}" style="width: 100%;"
                data-isshow="true">
                @foreach ($collabFilter->sortBy('order')->take(8) as $item)
                    <div class="skeleton skeleton-h-3 skeleton-w-100">
                        <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                            onclick="collabFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_collab_filter }})">
                            <div>
                                <i class="fa fa-solid fa-{{ $item->icon }} text-18 list-description  {{ $textColor }} sub-icon"
                                    @php
                                        $isChecked = '';
                                        $filterIds = explode(',', request()->get('filter'));
                                    @endphp @if (in_array($item->id_collab_filter, $filterIds))
                                    style="color: #ff7400 !important;"
                @endif>
                </i>
            </div>
            <div class="list-description {{ $textColor }}">{{ $item->name }}</div>
        </div>
    </div>
    @endforeach

    <div class="skeleton skeleton-h-3 skeleton-w-100">
        <div class="grid-sub-cat-content-container text-13 list-description {{ $textColor }}"
            onclick="moreSubCategory()">

            <div>
                <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
            </div>
            <p class="list-description {{ $textColor }}">
                {{ __('user_page.More') }}
            </p>

        </div>
    </div>
    </div>
    </div>

    <div class="col-lg-12 container-grid">
        @foreach ($collab as $data)
            <div class="grid-list-container">

                <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">

                    <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                        <input type="hidden" value="{{ $data->id_collab }}" id="id_collab" name="id_collab">
                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white skeleton skeleton-w-100 skeleton-h-10"
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
    {{-- modal laguage and currency --}}
    </div>

    {{-- VIEW VIDEO --}}
    {{-- @include('user.modal.collab.list.video') --}}
    {{-- END VIEW VIDEO --}}
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/list-collab-extend.js') }}"></script>

    {{-- VIEW MAP --}}
    {{-- @include('user.modal.collab.list.map') --}}
    {{-- END VIEW MAP --}}

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $(".js-slider .slick-next").css("display", "none");
            $(".js-slider .slick-prev").css("display", "none");
            $(".js-slider").mouseenter(function(e) {
                $(this).children(".slick-prev").css("display", "block");
                $(this).children(".slick-next").css("display", "block");
            });
            $(".js-slider").mouseleave(function(e) {
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
@endsection
