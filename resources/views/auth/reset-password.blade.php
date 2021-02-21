@extends('layouts.auth')
@section('content')
<h1>Reinitialiser mot de passe</h1>
<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div>
        <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email', $request->email)" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0" required autofocus />
    </div>

    <!-- Password -->
    <div>
        <x-input id="password" class="form-control form-control-lg" type="password" name="password" style="margin-bottom: -1px;border-radius:0" required placeholder="Nouveau mot de passe" />
    </div>

    <!-- Confirm Password -->
    <div>
        <x-input id="password_confirmation" class="form-control form-control-lg mb-4" type="password" name="password_confirmation" style="margin-bottom:-1px; border-top-left-radius:0;border-top-right-radius:0" required placeholder="Confirmation mot de passe"/>
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-primary btn-block mt-10">Envoyer</button>
    </div>
</form>

@endsection
