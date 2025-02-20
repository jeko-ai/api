<?php

namespace App\Http\Controllers\API\V1\Sectors;

use App\Http\Resources\API\V1\SectorsResource;
use App\Models\Sectors;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/sectors/{id}",
 *     summary="Get Sectors by ID",
 *     tags={"Sectors"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SectorsResource")
 *     )
 * )
 */
class GetSectorsById extends Controller
{
    public function __invoke($id)
    {
        return new SectorsResource(Sectors::findOrFail($id));
    }
}
