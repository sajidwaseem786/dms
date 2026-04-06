<?php

namespace App\Filament\Tenant\Pages\Profile;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Page
{
    use InteractsWithForms;

    protected static ?string $title = 'Wachtwoord wijzigen';
    protected static ?string $navigationLabel = 'Wachtwoord wijzigen';
    protected static string|\UnitEnum|null $navigationGroup = 'Instellingen';
    protected static string|BackedEnum|null $navigationIcon  =  Heroicon::LockClosed;
    protected static ?int $navigationSort     = 3;
    protected string $view = 'filament.tenant.pages.profile.change-password';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('current_password')
                    ->label('Oud wachtwoord')
                    ->password()
                    ->required(),

                TextInput::make('password')
                    ->label('Nieuw wachtwoord')
                    ->password()
                    ->required()
                    ->minLength(8),

                TextInput::make('password_confirmation')
                    ->label('Herhaal nieuw wachtwoord')
                    ->password()
                    ->required()
                    ->same('password'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!Hash::check($data['current_password'], Auth::user()->password)) {
            throw ValidationException::withMessages([
                'data.current_password' => 'Het huidige wachtwoord is onjuist.',
            ]);
        }

        Auth::user()->update([
            'password' => Hash::make($data['password']),
        ]);

        $this->form->fill();

        Notification::make()
            ->title('Wachtwoord gewijzigd')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Wijzigen')
                ->submit('save'),
        ];
    }
}