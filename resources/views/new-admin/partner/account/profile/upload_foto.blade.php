@extends('new-admin.layouts.admin_layout')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Profile Photo - EZV2')

<style>
    .photo-profile {
        height: 150px;
        border-radius: 50%;
        aspect-ratio : 1/1;
        object-fit:cover;
    }

    .title-header{
        font-weight:bold; 
        color: #383838; 
        font-size:25pt; 
    }

    #content{
        width:100%;
        margin:1.5rem 0;
    }

    #content .card{
        box-shadow: 0px 3px 15px -8px rgb(100,100,100);
    }
    .card-image-profile{
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .card-profile-description,
    .card-profile-description hr{
        margin:.75rem 0;
    }

    .card-profile-description hr{
        display:block;
    }
    @media (min-width: 768px) {
        .photo-profile {
            height: 200px;
        }
        #content{
            width:80%;
            margin:3rem 0;
        }
        .card-profile-description,
        .card-profile-description hr{
            margin:0;
        }

        .card-profile-description hr{
            display:none;
        }
    }

    @media (min-width: 992px) {
        #content{
            width:70%;
        }
    }

</style>

@section('content_admin')

<div class="container container-dashboard">
    <div class="header-edit-photo">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent m-0 pl-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('profile_user') }}">Profile</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Profile photos</li>
            </ol>
        </nav>
        <h1 class="title-header">Profile photos</h1>
    </div>

    <div id="content">
        <div class="card">
            <div class="card-header" style="background: #DDDDDD;">
                <span class="text-dark">Profile Photo</span>
            </div>
            <div class="card-block">
                <div class="row p-4">
                    <div class="col-md-5 card-image-profile">
                        @if (Auth::user()->foto_profile != NULL)
                            <img class="photo-profile" src="{{ asset('foto_profile/'.Auth::user()->foto_profile) }} ">
                        @elseIf (Auth::user()->avatar != NULL)
                            <img class="photo-profile" src="{{ Auth::user()->avatar }}">
                        @else
                            <img class="photo-profile" src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name }}">
                        @endif
                    </div>
                    <div class="col-md-7 card-profile-description">
                        <hr>
                        <div class="section-description">
                            <p class="text-dark mb-3 text-sm">A profile photo that shows your face can help other hosts and guests get to know you. EZV2 requires all hosts to have a profile photo. We don’t require guests to have a profile photo, but hosts can. If you’re a guest, even if a host requires you to have a photo, they won’t be able to see it until your booking is confirmed.</p>
                            <input type="file" id="getFile" name="foto_profile" class="d-none">
                            <a class="btn btn-outline-dark d-block" href="javascript:void(0);" onclick="document.getElementById('getFile').click()"><b>Upload a file from your computer</b></a>
                            <span id="msg"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--/card-block-->
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
