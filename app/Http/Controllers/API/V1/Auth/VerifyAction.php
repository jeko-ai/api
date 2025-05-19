<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\VerifyRequest;
use App\Http\Resources\API\V1\Auth\UserResource;
use App\Models\Plan;
use App\Models\User;
use Ichtrojan\Otp\Otp;

class VerifyAction
{
    public function __invoke(VerifyRequest $request)
    {
        $validation = (new Otp)->validate($request->identifier, $request->token);

        if ($validation->status) {
            /** @var User $user */
            $user = User::firstOrCreate([
                'email' => $request->identifier
            ]);
            $plan = $user->activePlanSubscriptions()->first();
            if (!$plan) {
                $freePlan = Plan::where('slug', 'standard')->first();
                $subscription = $user->newPlanSubscription($freePlan->slug, $freePlan);
                $subscription->forceFill([
                    'features' => $freePlan->features->map(function ($feature) {
                        return $feature->only([
                            'id',
                            'slug',
                            'name',
                            'description',
                            'value',
                            'resettable_period',
                            'resettable_interval',
                        ]);
                    }),
                ])->save();
            }

            if ($request->has('fcm_token') && !empty($request->fcm_token)) {
                $user->devices()->firstOrCreate([
                    'fcm_token' => $request->fcm_token
                ]);
            }

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
