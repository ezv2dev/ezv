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

        .border-left {
            border-left: 1px solid #eee !important;
        }

        .border-right {
            border-right: 1px solid #eee !important;
        }

        .border-top {
            border-top: 1px solid #eee !important;
        }

        .border-bottom {
            border-bottom: 1px solid #eee !important;
        }

        .border {
            border: 1px solid #eee !important;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .list_msg:hover {
            background-color: rgb(255, 255, 255);
            cursor: pointer;
        }

        .reply-button {
            position: absolute;
            background: #ff7400;
            color: #fff;
            border-radius: 6px;
            padding: 10px 20px;
            border: solid 1px #ff7400;
            outline: none;
            font-weight: 600;
            width: 4rem;
            height: 2rem;
            bottom: 0rem;
            right: 0rem;
        }
    </style>

    <!-- Baru -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav" class="border-right" style="z-index: 3">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu" style="background-color: #f1ece7;">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="dropdown mb-3">
                            <a type="button" class="sidenav-menu-heading" style="font-size: 16px; color: #ff7400"
                                data-toggle="collapse" data-target="#dropProfile" aria-expanded="false"
                                aria-controls="dropProfile">Inbox</a>
                            <div class="collapse show mt-2" id="dropProfile">
                                <div class="d-flex flex-row align-items-center justify-content-between pr-4">
                                    <a class="nav-link py-1" href="#" style="color: #767676;">
                                        <div class="nav-link-icon" style="padding-right: 0px;"><img style="width: 25px;"
                                                src="/assets/logo.png" alt="EZV"></div>
                                        EZV
                                    </a>
                                    <span style="color: #ff7400;">10</span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between pr-4">
                                    <a class="nav-link py-1" href="#" style="color: #767676;">
                                        <div class="nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                        Collaboration
                                    </a>
                                    <span style="color: #ff7400;">10</span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between pr-4">
                                    <a class="nav-link py-1" href="#" style="color: #767676;">
                                        <div class="nav-link-icon"><i class="fas fa-star"></i></div>
                                        Review
                                    </a>
                                    <span style="color: #ff7400;">10</span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between pr-4">
                                    <a class="nav-link py-1" href="#" style="color: #767676;">
                                        <div class="nav-link-icon"><i class="fas fa-bug"></i></div>
                                        Report Misconduct
                                    </a>
                                    <span style="color: #ff7400;">10</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" type="button" class="sidenav-menu-heading mb-3"
                            style="font-size: 16px; color: #ff7400">Sent Items</a>
                        <a href="#" type="button" class="sidenav-menu-heading mb-3"
                            style="font-size: 16px; color: #ff7400">Deleted Items</a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <div class="sidebar-background"></div>
            <main>

                <div class="h-100" style="position: fixed;background-color: #efefef; width:20rem;">
                    <div class="row">
                        <div class="col-12" style="overflow-y: scroll; height: 100vh;">
                            <div style="padding: 15px;">
                                <div>
                                    @foreach ($messageList as $item)
                                        <div id="list_msg" class="row p-2 list_msg"
                                            onclick="listMsg({{ $item->id_message }})"
                                            style="border-bottom: 1px solid #d5d5d5;">
                                            <div class="col-2 p-0">
                                                @if ($item->user->avatar)
                                                    <img style="width: 100%; aspect-ratio: 4/3.9; border-radius: 30px; object-fit: cover;"
                                                        class="lozad" loading="lazy" src="{{ $item->user->avatar }}"
                                                        data-loaded="true">
                                                @else
                                                    <img style="width: 100%; aspect-ratio: 4/3.9; border-radius: 30px; object-fit: cover;"
                                                        class="lozad" loading="lazy"
                                                        src="{{ asset('assets/icon/menu/user_default.svg') }}"
                                                        data-loaded="true">
                                                @endif
                                            </div>
                                            <div class="col-10">
                                                <p
                                                    style="font-size: 16px; font-weight: 600; line-height: 1.2; color: #ff7400; margin-bottom: 5px;">
                                                    {{ $item->user->name }}</p>
                                                <p
                                                    style="font-size: 10px; font-weight: 600; color: #767676; text-align: justify;">
                                                    {{ date_format($item->created_at, 'd M Y h:i:s A') }}</p>
                                                <p
                                                    style="font-size: 12px; font-weight: 600; color: #767676; text-align: justify;">
                                                    {{ $item->message }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bg_msg" class="container justify-content-center">
                    <img style="height: 70%; top: 20%; right: 5%; left: 60%; border-radius: 30px; object-fit: cover; position: fixed;"
                        class="lozad" loading="lazy"
                        src="https://cdn.eraspace.com/pub/media/catalog/product/i/p/iphone_13_green_1_1_2.jpg"
                        data-src="https://cdn.eraspace.com/pub/media/catalog/product/i/p/iphone_13_green_1_1_2.jpg"
                        alt="EZV_1657614819_jason-leung-poI7DelFiVA-unsplash.webp" data-loaded="true">
                </div>
                <div class="h-100" id="replySection" style="display: none;">
                    <div class="row" style="top: 20%; right: 8%; width: 45%; left: 48%; position: fixed;">
                        <div class="col-12" id="replyMsg"
                            style="border-radius: 12px; background: #fff; box-shadow: 0 0 1rem 0.2rem rgb(0 0 0 / 10%);">
                            <div style="padding: 15px;">
                                <div class="row p-2" style="position: relative;">
                                    <div class="col-2 p-0" id="senderPict">
                                    </div>
                                    <div class="col-10">
                                        <p style="font-size: 20px; font-weight: 600; line-height: 1.2; color: #ff7400; margin-bottom: 5px;"
                                            id="senderInfo"></p>
                                        <p style="font-size: 12px; font-weight: 600; color: #767676; text-align: justify;"
                                            id="senderMsg"></p>
                                    </div>
                                    <div class="col-12 mt-5" id="replyID">
                                        <a type="button" onclick="repMsg()"
                                            class="reply-button btn btn-sm btn-create-listing" href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="rep_form" class="col-12 mt-5"
                            style="display:none; border-radius: 12px; background: #fff; box-shadow: 0 0 1rem 0.2rem rgb(0 0 0 / 10%);">
                            <div style="padding: 15px;">
                                <div class="row p-2" style="position: relative;">
                                    <div class="col-2 p-0" id="senderPict2">
                                    </div>
                                    <div class="col-10">
                                        <p style="font-size: 20px; font-weight: 600; line-height: 1.2; color: #ff7400; margin-bottom: 5px;"
                                            id="senderReplyTo"></p>
                                        <a type="button"
                                            style="position: absolute; background: #b7b7b7; color: #fff; border-radius: 6px; padding: 10px 20px; border: solid 1px #b7b7b7; outline: none; font-weight: 600; width: 4rem; height: 2rem; top: 0rem; right: 5rem;"
                                            class="btn btn-sm btn-create-listing" id="cancel_rep">cancel</a>
                                        <a type="button"
                                            style="position: absolute; background: #ff7400; color: #fff; border-radius: 6px; padding: 10px 20px; border: solid 1px #ff7400; outline: none; font-weight: 600; width: 4rem; height: 2rem; top: 0rem; right: 0rem;"
                                            class="btn btn-sm btn-create-listing" href="#">send</a>
                                        <textarea style="width: 100%; border-radius: 15px;" class="mt-4" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- MODAL MESSAGE DETAIL --}}
    <div class="modal fade" id="modal-message_detail" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
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
        $('#iconified').on('keyup', function() {
            var input = $(this);
            if (input.val().length === 0) {
                input.addClass('empty');
            } else {
                input.removeClass('empty');
            }
        });
    </script>

    <script>
        $(window).resize(function() {
            if ($(window).height() < 800) {
                $('#layoutSidenav').addClass('beAbsolute').removeClass('beFixed');
            } else {
                $('#layoutSidenav').addClass('beFixed').removeClass('beAbsolute');
            }
        });
    </script>
