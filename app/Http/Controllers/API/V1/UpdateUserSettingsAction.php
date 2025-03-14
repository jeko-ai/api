<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdateUserSettingsRequest;

class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json($user->refresh());
    }
}
