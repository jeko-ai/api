<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Profiles;

class GetUserProfileAction
{
    public function __invoke()
    {
        $profile = Profiles::where('user_id', request()->attributes->get('user_id'))->first();
        return response()->json($profile);
    }
}
