<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PricePredictionRequests extends Model
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
        'prediction_result',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'prediction_result' => 'array'
    ];
}
