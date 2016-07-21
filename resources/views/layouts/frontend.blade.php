<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>EVOS</title>

    <!-- Styles (wenn fertig, per gulp ein file mit benötigten styles erzeugen und hereinladen)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="css/frontEnd.css" rel="stylesheet">

    <!-- JS (Wenn fertig, per gul passende files zusammen packen und herinladen)-->
    <script>
        //Websocket
        var url = '{{ env('SYNC_SERVER_URL', 'ws://127.0.0.1:8080/EVOS-Sync/sync') }}';
        var appUrl = '{{ url('/') }}';

        if(typeof WebSocket === "undefined" ){
            window.location.replace(appUrl + "/error");
        }

    </script>

    <!-- JavaScripts -->
    <script src="{{ asset('js/all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/MathJaxConf.js') }}"></script>
    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script src="js/frontEnd.js"></script>

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
