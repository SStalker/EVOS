<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <title>eVos - HS - Osnabrueck</title>

    <!-- Styles (wenn fertig, per gulp ein file mit benötigten styles erzeugen und hereinladen)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="css/frontEnd.css" rel="stylesheet">

    <!-- JS (Wenn fertig, per gul passende files zusammen packen und herinladen)-->
    <script>
        //Websocket
        var url = '{{ env('SYNC_SERVER_URL', 'ws://127.0.0.1:8080/EVOS-Sync/sync') }}';
        var appUrl = '{{ url('/') }}';
    </script>

    <script src="{{ asset('js/all.js') }}"></script>
    <script src="js/frontEnd.js"></script>

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
