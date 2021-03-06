<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css" />

    <!-- JavaScripts -->
    <script src="{{ asset('js/frameworks.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/MathJaxConf.js') }}"></script>
    <script type="text/javascript"
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/evos.png') }}">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if(Auth::user())
                    <li><a href="{{ url('/categories') }}">Kategorien</a></li>
                    <li><a href="{{ url('/share') }}">Freigaben</a></li>
                @endif
                @if(Auth::user() != null && Auth::user()->isAdmin)
                    <li><a href="{{ url('/users') }}" class="alert-danger">Benutzer</a></li>
                @endif
            </ul>
            <div class="pull-right">
                @if(Auth::user())

                    {{ Form::open(['url' => 'search', 'method' => 'GET', 'class' => 'input-group navbar-form navbar-left']) }}
                    <div class='input-group'>
                        {{ Form::text('searchtext', null, ['class' => 'form-control searchtext', 'placeholder' => 'Suche...']) }}
                        <span class="input-group-btn">
                            {{ Form::button('Suchen', ['type' => 'submit', 'class' => 'btn btn-default']) }}
                        </span>
                    </div>
                {{ Form::close() }}
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/change_password') }}"><i class="fa fa-key fa-fw"></i>Passwort
                                        ändern</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</nav>

@yield('breadcrumb')

@if ($errors->any())
    <div class="alert alert-danger">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Es gab ein paar Probleme:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
        {{ session('message') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
