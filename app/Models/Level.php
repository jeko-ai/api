<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasUuids;

    protected $table = 'levels';
    protected $fillable = [
        'slug',
        'level',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'xp_required',
        'created_at',
    ];
}
