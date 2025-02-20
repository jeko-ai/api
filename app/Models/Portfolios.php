<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Portfolios extends Model
{
    use HasUuids;

    protected $table = 'portfolios';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'created_at',
        'is_default',
        'currency',
        'total_value',
    ];
}