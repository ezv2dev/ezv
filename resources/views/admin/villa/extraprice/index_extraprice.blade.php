@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        {{ $data[0]->name }} Extra Price
                        <input type="hidden" id="id_villa" name="id_villa" value="{{ $data[0]->id_villa }}">
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome <a class="font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>, everything looks great.
                    </h2>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">
                    <a type="button" class="btn btn-sm btn-alt-primary" href="{{ route('admin_villa_create_extraprice', $data[0]->id_villa) }}">
                        <i class="fa fa-plus-circle"></i> Add Data
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('content')
<!-- Stylesheets -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">

<!-- Dynamic Table Full -->
<div class="block block-rounded">
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-hover table-vcenter" id="tabel" >
            <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">MAX NUMBER</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">TYPE PRICE</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 10%;">PRICE</th>
                    <th class="text-center" style="width: 15%;">ACTION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->
<div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
    <div class="row">
        <div class="col-6">
            {{-- <button type="submit" id="button" class="btn btn-primary">Upload</button> --}}
        </div>
        <div class="col-6 text-right">
            {{-- <button type="button" class="btn btn-alt-danger" >
               <i class="fa fa-angle-left ml-1"></i>  List Villa 
            </button> --}}
            <a type="button" class="btn btn-alt-success" href="{{ route('admin_villa') }}">
                List Villa <i class="fa fa-angle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){One.helpers('select2');});</script>

<script>
    load_tabel_first();
    var table = $('#tabel').dataTable({
        processing: true,
        serverSide: true,
        ajax:"/admin/villa/datatable_extraprice/" + $("#id_villa").val(),      
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
            { data: 'name', name: 'name', class:'font-w600 font-size-sm' },
			{ data: 'max_number', name: 'max_number', class:'font-w600 font-size-sm' },
            { data: 'type', name: 'type', class:'font-w600 font-size-sm' },
			{ data: 'price', name: 'price', class:'font-w600 font-size-sm' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
		],
		responsive: true
    });

</script>
@endsection