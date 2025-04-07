<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\Quote;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *     path="/v1/pricing/quotes",
 *     summary="Get list of quotes",
 *     tags={"Pricing"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\AdditionalProperties(
 *                 @OA\Property(property="symbol_id", type="integer"),
 *                 @OA\Property(property="quote", type="object")
 *             )
 *         )
 *     )
 * )
 */
class GetQuotesAction
{
    public function __invoke()
    {
        if (Cache::has("quotes")) {
            return Cache::get("quotes");
        }
        return Cache::remember("quotes", 5 * 60, function () {
            return Quote::all()->keyBy("symbol_id");
        });
    }
}

