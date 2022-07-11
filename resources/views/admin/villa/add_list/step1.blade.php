@extends('layouts.admin.step_add_villa')

@section('content')
<form class="js-wizard-validation2-form" action="" method="POST" id="basic-form" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-lg-6">
                <div id="background" class="bg-gd-sublime-op">
                    <h1 class="headingWh " style="color: #FFF; font-size: 40px; padding-top:30%; padding-right:15px; text-align:right;">What type you want to add?</h1>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="mt-3 mt-sm-0 ml-sm-3" style="float: right;">
                    <a type="button" class="btn btn-sm rounded-pill btn-outline-secondary" href="{{ route('admin_villa') }}">
                        <i class="fa fa-window-close"></i> Exit
                    </a>
                </div>

                <div style="padding-top:20%;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <a class="block block-rounded text-center bg-image" style="background-image: url('{{ asset('assets/media/photos/photo15.jpg') }}');" href="{{ route('villa_add_step_one_store') }}">
                                    <div class="block-content block-content-full bg-gd-fruit-op ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                        <i class="fa fa-2x fa-home text-white"></i>
                                            <div class="fw-semibold mt-3 text-uppercase text-white">{{ $type[0]->name }}</div>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-6">
                                <a class="block block-rounded text-center bg-image" style="background-image: url('{{ asset('assets/media/photos/photo16.jpg') }}');" href="javascript:void(0)">
                                    <div class="block-content block-content-full bg-gd-sublime-op ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                        <i class="far fa-2x fa fa-hotel text-white"></i>
                                        <div class="fw-semibold mt-3 text-uppercase text-white">{{ $type[1]->name }}</div>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-6">
                                <a class="block block-rounded text-center bg-image" style="background-image: url('{{ asset('assets/media/photos/photo15.jpg') }}');" href="{{ route('restaurant_add_step_one_store') }}">
                                    <div class="block-content block-content-full bg-gd-fruit-op ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                        <i class="fa fa-2x fa-utensils text-white"></i>
                                            <div class="fw-semibold mt-3 text-uppercase text-white">{{ $type[2]->name }}</div>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-6">
                                <a class="block block-rounded text-center bg-image" style="background-image: url('{{ asset('assets/media/photos/photo16.jpg') }}');" href="{{ route('activity_add_step_one_store') }}">
                                    <div class="block-content block-content-full bg-gd-sublime-op ratio ratio-16x9">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                        <i class="far fa-2x fa fa-walking text-white"></i>
                                        <div class="fw-semibold mt-3 text-uppercase text-white">{{ $type[3]->name }}</div>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                {{-- <div style="position: fixed; bottom: 0; width: 100%;">
                    <div class="row">
                        <div class="col-lg-5" style="padding:auto auto;">
                            {{-- <a type="button" class="btn btn-outline-secondary" href="{{ route('villa_add_step_one') }}">
                                Back
                            </a> --}}
                            {{-- <button style="float: right;" type="submit" class="btn btn-outline-secondary">
                                Next
                            </button>
                        </div>
                    </div>
                </div>   --}} 
                <!-- END Footer -->
                    
            </div>
        </div>
    </form>
@endsection