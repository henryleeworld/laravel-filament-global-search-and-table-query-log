<?php

namespace App\Filament\Concerns;

use App\Models\SearchLog;
use Illuminate\Support\Collection;

trait TrackGlobalSearch
{
    public static function getGlobalSearchResults(string $search): Collection
    {
        if ($search) {
            SearchLog::create([
                'search_query' => $search,
                'resource' => static::class,
                'user_id' => auth()->id(),
            ]);
        }
        return parent::getGlobalSearchResults($search);
    }
}
