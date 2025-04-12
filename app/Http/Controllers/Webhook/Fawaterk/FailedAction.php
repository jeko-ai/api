<?php

namespace App\Http\Controllers\Webhook\Fawaterk;

use F9Web\ApiResponseHelpers;

class FailedAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        return $this->respondOk('Webhook received successfully');
    }
}
