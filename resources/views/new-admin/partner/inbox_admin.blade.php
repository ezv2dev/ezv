@extends('new-admin.layouts.admin_layout')

@section('title', 'Inbox - EZV2')

@section('content_admin')
    {{-- CONTENT --}}
    <div class="container container-dashboard px-4">

        <h1 class="fw-semibold mb-5">Inbox</h1>

        <div class="mb-4 tab-bar">
            <a class="title-bar active" href="#">Inbox</a>
            <a class="title-bar" href="#">Reply</a>
        </div>

        <div class="datatable">
            <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%"
                cellspacing="0">
                <thead style="color: #383838;" class="thead-dark table-borderless">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">USER</th>
                        <th class="text-center">OWNER</th>
                        <th class="text-center">MESSAGE</th>
                        <th class="d-sm-table-cell text-center">CREATED AT</th>
                        <th class="d-sm-table-cell text-center">UPDATED AT</th>
                        <th class="d-sm-table-cell text-center">APPROVAL STATUS</th>
                        <th class="text-center" style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot style="color: #383838">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">USER</th>
                        <th class="text-center">OWNER</th>
                        <th class="text-center">MESSAGE</th>
                        <th class="d-sm-table-cell text-center">CREATED AT</th>
                        <th class="d-sm-table-cell text-center">UPDATED AT</th>
                        <th class="d-sm-table-cell text-center">APPROVAL STATUS</th>
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
            dom: "<'layout-header-footer'<l><f>>" +
                "<'overflow-x-scroll'<tr>>" +
                "<'layout-header-footer'<i><p>>",
            pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [
                [10, 20, 50],
                [10, 20, 50]
            ],
            autoWidth: !1,

            processing: true,
            serverSide: true,
            ajax: "{{ route('inbox_datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'sender',
                    name: 'sender',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'owner',
                    name: 'owner',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'message',
                    name: 'message',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'font-w600 font-size-sm'
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
