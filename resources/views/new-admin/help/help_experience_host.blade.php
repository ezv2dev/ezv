@extends('new-admin.layouts.admin_layout')

@section('title', 'Help Center - EZV2')

<style>
    .search__container {
        padding-top: 64px;
    }

    .search__input {
        width: 100%;
        padding: 12px 24px;

        background-color: transparent;
        transition: transform 250ms ease-in-out;
        font-size: 14px;
        line-height: 18px;

        color: #ff7400;
        background-color: transparent;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 2px solid #ff7400;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

    .search__input::placeholder {
        color: rgba(87, 87, 86, 0.8);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .search__input:hover,
    .search__input:focus {
        padding: 12px 0;
        outline: 0;
        border: 2px solid transparent;
        border-bottom: 2px solid #ff7400;
        border-radius: 0;
        background-position: 100% center;
    }

</style>

@section('content_admin')

<div class="container mb-5">
    <div class="row">
        <h4>Help Center</h4>
    </div>

    <div class="row d-flex justify-content-center">
        <h1 class="text-bolder" style="font-size: 42px;">Hi {{ Auth::user()->first_name }}, how can we help?</h1>
    </div>

    <div class="row d-flex justify-content-center mt-n5">
        <div class="col-5">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search more">
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 mt-4" style="border-bottom: 1px solid #DFDFDE;">
            <div class="title-bar p-0" style="margin-right: 20px; display: inline-block;">
                <a style="text-decoration: none;" href="{{ route('help_guest') }}">
                    <h6>Guest</h6>
                </a>
            </div>
            <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                <a style="text-decoration: none;" href="{{ route('help_host') }}">
                    <h6>Host</h6>
                </a>
            </div>
            <div class="title-bar" style="margin-right: 20px; display: inline-block; border-bottom: 2px solid #FF7400;">
                <a style="text-decoration: none;" href="{{ route('help_experience_host') }}">
                    <h6><b>Experience Host</b></h6>
                </a>
            </div>
            <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                <a style="text-decoration: none;" href="{{ route('help_travel_admin') }}">
                    <h6>Travel Admin</h6>
                </a>
            </div>
        </div>
    </div>
</div>


@include('new-admin.layouts.footer')
@endsection

@section('script')

@endsection
