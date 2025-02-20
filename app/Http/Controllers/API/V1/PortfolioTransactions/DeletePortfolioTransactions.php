<?php

namespace App\Http\Controllers\API\V1\PortfolioTransactions;

use App\Models\PortfolioTransactions;
use Illuminate\Routing\Controller;

/**
 * @OA\Delete(
 *     path="/v1/portfoliotransactions/{id}",
 *     summary="Delete PortfolioTransactions",
 *     tags={"PortfolioTransactions"},
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
class DeletePortfolioTransactions extends Controller
{
    public function __invoke($id)
    {
        PortfolioTransactions::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
