<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Name'))
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->required(),
                            ])
                            ->columns(2),
                        Section::make()
                            ->schema([
                                Toggle::make('is_visible')
                                    ->label(__('Visibility'))
                                    ->default(false),
                            ])
                            ->columns(2),
                        Section::make(__('Pricing'))
                            ->schema([
                                TextInput::make('price')
                                    ->label(__('Price'))
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),
                                TextInput::make('old_price')
                                    ->label(__('Old price'))
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),
                                TextInput::make('cost')
                                    ->label(__('Cost'))
                                    ->helperText(__('Customers won\'t see this price.'))
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),
            ])
            ->columns(3);
    }
}
