<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\Portfolio;
use App\Models\PortfolioHistory;

/**
 * @OA\Get(
 *     path="/v1/portfolio",
 *     operationId="getUserPortfolio",
 *     tags={"Portfolio"},
 *     summary="Get user's default portfolio details",
 *     description="Returns detailed information about the user's default portfolio including value and change percentage",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="total_value", type="number", format="float"),
 *             @OA\Property(property="currency", type="string"),
 *             @OA\Property(property="is_default", type="boolean"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="change_percentage", type="number", format="float"),
 *             @OA\Property(property="previous_total_value", type="number", format="float")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Portfolio not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="no_portfolio")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
class GetUserPortfolioAction
{
    public function __invoke()
    {
        // Get the latest default portfolio
        $latestPortfolio = Portfolio::where('user_id', request()->user()->id)
            ->where('is_default', true)
            ->first();

        if (!$latestPortfolio) {
            return response()->json(['status' => 'no_portfolio'], 404);
        }

        // Get the previous day's total value
        $previousValue = PortfolioHistory::where('portfolio_id', $latestPortfolio->id)
            ->whereDate('date', now()->subDay()->toDateString())
            ->orderBy('date', 'desc')
            ->value('total_value');

        // Calculate the percentage change
        $previousValue = $previousValue ?? $latestPortfolio->total_value; // Default to current value if no history exists
        $changePercentage = $previousValue != 0
            ? round((($latestPortfolio->total_value - $previousValue) / $previousValue) * 100, 2)
            : 0;

        return response()->json([
            'id' => $latestPortfolio->id,
            'name' => $latestPortfolio->name,
            'description' => $latestPortfolio->description,
            'total_value' => $latestPortfolio->total_value,
            'currency' => $latestPortfolio->currency,
            'is_default' => $latestPortfolio->is_default,
            'created_at' => $latestPortfolio->created_at,
            'change_percentage' => $changePercentage,
            'previous_total_value' => $previousValue,
        ]);
    }
}

