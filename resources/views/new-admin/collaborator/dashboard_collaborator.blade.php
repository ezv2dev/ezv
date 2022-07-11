@extends('new-admin.layouts.collab_layout')

@section('title', 'Collabs Dashboard - EZV2')

@section('content_admin')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -1.2%">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center">
                <div class="col-3 mt-2">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Today
                    </h1>
                    <div class="col-12">
                        <div class="d-inline-flex justify-content-between">
                            <div class="col-12 mt-4">
                                @php
                                    $user = Auth::user()->id;
                                    $collab = \App\Models\Collaborator::where('created_by',$user)->select('id_collab')->first();
                                @endphp
                                <b class="text-primary" style="font-size: 14px;"><a href="{{ route('collaborator', $collab->id_collab) }}">Go To Profile Page</a></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-10">
    <div class="row align-items-center justify-content-between">
        <h1 style="font-weight: bold; color: #000;">
            Your Reservations
        </h1>
        <h5 style="text-decoration: underline; color: #000;"><a style="color: black;" href="{{ route('reservations_dashboard') }}">All reservations ({{$count}})</a></h5>
    </div>
    <div class="row align-items-center justify-content-between">
        <ul class="ml-n5 mt-2">
            <li type="button" class="btn btn-light"
                style="color: #000; border-radius: 20px; border: 2px solid black; background-color:#fff;"><a style="color: black; text-decoration:none;" href="{{ route('partner_dashboard') }}">Currently
                    Hosting ({{$count}})</a></li>
            <li type="button" class="btn btn-light"
                style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a style="color: black; text-decoration:none;" href="{{ route('partner_dashboard2') }}">Arriving
                    Soon ({{$arrivingSoon}})</a></li>
            <li type="button" class="btn btn-light"
                style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a style="color: black; text-decoration:none;" href="{{ route('partner_dashboard3') }}">Checking Out
                    ({{$checkout}})</a></li>
            <li type="button" class="btn btn-light"
                style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a style="color: black; text-decoration:none;" href="{{ route('partner_dashboard4') }}">Upcoming ({{$upcoming}})</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12 mt-5 mb-4">
            <div class="datatable">
                <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color: #383838;" class="thead-dark table-borderless">
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
                    <tfoot>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NO INVOICE</th>
                            <th class="text-center">VILLA NAME</th>
                            <th class="d-none d-sm-table-cell text-center" >CHECK-IN/CHECK-OUT</th>
                            <th class="d-none d-sm-table-cell text-center" >PRICE</th>
                            <th class="d-none d-sm-table-cell text-center" >STATUS</th>
                            <th class="text-center" style="width: 15%;">ACTION</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
            {{-- <div class="card h-100">
                <div class="card-body2 "> --}}

                    {{-- <center>
                        <p>
                            <i class="fa fa-edit" style="color: #000; font-size: 30px;" aria-hidden="true"></i>
                        </p>
                        <p class="text-gray-700 mb-0 mt-3">You don’t have any guests staying with you right
                            now..
                        </p>
                    </center> --}}
                {{-- </div>
            </div> --}}
        </div>
    </div>
</div>

@include('new-admin.layouts.footer_dashboard')

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
        ajax:"{{ route('reservations_dashboard_datatables1') }}",
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
