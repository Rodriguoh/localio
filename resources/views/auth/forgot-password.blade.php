@extends('layouts.auth')
@section('content')


    <div class="select-type">

        <a href="{{route('login')}}">CONNEXION</a>

        <a href="{{route('register')}}">INSCRIPTION</a>

    </div>

    <!-- Container largeur utile -->
    <div class="login-section">


        <h1>Mot de passe oublié ?</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
            <div class="login-input">
                <x-input id="email" type="email" name="email" :value="old('email')" placeholder="Votre email" required autofocus />
            </div>

            <div class="m-10">
                <x-button class="btn btn-action btn-r8 login-btn">ENVOYER</x-button>
            </div>
        </form>

    </div>

@endsection
