@extends('layouts.auth')
@section('content')
<h1>Inscription</h1>
<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('register') }}" class="w-full">
    @csrf

    {{-- <!-- Name -->
            <div class="auth-input">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div> --}}

    <!-- Email Address -->
    <div>
        <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" placeholder="Email" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" required />
    </div>

    <!-- Password -->
    <div class="">
        <x-input id="password" class="form-control form-control-lg" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password" style="margin-bottom: -1px;border-radius:0" />
    </div>

    <!-- Confirm Password -->
    <div class="">

        <x-input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirmation mot de passe" style="margin-bottom:-1px; border-top-left-radius:0;border-top-right-radius:0" required />
    </div>

    <div class="d-flex flex-column m-10">
        <a class="" href="{{ route('login') }}">
            Vous avez déjà un compte ?
        </a>


        <button type="submit" class="btn btn-primary m-10">S'inscrire</button>
    </div>
</form>

@endsection
