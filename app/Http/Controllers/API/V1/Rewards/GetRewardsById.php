<?php

namespace App\Http\Controllers\API\V1\Rewards;

use App\Http\Resources\API\V1\RewardsResource;
use App\Models\Rewards;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/rewards/{id}",
 *     summary="Get Rewards by ID",
 *     tags={"Rewards"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/RewardsResource")
 *     )
 * )
 */
class GetRewardsById extends Controller
{
    public function __invoke($id)
    {
        return new RewardsResource(Rewards::findOrFail($id));
    }
}
