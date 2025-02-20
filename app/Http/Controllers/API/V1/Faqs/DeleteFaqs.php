<?php

namespace App\Http\Controllers\API\V1\Faqs;

use App\Models\Faqs;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/api/v1/faqs/{id}",
 *     summary="Delete Faqs",
 *     tags={"Faqs"},
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
class DeleteFaqs extends Controller
{
    public function __invoke($id)
    {
        Faqs::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
