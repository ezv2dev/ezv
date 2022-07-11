@extends('layouts.admin.dashboard')

@section('hero')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Villa Messages</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            {{-- <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary" href="{{ route('admin_add_listing') }}">
                <i class="fa fa-plus-circle"></i> Add Data
            </a> --}}
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
        <table class="table table-striped " id="tabel" >
            <thead class="thead-font">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">SENDER</th>
                    <th class="text-center">MESSAGES</th>
                    <th class="text-center">SENDER TYPE</th>
                    <th class="text-center">REPLY STATUS</th>
                    <th class="text-center" style="width: 15%;">ACTION</th>
                </tr>
            </thead>
            <tbody style="text-align: center;" class="tbody-font">
                @forelse ($allConversationList as $conversation)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $conversation->sender_name }}</td>
                        <td>{{ $conversation->message }}</td>
                        <td>{{ $conversation->conversation_sender_type }}</td>
                        <td>
                            @if ($conversation->is_reply)
                                yes
                            @else
                                no
                            @endif
                        </td>
                        <td>
                            <center>
                            <div class='dropdown'>
                                <button type='button' class='btn button-admin dropdown-toggle btn-sm' id='dropdown-align-primary' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                </button>
                                <div class='dropdown-menu dropdown-menu-end font-size-sm' aria-labelledby='dropdown-align-primary'>
                                    <button class='dropdown-item admin-action-dropdown' onclick="view_villa_message_details_{{ $i }}()">View</button>
                                </div>
                            </div>
                            </center>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-villa_message_details_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Message Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-1">
                                    <h3>message details</h3>
                                    <p>sender: {{ $conversation->sender_name }}</p>
                                    <p>message: {{ $conversation->message }}</p>
                                    @if (!$conversation->is_reply)
                                        <h3>reply</h3>
                                        <div>
                                            <form action="{{ route('villa_reply_owner_message') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_owner" id="id_owner" value="{{ $conversation->id_owner }}" required>
                                                <input type="hidden" name="id_message" id="id_message" value="{{ $conversation->id_message }}" required>
                                                <div class="form-group">
                                                    <textarea name="message" rows="10" class="w-100" required>{{ old('message') }}</textarea>
                                                    <button type="submit" class="btn btn-primary">send</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <p>this message already replied</p>
                                        <p>your message: {{ $conversation->conversationReply->message }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function view_villa_message_details_{{ $i }}() {
                            $('#modal-villa_message_details_{{ $i }}').modal('show');
                        }
                    </script>
                @empty
                    {{-- empty --}}
                @endforelse

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

{{-- <script>
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
        ajax:"{{ route('admin_restaurant_datatable') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center font-size-sm' },
            { data: 'name', name: 'name', class:'font-w600 font-size-sm' },
			{ data: 'address', name: 'address', class:'font-w600 font-size-sm' },
			{ data: 'phone', name: 'phone', class:'font-w600 font-size-sm' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
		],
		responsive: true
    });

</script> --}}
@endsection
