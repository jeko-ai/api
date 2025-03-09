<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

class GetNewsBySentiment
{
    public function __invoke(string $sentiment)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');
        $market_id = request('market_id');

        $query = News::query()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)->where('language', $locale)->orderByDesc('created_at');

        if ($limit) {
            $query->limit($limit);
        }
        if ($market_id) {
            $query->where('market_id', $market_id);
        }

        return Cache::remember("news-$sentiment-$market_id-$limit-$locale", 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}
