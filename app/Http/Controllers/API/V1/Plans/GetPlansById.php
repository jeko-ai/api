<?php

namespace App\Http\Controllers\API\V1\Plans;

use App\Http\Resources\API\V1\PlansResource;
use App\Models\Plans;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/plans/{id}",
 *     summary="Get Plans by ID",
 *     tags={"Plans"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PlansResource")
 *     )
 * )
 */
class GetPlansById extends Controller
{
    public function __invoke($id)
    {
        return new PlansResource(Plans::findOrFail($id));
    }
}
