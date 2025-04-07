<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\SymbolPrice;

/**
 * @OA\Get(
 *     path="/v1/pricing/prices",
 *     summary="Get list of symbol prices",
 *     tags={"Pricing"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="symbol", type="string"),
 *                 @OA\Property(property="price", type="number", format="float")
 *             )
 *         )
 *     )
 * )
 */
class GetPricesAction
{
    public function __invoke()
    {
        return SymbolPrice::select('symbol', 'price')
            ->orderBy('timestamp')
            ->groupBy('symbol_id')
            ->get();
    }
}

