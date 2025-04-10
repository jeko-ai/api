<?php

namespace App\Filament\Admin\Resources\SubscriptionResource\Pages;

use App\Filament\Admin\Resources\SubscriptionResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Laravelcm\Subscriptions\Models\Plan;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $useCustomDates = isset($data['use_custom_dates']) ? (bool) $data['use_custom_dates'] : false;

        $subscriberType = $data['subscriber_type'];
        $subscriberModel = $subscriberType::find($data['subscriber_id']);

        if (!$subscriberModel) {
            return Notification::make()
                ->warning()
                ->title('Subscriber not found.');
        }

        $plan = Plan::find($data['plan_id']);

        if ($useCustomDates) {
            $subscription = $this->getModel()::create([
                'subscriber_type' => $data['subscriber_type'],
                'subscriber_id' => $data['subscriber_id'],
                'name' => $plan->slug,
                'plan_id' => $data['plan_id'],
                'trial_ends_at' => $data['trial_ends_at'] ?? null,
                'starts_at' => $data['starts_at'] ?? null,
                'ends_at' => $data['ends_at'] ?? null,
                'canceled_at' => $data['canceled_at'] ?? null,
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
                })
            ]);
        } else {
            // Use the newPlanSubscription method
            $subscription = $subscriberModel->newPlanSubscription($plan->slug, $plan);

            $subscription->features = $plan->features->map(function ($feature) {
                return $feature->only([
                    'id',
                    'slug',
                    'name',
                    'description',
                    'value',
                    'resettable_period',
                    'resettable_interval',
                ]);
            });
            $subscription->save();
        }

        return $subscription;
    }
}
