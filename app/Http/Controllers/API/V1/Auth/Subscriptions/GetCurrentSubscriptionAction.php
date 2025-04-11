<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use App\Http\Resources\SubscriptionResource;
use F9Web\ApiResponseHelpers;
use Illuminate\Database\Eloquent\Builder;

class GetCurrentSubscriptionAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        $user = auth()->user();

        $subscription = $user->planSubscriptions()->with([
            'plan:id,slug,name',
            'usage'
        ])->whereNull('canceled_at')->where(function (Builder $query) {
            $query->whereBeforeToday('ends_at')->orWhereBeforeToday('trial_ends_at');
        })->first();

        return $this->respondWithSuccess(SubscriptionResource::make($subscription));
    }
}
