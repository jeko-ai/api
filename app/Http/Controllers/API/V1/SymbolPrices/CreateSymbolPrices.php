<?php

namespace App\Http\Controllers\API\V1\SymbolPrices;

use App\Http\Requests\API\V1\SymbolPrices\CreateSymbolPricesRequest;
use App\Http\Resources\API\V1\SymbolPricesResource;
use App\Models\SymbolPrices;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/symbolprices",
 *     summary="Create a new SymbolPrices",
 *     tags={"SymbolPrices"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSymbolPricesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolPricesResource")
 *     )
 * )
 */
class CreateSymbolPrices extends Controller
{
    public function __invoke(CreateSymbolPricesRequest $request)
    {
        $record = SymbolPrices::create($request->validated());
        return new SymbolPricesResource($record);
    }
}
