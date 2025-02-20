<?php

namespace App\Http\Controllers\API\V1\Invitations;

use App\Http\Requests\API\V1\Invitations\CreateInvitationsRequest;
use App\Http\Resources\API\V1\InvitationsResource;
use App\Models\Invitations;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/invitations",
 *     summary="Create a new Invitations",
 *     tags={"Invitations"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateInvitationsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/InvitationsResource")
 *     )
 * )
 */
class CreateInvitations extends Controller
{
    public function __invoke(CreateInvitationsRequest $request)
    {
        $record = Invitations::create($request->validated());
        return new InvitationsResource($record);
    }
}
