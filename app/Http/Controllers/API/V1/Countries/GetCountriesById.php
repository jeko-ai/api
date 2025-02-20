<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Http\Resources\API\V1\CountriesResource;
use App\Models\Countries;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/countries/{id}",
 *     summary="Get Countries by ID",
 *     tags={"Countries"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/CountriesResource")
 *     )
 * )
 */
class GetCountriesById extends Controller
{
    public function __invoke($id)
    {
        return new CountriesResource(Countries::findOrFail($id));
    }
}
