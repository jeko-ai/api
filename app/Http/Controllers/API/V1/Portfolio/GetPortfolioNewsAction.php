<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

class GetPortfolioNewsAction
{
    public function __invoke(string $sentiment)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');

        $query = News::isRewritten()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)->where('language', $locale)->orderByDesc('created_at');

        if ($limit) {
            $query->limit($limit);
        }
        $userId = auth()->user()->id;

        return Cache::remember("news-$sentiment-$userId-$limit-$locale", 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}
