<?php

namespace App\Http\Controllers\API\V1\Invitations;

use App\Models\Invitations;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/invitations/{id}",
 *     summary="Delete Invitations",
 *     tags={"Invitations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Deleted"
 *     )
 * )
 */
class DeleteInvitations extends Controller
{
    public function __invoke($id)
    {
        Invitations::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
