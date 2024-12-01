<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\TrackGlobalSearch;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    use TrackGlobalSearch;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label(__('Email verified at')),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone'))
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('birthday')
                            ->label(__('Birthday'))
                            ->maxDate('today'),
                        Forms\Components\TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('Created at'))
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('Updated at'))
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name . ' ' . $record->email;
    }

    public static function getModelLabel(): string
    {
        return __('user');
    }

    public static function getNavigationLabel(): string
    {
        return __('Users');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
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
