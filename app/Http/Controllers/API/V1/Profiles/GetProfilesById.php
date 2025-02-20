<?php

namespace App\Http\Controllers\API\V1\Profiles;

use App\Http\Resources\API\V1\ProfilesResource;
use App\Models\Profiles;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/profiles/{id}",
 *     summary="Get Profiles by ID",
 *     tags={"Profiles"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/ProfilesResource")
 *     )
 * )
 */
class GetProfilesById extends Controller
{
    public function __invoke($id)
    {
        return new ProfilesResource(Profiles::findOrFail($id));
    }
}
