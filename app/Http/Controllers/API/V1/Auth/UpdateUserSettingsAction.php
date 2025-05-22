<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Http\Resources\API\V1\Auth\UserResource;
use App\Models\UserSector;

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
            $user->portfolio()->update([
                'currency' => $user->country?->currency_code
            ]);
        }

        if ($request->has('sectors')) {
            \DB::transaction(function () use ($request, $user) {
                $user->sectors()->detach();
                foreach ($request->sectors as $sector) {
                    UserSector::create([
                        'user_id' => $user->id,
                        'sector_id' => $sector
                    ]);
                }
            });
        }

        return response()->json(UserResource::make($user->refresh()->load('sectors')));
    }
}
