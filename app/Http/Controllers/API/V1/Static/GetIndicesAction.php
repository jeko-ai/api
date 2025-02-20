<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/static/indices",
 *     summary="Get a list of indices",
 *     description="Fetches all indices from the database and caches the response indefinitely.",
 *     tags={"Indices"},
 *     @OA\Response(
 *         response=200,
 *         description="List of indices retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="string", example=1),
 *                 @OA\Property(property="tv_id", type="string", example="IDX123"),
 *                 @OA\Property(property="symbol", type="string", example="EGX30"),
 *                 @OA\Property(property="isin", type="string", example="EG0001234567"),
 *                 @OA\Property(property="logo_id", type="string", example="logo_123"),
 *                 @OA\Property(property="type", type="string", example="index"),
 *                 @OA\Property(property="currency", type="string", example="EGP"),
 *                 @OA\Property(property="inv_symbol", type="string", example="INV_EGX30"),
 *                 @OA\Property(property="inv_id", type="integer", example=200),
 *                 @OA\Property(property="name_en", type="string", example="Egyptian Stock Exchange 30"),
 *                 @OA\Property(property="name_ar", type="string", example="البورصة المصرية 30"),
 *                 @OA\Property(property="description_en", type="string", example="The top 30 companies listed on the Egyptian Stock Exchange."),
 *                 @OA\Property(property="description_ar", type="string", example="أكبر 30 شركة مدرجة في البورصة المصرية."),
 *                 @OA\Property(property="short_description_en", type="string", example="Top 30 EGX companies."),
 *                 @OA\Property(property="short_description_ar", type="string", example="أفضل 30 شركة في EGX."),
 *                 @OA\Property(property="full_name", type="string", example="Egyptian Exchange Top 30 Index"),
 *                 @OA\Property(property="mb_url", type="string", format="uri", example="https://example.com/index/EGX30"),
 *                 @OA\Property(property="status", type="string", example="active"),
 *                 @OA\Property(property="country_id", type="integer", example=1),
 *                 @OA\Property(property="market_id", type="integer", example=10),
 *                 @OA\Property(property="sector_id", type="integer", example=5)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error"
 *     )
 * )
 */
class GetIndicesAction
{
    public function __invoke(): JsonResponse
    {
        $indices = Cache::rememberForever('indices', function () {
            return Symbols::where('type', 'index')->get();
        });

        return response()->json($indices);
    }
}
