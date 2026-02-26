<?php

namespace App\Filament\Tenant\Resources\Users\Pages;

use App\Filament\Tenant\Resources\Users\UserResource;
use App\Models\CustomFieldValue;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function afterCreate(): void
    {
        $this->record->syncRoles(
            $this->data['roles'] ?? []
        );
        foreach ($this->data['customFields'] ?? [] as $fieldId => $value) {

            CustomFieldValue::updateOrCreate([
                'custom_field_id' => $fieldId,
                'valuable_id' => $this->record->id,
                'valuable_type' => \App\Models\User::class,
            ], [
                'value' => is_array($value)
                    ? json_encode($value)
                    : $value,
            ]);
        }
    }
}
