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
                            Edit User
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
            <div class="card-header">Edit User Form</div>
            <div class="card-body">
                <form style="font-size: 14px;" action="{{ route('admin_user_update', $find->id) }}" method="POST" id="frm_tambah" class="js-validation text-black">
                    @csrf
                    @method('PUT')
                    <div class="block-content font-size-sm">
                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-input-admin-font" id="first_name" name="first_name" value="{{ old('first_name') ?? $find->first_name }}" placeholder="Enter a first name..">
                            </div>
                            @error('first_name')
                                    <small class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-input-admin-font" id="last_name" name="last_name" value="{{ old('last_name') ?? $find->last_name }}" placeholder="Enter a last name.." required>
                            </div>
                            @error('last_name')
                                    <small class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="email">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-input-admin-font" id="email" name="email" value="{{ old('email') ?? $find->email }}" placeholder="Enter a email..">
                                @error('email')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="password">Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-input-admin-font" id="password" name="password"
                                    placeholder="Enter a password.." required>
                                @error('password')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="password_confirmation">Password Confirmation <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-input-admin-font" id="password_confirmation"
                                    name="password_confirmation" placeholder="Enter a password confirmation.." required>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-2">
                            <label class="col-sm-3 col-form-label" for="role">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="role_id" style="font-size: 14px;" class="form-select" aria-label="Default select example" required>
                                    <option value="">...</option>
                                    @forelse ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $find->role_id == $role->id? 'selected' : '' }}>{{ $role->name }}</option>
                                    @empty
                                        {{-- empty --}}
                                    @endforelse
                                </select>
                                @error('role_id')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <!-- Submit -->
                        <div class="row items-push">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-sm button-admin">
                                    Save
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
