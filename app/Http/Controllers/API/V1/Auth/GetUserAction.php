<?php

namespace App\Http\Controllers\API\V1\Auth;

/**
 * @OA\Get(
 *     path="/v1/auth/me",
 *     summary="Get authenticated user information",
 *     tags={"Auth"},
 *     security={{
 *         "passport": {}
 *     }},
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved user information",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="string", format="uuid"),
 *             @OA\Property(property="email", type="string", format="email"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
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
class GetUserAction
{
    public function __invoke()
    {
        $user = auth()->user();
        return response()->json([
            $user,
            ...$user->activePlanSubscriptions()
        ]);
    }
}
