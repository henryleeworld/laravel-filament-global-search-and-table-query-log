<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SearchLogResource\Pages;
use App\Models\SearchLog;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SearchLogResource extends Resource
{
    protected static ?string $model = SearchLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('search log');
    }

    public static function getNavigationLabel(): string
    {
        return __('Search Logs');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSearchLogs::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->addSelect(DB::raw('count(search_query) as search_count, MAX(id) as id, resource, search_query'))
                    ->groupBy('resource', 'search_query');
            })
            ->defaultGroup('resource')
            ->columns([
                Tables\Columns\TextColumn::make('resource')
                    ->label(__('Resource'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('search_query')
                    ->label(__('Search query'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('search_count')
                    ->label(__('Search count')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('resource')
                    ->label(__('Resource'))
                    ->options(SearchLog::pluck('resource', 'resource')),
            ]);
    }
}
