<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Laravelcm\Subscriptions\Services\Period;

class CheckInvoiceAction
{
    use ApiResponseHelpers;

    /**
     * @throws ConnectionException
     */
    public function __invoke($id)
    {
        $user = auth()->user();
        $subscription = Subscription::where('invoice_id', $id)->first();
        if ($subscription) {
            if ($subscription->user_id != $user->id) {
                return $this->respondError('Invoice already exists');
            }
            return $this->respondWithSuccess($subscription);
        }
        $apiUrl = config('services.fawaterk.api_url');

        $response = Http::asJson()
            ->acceptJson()
            ->withToken('Bearer ' . config('services.fawaterk.api_key'))->get("$apiUrl/api/v2/getInvoiceData/$id");

        $json = $response->json();

        if (isset($json['status']) && $json['status'] == 'success') {
            $data = $json['data'];
            $extra = json_decode($data['pay_load'], true);
            if ($data['paid']) {
                $user->activePlanSubscriptions()->each(function (Subscription $subscription) {
                    if ($subscription->active()) {
                        $subscription->cancel();
                    }
                });

                $interval = match ($extra['payment_option']) {
                    'monthly' => 1,
                    'quarterly' => 3,
                    'biannual' => 6,
                    'yearly' => 12,
                };

                $plan = Plan::find($extra['plan_id']);

                $trial = new Period(
                    interval: $plan->trial_interval,
                    count: $plan->trial_period,
                    start: $startDate ?? Carbon::now()
                );

                $period = new Period(
                    interval: $plan->invoice_interval,
                    count: $interval,
                    start: $trial->getEndDate()
                );

                $subscription = $user->planSubscriptions()->create([
                    'invoice_id' => $id,
                    'name' => $plan->slug,
                    'plan_id' => $plan->id,
                    'trial_ends_at' => $trial->getEndDate(),
                    'starts_at' => $period->getStartDate(),
                    'ends_at' => $period->getEndDate(),
                    'features' => $plan->features->map(function ($feature) {
                        return $feature->only([
                            'id',
                            'slug',
                            'name',
                            'description',
                            'value',
                            'resettable_period',
                            'resettable_interval',
                        ]);
                    }),
                ]);

                return $this->respondWithSuccess($subscription);
            }
        }

        return $this->respondError('Invoice not found');
    }
}
