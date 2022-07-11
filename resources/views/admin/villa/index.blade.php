@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Villa</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if($data == 0)
                    <a type="button" class="btn btn-sm admin-adddata-button" href="{{ route('admin_add_listing') }}">
                        <i class="fa fa-plus-circle"></i> Add Data
                    </a>
                    @elseif($data > 0)
                    <a type="button" class="btn btn-sm btn-alt-primary" href="{{ route('villa_add_step_continue') }}">
                        <i class="fa fa-plus-circle"></i> Complete your listing
                    </a>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
@endsection

@section('content')

<!-- Dynamic Table Full -->
<div class="block block-rounded">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-striped " id="tabel">
            <thead class="thead-font">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">ORIGINAL NAME</th>
                    <th class="text-center">ADDRESS</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">PRICE</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 10%;">STATUS</th>
                    <th class="text-center" style="width: 15%;">ACTION</th>
                </tr>
            </thead>
            <tbody class="tbody-font">
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->
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
    var table = $('#tabel').dataTable({
        dom: "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        pagingType: "full_numbers",
        pageLength: 10,
        lengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
        autoWidth: !1,

        processing: true,
        serverSide: true,
        ajax: "{{ route('admin_villa_datatable') }}",
        columns: [{
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
                data: 'original_name',
                name: 'original_name',
                class: 'font-w600 font-size-sm'
            },
            {
                data: 'address',
                name: 'address',
                class: 'font-w600 font-size-sm'
            },
            {
                data: 'price',
                name: 'price',
                class: 'font-w600 font-size-sm'
            },
            {
                data: 'status',
                name: 'status',
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
