<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontEndUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="{{ asset('js/all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/MathJaxConf.js') }}"></script>
    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{!! asset('images/evos.png') !!}">
            </a>
        </div>
    </div>
</nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
