<?php

namespace App\Http\Controllers\API\V1\Markets;

use App\Http\Resources\API\V1\MarketsResource;
use App\Models\Markets;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/markets/{id}",
 *     summary="Get Markets by ID",
 *     tags={"Markets"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/MarketsResource")
 *     )
 * )
 */
class GetMarketsById extends Controller
{
    public function __invoke($id)
    {
        return new MarketsResource(Markets::findOrFail($id));
    }
}
