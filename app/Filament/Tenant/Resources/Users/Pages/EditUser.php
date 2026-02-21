<?php

namespace App\Filament\Tenant\Resources\Users\Pages;

use App\Filament\Tenant\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
protected function afterSave(): void
{
    $this->record->syncRoles([$this->data['roles']]);
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
}
