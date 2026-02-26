<?php

namespace App\Filament\Tenant\Resources\Users\Pages;

use App\Filament\Tenant\Resources\Users\UserResource;
use App\Models\CustomFieldValue;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected function afterSave(): void
    {
        $this->record->syncRoles([$this->data['roles']]);
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
    public function mount(int|string $record): void
    {
        parent::mount($record);
        $this->data['roles'] = $this->record->roles->pluck('name')->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
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
