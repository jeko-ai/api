<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravelcm\Subscriptions\Models\Feature;
use Laravelcm\Subscriptions\Models\SubscriptionUsage as BaseSubscriptionUsage;

class SubscriptionUsage extends BaseSubscriptionUsage
{
    use HasUuids;

    public function scopeByFeatureSlug(Builder $builder, string $featureSlug, string|int $planId): Builder
    {
        $model = config('laravel-subscriptions.models.feature', Feature::class);
        $feature = $model::where('plan_id', $planId)->where('slug', $featureSlug)->first();

        return $builder->where('feature_id', $feature ? $feature->getKey() : null);
    }
}
