<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Profile;

class GetUserProfileAction
{
    public function __invoke()
    {
        $profile = Profile::find(request()->user()->id);
        return response()->json($profile);
    }
}
