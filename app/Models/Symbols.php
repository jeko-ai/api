<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Symbols extends Model
{
    use HasUuids;

    protected $table = 'symbols';
    protected $fillable = [
        'tv_id',
        'symbol',
        'isin',
        'logo_id',
        'type',
        'currency',
        'inv_symbol',
        'inv_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'short_description_en',
        'short_description_ar',
        'full_name',
        'mb_url',
        'status',
        'country_id',
        'market_id',
        'sector_id',
        'created_at',
        'next_month_recommendation',
        'next_quarter_recommendation',
        'next_biannual_recommendation',
        'next_year_recommendation',
    ];
}