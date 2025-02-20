<?php

namespace App\Http\Controllers\API\V1\Invitations;

use App\Http\Resources\API\V1\InvitationsResource;
use App\Models\Invitations;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/invitations/{id}",
 *     summary="Get Invitations by ID",
 *     tags={"Invitations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/InvitationsResource")
 *     )
 * )
 */
class GetInvitationsById extends Controller
{
    public function __invoke($id)
    {
        return new InvitationsResource(Invitations::findOrFail($id));
    }
}
