<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversGainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/companies/{market}",
 *     summary="Get companies",
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
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="market_id", type="string", example="NYSE"),
 *                 @OA\Property(property="symbol", type="string", example="AAPL"),
 *                 @OA\Property(property="name", type="string", example="Apple Inc."),
 *                 @OA\Property(property="price", type="number", format="float", example=150.75),
 *                 @OA\Property(property="change_percentage", type="number", format="float", example=2.5),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
class GetCompaniesAction
{
    public function __invoke(string $market): JsonResponse
    {
        $items = Cache::remember("best-{$market}", 1440, function () use ($market) {
            return MarketMoversGainer::where('market_id', $market)->get();
        });

        $count = $items->count();
        $itemsToReturn = $count >= 8 ? $items->random(8) : $items;

        return response()->json($itemsToReturn);
    }
}

