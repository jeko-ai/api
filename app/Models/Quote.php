<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasUuids;

    protected $table = 'quotes';
    protected $fillable = [
        'symbol_id',
        'symbol',
        'name',
        'exchange',
        'description',
        'last_price',
        'change',
        'change_percent',
        'open_price',
        'high_price',
        'low_price',
        'prev_close_price',
        'volume',
        'ask_price',
        'bid_price',
        'spread',
        'created_at',
    ];
}
