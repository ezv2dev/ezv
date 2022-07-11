<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EZV2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        .bg-company{
            background-color: #FF7400;
        }

        .btn-company {
            font: 600 0.9rem Poppins, sans-serif;
            padding: 1rem 2.5rem;
            background-color: #FF7400;
            transition: 0.3s;
            letter-spacing: 0.025em;
            border-radius: 0.75rem;
            color: #ffffff;
        }

        .btn-company:hover {
            background-color: #000000;
            transition: 0.3s;
            color: #ffffff;
        }

        .btn-outline-company {
            font: 600 0.9rem Poppins, sans-serif;
            padding: 1rem 2.5rem;
            border: 2px solid #FF7400;
            background-color: #FF7400;
            transition: 0.3s;
            background-color: transparent;
            border-radius: 0.75rem;
            color:#FF7400;
        }

        .btn-outline-company:hover {
            background-color:#ffffff;
            border:2px solid #ffffff;
            color: #FF7400;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    @include('layouts.user2.header')
    @yield('content')
    @include('layouts.user2.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>
