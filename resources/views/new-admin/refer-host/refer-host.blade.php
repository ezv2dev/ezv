@extends('new-admin.layouts.admin_layout')

@section('title', 'Referral - EZV2')

@section('content_admin')
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Referral Program</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-7">
                <h1 style="font-size: 40px; font-weight: 600;">Earn 12% for every user transaction</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-7">
                <p>Invite someone that loves to travel around the World and earn 12% for every transaction.
                    <a href="#">Read the terms and program requirements.</a>
                </p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-7">
                <div class="card px-5 py-3 shadow">
                    <div class="card-body">
                        <input type="text" value="{{ env('APP_URL') }}/register?ref={{ Auth::user()->user_code }}"
                            id="myInput" style=" background: #ffffff; width: 445px; border: 1px;" disabled>
                        <button onclick="myCopy()" class="btn btn-primary">Copy</button>
                    </div>
                </div>
                <p class="mt-3" style="font-size: 14px; font-weight: 600;">Copy or share your referral link with
                    friends</p>
                <hr>
                <p class="my-3" style="font-size: 16px; font-weight: 600; color: red;"><sup>*</sup> Your referral
                    code is used
                    by</p>
            </div>

        </div>

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
                                <th class="text-center">START PROGRAM</th>
                                <th class="text-center">END PROGRAM</th>
                                <th class="text-center">CREATED AT</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">USER</th>
                                <th class="text-center">START PROGRAM</th>
                                <th class="text-center">END PROGRAM</th>
                                <th class="text-center">CREATED AT</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')
@endsection

@section('scripts')
    <script>
        function myCopy() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Copied: " + copyText.value);
        }
    </script>

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

    <script>
        // load_tabel_first();
        var table = $('#dataTable').dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('refer_datatable') }}",
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
                    data: 'created_at',
                    name: 'created_at',
                    class: 'font-w600 font-size-sm'
                },
            ],
            responsive: true
        });
    </script>
@endsection
