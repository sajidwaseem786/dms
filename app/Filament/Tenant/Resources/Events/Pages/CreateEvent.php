<?php

namespace App\Filament\Tenant\Resources\Events\Pages;

use App\Filament\Tenant\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
