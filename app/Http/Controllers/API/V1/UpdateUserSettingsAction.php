<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\Profiles;

class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $profile = Profiles::find($request->attributes->get('user_id'));
        $profile->update($request->validated());

        return response()->json($profile->refresh());
    }
}
