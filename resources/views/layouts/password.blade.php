<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Forgot Password - EZV</title>
    <link href="{{ asset('assets/partner/css/styles.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">

    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous">
    </script>

    <style>
        .card-header{
            background-color: #222222 !important;
            color: white !important;
        }
        @media only screen and (max-width: 425px) {
            .card {
                max-width: 90%;
                margin: 0 auto;
                padding: 10px;
            }
            .forget-header {
            padding: 0 1rem !important;
            }
        }
        .forget-header {
            width: 100%;
            height: 70px;
            background: #000;
            padding: 0 7rem;
        }
    </style>
</head>

<body class="bg-transparent">
    <section class="forget-header">
        <div class="row">
            <div class="col-4">
            <a href="{{ route('index') }}" target="_blank"><img style="width: 90px; margin-top: 15px;"
                    src="{{ asset('assets/logo.png') }}" alt="oke"></a>
            </div>
        </div>
    </section>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="mt-5">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('new-admin.layouts.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/partner/js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>
