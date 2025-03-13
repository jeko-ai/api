<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SymbolPrice extends Model
{
    use HasUuids;

    protected $table = 'symbol_prices';
    protected $fillable = [
        'symbol_id',
        'pid',
        'last_dir',
        'last_numeric',
        'last',
        'bid',
        'ask',
        'high',
        'low',
        'last_close',
        'pc',
        'pcp',
        'pc_col',
        'time',
        'timestamp',
        'turnover',
        'turnover_numeric',
        'created_at',
    ];
}
