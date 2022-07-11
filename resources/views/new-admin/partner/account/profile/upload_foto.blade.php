@extends('new-admin.layouts.admin_layout')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Profile Photo - EZV2')

<style>
    .photo-profile {
        height: 200px;
        border-radius: 50%;
        margin-top: 20px;
        margin-left: 50px;
        aspect-ratio : 1/1;
    }

</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2" style="margin-left: 30px;">
                    <div class="block-content">
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('profile_user') }}">Profile</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Profile photos</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Profile photos
                    </h1>
                </div>

                <div id="content" class="col-12">
                    <div class="col-12 mt-5 d-flex" style="margin-left: 10px;">
                        <div class="col-md-9">
                            <div class="card" style="box-shadow: 0px 3px 15px -8px rgb(100,100,100);">
                                <div class="card-header" style="background: #DDDDDD;">
                                    <span class="text-dark">Profile Photo</span>
                                </div>
                                <div class="card-block">
                                    <div class="row" style="padding:20px;">
                                        <div class="col-lg-5 tags">
                                            @if (Auth::user()->foto_profile != NULL)
                                                <img class="photo-profile" src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                                            @elseIf (Auth::user()->avatar != NULL)
                                                <img class="photo-profile" src="{{ Auth::user()->avatar }}">
                                            @else
                                                <img class="photo-profile" src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                                            @endif
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="section-description">
                                                <p class="text-dark mb-3" style="font-size: 11pt;">A profile photo that shows your face can help other hosts and guests get to know you. EZV2 requires all hosts to have a profile photo. We don’t require guests to have a profile photo, but hosts can. If you’re a guest, even if a host requires you to have a photo, they won’t be able to see it until your booking is confirmed.</p>
                                                <input type="file" id="getFile" name="foto_profile" style="display:none">
                                                <a class="btn btn-outline-dark" style="display: block;" href="javascript:void(0);" onclick="document.getElementById('getFile').click()"><b>Upload a file from your computer</b></a>
                                                <span id="msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/card-block-->
                            </div>
                        </div>
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
     $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script type="text/javascript">
    $('#getFile').on('change',function(ev){

      var filedata=this.files[0];
      var imgtype=filedata.type;

    //   console.log(imgtype);

    //   var match=['image/jpeg','image/jpg','image/png'];

      if(imgtype.includes("image/png") || imgtype.includes("image/jpg") || imgtype.includes("image/jpeg")){

        //upload

        var postData=new FormData();
          postData.append('file',this.files[0]);

          var url="/users/edit-photo/upload";

          $.ajax({
          async:true,
          type:"post",
          contentType:false,
          url:url,
          data:postData,
          processData:false,
          beforeSend:function(){
                    $('#msg').html("<label class='text-success'>Image Uploading...</label>");
                },
                success: (response) => {
                    if (response) {
                        alert('Image has been uploaded successfully');
                        location.reload();
                        this.reset();
                    }
                },
                error: function(response){
                    alert('Error uploading image');
                    $('#msg').html('<p style="color:red">Error uploading image</p>');
                }

          });


      }else{

        $('#msg').html('<p style="color:red">Plz select a valid type image..only jpg, jpeg, png allowed</p>');

      }

    });

  </script>

@endsection
