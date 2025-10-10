<?php

namespace App\Filament\Resources\SearchLogs;

use App\Filament\Resources\SearchLogs\Pages\ListSearchLogs;
use App\Filament\Resources\SearchLogs\Schemas\SearchLogForm;
use App\Filament\Resources\SearchLogs\Tables\SearchLogsTable;
use App\Models\SearchLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SearchLogResource extends Resource
{
    protected static ?string $model = SearchLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return SearchLogForm::configure($schema);
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
            'index' => ListSearchLogs::route('/'),
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
        return SearchLogsTable::configure($table);
    }
}
