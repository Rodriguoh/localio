@extends('layouts.auth')
@section('content')

    <div class="select-type">

        <a href="{{route('login')}}" class="active">CONNEXION</a>

        <a href="{{route('register')}}">INSCRIPTION</a>

    </div>

    <!-- Container largeur utile -->
    <div class="login-section">

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
                Rester Connecté
            </label>
        </div>

        <div class="d-flex flex-column align-items-center">

            <button class="btn btn-action btn-r8 login-btn">SE CONNECTER</button>
            <x-google-link/>
            @if (Route::has('password.request'))
                <a href="{{route('password.request')}}">
                    Mot de passe oublié ?
                </a><br>
            @endif

        </div>
    </form>
    </div>


@endsection
