<?php

namespace App\Filament\Tenant\Resources\Roles\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
}
