<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/symbols/{symbol}/recommendations",
 *     summary="Get recommendations for a symbol",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="symbol",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="timeframe",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         @OA\Schema(type="integer")
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
 * )
 */
class GetSymbolRecommendationsAction
{
    public function __invoke(string $symbol, string $timeframe)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');
        $select = [
            'id', 'symbol_id', 'sector_id', 'market_id', 'target_price', 'expected_return', 'timeframe', 'risk_level', 'slug'
        ];
        if ($locale === 'ar') {
            $select = array_merge($select, ['title_ar', 'description_ar', 'points_ar']);
        } else {
            $select = array_merge($select, ['title', 'description', 'points']);
        }
        $query = Recommendation::query()->select($select)->where('symbol_id', $symbol);

        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("recommendations-$timeframe-$symbol-$limit-$locale", 20 * 24 * 60 * 60, function () use ($query, $timeframe) {
            return $query->where('timeframe', $timeframe)->get();
        });
    }
}

