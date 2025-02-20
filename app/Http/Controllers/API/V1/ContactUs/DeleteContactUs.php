<?php

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Models\ContactUs;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/contactus/{id}",
 *     summary="Delete ContactUs",
 *     tags={"ContactUs"},
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
class DeleteContactUs extends Controller
{
    public function __invoke($id)
    {
        ContactUs::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
