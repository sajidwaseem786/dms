<?php

namespace App\Filament\Tenant\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('location')
                            ->required()
                            ->maxLength(255)
                    ]),

                Grid::make(2)
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        TimePicker::make('start_time')
                            ->label('Start Time')
                            ->required(),
                    ]),

                Grid::make(2)
                    ->schema([
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->afterOrEqual('start_date'),

                        TimePicker::make('end_time')
                            ->label('End Time')
                            ->required(),
                    ]),

                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('description')
                            ->rows(2)
                            ->maxLength(65535),

                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'closed' => 'Closed',
                            ])
                            ->default('draft')
                            ->required(),
                    ]),

                Section::make('Event Roles')
                    ->description('Define roles and compensation for this event')
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Repeater::make('roles')
                            ->relationship()
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                // Row 1: Role and Required Count
                                Grid::make(2)
                                    ->schema([
                                        Select::make('role_id')
                                            ->label('Role')
                                            ->options(function () {
                                                return \App\Models\VolunteerRole::pluck('name', 'id');
                                            })
                                            ->searchable()
                                            ->required()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->label('Role Name'),
                                                Textarea::make('description')
                                                    ->rows(2)
                                                    ->label('Description'),
                                            ])
                                            ->createOptionUsing(function (array $data) {
                                                return \App\Models\VolunteerRole::create($data)->id;
                                            }),

                                        TextInput::make('required_count')
                                            ->label('Required Volunteers')
                                            ->required()
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1),
                                    ]),

                                // Row 2: Volunteer Types (Full Width)
                                Select::make('volunteer_type_ids')
                                    ->label('Open Voor')
                                    ->multiple()
                                    ->options(function () {
                                        return \App\Models\VolunteerRole::pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->helperText('Select the types of volunteers suitable for this role')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('Type Name'),
                                        Textarea::make('description')
                                            ->rows(2)
                                            ->label('Description'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        return \App\Models\VolunteerRole::create($data)->id;
                                    })
                                    ->columnSpanFull(),

                                // Row 3: Compensation Type and Amount
                                Grid::make(2)
                                    ->schema([
                                        Select::make('compensation_type')
                                            ->label('Compensation Type')
                                            ->options([
                                                'none' => 'Unpaid',
                                                'fixed' => 'Fixed Amount',
                                                'hourly' => 'Hourly Rate',
                                            ])
                                            ->default('none')
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(
                                                fn($state, callable $set) =>
                                                $state === 'none' ? $set('compensation_amount', null) : null
                                            ),

                                        TextInput::make('compensation_amount')
                                            ->label('Amount (€)')
                                            ->numeric()
                                            ->prefix('€')
                                            ->step(0.01)
                                            ->minValue(0)
                                            ->hidden(fn(callable $get) => $get('compensation_type') === 'none')
                                            ->required(fn(callable $get) => in_array($get('compensation_type'), ['fixed', 'hourly'])),
                                    ]),
                            ])
                            ->addActionLabel('Add Role')
                            ->defaultItems(0)
                            ->itemLabel(
                                fn(array $state): ?string =>
                                isset($state['role_id'])
                                ? \App\Models\VolunteerRole::find($state['role_id'])?->name
                                : null
                            )
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
