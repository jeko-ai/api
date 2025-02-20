<?php

namespace App\Http\Controllers\API\V1\Subscriptions;

use App\Http\Requests\API\V1\Subscriptions\UpdateSubscriptionsRequest;
use App\Http\Resources\API\V1\SubscriptionsResource;
use App\Models\Subscriptions;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/subscriptions/{id}",
 *     summary="Update Subscriptions",
 *     tags={"Subscriptions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateSubscriptionsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriptionsResource")
 *     )
 * )
 */
class UpdateSubscriptions extends Controller
{
    public function __invoke(UpdateSubscriptionsRequest $request, $id)
    {
        $record = Subscriptions::findOrFail($id);
        $record->update($request->validated());
        return new SubscriptionsResource($record);
    }
}
