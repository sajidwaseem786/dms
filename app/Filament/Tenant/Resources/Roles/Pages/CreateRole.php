<?php

namespace App\Filament\Tenant\Resources\Roles\Pages;

use App\Filament\Tenant\Resources\Roles\RoleResource;
use App\Models\CustomFieldValue;
use App\Models\VolunteerRole;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected function afterCreate(): void
    {
        foreach ($this->data['customFields'] ?? [] as $fieldId => $value) {

            CustomFieldValue::updateOrCreate([
                'custom_field_id' => $fieldId,
                'valuable_id' => $this->record->id,
                'valuable_type' => VolunteerRole::class,
            ], [
                'value' => is_array($value)
                    ? json_encode($value)
                    : $value,
            ]);
        }
    }
}
