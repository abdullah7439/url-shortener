<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    // ensure the user has the required role to access the route.
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (! $user || $user->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
