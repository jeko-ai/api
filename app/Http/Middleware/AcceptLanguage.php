<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        app()->setLocale($locale);
        $request->setLocale($locale);

        return $next($request);
    }
}
