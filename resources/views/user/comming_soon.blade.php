<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EZV</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/comming/css/bd-coming-soon.css') }}">

</head>

<body class="min-vh-100 d-flex flex-column">

    <header>
        <div class="container">
            <nav class="navbar navbar-dark bg-transparenet">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <strong>EZV<span style="color: #FF7400">2</span></strong>
                </a>
                <span class="navbar-text ml-auto d-none d-sm-inline-block">000-000-000-000</span>
                <span class="navbar-text d-none d-sm-inline-block">info@ezv.app</span>
            </nav>
        </div>
    </header>
    <main class="my-auto">
        <div class="container">
            <h1 class="page-title">We're <span style="color: #FF7400">coming soon</span></h1>
            <p class="page-description">We are preparing something amazing and exciting for you. We also have a special
                surprise for our subscribers.
            </p>
            <a href="{{ route('index') }}"><strong style="color: #FF7400;">Back to Home</strong></a>
            <nav class="footer-social-links" style="margin-top: 15px;">
                <a href="#!" class="social-link"><i class="mdi mdi-facebook-box"></i></a>
                <a href="#!" class="social-link"><i class="mdi mdi-twitter"></i></a>
                <a href="#!" class="social-link"><i class="mdi mdi-google"></i></a>
                <a href="#!" class="social-link"><i class="mdi mdi-slack"></i></a>
                <a href="#!" class="social-link"><i class="mdi mdi-skype"></i></a>
            </nav>
        </div>
    </main>
</body>

</html>
