<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

/**
 * @OA\Get(
 *     path="/v1/recommendations/details/{slug}",
 *     summary="Get recommendation details",
 *     tags={"Recommendations"},
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      type="object",
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="symbol_id", type="integer"),
 *                      @OA\Property(property="sector_id", type="integer"),
 *                      @OA\Property(property="market_id", type="integer"),
 *                      @OA\Property(property="target_price", type="number", format="float"),
 *                      @OA\Property(property="expected_return", type="number", format="float"),
 *                      @OA\Property(property="timeframe", type="string"),
 *                      @OA\Property(property="risk_level", type="string"),
 *                      @OA\Property(property="slug", type="string"),
 *                      @OA\Property(property="title", type="string"),
 *                      @OA\Property(property="description", type="string"),
 *                      @OA\Property(property="points", type="string")
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object"),
 *              @OA\Property(property="meta", type="object")
 *          )
 *      ),
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

