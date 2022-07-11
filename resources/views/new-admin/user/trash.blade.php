@extends('new-admin.layouts.admin_layout')

@section('title','User Trash - EZV2')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
              <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">User</h1>
                {{-- <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <a type="button" class="btn admin-adddata-button btn-sm btn-alt-primary" href="{{ route('admin_user_create') }}">
                        <i class="fa fa-plus-circle"></i> Add Data
                    </a>
                  </ol>
                </nav> --}}
              </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container" style="padding-bottom: 30px;">
        <!-- Example DataTable for Dashboard Demo-->
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg">
                        <a class="btn btn-success" style="color: #fff" href="{{ route('admin_user') }}"><i class="fa fa-list mr-2" aria-hidden="true"></i> Data User</a></span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable" style="padding: 20px;">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">FIRST NAME</th>
                                <th class="text-center">LAST NAME</th>
                                <th class="text-center">USERNAME</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">EMAIL</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 15%;">ROLE</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">FIRST NAME</th>
                                <th class="text-center">LAST NAME</th>
                                <th class="text-center">USERNAME</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 20%;">EMAIL</th>
                                <th class="d-none d-sm-table-cell text-center" style="width: 15%;">ROLE</th>
                                <th class="text-center">STATUS</th>
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
            ajax: "{{ route('admin_user_datatableTrash') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'last_name',
                    name: 'last_name',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'username',
                    name: 'username',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'email',
                    name: 'email',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'role',
                    name: 'role',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'isActive',
                    name: 'isActive',
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
                    url: "{{ route('admin_user_delete','') }}/"+id,
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
