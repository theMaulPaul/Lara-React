<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    // public function handle($request, Closure $next, ...$guards)
    // {
    //     $this->authenticate($request, $guards);
    //     if($this->auth->user() && $this->auth->user()->isAdmin()) {
    //         return $next($request);
    //     }
        
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }
}