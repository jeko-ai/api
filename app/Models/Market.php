<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
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

    protected $casts = [
        'trading_days' => 'array'
    ];

    public function symbols(): HasMany
    {
        return $this->hasMany(Symbol::class);
    }
}
