<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Resources\API\V1\SymbolsResource;
use App\Models\Symbols;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/symbols/{id}",
 *     summary="Get Symbols by ID",
 *     tags={"Symbols"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolsResource")
 *     )
 * )
 */
class GetSymbolsById extends Controller
{
    public function __invoke($id)
    {
        return new SymbolsResource(Symbols::findOrFail($id));
    }
}
