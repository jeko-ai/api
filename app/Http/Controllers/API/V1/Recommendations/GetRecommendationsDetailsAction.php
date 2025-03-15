<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendation;

class GetRecommendationsDetailsAction
{
    public function __invoke(string $slug)
    {
        $recommendation = Recommendation::where('slug', $slug)->firstOrFail();

        return response()->json($recommendation);
    }
}
