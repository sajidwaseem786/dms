<?php

namespace App\Filament\Tenant\Resources\CustomFields\Pages;

use App\Filament\Tenant\Resources\CustomFields\CustomFieldResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomField extends EditRecord
{
    protected static string $resource = CustomFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
