<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->path() === 'login') {
            return $next($request);
        }

        $dotenv = \Dotenv\Dotenv::createImmutable(base_path());
        $dotenv->load();

        $username = env('BASIC_AUTH_USERNAME');
        $password = env('BASIC_AUTH_PASSWORD');

        if ($request->getUser() != $username || $request->getPassword() != $password) {
            return response()->json(['message' => 'Unauthorized'], 401)
                ->header('WWW-Authenticate', 'Basic');
        }

        return $next($request);
    }
}
