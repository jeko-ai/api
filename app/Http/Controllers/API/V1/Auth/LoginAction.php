<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\LoginRequest;
use App\Jobs\SendOtpJob;

/**
 * @OA\Post(
 *     path="/api/v1/auth/login",
 *     summary="Login with identifier (email)",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="identifier", type="string", format="email", example="user@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OTP sent successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="OTP sent"),
 *             @OA\Property(property="status", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object")
 *         )
 *     )
 * )
 */
class LoginAction
{
    public function __invoke(LoginRequest $request)
    {
        SendOtpJob::dispatch($request->identifier);

        return response()->json([
            'message' => 'OTP sent',
            'status' => true
        ]);
    }
}
