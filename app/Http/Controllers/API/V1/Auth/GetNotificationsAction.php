<?php

namespace App\Http\Controllers\API\V1\Auth;

use F9Web\ApiResponseHelpers;

class GetNotificationsAction
{
    use ApiResponseHelpers;

    public function __invoke()
    {
        $user = auth()->user();
        $type = request('type');

        $query = $user->notifications();

        if ($type) {
            $query->where('type', $type);
        }

        return $this->respondWithSuccess($query->paginate());
    }
}

