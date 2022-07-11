@extends('new-admin.layouts.admin_layout')

@section('title', 'All messages - EZV2')

@section('content_admin')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style>
    .beFixed {
        position: fixed;
    }

    .beAbsolute {
        position: absolute;
        top: 0px;
    }

    input[type=text],
    select {
        padding: 10px 18px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 50px;
        box-sizing: border-box;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        background-color: #f7f7f7;
    }

</style>

<hr class="mt-n2">
<div id="layoutSidenav" style="margin-top: -58px;">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light" style="margin-top: 90px;">
            <div class="sidenav-menu">
                <div class="nav accordion" style="margin-top: -28px;" id="accordionSidenav">
                    <div class="sidenav-menu-heading mb-3" style="font-size: 16px; color: #000">Inbox</div>
                    <a class="nav-link" href="tables.html">
                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                        All messages
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                        EZV Support
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                        Archive
                    </a>

                    <div class="sidenav-menu-heading">Settings</div>
                    <a class="nav-link" href="charts.html">
                        <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                        Quick Replies
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                        Scheduled Messages
                    </a>
                </div>
                <div style="margin-top: 100px; margin-left: 30px; beckground-color:#fff">
                    <li type="button" class="btn btn-light"
                        style="color: #000; border-radius: 10px; border: 1px solid black; background-color:#fff;">
                        <i class="fa fa-plane" aria-hidden="true" style="color: #000"></i> Give Feedback</li>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container justify-content-center">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 style="color: black" class="page-header-title">
                                <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2"
                                    id="sidebarToggle" href="#"><i data-feather="menu"
                                        style="color: black"></i></button>
                                All messages
                            </h1>

                            {{-- <form role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control empty" id="iconified"
                                        placeholder="&#xF002; Search inbox" />
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="row justify-content-center mt-10">
                    <i class="fa fa-check" aria-hidden="true" style="color: #000"></i>
                </div> --}}
                <div class="row justify-content-center mt-2">
                    {{-- <table class="table table-striped w-100" id="tabel">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">SENDER</th>
                                <th class="text-center">MESSAGES</th>
                                <th class="text-center">SENDER TYPE</th>
                                <th class="text-center">REPLY STATUS</th>
                                <th class="text-center" style="width: 15%;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> --}}
                    <div class="datatable px-5">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">SENDER</th>
                                    <th class="text-center">MESSAGES</th>
                                    <th class="text-center">SENDER TYPE</th>
                                    <th class="text-center">REPLY STATUS</th>
                                    <th class="text-center" style="width: 15%;">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">SENDER</th>
                                    <th class="text-center">MESSAGES</th>
                                    <th class="text-center">SENDER TYPE</th>
                                    <th class="text-center">REPLY STATUS</th>
                                    <th class="text-center" style="width: 15%;">ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <center>
                        <b style="color: #000"> No new messages</b>
                    </center>
                </div>
                {{-- <div class="row justify-content-center mt-2">
                    <p style="color: #717171">If you're looking for a message, check the archive.</p>
                </div>
                <div class="row justify-content-center mt-3">
                    <a href="#" type="submit" class="btn btn-black" style="background-color: #222222"> Go to archive</a>
                </div> --}}
            </div>
        </main>
    </div>
</div>

{{-- MODAL MESSAGE DETAIL --}}
<div class="modal fade" id="modal-message_detail" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Details</h5>
                <button type="button" class="btn-close" onclick="hide_villa_message()"></button>
            </div>
            <div class="modal-body pb-1 text-black">
                <h3>message details</h3>
                <p id="message-detail-sender"></p>
                <p id="message-detail-message"></p>
                <h3>reply</h3>
                <div id="message-detail-form" style="display: none">
                    <div>
                        <form action="{{ route('villa_reply_owner_message') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_owner" id="id_owner" required>
                            <input type="hidden" name="id_message" id="id_message" required>
                            <div class="form-group">
                                <textarea name="message" rows="10" class="w-100" required>{{ old('message') }}</textarea>
                                <button type="submit" class="btn btn-primary">send</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="message-detail-already-reply" style="display: none">
                    <p>this message already replied</p>
                    <p id="message-reply"></p>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END MODAL MESSAGE DETAIL --}}

<script>
    $('#iconified').on('keyup', function () {
        var input = $(this);
        if (input.val().length === 0) {
            input.addClass('empty');
        } else {
            input.removeClass('empty');
        }
    });

</script>

<script>
    $(window).resize(function () {
        if ($(window).height() < 800) {
            $('#layoutSidenav').addClass('beAbsolute').removeClass('beFixed');
        } else {
            $('#layoutSidenav').addClass('beFixed').removeClass('beAbsolute');
        }
    });

</script>
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
            ajax:"{{ route('partner_inbox_datatable') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
                { data: 'sender', name: 'sender', class:'font-w600 font-size-sm' },
                { data: 'message', name: 'message', class:'font-w600 font-size-sm' },
                { data: 'senderType', name: 'senderType', class:'font-w600 font-size-sm' },
                { data: 'replyStatus', name: 'replyStatus', class:'font-w600 font-size-sm' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            responsive: true
        });
    </script>

    <script>
        function view_villa_message(id) {
            $.ajax({
                type: "GET",
                url: `{{ route('partner_inbox_show', 1) }}`,
                dataType: "JSON",
                success: function (data) {
                    $("#message-detail-sender").text(`sender : ${data.sender_name}`);
                    $("#message-detail-message").text(`message : ${data.message}`);

                    if(data.is_reply) {
                        $("#message-detail-form").hide();
                        $("#message-detail-already-reply").show();
                        $("#message-reply").text(`message : ${data[0].message_reply}`);
                    } else {
                        $("#message-detail-form").show();
                        $("#message-detail-already-reply").hide();
                        $("#id_owner").val(data.id_owner);
                        $("#id_message").val(data.id_message);
                    }

                    $('#modal-message_detail').modal('show');
                }
            });
        }
        function hide_villa_message() {
            $('#modal-message_detail').modal('hide');
        }
    </script>
@endsection
