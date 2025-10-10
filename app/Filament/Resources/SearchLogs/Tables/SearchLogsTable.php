<?php

namespace App\Filament\Resources\SearchLogs\Tables;

use App\Models\SearchLog;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SearchLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->addSelect(DB::raw('count(search_query) as search_count, MAX(id) as id, resource, search_query'))
                    ->groupBy('resource', 'search_query');
            })
            ->defaultGroup('resource')
            ->columns([
                TextColumn::make('resource')
                    ->label(__('Resource'))
                    ->searchable(),
                TextColumn::make('search_query')
                    ->label(__('Search query'))
                    ->searchable(),
                TextColumn::make('search_count')
                    ->label(__('Search count')),
            ])
            ->filters([
                SelectFilter::make('resource')
                    ->label(__('Resource'))
                    ->options(SearchLog::pluck('resource')),
            ]);
    }
}
