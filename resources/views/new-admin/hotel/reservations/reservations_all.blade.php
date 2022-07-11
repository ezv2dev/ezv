@extends('new-admin.layouts.admin_layout')

@section('title', 'Hotel Reservations - EZV2')

@section('content_admin')
    <!-- Hero -->
    <div class="container mb-3">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Hotel Reservations</h1>
                    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    {{-- <ol class="breadcrumb">
                        <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary" href="#">
                            <i class="fa fa-plus-circle mr-2"></i> Create Listing
                        </a>
                    </ol> --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container" style="margin-bottom: 40px;">

        <div class="col-12">

            <div class="col-md-7 mt-5" style="border-bottom: 1px solid #DFDFDE;">
                <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                    <a style="text-decoration: none;" href="{{ route('hotel_room_reservations_dashboard') }}"><h6>Upcoming</h6></a>
                </div>
                <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                    <a style="text-decoration: none;" href="#"><h6>Completed</h6></a>
                </div>
                <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                    <a style="text-decoration: none;" href="#"><h6>Canceled</h6></a>
                </div>
                <div class="title-bar" style="margin-right: 20px; border-bottom: 2px solid #FF7400; display: inline-block;">
                    <a style="text-decoration: none;" href="{{ route('hotel_reservations_all') }}"><h6><b>All</b></h6></a>
                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="container" style="margin-top: 30px;">
                <div class="datatable">
                    <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%" cellspacing="0">
                        <thead style="color: #383838;" class="thead-dark table-borderless">
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NO INVOICE</th>
                                <th class="text-center">HOTEL NAME</th>
                                <th class="d-none d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                                <th class="d-none d-sm-table-cell text-center" >PRICE</th>
                                <th class="d-none d-sm-table-cell text-center" >STATUS</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                            <tfoot style="color: #383838">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">NO INVOICE</th>
                                    <th class="text-center">HOTEL NAME</th>
                                    <th class="d-none d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                                    <th class="d-none d-sm-table-cell text-center" >PRICE</th>
                                    <th class="d-none d-sm-table-cell text-center" >STATUS</th>
                                    <th class="text-center" style="width: 15%;">ACTION</th>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- END CONTENT --}}

    @include('new-admin.layouts.footer')

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
            dom:
            "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            pagingType:"full_numbers",
            pageLength:10,
            lengthMenu:[[10,20,50],[10,20,50]],
            autoWidth:!1,

            processing: true,
            serverSide: true,
            ajax:"{{ route('hotel_reservations_datatable_all') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
                { data: 'no_inv', name: 'no_inv', class:'font-w600 font-size-sm' },
                { data: 'name_hotel', name: 'name_hotel', class:'font-w600 font-size-sm' },
                { data: 'in_out', name: 'in_out', class:'font-w600 font-size-sm' },
                { data: 'total_price', name: 'total_price', class:'font-w600 font-size-sm' },
                { data: 'status', name: 'status', class:'font-w600 font-size-sm' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            responsive: true
        });
    </script>

@endsection
