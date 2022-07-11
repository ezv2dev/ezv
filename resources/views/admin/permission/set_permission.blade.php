@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Set Role Permission
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome <a class="font-w600" href="javascript:void(0)">{{ Auth::user()->name }}</a>, everything looks great.
                    </h2>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">

                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('content')
<!-- Stylesheets -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">

<form action="{{ route('admin_role_permission_store') }}" method="POST" class="js-validation">
    @csrf
    <input type="hidden" value="{{ $role[0]->id }}" name="id_role" id="id_role">
    <!-- Checkboxes -->
    <div class="block block-rounded">
        <div class="block-content">
            <!-- Based on Bootstrap -->
            <h2 class="content-heading border-bottom mb-4 pb-2">{{ $role[0]->name }}</h2>
            <div class="row push">
                <div class="col-lg-12">
                    <div class="form-group">
                        @foreach($permission as $data)
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <div class="col-lg-3">
                            <input type="checkbox" class="custom-control-input" id="{{ $data->id }}" name="{{ $data->id }}" value="{{ $data->id }}">
                            <label class="custom-control-label" for="{{ $data->id }}">{{ $data->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END Based on Bootstrap -->
            <div class="block-content block-content-full text-right border-top">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7 offset-lg-4">
                        <button type="submit" class="btn btn-alt-primary">Save</button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </div>
    <!-- END Checkboxes -->
</form>
@endsection

@section('scripts')

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){One.helpers('select2');});</script>

<script>

</script>
@endsection
