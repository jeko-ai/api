<?php

namespace App\Http\Controllers\API\V1\Rewards;

use App\Http\Requests\API\V1\Rewards\UpdateRewardsRequest;
use App\Http\Resources\API\V1\RewardsResource;
use App\Models\Rewards;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/rewards/{id}",
 *     summary="Update Rewards",
 *     tags={"Rewards"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateRewardsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/RewardsResource")
 *     )
 * )
 */
class UpdateRewards extends Controller
{
    public function __invoke(UpdateRewardsRequest $request, $id)
    {
        $record = Rewards::findOrFail($id);
        $record->update($request->validated());
        return new RewardsResource($record);
    }
}
