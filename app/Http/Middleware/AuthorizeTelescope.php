<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeTelescope
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLocal = app()->environment('local') ||
            app()->environment('dev') ||
            app()->environment('stage') ||
            app()->hasDebugModeEnabled();

        return $isLocal ? $next($request) : abort(403);
    }
}
