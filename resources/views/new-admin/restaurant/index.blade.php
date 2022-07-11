@extends('new-admin.layouts.admin_layout')

@section('title', 'Restaurant - EZV2')

@section('content_admin')
<style>
    .overflow-x-scroll{
        overflow-x:scroll;
    }
    .layout-header-footer{
        display:flex;
        flex-direction:column;
        text-align:center;
        align-items:center;
        row-gap:12px;
    }

    @media (min-width: 768px) { 
        .layout-header-footer{
            flex-direction:row;
            text-align:left;
            justify-content:space-between;
            row-gap:0px;
        }
    }
</style>
    <!-- Hero -->
    <div class="container px-4">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center my-3">
                    <h1 class="flex-grow-1 fs-3 fw-semibold">Restaurant</h1>
                    <!-- <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary" href="{{ route('admin_add_listing') }}">
                            <i class="fa fa-plus-circle"></i> Add Data
                        </a>
                    </ol>
                    </nav> -->
                    <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary btn-light py-3 px-4" href="{{ route('admin_add_listing') }}">
                        <i class="fa fa-plus-circle mr-2"></i> Add Data
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container px-4" style="padding-bottom: 30px;">
        <!-- Example DataTable for Dashboard Demo-->
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg">
                        <a class="btn btn-danger" style="color: #fff" href="{{ route('admin_restaurant_trash') }}"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Trash Data</a></span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="" style="padding: 20px;">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ADDRESS</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 10%;">PHONE</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 10%;">STATUS</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ADDRESS</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 10%;">PHONE</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 10%;">STATUS</th>
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
            // dom:
            // "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
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
            ajax:"{{ route('admin_restaurant_datatable') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
                { data: 'name', name: 'name', class:'font-w600 font-size-sm' },
                { data: 'address', name: 'address', class:'font-w600 font-size-sm' },
                { data: 'phone', name: 'phone', class:'font-w600 font-size-sm d-none d-sm-table-cell' },
                { data: 'status', name: 'status', class:'font-w600 font-size-sm d-none d-sm-table-cell'},
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ],
            responsive: true
        });

        $(document).on('click', '.delete', function (){
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, deleted it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: "{{ route('admin_restaurant_destroy','') }}/"+id,
                        statusCode: {
                            500: () => {
                                Swal.fire('Failed', data.message ,'error');
                            }
                        },
                        success: async function (data) {
                            // console.log(data.message);
                            await Swal.fire('Deleted', data.message ,'success');
                            var table = $('#dataTable').DataTable();
                            table.draw();
                        }
                    });
                }
                else {
                    Swal.fire('Cancel','Canceled Deleted Data','error')
                }
            });
        });
    </script>
@endsection
