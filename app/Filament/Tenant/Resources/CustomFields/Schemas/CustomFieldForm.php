<?php

namespace App\Filament\Tenant\Resources\CustomFields\Schemas;

use App\Models\Event;
use App\Models\EventRole;
use App\Models\User;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustomFieldForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('type')
                    ->required()
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'select' => 'Select',
                        'multiselect' => 'Multi Select',
                        'radio' => 'Radio',
                        'checkbox' => 'Checkbox',
                        'toggle' => 'Toggle',
                        'date' => 'Date',
                        'datetime' => 'DateTime',
                        'file' => 'File Upload',
                        'email' => 'Email',
                        'url' => 'URL',
                    ])
                    ->live(),

                Select::make('entity_type')
                    ->required()
                    ->options([
                        Event::class => 'Event',
                        User::class => 'User',
                        EventRole::class => 'Event Role',
                    ]),

                Toggle::make('is_required'),

                Toggle::make('is_active'),

                KeyValue::make('options')
                    ->visible(
                        fn($get) =>
                        in_array($get('type'), ['select', 'multiselect', 'radio', 'checkbox'])
                    )
                    ->columnSpanFull(),

                TextInput::make('sort')
                    ->numeric(),
            ]);
    }

}
