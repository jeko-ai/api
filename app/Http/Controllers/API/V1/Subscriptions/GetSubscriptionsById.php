<?php

namespace App\Http\Controllers\API\V1\Subscriptions;

use App\Http\Resources\API\V1\SubscriptionsResource;
use App\Models\Subscriptions;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/subscriptions/{id}",
 *     summary="Get Subscriptions by ID",
 *     tags={"Subscriptions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionsResource")
 *     )
 * )
 */
class GetSubscriptionsById extends Controller
{
    public function __invoke($id)
    {
        return new SubscriptionsResource(Subscriptions::findOrFail($id));
    }
}
