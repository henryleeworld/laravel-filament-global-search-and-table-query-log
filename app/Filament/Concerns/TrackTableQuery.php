<?php

namespace App\Filament\Concerns;

use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Builder;

trait TrackTableQuery
{
    protected function applyColumnSearchesToTableQuery(Builder $query): Builder
    {
        if ($this->getTableSearch()) {
            SearchLog::create([
                'search_query' => $this->getTableSearch(),
                'resource' => static::$resource,
                'user_id' => auth()->id(),
            ]);
        }

        return parent::applyColumnSearchesToTableQuery($query);
    }
}
