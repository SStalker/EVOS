<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <title>eVos - HS - Osnabrueck</title>

    <!-- Angular JS -->
    <script src="app/js/jquery-2.2.2.js"></script>
    <script src="app/js/frontEnd.js"></script>
    <!-- Styles -->
    <link href="app/css/frontEnd.css" rel="stylesheet">
    <link href="app/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <script>
        $.ajaxSetup(
                {
                    headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
    </script>
</head>
<body>
    @yield('frontEndContent')
</body>
</html>
