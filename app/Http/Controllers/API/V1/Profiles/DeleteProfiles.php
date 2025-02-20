<?php

namespace App\Http\Controllers\API\V1\Profiles;

use App\Models\Profiles;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/profiles/{id}",
 *     summary="Delete Profiles",
 *     tags={"Profiles"},
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
class DeleteProfiles extends Controller
{
    public function __invoke($id)
    {
        Profiles::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
