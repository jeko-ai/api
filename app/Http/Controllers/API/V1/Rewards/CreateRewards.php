<?php

namespace App\Http\Controllers\API\V1\Rewards;

use App\Http\Requests\API\V1\Rewards\CreateRewardsRequest;
use App\Http\Resources\API\V1\RewardsResource;
use App\Models\Rewards;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/rewards",
 *     summary="Create a new Rewards",
 *     tags={"Rewards"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateRewardsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/RewardsResource")
 *     )
 * )
 */
class CreateRewards extends Controller
{
    public function __invoke(CreateRewardsRequest $request)
    {
        $record = Rewards::create($request->validated());
        return new RewardsResource($record);
    }
}
