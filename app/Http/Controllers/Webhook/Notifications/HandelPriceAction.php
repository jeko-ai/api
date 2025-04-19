<?php

namespace App\Http\Controllers\Webhook\Notifications;

use F9Web\ApiResponseHelpers;

class HandelPriceAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        return $this->respondOk('Price received successfully');
    }
}
