@extends('new-admin.layouts.admin_layout')

@section('content_admin')
<div class="container mt-10">
    <div class="row align-items-center justify-content-between">
        <h1 style="font-weight: bold; color: #000;">
            hello <u>{{ auth()->user()->name }}</u>
        </h1>
    </div>
</div>
@endsection
