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
                            Choose an ID type to add
                        </h1>
                        {{-- <p class="text-dark" style="font-size: 11pt;">We’ll need you to add an official government ID. This step helps make sure you’re really you.</p> --}}
                    </div>
                </div>

                <div id="content" class="col-12 mt-5">
                    <div class="col-md-6 text-dark ml-max-md-0p" style="margin-left: 18px;">
                        <form action="{{ route('add_government.step_two') }}" method="post">
                            @csrf
                            <div class="col-12 mb-5">
                                <span>Issuing country/region</span>
                                <select style="width: 100%; padding:10px;" class="form-select" name="country">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id_countries }}" {!! (isset($government['country']) && $government['country'] == $country->id_countries) ? "selected" : "" !!} >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="label">
                                    <span>Driver's license</span>
                                    <input class="float-right" type="radio" name="chooseGovernmentID" value="driver_license" {{ (isset($government['chooseGovernmentID']) && $government['chooseGovernmentID'] == 'driver_license') ? "checked" : "" }}>
                                    {{-- <p>Recommended</p> --}}
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="label">
                                    <span>Passport</span>
                                    <input class="float-right" type="radio" name="chooseGovernmentID" value="passport" {{ (isset($government['chooseGovernmentID']) && $government['chooseGovernmentID'] == 'passport') ? "checked" : "" }}>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="label">
                                    <span>Identity card</span>
                                    <input class="float-right" type="radio" name="chooseGovernmentID" value="identity_card" {{ (isset($government['chooseGovernmentID']) && $government['chooseGovernmentID'] == 'identity_card') ? "checked" : "" }}>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 60px;">
                                <hr>
                            </div>

                            <div class="col-12">
                                <span><a class="text-dark" href="{{ route('add_government') }}"><i class="fa-solid fa-angle-left mr-2"></i> <b>Back</b></a></span>
                                <button id="submitBtn" class="btn btn-dark float-right" style="padding: 10px 30px;" type="submit"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 13px; width: 13px; fill: currentcolor;"><path d="M10.25 4a2.25 2.25 0 0 0-4.495-.154L5.75 4v2h-1.5V4a3.75 3.75 0 0 1 7.495-.2l.005.2v2H13a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h7.25V4z"></path></svg><b>Continue</b></button>
                            </div>
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

<script>

</script>

@endsection
