<?php

namespace App\Http\Controllers\API\V1\Portfolios;

use App\Http\Requests\API\V1\Portfolios\UpdatePortfoliosRequest;
use App\Http\Resources\API\V1\PortfoliosResource;
use App\Models\Portfolios;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/portfolios/{id}",
 *     summary="Update Portfolios",
 *     tags={"Portfolios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdatePortfoliosRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/PortfoliosResource")
 *     )
 * )
 */
class UpdatePortfolios extends Controller
{
    public function __invoke(UpdatePortfoliosRequest $request, $id)
    {
        $record = Portfolios::findOrFail($id);
        $record->update($request->validated());
        return new PortfoliosResource($record);
    }
}
