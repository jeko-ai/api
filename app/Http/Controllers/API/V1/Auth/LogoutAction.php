<?php

namespace App\Http\Controllers\API\V1\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/auth/logout",
 *     summary="Logout user and revoke access token",
 *     tags={"Auth"},
 *     security={{
 *         "passport": {}
 *     }},
 *     @OA\Response(
 *         response=200,
 *         description="Successfully logged out",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Logged out successfully"),
 *             @OA\Property(property="status", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     )
 * )
 */
class LogoutAction
{
    public function __invoke()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully', 'status' => true]);
    }
}
