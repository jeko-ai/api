<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasUuids;

    protected $table = 'countries';
    protected $fillable = [
        'name_en',
        'name_ar',
        'code',
        'currency_en',
        'currency_ar',
        'currency_code',
        'created_at',
    ];
}
