<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravelcm\Subscriptions\Models\Subscription as BaseSubscription;

class Subscription extends BaseSubscription
{
    use HasUuids;

    protected function casts(): array
    {
        return [
            'features' => 'array',
        ];
    }
}
