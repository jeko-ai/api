<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *      path="/v1/symbols",
 *      operationId="getSymbols",
 *      tags={"Symbols"},
 *      summary="Retrieve a list of all symbols",
 *      description="Gets a list of symbols from the database or cache",
 *      @OA\Response(
 *          response=200,
 *          description="A list of symbols",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Symbols")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error retrieving symbols"
 *      )
 * )
 */
class GetSymbolsAction
{
    public function __invoke()
    {
        return Cache::rememberForever('symbols', function () {
            return Symbols::where('type', 'stock')->get();
        });
    }
}
