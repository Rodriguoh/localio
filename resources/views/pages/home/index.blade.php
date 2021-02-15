
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="#">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <style>
        #map {
            width: 100%;
            height: 100vh;
            z-index:1;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    <div id="app">
        <a id="scroll" href="#bottom">
            <img src="{{asset('img/arrow.svg')}}">
        </a>
        <div id="map">
        </div>
    </div>
    @include('layouts.footer')

    {{-- Import VueJS via CDN pour la phase de dev --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="js/mapScript.js"></script>
</body>
</html>
