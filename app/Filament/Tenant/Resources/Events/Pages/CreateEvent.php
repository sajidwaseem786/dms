<?php

namespace App\Filament\Tenant\Resources\Events\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Tenant\Resources\Events\EventResource;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        return $data;
    }

}
