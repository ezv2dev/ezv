@extends('new-admin.layouts.admin_layout')

@section('title', 'User Reward Programm - EZV2')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">User Reward</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container">
        <!-- Example DataTable for Dashboard Demo-->
        <div class="row mb-5">
            <div class="col-12">
                <div class="datatable">
                    <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead style="color: #383838;" class="thead-dark table-borderless">
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">USER</th>
                                <th class="text-center">REFERENCE CODE</th>
                                <th class="text-center">START PROGRAM</th>
                                <th class="text-center">END PROGRAM</th>
                                <th class="text-center">STATUS</th>
                                <th class="d-none d-sm-table-cell text-center">CREATED AT</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">USER</th>
                                <th class="text-center">REFERENCE CODE</th>
                                <th class="text-center">START PROGRAM</th>
                                <th class="text-center">END PROGRAM</th>
                                <th class="text-center">STATUS</th>
                                <th class="d-none d-sm-table-cell text-center">CREATED AT</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
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
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_user_reward_datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'id_user',
                    name: 'id_user',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'reference_code',
                    name: 'reference_code',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'start_program',
                    name: 'start_program',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'end_program',
                    name: 'end_program',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
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
