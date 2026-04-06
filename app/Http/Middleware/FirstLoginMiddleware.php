<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_first_login) {
            // Allow access to change-password routes so we don't loop
            if (!$request->routeIs('password.change') && !$request->routeIs('password.change.update')) {
                return redirect()->route('password.change')
                    ->with('info', 'Welcome! Please change your password before continuing.');
            }
        }

        return $next($request);
    }
}
