<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\API\V1\Symbols\UpdateSymbolsRequest;
use App\Http\Resources\API\V1\SymbolsResource;
use App\Models\Symbols;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/symbols/{id}",
 *     summary="Update Symbols",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSymbolsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolsResource")
 *     )
 * )
 */
class UpdateSymbols extends Controller
{
    public function __invoke(UpdateSymbolsRequest $request, $id)
    {
        $record = Symbols::findOrFail($id);
        $record->update($request->validated());
        return new SymbolsResource($record);
    }
}
