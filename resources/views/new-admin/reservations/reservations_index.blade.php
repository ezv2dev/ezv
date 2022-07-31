@extends('new-admin.layouts.admin_layout')

@section('title', 'Reservations Dashboard - EZV2')

@section('content_admin')
    {{-- CONTENT --}}
    <div class="container container-dashboard px-4">

        <h1 class="fw-semibold mb-5">Reservations</h1>

        <div class="mb-4 tab-bar">
            <a class="title-bar active" href="{{ route('reservations_dashboard') }}">Upcoming</a>
            <a class="title-bar" href="{{ route('reservations_completed_index') }}">Completed</a>
            <a class="title-bar" href="{{ route('reservations_canceled_index') }}">Canceled</a>
            <a class="title-bar" href="{{ route('reservations_all_index') }}">All</a>
        </div>

        <div class="datatable">
            <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%" cellspacing="0">
                <thead style="color: #383838;" class="thead-dark table-borderless">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NO INVOICE</th>
                        <th class="text-center">VILLA NAME</th>
                        <th class="d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                        <th class="d-sm-table-cell text-center" >PRICE</th>
                        <th class="d-sm-table-cell text-center" >STATUS</th>
                        <th class="text-center" style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                    <tfoot style="color: #383838">
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NO INVOICE</th>
                            <th class="text-center">VILLA NAME</th>
                            <th class="d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                            <th class="d-sm-table-cell text-center" >PRICE</th>
                            <th class="d-sm-table-cell text-center" >STATUS</th>
                            <th class="text-center" style="width: 15%;">ACTION</th>
                        </tr>
                    </tfoot>
            </table>
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
            // dom:
            // "<'row'<'col-sm-12 col-md-9'l><'col-resv col-sm-12 col-md-3'f>>" +
            // "<'row'<'col-sm-12'tr>>" +
            // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            dom: "<'layout-header-footer'<l><f>>" +
            "<'overflow-x-scroll'<tr>>" +
            "<'layout-header-footer'<i><p>>",
            pagingType:"full_numbers",
            pageLength:10,
            lengthMenu:[[10,20,50],[10,20,50]],
            autoWidth:!1,

            processing: true,
            serverSide: true,
            ajax:"{{ route('reservations_datatable_upcoming') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
                { data: 'no_inv', name: 'no_inv', class:'font-w600 font-size-sm' },
                { data: 'name_villa', name: 'name_villa', class:'font-w600 font-size-sm' },
                { data: 'in_out', name: 'in_out', class:'font-w600 font-size-sm' },
                { data: 'total_price', name: 'total_price', class:'font-w600 font-size-sm' },
                { data: 'status', name: 'status', class:'font-w600 font-size-sm' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            responsive: true
        });
    </script>

@endsection
