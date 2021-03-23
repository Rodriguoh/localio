@extends('layouts.auth')
@section('content')


    <div class="select-type">

        <a href="{{route('login')}}">CONNEXION</a>

        <a href="{{route('register')}}">INSCRIPTION</a>

    </div>

    <!-- Container largeur utile -->
    <div class="login-section">

        <h1>Reinitialiser mot de passe</h1>
        <!-- Session Status -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="login-input">
                <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email', $request->email)" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" required disabled autofocus />
            </div>

            <!-- Password -->
            <div class="login-input">
                <x-input id="password" class="form-control form-control-lg" type="password" name="password" style="margin-bottom: -1px;border-radius:0" required placeholder="Nouveau mot de passe" />
            </div>

            <!-- Confirm Password -->
            <div class="login-input">
                <x-input id="password_confirmation" class="form-control form-control-lg mb-4" type="password" name="password_confirmation" style="margin-bottom:-1px; border-top-left-radius:0;border-top-right-radius:0" required placeholder="Confirmation mot de passe"/>
            </div>

            <div class="m-10">
                <button type="submit" class="btn btn-action btn-r8 login-btn">REINITIALISER</button>
            </div>
        </form>


    </div>
<!-- Validation Errors -->

@endsection
