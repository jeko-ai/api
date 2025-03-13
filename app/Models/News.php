<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasUuids;

    protected $table = 'news';
    protected $fillable = [
        'title',
        'content',
        'description',
        'link',
        'resource_id',
        'language',
        'image_url',
        'small_image_url',
        'score',
        'sentiment',
        'reason',
        'negative_aspects',
        'positive_aspects',
        'symbol_id',
        'market_id',
        'country_id',
        'created_at',
        'images',
        'category',
        'date',
        'sector_id',
        'is_rewritten',
        'source',
        'actions',
        'slug',
        'meta_tags',
        'meta_description',
    ];

    protected $casts = [
        'actions' => 'array',
        'images' => 'array',
        'meta_tags' => 'array',
        'meta_description' => 'array',
    ];
}
