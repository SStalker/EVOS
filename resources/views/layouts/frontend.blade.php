<!DOCTYPE html>
<html lang="en" ng-app="evosApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eVos - HS - Osnabrueck</title>

    <!-- Angular JS -->
    <script src="app/js/angular.min.js"></script>
    <script src="app/js/angular-route.min.js"></script>
    <script src="app/controller/frontEnd.js"></script>

    <!-- Styles -->
    <link href="app/css/frontEnd.css" rel="stylesheet">
    <link href="app/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body>
    @yield('frontEndContent')
</body>
</html>
