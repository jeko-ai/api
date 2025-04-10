<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use App\Http\Resources\SubscriptionResource;
use F9Web\ApiResponseHelpers;

class GetSubscriptionsAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        $user = auth()->user();

        $subscriptions = $user->planSubscriptions()->with([
            'plan:id,slug,name',
            'usage'
        ])->get();

        return $this->respondWithSuccess(SubscriptionResource::collection($subscriptions));
    }
}
