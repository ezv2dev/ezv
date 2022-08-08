@extends('new-admin.layouts.admin_layout')

@section('title', 'Listing Dashboard - EZV2')

@section('content_admin')
    <style>
        .overflow-x-scroll {
            overflow-x: auto;
        }

        .layout-header-footer {
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            row-gap: 12px;
        }

        .container-dashboard{
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

            .container-dashboard{
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
        }
        .search-listing input {
            width: 100%;
            height: 40px;
            padding: 10px 20px;
            border-radius: 12px;
            border: solid 1px #757575;
            outline: none;
            min-height: 50px;
        }
        .btn-create-listing, .btn-create-listing:hover {
            background: #ff7400;
            color: #fff;
            border-radius: 12px;
            padding: 10px 20px;
            border: solid 1px #ff7400;
            outline: none;
            font-weight: 600;
            min-height: 50px;
        }
        .btn-create-listing:hover, .btn-create-listing:focus {
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
        .listing-card {
            padding: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 1rem 0.2rem rgb(0 0 0 / 10%);
        }
        .list-listing-img img {
            max-width: 100%;
            aspect-ratio: 4/5;
            border-radius: 12px;
            min-height: 100%;
            object-fit: cover;
        }
        .listing-card-title {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.2;
            color: #ff7400;
        }
        .last-mod {
            font-size: 12px;
            font-weight: 600;
            color: #767676;
        }
        .listing-status {
            color: #fff;
            width: fit-content;
            padding: 5px 10px;
            font-size: 12px;
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
            font-size: 13px;
            color: #7e8282;
            font-weight: 600;
        }
        .listing-action {
            width: 100%;
            border: solid 1px #ff7400;
            background: #ff7400;
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 4px 12px;
        }
    </style>
    <!-- Hero -->
    <div class="container container-dashboard px-4">
        <div class="bg-body-light">
            <div class="content content-full">
                <!-- <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center my-3 ">
                    <h1 class="flex-grow-1 fs-3 fw-semibold ">{{ $data }} Listing</h1> -->
                    <!-- <nav class="flex-shrink-0" aria-label="breadcrumb"> -->
                                <!-- <ol class="breadcrumb">
                                    <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary " href="{{ route('admin_add_listing') }}">
                                        <i class="fa fa-plus-circle mr-2"></i> Create Listing
                                    </a>
                                </ol>
                            </nav>
                    <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary btn-light py-3 px-4"
                        href="{{ route('admin_add_listing') }}">
                        <i class="fa fa-plus-circle mr-2"></i> Create Listing
                    </a>
                </div> -->
                <div class="row">
                    <div class="col-4 pt-10">
                        <h1 class="flex-grow-1 fs-3 fw-semibold ">{{ $data }} Listing</h1>
                    </div>
                    <div class="col-4 text-center search-listing">
                        <input type="text" placeholder="Search...">
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
        <!-- Example DataTable for Dashboard Demo-->
        <!-- <div class="" style="margin-bottom: 50px; ">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Listing</th>
                        <th class="text-center">Status</th>
                        {{-- <th class="text-center">Todo</th> --}}
                        <th class="text-center">Instant Book</th>
                        <th class="text-center">Bedrooms</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">Beds</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Baths</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Location</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Last Modified</th>
                        <th class="text-center" style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Listing</th>
                        <th class="text-center">Status</th>
                        {{-- <th class="text-center">Todo</th> --}}
                        <th class="text-center">Instant Book</th>
                        <th class="text-center">Bedrooms</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">Beds</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Baths</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Location</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Last Modified</th>
                        <th class="text-center" style="width: 15%;">ACTION</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div> -->
        <div class="row-grid-listing">
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/hHz4yrvxwlA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Bharada E Brand New Luxury Villa</p>
                        <p class="last-mod">Last Modified 1 Hours Ago</p>
                        <p class="listing-status inactive">Inactive Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Belig Gg. Batu Ilang 14X, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/qlOyTwSyypA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Ferdy Sambo Family Villa and Spa</p>
                        <p class="last-mod">Last Modified 12 Hours Ago</p>
                        <p class="listing-status activated">Active Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Bolong Gg. Batu Selem 124, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/hHz4yrvxwlA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Bharada E Brand New Luxury Villa</p>
                        <p class="last-mod">Last Modified 1 Hours Ago</p>
                        <p class="listing-status inactive">Inactive Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Belig Gg. Batu Ilang 14X, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/qlOyTwSyypA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Ferdy Sambo Family Villa and Spa</p>
                        <p class="last-mod">Last Modified 12 Hours Ago</p>
                        <p class="listing-status activated">Active Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Bolong Gg. Batu Selem 124, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/hHz4yrvxwlA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Bharada E Brand New Luxury Villa</p>
                        <p class="last-mod">Last Modified 1 Hours Ago</p>
                        <p class="listing-status inactive">Inactive Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Belig Gg. Batu Ilang 14X, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/qlOyTwSyypA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Ferdy Sambo Family Villa and Spa</p>
                        <p class="last-mod">Last Modified 12 Hours Ago</p>
                        <p class="listing-status activated">Active Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Bolong Gg. Batu Selem 124, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/hHz4yrvxwlA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Bharada E Brand New Luxury Villa</p>
                        <p class="last-mod">Last Modified 1 Hours Ago</p>
                        <p class="listing-status inactive">Inactive Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Belig Gg. Batu Ilang 14X, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
            <div class="listing-card">
                <div class="row">
                    <div class="col-12 col-md-6  list-listing-img">
                        <img src="https://source.unsplash.com/qlOyTwSyypA/">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="listing-card-title">Ferdy Sambo Family Villa and Spa</p>
                        <p class="last-mod">Last Modified 12 Hours Ago</p>
                        <p class="listing-status activated">Active Listing</p>
                        <p class="listing-info">Instant Book: No<br>
                        Bedroom: 4<br>
                        Beds: 6<br>
                        Bath: 2<br>
                        Location: Jl. Batu Bolong Gg. Batu Selem 124, Seminyak, Kuta Utara, Bali 80361
                        </p>
                        <button class="listing-action">Action</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align:center; padding: 20px 0;"><p><&nbsp;&nbsp;<span style="font-size: larger; letter-spacing: 10px; font-weight: 600;">1</span><span style="font-size: 22px; background: #ff7400; padding: 3px 12px; border-radius: 50%; margin-right: 10px; color: #fff; font-weight: 600;">2</span><span style="font-size: larger; letter-spacing: 10px; font-weight: 600;">3 ... 7 8 9</span>&nbsp;></p>
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

    <script>
        // load_tabel_first();
        var table = $('#dataTable').dataTable({
            // dom: "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            dom: "<'layout-header-footer'<l><f>>" +
                "<'overflow-x-scroll'<tr>>" +
                "<'layout-header-footer'<i><p>>",
            pagingType: "full_numbers",
            pageLength: 10,
            lengthChange: false,
            lengthMenu: [
                [10, 20, 50],
                [10, 20, 50]
            ],
            autoWidth: !1,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_listing_datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'listing',
                    name: 'listing',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'font-w600 font-size-sm'
                },
                // {
                //     data: 'todo',
                //     name: 'todo',
                //     class: 'font-w600 font-size-sm',
                //     orderable: false,
                //     searchable: false,
                // },
                {
                    data: 'instantBook',
                    name: 'instantBook',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'bedroom',
                    name: 'bedroom',
                    class: 'font-w600 font-size-md'
                },
                {
                    data: 'beds',
                    name: 'beds',
                    class: 'font-w600 font-size-md d-none d-sm-table-cell'
                },
                {
                    data: 'bathroom',
                    name: 'bathroom',
                    class: 'font-w600 font-size-md d-none d-sm-table-cell'
                },
                {
                    data: 'address',
                    name: 'address',
                    class: 'font-w600 font-size-md d-none d-sm-table-cell'
                },
                {
                    data: 'last_modified',
                    name: 'last_modified',
                    class: 'font-w600 font-size-md d-none d-sm-table-cell'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            responsive: true
        });
    </script>
@endsection
