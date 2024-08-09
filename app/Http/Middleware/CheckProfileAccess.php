<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user is the owner of the profile
        if (auth()->check() && auth()->user()->id == $request->route('userId')) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized access to profile'], 403);
    }
}
