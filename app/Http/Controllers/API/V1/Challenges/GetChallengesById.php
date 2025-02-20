<?php

namespace App\Http\Controllers\API\V1\Challenges;

use App\Http\Resources\API\V1\ChallengesResource;
use App\Models\Challenges;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/challenges/{id}",
 *     summary="Get Challenges by ID",
 *     tags={"Challenges"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/ChallengesResource")
 *     )
 * )
 */
class GetChallengesById extends Controller
{
    public function __invoke($id)
    {
        return new ChallengesResource(Challenges::findOrFail($id));
    }
}
