@extends('new-admin.layouts.admin_layout')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="h3 font-w700 mb-2">
                            Add Things To Do Category
                        </h1>
                    </div>
                    <div class="mt-3 mt-sm-0 ml-sm-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">Add Things To Do Category Form</div>
            <div class="card-body">
                <form action="{{ route('admin_activity_category_store') }}" method="POST" id="frm_tambah"
                    class="js-validation">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label text-black" for="name">Name Category <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter a name of category things to do.." maxlength="50" required>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <!-- Submit -->
                        <div class="row items-push">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-sm button-admin">
                                    <i class="fa fa-check"></i> Save
                                </button>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END CONTENT --}}
@endsection
