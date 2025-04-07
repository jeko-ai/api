<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

class GetRecommendationsAction
{
    /**
     * @OA\Get(
     *     path="/v1/recommendations",
     *     summary="Get list of recommendations",
     *     description="Retrieves paginated investment recommendations with optional filtering",
     *     operationId="getRecommendations",
     *     tags={"Recommendations"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Maximum number of records to return (max: 12)",
     *         required=false,
     *         @OA\Schema(type="integer", default=12)
     *     ),
     *     @OA\Parameter(
     *         name="market_id",
     *         in="query",
     *         description="Filter recommendations by market ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="Accept-Language",
     *         in="header",
     *         description="Language preference (en or ar)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"en", "ar"}, default="en")
     *     ),
     *     @OA\Parameter(
     *         name="locale",
     *         in="query",
     *         description="Alternative way to specify language preference",
     *         required=false,
     *         @OA\Schema(type="string", enum={"en", "ar"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="symbol_id", type="integer"),
     *                     @OA\Property(property="sector_id", type="integer"),
     *                     @OA\Property(property="market_id", type="integer"),
     *                     @OA\Property(property="target_price", type="number", format="float"),
     *                     @OA\Property(property="expected_return", type="number", format="float"),
     *                     @OA\Property(property="timeframe", type="string"),
     *                     @OA\Property(property="risk_level", type="string"),
     *                     @OA\Property(property="slug", type="string"),
     *                     @OA\Property(property="title", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="points", type="string")
     *                 )
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
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
