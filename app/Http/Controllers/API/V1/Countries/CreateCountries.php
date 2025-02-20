<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Http\Requests\API\V1\Countries\CreateCountriesRequest;
use App\Http\Resources\API\V1\CountriesResource;
use App\Models\Countries;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/countries",
 *     summary="Create a new Countries",
 *     tags={"Countries"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateCountriesRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/CountriesResource")
 *     )
 * )
 */
class CreateCountries extends Controller
{
    public function __invoke(CreateCountriesRequest $request)
    {
        $record = Countries::create($request->validated());
        return new CountriesResource($record);
    }
}
