@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Villa Booking</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
           
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
            <thead class="thead-font">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NO INVOICE</th>
                    <th class="text-center">VILLA NAME</th>
                    <th class="d-none d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                    <th class="d-none d-sm-table-cell text-center" >PRICE</th>
                    <th class="d-none d-sm-table-cell text-center" >STATUS</th>
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
        ajax:"{{ route('admin_villa_booking_datatable') }}",      
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