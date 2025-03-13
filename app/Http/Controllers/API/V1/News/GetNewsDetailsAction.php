<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

class GetNewsDetailsAction
{
    public function __invoke(string $slug)
    {
        $news = Cache::rememberForever('plans', function () use ($slug) {
            return News::where('slug', $slug)->firstOrFail();
        });

        return response()->json($news);
    }
}
