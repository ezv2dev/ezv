<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Forgot Password - SB Admin Pro</title>
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
    </style>
</head>

<body class="bg-transparent">

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
