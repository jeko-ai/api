<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Portfolios extends Model
{
    use HasUuids;

    protected $table = 'portfolios';
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'is_default',
        'currency',
        'total_value',
    ];
}
