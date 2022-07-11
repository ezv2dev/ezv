@extends('new-admin.layouts.admin_layout')

@section('title', 'Add Government ID - EZV2')

<style>
    .upload-front {
        border: 1px dotted #000;
        border-radius: 8px;
        padding: 30px;
        cursor: pointer;
        /* display: flex; */
    }

    .upload-back {
        border: 1px dotted #000;
        border-radius: 8px;
        padding: 30px;
        cursor: pointer;
        /* display: flex; */
    }

    .svg-front {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .svg-back {
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2" style="margin-left: 20px;">
                    <div class="col-md-5">
                        <h1 style="font-weight:bold; color: #383838;">
                            Upload images of your {!! isset($title) ? $title : "" !!}
                        </h1>
                        @if ($government['chooseGovernmentID'] && $government['chooseGovernmentID'] == 'passport')
                            <p class="text-dark" style="font-size: 11pt;">Make sure the photo of your {!! isset($title) ? $title : "" !!} isn’t blurry and that it clearly shows your face.</p>
                        @else
                            <p class="text-dark" style="font-size: 11pt;">Make sure your photos aren’t blurry and the front of your {!! isset($title) ? $title : "" !!} clearly shows your face.</p>
                        @endif
                    </div>
                </div>

                <!-- content -->
                <div id="content" class="col-12 mt-4">
                    @if ($government['chooseGovernmentID'] && $government['chooseGovernmentID'] == 'passport')
                    <div class="col-md-6 text-dark">
                        <form action="{{ route('add_government.step_three') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-11 mb-4" style="margin-left: 10px;">
                                <div class="form-group">
                                    <label>No. {!! isset($title) ? $title : "" !!}</label>
                                    <input class="form-control" type="text" name="no_id">
                                </div>
                            </div>
                            <div class="col-12 text-center" style="display: flex;">
                                <div class="col-12">
                                    <!-- Input File Front Picture -->
                                    <div class="upload-front" onclick="document.getElementById('getFilePassport').click()">
                                        <input type="file" id="getFilePassport" name="front_picture" style="display:none" onchange="previewPassport();">
                                        <div id="svgPassport" class="svg-front">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m1.66675 2.67728c0-1.29010774 1.19757945-2.22892485 2.43214873-1.95293212l.14254843.03728562 11.76455284 3.5293665 11.7747926-3.3852093c1.1836744-.3403064 2.3638086.45712676 2.5321485 1.63303369l.0152796.14287691.0051793.1462187v23.09468c0 .8279727-.5091718 1.5640524-1.2698418 1.8619846l-.155411.0536419-12.6207 3.7862c-.1499506.0449851-.3078242.0539821-.4609439.026991l-.1137505-.026991-12.62071315-3.786204c-.79308169-.2379357-1.35183119-.937138-1.41857691-1.7513494l-.00671274-.1642731zm1.99999664.00000464v23.24528886l12.33325336 3.6994265 12.3334-3.6994076v-23.0946724l-12.0569924 3.46639925c-.1474472.0423911-.3021582.05014891-.4521925.02334213l-.1114623-.02658488zm21.66607876 17.47821536v2.088l-9.333 2.8v-2.087zm0-6v2.088l-9.333 2.8v-2.087zm0-5.999v2.087l-9.333 2.8v-2.087z"></path></svg>
                                        </div>
                                        <span id="uploadPassport" style="display:block; margin-top: 5px;"><b>Upload passport</b></span>
                                        <span id="descriptionPassport" style="display:block; font-size: 9pt; color: #78938A;">JPEG or PNG only</span>
                                        <img id="framePassport" width="100%" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" style="margin-top: 60px;">
                                <span style="color: #525E75; font-size: 10pt;"><i style="font-size: 10pt;" class="fa-solid fa-lock"></i> We aim to keep the data you share private, safe, and secure.</span>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12">
                                <span><a class="text-dark" href="{{ route('add_government.step_two') }}"><i class="fa-solid fa-angle-left mr-2"></i> <b>Back</b></a></span>
                                <button class="btn btn-dark float-right" style="padding: 10px 30px;" type="submit"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 13px; width: 13px; fill: currentcolor;"><path d="M10.25 4a2.25 2.25 0 0 0-4.495-.154L5.75 4v2h-1.5V4a3.75 3.75 0 0 1 7.495-.2l.005.2v2H13a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h7.25V4z"></path></svg><b>Continue</b></button>
                            </div>
                        </form>

                    </div>
                    @else
                    <div class="col-md-6 text-dark">
                        <form action="{{ route('add_government.step_three') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-11 mb-4" style="margin-left: 10px;">
                                <div class="form-group">
                                    <label>No. {!! isset($title) ? $title : "" !!}</label>
                                    <input class="form-control" type="text" name="no_id">
                                </div>
                            </div>
                            <div class="col-12 text-center" style="display: flex;">
                                <div class="col-6">
                                    <!-- Input File Front Picture -->
                                    <div id="divFront" class="upload-front" onclick="document.getElementById('getFileFront').click()">
                                        <input type="file" id="getFileFront" name="front_picture" style="display:none" onchange="previewFront();">
                                        <div id="svgFront" class="svg-front">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m29 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v18c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-26c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-18c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm0 2h-26v18h26zm-3 12v2h-8v-2zm-16-8c1.6568542 0 3 1.3431458 3 3 0 .6167852-.1861326 1.1900967-.5052911 1.6668281 1.4972342.8624949 2.5052911 2.4801112 2.5052911 4.3331719h-2c0-1.3058822-.8343774-2.4168852-1.9990993-2.8289758l-.0009007-3.1710242c0-.5522847-.4477153-1-1-1-.51283584 0-.93550716.3860402-.99327227.8833789l-.00672773.1166211.00008893 3.1706743c-1.16523883.4118113-2.00008893 1.5230736-2.00008893 2.8293257h-2c0-1.8530607 1.00805693-3.470677 2.50570706-4.3343854-.3195745-.4755179-.50570706-1.0488294-.50570706-1.6656146 0-1.6568542 1.34314575-3 3-3zm16 4v2h-8v-2zm0-4v2h-8v-2z"></path></svg>
                                        </div>
                                        <span id="uploadFront" style="display:block; margin-top: 5px;"><b>Upload front</b></span>
                                        <span id="descriptionFront" style="display:block; font-size: 9pt; color: #78938A;">JPEG or PNG only</span>
                                        <img id="frameFront" width="100%" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Input File Front Picture -->
                                    <div id="divBack" class="upload-back" onclick="document.getElementById('getFileBack').click()">
                                        <input type="file" id="getFileBack" name="back_picture" style="display:none" onchange="previewBack();">
                                        <div id="svgBack" class="svg-back">
                                            <svg class="svg-back" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M29 5a2 2 0 0 1 1.995 1.85L31 7v18a2 2 0 0 1-1.85 1.995L29 27H3a2 2 0 0 1-1.995-1.85L1 25V7a2 2 0 0 1 1.85-1.995L3 5zm0 6H3v14h26zm-3 10a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-4 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7-14H3v2h26z"></path></svg>
                                        </div>
                                        <span id="uploadBack" style="display:block; margin-top: 5px;"><b>Upload back</b></span>
                                        <span id="descriptionBack" style="display:block; font-size: 9pt; color: #78938A;">JPEG or PNG only</span>
                                        <img id="frameBack" width="100%" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" style="margin-top: 60px;">
                                <span style="color: #525E75; font-size: 10pt;"><i style="font-size: 10pt;" class="fa-solid fa-lock"></i> We aim to keep the data you share private, safe, and secure.</span>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12">
                                <span><a class="text-dark" href="{{ route('add_government.step_two') }}"><i class="fa-solid fa-angle-left mr-2"></i> <b>Back</b></a></span>
                                <button class="btn btn-dark float-right" style="padding: 10px 30px;" type="submit"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 13px; width: 13px; fill: currentcolor;"><path d="M10.25 4a2.25 2.25 0 0 0-4.495-.154L5.75 4v2h-1.5V4a3.75 3.75 0 0 1 7.495-.2l.005.2v2H13a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h7.25V4z"></path></svg><b>Continue</b></button>
                            </div>
                        </form>

                    </div>
                    @endif
                </div>
                <!-- end content -->

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    function previewPassport()
    {
        document.getElementById('svgPassport').style.display = "none";
        document.getElementById('uploadPassport').style.display = "none";
        document.getElementById('descriptionPassport').style.display = "none";
        framePassport.src=URL.createObjectURL(event.target.files[0]);
    }

    function previewFront()
    {
        document.getElementById('svgFront').style.display = "none";
        document.getElementById('uploadFront').style.display = "none";
        document.getElementById('descriptionFront').style.display = "none";
        document.getElementById('divFront').style.padding ="8px";
        frameFront.src=URL.createObjectURL(event.target.files[0]);
    }

    function previewBack()
    {
        document.getElementById('svgBack').style.display = "none";
        document.getElementById('uploadBack').style.display = "none";
        document.getElementById('descriptionBack').style.display = "none";
        document.getElementById('divBack').style.padding ="8px";
        frameBack.src=URL.createObjectURL(event.target.files[0]);
    }

</script>

@endsection
