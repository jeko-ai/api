<?php

namespace App\Http\Middleware;

use App\Helpers\EncryptionHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class ValidateApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');
        if (!$apiKey) {
            return response()->json([
                'status' => 401,
                'message' => 'API key is missing',
            ], 401);
        }

        try {
            $data = explode('=|%*+|=', $apiKey);
            if (count($data) !== 2) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid API key format',
                ], 401);
            }

            $encryptedData = $data[0];
            $iv = $data[1];

            $decrypted = EncryptionHelper::decrypt($encryptedData, $iv);

            if (!$decrypted) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid API key',
                ], 401);
            }

            $timestamp = explode('||', $decrypted)[0];
            $timeDiff = time() - (int)$timestamp;
            if ($timeDiff > 900) {
                return response()->json([
                    'status' => 401,
                    'message' => "API key is expired ({$timeDiff} seconds)"
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Invalid API key',
            ], 500);
        }

        return $next($request);
    }
}
