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

    public function active(): bool
    {
        if ($this->ended()) return false;
        if ($this->canceled()) return false;
        return $this->ended() || $this->onTrial();
    }
}
