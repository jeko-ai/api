<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
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
