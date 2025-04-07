<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\MarketMoversActive;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/static/highest-volume/{market}",
 *     summary="Get highest volume companies",
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
 *                 @OA\Property(property="symbol", type="string", example="ABC"),
 *                 @OA\Property(property="name", type="string", example="Alphabet Inc."),
 *                 @OA\Property(property="volume", type="number", format="double", example=1000000),
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
class GetHighestVolumeAction
{
    public function __invoke(string $market): JsonResponse
    {
        $items = Cache::remember("highest-volume-{$market}", 1440, function () use ($market) {
            return MarketMoversActive::where('market_id', $market)->get();
        });

        $count = $items->count();
        $itemsToReturn = $count >= 8 ? $items->random(8) : $items;

        return response()->json($itemsToReturn);
    }
}

