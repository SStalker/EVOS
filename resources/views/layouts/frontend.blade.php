<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>EVOS</title>

    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

    <!-- JavaScripts -->
    <script>
        //Websocket
        var url = '{{ env('SYNC_SERVER_URL', 'ws://127.0.0.1:8080/EVOS-Sync/sync') }}';
        var appUrl = '{{ url('/') }}';
        var phpSession = '{{ session()->getId() }}';

        console.log('test');

        if(WebSocket === undefined ){
            location.href = "/error";
        }

    </script>

    <!-- JavaScripts -->
    <script src="{{ asset('js/frontEnd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/MathJaxConf.js') }}"></script>
    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script>
        $.ajaxSetup(
                {
                    headers:
                    {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
    </script>
</head>
<body>
    @yield('frontEndContent')
</body>
</html>
