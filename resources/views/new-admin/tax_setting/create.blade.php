@extends('new-admin.layouts.admin_layout')

@section('title', 'Tax Setting Program - EZV2')

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="h3 font-w700 mb-2">
                            Add Tax Setting
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
        <div class="card mb-5">
            <div class="card-body p-5">
                <form action="{{ route('admin_tax_setting_store') }}" method="POST" id="frm_tambah"
                    class="js-validation">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label text-black" for="total_tax">Tax Value</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="total_tax" name="total_tax"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                    placeholder="Enter a tax value.." maxlength="50">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-check"></i> &nbsp; Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')

    {{-- END CONTENT --}}
@endsection
