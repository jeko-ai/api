<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravelcm\Subscriptions\Models\Plan as BasePlan;

class Plan extends BasePlan
{
    use HasUuids;
}
