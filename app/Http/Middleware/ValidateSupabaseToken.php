<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class ValidateSupabaseToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(config('app.supabase_jwt_secret'), 'HS256'));
            $request->attributes->set('user_id', $decoded->sub);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}

