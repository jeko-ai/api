<?php

namespace App\Http\Controllers\API\V1\Recommendations;

use App\Models\Recommendations;

class GetRecommendationsDetailsAction
{
    public function __invoke(string $slug)
    {
        $recommendation = Recommendations::where('slug', $slug)->firstOrFail();

        return response()->json($recommendation);
    }
}
