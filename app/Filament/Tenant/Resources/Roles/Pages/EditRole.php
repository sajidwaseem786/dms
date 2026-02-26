<?php

namespace App\Filament\Tenant\Resources\Roles\Pages;

use App\Filament\Tenant\Resources\Roles\RoleResource;
use App\Models\CustomFieldValue;
use App\Models\EventRole;
use App\Models\VolunteerRole;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
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
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['customFields'] = $this->record
            ->customFieldValues
            ->pluck('value', 'custom_field_id')
            ->map(fn($value) => $this->decodeValue($value))
            ->toArray();

        return $data;
    }
    protected function decodeValue($value)
    {
        if (!$value)
            return null;

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE
            ? $decoded
            : $value;
    }
}
