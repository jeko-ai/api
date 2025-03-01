<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Markets;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/api/v1/static/markets",
 *     summary="Get a list of markets",
 *     description="Fetches all markets from the database and caches the response indefinitely.",
 *     tags={"Markets"},
 *     @OA\Response(
 *         response=200,
 *         description="List of markets retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="country_id", type="integer", example=1),
 *                 @OA\Property(property="name_en", type="string", example="Egyptian Exchange"),
 *                 @OA\Property(property="name_ar", type="string", example="البورصة المصرية"),
 *                 @OA\Property(property="code", type="string", example="EGX"),
 *                 @OA\Property(property="timezone", type="string", example="Africa/Cairo"),
 *                 @OA\Property(property="is_active", type="boolean", example=true),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T12:00:00Z"),
 *                 @OA\Property(property="symbol_id", type="integer", example=101),
 *                 @OA\Property(property="tv_link", type="string", format="uri", example="https://www.tradingview.com/markets/egypt")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetMarketsAction
{
    public function __invoke(): JsonResponse
    {
        $markets = Cache::rememberForever('markets', function () {
            return Markets::all();
        });

        return response()->json($markets);
    }
}
