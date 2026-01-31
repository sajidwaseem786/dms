<?php

namespace App\Filament\Tenant\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->seconds(false)
                    ->nullable()
                    ->default(
                        fn(string $context) =>
                        $context === 'create' ? now() : null
                    ),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(
                        fn($state) =>
                        filled($state) ? Hash::make($state) : null
                    )
                    ->required(fn(string $context) => $context === 'create')
                    ->hiddenOn('edit'),

                Select::make('roles')
                    ->label('Role')
                    ->options(fn() => \App\Models\Role::pluck('name', 'name'))
                    ->required()
                    ->preload()
                    ->searchable()
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record) {
                            $component->state(
                                $record->roles->first()?->name
                            );
                        }
                    }),

            ]);
    }
}
