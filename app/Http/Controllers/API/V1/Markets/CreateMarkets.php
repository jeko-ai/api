<?php

namespace App\Http\Controllers\API\V1\Markets;

use App\Http\Requests\API\V1\Markets\CreateMarketsRequest;
use App\Http\Resources\API\V1\MarketsResource;
use App\Models\Markets;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/markets",
 *     summary="Create a new Markets",
 *     tags={"Markets"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateMarketsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/MarketsResource")
 *     )
 * )
 */
class CreateMarkets extends Controller
{
    public function __invoke(CreateMarketsRequest $request)
    {
        $record = Markets::create($request->validated());
        return new MarketsResource($record);
    }
}
