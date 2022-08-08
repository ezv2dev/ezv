@extends('new-admin.layouts.admin_layout')

@section('title', 'Account Setting - EZV2')

<style>
    @media only screen and (max-width: 425px) {
        .card-subtitle {
            font-size: 14px;
        }
    }
    @media only screen and (min-width: 576px) and (max-width: 991px) {
        .card {
            height: 230px !important;
        }
    }
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .card {
            height: 200px !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header page-header-dark">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2" style="margin-left: 20px;">
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt;">
                        Co-Host Setting
                    </h1>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center my-3 ">
                    <a type="button" class="btn btn-sm admin-adddata-button btn-alt-primary btn-light py-3 px-4" onclick="add_cohost()">
                        <svg class="svg-inline--fa fa-plus-circle fa-w-16 mr-2" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg> Add Co-Host
                    </a>
                </div>
                <div class="row mt-5 pl-4 pr-0">
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <a href="{{ route('personal_info') }}" class="text-dark" style="text-decoration: none;">
                            <div class="card pb-4 shadow" style="height: 180px;">
                                <div class="card-block" style="padding: 25px;">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 32px; width: 32px; fill: currentcolor;">
                                        <path
                                            d="m29 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v18c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-26c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-18c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm0 2h-26v18h26zm-3 12v2h-8v-2zm-16-8c1.6568542 0 3 1.3431458 3 3 0 .6167852-.1861326 1.1900967-.5052911 1.6668281 1.4972342.8624949 2.5052911 2.4801112 2.5052911 4.3331719h-2c0-1.3058822-.8343774-2.4168852-1.9990993-2.8289758l-.0009007-3.1710242c0-.5522847-.4477153-1-1-1-.51283584 0-.93550716.3860402-.99327227.8833789l-.00672773.1166211.00008893 3.1706743c-1.16523883.4118113-2.00008893 1.5230736-2.00008893 2.8293257h-2c0-1.8530607 1.00805693-3.470677 2.50570706-4.3343854-.3195745-.4755179-.50570706-1.0488294-.50570706-1.6656146 0-1.6568542 1.34314575-3 3-3zm16 4v2h-8v-2zm0-4v2h-8v-2z">
                                        </path>
                                    </svg>
                                    <h4 class="card-title pt-4"><b>Personal Info</b></h4>
                                    <p class="card-subtitle text-muted p-y-1">Provide personal details and how we can
                                        reach you.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.cohost.cohost_add')

@include('new-admin.layouts.footer')

@endsection

@section('scripts')
<script>
    function add_cohost() {
        $('#modal-cohost').modal('show');
    }
</script>
@endsection
