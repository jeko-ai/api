<?php

namespace App\Http\Controllers\API\V1\Portfolios;

use App\Http\Requests\API\V1\Portfolios\CreatePortfoliosRequest;
use App\Http\Resources\API\V1\PortfoliosResource;
use App\Models\Portfolios;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/portfolios",
 *     summary="Create a new Portfolios",
 *     tags={"Portfolios"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePortfoliosRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PortfoliosResource")
 *     )
 * )
 */
class CreatePortfolios extends Controller
{
    public function __invoke(CreatePortfoliosRequest $request)
    {
        $record = Portfolios::create($request->validated());
        return new PortfoliosResource($record);
    }
}
