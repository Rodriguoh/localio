<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Localio</title>
        {{-- Favicons --}}
        <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="favicon.png" type="image/png">
        <link rel="icon" sizes="32x32" href="{{ asset('img/favicons/favicon-32.png') }}" type="image/png">
        <link rel="icon" sizes="64x64" href="{{ asset('img/favicons/favicon-64.png') }}" type="image/png">
        <link rel="icon" sizes="96x96" href="{{ asset('img/favicons/favicon-96.png') }}" type="image/png">
        <link rel="icon" sizes="196x196" href="{{ asset('img/favicons/favicon-196.png') }}" type="image/png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-touch-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-touch-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-touch-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-touch-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-touch-icon-144x144.png') }}">
        <meta name="msapplication-TileImage" content="favicon-144.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">

    <!-- BOOTSTRAP DEV  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <title>404 Error page</title>
</head>

<body data-set-preferred-mode-onload="true">

    <style>
        .cercle-jaune {
            position: absolute;
            margin-left: 175px;
        }

        @media screen and (min-width:768px){
            .cercle-jaune {
                margin-left: 375px;
            }
        }
    </style>
    <div class="page-wrapper mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="">404</h2>
            <p class="">Oops! Une erreur est survenu.</p>
        </div>

        <div class="mt-20 ml-10">
            <div class="text-center">
                <a class="btn btn-success btn-lg" href="{{ URL::previous() }}">Page précédente</a>
                <a class="btn btn-primary btn-lg" href="{{route('home')}}">Retourner à l'accueil</a>
            </div>

            <div class="cercle-jaune">
                <img class="h-350 h-sm-600 d-md-none" src="{{asset('img/cercleJaune.svg')}}" alt="cercle jaune">
            </div>
        </div>

    </div>
</body>

</html>
