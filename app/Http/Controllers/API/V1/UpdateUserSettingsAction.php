<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdateUserSettingsRequest;

class UpdateUserSettingsAction
{
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        if ($request->has('phone')) {
            $user->phone_verified_at = now();
            $user->save();
        }
        if ($request->has('country_id')) {
            $user->portfolio = $user->country?->currency_code;
            $user->save();
        }

        return response()->json($user->refresh());
    }
}
