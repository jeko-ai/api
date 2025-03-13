<?php

namespace App\Http\Controllers\API\V1\News;

use App\Models\News;

class GetNewsDetailsAction
{
    public function __invoke(string $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        return response()->json($news);
    }
}
