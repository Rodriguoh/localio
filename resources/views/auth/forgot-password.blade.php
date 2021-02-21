@extends('layouts.auth')
@section('content')


<h1 style="font-size:29px">Mots de passe oubliés ?</h1>
<div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.email') }}" style="width:100%">
    @csrf

    <!-- Email Address -->
    <div class="m-10">
        <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" placeholder="Votre email" required autofocus />
    </div>

    <div class="m-10">
        <x-button class="btn btn-lg btn-primary btn-block">Reinitialiser son mot de passe</x-button>
    </div>
</form>

@endsection
