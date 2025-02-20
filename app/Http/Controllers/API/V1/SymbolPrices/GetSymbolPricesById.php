<?php

namespace App\Http\Controllers\API\V1\SymbolPrices;

use App\Http\Resources\API\V1\SymbolPricesResource;
use App\Models\SymbolPrices;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/symbolprices/{id}",
 *     summary="Get SymbolPrices by ID",
 *     tags={"SymbolPrices"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolPricesResource")
 *     )
 * )
 */
class GetSymbolPricesById extends Controller
{
    public function __invoke($id)
    {
        return new SymbolPricesResource(SymbolPrices::findOrFail($id));
    }
}
