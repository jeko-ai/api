<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Resources\API\V1\Auth\UserResource;
use App\Models\Plan;

class GetUserAction
{
    public function __invoke()
    {
        $user = auth()->user();
        $plan = $user->activePlanSubscriptions()->first();
        if (!$plan) {
            $subscription = $user->planSubscription('free');
            if ($subscription) {
                $subscription->renew();
            } else {
                $freePlan = Plan::where('slug', 'free')->first();
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
        }
        return response()->json(UserResource::make($user->load('planSubscriptions')));
    }
}
