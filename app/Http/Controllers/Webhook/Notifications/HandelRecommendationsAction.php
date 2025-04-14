<?php

namespace App\Http\Controllers\Webhook\Notifications;

use App\Jobs\ProcessRecommendationsNotificationJob;
use F9Web\ApiResponseHelpers;

class HandelRecommendationsAction
{
    use ApiResponseHelpers;

    public function __invoke($id)
    {
        ProcessRecommendationsNotificationJob::dispatch($id);

        return $this->respondOk('Recommendations received successfully');
    }
}
