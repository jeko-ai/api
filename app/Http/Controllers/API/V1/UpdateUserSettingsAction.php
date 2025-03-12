<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\Profiles;

class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $profile = Profiles::find('id', $request->attributes->get('user_id'));
        Profiles::where('id', $request->attributes->get('user_id'))->update($request->validated());

        return response()->json($profile->refresh());
    }
}
