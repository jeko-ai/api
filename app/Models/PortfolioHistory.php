<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PortfolioHistory extends Model
{
    use HasUuids;

    protected $table = 'portfolio_history';
    protected $fillable = [
        'portfolio_id',
        'date',
        'total_value',
        'created_at',
    ];
}