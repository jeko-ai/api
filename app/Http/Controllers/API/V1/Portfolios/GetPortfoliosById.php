<?php

namespace App\Http\Controllers\API\V1\Portfolios;

use App\Http\Resources\API\V1\PortfoliosResource;
use App\Models\Portfolios;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/portfolios/{id}",
 *     summary="Get Portfolios by ID",
 *     tags={"Portfolios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/PortfoliosResource")
 *     )
 * )
 */
class GetPortfoliosById extends Controller
{
    public function __invoke($id)
    {
        return new PortfoliosResource(Portfolios::findOrFail($id));
    }
}
