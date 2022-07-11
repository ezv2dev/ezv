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
                            Add Role Permission
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
            <div class="card-header">Add Role Permission Form</div>
            <div class="card-body">
                <form action="{{ route('admin_role_permission_store') }}" method="POST" class="js-validation text-black">
                    @csrf
                    <input type="hidden" value="{{ $role->id }}" name="id_role" id="id_role">
                    <!-- Checkboxes -->
                        <div class="">
                            <!-- Based on Bootstrap -->
                            <h2 class="content-heading border-bottom mb-4 pb-2">{{ $role->name }}</h2>
                                <div class="form-group">
                                    @foreach($permission as $data)
                                    <div class="custom-control">
                                        <div class="col-lg-3">
                                        @php
                                            $isChecked = '';
                                            foreach ($role->permissions as $permission) {
                                                if($data->id == $permission->id) {
                                                    $isChecked = 'checked';
                                                }
                                            }
                                        @endphp
                                        <input type="checkbox" class="custom-control-input" id="{{ $data->id }}" name="{{ $data->id }}" value="{{ $data->id }}" {{ $isChecked }}>
                                        <label class="custom-control-label" for="{{ $data->id }}">{{ $data->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
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
                    <!-- END Checkboxes -->
                </form>
            </div>
        </div>
    </div>
    {{-- END CONTENT --}}
@endsection
