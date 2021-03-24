<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            auth()->logout();

            if ($banned_days > 30) {
                $message = 'Votre compte a été suspendu indéfiniment.';
            } else {
                $message = 'Votre compte a été suspendu '.$banned_days.' jours.';
            }

            return redirect()->route('login')->withErrors([$message]);
        }

        return $next($request);
    }
}
