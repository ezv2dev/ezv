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
    .cursor-disable{
        cursor: not-allowed;
    }

    .text-grey{
        color: #78938A;
    }

    #editButton{
        display: block;
        text-decoration: underline;
        margin-top: 20px;
    }

    .label-input{
        font-weight: 500;
    }

    .container-profile{
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .profile-right{
        margin-top:1rem !important;
    }

    .section-form-profile{
        margin-top:1rem;
    }

    .profile-right hr{
        display:block;
        margin:1rem 0;
    }

    .button{
        padding: 10px 30px;
    }

    #languagelist{
        display:flex;
        flex-wrap:wrap;
        gap:.5rem;
    }

    @media (min-width: 768px) {
        .container-profile{
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }

        .profile-right{
            padding: 0 1.5rem !important;
            margin-top:0 !important;
        }

        .profile-right hr{
            display:none;
            margin: 0;
        }
    }
</style>

@section('content_admin')

<div class="container container-profile ">
    <div class="row">
        <div class="col-md-4 profile-left">
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
                    <p class="text-dark">Show others you’re really you with the identity verification badge.</p>
                    <a href="#" class="btn btn-outline-dark button mt-4"><b>Get the badge</b></a>
                </div>
                <div class="confirmed">
                    <h3 class="mb-4"><b>{{ Auth::user()->first_name }} confirmed</b></h3>
                    <p><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="height: 16px; width: 16px; fill: currentcolor;"><path d="M13.102 2.537L15.365 4.8l-9.443 9.443L.057 8.378 2.32 6.115l3.602 3.602z"></path></svg> Email address</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 profile-right">
            <hr>
            <div class="section-profile">
                <h3 class="name-user">Hi, I'm {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                <span class="text-grey">Joined in {{ Auth::user()->created_at->format('Y') }}</span>
                <a id="editButton" class="text-dark" href="javascript:void(0);" onclick="showFormEditProfile();">Edit profile</a>
            </div>
            <div id="formEditProfile" class="section-form-profile d-none">
                <form action="{{ route('store_profile') }}" method="post" id="EditProfileForm">
                    @csrf
                    <div class="form-group">
                        <label class="label-input">About</label>
                        <!-- text area menampilkan semua yang ada di antara tag textarea, termasuk spasi -->
                        <textarea name="about" class="form-control" id="user-about" cols="30" rows="4">{{isset($profile->about)?$profile->about:''}}</textarea>
                        <small id="err-about" style="display: none;" class="invalid-feedback">The about field is required</small>
                    </div>
                    <div class="form-group">
                        <label class="label-input">Location</label>
                        <input type="text" id="locationForm" class="form-control" name="location" value="{{ isset($profile->location) ? $profile->location : '' }}">
                        <small id="err-location" style="display: none;" class="invalid-feedback">The location field is required</small>
                    </div>
                    <div class="form-group">
                        <label class="label-input">Languages I speak</label>
                        @if ($owner_language != null)
                        <div id="languagelist">
                            @foreach ($owner_language as $item)
                                <a href="#" class="btn btn-outline-success">{{ $item->name }}</a>
                            @endforeach
                        </div>
                        @endif
                        {{-- <input class="form-control" name="language_speak[]" type="text" id="language_speak" style="display: none;" data-role="tagsinput"> --}}
                        <a class="d-block" style="margin-top: 10px;" href="javascript:void(0);" onclick="addmore();">Add more</a>
                    </div>
                    <div class="form-group">
                        <label class="label-input">Work</label>
                        <input type="text" class="form-control" id="user-work" name="work" value="{{ isset($profile->work) ? $profile->work : '' }}">
                        <small id="err-work" style="display: none;" class="invalid-feedback">The work field is required</small>
                    </div>
                    <!-- Modal Checkbox-->
                    <div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Languages I speak</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetDataChecked()">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="header-description mb-3">
                                        <span class="text-dark" style="font-size: 11pt;">
                                            We have many international travelers who appreciate hosts who can speak their language.
                                        </span>
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
                                        height: 20px;" value="{{ $item->id_host_language }}" {{ $isChecked }} onchange="addlanguages(this);">
                                        <label class="form-check-label" style="margin-left: 10px; margin-top: 3px;">
                                        {{$item->name}}
                                        </label>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="appendLanguage()" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                        Done
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Checkbox-->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a class="text-dark" href="javascript:void(0);" onclick="hideFormEditProfile()">
                            <i class="fa-solid fa-angle-left mr-2"></i>
                            <b>Cancel</b>
                        </a>
                        <button id="submitBtn" class="btn btn-dark button" type="submit"><b>Save</b></button>
                    </div>
                </form>
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

    // data untuk language
    // get id from modal language
    let modalLanguage = [];

    // buat array baru untuk ditampilkan di form berdasarkan modal
    let data = [];

    function addmore()
    {
        $('#languageModal').modal();

        // simpan data awal yang checked ketika buka modal
        $("input[name='language[]']:checked").each(function () {
            modalLanguage.push(parseInt($(this).val()));
        });
    }

    function addlanguages(input)
    {

        //get language owner
        // let language = @json($languages);

        //get id from modal language
        // let modalLanguage = [];

        //buat array baru untuk ditampilkan di form berdasarkan modal
        // let data = [];

        // var checkbox = document.getElementById('languages');
        // --
        // $("input[name='language[]']:checked").each(function () {
        //     modalLanguage.push(parseInt($(this).val()));
        // });

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

        // ---
        // for (let i = 0; i < modalLanguage.length; i++) {
        //     for (let j = 0; j < language.length; j++) {
        //         if(language[j].id_host_language == modalLanguage[i]) {
        //             data.push(language[j]);
        //         }
        //     }
        // }

        // console.log(data);

        // appendLanguage(data);
    }
    
    // ketika batal melakukan perubahan data language, reset sesuai dengan data awal ketika modal language di buka
    function resetDataChecked(){
        $('#languageModal .form-check-input').each(function(){
            if(modalLanguage.includes(parseInt($(this).val()))){
                $(this).prop('checked', true)
            }else{
                $(this).prop('checked', false)
            }
        })
    }

    // ketika backdrop modal di klik reset data language checked
    $(document).click(function(e){
        if(e.target == $('#languageModal')[0] && $('body').hasClass('modal-open')){
            resetDataChecked()
        }
    })

    // function appendLanguage(data)
    function appendLanguage()
    {
        let language = @json($languages);
        //get id from modal language
        modalLanguage = [];

        //buat array baru untuk ditampilkan di form berdasarkan modal
        data = [];

        $("input[name='language[]']:checked").each(function () {
            modalLanguage.push(parseInt($(this).val()));
        });

        for (let i = 0; i < modalLanguage.length; i++) {
            for (let j = 0; j < language.length; j++) {
                if(language[j].id_host_language == modalLanguage[i]) {
                    data.push(language[j]);
                }
            }
        }

        $('#languagelist').html('');
        for (let index = 0; index < data.length; index++) {
            // let span = document.createElement('span');
            // span.id = 'bebas';
            // span.innerHTML = data[index].name;
            // document.getElementById("append").appendChild('span');
            $('#languagelist').append('<a href="#" class="btn btn-outline-success">' +data[index].name+ '</a>');
        }

    }

    function showFormEditProfile()
    {
        $('#formEditProfile').removeClass('d-none');
        $('#editButton').addClass('cursor-disable');
    }

    function hideFormEditProfile()
    {
        $('#formEditProfile').addClass('d-none');
        $('#editButton').removeClass('cursor-disable');
    }

