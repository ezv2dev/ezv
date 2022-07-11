@extends('layouts.user.list')

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

</style>

@section('content')
    <div id="body-color" class="bg-body-black">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12 grid-container-43">
                <!-- Grid 43 -->
                @foreach ($collab as $data)
                    <div class="row list-row-gap">
                        <!-- Left Sedtion -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-image-container">
                            <div class="content list-image-content">
                                <input type="hidden" value="{{ $data->id_collab }}" id="id_collab" name="id_collab">
                                <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                    data-dots="false" data-arrows="true">
                                    @php
                                        $gallery = App\Http\Controllers\Collaborator\CollaboratorController::gallery($data->id_collab);
                                    @endphp
                                    @forelse ($gallery as $item)
                                        <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                            class="col-lg-6 grid-image-container">
                                            <img class="img-fluid grid-image" style="display: block;"
                                                src="{{ URL::asset('/foto/collaborator/' . $data->id_collab . '/' . $item->photo) }}"
                                                {{-- src="{{ URL::asset('foto/collaborator/1/1.jpg') }}" --}} alt="EZV_{{ $item->photo }}">
                                        </a>
                                    @empty
                                        @if ($data->image)
                                            <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/foto/collaborator/' . $item->id_collab . '/' . $data->image) }}"
                                                    alt="EZV_{{ $item->photo }}">
                                            </a>
                                        @else
                                            <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                                class="col-lg-6 grid-image-container">
                                                <img class="img-fluid grid-image" style="display: block;"
                                                    src="{{ URL::asset('/template/collab/template_profile.jpg') }}"
                                                    alt="EZV_{{ $item->photo }}">
                                            </a>
                                        @endif
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- End Left Section -->
                        <!-- Right Section -->
                        <div class="col-lg-6 col-xs-12 grid-image-container grid-desc-container list-desc-container">
                            <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank"
                                class=" overlay-desc"></a>
                            <div class="row">
                                <div class="col-lg-9 float-left">
                                    <p class="villa-list-name" style="color: #ff7400;">{{ $data->name }}</p>
                                    <div class="villa-list-title py-3">
                                        <div class="list-description font-light" style="margin-right: 4px;">
                                            • {{ $data->phone }} Phone
                                        </div>
                                        <div class="list-description font-light">
                                            • {{ $data->email }} Email
                                        </div>
                                        <div class="list-description font-light">
                                            • {{ $data->address }} Address
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 float-left-align-right">
                                    <a href="{{ route('collaborator', $data->id_collab) }}" target="_blank">
                                        <div class="villa-list-video-container video-show-buttons">
                                            <i class="fas fa-2x fa-play video-button"></i>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-lg-12 villa-list-description-container">
                                    <p class="col-lg-12 villa-list-title font-light list-description">
                                        {{ $data->description }}</p>
                                </div>
                                <div class="col-lg-12 villa-list-desc-container">
                                    <div class="col-lg-12 villa-list-price">
                                        <span class="villa-list-price list-description font-light">
                                            IDR {{ number_format($data->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="list-row row-line-white">
                @endforeach
                <!-- End Grid 43 -->
                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{-- {{ $collab->links('vendor.pagination.bootstrap-4') }} --}}
                </div>
                {{-- End Pagination --}}
            </div>
            <!-- End Refresh Page -->
        </div>
        <!-- End Page Content -->
        {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
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

    {{-- SEARCH FUNCTION --}}
    <script>
        function collabRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/searchcollabcombine?${suburl}`;
        }
    </script>

    <script>
        function collabFilter() {
            var fMaxPriceFormInput = [];
            $("input[name='fMaxPrice[]']").each(function() {
                fMaxPriceFormInput.push(parseInt($(this).val()));
            });

            var fMinPriceFormInput = [];
            $("input[name='fMinPrice[]']").each(function() {
                fMinPriceFormInput.push(parseInt($(this).val()));
            });

            var fPropertyFormInput = [];
            $("input[name='fProperty[]']:checked").each(function() {
                fPropertyFormInput.push(parseInt($(this).val()));
            });

            var fBedroomFormInput = [];
            $("input[name='fBedroom[]']").each(function() {
                fBedroomFormInput.push(parseInt($(this).val()));
            });

            var fBathroomFormInput = [];
            $("input[name='fBathroom[]']").each(function() {
                fBathroomFormInput.push(parseInt($(this).val()));
            });

            var fBedsFormInput = [];
            $("input[name='fBeds[]']").each(function() {
                fBedsFormInput.push(parseInt($(this).val()));
            });

            var fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });

            var fSuitableFormInput = [];
            $("input[name='fSuitable[]']:checked").each(function() {
                fSuitableFormInput.push(parseInt($(this).val()));
            });

            var sLocationFormInput = $("input[name='sLocation']").val();

            var sCheck_inFormInput = $("input[name='sCheck_in']").val();

            var sCheck_outFormInput = $("input[name='sCheck_out']").val();

            var sAdultFormInput = $("input[name='sAdult']").val();

            var sChildFormInput = $("input[name='sChild']").val();

            var subUrl =
                `fMaxPrice=${fMaxPriceFormInput}&fMinPrice=${fMinPriceFormInput}&fProperty=${fPropertyFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fFacilities=${fFacilitiesFormInput}&fSuitable=${fSuitableFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            collabRefreshFilter(subUrl);
        }
    </script>
    {{-- END SEARCH FUNCTION --}}



    {{-- REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 1024 --}}
    {{-- <script>
    var search = new URLSearchParams(window.location.search);
    $(window).on('resize', () => {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            search.set('screen', 'mobile');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            search.set('screen', 'desktop');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
    });
    $(document).ready(() => {
        if ($(window).width() < 1024 && '{{ request()->screen ?? "" }}' != 'mobile') {
            search.set('screen', 'mobile');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
        if ($(window).width() > 1024 && '{{ request()->screen ?? "" }}' != 'desktop') {
            search.set('screen', 'desktop');
            window.location.href = window.location.origin + window.location.pathname + '?' + search.toString();
        }
    });

</script> --}}
    {{-- END REDIRECT TO NEW PAGE WHEN SCREEN SIZE IS UNDER 900 --}}
@endsection
