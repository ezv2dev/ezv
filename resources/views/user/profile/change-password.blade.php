<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - EZV</title>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}"> -->

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header_minimaliste.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .relative{
            position:relative;
        }
        .icon-input-container{
            position:absolute;
            right:.5rem;
            top:50%;
            transform:translateY(-50%);
            background:transparent;
            outline:none;
            border:0;
        }
    </style>
</head>
<body>
<div id="page-container">
     {{-- navbar --}}
     <section id="header-container" class="header">
        <!-- Header -->
        @include('layouts.user.header_minimaliste')
    </section>
    <section class="homes">
        <div class="col-lg-12 home-content">
            @if (session('success'))
            <div class="col-12">
                <div style="background-color: #CCEEE1 !important; color: #005937 !important; " class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                </div>
            </div>
            @endif
            <form action="{{ route('password_update') }}" method="POST" class="body-form">
                @csrf
                @method('PATCH')

                <h5>Change Password</h5>
                <div class="form-group">
                    <label class="label" for="old_password">Current Password</label>
                    <div class="relative">
                        <input type="password" name="old_password" id="old_password"
                            class="form-control adminlisting-font mb-2" size="50" placeholder="Old Password">
                        <button type="button" class="icon-input-container">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
    
                    <span class="invalid-feedback" role="alert"></span>
                </div>
                
                <div class="form-group">
                    <label class="label" for="password">New Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="form-control adminlisting-font mb-2"
                            size="50" placeholder="New Password">
                        <button type="button" class="icon-input-container">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
    
                    <span class="invalid-feedback" role="alert"></span>
                </div>

                <div class="form-group">
                    <label class="label" for="password_confirmation">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control adminlisting-font mb-2" size="50" placeholder="Confirm Password">
                        <button type="button" class="icon-input-container">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
    
                    <span class="invalid-feedback" role="alert"></span>
                </div>
                <button type="submit"
                    style="border-radius: 5px; color: white; font-size: 12px; padding: 9px; box-sizing: border-box; margin-top: 9px; background-color: #FF7400;">Update
                    password</button>
            </form>
        </div>
    </section>
    {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        {{-- modal laguage and currency --}}

        {{-- modal login --}}
        {{--@include('user.modal.auth.login_register')--}}
        {{-- @include('user.modal.user.bar_modal') --}}

        <!-- Footer -->
        @include('layouts.user.footer')
        <!-- END Footer -->
</div>
    <!-- END Page Container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

    <script>
        //Sticky Bar
        $(function(){
        $(window).scroll(function(){
            var winTop = $(window).scrollTop();
            if(winTop >= 100){
            $("#header-container").addClass("fix-header");
            }else{
            $("#header-container").removeClass("fix-header");
            }
            });
        });
    </script>
    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for Magnific Popup plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('assets/js/view-villa.js') }}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-slick']);

    </script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>
        Dashmix.helpersOnLoad(['jq-magnific-popup']);

    </script>

    <!-- Tambahan -->
    <script src="{{ asset('assets/js/home.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
        {{-- Search Location --}}
        <script>
            //show password
            $('.icon-input-container').on('click',function(){
                let parent = $(this).parent()
                let icon = $(this).find('.fa-solid')
                if(icon.hasClass('fa-eye')){
                    icon.removeClass('fa-eye')
                    icon.addClass('fa-eye-slash')
                    parent.find('.form-control').get(0).type = 'password'
                }else{
                    icon.removeClass('fa-eye-slash')
                    icon.addClass('fa-eye')
                    parent.find('.form-control').get(0).type = 'text'
                }
            })

            //validasi form when on keyup
            $('.form-control').on('keyup', function(){
                validate($(this))
            })

            //validasi form when on focusout
            $('.form-control').on('focusout', function(){
                validate($(this))
            })

            async function validate(input){
                let parentInput = input.parent()
                let messageContainer = parentInput.parent().find('.invalid-feedback')
                let iconInput = parentInput.find('.icon-input-container')
                // reset error style
                // await resetErrorStyle(input, parentInput)
                console.log(input.val(), !input.val())
                if(!input.val()){
                    setErrorStyle(input, messageContainer, iconInput)
                    messageContainer.text('{{ __('auth.empty_password') }}')
                }else{
                    if(input.val().length < 8){
                        setErrorStyle(input, messageContainer, iconInput)
                        messageContainer.text('{{ __('auth.min_password') }}')
                    }else if(input.attr('id') == 'password_confirmation'){
                        if(input.val() != $('#password').val()){
                            setErrorStyle(input, messageContainer, iconInput)
                            messageContainer.text('{{ __('auth.invalid_password') }}')
                        }
                    }else{
                        resetErrorStyle(input, messageContainer, iconInput)
                    } 
                }
            }
            
            function setErrorStyle(input, messageContainer, iconInput){                
                input.hasClass('is-invalid') ? '' : input.addClass('is-invalid')
                iconInput.hide()
                messageContainer.show()
            }

            function resetErrorStyle(input, messageContainer, iconInput) {
                input.removeClass('is-invalid')
                iconInput.show()
                messageContainer.hide()
                messageContainer.text('')
            }

            $(document).ready(() => {


                if (window.scrollY == 0 && window.innerWidth <= 991) {
                    document.getElementById("ul").style.display = "none";
                }
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                })
                $("#expand-mobile-btn").on("click", function() {
                    $("body").css({
                        "height": "100%",
                        "overflow": "hidden"
                    })
                    $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "true");
                })
                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest').removeClass("display-none");
                    $('#sugest').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#loc_sugest").on('keyup change', async () => {
                    var close = $(".sugest-list-first");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty").eq(0).hide();

                    var formValue = $("#loc_sugest").val();
                    var isEmpty = true;

                    $(".sugest-list").map((data) => {
                        var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                            .children('a').text();
                        if (name.toLowerCase().includes(formValue.toLowerCase())) {
                            $(".sugest-list").eq(data).show();
                            isEmpty = false;
                        }
                    });

                    if (isEmpty) {
                        $(".sugest-list-empty").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op").on('click', function(e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                });
            });
        </script>

        <script>
            function language() {
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').addClass('active');
                $('#content-tab-language').addClass('active');
                $('#trigger-tab-currency').removeClass('active');
                $('#content-tab-currency').removeClass('active');
            }
            function currency() {
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');
            }
        </script>
        <script>
            function view_LoginModal() {
                $('#LoginModal').modal('show');
            }
        </script>

        {{-- LAZY LOAD --}}
        @include('components.lazy-load.lazy-load')
        {{-- END LAZY LOAD --}}
</body>

</html>
