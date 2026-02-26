<?php

namespace App\Filament\Tenant\Resources\CustomFields\Pages;

use App\Filament\Tenant\Resources\CustomFields\CustomFieldResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomField extends CreateRecord
{
    protected static string $resource = CustomFieldResource::class;
}
