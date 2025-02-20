<?php

namespace App\Http\Controllers\API\V1\Invitations;

use App\Http\Requests\API\V1\Invitations\UpdateInvitationsRequest;
use App\Http\Resources\API\V1\InvitationsResource;
use App\Models\Invitations;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/v1/invitations/{id}",
 *     summary="Update Invitations",
 *     tags={"Invitations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateInvitationsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/InvitationsResource")
 *     )
 * )
 */
class UpdateInvitations extends Controller
{
    public function __invoke(UpdateInvitationsRequest $request, $id)
    {
        $record = Invitations::findOrFail($id);
        $record->update($request->validated());
        return new InvitationsResource($record);
    }
}
