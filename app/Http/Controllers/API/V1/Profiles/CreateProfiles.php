<?php

namespace App\Http\Controllers\API\V1\Profiles;

use App\Http\Requests\API\V1\Profiles\CreateProfilesRequest;
use App\Http\Resources\API\V1\ProfilesResource;
use App\Models\Profiles;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/profiles",
 *     summary="Create a new Profiles",
 *     tags={"Profiles"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateProfilesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/ProfilesResource")
 *     )
 * )
 */
class CreateProfiles extends Controller
{
    public function __invoke(CreateProfilesRequest $request)
    {
        $record = Profiles::create($request->validated());
        return new ProfilesResource($record);
    }
}
