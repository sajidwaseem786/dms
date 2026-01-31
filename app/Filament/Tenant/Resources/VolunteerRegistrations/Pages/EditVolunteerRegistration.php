<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations\Pages;

use App\Filament\Tenant\Resources\VolunteerRegistrations\VolunteerRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVolunteerRegistration extends EditRecord
{
    protected static string $resource = VolunteerRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function mount(int|string $record): void
    {
        parent::mount($record);
        $this->data['event_role_ids'] = $this->record->eventRole->pluck('id')->toArray();
    }

    protected function afterSave(): void
    {
        $eventRoleIds = $this->record->event_role_ids ?? [];
        if (!empty($eventRoleIds)) {
            $this->record->eventRole()->sync($eventRoleIds);
        }
    }
}
