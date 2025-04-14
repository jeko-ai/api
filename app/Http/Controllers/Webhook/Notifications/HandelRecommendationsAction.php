<?php

namespace App\Http\Controllers\Webhook\Notifications;

use App\Jobs\ProcessRecommendationsNotificationJob;
use App\Models\Recommendation;
use F9Web\ApiResponseHelpers;

class HandelRecommendationsAction
{
    use ApiResponseHelpers;

    public function __invoke(Recommendation $id)
    {
        ProcessRecommendationsNotificationJob::dispatch($id);

        return $this->respondOk('Recommendations received successfully');
    }
}
