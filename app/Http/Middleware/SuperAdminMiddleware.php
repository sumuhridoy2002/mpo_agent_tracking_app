<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to check if the authenticated user has the 'SuperAdmin' role.
 *
 * @author Hridoy
 */
class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the 'SuperAdmin' role
        if ($request->user() && $request->user()->role === 'Super Admin') return $next($request);

        // If not, you can customize the response or redirect
        auth()->logout();
        return redirect()->route('login')->with('error', 'Unauthorized. You must be the Super Admin.');
    }
}