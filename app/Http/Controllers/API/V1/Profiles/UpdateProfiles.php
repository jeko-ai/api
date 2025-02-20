<?php

namespace App\Http\Controllers\API\V1\Profiles;

use App\Http\Requests\API\V1\Profiles\UpdateProfilesRequest;
use App\Http\Resources\API\V1\ProfilesResource;
use App\Models\Profiles;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/profiles/{id}",
 *     summary="Update Profiles",
 *     tags={"Profiles"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateProfilesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/ProfilesResource")
 *     )
 * )
 */
class UpdateProfiles extends Controller
{
    public function __invoke(UpdateProfilesRequest $request, $id)
    {
        $record = Profiles::findOrFail($id);
        $record->update($request->validated());
        return new ProfilesResource($record);
    }
}
