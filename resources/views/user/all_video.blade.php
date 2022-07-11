<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>EZV2</title>

    <meta name="description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}"> --}}

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
  </head>
  <body>
    <div id="page-container" >

      <!-- Main Container -->
      <main id="main-container">

        <!-- Page Content -->
        <!-- Magnific Popup (.js-gallery class is initialized in Helpers.jqMagnific()) -->
        <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
        <div class="content">
          <!-- Simple Gallery -->
          <h2 class="content-heading">Video</h2>
          <div class="row items-push js-gallery img-fluid-100">
            @foreach($data as $item)
            <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                <a type="button" onclick="view({{ $item->id_video }});">
                    <i class="fas fa-2x fa-play-circle" style="position: absolute; bottom:50%; left:40%; color:white"></i>
                    <video class="img-fluid" style="object-fit: cover; display: block" src="{{ URL::asset('/foto/gallery/'.strtolower($item->name).'/'.$item->video)}}" alt=""></video>
                </a>
            </div>
            @endforeach
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Modal -->
      <div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="modal-default-large modal-default-fadein" aria-hidden="true" style="border-radius: 10px;"> 
        <div class="modal-dialog modal-lg" role="document">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="">
                <video controls id="video1" style="border-radius: 25px; position:relative; display:block;">
                    <source src="">
                    Your browser doesn't support HTML5 video tag.
                </video>
                <h5 style="position:absolute; top:30px; left:30px; text-color:black;" id="title"></h5><br>
            </div>
            <div class="modal-content" style="width: 720px; border:0.5px solid rgb(187, 187, 187); border-radius:10px;">
                <div class="modal-footer" style="width: 720px; border:0.5px solid rgb(187, 187, 187); border-radius:10px; background-color:white;">
                    <p id="mod_description" style="text-color:black; padding-left:5px; padding-right:5px;"></p>
                    <a type="button" class="btn btn-sm btn-outline-success"  href="" target="_blank">See More Videos</a>
                </div>
            </div>
        </div>
    </div>

      <!-- Footer -->
      <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
          <div class="row fs-sm">
            {{-- <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
              Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
            </div> --}}
            <div class="col-sm-6 order-sm-1 text-center text-sm-start">
              <a class="fw-semibold" href="#" target="_blank">EZV2 V 1.0</a> &copy; <span data-toggle="year-copy"></span>
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    {{-- <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script> --}}

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>Dashmix.helpersOnLoad(['jq-slick']);</script>

    <script>
        function view(id){
            $.ajax({
            type: "GET",
            url: "/villa-video-list/" + id,
            dataType: "JSON",
            success: function(data){
                var video = document.getElementById('video1');
                var public = '/foto/gallery/';
                var slash = '/';
                var name = data[0].name;
                video.src = public + data[0].name + slash + data[0].video;
                video.load();
                video.play();
                $("#title").html(name);
                var short_text = data[0].description.substr(0, 200);
                $('#mod_description').html(short_text + "...");       
                $('#videomodal').modal('show');
            }
            });
        }

        // $("#video1").on("ended", function() {
        //     // $('#videomodal').modal('hide');
        //     $.ajax({
        //     type: "GET",
        //     url: "/video/next",
        //     dataType: "JSON",
        //     success: function(data){
        //         var video = document.getElementById('video1');
        //         var public = '/foto/gallery/';
        //         var slash = '/';
        //         video.src = public + data[0].name + slash + data[0].video;
        //         video.load();
        //         video.play();
        //         $("#title").html(data[0].name);
        //         var short_text = data[0].description.substr(0, 200);
        //         $('#mod_description').html(short_text + "...");
        //         $('#videomodal').modal('show');
        //     }
        //     });
        // });

        $(function(){
            $('#videomodal').modal({
                show: false
            }).on('hidden.bs.modal', function(){
                $(this).find('video')[0].pause();
            });
        });
    </script>
  </body>
</html>
