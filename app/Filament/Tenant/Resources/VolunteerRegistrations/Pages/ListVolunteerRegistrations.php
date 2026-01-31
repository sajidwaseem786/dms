<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations\Pages;

use App\Filament\Tenant\Resources\VolunteerRegistrations\VolunteerRegistrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVolunteerRegistrations extends ListRecords
{
    protected static string $resource = VolunteerRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
