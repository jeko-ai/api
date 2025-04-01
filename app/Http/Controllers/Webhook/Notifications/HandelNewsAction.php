<?php

namespace App\Http\Controllers\Webhook\Notifications;

use App\Jobs\ProcessNewsNotificationJob;
use App\Models\News;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;

class HandelNewsAction
{
    use ApiResponseHelpers;

    /**
     * Handle the incoming request.
     *
     * @param News $id
     * @return JsonResponse
     */
    public function __invoke(News $id)
    {
        ProcessNewsNotificationJob::dispatch($id);

        return $this->respondOk('News received successfully');
    }
}
