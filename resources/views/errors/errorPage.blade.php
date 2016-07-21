<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EVOS</title>

    <!-- Styles (wenn fertig, per gulp ein file mit benötigten styles erzeugen und hereinladen)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="css/frontEnd.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="wrapper">
        <div id="websocketErrorPanel" class="container" style="text-align: center;">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive center-block">
            <h1>Ooops, da ging etwas schief!</h1>
            <p style="margin-top: 2%">
                Der Browser unterstützt keine Websockets oder deine Anti Viren Software blockiert den Websocket.
                Welcher der beiden fälle auf dich zutrifft findest du auf <a href="https://websocketstest.com/">https://websocketstest.com/</a> herraus.
            </p>
            <p>
                Eine kurze Übersicht einiger Browser die WebSockets unterstützen finden sie auf <a href="http://caniuse.com/#search=websockets">http://caniuse.com/#search=websockets</a>,
                oder <a href="https://developer.mozilla.org/de/docs/WebSockets">https://developer.mozilla.org/de/docs/WebSockets</a> .
                Sollten die Links nicht funktionieren bleibt zu sagen, dass inzwischen alle aktuellen Browser diese Technologie unterstützen.
            </p>
        </div>
    </div>
</div>
</body>
</html>
