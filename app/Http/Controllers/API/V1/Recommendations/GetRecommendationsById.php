<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Http\Resources\API\V1\RecommendationsResource;
use App\Models\Recommendations;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/recommendations/{id}",
 *     summary="Get Recommendations by ID",
 *     tags={"Recommendations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/RecommendationsResource")
 *     )
 * )
 */
class GetRecommendationsById extends Controller
{
    public function __invoke($id)
    {
        return new RecommendationsResource(Recommendations::findOrFail($id));
    }
}
