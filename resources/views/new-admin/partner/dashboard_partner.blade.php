@extends('new-admin.layouts.admin_layout')

@section('title', 'Host Dashboard - EZV2')

@section('content_admin')

<!-- Di komen sementara -->

    <style>
        .overflow-x-auto{
            overflow-x:auto;
            white-space: nowrap;
        }
        .layout-header-footer,
        .flex-gap{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .layout-header-footer{
            flex-direction:column;
            text-align:center;
        }

        .flex-gap{
            flex-wrap: wrap;
        }

        .content-container{
            margin-top:48px;
        }

        @media (min-width: 768px) { 
            .layout-header-footer{
                flex-direction:row;
                text-align:left;
                justify-content:space-between;
                gap:0px;
            }
            .content-container{
                margin-top:6rem;
            }
        }
    </style>
    <!-- <header class="page-header page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -1.2%">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center">
                    <div class="col-3 mt-2">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Today
                        </h1>
                        <div class="col-12">
                            <div class="d-inline-flex" style="justify-content: space-around;">
                                @forelse ($today as $item)
                                    <div class="col-xxl-3 col-xl-3 mt-4">
                                        <div class="card1">
                                            <div class="card-body1">
                                                <div class="col-12">
                                                    <b class="text-primary" style="font-size: 14px;">Confirm Important
                                                        Details</b>
                                                    <p class="text-gray-600" style="font-size: 14px">Required to Publish
                                                    </p>
                                                    <p class="text-gray-600" style="font-size: 14px">{{ $item->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 mt-4">
                                        <b class="text-primary" style="font-size: 14px;">No Required to Publish</b>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container py-5 px-4">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="activity"></i></div>
                Today
            </h1>
            <div class="flex-gap">
                @forelse ($today as $item)
                    <div class="bg-white rounded p-4 mt-4">
                        <b class="text-primary text-sm">Confirm Important
                            Details</b>
                        <p class="text-gray-600 text-sm">Required to Publish
                        </p>
                        <p class="text-gray-600 text-sm">{{ $item->name }}
                        </p>
                    </div>
                @empty
                    <div class="mt-4">
                        <b class="text-primary text-sm">No Required to Publish</b>
                    </div>
                @endforelse
            </div>
        </div>
    </header>
    <!-- Main page content-->

    <div class="container content-container px-4">
        <div class="d-flex align-items-center justify-content-between flex-gap">
            <h1 style="font-weight: bold; color: #000;">
                Your Reservations
            </h1>
            <h5 style="text-decoration: underline; color: #000;"><a style="color: black;"
                    href="{{ route('reservations_dashboard') }}">All reservations ({{ $count }})</a></h5>
        </div>
        <div class="mt-2">
            <ul class="m-0 p-0 overflow-x-auto">
                <li type="button" class="btn"
                    style="color: #000; border-radius: 20px; border: 2px solid black; background-color:#fff;"><a
                        style="color: black; text-decoration:none;" href="{{ route('partner_dashboard') }}">Currently
                        Hosting ({{ $count }})</a></li>
                <li type="button" class="btn"
                    style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a
                        style="color: black; text-decoration:none;" href="{{ route('partner_dashboard2') }}">Arriving
                        Soon ({{ $arrivingSoon }})</a></li>
                <li type="button" class="btn"
                    style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a
                        style="color: black; text-decoration:none;" href="{{ route('partner_dashboard3') }}">Checking Out
                        ({{ $checkout }})</a></li>
                <li type="button" class="btn"
                    style="color: #000; border-radius: 20px; border: 1px solid #DDDDDD; background-color:#fff;"><a
                        style="color: black; text-decoration:none;" href="{{ route('partner_dashboard4') }}">Upcoming
                        ({{ $upcoming }})</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12 mt-5 mb-4">
                <div class="">
                    <table class="table table-bordered table-hover" style="color: #383838" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead style="color: #383838;" class="thead-dark table-borderless">
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NO INVOICE</th>
                                <th class="text-center">VILLA NAME</th>
                                <th class="d-none d-sm-table-cell text-center">CHECK-IN/CHECK-OUT</th>
                                <th class="d-none d-sm-table-cell text-center">PRICE</th>
                                <th class="d-none d-sm-table-cell text-center">STATUS</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NO INVOICE</th>
                                <th class="text-center">VILLA NAME</th>
                                <th class="d-none d-sm-table-cell text-center">CHECK-IN/CHECK-OUT</th>
                                <th class="d-none d-sm-table-cell text-center">PRICE</th>
                                <th class="d-none d-sm-table-cell text-center">STATUS</th>
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

    <!--
    <style>
        img{
            object-position:center;
            object-fit:cover;
        }

        .dashboard-profile{
            display:flex;
            flex-direction:column;
            padding:1rem;
            gap:2rem;
            border-bottom:1px solid #ddd;
        }

        .dashboard-card-profile{
            padding:2rem 1rem;
            border-radius:1rem;
            border:1px solid #ddd;
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:2rem;
        }

        .dashboard-img-profile-container{          
            padding:6px;
            border:1px solid #ddd;
            background:white;
            border-radius:50%;
            box-shadow:0px 3px 15px -8px rgb(100 100 100);
        }

        .dashboard-img-profile{
            width:120px;
            height:120px;
            border-radius:50%;
        }

        .dashboard-list-badge{
            margin:0;
            padding:0;
            display:flex;
            flex-direction:column;
            gap:1rem;
            width:100%;
        }

        .dashboard-list-badge li{
            list-style: none;
            display:flex;
            gap:.5rem;
        }

        .dashboard-list-badge li svg{
            width:24px;
        }
        
        .dashboard-profile-title{
            font-weight:bold;
        }

        .dashboard-profile-location{
            display:flex;
            gap:.5rem;
            margin-top:1rem;
        }

        .dashboard-profile-description{
            margin-top:2rem;
        }

        .dashboard-item-container{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(200px, auto));
            padding:1rem;
            gap:.75rem;
        }

        .dashboard-item{
            aspect-ratio:1;
            position:relative;
        }

        .item-background-image{
            width:100%;
            height:100%;
            border-radius:1rem;
            filter:brightness(.7);
        }

        .item-title{
            color:white;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            text-align:center;
        }

        @media (min-width: 992px) { 
            .dashboard-profile{
                flex-direction:row;
                padding:4rem;
            }

            .dashboard-card-profile{
                width:300px;
                padding:2rem;
            }

            .dashboard-profile-description{
                width:540px;
                margin-top:2.25rem;
            }

            .dashboard-item-container{
                padding:4rem;
                grid-template-columns:repeat(7, 1fr);
            }
        }
    </style>
    <section id="dashboard">
        <div class="dashboard-profile">
            <div class="dashboard-card-profile">
                <div class="dashboard-img-profile-container">
                    <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="dashboard-img-profile">
                </div>
                <ul class="dashboard-list-badge">
                    <li>
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="fill: currentcolor;">
                            <path d="M14.998 1.032a2 2 0 0 0-.815.89l-3.606 7.766L1.951 10.8a2 2 0 0 0-1.728 2.24l.031.175A2 2 0 0 0 .87 14.27l6.36 5.726-1.716 8.608a2 2 0 0 0 1.57 2.352l.18.028a2 2 0 0 0 1.215-.259l7.519-4.358 7.52 4.358a2 2 0 0 0 2.734-.727l.084-.162a2 2 0 0 0 .147-1.232l-1.717-8.608 6.361-5.726a2 2 0 0 0 .148-2.825l-.125-.127a2 2 0 0 0-1.105-.518l-8.627-1.113-3.606-7.765a2 2 0 0 0-2.656-.971zm-3.07 10.499l4.07-8.766 4.07 8.766 9.72 1.252-7.206 6.489 1.938 9.723-8.523-4.94-8.522 4.94 1.939-9.723-7.207-6.489z">
                            </path>
                        </svg>
                        <span>132 reviews</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="fill: currentcolor;"><path d="M16 .798l.555.37C20.398 3.73 24.208 5 28 5h1v12.5C29 25.574 23.21 31 16 31S3 25.574 3 17.5V5h1c3.792 0 7.602-1.27 11.445-3.832L16 .798zm0 2.394l-.337.213C12.245 5.52 8.805 6.706 5.352 6.952L5 6.972V17.5c0 6.831 4.716 11.357 10.713 11.497L16 29c6.133 0 11-4.56 11-11.5V6.972l-.352-.02c-3.453-.246-6.893-1.432-10.311-3.547L16 3.192zm7 7.394L24.414 12 13.5 22.914 7.586 17 9 15.586l4.5 4.499 9.5-9.5z"></path></svg>
                        <span>Identity verified</span>
                    </li>
                </ul>
            </div>
            <div class="dashboard-profile-information">
                <h4 class="dashboard-profile-title">The Luxe Nomad</h4>
                <div class="dashboard-profile-location">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.23914 10.3913C4.25354 6.15072 7.7029 2.72472 11.9435 2.73913C16.1841 2.75354 19.6101 6.20289 19.5957 10.4435V10.5304C19.5435 13.287 18.0044 15.8348 16.1174 17.8261C15.0382 18.9467 13.8331 19.9388 12.5261 20.7826C12.1766 21.0849 11.6582 21.0849 11.3087 20.7826C9.3602 19.5144 7.65007 17.9131 6.25653 16.0522C5.01449 14.4294 4.3093 12.4597 4.23914 10.4174L4.23914 10.3913Z" stroke="red" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="11.9174" cy="10.5391" r="2.46087" stroke="red" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span>Puerto Princesa Philippines</span>
                </div>
                
                <p class="dashboard-profile-description">
                    We are a specialised luxury villa management company with properties throughout Asia, we have a strong team of trained profesionals to ensureyour stay with is memorable and well worth your money spent
                </p>

            </div>
        </div>

        <div class="dashboard-item-container">
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">List New Property</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Help Desk</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">CO</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Report</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Text</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Text 1</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Text 2</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Advertising</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Tips For Hosting</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">EZV Cover</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Channel</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Colab</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Terms & Condition</b>
            </div>
            <div class="dashboard-item">
                <img src="{{ asset('assets/media/photos/3.jpg') }}" alt="" class="item-background-image">
                <b class="item-title">Advertising</b>
            </div>

        </div>

    </section>

    -->
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
            // dom: "<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-3'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            dom: "<'layout-header-footer'<l><f>>" +
            "<'overflow-x-auto'<tr>>" +
            "<'layout-header-footer'<i><p>>",
            pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [
                [10, 20, 50],
                [10, 20, 50]
            ],
            autoWidth: !1,

            processing: true,
            serverSide: true,
            ajax: "{{ route('reservations_dashboard_datatables1') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'no_inv',
                    name: 'no_inv',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'name_villa',
                    name: 'name_villa',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'in_out',
                    name: 'in_out',
                    class: 'font-w600 font-size-sm  d-none d-sm-table-cell'
                },
                {
                    data: 'total_price',
                    name: 'total_price',
                    class: 'font-w600 font-size-sm d-none d-sm-table-cell'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'font-w600 font-size-sm d-none d-sm-table-cell'
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
