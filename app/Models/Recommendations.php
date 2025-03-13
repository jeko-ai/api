<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Recommendations extends Model
{
    use HasUuids;

    protected $table = 'recommendations';
    protected $fillable = [
        'symbol_id',
        'market_id',
        'country_id',
        'sector_id',
        'current_price',
        'target_price',
        'reason',
        'reason_ar',
        'recent_performance',
        'recent_performance_ar',
        'competitive_positioning',
        'competitive_positioning_ar',
        'economic_factors',
        'economic_factors_ar',
        'risk_level',
        'potential_growth',
        'confidence_score',
        'expected_return',
        'recommendation_type',
        'analysis_summary',
        'analysis_summary_ar',
        'created_at',
        'valid_until',
        'timeframe',
        'title',
        'title_ar',
        'description',
        'description_ar',
        'short_description',
        'short_description_ar',
        'points',
        'points_ar',
        'meta_description',
        'meta_description_ar',
        'meta_tags',
        'meta_tags_ar',
        'slug',
    ];

    protected $casts = [
        'points' => 'array',
        'points_ar' => 'array',
        'meta_tags_ar',
        'meta_tags' => 'array',
    ];
}
