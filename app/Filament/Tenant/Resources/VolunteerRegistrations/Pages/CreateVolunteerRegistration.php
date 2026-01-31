<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations\Pages;

use App\Filament\Tenant\Resources\VolunteerRegistrations\VolunteerRegistrationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVolunteerRegistration extends CreateRecord
{
    protected static string $resource = VolunteerRegistrationResource::class;
    protected $eventRoleIds = [];
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['event_role_ids'])) {
            $this->eventRoleIds = $data['event_role_ids'];
        }
        return $data;
    }
    protected function afterCreate(): void
    {
        $eventRoleIds = $this->eventRoleIds;
        if (!empty($eventRoleIds)) {
            $this->record->eventRole()->sync($eventRoleIds);
        }
    }
}
