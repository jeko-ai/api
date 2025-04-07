<?php

namespace App\Http\Controllers\API\V1\Pricing;

use App\Models\SymbolPrice;

/**
 * @OA\Get(
 *     path="/v1/pricing/symbols/{id}/price",
 *     summary="Get price of a specific symbol",
 *     tags={"Pricing"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="string"),
 *             @OA\Property(property="price", type="number", format="float")
 *         )
 *     )
 * )
 */
class GetSymbolPriceAction
{
    public function __invoke(string $id)
    {
        return SymbolPrice::where('id', $id)->orderByDesc('timestamp')->first();
    }
}

