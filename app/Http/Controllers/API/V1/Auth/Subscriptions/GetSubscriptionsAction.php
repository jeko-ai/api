<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use F9Web\ApiResponseHelpers;

class GetSubscriptionsAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        $user = auth()->user();

        return $this->respondWithSuccess($user->planSubscriptions()->with([
            'plan',
            'usage'
        ])->get());
    }
}
