<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations\Schemas;

use App\Models\Event;
use App\Models\EventRole;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;

class VolunteerRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('event_id')
                            ->label('Event')
                            ->options(function () {
                                return Event::where('status', 'published')
                                    ->pluck('title', 'id');
                            })
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('event_role_id', null))
                            ->searchable(),
                        Select::make('user_id')
                            ->label('Volunteer')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query) =>
                                $query->whereHas(
                                    'roles',
                                    fn(Builder $q) =>
                                    $q->where('name', 'volunteer')
                                )
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                Grid::make(2)
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                        Select::make('event_role_ids')
                            ->label('Role')
                            ->multiple(true)
                            ->options(function (callable $get) {
                                $eventId = $get('event_id');
                                if (!$eventId) {
                                    return [];
                                }
                                return EventRole::where('event_id', $eventId)
                                    ->with('role')
                                    ->get()
                                    ->pluck('role.name', 'id');
                            })
                            ->required()
                            ->reactive()
                            ->searchable()
                            ->visible(fn(callable $get) => $get('event_id') !== null),
                    ]),
            ]);
    }
}
