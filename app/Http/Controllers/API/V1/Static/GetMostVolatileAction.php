<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMostVolatile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/most-volatile/{market}",
 *     summary="Get most volatile companies",
 *     tags={"Static"},
 *     @OA\Parameter(
 *         name="market",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(
 *             type="object",
 *             @OA\Property(property="id", type="string", format="uuid"),
 *             @OA\Property(property="symbol_id", type="string", format="uuid"),
 *             @OA\Property(property="market_id", type="string"),
 *             @OA\Property(property="volatility", type="number", format="float"),
 *             @OA\Property(property="price", type="number", format="float"),
 *             @OA\Property(property="change_percent", type="number", format="float"),
 *             @OA\Property(property="volume", type="number"),
 *             @OA\Property(property="rel_volume", type="number", format="float"),
 *             @OA\Property(property="market_cap", type="number"),
 *             @OA\Property(property="pe_ratio", type="number", format="float"),
 *             @OA\Property(property="eps_dil_ttm", type="number", format="float"),
 *             @OA\Property(property="eps_dil_growth_ttm_yoy", type="number", format="float"),
 *             @OA\Property(property="div_yield_ttm", type="number", format="float"),
 *             @OA\Property(property="sector", type="string"),
 *             @OA\Property(property="analyst_rating", type="string"),
 *             @OA\Property(property="created_at", type="string", format="date-time")
 *         ))
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class GetMostVolatileAction
{
    public function __invoke(string $market): JsonResponse
    {
        $items = Cache::remember("most-volatile-{$market}", 1440, function () use ($market) {
            return MarketMostVolatile::where('market_id', $market)->get();
        });

        $count = $items->count();
        $itemsToReturn = $count >= 8 ? $items->random(8) : $items;

        return response()->json($itemsToReturn);
    }
}
