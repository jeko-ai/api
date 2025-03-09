<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;

class GetNewsAction
{
    public function __invoke()
    {
        $language = request()->header('Accept-Language', request('language', 'en'));
        $limit = min(request('limit', 12), 12);
        $market_id = request('market_id');
        $search = request('search');

        $query = News::query()
            ->where('language', $language)->select([
                'slug', 'title', 'small_image_url', 'symbol_id', 'market_id', 'description', 'sentiment', 'date'
            ])
            ->orderByDesc('created_at');

        if ($market_id) {
            $query->where('market_id', $market_id);
        }

        return News::paginate($limit);
    }
}
