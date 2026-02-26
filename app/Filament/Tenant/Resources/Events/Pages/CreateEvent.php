<?php

namespace App\Filament\Tenant\Resources\Events\Pages;

use App\Filament\Tenant\Resources\Events\EventResource;
use App\Models\CustomFieldValue;
use App\Models\Event;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        return $data;
    }
    protected function afterCreate(): void
    {
        foreach ($this->data['customFields'] ?? [] as $fieldId => $value) {

            CustomFieldValue::updateOrCreate([
                'custom_field_id' => $fieldId,
                'valuable_id' => $this->record->id,
                'valuable_type' => Event::class,
            ], [
                'value' => is_array($value)
                    ? json_encode($value)
                    : $value,
            ]);
        }
    }
}
