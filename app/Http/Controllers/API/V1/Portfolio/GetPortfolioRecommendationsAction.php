<?php

namespace App\Http\Controllers\API\V1\Portfolio;

use App\Models\PortfolioAsset;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

class GetPortfolioRecommendationsAction
{
    public function __invoke(string $timeframe)
    {
        $userId = auth()->user()->id;

        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit');
        $select = [
            'id', 'symbol_id', 'sector_id', 'market_id', 'target_price', 'expected_return', 'timeframe', 'risk_level', 'slug'
        ];
        if ($locale === 'ar') {
            $select = array_merge($select, ['title_ar', 'description_ar', 'points_ar']);
        } else {
            $select = array_merge($select, ['title', 'description', 'points']);
        }
        $assets = PortfolioAsset::where('user_id', $userId)->get(['symbol_id'])->pluck('symbol_id');

        $query = Recommendation::query()->where('symbol_id', $assets)->select($select);

        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("recommendations-$timeframe-$limit-$locale-$userId", 20 * 24 * 60 * 60, function () use ($query, $timeframe) {
            return $query->where('timeframe', $timeframe)->get();
        });
    }
}
