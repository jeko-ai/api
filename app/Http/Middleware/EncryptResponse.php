<?php

namespace App\Http\Middleware;

use App\Helpers\EncryptionHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $content = $response->getContent();
        $content = EncryptionHelper::encrypt($content);
        $response->setContent(json_encode($content));

        return $response;
    }
}
