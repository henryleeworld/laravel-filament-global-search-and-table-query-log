<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->maxLength(255)
                            ->email()
                            ->unique(User::class, 'email', ignoreRecord: true)
                            ->required(),
                        DateTimePicker::make('email_verified_at')
                            ->label(__('Email verified at')),
                        TextInput::make('phone')
                            ->label(__('Phone'))
                            ->maxLength(255),
                        DatePicker::make('birthday')
                            ->label(__('Birthday'))
                            ->maxDate('today'),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => $state)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),
                Section::make()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label(__('Created at'))
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),
                        Placeholder::make('updated_at')
                            ->label(__('Updated at'))
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),
            ])
            ->columns(3);
    }
}
