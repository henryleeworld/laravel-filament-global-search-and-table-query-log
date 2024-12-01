<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\TrackGlobalSearch;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    use TrackGlobalSearch;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Name'))
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->required(),
                            ])
                            ->columns(2),
                        Forms\Components\Section::make(__('Pricing'))
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label(__('Price'))
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                Forms\Components\TextInput::make('old_price')
                                    ->label(__('Old price'))
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                Forms\Components\TextInput::make('cost')
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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name;
    }

    public static function getModelLabel(): string
    {
        return __('product');
    }

    public static function getNavigationLabel(): string
    {
        return __('Products');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label(__('Visibility'))
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
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
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->deferFilters()
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
