@extends('layouts.auth')
@section('content')
    <h1>Connexion</h1>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />
   
        <form method="POST" action="{{ route('login') }}" style="width:100%">
            @csrf

            <!-- Email Address -->
            <div class="">
                <x-input id="email" class="form-control form-control-lg" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" />
            </div>

            <!-- Password -->
            <div class="">

                <x-input id="password" class="form-control form-control-lg" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password" style="margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;outline:none" />
            </div>

            <!-- Remember Me -->

            <div class="checkbox mb-3">
                <label>
                    <input id="remember_me" type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <div class="d-flex flex-column align-items-center">

                <a class="" href="{{ route('register') }}">
                    Pas encore inscrit ?
                </a>

                <button class="btn btn-lg btn-primary btn-block m-10">Envoyer</button>
               <x-google-link/>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
                @endif
            </div>
        </form>

@endsection
