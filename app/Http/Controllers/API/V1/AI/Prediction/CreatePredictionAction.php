<?php

namespace App\Http\Controllers\API\V1\AI\Prediction;

use App\Http\Requests\API\V1\CreatePredictionRequest;
use App\Jobs\NotifyBrainAboutNewRequestJob;
use App\Models\PricePredictionRequest;
use App\Models\Subscription;
use App\Models\Symbol;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Cache;

class CreatePredictionAction
{
    use ApiResponseHelpers;

    public function __invoke(CreatePredictionRequest $request)
    {
        /** @var Subscription $subscription */
        $subscription = $request->user()->activePlanSubscriptions()->first();
        if (!$subscription) {
            return $this->respondError(__("Subscription not found"));
        }

        if ($subscription->canUseFeature('ai-stock-predictions')) {
            return $this->respondError(__('You have reached the limit of your plan for this feature'));
        }

        $symbols = Cache::rememberForever('symbols', function () {
            return Symbol::where('type', 'stock')->get();
        });
        $symbol = collect($symbols)->keyBy('id')->get($request->id);
        $market = $symbol?->market;

        $prediction = PricePredictionRequest::create([
            'user_id' => $request->user()->id,
            'symbol_id' => $symbol?->id,
            'symbol' => $symbol?->symbol,
            'market_id' => $symbol?->market_id,
            'prediction_type' => $request->prediction_type,
            'prediction_start_date' => Carbon::parse($request->prediction_start_date)->setTimeFromTimeString($market->open_at),
            'prediction_end_date' => Carbon::parse($request->prediction_end_date)->setTimeFromTimeString($market->close_at),
        ]);
        // Notify Brain about the new prediction request
        NotifyBrainAboutNewRequestJob::dispatch(PricePredictionRequest::class);

        $subscription->recordFeatureUsage('ai-stock-predictions');

        return response()->json($prediction);
    }
}
