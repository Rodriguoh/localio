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

                <div class="select-type">

                    <input type="radio" id="connexion" v-model="connexion" value="{{true}}" checked hidden>
                    <label for="connexion">CONNEXION</label>

                    <input type="radio" id="inscription" v-model="connexion" value="{{false}}" hidden>
                    <label for="inscription">INSCRIPTION</label>

                </div>

                <!-- Container largeur utile -->
                <div class="login-section" v-if="connexion">
                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}" style="width:100%">
                    @csrf

                    <!-- Email Address -->
                        <div class="login-input">
                            <x-input id="email" class="form-control form-control-lg" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" />
                        </div>

                        <!-- Password -->
                        <div class="login-input">

                            <x-input id="password" class="form-control form-control-lg" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password" style="margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;outline:none" />
                        </div>

                        <!-- Remember Me -->

                        <div class="checkbox mb-3">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember_me" style="margin: 2px 0 0 5px">
                                Rester Connecter
                            </label>
                        </div>

                        <div class="d-flex flex-column align-items-center">

                            <button class="btn btn-action btn-r8 login-btn">SE CONNECTER</button>
                            <x-google-link/>
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a><br>
                            @endif

                        </div>
                    </form>

                </div>

                <!-- Container largeur utile -->
                <div class="login-section" v-else>

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('register') }}" class="w-full">
                    @csrf
                    <!-- Email Address -->
                        <div class="login-input">
                            <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" placeholder="Email" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" required />
                        </div>
                        <!-- Password -->
                        <div class="login-input">
                            <x-input id="password" class="form-control form-control-lg" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password" style="margin-bottom: -1px;border-radius:0" />
                        </div>
                        <!-- Confirm Password -->
                        <div class="login-input">
                            <x-input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirmation mot de passe" style="margin-bottom:-1px; border-top-left-radius:0;border-top-right-radius:0" required />
                        </div>

                        <div class="d-flex flex-column m-10">
                            <button type="submit" class="btn btn-action btn-r8 login-btn">S'INSCRIRE</button>
                        </div>
                    </form>
                </div>

                {{-- <div class="circle"></div>--}}

            </div>

        </div>

    </div>
</body>
</html>