</script>

<script>
    $(function() {
        $('#user-about').keyup(function() {
            $('#user-about').removeClass('is-invalid');
            $('#err-about').hide();
        })
        $('#locationForm').keyup(function() {
            $('#locationForm').removeClass('is-invalid');
            $('#err-location').hide();
        })
        $('#user-work').keyup(function() {
            $('#user-work').removeClass('is-invalid');
            $('#err-work').hide();
        })
        $('#EditProfileForm').submit(function (e) {
            let error = 0;
            if(!$('#user-about').val()) {
                $('#user-about').addClass('is-invalid');
                $('#err-about').show();
                error = 1;
            } else {
                $('#user-about').removeClass('is-invalid');
                $('#err-about').hide();
            }
            if(!$('#locationForm').val()) {
                $('#locationForm').addClass('is-invalid');
                $('#err-location').show();
                error = 1;
            } else {
                $('#locationForm').removeClass('is-invalid');
                $('#err-location').hide();
            }
            if(!$('#user-work').val()) {
                $('#user-work').addClass('is-invalid');
                $('#err-work').show();
                error = 1;
            } else {
                $('#user-work').removeClass('is-invalid');
                $('#err-work').hide();
            }
            if(error) {
                e.preventDefault();
            }
        });
    })
</script>
@endsection
