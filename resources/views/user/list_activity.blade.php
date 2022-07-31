@extends('layouts.user.list')

@section('title', 'List of WOW - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    $activitys = $activity->shuffle()->sortBy('grade');
    $list = [];
    foreach ($activitys as $item) {
        array_push($list, $item->id_activity);
    }
    $scenic_views = App\Models\ScenicViews::all();

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
    @endphp
    {{-- function get data --}}

    <style>
        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }
    </style>

    <div id="body-color" class="{{ $bgColor }}" style="position: relative; min-height: 100px;">
        <!-- Page Content -->
        <div id="div-to-refresh" class="container__list">
            @php
                $fcategory = '';
            @endphp

            <div id="filter-cat-bg-color" style="width:100%;"
                class="container-grid-cat translate-text-group {{ $bgColor }} top-min-10p pb-10p" style="">
                @foreach ($categories->take(6) as $item)
                    <div>
                        <a href="#" class="grid-img-container"
                            onclick="wowFilter({{ $item->id_category }}, null, 1, true)">
                            <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                                @if (request()->get('fCategory') == $item->id_category) style="border: 5px solid #ff7400;" @endif
                                data-src="https://source.unsplash.com/random/?{{ $item->name }}">
                            <div class="grid-text translate-text-group-items">
                                {{ $item->name }}
                            </div>
                        </a>
                    </div>
                @endforeach

                <div style="cursor:pointer;" onclick="moreCategory()">
                    <a class="grid-img-container">
                        <img class="grid-img-filter lozad" src="{{ LazyLoad::show() }}"
                            data-src="https://source.unsplash.com/random/?bali">
                        <div class="grid-text">
                            {{ __('user_page.More') }}
                        </div>
                    </a>
                </div>
            </div>
            <div class="stickySubCategory">
                <div id="filter-subcat-bg-color" style="width: 100%;"
                    class="container-grid-sub-cat translate-text-group {{ $bgColor }} bg-dark pt-15p pb-15p"
                    style="">
                    @if (request()->get('fCategory') == null)
                        @foreach ($subCategoryAll->take(8) as $item)
                            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                                onclick="wowFilter({{ $item->id_category }}, {{ $item->id_subcategory }}, null, false)">
                                <div>
                                    <i class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                                        @php
                                            $isChecked = '';
                                            $filterIds = explode(',', request()->get('fSubCategory'));
                                        @endphp @if (in_array($item->id_subcategory, $filterIds))
                                        style="color: #ff7400 !important;"
                        @endif>
                        </i>
                </div>
                <div>
                    <span class="translate-text-group-items list-description {{ $textColor }}">
                        {{ $item->name }}
                    </span>
                </div>
            </div>
            @endforeach
            @if ($subCategoryAll->count() > 6)
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13" onclick="moreSubCategory()">
                    <div>
                        <div>
                            <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                        </div>
                        <p class="text-13 list-description {{ $textColor }} m-0">
                            {{ __('user_page.More') }}
                        </p>
                    </div>
                </div>
            @endif
        @else
            @foreach ($subCategory->take(8) as $item)
                <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                    onclick="wowFilter({{ $item->id_category }}, {{ $item->id_subcategory }}, null, false)">
                    <div>
                        <i class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"
                            @php
                                $isChecked = '';
                                $filterIds = explode(',', request()->get('fSubCategory'));
                            @endphp @if (in_array($item->id_subcategory, $filterIds))
                            style="color: #ff7400 !important;"
            @endif></i>
        </div>
        <div>
            <span class="translate-text-group-items list-description {{ $textColor }}">
                {{ $item->name }}
            </span>
        </div>
    </div>
    @endforeach
    @if ($subCategory->count() > 6)
        <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13 list-description {{ $textColor }} "
            onclick="moreSubCategory()">
            <div>
                <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
            </div>
            <p class="text-13 list-description {{ $textColor }} ">{{ __('user_page.More') }}</p>
        </div>
    @endif
    @endif
    </div>

    </div>
    <!-- Refresh Page -->
    @if (count($activitys) == 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mt-4">
                        <img style="height: 53vh;" class="img-fluid p-4"
                            src="{{ asset('assets/partner/template/assets/img/freepik/filter_data_unavailable.svg') }}"
                            alt="" />
                        <p class="lead" style="font-weight: 700; color: #ff7400;">WoW data not available</p>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="col-lg-12 container-grid-activity container__grid mt-0 mt-lg-10p">
        @foreach ($activitys as $data)
            <div class="grid-list-container">
                <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                    @guest
                        <div class="list-like-button-container" style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="loginForm(1)" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    role="presentation" focusable="false" class="favorite-button favorite-button-28">
                                    <path
                                        d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    @endguest

                    @auth
                        @php
                            $cekActivity = App\Models\ActivitySave::where('id_activity', $data->id_activity)
                                ->where('id_user', Auth::user()->id)
                                ->first();
                        @endphp

                        @if ($cekActivity == null)
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_activity }}, 'activity')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button favorite-button-28 likeButtonactivity{{ $data->id_activity }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                                <a onclick="likeFavorit({{ $data->id_activity }}, 'activity')" style="cursor: pointer;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        class="favorite-button-active favorite-button-28 unlikeButtonactivity{{ $data->id_activity }}">
                                        <path
                                            d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    @endauth

                    <div class="like-sign" id="like-sign-{{ $data->id_activity }}">
                        <i class="fa fa-heart fa-lg" style="color: #e31c5f"></i>
                    </div>

                    <a href="{{ route('activity', $data->id_activity) }}" target="_blank" class="absolute-right">
                        <div class="video-thumb-container skeleton">
                            <div class="video-thumb-content">
                                <i class="fas fa-2x fa-play video-button"></i>
                                @if ($data->video->count() > 0)
                                    <video class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/activity/' . strtolower($data->uid) . '/' . $data->video->last()->name) }}#t=1.0"></video>
                                @elseif ($data->photo->count() > 0)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/activity/' . strtolower($data->uid) . '/' . $data->photo->last()->name) }}">
                                @elseif ($data->image != null)
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/activity/' . strtolower($data->uid) . '/' . $data->image) }}">
                                @else
                                    <img class="video-thumb lozad" src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}">
                                @endif
                            </div>
                        </div>
                    </a>


                    <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                        <input type="hidden" value="{{ $data->id_activity }}" id="id_activity" name="id_activity">
                        <div class="dots-container d-flex justify-content-center"></div>
                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white skeleton skeleton-w-100 skeleton-h-lg"
                            data-dots="false" data-arrows="true">

                            @forelse ($data->photo->sortBy('order') as $item)
                                <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                    class="col-lg-6 grid-image-container">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;"
                                        src="{{ LazyLoad::show() }}"
                                        data-src="{{ URL::asset('/foto/activity/' . strtolower($data->uid) . '/' . $item->name) }}"
                                        alt="EZV_{{ $item->name }}">
                                </a>
                            @empty
                                @if ($data->image)
                                    <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/activity/' . strtolower($data->uid) . '/' . $data->image) }}"
                                            alt="EZV_{{ $data->image }}">
                                    </a>
                                @else
                                    <a href="{{ route('activity', $data->id_activity) }}" target="_blank"
                                        class="col-lg-6 grid-image-container">
                                        <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto"
                                            style="display: block;" src="{{ LazyLoad::show() }}"
                                            data-src="{{ URL::asset('/foto/default/no-image.jpeg') }}"
                                            alt="EZV_no-image.jpeg">
                                    </a>
                                @endif
                            @endforelse

                        </div>
                    </div>

                </div>

                <div class="desc-container-grid mb-2">
                    <a href="{{ route('activity', $data->id_activity) }}" target="_blank" class="grid-overlay-desc"></a>
                    <div class="max-lines skeleton skeleton-w-100 skeleton-h-2">
                        <span class="text-14 max-lines fw-500 {{ $textColor }} list-description">
                            {{ $data->name ?? __('user_page.There is no name yet') }}
                        </span>
                    </div>
                    <div class="grid-one-line max-lines col-lg-10 skeleton skeleton-w-100 skeleton-h-1">
                        <span class="text-14 fw-400 text-grey-2 max-lines grid-one-line">
                            {{ Translate::translate($data->short_description) ?? __('user_page.There is no description yet') }}
                        </span>
                    </div>
                    <div class="skeleton">
                        @if ($data->price->count() <= 0 || !$data->price->sortBy('price')->first()->price)
                            <div class="text-14 fw-400 grid-one-line {{ $textColor }} list-description ">
                                {{ __('user_page.Price is unknown') }}
                            </div>
                        @else
                            <div class="text-14 fw-400 grid-one-line {{ $textColor }} list-description">
                                {{ __('user_page.Start from') }}
                                <span class="fw-600 ml-1 text-14 {{ $textColor }} list-description">
                                    {{ CurrencyConversion::exchangeWithUnit($data->price->sortBy('price')->first()->price) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div
                        class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 skeleton skeleton-w-50 skeleton-h-1">
                        <a class="orange-hover m-0" href="#!"
                            onclick="view_maps('{{ $data->id_activity }}')"></i><i class="fa-solid fa-location-dot"></i>
                            {{ $data->location->name ?? __('user_page.Location not found') }}
                        </a>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach


    </div>
    <!-- End Grid 43 -->
    </div>

    <div class="col-12" id="view-map-button-float">
        <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4">
            <button onclick="view_main_map()" style="height:inherit;">

                <div class="notice">
                    <span class="world">
                        <span class="images" style="color: #52EB35;">
                            <img src="{{ asset('assets/earth.svg') }}" alt="Earth SVG">
                        </span>
                    </span>
                </div>
                <!-- partial -->
            </button>
        </div>
    </div>
    <!-- End Refresh Page -->
    </div>
    <!-- End Page Content -->
    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center" id="footer">
        <div class="mt-3">
            {{ $activity->onEachSide(0)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- End Pagination --}}
    </div>
    {{-- modal laguage and currency --}}
    @include('user.modal.filter.filter_language')
    @include('user.modal.auth.login_register')
    @include('user.modal.activity.category')
    @include('user.modal.activity.sub_category')
    @include('user.modal.activity.intro')
    {{-- modal laguage and currency --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>
    {{-- Like Favorit --}}
    @auth
        @include('components.favorit.like-favorit')
    @endauth
    {{-- End Like Favorit --}}

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $(".js-slider").each(function(i, el) {
                var sliderLength = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        sliderLength = parseInt($(this).attr("data-slick-index"));
                        maxSlickIndex = sliderLength;
                    }
                })
                var dotsContainer = $(this).parent().find(".dots-container");
                if (sliderLength >= 4) {
                    for (var j = 0; j <= 4; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                } else if (sliderLength > 0 && sliderLength <= 4 && sliderLength != 0) {
                    for (var j = 0; j <= sliderLength; j++) {
                        if (j == 0) {
                            dotsContainer.append('<div class="circle activeIndicator" data-index=' + j +
                                '></div>');
                        } else {
                            dotsContainer.append('<div class="circle" data-index=' + j + '></div>');
                        }
                    }
                }
            });
            $('.js-slider').on("afterChange", function(e) {
                var currSlickIndex = parseInt($(this).find(".slick-current").attr("data-slick-index"));
                var maxSlickIndex = 0;
                $(this).find(".slick-slide").each(function(i, el) {
                    if (!$(this).hasClass("slick-cloned")) {
                        maxSlickIndex = parseInt($(this).attr("data-slick-index"));
                    }
                })
                var allDots = $(this).parent().find(".dots-container").find(".circle");
                var dots = $(this).parent().find(".dots-container").find(".circle");
                if (maxSlickIndex > 5) {
                    if (currSlickIndex > 1 && currSlickIndex <= maxSlickIndex - 2) {
                        allDots.removeClass("activeIndicator");
                        dots[2].classList.add("activeIndicator");
                    } else if (currSlickIndex <= 1) {
                        allDots.removeClass("activeIndicator");
                        dots[currSlickIndex].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex - 1) {
                        allDots.removeClass("activeIndicator");
                        dots[3].classList.add("activeIndicator");
                    } else if (currSlickIndex == maxSlickIndex) {
                        allDots.removeClass("activeIndicator");
                        dots[4].classList.add("activeIndicator");
                    }
                } else {
                    allDots.removeClass("activeIndicator");
                    dots[currSlickIndex].classList.add("activeIndicator");
                }
            });
            $('.js-slider .slick-next').css('display', 'none');
            $('.js-slider .slick-prev').css('display', 'none');
            $('.js-slider').mouseenter(function(e) {
                $(this).children('.slick-prev').css('display', 'block');
                $(this).children('.slick-next').css('display', 'block');
            })
            $('.js-slider').mouseleave(function(e) {
                $(this).children('.slick-prev').css('display', 'none');
                $(this).children('.slick-next').css('display', 'none');
            })
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

    {{-- ACTIVITY FILTER --}}
    <script>
        function activityRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/things-to-do/s?${suburl}`;
        }

        function wowRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/wow/search?${suburl}`;
        }

        function defaultURLwow() {
            window.location.href = `{{ env('APP_URL') }}/things-to-do-list`;
        }

        function subRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/wow/sub?${suburl}`;
        }
    </script>

    <script>
        function wowFilter(valueCategory, valueSub, clearSub, unCheckCategory) {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sKeywordFormInput = $("input[name='sKeyword']").val();
            var sStart = $("input[name='start_date']").val();
            var sEnd = $("input[name='end_date']").val();

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

            if (unCheckCategory == true) {
                var url_wow = window.location.href;
                var url2 = new URL(url_wow);

                if (url2.searchParams.get('fCategory') == valueCategory) {
                    valueCategory = '';
                }
            }

            var filterFormInput = [];
            $("input[name='subCategory[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });

            if (filterFormInput.includes(valueSub) == true) {
                var filterCheck = filterFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueSub;
                }

                var filteredArray = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                filterFormInput.push(valueSub);

                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }

            if (clearSub == 1) {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=${valueCategory}&fSubCategory=`;
            } else if (valueCategory == null) {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=&fSubCategory=${valueSub}`;
            } else {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sKeyword=${sKeywordFormInput}&sStart=${sStart}&sEnd=${sEnd}&fCategory=${valueCategory}&fSubCategory=${filteredArray}`;
            }

            wowRefreshFilter(subUrl);
        }
    </script>

    <script>
        $(window).on('load', function() {
            if (window.location.href == `{{ env('APP_URL') }}/wow-list?`) {
                $('#categoryModal').modal('show');
            }
        });

        // function moreCategory() {
        //     $('#categoryModal').modal('show');
        // }

        // function moreSubCategory() {
        //     $('#modalSubCategory').modal('show');
        // }
    </script>
    <script>
        // Show modal pop up on first time visit
        var thisshow = localStorage.getItem('thisshow');
        if (thisshow == null) {
            localStorage.setItem('thisshow', 1);
            // Show popup here
            setTimeout(function() {
                jQuery('#introModal').modal('show');
            }, 5000);
        }
    </SCRIPT>

    {{-- VIEW MAP --}}
    @include('user.modal.activity.list.map')
    {{-- END VIEW MAP --}}
    <script src="{{ asset('assets/js/translate.js') }}"></script>
@endsection
