<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->label(__('Visibility'))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->label(__('Price'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('name')
                            ->label(__('Name')),
                        BooleanConstraint::make('is_visible')
                            ->label(__('Visibility')),
                        NumberConstraint::make('old_price')
                            ->label(__('Old price'))
                            ->icon('heroicon-m-currency-dollar'),
                        NumberConstraint::make('price')
                            ->label(__('Price'))
                            ->icon('heroicon-m-currency-dollar'),
                        NumberConstraint::make('cost')
                            ->label(__('Cost'))
                            ->icon('heroicon-m-currency-dollar'),
                    ])
                    ->constraintPickerColumns(2),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->deferFilters()
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
