<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="viewport" content="width=device-width" />

    {{-- <link rel="stylesheet" href="css/main.css"> --}}
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    <script src="{{ asset('js/mapScript.js')}}" defer></script>

    <!-- Favicon and title -->
    <link rel="icon" href="path/to/fav.png">
    <title>Login</title>

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
