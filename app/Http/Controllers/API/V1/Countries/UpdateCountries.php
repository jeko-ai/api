<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Http\Requests\API\V1\Countries\UpdateCountriesRequest;
use App\Http\Resources\API\V1\CountriesResource;
use App\Models\Countries;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/countries/{id}",
 *     summary="Update Countries",
 *     tags={"Countries"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateCountriesRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/CountriesResource")
 *     )
 * )
 */
class UpdateCountries extends Controller
{
    public function __invoke(UpdateCountriesRequest $request, $id)
    {
        $record = Countries::findOrFail($id);
        $record->update($request->validated());
        return new CountriesResource($record);
    }
}
