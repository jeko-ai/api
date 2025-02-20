<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Plans extends Model
{
    use HasUuids;

    protected $table = 'plans';
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'billing_cycle',
        'trial_days',
        'features',
        'status',
        'created_at',
        'slug',
    ];
}