<?php

namespace App\Http\Controllers\API\V1\Plans;

use App\Http\Requests\API\V1\Plans\CreatePlansRequest;
use App\Http\Resources\API\V1\PlansResource;
use App\Models\Plans;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/plans",
 *     summary="Create a new Plans",
 *     tags={"Plans"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreatePlansRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/PlansResource")
 *     )
 * )
 */
class CreatePlans extends Controller
{
    public function __invoke(CreatePlansRequest $request)
    {
        $record = Plans::create($request->validated());
        return new PlansResource($record);
    }
}
