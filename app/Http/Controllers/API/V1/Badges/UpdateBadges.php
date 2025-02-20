<?php

namespace App\Http\Controllers\API\V1\Badges;

use App\Http\Requests\API\V1\Badges\UpdateBadgesRequest;
use App\Http\Resources\API\V1\BadgesResource;
use App\Models\Badges;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/badges/{id}",
 *     summary="Update Badges",
 *     tags={"Badges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateBadgesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/BadgesResource")
 *     )
 * )
 */
class UpdateBadges extends Controller
{
    public function __invoke(UpdateBadgesRequest $request, $id)
    {
        $record = Badges::findOrFail($id);
        $record->update($request->validated());
        return new BadgesResource($record);
    }
}
