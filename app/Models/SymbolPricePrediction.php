<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SymbolPricePrediction extends Model
{
    use HasUuids;

    protected $table = 'symbol_price_predictions';
}
