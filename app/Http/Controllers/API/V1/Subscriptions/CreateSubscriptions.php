<?php

namespace App\Http\Controllers\API\V1\Subscriptions;

use App\Http\Requests\API\V1\Subscriptions\CreateSubscriptionsRequest;
use App\Http\Resources\API\V1\SubscriptionsResource;
use App\Models\Subscriptions;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/subscriptions",
 *     summary="Create a new Subscriptions",
 *     tags={"Subscriptions"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateSubscriptionsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionsResource")
 *     )
 * )
 */
class CreateSubscriptions extends Controller
{
    public function __invoke(CreateSubscriptionsRequest $request)
    {
        $record = Subscriptions::create($request->validated());
        return new SubscriptionsResource($record);
    }
}
