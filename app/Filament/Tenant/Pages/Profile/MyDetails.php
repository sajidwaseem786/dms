<?php

namespace App\Filament\Tenant\Pages\Profile;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class MyDetails extends Page
{
    protected static ?string $title = 'Mijn gegevens';
    protected static ?string $navigationLabel = 'Mijn gegevens';
    protected static string|\UnitEnum|null $navigationGroup = 'Instellingen';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.tenant.pages.profile.my-details';

    // Edit modal form state
    public ?array $data = [];

    public function mount(): void
    {
        $this->data = Auth::user()->only([
            'first_name', 'last_name', 'gender', 'birth_date',
            'street', 'house_number', 'postal_code', 'city', 'country',
            'email', 'phone', 'iban', 'smoelenboek_description',
            'big_ehbo', 'big_ehbo_valid_until', 'has_license',
        ]);
    }

    // Edit action that opens a modal
    public function editAction(): Action
    {
        return Action::make('edit')
            ->label('Gegevens wijzigen')
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('first_name')->label('Voornaam')->required(),
                    TextInput::make('last_name')->label('Achternaam')->required(),
                ]),
                Grid::make(2)->schema([
                    Select::make('gender')
                        ->label('Geslacht')
                        ->options([
                            'male'   => 'Man',
                            'female' => 'Vrouw',
                            'other'  => 'Anders',
                        ]),
                    DatePicker::make('birth_date')
                        ->label('Geboortedatum')
                        ->native(false)
                        ->displayFormat('d-m-Y'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('street')->label('Straat'),
                    TextInput::make('house_number')->label('Huisnummer'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('postal_code')->label('Postcode'),
                    TextInput::make('city')->label('Woonplaats'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('country')->label('Land')->default('Nederland'),
                    TextInput::make('email')->label('E-mailadres')->email()->required(),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('phone')->label('Telefoonnummer')->tel(),
                    TextInput::make('iban')->label('IBAN'),
                ]),
                Textarea::make('smoelenboek_description')
                    ->label('Beschrijving (smoelenboek)')
                    ->rows(3)
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    TextInput::make('big_ehbo')->label('BIG-/EHBO-nummer'),
                    DatePicker::make('big_ehbo_valid_until')
                        ->label('BIG/EHBO geldig tot')
                        ->native(false)
                        ->displayFormat('d-m-Y'),
                ]),
                Toggle::make('has_license')->label('Rijbewijs'),
            ])
            ->fillForm(fn() => Auth::user()->only([
                'first_name', 'last_name', 'gender', 'birth_date',
                'street', 'house_number', 'postal_code', 'city', 'country',
                'email', 'phone', 'iban', 'smoelenboek_description',
                'big_ehbo', 'big_ehbo_valid_until', 'has_license',
            ]))
            ->action(function (array $data): void {
                Auth::user()->update($data);
                // Refresh local data
                $this->data = Auth::user()->fresh()->only([
                    'first_name', 'last_name', 'gender', 'birth_date',
                    'street', 'house_number', 'postal_code', 'city', 'country',
                    'email', 'phone', 'iban', 'smoelenboek_description',
                    'big_ehbo', 'big_ehbo_valid_until', 'has_license',
                ]);
                Notification::make()
                    ->title('Gegevens opgeslagen')
                    ->success()
                    ->send();
            });
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}