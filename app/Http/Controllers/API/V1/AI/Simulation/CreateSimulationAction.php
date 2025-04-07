<?php

namespace App\Http\Controllers\API\V1\AI\Simulation;

use App\Http\Requests\CreateSimulationRequest;
use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\Market;
use App\Models\Subscription;
use App\Models\TradingSimulationRequest;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Post(
 *     path="/api/v1/ai/simulations",
 *     operationId="createSimulation",
 *     tags={"AI Simulations"},
 *     summary="Create a new trading simulation",
 *     description="Creates a new trading simulation based on input parameters",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"market_id", "investment_amount", "risk_level", "duration", "strategy", "start_time", "end_time"},
 *             @OA\Property(property="market_id", type="integer", example=1, description="Market ID"),
 *             @OA\Property(property="symbols", type="array", @OA\Items(type="string"), example={"AAPL", "MSFT"}, description="Stock symbols to include"),
 *             @OA\Property(property="sectors", type="array", @OA\Items(type="string"), example={"Technology", "Healthcare"}, description="Sectors to include"),
 *             @OA\Property(property="investment_amount", type="number", format="float", example=10000, description="Total investment amount"),
 *             @OA\Property(property="risk_level", type="string", example="medium", description="Risk level (low, medium, high)"),
 *             @OA\Property(property="duration", type="integer", example=30, description="Duration in days"),
 *             @OA\Property(property="strategy", type="string", example="growth", description="Investment strategy"),
 *             @OA\Property(property="start_time", type="string", format="date", example="2023-08-01", description="Start date"),
 *             @OA\Property(property="end_time", type="string", format="date", example="2023-09-01", description="End date"),
 *             @OA\Property(property="expected_return_percentage", type="number", format="float", example=5.5, description="Expected return percentage"),
 *             @OA\Property(property="stop_loss_percentage", type="number", format="float", example=2.0, description="Stop loss percentage"),
 *             @OA\Property(property="selected_type", type="string", example="symbols", description="Selection type (symbols or sectors)")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Simulation created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="market_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="pending"),
 *             @OA\Property(property="investment_amount", type="number", format="float", example=10000),
 *             @OA\Property(property="created_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or subscription limit reached",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="You have reached the limit of your plan for this feature")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
class CreateSimulationAction
{
    use ApiResponseHelpers;

    public function __invoke(CreateSimulationRequest $request)
    {
        /** @var Subscription $subscription */
        $subscription = $request->user()->activePlanSubscriptions()->first();
        if (!$subscription) {
            return $this->respondError(__("Subscription not found"));
        }

        if (!$subscription->canUseFeature('ai-trading-simulations')) {
            return $this->respondError(__('You have reached the limit of your plan for this feature'));
        }

        $markets = Cache::rememberForever('markets', function () {
            return Market::all();
        });

        $market = collect($markets)->keyBy('id')->get($request->market_id);

        $simulation = TradingSimulationRequest::create([
            'user_id' => $request->user()->id,
            'market_id' => $request->market_id,
            'symbols' => $request->symbols,
            'sectors' => $request->sectors,
            'investment_amount' => $request->investment_amount,
            'risk_level' => $request->risk_level,
            'duration' => $request->duration,
            'strategy' => $request->strategy,
            'start_time' => Carbon::parse($request->start_time)->setTimeFromTimeString($market->open_at),
            'end_time' => Carbon::parse($request->end_time)->setTimeFromTimeString($market->close_at),
            'expected_return_percentage' => $request->expected_return_percentage,
            'stop_loss_percentage' => $request->stop_loss_percentage,
            'selected_type' => $request->selected_type,
        ]);
        // Notify Brain about the new simulation request
        NotifyBrainAboutNewRequestJob::dispatch(TradingSimulationRequest::class);

        $subscription->recordFeatureUsage('ai-trading-simulations');

        return response()->json($simulation);

    }
}

