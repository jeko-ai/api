<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\News;
use App\Models\PortfolioAsset;
use Illuminate\Support\Facades\Cache;

class GetPortfolioNewsAction
{
    public function __invoke(string $sentiment)
    {
        $userId = auth()->user()->id;

        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');

        $assets = PortfolioAsset::where('user_id', $userId)->get(['symbol_id'])->pluck('symbol_id');

        $query = News::isRewritten()->select([
            'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
        ])->where('sentiment', $sentiment)
            ->where('language', $locale)
            ->whereIn('symbol_id', $assets)
            ->orderByDesc('created_at');


        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("news-$sentiment-$userId-$limit-$locale", 60 * 60, function () use ($query) {
            return $query->get();
        });
    }
}

