<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;
use Illuminate\Support\Facades\Cache;

class GetRecommendationsByTimeframeAction
{
    public function __invoke(string $timeframe)
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = request('limit', 4);
        $market_id = request('market_id');
        $symbol_id = request('symbol_id');
        $select = [
            'id', 'symbol_id', 'sector_id', 'market_id', 'target_price', 'expected_return', 'timeframe', 'risk_level', 'slug'
        ];
        if ($locale === 'ar') {
            $select = array_merge($select, ['title_ar', 'description_ar', 'points_ar']);
        } else {
            $select = array_merge($select, ['title', 'description', 'points']);
        }
        $query = Recommendation::query()->select($select);

        if ($market_id) {
            $query->where('market_id', $market_id);
        }
        if ($limit) {
            $query->limit($limit);
        }

        if ($symbol_id) {
            $query->where('symbol_id', $symbol_id);
        }

        return $query->where('timeframe', $timeframe)->get();
    }
}

