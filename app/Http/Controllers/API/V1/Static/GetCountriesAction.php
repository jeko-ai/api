<?php

namespace App\Http\Controllers\API\V1\Static;

use App\Models\Countries;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Get(
 *      path="/v1/countries",
 *      operationId="getCountries",
 *      tags={"Countries"},
 *      summary="Retrieve a list of all countries",
 *      description="Gets a list of countries from the database or cache",
 *      @OA\Response(
 *          response=200,
 *          description="A list of countries",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Countries")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error retrieving countries"
 *      )
 * )
 */
class GetCountriesAction
{
    public function __invoke()
    {
        return Cache::rememberForever('countries', function () {
            return Countries::all();
        });
    }
}
