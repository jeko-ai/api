<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Symbols;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *      path="/v1/indices",
 *      operationId="getIndices",
 *      tags={"Indices"},
 *      summary="Retrieve a list of all indices",
 *      description="Gets a list of indices from the database or cache",
 *      @OA\Response(
 *          response=200,
 *          description="A list of indices",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Indices")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error retrieving indices"
 *      )
 * )
 */
class GetIndicesAction
{
    public function __invoke()
    {
        return Cache::rememberForever('indices', function () {
            return Symbols::where('type', 'index')->get();
        });
    }
}
