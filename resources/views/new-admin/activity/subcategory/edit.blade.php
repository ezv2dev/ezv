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
                            Edit Things To Do Sub-Category
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
            <div class="card-header">Edit Things To Do Sub-Category Form</div>
            <div class="card-body">
                <form action="{{ route('admin_activity_subcategory_update', $find[0]->id_subcategory) }}" method="POST"
                    id="frm_tambah" class="js-validation">
                    @csrf
                    @method('PUT')
                    <div class="block-content font-size-sm">
                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label text-black" for="name">Category<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_category" class="form-control" required>
                                    <option value="">...</option>
                                    @forelse ($categories as $category)
                                        @php
                                            $isSelected = '';
                                            if ($category->id_category == $find[0]->id_category) {
                                                $isSelected = 'selected';
                                            }
                                        @endphp
                                        <option value="{{ $category->id_category }}" {{ $isSelected }}>
                                            {{ $category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label text-black" for="name">Name Sub-Category <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $find[0]->name }}">
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
