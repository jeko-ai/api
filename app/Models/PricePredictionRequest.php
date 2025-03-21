<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PricePredictionRequest extends Model
{
    use HasUuids;

    protected $table = 'price_prediction_requests';
    protected $fillable = [
        'user_id',
        'symbol_id',
        'symbol',
        'market_id',
        'prediction_type',
        'request_date',
        'prediction_start_date',
        'prediction_end_date',
        'status',
        'created_at',
        'updated_at',
    ];

    public function symbol(): HasOne
    {
        return $this->hasOne(Symbol::class, 'id', 'symbol_id');
    }

    public function quote(): HasOne
    {
        return $this->hasOne(Quote::class, 'symbol_id', 'symbol_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(PricePredictionRequestResult::class, 'request_id', 'id');
    }
}
