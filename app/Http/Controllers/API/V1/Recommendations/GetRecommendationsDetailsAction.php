<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

/**
 * @OA\Get(
 *     path="/v1/recommendations/{slug}",
 *     summary="Get recommendation details",
 *     tags={"Recommendations"},
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Recommendation")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found"
 *     )
 * )
 */
class GetRecommendationsDetailsAction
{
    public function __invoke(string $slug)
    {
        $recommendation = Recommendation::where('slug', $slug)->firstOrFail();

        return response()->json($recommendation);
    }
}