@endsection

@section('scripts')
    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>

    <script>
        function listMsg(id_message) {
            $.ajax({
                async: false,
                type: "GET",
                global: false,
                dataType: 'json',
                url: "/user/message",
                data: {
                    id_message: id_message
                },
                success: function(response) {
                    $('#bg_msg').hide();
                    $('#rep_form').hide();
                    $('#replySection').show();
                    $('#replyMsg').show();

                    if (response.data.user.avatar == null) {
                        $('#senderPict').html(
                            `<img style="width: 70%; aspect-ratio: 4/3.9; border-radius: 50px; object-fit: cover;"
                                            class="lozad" loading="lazy" src="{{ asset('assets/icon/menu/user_default.svg') }}">`
                        );
                        $('#senderPict2').html(
                            `<img style="width: 70%; aspect-ratio: 4/3.9; border-radius: 50px; object-fit: cover;"
                                            class="lozad" loading="lazy" src="{{ asset('assets/icon/menu/user_default.svg') }}">`
                        );
                    } else {
                        $('#senderPict').html(
                            `<img style="width: 70%; aspect-ratio: 4/3.9; border-radius: 50px; object-fit: cover;" class="lozad" loading="lazy" src="${response.data.user.avatar}">`
                        );
                        $('#senderPict2').html(
                            `<img style="width: 70%; aspect-ratio: 4/3.9; border-radius: 50px; object-fit: cover;" class="lozad" loading="lazy" src="${response.data.user.avatar}">`
                        );
                    }

                    $('#senderInfo').html(`${response.data.user.first_name} ${response.data.user.last_name}`);
                    $('#senderReplyTo').html(
                        `To : ${response.data.user.first_name} ${response.data.user.last_name}`);
                    $('#senderMsg').html(response.data.message);
                }
            });
        }

        function repMsg() {
            $('#replyMsg').hide();
            $('#rep_form').show();
        }

        $('#cancel_rep').click(function(e) {
            $('#replyMsg').show();
            $('#rep_form').hide();
        });
    </script>

    <script>
        // load_tabel_first();
        var table = $('#dataTable').dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('partner_inbox_datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center font-size-sm'
                },
                {
                    data: 'sender',
                    name: 'sender',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'message',
                    name: 'message',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'senderType',
                    name: 'senderType',
                    class: 'font-w600 font-size-sm'
                },
                {
                    data: 'replyStatus',
                    name: 'replyStatus',
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
    </script>

    <script>
        function view_villa_message(id) {
            $.ajax({
                type: "GET",
                url: `{{ route('partner_inbox_show', 1) }}`,
                dataType: "JSON",
                success: function(data) {
                    $("#message-detail-sender").text(`sender : ${data.sender_name}`);
                    $("#message-detail-message").text(`message : ${data.message}`);

                    if (data.is_reply) {
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
