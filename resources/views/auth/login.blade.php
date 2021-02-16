@include('layouts.app')
<div class="auth-card">
    <h1>Connection</h1>
        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="auth-input">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="auth-input">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="auth-block-button">

                <a class="" href="{{ route('register') }}">
                    Pas encore inscrit ?
                </a>

                <x-button class="auth-submit">
                    {{ __('Login') }}
                </x-button>
                <a class="auth-google" href="{{ route('google-auth') }}">
                    <x-google-button></x-google-button>
                    <span>{{ __('Login') }} with Google</span>
                </a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
