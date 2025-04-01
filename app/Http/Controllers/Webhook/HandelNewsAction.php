<?php

namespace App\Http\Controllers\Webhook;

use App\Jobs\ProcessNewsNotification;
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
        ProcessNewsNotification::dispatch($id);

        return $this->respondOk('News received successfully');
    }
}
