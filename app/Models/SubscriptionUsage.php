<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravelcm\Subscriptions\Models\SubscriptionUsage as BaseSubscriptionUsage;

class SubscriptionUsage extends BaseSubscriptionUsage
{
    use HasUuids;
}
