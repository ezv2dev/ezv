@extends('new-admin.layouts.admin_layout')

@section('title', 'Food Listing - EZV2')

@section('content_admin')
    <style>
        .overflow-x-scroll {
            overflow-x: auto;
        }

        .d-none {
            display: none;
        }

        .d-block {
            display: block;
        }

        .location-popup {
            position: absolute;
            width: 345px;
            background-color: white;
            left: 50%;
            transform:translateX(-50%);
            padding-top: 1px !important;
            padding-bottom: 10px !important;
            padding-left: 3px !important;
            padding-right: 3px !important;
            top: 60px;
            z-index: 99;
            border-radius: 12px !important;
            text-align: left;
            border: 2px solid #ff7400;
            height: 287px;
        }

        .location-popup-container {
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0px !important;
        }

        .location-popup-container::-webkit-scrollbar {
            width: 10px;
        }

        .location-popup-container::-webkit-scrollbar-thumb {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #f0f0f0;
            border-radius: 30px;
        }

        .location-popup-container::-webkit-scrollbar-thumb:hover {
            background-color: #e0e0e0;
        }

        .location-popup-desc-container {
            display: flex;
            padding-top: 9px !important;
            padding-bottom: 9px !important;
            display: flex;
            align-items: center;
        }


        .location-popup-map {
            background-color: #ff7400;
            height: 55px;
            width: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .location-popup-map-load {
            background-color: #e0e0e0;
            height: 55px;
            width: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .location-popup-map-image {
            height: 55px;
            width: 55px;
            border-radius: inherit;
            border: 2px solid #e0e0e0;
        }

        .nav-link-title {
            margin: 7px 0px 0px 0px;
            font-size: 14px;
        }

        .location-popup-text {
            font-size: 15px;
            display: flex;
            align-items: center;
            padding-left: 5px !important;
            padding-right: 0px !important;
        }

        .location-popup-text .location_op,
        .location-popup-text .location_op:hover,
        .location-popup-text .location_op2,
        .location-popup-text .location_op2:hover {
            color: #ff7400;
        }

        .px-md-4 {
            padding: 3px 0 16px 0;
        }

        .px-md-4:hover {
            padding: 5px 0 14px 0;
        }

        .fs-3 {
            font-size: 1.15rem !important;
        }

        .layout-header-footer {
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            row-gap: 12px;
        }

        .container-dashboard {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        @media (min-width: 768px) {
            .layout-header-footer {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                row-gap: 0px;
            }

            .container-dashboard {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
        }

        .search-listing input {
            width: 100%;
            height: 40px;
            padding: 10px 20px;
            border-radius: 12px;
            border: solid 1px #d5d5d5;
            outline: none;
            min-height: 50px;
        }

        .btn-create-listing,
        .btn-create-listing:hover {
            background: #ff7400;
            color: #fff;
            border-radius: 12px;
            padding: 10px 20px;
            border: solid 1px #ff7400;
            outline: none;
            font-weight: 600;
            min-height: 50px;
        }

        .btn-create-listing:hover,
        .btn-create-listing:focus {
            color: #fff;
        }

        .pt-10 {
            padding-top: 10px !important;
        }

        .row-grid-listing {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            grid-template-rows: repeat(1, auto) !important;
            gap: 25px;
            display: grid;
        }

        @media only screen and (max-width: 768px) {
            .row-grid-listing {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }

        @media only screen and (min-width: 426px) and (max-width: 768px) {
            .list-listing-img img {
                aspect-ratio: 11/7.2 !important;
            }
        }

        .listing-card {
            padding: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 1rem 0.2rem rgb(0 0 0 / 10%);
        }

        .list-listing-img img {
            max-width: 100%;
            aspect-ratio: 4/3.9;
            border-radius: 12px;
            object-fit: cover;
        }

        .listing-card-title {
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
            color: #ff7400;
        }

        .last-mod {
            font-size: 10px;
            font-weight: 600;
            color: #767676;
        }

        .listing-status {
            margin-top: 10px;
            color: #fff;
            width: fit-content;
            padding: 3px 8px;
            font-size: 10px;
            border-radius: 12px;
            font-weight: 600;
        }

        .inactive {
            background: #ff0000;
        }

        .activated {
            background: #008000;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .listing-info {
            font-size: 11px;
            color: #7e8282;
            font-weight: 600;
        }

        .listing-button {
            width: 100%;
            text-align: center;
        }

        .listing-action {
            width: 100%;
            border: solid 1px #ff7400;
            background: #ff7400;
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 4px 12px;
            font-size: 12px;
        }

        .listing-action:hover{
            text-decoration:none;
            color:white;
        }

        .last-mod span,
        .listing-info span {
            display: block;
        }

        @media only screen and (max-width: 768px) {
            .fs-3 {
                font-size: calc(0.7rem + .6vw) !important;
            }

            .search-listing input {
                height: 30px;
                padding: 5px 10px;
                border-radius: 8px;
                min-height: 30px;
                font-size: 11px;
            }

            .btn-create-listing,
            .btn-create-listing:hover {
                border-radius: 8px;
                padding: 5px 3px;
                min-height: 30px;
                font-size: 10px;
                height: 30px;
                width: 100%;
            }

            .pt-10 {
                padding-top: 5px !important;
            }

            .list-listing-img img {
                aspect-ratio: 8/6;
            }

            .last-mod span {
                display: inline-flex;
                margin-left: 5px;
            }

            .last-mod {
                font-size: 10px;
            }

            .listing-status {
                padding: 3px 7px;
                font-size: 10px;
            }

            .listing-card-title {
                font-size: 14px;
                margin-top: 20px;
            }

            .listing-info {
                margin-left: 10px;
            }

            .listing-info span {
                display: inline-flex;
                margin-right: 10px;
                margin-left: -10px;
            }

            .listing-info span::before {
                content: '•';
                margin-right: 3px;
            }

            .listing-button {
                margin-top: 20px;
            }

            .listing-action {
                /* width: 70%; */
                padding: 2px 10px;
                border-radius: 6px;
            }
        }
    </style>
    <!-- Hero -->
    @php
    if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
        $restaurantName = App\Models\Restaurant::select('id_restaurant', 'name')->get();
    } else {
        $restaurantName = App\Models\Restaurant::where('created_by', Auth::user()->id)
            ->select('id_restaurant', 'name')
            ->get();
    }
    @endphp
    <div class="container container-dashboard px-4">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="row">
                    <div class="col-4 pt-10">
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <h1 class="flex-grow-1 fs-3 fw-semibold ">{{ $restaurantName->count() }} Total Listing</h1>
                        @else
                            <h1 class="flex-grow-1 fs-3 fw-semibold ">{{ $data }} Total Listing</h1>
                        @endif
                    </div>
                    <div class="col-4 text-center search-listing">
                        <input type="text" onfocus="this.value=''" autocomplete="off"
                            class="form-control input-transparant input-location" style="margin-top: -2px;" id="loc_sugest"
                            name="sLocation" placeholder="Search your listing here...">

                        <div id="sugest" class="location-popup d-none">
                            <div class="location-popup-container h-100">
                                @foreach ($restaurantName as $item)
                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first lozad"
                                        loading="lazy"
                                        onclick="window.open('{{ route('restaurant', $item->id_restaurant) }}', '_blank');"
                                        style="display: none">
                                        <div class="location-popup-map sugest-list-map">
                                            <img class="location-popup-map-image lozad" loading="lazy"
                                                src="{{ LazyLoad::show() }}"
                                                data-src="{{ asset('assets/icon/map/restaurant.png') }}">
                                        </div>
                                        <div class="location-popup-text sugest-list-text">
                                            <a type="button" class="location_op"
                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($restaurantName as $item)
                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                        style="display: none; cursor: pointer;"
                                        onclick="window.open('{{ route('restaurant', $item->id_restaurant) }}', '_blank');">
                                        <div class="location-popup-map sugest-list-map">
                                            <img class="location-popup-map-image lozad" loading="lazy"
                                                src="{{ LazyLoad::show() }}"
                                                data-src="{{ asset('assets/icon/map/restaurant.png') }}">
                                        </div>
                                        <div class="location-popup-text sugest-list-text">
                                            <a href="{{ route('restaurant', $item->id_restaurant) }}" type="button"
                                                class="location_op" target="_blank"
                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                    style="display: none">
                                    <p>Data not found</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-right create-listing">
                        <a type="button" class="btn btn-sm btn-create-listing"
                            href="{{ route('admin_add_listing') }}">Create Listing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container px-4">
        <div class="row-grid-listing">
            @foreach ($restaurant as $item)
                <div class="listing-card">
                    <div class="row">
                        <div class="col-12 col-md-6  list-listing-img">
                            <img class="lozad" loading="lazy" src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/restaurant/' . strtolower($item->uid) . '/' . $item->image) }}"
                                alt="EZV_{{ $item->image }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="listing-card-title">{{ $item->name }}</p>
                            <p class="last-mod">Last Modified
                                {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                                @if ($item->status == 1)
                                    <span class="listing-status activated">Active Listing</span>
                                @else
                                    <span class="listing-status inactive">Inactive Listing</span>
                                @endif
                            </p>
                            <p class="listing-info">
                                <span>Phone: {{ $item->phone }}</span>
                                <span>Email: {{ $item->email }}</span>
                            </p>
                            <a type="button" href="{{ route('restaurant', $item->id_restaurant) }}" target="_blank"
                                    class="listing-action listing-button">Action</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        <div class="mt-3">
            {{ $restaurant->onEachSide(0)->appends(Request::all())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    @include('new-admin.layouts.footer')

    {{-- END CONTENT --}}
@endsection

@section('scripts')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>

    {{-- Search Location --}}
    <script>
        $(document).ready(() => {
            $(".btn-close-expand-navbar-mobile").on("click", function() {
                $("body").css({
                    "height": "auto",
                    "overflow": "auto"
                })
                $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                $(".expand-navbar-mobile").attr("aria-expanded", "false");
                $("#overlay").css("display", "none");
            })
            $("#expand-mobile-btn").on("click", function() {
                $("body").css({
                    "height": "100%",
                    "overflow": "hidden"
                })
                $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                $(".expand-navbar-mobile").attr("aria-expanded", "true");
                $("#overlay").css("display", "block");
            })
            $('#overlay').click(function() {
                $("body").css({
                    "height": "auto",
                    "overflow": "auto"
                })
                $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                $(".expand-navbar-mobile").attr("aria-expanded", "false");
                $("#overlay").css("display", "none");
            })
            $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                var ids = $(".sugest-list-first");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                    // console.log(rndInt);
                    ids.show();
                };

                $('#sugest').removeClass("d-none");
                $('#sugest').addClass("d-block"); //add the class to the clicked element
            });

            $(document).mouseup(function(e) {
                var container = $('#sugest');

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.removeClass("d-block");
                    container.addClass("d-none");
                }
            });
            
            $(document).on('scroll', function(){
                if(!$('#sugest').hasClass('d-none')){
                    $('#sugest').addClass("d-none");
                    $('#sugest').removeClass("d-block"); 
                }
            })

            $("#loc_sugest").on('keyup change', async () => {
                var close = $(".sugest-list-first");
                close.hide();
                var ids = $(".sugest-list");
                ids.hide();
                $(".sugest-list-empty").eq(0).hide();

                var formValue = $("#loc_sugest").val();
                var isEmpty = true;

                $(".sugest-list").map((data) => {
                    var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                        .children('a').text();
                    if (name.toLowerCase().includes(formValue.toLowerCase())) {
                        $(".sugest-list").eq(data).show();
                        isEmpty = false;
                    }
                });

                if (isEmpty) {
                    $(".sugest-list-empty").eq(0).show();
                }

                if (formValue.length === 0) {
                    close.show();
                    ids.hide();
                }
            });

            $(".location_op").on('click', function(e) {
                $('#loc_sugest').val($(this).data("value"));
                $('#sugest').removeClass("d-block");
                $('#sugest').addClass("d-none");

                //calendar show when user filled location
                var content_flatpickr = document.getElementById('popup_check_search');
                if (content_flatpickr.style.display === "block") {
                    content_flatpickr.style.display = "none";
                } else {
                    content_flatpickr.style.display = "block";
                    document.addEventListener('mouseup', function(e) {
                        let container = content_flatpickr;
                        if (!container.contains(e.target)) {
                            container.style.display = 'none';
                        }
                    });
                }
            });
        });
    </script>
@endsection
