<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Profiles;

class GetUserProfileAction
{
    public function __invoke()
    {
        $profile = Profiles::find(request()->attributes->get('user_id'));
        return response()->json($profile);
    }
}
