@extends('new-admin.layouts.admin_layout')

@section('title', 'Profile User - EZV2')

<style>
    .section-photo {
        height: auto;
        border: 1px solid #DFDFDE;
        border-radius: 10px;
        color: #3A3845;
        padding-bottom: 20px;
    }

    .photo {
        text-align: center;
    }

    .section-profile {
        height: 150px;
        padding: 15px;
        /* border: 1px solid #78938A; */
        border-radius: 5px;
    }

    .section-form-profile {
        padding: 15px;
    }

    .photo-profile {
        height: 125px;
        border-radius: 50%;
        margin-top: 30px;
        margin-bottom: 10px;
        asset-ratio : 1/1;
    }

    .name-user {
        font-size: 20pt;
        font-weight: bold;
    }

    .confirmed {
        margin: 30px;
        border-top: 1px solid #DFDFDE;
        padding-top: 20px;
    }

    .identity-verification {
        margin: 30px;
    }

</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 d-flex">
                    <div class="col-4">
                        <div class="section-photo">
                            <div class="photo">
                                @if (Auth::user()->foto_profile != NULL)
                                    <img class="photo-profile" src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                                @elseIf (Auth::user()->avatar != NULL)
                                    <img class="photo-profile" src="{{ Auth::user()->avatar }}">
                                @else
                                    <img class="photo-profile" src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                                @endif
                                {{-- <img class="photo-profile" src="{{ Auth::user()->foto_profile == NULL || Auth::user()->avatar == NULL ? 'https://a0.muscache.com/defaults/user_pic-225x225.png' : asset('/foto_profile/'.Auth::user()->foto_profile) }}" alt=""> --}}
                                <a style="text-decoration: underline; display: block;" class="text-dark" href="{{ route('upload_foto_index') }}">Update photo</a>
                            </div>
                            <div class="identity-verification">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor; margin-bottom: 20px;"><path d="M16 .798l.555.37C20.398 3.73 24.208 5 28 5h1v12.5C29 25.574 23.21 31 16 31S3 25.574 3 17.5V5h1c3.792 0 7.602-1.27 11.445-3.832L16 .798zm0 2.394l-.337.213C12.245 5.52 8.805 6.706 5.352 6.952L5 6.972V17.5c0 6.831 4.716 11.357 10.713 11.497L16 29c6.133 0 11-4.56 11-11.5V6.972l-.352-.02c-3.453-.246-6.893-1.432-10.311-3.547L16 3.192zm7 7.394L24.414 12 13.5 22.914 7.586 17 9 15.586l4.5 4.499 9.5-9.5z"></path></svg>
                                <h3><b>Identity verification</b></h3>
                                <p style="color:#3A3845">Show others you’re really you with the identity verification badge.</p>
                                <a href="#" class="btn btn-outline-dark" style="padding: 10px 25px; margin-top: 20px;"><b>Get the badge</b></a>
                            </div>
                            <div class="confirmed">
                                <h3 class="mb-4"><b>{{ Auth::user()->first_name }} confirmed</b></h3>
                                <p><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="height: 16px; width: 16px; fill: currentcolor;"><path d="M13.102 2.537L15.365 4.8l-9.443 9.443L.057 8.378 2.32 6.115l3.602 3.602z"></path></svg> Email address</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="section-profile">
                            <h3 class="name-user">Hi, I'm {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                            <span style="color: #78938A;">Joined in {{ Auth::user()->created_at->format('Y') }}</span>
                            <div class="row">
                                <div class="col-2">
                                <a id="editButton" style="display: block; text-decoration: underline; margin-top: 20px;" class="text-dark" href="javascript:void(0);" onclick="showFormEditProfile();">Edit profile</a>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-2">
                                        <span id="disableButton" style="display: none; text-decoration: underline; margin-top: 20px; cursor: not-allowed;
                                        pointer-events: all !important; color: #78938A;">Edit profile
                                        </span>
                                    </div>
                                </div>

                        </div>
                        <div id="formEditProfile" class="section-form-profile" style="display: none;">
                            <form action="{{ route('store_profile') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label style="font-weight: 500;">About</label>
                                    <textarea name="about" class="form-control" id="" cols="30" rows="4">{{ isset($profile->about) ? $profile->about : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 500;">Location</label>
                                    <input type="text" id="locationForm" class="form-control" name="location" value="{{ isset($profile->location) ? $profile->location : '' }}">
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 500;">Languages I speak</label>
                                    @if ($owner_language != null)
                                    <div id="languagelist">
                                        @foreach ($owner_language as $item)
                                            <a href="#" class="btn btn-outline-success mr-2">{{ $item->name }}</a>
                                        @endforeach
                                    </div>
                                    @endif
                                    {{-- <input class="form-control" name="language_speak[]" type="text" id="language_speak" style="display: none;" data-role="tagsinput"> --}}
                                    <a class="d-block" style="margin-top: 10px;" href="javascript:void(0);" onclick="addmore();">Add more</a>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 500;">Work</label>
                                    <input type="text" class="form-control" name="work" value="{{ isset($profile->work) ? $profile->work : '' }}">
                                </div>
                                <!-- Modal Checkbox-->
                                <div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Languages I speak</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="header-description mb-3">
                                                <span class="text-dark" style="font-size: 11pt;">We have many international travelers who appreciate hosts who can speak their language.</span>
                                            </div>

                                            @foreach ($languages as $item)
                                            <div class="form-check">
                                                @php
                                                    $isChecked = "";
                                                    foreach ($owner_language as $owner_lang) {
                                                        if($item->id_host_language == $owner_lang->language) {
                                                            $isChecked = "checked";
                                                        }
                                                    }
                                                @endphp
                                                <input class="form-check-input" type="checkbox" name="language[]" id="languages" style="width: 20px;
                                                height: 20px;" value="{{ $item->id_host_language }}" {{ $isChecked }} onchange="addlanguages(this.value);">
                                                <label class="form-check-label" style="margin-left: 10px; margin-top: 3px;">
                                                {{$item->name}}
                                                </label>
                                            </div>
                                            @endforeach

                                        </div>
                                        <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                        <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">Done</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Modal Checkbox-->
                                <div class="col-12 d-flex justify-content-between mt-4">
                                    <a class="text-dark" href="javascript:void(0);" onclick="cancelButtonForm()"><i class="fa-solid fa-angle-left mr-2"></i> <b>Cancel</b></a>
                                    <button id="submitBtn" class="btn btn-dark" style="padding: 10px 30px;" type="submit"><b>Save</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end col-8 -->

                </div>
            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjPdG66Pt3sqya1EC_tjg9a4F2KVC5cTk&libraries=places">
</script>

<script>

    var input = document.getElementById('locationForm');

    var autocomplete = new google.maps.places.Autocomplete(input);

    function addmore()
    {
        $('#languageModal').modal();
    }

    function addlanguages()
    {
        //get language owner
        let language = @json($languages);

        //get id from modal language
        let modalLanguage = [];

        //buat array baru untuk ditampilkan di form berdasarkan modal
        let data = [];

        // var checkbox = document.getElementById('languages');

        $("input[name='language[]']:checked").each(function () {
            modalLanguage.push(parseInt($(this).val()));
        });

        // console.log(modalLanguage);

        // for (let index = 0; index < language.length; index++) {
        //     data.push(language[index]);
        //     if(language[index].id_host_language == modalLanguage[index] ) {
        //         console.log(language[index]);
        //         // data = language[index];
        //         // data.push(language[index]);
        //         // break;
        //     }
        // }
        for (let i = 0; i < modalLanguage.length; i++) {
            for (let j = 0; j < language.length; j++) {
                if(language[j].id_host_language == modalLanguage[i]) {
                    data.push(language[j]);
                }
            }
        }

        // console.log(data);

        appendLanguage(data);
    }

    function appendLanguage(data)
    {
        $('#languagelist').html('');
        for (let index = 0; index < data.length; index++) {
            // let span = document.createElement('span');
            // span.id = 'bebas';
            // span.innerHTML = data[index].name;
            // document.getElementById("append").appendChild('span');
            $('#languagelist').append('<a href="#" class="btn btn-outline-success mr-2">' +data[index].name+ '</a>');
        }
    }

    function showFormEditProfile()
    {
        document.getElementById('editButton').style.display = "none";
        document.getElementById('disableButton').style.display = "block";

        document.getElementById('formEditProfile').style.display = "block";
    }

    function cancelButtonForm()
    {
        document.getElementById('editButton').style.display = "block";
        document.getElementById('disableButton').style.display = "none";

        document.getElementById('formEditProfile').style.display = "none";
    }

</script>

@endsection
