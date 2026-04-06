<?php

namespace App\Filament\Tenant\Pages\Profile;

use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class ChangePhoto extends Page
{
    use InteractsWithForms;

    protected static ?string $title = 'Mijn foto';
    protected static ?string $navigationLabel = 'Foto wijzigen';
    protected static string|\UnitEnum|null $navigationGroup = 'Instellingen';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Camera;
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.tenant.pages.profile.change-photo';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'profile_photo' => Auth::user()->profile_photo,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('profile_photo')
                    ->label('Bestand')
                    ->image()
                    ->disk('public')
                    ->directory('profile-photos')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/gif']),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!empty($data['profile_photo'])) {
            Auth::user()->update(['profile_photo' => $data['profile_photo']]);

            Notification::make()
                ->title('Foto opgeslagen')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Geen foto geselecteerd')
                ->warning()
                ->send();
        }
    }
}