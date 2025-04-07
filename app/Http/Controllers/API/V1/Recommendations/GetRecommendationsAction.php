<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

/**
 * @OA\Get(
 *     path="/v1/recommendations",
 *     summary="Get recommendations",
 *     tags={"Recommendations"},
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
 *         @OA\Schema(type="integer", default=12)
 *     ),
 *     @OA\Parameter(
 *         name="market_id",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Recommendation"))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class GetRecommendationsAction
{
    public function __invoke()
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = min(request('limit'), 12);
        $market_id = request('market_id');
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

        return $query->paginate($limit);
    }
}

