<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use App\Models\PortfolioAsset;

/**
 * @OA\Get(
 *     path="/v1/portfolio/assets",
 *     operationId="getUserPortfolioAssets",
 *     tags={"Portfolio"},
 *     summary="Get assets in user's default portfolio",
 *     description="Returns a list of assets in the user's default portfolio with their details",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="portfolio_id", type="integer"),
 *                 @OA\Property(property="symbol_id", type="integer"),
 *                 @OA\Property(property="quantity", type="number", format="float"),
 *                 @OA\Property(property="average_price", type="number", format="float"),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time"),
 *                 @OA\Property(
 *                     property="symbol",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="logo_id", type="integer"),
 *                     @OA\Property(property="name_ar", type="string"),
 *                     @OA\Property(property="name_en", type="string"),
 *                     @OA\Property(property="symbol", type="string"),
 *                     @OA\Property(property="currency", type="string"),
 *                     @OA\Property(property="quote", type="object")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
class GetUserPortfolioAssetsAction
{
    public function __invoke()
    {
        $latestPortfolio = Portfolio::where('user_id', request()->user()->id)
            ->where('is_default', true)
            ->orderBy('created_at', 'desc')
            ->first();

        $assets = PortfolioAsset::where('portfolio_id', $latestPortfolio->id)->with([
            'symbol' => function ($query) {
                $query->select([
                    'id', 'logo_id', 'name_ar', 'name_en', 'symbol', 'currency'
                ])->with('quote');
            },
        ])->get();

        return response()->json($assets);
    }
}

