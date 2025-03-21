<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PricePredictionRequestResult extends Model
{
    use HasUuids;

    protected $table = 'price_prediction_request_results';
    protected $fillable = [

    ];
}
