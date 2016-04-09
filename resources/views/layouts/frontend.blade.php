<!DOCTYPE html>
<html lang="en" ng-app="evosApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eVos - HS - Osnabrueck</title>

    <!-- Angular JS -->
    <script src="app/js/angular.min.js"></script>
    <script src="app/controller/frontEnd.js"></script>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body>
    <div ng-controller="frontEndController as ctrl">
        <p class="text-center"> <% test %> </p>
    </div>
</body>
</html>
