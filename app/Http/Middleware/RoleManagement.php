<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roleName)
    {
        if (Auth::check()) {
            if (User::find(Auth::id())->hasRole($roleName)) {
                return $next($request);
            } else {
                abort(403, "User don't have the role needed to access to this page");
            }
            abort(403, "User need to be at least authenticated to access to this page");
        }
    }
}
