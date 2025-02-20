<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Markets extends Model
{
    use HasUuids;

    protected $table = 'markets';
    protected $fillable = [
        'country_id',
        'name_en',
        'name_ar',
        'code',
        'timezone',
        'is_active',
        'created_at',
        'symbol_id',
        'tv_link',
    ];
}