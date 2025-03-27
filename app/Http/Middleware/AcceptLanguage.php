<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
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
        $locale = request()->header('Accept-Language', request('locale', 'en')) ?? 'en';
        $locale = strtok($locale, ','); // Extract the first locale from the header
        try {
            app()->setLocale($locale);
            $request->setLocale($locale);
        } catch (Exception $e) {
            app()->setLocale('en');
            $request->setLocale('en');
        }

        return $next($request);
    }
}
