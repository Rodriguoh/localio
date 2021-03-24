<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="viewport" content="width=device-width" />

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
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <title>Login - Localio</title>

</head>
<body class="full-with">

    <div id="app">

        @include('components.navbar')


        <!-- Container avec les marges -->
        <div class="login-container">

            <div class="login-illustration">
                <h1>Nous étions sûr que vous reviendrez.</h1>
                <h3>Mais ce qui compte pour nous, c’est votre satisfaction.</h3>
                <img src="{{asset('img/illustrations/login-welcome.svg')}}"/>
            </div>

            <div class="login-forms">

                @yield('content')

            </div>

        </div>

    </div>
</body>
</html>
