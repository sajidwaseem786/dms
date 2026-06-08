<?php

namespace App\Filament\Tenant\Pages\Planning;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class PlanningInstellingen extends Page
{
    protected static ?string $title           = 'Planning instellingen';
    protected static ?string $navigationLabel  = 'Instellingen';
    protected static string|\UnitEnum|null $navigationGroup = 'Planning';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.tenant.pages.planning.planning-instellingen';

    public ?string $selectedVariable = null;

    /**
     * The fixed list of settings rows shown on the page.
     * type: 'categories' => repeater modal, 'text' => textarea/input modal
     */
    public function getRows(): array
    {
        return [
            [
                'variable' => 'planningcat',
                'label'    => 'Planning Categoriën',
                'type'     => 'categories',
            ],
            [
                'variable' => 'reminder_signature',
                'label'    => 'Handtekening reminder',
                'type'     => 'text',
            ],
            [
                'variable' => 'email_signature',
                'label'    => 'Handtekening email',
                'type'     => 'text',
            ],
            [
                'variable' => 'reminder_text_verder',
                'label'    => 'Reminder tekst "Verder"',
                'type'     => 'text',
            ],
            [
                'variable' => 'notification_email',
                'label'    => 'Notificatie emailadres voor nieuwe inschrijvingen (laat leeg om uit te schakelen)',
                'type'     => 'input',
            ],
            [
                'variable' => 'reminder_general',
                'label'    => 'Reminder Algemeen',
                'type'     => 'text',
            ],
        ];
    }

    /** Display the stored value in the table column. */
    public function getDisplayValue(string $variable): string
    {
        $raw = Setting::get($variable);

        if ($variable === 'planningcat') {
            $cats = Setting::getArray($variable);
            return collect($cats)
                ->map(fn ($pair) => is_array($pair) ? ($pair[1] ?? $pair[0] ?? '') : $pair)
                ->filter()
                ->implode(', ');
        }

        return (string) ($raw ?? '');
    }

    // ── Edit categories (repeater) ─────────────────────────────
    public function editCategoriesAction(): Action
    {
        return Action::make('editCategories')
            ->label('Categorieën aanpassen')
            ->modalHeading('Instelling aanpassen')
            ->schema([
                Repeater::make('categories')
                    ->label('Categorieën (geen spaties in waarde!)')
                    ->schema([
                        TextInput::make('label')
                            ->label('Beschrijving')
                            ->required(),
                        TextInput::make('value')
                            ->label('Waarde (GEEN SPATIES!)')
                            ->required(),
                    ])
                    ->columns(2)
                    ->addActionLabel('Nieuwe waarde toevoegen')
                    ->reorderable(false)
                    ->defaultItems(1),
            ])
            ->fillForm(function (): array {
                $cats = Setting::getArray('planningcat');
                return [
                    'categories' => collect($cats)->map(fn ($pair) => [
                        'value' => $pair[0] ?? '',
                        'label' => $pair[1] ?? '',
                    ])->all(),
                ];
            })
            ->modalSubmitActionLabel('Wijzigen')
            ->action(function (array $data): void {
                $pairs = collect($data['categories'] ?? [])
                    ->map(fn ($row) => [$row['value'], $row['label']])
                    ->all();

                Setting::set('planningcat', $pairs);

                Notification::make()->title('Instelling bijgewerkt')->success()->send();
            });
    }

    // ── Edit a text setting (textarea) ─────────────────────────
    public function editTextAction(): Action
    {
        return Action::make('editText')
            ->label('Aanpassen')
            ->modalHeading('Instelling aanpassen')
            ->schema([
                Textarea::make('value')
                    ->label('Waarde')
                    ->rows(5)
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (): array => ['value' => Setting::get($this->selectedVariable)])
            ->modalSubmitActionLabel('Wijzigen')
            ->action(function (array $data): void {
                if (! $this->selectedVariable) {
                    return;
                }
                Setting::set($this->selectedVariable, $data['value'] ?? '');
                Notification::make()->title('Instelling bijgewerkt')->success()->send();
            });
    }

    // ── Edit a single-line input setting (email) ───────────────
    public function editInputAction(): Action
    {
        return Action::make('editInput')
            ->label('Aanpassen')
            ->modalHeading('Instelling aanpassen')
            ->schema([
                TextInput::make('value')
                    ->label('Waarde')
                    ->email()
                    ->columnSpanFull(),
            ])
            ->fillForm(fn (): array => ['value' => Setting::get($this->selectedVariable)])
            ->modalSubmitActionLabel('Wijzigen')
            ->action(function (array $data): void {
                if (! $this->selectedVariable) {
                    return;
                }
                Setting::set($this->selectedVariable, $data['value'] ?? '');
                Notification::make()->title('Instelling bijgewerkt')->success()->send();
            });
    }

    // ── Row click handlers (set selected variable, open right modal) ──
    public function selectAndEdit(string $variable, string $type): void
    {
        $this->selectedVariable = $variable;

        match ($type) {
            'categories' => $this->mountAction('editCategories'),
            'input'      => $this->mountAction('editInput'),
            default      => $this->mountAction('editText'),
        };
    }
}