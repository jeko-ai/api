<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Http\Requests\API\V1\Symbols\CreateSymbolsRequest;
use App\Http\Resources\API\V1\SymbolsResource;
use App\Models\Symbols;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/symbols",
 *     summary="Create a new Symbols",
 *     tags={"Symbols"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSymbolsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SymbolsResource")
 *     )
 * )
 */
class CreateSymbols extends Controller
{
    public function __invoke(CreateSymbolsRequest $request)
    {
        $record = Symbols::create($request->validated());
        return new SymbolsResource($record);
    }
}
