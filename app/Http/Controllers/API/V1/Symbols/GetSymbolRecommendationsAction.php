<?php

namespace App\Http\Controllers\API\V1\Symbols;

use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

class GetSymbolRecommendationsAction
{
    public function __invoke(string $symbol, string $timeframe)
    {
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
        $query = Recommendation::query()->select($select)->where('symbol_id', $symbol);

        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("recommendations-$timeframe-$symbol-$limit-$locale", 20 * 24 * 60 * 60, function () use ($query, $timeframe) {
            return $query->where('timeframe', $timeframe)->get();
        });
    }
}

