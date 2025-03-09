<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendations;
use Illuminate\Support\Facades\Cache;

class GetRecommendationsByTimeframeAction
{
    public function __invoke(string $timeframe)
    {
        $locale = request()->header('Accept-Language', 'en');
        $limit = request('limit');
        $market_id = request('market_id');
        $select = 'id, symbol_id, sector_id, market_id, target_price, expected_return, timeframe, risk_level, slug';
        if ($locale === 'ar') {
            $select .= ', title_ar, description_ar, points_ar';
        } else {
            $select .= ', title, description, points';
        }
        $query = Recommendations::query()->select($select);
        if ($market_id) {
            $query->where('market_id', $market_id);
        }
        if ($limit) {
            $query->limit($limit);
        }

        return Cache::remember("recommendations-$timeframe-$market_id-$limit-$locale", 20 * 24 * 60 * 60, function () use ($query, $timeframe) {
            return $query->where('timeframe', $timeframe)->get();
        });
    }
}
