<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

class GetRecommendationsAction
{
    public function __invoke()
    {
        $locale = request()->header('Accept-Language', request('locale', 'en'));
        $limit = min(request('limit'), 12);
        $market_id = request('market_id');
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

        return $query->paginate($limit);
    }
}
