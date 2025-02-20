<?php

namespace App\Http\Controllers\API\V1\SymbolPrices;

use App\Http\Requests\API\V1\SymbolPrices\UpdateSymbolPricesRequest;
use App\Http\Resources\API\V1\SymbolPricesResource;
use App\Models\SymbolPrices;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/symbolprices/{id}",
 *     summary="Update SymbolPrices",
 *     tags={"SymbolPrices"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSymbolPricesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolPricesResource")
 *     )
 * )
 */
class UpdateSymbolPrices extends Controller
{
    public function __invoke(UpdateSymbolPricesRequest $request, $id)
    {
        $record = SymbolPrices::findOrFail($id);
        $record->update($request->validated());
        return new SymbolPricesResource($record);
    }
}
