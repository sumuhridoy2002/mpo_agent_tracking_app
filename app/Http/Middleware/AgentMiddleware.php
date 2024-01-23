<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to check if the authenticated user has the 'Agent' role.
 *
 * @author Hridoy
 */
class AgentMiddleware
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
        // Check if the authenticated user has the 'Agent' role
        if ($request->user() && $request->user()->role === 'Agent') return $next($request);

        // If not, you can customize the response or redirect
        return response()->json(['error' => 'Unauthorized. You must be an agent.'], 403);
    }
}