<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Favorites extends Model
{
    use HasUuids;

    protected $table = 'favorites';
    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
        'created_at',
    ];
}