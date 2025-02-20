<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sectors extends Model
{
    use HasUuids;

    protected $table = 'sectors';
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'created_at',
    ];
}