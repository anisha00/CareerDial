<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check the user's role
            if (Auth::user()->is_admin && $role === 'admin') {
                return $next($request);
            } elseif (!$role) {
                return $next($request);
            }
        }

        // Redirect to the login page or show an unauthorized error
        return redirect('login')->with('error', 'Unauthorized');
    }
}
