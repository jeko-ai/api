<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\PortfolioAsset;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/portfolio/recommendations/{timeframe}",
 *     operationId="getPortfolioRecommendations",
 *     tags={"Portfolio"},
 *     summary="Get recommendations for assets in user's portfolio by timeframe",
 *     description="Returns investment recommendations related to assets in the user's portfolio for a specific timeframe",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="timeframe",
 *         in="path",
 *         required=true,
 *         description="Recommendation timeframe (short, medium, long)",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         required=false,
 *         description="Maximum number of recommendations to return",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         required=false,
 *         description="Language preference (en, ar)",
 *         @OA\Schema(type="string", default="en")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="symbol_id", type="integer"),
 *                 @OA\Property(property="sector_id", type="integer"),
 *                 @OA\Property(property="market_id", type="integer"),
 *                 @OA\Property(property="target_price", type="number", format="float"),
 *                 @OA\Property(property="expected_return", type="number", format="float"),
 *                 @OA\Property(property="timeframe", type="string"),
 *                 @OA\Property(property="risk_level", type="string"),
 *                 @OA\Property(property="slug", type="string"),
 *                 @OA\Property(property="title", type="string"),
 *                 @OA\Property(property="description", type="string"),
 *                 @OA\Property(property="points", type="string")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
class GetPortfolioRecommendationsAction
{
    public function __invoke(string $timeframe)
    {
        $userId = auth()->user()->id;

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
        $assets = PortfolioAsset::where('user_id', $userId)->get(['symbol_id'])->pluck('symbol_id');

        $query = Recommendation::query()->whereIn('symbol_id', $assets)->select($select);

        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("recommendations-$timeframe-$limit-$locale-$userId", 20 * 24 * 60 * 60, function () use ($query, $timeframe) {
            return $query->where('timeframe', $timeframe)->get();
        });
    }
}

