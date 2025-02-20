<?php

namespace App\Http\Controllers\API\V1\UserBadges;

use App\Http\Requests\API\V1\UserBadges\UpdateUserBadgesRequest;
use App\Http\Resources\API\V1\UserBadgesResource;
use App\Models\UserBadges;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/userbadges/{id}",
 *     summary="Update UserBadges",
 *     tags={"UserBadges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateUserBadgesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/UserBadgesResource")
 *     )
 * )
 */
class UpdateUserBadges extends Controller
{
    public function __invoke(UpdateUserBadgesRequest $request, $id)
    {
        $record = UserBadges::findOrFail($id);
        $record->update($request->validated());
        return new UserBadgesResource($record);
    }
}
