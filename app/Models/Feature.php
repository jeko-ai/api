<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravelcm\Subscriptions\Models\Feature as BaseFeature;

class Feature extends BaseFeature
{
    use HasUuids;
}
