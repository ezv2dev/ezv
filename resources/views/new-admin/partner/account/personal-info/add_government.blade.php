@extends('new-admin.layouts.admin_layout')

@section('title', 'Add Government ID - EZV2')

<style>
    input[type="radio"] {
    width: 18px;
    height: 18px;
    margin: 0;
    cursor: default;
    }
    @media only screen and (max-width: 767px) {
        .ml-max-md-10p {
            margin-left: 10px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2 ml-max-md-10p" style="margin-left: 30px;">
                    <div class="col-md-5">
                        <h1 style="font-weight:bold; color: #383838;">
                            Let’s add your government ID
                        </h1>
                        <p class="text-dark" style="font-size: 11pt;">We’ll need you to add an official government ID. This step helps make sure you’re really you.</p>
                    </div>
                </div>

                <div id="content" class="col-12 mt-5">
                    <div class="col-md-6 text-dark ml-max-md-0p" style="margin-left: 18px;">
                        <form action="{{ route('add_government') }}" method="post">
                            @csrf
                            <div class="col-12">
                                <div class="label d-flex">
                                    <div class="flex-fill">
                                        <span><b>Upload an existing photo</b></span>
                                        <p>Recommended</p>
                                    </div>
                                    <input class="float-right" type="radio" name="chooseHow" value="radio1">
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="label d-flex">
                                    <span class="flex-fill"><b>Take photo from your webcam</b></span>
                                    <input class="float-right" type="radio" name="chooseHow" value="radio2">
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 60px;">
                                <hr>
                            </div>

                            <button class="btn btn-dark float-right" style="padding: 10px 30px;" type="submit"><b>Continue</b></button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')



@endsection
