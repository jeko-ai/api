<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use App\Http\Resources\SubscriptionResource;
use App\Models\Plan;
use App\Models\Subscription;
use F9Web\ApiResponseHelpers;

class CancelSubscriptionAction
{
    use ApiResponseHelpers;

    public function __invoke(Subscription $id)
    {
        $user = auth()->user();
        $id->cancel();

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

        return $this->respondOk('Subscription canceled successfully');
    }
}
