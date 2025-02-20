<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Models\Countries;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/countries/{id}",
 *     summary="Delete Countries",
 *     tags={"Countries"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Deleted"
 *     )
 * )
 */
class DeleteCountries extends Controller
{
    public function __invoke($id)
    {
        Countries::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
