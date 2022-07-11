@extends('new-admin.layouts.admin_layout')

@section('title', 'Approval Government Page - EZV2')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: transparent; margin-bottom: 0;">
                        <li class="breadcrumb-item">
                            <a href="{{ route('account_setting') }}" style="color: #ff7400 !important">Account</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Government Approved</li>
                    </ol>
                </nav>
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 mx-3 fs-3 fw-semibold">Data Government Approved</h1>
                    {{-- <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary" href="#">
                                <i class="fa fa-eye mr-2"></i> View Approved Data
                            </a>
                        </ol>
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container">

        <div class="col-12">

            <div class="col-md-7 mt-5" style="border-bottom: 1px solid #DFDFDE;">
                <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                    <a style="text-decoration: none;" href="{{ route('government_approval_index') }}"><h6>UnApproved</h6></a>
                </div>
                <div class="title-bar" style="margin-right: 20px; border-bottom: 2px solid #FF7400; display: inline-block;">
                    <a style="text-decoration: none;" href="{{ route('government_list_approval_index') }}"><h6><b>Approved</b></h6></a>
                </div>
            </div>

        </div>

        <div class="col-12">
            <!-- Example DataTable for Dashboard Demo-->
            <div class="datatable" style="margin-bottom: 50px;">
                <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color: #383838;" class="thead-dark table-borderless">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">No. ID</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Front Photo</th>
                            <th class="text-center">Back Photo</th>
                            {{-- <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">Beds</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Baths</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Location</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Last Modified</th> --}}
                            <th class="text-center" style="width: 15%;">ACTION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">No. ID</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Front Photo</th>
                            <th class="text-center">Back Photo</th>
                            <th class="text-center" style="width: 15%;">ACTION</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
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
            dom: "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
            ajax: "{{ route('government_approval_datatable') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'no_id',
                    name: 'no_id',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'type',
                    name: 'type',
                    class: 'font-w600 font-size-sm',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'front_picture',
                    name: 'front_picture',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'back_picture',
                    name: 'back_picture',
                    class: 'font-w600 font-size-md'
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
