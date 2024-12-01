<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Concerns\TrackTableQuery;
use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    use TrackTableQuery;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
