@extends('new-admin.layouts.admin_layout')

@section('title', 'Hotel Listing - EZV2')

@section('content_admin')
    <!-- Hero -->
    <style>
        .overflow-x-scroll{
            overflow-x:scroll;
        }
        .layout-header-footer{
            display:flex;
            flex-direction:column;
            text-align:center;
            align-items:center;
            row-gap:12px;
        }

        @media (min-width: 768px) { 
            .layout-header-footer{
                flex-direction:row;
                text-align:left;
                justify-content:space-between;
                row-gap:0px;
            }
        }
    </style>
    <div class="container px-4">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center my-3">
                    <h1 class="flex-grow-1 fs-3 fw-semibold ">{{$data}} Listing</h1>
                    <!-- <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary" href="{{ route('admin_add_listing') }}">
                            <i class="fa fa-plus-circle mr-2"></i> Create Listing
                        </a>
                    </ol>
                    </nav> -->
                    <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary btn-light py-3 px-4" href="{{ route('admin_add_listing') }}">
                        <i class="fa fa-plus-circle mr-2"></i> Create Listing
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container px-4">
        <!-- Example DataTable for Dashboard Demo-->
        <div class="" style="margin-bottom: 50px;">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Listing</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Todo</th>
                        <th class="text-center">Instant Book</th>
                        <th class="text-center">Bedrooms</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">Beds</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Baths</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Location</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Last Modified</th>
                        {{-- <th class="text-center" style="width: 15%;">ACTION</th> --}}
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Listing</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Todo</th>
                        <th class="text-center">Instant Book</th>
                        <th class="text-center">Bedrooms</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">Beds</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Baths</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Location</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Last Modified</th>
                        {{-- <th class="text-center" style="width: 15%;">ACTION</th> --}}
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
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
            ajax: "{{ route('dashboard_listing_hotel_datatable') }}",
            columns: [
                {
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
                {
                    data: 'todo',
                    name: 'todo',
                    class: 'font-w600 font-size-sm',
                    orderable: false,
                    searchable: false,
                },
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
                // {
                //     data: 'aksi',
                //     name: 'aksi',
                //     orderable: false,
                //     searchable: false
                // }
            ],
            responsive: true
        });

    </script>
@endsection
