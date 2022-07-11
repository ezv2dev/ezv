@extends('new-admin.layouts.admin_layout')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
              <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Villa Bathroom</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <a type="button" class="btn admin-adddata-button btn-sm btn-alt-primary" href="{{ route('admin_bathroom_create') }}">
                        <i class="fa fa-plus-circle"></i> Add Data
                    </a>
                  </ol>
                </nav>
              </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container">
        <!-- Example DataTable for Dashboard Demo-->
        <div class="card mb-4">
            <div class="card-header">Villa Bathroom</div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">ICON</th>
                                <th class="text-center">AMENITIES</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">CREATED_AT</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 15%;">UPDATED_AT</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">ICON</th>
                                <th class="text-center">AMENITIES</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">CREATED_AT</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 15%;">UPDATED_AT</th>
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
            ajax:"{{ route('admin_bathroom_datatable') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
                { data: 'icon', name: 'icon', class:'font-w600 font-size-sm' },
                { data: 'name', name: 'name', class:'font-w600 font-size-sm' },
                { data: 'created_at', name: 'created_at', class:'font-w600 font-size-sm' },
                { data: 'updated_at', name: 'updated_at', class:'font-w600 font-size-sm' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            responsive: true
        });

    </script>
@endsection
