<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\VerifyRequest;
use App\Http\Resources\API\V1\Auth\UserResource;
use App\Models\Plan;
use App\Models\User;
use Ichtrojan\Otp\Otp;

/**
 * @OA\Post(
 *     path="/v1/auth/verify",
 *     summary="Verify OTP and create/login user",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="identifier", type="string", format="email", example="user@example.com"),
 *             @OA\Property(property="token", type="string", example="123456", description="OTP token received via email")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OTP verified successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="OTP verified"),
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="user", type="object"),
 *             @OA\Property(property="portfolio", type="object"),
 *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Invalid OTP",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Invalid OTP"),
 *             @OA\Property(property="status", type="boolean", example=false)
 *         )
 *     )
 * )
 */
class VerifyAction
{
    public function __invoke(VerifyRequest $request)
    {
        $validation = (new Otp)->validate($request->identifier, $request->token);

        if ($validation->status) {
            $user = User::firstOrCreate([
                'email' => $request->identifier
            ]);
            $standardPlan = Plan::where('slug', 'standard')->first();
            $subscription = $user->newPlanSubscription($standardPlan->slug, $standardPlan);
            $subscription->forceFill([
                'feature' => $standardPlan->features->map(function ($feature) {
                    return $feature->only([
                        'slug',
                        'name',
                        'description',
                        'value',
                        'resettable_period',
                        'resettable_interval',
                    ]);
                }),
            ])->save();

            return response()->json([
                'message' => 'OTP verified',
                'status' => true,
                'user' => UserResource::make($user->load('planSubscriptions')),
                'portfolio' => $user->portfolio()->firstOrCreate([], [
                    'name' => 'Default Portfolio',
                    'description' => 'This is your default portfolio',
                    'is_default' => true
                ]),
                'token' => $user->createToken('auth_token')->accessToken
            ]);
        }

        return response()->json($validation, $validation->status ? 200 : 400);
    }
}
