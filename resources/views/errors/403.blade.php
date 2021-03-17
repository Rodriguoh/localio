<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="css/main.css"> --}}

    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">

    <!-- BOOTSTRAP DEV  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <title>403 Error page</title>
</head>

<body>

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
                <a class="btn btn-primary btn-lg"  href="{{route('home')}}">Retourner à l'accueil</a>
            </div>

            <div class="cercle-jaune">
                <img class="h-350 h-sm-600 d-md-none" src="{{asset('img/cercleJaune.svg')}}" alt="cercle jaune">
            </div>
        </div>

    </div>
</body>

</html>