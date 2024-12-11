<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
public function handle(Request $request, Closure $next, $role)
{
    if (Auth::check()) {
        $userRole = Auth::user()->role;
        \Log::info('User Role: ' . $userRole); // Debugging
        if ($userRole === $role) {
            return $next($request);
        }
    }

    return abort(403, 'User does not have the right roles');
}
}

