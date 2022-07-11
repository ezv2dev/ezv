@extends('layouts.admin.dashboard')

@section('hero')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Add Permission
                    </h1>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@section('content')

<!-- Dynamic Table Full -->
<div class="block block-rounded">
    <div class="block-content">
        <form action="{{ route('admin_permission_store') }}" method="POST" class="js-validation"  >
            @csrf
            <div class="block-content font-size-sm">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name1" name="name1" placeholder="Enter a name of permission..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name2" name="name2" placeholder="Enter a name of permission..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name3" name="name3" placeholder="Enter a name of permission..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name4" name="name4" placeholder="Enter a name of permission..">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name5" name="name5" placeholder="Enter a name of permission..">
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                          </button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </form>
    </div>
</div>
<!-- END Dynamic Table Full -->
@endsection

@section('scripts')

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
@endsection