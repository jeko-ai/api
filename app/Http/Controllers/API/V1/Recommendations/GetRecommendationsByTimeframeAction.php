<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/recommendations/{timeframe}",
 *     summary="Get recommendations by timeframe",
 *     tags={"Recommendations"},
 *     @OA\Parameter(
 *         name="timeframe",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="locale",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="market_id",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="symbol_id",
 *         in="query",
 *         required=false,
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
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class GetRecommendationsByTimeframeAction
{
    public function __invoke(string $timeframe)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit', 4);
        $market_id = request('market_id');
        $symbol_id = request('symbol_id');
        $select = [
            'id', 'symbol_id', 'sector_id', 'market_id', 'target_price', 'expected_return', 'timeframe', 'risk_level', 'slug'
        ];
        if ($locale === 'ar') {
            $select = array_merge($select, ['title_ar', 'description_ar', 'points_ar']);
        } else {
            $select = array_merge($select, ['title', 'description', 'points']);
        }
        $query = Recommendation::query()->select($select);

        if ($market_id) {
            $query->where('market_id', $market_id);
        }
        if ($limit) {
            $query->limit($limit);
        }

        if ($symbol_id) {
            $query->where('symbol_id', $symbol_id);
        }

        return $query->where('timeframe', $timeframe)->get();
    }
}

