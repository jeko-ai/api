<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Markets;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *      path="/v1/markets",
 *      operationId="getMarkets",
 *      tags={"Markets"},
 *      summary="Retrieve a list of all markets",
 *      description="Gets a list of markets from the database or cache",
 *      @OA\Response(
 *          response=200,
 *          description="A list of markets",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Markets")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error retrieving markets"
 *      )
 * )
 */
class GetMarketsAction
{
    public function __invoke()
    {
        return Cache::rememberForever('markets', function () {
            return Markets::all();
        });
    }
}
