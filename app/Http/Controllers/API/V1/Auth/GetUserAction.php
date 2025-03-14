<?php

namespace App\Http\Controllers\API\V1\Auth;

class GetUserAction
{
    public function __invoke()
    {
        return response()->json(auth()->user());
    }
}
