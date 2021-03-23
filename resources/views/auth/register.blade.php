@extends('layouts.auth')
@section('content')

    <div class="select-type">

        <a href="{{route('login')}}">CONNEXION</a>

        <a href="{{route('register')}}" class="active">INSCRIPTION</a>

    </div>

    <!-- Container largeur utile -->
    <div class="login-section">


    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}" class="w-full">
    @csrf
    <!-- Email Address -->
        <div class="login-input">
            <x-input
                id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" placeholder="Email" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" required />
        </div>
        <!-- Password -->
        <div class="login-input">
            <x-input
                id="password"
                class="form-control form-control-lg"
                type="password"
                name="password"
                placeholder="Mot de passe"
                pattern=".{8,}"
                title="Votre mot de passe doit contenir au moins 8 caractères"
                autocomplete="new-password"
                style="margin-bottom: -1px;border-radius:0"
                required/>
        </div>
        <!-- Confirm Password -->
        <div class="login-input">
            <x-input
                id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirmation mot de passe" style="margin-bottom:-1px; border-top-left-radius:0;border-top-right-radius:0" required />
            <label for="password_confirmation" style="margin: 15px 0 0 15px">Mot de passe de 8 caractères minimum</label>
        </div>

        <div class="d-flex flex-column m-10">
            <button type="submit" class="btn btn-action btn-r8 login-btn">S'INSCRIRE</button>
        </div>
    </form>
    </div>


@endsection
