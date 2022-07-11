@extends('layouts.admin.dashboard')

@section('hero')
   <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $data[0]->name }} Menu</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{ route('admin_restaurant_create_menu', $data[0]->id_restaurant) }}">
                <i class="fa fa-plus-circle"></i> Add Data
            </a>
            <input type="hidden" id="id_restaurant" name="id_restaurant" value="{{ $data[0]->id_restaurant }}">
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
        <table class="table table-hover table-vcenter" id="tabel" >
            <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">DESCRIPTION</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 15S%;">PRICE</th>
                    <th class="d-none d-sm-table-cell text-center" style="width: 10%;">IMAGE</th>
                    <th class="text-center" style="width: 15%;">ACTION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
!-- Page JS Plugins -->
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
        ajax:"/admin/restaurant/datatable_menu/" + $("#id_restaurant").val(),      
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
            { data: 'name', name: 'name', class:'font-w600 font-size-sm' },
			{ data: 'description', name: 'description', class:'font-w600 font-size-sm' },
            { data: 'price', name: 'price', class:'font-w600 font-size-sm' },
			{ data: 'foto', name: 'foto', class:'font-w600 font-size-sm' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
		],
		responsive: true
    });

</script>
@endsection